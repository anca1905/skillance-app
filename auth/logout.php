<?php
session_start();

$ref = $_GET['ref'] ?? '';

// Hapus semua variabel sesi
$_SESSION = [];

// Hapus cookie sesi jika ada
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hancurkan sesi
session_destroy();

if ($ref === 'academy') {
    header("Location: https://academy.skillance.cloud/auth/logout.php");
    exit();
}

// Redirect ke halaman login auth
header("Location: index.php?logged_out=1");
exit();
