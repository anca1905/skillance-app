<?php
session_start();
require_once __DIR__ . '/tutorials_data.php';

$userId = $_SESSION['user_id'] ?? null;
$userName = $_SESSION['user_name'] ?? 'Tamu Mahasiswa';
$userEmail = $_SESSION['user_email'] ?? '';
$userType = $_SESSION['user_type'] ?? 'student';
$avatarUrl = $_SESSION['user_photo'] ?? ('https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=0d2e5c&color=fff');
$isLoggedIn = !empty($userId);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skillance Academy Indonesia - Platform Belajar Koding Praktis & Mandiri</title>
    
    <!-- Meta SEO -->
    <meta name="description" content="Portal belajar koding mandiri dan interaktif resmi dari Skillance Academy Indonesia untuk mahasiswa dan umum. Kuasai HTML, CSS, JavaScript, PHP, MySQL, dan Flutter.">
    
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

    <!-- TOP HUB BAR -->
    <div class="top-hub-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <a href="https://skillance.my.id" class="text-decoration-none text-white-50 hover-white me-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke <strong>skillance.my.id</strong>
                </a>
                <a href="https://skillance.my.id/bursa-freelance.php" class="text-decoration-none text-gold me-2 d-none d-md-inline">
                    <i class="fa-solid fa-briefcase me-1"></i> Bursa Freelance
                </a>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="small d-none d-md-inline" style="color: #cbd5e1;">Skillance Academy Indonesia</span>
                <?php if ($isLoggedIn): ?>
                    <span class="badge bg-success-subtle text-success"><i class="fa-solid fa-circle-check me-1"></i> <?= htmlspecialchars($userName) ?></span>
                    <a href="auth/logout.php" class="text-white-50 text-decoration-none small"><i class="fa-solid fa-right-from-bracket me-1"></i> Keluar</a>
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
                <a href="roadmap.php" class="btn btn-sm btn-navy rounded-pill px-3 py-2 fw-bold">
                    <i class="fa-solid fa-map-location-dot text-gold me-1"></i> Roadmap Belajar
                </a>
                <a href="tryit.php" class="btn btn-sm btn-outline-navy rounded-pill px-3 py-2 fw-bold">
                    <i class="fa-solid fa-code text-gold me-1"></i> Code Lab Editor
                </a>
                <?php if ($isLoggedIn): ?>
                    <a href="https://skillance.my.id/dashboard/freelancer/" class="btn btn-sm btn-navy rounded-pill px-3 py-2 fw-bold">
                        <i class="fa-solid fa-briefcase me-1"></i> Dashboard Freelance
                    </a>
                <?php else: ?>
                    <a href="https://skillance.my.id/auth/index.php?ref=academy" class="btn btn-sm btn-navy rounded-pill px-3 py-2 fw-bold">
                        <i class="fa-solid fa-user me-1"></i> Masuk
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- COURSE SUBNAV BAR (Skillance Quick Nav Bar) -->
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
            <a href="roadmap.php" class="course-nav-item text-gold ms-auto"><i class="fa-solid fa-map-location-dot me-1"></i> ROADMAP BELAJAR</a>
            <a href="tryit.php" class="course-nav-item text-gold"><i class="fa-solid fa-bolt me-1"></i> TRY IT YOURSELF</a>
        </div>
    </div>

    <!-- HERO BANNER -->
    <header class="hero-banner">
        <div class="container">
            <span class="badge bg-gold text-navy fw-bold px-3 py-2 rounded-pill mb-3 text-uppercase shadow-sm" style="font-size: 0.78rem; letter-spacing: 0.8px;">
                <i class="fa-solid fa-book-open me-1"></i> Modul Terstruktur Mandiri
            </span>
            <h1 class="display-5 fw-bold font-heading mb-3 text-white">Belajar Koding Praktis & Terarah</h1>
            <p class="lead mx-auto mb-4" style="max-width: 720px; color: #cbd5e1; line-height: 1.8; font-size: 1.05rem;">
                Setiap materi disusun secara terpisah, rapi, dan mudah dipahami berdasarkan standar <strong>Skillance Academy</strong>. Disertai contoh kode yang dapat Anda coba dan jalankan langsung di browser!
            </p>

            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="roadmap.php" class="btn btn-warning btn-lg fw-bold px-4 py-3 rounded-pill text-navy shadow">
                    <i class="fa-solid fa-map-location-dot me-2"></i> Lihat Roadmap Belajar &raquo;
                </a>
                <a href="learn.php?c=html" class="btn btn-outline-light btn-lg fw-bold px-4 py-3 rounded-pill">
                    <i class="fa-solid fa-play me-2"></i> Mulai dari HTML
                </a>
                <a href="tryit.php" class="btn btn-outline-light btn-lg fw-bold px-4 py-3 rounded-pill">
                    <i class="fa-solid fa-code me-2"></i> Code Lab Editor
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
                            <span class="badge bg-info-subtle text-info-emphasis fw-bold">Mobile Native</span>
                            <small class="text-muted">Android & iOS</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">Flutter Mobile</h4>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                            Toolkit UI dari Google untuk membangun aplikasi smartphone Android & iOS berperforma tinggi dengan satu basis kode Dart.
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
                            <span class="badge bg-pink-subtle text-pink fw-bold" style="background:#fce7f3; color:#be185d;">Desain Produk</span>
                            <small class="text-muted">Figma & UX</small>
                        </div>
                        <h4 class="fw-bold text-navy mb-2">UI/UX Design</h4>
                        <p class="text-secondary small mb-4 flex-grow-1" style="line-height: 1.6;">
                            Metodologi Design Thinking, riset pengguna, wireframing, Auto-Layout responsif di Figma, dan penyerahan desain ke developer.
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
                    <span class="badge bg-gold text-navy fw-bold px-3 py-2 rounded-pill mb-2 text-uppercase shadow-sm" style="font-size: 0.75rem;">
                        <i class="fa-solid fa-compass me-1"></i> Jalur Belajar Terstruktur
                    </span>
                    <h2 class="fw-bold text-navy font-heading mb-1">Roadmap Karier & Keahlian Digital</h2>
                    <p class="text-muted mb-0">Panduan bertahap dari pemula, menengah, hingga mahir untuk mempersiapkan Anda siap berkarier.</p>
                </div>
                <div class="mt-3 mt-md-0">
                    <a href="roadmap.php" class="btn btn-navy rounded-pill px-4 py-2 fw-bold shadow-sm">
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
                            <div class="bg-navy text-gold p-3 rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="fa-solid fa-handshake fs-4"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-navy mb-0">Mitra Komunitas & Kampus</h5>
                                <small class="text-muted">Multimedia Study Club (MSC) USN Kolaka</small>
                            </div>
                        </div>
                        <p class="text-secondary small mb-3" style="line-height: 1.7;">
                            Skillance Academy berkolaborasi aktif dengan organisasi mahasiswa dan komunitas riset teknologi di kampus lokal untuk mencetak talenta programmer dan desainer siap industri dari daerah.
                        </p>
                        <a href="https://skillance.my.id/bursa-freelance.php" class="btn btn-navy btn-sm rounded-pill px-4 py-2 fw-bold align-self-start">
                            <i class="fa-solid fa-briefcase me-1"></i> Buka Bursa Freelance &raquo;
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="py-4 text-center bg-white border-top">
        <div class="container">
            <p class="small text-muted mb-1">&copy; 2026 Skillance Academy Indonesia & Skillance Digital Indonesia. All rights reserved.</p>
            <p class="small text-muted mb-0">
                <a href="https://skillance.my.id" class="text-navy text-decoration-none me-3">Website Utama</a>
                <a href="https://skillance.my.id/bursa-freelance.php" class="text-navy text-decoration-none me-3">Bursa Freelance</a>
                <a href="learn.php?c=html" class="text-navy text-decoration-none">Materi HTML</a>
            </p>
        </div>
    </footer>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
