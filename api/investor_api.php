<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST");

require_once '../config/config.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // 1. Get transactions for this investor (we'll filter by user_id if auth is fully implemented, right now we just pull all 'Profit Investasi' related or user passed context. Since investor dashboard is isolated, we'll fetch all transactions for now or filter by a specific 'type' if needed. The frontend only needs transactions. Let's fetch from `transactions` table.)

    $transactions = [];
    $trx_query = $conn->query("SELECT * FROM transactions WHERE category='Profit Investasi' OR category IS NULL ORDER BY created_at DESC LIMIT 50");
    if ($trx_query) {
        while ($row = $trx_query->fetch_assoc()) {
            if (!is_null($row['buy_price'])) { // Only show investor ones
                $transactions[] = [
                    "id" => $row['id'],
                    "date" => $row['created_at'],
                    "type" => $row['description'],
                    "buyPrice" => (float)$row['buy_price'],
                    "sellPrice" => (float)$row['sell_price']
                ];
            }
        }
    }

    // 2. Get Total Capital invested to this user from finances
    // If Admin gave "Modal Investasi", it's an expense in finance.
    $capital = 0;
    $q_capital = $conn->query("SELECT SUM(amount) as total FROM finances WHERE type='expense' AND category='Modal Investasi'");
    if ($q_capital && $row = $q_capital->fetch_assoc()) {
        $capital = (float)$row['total'];
    }

    // 3. Get Total Profit from transactions (or from finances where category='Profit Investasi')
    $totalProfit = 0;
    $q_profit = $conn->query("SELECT SUM(amount) as total FROM finances WHERE type='income' AND category='Profit Investasi'");
    if ($q_profit && $row = $q_profit->fetch_assoc()) {
        $totalProfit = (float)$row['total'];
    }

    echo json_encode([
        "status" => "success",
        "transactions" => $transactions,
        "capital" => $capital,
        "totalProfit" => $totalProfit
    ]);
    exit();
}

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data) $data = $_POST;

    $type_desc = $conn->real_escape_string($data['type'] ?? '');
    $buyPrice = (float)($data['buyPrice'] ?? 0);
    $sellPrice = (float)($data['sellPrice'] ?? 0);
    $date = date('Y-m-d H:i:s');
    $financeDate = date('Y-m-d');

    if (empty($type_desc) || empty($buyPrice) || empty($sellPrice)) {
        echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
        exit();
    }

    $profit = $sellPrice - $buyPrice;

    // 1. Save to transactions
    $sql_trx = "INSERT INTO transactions (transaction_date, description, type, category, amount, buy_price, sell_price, created_at) VALUES ('$financeDate', '$type_desc', 'income', 'Profit Investasi', $profit, $buyPrice, $sellPrice, '$date')";
    if ($conn->query($sql_trx)) {

        // 2. Save profit to finances as income automatically
        if ($profit > 0) {
            $desc = "Profit: " . $type_desc;
            $sql_fin = "INSERT INTO finances (type, amount, description, category, date) VALUES ('income', $profit, '$desc', 'Profit Investasi', '$financeDate')";
            $conn->query($sql_fin);
        }

        echo json_encode(["status" => "success", "message" => "Transaksi berhasil dicatat"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan: " . $conn->error]);
    }
    exit();
}

echo json_encode(["status" => "error", "message" => "Invalid request method"]);
