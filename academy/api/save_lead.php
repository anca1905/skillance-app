<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
    exit;
}

// Support both JSON payload and multipart/urlencoded POST
$input = json_decode(file_get_contents('php://input'), true);
if (!is_array($input)) {
    $input = $_POST;
}

$productId = trim($input['product_id'] ?? '');
$productTitle = trim($input['product_title'] ?? '');
$fullName = trim($input['full_name'] ?? '');
$whatsapp = trim($input['whatsapp'] ?? '');
$email = trim($input['email'] ?? '');
$profession = trim($input['profession'] ?? 'Mahasiswa');
$ipAddress = $_SERVER['REMOTE_ADDR'] ?? '';

// Basic validation
if (empty($fullName) || empty($whatsapp) || empty($productId)) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Mohon lengkapi Nama Lengkap dan Nomor WhatsApp Anda.'
    ]);
    exit;
}

// Clean phone format
$whatsapp = preg_replace('/[^0-9]/', '', $whatsapp);
if (strpos($whatsapp, '0') === 0) {
    $whatsapp = '62' . substr($whatsapp, 1);
}

$leadId = 0;
if ($conn) {
    $stmt = $conn->prepare("INSERT INTO `academy_leads` 
        (`product_id`, `product_title`, `full_name`, `whatsapp`, `email`, `profession`, `ip_address`, `status`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, 'active')");
    if ($stmt) {
        $stmt->bind_param('sssssss', 
            $productId, 
            $productTitle, 
            $fullName, 
            $whatsapp, 
            $email, 
            $profession, 
            $ipAddress
        );
        $stmt->execute();
        $leadId = $stmt->insert_id;
        $stmt->close();
    }
}

$previewUrl = 'sample_preview.php?pid=' . urlencode($productId) . '&lead=' . $leadId;

echo json_encode([
    'success' => true,
    'lead_id' => $leadId,
    'preview_url' => $previewUrl,
    'message' => 'Terima kasih! Sampel gratis Bab 1 & Daftar Isi siap Anda baca dan download.'
]);
