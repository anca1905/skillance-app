<?php
session_start();
header('Content-Type: application/json');

require_once __DIR__ . '/../config/config.php';

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

$userRole = $_SESSION['user_role'] ?? $_SESSION['role'] ?? '';
if (!in_array($userRole, ['admin', 'bendahara'])) {
    echo json_encode(['status' => 'error', 'message' => 'Akses ditolak: Hanya Admin dan Bendahara yang berhak mengakses sistem payroll.']);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Fetch payroll records with user & project details
        $sql = "SELECT p.*, 
                       u.name as user_name, 
                       u.role as user_role,
                       pr.name as project_name,
                       pr.price as project_price,
                       pr.payment_status as project_payment_status,
                       COALESCE(NULLIF(p.unit_bisnis, ''), 'Software House') as unit_bisnis 
                FROM payrolls p 
                JOIN users u ON p.user_id = u.id 
                LEFT JOIN projects pr ON p.project_id = pr.id
                ORDER BY p.id DESC";
                
        $result = $conn->query($sql);
        $payrolls = [];
        $totalPending = 0;
        $totalPaid = 0;

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $amt = (float)$row['total_amount'];
                if ($row['status'] === 'Pending') {
                    $totalPending += $amt;
                } else {
                    $totalPaid += $amt;
                }
                $payrolls[] = $row;
            }
        }
        
        // Fetch users for dropdown (staff, freelancers, admin)
        $usersResult = $conn->query("SELECT id, name, role FROM users ORDER BY name ASC");
        $users = [];
        if ($usersResult) {
            while ($row = $usersResult->fetch_assoc()) {
                $users[] = $row;
            }
        }

        // Fetch projects for profit-sharing linking
        $projectsResult = $conn->query("SELECT id, name, client_name, price, payment_status, status FROM projects ORDER BY id DESC LIMIT 50");
        $projects = [];
        if ($projectsResult) {
            while ($row = $projectsResult->fetch_assoc()) {
                $projects[] = $row;
            }
        }
        
        echo json_encode([
            'status' => 'success', 
            'data' => $payrolls, 
            'users' => $users,
            'projects' => $projects,
            'summary' => [
                'total_pending' => $totalPending,
                'total_paid' => $totalPaid,
                'count_total' => count($payrolls)
            ]
        ]);
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        if (!$input) $input = $_POST;
        
        $user_id = intval($input['user_id'] ?? 0);
        $project_id = intval($input['project_id'] ?? 0);
        $proj_col_val = ($project_id > 0) ? $project_id : 'NULL';

        $role_type = $conn->real_escape_string($input['role_type'] ?? 'Programmer');
        $unit_bisnis = $conn->real_escape_string($input['unit_bisnis'] ?? 'Software House');
        $description = $conn->real_escape_string($input['description'] ?? '');
        $complexity = $conn->real_escape_string($input['complexity'] ?? 'Standard');
        $qty = intval($input['qty'] ?? 1);
        if ($qty <= 0) $qty = 1;
        
        $rate = floatval($input['rate'] ?? 0);

        // Fallback default rates if not specified
        if ($rate <= 0) {
            if ($role_type === 'Programmer') {
                $rate = 500000;
            } else if ($role_type === 'Designer') {
                $rate = ($complexity === 'Complex') ? 25000 : 15000;
            } else if ($role_type === 'Operator Toko') {
                $rate = 50000;
            } else if ($role_type === 'Instruktur') {
                $rate = 200000;
            } else if ($role_type === 'Jurnalis') {
                $rate = 35000;
            } else {
                $rate = 100000;
            }
        }
        
        if ($user_id === 0 || empty($description)) {
            echo json_encode(['status' => 'error', 'message' => 'Lengkapi nama karyawan dan deskripsi tugas / project.']);
            exit();
        }
        
        $total_amount = $rate * $qty;
        
        $sql = "INSERT INTO payrolls (user_id, project_id, role_type, unit_bisnis, description, complexity, qty, rate, total_amount, status) 
                VALUES ($user_id, $proj_col_val, '$role_type', '$unit_bisnis', '$description', '$complexity', $qty, $rate, $total_amount, 'Pending')";
                
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Catatan honor / bagi hasil berhasil ditambahkan ke daftar pending.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambah catatan: ' . $conn->error]);
        }
        break;

    case 'PUT':
        $input = json_decode(file_get_contents('php://input'), true);
        $id = isset($input['id']) ? intval($input['id']) : 0;
        
        if ($id === 0) {
            echo json_encode(['status' => 'error', 'message' => 'ID catatan gaji diperlukan.']);
            exit();
        }
        
        if (isset($input['mark_paid']) && $input['mark_paid'] === true) {
            // Get detail payroll
            $q_item = $conn->query("
                SELECT p.*, u.name as user_name, pr.name as project_name 
                FROM payrolls p 
                JOIN users u ON p.user_id = u.id 
                LEFT JOIN projects pr ON p.project_id = pr.id
                WHERE p.id = $id
            ");
            $item = $q_item ? $q_item->fetch_assoc() : null;

            if (!$item) {
                echo json_encode(['status' => 'error', 'message' => 'Data penggajian tidak ditemukan.']);
                exit();
            }

            // Update status to Dibayar
            $sql = "UPDATE payrolls SET status = 'Dibayar', payment_date = CURDATE() WHERE id = $id";
            if ($conn->query($sql) === TRUE) {
                // AUTO LOG INTO FINANCES (BUKU KAS PT)
                $amount = (float)$item['total_amount'];
                $unit = $item['unit_bisnis'] ?: 'Software House';
                $proj_id_val = !empty($item['project_id']) ? intval($item['project_id']) : 'NULL';
                
                $projNote = !empty($item['project_name']) ? " (Proyek: {$item['project_name']})" : "";
                $desc = $conn->real_escape_string("Pembayaran Honor Bagi Hasil: {$item['user_name']} - {$item['role_type']}{$projNote} [{$item['description']}]");
                $cat = 'Honorarium';
                $today = date('Y-m-d');

                $conn->query("
                    INSERT INTO finances (project_id, type, amount, description, category, unit_bisnis, date) 
                    VALUES ($proj_id_val, 'expense', $amount, '$desc', '$cat', '$unit', '$today')
                ");

                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Status honor berhasil ditandai Dibayar dan otomatis dicatat ke Buku Kas Pengeluaran PT Skillance!'
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate status: ' . $conn->error]);
            }
        }
        break;

    case 'DELETE':
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        if ($id === 0) {
            echo json_encode(['status' => 'error', 'message' => 'ID diperlukan']);
            exit();
        }
        
        $sql = "DELETE FROM payrolls WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Catatan gaji/bagi hasil berhasil dihapus.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus catatan: ' . $conn->error]);
        }
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
        break;
}

$conn->close();
