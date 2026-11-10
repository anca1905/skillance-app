<?php
/**
 * Skillance Order & Payment Verification API
 * Manages order statuses with 1x24 hour admin manual verification gate.
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'OPTIONS') {
    http_response_code(200);
    exit;
}

require_once __DIR__ . '/../config/config.php';

// Auto create table academy_orders
if ($conn && $conn instanceof mysqli && !$conn->connect_error) {
    @$conn->query("
        CREATE TABLE IF NOT EXISTS academy_orders (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            invoice_no VARCHAR(50) UNIQUE NOT NULL,
            product_id VARCHAR(50) NOT NULL,
            product_title VARCHAR(200) NOT NULL,
            nominal INT NOT NULL DEFAULT 79000,
            buyer_name VARCHAR(150) NULL,
            buyer_whatsapp VARCHAR(30) NULL,
            status VARCHAR(20) NOT NULL DEFAULT 'pending',
            download_url VARCHAR(255) NOT NULL DEFAULT 'downloads/sidesa-bundle-master.zip',
            verified_at DATETIME NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            INDEX idx_inv (invoice_no),
            INDEX idx_status (status)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");
}

$action = $_GET['action'] ?? ($_POST['action'] ?? 'check');

// ACTION 1: Check Invoice Status
if ($action === 'check') {
    $inv = trim($_GET['invoice'] ?? '');
    if (empty($inv)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Nomor invoice diperlukan.']);
        exit;
    }

    if ($conn && $conn instanceof mysqli && !$conn->connect_error) {
        $invSafe = $conn->real_escape_string($inv);
        $res = $conn->query("SELECT * FROM academy_orders WHERE invoice_no = '$invSafe' LIMIT 1");
        if ($res && $row = $res->fetch_assoc()) {
            if ($row['status'] === 'verified') {
                echo json_encode([
                    'status' => 'verified',
                    'message' => 'Pembayaran Anda telah diverifikasi oleh Admin!',
                    'data' => [
                        'invoice_no' => $row['invoice_no'],
                        'product_title' => $row['product_title'],
                        'status' => 'verified',
                        'download_url' => $row['download_url'],
                        'verified_at' => $row['verified_at']
                    ]
                ]);
                exit;
            } else {
                echo json_encode([
                    'status' => 'pending',
                    'message' => 'Pembayaran sedang menunggu konfirmasi Admin (Maksimal 1x24 Jam).',
                    'data' => [
                        'invoice_no' => $row['invoice_no'],
                        'product_title' => $row['product_title'],
                        'status' => 'pending',
                        'download_url' => null
                    ]
                ]);
                exit;
            }
        }
    }

    // Default if not yet recorded: treat as pending 1x24h
    echo json_encode([
        'status' => 'pending',
        'message' => 'Pembayaran dengan No. Invoice ' . htmlspecialchars($inv) . ' sedang dalam antrean verifikasi Admin (Maksimal 1x24 Jam).',
        'data' => [
            'invoice_no' => $inv,
            'status' => 'pending',
            'download_url' => null
        ]
    ]);
    exit;
}

// ACTION 2: Register Pending Order (When QRIS modal is opened / submitted)
if ($action === 'register') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) $input = $_POST;

    $inv   = trim($input['invoice_no'] ?? '');
    $pid   = trim($input['product_id'] ?? 'sidesa');
    $title = trim($input['product_title'] ?? 'Sistem Informasi Desa Mandiri (SIDESA)');
    $price = intval($input['nominal'] ?? 79000);
    $name  = trim($input['buyer_name'] ?? 'Pelanggan Skillance');
    $wa    = trim($input['buyer_whatsapp'] ?? '');
    $dl    = trim($input['download_url'] ?? 'downloads/sidesa-bundle-master.zip');

    if (empty($inv)) {
        $inv = 'INV-2026-' . rand(1000, 9999);
    }

    if ($conn && $conn instanceof mysqli && !$conn->connect_error) {
        $stmt = $conn->prepare("INSERT INTO academy_orders (invoice_no, product_id, product_title, nominal, buyer_name, buyer_whatsapp, download_url, status) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, 'pending') 
                                ON DUPLICATE KEY UPDATE buyer_name = VALUES(buyer_name), buyer_whatsapp = VALUES(buyer_whatsapp), download_url = VALUES(download_url)");
        if ($stmt) {
            $stmt->bind_param("sssisss", $inv, $pid, $title, $price, $name, $wa, $dl);
            $stmt->execute();
            $stmt->close();
        }
    }

    echo json_encode([
        'status' => 'success',
        'message' => 'Order berhasil dicatat. Menunggu verifikasi admin 1x24 jam.',
        'data' => [
            'invoice_no' => $inv,
            'product_title' => $title,
            'status' => 'pending'
        ]
    ]);
    exit;
}

// ACTION 3: Admin Approval
if ($action === 'approve') {
    $input = json_decode(file_get_contents('php://input'), true);
    if (!$input) $input = $_POST;
    $inv = trim($input['invoice_no'] ?? ($_GET['invoice_no'] ?? ''));
    if (!empty($inv) && $conn && $conn instanceof mysqli && !$conn->connect_error) {
        $invSafe = $conn->real_escape_string($inv);
        $conn->query("UPDATE academy_orders SET status = 'verified', verified_at = NOW() WHERE invoice_no = '$invSafe'");
        echo json_encode([
            'status' => 'success',
            'message' => 'Order ' . $inv . ' berhasil diverifikasi! Akses download ZIP telah dibuka.'
        ]);
        exit;
    }
    echo json_encode([
        'status' => 'error',
        'message' => 'Gagal verifikasi: Nomor invoice tidak valid.'
    ]);
    exit;
}
