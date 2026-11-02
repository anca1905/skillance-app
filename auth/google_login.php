<?php
session_start();
require_once __DIR__ . '/../config/config.php';

$clientId = $_ENV['GOOGLE_CLIENT_ID'] ?? (function_exists('getenv') ? getenv('GOOGLE_CLIENT_ID') : '');
$redirectUri = $_ENV['GOOGLE_REDIRECT_URI'] ?? (function_exists('getenv') ? getenv('GOOGLE_REDIRECT_URI') : '');

// Jika redirect URI tidak diset atau mengarah ke localhost/laskar_wonua, kita gunakan callback auth default
if (empty($redirectUri) || strpos($redirectUri, 'localhost') !== false || strpos($redirectUri, 'laskar_wonua') !== false) {
    // Deteksi host otomatis
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    $basePath = (strpos($host, 'localhost') !== false || strpos($_SERVER['REQUEST_URI'] ?? '', '/skillance/') !== false) ? '/skillance' : '';
    $redirectUri = "$protocol://$host$basePath/auth/google_callback.php";
}

if (empty($clientId)) {
    die("Kredensial GOOGLE_CLIENT_ID belum diatur pada file .env!");
}

if (!empty($_GET['redirect'])) {
    $_SESSION['auth_redirect'] = $_GET['redirect'];
}

$state = bin2hex(random_bytes(16));
$_SESSION['oauth_state'] = $state;

$params = [
    'client_id' => $clientId,
    'redirect_uri' => $redirectUri,
    'response_type' => 'code',
    'scope' => 'email profile openid',
    'state' => $state,
    'access_type' => 'online',
    'prompt' => 'select_account'
];

$authUrl = "https://accounts.google.com/o/oauth2/v2/auth?" . http_build_query($params);
header("Location: " . $authUrl);
exit();
