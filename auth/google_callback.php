<?php
session_start();
require_once __DIR__ . '/../config/config.php';

$clientId     = $_ENV['GOOGLE_CLIENT_ID'] ?? (function_exists('getenv') ? getenv('GOOGLE_CLIENT_ID') : '');
$clientSecret = $_ENV['GOOGLE_CLIENT_SECRET'] ?? (function_exists('getenv') ? getenv('GOOGLE_CLIENT_SECRET') : '');
$redirectUri  = 'https://skillance.cloud/auth/google_callback.php';
$defaultCallback = 'https://skillance.cloud/auth/google_callback.php';

if (isset($_GET['error'])) {
    $_SESSION['login_error'] = "Login Google Dibatalkan atau Error: " . htmlspecialchars($_GET['error']);
    header("Location: index.php");
    exit();
}

if (!isset($_GET['code'])) {
    header("Location: index.php");
    exit();
}

$code = $_GET['code'];

// Tukar authorization code dengan access token
$ch = curl_init('https://oauth2.googleapis.com/token');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
    'code'          => $code,
    'client_id'     => $clientId,
    'client_secret' => $clientSecret,
    'redirect_uri'  => $redirectUri,
    'grant_type'    => 'authorization_code'
]));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$tokenData = json_decode($response, true);

if (!isset($tokenData['access_token'])) {
    // Coba fallback dengan default callback jika redirect uri sebelumnya berbeda
    if ($redirectUri !== $defaultCallback) {
        $ch = curl_init('https://oauth2.googleapis.com/token');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query([
            'code'          => $code,
            'client_id'     => $clientId,
            'client_secret' => $clientSecret,
            'redirect_uri'  => $defaultCallback,
            'grant_type'    => 'authorization_code'
        ]));
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        $tokenData = json_decode($response, true);
        curl_close($ch);
    }
}

if (!isset($tokenData['access_token'])) {
    $_SESSION['login_error'] = "Gagal menukar token dengan Google: " . ($tokenData['error_description'] ?? 'Silakan coba lagi.');
    header("Location: index.php");
    exit();
}

// Ambil info profil user dari Google
$ch = curl_init('https://www.googleapis.com/oauth2/v3/userinfo');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $tokenData['access_token']
]);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$userInfoResponse = curl_exec($ch);
curl_close($ch);

$googleUser = json_decode($userInfoResponse, true);

if (!isset($googleUser['sub']) || !isset($googleUser['email'])) {
    $_SESSION['login_error'] = "Gagal mengambil data profil Google.";
    header("Location: index.php");
    exit();
}

$googleId = $googleUser['sub'];
$email    = strtolower(trim($googleUser['email']));
$name     = $googleUser['name'] ?? explode('@', $email)[0];
$photo    = $googleUser['picture'] ?? null;

// Cek apakah user sudah terdaftar di database
$stmt = $conn->prepare("SELECT * FROM `users` WHERE `google_id` = ? OR `email` = ? LIMIT 1");
$stmt->bind_param("ss", $googleId, $email);
$stmt->execute();
$res = $stmt->get_result();

$userId = null;
$role   = 'freelancer';
$userType = 'umum';
$assignedRoles = 'freelancer,mahasiswa';
$partnerSlug = 'msc-usn';
$positionTitle = '';
$isNewUser = false;

if ($res->num_rows > 0) {
    $existing = $res->fetch_assoc();
    $userId = $existing['id'];
    $role   = $existing['role'];
    $userType = $existing['user_type'] ?? 'umum';
    $assignedRoles = $existing['assigned_roles'] ?? ($role === 'admin' ? 'admin,dekanat,ormawa,mahasiswa,freelancer' : 'freelancer,mahasiswa');
    $partnerSlug = $existing['partner_slug'] ?? 'msc-usn';
    $positionTitle = $existing['position_title'] ?? '';

    // Update google_id dan photo jika belum ada
    $updateStmt = $conn->prepare("UPDATE `users` SET `google_id` = ?, `photo` = IFNULL(`photo`, ?) WHERE `id` = ?");
    $updateStmt->bind_param("ssi", $googleId, $photo, $userId);
    $updateStmt->execute();
    $updateStmt->close();
} else {
    // User baru -> Otomatis daftar dengan akses default
    $isNewUser = true;
    $assignedRoles = 'freelancer,mahasiswa';
    $partnerSlug = 'msc-usn';
    $insertStmt = $conn->prepare("INSERT INTO `users` (`name`, `email`, `google_id`, `photo`, `role`, `user_type`, `assigned_roles`, `partner_slug`) VALUES (?, ?, ?, ?, 'freelancer', 'umum', ?, ?)");
    $insertStmt->bind_param("ssssss", $name, $email, $googleId, $photo, $assignedRoles, $partnerSlug);
    $insertStmt->execute();
    $userId = $insertStmt->insert_id;
    $role = 'freelancer';
    $insertStmt->close();
}
$stmt->close();

// Set session lengkap
$_SESSION['user_id']        = $userId;
$_SESSION['user_name']      = $name;
$_SESSION['user_email']     = $email;
$_SESSION['user_role']      = $role;
$_SESSION['user_photo']     = $photo;
$_SESSION['user_type']      = $userType;
$_SESSION['assigned_roles'] = $assignedRoles;
$_SESSION['partner_slug']   = $partnerSlug;
$_SESSION['position_title'] = $positionTitle;

// Redirect khusus jika sebelumnya diarahkan dari link tugas/job tertentu atau dari Academy
if (!empty($_SESSION['auth_redirect'])) {
    $redirectUrl = $_SESSION['auth_redirect'];
    unset($_SESSION['auth_redirect']);

    // SSO ke Skillance Academy
    if ($redirectUrl === 'academy' || strpos($redirectUrl, 'academy.skillance.cloud') !== false) {
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', time() + 300);
        $ssoStmt = $conn->prepare("INSERT INTO `sso_tokens` (`token`, `user_id`, `expires_at`) VALUES (?, ?, ?)");
        $ssoStmt->bind_param("sis", $token, $userId, $expiresAt);
        $ssoStmt->execute();
        $ssoStmt->close();
        header("Location: https://academy.skillance.cloud/auth/sso.php?token=" . urlencode($token));
        exit();
    }

    if (strpos($redirectUrl, '://') === false || strpos($redirectUrl, 'skillance.cloud') !== false) {
        header("Location: ../" . ltrim($redirectUrl, '/'));
        exit();
    }
}

// Redirect ke Layar Pemilihan Peran (SIAKAD Multi-Role Gateway)
header("Location: select_role.php");
exit();
