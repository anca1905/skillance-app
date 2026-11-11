<?php
session_start();
require_once __DIR__ . '/config/config.php';

$examQuestionsData = require __DIR__ . '/data/exam_questions.php';

// Session user data if logged in
$isLoggedIn = !empty($_SESSION['user_id']);
$defaultName = $_SESSION['user_name'] ?? '';
$defaultEmail = $_SESSION['user_email'] ?? '';
$userId = $_SESSION['user_id'] ?? null;

$action = $_POST['action'] ?? $_GET['action'] ?? 'welcome';
$trackKey = $_POST['track'] ?? $_GET['track'] ?? 'html';
if (!array_key_exists($trackKey, $examQuestionsData)) {
    $trackKey = 'html';
}

$trackInfo = $examQuestionsData[$trackKey];
$resultData = null;
$errorMsg = '';
$paymentNotice = '';

// Allowed instant access demo / student vouchers
$validVouchers = ['MAHASISWA', 'SKILLANCE2026', 'DEMO19K', 'SOLOLEARN', 'SKPI2026', 'GRATISUJIAN'];

// Separate tracks into Modular Courses (SoloLearn Style) and Career Tracks
$modularCourseTracks = [];
$careerTracks = [];
foreach ($examQuestionsData as $k => $info) {
    if (($info['type'] ?? 'course') === 'course') {
        $modularCourseTracks[$k] = $info;
    } else {
        $careerTracks[$k] = $info;
    }
}

// Check user verified orders in database (auto link & unlock for logged in student)
$userVerifiedTracks = [];
if ($isLoggedIn && $conn) {
    $uIdSafe = intval($userId);
    $uNameSafe = $conn->real_escape_string($defaultName);
    $uEmailSafe = $conn->real_escape_string($defaultEmail);

    $resVo = $conn->query("
        SELECT invoice_no, product_id, product_title 
        FROM academy_orders 
        WHERE status = 'verified' 
          AND (
              user_id = $uIdSafe
              OR LOWER(TRIM(buyer_name)) = LOWER(TRIM('$uNameSafe'))
              " . (!empty($uEmailSafe) ? "OR buyer_email = '$uEmailSafe'" : "") . "
          )
    ");
    if ($resVo) {
        while ($voRow = $resVo->fetch_assoc()) {
            $pId = $voRow['product_id'];
            $cKey = str_replace('cert_', '', $pId);
            if ($cKey === 'js') $cKey = 'javascript';
            $userVerifiedTracks[$cKey] = $voRow['invoice_no'];
            $userVerifiedTracks[$pId] = $voRow['invoice_no'];
            if (!isset($_SESSION['unlocked_tracks'])) {
                $_SESSION['unlocked_tracks'] = [];
            }
            $_SESSION['unlocked_tracks'][$cKey] = true;
            $_SESSION['unlocked_tracks'][$pId] = true;
        }
    }
}

// =========================================================================
// ACTION: START EXAM (VERIFY PAYMENT / VOUCHER GATE)
// =========================================================================
if ($action === 'start_exam') {
    $recipientName = trim($_POST['recipient_name'] ?? $_GET['recipient_name'] ?? $defaultName);
    $recipientEmail = trim($_POST['recipient_email'] ?? $_GET['recipient_email'] ?? $defaultEmail);
    $invoiceNo = strtoupper(trim($_POST['invoice_no'] ?? $_GET['invoice_no'] ?? ''));
    $voucherCode = strtoupper(trim($_POST['voucher_code'] ?? $_GET['voucher_code'] ?? ''));

    if (empty($recipientName)) {
        $recipientName = $defaultName ?: 'Peserta Skillance Academy';
    }

    $isUnlocked = false;

    // 1. Check Voucher Code
    if (!empty($voucherCode) && in_array($voucherCode, $validVouchers)) {
        $isUnlocked = true;
        $_SESSION['unlocked_tracks'][$trackKey] = true;
    }

    // 2. Check Session Cache
    if (!empty($_SESSION['unlocked_tracks'][$trackKey])) {
        $isUnlocked = true;
    }

    // 2b. Check User Verified Orders in Database
    if (!$isUnlocked && !empty($userVerifiedTracks[$trackKey])) {
        $isUnlocked = true;
        $_SESSION['unlocked_tracks'][$trackKey] = true;
        if (empty($invoiceNo)) {
            $invoiceNo = $userVerifiedTracks[$trackKey];
        }
    }

    // 3. Check Invoice Status in Database
    if (!$isUnlocked && !empty($invoiceNo) && $conn) {
        $invSafe = $conn->real_escape_string($invoiceNo);
        $chkOrder = $conn->query("SELECT * FROM academy_orders WHERE invoice_no = '$invSafe' LIMIT 1");
        if ($chkOrder && $orderRow = $chkOrder->fetch_assoc()) {
            if ($orderRow['status'] === 'verified') {
                $isUnlocked = true;
                $_SESSION['unlocked_tracks'][$trackKey] = true;
            } else {
                $errorMsg = "Nomor Invoice <strong>" . htmlspecialchars($invoiceNo) . "</strong> berstatus <em>PENDING</em> (Menunggu konfirmasi admin 1x24 jam). Jika Anda telah transfer, silakan konfirmasi ke WhatsApp Admin atau gunakan Kode Voucher Mahasiswa.";
                $action = 'welcome';
            }
        } else {
            // Check if invoice matches pattern INV-2026-CERT-
            if (strpos($invoiceNo, 'INV-2026-CERT-') === 0) {
                // Auto register pending invoice if not yet in DB
                $tPrice = intval($trackInfo['price'] ?? 19000);
                $pTitle = $trackInfo['title'];
                $stmt = $conn->prepare("INSERT IGNORE INTO academy_orders (invoice_no, product_id, product_title, nominal, buyer_name, status) VALUES (?, ?, ?, ?, ?, 'pending')");
                if ($stmt) {
                    $pid = 'cert_' . $trackKey;
                    $stmt->bind_param("sssis", $invoiceNo, $pid, $pTitle, $tPrice, $recipientName);
                    $stmt->execute();
                    $stmt->close();
                }
                $errorMsg = "Nomor Invoice <strong>" . htmlspecialchars($invoiceNo) . "</strong> baru saja tercatat dan sedang dalam antrean verifikasi Admin (1x24 Jam). Silakan kirimkan bukti bayar ke WA Admin atau masukkan Voucher Mahasiswa untuk akses instan.";
                $action = 'welcome';
            } else {
                $errorMsg = "Nomor Invoice atau Kode Voucher <strong>" . htmlspecialchars($invoiceNo) . "</strong> tidak valid.";
                $action = 'welcome';
            }
        }
    }

    // If still not unlocked and user directly navigated, show payment gate
    if (!$isUnlocked && empty($errorMsg)) {
        // If track has a price and no unlock provided, route back to welcome with selection
        $action = 'welcome';
        $paymentNotice = 'Silakan lakukan pembayaran administrasi ujian via QRIS atau gunakan Kode Voucher Mahasiswa di bawah ini.';
    }
}

// =========================================================================
// ACTION: SUBMIT EXAM & GENERATE OFFICIAL CERTIFICATE
// =========================================================================
if (($_SERVER['REQUEST_METHOD'] ?? 'GET') === 'POST' && $action === 'submit_exam') {
    $recipientName = trim($_POST['recipient_name'] ?? '');
    $recipientEmail = trim($_POST['recipient_email'] ?? '');
    $submittedAnswers = $_POST['answers'] ?? [];

    if (empty($recipientName)) {
        $recipientName = $defaultName ?: 'Peserta Skillance Academy';
    }

    $allQuestions = $trackInfo['questions'];
    $totalQuestions = count($allQuestions);
    $correctCount = 0;
    $breakdown = [];

    foreach ($allQuestions as $qIdx => $q) {
        $userAns = isset($submittedAnswers[$qIdx]) ? (int)$submittedAnswers[$qIdx] : -1;
        $isCorrect = ($userAns === (int)$q['ans']);
        if ($isCorrect) {
            $correctCount++;
        }
        $breakdown[] = [
            'q' => $q['q'],
            'options' => $q['options'],
            'user_ans' => $userAns,
            'correct_ans' => (int)$q['ans'],
            'is_correct' => $isCorrect,
            'exp' => $q['exp']
        ];
    }

    $finalScore = ($totalQuestions > 0) ? round(($correctCount / $totalQuestions) * 100) : 0;
    $passingThreshold = $trackInfo['passing_score'] ?? 70;
    $passed = ($finalScore >= $passingThreshold);
    $certificateNo = '';

    // If passed, issue official digital certificate into database
    if ($passed) {
        // Generate unique certificate serial e.g. SKL-2026-HTML-8821
        $trackCode = $trackInfo['code'] ?? 'SKL';
        $randomNum = rand(1000, 9999);
        $certificateNo = 'SKL-2026-' . $trackCode . '-' . $randomNum;

        if ($conn) {
            // Check uniqueness
            $chk = $conn->prepare("SELECT id FROM `academy_certificates` WHERE `certificate_no` = ? LIMIT 1");
            if ($chk) {
                $chk->bind_param('s', $certificateNo);
                $chk->execute();
                if ($chk->get_result()->num_rows > 0) {
                    $certificateNo = 'SKL-2026-' . $trackCode . '-' . rand(10000, 99999);
                }
                $chk->close();
            }

            // Insert certificate
            $issueDate = date('Y-m-d');
            $status = 'active';
            $ins = $conn->prepare("INSERT INTO `academy_certificates` 
                (`certificate_no`, `user_id`, `recipient_name`, `recipient_email`, `track_id`, `track_title`, `competencies`, `score`, `issue_date`, `status`)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            if ($ins) {
                $ins->bind_param('sisssssiss', 
                    $certificateNo, 
                    $userId, 
                    $recipientName, 
                    $recipientEmail, 
                    $trackKey, 
                    $trackInfo['title'], 
                    $trackInfo['competencies'], 
                    $finalScore, 
                    $issueDate, 
                    $status
                );
                $ins->execute();
                $ins->close();
            }
        }
    }

    $resultData = [
        'passed' => $passed,
        'score' => $finalScore,
        'correct' => $correctCount,
        'total' => $totalQuestions,
        'certificate_no' => $certificateNo,
        'recipient_name' => $recipientName,
        'track_title' => $trackInfo['title'],
        'passing_score' => $passingThreshold,
        'breakdown' => $breakdown
    ];
}

// Master SEO Configuration
$seoTitle = 'Ujian Sertifikasi Kompetensi Resmi SoloLearn-Style - Skillance Academy';
$seoDesc = 'Ujian evaluasi koding interaktif untuk menerbitkan Sertifikat Kelulusan Resmi ber-QR Code untuk portofolio SKPI mahasiswa dan pencari kerja profesional.';
$seoKeywords = 'ujian koding online, sertifikat skpi koding, tes kompetensi web developer, sertifikasi flutter, skillance academy exam';
$seoOgImage = 'https://academy.skillance.cloud/assets/img/og-exam.png';
$seoCanonical = 'https://academy.skillance.cloud/exam.php';
$seoType = 'website';
$seoBreadcrumbs = [
    ['name' => 'Beranda', 'url' => 'https://academy.skillance.cloud/index.php'],
    ['name' => 'Ujian Sertifikasi SKPI', 'url' => 'https://academy.skillance.cloud/exam.php']
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- MASTER ENTERPRISE SEO & OPEN GRAPH -->
    <?php include __DIR__ . '/includes/seo_meta.php'; ?>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cinzel:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    
    <style>
        :root {
            --navy: #0d2e5c;
            --navy-dark: #071a35;
            --gold: #fca311;
            --gold-hover: #e5930e;
            --w3-green: #04AA6D;
            --w3-green-hover: #038d5a;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }

        .font-heading {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
        }

        /* Top Bar */
        .top-hub-bar {
            background-color: var(--navy-dark);
            color: #cbd5e1;
            font-size: 0.78rem;
            padding: 7px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* Academy Navbar */
        .academy-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .nav-menu-link {
            color: #475569;
            font-weight: 600;
            font-size: 0.88rem;
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .nav-menu-link:hover, .nav-menu-link.active {
            color: #0d2e5c;
            font-weight: 700;
            background-color: #f1f5f9;
        }

        /* Exam Hero */
        .exam-hero {
            background: linear-gradient(135deg, #071a35 0%, #0d2e5c 60%, #00758f 100%);
            color: white;
            padding: 45px 0 35px;
            text-align: center;
            border-bottom: 3px solid var(--gold);
        }

        .exam-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
            padding: 28px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        }

        /* Course Radio Card */
        .track-selector-card {
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            padding: 16px;
            cursor: pointer;
            transition: all 0.2s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            background: #ffffff;
        }

        .track-selector-card:hover {
            border-color: #fca311;
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(13, 46, 92, 0.08);
        }

        .track-selector-card.selected {
            border-color: #0d2e5c;
            background: #f0f7ff;
            box-shadow: 0 0 0 3px rgba(13, 46, 92, 0.15);
        }

        .track-radio-input {
            position: absolute;
            top: 14px;
            right: 14px;
            accent-color: #0d2e5c;
            width: 18px;
            height: 18px;
        }

        /* Nav Pills Modern */
        .nav-pills-custom .nav-link {
            color: #475569;
            font-weight: 700;
            border-radius: 50px;
            padding: 10px 22px;
            font-size: 0.92rem;
            transition: all 0.2s ease;
        }
        .nav-pills-custom .nav-link.active {
            background-color: #0d2e5c;
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(13, 46, 92, 0.25);
        }

        /* QRIS Gateway Card */
        .qris-box {
            background: #ffffff;
            border: 2px dashed #0d2e5c;
            border-radius: 16px;
            padding: 24px;
            text-align: center;
        }

        /* Question Options */
        .option-label {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 18px;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.15s ease;
            background: #ffffff;
        }
        .option-label:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }
        .option-label.selected {
            background: #eff6ff;
            border-color: #3b82f6;
            color: #1e3a8a;
            font-weight: 600;
        }
        .option-radio {
            accent-color: #2563eb;
            margin-top: 4px;
            width: 17px;
            height: 17px;
        }

        /* Number Grid Navigation */
        .q-number-btn {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            font-size: 0.85rem;
            font-weight: 700;
            border: 2px solid #e2e8f0;
            background: #ffffff;
            color: #475569;
            transition: all 0.15s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .q-number-btn:hover {
            border-color: #94a3b8;
        }
        .q-number-btn.answered {
            background-color: #04AA6D;
            color: #ffffff;
            border-color: #04AA6D;
        }
        .q-number-btn.active {
            border-color: #fca311;
            box-shadow: 0 0 0 2px #fca311;
        }

        /* Sticky Timer Bar */
        .exam-timer-bar {
            background: var(--navy-dark);
            color: white;
            padding: 12px 20px;
            border-radius: 12px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 70px;
            z-index: 1010;
            box-shadow: 0 4px 15px rgba(0,0,0,0.15);
        }

        .timer-display {
            font-size: 1.35rem;
            font-weight: 800;
            color: #fca311;
            letter-spacing: 1px;
            font-family: monospace;
        }

        .timer-warning {
            color: #ef4444 !important;
            animation: pulseWarning 1s infinite;
        }
        @keyframes pulseWarning {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* Success & Passed Card */
        .pass-hero-card {
            background: linear-gradient(135deg, #071a35 0%, #0d2e5c 60%, #04AA6D 100%);
            color: white;
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(4, 170, 109, 0.2);
        }
    </style>
</head>
<body>

    <?php
    $activeNav = 'exam';
    $showSubnav = false;
    include __DIR__ . '/includes/navbar.php';
    ?>

    <!-- ========================================== -->
    <!-- STATE 1: WELCOME & TRACK SELECTION -->
    <!-- ========================================== -->
    <?php if ($action === 'welcome' && !$resultData): 
        // Unique random invoice for payment checkout
        $generatedInv = 'INV-2026-CERT-' . rand(1000, 9999);
    ?>
        <header class="exam-hero">
            <div class="container">
                <span class="badge bg-white bg-opacity-10 text-gold px-3 py-2 rounded-pill fw-bold mb-3 border border-warning border-opacity-25" style="color: #fca311;">
                    <i class="fa-solid fa-graduation-cap me-1"></i> Standar SoloLearn & Portofolio SKPI Kampus
                </span>
                <h1 class="display-6 fw-bold font-heading mb-3 text-white">Ujian Kelulusan & Sertifikasi Digital Resmi</h1>
                <p class="lead mx-auto mb-3" style="max-width: 760px; color: #cbd5e1; font-size: 1rem; line-height: 1.8;">
                    Materi pembelajaran koding di Skillance Academy <strong>100% Gratis</strong>. Setelah memahami materi, Anda dapat mengikuti <strong>Ujian Evaluasi Berstandar Industri</strong> dan menerbitkan <strong>Sertifikat Digital Ber-QR Code Resmi</strong> yang terverifikasi publik seumur hidup di <code>verify.php</code>.
                </p>
                <div class="d-inline-flex align-items-center gap-2 bg-white bg-opacity-10 px-3 py-2 rounded-pill small text-warning border border-warning border-opacity-25">
                    <i class="fa-solid fa-circle-check"></i> <span>Biaya Terjangkau Khusus Mahasiswa: <strong>Rp 19.000</strong> per materi (Diskon 60%)</span>
                </div>
            </div>
        </header>

        <main class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">

                    <?php if (!empty($errorMsg)): ?>
                        <div class="alert alert-danger rounded-4 p-3 mb-4 shadow-sm d-flex align-items-center gap-3">
                            <i class="fa-solid fa-circle-exclamation fs-3 text-danger"></i>
                            <div><?= $errorMsg ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($paymentNotice)): ?>
                        <div class="alert alert-warning rounded-4 p-3 mb-4 shadow-sm d-flex align-items-center gap-3">
                            <i class="fa-solid fa-bell fs-3 text-warning"></i>
                            <div><?= htmlspecialchars($paymentNotice) ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($userVerifiedTracks[$trackKey])): ?>
                        <div class="alert alert-success border-0 rounded-4 p-3 mb-4 shadow-sm d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <i class="fa-solid fa-circle-check fs-2 text-success"></i>
                                <div>
                                    <strong class="d-block text-navy">Akses Ujian & Sertifikasi Telah Terverifikasi!</strong>
                                    <span class="small text-muted">Invoice <strong><?= htmlspecialchars($userVerifiedTracks[$trackKey]) ?></strong> telah lunas & disetujui Admin. Anda dapat langsung mengerjakan ujian evaluasi sekarang.</span>
                                </div>
                            </div>
                            <a href="exam.php?action=start_exam&track=<?= urlencode($trackKey) ?>&invoice_no=<?= urlencode($userVerifiedTracks[$trackKey]) ?>&recipient_name=<?= urlencode($defaultName) ?>" class="btn btn-success fw-bold px-4 py-2 rounded-pill shadow-sm" style="background-color: #04AA6D !important;">
                                <i class="fa-solid fa-play me-1"></i> Mulai Ujian Sekarang &raquo;
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- TRYOUT KILAT BANNER (FEATURE PEMANASAN) -->
                    <div class="card border-0 rounded-4 shadow-sm mb-5 p-4 text-white overflow-hidden position-relative" style="background: linear-gradient(135deg, #0d2e5c 0%, #1e3a8a 100%); border-left: 5px solid #fca311 !important;">
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                            <div>
                                <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold mb-2 small shadow-sm">
                                    <i class="fa-solid fa-bolt me-1 text-danger"></i> PEMANASAN UJIAN CEPAT
                                </span>
                                <h4 class="fw-bold mb-1 text-white">Simulasi Tryout Kilat 5 Soal (2 Menit)</h4>
                                <p class="text-white-50 small mb-0" style="max-width: 520px; line-height: 1.6;">
                                    Ingin uji kemampuan awal secara gratis sebelum ujian sertifikasi? Kerjakan 5 soal interaktif kilat dengan pembahasan kunci jawaban instan dan peroleh <strong>+30 XP</strong>!
                                </p>
                            </div>
                            <button type="button" class="btn btn-warning text-navy fw-bold px-4 py-3 rounded-pill shadow-sm align-self-start align-self-md-center flex-shrink-0" onclick="openQuickTryoutModal()" style="font-size: 0.95rem; background-color: #fca311 !important; color: #071a35 !important;">
                                <i class="fa-solid fa-play me-1"></i> Mulai Tryout Kilat &raquo;
                            </button>
                        </div>
                    </div>

                    <!-- STEP 1 & 2: KATALOG SERTIFIKASI & PEMBAYARAN -->
                    <div class="exam-card mb-5">
                        
                        <!-- TAB NAVIGASI KATALOG -->
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 pb-3 border-bottom">
                            <div>
                                <h4 class="fw-bold text-navy font-heading mb-1">
                                    <i class="fa-solid fa-award text-warning me-2"></i> Pilih Materi Ujian & Sertifikat
                                </h4>
                                <small class="text-muted">Pilih sertifikat spesifik per-materi (Gaya SoloLearn) atau Jalur Karir Komprehensif:</small>
                            </div>

                            <ul class="nav nav-pills nav-pills-custom" id="trackTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="tab-course-btn" data-bs-toggle="pill" data-bs-target="#tab-course-pane" type="button" role="tab">
                                        <i class="fa-solid fa-graduation-cap me-1 text-warning"></i> Per Materi (SoloLearn - Rp 19rb)
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="tab-career-btn" data-bs-toggle="pill" data-bs-target="#tab-career-pane" type="button" role="tab">
                                        <i class="fa-solid fa-briefcase me-1"></i> Jalur Karir (Rp 29rb - 35rb)
                                    </button>
                                </li>
                            </ul>
                        </div>

                        <!-- TAB CONTENT -->
                        <div class="tab-content mb-4" id="trackTabsContent">
                            
                            <!-- TAB 1: MODULAR COURSE TRACKS (SOLOLEARN STYLE) -->
                            <div class="tab-pane fade show active" id="tab-course-pane" role="tabpanel">
                                <div class="row g-3">
                                    <?php foreach ($modularCourseTracks as $k => $info): 
                                        $isModVerified = !empty($userVerifiedTracks[$k]);
                                    ?>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="track-selector-card <?= ($k === $trackKey) ? 'selected' : '' ?> <?= $isModVerified ? 'border-success' : '' ?>" onclick="selectTrack('<?= $k ?>', '<?= htmlspecialchars(addslashes($info['title'])) ?>', <?= $info['price'] ?>, '<?= $info['code'] ?>', <?= $info['duration_minutes'] ?>, <?= count($info['questions']) ?>, this)">
                                                <input type="radio" name="track_choice" value="<?= $k ?>" class="track-radio-input" <?= ($k === $trackKey) ? 'checked' : '' ?>>
                                                <div>
                                                    <div class="d-flex justify-content-between align-items-center mb-2 pe-4">
                                                        <span class="badge bg-navy text-white px-2 py-1 rounded small" style="background-color: #0d2e5c; font-size: 0.72rem;"><?= $info['code'] ?></span>
                                                        <?php if ($isModVerified): ?>
                                                            <span class="badge bg-success rounded-pill small"><i class="fa-solid fa-circle-check me-1"></i> TERVERIFIKASI</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-danger rounded-pill small">HEMAT 60%</span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <h6 class="fw-bold text-navy mb-1" style="font-size: 0.95rem; line-height: 1.4;"><?= htmlspecialchars($info['title']) ?></h6>
                                                    <p class="text-muted small mb-2" style="font-size: 0.74rem; line-height: 1.5;"><?= htmlspecialchars($info['competencies']) ?></p>
                                                </div>
                                                <div class="pt-2 border-top mt-2 d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <small class="text-muted text-decoration-line-through" style="font-size: 0.72rem;">Rp <?= number_format($info['original_price'], 0, ',', '.') ?></small>
                                                        <div class="fw-bold text-warning" style="font-size: 0.95rem; color: #d97706 !important;">Rp <?= number_format($info['price'], 0, ',', '.') ?></div>
                                                    </div>
                                                    <span class="small text-secondary" style="font-size: 0.74rem;"><i class="fa-regular fa-clock me-1"></i> <?= $info['duration_minutes'] ?>m / 10 Soal</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- TAB 2: CAREER TRACKS -->
                            <div class="tab-pane fade" id="tab-career-pane" role="tabpanel">
                                <div class="row g-3">
                                    <?php foreach ($careerTracks as $k => $info): 
                                        $isCarVerified = !empty($userVerifiedTracks[$k]);
                                    ?>
                                        <div class="col-md-6">
                                            <div class="track-selector-card <?= ($k === $trackKey) ? 'selected' : '' ?> <?= $isCarVerified ? 'border-success' : '' ?>" onclick="selectTrack('<?= $k ?>', '<?= htmlspecialchars(addslashes($info['title'])) ?>', <?= $info['price'] ?>, '<?= $info['code'] ?>', <?= $info['duration_minutes'] ?>, <?= count($info['questions']) ?>, this)">
                                                <input type="radio" name="track_choice" value="<?= $k ?>" class="track-radio-input" <?= ($k === $trackKey) ? 'checked' : '' ?>>
                                                <div>
                                                    <div class="d-flex justify-content-between align-items-center mb-2 pe-4">
                                                        <span class="badge bg-warning text-dark fw-bold px-2 py-1 rounded small"><?= $info['code'] ?> CAREER</span>
                                                        <?php if ($isCarVerified): ?>
                                                            <span class="badge bg-success rounded-pill small"><i class="fa-solid fa-circle-check me-1"></i> TERVERIFIKASI</span>
                                                        <?php else: ?>
                                                            <span class="badge bg-success rounded-pill small">25 Soal Komprehensif</span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <h5 class="fw-bold text-navy mb-2"><?= htmlspecialchars($info['title']) ?></h5>
                                                    <p class="text-muted small mb-3"><?= htmlspecialchars($info['competencies']) ?></p>
                                                </div>
                                                <div class="pt-2 border-top mt-2 d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <small class="text-muted text-decoration-line-through">Rp <?= number_format($info['original_price'], 0, ',', '.') ?></small>
                                                        <div class="fw-bold text-danger fs-5">Rp <?= number_format($info['price'], 0, ',', '.') ?></div>
                                                    </div>
                                                    <span class="small text-secondary"><i class="fa-regular fa-clock me-1"></i> <?= $info['duration_minutes'] ?> Menit (Passing 80%)</span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                        </div>

                        <!-- GATEWAY PEMBAYARAN & AKTIVASI UJIAN (BAYAR DULU) -->
                        <?php
                        $isTrackVerified = !empty($userVerifiedTracks[$trackKey]);
                        $activeInv = $isTrackVerified ? $userVerifiedTracks[$trackKey] : $generatedInv;
                        ?>
                        <div class="p-4 rounded-4 bg-light border border-2 mt-4" style="border-color: #e2e8f0 !important;" id="checkoutGateBox">
                            
                            <div class="row g-4 align-items-start">
                                
                                <!-- LEFT COL: FORM PESERTA -->
                                <div class="col-lg-7">
                                    <div class="d-flex align-items-center gap-2 mb-3">
                                        <div class="p-2 bg-navy text-white rounded-3 d-flex align-items-center justify-content-center" style="background-color: #0d2e5c; width: 36px; height: 36px;">
                                            <i class="fa-solid fa-id-card text-warning"></i>
                                        </div>
                                        <div>
                                            <h5 class="fw-bold text-navy font-heading mb-0">Formulir Peserta & Penerima Sertifikat</h5>
                                            <small class="text-muted">Nama ini akan dicetak permanen di sertifikat fisik & digital</small>
                                        </div>
                                    </div>

                                    <div class="alert alert-success border-0 rounded-3 p-3 mb-3" id="verifiedNotice" style="<?= $isTrackVerified ? '' : 'display: none;' ?>">
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <i class="fa-solid fa-circle-check fs-5 text-success"></i>
                                            <strong class="text-navy">Pembayaran Terverifikasi & Akses Ujian Aktif</strong>
                                        </div>
                                        <div class="small text-muted">
                                            No. Invoice: <strong class="text-dark" id="verifiedInvLabel"><?= htmlspecialchars($activeInv) ?></strong>. Anda tidak perlu membayar lagi untuk materi ini. Silakan langsung masuk ke ruang ujian.
                                        </div>
                                    </div>

                                    <form id="startExamForm" action="exam.php" method="POST">
                                        <input type="hidden" name="action" value="start_exam">
                                        <input type="hidden" name="track" id="formTrackKey" value="<?= htmlspecialchars($trackKey) ?>">
                                        <input type="hidden" name="invoice_no" id="formInvoiceNo" value="<?= htmlspecialchars($activeInv) ?>">

                                        <div class="mb-3">
                                            <label class="form-label small fw-bold text-navy">Nama Lengkap Mahasiswa / Peserta <span class="text-danger">*</span></label>
                                            <input type="text" name="recipient_name" id="inputRecipientName" class="form-control form-control-lg rounded-3" value="<?= htmlspecialchars($defaultName) ?>" placeholder="Contoh: Muhammad Rian Pratama, S.Kom" required>
                                            <small class="text-muted" style="font-size: 0.74rem;">*Pastikan ejaan nama sesuai KTP / KTM untuk keabsahan SKPI kampus.</small>
                                        </div>

                                        <div class="row g-3 mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label small fw-bold text-navy">Alamat Email Aktif <span class="text-danger">*</span></label>
                                                <input type="email" name="recipient_email" id="inputRecipientEmail" class="form-control rounded-3" value="<?= htmlspecialchars($defaultEmail) ?>" placeholder="email@mahasiswa.ac.id" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small fw-bold text-navy">Nomor WhatsApp Aktif <span class="text-danger">*</span></label>
                                                <input type="tel" name="recipient_wa" id="inputRecipientWa" class="form-control rounded-3" placeholder="Contoh: 082291700778" required>
                                            </div>
                                        </div>

                                        <!-- SELECTED TRACK BADGE -->
                                        <div class="p-3 rounded-3 bg-white border mb-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <small class="text-muted d-block" style="font-size: 0.74rem;">Sertifikat yang Dipilih:</small>
                                                    <strong class="text-navy" id="selectedTrackTitleDisplay"><?= htmlspecialchars($trackInfo['title']) ?></strong>
                                                </div>
                                                <div class="text-end">
                                                    <span class="badge bg-warning text-dark fw-bold px-3 py-1 rounded-pill" id="selectedTrackPriceDisplay">Rp <?= number_format($trackInfo['price'], 0, ',', '.') ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- VOUCHER / BYPASS INPUT -->
                                        <div class="mb-4 p-3 rounded-3 bg-warning bg-opacity-10 border border-warning border-opacity-50" id="voucherBoxWrapper" style="<?= $isTrackVerified ? 'display: none;' : '' ?>">
                                            <label class="form-label small fw-bold text-navy d-flex justify-content-between align-items-center mb-1">
                                                <span><i class="fa-solid fa-ticket text-warning me-1"></i> Punya Kode Voucher / Akses Instan?</span>
                                                <span class="badge bg-navy text-white small" style="background: #0d2e5c; font-size: 0.68rem;">Khusus Mahasiswa: MAHASISWA</span>
                                            </label>
                                            <div class="input-group">
                                                <input type="text" name="voucher_code" id="inputVoucherCode" class="form-control text-uppercase font-monospace" placeholder="Masukkan kode voucher atau no. invoice" value="">
                                                <button type="submit" class="btn btn-warning text-navy fw-bold px-4" style="background-color: #fca311 !important; color: #071a35 !important;">
                                                    <i class="fa-solid fa-unlock me-1"></i> Buka Ujian &raquo;
                                                </button>
                                            </div>
                                            <small class="text-muted d-block mt-1" style="font-size: 0.72rem;">*Mahasiswa/penguji dapat mengetik kode <code>MAHASISWA</code> atau <code>DEMO19K</code> untuk aktivasi instan tanpa menunggu konfirmasi manual.</small>
                                        </div>

                                        <!-- START EXAM BUTTON -->
                                        <button type="submit" class="btn <?= $isTrackVerified ? 'btn-success' : 'btn-navy' ?> btn-lg fw-bold w-100 py-3 rounded-pill text-white shadow-sm" id="btnSubmitExam" style="<?= $isTrackVerified ? 'background-color: #04AA6D !important;' : 'background-color: #0d2e5c !important;' ?>">
                                            <i class="fa-solid fa-play me-2 <?= $isTrackVerified ? '' : 'text-warning' ?>"></i> <?= $isTrackVerified ? 'Masuk Ruang Ujian (Akses Terverifikasi) &raquo;' : 'Masuk Ruang Ujian Kompetensi &raquo;' ?>
                                        </button>
                                    </form>
                                </div>

                                <!-- RIGHT COL: QRIS BOX & VERIFIED STATUS -->
                                <div class="col-lg-5">
                                    <div id="qrisVerifiedBoxWrapper" style="<?= $isTrackVerified ? '' : 'display: none;' ?>">
                                        <div class="p-4 bg-white border border-success rounded-4 text-center shadow-sm">
                                            <div class="bg-success text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 56px; height: 56px; font-size: 1.6rem; background-color: #04AA6D !important;">
                                                <i class="fa-solid fa-shield-halved"></i>
                                            </div>
                                            <h5 class="fw-bold text-navy mb-1">Akses Ujian Terbuka</h5>
                                            <p class="text-muted small mb-3">Pesanan Anda telah diverifikasi oleh Admin. Kerjakan ujian kompetensi dengan teliti untuk memperoleh Sertifikat Digital SKPI.</p>
                                            <div class="p-2 bg-light rounded-3 border small font-monospace text-muted mb-0">
                                                Invoice: <strong class="text-navy" id="verifiedCardInvDisplay"><?= htmlspecialchars($activeInv) ?></strong>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="qris-box shadow-sm" id="qrisBoxWrapper" style="<?= $isTrackVerified ? 'display: none;' : '' ?>">
                                        <span class="badge bg-warning text-dark fw-bold px-3 py-1 rounded-pill mb-2 small shadow-xs">
                                            <i class="fa-solid fa-qrcode me-1"></i> QRIS SKILLANCE STORE
                                        </span>
                                        <h6 class="fw-bold text-navy mb-1" id="qrisTitleLabel">Pembayaran Biaya Administrasi</h6>
                                        <div class="text-muted small mb-2 font-monospace" style="font-size: 0.76rem;">No. Invoice: <strong class="text-dark" id="displayInvoiceNo"><?= $generatedInv ?></strong></div>

                                        <div class="my-2 p-2 bg-light rounded-3 d-inline-block border">
                                            <img src="assets/img/qris_official.jpg" alt="QRIS Skillance Store" class="img-fluid rounded" style="max-width: 210px; height: auto;" onerror="this.src='https://api.qrserver.com/v1/create-qr-code/?size=220x220&data=00020101021126580014ID.LINKAJA.WWW01189360091100266343635204581253033605802ID5915Skillance Store6013Kota Kendari61059311162070703A0163047A9B';">
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center bg-light p-2 rounded-3 my-2 border">
                                            <span class="small text-muted">Total Pembayaran:</span>
                                            <strong class="text-danger fs-5" id="displayPriceTag">Rp <?= number_format($trackInfo['price'], 0, ',', '.') ?></strong>
                                        </div>

                                        <div class="small text-muted mb-3" style="font-size: 0.72rem; line-height: 1.5;">
                                            Dapat discan dengan <strong>GoPay, OVO, DANA, ShopeePay, BCA, Mandiri, BRImo</strong>, atau m-Banking manapun.
                                        </div>

                                        <!-- WHATSAPP CONFIRM BUTTON -->
                                        <a href="https://wa.me/6282291700778?text=<?= urlencode("Halo Admin Skillance Academy (0822-9170-0778),

Saya ingin konfirmasi pembayaran Ujian Sertifikasi Resmi:
- No. Invoice: " . $generatedInv . "
- Materi: " . $trackInfo['title'] . "
- Nominal: Rp " . number_format($trackInfo['price'], 0, ',', '.') . "
- Nama: [Nama Anda]

Mohon diverifikasi agar akses ujian terbuka. Terima kasih!") ?>" target="_blank" id="btnWaConfirm" class="btn btn-success fw-bold w-100 rounded-pill py-2 shadow-xs mb-2">
                                            <i class="fa-brands fa-whatsapp fs-5 me-1"></i> Konfirmasi ke WA Admin (0822-9170-0778)
                                        </a>

                                        <small class="text-muted d-block" style="font-size: 0.7rem;">
                                            <i class="fa-solid fa-shield-halved text-success me-1"></i> Verifikasi Admin maksimal 1x24 Jam kerja.
                                        </small>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </main>

        <script>
            const verifiedTracks = <?= json_encode($userVerifiedTracks) ?>;
            const defaultGeneratedInv = '<?= $generatedInv ?>';

            function selectTrack(trackKey, trackTitle, price, code, duration, qCount, el) {
                // Update selected styles
                document.querySelectorAll('.track-selector-card').forEach(c => c.classList.remove('selected'));
                el.classList.add('selected');
                el.querySelector('input[type="radio"]').checked = true;

                // Update form inputs
                document.getElementById('formTrackKey').value = trackKey;
                document.getElementById('selectedTrackTitleDisplay').innerText = trackTitle;
                
                const formattedPrice = 'Rp ' + price.toLocaleString('id-ID');
                document.getElementById('selectedTrackPriceDisplay').innerText = formattedPrice;
                document.getElementById('displayPriceTag').innerText = formattedPrice;

                const userVerifInv = verifiedTracks[trackKey] || '';
                const inv = userVerifInv || defaultGeneratedInv;
                document.getElementById('formInvoiceNo').value = inv;

                const verifiedNotice = document.getElementById('verifiedNotice');
                const voucherBoxWrapper = document.getElementById('voucherBoxWrapper');
                const qrisBoxWrapper = document.getElementById('qrisBoxWrapper');
                const qrisVerifiedBoxWrapper = document.getElementById('qrisVerifiedBoxWrapper');
                const btnSubmitExam = document.getElementById('btnSubmitExam');

                if (userVerifInv) {
                    if (verifiedNotice) {
                        verifiedNotice.style.display = 'block';
                        document.getElementById('verifiedInvLabel').innerText = userVerifInv;
                    }
                    if (voucherBoxWrapper) voucherBoxWrapper.style.display = 'none';
                    if (qrisBoxWrapper) qrisBoxWrapper.style.display = 'none';
                    if (qrisVerifiedBoxWrapper) {
                        qrisVerifiedBoxWrapper.style.display = 'block';
                        document.getElementById('verifiedCardInvDisplay').innerText = userVerifInv;
                    }
                    if (btnSubmitExam) {
                        btnSubmitExam.className = 'btn btn-success btn-lg fw-bold w-100 py-3 rounded-pill text-white shadow-sm';
                        btnSubmitExam.style.backgroundColor = '#04AA6D';
                        btnSubmitExam.innerHTML = '<i class="fa-solid fa-play me-2"></i> Masuk Ruang Ujian (Akses Terverifikasi) &raquo;';
                    }
                } else {
                    if (verifiedNotice) verifiedNotice.style.display = 'none';
                    if (voucherBoxWrapper) voucherBoxWrapper.style.display = 'block';
                    if (qrisBoxWrapper) qrisBoxWrapper.style.display = 'block';
                    if (qrisVerifiedBoxWrapper) qrisVerifiedBoxWrapper.style.display = 'none';
                    if (btnSubmitExam) {
                        btnSubmitExam.className = 'btn btn-navy btn-lg fw-bold w-100 py-3 rounded-pill text-white shadow-sm';
                        btnSubmitExam.style.backgroundColor = '#0d2e5c';
                        btnSubmitExam.innerHTML = '<i class="fa-solid fa-play me-2 text-warning"></i> Masuk Ruang Ujian Kompetensi &raquo;';
                    }
                }

                // Update WA link
                const name = document.getElementById('inputRecipientName').value || 'Peserta Mahasiswa';
                const waMsg = `Halo Admin Skillance Academy (0822-9170-0778),

Saya ingin konfirmasi pembayaran Ujian Sertifikasi Resmi:
- No. Invoice: ${inv}
- Materi: ${trackTitle}
- Nominal: ${formattedPrice}
- Nama: ${name}

Mohon diverifikasi agar akses ujian terbuka. Terima kasih!`;
                const btnWa = document.getElementById('btnWaConfirm');
                if (btnWa) {
                    btnWa.href = 'https://wa.me/6282291700778?text=' + encodeURIComponent(waMsg);
                }

                // Auto register order in background
                if (!userVerifInv) {
                    fetch('api/order_status.php?action=register', {
                        method: 'POST',
                        headers: { 'Content-Type': 'application/json' },
                        body: JSON.stringify({
                            invoice_no: inv,
                            product_id: 'cert_' + trackKey,
                            product_title: 'Sertifikat Resmi ' + trackTitle,
                            nominal: price,
                            buyer_name: name
                        })
                    }).catch(() => {});
                }
            }
        </script>

    <!-- ========================================== -->
    <!-- STATE 2: EXAM SESSION (ACTIVE TEST) -->
    <!-- ========================================== -->
    <?php elseif ($action === 'start_exam' && !$resultData): 
        $recipientName = trim($_POST['recipient_name'] ?? $_GET['recipient_name'] ?? $defaultName ?: 'Peserta Ujian');
        $recipientEmail = trim($_POST['recipient_email'] ?? $_GET['recipient_email'] ?? $defaultEmail ?: '');
        $questions = $trackInfo['questions'];
        $totalQuestions = count($questions);
        $durationMinutes = $trackInfo['duration_minutes'] ?? 15;
    ?>
        <main class="container py-4">
            
            <!-- STICKY TOP TIMER & PROGRESS BAR -->
            <div class="exam-timer-bar">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-gold text-navy fw-bold px-3 py-1 rounded-pill small" style="background-color: #fca311 !important; color: #071a35 !important;"><?= htmlspecialchars($trackInfo['title']) ?></span>
                    <span class="small text-white-50 d-none d-md-inline">| Peserta: <strong><?= htmlspecialchars($recipientName) ?></strong></span>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-regular fa-clock text-warning fs-5"></i>
                        <span id="examTimerDisplay" class="timer-display"><?= sprintf('%02d:00', $durationMinutes) ?></span>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                
                <!-- LEFT COLUMN: QUESTION PANES -->
                <div class="col-lg-8">
                    <form id="examForm" action="exam.php" method="POST">
                        <input type="hidden" name="action" value="submit_exam">
                        <input type="hidden" name="track" value="<?= htmlspecialchars($trackKey) ?>">
                        <input type="hidden" name="recipient_name" value="<?= htmlspecialchars($recipientName) ?>">
                        <input type="hidden" name="recipient_email" value="<?= htmlspecialchars($recipientEmail) ?>">

                        <?php foreach ($questions as $qIdx => $q): ?>
                            <div class="exam-card question-pane" id="pane-<?= $qIdx ?>" style="<?= ($qIdx === 0) ? '' : 'display: none;' ?>">
                                
                                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                                    <span class="badge bg-navy text-white px-3 py-1 rounded-pill small" style="background-color: #0d2e5c !important;">
                                        Soal <?= ($qIdx + 1) ?> dari <?= $totalQuestions ?>
                                    </span>
                                    <small class="text-muted"><i class="fa-solid fa-list-check me-1"></i> Pilihan Ganda Tunggal</small>
                                </div>

                                <h5 class="fw-bold text-navy mb-4 font-heading" style="line-height: 1.6;">
                                    <?= htmlspecialchars($q['q']) ?>
                                </h5>

                                <div class="d-flex flex-column gap-2 mb-4">
                                    <?php 
                                    $optLetters = ['A', 'B', 'C', 'D'];
                                    foreach ($q['options'] as $optIdx => $optText): 
                                    ?>
                                        <label class="option-label" id="opt-label-<?= $qIdx ?>-<?= $optIdx ?>" onclick="markAnswered(<?= $qIdx ?>, <?= $optIdx ?>)">
                                            <input type="radio" name="answers[<?= $qIdx ?>]" value="<?= $optIdx ?>" class="option-radio">
                                            <div class="d-flex align-items-start gap-2">
                                                <span class="badge bg-light text-navy border px-2 py-1 rounded small fw-bold"><?= $optLetters[$optIdx] ?></span>
                                                <span style="font-size: 0.95rem; line-height: 1.5;"><?= htmlspecialchars($optText) ?></span>
                                            </div>
                                        </label>
                                    <?php endforeach; ?>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                    <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3" onclick="goToQuestion(<?= ($qIdx - 1) ?>)" <?= ($qIdx === 0) ? 'disabled' : '' ?>>
                                        &laquo; Soal Sebelumnya
                                    </button>

                                    <?php if ($qIdx < $totalQuestions - 1): ?>
                                        <button type="button" class="btn btn-navy text-white btn-sm rounded-pill px-4 py-2 fw-bold" style="background-color: #0d2e5c !important;" onclick="goToQuestion(<?= ($qIdx + 1) ?>)">
                                            Soal Berikutnya &raquo;
                                        </button>
                                    <?php else: ?>
                                        <button type="button" class="btn btn-success btn-sm rounded-pill px-4 py-2 fw-bold shadow-sm" onclick="confirmSubmitExam()">
                                            <i class="fa-solid fa-check-circle me-1"></i> Kumpulkan Jawaban Ujian
                                        </button>
                                    <?php endif; ?>
                                </div>

                            </div>
                        <?php endforeach; ?>

                    </form>
                </div>

                <!-- RIGHT COLUMN: NUMBER NAVIGATION GRID -->
                <div class="col-lg-4">
                    <div class="exam-card position-sticky" style="top: 150px;">
                        <h6 class="fw-bold text-navy font-heading mb-3 pb-2 border-bottom">
                            <i class="fa-solid fa-border-all text-warning me-1"></i> Navigasi Nomor Soal
                        </h6>

                        <div class="d-flex flex-wrap gap-2 mb-4">
                            <?php for ($i = 0; $i < $totalQuestions; $i++): ?>
                                <button type="button" class="q-number-btn <?= ($i === 0) ? 'active' : '' ?>" id="grid-btn-<?= $i ?>" onclick="goToQuestion(<?= $i ?>)">
                                    <?= ($i + 1) ?>
                                </button>
                            <?php endfor; ?>
                        </div>

                        <div class="p-3 bg-light rounded-3 small mb-3">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <span class="badge bg-success rounded-circle" style="width: 10px; height: 10px; padding: 0;">&nbsp;</span>
                                <span class="text-muted">Hijau: Sudah Dijawab</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-white border border-secondary rounded-circle" style="width: 10px; height: 10px; padding: 0;">&nbsp;</span>
                                <span class="text-muted">Putih: Belum Dijawab</span>
                            </div>
                        </div>

                        <div class="text-center">
                            <div class="small fw-bold text-navy mb-2" id="answeredCounter">0 / <?= $totalQuestions ?> Terjawab</div>
                            <button type="button" class="btn btn-success fw-bold w-100 py-2 rounded-pill shadow-sm" onclick="confirmSubmitExam()">
                                <i class="fa-solid fa-cloud-arrow-up me-1"></i> Selesaikan Ujian Sekarang
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </main>

        <script>
            const totalQ = <?= $totalQuestions ?>;
            let currentQuestionIdx = 0;
            let answeredMap = {};

            function goToQuestion(idx) {
                if (idx < 0 || idx >= totalQ) return;
                document.querySelectorAll('.question-pane').forEach(el => el.style.display = 'none');
                document.getElementById('pane-' + idx).style.display = 'block';

                document.querySelectorAll('.q-number-btn').forEach(btn => btn.classList.remove('active'));
                document.getElementById('grid-btn-' + idx).classList.add('active');
                currentQuestionIdx = idx;
            }

            function markAnswered(qIdx, optIdx) {
                answeredMap[qIdx] = optIdx;
                document.querySelectorAll('#pane-' + qIdx + ' .option-label').forEach(lbl => lbl.classList.remove('selected'));
                document.getElementById('opt-label-' + qIdx + '-' + optIdx).classList.add('selected');

                const btn = document.getElementById('grid-btn-' + qIdx);
                btn.classList.add('answered');

                const count = Object.keys(answeredMap).length;
                document.getElementById('answeredCounter').textContent = count + ' / ' + totalQ + ' Terjawab';
            }

            function confirmSubmitExam() {
                const count = Object.keys(answeredMap).length;
                const unanswered = totalQ - count;
                let msg = 'Apakah Anda yakin ingin mengakhiri ujian dan mengumpulkan jawaban sekarang?';
                if (unanswered > 0) {
                    msg = `Masih terdapat ${unanswered} soal yang belum dijawab. Apakah Anda tetap yakin ingin mengumpulkan ujian?`;
                }
                if (confirm(msg)) {
                    document.getElementById('examForm').submit();
                }
            }

            // Timer Countdown
            let durationSeconds = <?= $durationMinutes ?> * 60;
            const timerEl = document.getElementById('examTimerDisplay');
            const timerInterval = setInterval(() => {
                durationSeconds--;
                if (durationSeconds <= 0) {
                    clearInterval(timerInterval);
                    alert('Waktu ujian telah berakhir! Jawaban Anda akan otomatis dikumpulkan.');
                    document.getElementById('examForm').submit();
                    return;
                }

                const minutes = Math.floor(durationSeconds / 60);
                const seconds = durationSeconds % 60;
                timerEl.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                if (durationSeconds <= 180) { // < 3 mins
                    timerEl.classList.add('timer-warning');
                }
            }, 1000);
        </script>

    <!-- ========================================== -->
    <!-- STATE 3: RESULT & CERTIFICATE ISSUANCE -->
    <!-- ========================================== -->
    <?php elseif ($resultData): ?>
        <main class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    
                    <?php if ($resultData['passed']): ?>
                        <!-- PASSED STATE -->
                        <div class="pass-hero-card mb-4">
                            <span class="badge bg-gold text-navy fw-bold px-3 py-2 rounded-pill mb-3 text-uppercase shadow-sm" style="background-color: #fca311 !important; color: #071a35 !important;">
                                <i class="fa-solid fa-crown me-1"></i> Selamat, Anda Dinyatakan Lulus!
                            </span>
                            <h1 class="display-5 fw-bold font-heading mb-2 text-white">Sertifikat Kelulusan Resmi Diterbitkan</h1>
                            <p class="mx-auto mb-4" style="max-width: 650px; color: #e2e8f0; font-size: 1.05rem; line-height: 1.7;">
                                Selamat kepada <strong><?= htmlspecialchars($resultData['recipient_name']) ?></strong>! Anda berhasil lulus Ujian Kompetensi Standar Industri pada materi <strong><?= htmlspecialchars($resultData['track_title']) ?></strong> dengan hasil sangat memuaskan.
                            </p>

                            <!-- SCORE AND CERT NO BADGES -->
                            <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
                                <div class="bg-white bg-opacity-15 p-3 rounded-4 border border-white border-opacity-25 text-start" style="min-width: 170px;">
                                    <small class="text-white-50 d-block">Nilai Kelulusan:</small>
                                    <div class="display-6 fw-bold text-warning" style="color: #fca311 !important;"><?= $resultData['score'] ?><span class="fs-5 text-white-50">/100</span></div>
                                    <small class="text-white-50"><?= $resultData['correct'] ?> dari <?= $resultData['total'] ?> Soal Benar</small>
                                </div>
                                <div class="bg-white bg-opacity-15 p-3 rounded-4 border border-white border-opacity-25 text-start" style="min-width: 260px;">
                                    <small class="text-white-50 d-block">No. Seri Sertifikat Digital Resmi:</small>
                                    <div class="fs-4 fw-bold font-monospace text-white mt-1"><?= htmlspecialchars($resultData['certificate_no']) ?></div>
                                    <small class="text-white-50"><i class="fa-solid fa-circle-check text-success me-1"></i> Terdaftar di Basis Data SKPI</small>
                                </div>
                            </div>

                            <!-- ACTION BUTTONS -->
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="verify.php?cert=<?= urlencode($resultData['certificate_no']) ?>" class="btn btn-warning btn-lg fw-bold px-4 py-3 rounded-pill text-navy shadow" style="background-color: #fca311 !important; color: #071a35 !important;">
                                    <i class="fa-solid fa-certificate me-2 fs-5"></i> Buka & Cetak Sertifikat Digital SKPI &raquo;
                                </a>
                                <a href="https://www.linkedin.com/profile/add?startTask=CERTIFICATION_NAME&name=<?= urlencode($resultData['track_title'] . ' Competence') ?>&organizationName=<?= urlencode('Skillance Digital Indonesia') ?>&issueYear=<?= date('Y') ?>&issueMonth=<?= date('n') ?>&certUrl=<?= urlencode('https://academy.skillance.cloud/verify.php?cert=' . $resultData['certificate_no']) ?>&certId=<?= urlencode($resultData['certificate_no']) ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline-light btn-lg fw-bold px-4 py-3 rounded-pill shadow-sm">
                                    <i class="fa-brands fa-linkedin me-2 text-info fs-5"></i> Tambah ke LinkedIn
                                </a>
                                <a href="exam.php" class="btn btn-outline-light btn-lg fw-bold px-4 py-3 rounded-pill">
                                    <i class="fa-solid fa-rotate-right me-1"></i> Ambil Ujian Materi Lain
                                </a>
                            </div>
                        </div>

                        <script>
                            confetti({
                                particleCount: 140,
                                spread: 90,
                                origin: { y: 0.6 }
                            });
                        </script>

                    <?php else: ?>
                        <!-- FAILED STATE -->
                        <div class="exam-card text-center py-5 mb-4 border-danger border-opacity-50">
                            <div class="fs-1 text-danger mb-3"><i class="fa-solid fa-circle-xmark"></i></div>
                            <h2 class="fw-bold text-navy font-heading mb-2">Nilai Belum Mencapai Standar Kelulusan</h2>
                            <p class="text-muted mx-auto mb-4" style="max-width: 600px; line-height: 1.7;">
                                Nilai perolehan Anda adalah <strong class="text-danger fs-5"><?= $resultData['score'] ?>/100</strong> (<?= $resultData['correct'] ?> benar dari <?= $resultData['total'] ?> soal). Standar minimal kelulusan untuk penerbitan sertifikat resmi pada jalur ini adalah <strong><?= $resultData['passing_score'] ?>%</strong>.
                            </p>

                            <div class="p-3 rounded-3 bg-light border d-inline-block mx-auto mb-4 text-start small" style="max-width: 500px;">
                                <i class="fa-solid fa-lightbulb text-warning me-1"></i> <strong>Saran untuk Anda:</strong>
                                <span class="text-secondary d-block mt-1">Jangan berkecil hati! Silakan pelajari kembali modul materi gratis pada jalur ini, baca penjelasan kunci jawaban di bawah, dan Anda dapat mengulang ujian ini kembali kapan saja.</span>
                            </div>

                            <div>
                                <a href="exam.php?track=<?= urlencode($trackKey) ?>" class="btn btn-navy text-white fw-bold px-4 py-3 rounded-pill shadow-sm" style="background: #0d2e5c;">
                                    <i class="fa-solid fa-rotate-left me-1 text-warning"></i> Ulangi Ujian Ini &raquo;
                                </a>
                                <a href="learn.php?c=<?= urlencode($trackKey) ?>" class="btn btn-outline-secondary fw-bold px-4 py-3 rounded-pill ms-2">
                                    <i class="fa-solid fa-book-open me-1"></i> Buka Modul Belajar Gratis
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- QUESTION BREAKDOWN & EXPLANATION -->
                    <div class="exam-card mt-4">
                        <h5 class="fw-bold text-navy font-heading mb-4 pb-2 border-bottom">
                            <i class="fa-solid fa-clipboard-check text-success me-2"></i> Pembahasan Soal & Kunci Jawaban
                        </h5>

                        <div class="d-flex flex-column gap-3">
                            <?php foreach ($resultData['breakdown'] as $bIdx => $bd): ?>
                                <div class="p-3 rounded-3 border <?= $bd['is_correct'] ? 'bg-success bg-opacity-10 border-success border-opacity-25' : 'bg-danger bg-opacity-10 border-danger border-opacity-25' ?>">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <strong class="text-navy" style="font-size: 0.95rem;">Soal <?= ($bIdx + 1) ?>: <?= htmlspecialchars($bd['q']) ?></strong>
                                        <span class="badge <?= $bd['is_correct'] ? 'bg-success' : 'bg-danger' ?> px-2 py-1 rounded-pill small">
                                            <?= $bd['is_correct'] ? '✓ Benar' : '✕ Salah' ?>
                                        </span>
                                    </div>
                                    <div class="small mb-2">
                                        <?php if ($bd['is_correct']): ?>
                                            <span class="text-success fw-bold">Jawaban Anda Benar:</span> <?= htmlspecialchars($bd['options'][$bd['correct_ans']]) ?>
                                        <?php else: ?>
                                            <span class="text-danger fw-bold">Jawaban Anda:</span> <?= ($bd['user_ans'] >= 0) ? htmlspecialchars($bd['options'][$bd['user_ans']]) : 'Tidak Dijawab' ?> <br>
                                            <span class="text-success fw-bold">Jawaban yang Benar:</span> <?= htmlspecialchars($bd['options'][$bd['correct_ans']]) ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="p-2 rounded-2 bg-white bg-opacity-75 border small text-muted">
                                        <strong><i class="fa-solid fa-circle-info text-primary me-1"></i> Pembahasan:</strong> <?= htmlspecialchars($bd['exp']) ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    <?php endif; ?>


    <!-- MODAL SIMULASI TRYOUT KILAT 5 SOAL -->
    <div class="modal fade" id="quickTryoutModal" tabindex="-1" aria-labelledby="quickTryoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header bg-navy text-white px-4 py-3" style="background-color: #0d2e5c !important;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-bolt text-warning fs-5"></i>
                        <div>
                            <h5 class="modal-title fw-bold mb-0" id="quickTryoutModalLabel">Simulasi Tryout Kilat 5 Soal</h5>
                            <small class="text-white-50">Kuis kilat 2 menit dengan pembahasan instan & reward +30 XP</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body p-4 bg-light">
                    <!-- STEP 1: PILIH TRACK -->
                    <div id="tryoutSetupStep">
                        <div class="text-center mb-4">
                            <h5 class="fw-bold text-navy">Pilih Materi Soal Tryout</h5>
                            <p class="text-muted small">Pilih salah satu materi yang ingin Anda coba evaluasi secara kilat:</p>
                        </div>
                        <div class="row g-2 mb-4" style="max-height: 280px; overflow-y: auto;">
                            <?php foreach ($examQuestionsData as $k => $info): ?>
                                <div class="col-6 col-md-4">
                                    <button type="button" class="btn btn-outline-secondary w-100 p-2 rounded-3 text-start h-100 track-tryout-btn" onclick="selectTryoutTrack('<?= $k ?>', '<?= htmlspecialchars(addslashes($info['title'])) ?>', this)">
                                        <div class="fw-bold text-navy small mb-1" style="font-size: 0.8rem;"><?= htmlspecialchars($info['title']) ?></div>
                                        <small class="text-muted" style="font-size: 0.7rem;"><?= count($info['questions']) ?> butir bank soal</small>
                                    </button>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="text-center">
                            <button type="button" id="btnStartTryoutQuiz" class="btn btn-warning text-navy fw-bold px-5 py-2 rounded-pill shadow-sm" style="background-color: #fca311 !important; color: #071a35 !important;" disabled onclick="launchTryoutQuiz()">
                                Mulai Kuis Kilat (5 Soal) &raquo;
                            </button>
                        </div>
                    </div>

                    <!-- STEP 2: ACTIVE TRYOUT QUESTION -->
                    <div id="tryoutQuizStep" style="display: none;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-navy text-white px-3 py-1 rounded-pill small" id="tryoutTrackBadge" style="background-color: #0d2e5c !important;">Jalur Koding</span>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-warning text-dark px-3 py-1 rounded-pill fw-bold font-monospace" id="tryoutTimer">
                                    <i class="fa-regular fa-clock me-1"></i> 02:00
                                </span>
                                <span class="small text-muted fw-semibold" id="tryoutProgressText">Soal 1 / 5</span>
                            </div>
                        </div>

                        <!-- QUESTION CARD -->
                        <div class="card border-0 shadow-sm rounded-3 p-4 mb-3 bg-white">
                            <h6 class="fw-bold text-navy mb-3" id="tryoutQuestionText">Memuat pertanyaan...</h6>
                            <div id="tryoutOptionsList" class="d-flex flex-column gap-2 mb-3"></div>
                            <div id="tryoutFeedbackBox" style="display: none;" class="p-3 rounded-3 small mb-2"></div>
                        </div>

                        <!-- CONTROLS -->
                        <div class="d-flex justify-content-between align-items-center">
                            <button type="button" class="btn btn-outline-secondary btn-sm rounded-pill px-3" onclick="abortTryout()">
                                Batal
                            </button>
                            <button type="button" id="btnNextTryoutQ" class="btn btn-navy text-white btn-sm rounded-pill px-4 py-2 fw-bold shadow-sm" style="background-color: #0d2e5c !important;" onclick="handleTryoutNext()">
                                Cek Jawaban &raquo;
                            </button>
                        </div>
                    </div>

                    <!-- STEP 3: RESULT -->
                    <div id="tryoutResultStep" style="display: none;" class="text-center py-4">
                        <div class="mb-3">
                            <i class="fa-solid fa-trophy text-warning" style="font-size: 3.5rem;"></i>
                        </div>
                        <h4 class="fw-bold text-navy mb-1">Tryout Kilat Selesai!</h4>
                        <p class="text-muted small mb-3">Berikut adalah hasil performa kilat Anda:</p>
                        
                        <div class="bg-white p-3 rounded-4 shadow-sm mx-auto mb-4 border" style="max-width: 320px;">
                            <div class="display-5 fw-bold text-navy mb-1" id="tryoutScoreDisplay">4 / 5</div>
                            <div class="text-success fw-bold small mb-2" id="tryoutScorePercentage">Skor 80% (Bagus!)</div>
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">
                                <i class="fa-solid fa-bolt text-danger me-1"></i> +30 XP Belajar Diperoleh
                            </span>
                        </div>

                        <p class="small text-muted mb-4" style="max-width: 450px; margin: 0 auto;">
                            Kemampuan dasar Anda sudah sangat baik! Ambil Ujian Sertifikasi Resmi sekarang untuk menerbitkan sertifikat SKPI bertanda tangan digital.
                        </p>

                        <div class="d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                Tutup
                            </button>
                            <button type="button" class="btn btn-success fw-bold rounded-pill px-4 shadow-sm" onclick="proceedToFullExam()">
                                <i class="fa-solid fa-award me-1"></i> Lanjut Ambil Sertifikat &raquo;
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- QUESTIONS BANK JSON FOR TRYOUT -->
    <script>
        const ALL_EXAM_DATA = <?= json_encode($examQuestionsData, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>;
        
        let selectedTryoutTrackKey = null;
        let selectedTryoutTrackTitle = '';
        let tryoutQuestions = [];
        let currentTryoutIdx = 0;
        let tryoutScore = 0;
        let tryoutTimerInterval = null;
        let tryoutTimeRemaining = 120; // 2 minutes
        let isQuestionAnswered = false;

        function openQuickTryoutModal() {
            resetTryoutToSetup();
            const modal = new bootstrap.Modal(document.getElementById('quickTryoutModal'));
            modal.show();
        }

        function resetTryoutToSetup() {
            if (tryoutTimerInterval) clearInterval(tryoutTimerInterval);
            selectedTryoutTrackKey = null;
            selectedTryoutTrackTitle = '';
            tryoutQuestions = [];
            currentTryoutIdx = 0;
            tryoutScore = 0;
            tryoutTimeRemaining = 120;
            isQuestionAnswered = false;

            document.getElementById('tryoutSetupStep').style.display = 'block';
            document.getElementById('tryoutQuizStep').style.display = 'none';
            document.getElementById('tryoutResultStep').style.display = 'none';
            document.getElementById('btnStartTryoutQuiz').disabled = true;

            document.querySelectorAll('.track-tryout-btn').forEach(b => {
                b.classList.remove('btn-navy', 'text-white');
                b.classList.add('btn-outline-secondary');
            });
        }

        function selectTryoutTrack(k, title, btnEl) {
            selectedTryoutTrackKey = k;
            selectedTryoutTrackTitle = title;
            document.querySelectorAll('.track-tryout-btn').forEach(b => {
                b.classList.remove('btn-navy', 'text-white');
                b.classList.add('btn-outline-secondary');
            });
            btnEl.classList.remove('btn-outline-secondary');
            btnEl.classList.add('btn-navy', 'text-white');
            document.getElementById('btnStartTryoutQuiz').disabled = false;
        }

        function launchTryoutQuiz() {
            if (!selectedTryoutTrackKey || !ALL_EXAM_DATA[selectedTryoutTrackKey]) return;
            const pool = ALL_EXAM_DATA[selectedTryoutTrackKey].questions;
            const shuffled = [...pool].sort(() => 0.5 - Math.random());
            tryoutQuestions = shuffled.slice(0, 5);

            document.getElementById('tryoutTrackBadge').textContent = selectedTryoutTrackTitle;
            document.getElementById('tryoutSetupStep').style.display = 'none';
            document.getElementById('tryoutQuizStep').style.display = 'block';
            currentTryoutIdx = 0;
            tryoutScore = 0;
            renderTryoutQuestion(0);
            startTryoutTimer();
        }

        function startTryoutTimer() {
            if (tryoutTimerInterval) clearInterval(tryoutTimerInterval);
            const timerEl = document.getElementById('tryoutTimer');
            updateTimerDisplay(timerEl, tryoutTimeRemaining);

            tryoutTimerInterval = setInterval(() => {
                tryoutTimeRemaining--;
                updateTimerDisplay(timerEl, tryoutTimeRemaining);
                if (tryoutTimeRemaining <= 0) {
                    clearInterval(tryoutTimerInterval);
                    finishTryout();
                }
            }, 1000);
        }

        function updateTimerDisplay(el, seconds) {
            const m = Math.floor(seconds / 60);
            const s = seconds % 60;
            el.innerHTML = `<i class="fa-regular fa-clock me-1"></i> ${m.toString().padStart(2, '0')}:${s.toString().padStart(2, '0')}`;
        }

        function renderTryoutQuestion(idx) {
            isQuestionAnswered = false;
            const q = tryoutQuestions[idx];
            document.getElementById('tryoutProgressText').textContent = `Soal ${idx + 1} / 5`;
            document.getElementById('tryoutQuestionText').textContent = q.q;

            const optContainer = document.getElementById('tryoutOptionsList');
            optContainer.innerHTML = '';
            const feedbackBox = document.getElementById('tryoutFeedbackBox');
            feedbackBox.style.display = 'none';
            feedbackBox.className = 'p-3 rounded-3 small mb-2';

            const optLetters = ['A', 'B', 'C', 'D'];
            q.options.forEach((optText, optIdx) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'btn btn-outline-secondary text-start p-3 rounded-3 w-100 d-flex align-items-center gap-2 tryout-opt-btn';
                btn.innerHTML = `<span class="badge bg-light text-navy border px-2 py-1 fw-bold">${optLetters[optIdx]}</span> <span>${escapeTryoutHtml(optText)}</span>`;
                btn.onclick = () => handleTryoutAnswer(optIdx, btn);
                optContainer.appendChild(btn);
            });

            document.getElementById('btnNextTryoutQ').textContent = 'Lewati / Lanjut »';
        }

        function handleTryoutAnswer(selectedIdx, btnEl) {
            if (isQuestionAnswered) return;
            isQuestionAnswered = true;

            const q = tryoutQuestions[currentTryoutIdx];
            const isCorrect = (selectedIdx === q.ans);
            const allBtns = document.querySelectorAll('.tryout-opt-btn');

            if (isCorrect) {
                tryoutScore++;
                btnEl.classList.remove('btn-outline-secondary');
                btnEl.classList.add('btn-success', 'text-white');
            } else {
                btnEl.classList.remove('btn-outline-secondary');
                btnEl.classList.add('btn-danger', 'text-white');
                allBtns[q.ans].classList.remove('btn-outline-secondary');
                allBtns[q.ans].classList.add('btn-success', 'text-white');
            }

            const feedbackBox = document.getElementById('tryoutFeedbackBox');
            feedbackBox.style.display = 'block';
            if (isCorrect) {
                feedbackBox.classList.add('bg-success', 'bg-opacity-10', 'text-success', 'border', 'border-success');
                feedbackBox.innerHTML = `<strong><i class="fa-solid fa-circle-check me-1"></i> Benar!</strong> ${escapeTryoutHtml(q.exp)}`;
            } else {
                feedbackBox.classList.add('bg-danger', 'bg-opacity-10', 'text-danger', 'border', 'border-danger');
                feedbackBox.innerHTML = `<strong><i class="fa-solid fa-circle-xmark me-1"></i> Kurang Tepat.</strong> ${escapeTryoutHtml(q.exp)}`;
            }

            document.getElementById('btnNextTryoutQ').textContent = (currentTryoutIdx < 4) ? 'Soal Berikutnya »' : 'Lihat Hasil Akhir »';
        }

        function handleTryoutNext() {
            if (currentTryoutIdx < 4) {
                currentTryoutIdx++;
                renderTryoutQuestion(currentTryoutIdx);
            } else {
                finishTryout();
            }
        }

        function finishTryout() {
            if (tryoutTimerInterval) clearInterval(tryoutTimerInterval);
            document.getElementById('tryoutQuizStep').style.display = 'none';
            document.getElementById('tryoutResultStep').style.display = 'block';

            const pct = Math.round((tryoutScore / 5) * 100);
            document.getElementById('tryoutScoreDisplay').textContent = `${tryoutScore} / 5`;
            const pctEl = document.getElementById('tryoutScorePercentage');
            pctEl.textContent = `Skor ${pct}% ` + (pct >= 80 ? '(Sangat Siap Lulus!)' : (pct >= 60 ? '(Cukup Baik)' : '(Perlu Latihan Lagi)'));
        }

        function abortTryout() {
            if (confirm('Batalkan sesi simulasi tryout kilat ini?')) {
                resetTryoutToSetup();
            }
        }

        function proceedToFullExam() {
            const modalEl = document.getElementById('quickTryoutModal');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();
            if (selectedTryoutTrackKey) {
                window.location.href = `exam.php?track=${encodeURIComponent(selectedTryoutTrackKey)}`;
            }
        }

        function escapeTryoutHtml(str) {
            return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }
    </script>

    <?php include __DIR__ . '/includes/footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
