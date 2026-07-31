<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../config/config.php';

$method = $_SERVER['REQUEST_METHOD'];

// Proteksi akses hanya untuk admin/staff
if (!isset($_SESSION['user_id'])) {
    http_response_code(403);
    echo json_encode(["status" => "error", "message" => "Akses ditolak. Silahkan login."]);
    exit();
}

// Fitur upload cover blog
function uploadCover($file) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'webp'])) {
            $uploadDir = '../assets/img/blog/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            $fileName = 'blog_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
            if (move_uploaded_file($file['tmp_name'], $uploadDir . $fileName)) {
                return 'assets/img/blog/' . $fileName; // Path disimpan relatif terhadap ROOT
            }
        }
    }
    return null;
}

if ($method === 'GET') {
    $stmt = $conn->prepare("SELECT * FROM blogs ORDER BY id DESC");
    $stmt->execute();
    $result = $stmt->get_result();
    $blogs = [];
    while ($row = $result->fetch_assoc()) {
        $blogs[] = $row;
    }
    echo json_encode(["status" => "success", "data" => $blogs]);
    exit();
}

if ($method === 'POST') {
    $action = $_POST['action'] ?? '';

    // Aksi Tambah Artikel
    if ($action === 'add') {
        $title = $_POST['title'] ?? '';
        $category = $_POST['category'] ?? '';
        $author = $_POST['author'] ?? $_SESSION['name'] ?? 'Admin';
        $excerpt = $_POST['excerpt'] ?? '';
        $content = $_POST['content'] ?? '';
        $badge_class = $_POST['badge_class'] ?? 'bg-navy-subtle text-navy';
        $date = date('Y-m-d');
        
        if (empty($title) || empty($content)) {
            echo json_encode(["status" => "error", "message" => "Judul dan Konten wajib diisi."]);
            exit();
        }

        $image = isset($_FILES['image']) ? uploadCover($_FILES['image']) : '';

        $stmt = $conn->prepare("INSERT INTO blogs (title, category, author, date, excerpt, content, image, badge_class) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssss", $title, $category, $author, $date, $excerpt, $content, $image, $badge_class);
        
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Artikel berhasil diterbitkan."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal menyimpan artikel: " . $conn->error]);
        }
    } 
    
    // Aksi Edit Artikel
    elseif ($action === 'edit') {
        $id = (int)($_POST['id'] ?? 0);
        $title = $_POST['title'] ?? '';
        $category = $_POST['category'] ?? '';
        $author = $_POST['author'] ?? '';
        $excerpt = $_POST['excerpt'] ?? '';
        $content = $_POST['content'] ?? '';
        $badge_class = $_POST['badge_class'] ?? 'bg-navy-subtle text-navy';

        if (empty($title) || empty($content) || $id === 0) {
            echo json_encode(["status" => "error", "message" => "Data artikel tidak valid."]);
            exit();
        }

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = uploadCover($_FILES['image']);
            $stmt = $conn->prepare("UPDATE blogs SET title=?, category=?, author=?, excerpt=?, content=?, image=?, badge_class=? WHERE id=?");
            $stmt->bind_param("sssssssi", $title, $category, $author, $excerpt, $content, $image, $badge_class, $id);
        } else {
            $stmt = $conn->prepare("UPDATE blogs SET title=?, category=?, author=?, excerpt=?, content=?, badge_class=? WHERE id=?");
            $stmt->bind_param("ssssssi", $title, $category, $author, $excerpt, $content, $badge_class, $id);
        }

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Artikel berhasil diperbarui."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal memperbarui: " . $conn->error]);
        }
    }
    
    // Aksi Hapus Artikel
    elseif ($action === 'delete') {
        $id = (int)($_POST['id'] ?? 0);
        if ($id > 0) {
            $stmt = $conn->prepare("DELETE FROM blogs WHERE id=?");
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                echo json_encode(["status" => "success", "message" => "Artikel telah dihapus permanen."]);
            } else {
                echo json_encode(["status" => "error", "message" => "Gagal menghapus artikel."]);
            }
        }
    }
}
?>
