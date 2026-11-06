<?php
session_start();
require_once __DIR__ . '/config/config.php';

// Check user login session
$isLoggedIn = !empty($_SESSION['user_id']);
$isDemo = !$isLoggedIn;

if ($isLoggedIn) {
    $userId = (int)$_SESSION['user_id'];
    $userName = $_SESSION['user_name'] ?? 'Mahasiswa Skillance';
    $userEmail = $_SESSION['user_email'] ?? '';
    $userPhoto = $_SESSION['user_photo'] ?? ('https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=0d2e5c&color=fff');
    $userType = $_SESSION['user_type'] ?? 'student';
} else {
    // Demo guest preview state
    $userId = 0;
    $userName = 'Fajar Nugraha (Demo Siswa)';
    $userEmail = 'fajar.nugraha@student.ac.id';
    $userPhoto = 'https://ui-avatars.com/api/?name=Fajar+Nugraha&background=0d2e5c&color=fca311';
    $userType = 'Mahasiswa Teknik Informatika';
}

// 1. Fetch Real or Demo Module Progress
$completedModules = [];
$totalModulesCount = 0;

if ($isLoggedIn && $conn) {
    $stmt = $conn->prepare("SELECT track_id, module_id, completed_at FROM `academy_module_progress` WHERE `user_id` = ? ORDER BY completed_at DESC");
    if ($stmt) {
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $res = $stmt->get_result();
        while ($row = $res->fetch_assoc()) {
            $completedModules[] = $row;
        }
        $stmt->close();
    }
}

// If demo or no modules yet, provide realistic rich demo data
if (empty($completedModules) && $isDemo) {
    $completedModules = [
        ['track_id' => 'web_frontend', 'module_id' => 'html_semantic', 'module_title' => 'HTML5 Semantik & Elemen Modern', 'completed_at' => date('Y-m-d H:i:s', strtotime('-1 day'))],
        ['track_id' => 'web_frontend', 'module_id' => 'css_flexbox', 'module_title' => 'CSS3 Flexbox & Layout Responsif', 'completed_at' => date('Y-m-d H:i:s', strtotime('-2 days'))],
        ['track_id' => 'web_frontend', 'module_id' => 'css_grid', 'module_title' => 'CSS3 Grid System Tingkat Lanjut', 'completed_at' => date('Y-m-d H:i:s', strtotime('-3 days'))],
        ['track_id' => 'web_frontend', 'module_id' => 'js_es6', 'module_title' => 'JavaScript Modern (ES6+, Arrow Function & Promise)', 'completed_at' => date('Y-m-d H:i:s', strtotime('-4 days'))],
        ['track_id' => 'web_frontend', 'module_id' => 'js_dom', 'module_title' => 'DOM Manipulation & Event Handling', 'completed_at' => date('Y-m-d H:i:s', strtotime('-5 days'))],
        ['track_id' => 'web_frontend', 'module_id' => 'vue_basics', 'module_title' => 'Vue.js 3 Reaktifitas & Single File Component (SFC)', 'completed_at' => date('Y-m-d H:i:s', strtotime('-6 days'))],
        ['track_id' => 'backend_api', 'module_id' => 'php_oop', 'module_title' => 'PHP 8.3 Pemrograman Berorientasi Objek (OOP)', 'completed_at' => date('Y-m-d H:i:s', strtotime('-8 days'))],
        ['track_id' => 'backend_api', 'module_id' => 'sql_indexing', 'module_title' => 'MySQL Relasional, Foreign Key & Query Indexing', 'completed_at' => date('Y-m-d H:i:s', strtotime('-10 days'))],
    ];
}
$totalModulesCount = count($completedModules);

// 2. Fetch Certificates
$certificates = [];
if ($isLoggedIn && $conn) {
    $stmtCert = $conn->prepare("SELECT * FROM `academy_certificates` WHERE `user_id` = ? OR `recipient_email` = ? ORDER BY id DESC");
    if ($stmtCert) {
        $stmtCert->bind_param("is", $userId, $userEmail);
        $stmtCert->execute();
        $resCert = $stmtCert->get_result();
        while ($row = $resCert->fetch_assoc()) {
            $certificates[] = $row;
        }
        $stmtCert->close();
    }
}

// Fallback demo certificate if demo
if (empty($certificates) && $isDemo) {
    $certificates = [
        [
            'certificate_no' => 'SKL-2026-FE-8877',
            'recipient_name' => $userName,
            'track_title' => 'Jalur Frontend Web Developer Modern',
            'score' => 96,
            'issue_date' => date('Y-m-d', strtotime('-3 days')),
            'competencies' => 'HTML5 Semantics, CSS3 Flexbox & Grid, JavaScript ES6+, DOM Manipulation, Bootstrap 5, Vue.js 3 SPA Component Architecture',
            'status' => 'active'
        ]
    ];
}

// 3. Fetch Downloaded Project Kits / Leads
$downloadedKits = [];
if ($isLoggedIn && $conn) {
    $stmtLead = $conn->prepare("SELECT product_id, product_title, downloaded_at FROM `academy_leads` WHERE `email` = ? OR `whatsapp` = ? ORDER BY id DESC");
    if ($stmtLead) {
        $userPhone = $_SESSION['user_phone'] ?? '';
        $stmtLead->bind_param("ss", $userEmail, $userPhone);
        $stmtLead->execute();
        $resLead = $stmtLead->get_result();
        while ($row = $resLead->fetch_assoc()) {
            $downloadedKits[] = $row;
        }
        $stmtLead->close();
    }
}

// Fallback demo kits
if (empty($downloadedKits)) {
    $downloadedKits = [
        [
            'product_id' => 'sidesa-laravel',
            'product_title' => 'Sistem Informasi Desa Mandiri & Layanan Surat Warga (SIDESA)',
            'downloaded_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
            'tech' => 'Laravel 11, Inertia.js, Vue 3, Tailwind',
            'pages' => '185 Halaman PDF',
            'status' => 'Sampel Bab 1 & Daftar Isi (Gratis)'
        ],
        [
            'product_id' => 'pos-kasir',
            'product_title' => 'Sistem Kasir Pintar (Point of Sale) & Cetak Struk Bluetooth Thermal',
            'downloaded_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
            'tech' => 'PHP 8.3, Laravel 11, Alpine.js, Web Bluetooth',
            'pages' => '150 Halaman PDF',
            'status' => 'Sampel Bab 1 & Daftar Isi (Gratis)'
        ]
    ];
}

// Average Exam Score
$avgScore = 0;
if (!empty($certificates)) {
    $scores = array_column($certificates, 'score');
    $avgScore = round(array_sum($scores) / count($scores));
} else {
    $avgScore = 92;
}

$adminWa = "6282291700778";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Belajar & Profil Siswa - Skillance Academy</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cinzel:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --navy: #0d2e5c;
            --navy-dark: #071a35;
            --gold: #fca311;
            --gold-dark: #d97706;
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

        /* Top Hub Bar */
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
            border-bottom: 2px solid var(--gold);
        }

        .course-nav-item {
            display: inline-block;
            padding: 10px 16px;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 0.82rem;
            font-weight: 700;
            letter-spacing: 0.3px;
            border-bottom: 3px solid transparent;
            transition: all 0.2s;
        }

        .course-nav-item:hover, .course-nav-item.active {
            color: #ffffff;
            border-bottom-color: var(--gold);
            background-color: rgba(255, 255, 255, 0.06);
        }

        /* Profile Banner */
        .dashboard-header {
            background: linear-gradient(135deg, #071a35 0%, #0d2e5c 65%, #1e3a8a 100%);
            color: #ffffff;
            padding: 45px 0 35px;
            position: relative;
        }

        .profile-avatar {
            width: 86px;
            height: 86px;
            border-radius: 50%;
            border: 4px solid #ffffff;
            box-shadow: 0 4px 14px rgba(0,0,0,0.25);
            object-fit: cover;
        }

        /* Metric KPI Card */
        .kpi-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 22px 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            transition: transform 0.2s, box-shadow 0.2s;
            height: 100%;
        }

        .kpi-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        }

        .kpi-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            margin-bottom: 12px;
        }

        /* Dashboard Tabs */
        .dash-nav-pills .nav-link {
            color: #475569;
            font-weight: 700;
            font-size: 0.92rem;
            padding: 12px 20px;
            border-radius: 12px;
            transition: all 0.2s;
            border: 1px solid transparent;
        }

        .dash-nav-pills .nav-link.active {
            background-color: var(--navy);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(13, 46, 92, 0.2);
        }

        /* Certificate Mini Card */
        .cert-vault-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 20px;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
        }

        .cert-vault-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 6px;
            height: 100%;
            background: var(--gold);
        }

        .cert-vault-card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.07);
            border-color: #cbd5e1;
        }

        /* Kit Card */
        .kit-vault-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 20px;
            height: 100%;
            display: flex;
            flex-column;
            justify-content: space-between;
        }
    </style>
</head>
<body>

    <?php
    $activeNav = 'my-learning';
    $showSubnav = false;
    include __DIR__ . '/includes/navbar.php';
    ?>

    <!-- PROFILE HEADER BANNER -->
    <header class="dashboard-header">
        <div class="container">
            <?php if ($isDemo): ?>
                <div class="alert alert-warning border-0 shadow-sm d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4 p-3 rounded-3">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-circle-info fs-5 text-warning"></i>
                        <span class="small text-dark">
                            <strong>Mode Pratinjau Demo:</strong> Anda saat ini sedang menjelajahi simulasi Dashboard Siswa. Masuk dengan akun Google untuk menyinkronkan progres Anda secara permanen.
                        </span>
                    </div>
                    <a href="https://skillance.my.id/auth/index.php" class="btn btn-navy text-white btn-sm rounded-pill fw-bold px-4" style="background: #0d2e5c;">
                        <i class="fa-brands fa-google text-warning me-1"></i> Masuk Sekarang &raquo;
                    </a>
                </div>
            <?php endif; ?>

            <div class="row align-items-center g-4">
                <div class="col-md-8 d-flex align-items-center gap-3">
                    <img src="<?= htmlspecialchars($userPhoto) ?>" alt="Avatar" class="profile-avatar">
                    <div>
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <h2 class="h4 fw-bold font-heading mb-0 text-white"><?= htmlspecialchars($userName) ?></h2>
                            <span class="badge bg-gold text-navy fw-bold small px-2 py-1 rounded-pill">
                                <i class="fa-solid fa-circle-check text-success me-1"></i> Verified Student
                            </span>
                        </div>
                        <p class="text-white-50 small mb-2"><?= htmlspecialchars($userEmail) ?> &bull; <?= htmlspecialchars($userType) ?></p>
                        <div class="d-flex flex-wrap gap-2">
                            <span class="badge bg-white bg-opacity-20 text-white rounded-pill px-3 py-1 small">
                                <i class="fa-solid fa-code me-1 text-warning"></i> Talenta Koding Indonesia
                            </span>
                            <span class="badge bg-white bg-opacity-20 text-white rounded-pill px-3 py-1 small">
                                <i class="fa-solid fa-shield-halved me-1 text-success"></i> SKPI Ready
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 text-md-end">
                    <div class="d-flex flex-column flex-sm-row justify-content-md-end gap-2">
                        <a href="https://skillance.my.id/dashboard/freelancer/" class="btn btn-warning fw-bold px-3 py-2 rounded-pill text-navy shadow-sm">
                            <i class="fa-solid fa-briefcase me-1"></i> Profil Bursa Freelance &raquo;
                        </a>
                        <?php if ($isLoggedIn): ?>
                            <a href="auth/logout.php" class="btn btn-outline-light btn-sm rounded-pill px-3 py-2">
                                <i class="fa-solid fa-arrow-right-from-bracket me-1"></i> Keluar
                            </a>
                        <?php else: ?>
                            <a href="https://skillance.my.id/auth/index.php" class="btn btn-outline-light btn-sm rounded-pill px-3 py-2">
                                <i class="fa-solid fa-arrow-right-to-bracket me-1"></i> Login Akun
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- MAIN DASHBOARD CONTENT -->
    <main class="container py-4">

        <!-- METRIC KPI ROW -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3">
                <div class="kpi-card">
                    <div class="kpi-icon bg-primary bg-opacity-10 text-primary">
                        <i class="fa-solid fa-book-open-reader"></i>
                    </div>
                    <div class="text-muted small fw-semibold">Materi Diselesaikan</div>
                    <div class="fs-3 fw-bold text-navy font-heading"><?= $totalModulesCount ?> <span class="fs-6 text-muted fw-normal">Modul</span></div>
                    <small class="text-success fw-bold" style="font-size: 0.72rem;"><i class="fa-solid fa-arrow-trend-up me-1"></i> Aktif Belajar</small>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="kpi-card">
                    <div class="kpi-icon bg-warning bg-opacity-10 text-warning">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <div class="text-muted small fw-semibold">Sertifikat Kelulusan</div>
                    <div class="fs-3 fw-bold text-navy font-heading"><?= count($certificates) ?> <span class="fs-6 text-muted fw-normal">Sertifikat</span></div>
                    <small class="text-primary fw-bold" style="font-size: 0.72rem;"><i class="fa-solid fa-qrcode me-1"></i> Terdaftar SKPI</small>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="kpi-card">
                    <div class="kpi-icon bg-danger bg-opacity-10 text-danger">
                        <i class="fa-solid fa-laptop-code"></i>
                    </div>
                    <div class="text-muted small fw-semibold">Koleksi Kit Proyek</div>
                    <div class="fs-3 fw-bold text-navy font-heading"><?= count($downloadedKits) ?> <span class="fs-6 text-muted fw-normal">E-Book</span></div>
                    <small class="text-danger fw-bold" style="font-size: 0.72rem;"><i class="fa-solid fa-file-pdf me-1"></i> Source Code Siap Pakai</small>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="kpi-card">
                    <div class="kpi-icon bg-success bg-opacity-10 text-success">
                        <i class="fa-solid fa-chart-line"></i>
                    </div>
                    <div class="text-muted small fw-semibold">Rata-rata Nilai Ujian</div>
                    <div class="fs-3 fw-bold text-navy font-heading"><?= $avgScore ?>%</div>
                    <small class="text-success fw-bold" style="font-size: 0.72rem;"><i class="fa-solid fa-circle-check me-1"></i> Grade A (Sangat Baik)</small>
                </div>
            </div>
        </div>

        <!-- DASHBOARD NAVIGATION TABS -->
        <ul class="nav dash-nav-pills gap-2 mb-4 bg-white p-2 rounded-3 border shadow-sm" id="dashTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tracks-tab" data-bs-toggle="tab" data-bs-target="#tracks-pane" type="button" role="tab">
                    <i class="fa-solid fa-bars-progress me-1"></i> Progres Materi Belajar (<?= $totalModulesCount ?>)
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="certs-tab" data-bs-toggle="tab" data-bs-target="#certs-pane" type="button" role="tab">
                    <i class="fa-solid fa-certificate me-1 text-gold"></i> Koleksi Sertifikat SKPI (<?= count($certificates) ?>)
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="kits-tab" data-bs-toggle="tab" data-bs-target="#kits-pane" type="button" role="tab">
                    <i class="fa-solid fa-book-bookmark me-1 text-danger"></i> E-Book & Kit Proyek (<?= count($downloadedKits) ?>)
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="freelance-tab" data-bs-toggle="tab" data-bs-target="#freelance-pane" type="button" role="tab">
                    <i class="fa-solid fa-briefcase me-1 text-success"></i> Integrasi Bursa Freelance
                </button>
            </li>
        </ul>

        <!-- TAB CONTENT -->
        <div class="tab-content" id="dashTabsContent">

            <!-- TAB 1: PROGRES MATERI BELAJAR -->
            <div class="tab-pane fade show active" id="tracks-pane" role="tabpanel">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="bg-white border rounded-3 p-4 shadow-sm mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5 class="fw-bold text-navy font-heading mb-0">Daftar Modul yang Telah Diselesaikan</h5>
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 small fw-bold">
                                    <i class="fa-solid fa-check-double me-1"></i> <?= $totalModulesCount ?> Dicentang Selesai
                                </span>
                            </div>
                            <p class="text-muted small mb-3">
                                Modul di bawah ini otomatis tercatat setiap kali Anda menyelesaikan latihan materi dan menekan tombol centang pemahaman di halaman tutorial koding.
                            </p>

                            <div class="list-group list-group-flush">
                                <?php foreach ($completedModules as $m): ?>
                                    <div class="list-group-item px-0 py-3 d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="bg-success bg-opacity-10 text-success rounded-circle p-2 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                                                <i class="fa-solid fa-circle-check fs-5"></i>
                                            </div>
                                            <div>
                                                <strong class="text-navy d-block small fw-bold">
                                                    <?= htmlspecialchars($m['module_title'] ?? $m['module_id']) ?>
                                                </strong>
                                                <span class="text-muted" style="font-size: 0.74rem;">
                                                    <i class="fa-solid fa-layer-group me-1"></i> Jalur: <?= strtoupper(str_replace('_', ' ', $m['track_id'])) ?> &bull; Diselesaikan: <?= date('d M Y, H:i', strtotime($m['completed_at'])) ?>
                                                </span>
                                            </div>
                                        </div>
                                        <a href="learn.php?c=html" class="btn btn-sm btn-outline-navy rounded-pill px-3" style="border-color: #0d2e5c; color: #0d2e5c; font-size: 0.78rem;">
                                            Buka Materi &raquo;
                                        </a>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>

                    <!-- SIDEBAR: REKOMENDASI MATERI & UJIAN -->
                    <div class="col-lg-4">
                        <div class="bg-white border rounded-3 p-4 shadow-sm mb-4">
                            <h6 class="fw-bold text-navy mb-2"><i class="fa-solid fa-award text-warning me-1"></i> Siap Menerbitkan Sertifikat?</h6>
                            <p class="text-muted small mb-3" style="line-height: 1.6;">
                                Jika Anda telah menyelesaikan materi, uji kemampuan Anda dalam <strong>Ujian Sertifikasi Resmi (30 Menit)</strong> untuk mendapatkan nomor registrasi sertifikat digital SKPI!
                            </p>
                            <a href="exam.php" class="btn btn-success w-100 fw-bold py-2 rounded-pill shadow-sm">
                                <i class="fa-solid fa-paper-plane me-1"></i> Ikuti Ujian Kelulusan &raquo;
                            </a>
                        </div>

                        <div class="bg-white border rounded-3 p-4 shadow-sm">
                            <h6 class="fw-bold text-navy mb-2"><i class="fa-solid fa-route text-primary me-1"></i> Roadmap Karier Anda</h6>
                            <p class="text-muted small mb-3" style="line-height: 1.6;">
                                Lihat posisi perkembangan keahlian Anda di peta kurikulum industri dari pemula hingga siap kerja profesional.
                            </p>
                            <a href="roadmap.php" class="btn btn-outline-navy w-100 fw-bold py-2 rounded-pill" style="border-color: #0d2e5c; color: #0d2e5c;">
                                <i class="fa-solid fa-map-location-dot me-1"></i> Buka Roadmap Lengkap &raquo;
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 2: KOLEKSI SERTIFIKAT SKPI -->
            <div class="tab-pane fade" id="certs-pane" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold text-navy font-heading mb-1">Koleksi Sertifikat Kredensial Resmi Anda</h5>
                        <p class="text-muted small mb-0">Setiap sertifikat memiliki nomor registrasi unik dan QR Code yang dapat divalidasi langsung oleh pihak kampus dan HRD perusahaan.</p>
                    </div>
                    <a href="exam.php" class="btn btn-success btn-sm rounded-pill px-3 py-2 fw-bold shadow-sm">
                        <i class="fa-solid fa-plus me-1"></i> Ambil Ujian Sertifikat Baru
                    </a>
                </div>

                <div class="row g-4">
                    <?php if (empty($certificates)): ?>
                        <div class="col-12">
                            <div class="bg-white border rounded-4 p-5 text-center shadow-sm">
                                <i class="fa-solid fa-certificate fs-1 text-muted mb-3"></i>
                                <h5 class="fw-bold text-navy mb-2">Belum Ada Sertifikat yang Diraih</h5>
                                <p class="text-muted small mb-4" style="max-width: 520px; margin: 0 auto;">
                                    Anda belum menyelesaikan ujian kompetensi kelulusan. Ikuti ujian 25 soal kuis dengan batas waktu 30 menit (passing grade 80%) untuk menerbitkan sertifikat digital pertama Anda!
                                </p>
                                <a href="exam.php" class="btn btn-success fw-bold px-4 py-2 rounded-pill shadow-sm">
                                    <i class="fa-solid fa-award me-1"></i> Mulai Ujian Sertifikasi Sekarang &raquo;
                                </a>
                            </div>
                        </div>
                    <?php else: ?>
                        <?php foreach ($certificates as $cert): ?>
                            <div class="col-md-6">
                                <div class="cert-vault-card shadow-sm h-100 d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <span class="badge bg-success-subtle text-success border border-success-subtle fw-bold rounded-pill px-2 py-1 small mb-1">
                                                    <i class="fa-solid fa-circle-check me-1"></i> SERTIFIKAT VALID
                                                </span>
                                                <h5 class="fw-bold text-navy font-heading mb-1 mt-1"><?= htmlspecialchars($cert['track_title']) ?></h5>
                                                <span class="text-muted font-monospace small">No. Seri: <strong><?= htmlspecialchars($cert['certificate_no']) ?></strong></span>
                                            </div>
                                            <div class="bg-light p-2 rounded-3 border text-center">
                                                <small class="d-block text-muted" style="font-size: 0.65rem;">NILAI</small>
                                                <strong class="fs-5 text-success font-heading"><?= $cert['score'] ?>%</strong>
                                            </div>
                                        </div>

                                        <p class="text-muted small mb-3" style="line-height: 1.6; font-size: 0.8rem;">
                                            <strong>Kompetensi:</strong> <?= htmlspecialchars($cert['competencies']) ?>
                                        </p>
                                    </div>

                                    <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                                        <small class="text-muted" style="font-size: 0.75rem;">
                                            Terbit: <?= date('d M Y', strtotime($cert['issue_date'])) ?>
                                        </small>
                                        <div class="d-flex gap-2">
                                            <button onclick="copyCertLink('<?= $cert['certificate_no'] ?>')" class="btn btn-outline-secondary btn-sm rounded-pill px-3" title="Salin Tautan">
                                                <i class="fa-regular fa-copy me-1"></i> Salin Link
                                            </button>
                                            <a href="verify.php?cert=<?= urlencode($cert['certificate_no']) ?>" target="_blank" class="btn btn-navy text-white btn-sm rounded-pill px-3 fw-bold" style="background: #0d2e5c;">
                                                <i class="fa-solid fa-qrcode me-1 text-gold"></i> Buka Sertifikat &raquo;
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- TAB 3: E-BOOK & KIT PROYEK -->
            <div class="tab-pane fade" id="kits-pane" role="tabpanel">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h5 class="fw-bold text-navy font-heading mb-1">E-Book & Kit Studi Kasus Riil Anda</h5>
                        <p class="text-muted small mb-0">Dokumen sampel bab 1 gratis yang telah Anda unduh dan akses materi panduan skripsi/freelance.</p>
                    </div>
                    <a href="projects.php" class="btn btn-warning btn-sm rounded-pill px-3 py-2 fw-bold text-navy shadow-sm">
                        <i class="fa-solid fa-book-open me-1"></i> Buka Katalog Kit Lengkap
                    </a>
                </div>

                <div class="row g-4">
                    <?php foreach ($downloadedKits as $kit): ?>
                        <div class="col-md-6">
                            <div class="kit-vault-card shadow-sm">
                                <div>
                                    <div class="d-flex align-items-center gap-3 mb-3">
                                        <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-3 fs-3 text-center d-flex align-items-center justify-content-center" style="width: 52px; height: 52px;">
                                            <i class="fa-solid fa-file-pdf"></i>
                                        </div>
                                        <div>
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-0 small mb-1 fw-bold">
                                                <?= $kit['status'] ?? 'E-Book Terdaftar' ?>
                                            </span>
                                            <h6 class="fw-bold text-navy mb-0" style="font-size: 0.95rem;"><?= htmlspecialchars($kit['product_title']) ?></h6>
                                        </div>
                                    </div>

                                    <div class="bg-light p-3 rounded-3 border mb-3 small" style="line-height: 1.7;">
                                        <div><strong>Teknologi:</strong> <?= $kit['tech'] ?? 'Laravel 11, MySQL, Full Source Code' ?></div>
                                        <div><strong>Format:</strong> <?= $kit['pages'] ?? '150+ Halaman PDF Siap Cetak' ?></div>
                                        <div class="text-muted mt-1" style="font-size: 0.72rem;">Diakses pada: <?= date('d M Y, H:i', strtotime($kit['downloaded_at'])) ?></div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between align-items-center pt-2">
                                    <a href="sample_preview.php?pid=<?= urlencode($kit['product_id']) ?>" class="btn btn-outline-danger btn-sm rounded-pill px-3 fw-bold">
                                        <i class="fa-solid fa-book-open-reader me-1"></i> Baca Sampel PDF &raquo;
                                    </a>
                                    <a href="https://wa.me/<?= $adminWa ?>?text=Halo%20Admin%20Skillance,%20saya%20tertarik%20membeli%20Full%20Source%20Code%20dan%20E-Book%20<?= urlencode($kit['product_title']) ?>" target="_blank" class="btn btn-success btn-sm rounded-pill px-3 fw-bold">
                                        <i class="fa-brands fa-whatsapp me-1"></i> Order Full Source Code
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- TAB 4: INTEGRASI BURSA FREELANCE -->
            <div class="tab-pane fade" id="freelance-pane" role="tabpanel">
                <div class="p-4 p-md-5 rounded-4 text-white shadow-lg position-relative overflow-hidden mb-4" style="background: linear-gradient(135deg, #071a35 0%, #0d2e5c 65%, #04AA6D 100%);">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <span class="badge bg-gold text-navy fw-bold px-3 py-2 rounded-pill mb-2 text-uppercase">
                                <i class="fa-solid fa-briefcase me-1"></i> Skillance Freelance Ecosystem
                            </span>
                            <h2 class="display-6 fw-bold font-heading mb-2 text-white">Hubungkan Prestasi Belajar Anda dengan Penghasilan Riil</h2>
                            <p class="text-white-50 mb-3" style="font-size: 0.98rem; line-height: 1.8;">
                                Setiap sertifikat kelulusan SKPI dan kit proyek yang Anda kuasai di Skillance Academy langsung menjadi nilai jual utama di <strong>Bursa Freelance Skillance</strong> untuk mendapatkan proyek pembuatan website, aplikasi UMKM, dan konsultasi IT dari klien bisnis!
                            </p>
                            <div class="d-flex flex-wrap gap-2 text-white-50 small mb-4">
                                <span class="badge bg-white bg-opacity-10 border border-white border-opacity-25 rounded-pill px-3 py-1"><i class="fa-solid fa-shield-halved text-warning me-1"></i> Badge Terverifikasi</span>
                                <span class="badge bg-white bg-opacity-10 border border-white border-opacity-25 rounded-pill px-3 py-1"><i class="fa-solid fa-hand-holding-dollar text-success me-1"></i> Komisi Pembayaran Aman</span>
                                <span class="badge bg-white bg-opacity-10 border border-white border-opacity-25 rounded-pill px-3 py-1"><i class="fa-solid fa-briefcase text-info me-1"></i> Ratusan Proyek UMKM Aktif</span>
                            </div>
                        </div>
                        <div class="col-lg-4 text-lg-end">
                            <a href="https://skillance.my.id/dashboard/freelancer/" class="btn btn-warning btn-lg fw-bold px-4 py-3 rounded-pill text-navy shadow w-100 mb-2">
                                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Buka Dashboard Freelancer &raquo;
                            </a>
                            <a href="https://skillance.my.id/bursa-freelance.php" class="btn btn-outline-light btn-sm rounded-pill px-4 py-2 w-100">
                                Cari Lowongan Proyek Terbuka
                            </a>
                        </div>
                    </div>
                </div>

                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="bg-white border rounded-3 p-4 shadow-sm h-100 text-center">
                            <div class="kpi-icon bg-primary bg-opacity-10 text-primary mx-auto mb-3">
                                <i class="fa-solid fa-id-card"></i>
                            </div>
                            <h6 class="fw-bold text-navy mb-2">1. Pasang Kredensial di CV</h6>
                            <p class="text-muted small mb-0" style="line-height: 1.6;">
                                Cantumkan tautan sertifikat QR Code Skillance Academy pada resume dan portofolio GitHub Anda untuk meyakinkan klien korporat.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-white border rounded-3 p-4 shadow-sm h-100 text-center">
                            <div class="kpi-icon bg-success bg-opacity-10 text-success mx-auto mb-3">
                                <i class="fa-solid fa-handshake"></i>
                            </div>
                            <h6 class="fw-bold text-navy mb-2">2. Terima Tawaran Proyek</h6>
                            <p class="text-muted small mb-0" style="line-height: 1.6;">
                                Dapatkan notifikasi saat ada pemilik toko, UMKM, atau dinas desa yang membutuhkan pembuatan website atau aplikasi POS kasir.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="bg-white border rounded-3 p-4 shadow-sm h-100 text-center">
                            <div class="kpi-icon bg-warning bg-opacity-10 text-warning mx-auto mb-3">
                                <i class="fa-solid fa-money-bill-wave"></i>
                            </div>
                            <h6 class="fw-bold text-navy mb-2">3. Pembayaran Masuk Rekening</h6>
                            <p class="text-muted small mb-0" style="line-height: 1.6;">
                                Dana proyek disimpan aman di escrow Skillance dan langsung dicairkan ke rekening bank Anda setelah hasil pekerjaan selesai disetujui klien.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </main>

    <!-- FOOTER -->
    <footer class="py-4 bg-white border-top text-center text-muted small mt-5">
        <div class="container">
            <p class="mb-1 fw-semibold">&copy; <?= date('Y') ?> <strong>Skillance Academy Indonesia</strong> — Dashboard Profil & Integrasi Karier Mahasiswa.</p>
            <p class="mb-0 text-muted" style="font-size: 0.75rem;">Platform inkubasi keterampilan teknologi dan bursa kerja digital terintegrasi se-Indonesia.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function copyCertLink(certNo) {
            const fullUrl = 'https://academy.skillance.cloud/verify.php?cert=' + encodeURIComponent(certNo);
            if (navigator.clipboard) {
                navigator.clipboard.writeText(fullUrl).then(() => {
                    alert('Tautan verifikasi sertifikat berhasil disalin ke clipboard:\n' + fullUrl);
                });
            } else {
                prompt('Salin tautan sertifikat:', fullUrl);
            }
        }
    </script>
<?php include_once __DIR__ . '/includes/spotlight_modal.php'; ?>
<script src="assets/js/spotlight.js"></script>
</body>
</html>
