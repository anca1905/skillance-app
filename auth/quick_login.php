<?php
session_start();
require_once __DIR__ . '/../config/config.php';

$userType = $_GET['user'] ?? 'mahasiswa';
$redirectParam = $_GET['redirect'] ?? ($_SESSION['auth_redirect'] ?? '');

if ($userType === 'google' || $userType === 'skillance' || $userType === 'skillance_official') {
    $email = 'skillance.id@gmail.com';
    $name = 'Skillance Official';
    $role = 'freelancer';
    $uType = 'mahasiswa';
    $assignedRoles = 'mahasiswa,freelancer';
    $partnerSlug = 'msc-usn';
    $photo = 'https://ui-avatars.com/api/?name=Skillance+Official&background=0d2e5c&color=fca311';
    $userId = 100;

    if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
        $stmt = $conn->prepare("SELECT id, name, email, photo, role, user_type FROM `users` WHERE `email` = ? LIMIT 1");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res && $res->num_rows > 0) {
                $row = $res->fetch_assoc();
                $userId = (int)$row['id'];
                $name = $row['name'] ?: $name;
                $photo = $row['photo'] ?: $photo;
            } else {
                $ins = $conn->prepare("INSERT INTO `users` (`name`, `email`, `role`, `user_type`, `assigned_roles`, `partner_slug`, `photo`) VALUES (?, ?, ?, ?, ?, ?, ?)");
                if ($ins) {
                    $ins->bind_param("sssssss", $name, $email, $role, $uType, $assignedRoles, $partnerSlug, $photo);
                    if ($ins->execute()) {
                        $userId = $ins->insert_id;
                    }
                    $ins->close();
                }
            }
            $stmt->close();
        }
    }

    $_SESSION['user_id']        = $userId;
    $_SESSION['user_name']      = $name;
    $_SESSION['user_email']     = $email;
    $_SESSION['user_role']      = $role;
    $_SESSION['user_photo']     = $photo;
    $_SESSION['user_type']      = $uType;
    $_SESSION['assigned_roles'] = $assignedRoles;
    $_SESSION['partner_slug']   = $partnerSlug;
    $_SESSION['active_portal']  = 'mahasiswa';

    $target = ($redirectParam === 'partner-portal') ? ('partner-portal.php?partner=' . urlencode($partnerSlug)) : 'my-learning.php';

    if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', time() + 300);
        $ssoStmt = $conn->prepare("INSERT INTO `sso_tokens` (`token`, `user_id`, `expires_at`) VALUES (?, ?, ?)");
        if ($ssoStmt) {
            $ssoStmt->bind_param("sis", $token, $userId, $expiresAt);
            $ssoStmt->execute();
            $ssoStmt->close();
            header("Location: https://academy.skillance.cloud/auth/sso.php?token=" . urlencode($token) . "&target=" . urlencode($target));
            exit();
        }
    }

    header("Location: https://academy.skillance.cloud/" . $target . "?logged_in=1");
    exit();
}

if ($userType === 'mahasiswa' || $userType === 'student' || $userType === 'siswa') {
    // Kredensial Siswa/Mahasiswa Skillance Academy
    $email = 'rian@usn.ac.id';
    $name = 'Muhammad Rian Pratama';
    $role = 'freelancer';
    $uType = 'mahasiswa';
    $assignedRoles = 'mahasiswa,freelancer';
    $partnerSlug = 'msc-usn';
    $photo = 'https://ui-avatars.com/api/?name=Muhammad+Rian+Pratama&background=0d2e5c&color=fca311';
    $userId = 101;

    // Pastikan user tercatat di database jika DB aktif agar relasi JOIN sso_tokens sukses
    if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
        $stmt = $conn->prepare("SELECT id, name, email, photo, role, user_type FROM `users` WHERE `email` = ? LIMIT 1");
        if ($stmt) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res && $res->num_rows > 0) {
                $row = $res->fetch_assoc();
                $userId = (int)$row['id'];
                $name = $row['name'] ?: $name;
                $photo = $row['photo'] ?: $photo;
            } else {
                $ins = $conn->prepare("INSERT INTO `users` (`name`, `email`, `role`, `user_type`, `assigned_roles`, `partner_slug`, `photo`) VALUES (?, ?, ?, ?, ?, ?, ?)");
                if ($ins) {
                    $ins->bind_param("sssssss", $name, $email, $role, $uType, $assignedRoles, $partnerSlug, $photo);
                    if ($ins->execute()) {
                        $userId = $ins->insert_id;
                    }
                    $ins->close();
                }
            }
            $stmt->close();
        }
    }

    // Set session di domain skillance.cloud
    $_SESSION['user_id']        = $userId;
    $_SESSION['user_name']      = $name;
    $_SESSION['user_email']     = $email;
    $_SESSION['user_role']      = $role;
    $_SESSION['user_photo']     = $photo;
    $_SESSION['user_type']      = $uType;
    $_SESSION['assigned_roles'] = $assignedRoles;
    $_SESSION['partner_slug']   = $partnerSlug;
    $_SESSION['active_portal']  = 'mahasiswa';

    // Target tujuan di Academy (My Learning atau Partner Portal)
    $target = ($redirectParam === 'partner-portal') ? ('partner-portal.php?partner=' . urlencode($partnerSlug)) : 'my-learning.php';

    // Buat token SSO jika koneksi database aktif
    if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', time() + 300);
        $ssoStmt = $conn->prepare("INSERT INTO `sso_tokens` (`token`, `user_id`, `expires_at`) VALUES (?, ?, ?)");
        if ($ssoStmt) {
            $ssoStmt->bind_param("sis", $token, $userId, $expiresAt);
            $ssoStmt->execute();
            $ssoStmt->close();
            header("Location: https://academy.skillance.cloud/auth/sso.php?token=" . urlencode($token) . "&target=" . urlencode($target));
            exit();
        }
    }

    // Fallback jika database belum terhubung
    header("Location: https://academy.skillance.cloud/" . $target . "?logged_in=1");
    exit();
}

// Default login sebagai Direktur Utama / Admin (MUH. ARSYAD RAMSI)
$userId = 4;
$name = 'MUH. ARSYAD RAMSI';
$email = 'arsyadhijrah49720@gmail.com';
$role = 'admin';
$photo = 'https://ui-avatars.com/api/?name=Muh+Arsyad+Ramsi&background=0d2e5c&color=fff';
$assignedRoles = 'admin,dekanat,ormawa,mahasiswa,freelancer';
$partnerSlug = 'msc-usn';

if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
    $stmt = $conn->prepare("SELECT id, name, email, photo, role FROM `users` WHERE `email` = ? OR `id` = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("si", $email, $userId);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res && $res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $userId = (int)$row['id'];
            $name = $row['name'] ?: $name;
            $photo = $row['photo'] ?: $photo;
        }
        $stmt->close();
    }
}

$_SESSION['user_id']        = $userId;
$_SESSION['user_name']      = $name;
$_SESSION['user_email']     = $email;
$_SESSION['user_role']      = $role;
$_SESSION['user_photo']     = $photo;
$_SESSION['user_type']      = 'admin';
$_SESSION['assigned_roles'] = $assignedRoles;
$_SESSION['partner_slug']   = $partnerSlug;

if ($redirectParam === 'academy' || strpos($redirectParam, 'academy') !== false) {
    unset($_SESSION['auth_redirect']);
    if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
        $token = bin2hex(random_bytes(32));
        $expiresAt = date('Y-m-d H:i:s', time() + 300);
        $ssoStmt = $conn->prepare("INSERT INTO `sso_tokens` (`token`, `user_id`, `expires_at`) VALUES (?, ?, ?)");
        if ($ssoStmt) {
            $ssoStmt->bind_param("sis", $token, $userId, $expiresAt);
            $ssoStmt->execute();
            $ssoStmt->close();
            header("Location: https://academy.skillance.cloud/auth/sso.php?token=" . urlencode($token) . "&target=my-learning.php");
            exit();
        }
    }
    header("Location: https://academy.skillance.cloud/my-learning.php?logged_in=1");
    exit();
}

header("Location: select_role.php");
exit();
