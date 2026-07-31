<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, DELETE");

require_once '../config/config.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $role = isset($_GET['role']) ? $conn->real_escape_string($_GET['role']) : null;

    $query = "SELECT id, name, email, role, created_at FROM users";
    if ($role) {
        $query .= " WHERE role='$role'";
    } else {
        $query .= " WHERE role != 'admin'"; // Default hide admins from HRD view if wanted
    }
    $query .= " ORDER BY created_at DESC";

    $result = $conn->query($query);
    $users = [];

    $countStaff = 0;
    $countInvestor = 0;

    // Also get totals
    $q_summary = $conn->query("SELECT role, COUNT(id) as total FROM users GROUP BY role");
    if ($q_summary) {
        while ($row = $q_summary->fetch_assoc()) {
            if ($row['role'] == 'staff') $countStaff = (int)$row['total'];
            if ($row['role'] == 'investor') $countInvestor = (int)$row['total'];
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
            "staff" => $countStaff,
            "investor" => $countInvestor
        ]
    ]);
    exit();
}

if ($method === 'POST') {
    // Determine if it's an insert or update based on 'id' existence (optional for future updates)
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data) $data = $_POST;

    $name = trim($data['name'] ?? '');
    $email = trim($data['email'] ?? '');
    $password = $data['password'] ?? '';
    $role = $data['role'] ?? 'staff';

    if (empty($name) || empty($email) || empty($password)) {
        echo json_encode(["status" => "error", "message" => "Data tidak lengkap"]);
        exit();
    }

    // Check if email already exists using prepared statement
    $stmtCheck = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmtCheck->bind_param("s", $email);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();
    if ($resultCheck->num_rows > 0) {
        echo json_encode(["status" => "error", "message" => "Email sudah terdaftar"]);
        $stmtCheck->close();
        exit();
    }
    $stmtCheck->close();

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert new user using prepared statement
    $stmtInsert = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmtInsert->bind_param("ssss", $name, $email, $hashedPassword, $role);
    
    if ($stmtInsert->execute()) {
        echo json_encode(["status" => "success", "message" => "Pengguna berhasil ditambahkan"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menyimpan pengguna: " . $stmtInsert->error]);
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

    // Prevent deleting admin? (Optional safety)
    $stmt = $conn->query("DELETE FROM users WHERE id=$id AND role != 'admin'");
    if ($stmt) {
        echo json_encode(["status" => "success", "message" => "Pengguna berhasil dihapus"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Gagal menghapus pengguna: " . $conn->error]);
    }
    exit();
}

echo json_encode(["status" => "error", "message" => "Invalid request method"]);
