<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, DELETE");

require_once '../config/config.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $role = isset($_GET['role']) ? $conn->real_escape_string($_GET['role']) : null;

    $query = "SELECT id, name, email, role, user_type, institution, created_at FROM users";
    if ($role) {
        $query .= " WHERE role='$role'";
    }
    $query .= " ORDER BY FIELD(role, 'admin', 'bendahara', 'staff', 'freelancer'), created_at DESC";

    $result = $conn->query($query);
    $users = [];

    $countAdmin = 0;
    $countStaff = 0;
    $countBendahara = 0;
    $countFreelancer = 0;
    $countTotal = 0;

    // Get role summaries
    $q_summary = $conn->query("SELECT role, COUNT(id) as total FROM users GROUP BY role");
    if ($q_summary) {
        while ($row = $q_summary->fetch_assoc()) {
            if ($row['role'] === 'admin') $countAdmin = (int)$row['total'];
            if ($row['role'] === 'bendahara') $countBendahara = (int)$row['total'];
            if ($row['role'] === 'staff') $countStaff = (int)$row['total'];
            if ($row['role'] === 'freelancer') $countFreelancer = (int)$row['total'];
            $countTotal += (int)$row['total'];
        }
    }

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    }

    echo json_encode([
        "status" => "success",
        "users" => $users,
        "summary" => [
            "admin" => $countAdmin,
            "bendahara" => $countBendahara,
            "staff" => $countStaff,
            "freelancer" => $countFreelancer,
            "total" => $countTotal
        ]
    ]);
    exit();
}

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data) $data = $_POST;

    $name = trim($data['name'] ?? '');
    $email = trim($data['email'] ?? '');
    $password = $data['password'] ?? '';
    $role = in_array($data['role'] ?? '', ['admin', 'staff', 'bendahara']) ? $data['role'] : 'staff';
    $userType = 'umum';

    if (empty($name) || empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Mohon lengkapi nama, email, dan password."]);
        exit();
    }

    // Check if email already exists
    $stmtCheck = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmtCheck->bind_param("s", $email);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();
    if ($resultCheck->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Email sudah terdaftar dalam sistem."]);
        $stmtCheck->close();
        exit();
    }
    $stmtCheck->close();

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmtInsert = $conn->prepare("INSERT INTO users (name, email, password, role, user_type) VALUES (?, ?, ?, ?, ?)");
    $stmtInsert->bind_param("sssss", $name, $email, $hashedPassword, $role, $userType);
    
    if ($stmtInsert->execute()) {
        echo json_encode(["status" => "success", "message" => "Akun pengguna baru berhasil dibuat."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan akun: " . $stmtInsert->error]);
    }
    
    $stmtInsert->close();
    exit();
}

if ($method === 'DELETE') {
    $data = json_decode(file_get_contents("php://input"), true);
    $id = isset($data['id']) ? (int)$data['id'] : 0;

    if ($id <= 0) {
        echo json_encode(["status" => "error", "message" => "ID tidak valid"]);
        exit();
    }

    $currentUserId = intval($_SESSION['user_id'] ?? 0);
    if ($id === $currentUserId || $id === 1) {
        echo json_encode(["status" => "error", "message" => "Akun Administrator Utama tidak boleh dihapus demi keamanan."]);
        exit();
    }

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        echo json_encode(["status" => "success", "message" => "Pengguna berhasil dihapus."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menghapus pengguna: " . $conn->error]);
    }
    $stmt->close();
    exit();
}

echo json_encode(["status" => "error", "message" => "Invalid request method"]);
