<?php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../includes/phone_helper.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method Not Allowed']);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
if (!is_array($input)) {
    $input = $_POST;
}

$productId    = trim($input['product_id'] ?? '');
$productTitle = trim($input['product_title'] ?? '');
$fullName     = trim($input['full_name'] ?? '');
$whatsapp     = trim($input['whatsapp'] ?? '');
$email        = trim($input['email'] ?? '');
$profession   = trim($input['profession'] ?? 'Mahasiswa');
$ipAddress    = $_SERVER['REMOTE_ADDR'] ?? '';

// Basic required validation
if (empty($fullName) || empty($whatsapp) || empty($productId)) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Mohon lengkapi Nama Lengkap dan Nomor WhatsApp Anda.'
    ]);
    exit;
}

// Strict Indonesian Phone Number Validation
$phoneVal = validateIndonesianPhone($whatsapp);
if (!$phoneVal['valid']) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => $phoneVal['message']
    ]);
    exit;
}

$cleanWhatsapp = $phoneVal['phone'];
$operator      = $phoneVal['operator'];

$leadId = 0;
if ($conn) {
    $stmt = $conn->prepare("INSERT INTO `academy_leads` 
        (`product_id`, `product_title`, `full_name`, `whatsapp`, `email`, `profession`, `ip_address`, `status`, `is_wa_verified`, `wa_provider`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, 'active', 0, ?)");
    if ($stmt) {
        $stmt->bind_param('ssssssss', 
            $productId, 
            $productTitle, 
            $fullName, 
            $cleanWhatsapp, 
            $email, 
            $profession, 
            $ipAddress,
            $operator
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
    'operator' => $operator,
    'preview_url' => $previewUrl,
    'message' => 'Terima kasih! Sampel gratis Bab 1 & Daftar Isi siap Anda baca dan download.'
]);
