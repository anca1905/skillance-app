<?php
session_start();
header('Content-Type: application/json');

require '../config/config.php';

// Check auth (assuming 'user_id' is set on login)
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'Unauthorized']);
    exit();
}

$method = $_SERVER['REQUEST_METHOD'];

// Helper function to send WA
function sendWANotification($conn, $assignee_id, $project_id, $task_title, $priority, $due_date) {
    if ($assignee_id === 'NULL' || !$assignee_id) return;
    
    // Get user phone
    $stmt = $conn->prepare("SELECT name, phone FROM users WHERE id = ?");
    $stmt->bind_param("i", $assignee_id);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($row = $res->fetch_assoc()) {
        if (!empty($row['phone'])) {
            // Get project name
            $stmt2 = $conn->prepare("SELECT name FROM projects WHERE id = ?");
            $stmt2->bind_param("i", $project_id);
            $stmt2->execute();
            $res2 = $stmt2->get_result();
            $p_name = ($row2 = $res2->fetch_assoc()) ? $row2['name'] : "Unknown Project";
            
            $msg = "Halo *" . $row['name'] . "*,\n\n";
            $msg .= "Anda mendapatkan tugas baru di Project *" . $p_name . "*:\n";
            $msg .= "📌 *Task*: " . $task_title . "\n";
            $msg .= "🔥 *Prioritas*: " . $priority . "\n";
            if ($due_date !== 'NULL') {
                $msg .= "⏰ *Tenggat Waktu*: " . trim($due_date, "'") . "\n\n";
            } else {
                $msg .= "\n";
            }
            $msg .= "Silakan cek sistem Skillance untuk detail lebih lanjut.";
            
            // Send to WA Gateway
            $url = 'http://localhost:3000/send';
            $data = json_encode(['phone' => $row['phone'], 'message' => $msg]);
            
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 2); // short timeout so it doesn't block
            $result = curl_exec($ch);
            curl_close($ch);
        }
    }
}

switch ($method) {
    case 'GET':
        $project_id = isset($_GET['project_id']) ? intval($_GET['project_id']) : 0;
        
        if ($project_id === 0) {
            echo json_encode(['status' => 'error', 'message' => 'Project ID required']);
            exit();
        }
        
        // Fetch tasks and assignee info if users table has it
        $sql = "SELECT t.*, u.name as assignee_name 
                FROM project_tasks t 
                LEFT JOIN users u ON t.assignee_id = u.id 
                WHERE t.project_id = $project_id
                ORDER BY t.created_at ASC";
                
        $result = $conn->query($sql);
        $tasks = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $tasks[] = $row;
            }
        }
        
        // Also fetch project users for assignee dropdown
        $usersResult = $conn->query("SELECT id, name FROM users");
        $users = [];
        if ($usersResult) {
            while ($row = $usersResult->fetch_assoc()) {
                $users[] = $row;
            }
        }
        
        echo json_encode(['status' => 'success', 'data' => $tasks, 'users' => $users]);
        break;

    case 'POST':
        $input = json_decode(file_get_contents('php://input'), true);
        if (empty($input)) {
            $input = $_POST;
        }
        
        $is_update = isset($input['id']) && intval($input['id']) > 0;
        $id = $is_update ? intval($input['id']) : 0;
        
        $project_id = isset($input['project_id']) ? intval($input['project_id']) : 0;
        $title = $conn->real_escape_string($input['title'] ?? '');
        $description = $conn->real_escape_string($input['description'] ?? '');
        $status = $conn->real_escape_string($input['status'] ?? 'Backlog');
        $priority = $conn->real_escape_string($input['priority'] ?? 'Normal');
        
        $assignee_id = !empty($input['assignee_id']) ? intval($input['assignee_id']) : 'NULL';
        $due_date = !empty($input['due_date']) ? "'" . $conn->real_escape_string($input['due_date']) . "'" : 'NULL';
        $tags = $conn->real_escape_string($input['tags'] ?? '');
        
        if (empty($title) || ($project_id === 0 && !$is_update)) {
            echo json_encode(['status' => 'error', 'message' => 'Project ID dan Title wajib diisi']);
            exit();
        }
        
        // Handle cover photo upload
        $cover_photo = null;
        if (isset($_FILES['cover_photo']) && $_FILES['cover_photo']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = '../assets/uploads/tasks/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            $file_ext = strtolower(pathinfo($_FILES['cover_photo']['name'], PATHINFO_EXTENSION));
            $allowed_exts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            if (in_array($file_ext, $allowed_exts)) {
                $new_filename = uniqid('task_') . '.' . $file_ext;
                $target_file = $upload_dir . $new_filename;
                if (move_uploaded_file($_FILES['cover_photo']['tmp_name'], $target_file)) {
                    $cover_photo = 'assets/uploads/tasks/' . $new_filename;
                }
            }
        }
        
        if ($is_update) {
            // Update logic
            $sql = "UPDATE project_tasks SET 
                    title = '$title',
                    description = '$description',
                    status = '$status',
                    priority = '$priority',
                    assignee_id = $assignee_id,
                    due_date = $due_date,
                    tags = '$tags'";
            
            if ($cover_photo) {
                $sql .= ", cover_photo = '$cover_photo'";
            }
            
            $sql .= " WHERE id = $id";
            
            if ($conn->query($sql) === TRUE) {
                echo json_encode(['status' => 'success', 'message' => 'Task berhasil diperbarui']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui task: ' . $conn->error]);
            }
        } else {
            // Insert logic
            $cover_val = $cover_photo ? "'$cover_photo'" : 'NULL';
            $sql = "INSERT INTO project_tasks (project_id, title, description, status, priority, assignee_id, due_date, tags, cover_photo) 
                    VALUES ($project_id, '$title', '$description', '$status', '$priority', $assignee_id, $due_date, '$tags', $cover_val)";
                    
            if ($conn->query($sql) === TRUE) {
                sendWANotification($conn, $assignee_id, $project_id, $title, $priority, $due_date);
                echo json_encode(['status' => 'success', 'message' => 'Task berhasil ditambahkan']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menambah task: ' . $conn->error]);
            }
        }
        break;

    case 'PUT':
        $input = json_decode(file_get_contents('php://input'), true);
        
        $id = isset($_GET['id']) ? intval($_GET['id']) : (isset($input['id']) ? intval($input['id']) : 0);
        
        if ($id === 0) {
            echo json_encode(['status' => 'error', 'message' => 'Task ID required']);
            exit();
        }
        
        // Handle drag and drop status update
        if (isset($input['update_status'])) {
            $new_status = $conn->real_escape_string($input['status']);
            $sql = "UPDATE project_tasks SET status = '$new_status' WHERE id = $id";
        } else {
            // Full update
            $title = $conn->real_escape_string($input['title'] ?? '');
            $description = $conn->real_escape_string($input['description'] ?? '');
            $status = $conn->real_escape_string($input['status'] ?? 'Backlog');
            $priority = $conn->real_escape_string($input['priority'] ?? 'Normal');
            
            $assignee_id = !empty($input['assignee_id']) ? intval($input['assignee_id']) : 'NULL';
            $due_date = !empty($input['due_date']) ? "'" . $conn->real_escape_string($input['due_date']) . "'" : 'NULL';
            $tags = $conn->real_escape_string($input['tags'] ?? '');
            
            if (empty($title)) {
                echo json_encode(['status' => 'error', 'message' => 'Title wajib diisi']);
                exit();
            }
            
            $sql = "UPDATE project_tasks SET 
                    title = '$title',
                    description = '$description',
                    status = '$status',
                    priority = '$priority',
                    assignee_id = $assignee_id,
                    due_date = $due_date,
                    tags = '$tags'
                    WHERE id = $id";
        }
        
        if ($conn->query($sql) === TRUE) {
            // Only send notification if it was a full update, not just a status drag-and-drop update
            if (!isset($input['update_status'])) {
                // Fetch project id for the task to pass to the notification function
                $task_res = $conn->query("SELECT project_id FROM project_tasks WHERE id = $id");
                $p_id = ($task_res && $row = $task_res->fetch_assoc()) ? $row['project_id'] : 0;
                sendWANotification($conn, $assignee_id, $p_id, $title, $priority, $due_date);
            }
            echo json_encode(['status' => 'success', 'message' => 'Task berhasil diperbarui']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui task: ' . $conn->error]);
        }
        break;

    case 'DELETE':
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        if ($id === 0) {
            echo json_encode(['status' => 'error', 'message' => 'Task ID required']);
            exit();
        }
        
        $sql = "DELETE FROM project_tasks WHERE id = $id";
        if ($conn->query($sql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Task berhasil dihapus']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus task']);
        }
        break;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Method not allowed']);
        break;
}

$conn->close();
?>
