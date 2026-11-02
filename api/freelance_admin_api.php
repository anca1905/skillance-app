<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once __DIR__ . '/../config/config.php';

// Verifikasi Sesi Admin / Pencari Jasa
if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(["status" => "error", "message" => "Sesi berakhir. Silakan login kembali."]);
    exit();
}

$currentUserId = intval($_SESSION['user_id']);
$userRole      = $_SESSION['user_role'] ?? '';

// Izinkan admin atau client (pencari jasa)
if ($userRole !== 'admin' && $userRole !== 'client' && $userRole !== 'staff') {
    http_response_code(403);
    echo json_encode(["status" => "error", "message" => "Akses ditolak. Fitur ini khusus Admin atau Pencari Jasa."]);
    exit();
}

$action = $_GET['action'] ?? ($_POST['action'] ?? '');

switch ($action) {

    // 1. GET ADMIN OVERVIEW & STATS
    case 'get_admin_stats':
        $stats = [
            'total_jobs' => 0,
            'active_freelancers' => 0,
            'pending_review' => 0,
            'pending_payouts_count' => 0,
            'pending_payouts_amount' => 0,
            'total_transferred_amount' => 0
        ];

        // Total lowongan
        $r = $conn->query("SELECT COUNT(*) as c FROM freelance_jobs")->fetch_assoc();
        $stats['total_jobs'] = intval($r['c']);

        // Total freelancer terdaftar
        $r = $conn->query("SELECT COUNT(*) as c FROM users WHERE role = 'freelancer'")->fetch_assoc();
        $stats['active_freelancers'] = intval($r['c']);

        // Tugas butuh review
        $r = $conn->query("SELECT COUNT(*) as c FROM freelance_assignments WHERE status = 'submitted'")->fetch_assoc();
        $stats['pending_review'] = intval($r['c']);

        // Antrean pembayaran pending
        $r = $conn->query("SELECT COUNT(*) as c, SUM(amount) as s FROM freelance_payouts WHERE status = 'pending'")->fetch_assoc();
        $stats['pending_payouts_count'] = intval($r['c']);
        $stats['pending_payouts_amount'] = floatval($r['s'] ?? 0);

        // Total telah ditransfer
        $r = $conn->query("SELECT SUM(amount) as s FROM freelance_payouts WHERE status = 'transferred'")->fetch_assoc();
        $stats['total_transferred_amount'] = floatval($r['s'] ?? 0);

        echo json_encode(["status" => "success", "stats" => $stats]);
        break;

    // 2. GET ALL JOBS
    case 'get_all_jobs':
        $query = "
            SELECT j.*, 
                   COUNT(a.id) as total_applicants,
                   SUM(CASE WHEN a.status = 'completed' THEN 1 ELSE 0 END) as completed_count,
                   u.name as creator_name
            FROM freelance_jobs j
            LEFT JOIN freelance_assignments a ON a.job_id = j.id
            LEFT JOIN users u ON u.id = j.client_id
            GROUP BY j.id
            ORDER BY j.id DESC
        ";
        $res = $conn->query($query);
        $jobs = [];
        while ($row = $res->fetch_assoc()) {
            $jobs[] = $row;
        }
        echo json_encode(["status" => "success", "jobs" => $jobs]);
        break;

    // 3. CREATE NEW JOB
    case 'create_job':
        $title       = trim($_POST['title'] ?? '');
        $category    = trim($_POST['category'] ?? '');
        $target      = $_POST['target_audience'] ?? 'semua';
        $desc        = trim($_POST['description'] ?? '');
        $reqs        = trim($_POST['requirements'] ?? '');
        $reward      = floatval($_POST['reward_amount'] ?? 0);
        $deadline    = trim($_POST['deadline'] ?? '');
        $clientId    = $currentUserId;

        if (empty($title) || empty($desc) || $reward <= 0 || empty($deadline)) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Mohon isi semua data lowongan dengan lengkap (Judul, Deskripsi, Budget, Deadline)."]);
            exit();
        }

        // Handle image upload if provided
        $imageName = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $tmpPath = $_FILES['image']['tmp_name'];
            $origName = $_FILES['image']['name'];
            $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION));
            $allowedExts = ['jpg', 'jpeg', 'png', 'webp', 'gif'];

            if (!in_array($ext, $allowedExts)) {
                http_response_code(400);
                echo json_encode(["status" => "error", "message" => "Format gambar tidak didukung. Harap gunakan JPG, PNG, atau WebP."]);
                exit();
            }

            if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
                http_response_code(400);
                echo json_encode(["status" => "error", "message" => "Ukuran gambar terlalu besar (maksimal 5MB)."]);
                exit();
            }

            $uploadDir = __DIR__ . '/../uploads/freelance_jobs/';
            if (!is_dir($uploadDir)) {
                @mkdir($uploadDir, 0775, true);
            }

            // Target extension: convert to JPG or keep PNG for guaranteed WhatsApp & social preview compatibility
            $targetExt = ($ext === 'png') ? 'png' : 'jpg';
            $imageName = 'job_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $targetExt;
            $destPath = $uploadDir . $imageName;

            // Load source image using GD for auto-resizing & format optimization
            $srcImg = null;
            if ($ext === 'jpg' || $ext === 'jpeg') {
                $srcImg = @imagecreatefromjpeg($tmpPath);
            } elseif ($ext === 'png') {
                $srcImg = @imagecreatefrompng($tmpPath);
            } elseif ($ext === 'webp') {
                if (function_exists('imagecreatefromwebp')) {
                    $srcImg = @imagecreatefromwebp($tmpPath);
                }
            } elseif ($ext === 'gif') {
                $srcImg = @imagecreatefromgif($tmpPath);
            }

            if ($srcImg) {
                $origW = imagesx($srcImg);
                $origH = imagesy($srcImg);
                $maxW = 1200;
                if ($origW > $maxW) {
                    $newW = $maxW;
                    $newH = (int)($origH * ($newW / $origW));
                } else {
                    $newW = $origW;
                    $newH = $origH;
                }

                $destImg = imagecreatetruecolor($newW, $newH);

                if ($targetExt === 'png') {
                    imagealphablending($destImg, false);
                    imagesavealpha($destImg, true);
                    $transparent = imagecolorallocatealpha($destImg, 255, 255, 255, 127);
                    imagefilledrectangle($destImg, 0, 0, $newW, $newH, $transparent);
                    imagecopyresampled($destImg, $srcImg, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
                    imagepng($destImg, $destPath, 8);
                } else {
                    // Fill white background in case source had alpha transparency
                    $white = imagecolorallocate($destImg, 255, 255, 255);
                    imagefilledrectangle($destImg, 0, 0, $newW, $newH, $white);
                    imagecopyresampled($destImg, $srcImg, 0, 0, 0, 0, $newW, $newH, $origW, $origH);
                    imagejpeg($destImg, $destPath, 85);
                }

                imagedestroy($srcImg);
                imagedestroy($destImg);
            } else {
                // Fallback direct move if GD load failed
                $imageName = 'job_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $ext;
                $destPath = $uploadDir . $imageName;
                if (!move_uploaded_file($tmpPath, $destPath)) {
                    $imageName = null;
                }
            }
        }

        $stmt = $conn->prepare("
            INSERT INTO freelance_jobs (client_id, title, category, target_audience, description, requirements, reward_amount, deadline, status, image)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'open', ?)
        ");
        $stmt->bind_param("isssssdss", $clientId, $title, $category, $target, $desc, $reqs, $reward, $deadline, $imageName);

        if ($stmt->execute()) {
            echo json_encode([
                "status" => "success",
                "message" => "Lowongan freelance baru berhasil diterbitkan!",
                "job_id" => $stmt->insert_id,
                "image" => $imageName
            ]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Gagal membuat lowongan: " . $conn->error]);
        }
        $stmt->close();
        break;

    // 4. UPDATE JOB STATUS
    case 'update_job_status':
        $jobId  = intval($_POST['job_id'] ?? 0);
        $status = $_POST['status'] ?? 'open';

        if (!in_array($status, ['open', 'in_progress', 'completed', 'closed'])) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Status tidak valid."]);
            exit();
        }

        $stmt = $conn->prepare("UPDATE freelance_jobs SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $jobId);
        $stmt->execute();
        $stmt->close();

        echo json_encode(["status" => "success", "message" => "Status lowongan diperbarui!"]);
        break;

    // 4.1 DELETE JOB
    case 'delete_job':
        $jobId = intval($_POST['job_id'] ?? 0);

        if ($jobId <= 0) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "ID Lowongan tidak valid."]);
            exit();
        }

        // Cek apakah ada tugas yang sudah dibayar/selesai
        $chk = $conn->query("SELECT COUNT(*) as cnt FROM freelance_assignments WHERE job_id = $jobId AND status = 'completed'");
        $cnt = intval($chk->fetch_assoc()['cnt'] ?? 0);
        if ($cnt > 0) {
            http_response_code(400);
            echo json_encode([
                "status" => "error", 
                "message" => "Lowongan ini memiliki tugas yang sudah selesai dan masuk laporan keuangan. Sebaiknya ubah statusnya menjadi 'Closed' agar riwayat keuangan tetap utuh."
            ]);
            exit();
        }

        // Hapus file gambar jika ada
        $imgRes = $conn->query("SELECT image FROM freelance_jobs WHERE id = $jobId");
        if ($imgRow = $imgRes->fetch_assoc()) {
            if (!empty($imgRow['image'])) {
                $imgPath = __DIR__ . '/../uploads/freelance_jobs/' . $imgRow['image'];
                if (file_exists($imgPath)) {
                    @unlink($imgPath);
                }
            }
        }

        // Hapus penugasan terkait
        $conn->query("DELETE FROM freelance_assignments WHERE job_id = $jobId");

        // Hapus pekerjaan
        $delStmt = $conn->prepare("DELETE FROM freelance_jobs WHERE id = ?");
        $delStmt->bind_param("i", $jobId);
        if ($delStmt->execute()) {
            echo json_encode(["status" => "success", "message" => "Lowongan berhasil dihapus dari sistem."]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Gagal menghapus lowongan: " . $conn->error]);
        }
        $delStmt->close();
        break;

    // 5. GET ALL SUBMISSIONS & TASKS FOR REVIEW
    case 'get_submissions':
        $filterStatus = $_GET['status'] ?? '';
        $whereSql = "WHERE 1=1";
        if (!empty($filterStatus)) {
            $whereSql .= " AND a.status = '" . $conn->real_escape_string($filterStatus) . "'";
        }

        $query = "
            SELECT a.*, 
                   j.title as job_title, j.category as job_category, j.reward_amount, j.deadline,
                   u.name as freelancer_name, u.email as freelancer_email, u.phone as freelancer_phone,
                   u.photo as freelancer_photo, u.user_type, u.institution, u.major, u.nim,
                   u.bank_name, u.bank_account_number, u.bank_account_name,
                   p.id as payout_id, p.status as payout_status, p.transfer_receipt
            FROM freelance_assignments a
            JOIN freelance_jobs j ON a.job_id = j.id
            JOIN users u ON a.freelancer_id = u.id
            LEFT JOIN freelance_payouts p ON p.assignment_id = a.id
            $whereSql
            ORDER BY 
                CASE WHEN a.status = 'submitted' THEN 1 WHEN a.status = 'revision' THEN 2 ELSE 3 END,
                a.submitted_at DESC, a.id DESC
        ";
        $res = $conn->query($query);
        $submissions = [];
        while ($row = $res->fetch_assoc()) {
            $submissions[] = $row;
        }

        echo json_encode(["status" => "success", "submissions" => $submissions]);
        break;

    // 6. REVIEW SUBMISSION (APPROVE / REVISION)
    case 'review_submission':
        $assignmentId = intval($_POST['assignment_id'] ?? 0);
        $decision     = $_POST['decision'] ?? ''; // 'approve' or 'revision'
        $feedback     = trim($_POST['feedback'] ?? '');

        if ($assignmentId <= 0 || !in_array($decision, ['approve', 'revision'])) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "Data review tidak valid."]);
            exit();
        }

        // Ambil data penugasan
        $aRes = $conn->query("
            SELECT a.*, j.reward_amount, j.id as job_id,
                   u.bank_name, u.bank_account_number, u.bank_account_name
            FROM freelance_assignments a
            JOIN freelance_jobs j ON a.job_id = j.id
            JOIN users u ON a.freelancer_id = u.id
            WHERE a.id = $assignmentId
        ");

        if ($aRes->num_rows == 0) {
            http_response_code(404);
            echo json_encode(["status" => "error", "message" => "Penugasan tidak ditemukan."]);
            exit();
        }
        $assignment = $aRes->fetch_assoc();
        $freelancerId = $assignment['freelancer_id'];
        $amount = $assignment['reward_amount'];

        if ($decision === 'approve') {
            // 1. Update status tugas menjadi 'completed'
            $stmt = $conn->prepare("UPDATE freelance_assignments SET status = 'completed', approved_at = NOW(), review = ? WHERE id = ?");
            $reviewNote = !empty($feedback) ? $feedback : "Hasil kerja disetujui dengan baik.";
            $stmt->bind_param("si", $reviewNote, $assignmentId);
            $stmt->execute();
            $stmt->close();

            // 2. Cek apakah record payout sudah pernah dibuat sebelumnya
            $pCheck = $conn->query("SELECT id FROM freelance_payouts WHERE assignment_id = $assignmentId");
            if ($pCheck->num_rows == 0) {
                // Buat antrean pembayaran manual
                $bankName   = !empty($assignment['bank_name']) ? $assignment['bank_name'] : 'Belum diisi';
                $bankAccNum = !empty($assignment['bank_account_number']) ? $assignment['bank_account_number'] : '-';
                $bankHolder = !empty($assignment['bank_account_name']) ? $assignment['bank_account_name'] : $assignment['freelancer_id'];

                $pStmt = $conn->prepare("
                    INSERT INTO freelance_payouts (assignment_id, freelancer_id, amount, bank_name, account_number, account_name, status)
                    VALUES (?, ?, ?, ?, ?, ?, 'pending')
                ");
                $pStmt->bind_param("iidsss", $assignmentId, $freelancerId, $amount, $bankName, $bankAccNum, $bankHolder);
                $pStmt->execute();
                $pStmt->close();
            }

            echo json_encode([
                "status" => "success",
                "message" => "Hasil kerja disetujui! Tugas selesai dan telah masuk ke Antrean Pembayaran Manual."
            ]);

        } else {
            // Minta Revisi
            if (empty($feedback)) {
                http_response_code(400);
                echo json_encode(["status" => "error", "message" => "Mohon sertakan catatan revisi agar freelancer tahu bagian mana yang perlu diperbaiki."]);
                exit();
            }

            $stmt = $conn->prepare("UPDATE freelance_assignments SET status = 'revision', revision_feedback = ? WHERE id = ?");
            $stmt->bind_param("si", $feedback, $assignmentId);
            $stmt->execute();
            $stmt->close();

            echo json_encode([
                "status" => "success",
                "message" => "Permintaan revisi berhasil dikirimkan ke Freelancer."
            ]);
        }
        break;

    // 7. GET PAYOUT QUEUE (DAFTAR PEMBAYARAN MANUAL)
    case 'get_payouts':
        $query = "
            SELECT p.*, 
                   j.title as job_title, j.category as job_category,
                   u.name as freelancer_name, u.email as freelancer_email, u.phone as freelancer_phone,
                   u.user_type, u.institution,
                   a.approved_at, a.submission_link, a.submission_file
            FROM freelance_payouts p
            JOIN freelance_assignments a ON p.assignment_id = a.id
            JOIN freelance_jobs j ON a.job_id = j.id
            JOIN users u ON p.freelancer_id = u.id
            ORDER BY 
                CASE WHEN p.status = 'pending' THEN 1 ELSE 2 END,
                p.id DESC
        ";
        $res = $conn->query($query);
        $payouts = [];
        while ($row = $res->fetch_assoc()) {
            $payouts[] = $row;
        }

        echo json_encode(["status" => "success", "payouts" => $payouts]);
        break;

    // 8. KONFIRMASI TRANSFER MANUAL SELESAI
    case 'confirm_payout':
        $payoutId      = intval($_POST['payout_id'] ?? 0);
        $transferNotes = trim($_POST['transfer_notes'] ?? '');

        if ($payoutId <= 0) {
            http_response_code(400);
            echo json_encode(["status" => "error", "message" => "ID Pembayaran tidak valid."]);
            exit();
        }

        $receiptFilename = null;

        // Upload bukti transfer jika ada
        if (!empty($_FILES['transfer_receipt']['name'])) {
            $targetDir = __DIR__ . '/../uploads/transfer_receipts/';
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $fileExt = strtolower(pathinfo($_FILES['transfer_receipt']['name'], PATHINFO_EXTENSION));
            $allowedExts = ['jpg', 'jpeg', 'png', 'pdf', 'webp'];

            if (!in_array($fileExt, $allowedExts)) {
                http_response_code(400);
                echo json_encode(["status" => "error", "message" => "Format bukti transfer harus Gambar (JPG/PNG) atau PDF."]);
                exit();
            }

            $receiptFilename = 'receipt_' . $payoutId . '_' . time() . '.' . $fileExt;
            $destPath = $targetDir . $receiptFilename;

            if (!move_uploaded_file($_FILES['transfer_receipt']['tmp_name'], $destPath)) {
                http_response_code(500);
                echo json_encode(["status" => "error", "message" => "Gagal mengunggah berkas bukti transfer."]);
                exit();
            }
        }

        $stmt = $conn->prepare("
            UPDATE freelance_payouts 
            SET status = 'transferred', 
                transfer_receipt = IFNULL(?, transfer_receipt), 
                transfer_notes = ?, 
                transferred_at = NOW() 
            WHERE id = ?
        ");
        $stmt->bind_param("ssi", $receiptFilename, $transferNotes, $payoutId);

        if ($stmt->execute()) {
            echo json_encode([
                "status" => "success",
                "message" => "Pembayaran manual berhasil dikonfirmasi! Status di dashboard freelancer langsung berubah menjadi 'Ditransfer'."
            ]);
        } else {
            http_response_code(500);
            echo json_encode(["status" => "error", "message" => "Gagal menyimpan konfirmasi: " . $conn->error]);
        }
        $stmt->close();
        break;

    default:
        http_response_code(400);
        echo json_encode(["status" => "error", "message" => "Aksi tidak dikenali."]);
        break;
}

$conn->close();
