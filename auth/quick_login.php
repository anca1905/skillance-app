<?php
session_start();
require_once __DIR__ . '/../config/config.php';

$userType = $_GET['user'] ?? 'arsyad';

if ($userType === 'mahasiswa') {
    $_SESSION['user_id'] = 101;
    $_SESSION['user_name'] = 'Muhammad Rian Pratama';
    $_SESSION['user_email'] = 'rian@usn.ac.id';
    $_SESSION['user_role'] = 'student';
    $_SESSION['user_photo'] = 'https://ui-avatars.com/api/?name=Muhammad+Rian+Pratama&background=0d2e5c&color=fff';
    $_SESSION['user_type'] = 'mahasiswa';
    $_SESSION['active_portal'] = 'mahasiswa';
    header("Location: https://academy.skillance.cloud/partner-portal.php?partner=msc-usn");
    exit();
}

// Default login sebagai Direktur Utama / Admin (MUH. ARSYAD RAMSI)
$_SESSION['user_id'] = 4;
$_SESSION['user_name'] = 'MUH. ARSYAD RAMSI';
$_SESSION['user_email'] = 'arsyadhijrah49720@gmail.com';
$_SESSION['user_role'] = 'admin';
$_SESSION['user_photo'] = 'https://ui-avatars.com/api/?name=Muh+Arsyad+Ramsi&background=0d2e5c&color=fff';
$_SESSION['user_type'] = 'admin';

header("Location: select_role.php");
exit();
