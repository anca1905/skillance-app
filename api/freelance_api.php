<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../config/config.php';

$action = $_GET['action'] ?? ($_POST['action'] ?? '');
$isLoggedIn = isset($_SESSION['user_id']);
$userId = $isLoggedIn ? intval($_SESSION['user_id']) : 0;

// Verifikasi Sesi Freelancer: get_jobs boleh diakses publik (tanpa login)
if (!$isLoggedIn && $action !== 'get_jobs') {
    http_response_code(401);
    echo json_encode([
        "status" => "error", 
        "message" => "Silakan login terlebih dahulu untuk mengakses fitur ini.", 
        "is_logged_in" => false
    ]);
    exit();
}

switch ($action) {

    // 1. GET OVERVIEW STATS & SUMMARY
    case 'get_overview':
        // Ambil data user
        $uStmt = $conn->prepare("SELECT id, name, email, photo, role, user_type, institution, major, skills, bank_name, bank_account_number, bank_account_name FROM users WHERE id = ?");
        $uStmt->bind_param("i", $userId);
        $uStmt->execute();
        $userData = $uStmt->get_result()->fetch_assoc();
        $uStmt->close();

        // Hitung statistik tugas
        $stats = [
            'total_completed' => 0,
            'in_progress' => 0,
            'submitted' => 0,
            'revision' => 0,
            'total_earnings_paid' => 0,
            'total_earnings_pending' => 0
        ];

        $taskStatRes = $conn->query("
            SELECT status, COUNT(*) as cnt 
            FROM freelance_assignments 
            WHERE freelancer_id = $userId 
            GROUP BY status
        ");
        while ($r = $taskStatRes->fetch_assoc()) {
            if ($r['status'] === 'completed') $stats['total_completed'] = intval($r['cnt']);
            if ($r['status'] === 'in_progress' || $r['status'] === 'accepted') $stats['in_progress'] += intval($r['cnt']);
            if ($r['status'] === 'submitted') $stats['submitted'] = intval($r['cnt']);
            if ($r['status'] === 'revision') $stats['revision'] = intval($r['cnt']);
        }

        // Hitung total earnings
        $earnRes = $conn->query("
            SELECT status, SUM(amount) as total 
            FROM freelance_payouts 
            WHERE freelancer_id = $userId 
            GROUP BY status
        ");
        while ($r = $earnRes->fetch_assoc()) {
            if ($r['status'] === 'transferred') $stats['total_earnings_paid'] = floatval($r['total']);
            if ($r['status'] === 'pending') $stats['total_earnings_pending'] = floatval($r['total']);
        }

        // Ambil 3 Tugas Aktif Terkini
        $activeTasks = [];
        $actRes = $conn->query("
            SELECT a.id as assignment_id, a.status, a.submitted_at, a.revision_feedback,
                   j.id as job_id, j.title, j.category, j.reward_amount, j.deadline,
                   DATEDIFF(j.deadline, CURDATE()) as days_left
            FROM freelance_assignments a
            JOIN freelance_jobs j ON a.job_id = j.id
            WHERE a.freelancer_id = $userId AND a.status IN ('in_progress', 'accepted', 'submitted', 'revision')
            ORDER BY j.deadline ASC
            LIMIT 3
        ");
        while ($r = $actRes->fetch_assoc()) {
            $activeTasks[] = $r;
        }

        // Rekomendasi Lowongan Terbuka
        $recentJobs = [];
        $jobRes = $conn->query("
            SELECT j.*, DATEDIFF(j.deadline, CURDATE()) as days_left,
                   (SELECT COUNT(*) FROM freelance_assignments a WHERE a.job_id = j.id AND a.freelancer_id = $userId) as has_applied
            FROM freelance_jobs j
            WHERE j.status = 'open'
            ORDER BY j.id DESC
            LIMIT 4
        ");
        while ($r = $jobRes->fetch_assoc()) {
            $recentJobs[] = $r;
        }

        echo json_encode([
            "status" => "success",
            "user" => $userData,
            "stats" => $stats,
            "active_tasks" => $activeTasks,
            "recent_jobs" => $recentJobs
        ]);
        break;

    // 2. GET MY TASKS (PEKERJAAN SAYA)
    case 'get_my_tasks':
        $filterStatus = $_GET['status'] ?? 'all';
        $whereSql = "WHERE a.freelancer_id = $userId";

        if ($filterStatus === 'in_progress') {
            $whereSql .= " AND a.status IN ('in_progress', 'accepted')";
        } elseif ($filterStatus === 'submitted') {
            $whereSql .= " AND a.status = 'submitted'";
        } elseif ($filterStatus === 'revision') {
            $whereSql .= " AND a.status = 'revision'";
        } elseif ($filterStatus === 'completed') {
            $whereSql .= " AND a.status = 'completed'";
        }

        $query = "
            SELECT a.id as assignment_id, a.job_id, a.status, a.application_notes,
                   a.submission_notes, a.submission_link, a.submission_file,
                   a.submitted_at, a.revision_feedback, a.approved_at, a.rating, a.review, a.created_at as assigned_at,
                   j.title, j.category, j.target_audience, j.description, j.requirements,
                   j.reward_amount, j.deadline, j.attachment as job_attachment,
                   DATEDIFF(j.deadline, CURDATE()) as days_left,
                   p.status as payout_status, p.transfer_receipt, p.transferred_at
            FROM freelance_assignments a
            JOIN freelance_jobs j ON a.job_id = j.id
            LEFT JOIN freelance_payouts p ON p.assignment_id = a.id
            $whereSql
            ORDER BY 
                CASE 
                    WHEN a.status = 'revision' THEN 1
                    WHEN a.status IN ('in_progress', 'accepted') THEN 2
                    WHEN a.status = 'submitted' THEN 3
                    ELSE 4
                END,
                j.deadline ASC, a.id DESC
        ";

        $res = $conn->query($query);
        $tasks = [];
        while ($row = $res->fetch_assoc()) {
            $tasks[] = $row;
        }

        echo json_encode(["status" => "success", "tasks" => $tasks]);
        break;

    // 3. GET OPEN JOBS (BURSA LOWONGAN - DAPAT DIAKSES PUBLIK)
    case 'get_jobs':
        $category = $_GET['category'] ?? '';
        $target   = $_GET['target'] ?? '';
        $search   = $_GET['search'] ?? '';

        $where = "WHERE j.status = 'open'";
        if (!empty($category)) {
            $where .= " AND j.category = '" . $conn->real_escape_string($category) . "'";
        }
        if (!empty($target) && $target !== 'semua') {
            $where .= " AND (j.target_audience = 'semua' OR j.target_audience = '" . $conn->real_escape_string($target) . "')";
        }
        if (!empty($search)) {
            $escaped = $conn->real_escape_string($search);
            $where .= " AND (j.title LIKE '%$escaped%' OR j.description LIKE '%$escaped%')";
        }

        $query = "
            SELECT j.*, DATEDIFF(j.deadline, CURDATE()) as days_left,
                   (SELECT COUNT(*) FROM freelance_assignments a WHERE a.job_id = j.id AND a.freelancer_id = $userId) as has_applied,
                   (SELECT a.status FROM freelance_assignments a WHERE a.job_id = j.id AND a.freelancer_id = $userId LIMIT 1) as my_task_status
            FROM freelance_jobs j
            $where
            ORDER BY j.id DESC
        ";

        $res = $conn->query($query);
        $jobs = [];
        while ($row = $res->fetch_assoc()) {
            $jobs[] = $row;
        }

        echo json_encode([
            "status" => "success",
            "is_logged_in" => $isLoggedIn,
            "user_id" => $userId,
            "user_role" => $_SESSION['user_role'] ?? null,
            "jobs" => $jobs
        ]);
        break;

    // 4. APPLY / AMBIL TUGAS PEKERJAAN
    case 'apply_job':
        $jobId = intval($_POST['job_id'] ?? 0);
        $notes = trim($_POST['application_notes'] ?? '');

        if ($jobId <= 0) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Pekerjaan tidak valid."]);
            exit();
        }

        // Cek apakah pekerjaan masih open
        $jStmt = $conn->prepare("SELECT * FROM freelance_jobs WHERE id = ? AND status = 'open'");
        $jStmt->bind_param("i", $jobId);
        $jStmt->execute();
        $job = $jStmt->get_result()->fetch_assoc();
        $jStmt->close();

        if (!$job) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Pekerjaan ini sudah ditutup atau tidak ditemukan."]);
            exit();
        }

        // Cek apakah sudah pernah ambil/apply
        $cStmt = $conn->prepare("SELECT id FROM freelance_assignments WHERE job_id = ? AND freelancer_id = ?");
        $cStmt->bind_param("ii", $jobId, $userId);
        $cStmt->execute();
        $already = $cStmt->get_result()->num_rows;
        $cStmt->close();

        if ($already > 0) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Anda sudah mengambil atau melamar pekerjaan ini."]);
            exit();
        }

        // Masukkan sebagai 'in_progress' agar freelancer bisa langsung mulai kerja
        $status = 'in_progress';
        $ins = $conn->prepare("INSERT INTO freelance_assignments (job_id, freelancer_id, status, application_notes) VALUES (?, ?, ?, ?)");
        $ins->bind_param("iiss", $jobId, $userId, $status, $notes);
        
        if ($ins->execute()) {
            $assignmentId = $ins->insert_id;
            $ins->close();
            echo json_encode([
                "status" => "success",
                "message" => "Pekerjaan berhasil diambil! Selamat mengerjakan tugas.",
                "assignment_id" => $assignmentId
            ]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Gagal mengambil pekerjaan: " . $conn->error]);
        }
        break;

    // 5. SUBMIT TUGAS / HASIL KERJA
    case 'submit_task':
        $assignmentId   = intval($_POST['assignment_id'] ?? 0);
        $submissionLink = trim($_POST['submission_link'] ?? '');
        $submissionNotes = trim($_POST['submission_notes'] ?? '');

        if ($assignmentId <= 0) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "ID Penugasan tidak valid."]);
            exit();
        }

        if (empty($submissionLink) && empty($_FILES['submission_file']['name'])) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Mohon sertakan tautan hasil kerja atau unggah berkas pengerjaan."]);
            exit();
        }

        // Cek kepemilikan assignment
        $check = $conn->query("SELECT * FROM freelance_assignments WHERE id = $assignmentId AND freelancer_id = $userId");
        if ($check->num_rows == 0) {
            http_response_code(403);
            echo json_encode(["status" => "error", "message" => "Tugas ini tidak ditemukan atau bukan milik Anda."]);
            exit();
        }
        $assignment = $check->fetch_assoc();

        $uploadedFilename = $assignment['submission_file'];

        // Handle upload berkas jika ada
        if (!empty($_FILES['submission_file']['name'])) {
            $targetDir = __DIR__ . '/../uploads/freelance_submissions/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $fileExt = strtolower(pathinfo($_FILES['submission_file']['name'], PATHINFO_EXTENSION));
            $allowedExts = ['zip', 'rar', 'pdf', 'doc', 'docx', 'png', 'jpg', 'jpeg', 'txt', 'fig'];

            if (!in_array($fileExt, $allowedExts)) {
                http_response_code(400);
                echo json_encode(["status" => "error", "message" => "Format berkas tidak diizinkan. Gunakan ZIP, PDF, DOC, atau Gambar."]);
                exit();
            }

            $uploadedFilename = 'sub_' . $assignmentId . '_' . time() . '.' . $fileExt;
            $destPath = $targetDir . $uploadedFilename;

            if (!move_uploaded_file($_FILES['submission_file']['tmp_name'], $destPath)) {
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => "Gagal menyimpan berkas yang diunggah."]);
                exit();
            }
        }

        // Update assignment status menjadi 'submitted'
        $stmt = $conn->prepare("
            UPDATE freelance_assignments 
            SET status = 'submitted', 
                submission_link = ?, 
                submission_file = ?, 
                submission_notes = ?, 
                submitted_at = NOW() 
            WHERE id = ? AND freelancer_id = ?
        ");
        $stmt->bind_param("sssii", $submissionLink, $uploadedFilename, $submissionNotes, $assignmentId, $userId);
        
        if ($stmt->execute()) {
            echo json_encode([
                "status" => "success",
                "message" => "Hasil kerja berhasil dikirimkan! Admin akan meninjau hasil kerja Anda."
            ]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Gagal memperbarui status pengajuan: " . $conn->error]);
        }
        $stmt->close();
        break;

    // 6. GET PAYOUTS (RIWAYAT PEMBAYARAN MANUAL)
    case 'get_payouts':
        $query = "
            SELECT p.*, j.title as job_title, j.category, a.approved_at
            FROM freelance_payouts p
            JOIN freelance_assignments a ON p.assignment_id = a.id
            JOIN freelance_jobs j ON a.job_id = j.id
            WHERE p.freelancer_id = $userId
            ORDER BY p.id DESC
        ";
        $res = $conn->query($query);
        $payouts = [];
        $totalPaid = 0;
        $totalPending = 0;

        while ($row = $res->fetch_assoc()) {
            if ($row['status'] === 'transferred') $totalPaid += floatval($row['amount']);
            if ($row['status'] === 'pending') $totalPending += floatval($row['amount']);
            $payouts[] = $row;
        }

        // Ambil info rekening tersimpan
        $uRes = $conn->query("SELECT bank_name, bank_account_number, bank_account_name FROM users WHERE id = $userId")->fetch_assoc();

        echo json_encode([
            "status" => "success",
            "payouts" => $payouts,
            "total_paid" => $totalPaid,
            "total_pending" => $totalPending,
            "bank_account" => $uRes
        ]);
        break;

    // 7. UPDATE PROFILE & REKENING PENCAIRAN
    case 'update_profile':
        $userType  = $_POST['user_type'] ?? 'umum';
        $name      = trim($_POST['name'] ?? '');
        $phone     = trim($_POST['phone'] ?? '');
        $institution = trim($_POST['institution'] ?? '');
        $major     = trim($_POST['major'] ?? '');
        $nim       = trim($_POST['nim'] ?? '');
        $skills    = trim($_POST['skills'] ?? '');
        $bio       = trim($_POST['bio'] ?? '');
        $portfolio = trim($_POST['portfolio_url'] ?? '');
        
        $bankName  = trim($_POST['bank_name'] ?? '');
        $bankNum   = trim($_POST['bank_account_number'] ?? '');
        $bankHolder = trim($_POST['bank_account_name'] ?? '');

        if (empty($name)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Nama lengkap wajib diisi."]);
            exit();
        }

        $stmt = $conn->prepare("
            UPDATE users 
            SET name = ?, phone = ?, user_type = ?, institution = ?, major = ?, nim = ?,
                skills = ?, bio = ?, portfolio_url = ?, 
                bank_name = ?, bank_account_number = ?, bank_account_name = ?
            WHERE id = ?
        ");
        $stmt->bind_param("ssssssssssssi", 
            $name, $phone, $userType, $institution, $major, $nim,
            $skills, $bio, $portfolio,
            $bankName, $bankNum, $bankHolder,
            $userId
        );

        if ($stmt->execute()) {
            $_SESSION['user_name'] = $name;
            $_SESSION['user_type'] = $userType;

            echo json_encode([
                "status" => "success",
                "message" => "Data profil dan rekening pencairan berhasil diperbarui!"
            ]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Gagal memperbarui profil: " . $conn->error]);
        }
        $stmt->close();
        break;

    // 8. GET DETAIL PROFIL
    case 'get_profile':
        $res = $conn->query("SELECT * FROM users WHERE id = $userId");
        if ($res->num_rows > 0) {
            $user = $res->fetch_assoc();
            unset($user['password']);
            echo json_encode(["status" => "success", "user" => $user]);
        } else {
            http_response_code(404);
            echo json_encode(["status" => "error", "message" => "User tidak ditemukan."]);
        }
        break;

    default:
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Action '$action' tidak dikenali."]);
        break;
}

$conn->close();
