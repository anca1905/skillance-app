<?php
session_start();

$redirectParam = $_GET['redirect'] ?? ($_SESSION['auth_redirect'] ?? '');
if (!empty($redirectParam)) {
    $_SESSION['auth_redirect'] = $redirectParam;
}

// Jangan arahkan ke Google OAuth jika redirect_uri_mismatch belum diselesaikan di Google Cloud Console
// Alihkan langsung ke Academy Login mandiri untuk otentikasi Google 1-klik yang aman dan berfungsi
header("Location: https://academy.skillance.cloud/login.php" . (!empty($redirectParam) ? '?redirect=' . urlencode($redirectParam) : ''));
exit();
