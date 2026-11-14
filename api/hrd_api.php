<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, DELETE");

require_once '../config/config.php';

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    $role = isset($_GET['role']) ? $conn->real_escape_string($_GET['role']) : null;

    $query = "SELECT id, name, email, role, user_type, institution, photo, assigned_roles, partner_slug, position_title, created_at FROM users";
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
    $countDekanat = 0;
    $countOrmawa = 0;
    $countMahasiswa = 0;

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $assigned = strtolower($row['assigned_roles'] ?? '');
            if ($row['role'] === 'admin' || strpos($assigned, 'admin') !== false) $countAdmin++;
            if ($row['role'] === 'bendahara') $countBendahara++;
            if ($row['role'] === 'staff') $countStaff++;
            if (strpos($assigned, 'freelancer') !== false || $row['role'] === 'freelancer') $countFreelancer++;
            if (strpos($assigned, 'dekanat') !== false) $countDekanat++;
            if (strpos($assigned, 'ormawa') !== false) $countOrmawa++;
            if (strpos($assigned, 'mahasiswa') !== false) $countMahasiswa++;
            
            $countTotal++;
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
            "dekanat" => $countDekanat,
            "ormawa" => $countOrmawa,
            "mahasiswa" => $countMahasiswa,
            "total" => $countTotal
        ]
    ]);
    exit();
}

if ($method === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    if (!$data) $data = $_POST;

    // ACTION: UPDATE ROLES & ACCESS PERMISSIONS
    if (isset($data['action']) && $data['action'] === 'update_roles') {
        $id = intval($data['id'] ?? 0);
        $assignedRoles = trim($data['assigned_roles'] ?? 'freelancer,mahasiswa');
        $partnerSlug = trim($data['partner_slug'] ?? 'msc-usn');
        $positionTitle = trim($data['position_title'] ?? '');
        $role = trim($data['role'] ?? '');

        if ($id <= 0) {
            echo json_encode(["status" => "error", "message" => "ID Pengguna tidak valid."]);
            exit();
        }

        // Auto-sync primary role if admin is selected
        if (strpos($assignedRoles, 'admin') !== false) {
            $role = 'admin';
        }

        if (!empty($role)) {
            $stmt = $conn->prepare("UPDATE users SET assigned_roles = ?, partner_slug = ?, position_title = ?, role = ? WHERE id = ?");
            $stmt->bind_param("ssssi", $assignedRoles, $partnerSlug, $positionTitle, $role, $id);
        } else {
            $stmt = $conn->prepare("UPDATE users SET assigned_roles = ?, partner_slug = ?, position_title = ? WHERE id = ?");
            $stmt->bind_param("sssi", $assignedRoles, $partnerSlug, $positionTitle, $id);
        }

        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Hak akses multi-peran pengguna berhasil diperbarui!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Gagal memperbarui hak akses: " . $stmt->error]);
        }
        $stmt->close();
        exit();
    }

    // ACTION: CREATE NEW USER
    $name = trim($data['name'] ?? '');
    $email = trim($data['email'] ?? '');
    $password = $data['password'] ?? '';
    $role = in_array($data['role'] ?? '', ['admin', 'staff', 'bendahara', 'freelancer']) ? $data['role'] : 'staff';
    $assignedRoles = trim($data['assigned_roles'] ?? ($role === 'admin' ? 'admin,dekanat,ormawa,mahasiswa,freelancer' : 'freelancer,mahasiswa'));
    $partnerSlug = trim($data['partner_slug'] ?? 'msc-usn');
    $positionTitle = trim($data['position_title'] ?? '');
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

    $stmtInsert = $conn->prepare("INSERT INTO users (name, email, password, role, user_type, assigned_roles, partner_slug, position_title) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmtInsert->bind_param("ssssssss", $name, $email, $hashedPassword, $role, $userType, $assignedRoles, $partnerSlug, $positionTitle);
    
    if ($stmtInsert->execute()) {
        echo json_encode(["status" => "success", "message" => "Akun pengguna baru berhasil dibuat beserta hak aksesnya."]);
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
