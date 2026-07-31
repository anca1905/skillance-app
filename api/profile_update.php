<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");

require_once '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Akses ditolak. Sesi tidak sah."]);
    exit();
}

$user_id = $_SESSION['user_id'];
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (empty($name) || empty($email)) {
    echo json_encode(["status" => "error", "message" => "Nama dan Email wajib diisi."]);
    exit();
}

// 1. Cek duplikasi email
$stmtCheck = $conn->prepare("SELECT id FROM users WHERE email = ? AND id != ?");
$stmtCheck->bind_param("si", $email, $user_id);
$stmtCheck->execute();
if ($stmtCheck->get_result()->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "Email sudah terdaftar untuk pengguna lain."]);
    $stmtCheck->close();
    exit();
}
$stmtCheck->close();

// 2. Handle Foto Profil
$photoPath = null;
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['photo']['tmp_name'];
    $fileName = $_FILES['photo']['name'];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    
    $allowedfileExtensions = array('jpg', 'jpeg', 'png');
    if (in_array($fileExtension, $allowedfileExtensions)) {
        $uploadFileDir = '../assets/img/profile/';
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0755, true);
        }
        $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
        $dest_path = $uploadFileDir . $newFileName;
        
        if(move_uploaded_file($fileTmpPath, $dest_path)) {
            $photoPath = $newFileName;
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal memindahkan file draf unggahan."]);
            exit();
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Format foto tidak didukung. Harap unggah JPG atau PNG."]);
        exit();
    }
}

// 3. Update Query berdasarkan input yang diisi
if (!empty($password)) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    if ($photoPath) {
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ?, photo = ? WHERE id = ?");
        $stmt->bind_param("ssssi", $name, $email, $hashedPassword, $photoPath, $user_id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $email, $hashedPassword, $user_id);
    }
} else {
    if ($photoPath) {
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ?, photo = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $email, $photoPath, $user_id);
    } else {
        $stmt = $conn->prepare("UPDATE users SET name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $email, $user_id);
    }
}

if ($stmt->execute()) {
    // Update info di sesi PHP
    $_SESSION['user_name'] = $name;
    
    // Ambil fresh data
    $stmtUser = $conn->prepare("SELECT id, name, email, role, photo FROM users WHERE id = ?");
    $stmtUser->bind_param("i", $user_id);
    $stmtUser->execute();
    $userData = $stmtUser->get_result()->fetch_assoc();
    $stmtUser->close();

    echo json_encode([
        "status" => "success", 
        "message" => "Profil berhasil diperbarui",
        "user" => $userData
    ]);
} else {
    echo json_encode(["status" => "error", "message" => "Gagal menyimpan perubahan: " . $stmt->error]);
}
$stmt->close();
?>
