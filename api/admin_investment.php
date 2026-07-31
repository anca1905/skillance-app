<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");

require_once '../config/config.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // 1. Get recent investments
    $investments = [];
    $trx_query = $conn->query("SELECT * FROM finances WHERE category='Modal Investasi' ORDER BY date DESC, id DESC");
    if ($trx_query) {
        while ($row = $trx_query->fetch_assoc()) {
            $investments[] = [
                "id" => $row['id'],
                "date" => $row['date'],
                "description" => $row['description'],
                "amount" => (float)$row['amount']
            ];
        }
    }

    // 2. Get overall stats (Total Modal, Total Profit)
    $totalModal = 0;
    $q_modal = $conn->query("SELECT SUM(amount) as total FROM finances WHERE category='Modal Investasi' AND type='expense'");
    if ($q_modal && $row = $q_modal->fetch_assoc()) {
        $totalModal = (float)$row['total'];
    }

    $totalProfit = 0;
    $q_profit = $conn->query("SELECT SUM(amount) as total FROM finances WHERE category='Profit Investasi' AND type='income'");
    if ($q_profit && $row = $q_profit->fetch_assoc()) {
        $totalProfit = (float)$row['total'];
    }

    echo json_encode([
        "status" => "success",
        "investments" => $investments,
        "totalModal" => $totalModal,
        "totalProfit" => $totalProfit
    ]);
    exit();
}

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data) $data = $_POST;

    $amount = (float)($data['amount'] ?? 0);
    $desc = $conn->real_escape_string($data['description'] ?? '');
    $date = $conn->real_escape_string($data['date'] ?? date('Y-m-d'));

    if (empty($amount) || empty($desc)) {
        echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
        exit();
    }

    // Always format description as context
    $formatted_desc = "Investasi: " . $desc;

    // Save investment as an expense in finances
    $sql = "INSERT INTO finances (type, amount, description, category, date) VALUES ('expense', $amount, '$formatted_desc', 'Modal Investasi', '$date')";

    if ($conn->query($sql)) {
        echo json_encode(["status" => "success", "message" => "Modal investasi berhasil ditambahkan"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan investasi: " . $conn->error]);
    }
    exit();
}

echo json_encode(["status" => "error", "message" => "Invalid request method"]);
