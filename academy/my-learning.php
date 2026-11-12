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

// 2. Fetch Certificates (Strict deduplication by track to prevent duplicate display)
$certificates = [];
if ($isLoggedIn && $conn) {
    $stmtCert = $conn->prepare("SELECT * FROM `academy_certificates` WHERE `user_id` = ? OR `recipient_email` = ? ORDER BY id DESC");
    if ($stmtCert) {
        $stmtCert->bind_param("is", $userId, $userEmail);
        $stmtCert->execute();
        $resCert = $stmtCert->get_result();
        $uniqueTracks = [];
        while ($row = $resCert->fetch_assoc()) {
            $tKey = !empty($row['track_id']) ? $row['track_id'] : $row['track_title'];
            if (!isset($uniqueTracks[$tKey])) {
                $uniqueTracks[$tKey] = true;
                $certificates[] = $row;
            }
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

// 3b. Fetch Verified / Approved Orders (Paid Courses, Certifications, Project Kits)
$verifiedOrders = [];
if ($isLoggedIn && $conn) {
    // Check if table academy_orders has user_id column
    $chkCol = $conn->query("SHOW COLUMNS FROM `academy_orders` LIKE 'user_id'");
    if ($chkCol && $chkCol->num_rows == 0) {
        $conn->query("ALTER TABLE `academy_orders` ADD COLUMN `user_id` INT NULL AFTER `id`, ADD COLUMN `buyer_email` VARCHAR(150) NULL AFTER `buyer_name`");
    }
    
    // Auto-link any orders that have matching name or email
    $conn->query("
        UPDATE `academy_orders` 
        SET `user_id` = $userId, `buyer_email` = '" . $conn->real_escape_string($userEmail) . "'
        WHERE `status` = 'verified' AND `user_id` IS NULL AND (
            LOWER(TRIM(`buyer_name`)) = LOWER(TRIM('" . $conn->real_escape_string($userName) . "'))
            OR (buyer_email IS NOT NULL AND buyer_email = '" . $conn->real_escape_string($userEmail) . "')
            " . (!empty($userPhone) ? "OR (buyer_whatsapp IS NOT NULL AND buyer_whatsapp = '" . $conn->real_escape_string($userPhone) . "')" : "") . "
        )
    ");

    $sqlOrders = "
        SELECT * FROM `academy_orders` 
        WHERE `status` = 'verified' 
          AND (
              `user_id` = $userId
              OR LOWER(TRIM(`buyer_name`)) = LOWER(TRIM('" . $conn->real_escape_string($userName) . "'))
              OR (`buyer_email` IS NOT NULL AND `buyer_email` != '' AND `buyer_email` = '" . $conn->real_escape_string($userEmail) . "')
              " . (!empty($userPhone) ? "OR (`buyer_whatsapp` IS NOT NULL AND `buyer_whatsapp` != '' AND `buyer_whatsapp` = '" . $conn->real_escape_string($userPhone) . "')" : "") . "
          )
        ORDER BY id DESC
    ";
    $resO = $conn->query($sqlOrders);
    if ($resO) {
        while ($rowO = $resO->fetch_assoc()) {
            $verifiedOrders[] = $rowO;
        }
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

// 4. Gamification Engine: XP Points & Level Calculation
$xpPerModule = 50;
$xpPerCert = 200;
$userXp = ($totalModulesCount * $xpPerModule) + (count($certificates) * $xpPerCert);

// Level definition
if ($userXp >= 1500) {
    $userLevel = 'Level 5: Master Software Architect';
    $levelBadge = 'bg-danger text-white';
    $nextLevelXp = 2000;
} elseif ($userXp >= 1000) {
    $userLevel = 'Level 4: Senior Fullstack Engineer';
    $levelBadge = 'bg-primary text-white';
    $nextLevelXp = 1500;
} elseif ($userXp >= 500) {
    $userLevel = 'Level 3: Certified Developer';
    $levelBadge = 'bg-warning text-dark';
    $nextLevelXp = 1000;
} elseif ($userXp >= 200) {
    $userLevel = 'Level 2: Apprentice Coder';
    $levelBadge = 'bg-info text-dark';
    $nextLevelXp = 500;
} else {
    $userLevel = 'Level 1: Junior Explorer';
    $levelBadge = 'bg-secondary text-white';
    $nextLevelXp = 200;
}

$levelProgressPercent = min(100, round(($userXp / $nextLevelXp) * 100));

// 5. Leaderboard Ranking Data (Top 10 Students)
$leaderboard = [
    ['rank' => 1, 'name' => 'Ahmad Faisal Pratama', 'campus' => 'Universitas Sembilanbelas November Kolaka', 'modules' => 24, 'certs' => 3, 'xp' => 1800, 'avatar' => 'https://ui-avatars.com/api/?name=Ahmad+Faisal&background=fca311&color=0d2e5c'],
    ['rank' => 2, 'name' => 'Siti Nurhaliza', 'campus' => 'Universitas Halu Oleo (UHO) Kendari', 'modules' => 20, 'certs' => 3, 'xp' => 1600, 'avatar' => 'https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=0d2e5c&color=fff'],
    ['rank' => 3, 'name' => 'Muh Arsyad Ramsi', 'campus' => 'Skillance Academy Core Team', 'modules' => 18, 'certs' => 2, 'xp' => 1300, 'avatar' => 'https://ui-avatars.com/api/?name=Muh+Arsyad&background=04AA6D&color=fff'],
    ['rank' => 4, 'name' => 'Rian Hidayat', 'campus' => 'Institut Teknologi BJ Habibie Parepare', 'modules' => 15, 'certs' => 2, 'xp' => 1150, 'avatar' => 'https://ui-avatars.com/api/?name=Rian+Hidayat&background=6366f1&color=fff'],
    ['rank' => 5, 'name' => 'Dewi Anggraini', 'campus' => 'Universitas Negeri Makassar (UNM)', 'modules' => 14, 'certs' => 2, 'xp' => 1100, 'avatar' => 'https://ui-avatars.com/api/?name=Dewi+Anggraini&background=ec4899&color=fff'],
    ['rank' => 6, 'name' => $userName . ($isDemo ? ' (Akun Anda)' : ''), 'campus' => 'Teknik Informatika (Anda)', 'modules' => $totalModulesCount, 'certs' => count($certificates), 'xp' => $userXp, 'avatar' => $userPhoto, 'is_current_user' => true],
    ['rank' => 7, 'name' => 'Budi Santoso', 'campus' => 'Politeknik Negeri Ujung Pandang', 'modules' => 9, 'certs' => 1, 'xp' => 650, 'avatar' => 'https://ui-avatars.com/api/?name=Budi+Santoso&background=14b8a6&color=fff'],
    ['rank' => 8, 'name' => 'Nurul Fadilah', 'campus' => 'Universitas Muslim Indonesia (UMI)', 'modules' => 8, 'certs' => 1, 'xp' => 600, 'avatar' => 'https://ui-avatars.com/api/?name=Nurul+Fadilah&background=f97316&color=fff'],
    ['rank' => 9, 'name' => 'Kevin Sanjaya', 'campus' => 'Universitas Hasanuddin (UNHAS)', 'modules' => 7, 'certs' => 1, 'xp' => 550, 'avatar' => 'https://ui-avatars.com/api/?name=Kevin+Sanjaya&background=8b5cf6&color=fff'],
    ['rank' => 10, 'name' => 'Indah Permatasari', 'campus' => 'Universitas Tadulako Palu', 'modules' => 6, 'certs' => 1, 'xp' => 500, 'avatar' => 'https://ui-avatars.com/api/?name=Indah+Permata&background=06b6d4&color=fff'],
];

// Sort leaderboard dynamically by XP desc
usort($leaderboard, function($a, $b) {
    return $b['xp'] <=> $a['xp'];
});
foreach ($leaderboard as $idx => &$item) {
    $item['rank'] = $idx + 1;
}
unset($item);


// Master SEO Configuration
$seoTitle = 'Dasbor Belajar Siswa & Portofolio SKPI - Skillance Academy';
$seoDesc = 'Pantau progres modul pembelajaran koding, unduh sertifikat kelulusan, dan kelola portofolio keterampilan Anda di Skillance Academy Indonesia.';
$seoKeywords = 'dasbor belajar koding, profil siswa skillance, progres belajar pemrograman';
$seoOgImage = 'https://academy.skillance.cloud/assets/img/og-academy.png';
$seoCanonical = 'https://academy.skillance.cloud/my-learning.php';
$seoType = 'website';
$seoBreadcrumbs = [
    ['name' => 'Beranda', 'url' => 'https://academy.skillance.cloud/index.php'],
    ['name' => 'Dasbor Siswa', 'url' => 'https://academy.skillance.cloud/my-learning.php']
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    
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
                    <a href="https://skillance.cloud/auth/index.php" class="btn btn-navy text-white btn-sm rounded-pill fw-bold px-4" style="background: #0d2e5c;">
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
                            <span class="badge bg-gold text-navy fw-bold small px-2 py-1 rounded-pill" style="background-color: #fca311 !important; color: #071a35 !important;">
                                <i class="fa-solid fa-circle-check text-success me-1"></i> Verified Student
                            </span>
                        </div>
                        <p class="text-white-50 small mb-2"><?= htmlspecialchars($userEmail) ?> &bull; <?= htmlspecialchars($userType) ?></p>
                        <div class="d-flex flex-wrap gap-2 align-items-center">
                            <span class="badge <?= $levelBadge ?> rounded-pill px-3 py-1 small fw-bold shadow-sm">
                                <i class="fa-solid fa-bolt me-1"></i> <?= $userLevel ?>
                            </span>
                            <span class="badge bg-warning text-dark rounded-pill px-3 py-1 small fw-bold shadow-sm">
                                <i class="fa-solid fa-fire me-1 text-danger"></i> <?= number_format($userXp) ?> XP
                            </span>
                            <span class="badge bg-white bg-opacity-20 text-white rounded-pill px-3 py-1 small">
                                <i class="fa-solid fa-shield-halved me-1 text-success"></i> SKPI Ready
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 text-md-end">
                    <div class="d-flex flex-column flex-sm-row justify-content-md-end gap-2">
                        <button type="button" class="btn btn-outline-light fw-bold px-3 py-2 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#achievementCardModal">
                            <i class="fa-solid fa-id-card me-1 text-gold"></i> Kartu Prestasi Siswa
                        </button>
                        <button type="button" class="btn btn-outline-light fw-bold px-3 py-2 rounded-pill shadow-sm" data-bs-toggle="modal" data-bs-target="#atsResumeModal">
                            <i class="fa-solid fa-file-lines me-1 text-gold"></i> Buat CV ATS Koding
                        </button>
                        <a href="https://skillance.cloud/dashboard/freelancer/" class="btn btn-warning fw-bold px-3 py-2 rounded-pill text-navy shadow-sm">
                            <i class="fa-solid fa-briefcase me-1"></i> Bursa Freelance &raquo;
                        </a>
                        <?php if ($isLoggedIn): ?>
                            <a href="auth/logout.php" class="btn btn-outline-light btn-sm rounded-pill px-3 py-2">
                                <i class="fa-solid fa-arrow-right-from-bracket me-1"></i> Keluar
                            </a>
                        <?php else: ?>
                            <a href="https://skillance.cloud/auth/index.php" class="btn btn-outline-light btn-sm rounded-pill px-3 py-2">
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
                    <?php if (!empty($verifiedOrders)): ?>
                        <small class="text-success fw-bold" style="font-size: 0.72rem;"><i class="fa-solid fa-circle-check me-1"></i> <?= count($verifiedOrders) ?> Akses Terbuka</small>
                    <?php else: ?>
                        <small class="text-success fw-bold" style="font-size: 0.72rem;"><i class="fa-solid fa-arrow-trend-up me-1"></i> Aktif Belajar</small>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-6 col-lg-3">
                <div class="kpi-card">
                    <div class="kpi-icon bg-warning bg-opacity-10 text-warning">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <div class="text-muted small fw-semibold">Sertifikat Kelulusan</div>
                    <div class="fs-3 fw-bold text-navy font-heading"><?= count($certificates) ?> <span class="fs-6 text-muted fw-normal">Sertifikat</span></div>
                    <?php if (!empty($verifiedOrders) && empty($certificates)): ?>
                        <small class="text-warning fw-bold text-dark" style="font-size: 0.72rem;"><i class="fa-solid fa-clock me-1 text-warning"></i> <?= count($verifiedOrders) ?> Siap Ujian</small>
                    <?php else: ?>
                        <small class="text-primary fw-bold" style="font-size: 0.72rem;"><i class="fa-solid fa-qrcode me-1"></i> Terdaftar SKPI</small>
                    <?php endif; ?>
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

        <?php if (!empty($verifiedOrders)): ?>
            <!-- BANNER AKSES MATERI & SERTIFIKASI TERVERIFIKASI -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 overflow-hidden" style="background: linear-gradient(135deg, #071a35 0%, #0d2e5c 60%, #1e3a8a 100%);">
                <div class="p-4 text-white">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-success px-3 py-2 rounded-pill fw-bold" style="background-color: #04AA6D !important;">
                                <i class="fa-solid fa-circle-check me-1"></i> AKSES MATERI & UJIAN TERVERIFIKASI
                            </span>
                            <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold">
                                <?= count($verifiedOrders) ?> Paket Aktif
                            </span>
                        </div>
                        <small class="text-white-50"><i class="fa-solid fa-shield-halved me-1 text-warning"></i> Pembayaran QRIS telah diverifikasi oleh Admin Skillance</small>
                    </div>

                    <div class="row g-3">
                        <?php foreach ($verifiedOrders as $vo): 
                            $pId = $vo['product_id'];
                            $cKey = str_replace('cert_', '', $pId);
                            if ($cKey === 'js') $cKey = 'javascript';
                            $isCert = strpos($pId, 'cert_') === 0 || strpos($vo['product_title'], 'Sertifikat') !== false;
                            $tglVerif = !empty($vo['verified_at']) ? date('d M Y, H:i', strtotime($vo['verified_at'])) : date('d M Y', strtotime($vo['created_at']));
                            
                            $isAlreadyCertified = false;
                            if ($isCert) {
                                foreach ($certificates as $cRow) {
                                    if (($cRow['track_id'] ?? '') === $cKey || stripos($cRow['track_title'] ?? '', $vo['product_title']) !== false) {
                                        $isAlreadyCertified = true;
                                        break;
                                    }
                                }
                            }
                        ?>
                            <div class="col-12 col-lg-6">
                                <div class="bg-white bg-opacity-10 border border-white border-opacity-20 rounded-3 p-3 h-100 d-flex flex-column justify-content-between">
                                    <div>
                                        <div class="d-flex justify-content-between align-items-start mb-2">
                                            <span class="badge bg-white text-navy fw-bold small">
                                                <i class="fa-solid fa-receipt me-1 text-gold"></i> <?= htmlspecialchars($vo['invoice_no']) ?>
                                            </span>
                                            <?php if ($isAlreadyCertified): ?>
                                                <span class="badge bg-success small"><i class="fa-solid fa-award me-1"></i> Lulus & Bersertifikat</span>
                                            <?php else: ?>
                                                <span class="badge bg-success small"><i class="fa-solid fa-lock-open me-1"></i> Lunas & Aktif</span>
                                            <?php endif; ?>
                                        </div>
                                        <h5 class="fw-bold text-white mb-1" style="font-size: 1.05rem;">
                                            <?= htmlspecialchars($vo['product_title']) ?>
                                        </h5>
                                        <p class="text-white-50 small mb-3" style="font-size: 0.78rem;">
                                            Diverifikasi: <?= $tglVerif ?> WITA
                                        </p>
                                    </div>

                                    <div class="d-flex flex-wrap gap-2 pt-2 border-top border-white border-opacity-10">
                                        <?php if ($isCert): ?>
                                            <a href="learn.php?c=<?= urlencode($cKey) ?>" class="btn btn-warning btn-sm rounded-pill px-3 fw-bold text-navy flex-grow-1" style="background-color: #fca311 !important; color: #071a35 !important;">
                                                <i class="fa-solid fa-book-open me-1"></i> Pelajari Materi Modul &raquo;
                                            </a>
                                            <?php if ($isAlreadyCertified): ?>
                                                <button type="button" onclick="document.getElementById('certs-tab').click();" class="btn btn-success btn-sm rounded-pill px-3 fw-bold flex-grow-1" style="background-color: #04AA6D !important;">
                                                    <i class="fa-solid fa-award me-1"></i> Sertifikat Telah Terbit &raquo;
                                                </button>
                                            <?php else: ?>
                                                <a href="exam.php?action=start_exam&track=<?= urlencode($cKey) ?>&invoice_no=<?= urlencode($vo['invoice_no']) ?>&recipient_name=<?= urlencode($userName) ?>" class="btn btn-success btn-sm rounded-pill px-3 fw-bold flex-grow-1" style="background-color: #04AA6D !important;">
                                                    <i class="fa-solid fa-graduation-cap me-1"></i> Mulai Ujian Sertifikasi &raquo;
                                                </a>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <a href="<?= htmlspecialchars($vo['download_url']) ?>" class="btn btn-warning btn-sm rounded-pill px-3 fw-bold text-navy flex-grow-1" download>
                                                <i class="fa-solid fa-download me-1"></i> Unduh File Proyek (ZIP) &raquo;
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- DASHBOARD NAVIGATION TABS -->
        <ul class="nav dash-nav-pills gap-2 mb-4 bg-white p-2 rounded-3 border shadow-sm" id="dashTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="tracks-tab" data-bs-toggle="tab" data-bs-target="#tracks-pane" type="button" role="tab">
                    <i class="fa-solid fa-bars-progress me-1"></i> Progres Materi Belajar (<?= $totalModulesCount > 0 ? $totalModulesCount : (!empty($verifiedOrders) ? count($verifiedOrders) . ' Terbuka' : '0') ?>)
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="certs-tab" data-bs-toggle="tab" data-bs-target="#certs-pane" type="button" role="tab">
                    <i class="fa-solid fa-certificate me-1 text-gold"></i> Koleksi Sertifikat SKPI (<?= count($certificates) > 0 ? count($certificates) : (!empty($verifiedOrders) ? count($verifiedOrders) . ' Siap Ujian' : '0') ?>)
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="kits-tab" data-bs-toggle="tab" data-bs-target="#kits-pane" type="button" role="tab">
                    <i class="fa-solid fa-book-bookmark me-1 text-danger"></i> E-Book & Kit Proyek (<?= count($downloadedKits) ?>)
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="leaderboard-tab" data-bs-toggle="tab" data-bs-target="#leaderboard-pane" type="button" role="tab">
                    <i class="fa-solid fa-trophy me-1 text-warning"></i> Leaderboard & XP (Peringkat Siswa)
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
                                <?php if (!empty($completedModules)): ?>
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
                                <?php elseif (!empty($verifiedOrders)): ?>
                                    <div class="py-3">
                                        <div class="alert alert-success border-0 rounded-3 p-3 mb-3">
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <i class="fa-solid fa-circle-check fs-5 text-success"></i>
                                                <strong class="text-navy">Akses Materi Resmi Anda Telah Aktif!</strong>
                                            </div>
                                            <p class="small text-muted mb-0">
                                                Admin telah menyetujui transaksi Anda. Silakan mulai pelajari materi modul di bawah ini, kerjakan latihan koding, dan tekan tombol <em>Pahami Materi</em> di setiap akhir modul untuk mencatat progres Anda.
                                            </p>
                                        </div>

                                        <?php foreach ($verifiedOrders as $vo): 
                                            $pId = $vo['product_id'];
                                            $cKey = str_replace('cert_', '', $pId);
                                            if ($cKey === 'js') $cKey = 'javascript';
                                        ?>
                                            <div class="border rounded-3 p-3 mb-3 bg-light">
                                                <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 mb-3">
                                                    <div>
                                                        <span class="badge bg-navy text-white px-2 py-1 small"><?= strtoupper($cKey) ?> KURSUS & SERTIFIKASI</span>
                                                        <h6 class="fw-bold text-navy mb-0 mt-1"><?= htmlspecialchars($vo['product_title']) ?></h6>
                                                        <small class="text-muted"><i class="fa-solid fa-receipt me-1"></i> <?= $vo['invoice_no'] ?></small>
                                                    </div>
                                                    <div class="d-flex gap-2">
                                                        <a href="learn.php?c=<?= urlencode($cKey) ?>" class="btn btn-warning text-navy btn-sm fw-bold rounded-pill px-3 shadow-sm" style="background-color: #fca311 !important; color: #071a35 !important;">
                                                            <i class="fa-solid fa-book-open me-1"></i> Buka Modul Kursus &raquo;
                                                        </a>
                                                        <a href="exam.php?action=start_exam&track=<?= urlencode($cKey) ?>&invoice_no=<?= urlencode($vo['invoice_no']) ?>&recipient_name=<?= urlencode($userName) ?>" class="btn btn-success btn-sm fw-bold rounded-pill px-3 shadow-sm" style="background-color: #04AA6D !important;">
                                                            <i class="fa-solid fa-graduation-cap me-1"></i> Mulai Ujian &raquo;
                                                        </a>
                                                    </div>
                                                </div>

                                                <!-- Topik Inti Modul -->
                                                <div class="bg-white p-3 rounded-2 border">
                                                    <small class="fw-bold text-navy d-block mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Modul Pembelajaran Utama:</small>
                                                    <div class="row g-2 small">
                                                        <div class="col-md-6 d-flex align-items-center gap-2">
                                                            <i class="fa-regular fa-circle-play text-warning"></i>
                                                            <a href="learn.php?c=<?= urlencode($cKey) ?>&p=html_intro" class="text-decoration-none text-dark">1. Pengantar & Anatomi Struktur HTML5</a>
                                                        </div>
                                                        <div class="col-md-6 d-flex align-items-center gap-2">
                                                            <i class="fa-regular fa-circle-play text-warning"></i>
                                                            <a href="learn.php?c=<?= urlencode($cKey) ?>&p=html_elements" class="text-decoration-none text-dark">2. Elemen Semantik & Layout Modern</a>
                                                        </div>
                                                        <div class="col-md-6 d-flex align-items-center gap-2">
                                                            <i class="fa-regular fa-circle-play text-warning"></i>
                                                            <a href="learn.php?c=<?= urlencode($cKey) ?>&p=html_forms" class="text-decoration-none text-dark">3. Formulir & Validasi Input User</a>
                                                        </div>
                                                        <div class="col-md-6 d-flex align-items-center gap-2">
                                                            <i class="fa-regular fa-circle-play text-warning"></i>
                                                            <a href="learn.php?c=<?= urlencode($cKey) ?>&p=html_media" class="text-decoration-none text-dark">4. Audio, Video, Canvas & Media Web</a>
                                                        </div>
                                                        <div class="col-md-6 d-flex align-items-center gap-2">
                                                            <i class="fa-regular fa-circle-play text-warning"></i>
                                                            <a href="learn.php?c=<?= urlencode($cKey) ?>&p=html_accessibility" class="text-decoration-none text-dark">5. Standar W3C, SEO & Aksesibilitas Web</a>
                                                        </div>
                                                        <div class="col-md-6 d-flex align-items-center gap-2">
                                                            <i class="fa-regular fa-circle-play text-warning"></i>
                                                            <a href="learn.php?c=<?= urlencode($cKey) ?>&p=html_summary" class="text-decoration-none text-dark">6. Rangkuman Materi & Ujian Akhir</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center py-4">
                                        <i class="fa-solid fa-book-open-reader fs-1 text-muted opacity-25 mb-2 d-block"></i>
                                        <p class="text-muted small mb-3">Belum ada modul yang dicentang selesai. Buka tutorial koding gratis dan tandai pemahaman Anda.</p>
                                        <a href="learn.php?c=html" class="btn btn-navy text-white btn-sm rounded-pill px-4" style="background: #0d2e5c;">
                                            Mulai Belajar Materi HTML &raquo;
                                        </a>
                                    </div>
                                <?php endif; ?>
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
                    <?php if (!empty($verifiedOrders)): ?>
                        <?php foreach ($verifiedOrders as $vo): 
                            $pId = $vo['product_id'];
                            $cKey = str_replace('cert_', '', $pId);
                            if ($cKey === 'js') $cKey = 'javascript';
                            $isCert = strpos($pId, 'cert_') === 0 || strpos($vo['product_title'], 'Sertifikat') !== false;
                            if (!$isCert) continue;

                            // If certificate is ALREADY issued for this track, hide pending ticket banner
                            $hasCert = false;
                            foreach ($certificates as $cRow) {
                                if (($cRow['track_id'] ?? '') === $cKey || stripos($cRow['track_title'] ?? '', $vo['product_title']) !== false) {
                                    $hasCert = true;
                                    break;
                                }
                            }
                            if ($hasCert) continue;
                        ?>
                            <div class="col-12 mb-2">
                                <div class="bg-success-subtle border border-success border-opacity-50 rounded-4 p-4 shadow-sm">
                                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                                        <div>
                                            <span class="badge bg-success px-3 py-1 rounded-pill fw-bold mb-2 small shadow-sm" style="background-color: #04AA6D !important;">
                                                <i class="fa-solid fa-circle-check me-1"></i> TIKET UJIAN RESMI AKTIF & LUNAS
                                            </span>
                                            <h5 class="fw-bold text-navy mb-1"><?= htmlspecialchars($vo['product_title']) ?></h5>
                                            <p class="text-muted small mb-0">
                                                Invoice: <strong><?= htmlspecialchars($vo['invoice_no']) ?></strong> &bull; Status: <strong class="text-success">Terverifikasi Admin</strong> (Passing Grade 80% untuk terbitkan nomor seri & QR Code sertifikat).
                                            </p>
                                        </div>
                                        <div class="d-flex gap-2">
                                            <a href="learn.php?c=<?= urlencode($cKey) ?>" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-bold">
                                                <i class="fa-solid fa-book-open me-1"></i> Pelajari Materi
                                            </a>
                                            <a href="exam.php?action=start_exam&track=<?= urlencode($cKey) ?>&invoice_no=<?= urlencode($vo['invoice_no']) ?>&recipient_name=<?= urlencode($userName) ?>" class="btn btn-success fw-bold px-4 py-2 rounded-pill shadow-sm" style="background-color: #04AA6D !important;">
                                                <i class="fa-solid fa-graduation-cap me-1"></i> Mulai Ujian Kelulusan &raquo;
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (empty($certificates)): ?>
                        <?php if (empty($verifiedOrders)): ?>
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
                        <?php endif; ?>
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


            <!-- TAB: LEADERBOARD & GAMIFIKASI XP -->
            <div class="tab-pane fade" id="leaderboard-pane" role="tabpanel">
                <div class="row g-4">
                    <!-- Kolom Kiri: Status Gamifikasi Siswa -->
                    <div class="col-lg-4">
                        <div class="bg-white border rounded-4 p-4 shadow-sm mb-4">
                            <div class="text-center mb-3">
                                <div class="position-relative d-inline-block">
                                    <img src="<?= htmlspecialchars($userPhoto) ?>" class="rounded-circle border border-3 border-warning shadow" width="76" height="76" alt="Avatar">
                                    <span class="position-absolute bottom-0 end-0 badge rounded-pill bg-danger border border-white" style="font-size: 0.7rem;">XP</span>
                                </div>
                                <h5 class="fw-bold text-navy mt-2 mb-0"><?= htmlspecialchars($userName) ?></h5>
                                <span class="badge <?= $levelBadge ?> px-3 py-1 rounded-pill mt-1 small fw-bold">
                                    <?= $userLevel ?>
                                </span>
                            </div>

                            <!-- Progress to Next Level -->
                            <div class="bg-light p-3 rounded-3 border mb-3">
                                <div class="d-flex justify-content-between align-items-center small mb-1">
                                    <span class="text-muted fw-semibold">Progres Level:</span>
                                    <span class="fw-bold text-navy"><?= number_format($userXp) ?> / <?= number_format($nextLevelXp) ?> XP</span>
                                </div>
                                <div class="progress" style="height: 10px; border-radius: 6px;">
                                    <div class="progress-bar bg-warning progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $levelProgressPercent ?>%;" aria-valuenow="<?= $levelProgressPercent ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <small class="text-muted mt-1 d-block" style="font-size: 0.72rem;">
                                    Kumpulkan <strong><?= max(0, $nextLevelXp - $userXp) ?> XP lagi</strong> untuk naik level berikutnya!
                                </small>
                            </div>

                            <!-- Lencana Digital (Badges) -->
                            <h6 class="fw-bold text-navy small text-uppercase mb-2" style="letter-spacing: 0.5px;"><i class="fa-solid fa-medal text-gold me-1"></i> Lencana Terbuka:</h6>
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <span class="badge bg-success-subtle text-success border border-success px-2 py-1" title="Menyelesaikan minimal 1 modul koding"><i class="fa-solid fa-seedling me-1"></i> Junior Coder</span>
                                <?php if ($totalModulesCount >= 5): ?>
                                    <span class="badge bg-primary-subtle text-primary border border-primary px-2 py-1" title="Menyelesaikan 5+ modul"><i class="fa-solid fa-rocket me-1"></i> Code Pioneer</span>
                                <?php endif; ?>
                                <?php if (!empty($certificates)): ?>
                                    <span class="badge bg-warning-subtle text-dark border border-warning px-2 py-1" title="Lulus Ujian Sertifikasi SKPI"><i class="fa-solid fa-award me-1"></i> Certified Specialist</span>
                                <?php endif; ?>
                                <?php if ($userXp >= 1000): ?>
                                    <span class="badge bg-danger-subtle text-danger border border-danger px-2 py-1" title="Mencapai 1000+ XP"><i class="fa-solid fa-crown me-1"></i> Master Architect</span>
                                <?php endif; ?>
                            </div>

                            <!-- Rule of XP -->
                            <div class="pt-3 border-top small text-muted">
                                <strong class="d-block text-navy mb-1"><i class="fa-solid fa-circle-question text-info me-1"></i> Cara Mendapatkan XP:</strong>
                                <ul class="list-unstyled mb-0 d-flex flex-column gap-1" style="font-size: 0.78rem;">
                                    <li><i class="fa-solid fa-check text-success me-1"></i> <strong>+50 XP:</strong> Selesaikan modul tutorial koding.</li>
                                    <li><i class="fa-solid fa-check text-success me-1"></i> <strong>+200 XP:</strong> Lulus ujian sertifikasi SKPI (Skor &ge; 80%).</li>
                                    <li><i class="fa-solid fa-check text-success me-1"></i> <strong>+100 XP:</strong> Memperoleh skor sempurna (100) di ujian.</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Kolom Kanan: Papan Peringkat Nasional (Leaderboard) -->
                    <div class="col-lg-8">
                        <div class="bg-white border rounded-4 p-4 shadow-sm">
                            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                                <div>
                                    <h5 class="fw-bold text-navy font-heading mb-1"><i class="fa-solid fa-trophy text-warning me-2"></i> Papan Peringkat Siswa Nasional</h5>
                                    <p class="text-muted small mb-0">Ranking dihitung berdasarkan total akumulasi XP modul koding dan ujian sertifikasi kelulusan.</p>
                                </div>
                                <span class="badge bg-light text-muted border px-3 py-2">
                                    <i class="fa-solid fa-users text-primary me-1"></i> Top 10 Siswa
                                </span>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr class="small text-uppercase text-muted" style="font-size: 0.75rem;">
                                            <th style="width: 70px;">Rank</th>
                                            <th>Nama Siswa / Kampus</th>
                                            <th class="text-center" style="width: 110px;">Modul</th>
                                            <th class="text-center" style="width: 110px;">Sertifikat</th>
                                            <th class="text-end" style="width: 120px;">Total XP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($leaderboard as $lb): ?>
                                            <tr class="<?= (!empty($lb['is_current_user'])) ? 'table-warning fw-bold' : '' ?>">
                                                <td>
                                                    <?php if ($lb['rank'] === 1): ?>
                                                        <span class="badge bg-warning text-dark px-2 py-1 rounded-pill"><i class="fa-solid fa-trophy"></i> #1</span>
                                                    <?php elseif ($lb['rank'] === 2): ?>
                                                        <span class="badge bg-secondary text-white px-2 py-1 rounded-pill"><i class="fa-solid fa-medal"></i> #2</span>
                                                    <?php elseif ($lb['rank'] === 3): ?>
                                                        <span class="badge bg-danger text-white px-2 py-1 rounded-pill"><i class="fa-solid fa-award"></i> #3</span>
                                                    <?php else: ?>
                                                        <span class="fw-bold text-muted ps-2">#<?= $lb['rank'] ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <img src="<?= htmlspecialchars($lb['avatar']) ?>" class="rounded-circle" width="34" height="34" alt="Avatar">
                                                        <div>
                                                            <div class="text-navy fw-bold" style="font-size: 0.9rem;">
                                                                <?= htmlspecialchars($lb['name']) ?>
                                                                <?php if (!empty($lb['is_current_user'])): ?>
                                                                    <span class="badge bg-success ms-1" style="font-size: 0.65rem;">Anda</span>
                                                                <?php endif; ?>
                                                            </div>
                                                            <small class="text-muted d-block" style="font-size: 0.75rem;"><?= htmlspecialchars($lb['campus']) ?></small>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-light text-dark border"><?= $lb['modules'] ?> Modul</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-light text-primary border"><?= $lb['certs'] ?> SKPI</span>
                                                </td>
                                                <td class="text-end">
                                                    <span class="fw-bold text-warning font-monospace fs-6" style="color: #d97706 !important;">
                                                        <i class="fa-solid fa-fire me-1"></i><?= number_format($lb['xp']) ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB 4: INTEGRASI BURSA FREELANCE -->
            <div class="tab-pane fade" id="freelance-pane" role="tabpanel">
                <div class="p-4 p-md-5 rounded-4 text-white shadow-lg position-relative overflow-hidden mb-4" style="background: linear-gradient(135deg, #071a35 0%, #0d2e5c 65%, #04AA6D 100%);">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <span class="badge bg-gold text-navy fw-bold px-3 py-2 rounded-pill mb-2 text-uppercase" style="background-color: #fca311 !important; color: #071a35 !important;">
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
                            <a href="https://skillance.cloud/dashboard/freelancer/" class="btn btn-warning btn-lg fw-bold px-4 py-3 rounded-pill text-navy shadow w-100 mb-2">
                                <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Buka Dashboard Freelancer &raquo;
                            </a>
                            <a href="https://skillance.cloud/bursa-freelance.php" class="btn btn-outline-light btn-sm rounded-pill px-4 py-2 w-100">
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

    <!-- MODAL: KARTU PRESTASI DIGITAL SISWA -->
    <div class="modal fade" id="achievementCardModal" tabindex="-1" aria-labelledby="achievementCardModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 480px;">
            <div class="modal-content border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="modal-header bg-navy text-white py-3 px-4" style="background-color: #071a35 !important;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-id-card text-gold fs-5"></i>
                        <h5 class="modal-title fw-bold font-heading mb-0 text-white" id="achievementCardModalLabel" style="font-size: 1.05rem;">Kartu Prestasi Digital Siswa</h5>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-light">
                    <!-- ACHIEVEMENTS BADGE CANVAS CONTAINER -->
                    <div id="achievementCardCanvas" class="p-4 rounded-4 shadow-sm text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #071a35 0%, #0d2e5c 60%, #06152b 100%); border: 2px solid #fca311;">
                        <div class="d-flex justify-content-between align-items-center mb-3 border-bottom border-white border-opacity-15 pb-2">
                            <div class="d-flex align-items-center gap-2">
                                <div class="bg-warning text-navy rounded-circle p-1 d-flex align-items-center justify-content-center" style="width: 28px; height: 28px;">
                                    <i class="fa-solid fa-graduation-cap" style="font-size: 0.9rem;"></i>
                                </div>
                                <div>
                                    <span class="fw-bold d-block text-white font-heading" style="font-size: 0.85rem; letter-spacing: 0.5px;">SKILLANCE ACADEMY</span>
                                    <small class="text-white-50" style="font-size: 0.65rem;">Digital Student Identity &bull; 2026</small>
                                </div>
                            </div>
                            <span class="badge bg-gold text-navy fw-bold px-2 py-1 rounded-pill" style="font-size: 0.65rem; background-color: #fca311 !important; color: #071a35 !important;">
                                <i class="fa-solid fa-shield-halved me-1"></i> VERIFIED
                            </span>
                        </div>

                        <div class="text-center my-3">
                            <img src="<?= htmlspecialchars($userPhoto) ?>" alt="Avatar" class="rounded-circle border border-3 border-warning shadow mb-2" style="width: 76px; height: 76px; object-fit: cover;">
                            <h4 class="fw-bold font-heading mb-1 text-white"><?= htmlspecialchars($userName) ?></h4>
                            <p class="text-white-50 small mb-2"><?= htmlspecialchars($userEmail) ?></p>
                            <div class="d-flex justify-content-center gap-2 mb-2">
                                <span class="badge <?= $levelBadge ?> rounded-pill px-3 py-1 fw-bold" style="font-size: 0.72rem;">
                                    <i class="fa-solid fa-bolt me-1"></i> <?= $userLevel ?>
                                </span>
                                <span class="badge bg-warning text-dark rounded-pill px-3 py-1 fw-bold" style="font-size: 0.72rem;">
                                    <i class="fa-solid fa-fire me-1 text-danger"></i> <?= number_format($userXp) ?> XP
                                </span>
                            </div>
                        </div>

                        <div class="bg-white bg-opacity-10 p-3 rounded-3 mb-3 border border-white border-opacity-10">
                            <div class="row text-center g-2">
                                <div class="col-4 border-end border-white border-opacity-15">
                                    <span class="d-block fs-5 fw-bold text-warning"><?= count($completedModules) ?></span>
                                    <small class="text-white-50" style="font-size: 0.65rem;">Modul Selesai</small>
                                </div>
                                <div class="col-4 border-end border-white border-opacity-15">
                                    <span class="d-block fs-5 fw-bold text-success"><?= count($certificates) ?></span>
                                    <small class="text-white-50" style="font-size: 0.65rem;">Sertifikat SKPI</small>
                                </div>
                                <div class="col-4">
                                    <span class="d-block fs-5 fw-bold text-info">Top 10</span>
                                    <small class="text-white-50" style="font-size: 0.65rem;">Rank Nasional</small>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center pt-2 border-top border-white border-opacity-15">
                            <div class="text-start">
                                <small class="text-white-50 d-block" style="font-size: 0.65rem;">Platform Koding & Portofolio</small>
                                <span class="text-warning fw-semibold font-monospace" style="font-size: 0.75rem;">academy.skillance.cloud</span>
                            </div>
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=60x60&data=<?= urlencode('https://academy.skillance.cloud/verify.php') ?>" alt="QR Code" class="bg-white p-1 rounded-2 shadow-sm" style="width: 48px; height: 48px;">
                        </div>
                    </div>

                    <!-- ACTION BUTTONS -->
                    <div class="d-flex flex-column gap-2 mt-3">
                        <button type="button" onclick="downloadAchievementBadgeImage()" class="btn btn-success fw-bold py-2 rounded-pill shadow-sm">
                            <i class="fa-solid fa-download me-1"></i> Unduh Gambar Kartu (PNG)
                        </button>
                        <a href="https://api.whatsapp.com/send?text=<?= urlencode('Lihat kartu prestasi belajar koding saya di Skillance Academy Indonesia: https://academy.skillance.cloud/my-learning.php') ?>" target="_blank" rel="noopener noreferrer" class="btn btn-outline-success fw-semibold py-2 rounded-pill">
                            <i class="fa-brands fa-whatsapp me-1"></i> Bagikan ke Status WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function downloadAchievementBadgeImage() {
            const cardEl = document.getElementById('achievementCardCanvas');
            if (!cardEl) return;
            html2canvas(cardEl, { scale: 3, useCORS: true }).then(canvas => {
                const link = document.createElement('a');
                link.download = 'Kartu-Prestasi-<?= preg_replace('/[^a-zA-Z0-9]/', '-', $userName) ?>.png';
                link.href = canvas.toDataURL('image/png');
                link.click();
            }).catch(err => {
                alert('Gagal mengunduh gambar: ' + err.message);
            });
        }
    </script>

    <?php include __DIR__ . '/includes/footer.php'; ?>

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

    <!-- MODAL GENERATOR CV ATS KODING -->
    <div class="modal fade" id="atsResumeModal" tabindex="-1" aria-labelledby="atsResumeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <div class="modal-header bg-navy text-white px-4 py-3" style="background-color: #0d2e5c !important;">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-file-invoice text-warning fs-5"></i>
                        <div>
                            <h5 class="modal-title fw-bold mb-0" id="atsResumeModalLabel">Generator CV Koding ATS-Friendly (1 Halaman Standar)</h5>
                            <small class="text-white-50">Format bersih tanpa kolom kompleks, siap lolos filter Applicant Tracking System (ATS)</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <div class="modal-body p-4 bg-light">
                    <!-- CONTROLS TOOLBAR -->
                    <div class="card border-0 shadow-sm rounded-3 p-3 mb-4 bg-white">
                        <div class="row g-3 align-items-center">
                            <div class="col-md-5">
                                <label class="form-label small fw-bold text-navy mb-1"><i class="fa-solid fa-user-tag text-primary me-1"></i> Posisi / Target Karir:</label>
                                <input type="text" id="atsJobTitleInput" class="form-control form-control-sm fw-semibold" value="Junior Fullstack Web Developer" oninput="updateAtsTitle(this.value)">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small fw-bold text-navy mb-1"><i class="fa-solid fa-phone text-success me-1"></i> Nomor WhatsApp / HP:</label>
                                <input type="text" id="atsPhoneInput" class="form-control form-control-sm fw-semibold" value="+62 822-XXXX-XXXX" oninput="updateAtsPhone(this.value)">
                            </div>
                            <div class="col-md-3 d-flex align-items-end gap-2 pt-md-3">
                                <button type="button" onclick="printAtsCv()" class="btn btn-navy text-white btn-sm rounded-pill px-3 py-2 fw-bold w-100 shadow-sm" style="background-color: #0d2e5c !important;">
                                    <i class="fa-solid fa-print me-1"></i> Cetak / Simpan PDF
                                </button>
                                <button type="button" onclick="copyAtsPlainText()" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-2 fw-bold w-100 shadow-sm" title="Salin teks polos untuk paste ke portal kerja">
                                    <i class="fa-solid fa-copy me-1"></i> Salin Teks
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- ATS RESUME SHEET (A4 PREVIEW) -->
                    <div class="ats-preview-wrapper d-flex justify-content-center">
                        <div id="atsResumeCanvas" class="ats-resume-sheet shadow bg-white p-5">
                            
                            <!-- HEADER -->
                            <div class="ats-header text-center pb-2 mb-3 border-bottom border-dark border-2">
                                <h1 class="ats-name fw-bold mb-1 font-monospace" style="letter-spacing: 1.5px; font-size: 1.75rem; color: #000;"><?= strtoupper(htmlspecialchars($userName)) ?></h1>
                                <div class="ats-role fw-bold text-uppercase mb-1" id="atsRoleDisplay" style="font-size: 0.95rem; color: #222;">JUNIOR FULLSTACK WEB DEVELOPER</div>
                                <div class="ats-contact small text-muted font-monospace" style="font-size: 0.82rem; color: #333 !important;">
                                    <span><?= htmlspecialchars($userEmail) ?></span> &bull; 
                                    <span id="atsPhoneDisplay">+62 822-XXXX-XXXX</span> &bull; 
                                    <span>Indonesia</span> &bull; 
                                    <span>academy.skillance.cloud</span>
                                </div>
                            </div>

                            <!-- RINGKASAN PROFESIONAL -->
                            <div class="ats-section mb-3">
                                <h6 class="ats-sec-title fw-bold text-uppercase border-bottom border-dark pb-1 mb-2 font-monospace" style="font-size: 0.9rem; letter-spacing: 0.5px; color: #000;">Ringkasan Profesional</h6>
                                <p class="ats-sec-content small mb-0" style="line-height: 1.6; text-align: justify; color: #222; font-size: 0.84rem;">
                                    Junior Web Developer berdedikasi dengan fondasi kuat dalam rekayasa perangkat lunak web fullstack. Terbiasa membangun antarmuka interaktif responsif (HTML5, CSS3, JavaScript ES6+, Vue.js) dan sistem backend modular berbasis PHP 8 serta basis data relasional MySQL. Telah menyelesaikan kurikulum sertifikasi kompetensi digital di Skillance Academy Indonesia dengan predikat kelulusan terverifikasi SKPI. Siap berkontribusi dalam tim engineering secara lincah, terstruktur, dan berorientasi pada solusi nyata.
                                </p>
                            </div>

                            <!-- KEAHLIAN TEKNIS -->
                            <div class="ats-section mb-3">
                                <h6 class="ats-sec-title fw-bold text-uppercase border-bottom border-dark pb-1 mb-2 font-monospace" style="font-size: 0.9rem; letter-spacing: 0.5px; color: #000;">Keahlian Teknis (Technical Skills)</h6>
                                <ul class="ats-list small mb-0 ps-3" style="line-height: 1.6; font-size: 0.84rem; color: #222;">
                                    <li><strong>Bahasa Pemrograman:</strong> PHP 8+, JavaScript (ES6+), SQL, HTML5, CSS3, Python</li>
                                    <li><strong>Framework & Pustaka:</strong> Bootstrap 5, Vue.js 3, Tailwind CSS, Composer</li>
                                    <li><strong>Basis Data & Tools:</strong> MySQL, phpMyAdmin, Git, GitHub, RESTful API, Postman, VS Code</li>
                                    <li><strong>Kompetensi Tambahan:</strong> Slicing Desain Figma to Code, Optimasi Kueri SQL, Integrasi Gateway QRIS/Midtrans</li>
                                </ul>
                            </div>

                            <!-- SERTIFIKASI & SKPI RESMI -->
                            <div class="ats-section mb-3">
                                <h6 class="ats-sec-title fw-bold text-uppercase border-bottom border-dark pb-1 mb-2 font-monospace" style="font-size: 0.9rem; letter-spacing: 0.5px; color: #000;">Sertifikasi & Kredensial Resmi (SKPI)</h6>
                                <div class="ats-cert-list">
                                    <?php if (!empty($certificates)): ?>
                                        <?php foreach ($certificates as $c): ?>
                                            <div class="mb-2">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <strong style="font-size: 0.86rem; color: #000;"><?= htmlspecialchars($c['track_title']) ?> Competence Certificate</strong>
                                                    <span class="small font-monospace" style="font-size: 0.78rem;"><?= !empty($c['issued_at']) ? date('M Y', strtotime($c['issued_at'])) : date('M Y') ?></span>
                                                </div>
                                                <div class="small text-muted font-monospace" style="font-size: 0.78rem;">
                                                    Penerbit: <strong>Skillance Academy Indonesia</strong> &bull; No. Seri: <strong><?= htmlspecialchars($c['certificate_no']) ?></strong>
                                                </div>
                                                <div class="small text-muted" style="font-size: 0.76rem;">
                                                    Tautan Verifikasi: https://academy.skillance.cloud/verify.php?cert=<?= urlencode($c['certificate_no']) ?>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <strong style="font-size: 0.86rem; color: #000;">Frontend Web Development Specialist (Standard Curriculum)</strong>
                                                <span class="small font-monospace" style="font-size: 0.78rem;">Skillance Academy (<?= date('Y') ?>)</span>
                                            </div>
                                            <div class="small text-muted" style="font-size: 0.78rem;">
                                                Status: Modul Pembelajaran Terverifikasi (<?= count($completedModules) ?> Modul Selesai) &bull; SKPI Standar Kampus
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- PROYEK TEKNOLOGI -->
                            <div class="ats-section mb-3">
                                <h6 class="ats-sec-title fw-bold text-uppercase border-bottom border-dark pb-1 mb-2 font-monospace" style="font-size: 0.9rem; letter-spacing: 0.5px; color: #000;">Proyek Rekayasa Perangkat Lunak (Key Projects)</h6>
                                
                                <div class="mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong style="font-size: 0.86rem; color: #000;">Sistem Informasi & Portal Layanan Publik Terpadu</strong>
                                        <span class="small font-monospace" style="font-size: 0.78rem;">PHP, MySQL, Bootstrap</span>
                                    </div>
                                    <ul class="ats-list small mb-0 ps-3" style="line-height: 1.5; font-size: 0.82rem; color: #222;">
                                        <li>Merancang arsitektur MVC sederhana untuk manajemen data warga, pengajuan berkas digital, dan log aktivitas perangkat.</li>
                                        <li>Mengimplementasikan validasi formulir sisi server dan sanitasi input database guna mencegah celah keamanan SQL Injection.</li>
                                    </ul>
                                </div>

                                <div class="mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong style="font-size: 0.86rem; color: #000;">Aplikasi Transaksi Kasir Point-of-Sale (POS) & Inventori</strong>
                                        <span class="small font-monospace" style="font-size: 0.78rem;">PHP, JavaScript, MySQL</span>
                                    </div>
                                    <ul class="ats-list small mb-0 ps-3" style="line-height: 1.5; font-size: 0.82rem; color: #222;">
                                        <li>Membangun modul kalkulasi kasir interaktif dengan fitur diskon dinamis, scan barcode barang, dan cetak invoice thermal.</li>
                                        <li>Mengoptimalkan kueri stok barang otomatis dengan transaksi ACID MySQL guna menjaga konsistensi neraca penjualan.</li>
                                    </ul>
                                </div>
                            </div>

                            <!-- PENDIDIKAN & PELATIHAN -->
                            <div class="ats-section">
                                <h6 class="ats-sec-title fw-bold text-uppercase border-bottom border-dark pb-1 mb-2 font-monospace" style="font-size: 0.9rem; letter-spacing: 0.5px; color: #000;">Pendidikan & Pelatihan Terstruktur</h6>
                                <div class="d-flex justify-content-between align-items-center">
                                    <strong style="font-size: 0.86rem; color: #000;">Skillance Academy Indonesia</strong>
                                    <span class="small font-monospace" style="font-size: 0.78rem;"><?= date('Y') ?></span>
                                </div>
                                <div class="small text-muted" style="font-size: 0.8rem;">
                                    Program Mandiri & Workshop Intensif Pengembangan Aplikasi Web Fullstack & Portofolio Industri.
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
                <div class="modal-footer bg-white border-top px-4 py-3 d-flex justify-content-between">
                    <small class="text-muted"><i class="fa-solid fa-circle-check text-success me-1"></i> Format ATS 1-Halaman telah disesuaikan dengan standar industri HR tech modern.</small>
                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .ats-resume-sheet {
            width: 100%;
            max-width: 800px;
            min-height: 1050px;
            font-family: Arial, Helvetica, sans-serif;
            color: #111827;
            border-radius: 4px;
            border: 1px solid #e2e8f0;
        }

        @media print {
            body * {
                visibility: hidden !important;
            }
            #atsResumeCanvas, #atsResumeCanvas * {
                visibility: visible !important;
            }
            #atsResumeCanvas {
                position: absolute !important;
                left: 0 !important;
                top: 0 !important;
                width: 100% !important;
                max-width: 100% !important;
                margin: 0 !important;
                padding: 12mm 15mm !important;
                border: none !important;
                box-shadow: none !important;
            }
            @page {
                size: A4 portrait;
                margin: 0;
            }
        }
    </style>

    <script>
        function updateAtsTitle(val) {
            const roleEl = document.getElementById('atsRoleDisplay');
            if (roleEl) roleEl.textContent = val.toUpperCase();
        }

        function updateAtsPhone(val) {
            const phoneEl = document.getElementById('atsPhoneDisplay');
            if (phoneEl) phoneEl.textContent = val;
        }

        function printAtsCv() {
            window.print();
        }

        function copyAtsPlainText() {
            const canvas = document.getElementById('atsResumeCanvas');
            if (!canvas) return;
            const text = canvas.innerText;
            if (navigator.clipboard) {
                navigator.clipboard.writeText(text).then(() => {
                    alert('CV Koding berhasil disalin ke clipboard dalam format teks polos! Anda dapat langsung menempelkannya (paste) ke formulir pendaftaran kerja atau email.');
                });
            } else {
                prompt('Salin teks CV berikut:', text);
            }
        }
    </script>

<?php include_once __DIR__ . '/includes/spotlight_modal.php'; ?>
<script src="assets/js/spotlight.js"></script>
</body>
</html>
