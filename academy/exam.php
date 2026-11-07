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
$trackKey = $_POST['track'] ?? $_GET['track'] ?? 'frontend';
if (!array_key_exists($trackKey, $examQuestionsData)) {
    $trackKey = 'frontend';
}

$trackInfo = $examQuestionsData[$trackKey];
$resultData = null;

// Handle Exam Submission
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
    $passed = ($finalScore >= 80);
    $certificateNo = '';

    // If passed, issue official digital certificate into database
    if ($passed) {
        // Generate unique certificate serial
        $randomSuffix = strtoupper(bin2hex(random_bytes(2))); // 4 hex chars e.g. 7A9B
        $randomNum = rand(1000, 9999);
        $certificateNo = 'SKL-2026-' . $trackInfo['code'] . '-' . $randomNum;

        if ($conn) {
            // Check uniqueness
            $chk = $conn->prepare("SELECT id FROM `academy_certificates` WHERE `certificate_no` = ? LIMIT 1");
            if ($chk) {
                $chk->bind_param('s', $certificateNo);
                $chk->execute();
                if ($chk->get_result()->num_rows > 0) {
                    $certificateNo = 'SKL-2026-' . $trackInfo['code'] . '-' . rand(10000, 99999);
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
        'breakdown' => $breakdown
    ];
}

// Master SEO Configuration
$seoTitle = 'Ujian Sertifikasi Kompetensi & Portofolio SKPI - Skillance Academy';
$seoDesc = 'Uji kompetensi pemrograman Anda dengan ujian interaktif berstandar industri. Dapatkan sertifikat kelulusan resmi ber-QR Code untuk portofolio SKPI mahasiswa dan pencari kerja.';
$seoKeywords = 'ujian koding online, sertifikat skpi koding, tes kompetensi web developer, sertifikasi flutter, skillance academy exam';
$seoOgImage = 'https://academy.skillance.cloud/assets/img/og-exam.png';
$seoCanonical = 'https://academy.skillance.cloud/exam.php';
$seoType = 'website';
$seoBreadcrumbs = [
    ['name' => 'Beranda', 'url' => 'https://academy.skillance.cloud/index.php'],
    ['name' => 'Ujian SKPI', 'url' => 'https://academy.skillance.cloud/exam.php']
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

        /* Navbar */
        
        /* Modern Clean Academy Navbar */
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

        .nav-menu-link:hover {
            color: #0d2e5c;
            background-color: #f1f5f9;
        }

        .nav-menu-link.active {
            color: #0d2e5c;
            font-weight: 700;
            background-color: #f1f5f9;
        }

        @media (max-width: 1199.98px) {
            .nav-menu-link {
                display: flex;
                padding: 10px 14px;
                border-radius: 8px;
            }
        }

        .academy-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        /* Subnav */
        .course-subnav {
            background-color: var(--navy);
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }
        .course-subnav::-webkit-scrollbar {
            display: none;
        }
        .course-nav-item {
            display: inline-block;
            padding: 10px 18px;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: all 0.2s;
        }
        .course-nav-item:hover, .course-nav-item.active {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Exam Hero */
        .exam-hero {
            background: linear-gradient(135deg, #071a35 0%, #0d2e5c 60%, #00758f 100%);
            color: white;
            padding: 55px 0 45px;
            text-align: center;
        }

        /* Card Styles */
        .exam-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        }

        /* Option Radio Card */
        .option-label {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 14px 18px;
            background: #ffffff;
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s ease;
            margin-bottom: 12px;
            font-size: 0.92rem;
            line-height: 1.5;
        }
        .option-label:hover {
            border-color: #cbd5e1;
            background-color: #f8fafc;
        }
        .option-label.selected {
            border-color: #0d2e5c;
            background-color: #f0f7ff;
            box-shadow: 0 2px 8px rgba(13, 46, 92, 0.1);
        }
        .option-radio {
            margin-top: 3px;
            accent-color: #0d2e5c;
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        /* Number Grid Navigation */
        .q-number-btn {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            font-weight: 700;
            font-size: 0.85rem;
            color: #475569;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.15s;
        }
        .q-number-btn:hover {
            border-color: #0d2e5c;
            color: #0d2e5c;
        }
        .q-number-btn.answered {
            background: #e0f2fe;
            border-color: #0284c7;
            color: #0369a1;
        }
        .q-number-btn.active {
            background: #0d2e5c;
            border-color: #0d2e5c;
            color: #ffffff;
            box-shadow: 0 2px 8px rgba(13, 46, 92, 0.3);
        }

        /* Sticky Timer Bar */
        .exam-timer-bar {
            background: #071a35;
            color: #ffffff;
            padding: 10px 20px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .timer-display {
            font-family: 'Cinzel', monospace, serif;
            font-size: 1.4rem;
            font-weight: 700;
            letter-spacing: 2px;
            color: #fca311;
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
    <?php if ($action === 'welcome' && !$resultData): ?>
        <header class="exam-hero">
            <div class="container">
                <span class="badge bg-white bg-opacity-10 text-gold px-3 py-2 rounded-pill fw-bold mb-3 border border-warning border-opacity-25">
                    <i class="fa-solid fa-file-signature me-1"></i> Ujian Kompetensi Mandiri Terstandar
                </span>
                <h1 class="display-6 fw-bold font-heading mb-3 text-white">Ujian Kelulusan & Sertifikasi Digital</h1>
                <p class="lead mx-auto mb-4" style="max-width: 720px; color: #cbd5e1; font-size: 1rem; line-height: 1.8;">
                    Uji pemahaman Anda melalui <strong>25 butir soal komprehensif</strong>. Raih nilai minimal <strong>80%</strong> untuk secara otomatis menerbitkan <strong>Sertifikat Digital Ber-QR Code Resmi</strong> yang dapat dilampirkan pada berkas SKPI kampus maupun portofolio kerja profesional.
                </p>
            </div>
        </header>

        <main class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="exam-card">
                        <form action="exam.php" method="GET">
                            <input type="hidden" name="action" value="start_exam">
                            
                            <h4 class="fw-bold text-navy font-heading mb-4">
                                <i class="fa-solid fa-clipboard-list text-warning me-2"></i> Konfigurasi Ujian Kompetensi
                            </h4>

                            <!-- IDENTITAS PESERTA -->
                            <div class="mb-4 p-3 bg-light rounded-3 border">
                                <h6 class="fw-bold text-navy mb-3"><i class="fa-solid fa-id-card me-1 text-primary"></i> Data Penerima Sertifikat:</h6>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-navy">Nama Lengkap Anda <span class="text-danger">*</span></label>
                                        <input type="text" name="recipient_name" class="form-control" value="<?= htmlspecialchars($defaultName) ?>" placeholder="Contoh: Muhammad Rian Pratama" required>
                                        <small class="text-muted" style="font-size: 0.72rem;">*Nama ini yang akan dicetak pada sertifikat resmi kelulusan.</small>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label small fw-bold text-navy">Alamat Email Aktif <span class="text-danger">*</span></label>
                                        <input type="email" name="recipient_email" class="form-control" value="<?= htmlspecialchars($defaultEmail) ?>" placeholder="email@contoh.com" required>
                                        <small class="text-muted" style="font-size: 0.72rem;">*Untuk arsip database kredensial kelulusan.</small>
                                    </div>
                                </div>
                            </div>

                            <!-- PILIHAN JALUR UJIAN -->
                            <div class="mb-4">
                                <label class="form-label fw-bold text-navy mb-2"><i class="fa-solid fa-route me-1 text-warning"></i> Pilih Jalur Spesialisasi yang Ingin Diuji:</label>
                                <div class="row g-3">
                                    <?php foreach ($examQuestionsData as $k => $info): ?>
                                        <div class="col-md-6">
                                            <label class="option-label h-100 <?= ($k === $trackKey) ? 'selected' : '' ?>">
                                                <input type="radio" name="track" value="<?= $k ?>" class="option-radio" <?= ($k === $trackKey) ? 'checked' : '' ?> onchange="document.querySelectorAll('.option-label').forEach(el=>el.classList.remove('selected')); this.closest('label').classList.add('selected');">
                                                <div>
                                                    <strong class="d-block text-navy font-heading" style="font-size: 0.95rem;"><?= htmlspecialchars($info['title']) ?></strong>
                                                    <small class="text-muted d-block mt-1" style="font-size: 0.76rem;"><?= htmlspecialchars($info['competencies']) ?></small>
                                                </div>
                                            </label>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- INFORMASI KETENTUAN UJIAN -->
                            <div class="p-3 rounded-3 bg-warning bg-opacity-10 border border-warning border-opacity-50 mb-4 small">
                                <strong class="text-navy"><i class="fa-solid fa-circle-exclamation me-1 text-warning"></i> Ketentuan Pelaksanaan Ujian:</strong>
                                <ul class="mb-0 mt-2 ps-3 text-secondary" style="line-height: 1.8;">
                                    <li>Durasi pengerjaan: <strong>30 Menit</strong> (timer otomatis dimulai saat klik tombol Mulai).</li>
                                    <li>Jumlah soal: <strong>25 Soal Pilihan Ganda</strong> berbasis pemahaman & studi kasus industri.</li>
                                    <li>Syarat Kelulusan: Skor minimal <strong>80% (20 soal benar)</strong>.</li>
                                    <li>Jika lulus, nomor seri sertifikat langsung diterbitkan dan terdaftar resmi di <code>verify.php</code>.</li>
                                    <li>Jika belum lulus, Anda dapat mempelajari kembali materi dan mengulang ujian kapan saja tanpa biaya.</li>
                                </ul>
                            </div>

                            <button type="submit" class="btn btn-warning btn-lg fw-bold w-100 py-3 rounded-pill text-navy shadow">
                                <i class="fa-solid fa-play me-2"></i> Mulai Ujian Sekarang (30 Menit) &raquo;
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </main>

    <!-- ========================================== -->
    <!-- STATE 2: EXAM SESSION (ACTIVE TEST) -->
    <!-- ========================================== -->
    <?php elseif ($action === 'start_exam' && !$resultData): 
        $recipientName = trim($_GET['recipient_name'] ?? $defaultName ?: 'Peserta Ujian');
        $recipientEmail = trim($_GET['recipient_email'] ?? $defaultEmail ?: '');
        $questions = $trackInfo['questions'];
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
                        <span id="examTimerDisplay" class="timer-display">30:00</span>
                    </div>
                </div>
            </div>

            <form id="examForm" action="exam.php" method="POST">
                <input type="hidden" name="action" value="submit_exam">
                <input type="hidden" name="track" value="<?= htmlspecialchars($trackKey) ?>">
                <input type="hidden" name="recipient_name" value="<?= htmlspecialchars($recipientName) ?>">
                <input type="hidden" name="recipient_email" value="<?= htmlspecialchars($recipientEmail) ?>">

                <div class="row g-4">
                    <!-- LEFT COLUMN: QUESTION CONTENT -->
                    <div class="col-lg-8">
                        <div class="exam-card">
                            
                            <?php foreach ($questions as $idx => $q): ?>
                                <div class="question-pane" id="pane-<?= $idx ?>" style="<?= ($idx === 0) ? 'display: block;' : 'display: none;' ?>">
                                    <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                                        <span class="badge bg-navy text-white px-3 py-1 rounded-pill fw-bold" style="background: #0d2e5c;">
                                            Soal Nomor <?= ($idx + 1) ?> dari <?= count($questions) ?>
                                        </span>
                                        <small class="text-muted"><i class="fa-solid fa-list-check me-1"></i> Pilihan Ganda</small>
                                    </div>

                                    <h5 class="fw-bold text-navy mb-4" style="line-height: 1.6; font-size: 1.15rem;">
                                        <?= htmlspecialchars($q['q']) ?>
                                    </h5>

                                    <!-- OPTIONS -->
                                    <div class="mb-4">
                                        <?php 
                                        $letters = ['A', 'B', 'C', 'D'];
                                        foreach ($q['options'] as $optIdx => $optText): 
                                        ?>
                                            <label class="option-label" id="opt-label-<?= $idx ?>-<?= $optIdx ?>">
                                                <input type="radio" name="answers[<?= $idx ?>]" value="<?= $optIdx ?>" class="option-radio" onchange="markAnswered(<?= $idx ?>, <?= $optIdx ?>)">
                                                <div>
                                                    <span class="badge bg-light text-navy border me-1 fw-bold"><?= $letters[$optIdx] ?></span>
                                                    <span><?= htmlspecialchars($optText) ?></span>
                                                </div>
                                            </label>
                                        <?php endforeach; ?>
                                    </div>

                                    <!-- NAVIGATION BUTTONS -->
                                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4 fw-bold" onclick="goToQuestion(<?= $idx - 1 ?>)" <?= ($idx === 0) ? 'disabled' : '' ?>>
                                            &laquo; Sebelumnya
                                        </button>

                                        <?php if ($idx < count($questions) - 1): ?>
                                            <button type="button" class="btn btn-navy text-white rounded-pill px-4 fw-bold" style="background: #0d2e5c;" onclick="goToQuestion(<?= $idx + 1 ?>)">
                                                Selanjutnya &raquo;
                                            </button>
                                        <?php else: ?>
                                            <button type="button" class="btn btn-success rounded-pill px-4 fw-bold text-white shadow-sm" onclick="confirmSubmitExam()">
                                                <i class="fa-solid fa-paper-plane me-1"></i> Kumpulkan Jawaban Ujian &raquo;
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>

                        </div>
                    </div>

                    <!-- RIGHT COLUMN: NUMBER GRID & SUBMIT BUTTON -->
                    <div class="col-lg-4">
                        <div class="exam-card sticky-top" style="top: 85px;">
                            <h6 class="fw-bold text-navy mb-3 d-flex justify-content-between align-items-center">
                                <span><i class="fa-solid fa-grid-2 me-1 text-warning"></i> Lembar Soal</span>
                                <span id="answeredCounter" class="badge bg-light text-navy border">0 / <?= count($questions) ?> Terjawab</span>
                            </h6>

                            <div class="d-flex flex-wrap gap-2 mb-4">
                                <?php for ($i = 0; $i < count($questions); $i++): ?>
                                    <button type="button" id="grid-btn-<?= $i ?>" class="q-number-btn <?= ($i === 0) ? 'active' : '' ?>" onclick="goToQuestion(<?= $i ?>)">
                                        <?= ($i + 1) ?>
                                    </button>
                                <?php endfor; ?>
                            </div>

                            <div class="d-flex flex-column gap-2 border-top pt-3">
                                <button type="button" class="btn btn-success fw-bold py-2 rounded-pill text-white shadow-sm" onclick="confirmSubmitExam()">
                                    <i class="fa-solid fa-check-double me-1"></i> Selesaikan Ujian
                                </button>
                                <a href="exam.php" class="btn btn-link text-muted small text-decoration-none text-center" onclick="return confirm('Apakah Anda yakin ingin membatalkan ujian ini? Kemajuan ujian saat ini akan hilang.')">
                                    Batalkan Ujian
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>

        <script>
            let currentQuestionIdx = 0;
            const totalQ = <?= count($questions) ?>;
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
                // Highlight option
                document.querySelectorAll('#pane-' + qIdx + ' .option-label').forEach(lbl => lbl.classList.remove('selected'));
                document.getElementById('opt-label-' + qIdx + '-' + optIdx).classList.add('selected');

                // Mark grid button
                const btn = document.getElementById('grid-btn-' + qIdx);
                btn.classList.add('answered');

                // Update counter
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

            // 30 Minutes Timer
            let durationSeconds = 30 * 60;
            const timerEl = document.getElementById('examTimerDisplay');
            const timerInterval = setInterval(() => {
                durationSeconds--;
                if (durationSeconds <= 0) {
                    clearInterval(timerInterval);
                    alert('Waktu ujian 30 menit telah berakhir! Jawaban Anda akan otomatis dikumpulkan.');
                    document.getElementById('examForm').submit();
                    return;
                }

                const minutes = Math.floor(durationSeconds / 60);
                const seconds = durationSeconds % 60;
                timerEl.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                if (durationSeconds <= 300) { // < 5 mins
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
                                Selamat kepada <strong><?= htmlspecialchars($resultData['recipient_name']) ?></strong>! Anda berhasil lulus Ujian Kompetensi Standar Industri pada <strong><?= htmlspecialchars($resultData['track_title']) ?></strong> dengan hasil sangat memuaskan.
                            </p>

                            <!-- SCORE AND CERT NO BADGES -->
                            <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
                                <div class="bg-white bg-opacity-15 p-3 rounded-3 text-white border border-white border-opacity-25" style="min-width: 140px;">
                                    <small class="d-block text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Nilai Ujian</small>
                                    <span class="fs-2 fw-bold text-warning font-heading"><?= $resultData['score'] ?></span> / 100
                                </div>
                                <div class="bg-white bg-opacity-15 p-3 rounded-3 text-white border border-white border-opacity-25" style="min-width: 140px;">
                                    <small class="d-block text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Soal Benar</small>
                                    <span class="fs-2 fw-bold text-success font-heading"><?= $resultData['correct'] ?></span> / <?= $resultData['total'] ?>
                                </div>
                                <div class="bg-white bg-opacity-15 p-3 rounded-3 text-white border border-white border-opacity-25" style="min-width: 180px;">
                                    <small class="d-block text-white-50 text-uppercase fw-bold" style="font-size: 0.72rem;">Nomor Registrasi Kredensial</small>
                                    <span class="fs-5 fw-bold text-gold font-monospace"><?= htmlspecialchars($resultData['certificate_no']) ?></span>
                                </div>
                            </div>

                            <!-- CTA BUTTON TO CERTIFICATE -->
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="verify.php?cert=<?= urlencode($resultData['certificate_no']) ?>" class="btn btn-warning btn-lg fw-bold px-4 py-3 rounded-pill text-navy shadow">
                                    <i class="fa-solid fa-certificate me-2 fs-5"></i> Buka & Cetak Sertifikat Digital SKPI &raquo;
                                </a>
                                <a href="exam.php" class="btn btn-outline-light btn-lg fw-bold px-4 py-3 rounded-pill">
                                    <i class="fa-solid fa-rotate-right me-1"></i> Ambil Ujian Jalur Lain
                                </a>
                            </div>
                        </div>

                        <script>
                            // Confetti celebration animation
                            confetti({
                                particleCount: 120,
                                spread: 80,
                                origin: { y: 0.6 }
                            });
                        </script>

                    <?php else: ?>
                        <!-- FAILED STATE -->
                        <div class="exam-card text-center py-5 mb-4 border-danger border-opacity-50">
                            <div class="fs-1 text-danger mb-3"><i class="fa-solid fa-circle-xmark"></i></div>
                            <h2 class="fw-bold text-navy font-heading mb-2">Nilai Belum Mencapai Standar Kelulusan</h2>
                            <p class="text-muted mx-auto mb-4" style="max-width: 600px; line-height: 1.7;">
                                Nilai perolehan Anda adalah <strong class="text-danger fs-5"><?= $resultData['score'] ?>/100</strong> (<?= $resultData['correct'] ?> benar dari <?= $resultData['total'] ?> soal). Standar minimal kelulusan untuk penerbitan sertifikat resmi adalah <strong>80%</strong>.
                            </p>

                            <div class="p-3 rounded-3 bg-light border d-inline-block mx-auto mb-4 text-start small" style="max-width: 500px;">
                                <i class="fa-solid fa-lightbulb text-warning me-1"></i> <strong>Saran untuk Anda:</strong>
                                <span class="text-secondary d-block mt-1">Jangan berkecil hati! Silakan pelajari kembali modul materi pada jalur ini, baca penjelasan kunci jawaban di bawah, dan Anda dapat mengulang ujian ini kembali kapan saja.</span>
                            </div>

                            <div>
                                <a href="exam.php?action=start_exam&track=<?= urlencode($trackKey) ?>&recipient_name=<?= urlencode($resultData['recipient_name']) ?>" class="btn btn-navy text-white fw-bold px-4 py-3 rounded-pill shadow-sm" style="background: #0d2e5c;">
                                    <i class="fa-solid fa-rotate-left me-1 text-warning"></i> Ulangi Ujian Ini &raquo;
                                </a>
                                <a href="learn.php?c=<?= urlencode($trackKey) ?>" class="btn btn-outline-secondary fw-bold px-4 py-3 rounded-pill ms-2">
                                    <i class="fa-solid fa-book-open me-1"></i> Buka Modul Belajar
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

    <!-- FOOTER -->
    <footer class="py-4 bg-white border-top text-center text-muted small mt-5">
        <div class="container">
            <p class="mb-1 fw-semibold">&copy; <?= date('Y') ?> <strong>Skillance Academy Indonesia</strong> — Sistem Sertifikasi Kompetensi & Pengembangan Talenta Digital.</p>
            <p class="mb-0 text-muted" style="font-size: 0.75rem;">Sertifikat digital diterbitkan secara sah dan tersimpan permanen pada basis data kredensial Skillance.</p>
        </div>
    </footer>

<?php include_once __DIR__ . '/includes/spotlight_modal.php'; ?>
<script src="assets/js/spotlight.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
