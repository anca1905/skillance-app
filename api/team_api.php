<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../config/config.php';

$method = $_SERVER['REQUEST_METHOD'];

// Helper function untuk upload foto profil tim
function uploadPhoto($file) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png'])) {
            $uploadDir = '../assets/img/team/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            $fileName = md5(time() . '_' . $file['name']) . '.' . $ext;
            if (move_uploaded_file($file['tmp_name'], $uploadDir . $fileName)) {
                return $fileName;
            }
        }
    }
    return null;
}

// 1. GET Request: Mengambil seluruh data tim (Public Access untuk Landing Page)
if ($method === 'GET') {
    $stmt = $conn->prepare("SELECT * FROM team_members ORDER BY order_num ASC, id DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    $team = [];
    while ($row = $result->fetch_assoc()) {
        $team[] = $row;
    }
    echo json_encode(["status" => "success", "data" => $team]);
    exit();
}

// 2. Proteksi POST Request: Harus punya session aktif (Hanya bisa diakses dari panel admin)
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(["status" => "error", "message" => "Akses ditolak. Tidak ada otorisasi."]);
    exit();
}

if ($method === 'POST') {
    $action = $_POST['action'] ?? '';

    // Aksi Tambah Anggota Baru
    if ($action === 'add') {
        $name = $_POST['name'] ?? '';
        $position = $_POST['position'] ?? '';
        $instagram = $_POST['instagram'] ?? '';
        $linkedin = $_POST['linkedin'] ?? '';
        $github = $_POST['github'] ?? '';
        $order_num = (int)($_POST['order_num'] ?? 0);
        
        if (empty($name) || empty($position)) {
            echo json_encode(["status" => "error", "message" => "Nama dan Jabatan wajib diisi."]);
            exit();
        }

        $photo = isset($_FILES['photo']) ? uploadPhoto($_FILES['photo']) : null;

        $stmt = $conn->prepare("INSERT INTO team_members (name, position, photo, instagram, linkedin, github, order_num) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssi", $name, $position, $photo, $instagram, $linkedin, $github, $order_num);
        
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Anggota tim berhasil ditambahkan."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal menambahkan ke database: " . $conn->error]);
        }
    } 
    
    // Aksi Edit Data Anggota
    elseif ($action === 'edit') {
        $id = (int)($_POST['id'] ?? 0);
        $name = $_POST['name'] ?? '';
        $position = $_POST['position'] ?? '';
        $instagram = $_POST['instagram'] ?? '';
        $linkedin = $_POST['linkedin'] ?? '';
        $github = $_POST['github'] ?? '';
        $order_num = (int)($_POST['order_num'] ?? 0);

        if (empty($name) || empty($position) || $id === 0) {
            echo json_encode(["status" => "error", "message" => "Data tidak valid atau tidak lengkap."]);
            exit();
        }

        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            // Jika ada kiriman gambar baru
            $photo = uploadPhoto($_FILES['photo']);
            $stmt = $conn->prepare("UPDATE team_members SET name=?, position=?, photo=?, instagram=?, linkedin=?, github=?, order_num=? WHERE id=?");
            $stmt->bind_param("ssssssii", $name, $position, $photo, $instagram, $linkedin, $github, $order_num, $id);
        } else {
            // Jika foto lama dipertahankan
            $stmt = $conn->prepare("UPDATE team_members SET name=?, position=?, instagram=?, linkedin=?, github=?, order_num=? WHERE id=?");
            $stmt->bind_param("sssssii", $name, $position, $instagram, $linkedin, $github, $order_num, $id);
        }

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Data anggota tim berhasil diperbarui."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal memperbarui: " . $conn->error]);
        }
    }
    
    // Aksi Hapus Anggota
    elseif ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            // Bisa diperkaya: hapus file foto fisiknya dari server di sini
            $stmt = $conn->prepare("DELETE FROM team_members WHERE id=?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Anggota tim telah dihapus."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Gagal menghapus dari database."]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "ID tidak valid."]);
        }
    }
}
?>
