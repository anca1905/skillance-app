<?php
session_start();
require_once __DIR__ . '/tutorials_data.php';

$userId = $_SESSION['user_id'] ?? null;
$userName = $_SESSION['user_name'] ?? 'Tamu Mahasiswa';
$userEmail = $_SESSION['user_email'] ?? '';
$userType = $_SESSION['user_type'] ?? 'student';
$avatarUrl = $_SESSION['user_photo'] ?? ('https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=0d2e5c&color=fff');
$isLoggedIn = !empty($userId);

// Master SEO Configuration
$seoTitle = 'Skillance Academy Indonesia - Platform Belajar Koding Praktis & Portofolio SKPI';
$seoDesc = 'Portal belajar koding mandiri dan interaktif resmi dari Skillance Academy Indonesia. Kuasai HTML, CSS, JavaScript, PHP, MySQL, Flutter, dan UI/UX dengan sertifikasi kelulusan digital SKPI.';
$seoKeywords = 'skillance academy, belajar koding indonesia, tutorial pemrograman, ujian koding online, sertifikat skpi, flutter indonesia, ui ux figma, belajar php mysql';
$seoOgImage = 'https://academy.skillance.cloud/assets/img/og-academy.png';
$seoCanonical = 'https://academy.skillance.cloud/index.php';
$seoType = 'website';
$seoBreadcrumbs = [
    ['name' => 'Beranda', 'url' => 'https://academy.skillance.cloud/index.php']
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- MASTER ENTERPRISE SEO & OPEN GRAPH -->
    <?php include __DIR__ . '/includes/seo_meta.php'; ?>
    
    <!-- Google Fonts & Bootstrap -->
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
        }

        .text-navy { color: #071a35 !important; }
        .text-gold { color: #fca311 !important; }
        .bg-gold {
            background-color: #fca311 !important;
            color: #071a35 !important;
        }
        .badge.bg-gold,
        .badge.bg-gold *,
        .badge.bg-gold.text-navy,
        .badge.bg-gold.text-navy * {
            background-color: #fca311 !important;
            color: #071a35 !important;
        }
        .bg-gold-subtle {
            background-color: rgba(252, 163, 17, 0.18) !important;
            color: #b45309 !important;
        }
        .bg-navy {
            background-color: #0d2e5c !important;
            color: #ffffff !important;
        }
        .bg-navy-subtle {
            background-color: rgba(13, 46, 92, 0.08) !important;
            color: #0d2e5c !important;
        }
        .btn-navy, a.btn-navy, button.btn-navy {
            background-color: #0d2e5c !important;
            color: #ffffff !important;
            border: 1px solid #0d2e5c !important;
            transition: all 0.25s ease;
        }
        .btn-navy:hover, a.btn-navy:hover, button.btn-navy:hover,
        .btn-navy:focus, a.btn-navy:focus, button.btn-navy:focus {
            background-color: #071a35 !important;
            color: #ffffff !important;
            border-color: #071a35 !important;
            box-shadow: 0 4px 14px rgba(13, 46, 92, 0.35);
            transform: translateY(-1px);
        }
        .btn-outline-navy, a.btn-outline-navy, button.btn-outline-navy {
            background-color: transparent !important;
            color: #0d2e5c !important;
            border: 1.5px solid #0d2e5c !important;
            transition: all 0.25s ease;
        }
        .btn-outline-navy:hover, a.btn-outline-navy:hover, button.btn-outline-navy:hover,
        .btn-outline-navy:focus, a.btn-outline-navy:focus, button.btn-outline-navy:focus {
            background-color: #0d2e5c !important;
            color: #ffffff !important;
            border-color: #0d2e5c !important;
            box-shadow: 0 4px 14px rgba(13, 46, 92, 0.25);
            transform: translateY(-1px);
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

        /* Course Quick Nav (Skillance Modern Style) */
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
        .course-nav-item:hover {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Hero Section */
        .hero-banner {
            background: linear-gradient(135deg, #0d2e5c 0%, #061a35 100%);
            color: white;
            padding: 70px 0 60px 0;
            text-align: center;
        }

        /* Course Cards */
        .course-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 30px;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: all 0.25s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        }
        .course-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 28px rgba(13, 46, 92, 0.1);
            border-color: var(--gold);
        }
        .course-icon-badge {
            width: 54px;
            height: 54px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 26px;
            margin-bottom: 20px;
        }
        .btn-learn {
            background-color: var(--w3-green);
            color: white;
            font-weight: 700;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: background 0.2s;
        }
        .btn-learn:hover {
            background-color: var(--w3-green-hover);
            color: white;
        }

        .btn-tryit-outline {
            background-color: transparent;
            color: var(--navy);
            border: 1px solid #cbd5e1;
            font-weight: 600;
            padding: 9px 18px;
            border-radius: 8px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .btn-tryit-outline:hover {
            background-color: #f1f5f9;
            color: var(--navy);
            border-color: var(--navy);
        }

        /* Feature Box */
        .feature-box {
            background: white;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 24px;
        }

        /* Mobile & Touch Ergonomics */
        .course-subnav {
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }
        .course-subnav::-webkit-scrollbar {
            display: none;
        }

        @media (max-width: 768px) {
            .hero-banner {
                padding: 45px 15px 40px;
            }
            .hero-banner h1 {
                font-size: 1.85rem;
                line-height: 1.3;
            }
            .hero-banner p.lead {
                font-size: 0.95rem;
            }
            .course-card {
                padding: 22px 18px;
                border-radius: 14px;
            }
            .course-icon-badge {
                width: 46px;
                height: 46px;
                font-size: 22px;
                margin-bottom: 14px;
            }
            .feature-box {
                padding: 18px 16px;
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
                font-size: 0.74rem;
            }
            .hero-banner {
                padding: 38px 12px 32px;
            }
            .hero-banner h1 {
                font-size: 1.65rem;
            }
            .hero-banner .btn-lg {
                width: 100%;
                font-size: 0.95rem;
                padding: 12px 20px;
            }
            .course-card {
                padding: 18px 15px;
            }
            .course-nav-item {
                padding: 8px 14px;
                font-size: 0.82rem;
            }
        }
    </style>
</head>
<body>

    <?php
    $activeNav = 'home';
    $showSubnav = true;
    include __DIR__ . '/includes/navbar.php';
    ?>

    <!-- HERO BANNER -->
    <header class="hero-banner">
        <div class="container">
            <span class="badge bg-gold text-navy fw-bold px-3 py-2 rounded-pill mb-3 text-uppercase shadow-sm" style="background-color: #fca311 !important; color: #071a35 !important; font-size: 0.8rem; letter-spacing: 0.8px;">
                <i class="fa-solid fa-book-open me-1"></i> Modul Terstruktur Mandiri
            </span>
            <h1 class="display-5 fw-bold font-heading mb-3 text-white">Belajar Koding Praktis & Terarah</h1>
            <p class="lead mx-auto mb-4" style="max-width: 720px; color: #cbd5e1; line-height: 1.8; font-size: 1.05rem;">
                Setiap materi disusun secara terpisah, rapi, dan mudah dipahami berdasarkan standar <strong>Skillance Academy</strong>. Disertai contoh kode yang dapat Anda coba dan jalankan langsung di browser!
            </p>

            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="exam.php" class="btn btn-success btn-lg fw-bold px-4 py-3 rounded-pill shadow">
                    <i class="fa-solid fa-award me-2"></i> Ikuti Ujian Sertifikasi SKPI &raquo;
                </a>
                <a href="projects.php" class="btn btn-warning btn-lg fw-bold px-4 py-3 rounded-pill text-navy shadow">
                    <i class="fa-solid fa-laptop-code me-2"></i> E-Book & Kit Proyek Industri &raquo;
                </a>
                <a href="roadmap.php" class="btn btn-outline-light btn-lg fw-bold px-4 py-3 rounded-pill">
                    <i class="fa-solid fa-map-location-dot me-2 text-warning"></i> Roadmap Belajar
                </a>
                <a href="partner.php" class="btn btn-outline-light btn-lg fw-bold px-4 py-3 rounded-pill">
                    <i class="fa-solid fa-building-columns me-2 text-info"></i> Kemitraan Kampus / UKM
                </a>
                <a href="verify.php" class="btn btn-outline-light btn-lg fw-bold px-4 py-3 rounded-pill">
                    <i class="fa-solid fa-shield-halved me-2 text-success"></i> Cek Sertifikat
                </a>
            </div>
        </div>
    </header>

    <!-- SECTION: DAFTAR KURSUS & MATERI MANDIRI -->
    <section class="py-5">
        <div class="container py-3">
            <div class="text-center mb-5 mx-auto" style="max-width: 650px;">
                <h2 class="fw-bold text-navy font-heading">Pilih Materi yang Ingin Dipelajari</h2>
                <p class="text-muted">Klik materi untuk membuka panduan lengkap, membaca teori, dan mencoba kode latihan secara mandiri.</p>
            </div>

            <div class="row g-4">
                
                <!-- CARD 1: HTML -->
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <div class="course-icon-badge" style="background: #fef2f2; color: #e34f26;">
                            <i class="fa-brands fa-html5"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-danger-subtle text-danger fw-bold">Dasar Web</span>
                            <small class="text-muted">90 Topik Lengkap (8 Kategori)</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">HTML Tutorial</h4>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                            Bahasa markah standar untuk membangun struktur halaman web, tag semantik, formulir pendaftaran, dan elemen multimedia.
                        </p>
                        <div class="d-flex gap-2 pt-3 border-top">
                            <a href="learn.php?c=html" class="btn-learn flex-grow-1">
                                Mulai Belajar &raquo;
                            </a>
                            <a href="tryit.php?c=html" class="btn-tryit-outline" title="Coba Kode Langsung">
                                <i class="fa-solid fa-code"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD 2: CSS -->
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <div class="course-icon-badge" style="background: #eff6ff; color: #264de4;">
                            <i class="fa-brands fa-css3-alt"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-primary-subtle text-primary fw-bold">Styling & Desain</span>
                            <small class="text-muted">125 Topik Lengkap (9 Kategori)</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">CSS Tutorial</h4>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                            Menata tampilan visual, pewarnaan, tipografi, box-model, dan tata letak modern responsif menggunakan Flexbox.
                        </p>
                        <div class="d-flex gap-2 pt-3 border-top">
                            <a href="learn.php?c=css" class="btn-learn flex-grow-1">
                                Mulai Belajar &raquo;
                            </a>
                            <a href="tryit.php?c=css" class="btn-tryit-outline" title="Coba Kode Langsung">
                                <i class="fa-solid fa-code"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD 3: JAVASCRIPT -->
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <div class="course-icon-badge" style="background: #fefce8; color: #ca8a04;">
                            <i class="fa-brands fa-js"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-warning-subtle text-warning-emphasis fw-bold">Interaktivitas</span>
                            <small class="text-muted">49 Topik Lengkap (5 Kategori)</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">JavaScript Tutorial</h4>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                            Bahasa pemrograman yang membuat website hidup. Manipulasi DOM, penanganan event klik, dan pertukaran data API.
                        </p>
                        <div class="d-flex gap-2 pt-3 border-top">
                            <a href="learn.php?c=javascript" class="btn-learn flex-grow-1">
                                Mulai Belajar &raquo;
                            </a>
                            <a href="tryit.php?c=javascript" class="btn-tryit-outline" title="Coba Kode Langsung">
                                <i class="fa-solid fa-code"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD 4: PHP & MYSQL -->
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <div class="course-icon-badge" style="background: #eef2ff; color: #6366f1;">
                            <i class="fa-brands fa-php"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-indigo-subtle text-indigo fw-bold" style="background:#e0e7ff; color:#4338ca;">Server & DB</span>
                            <small class="text-muted">117 Topik Lengkap (10 Kategori)</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">PHP & MySQL Tutorial</h4>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                            Pemrograman server-side, pengolahan form, koneksi database relasional, dan query aman dengan Prepared Statements.
                        </p>
                        <div class="d-flex gap-2 pt-3 border-top">
                            <a href="learn.php?c=php" class="btn-learn flex-grow-1">
                                Mulai Belajar &raquo;
                            </a>
                            <a href="tryit.php?c=php" class="btn-tryit-outline" title="Coba Kode Langsung">
                                <i class="fa-solid fa-code"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD: SQL -->
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <div class="course-icon-badge" style="background: #ecfeff; color: #00758f;">
                            <i class="fa-solid fa-database"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-info-subtle text-info fw-bold" style="background:#cffafe; color:#0e7490;">Database Relasional</span>
                            <small class="text-muted">82 Topik Lengkap (5 Kategori)</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">SQL Tutorial</h4>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                            Bahasa standar internasional untuk mengelola database relasional, query SELECT, JOIN, agregasi, subquery, dan indexing.
                        </p>
                        <div class="d-flex gap-2 pt-3 border-top">
                            <a href="learn.php?c=sql" class="btn-learn flex-grow-1">
                                Mulai Belajar &raquo;
                            </a>
                            <a href="tryit.php?c=sql" class="btn-tryit-outline" title="Coba Kode Langsung">
                                <i class="fa-solid fa-code"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD: JQUERY -->
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <div class="course-icon-badge" style="background: #f0f9ff; color: #0769ad;">
                            <i class="fa-solid fa-bolt"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-primary-subtle text-primary fw-bold" style="background:#e0f2fe; color:#0369a1;">Pustaka JavaScript</span>
                            <small class="text-muted">46 Topik Lengkap (9 Kategori)</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">jQuery Tutorial</h4>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                            Pustaka JavaScript legendaris berprinsip 'Write Less, Do More'. Mempermudah manipulasi DOM, animasi efek, dan komunikasi AJAX.
                        </p>
                        <div class="d-flex gap-2 pt-3 border-top">
                            <a href="learn.php?c=jquery" class="btn-learn flex-grow-1">
                                Mulai Belajar &raquo;
                            </a>
                            <a href="tryit.php?c=jquery" class="btn-tryit-outline" title="Coba Kode Langsung">
                                <i class="fa-solid fa-code"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD: PYTHON -->
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <div class="course-icon-badge" style="background: #eff6ff; color: #3776ab;">
                            <i class="fa-brands fa-python"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-primary-subtle text-primary fw-bold" style="background:#e0f2fe; color:#0369a1;">AI, Data & Web</span>
                            <small class="text-muted">166 Topik (14 Kategori)</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Python Tutorial</h4>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                            Bahasa pemrograman serbaguna untuk Artificial Intelligence, Machine Learning, Data Science, Matplotlib, Algoritma DSA, dan Database.
                        </p>
                        <div class="d-flex gap-2 pt-3 border-top">
                            <a href="learn.php?c=python" class="btn-learn flex-grow-1">
                                Mulai Belajar &raquo;
                            </a>
                            <a href="tryit.php?c=python" class="btn-tryit-outline" title="Coba Kode Langsung">
                                <i class="fa-solid fa-code"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD: JAVA -->
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <div class="course-icon-badge" style="background: #fff7ed; color: #ea580c;">
                            <i class="fa-brands fa-java"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-warning-subtle text-warning-emphasis fw-bold">Enterprise & Backend</span>
                            <small class="text-muted">118 Topik (13 Kategori)</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Java Tutorial</h4>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                            Bahasa pemrograman berorientasi objek tangguh untuk sistem berskala enterprise, arsitektur microservices, aplikasi Android, dan Spring Boot backend.
                        </p>
                        <div class="d-flex gap-2 pt-3 border-top">
                            <a href="learn.php?c=java" class="btn-learn flex-grow-1">
                                Mulai Belajar &raquo;
                            </a>
                            <a href="tryit.php?c=java" class="btn-tryit-outline" title="Coba Kode Langsung">
                                <i class="fa-solid fa-code"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD: C++ -->
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <div class="course-icon-badge" style="background: #e0f2fe; color: #00599c;">
                            <i class="fa-solid fa-code"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-primary-subtle text-primary fw-bold" style="background:#e0f2fe; color:#00599c;">High Performance</span>
                            <small class="text-muted">80 Topik (11 Kategori)</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">C++ Tutorial</h4>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                            Bahasa pemrograman biner super cepat untuk Game Development (Unreal Engine), sistem operasi, algoritma STL, dan pemrosesan komputasi intensif.
                        </p>
                        <div class="d-flex gap-2 pt-3 border-top">
                            <a href="learn.php?c=cpp" class="btn-learn flex-grow-1">
                                Mulai Belajar &raquo;
                            </a>
                            <a href="tryit.php?c=cpp" class="btn-tryit-outline" title="Coba Kode Langsung">
                                <i class="fa-solid fa-code"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD: VUE.JS -->
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <div class="course-icon-badge" style="background: #f0fdf4; color: #42b883;">
                            <i class="fa-brands fa-vuejs"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-success-subtle text-success fw-bold" style="background:#f0fdf4; color:#16a34a;">Frontend Reaktif</span>
                            <small class="text-muted">56 Topik (5 Kategori)</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Vue.js 3 Tutorial</h4>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                            Framework JavaScript progresif untuk membangun Single Page Applications (SPA), antarmuka reaktif deklaratif, Single File Components, dan Composition API modern.
                        </p>
                        <div class="d-flex gap-2 pt-3 border-top">
                            <a href="learn.php?c=vue" class="btn-learn flex-grow-1">
                                Mulai Belajar &raquo;
                            </a>
                            <a href="tryit.php?c=vue" class="btn-tryit-outline" title="Coba Kode Langsung">
                                <i class="fa-solid fa-code"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD 5: FLUTTER -->
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <div class="course-icon-badge" style="background: #e0f2fe; color: #0284c7;">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-info-subtle text-info-emphasis fw-bold">Cross-Platform & AI</span>
                            <small class="text-muted"><i class="fa-solid fa-book-open me-1"></i> 29 Topik</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Flutter & Dart Mobile</h4>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                            Kuasai ekosistem Flutter resmi dari Google: Widget Tree, Material 3, BLoC/Riverpod, REST API, Gemini AI Mobile, dan rilis Google Play Store.
                        </p>
                        <div class="d-flex gap-2 pt-3 border-top">
                            <a href="learn.php?c=flutter" class="btn-learn flex-grow-1">
                                Mulai Belajar &raquo;
                            </a>
                            <a href="tryit.php?c=flutter" class="btn-tryit-outline" title="Coba Kode Langsung">
                                <i class="fa-solid fa-code"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- CARD 6: UI/UX -->
                <div class="col-md-6 col-lg-4">
                    <div class="course-card">
                        <div class="course-icon-badge" style="background: #fdf4ff; color: #c026d3;">
                            <i class="fa-solid fa-bezier-curve"></i>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge bg-pink-subtle text-pink fw-bold" style="background:#fce7f3; color:#be185d;">Desain Produk & Riset</span>
                            <small class="text-muted"><i class="fa-solid fa-book-open me-1"></i> 18 Topik</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">UI/UX Design & Figma</h4>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                            Kuasai metodologi Design Thinking, riset pengguna, Auto-Layout responsif Figma, Design Tokens, prototyping interaktif, dan handoff developer.
                        </p>
                        <div class="d-flex gap-2 pt-3 border-top">
                            <a href="learn.php?c=uiux" class="btn-learn flex-grow-1">
                                Mulai Belajar &raquo;
                            </a>
                            <a href="tryit.php?c=uiux" class="btn-tryit-outline" title="Coba Kode Langsung">
                                <i class="fa-solid fa-code"></i>
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    <!-- SECTION: JALUR BELAJAR & ROADMAP TERSTRUKTUR -->
    <section class="py-5 bg-white border-top border-bottom">
        <div class="container py-2">
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
                <div>
                    <span class="badge bg-gold text-navy fw-bold px-3 py-2 rounded-pill mb-2 text-uppercase shadow-sm" style="background-color: #fca311 !important; color: #071a35 !important; font-size: 0.75rem;">
                        <i class="fa-solid fa-compass me-1"></i> Jalur Belajar Terstruktur
                    </span>
                    <h2 class="fw-bold text-navy font-heading mb-1">Roadmap Karier & Keahlian Digital</h2>
                    <p class="text-muted mb-0">Panduan bertahap dari pemula, menengah, hingga mahir untuk mempersiapkan Anda siap berkarier.</p>
                </div>
                <div class="mt-3 mt-md-0">
                    <a href="roadmap.php" class="btn btn-navy text-white rounded-pill px-4 py-2 fw-bold shadow-sm" style="background-color: #0d2e5c !important; color: #ffffff !important;">
                        <i class="fa-solid fa-map-location-dot text-gold me-1"></i> Buka Roadmap Lengkap &raquo;
                    </a>
                </div>
            </div>

            <div class="row g-4">
                <!-- CARD 1: FRONTEND -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 p-4 shadow-sm" style="background: #f8fafc; border-top: 4px solid #fca311 !important;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-warning-subtle text-warning-emphasis fw-bold">Frontend Track</span>
                            <small class="text-muted"><i class="fa-regular fa-clock me-1"></i> ~12 Minggu</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Frontend Web Developer</h4>
                        <p class="text-secondary small mb-3" style="line-height: 1.6;">
                            Kuasai pembuatan antarmuka web modern dari dasar struktur, desain responsif, hingga animasi interaktif tingkat lanjut.
                        </p>
                        <div class="d-flex flex-wrap gap-1 mb-4">
                            <span class="badge bg-light text-secondary border">HTML5</span>
                            <span class="badge bg-light text-secondary border">CSS3</span>
                            <span class="badge bg-light text-secondary border">JavaScript</span>
                            <span class="badge bg-light text-secondary border">jQuery</span>
                            <span class="badge bg-light text-secondary border">Bootstrap 5</span>
                            <span class="badge bg-light text-secondary border">Vue.js 3</span>
                        </div>
                        <a href="roadmap.php?path=frontend" class="btn btn-outline-navy btn-sm rounded-pill mt-auto fw-bold">
                            Lihat Jalur Frontend &raquo;
                        </a>
                    </div>
                </div>

                <!-- CARD 2: BACKEND -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 p-4 shadow-sm" style="background: #f8fafc; border-top: 4px solid #00758f !important;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-info-subtle text-info-emphasis fw-bold">Backend Track</span>
                            <small class="text-muted"><i class="fa-regular fa-clock me-1"></i> ~14 Minggu</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Backend Web Developer</h4>
                        <p class="text-secondary small mb-3" style="line-height: 1.6;">
                            Bangun logika server-side, manajemen basis data relasional SQL berkinerja tinggi, dan arsitektur RESTful API yang aman.
                        </p>
                        <div class="d-flex flex-wrap gap-1 mb-4">
                            <span class="badge bg-light text-secondary border">PHP 8</span>
                            <span class="badge bg-light text-secondary border">SQL / MySQL</span>
                            <span class="badge bg-light text-secondary border">PDO Security</span>
                            <span class="badge bg-light text-secondary border">REST API</span>
                            <span class="badge bg-light text-secondary border">Linux VPS</span>
                        </div>
                        <a href="roadmap.php?path=backend" class="btn btn-outline-navy btn-sm rounded-pill mt-auto fw-bold">
                            Lihat Jalur Backend &raquo;
                        </a>
                    </div>
                </div>

                <!-- CARD 3: FULLSTACK -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 p-4 shadow-sm" style="background: #f8fafc; border-top: 4px solid #04AA6D !important;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-success-subtle text-success-emphasis fw-bold">Fullstack Track</span>
                            <small class="text-muted"><i class="fa-regular fa-clock me-1"></i> ~20 Minggu</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Fullstack Web Developer</h4>
                        <p class="text-secondary small mb-3" style="line-height: 1.6;">
                            Alur komprehensif end-to-end: merancang tampilan web, mengelola basis data, membangun backend, hingga rilis ke Cloud VPS.
                        </p>
                        <div class="d-flex flex-wrap gap-1 mb-4">
                            <span class="badge bg-light text-secondary border">Client Layer</span>
                            <span class="badge bg-light text-secondary border">Server Layer</span>
                            <span class="badge bg-light text-secondary border">Database</span>
                            <span class="badge bg-light text-secondary border">Cloud Nginx</span>
                        </div>
                        <a href="roadmap.php?path=fullstack" class="btn btn-outline-navy btn-sm rounded-pill mt-auto fw-bold">
                            Lihat Jalur Fullstack &raquo;
                        </a>
                    </div>
                </div>

                <!-- CARD 4: PYTHON & AI -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 p-4 shadow-sm" style="background: #f8fafc; border-top: 4px solid #3776ab !important;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-primary-subtle text-primary fw-bold" style="background:#e0f2fe; color:#0369a1;">AI & Data Track</span>
                            <small class="text-muted"><i class="fa-regular fa-clock me-1"></i> ~14 Minggu</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Python, Data & AI Developer</h4>
                        <p class="text-secondary small mb-3" style="line-height: 1.6;">
                            Kuasai bahasa pemrograman terpopuler untuk Machine Learning, manipulasi data Pandas/NumPy, visualisasi grafik, dan algoritma DSA.
                        </p>
                        <div class="d-flex flex-wrap gap-1 mb-4">
                            <span class="badge bg-light text-secondary border">Python 3.12</span>
                            <span class="badge bg-light text-secondary border">OOP & DSA</span>
                            <span class="badge bg-light text-secondary border">NumPy & Pandas</span>
                            <span class="badge bg-light text-secondary border">Matplotlib</span>
                            <span class="badge bg-light text-secondary border">Machine Learning</span>
                        </div>
                        <a href="roadmap.php?path=python" class="btn btn-outline-navy btn-sm rounded-pill mt-auto fw-bold">
                            Lihat Jalur Python &raquo;
                        </a>
                    </div>
                </div>

                <!-- CARD 5: JAVA ENTERPRISE -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 p-4 shadow-sm" style="background: #f8fafc; border-top: 4px solid #ea580c !important;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-warning-subtle text-warning-emphasis fw-bold">Enterprise Track</span>
                            <small class="text-muted"><i class="fa-regular fa-clock me-1"></i> ~16 Minggu</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Java Enterprise Developer</h4>
                        <p class="text-secondary small mb-3" style="line-height: 1.6;">
                            Kuasai bahasa OOP murni untuk arsitektur backend perbankan, multithreading, Collections Framework, dan Spring Boot microservices.
                        </p>
                        <div class="d-flex flex-wrap gap-1 mb-4">
                            <span class="badge bg-light text-secondary border">Java 21</span>
                            <span class="badge bg-light text-secondary border">OOP Murni</span>
                            <span class="badge bg-light text-secondary border">Collections</span>
                            <span class="badge bg-light text-secondary border">Streams</span>
                            <span class="badge bg-light text-secondary border">Spring Boot</span>
                        </div>
                        <a href="roadmap.php?path=java" class="btn btn-outline-navy btn-sm rounded-pill mt-auto fw-bold">
                            Lihat Jalur Java &raquo;
                        </a>
                    </div>
                </div>

                <!-- CARD 6: C++ SYSTEMS & GAME DEVELOPER -->
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border-0 rounded-4 p-4 shadow-sm" style="background: #f8fafc; border-top: 4px solid #00599c !important;">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="badge bg-primary-subtle text-primary fw-bold" style="background: #e0f2fe; color: #00599c;">Sistem & Game Dev</span>
                            <small class="text-muted"><i class="fa-regular fa-clock me-1"></i> ~14 Minggu</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">C++ Systems & Game Dev</h4>
                        <p class="text-secondary small mb-3" style="line-height: 1.6;">
                            Kuasai C++20 modern, manajemen memori manual, pointer, OOP virtual polimorfik, Standard Template Library (STL), dan arsitektur low-latency.
                        </p>
                        <div class="d-flex flex-wrap gap-1 mb-4">
                            <span class="badge bg-light text-secondary border">C++20</span>
                            <span class="badge bg-light text-secondary border">Pointers & Heap</span>
                            <span class="badge bg-light text-secondary border">STL Vector & Map</span>
                            <span class="badge bg-light text-secondary border">Game Engine</span>
                        </div>
                        <a href="roadmap.php?path=cpp" class="btn btn-outline-navy btn-sm rounded-pill mt-auto fw-bold">
                            Lihat Jalur C++ &raquo;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: FITUR UNGGULAN & KEMITRAAN KAMPUS -->
    <section class="py-5 bg-white border-top border-bottom">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6">
                    <span class="badge bg-navy-subtle text-navy fw-bold px-3 py-2 rounded-pill mb-2 text-uppercase" style="font-size: 0.72rem;">Fitur Unggulan</span>
                    <h3 class="fw-bold text-navy font-heading mb-3">Metode Belajar Terbukti: Teori Ringkas + Praktik Langsung</h3>
                    <p class="text-muted mb-4" style="line-height: 1.8;">
                        Tidak perlu mengunduh aplikasi atau text editor yang berat di awal. Cukup buka halaman materi, pahami konsep dasarnya, dan klik <strong>Coba Sendiri (Try it Yourself)</strong> untuk langsung menguji kode di browser Anda.
                    </p>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="feature-box">
                                <h6 class="fw-bold text-navy mb-1"><i class="fa-solid fa-laptop-code text-gold me-2"></i>In-Browser Editor</h6>
                                <p class="text-muted small mb-0">Ubah kode dan lihat hasilnya secara instan di browser.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="feature-box">
                                <h6 class="fw-bold text-navy mb-1"><i class="fa-solid fa-certificate text-success me-2"></i>Siap Kerja Freelance</h6>
                                <p class="text-muted small mb-0">Koneksi langsung ke Bursa Freelance Skillance Indonesia.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card border-0 rounded-4 p-4 shadow-sm" style="background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%); border-left: 4px solid var(--gold) !important;">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div class="bg-navy text-gold p-3 rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 50px; height: 50px; background-color: #0d2e5c !important;">
                                <i class="fa-solid fa-graduation-cap fs-4 text-warning"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-navy mb-0">Rencana Kemitraan Kampus & Fakultas</h5>
                                <small class="text-muted">Workshop Koding & Sertifikasi SKPI Mahasiswa</small>
                            </div>
                        </div>
                        <p class="text-secondary small mb-3" style="line-height: 1.7;">
                            Skillance Academy membuka program kemitraan bagi perguruan tinggi, fakultas, dan organisasi mahasiswa untuk menyelenggarakan workshop teknologi terapan, pembekalan skripsi, serta penerbitan sertifikat kompetensi SKPI resmi.
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="partner.php" class="btn btn-navy text-white btn-sm rounded-pill px-3 py-2 fw-bold shadow-sm" style="background-color: #0d2e5c !important; color: #ffffff !important;">
                                <i class="fa-solid fa-file-pdf text-warning me-1"></i> Pelajari Proposal Kerjasama &raquo;
                            </a>
                            <a href="https://skillance.my.id/bursa-freelance.php" class="btn btn-outline-navy btn-sm rounded-pill px-3 py-2 fw-bold text-navy" style="border: 1.5px solid #0d2e5c; color: #0d2e5c !important;">
                                <i class="fa-solid fa-briefcase me-1"></i> Bursa Freelance
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: ECOSYSTEM HIGHLIGHT (PROJECT KITS, CAMPUS PARTNERSHIP, CERTIFICATION) -->
    <section class="py-5 bg-white border-top border-bottom">
        <div class="container py-2">
            <div class="row g-4 align-items-stretch">
                <!-- BOX 1: PROJECT KITS -->
                <div class="col-lg-4">
                    <div class="p-4 rounded-4 h-100 border d-flex flex-column justify-content-between" style="background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);">
                        <div>
                            <span class="badge bg-danger text-white px-3 py-1 rounded-pill small fw-bold mb-3">Project-Based Learning</span>
                            <h4 class="fw-bold text-navy font-heading mb-2">E-Book & Full Source Code Siap Pakai</h4>
                            <p class="text-secondary small mb-3" style="line-height: 1.7;">
                                Pelajari studi kasus nyata: <strong>Website Desa Modern</strong> (Laravel + Vue), <strong>Aplikasi Kasir POS Thermal</strong>, dan <strong>E-Commerce Midtrans</strong>. Lengkap dengan lisensi komersial untuk skripsi atau dijual ke klien!
                            </p>
                        </div>
                        <a href="projects.php" class="btn btn-navy text-white btn-sm rounded-pill px-4 py-2 fw-bold align-self-start" style="background: #0d2e5c;">
                            <i class="fa-solid fa-book-bookmark text-warning me-1"></i> Buka Katalog E-Book &raquo;
                        </a>
                    </div>
                </div>

                <!-- BOX 2: CAMPUS & UKM PARTNERSHIP -->
                <div class="col-lg-4">
                    <div class="p-4 rounded-4 h-100 border d-flex flex-column justify-content-between" style="background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);">
                        <div>
                            <span class="badge bg-primary text-white px-3 py-1 rounded-pill small fw-bold mb-3">Kolaborasi Organisasi</span>
                            <h4 class="fw-bold text-navy font-heading mb-2">Kemitraan BEM & UKM Mahasiswa</h4>
                            <p class="text-secondary small mb-3" style="line-height: 1.7;">
                                Ingin mengadakan workshop koding di kampus? Skillance Academy menyediakan pemateri, modul, dan sertifikat SKPI dengan sistem <strong>Bagi Hasil Kas UKM 40%–50%</strong> tanpa biaya kerjasama awal.
                            </p>
                        </div>
                        <a href="partner.php" class="btn btn-outline-navy btn-sm rounded-pill px-4 py-2 fw-bold align-self-start text-navy" style="border-color: #0d2e5c;">
                            <i class="fa-solid fa-handshake me-1"></i> Ajukan Kolaborasi Kampus &raquo;
                        </a>
                    </div>
                </div>

                <!-- BOX 3: DIGITAL CERTIFICATION -->
                <div class="col-lg-4">
                    <div class="p-4 rounded-4 h-100 border d-flex flex-column justify-content-between" style="background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);">
                        <div>
                            <span class="badge bg-success text-white px-3 py-1 rounded-pill small fw-bold mb-3">Resmi & Terverifikasi</span>
                            <h4 class="fw-bold text-navy font-heading mb-2">Verifikasi Sertifikat Digital SKPI</h4>
                            <p class="text-secondary small mb-3" style="line-height: 1.7;">
                                Setiap kelulusan jalur belajar diterbitkan sertifikat resmi dengan QR Code dan nomor registrasi unik yang dapat divalidasi langsung oleh pihak kampus dan HRD perusahaan secara realtime.
                            </p>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="exam.php" class="btn btn-success btn-sm rounded-pill px-3 py-2 fw-bold">
                                <i class="fa-solid fa-award me-1"></i> Ikuti Ujian Sertifikasi &raquo;
                            </a>
                            <a href="verify.php" class="btn btn-outline-secondary btn-sm rounded-pill px-3 py-2 fw-bold">
                                <i class="fa-solid fa-shield-halved text-success me-1"></i> Cek Keaslian &raquo;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: VIRAL CLASSROOM SHARE BANNER (MONETIZATION & TRAFFIC DRIVER) -->
    <section class="py-4 bg-light border-bottom">
        <div class="container">
            <div class="card border-0 rounded-4 shadow-sm p-4 p-md-4 text-white overflow-hidden position-relative" style="background: linear-gradient(135deg, #071a35 0%, #0d2e5c 60%, #1e3a8a 100%); border-left: 5px solid #fca311 !important;">
                <div class="row align-items-center g-3">
                    <div class="col-lg-8">
                        <span class="badge bg-warning text-dark px-3 py-1 rounded-pill small fw-bold mb-2">
                            <i class="fa-solid fa-users me-1 text-danger"></i> KOMUNITAS MAHASISWA & PROGRAMMER
                        </span>
                        <h4 class="fw-bold mb-1 text-white">Ajak Teman Sekelas Belajar Koding & Raih Sertifikat SKPI</h4>
                        <p class="text-white-50 small mb-0" style="line-height: 1.6; max-width: 620px;">
                            Bantu teman satu jurusan atau angkatan Anda menguasai koding dari nol dan mempersiapkan portofolio skripsi. Bagikan akses gratis Skillance Academy langsung ke grup WhatsApp kelas Anda!
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="https://api.whatsapp.com/send?text=<?= urlencode("Halo teman-teman! Ada platform belajar koding mandiri gratis dari Skillance Academy Indonesia. Lengkap tutorial praktis HTML, CSS, JS, PHP, Python, Flutter, sampai ujian sertifikasi resmi untuk lampiran SKPI kampus. Yuk coba kuis tryout kilatnya di sini: https://academy.skillance.cloud") ?>" 
                           target="_blank" rel="noopener noreferrer" 
                           class="btn btn-success btn-lg fw-bold px-4 py-3 rounded-pill shadow-sm d-inline-flex align-items-center gap-2" style="background-color: #25D366; border-color: #25D366;">
                            <i class="fa-brands fa-whatsapp fs-5"></i> Bagikan ke Grup WA &raquo;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: FAQ INTERAKTIF & GOOGLE RICH SNIPPET (TRUST & CONVERSION) -->
    <section class="py-5 bg-white border-bottom" id="faq">
        <div class="container py-2">
            <div class="text-center mb-5">
                <span class="badge bg-gold text-navy fw-bold px-3 py-2 rounded-pill mb-2 text-uppercase shadow-sm" style="background-color: #fca311 !important; color: #071a35 !important; font-size: 0.75rem;">
                    <i class="fa-solid fa-circle-question me-1"></i> BANTUAN & TANYA JAWAB
                </span>
                <h2 class="display-6 fw-bold text-navy font-heading mb-2">Pertanyaan yang Sering Diajukan (FAQ)</h2>
                <p class="text-muted small mx-auto mb-0" style="max-width: 620px; line-height: 1.7;">
                    Semua yang perlu Anda ketahui mengenai akses belajar, keabsahan sertifikat SKPI kampus, ujian online, dan peluang monetisasi proyek teknologi di Skillance Academy.
                </p>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="accordion accordion-flush shadow-sm rounded-4 border overflow-hidden" id="academyFaqAccordion">
                        
                        <!-- FAQ 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading1">
                                <button class="accordion-button fw-bold text-navy py-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="false" aria-controls="faqCollapse1" style="font-size: 0.98rem;">
                                    <i class="fa-solid fa-circle-check text-success me-2"></i> Apakah materi tutorial dan Code Lab di Skillance Academy benar-benar gratis?
                                </button>
                            </h2>
                            <div id="faqCollapse1" class="accordion-collapse collapse" aria-labelledby="faqHeading1" data-bs-parent="#academyFaqAccordion">
                                <div class="accordion-body text-secondary small" style="line-height: 1.8; font-size: 0.9rem;">
                                    <strong>Ya, 100% gratis!</strong> Seluruh silabus komprehensif (HTML, CSS, JavaScript, PHP, MySQL, Python, Vue.js, Flutter, dan UI/UX Design) serta editor interaktif <em>Code Lab (Try it Yourself)</em> dapat diakses bebas tanpa dipungut biaya dan tanpa kewajiban berlangganan.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading2">
                                <button class="accordion-button fw-bold text-navy py-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2" style="font-size: 0.98rem;">
                                    <i class="fa-solid fa-shield-halved text-primary me-2"></i> Apakah sertifikat kelulusan resmi dan diakui untuk lampiran SKPI kampus?
                                </button>
                            </h2>
                            <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#academyFaqAccordion">
                                <div class="accordion-body text-secondary small" style="line-height: 1.8; font-size: 0.9rem;">
                                    <strong>Sangat resmi dan terverifikasi.</strong> Setiap peserta yang lulus ujian kompetensi akan menerima e-sertifikat digital beresolusi tinggi (format cetak A4) yang dilengkapi <strong>Nomor Seri Unik</strong> dan <strong>QR Code Kriptografis</strong>. Pihak BAAK, dosen pembimbing, maupun HRD perusahaan dapat memindai atau memeriksa langsung keabsahannya di <a href="verify.php" class="text-decoration-none fw-bold text-navy">academy.skillance.cloud/verify.php</a> secara realtime.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading3">
                                <button class="accordion-button fw-bold text-navy py-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3" style="font-size: 0.98rem;">
                                    <i class="fa-solid fa-award text-warning me-2"></i> Berapa batas nilai ujian sertifikasi dan apakah bisa mengulang jika belum lulus?
                                </button>
                            </h2>
                            <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#academyFaqAccordion">
                                <div class="accordion-body text-secondary small" style="line-height: 1.8; font-size: 0.9rem;">
                                    Batas kelulusan standar industri adalah skor minimal <strong>80%</strong> dari 25 butir soal pilihan ganda acak. Jika belum mencapai skor tersebut, Anda dapat mempelajari kembali modul materi dan mengulang ujian tanpa penalti. Kami juga menyediakan fitur <strong>Simulasi Tryout Kilat 5 Soal (2 Menit)</strong> untuk pemanasan instan sebelum memulai ujian resmi.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 4 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading4">
                                <button class="accordion-button fw-bold text-navy py-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4" style="font-size: 0.98rem;">
                                    <i class="fa-solid fa-laptop-code text-danger me-2"></i> Apa itu E-Book & Project Kit Siap Pakai dan apakah ada lisensi komersialnya?
                                </button>
                            </h2>
                            <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4" data-bs-parent="#academyFaqAccordion">
                                <div class="accordion-body text-secondary small" style="line-height: 1.8; font-size: 0.9rem;">
                                    <strong>Project Kit</strong> di Skillance Academy adalah paket lengkap berupa source code aplikasi produksi nyata (seperti <em>Website Desa Modern</em>, <em>Aplikasi Kasir POS Thermal</em>, dan <em>E-Commerce Gateway Midtrans</em>) disertai e-book petunjuk instalasi dan skema database MySQL. Pembeli mendapatkan <strong>Lisensi Komersial Penuh (Full Commercial Rights)</strong>, sehingga kode program bebas dimodifikasi untuk tugas akhir/skripsi maupun dijual kembali kepada klien UMKM lokal.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 5 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading5">
                                <button class="accordion-button fw-bold text-navy py-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5" style="font-size: 0.98rem;">
                                    <i class="fa-solid fa-handshake text-success me-2"></i> Bagaimana ormawa (BEM/HIMA/UKM) dapat bermitra menyelenggarakan workshop?
                                </button>
                            </h2>
                            <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5" data-bs-parent="#academyFaqAccordion">
                                <div class="accordion-body text-secondary small" style="line-height: 1.8; font-size: 0.9rem;">
                                    Ormawa dapat mengajukan kemitraan <em>Co-Branded Workshop</em> melalui menu <a href="partner.php" class="text-decoration-none fw-bold text-navy">Kemitraan Kampus</a>. Skillance Academy menyediakan instruktur ahli, kurikulum studi kasus, dan sistem sertifikat SKPI dengan sistem <strong>Bagi Hasil Tiket 40% – 50% masuk langsung ke kas ormawa</strong> tanpa biaya deposit awal (Zero Capital). Anda juga dapat mengunduh format surat proposal resmi siap cetak di <a href="proposal.php" class="text-decoration-none fw-bold text-navy">halaman proposal</a>.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ 6 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="faqHeading6">
                                <button class="accordion-button fw-bold text-navy py-3 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse6" aria-expanded="false" aria-controls="faqCollapse6" style="font-size: 0.98rem;">
                                    <i class="fa-solid fa-mobile-screen-button text-info me-2"></i> Apakah bisa belajar koding dan mencoba editor hanya melalui smartphone?
                                </button>
                            </h2>
                            <div id="faqCollapse6" class="accordion-collapse collapse" aria-labelledby="faqHeading6" data-bs-parent="#academyFaqAccordion">
                                <div class="accordion-body text-secondary small" style="line-height: 1.8; font-size: 0.9rem;">
                                    <strong>Bisa!</strong> Seluruh antarmuka platform dirancang responsif untuk peramban ponsel. Pada editor koding <em>Code Lab</em>, tersedia tab navigasi khusus ponsel (Editor, Hasil, dan Split) sehingga Anda dapat mengetik sintaks dan menguji tampilan secara ergonomis langsung dari genggaman tanpa harus membuka laptop.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SCHEMA.ORG FAQPAGE (JSON-LD) FOR GOOGLE RICH SNIPPET -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [
        {
          "@type": "Question",
          "name": "Apakah materi tutorial dan Code Lab di Skillance Academy benar-benar gratis?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Ya, 100% gratis tanpa biaya tersembunyi. Seluruh silabus komprehensif dan editor interaktif Code Lab dapat diakses bebas tanpa dipungut biaya."
          }
        },
        {
          "@type": "Question",
          "name": "Apakah sertifikat kelulusan resmi dan diakui untuk lampiran SKPI kampus?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Sangat resmi. Setiap sertifikat kelulusan dilengkapi Nomor Seri Unik dan QR Code Kriptografis yang dapat divalidasi publik di academy.skillance.cloud/verify.php untuk keperluan SKPI kampus dan rekrutmen kerja."
          }
        },
        {
          "@type": "Question",
          "name": "Berapa batas nilai ujian sertifikasi dan apakah bisa mengulang jika belum lulus?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Batas kelulusan standar industri adalah skor minimal 80% dari 25 butir soal. Siswa dapat mengulang ujian kapan saja tanpa penalti."
          }
        },
        {
          "@type": "Question",
          "name": "Apa itu E-Book & Project Kit Siap Pakai dan apakah ada lisensi komersialnya?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Project Kit adalah paket lengkap berupa source code aplikasi produksi nyata (Website Desa, POS Kasir, E-Commerce) dengan lisensi komersial penuh untuk referensi skripsi maupun dijual ke klien UMKM."
          }
        },
        {
          "@type": "Question",
          "name": "Bagaimana ormawa (BEM/HIMA/UKM) dapat bermitra menyelenggarakan workshop?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Ormawa dapat mengajukan kemitraan Co-Branded Workshop dengan bagi hasil tiket 40-50% masuk ke kas ormawa tanpa modal awal (Zero Capital)."
          }
        },
        {
          "@type": "Question",
          "name": "Apakah bisa belajar koding dan mencoba editor hanya melalui smartphone?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Bisa. Platform memiliki tata letak mobile ergonomis dengan mode tab Editor, Hasil, dan Split di browser smartphone."
          }
        }
      ]
    }
    </script>

    <?php include __DIR__ . '/includes/footer.php'; ?>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include_once __DIR__ . '/includes/spotlight_modal.php'; ?>
<script src="assets/js/spotlight.js"></script>
</body>
</html>
