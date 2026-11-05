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
            <a href="learn.php?c=flutter" class="course-nav-item"><i class="fa-solid fa-mobile-screen-button me-1 text-info"></i> FLUTTER</a>
            <a href="learn.php?c=uiux" class="course-nav-item"><i class="fa-solid fa-bezier-curve me-1 text-pink"></i> UI/UX</a>
            <a href="tryit.php" class="course-nav-item text-gold ms-auto"><i class="fa-solid fa-bolt me-1"></i> TRY IT YOURSELF</a>
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
                <a href="learn.php?c=html" class="btn btn-warning btn-lg fw-bold px-4 py-3 rounded-pill text-navy shadow">
                    <i class="fa-solid fa-play me-2"></i> Mulai Belajar HTML &raquo;
                </a>
                <a href="tryit.php" class="btn btn-outline-light btn-lg fw-bold px-4 py-3 rounded-pill">
                    <i class="fa-solid fa-code me-2"></i> Buka Try It Yourself Editor
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
