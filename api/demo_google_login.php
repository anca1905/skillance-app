<?php
session_start();
require_once __DIR__ . '/../config/config.php';

$type = $_GET['type'] ?? 'mahasiswa';

if ($type === 'mahasiswa') {
    $email = 'budi.santoso@mhs.unhalu.ac.id';
    $name = 'Budi Santoso';
    $googleId = 'google_demo_mhs_12345';
    $userType = 'mahasiswa';
    $institution = 'Universitas Halu Oleo (UHO)';
    $major = 'Teknik Informatika';
    $nim = 'F1G122045';
    $skills = 'HTML/CSS, Bootstrap, Web Design, Copywriting, Python';
    $bankName = 'Dana';
    $bankNumber = '082291700778';
    $bankHolder = 'Budi Santoso';
} else {
    $email = 'siti.nurhaliza@gmail.com';
    $name = 'Siti Nurhaliza';
    $googleId = 'google_demo_umum_67890';
    $userType = 'umum';
    $institution = 'Umum / Fresh Graduate';
    $major = 'Desain Komunikasi Visual';
    $nim = '-';
    $skills = 'Figma, Canva, Video Editing, Social Media';
    $bankName = 'BCA';
    $bankNumber = '8220192837';
    $bankHolder = 'Siti Nurhaliza';
}

// Cek apakah user demo sudah ada
$stmt = $conn->prepare("SELECT * FROM `users` WHERE `email` = ? LIMIT 1");
$stmt->bind_param("s", $email);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows > 0) {
    $user = $res->fetch_assoc();
    $userId = $user['id'];
} else {
    $insert = $conn->prepare("INSERT INTO `users` (`name`, `email`, `google_id`, `role`, `user_type`, `institution`, `major`, `nim`, `skills`, `bank_name`, `bank_account_number`, `bank_account_name`) VALUES (?, ?, ?, 'freelancer', ?, ?, ?, ?, ?, ?, ?, ?)");
    $insert->bind_param("sssssssssss", $name, $email, $googleId, $userType, $institution, $major, $nim, $skills, $bankName, $bankNumber, $bankHolder);
    $insert->execute();
    $userId = $insert->insert_id;
    $insert->close();
}
$stmt->close();

$_SESSION['user_id']    = $userId;
$_SESSION['user_name']  = $name;
$_SESSION['user_email'] = $email;
$_SESSION['user_role']  = 'freelancer';
$_SESSION['user_photo'] = 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=0d2e5c&color=fca311';
$_SESSION['user_type']  = $userType;

header("Location: ../dashboard/freelancer/index.php");
exit();
