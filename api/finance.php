<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");

require_once '../config/config.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $income = 0;
    $expense = 0;

    // Get stats
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
        "balance" => $balance
    ];

    // Get transactions
    $transactions = [];
    $trx_query = $conn->query("SELECT * FROM finances ORDER BY date DESC, id DESC LIMIT 50");
    if ($trx_query) {
        while ($row = $trx_query->fetch_assoc()) {
            $transactions[] = [
                "id" => $row['id'],
                "date" => $row['date'],
                "desc" => $row['description'],
                "category" => $row['category'],
                "type" => $row['type'],
                "amount" => (float)$row['amount']
            ];
        }
    }

    echo json_encode([
        "status" => "success",
        "stats" => $stats,
        "transactions" => $transactions
    ]);
    exit();
}

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    // If not JSON, try $_POST
    if (!$data) {
        $data = $_POST;
    }

    $type = $conn->real_escape_string($data['type'] ?? '');
    $amount = (float)($data['amount'] ?? 0);
    $desc = $conn->real_escape_string($data['description'] ?? '');
    $date = $conn->real_escape_string($data['date'] ?? date('Y-m-d'));

    // Simple category logic based on description
    $category = 'Lainnya';
    $desc_lower = strtolower($desc);
    if (strpos($desc_lower, 'project') !== false || strpos($desc_lower, 'website') !== false || strpos($desc_lower, 'aplikasi') !== false) {
        $category = 'Project';
    } else if (strpos($desc_lower, 'hosting') !== false || strpos($desc_lower, 'server') !== false || strpos($desc_lower, 'domain') !== false || strpos($desc_lower, 'listrik') !== false) {
        $category = 'Operasional';
    }

    if (empty($type) || empty($amount) || empty($desc)) {
        echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
        exit();
    }

    $sql = "INSERT INTO finances (type, amount, description, category, date) VALUES ('$type', $amount, '$desc', '$category', '$date')";
    if ($conn->query($sql)) {
        echo json_encode(["status" => "success", "message" => "Transaksi berhasil dicatat"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan: " . $conn->error]);
    }
    exit();
}

echo json_encode(["status" => "error", "message" => "Invalid request method"]);
