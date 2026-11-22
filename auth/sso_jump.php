<?php
session_start();
require_once __DIR__ . '/../config/config.php';

// Jika belum login di freelance/utama, arahkan login dulu dengan referer academy
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php?ref=academy");
    exit();
}

$userId = $_SESSION['user_id'];
$token = bin2hex(random_bytes(32));
$expiresAt = date('Y-m-d H:i:s', time() + 300); // Token berlaku 5 menit

// Simpan token SSO jika database aktif
if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
    $stmt = $conn->prepare("INSERT INTO `sso_tokens` (`token`, `user_id`, `expires_at`) VALUES (?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sis", $token, $userId, $expiresAt);
        $stmt->execute();
        $stmt->close();
    }
}

$target = trim($_GET['target'] ?? '');

// Arahkan ke Academy dengan token SSO
$targetUrl = "https://academy.skillance.cloud/auth/sso.php?token=" . urlencode($token);
if (!empty($target)) {
    $targetUrl .= "&target=" . urlencode($target);
}

header("Location: " . $targetUrl);
exit();
