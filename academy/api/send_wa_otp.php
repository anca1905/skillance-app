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

$whatsapp = trim($input['whatsapp'] ?? '');
$fullName = trim($input['full_name'] ?? 'Calon Developer');
$productId = trim($input['product_id'] ?? 'sidesa');

// 1. Strict Phone Validation
$phoneVal = validateIndonesianPhone($whatsapp);
if (!$phoneVal['valid']) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => $phoneVal['message']
    ]);
    exit;
}

$cleanPhone = $phoneVal['phone'];
$operator = $phoneVal['operator'];

// 2. Generate 4-digit OTP
$otp = str_pad(strval(mt_rand(1000, 9999)), 4, '0', STR_PAD_LEFT);
$expiresAt = date('Y-m-d H:i:s', strtotime('+10 minutes'));

// 3. Store OTP in database
if ($conn) {
    // Invalidate old OTPs for this phone
    $invStmt = $conn->prepare("UPDATE `academy_otps` SET `is_used` = 1 WHERE `whatsapp` = ?");
    if ($invStmt) {
        $invStmt->bind_param('s', $cleanPhone);
        $invStmt->execute();
        $invStmt->close();
    }

    $stmt = $conn->prepare("INSERT INTO `academy_otps` (`whatsapp`, `otp`, `full_name`, `expires_at`, `is_used`) VALUES (?, ?, ?, ?, 0)");
    if ($stmt) {
        $stmt->bind_param('ssss', $cleanPhone, $otp, $fullName, $expiresAt);
        $stmt->execute();
        $stmt->close();
    }
}

// 4. Dispatch WhatsApp Message
$waText = "Halo Kak {$fullName}! 🚀\n\nKode verifikasi Skillance Academy Anda adalah: *{$otp}*\n\nMasukkan kode ini pada web untuk membuka akses dan mengunduh Sampel Bab 1 & Paket Proyek SIDESA. Jangan bagikan kode ini kepada siapa pun.";

$sendRes = sendWhatsAppMessage($cleanPhone, $waText);

$response = [
    'success' => true,
    'message' => "Kode verifikasi 4-digit telah dikirim ke nomor WhatsApp {$phoneVal['formatted']} ({$operator}).",
    'operator' => $operator,
    'phone' => $cleanPhone,
    'is_gateway_active' => $sendRes['success']
];

// If running in development/standby without live headless whatsapp node running,
// we provide the test OTP in the response payload for testing so the user/developer isn't blocked.
if (!$sendRes['success']) {
    $response['simulation_otp'] = $otp;
    $response['notice'] = "WhatsApp Gateway lokal sedang standby. Kode verifikasi uji coba: {$otp}";
}

echo json_encode($response);
