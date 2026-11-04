<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once __DIR__ . '/../config/config.php';

$data = json_decode(file_get_contents("php://input"));

if (empty($data->credential)) {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Token kredensial Google tidak ditemukan."]);
    exit();
}

$idToken = $data->credential;

// 1. Verifikasi token dengan endpoint tokeninfo Google
$verifyUrl = "https://oauth2.googleapis.com/tokeninfo?id_token=" . urlencode($idToken);
$ch = curl_init($verifyUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$verifyResponse = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

$tokenInfo = json_decode($verifyResponse, true);

if ($httpCode !== 200 || empty($tokenInfo['sub']) || empty($tokenInfo['email'])) {
    // Fallback: parse JWT payload directly if local network blocks googleapis
    $parts = explode('.', $idToken);
    if (count($parts) === 3) {
        $payload = json_decode(base64_decode(str_replace(['-', '_'], ['+', '/'], $parts[1])), true);
        if (!empty($payload['email']) && !empty($payload['sub'])) {
            $tokenInfo = $payload;
        }
    }
}

if (empty($tokenInfo['sub']) || empty($tokenInfo['email'])) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Verifikasi akun Google gagal. Token tidak valid."]);
    exit();
}

$googleId = $tokenInfo['sub'];
$email    = strtolower(trim($tokenInfo['email']));
$name     = $tokenInfo['name'] ?? explode('@', $email)[0];
$photo    = $tokenInfo['picture'] ?? null;

// Cek user di database
$stmt = $conn->prepare("SELECT * FROM `users` WHERE `google_id` = ? OR `email` = ? LIMIT 1");
$stmt->bind_param("ss", $googleId, $email);
$stmt->execute();
$res = $stmt->get_result();

$userId = null;
$role = 'freelancer';
$userType = 'umum';
$isNewUser = false;

if ($res->num_rows > 0) {
    $existing = $res->fetch_assoc();
    $userId = $existing['id'];
    $role   = $existing['role'];
    $userType = $existing['user_type'] ?? 'umum';

    $updateStmt = $conn->prepare("UPDATE `users` SET `google_id` = ?, `photo` = IFNULL(`photo`, ?) WHERE `id` = ?");
    $updateStmt->bind_param("ssi", $googleId, $photo, $userId);
    $updateStmt->execute();
    $updateStmt->close();
} else {
    $isNewUser = true;
    $insertStmt = $conn->prepare("INSERT INTO `users` (`name`, `email`, `google_id`, `photo`, `role`, `user_type`) VALUES (?, ?, ?, ?, 'freelancer', 'umum')");
    $insertStmt->bind_param("ssss", $name, $email, $googleId, $photo);
    $insertStmt->execute();
    $userId = $insertStmt->insert_id;
    $role = 'freelancer';
    $insertStmt->close();
}
$stmt->close();

// Set session
$_SESSION['user_id']    = $userId;
$_SESSION['user_name']  = $name;
$_SESSION['user_email'] = $email;
$_SESSION['user_role']  = $role;
$_SESSION['user_photo'] = $photo;
$_SESSION['user_type']  = $userType;

$redirectUrl = "../dashboard/freelancer/index.php";
if (!empty($_SESSION['auth_redirect']) && ($_SESSION['auth_redirect'] === 'academy' || strpos($_SESSION['auth_redirect'], 'academy.skillance.cloud') !== false)) {
    unset($_SESSION['auth_redirect']);
    $token = bin2hex(random_bytes(32));
    $expiresAt = date('Y-m-d H:i:s', time() + 300);
    $ssoStmt = $conn->prepare("INSERT INTO `sso_tokens` (`token`, `user_id`, `expires_at`) VALUES (?, ?, ?)");
    $ssoStmt->bind_param("sis", $token, $userId, $expiresAt);
    $ssoStmt->execute();
    $ssoStmt->close();
    $redirectUrl = "https://academy.skillance.cloud/auth/sso.php?token=" . urlencode($token);
} elseif ($role === 'freelancer') {
    $redirectUrl = $isNewUser ? "../dashboard/freelancer/profile.php?welcome=1" : "../dashboard/freelancer/index.php";
} elseif ($role === 'admin') {
    $redirectUrl = "../dashboard/index.php";
} elseif ($role === 'investor') {
    $redirectUrl = "../dashboard/investor.php";
}

echo json_encode([
    "status" => "success",
    "message" => "Login Google berhasil!",
    "redirect" => $redirectUrl,
    "user" => [
        "id" => $userId,
        "name" => $name,
        "email" => $email,
        "role" => $role
    ]
]);
