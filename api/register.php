<?php
session_start();

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once '../config/config.php';

$raw = file_get_contents("php://input");
$data = json_decode($raw);
if (!$data && !empty($_POST)) {
    $data = (object)$_POST;
}

if (!empty($data->name) && !empty($data->email) && !empty($data->password)) {
    $name = trim($data->name);
    $email = strtolower(trim($data->email));
    $password = $data->password;
    $confirmPassword = $data->confirm_password ?? $password;
    $userType = in_array(strtolower($data->user_type ?? ''), ['mahasiswa', 'umum']) ? strtolower($data->user_type) : 'mahasiswa';

    // 1. Validasi Nama
    if (strlen($name) < 2) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Nama lengkap minimal 2 karakter."]);
        exit();
    }

    // 2. Validasi Format Email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Format alamat email tidak valid."]);
        exit();
    }

    // 3. Validasi Password
    if (strlen($password) < 6) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Password minimal terdiri dari 6 karakter."]);
        exit();
    }

    if ($password !== $confirmPassword) {
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Konfirmasi password tidak cocok."]);
        exit();
    }

    // 4. Cek apakah Email sudah terdaftar
    $checkStmt = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
    $checkStmt->bind_param("s", $email);
    $checkStmt->execute();
    $checkRes = $checkStmt->get_result();
    if ($checkRes && $checkRes->num_rows > 0) {
        http_response_code(409);
        echo json_encode([
            "status" => "error",
            "message" => "Email ini sudah terdaftar. Silakan langsung masuk menggunakan password Anda."
        ]);
        $checkStmt->close();
        exit();
    }
    $checkStmt->close();

    // 5. Hash Password & Siapkan Atribut Pengguna
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $role = 'pengguna'; // Role disederhanakan: admin, keuangan, pengguna
    $photo = 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=0d2e5c&color=fca311&bold=true';
    $assignedRoles = 'pengguna,mahasiswa,freelancer';
    $partnerSlug = 'msc-usn';

    // 6. Insert ke Tabel Users
    $insStmt = $conn->prepare("INSERT INTO users (name, email, password, role, photo, user_type, assigned_roles, partner_slug) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($insStmt) {
        $insStmt->bind_param("ssssssss", $name, $email, $hashedPassword, $role, $photo, $userType, $assignedRoles, $partnerSlug);
        if ($insStmt->execute()) {
            $newUserId = $insStmt->insert_id;
            $insStmt->close();

            // 7. Otomatis Login & Set Session
            $_SESSION['user_id'] = $newUserId;
            $_SESSION['user_name'] = $name;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_role'] = $role;
            $_SESSION['user_photo'] = $photo;
            $_SESSION['user_type'] = $userType;
            $_SESSION['assigned_roles'] = $assignedRoles;
            $_SESSION['partner_slug'] = $partnerSlug;

            $redirectTarget = "../dashboard/freelancer/index.php";

            // Jika user datang dari referensi Academy, arahkan dengan SSO
            if (!empty($_SESSION['auth_redirect']) && ($_SESSION['auth_redirect'] === 'academy' || strpos($_SESSION['auth_redirect'], 'academy') !== false)) {
                unset($_SESSION['auth_redirect']);
                $token = bin2hex(random_bytes(32));
                $expiresAt = date('Y-m-d H:i:s', time() + 300);
                $ssoStmt = $conn->prepare("INSERT INTO `sso_tokens` (`token`, `user_id`, `expires_at`) VALUES (?, ?, ?)");
                if ($ssoStmt) {
                    $ssoStmt->bind_param("sis", $token, $newUserId, $expiresAt);
                    $ssoStmt->execute();
                    $ssoStmt->close();
                    $redirectTarget = "https://academy.skillance.cloud/auth/sso.php?token=" . urlencode($token) . "&target=my-learning.php";
                } else {
                    $redirectTarget = "https://academy.skillance.cloud/my-learning.php";
                }
            }

            http_response_code(201);
            echo json_encode([
                "status" => "success",
                "message" => "Pendaftaran akun berhasil! Mengalihkan ke dashboard...",
                "redirect" => $redirectTarget,
                "user" => [
                    "id" => $newUserId,
                    "name" => $name,
                    "email" => $email,
                    "role" => $role,
                    "user_type" => $userType,
                    "photo" => $photo
                ]
            ]);
            exit();
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Gagal menyimpan akun: " . $conn->error]);
            $insStmt->close();
            exit();
        }
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "Terjadi kesalahan internal server database."]);
        exit();
    }
} else {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Mohon lengkapi seluruh formulir pendaftaran."]);
    exit();
}
