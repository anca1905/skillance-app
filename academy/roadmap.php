<?php
session_start();
require_once __DIR__ . '/tutorials_data.php';

$userId = $_SESSION['user_id'] ?? null;
$userName = $_SESSION['user_name'] ?? 'Tamu Mahasiswa';
$userEmail = $_SESSION['user_email'] ?? '';
$userType = $_SESSION['user_type'] ?? 'student';
$avatarUrl = $_SESSION['user_photo'] ?? ('https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=0d2e5c&color=fff');
$isLoggedIn = !empty($userId);

// Get initial active path from query string or default to 'frontend'
$validPaths = ['frontend', 'backend', 'fullstack', 'python', 'java', 'cpp', 'mobile', 'uiux'];
$activePath = $_GET['path'] ?? 'frontend';
if (!in_array($activePath, $validPaths)) {
    $activePath = 'frontend';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roadmap Belajar Terstruktur - Skillance Academy Indonesia</title>
    
    <!-- Meta SEO -->
    <meta name="description" content="Alur dan panduan belajar (learning path) terstruktur dari pemula hingga siap kerja. Kuasai Frontend, Backend, Fullstack, Mobile App Flutter, dan UI/UX Design secara bertahap.">
    <meta name="keywords" content="roadmap belajar koding, roadmap web developer, belajar frontend, belajar backend, fullstack developer indonesia, roadmap flutter, skillance academy">
    
    <!-- Google Fonts & Bootstrap 5 -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Fira+Code:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --navy: #0d2e5c;
            --navy-dark: #071a35;
            --gold: #fca311;
            --w3-green: #04AA6D;
            --w3-green-hover: #038d5a;
            --cyan-accent: #00758f;
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
        .academy-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        /* Course Subnav */
        .course-subnav {
            background-color: var(--navy);
            overflow-x: auto;
            white-space: nowrap;
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
            background-color: rgba(255, 255, 255, 0.12);
        }

        /* Hero Section */
        .roadmap-hero {
            background: linear-gradient(135deg, #071a35 0%, #0d2e5c 60%, #00758f 100%);
            color: white;
            padding: 60px 0 50px;
            position: relative;
            overflow: hidden;
        }
        .roadmap-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at 80% 20%, rgba(252, 163, 17, 0.15) 0%, transparent 60%);
            pointer-events: none;
        }

        /* Path Switcher Tabs */
        .path-nav-container {
            background: #ffffff;
            border-radius: 16px;
            padding: 8px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            border: 1px solid #e2e8f0;
            margin-top: -30px;
            position: relative;
            z-index: 10;
        }
        .path-tab-btn {
            border: none;
            background: transparent;
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.92rem;
            color: #475569;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            flex-grow: 1;
            justify-content: center;
        }
        .path-tab-btn:hover {
            color: var(--navy);
            background-color: #f1f5f9;
        }
        .path-tab-btn.active {
            background: var(--navy);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(13, 46, 92, 0.25);
        }
        .path-tab-btn.active .path-icon {
            color: var(--gold);
        }

        /* Progress Card */
        .progress-box {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 20px 24px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        }

        /* Timeline Step Cards */
        .timeline-container {
            position: relative;
            padding-left: 50px;
        }
        .timeline-container::before {
            content: '';
            position: absolute;
            left: 20px;
            top: 15px;
            bottom: 30px;
            width: 4px;
            background: linear-gradient(180deg, #04AA6D 0%, #00758f 50%, #cbd5e1 100%);
            border-radius: 4px;
        }

        .timeline-step {
            position: relative;
            margin-bottom: 35px;
        }
        .timeline-node {
            position: absolute;
            left: -50px;
            top: 20px;
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: #ffffff;
            border: 4px solid #04AA6D;
            color: var(--navy);
            font-weight: 800;
            font-size: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 0 6px rgba(4, 170, 109, 0.15);
            z-index: 2;
        }
        .timeline-step.completed .timeline-node {
            background: #04AA6D;
            color: #ffffff;
            border-color: #04AA6D;
        }

        .step-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
            padding: 24px 28px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.04);
            transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease;
        }
        .step-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0,0,0,0.07);
            border-color: #cbd5e1;
        }

        .step-badge {
            font-size: 0.75rem;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .skill-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 8px 12px;
            border-radius: 8px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            margin-bottom: 8px;
            font-size: 0.88rem;
            line-height: 1.5;
            transition: background 0.15s;
        }
        .skill-item:hover {
            background: #f1f5f9;
        }
        .skill-checkbox {
            margin-top: 3px;
            width: 17px;
            height: 17px;
            cursor: pointer;
            accent-color: #04AA6D;
        }

        /* Action Buttons */
        .btn-course-action {
            background-color: var(--w3-green);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 8px 18px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.2s;
            border: none;
        }
        .btn-course-action:hover {
            background-color: var(--w3-green-hover);
            color: #ffffff;
            transform: translateY(-1px);
        }

        .project-highlight {
            background: #fffdf5;
            border: 1px solid #fde68a;
            border-radius: 10px;
            padding: 14px 18px;
            margin-top: 15px;
        }


        /* Mobile & Touch Ergonomics */
        .course-subnav {
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }
        .course-subnav::-webkit-scrollbar {
            display: none;
        }

        @media (max-width: 991px) {
            .path-nav-container {
                flex-wrap: nowrap !important;
                overflow-x: auto !important;
                -webkit-overflow-scrolling: touch;
                scrollbar-width: none;
                padding: 8px 10px;
                margin-top: -20px;
                border-radius: 14px;
                gap: 8px !important;
            }
            .path-nav-container::-webkit-scrollbar {
                display: none;
            }
            .path-tab-btn {
                flex: 0 0 auto !important;
                white-space: nowrap;
                padding: 10px 16px;
                font-size: 0.85rem;
                border-radius: 10px;
            }
        }

        @media (max-width: 768px) {
            .roadmap-hero {
                padding: 40px 0 50px !important;
            }
            .roadmap-hero h1 {
                font-size: 1.65rem !important;
                line-height: 1.3;
            }
            .roadmap-hero p.lead {
                font-size: 0.95rem !important;
            }
            .timeline-container {
                padding-left: 36px;
            }
            .timeline-container::before {
                left: 14px;
                top: 10px;
                width: 3px;
            }
            .timeline-node {
                left: -36px;
                top: 14px;
                width: 32px;
                height: 32px;
                font-size: 0.82rem;
                border-width: 3px;
                box-shadow: 0 0 0 4px rgba(4, 170, 109, 0.15);
            }
            .step-card {
                padding: 16px 14px;
                border-radius: 12px;
            }
            .step-card h3 {
                font-size: 1.15rem;
            }
            .step-badge {
                font-size: 0.68rem;
                padding: 3px 8px;
            }
            .skill-item {
                font-size: 0.82rem;
                padding: 7px 10px;
                gap: 8px;
            }
            .skill-checkbox {
                width: 16px;
                height: 16px;
                margin-top: 2px;
            }
            .btn-course-action {
                width: 100%;
                justify-content: center;
                margin-top: 10px;
                padding: 10px 16px;
            }
            .progress-box {
                padding: 16px 14px;
                border-radius: 12px;
            }
            .project-highlight {
                padding: 12px 14px;
            }
        }

        @media (max-width: 576px) {
            .academy-navbar {
                padding-top: 10px !important;
                padding-bottom: 10px !important;
            }
            .navbar-brand span {
                font-size: 1.05rem !important;
            }
            .navbar-brand small {
                display: none !important;
            }
            .top-hub-bar {
                font-size: 0.72rem;
            }
            .roadmap-hero .badge {
                font-size: 0.75rem;
            }
        }

        @media print {
            .academy-navbar, .top-hub-bar, .course-subnav, .path-nav-container, .btn-print-hide {
                display: none !important;
            }
            .roadmap-hero {
                background: none !important;
                color: black !important;
                padding: 10px 0 !important;
            }
            .timeline-container::before {
                background: #000 !important;
            }
            .step-card {
                box-shadow: none !important;
                border: 1px solid #ccc !important;
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>

    <!-- TOP HUB BAR -->
    <div class="top-hub-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <a href="https://skillance.my.id" class="text-decoration-none text-light fw-semibold">
                    <i class="fa-solid fa-arrow-left me-1"></i> Skillance Cloud Utama
                </a>
                <span class="text-secondary">|</span>
                <span class="text-gold fw-bold"><i class="fa-solid fa-map-location-dot me-1"></i> Learning Roadmap 2026</span>
            </div>
            <div>
                <?php if ($isLoggedIn): ?>
                    <span class="badge bg-success-subtle text-success me-2"><i class="fa-solid fa-circle-check me-1"></i> <?= htmlspecialchars($userName) ?></span>
                <?php else: ?>
                    <a href="https://skillance.my.id/auth/index.php?ref=academy" class="text-gold text-decoration-none fw-semibold">
                        <i class="fa-solid fa-user me-1"></i> Masuk Akun
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- MAIN NAVBAR -->
    <nav class="navbar navbar-expand-lg academy-navbar py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
                <div class="bg-navy text-gold p-2 rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;">
                    <i class="fa-solid fa-graduation-cap fs-5"></i>
                </div>
                <div>
                    <span class="fw-bold text-navy font-heading" style="font-size: 1.25rem; letter-spacing: -0.5px;">SKILLANCE ACADEMY</span>
                    <small class="d-block text-muted" style="font-size: 0.7rem; margin-top: -3px;">Pusat Belajar Koding Skillance Academy Indonesia</small>
                </div>
            </a>

            <div class="d-flex align-items-center gap-2 ms-auto">
                <a href="roadmap.php" class="btn btn-sm btn-navy rounded-pill px-3 py-2 fw-bold active">
                    <i class="fa-solid fa-map-location-dot text-gold me-1"></i> Roadmap Belajar
                </a>
                <a href="tryit.php" class="btn btn-sm btn-outline-navy rounded-pill px-3 py-2 fw-bold">
                    <i class="fa-solid fa-code text-gold me-1"></i> Code Lab Editor
                </a>
                <a href="index.php" class="btn btn-sm btn-light rounded-pill px-3 py-2 fw-semibold text-secondary">
                    <i class="fa-solid fa-house me-1"></i> Beranda
                </a>
            </div>
        </div>
    </nav>

    <!-- COURSE SUBNAV BAR -->
    <div class="course-subnav">
        <div class="container d-flex">
            <a href="learn.php?c=html" class="course-nav-item"><i class="fa-brands fa-html5 me-1 text-warning"></i> HTML</a>
            <a href="learn.php?c=css" class="course-nav-item"><i class="fa-brands fa-css3-alt me-1 text-info"></i> CSS</a>
            <a href="learn.php?c=javascript" class="course-nav-item"><i class="fa-brands fa-js me-1 text-warning"></i> JAVASCRIPT</a>
            <a href="learn.php?c=jquery" class="course-nav-item"><i class="fa-solid fa-bolt me-1 text-primary"></i> JQUERY</a>
            <a href="learn.php?c=php" class="course-nav-item"><i class="fa-brands fa-php me-1 text-primary"></i> PHP</a>
            <a href="learn.php?c=sql" class="course-nav-item"><i class="fa-solid fa-database me-1 text-info"></i> SQL</a>
            <a href="learn.php?c=python" class="course-nav-item"><i class="fa-brands fa-python me-1 text-warning"></i> PYTHON</a>
            <a href="learn.php?c=java" class="course-nav-item"><i class="fa-brands fa-java me-1 text-danger"></i> JAVA</a>
            <a href="learn.php?c=cpp" class="course-nav-item"><i class="fa-solid fa-code me-1 text-info"></i> C++</a>
            <a href="learn.php?c=vue" class="course-nav-item"><i class="fa-brands fa-vuejs me-1 text-success"></i> VUE</a>
            <a href="learn.php?c=flutter" class="course-nav-item"><i class="fa-solid fa-mobile-screen-button me-1 text-info"></i> FLUTTER</a>
            <a href="learn.php?c=uiux" class="course-nav-item"><i class="fa-solid fa-bezier-curve me-1 text-pink"></i> UI/UX</a>
            <a href="roadmap.php" class="course-nav-item text-gold active ms-auto"><i class="fa-solid fa-map-location-dot me-1"></i> ROADMAP</a>
        </div>
    </div>

    <!-- HERO HEADER -->
    <section class="roadmap-hero">
        <div class="container text-center">
            <span class="badge bg-white bg-opacity-10 text-gold px-3 py-2 rounded-pill fw-bold mb-3 border border-warning border-opacity-25">
                <i class="fa-solid fa-compass me-1"></i> Panduan Alur Belajar Terstruktur (Learning Path)
            </span>
            <h1 class="display-5 fw-bold font-heading mb-3 text-white">Roadmap Karier & Keahlian Digital</h1>
            <p class="lead mx-auto mb-4" style="max-width: 760px; color: #cbd5e1; line-height: 1.8; font-size: 1.05rem;">
                Jangan bingung harus mulai belajar dari mana! Ikuti kurikulum bertahap resmi dari <strong>Skillance Academy</strong> yang telah disusun sistematis dari tingkat pemula, menengah, hingga mahir dan siap terjun ke industri.
            </p>
            <div class="d-flex justify-content-center gap-2">
                <button onclick="window.print()" class="btn btn-sm btn-outline-light rounded-pill px-3 py-2 fw-semibold btn-print-hide">
                    <i class="fa-solid fa-print me-1"></i> Cetak / Simpan PDF
                </button>
                <button onclick="resetChecklist()" class="btn btn-sm btn-outline-warning rounded-pill px-3 py-2 fw-semibold btn-print-hide">
                    <i class="fa-solid fa-rotate-left me-1"></i> Reset Progress
                </button>
            </div>
        </div>
    </section>

    <!-- MAIN ROADMAP CONTAINER -->
    <main class="container py-4">
        
        <!-- PATH SWITCHER TABS -->
        <div class="path-nav-container d-flex flex-wrap gap-2 mb-4">
            <button class="path-tab-btn <?= ($activePath === 'frontend') ? 'active' : '' ?>" onclick="switchPath('frontend')">
                <i class="fa-brands fa-html5 fs-5 path-icon text-warning"></i>
                <div class="text-start">
                    <div class="fw-bold" style="font-size: 0.95rem;">Frontend Developer</div>
                    <small class="d-none d-md-block opacity-75" style="font-size: 0.75rem;">HTML, CSS, JS, jQuery</small>
                </div>
            </button>
            <button class="path-tab-btn <?= ($activePath === 'backend') ? 'active' : '' ?>" onclick="switchPath('backend')">
                <i class="fa-solid fa-server fs-5 path-icon text-info"></i>
                <div class="text-start">
                    <div class="fw-bold" style="font-size: 0.95rem;">Backend Developer</div>
                    <small class="d-none d-md-block opacity-75" style="font-size: 0.75rem;">PHP, SQL, Database, API</small>
                </div>
            </button>
            <button class="path-tab-btn <?= ($activePath === 'fullstack') ? 'active' : '' ?>" onclick="switchPath('fullstack')">
                <i class="fa-solid fa-layer-group fs-5 path-icon text-primary"></i>
                <div class="text-start">
                    <div class="fw-bold" style="font-size: 0.95rem;">Fullstack Developer</div>
                    <small class="d-none d-md-block opacity-75" style="font-size: 0.75rem;">End-to-End Web App</small>
                </div>
            </button>
            <button class="path-tab-btn <?= ($activePath === 'python') ? 'active' : '' ?>" onclick="switchPath('python')">
                <i class="fa-brands fa-python fs-5 path-icon text-warning"></i>
                <div class="text-start">
                    <div class="fw-bold" style="font-size: 0.95rem;">Python & AI Developer</div>
                    <small class="d-none d-md-block opacity-75" style="font-size: 0.75rem;">Python, Data, ML & AI</small>
                </div>
            </button>
            <button class="path-tab-btn <?= ($activePath === 'java') ? 'active' : '' ?>" onclick="switchPath('java')">
                <i class="fa-brands fa-java fs-5 path-icon text-danger"></i>
                <div class="text-start">
                    <div class="fw-bold" style="font-size: 0.95rem;">Java Enterprise Developer</div>
                    <small class="d-none d-md-block opacity-75" style="font-size: 0.75rem;">Java 21, OOP, Spring Boot</small>
                </div>
            </button>
            <button class="path-tab-btn <?= ($activePath === 'cpp') ? 'active' : '' ?>" onclick="switchPath('cpp')">
                <i class="fa-solid fa-code fs-5 path-icon text-info"></i>
                <div class="text-start">
                    <div class="fw-bold" style="font-size: 0.95rem;">C++ Systems & Game Dev</div>
                    <small class="d-none d-md-block opacity-75" style="font-size: 0.75rem;">C++20, STL, Pointers, Unreal Engine</small>
                </div>
            </button>
            <button class="path-tab-btn <?= ($activePath === 'mobile') ? 'active' : '' ?>" onclick="switchPath('mobile')">
                <i class="fa-solid fa-mobile-screen-button fs-5 path-icon text-success"></i>
                <div class="text-start">
                    <div class="fw-bold" style="font-size: 0.95rem;">Mobile Developer</div>
                    <small class="d-none d-md-block opacity-75" style="font-size: 0.75rem;">Flutter & Dart Cross-Platform</small>
                </div>
            </button>
            <button class="path-tab-btn <?= ($activePath === 'uiux') ? 'active' : '' ?>" onclick="switchPath('uiux')">
                <i class="fa-solid fa-bezier-curve fs-5 path-icon text-danger"></i>
                <div class="text-start">
                    <div class="fw-bold" style="font-size: 0.95rem;">UI/UX Designer</div>
                    <small class="d-none d-md-block opacity-75" style="font-size: 0.75rem;">Figma, Wireframing, UX</small>
                </div>
            </button>
        </div>

        <!-- PROGRESS BAR SUMMARY -->
        <div class="progress-box">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-2">
                <div>
                    <h5 class="fw-bold text-navy mb-1" id="pathTitle">Jalur Frontend Web Developer</h5>
                    <p class="text-muted small mb-0" id="pathDescription">Menguasai pembangunan antarmuka web interaktif yang modern, estetik, dan responsif.</p>
                </div>
                <div class="text-end mt-2 mt-md-0">
                    <span class="fs-4 fw-bold text-navy" id="progressPercentage">0%</span>
                    <small class="d-block text-muted" id="progressCount">0 dari 0 materi terselesaikan</small>
                </div>
            </div>
            <div class="progress" style="height: 10px; background-color: #e2e8f0; border-radius: 99px;">
                <div class="progress-bar" id="progressBarFill" role="progressbar" style="width: 0%; background: linear-gradient(90deg, #04AA6D, #00758f); border-radius: 99px;"></div>
            </div>
        </div>

        <!-- PATH 1: FRONTEND DEVELOPER -->
        <section id="path-frontend" class="roadmap-path-section" style="<?= ($activePath === 'frontend') ? '' : 'display:none;' ?>">
            <div class="timeline-container">

                <!-- Step 1: HTML5 -->
                <div class="timeline-step">
                    <div class="timeline-node">1</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-warning-subtle text-warning-emphasis me-2">Tahap 1: Fondasi</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 2 Minggu</span>
                            </div>
                            <a href="learn.php?c=html" class="btn-course-action">
                                <i class="fa-brands fa-html5"></i> Buka Materi HTML (90 Topik) &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">HTML5: Struktur & Semantik Dokumen Web</h4>
                        <p class="text-muted small mb-3">
                            Fondasi mutlak setiap halaman web. Anda akan mempelajari bagaimana menyusun kerangka dokumen yang bersih, mudah diindeks mesin pencari (SEO), dan ramah aksesibilitas.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_html_elements">
                                    <span>Elemen dasar: tag heading, paragraf, list, link, tabel, dan gambar</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_html_forms">
                                    <span>Pembuatan form interaktif: input, validation, radio, checkbox, select</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_html_semantic">
                                    <span>Tag semantik modern: <code>&lt;header&gt;</code>, <code>&lt;nav&gt;</code>, <code>&lt;main&gt;</code>, <code>&lt;article&gt;</code>, <code>&lt;footer&gt;</code></span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_html_multimedia">
                                    <span>Integrasi multimedia audio, video, dan canvas grafis</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-diagram-project me-1"></i> Proyek Praktik Milestone:</small>
                            <span class="small text-secondary">Membangun halaman portofolio biodata pribadi semantik lengkap dengan tabel riwayat dan form kontak.</span>
                        </div>
                    </div>
                </div>

                <!-- Step 2: CSS3 -->
                <div class="timeline-step">
                    <div class="timeline-node">2</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-info-subtle text-info-emphasis me-2">Tahap 2: Tampilan & Layout</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 3 Minggu</span>
                            </div>
                            <a href="learn.php?c=css" class="btn-course-action">
                                <i class="fa-brands fa-css3-alt"></i> Buka Materi CSS (125 Topik) &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">CSS3: Tata Letak Modern & Desain Responsif</h4>
                        <p class="text-muted small mb-3">
                            Mengubah kerangka mentah HTML menjadi antarmuka yang memukau secara visual, rapi di berbagai ukuran layar (mobile, tablet, desktop), serta kaya animasi halus.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_css_boxmodel">
                                    <span>CSS Box Model: margin, padding, border, box-sizing, and outline</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_css_flexbox">
                                    <span>CSS Flexbox: justify-content, align-items, flex-direction, gap</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_css_grid">
                                    <span>CSS Grid 2D: grid-template-columns, grid-areas, responsive autofill</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_css_responsive">
                                    <span>Media Queries & Desain Mobile-First (@media screen)</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-diagram-project me-1"></i> Proyek Praktik Milestone:</small>
                            <span class="small text-secondary">Membangun landing page bisnis responsif yang otomatis menyesuaikan tata letak pada layar HP dan laptop.</span>
                        </div>
                    </div>
                </div>

                <!-- Step 3: JavaScript -->
                <div class="timeline-step">
                    <div class="timeline-node">3</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-warning-subtle text-warning-emphasis me-2">Tahap 3: Logika Interaktivitas</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 4 Minggu</span>
                            </div>
                            <a href="learn.php?c=javascript" class="btn-course-action">
                                <i class="fa-brands fa-js"></i> Buka Materi JS (49 Topik) &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">JavaScript ES6+: Logika Pemrograman & DOM</h4>
                        <p class="text-muted small mb-3">
                            Memberikan nyawa dan kecerdasan interaksi pada website. Menangani kalkulasi, reaksi klik pengguna, validasi dinamis, dan manipulasi elemen Model Objek Dokumen (DOM).
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_js_fundamentals">
                                    <span>Variabel (let/const), Tipe Data, Operator, Kondisi if/switch, Looping</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_js_functions">
                                    <span>Fungsi & Arrow Function, Parameter, Return Value, Scope</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_js_dom">
                                    <span>Manipulasi DOM: <code>querySelector</code>, <code>addEventListener</code>, innerHTML</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_js_async">
                                    <span>Asinkron & API: JSON, Fetch API, Async/Await, Promise handling</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-diagram-project me-1"></i> Proyek Praktik Milestone:</small>
                            <span class="small text-secondary">Aplikasi To-Do List interaktif dengan filter status dan penyimpanan lokal di browser (LocalStorage).</span>
                        </div>
                    </div>
                </div>

                <!-- Step 4: jQuery -->
                <div class="timeline-step">
                    <div class="timeline-node">4</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-primary-subtle text-primary-emphasis me-2">Tahap 4: Efisiensi DOM</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 1-2 Minggu</span>
                            </div>
                            <a href="learn.php?c=jquery" class="btn-course-action">
                                <i class="fa-solid fa-bolt"></i> Buka Materi jQuery (46 Topik) &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">jQuery: Animasi Cepat & Manajemen Event</h4>
                        <p class="text-muted small mb-3">
                            Mempersingkat puluhan baris kode JavaScript menjadi 1 baris ekspresif. Sangat krusial untuk membuat efek slider, modal dialog, accordion, dan AJAX server cepat.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_jq_selectors">
                                    <span>Sintaks <code>$('selector').action()</code> dan event ready</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_jq_effects">
                                    <span>Efek transisi bawaan: hide/show, slideDown, fadeIn, animate, chaining</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_jq_traversing">
                                    <span>DOM Traversing: parent, children, siblings, filtering eq()</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_jq_ajax">
                                    <span>jQuery AJAX: method <code>load()</code>, <code>$.get()</code>, dan <code>$.post()</code></span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-diagram-project me-1"></i> Proyek Praktik Milestone:</small>
                            <span class="small text-secondary">Komponen Dashboard Admin Interaktif: Tab Switcher, Modal Konfirmasi, dan Live Search Filter.</span>
                        </div>
                    </div>
                </div>

                <!-- Step 5: Framework & Tooling -->
                <div class="timeline-step">
                    <div class="timeline-node">5</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-success-subtle text-success-emphasis me-2">Tahap 5: Ekosistem Industri</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 2 Minggu</span>
                            </div>
                            <span class="badge bg-light text-secondary border px-3 py-2 fw-semibold">Modern Tooling</span>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">CSS Framework, Git & Kolaborasi GitHub</h4>
                        <p class="text-muted small mb-3">
                            Mempersiapkan kode untuk standar industri menggunakan framework CSS Bootstrap 5 / Tailwind CSS, manajemen versi kode dengan Git, dan portofolio live di GitHub.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_tooling_bootstrap">
                                    <span>Bootstrap 5: Grid 12 kolom, Navbar, Card, Modal, Offcanvas</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_tooling_git">
                                    <span>Git: init, add, commit, branch, merge, push/pull ke GitHub</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-trophy me-1"></i> Portofolio Akhir Frontend:</small>
                            <span class="small text-secondary">Aplikasi Web Katalog Produk Interaktif yang terhubung ke REST API publik dengan live demo di GitHub Pages / Vercel.</span>
                        </div>
                    </div>
                </div>

                <!-- Step 6: Vue.js 3 & SPA -->
                <div class="timeline-step">
                    <div class="timeline-node">6</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-success-subtle text-success-emphasis me-2">Tahap 6: Frontend Framework & SPA</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 3 Minggu</span>
                            </div>
                            <a href="learn.php?c=vue" class="btn-course-action">
                                <i class="fa-brands fa-vuejs"></i> Buka Materi Vue.js (56 Topik) &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Vue.js 3: Reaktivitas, Komponen & Single Page Apps (SPA)</h4>
                        <p class="text-muted small mb-3">
                            Membangun aplikasi web generasi baru berbasis komponen reaktif deklaratif dengan Vue 3, Single File Components (.vue), Composition API, Vite build tool, dan perutean Vue Router.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-success"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_vue_reactivity">
                                    <span>Reaktivitas: Directives (v-model, v-bind, v-for, v-if), Computed & Watch</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_vue_components">
                                    <span>Komponen Modular: Props, $emit, Named Slots, & Scoped CSS</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_vue_composition">
                                    <span>Vue 3 Composition API: ref(), reactive(), Vite Toolchain, & SFC</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="fe_vue_routing">
                                    <span>Vue Router, Dynamic Navigation, & REST API Data Fetching</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-trophy me-1"></i> Portofolio Mahir Frontend SPA:</small>
                            <span class="small text-secondary">Aplikasi Web Single Page Application (SPA) E-Commerce / Dashboard Interaktif dengan Vue 3, Pinia / Composition State, dan REST API integration.</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- PATH 2: BACKEND DEVELOPER -->
        <section id="path-backend" class="roadmap-path-section" style="<?= ($activePath === 'backend') ? '' : 'display:none;' ?>">
            <div class="timeline-container">

                <!-- Step 1: PHP -->
                <div class="timeline-step">
                    <div class="timeline-node">1</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-primary-subtle text-primary-emphasis me-2">Tahap 1: Server Logic</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 4 Minggu</span>
                            </div>
                            <a href="learn.php?c=php" class="btn-course-action">
                                <i class="fa-brands fa-php"></i> Buka Materi PHP (117 Topik) &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">PHP 8: Logika Sisi Server & Pemrosesan Formulir</h4>
                        <p class="text-muted small mb-3">
                            Bahasa server paling populer yang menggerakkan lebih dari 75% website di dunia. Memproses data dari pengguna, mengelola sesi login, dan menghasilkan HTML dinamis.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="be_php_syntax">
                                    <span>Sintaks PHP, Variabel, String manipulation, Tipe Data, Operator</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="be_php_arrays">
                                    <span>Array Terindeks, Array Asosiatif, Multidimensi, dan foreach loop</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="be_php_forms">
                                    <span>Pemrosesan Form: $_GET, $_POST, sanitasi input, validasi email/password</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="be_php_auth">
                                    <span>Autentikasi: $_SESSION, Cookies, password_hash & password_verify</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-diagram-project me-1"></i> Proyek Praktik Milestone:</small>
                            <span class="small text-secondary">Sistem Login & Registrasi Pengguna aman dengan enkripsi password Bcrypt dan proteksi Session.</span>
                        </div>
                    </div>
                </div>

                <!-- Step 2: SQL & MySQL -->
                <div class="timeline-step">
                    <div class="timeline-node">2</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-info-subtle text-info-emphasis me-2">Tahap 2: Database Management</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 3 Minggu</span>
                            </div>
                            <a href="learn.php?c=sql" class="btn-course-action">
                                <i class="fa-solid fa-database"></i> Buka Materi SQL (82 Topik) &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">SQL & MySQL: Arsitektur Basis Data Relasional</h4>
                        <p class="text-muted small mb-3">
                            Jantung dari setiap aplikasi yang menyimpan informasi. Mempelajari query data, merancang skema relasi antartabel, dan mengoptimalkan performa indeks.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="be_sql_crud">
                                    <span>Perintah CRUD Dasar: SELECT, INSERT INTO, UPDATE, DELETE</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="be_sql_clause">
                                    <span>Klausa & Filter: WHERE, ORDER BY, GROUP BY, HAVING, LIMIT</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="be_sql_joins">
                                    <span>Relasi Tabel: INNER JOIN, LEFT JOIN, RIGHT JOIN, Primary & Foreign Key</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="be_sql_pdo">
                                    <span>Koneksi PHP Data Objects (PDO) & Prepared Statements (Cegah SQL Injection)</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-diagram-project me-1"></i> Proyek Praktik Milestone:</small>
                            <span class="small text-secondary">Perancangan Basis Data Toko Online lengkap dengan relasi tabel Pelanggan, Produk, Pesanan, dan Pembayaran.</span>
                        </div>
                    </div>
                </div>

                <!-- Step 3: OOP & Architecture -->
                <div class="timeline-step">
                    <div class="timeline-node">3</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-warning-subtle text-warning-emphasis me-2">Tahap 3: Desain Pola & API</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 3 Minggu</span>
                            </div>
                            <span class="badge bg-light text-secondary border px-3 py-2 fw-semibold">OOP & REST API</span>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">PHP OOP & Arsitektur RESTful API</h4>
                        <p class="text-muted small mb-3">
                            Menulis kode yang modular dan mudah dirawat dengan Object-Oriented Programming (OOP) serta membangun backend berbasis API JSON untuk dikonsumsi web atau mobile.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="be_oop_principles">
                                    <span>Konsep OOP: Class, Object, Encapsulation, Inheritance, Polymorphism</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="be_rest_api">
                                    <span>REST API Endpoints: GET, POST, PUT, DELETE dengan format respons JSON</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="be_api_auth">
                                    <span>Token-based Authentication: JWT (JSON Web Token) / API Keys</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="be_security">
                                    <span>Keamanan Backend: CSRF protection, XSS filtering, CORS policy, Rate limiting</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-diagram-project me-1"></i> Proyek Praktik Milestone:</small>
                            <span class="small text-secondary">RESTful API CRUD Manajemen Pengguna dan Produk dengan otentikasi token JWT.</span>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Server Deployment -->
                <div class="timeline-step">
                    <div class="timeline-node">4</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-success-subtle text-success-emphasis me-2">Tahap 4: Cloud & Deployment</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 2 Minggu</span>
                            </div>
                            <span class="badge bg-light text-secondary border px-3 py-2 fw-semibold">Cloud Production</span>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Cloud VPS Deployment: Linux, Nginx & SSL</h4>
                        <p class="text-muted small mb-3">
                            Menghubungkan kode lokal Anda ke server produksi publik agar bisa diakses oleh siapa saja di seluruh dunia dengan performa tinggi dan keamanan SSL HTTPS.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="be_deploy_linux">
                                    <span>Navigasi Terminal Linux Ubuntu/Debian: SSH, user permission, systemctl</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="be_deploy_nginx">
                                    <span>Konfigurasi Web Server Nginx / Apache & FastCGI PHP-FPM</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="be_deploy_ssl">
                                    <span>Pemasangan Domain, DNS Record A/CNAME, & Sertifikat SSL Let's Encrypt</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-trophy me-1"></i> Portofolio Akhir Backend:</small>
                            <span class="small text-secondary">REST API Layanan Microservice E-Commerce yang ter-deploy langsung di Cloud Server VPS ber-domain aktif.</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- PATH 3: FULLSTACK DEVELOPER -->
        <section id="path-fullstack" class="roadmap-path-section" style="<?= ($activePath === 'fullstack') ? '' : 'display:none;' ?>">
            <div class="timeline-container">

                <div class="timeline-step">
                    <div class="timeline-node">1</div>
                    <div class="step-card">
                        <span class="step-badge bg-primary-subtle text-primary-emphasis mb-2 d-inline-block">Fase 1: Client Layer</span>
                        <h4 class="fw-bold text-navy mb-2">Penguasaan Frontend Komprehensif</h4>
                        <p class="text-muted small mb-3">Membangun tampilan antarmuka yang responsif dan interaktif dengan HTML5, CSS3, JavaScript ES6+, dan jQuery.</p>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <a href="learn.php?c=html" class="btn btn-sm btn-outline-navy rounded-pill px-3"><i class="fa-brands fa-html5 text-warning me-1"></i> HTML (90)</a>
                            <a href="learn.php?c=css" class="btn btn-sm btn-outline-navy rounded-pill px-3"><i class="fa-brands fa-css3-alt text-info me-1"></i> CSS (125)</a>
                            <a href="learn.php?c=javascript" class="btn btn-sm btn-outline-navy rounded-pill px-3"><i class="fa-brands fa-js text-warning me-1"></i> JS (49)</a>
                            <a href="learn.php?c=jquery" class="btn btn-sm btn-outline-navy rounded-pill px-3"><i class="fa-solid fa-bolt text-primary me-1"></i> jQuery (46)</a>
                        </div>
                        <label class="skill-item">
                            <input type="checkbox" class="skill-checkbox" data-skill="fs_frontend_ready">
                            <span>Mampu merancang antarmuka responsif dan menangani event aksi pengguna secara dinamis</span>
                        </label>
                    </div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-node">2</div>
                    <div class="step-card">
                        <span class="step-badge bg-info-subtle text-info-emphasis mb-2 d-inline-block">Fase 2: Server & Data Layer</span>
                        <h4 class="fw-bold text-navy mb-2">Penguasaan Backend & Basis Data</h4>
                        <p class="text-muted small mb-3">Membangun logika bisnis sisi server dengan PHP 8 dan merancang skema relasi basis data menggunakan SQL & MySQL.</p>
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <a href="learn.php?c=php" class="btn btn-sm btn-outline-navy rounded-pill px-3"><i class="fa-brands fa-php text-primary me-1"></i> PHP (117)</a>
                            <a href="learn.php?c=sql" class="btn btn-sm btn-outline-navy rounded-pill px-3"><i class="fa-solid fa-database text-info me-1"></i> SQL (82)</a>
                        </div>
                        <label class="skill-item">
                            <input type="checkbox" class="skill-checkbox" data-skill="fs_backend_ready">
                            <span>Mampu membuat query SQL relasional dan memproses data dengan PHP PDO berkeamanan tinggi</span>
                        </label>
                    </div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-node">3</div>
                    <div class="step-card">
                        <span class="step-badge bg-success-subtle text-success-emphasis mb-2 d-inline-block">Fase 3: Integrasi End-to-End</span>
                        <h4 class="fw-bold text-navy mb-2">Integrasi AJAX, Arsitektur MVC & Live Deployment</h4>
                        <p class="text-muted small mb-3">Menghubungkan antarmuka klien ke API backend secara mulus menggunakan AJAX/Fetch dan men-deploy aplikasi secara penuh ke VPS Cloud.</p>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-trophy me-1"></i> Portofolio Akhir Fullstack:</small>
                            <span class="small text-secondary">Aplikasi SaaS Freelance Marketplace Lengkap (seperti Skillance) dengan sistem autentikasi, transaksi saldo, dan posting lowongan kerja secara real-time.</span>
                        </div>
                        <label class="skill-item mt-2">
                            <input type="checkbox" class="skill-checkbox" data-skill="fs_fullstack_project">
                            <span>Berhasil membangun dan meluncurkan proyek web fullstack end-to-end ke internet</span>
                        </label>
                    </div>
                </div>

            </div>
        </section>


        <!-- PATH: PYTHON, DATA SCIENCE & AI DEVELOPER -->
        <section id="path-python" class="roadmap-path-section" style="<?= ($activePath === 'python') ? '' : 'display:none;' ?>">
            <div class="timeline-container">

                <!-- Step 1: Python Core -->
                <div class="timeline-step">
                    <div class="timeline-node">1</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-primary-subtle text-primary-emphasis me-2">Tahap 1: Fondasi Bahasa</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 3 Minggu</span>
                            </div>
                            <a href="learn.php?c=python" class="btn-course-action">
                                <i class="fa-brands fa-python"></i> Buka Materi Python (166 Topik) &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Python 3.12: Sintaks, Kontrol Alur & Struktur Data</h4>
                        <p class="text-muted small mb-3">
                            Mempelajari fondasi bahasa pemrograman terpopuler di dunia. Dari variabel, operator, percabangan if/match, looping, fungsi modular, hingga struktur data built-in (List, Tuple, Set, Dict).
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_core_syntax">
                                    <span>Sintaks Indentasi, Variabel, Tipe Data Primitif, Casting, F-Strings</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_core_collections">
                                    <span>Koleksi Data: List, Tuple, Set, Dictionary, Slicing & Comprehension</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_core_functions">
                                    <span>Fungsi `def`, Parameter Default, `*args`, `**kwargs`, Lambda & Scope</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_core_modules">
                                    <span>Modul Standar: `math`, `datetime`, `json`, `re`, `random`, PIP & VirtualEnv</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-diagram-project me-1"></i> Proyek Praktik Milestone:</small>
                            <span class="small text-secondary">Aplikasi Command Line Interface (CLI) Manajemen Kontak & Keuangan Pribadi dengan penyimpanan file JSON.</span>
                        </div>
                    </div>
                </div>

                <!-- Step 2: OOP & File Handling -->
                <div class="timeline-step">
                    <div class="timeline-node">2</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-info-subtle text-info-emphasis me-2">Tahap 2: OOP & Files</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 2 Minggu</span>
                            </div>
                            <a href="learn.php?c=python&p=py_oop" class="btn-course-action">
                                <i class="fa-solid fa-cube"></i> Buka Materi OOP &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Pemrograman Berorientasi Objek & Penanganan File</h4>
                        <p class="text-muted small mb-3">
                            Menulis kode berstandar enterprise dengan prinsip Class, Objek, Enkapsulasi, Pewarisan (Inheritance), Magic Dunder Methods, Exception Handling, dan manipulasi berkas (I/O).
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_oop_classes">
                                    <span>Class, Objek, `__init__()`, `self`, `@property`, dan `@staticmethod`</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_oop_inheritance">
                                    <span>Pewarisan Class (Inheritance), fungsi `super()`, dan Polimorfisme</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_oop_files">
                                    <span>Operasi File I/O: blok `with open()`, mode `'r'`, `'w'`, `'a'`, penanganan CSV</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_oop_exceptions">
                                    <span>Manajemen Error: `try`, `except`, `else`, `finally`, Custom Exceptions</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-diagram-project me-1"></i> Proyek Praktik Milestone:</small>
                            <span class="small text-secondary">Sistem Perbankan OOP dengan rekening nasabah, transfer dana terenkripsi, dan pencatatan mutasi transaksi otomatis ke file log.</span>
                        </div>
                    </div>
                </div>

                <!-- Step 3: DSA -->
                <div class="timeline-step">
                    <div class="timeline-node">3</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-warning-subtle text-warning-emphasis me-2">Tahap 3: Algoritma & DSA</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 3 Minggu</span>
                            </div>
                            <a href="learn.php?c=python&p=py_dsa_intro" class="btn-course-action">
                                <i class="fa-solid fa-network-wired"></i> Buka Materi DSA (20 Topik) &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Struktur Data & Algoritma (DSA)</h4>
                        <p class="text-muted small mb-3">
                            Memahami efisiensi memori dan waktu eksekusi (Big-O Notation) serta implementasi struktur data fundamental untuk menyelesaikan tantangan koding teknis wawancara kerja.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_dsa_linear">
                                    <span>Struktur Linear: Stacks (LIFO), Queues (FIFO), Singly & Doubly Linked Lists</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_dsa_trees">
                                    <span>Pohon & Graf: Binary Trees, Binary Search Trees (BST), AVL Trees, Graphs</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_dsa_searching">
                                    <span>Algoritma Pencarian: Linear Search O(n) vs Binary Search O(log n)</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_dsa_sorting">
                                    <span>Algoritma Pengurutan: Bubble, Insertion, Merge Sort, Quick Sort O(n log n)</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-diagram-project me-1"></i> Proyek Praktik Milestone:</small>
                            <span class="small text-secondary">Mesin Pencari Kamus Cepat berbasis Hash Table dan Binary Search Tree dengan benchmark waktu eksekusi.</span>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Data Analysis & Visualization -->
                <div class="timeline-step">
                    <div class="timeline-node">4</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-primary-subtle text-primary-emphasis me-2">Tahap 4: Data & Visualisasi</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 3 Minggu</span>
                            </div>
                            <a href="learn.php?c=python&p=py_mod_numpy" class="btn-course-action">
                                <i class="fa-solid fa-chart-line"></i> Buka NumPy & Matplotlib &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Manipulasi Data & Visualisasi Grafik 2D</h4>
                        <p class="text-muted small mb-3">
                            Menganalisis kumpulan data besar dengan pustaka komputasi numerik NumPy dan Pandas, lalu memvisualisasikan wawasan tren bisnis melalui diagram Matplotlib.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_data_numpy">
                                    <span>NumPy: Komputasi Array N-Dimensi, Operasi Matriks, Vektorisasi</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_data_pandas">
                                    <span>Pandas: DataFrame, Series, Data Cleaning, Filter Kondisi, Agregasi GroupBy</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_data_matplotlib">
                                    <span>Matplotlib: Plot Garis, Scatter Plot, Bar Chart, Histogram, Pie Chart</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_data_styling">
                                    <span>Kustomisasi Visual: Subplot grid, Legend, Grid line, Marker warna</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-diagram-project me-1"></i> Proyek Praktik Milestone:</small>
                            <span class="small text-secondary">Exploratory Data Analysis (EDA) Data Transaksi E-Commerce dengan visualisasi grafik demografi pelanggan.</span>
                        </div>
                    </div>
                </div>

                <!-- Step 5: Machine Learning -->
                <div class="timeline-step">
                    <div class="timeline-node">5</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-success-subtle text-success-emphasis me-2">Tahap 5: AI & Machine Learning</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 4 Minggu</span>
                            </div>
                            <a href="learn.php?c=python&p=py_ml_getstarted" class="btn-course-action">
                                <i class="fa-solid fa-brain"></i> Buka Machine Learning (23 Topik) &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Machine Learning & Pemodelan Prediktif</h4>
                        <p class="text-muted small mb-3">
                            Mengajarkan komputer menemukan pola tersembunyi dari data historis untuk memprediksi hasil masa depan menggunakan Scikit-Learn dan algoritma kecerdasan buatan.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_ml_preprocessing">
                                    <span>Pra-pemrosesan Data: Train/Test Split (80/20), Feature Scaling, Encoding</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_ml_regression">
                                    <span>Algoritma Regresi: Linear Regression, Polynomial Regression, Multi-Regression</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_ml_classification">
                                    <span>Klasifikasi: Logistic Regression, Decision Tree, Random Forest, KNN</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_ml_evaluation">
                                    <span>Evaluasi Model: Confusion Matrix, K-Fold Cross Validation, Kurva AUC-ROC</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-trophy me-1"></i> Proyek Portofolio Utama:</small>
                            <span class="small text-secondary">Model Prediksi Harga Rumah atau Deteksi Risiko Kredit Nasabah dengan skor akurasi di atas 85%.</span>
                        </div>
                    </div>
                </div>

                <!-- Step 6: Database & Web Integration -->
                <div class="timeline-step">
                    <div class="timeline-node">6</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-primary-subtle text-primary-emphasis me-2">Tahap 6: Basis Data & Web</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 3 Minggu</span>
                            </div>
                            <a href="learn.php?c=python&p=py_mysql_getstarted" class="btn-course-action">
                                <i class="fa-solid fa-database"></i> Buka MySQL & MongoDB &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Integrasi Basis Data (MySQL/MongoDB) & REST API</h4>
                        <p class="text-muted small mb-3">
                            Menghubungkan model Python ke basis data SQL relasional dan NoSQL dokumen, serta membungkusnya menjadi layanan REST API menggunakan Django atau FastAPI.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_db_mysql">
                                    <span>MySQL Connector: CRUD, Prepared Statements, Foreign Key Joins</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_db_mongodb">
                                    <span>PyMongo NoSQL: Koleksi BSON, Query Operators, Aggregation Pipeline</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_web_django">
                                    <span>Framework Web Django: MTV Architecture, ORM Models, Admin Panel</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="py_cert_complete">
                                    <span>Mengikuti Evaluasi Ujian Sertifikasi Kompetensi Python Skillance</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-certificate me-1"></i> Portofolio Akhir Python & AI:</small>
                            <span class="small text-secondary">Aplikasi Web SaaS Dashboard Analitik Prediktif AI lengkap dengan endpoint REST API dan integrasi database aktif.</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>


        <!-- PATH: JAVA ENTERPRISE DEVELOPER -->
        <section id="path-java" class="roadmap-path-section" style="<?= ($activePath === 'java') ? '' : 'display:none;' ?>">
            <div class="timeline-container">

                <!-- Step 1: Java Core -->
                <div class="timeline-step">
                    <div class="timeline-node">1</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-primary-subtle text-primary-emphasis me-2">Tahap 1: Sintaks & Fondasi</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 3 Minggu</span>
                            </div>
                            <a href="learn.php?c=java" class="btn-course-action">
                                <i class="fa-brands fa-java"></i> Buka Materi Java (118 Topik) &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Java 21 LTS: Tipe Data, Kontrol Alur & Array</h4>
                        <p class="text-muted small mb-3">
                            Mempelajari fondasi bahasa pemrograman berorientasi objek yang tangguh dan bertipe statis kuat (Strongly-Typed). Memahami kompilasi bytecode JVM, tipe data primitif, percabangan if/switch modern, perulangan, dan manipulasi array.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_core_syntax">
                                    <span>Struktur Class Java, method main(), Tipe Data Primitif, Casting</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_core_strings">
                                    <span>Manipulasi String, Immutability, StringBuilder, Math API</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_core_control">
                                    <span>Logika Percabangan: if-else, Switch Expressions Java 14+, Ternary</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_core_arrays">
                                    <span>Perulangan for, while, for-each, Array 1D & Multidimensi</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-diagram-project me-1"></i> Proyek Praktik Milestone:</small>
                            <span class="small text-secondary">Aplikasi Konsol Java Manajemen Nilai Akademik Mahasiswa lengkap dengan kalkulasi IPK dan predikat kelulusan.</span>
                        </div>
                    </div>
                </div>

                <!-- Step 2: OOP Murni -->
                <div class="timeline-step">
                    <div class="timeline-node">2</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-info-subtle text-info-emphasis me-2">Tahap 2: OOP & Desain Objek</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 3 Minggu</span>
                            </div>
                            <a href="learn.php?c=java&p=java_oop" class="btn-course-action">
                                <i class="fa-solid fa-cube"></i> Buka Materi OOP &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Pemrograman Berorientasi Objek Murni (OOP)</h4>
                        <p class="text-muted small mb-3">
                            Java adalah bahasa OOP sejati. Kuasai pembuatan Class, Objek, Konstruktor, Enkapsulasi data dengan private fields & getters/setters, Pewarisan (Inheritance), Polimorfisme Overriding, Abstract Classes, dan Interfaces.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_oop_encapsulation">
                                    <span>Enkapsulasi: Access Modifiers, Constructor Overloading, `this`</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_oop_inheritance">
                                    <span>Pewarisan: kata kunci `extends`, method overriding, kata kunci `super`</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_oop_abstraction">
                                    <span>Abstraksi: Abstract Class vs Interface, kata kunci `implements`</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_oop_advanced">
                                    <span>Polimorfisme Dinamis, Inner Classes, Anonymous Classes, dan Enum</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-diagram-project me-1"></i> Proyek Praktik Milestone:</small>
                            <span class="small text-secondary">Sistem Reservasi Kamar Hotel Berbasis OOP dengan hierarki tipe kamar, penghitungan tarif diskon, dan faktur cetak.</span>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Exception & I/O -->
                <div class="timeline-step">
                    <div class="timeline-node">3</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-warning-subtle text-warning-emphasis me-2">Tahap 3: Error & Berkas</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 2 Minggu</span>
                            </div>
                            <a href="learn.php?c=java&p=java_errors" class="btn-course-action">
                                <i class="fa-solid fa-triangle-exclamation"></i> Buka Exception & I/O &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Penanganan Error & Java I/O Streams</h4>
                        <p class="text-muted small mb-3">
                            Membangun aplikasi enterprise yang tahan banting (resilient) dengan penanganan perkecualian checked vs unchecked, try-with-resources otomatis, dan membaca/menulis berkas teks dan biner melalui Stream buffer.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_io_exceptions">
                                    <span>Try-Catch-Finally, Throw/Throws, Custom Exception Class</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_io_resources">
                                    <span>Manajemen Resource Otomatis: Blok `try-with-resources`</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_io_streams">
                                    <span>Character Streams: BufferedReader & BufferedWriter untuk file teks</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_io_binary">
                                    <span>Byte Streams: FileInputStream & FileOutputStream untuk berkas biner</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-diagram-project me-1"></i> Proyek Praktik Milestone:</small>
                            <span class="small text-secondary">Aplikasi Pengolah File Log Server: Membaca jutaan baris log dan menyaring error secara otomatis ke file rekapitulasi.</span>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Collections Framework -->
                <div class="timeline-step">
                    <div class="timeline-node">4</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-primary-subtle text-primary-emphasis me-2">Tahap 4: Collections Framework</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 3 Minggu</span>
                            </div>
                            <a href="learn.php?c=java&p=java_data_structures" class="btn-course-action">
                                <i class="fa-solid fa-database"></i> Buka Java Collections &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Java Collections Framework (JCF)</h4>
                        <p class="text-muted small mb-3">
                            Standar struktur data industri Java: Memahami kapan menggunakan ArrayList vs LinkedList, HashSet vs TreeSet untuk keunikan, dan HashMap vs TreeMap untuk pemetaan kunci-nilai berefisiensi tinggi.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_jcf_lists">
                                    <span>List Hierarchy: ArrayList, LinkedList, Operasi CRUD & Sorting</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_jcf_sets">
                                    <span>Set Hierarchy: HashSet O(1), TreeSet O(log n), LinkedHashSet</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_jcf_maps">
                                    <span>Map Hierarchy: HashMap, TreeMap, LinkedHashMap, Iterator</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_jcf_generics">
                                    <span>Java Generics `<T>`, Comparable, dan Comparator Kustom</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-diagram-project me-1"></i> Proyek Praktik Milestone:</small>
                            <span class="small text-secondary">Sistem Manajemen Inventaris Barang Toko dengan pencarian instan berbasis HashMap dan pengurutan harga stok.</span>
                        </div>
                    </div>
                </div>

                <!-- Step 5: Advanced Java -->
                <div class="timeline-step">
                    <div class="timeline-node">5</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-success-subtle text-success-emphasis me-2">Tahap 5: Fitur Modern & Konkurensi</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 3 Minggu</span>
                            </div>
                            <a href="learn.php?c=java&p=java_wrapper_classes" class="btn-course-action">
                                <i class="fa-solid fa-bolt"></i> Buka Java Advanced &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Java Advanced: Lambda, Stream API & Multithreading</h4>
                        <p class="text-muted small mb-3">
                            Memodernisasi gaya koding dengan pemrograman fungsional: Ekspresi Lambda, method reference `::`, pipeline pengolahan data Stream API (`filter`, `map`, `reduce`), kelas `Optional<T>`, dan eksekusi paralel Thread & Concurrency.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_adv_lambda">
                                    <span>Ekspresi Lambda `() -> {}` dan Functional Interfaces</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_adv_streams">
                                    <span>Stream API: Operasi deklaratif filter, map, collect, reduce</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_adv_optional">
                                    <span>Pencegahan Null: Penggunaan `Optional<T>` dan Anotasi Java</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_adv_threads">
                                    <span>Multithreading: Thread class, Runnable, ExecutorService dasar</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-diagram-project me-1"></i> Proyek Praktik Milestone:</small>
                            <span class="small text-secondary">Aplikasi Pengunduh Data Multithread Asinkron dengan rekapitulasi data menggunakan Stream API.</span>
                        </div>
                    </div>
                </div>

                <!-- Step 6: Enterprise & Spring Boot -->
                <div class="timeline-step">
                    <div class="timeline-node">6</div>
                    <div class="step-card">
                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                            <div>
                                <span class="step-badge bg-primary-subtle text-primary-emphasis me-2">Tahap 6: Enterprise Backend</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 4 Minggu</span>
                            </div>
                            <a href="learn.php?c=java&p=java_server" class="btn-course-action">
                                <i class="fa-solid fa-server"></i> Buka Java Server & Projects &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Java Enterprise: Spring Boot & RESTful Microservices</h4>
                        <p class="text-muted small mb-3">
                            Standar tertinggi backend enterprise global: Membangun RESTful API dengan Spring Boot, Dependency Injection (Inversion of Control), koneksi database relasional melalui Spring Data JPA / Hibernate, dan rilis ke Cloud.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_ent_springboot">
                                    <span>Spring Boot: `@RestController`, `@GetMapping`, `@PostMapping`</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_ent_jpa">
                                    <span>Spring Data JPA: Entitas `@Entity`, Repository CRUD, Relasi MySQL</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_ent_security">
                                    <span>Autentikasi & Keamanan: Spring Security & JWT Token Auth</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="java_cert_complete">
                                    <span>Ujian Evaluasi Sertifikasi Kompetensi Java Developer Skillance</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-trophy me-1"></i> Portofolio Akhir Java Enterprise:</small>
                            <span class="small text-secondary">RESTful API E-Commerce Microservices berbasis Spring Boot, MySQL Database, dan autentikasi token JWT yang siap deploy ke VPS Cloud.</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- PATH: C++ SYSTEMS & GAME DEVELOPER -->
        <section id="path-cpp" class="roadmap-path-section" style="<?= ($activePath === 'cpp') ? '' : 'display:none;' ?>">
            <div class="timeline-container">

                <!-- Step 1: Fondasi Bahasa C++20 -->
                <div class="timeline-step">
                    <div class="timeline-node">1</div>
                    <div class="step-card">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <span class="step-badge bg-primary-subtle text-primary-emphasis mb-2 d-inline-block">Tahap 1: Fondasi Kompilasi</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 3 Minggu</span>
                            </div>
                            <a href="learn.php?c=cpp" class="btn-course-action">
                                <i class="fa-solid fa-code"></i> Buka Materi C++ (80 Topik) &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Fondasi C++20, Kompilasi & Manajemen Dasar</h4>
                        <p class="text-muted small mb-3">
                            Memahami arsitektur bahasa kompilasi berkinerja tinggi, struktur fungsi <code>main()</code>, preprocessor <code>#include</code>, variabel strongly-typed, kontrol alur logika, dan input/output stream konsol.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-primary"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="cpp_fund_syntax">
                                    <span>Sintaks C++20, Stream I/O, Variabel, Konstanta & Operators</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="cpp_fund_control">
                                    <span>Kontrol Alur: If-Else, Switch Case, For & While Loop</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="cpp_fund_arrays">
                                    <span>Array Kontigu, Manipulasi std::string, & Structs</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="cpp_fund_functions">
                                    <span>Modularitas Fungsi, Overloading, Scope, & Lambda Expression</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Pointer & Memori Dinamis -->
                <div class="timeline-step">
                    <div class="timeline-node">2</div>
                    <div class="step-card">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <span class="step-badge bg-info-subtle text-info-emphasis mb-2 d-inline-block">Tahap 2: Manajemen Memori</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 3 Minggu</span>
                            </div>
                            <a href="learn.php?c=cpp&p=cpp_pointers" class="btn-course-action">
                                <i class="fa-solid fa-microchip"></i> Buka Materi Pointers C++ &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Pointers, Referensi & Alokasi Heap (RAII)</h4>
                        <p class="text-muted small mb-3">
                            Kekuatan sejati C++: Mengendalikan alamat memori secara langsung, efisiensi passing referensi, alokasi memori heap dinamis, pencegahan memory leak, dan Modern Smart Pointers.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-info"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="cpp_mem_pointers">
                                    <span>Pointers: Operator Alamat (&), Dereferensi (*), & Nullptr</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="cpp_mem_references">
                                    <span>Referensi (&) & Pass-by-Const-Reference Efisien</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="cpp_mem_heap">
                                    <span>Alokasi Heap: Operator new/delete & Debugging Leak</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="cpp_mem_smart">
                                    <span>Smart Pointers Modern: std::unique_ptr & std::shared_ptr</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Pemrograman Berorientasi Objek Murni -->
                <div class="timeline-step">
                    <div class="timeline-node">3</div>
                    <div class="step-card">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <span class="step-badge bg-warning-subtle text-warning-emphasis mb-2 d-inline-block">Tahap 3: Arsitektur OOP</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 4 Minggu</span>
                            </div>
                            <a href="learn.php?c=cpp&p=cpp_oop" class="btn-course-action">
                                <i class="fa-solid fa-cubes"></i> Buka Materi OOP C++ &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">OOP Murni, Dynamic Polymorphism & Generik Templates</h4>
                        <p class="text-muted small mb-3">
                            Membangun abstraksi game engine dan arsitektur modular dengan Class, Enkapsulasi, Member Initializer List, Virtual Destructors, Dynamic Dispatch, dan Generic Programming dengan Templates.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-warning"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="cpp_oop_classes">
                                    <span>Class, Constructors, Initializer List, & Destructors</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="cpp_oop_encaps">
                                    <span>Enkapsulasi, Access Specifiers, & Friend Functions</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="cpp_oop_polymorph">
                                    <span>Pewarisan, Virtual Functions, Override, & Pure Virtual Class</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="cpp_oop_templates">
                                    <span>Generic Programming: Function & Class Templates</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 4: STL Containers & Proyek Capstone -->
                <div class="timeline-step">
                    <div class="timeline-node">4</div>
                    <div class="step-card">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <div>
                                <span class="step-badge bg-success-subtle text-success-emphasis mb-2 d-inline-block">Tahap 4: STL & Capstone</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i> Estimasi: 4 Minggu</span>
                            </div>
                            <a href="learn.php?c=cpp&p=cpp_data_structures" class="btn-course-action">
                                <i class="fa-solid fa-layer-group"></i> Buka Materi STL C++ &raquo;
                            </a>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Standard Template Library (STL), Algoritma & Proyek Sistem</h4>
                        <p class="text-muted small mb-3">
                            Menguasai seluruh struktur data produksi STL (Vector, Map, Set, Deque, Stack), algoritma IntroSort, evaluasi kompleksitas O(log n), serta penyelesaian Proyek Capstone dan Evaluasi Sertifikasi C++ Developer.
                        </p>
                        <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-list-check me-1 text-success"></i> Target Kompetensi & Checklist:</h6>
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="cpp_stl_containers">
                                    <span>Sequence Containers: std::vector, std::deque, & std::list</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="cpp_stl_maps">
                                    <span>Associative Containers: std::map, std::unordered_map, std::set</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="cpp_stl_algo">
                                    <span>STL Algorithms: std::sort, binary_search, & accumulate</span>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="skill-item">
                                    <input type="checkbox" class="skill-checkbox" data-skill="cpp_capstone_cert">
                                    <span>Proyek Capstone Manajemen Data & Sertifikasi C++ Developer</span>
                                </label>
                            </div>
                        </div>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-trophy me-1"></i> Portofolio Akhir C++ Systems:</small>
                            <span class="small text-secondary">Aplikasi CLI High-Performance Manajemen Data & Ranking Siswa berbasis C++20, STL Vector, File Persistence I/O, dan Lambda Sorting teroptimasi.</span>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- PATH 4: MOBILE APP DEVELOPER -->
        <section id="path-mobile" class="roadmap-path-section" style="<?= ($activePath === 'mobile') ? '' : 'display:none;' ?>">
            <div class="timeline-container">

                <div class="timeline-step">
                    <div class="timeline-node">1</div>
                    <div class="step-card">
                        <span class="step-badge bg-info-subtle text-info-emphasis mb-2 d-inline-block">Tahap 1: Bahasa Dasar</span>
                        <h4 class="fw-bold text-navy mb-2">Pemrograman Dart</h4>
                        <p class="text-muted small mb-3">Bahasa pemrograman modern bertipe kuat (strongly-typed) yang dioptimalkan untuk performa aplikasi mobile yang cepat.</p>
                        <label class="skill-item">
                            <input type="checkbox" class="skill-checkbox" data-skill="mob_dart_oop">
                            <span>Sintaks Dart, Null Safety, Koleksi (List, Map), Pemrograman Berorientasi Objek (OOP)</span>
                        </label>
                    </div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-node">2</div>
                    <div class="step-card">
                        <span class="step-badge bg-primary-subtle text-primary-emphasis mb-2 d-inline-block">Tahap 2: UI Framework</span>
                        <h4 class="fw-bold text-navy mb-2">Flutter UI & Widget Architecture</h4>
                        <p class="text-muted small mb-3">Membangun antarmuka cross-platform (Android & iOS) dengan prinsip "Everything is a Widget".</p>
                        <label class="skill-item">
                            <input type="checkbox" class="skill-checkbox" data-skill="mob_flutter_widgets">
                            <span>StatelessWidget, StatefulWidget, Scaffold, Container, Column, Row, ListView, GridView</span>
                        </label>
                    </div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-node">3</div>
                    <div class="step-card">
                        <span class="step-badge bg-success-subtle text-success-emphasis mb-2 d-inline-block">Tahap 3: State & API</span>
                        <h4 class="fw-bold text-navy mb-2">State Management & Integrasi Backend API</h4>
                        <p class="text-muted small mb-3">Mengelola alur data aplikasi secara rapi menggunakan Provider/BLoC dan mengonsumsi REST API dari server.</p>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-trophy me-1"></i> Portofolio Akhir Mobile:</small>
                            <span class="small text-secondary">Aplikasi Mobile E-Commerce lengkap dengan keranjang belanja, integrasi REST API produk, dan login token.</span>
                        </div>
                        <label class="skill-item mt-2">
                            <input type="checkbox" class="skill-checkbox" data-skill="mob_project_complete">
                            <span>Menghasilkan file APK/AAB yang siap diunggah ke Google Play Store</span>
                        </label>
                    </div>
                </div>

            </div>
        </section>

        <!-- PATH 5: UI/UX DESIGNER -->
        <section id="path-uiux" class="roadmap-path-section" style="<?= ($activePath === 'uiux') ? '' : 'display:none;' ?>">
            <div class="timeline-container">

                <div class="timeline-step">
                    <div class="timeline-node">1</div>
                    <div class="step-card">
                        <span class="step-badge bg-danger-subtle text-danger-emphasis mb-2 d-inline-block">Tahap 1: Riset & Konsep</span>
                        <h4 class="fw-bold text-navy mb-2">Design Thinking & Riset Pengguna</h4>
                        <p class="text-muted small mb-3">Memahami kebutuhan pengguna melalui empati, mendefinisikan masalah (Problem Statement), dan membuat persona.</p>
                        <label class="skill-item">
                            <input type="checkbox" class="skill-checkbox" data-skill="uiux_research">
                            <span>User Interview, Empathy Map, Persona, User Journey Map, Information Architecture</span>
                        </label>
                    </div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-node">2</div>
                    <div class="step-card">
                        <span class="step-badge bg-primary-subtle text-primary-emphasis mb-2 d-inline-block">Tahap 2: Desain Visual</span>
                        <h4 class="fw-bold text-navy mb-2">Figma Mastery & Design System</h4>
                        <p class="text-muted small mb-3">Merancang antarmuka berkualitas tinggi (High-Fidelity) dengan Auto Layout, Reusable Components, dan Typography tokens.</p>
                        <label class="skill-item">
                            <input type="checkbox" class="skill-checkbox" data-skill="uiux_figma">
                            <span>Auto Layout, Component Variants, Color Palettes, Grid System, Interactive Prototype</span>
                        </label>
                    </div>
                </div>

                <div class="timeline-step">
                    <div class="timeline-node">3</div>
                    <div class="step-card">
                        <span class="step-badge bg-success-subtle text-success-emphasis mb-2 d-inline-block">Tahap 3: Validasi & Handoff</span>
                        <h4 class="fw-bold text-navy mb-2">Usability Testing & Developer Handoff</h4>
                        <p class="text-muted small mb-3">Menguji prototipe kepada calon pengguna asli dan menyiapkan dokumentasi aset untuk diserahkan ke tim developer.</p>
                        <div class="project-highlight">
                            <small class="fw-bold text-warning-emphasis d-block mb-1"><i class="fa-solid fa-trophy me-1"></i> Portofolio Akhir UI/UX:</small>
                            <span class="small text-secondary">Studi kasus UI/UX lengkap (Case Study) desain aplikasi mobile/web interaktif yang dipublikasikan di Behance / Figma Community.</span>
                        </div>
                        <label class="skill-item mt-2">
                            <input type="checkbox" class="skill-checkbox" data-skill="uiux_case_study">
                            <span>Menyelesaikan Case Study UI/UX komprehensif dari riset hingga prototipe final</span>
                        </label>
                    </div>
                </div>

            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="bg-navy text-white py-5 mt-5 border-top">
        <div class="container text-center">
            <h5 class="fw-bold text-gold font-heading mb-2">SKILLANCE ACADEMY INDONESIA</h5>
            <p class="text-light small mb-3" style="max-width: 600px; margin: auto;">
                Platform edukasi teknologi digital dan koding mandiri terpadu. Dilengkapi materi terstruktur dan lingkungan latihan langsung di browser.
            </p>
            <div class="d-flex justify-content-center gap-3 small text-secondary">
                <a href="index.php" class="text-decoration-none text-light opacity-75">Katalog Kursus</a>
                <span>•</span>
                <a href="roadmap.php" class="text-decoration-none text-gold fw-bold">Roadmap Belajar</a>
                <span>•</span>
                <a href="tryit.php" class="text-decoration-none text-light opacity-75">Code Lab Editor</a>
            </div>
            <div class="mt-4 pt-3 border-top border-white border-opacity-10 text-muted small">
                &copy; <?= date('Y') ?> Skillance Academy Indonesia. Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

    <!-- INTERACTIVE ROADMAP SCRIPT -->
    <script>
        const pathData = {
            frontend: {
                title: "Jalur Frontend Web Developer",
                desc: "Menguasai pembangunan antarmuka web interaktif yang modern, estetik, dan responsif."
            },
            backend: {
                title: "Jalur Backend Web Developer",
                desc: "Membangun logika bisnis sisi server, relasi basis data SQL, dan RESTful API berkeamanan tinggi."
            },
            fullstack: {
                title: "Jalur Fullstack Web Developer",
                desc: "Mengintegrasikan antarmuka frontend, logika backend, database, hingga live cloud deployment."
            },
            python: {
                title: "Jalur Python, Data Science & AI Developer",
                desc: "Menguasai fondasi Python 3.12, OOP, Algoritma DSA, Manipulasi Data, Matplotlib, hingga Machine Learning prediktif."
            },
            java: {
                title: "Jalur Java Enterprise & Backend Developer",
                desc: "Menguasai Java 21 LTS, OOP murni, Collections Framework, I/O Streams, Multithreading, hingga arsitektur Spring Boot."
            },
            cpp: {
                title: "Jalur C++ Systems & Game Developer",
                desc: "Menguasai standar modern C++20, alokasi memori manual, pointer, OOP polimorfik, Standard Template Library (STL), dan fondasi game engine."
            },
            mobile: {
                title: "Jalur Mobile App Developer (Flutter & Dart)",
                desc: "Membangun aplikasi mobile cross-platform Android dan iOS dari satu basis kode."
            },
            uiux: {
                title: "Jalur UI/UX Designer",
                desc: "Merancang pengalaman pengguna (UX) dan antarmuka visual (UI) modern menggunakan Figma."
            }
        };

        let currentActivePath = '<?= $activePath ?>';

        function switchPath(pathKey) {
            currentActivePath = pathKey;
            
            // Update tabs
            document.querySelectorAll('.path-tab-btn').forEach(btn => btn.classList.remove('active'));
            event.currentTarget.classList.add('active');
            try { event.currentTarget.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' }); } catch(e){}

            // Hide all sections, show active
            document.querySelectorAll('.roadmap-path-section').forEach(sec => sec.style.display = 'none');
            const targetSec = document.getElementById('path-' + pathKey);
            if (targetSec) targetSec.style.display = 'block';

            // Update title & desc
            if (pathData[pathKey]) {
                document.getElementById('pathTitle').textContent = pathData[pathKey].title;
                document.getElementById('pathDescription').textContent = pathData[pathKey].desc;
            }

            // Update URL without reload
            window.history.replaceState(null, null, '?path=' + pathKey);

            // Recalculate progress for this path
            updatePathProgress();
        }

        function updatePathProgress() {
            const activeSection = document.getElementById('path-' + currentActivePath);
            if (!activeSection) return;

            const checkboxes = activeSection.querySelectorAll('.skill-checkbox');
            const total = checkboxes.length;
            let checked = 0;

            checkboxes.forEach(cb => {
                const key = 'skillance_roadmap_' + cb.dataset.skill;
                if (localStorage.getItem(key) === 'true') {
                    cb.checked = true;
                    checked++;
                    // Mark step card if all checked
                    const card = cb.closest('.timeline-step');
                    if (card) card.classList.add('has-progress');
                } else {
                    cb.checked = false;
                }
            });

            const percent = total > 0 ? Math.round((checked / total) * 100) : 0;
            document.getElementById('progressBarFill').style.width = percent + '%';
            document.getElementById('progressPercentage').textContent = percent + '%';
            document.getElementById('progressCount').textContent = checked + ' dari ' + total + ' kompetensi terselesaikan';
        }

        // Attach event listener to all checkboxes
        document.querySelectorAll('.skill-checkbox').forEach(cb => {
            cb.addEventListener('change', function() {
                const key = 'skillance_roadmap_' + this.dataset.skill;
                if (this.checked) {
                    localStorage.setItem(key, 'true');
                } else {
                    localStorage.removeItem(key);
                }
                updatePathProgress();
            });
        });

        function resetChecklist() {
            if (confirm('Apakah Anda yakin ingin mereset seluruh kemajuan checklist belajar pada jalur ini?')) {
                const activeSection = document.getElementById('path-' + currentActivePath);
                if (activeSection) {
                    activeSection.querySelectorAll('.skill-checkbox').forEach(cb => {
                        localStorage.removeItem('skillance_roadmap_' + cb.dataset.skill);
                        cb.checked = false;
                    });
                }
                updatePathProgress();
            }
        }

        // Initial progress calculation on page load
        document.addEventListener('DOMContentLoaded', () => {
            updatePathProgress();
        });
    </script>
</body>
</html>
