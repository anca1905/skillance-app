<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, DELETE");

require_once '../config/config.php';

$method = $_SERVER['REQUEST_METHOD'];

// Helper to sanitize
function clean_str($conn, $val) {
    return $conn->real_escape_string(trim($val ?? ''));
}

if ($method === 'GET') {
    $year = isset($_GET['year']) ? intval($_GET['year']) : intval(date('Y'));
    if ($year < 2020 || $year > 2035) $year = intval(date('Y'));

    $unitFilter = isset($_GET['unit']) ? clean_str($conn, $_GET['unit']) : '';

    $income = 0;
    $expense = 0;

    // 1. Overall stats
    $stats_query = $conn->query("SELECT type, SUM(amount) as total FROM finances GROUP BY type");
    if ($stats_query) {
        while ($row = $stats_query->fetch_assoc()) {
            if ($row['type'] === 'income') {
                $income = (float)$row['total'];
            } else {
                $expense = (float)$row['total'];
            }
        }
    }
    $balance = $income - $expense;

    $stats = [
        "income" => $income,
        "expense" => $expense,
        "balance" => $balance,
        "active_year" => $year
    ];

    // 2. Monthly SPT Pajak Badan (PP 55 / PPh Final 0.5% & Laba Rugi)
    $monthNames = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
        5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    $monthlyData = [];
    for ($m = 1; $m <= 12; $m++) {
        $monthlyData[$m] = [
            "month" => $m,
            "month_name" => $monthNames[$m],
            "income" => 0,
            "expense" => 0,
            "net_profit" => 0,
            "tax_rate" => 0.005, // 0.5% PP 55 / PPh Final UMKM
            "pph_final" => 0,
            "trx_count" => 0
        ];
    }

    $q_monthly = $conn->query("
        SELECT 
            MONTH(date) as bln,
            type,
            SUM(amount) as total_amt,
            COUNT(id) as cnt
        FROM finances 
        WHERE YEAR(date) = $year
        GROUP BY MONTH(date), type
    ");

    if ($q_monthly) {
        while ($r = $q_monthly->fetch_assoc()) {
            $bln = (int)$r['bln'];
            if (isset($monthlyData[$bln])) {
                if ($r['type'] === 'income') {
                    $monthlyData[$bln]['income'] += (float)$r['total_amt'];
                } else {
                    $monthlyData[$bln]['expense'] += (float)$r['total_amt'];
                }
                $monthlyData[$bln]['trx_count'] += (int)$r['cnt'];
            }
        }
    }

    $yearlyIncome = 0;
    $yearlyExpense = 0;
    $yearlyPph = 0;

    $sptMonthly = [];
    foreach ($monthlyData as $m => $d) {
        $inc = $d['income'];
        $exp = $d['expense'];
        $net = $inc - $exp;
        $pph = round($inc * 0.005); // 0.5% PPh Final

        $yearlyIncome += $inc;
        $yearlyExpense += $exp;
        $yearlyPph += $pph;

        $d['net_profit'] = $net;
        $d['pph_final'] = $pph;
        $sptMonthly[] = $d;
    }

    $sptSummary = [
        "year" => $year,
        "yearly_income" => $yearlyIncome,
        "yearly_expense" => $yearlyExpense,
        "yearly_net_profit" => ($yearlyIncome - $yearlyExpense),
        "yearly_pph_final" => $yearlyPph,
        "monthly" => $sptMonthly
    ];

    // 3. Unit Bisnis Breakdown
    $unitsBreakdown = [];
    $defaultUnits = [
        'Software House',
        'Bursa Freelance',
        'Skillance Academy',
        'Aquirist Print',
        'Penyewaan Akrilik',
        'Media Pemberitaan',
        'Operasional Kantor'
    ];

    foreach ($defaultUnits as $u) {
        $unitsBreakdown[$u] = [
            "unit" => $u,
            "income" => 0,
            "expense" => 0,
            "net" => 0,
            "count" => 0
        ];
    }

    $q_unit = $conn->query("
        SELECT 
            COALESCE(NULLIF(unit_bisnis, ''), 'Software House') as unit_name,
            type,
            SUM(amount) as total,
            COUNT(id) as cnt
        FROM finances
        GROUP BY unit_name, type
    ");

    if ($q_unit) {
        while ($r = $q_unit->fetch_assoc()) {
            $uName = $r['unit_name'];
            if (!isset($unitsBreakdown[$uName])) {
                $unitsBreakdown[$uName] = [
                    "unit" => $uName,
                    "income" => 0,
                    "expense" => 0,
                    "net" => 0,
                    "count" => 0
                ];
            }
            if ($r['type'] === 'income') {
                $unitsBreakdown[$uName]['income'] += (float)$r['total'];
            } else {
                $unitsBreakdown[$uName]['expense'] += (float)$r['total'];
            }
            $unitsBreakdown[$uName]['count'] += (int)$r['cnt'];
        }
    }

    foreach ($unitsBreakdown as $k => $v) {
        $unitsBreakdown[$k]['net'] = $v['income'] - $v['expense'];
    }

    // 4. Get transactions
    $whereClause = "";
    if (!empty($unitFilter)) {
        $whereClause = "WHERE unit_bisnis = '$unitFilter'";
    }

    $transactions = [];
    $trx_query = $conn->query("
        SELECT id, project_id, type, amount, description, category, date, created_at,
               COALESCE(NULLIF(unit_bisnis, ''), 'Software House') as unit_bisnis
        FROM finances 
        $whereClause
        ORDER BY date DESC, id DESC 
        LIMIT 100
    ");

    if ($trx_query) {
        while ($row = $trx_query->fetch_assoc()) {
            $transactions[] = [
                "id" => $row['id'],
                "project_id" => $row['project_id'],
                "date" => $row['date'],
                "desc" => $row['description'],
                "category" => $row['category'] ?? 'Lainnya',
                "unit_bisnis" => $row['unit_bisnis'] ?? 'Software House',
                "type" => $row['type'],
                "amount" => (float)$row['amount']
            ];
        }
    }

    echo json_encode([
        "status" => "success",
        "stats" => $stats,
        "spt_summary" => $sptSummary,
        "business_units" => array_values($unitsBreakdown),
        "transactions" => $transactions
    ]);
    exit();
}

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data) $data = $_POST;

    $type = clean_str($conn, $data['type'] ?? '');
    $amount = (float)($data['amount'] ?? 0);
    $desc = clean_str($conn, $data['description'] ?? '');
    $date = clean_str($conn, $data['date'] ?? date('Y-m-d'));
    $unit = clean_str($conn, $data['unit_bisnis'] ?? '');
    $category = clean_str($conn, $data['category'] ?? '');

    if (empty($type) || empty($amount) || empty($desc)) {
        echo json_encode(["status" => "error", "message" => "Data tidak lengkap. Mohon isi jenis, nominal, dan keterangan."]);
        exit();
    }

    // Default Unit Bisnis deduction if empty
    if (empty($unit)) {
        $desc_lower = strtolower($desc);
        if (strpos($desc_lower, 'print') !== false || strpos($desc_lower, 'cetak') !== false || strpos($desc_lower, 'spanduk') !== false || strpos($desc_lower, 'stiker') !== false) {
            $unit = 'Aquirist Print';
        } else if (strpos($desc_lower, 'akrilik') !== false || strpos($desc_lower, 'plakat') !== false || strpos($desc_lower, 'stand') !== false) {
            $unit = 'Penyewaan Akrilik';
        } else if (strpos($desc_lower, 'berita') !== false || strpos($desc_lower, 'media') !== false || strpos($desc_lower, 'pers') !== false || strpos($desc_lower, 'advertorial') !== false) {
            $unit = 'Media Pemberitaan';
        } else if (strpos($desc_lower, 'academy') !== false || strpos($desc_lower, 'kursus') !== false || strpos($desc_lower, 'bootcamp') !== false) {
            $unit = 'Skillance Academy';
        } else if (strpos($desc_lower, 'freelance') !== false || strpos($desc_lower, 'bursa') !== false) {
            $unit = 'Bursa Freelance';
        } else if (strpos($desc_lower, 'server') !== false || strpos($desc_lower, 'hosting') !== false || strpos($desc_lower, 'listrik') !== false || strpos($desc_lower, 'operasional') !== false) {
            $unit = 'Operasional Kantor';
        } else {
            $unit = 'Software House';
        }
    }

    if (empty($category)) {
        $desc_lower = strtolower($desc);
        if (strpos($desc_lower, 'project') !== false || strpos($desc_lower, 'website') !== false || strpos($desc_lower, 'aplikasi') !== false) {
            $category = 'Project';
        } else if (strpos($desc_lower, 'hosting') !== false || strpos($desc_lower, 'server') !== false || strpos($desc_lower, 'domain') !== false || strpos($desc_lower, 'listrik') !== false) {
            $category = 'Operasional';
        } else if (strpos($desc_lower, 'gaji') !== false || strpos($desc_lower, 'honor') !== false || strpos($desc_lower, 'fee') !== false) {
            $category = 'Honorarium';
        } else {
            $category = ($type === 'income') ? 'Pendapatan Usaha' : 'Biaya Usaha';
        }
    }

    $sql = "INSERT INTO finances (type, amount, description, category, unit_bisnis, date) 
            VALUES ('$type', $amount, '$desc', '$category', '$unit', '$date')";
    
    if ($conn->query($sql)) {
        echo json_encode([
            "status" => "success", 
            "message" => "Transaksi keuangan berhasil dicatat ke pembukuan PT Skillance Digital Indonesia."
        ]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan transaksi: " . $conn->error]);
    }
    exit();
}

if ($method === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = isset($data['id']) ? intval($data['id']) : 0;

    if ($id <= 0) {
        echo json_encode(["status" => "error", "message" => "ID transaksi tidak valid."]);
        exit();
    }

    $stmt = $conn->prepare("DELETE FROM finances WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Transaksi berhasil dihapus dari pembukuan."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menghapus: " . $conn->error]);
    }
    $stmt->close();
    exit();
}

echo json_encode(["status" => "error", "message" => "Invalid request method"]);
