<?php
session_start();
header('Content-Type: application/json');

require '../config/config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Fetch payroll records
        $sql = "SELECT p.*, u.name as user_name, u.role as user_role 
                FROM payrolls p 
                JOIN users u ON p.user_id = u.id 
                ORDER BY p.created_at DESC";
                
        $result = $conn->query($sql);
        $payrolls = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $payrolls[] = $row;
            }
        }
        
        // Fetch users for dropdown
        $usersResult = $conn->query("SELECT id, name, role FROM users");
        $users = [];
        if ($usersResult) {
            while ($row = $usersResult->fetch_assoc()) {
                $users[] = $row;
            }
        }
        
        echo json_encode(['status' => 'success', 'data' => $payrolls, 'users' => $users]);
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        
        $user_id = intval($input['user_id']);
        $role_type = $conn->real_escape_string($input['role_type']);
        $description = $conn->real_escape_string($input['description']);
        $complexity = $conn->real_escape_string($input['complexity'] ?? 'Standard');
        $qty = intval($input['qty']);
        
        if ($user_id === 0 || empty($description) || $qty <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Lengkapi form dengan benar.']);
            exit();
        }
        
        // Calculate rate based on user rule
        $rate = 0;
        if ($role_type === 'Programmer') {
            $rate = 500000;
        } else if ($role_type === 'Designer') {
            if ($complexity === 'Complex') {
                $rate = 25000; // Multi slide
            } else {
                $rate = 15000; // Single layer
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Role tidak valid.']);
            exit();
        }
        
        $total_amount = $rate * $qty;
        
        $sql = "INSERT INTO payrolls (user_id, role_type, description, complexity, qty, rate, total_amount, status) 
                VALUES ($user_id, '$role_type', '$description', '$complexity', $qty, $rate, $total_amount, 'Pending')";
                
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Catatan gaji berhasil ditambahkan']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambah catatan: ' . $conn->error]);
        }
        break;

    case 'PUT':
        $input = json_decode(file_get_contents('php://input'), true);
        $id = isset($input['id']) ? intval($input['id']) : 0;
        
        if ($id === 0) {
            echo json_encode(['status' => 'error', 'message' => 'ID required']);
            exit();
        }
        
        if (isset($input['mark_paid']) && $input['mark_paid'] === true) {
            $sql = "UPDATE payrolls SET status = 'Dibayar', payment_date = CURDATE() WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                echo json_encode(['status' => 'success', 'message' => 'Status diubah menjadi Dibayar']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate status: ' . $conn->error]);
            }
        }
        break;

    case 'DELETE':
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        if ($id === 0) {
            echo json_encode(['status' => 'error', 'message' => 'ID required']);
            exit();
        }
        
        $sql = "DELETE FROM payrolls WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Catatan berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus catatan']);
        }
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
        break;
}

$conn->close();
?>
