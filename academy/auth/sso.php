<?php
session_start();
require_once __DIR__ . '/../config/config.php';

$token = trim($_GET['token'] ?? '');

if (empty($token)) {
    header("Location: ../index.php?error=token_missing");
    exit();
}

// 1. Validasi token SSO dari database bersama
$stmt = $conn->prepare("SELECT s.id as token_id, s.user_id, u.name, u.email, u.role, u.photo, u.user_type FROM `sso_tokens` s JOIN `users` u ON s.user_id = u.id WHERE s.token = ? AND s.expires_at > NOW() LIMIT 1");
$stmt->bind_param("s", $token);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows === 0) {
    $stmt->close();
    header("Location: ../index.php?error=token_invalid_or_expired");
    exit();
}

$userData = $res->fetch_assoc();
$tokenId  = $userData['token_id'];
$userId   = $userData['user_id'];
$stmt->close();

// 2. Hapus token agar hanya bisa digunakan 1 kali (secure one-time token)
$delStmt = $conn->prepare("DELETE FROM `sso_tokens` WHERE `id` = ?");
$delStmt->bind_param("i", $tokenId);
$delStmt->execute();
$delStmt->close();

// 3. Set Session di Academy
$_SESSION['academy_user_id']    = $userId;
$_SESSION['academy_user_name']  = $userData['name'];
$_SESSION['academy_user_email'] = $userData['email'];
$_SESSION['academy_user_role']  = $userData['role'];
$_SESSION['academy_user_photo'] = $userData['photo'];
$_SESSION['academy_user_type']  = $userData['user_type'] ?? 'umum';

// Set session standar
$_SESSION['user_id']    = $userId;
$_SESSION['user_name']  = $userData['name'];
$_SESSION['user_email'] = $userData['email'];
$_SESSION['user_role']  = $userData['role'];
$_SESSION['user_photo'] = $userData['photo'];
$_SESSION['user_type']  = $userData['user_type'] ?? 'umum';

// 4. Pastikan ada pendaftaran track awal jika baru pertama kali login
$trackCheck = $conn->prepare("SELECT id FROM `academy_enrollments` WHERE `user_id` = ? LIMIT 1");
$trackCheck->bind_param("i", $userId);
$trackCheck->execute();
if ($trackCheck->get_result()->num_rows === 0) {
    $insTrack = $conn->prepare("INSERT INTO `academy_enrollments` (`user_id`, `track_id`, `progress_percent`, `status`) VALUES (?, 'web_frontend', 10, 'learning')");
    $insTrack->bind_param("i", $userId);
    $insTrack->execute();
    $insTrack->close();
}
$trackCheck->close();

header("Location: ../index.php?logged_in=1");
exit();
