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

$whatsapp     = trim($input['whatsapp'] ?? '');
$otp          = trim($input['otp'] ?? '');
$fullName     = trim($input['full_name'] ?? '');
$email        = trim($input['email'] ?? '');
$profession   = trim($input['profession'] ?? 'Mahasiswa');
$productId    = trim($input['product_id'] ?? 'sidesa');
$productTitle = trim($input['product_title'] ?? 'Sistem Informasi Desa Mandiri & Layanan Surat Warga (SIDESA)');
$ipAddress    = $_SERVER['REMOTE_ADDR'] ?? '';

// Validate Phone
$phoneVal = validateIndonesianPhone($whatsapp);
if (!$phoneVal['valid']) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => $phoneVal['message']]);
    exit;
}
$cleanPhone = $phoneVal['phone'];
$operator   = $phoneVal['operator'];

if (empty($otp)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Mohon masukkan 4-digit kode OTP verifikasi WhatsApp.']);
    exit;
}

// Check OTP in DB
$isOtpValid = false;
if ($conn) {
    $now = date('Y-m-d H:i:s');
    $stmt = $conn->prepare("SELECT id FROM `academy_otps` WHERE `whatsapp` = ? AND `otp` = ? AND `is_used` = 0 AND `expires_at` >= ? ORDER BY id DESC LIMIT 1");
    if ($stmt) {
        $stmt->bind_param('sss', $cleanPhone, $otp, $now);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res && $res->num_rows > 0) {
            $otpRow = $res->fetch_assoc();
            $otpId = $otpRow['id'];
            $isOtpValid = true;

            // Mark OTP as used
            $upStmt = $conn->prepare("UPDATE `academy_otps` SET `is_used` = 1 WHERE `id` = ?");
            if ($upStmt) {
                $upStmt->bind_param('i', $otpId);
                $upStmt->execute();
                $upStmt->close();
            }
        }
        $stmt->close();
    }
}

if (!$isOtpValid) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'message' => 'Kode verifikasi WhatsApp salah atau sudah kedaluwarsa. Silakan minta kode baru.'
    ]);
    exit;
}

// Save verified lead into academy_leads
$leadId = 0;
if ($conn) {
    $now = date('Y-m-d H:i:s');
    $insStmt = $conn->prepare("INSERT INTO `academy_leads` 
        (`product_id`, `product_title`, `full_name`, `whatsapp`, `email`, `profession`, `ip_address`, `status`, `is_wa_verified`, `wa_provider`, `verified_at`) 
        VALUES (?, ?, ?, ?, ?, ?, ?, 'active', 1, ?, ?)");
    if ($insStmt) {
        $insStmt->bind_param('sssssssss', 
            $productId,
            $productTitle,
            $fullName,
            $cleanPhone,
            $email,
            $profession,
            $ipAddress,
            $operator,
            $now
        );
        $insStmt->execute();
        $leadId = $insStmt->insert_id;
        $insStmt->close();
    }
}

// Send WhatsApp confirmation / thank you with access link if gateway active
$welcomeMsg = "Halo Kak {$fullName}! 🎉\n\nNomor WhatsApp Anda berhasil terverifikasi di *Skillance Academy*.\n\nBerikut tautan langsung untuk membaca Bab 1 dan mengunduh paket proyek *{$productTitle}*:\n🔗 https://skillance.cloud/academy/sample_preview.php?pid={$productId}&lead={$leadId}\n\nSelamat belajar & semoga sukses skripsinya!";
sendWhatsAppMessage($cleanPhone, $welcomeMsg);

$previewUrl = 'sample_preview.php?pid=' . urlencode($productId) . '&lead=' . $leadId . '&verified=1';
$downloadBundleUrl = 'downloads/sidesa-bundle-master.zip';

echo json_encode([
    'success' => true,
    'lead_id' => $leadId,
    'preview_url' => $previewUrl,
    'download_bundle_url' => $downloadBundleUrl,
    'operator' => $operator,
    'message' => "Verifikasi Berhasil! Selamat datang Kak {$fullName}. Dokumen dan sampel proyek telah dibuka."
]);
