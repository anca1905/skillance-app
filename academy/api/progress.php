<?php
session_start();
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/../config/config.php';

$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    http_response_code(401);
    echo json_encode(['status' => 'error', 'message' => 'Silakan login terlebih dahulu untuk menyimpan progres belajar.']);
    exit();
}

// Total modules per track mapping for progress calculation
$trackTotalModules = [
    'web_frontend'  => 7,
    'backend_api'   => 4,
    'mobile_flutter'=> 4,
    'uiux_design'   => 4
];

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    // Ambil semua modul yang telah diselesaikan oleh user
    $stmt = $conn->prepare("SELECT track_id, module_id, completed_at FROM `academy_module_progress` WHERE `user_id` = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $res = $stmt->get_result();

    $completedModules = [];
    while ($row = $res->fetch_assoc()) {
        $completedModules[] = [
            'track_id'     => $row['track_id'],
            'module_id'    => $row['module_id'],
            'completed_at' => $row['completed_at']
        ];
    }
    $stmt->close();

    // Ambil daftar enrollments & percent
    $stmtEnroll = $conn->prepare("SELECT track_id, progress_percent, status FROM `academy_enrollments` WHERE `user_id` = ?");
    $stmtEnroll->bind_param("i", $userId);
    $stmtEnroll->execute();
    $resEnroll = $stmtEnroll->get_result();

    $enrollments = [];
    while ($row = $resEnroll->fetch_assoc()) {
        $enrollments[$row['track_id']] = [
            'progress' => (int)$row['progress_percent'],
            'status'   => $row['status']
        ];
    }
    $stmtEnroll->close();

    // Ambil lencana / badge yang diraih
    $stmtBadge = $conn->prepare("SELECT badge_title, track_id, badge_icon, awarded_at FROM `academy_badges` WHERE `user_id` = ?");
    $stmtBadge->bind_param("i", $userId);
    $stmtBadge->execute();
    $resBadge = $stmtBadge->get_result();

    $badges = [];
    while ($row = $resBadge->fetch_assoc()) {
        $badges[] = $row;
    }
    $stmtBadge->close();

    echo json_encode([
        'status'            => 'success',
        'completed_modules' => $completedModules,
        'enrollments'       => $enrollments,
        'badges'            => $badges
    ]);
    exit();
}

if ($method === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $trackId  = trim($input['track_id'] ?? '');
    $moduleId = trim($input['module_id'] ?? '');
    $isComplete = !empty($input['completed']);

    if (empty($trackId) || empty($moduleId)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Parameter track_id dan module_id wajib diisi.']);
        exit();
    }

    if ($isComplete) {
        $stmt = $conn->prepare("INSERT IGNORE INTO `academy_module_progress` (`user_id`, `track_id`, `module_id`) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $userId, $trackId, $moduleId);
        $stmt->execute();
        $stmt->close();
    } else {
        $stmt = $conn->prepare("DELETE FROM `academy_module_progress` WHERE `user_id` = ? AND `track_id` = ? AND `module_id` = ?");
        $stmt->bind_param("iss", $userId, $trackId, $moduleId);
        $stmt->execute();
        $stmt->close();
    }

    // Hitung total modul selesai di track ini
    $countStmt = $conn->prepare("SELECT COUNT(*) as completed_count FROM `academy_module_progress` WHERE `user_id` = ? AND `track_id` = ?");
    $countStmt->bind_param("is", $userId, $trackId);
    $countStmt->execute();
    $countRes = $countStmt->get_result()->fetch_assoc();
    $completedCount = (int)$countRes['completed_count'];
    $countStmt->close();

    $totalModules = $trackTotalModules[$trackId] ?? 8;
    $percent = min(100, (int)round(($completedCount / $totalModules) * 100));
    $trackStatus = ($percent >= 100) ? 'completed' : 'learning';

    // Update or insert into academy_enrollments
    $enrollStmt = $conn->prepare("INSERT INTO `academy_enrollments` (`user_id`, `track_id`, `progress_percent`, `status`) VALUES (?, ?, ?, ?) ON DUPLICATE KEY UPDATE `progress_percent` = VALUES(`progress_percent`), `status` = VALUES(`status`)");
    $enrollStmt->bind_param("isis", $userId, $trackId, $percent, $trackStatus);
    $enrollStmt->execute();
    $enrollStmt->close();

    $badgeAwarded = null;
    // Jika selesai 100%, beri badge kelulusan
    if ($percent >= 100) {
        $badgeNames = [
            'web_frontend'  => 'Frontend Web Specialist',
            'backend_api'   => 'Backend & API Engineer',
            'mobile_flutter'=> 'Flutter Mobile Developer',
            'uiux_design'   => 'Product UI/UX Designer'
        ];
        $badgeTitle = $badgeNames[$trackId] ?? 'Skillance Certified Graduate';

        $bStmt = $conn->prepare("INSERT IGNORE INTO `academy_badges` (`user_id`, `badge_title`, `track_id`, `badge_icon`) VALUES (?, ?, ?, 'fa-certificate')");
        $bStmt->bind_param("iss", $userId, $badgeTitle, $trackId);
        $bStmt->execute();
        if ($bStmt->affected_rows > 0) {
            $badgeAwarded = $badgeTitle;
        }
        $bStmt->close();
    }

    echo json_encode([
        'status'           => 'success',
        'track_id'         => $trackId,
        'module_id'        => $moduleId,
        'completed'        => $isComplete,
        'completed_count'  => $completedCount,
        'total_modules'    => $totalModules,
        'progress_percent' => $percent,
        'badge_awarded'    => $badgeAwarded
    ]);
    exit();
}
