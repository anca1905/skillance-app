<?php
session_start();
$isLoggedIn = !empty($_SESSION['user_id']);
$userName = $_SESSION['user_name'] ?? '';
$userPhoto = $_SESSION['user_photo'] ?? null;
$userType = $_SESSION['user_type'] ?? 'umum';
$userEmail = $_SESSION['user_email'] ?? '';
$avatarUrl = $userPhoto ?: ('https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=0d2e5c&color=fff');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skillance Academy: Platform Belajar Pemrograman & Koding Interaktif Indonesia</title>
    <meta name="description" content="Platform belajar koding interaktif ala W3Schools & Dicoding di Indonesia. Pelajari Web Development, Backend, Mobile Flutter, dan Desain UI/UX dengan latihan langsung di browser.">
    <meta name="keywords" content="belajar coding online, tutorial html css php javascript laravel flutter figma, w3schools indonesia, dicoding sultra, skillance academy, academy.skillance.cloud">
    <meta name="author" content="Skillance Digital Indonesia">
    <link rel="canonical" href="https://academy.skillance.cloud">

    <!-- Open Graph -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:type" content="website">
    <meta property="og:title" content="Skillance Academy Indonesia: Platform Belajar Koding Interaktif">
    <meta property="og:description" content="Platform edukasi pemrograman praktis ala W3Schools & Dicoding. Coba koding langsung di browser dan ikuti jalur belajar terstruktur.">
    <meta property="og:url" content="https://academy.skillance.cloud">
    <meta property="og:image" content="https://skillance.my.id/assets/img/og-preview.png">

    <link rel="icon" type="image/png" href="https://skillance.my.id/assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700&family=Fira+Code:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://skillance.my.id/assets/css/style.css">

    <style>
        :root {
            --code-bg: #0b192c;
            --code-header: #061221;
        }
        .code-font {
            font-family: 'Fira Code', monospace;
        }
        .playground-editor {
            background-color: var(--code-bg);
            color: #f8fafc;
            border: 1px solid #1e293b;
            border-radius: 8px;
            font-family: 'Fira Code', monospace;
            font-size: 0.88rem;
            line-height: 1.6;
            resize: vertical;
            min-height: 240px;
            padding: 16px;
            width: 100%;
        }
        .playground-editor:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 2px rgba(252, 163, 17, 0.25);
        }
        .preview-iframe {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            width: 100%;
            min-height: 240px;
            height: 100%;
        }
        .track-card {
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            border-radius: 14px;
        }
        .track-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(13, 46, 92, 0.1) !important;
        }
        .top-hub-bar {
            background: #061a35;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.85rem;
        }
    </style>
</head>
<body style="background-color: #f8fafc;">

    <!-- TOP HUB NAVIGATION: Menghubungkan antara Academy & Website Utama Skillance -->
    <div class="top-hub-bar py-2 px-3 text-white">
        <div class="container d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div class="d-flex align-items-center gap-2">
                <span class="badge bg-gold text-navy fw-bold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.5px;">Portal Belajar</span>
                <?php if ($isLoggedIn): ?>
                    <span class="small" style="color: #cbd5e1;">
                        <span class="badge bg-success text-white me-1 px-2 py-1"><i class="fa-solid fa-circle-check me-1"></i> Akun Terpadu</span>
                        Halo, <strong class="text-white"><?= htmlspecialchars($userName) ?></strong>
                    </span>
                <?php else: ?>
                    <span class="small d-none d-md-inline" style="color: #cbd5e1;">Skillance Academy Indonesia (academy.skillance.cloud)</span>
                <?php endif; ?>
            </div>
            <div class="d-flex align-items-center gap-2 ms-auto">
                <a href="https://skillance.my.id" class="btn btn-sm btn-outline-light rounded-pill px-3 py-1" style="font-size: 0.78rem;">
                    <i class="fa-solid fa-arrow-left me-1"></i> Website Utama
                </a>
                <a href="https://skillance.my.id/dashboard/freelancer/" class="btn btn-sm btn-gold rounded-pill px-3 py-1 fw-bold" style="font-size: 0.78rem;">
                    <i class="fa-solid fa-briefcase me-1"></i> Mode Freelance
                </a>
            </div>
        </div>
    </div>

    <!-- Main Academy Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.html">
                <i class="fa-solid fa-graduation-cap text-gold fs-3"></i>
                <div class="d-flex flex-column">
                    <span class="fw-bold text-navy lh-1 ls-2" style="font-size: 1.15rem;">SKILLANCE ACADEMY</span>
                    <small class="text-muted fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">KODING & MULTIMEDIA INDONESIA</small>
                </div>
            </a>
            <!-- Mobile Profile Avatar (tampak di HP) -->
            <div class="d-flex align-items-center gap-2 ms-auto d-lg-none">
                <?php if ($isLoggedIn): ?>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-light rounded-circle p-1 dropdown-toggle shadow-none border-0" type="button" data-bs-toggle="dropdown">
                            <img src="<?= htmlspecialchars($avatarUrl) ?>" class="rounded-circle shadow-sm" style="width: 32px; height: 32px; object-fit: cover;">
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2" style="font-size: 0.85rem; min-width: 220px;">
                            <li class="px-3 py-2 border-bottom">
                                <div class="fw-bold text-navy text-truncate"><?= htmlspecialchars($userName) ?></div>
                                <small class="text-muted text-uppercase" style="font-size: 0.68rem;"><i class="fa-solid fa-graduation-cap text-gold me-1"></i> Siswa Aktif (<?= htmlspecialchars($userType) ?>)</small>
                            </li>
                            <li><a class="dropdown-item py-2 fw-semibold" href="https://skillance.my.id/dashboard/freelancer/"><i class="fa-solid fa-briefcase text-gold me-2"></i> Mode Freelance</a></li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li><a class="dropdown-item py-2 text-danger fw-semibold" href="auth/logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i> Keluar</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="https://skillance.my.id/auth/index.php?ref=academy" class="btn btn-sm btn-navy rounded-pill px-3 py-1 fw-bold" style="font-size: 0.78rem;">
                        <i class="fa-solid fa-user me-1"></i> Masuk
                    </a>
                <?php endif; ?>
            </div>

            <button class="navbar-toggler border-0 shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#academyNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="academyNav">
                <ul class="navbar-nav mx-auto align-items-lg-center gap-lg-2 my-3 my-lg-0">
                    <li class="nav-item"><a class="nav-link fw-semibold active text-navy" href="#tracks">Jalur Belajar</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold text-navy" href="#playground">Code Playground</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold text-navy" href="#fitur">Fitur Interaktif</a></li>
                    <li class="nav-item"><a class="nav-link fw-semibold text-navy" href="#kemitraan">Mitra Kampus (MSC USN)</a></li>
                </ul>
                <div class="d-none d-lg-flex align-items-center gap-2" id="navAuthArea">
                    <?php if ($isLoggedIn): ?>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-navy rounded-pill px-3 py-1 fw-bold dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                                <img src="<?= htmlspecialchars($avatarUrl) ?>" class="rounded-circle shadow-sm" style="width: 26px; height: 26px; object-fit: cover;">
                                <span class="text-truncate" style="max-width: 130px;"><?= htmlspecialchars($userName) ?></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2" style="font-size: 0.85rem; min-width: 230px;">
                                <li class="px-3 py-2 border-bottom">
                                    <div class="fw-bold text-navy text-truncate"><?= htmlspecialchars($userName) ?></div>
                                    <small class="text-muted text-uppercase" style="font-size: 0.68rem;"><i class="fa-solid fa-graduation-cap text-gold me-1"></i> Siswa Aktif (<?= htmlspecialchars($userType) ?>)</small>
                                </li>
                                <li><a class="dropdown-item py-2 fw-semibold" href="https://skillance.my.id/dashboard/freelancer/"><i class="fa-solid fa-briefcase text-gold me-2"></i> Mode Freelance & Tugas</a></li>
                                <li><hr class="dropdown-divider my-1"></li>
                                <li><a class="dropdown-item py-2 text-danger fw-semibold" href="auth/logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i> Keluar</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="https://skillance.my.id/auth/index.php?ref=academy" class="btn btn-navy btn-sm rounded-pill px-3 fw-bold">
                            <i class="fa-solid fa-user me-1"></i> Akun Belajar
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section: W3Schools & Dicoding Concept -->
    <header class="py-5 text-white position-relative overflow-hidden" style="background: linear-gradient(135deg, #0d2e5c 0%, #061a35 100%);">
        <div class="container py-4 text-center">
            <span class="badge bg-gold text-navy fw-bold px-3 py-2 rounded-pill mb-3 text-uppercase shadow-sm" style="font-size: 0.75rem; letter-spacing: 1px;">
                <i class="fa-solid fa-terminal text-navy me-1"></i> Interactive Coding Platform
            </span>
            <h1 class="display-5 fw-bold font-heading mb-3 text-white">Belajar Koding Praktis dari Nol Hingga Jadi Software Engineer</h1>
            <p class="lead mx-auto mb-4" style="max-width: 760px; color: #cbd5e1; line-height: 1.8;">
                Kurikulum bertahap ala <strong>Dicoding</strong> dan latihan kode langsung di browser ala <strong>W3Schools</strong>. Kuasai Web Development, Backend, Flutter Mobile Apps, dan UI/UX Design berstandar industri.
            </p>

            <!-- Search Quick Code Topics -->
            <div class="mx-auto mb-4" style="max-width: 580px;">
                <div class="input-group shadow-lg rounded-pill overflow-hidden bg-white p-1">
                    <span class="input-group-text bg-transparent border-0 text-muted ps-3">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>
                    <input type="text" id="searchInput" class="form-control border-0 shadow-none" placeholder="Cari materi koding: HTML, CSS, JavaScript, PHP, Laravel, Flutter, Figma..." onkeyup="filterTracks()">
                    <button class="btn btn-gold fw-bold px-4 rounded-pill" type="button">Cari Materi</button>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-center gap-2 text-white-50 small">
                <span>Topik Populer:</span>
                <a href="#playground" onclick="loadTemplate('html')" class="badge bg-white bg-opacity-10 text-white text-decoration-none px-2 py-1">HTML5</a>
                <a href="#playground" onclick="loadTemplate('css')" class="badge bg-white bg-opacity-10 text-white text-decoration-none px-2 py-1">CSS Flexbox</a>
                <a href="#playground" onclick="loadTemplate('js')" class="badge bg-white bg-opacity-10 text-white text-decoration-none px-2 py-1">JavaScript DOM</a>
                <a href="#tracks" class="badge bg-white bg-opacity-10 text-white text-decoration-none px-2 py-1">PHP & MySQL</a>
                <a href="#tracks" class="badge bg-white bg-opacity-10 text-white text-decoration-none px-2 py-1">Laravel 11</a>
                <a href="#tracks" class="badge bg-white bg-opacity-10 text-white text-decoration-none px-2 py-1">Flutter Mobile</a>
            </div>
        </div>
    </header>

    <!-- SECTION: INTERACTIVE CODE PLAYGROUND (ALA W3SCHOOLS "TRY IT YOURSELF") -->
    <section class="py-5 bg-white border-bottom" id="playground">
        <div class="container py-3">
            <div class="text-center mb-4 mx-auto" style="max-width: 650px;">
                <span class="badge bg-gold-subtle text-navy fw-bold px-3 py-2 rounded-pill mb-2 text-uppercase" style="font-size: 0.72rem;">
                    <i class="fa-solid fa-code text-gold me-1"></i> Interactive Lab
                </span>
                <h3 class="fw-bold text-navy font-heading">Code Playground ("Try It Yourself")</h3>
                <p class="text-muted small">Coba ubah kode di bawah ini dan klik tombol <strong>Jalankan Kode</strong> untuk melihat hasil rendering langsung di browser.</p>
            </div>

            <!-- Editor Container -->
            <div class="card border-0 rounded-4 shadow-lg overflow-hidden" style="background-color: var(--code-bg);">
                <!-- Editor Top Bar -->
                <div class="card-header border-bottom border-dark py-3 px-4 d-flex flex-wrap justify-content-between align-items-center gap-2" style="background-color: var(--code-header);">
                    <div class="d-flex align-items-center gap-2">
                        <span class="rounded-circle d-inline-block" style="width: 12px; height: 12px; background-color: #ff5f56;"></span>
                        <span class="rounded-circle d-inline-block" style="width: 12px; height: 12px; background-color: #ffbd2e;"></span>
                        <span class="rounded-circle d-inline-block" style="width: 12px; height: 12px; background-color: #27c93f;"></span>
                        <span class="text-white-50 ms-2 small code-font" id="editorFilename">index.html (HTML + CSS + JS)</span>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <div class="btn-group btn-group-sm" role="group">
                            <button type="button" class="btn btn-outline-light btn-sm" onclick="loadTemplate('html')">Template HTML</button>
                            <button type="button" class="btn btn-outline-light btn-sm" onclick="loadTemplate('css')">Template Button CSS</button>
                            <button type="button" class="btn btn-outline-light btn-sm" onclick="loadTemplate('js')">Template Counter JS</button>
                        </div>
                        <button type="button" class="btn btn-gold btn-sm fw-bold px-3 rounded-pill" onclick="runCode()">
                            <i class="fa-solid fa-play me-1"></i> Jalankan Kode
                        </button>
                    </div>
                </div>

                <!-- Code Input & Preview Split Screen -->
                <div class="card-body p-3">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="d-flex justify-content-between align-items-center text-white-50 small mb-2 px-1">
                                <span><i class="fa-solid fa-pen-to-square me-1"></i> Editor Kode</span>
                                <span class="badge bg-secondary" style="font-size:0.7rem;">Live Edit</span>
                            </div>
                            <textarea id="codeEditor" class="playground-editor" spellcheck="false" placeholder="Tuliskan kode HTML/CSS/JavaScript di sini...">&lt;!DOCTYPE html&gt;
&lt;html&gt;
&lt;head&gt;
    &lt;style&gt;
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            text-align: center;
            padding: 30px 15px;
            background: linear-gradient(135deg, #eef2f7 0%, #ffffff 100%);
            color: #0d2e5c;
        }
        .card-demo {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            max-width: 380px;
            margin: auto;
            border-top: 4px solid #fca311;
        }
        h2 { margin-bottom: 8px; font-weight: bold; }
        p { color: #555; font-size: 14px; line-height: 1.6; }
        button {
            background: #0d2e5c;
            color: white;
            border: none;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 50px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover { background: #fca311; color: #0d2e5c; }
    &lt;/style&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;div class="card-demo"&gt;
        &lt;h2&gt;Halo, Skillance Academy!&lt;/h2&gt;
        &lt;p&gt;Selamat datang di Code Playground. Kamu bisa langsung mengedit teks dan kode ini!&lt;/p&gt;
        &lt;button onclick="salam()"&gt;Klik Saya!&lt;/button&gt;
        &lt;p id="pesan" style="margin-top:15px; color:#27c93f; font-weight:bold;"&gt;&lt;/p&gt;
    &lt;/div&gt;

    &lt;script&gt;
        function salam() {
            document.getElementById('pesan').innerText = '🎉 Keren! Kode JavaScript berhasil dieksekusi!';
        }
    &lt;/script&gt;
&lt;/body&gt;
&lt;/html&gt;</textarea>
                        </div>

                        <div class="col-lg-6">
                            <div class="d-flex justify-content-between align-items-center text-white-50 small mb-2 px-1">
                                <span><i class="fa-solid fa-desktop me-1"></i> Hasil Tampilan (Live Preview)</span>
                                <span class="badge bg-success" style="font-size:0.7rem;">Browser Output</span>
                            </div>
                            <iframe id="codePreview" class="preview-iframe" title="Code Preview"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

        <!-- SECTION: JALUR & TAHAPAN BELAJAR LENGKAP (ALA DICODING & W3SCHOOLS) -->
    <section class="py-5" style="background-color: #f1f5f9;" id="tracks">
        <div class="container py-3">
            <div class="text-center mb-5 mx-auto" style="max-width: 780px;">
                <span class="badge bg-navy-subtle text-navy fw-bold px-3 py-2 rounded-pill mb-2 text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">Kurikulum Standar Industri</span>
                <h2 class="fw-bold font-heading text-navy">Jalur Belajar & Tahapan Modul Terstruktur</h2>
                <p class="text-muted">Pilih jalur keahlian yang ingin Anda tekuni. Setiap modul dirancang bertahap lengkap dengan teori konsep, contoh kode interaktif, kuis pemahaman, dan sertifikat kelulusan.</p>
            </div>

            <!-- Tab Pemilihan Jalur Belajar (Track Tabs) -->
            <div class="d-flex flex-wrap justify-content-center gap-2 mb-4" id="trackTabButtons">
                <button class="btn btn-navy fw-bold px-4 py-2 rounded-pill shadow-sm track-nav-btn active" id="btn-tab-web_frontend" onclick="switchTrack('web_frontend')">
                    <i class="fa-brands fa-html5 text-gold me-2"></i> Frontend Web
                </button>
                <button class="btn btn-outline-navy fw-bold px-4 py-2 rounded-pill track-nav-btn" id="btn-tab-backend_api" onclick="switchTrack('backend_api')">
                    <i class="fa-solid fa-server me-2"></i> Backend & REST API
                </button>
                <button class="btn btn-outline-navy fw-bold px-4 py-2 rounded-pill track-nav-btn" id="btn-tab-mobile_flutter" onclick="switchTrack('mobile_flutter')">
                    <i class="fa-solid fa-mobile-screen-button me-2"></i> Mobile Flutter
                </button>
                <button class="btn btn-outline-navy fw-bold px-4 py-2 rounded-pill track-nav-btn" id="btn-tab-uiux_design" onclick="switchTrack('uiux_design')">
                    <i class="fa-solid fa-bezier-curve me-2"></i> UI/UX & Multimedia
                </button>
            </div>

            <!-- Header Info & Progres Jalur yang Sedang Aktif -->
            <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-white border-start border-4 border-gold" id="trackHeaderCard">
                <div class="row align-items-center g-3">
                    <div class="col-lg-8">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-2">
                            <span class="badge bg-gold text-navy fw-bold" id="activeTrackBadge">Pemula ke Mahir</span>
                            <span class="text-muted small" id="activeTrackSkills"><i class="fa-solid fa-layer-group me-1 text-gold"></i> HTML5, CSS3, JavaScript ES6+, Flexbox, Grid, DOM, Fetch API</span>
                        </div>
                        <h3 class="fw-bold text-navy font-heading mb-2" id="activeTrackTitle">Frontend Web Development</h3>
                        <p class="text-muted small mb-0" id="activeTrackDesc" style="line-height: 1.6;">
                            Kuasai pembuatan antarmuka website modern, responsif di HP & Laptop, dan interaktif menggunakan standar industri.
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <div class="bg-light p-3 rounded-3 border text-start">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <small class="fw-bold text-navy" style="font-size: 0.78rem;">Progres Belajar Anda:</small>
                                <span class="fw-bold text-gold small" id="trackProgressText">0% Selesai</span>
                            </div>
                            <div class="progress mb-2" style="height: 10px; border-radius: 6px;">
                                <div class="progress-bar bg-gold progress-bar-striped progress-bar-animated" id="trackProgressBar" role="progressbar" style="width: 0%"></div>
                            </div>
                            <small class="text-muted d-block" style="font-size: 0.72rem;" id="trackProgressHint">
                                <?php if ($isLoggedIn): ?>
                                    <i class="fa-solid fa-cloud-arrow-up text-success me-1"></i> Tersinkron otomatis dengan akun Skillance Anda.
                                <?php else: ?>
                                    <i class="fa-solid fa-circle-info text-primary me-1"></i> <a href="https://skillance.my.id/auth/index.php?ref=academy" class="text-navy fw-bold text-decoration-none">Masuk Akun</a> untuk simpan permanen.
                                <?php endif; ?>
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Area Tahapan & Kartu Modul Dinamis -->
            <div id="stagesContainer" class="d-flex flex-column gap-4">
                <!-- Rendered dynamically by JavaScript -->
            </div>
        </div>
    </section>

    <!-- MODAL PEMBELAJARAN INTERAKTIF & TEORI LENGKAP (ALA DICODING & W3SCHOOLS) -->
    <div class="modal fade" id="lessonModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 rounded-4 shadow-lg overflow-hidden">
                <div class="modal-header text-white" style="background: linear-gradient(135deg, #0d2e5c 0%, #061a35 100%);">
                    <div>
                        <span class="badge bg-gold text-navy fw-bold mb-1" id="modalLevelBadge" style="font-size: 0.68rem;">Dasar</span>
                        <h5 class="modal-title fw-bold text-white mb-0" id="modalLessonTitle">Judul Modul Pembelajaran</h5>
                        <small class="text-white-50" id="modalLessonDuration" style="font-size: 0.75rem;"><i class="fa-regular fa-clock me-1"></i> 25 Menit Estimasi</small>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 bg-white" style="line-height: 1.7;">
                    
                    <!-- 1. Penjelasan Konsep & Teori -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-navy d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-book-open-reader text-gold"></i> Penjelasan Konsep & Teori
                        </h6>
                        <div class="text-secondary small mb-3 p-3 rounded-3" id="modalLessonTheory" style="font-size: 0.92rem; line-height: 1.8; background:#f8fafc; border: 1px solid #e2e8f0;"></div>
                        
                        <div class="card bg-light border-0 rounded-3 p-3 mb-3">
                            <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-check-double text-success me-1"></i> Poin Kunci yang Harus Diingat:</h6>
                            <ul class="text-secondary small mb-0 ps-3" id="modalKeyPoints" style="line-height: 1.7;"></ul>
                        </div>
                    </div>

                    <!-- 2. Contoh Kode & Coba Sendiri (W3Schools Style) -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <h6 class="fw-bold text-navy mb-0">
                                <i class="fa-solid fa-code text-primary me-1"></i> Contoh Kode Praktik
                            </h6>
                            <button class="btn btn-sm btn-gold rounded-pill px-3 fw-bold" id="btnTryInLab" onclick="runInPlayground()">
                                <i class="fa-solid fa-bolt me-1"></i> Coba Sendiri di Code Lab &rarr;
                            </button>
                        </div>
                        <div class="position-relative">
                            <pre class="p-3 rounded-3 text-white m-0" style="background:#0b192c; font-family:'Fira Code',monospace; font-size:0.84rem; max-height:260px; overflow:auto;"><code id="modalSampleCode"></code></pre>
                        </div>
                        <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">
                            <i class="fa-solid fa-info-circle text-gold me-1"></i> Klik <strong>"Coba Sendiri di Code Lab"</strong> untuk memuat dan mengeksekusi kode ini langsung di editor browser!
                        </small>
                    </div>

                    <!-- 3. Kuis Interaktif / Latihan Pemahaman -->
                    <div class="card border border-warning-subtle rounded-3 p-3 mb-2" style="background: #fffdf5;">
                        <h6 class="fw-bold text-navy small d-flex align-items-center gap-2 mb-2">
                            <i class="fa-solid fa-circle-question text-gold"></i> Kuis Cepat Pemahaman (Knowledge Check)
                        </h6>
                        <p class="small text-dark fw-semibold mb-2" id="quizQuestion">Pertanyaan kuis...</p>
                        <div class="d-flex flex-column gap-2 mb-2" id="quizOptions"></div>
                        <div id="quizFeedback" class="small mt-2 p-2 rounded-2" style="display:none;"></div>
                    </div>

                </div>
                <div class="modal-footer bg-light border-top d-flex justify-content-between">
                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-bs-dismiss="modal">Tutup</button>
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" class="btn btn-sm btn-success rounded-pill px-4 fw-bold shadow-sm" id="btnToggleComplete">
                            <i class="fa-solid fa-check me-1"></i> Tandai Selesai
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION: FITUR UNGGULAN PLATFORM ALA W3SCHOOLS & DICODING -->
    <section class="py-5 bg-white" id="fitur">
        <div class="container py-4">
            <div class="row align-items-center g-5">
                <div class="col-lg-5">
                    <span class="badge bg-gold text-navy fw-bold px-3 py-1 rounded-pill mb-2">METODOLOGI KAMI</span>
                    <h2 class="fw-bold text-navy font-heading mb-3">Ekosistem Belajar Koding Berkelanjutan</h2>
                    <p class="text-muted" style="line-height: 1.8;">
                        Kami menggabungkan kemudahan dokumentasi to-the-point ala <strong>W3Schools</strong> dengan standar submission tugas riil ala <strong>Dicoding</strong>, lalu menghubungkannya langsung ke <strong>Bursa Freelance Skillance</strong>.
                    </p>
                    <div class="d-flex flex-column gap-3 mt-4">
                        <div class="d-flex align-items-start gap-3">
                            <div class="bg-gold-subtle p-2 rounded-circle text-gold">
                                <i class="fa-solid fa-code"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-navy mb-1">Code Along & Interactive Test</h6>
                                <p class="text-muted small mb-0">Praktikkan setiap baris kode dengan validasi instan di browser.</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start gap-3">
                            <div class="bg-navy-subtle p-2 rounded-circle text-navy">
                                <i class="fa-solid fa-award"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-navy mb-1">Project Review oleh Mentor</h6>
                                <p class="text-muted small mb-0">Tugas akhir Anda diperiksa dan diberi masukan langsung oleh software engineer profesional.</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start gap-3">
                            <div class="bg-success-subtle p-2 rounded-circle text-success">
                                <i class="fa-solid fa-sack-dollar"></i>
                            </div>
                            <div>
                                <h6 class="fw-bold text-navy mb-1">Penyaluran Proyek Berbayar</h6>
                                <p class="text-muted small mb-0">Lulusan terbaik langsung dipromosikan untuk mengambil tugas di Bursa Freelance Skillance.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="p-4 rounded-4 shadow-sm border bg-light h-100">
                                <i class="fa-solid fa-graduation-cap fs-2 text-gold mb-3"></i>
                                <h5 class="fw-bold text-navy mb-2">Sertifikat Kelulusan</h5>
                                <p class="text-muted small mb-0">Dapatkan sertifikat digital kompetensi yang dapat diverifikasi online untuk melengkapi CV dan portofolio kerja Anda.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4 rounded-4 shadow-sm border bg-light h-100">
                                <i class="fa-solid fa-users-line fs-2 text-primary mb-3"></i>
                                <h5 class="fw-bold text-navy mb-2">Komunitas Diskusi Aktif</h5>
                                <p class="text-muted small mb-0">Bergabung dengan grup diskusi sesama pembelajar dan praktisi IT untuk bertanya seputar error, bug, dan arsitektur kode.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4 rounded-4 shadow-sm border bg-light h-100">
                                <i class="fa-solid fa-laptop-code fs-2 text-success mb-3"></i>
                                <h5 class="fw-bold text-navy mb-2">100% Studi Kasus Nyata</h5>
                                <p class="text-muted small mb-0">Bukan sekadar tutorial "Hello World", Anda akan membangun aplikasi kasir, sistem presensi, SIMS sekolah, hingga portal berita.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="p-4 rounded-4 shadow-sm border bg-light h-100">
                                <i class="fa-solid fa-shield-halved fs-2 text-danger mb-3"></i>
                                <h5 class="fw-bold text-navy mb-2">Standar Clean Code</h5>
                                <p class="text-muted small mb-0">Mempelajari kebiasaan penulisan kode yang rapi, berstruktur, aman dari SQL Injection & XSS, serta mudah dikembangkan tim.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION: KEMITRAAN KAMPUS (MSC USN KOLAKA) & SPONSOR -->
    <section class="py-5" style="background-color: #f8fafc;" id="kemitraan">
        <div class="container py-4">
            <div class="text-center mb-5 mx-auto" style="max-width: 760px;">
                <span class="badge bg-gold-subtle text-navy fw-bold px-3 py-2 rounded-pill mb-2 text-uppercase" style="font-size: 0.72rem; letter-spacing: 0.5px;">
                    <i class="fa-solid fa-handshake-angle text-gold me-1"></i> Kolaborasi Komunitas
                </span>
                <h2 class="fw-bold font-heading text-navy mb-3">Sinergi Bersama Komunitas Kampus & Sponsor Industri</h2>
                <p class="text-muted">
                    Skillance Academy Indonesia membuka kolaborasi dengan UKM kampus seperti <strong>Multimedia Study Club (MSC) USN Kolaka</strong> dan sponsor industri untuk mencetak programmer dan desainer multimedia handal.
                </p>
            </div>

            <div class="row g-4 mb-5">
                <!-- Card 1: Kolaborasi Kampus & Multimedia Study Club (MSC) USN Kolaka -->
                <div class="col-lg-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4 p-lg-5 bg-white border-start border-4 border-gold">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-primary text-white px-3 py-2 rounded-pill" style="font-size: 0.72rem;">
                                <i class="fa-solid fa-graduation-cap me-1"></i> Mitra Kampus: USN Kolaka
                            </span>
                            <div class="bg-gold-subtle p-2 rounded-circle text-gold">
                                <i class="fa-solid fa-photo-film fs-5"></i>
                            </div>
                        </div>

                        <h4 class="fw-bold text-navy mb-2">Multimedia Study Club (MSC) - USN Kolaka</h4>
                        <p class="text-muted small mb-3" style="line-height: 1.7;">
                            Kolaborasi edukatif dan pembinaan talenta antara <strong>Skillance Academy Indonesia</strong> dengan UKM / Study Club mahasiswa di <strong>Universitas Sembilanbelas November (USN) Kolaka</strong>, mencakup keahlian <strong>Pemrograman (Coding Web/Mobile)</strong> dan <strong>Kreativitas Multimedia</strong>.
                        </p>

                        <div class="bg-light p-3 rounded-3 mb-3 border">
                            <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-layer-group text-gold me-1"></i> Ruang Lingkup Kolaborasi:</h6>
                            <ul class="list-unstyled text-muted small d-flex flex-column gap-2 mb-0">
                                <li><i class="fa-solid fa-laptop-code text-primary me-2"></i> <strong>Bootcamp Pemrograman:</strong> Pendampingan intensif coding Web & Mobile Apps, database MySQL, dan framework modern.</li>
                                <li><i class="fa-solid fa-palette text-primary me-2"></i> <strong>Desain Multimedia & UI/UX:</strong> Standardisasi aset visual grafis, motion design, dan prototipe aplikasi.</li>
                                <li><i class="fa-solid fa-briefcase text-success me-2"></i> <strong>Prioritas Masuk Bursa Freelance:</strong> Anggota berprestasi diprioritaskan mengambil proyek nyata di Skillance.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Program Sponsorship & CSR Korporasi -->
                <div class="col-lg-6">
                    <div class="card h-100 border-0 shadow-sm rounded-4 p-4 p-lg-5 bg-white border-start border-4 border-navy">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-success text-white px-3 py-2 rounded-pill" style="font-size: 0.72rem;">
                                <i class="fa-solid fa-bullhorn me-1"></i> Peluang Sponsorship & CSR
                            </span>
                            <div class="bg-navy-subtle p-2 rounded-circle text-navy">
                                <i class="fa-solid fa-handshake-simple fs-5"></i>
                            </div>
                        </div>

                        <h4 class="fw-bold text-navy mb-2">Dukungan Sponsor Industri & Program CSR</h4>
                        <p class="text-muted small mb-3" style="line-height: 1.7;">
                            Kami mengundang instansi pemerintah, BUMN, lembaga perbankan, dan perusahaan teknologi untuk menjadi <strong>Sponsor Resmi</strong> dalam program beasiswa pelatihan koding bagi pemuda dan mahasiswa daerah.
                        </p>

                        <div class="bg-light p-3 rounded-3 mb-3 border">
                            <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-award text-gold me-1"></i> Keuntungan Sponsor:</h6>
                            <ul class="list-unstyled text-muted small d-flex flex-column gap-2 mb-0">
                                <li><i class="fa-solid fa-medal text-gold me-2"></i> <strong>Beasiswa Koding:</strong> Mendanai kuota belajar intensif bagi talenta muda potensial berprestasi.</li>
                                <li><i class="fa-solid fa-bullhorn text-gold me-2"></i> <strong>Branding Prestisius:</strong> Penempatan logo sponsor di modul, sertifikat, dan media resmi Skillance.</li>
                                <li><i class="fa-solid fa-user-check text-gold me-2"></i> <strong>Akses Talent Pool:</strong> Akses langsung merekrut talenta programmer & desainer lulusan terbaik.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Call to Action Banner Kemitraan & Akses Subdomain -->
            <div class="card border-0 rounded-4 shadow-sm text-white p-4 p-md-5 position-relative overflow-hidden" style="background: linear-gradient(135deg, #0d2e5c 0%, #061a35 100%);">
                <div class="row align-items-center g-4 position-relative z-2">
                    <div class="col-lg-8">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            <span class="badge bg-gold text-navy fw-bold px-3 py-1 rounded-pill" style="font-size: 0.72rem;">PORTAL RESMI ACADEMY</span>
                        </div>
                        <h3 class="fw-bold font-heading text-white mb-2">Kunjungi Portal Mandiri di academy.skillance.cloud</h3>
                        <p class="text-white-50 small mb-0" style="line-height: 1.7; max-width: 650px;">
                            Akses materi coding interaktif, modul lengkap, dan latihan praktis langsung di subdomain resmi Skillance Academy. Anda juga dapat kembali ke website utama kapan saja melalui tombol navigasi.
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <div class="d-flex flex-column flex-sm-row flex-lg-column gap-2 justify-content-lg-end">
                            <a href="https://skillance.my.id" class="btn btn-outline-light fw-bold px-4 py-2 rounded-pill">
                                <i class="fa-solid fa-arrow-left me-1"></i> Ke Skillance.my.id
                            </a>
                            <a href="https://skillance.my.id/freelance.html" class="btn btn-gold fw-bold px-4 py-2 rounded-pill shadow-sm">
                                <i class="fa-solid fa-briefcase me-1"></i> Bursa Freelance
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-navy text-white pt-5 pb-4 border-top border-dark">
        <div class="container">
            <div class="row g-4 justify-content-between mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-code text-gold fs-3"></i>
                        <span class="fw-bold fs-4 font-heading text-white">SKILLANCE</span>
                    </div>
                    <p class="text-white-50 small mb-4">
                        Skillance Digital Indonesia adalah perusahaan penyedia solusi IT, Software House, dan Konsultan Sistem Informasi terpercaya di Sulawesi Tenggara.
                    </p>
                    <div class="d-flex gap-2">
                        <a href="https://skillance.my.id" class="btn btn-sm btn-outline-light rounded-circle" style="width:36px;height:36px;padding:6px;" title="Website Utama"><i class="fa-solid fa-globe"></i></a>
                        <a href="https://skillance.my.id/freelance.html" class="btn btn-sm btn-outline-light rounded-circle" style="width:36px;height:36px;padding:6px;" title="Bursa Freelance"><i class="fa-solid fa-briefcase"></i></a>
                        <a href="https://api.whatsapp.com/send?phone=6282291700778" target="_blank" class="btn btn-sm btn-outline-light rounded-circle" style="width:36px;height:36px;padding:6px;" title="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="fw-bold text-gold text-uppercase mb-3">Navigasi Utama</h6>
                    <ul class="list-unstyled small text-white-50 d-flex flex-column gap-2 mb-0">
                        <li><a href="https://skillance.my.id" class="text-white-50 text-decoration-none hover-gold">Beranda Skillance</a></li>
                        <li><a href="https://skillance.my.id/about.html" class="text-white-50 text-decoration-none hover-gold">Tentang Kami</a></li>
                        <li><a href="https://skillance.my.id/services.html" class="text-white-50 text-decoration-none hover-gold">Layanan</a></li>
                        <li><a href="https://skillance.my.id/portfolio.html" class="text-white-50 text-decoration-none hover-gold">Karya Kami</a></li>
                        <li><a href="https://skillance.my.id/freelance.html" class="text-white-50 text-decoration-none hover-gold">Bursa Freelance</a></li>
                        <li><a href="https://skillance.my.id/blog.html" class="text-white-50 text-decoration-none hover-gold">Blog</a></li>
                        <li><a href="https://skillance.my.id/contact.html" class="text-white-50 text-decoration-none hover-gold">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6 col-6">
                    <h6 class="fw-bold text-gold text-uppercase mb-3">Jalur Belajar Koding</h6>
                    <ul class="list-unstyled small text-white-50 d-flex flex-column gap-2 mb-0">
                        <li>Frontend Web (HTML/CSS/JS)</li>
                        <li>Backend API & Database MySQL</li>
                        <li>Framework Laravel 11</li>
                        <li>Flutter Android & iOS</li>
                        <li>UI/UX Design Prototyping Figma</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h6 class="fw-bold text-gold text-uppercase mb-3">Kontak Kantor</h6>
                    <p class="text-white-50 small mb-2"><i class="fa-solid fa-location-dot text-gold me-2"></i> Desa Pabiring Dusun Taruseng, Kec. Poleang Barat, Kab. Bombana, Sultra</p>
                    <p class="text-white-50 small mb-2"><i class="fa-solid fa-phone text-gold me-2"></i> +62 822-9170-0778</p>
                    <p class="text-white-50 small mb-0"><i class="fa-solid fa-envelope text-gold me-2"></i> official@skillance.my.id</p>
                </div>
            </div>
            <div class="border-top border-secondary pt-3 text-center small text-white-50">
                &copy; 2026 Skillance Digital Indonesia & Skillance Academy. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Interactive Code Playground Engine (Ala W3Schools / Dicoding)
        const templates = {
            html: `<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 25px; background: #f0fdf4; color: #166534; }
        .box { background: white; padding: 20px; border-radius: 12px; border: 2px solid #86efac; max-width: 350px; margin: auto; }
        h3 { margin-bottom: 5px; }
    </style>
</head>
<body>
    <div class="box">
        <h3>🌱 Belajar HTML & CSS</h3>
        <p>Ubah teks di editor koding sebelah kiri, lalu klik <strong>Jalankan Kode</strong>!</p>
        <button style="background:#16a34a; color:white; border:none; padding:8px 16px; border-radius:6px; cursor:pointer;" onclick="alert('Tombol berfungsi normal!')">Klik Saya</button>
    </div>
</body>
</html>`,
            css: `<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: flex; justify-content: center; align-items: center; min-height: 200px; margin: 0; background: #f8fafc; }
        .btn-modern {
            background: linear-gradient(135deg, #0d2e5c 0%, #1e3a8a 100%);
            color: #ffffff;
            border: 2px solid #fca311;
            padding: 12px 28px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 50px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(13, 46, 92, 0.2);
            transition: all 0.3s ease;
        }
        .btn-modern:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 6px 20px rgba(252, 163, 17, 0.4);
            background: #fca311;
            color: #0d2e5c;
        }
    </style>
</head>
<body>
    <button class="btn-modern" onclick="this.innerText = '⚡ Tombol Aktif!'">Efek Tombol Skillance</button>
</body>
</html>`,
            js: `<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; text-align: center; padding: 20px; background: #fffbeb; color: #78350f; }
        .counter-box { background: white; padding: 20px; border-radius: 12px; max-width: 300px; margin: auto; border: 1px solid #fde68a; }
        .number { font-size: 42px; font-weight: bold; color: #0d2e5c; margin: 10px 0; }
        .btn { padding: 8px 16px; font-weight: bold; border-radius: 8px; border: none; cursor: pointer; margin: 0 4px; }
        .btn-add { background: #0d2e5c; color: white; }
        .btn-reset { background: #e2e8f0; color: #333; }
    </style>
</head>
<body>
    <div class="counter-box">
        <h4 style="margin:0;">Interactive Counter</h4>
        <div class="number" id="num">0</div>
        <button class="btn btn-add" onclick="tambah()">+ Tambah</button>
        <button class="btn btn-reset" onclick="reset()">Reset</button>
    </div>
    <script>
        let count = 0;
        function tambah() {
            count++;
            document.getElementById('num').innerText = count;
        }
        function reset() {
            count = 0;
            document.getElementById('num').innerText = count;
        }
    <\/script>
</body>
</html>`
        };

        function runCode() {
            const code = document.getElementById('codeEditor').value;
            const iframe = document.getElementById('codePreview');
            const doc = iframe.contentDocument || iframe.contentWindow.document;
            doc.open();
            doc.write(code);
            doc.close();
        }

        function loadTemplate(type) {
            if (templates[type]) {
                document.getElementById('codeEditor').value = templates[type];
                document.getElementById('editorFilename').innerText = `example_${type}.html`;
                runCode();
            }
        }

        function filterTracks() {
            const query = document.getElementById('searchInput').value.toLowerCase().trim();
            const items = document.querySelectorAll('.track-item');
            items.forEach(el => {
                const keywords = (el.getAttribute('data-keywords') || '') + ' ' + el.innerText.toLowerCase();
                if (query === '' || keywords.includes(query)) {
                    el.style.display = 'block';
                } else {
                    el.style.display = 'none';
                }
            });
        }

        // Run default template on load
        
        // Data Kurikulum Terstruktur Lengkap Skillance Academy
        const COURSES_DATA = {
  "web_frontend": {
    "title": "Frontend Web Development",
    "badge": "Pemula ke Mahir",
    "icon": "fa-brands fa-html5",
    "color": "gold",
    "desc": "Kuasai pembuatan antarmuka website modern, responsif di HP & Laptop, dan interaktif menggunakan standar industri.",
    "skills": "HTML5, CSS3, JavaScript ES6+, Flexbox, Grid, DOM, Fetch API",
    "stages": [
      {
        "stage_num": 1,
        "stage_name": "Fundamental HTML5 & Struktur Web Semantik",
        "modules": [
          {
            "id": "html_basic",
            "title": "Pengenalan Web & Anatomi Dokumen HTML5 Semantik",
            "duration": "25 Menit",
            "level": "Dasar",
            "desc": "Memahami cara kerja browser, struktur DOM dasar, dan pentingnya elemen semantik untuk SEO dan aksesibilitas.",
            "theory": "HTML (HyperText Markup Language) adalah fondasi dari setiap halaman web di internet. Dalam HTML5 modern, penulisan markup tidak sekadar menampilkan teks dan gambar, melainkan menggunakan tag semantik seperti <header>, <nav>, <main>, <article>, <section>, dan <footer>. Tag semantik membantu mesin pencari (SEO) memahami hierarki konten dan memungkinkan pembaca layar (screen reader) membantu pengguna disabilitas menavigasi website dengan tepat.",
            "key_points": [
              "Gunakan <!DOCTYPE html> untuk mendeklarasikan standar HTML5 terkini.",
              "Tag <meta name='viewport'> wajib disertakan agar website responsif di layar ponsel pintar.",
              "Gunakan elemen semantik (<header>, <nav>, <main>, <footer>) daripada hanya menggunakan <div> berulang kali.",
              "Setiap gambar wajib menyertakan atribut 'alt' deskriptif untuk aksesibilitas dan SEO."
            ],
            "sample_code": "<!DOCTYPE html>\n<html lang=\"id\">\n<head>\n    <meta charset=\"UTF-8\">\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\n    <style>\n        body { font-family: system-ui, sans-serif; margin: 0; background: #f8fafc; color: #1e293b; }\n        header { background: #0d2e5c; color: white; padding: 20px; text-align: center; }\n        main { max-width: 600px; margin: 20px auto; background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }\n        h1 { margin: 0 0 10px; font-size: 1.5rem; color: #fca311; }\n        p { line-height: 1.6; }\n        .badge { background: #e0f2fe; color: #0369a1; padding: 4px 10px; border-radius: 20px; font-weight: bold; font-size: 0.8rem; }\n    </style>\n</head>\n<body>\n    <header>\n        <h2>Skillance Academy Indonesia</h2>\n    </header>\n    <main>\n        <span class=\"badge\">Tahap 1: HTML5</span>\n        <h1>Struktur Web Semantik</h1>\n        <p>Halaman ini dibangun dengan tag semantik modern: <code>&lt;header&gt;</code> dan <code>&lt;main&gt;</code> tanpa wrapper div yang berlebihan.</p>\n        <button style=\"background:#0d2e5c; color:white; border:none; padding:10px 18px; border-radius:6px; cursor:pointer;\" onclick=\"alert('Halo Talenta Digital!')\">Uji Interaksi</button>\n    </main>\n</body>\n</html>",
            "quiz": {
              "q": "Tag HTML5 manakah yang paling tepat digunakan untuk membungkus konten inti/utama dalam sebuah halaman web?",
              "options": [
                "<div id='content'>",
                "<main>",
                "<section>",
                "<body>"
              ],
              "answer": 1,
              "explanation": "Tag <main> adalah elemen semantik standar HTML5 yang secara eksplisit menandai konten utama yang unik dalam sebuah dokumen."
            }
          },
          {
            "id": "html_forms",
            "title": "Formulir Input Data, Validasi, dan Komponen Interaktif",
            "duration": "30 Menit",
            "level": "Dasar",
            "desc": "Membangun form pendaftaran yang ramah pengguna dengan validasi bawaan HTML5 dan tipe input modern.",
            "theory": "Formulir adalah jembatan utama interaksi dua arah antara pengguna dan sistem web. HTML5 menyediakan tipe input canggih seperti email, tel, date, number, serta atribut validasi seperti required, minlength, pattern, dan autocomplete. Memanfaatkan validasi klien bawaan membuat aplikasi terasa responsif dan mengurangi beban server dari kesalahan input sederhana.",
            "key_points": [
              "Selalu pasangkan tag <label for='id'> dengan elemen <input id='id'> untuk aksesibilitas fokus klik.",
              "Manfaatkan atribut 'required', 'minlength', dan regex 'pattern' untuk validasi instan di browser.",
              "Gunakan atribut 'autocomplete' (misal: 'email', 'tel', 'current-password') untuk memudahkan pengisian data otomatis oleh browser pengguna."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: sans-serif; padding: 20px; background: #f0fdf4; display: flex; justify-content: center; }\n        .form-card { background: white; padding: 25px; border-radius: 12px; width: 100%; max-width: 360px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); }\n        .form-group { margin-bottom: 15px; }\n        label { display: block; margin-bottom: 6px; font-weight: 600; font-size: 0.85rem; color: #166534; }\n        input { width: 100%; padding: 10px; border: 1px solid #bbf7d0; border-radius: 6px; box-sizing: border-box; }\n        input:focus { outline: none; border-color: #16a34a; box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.2); }\n        button { width: 100%; background: #16a34a; color: white; border: none; padding: 10px; border-radius: 6px; font-weight: bold; cursor: pointer; }\n    </style>\n</head>\n<body>\n    <div class=\"form-card\">\n        <h3 style=\"margin-top:0; color:#15803d;\">Daftar Kelas Mahasiswa</h3>\n        <form onsubmit=\"event.preventDefault(); alert('Pendaftaran ' + document.getElementById('name').value + ' Diterima!');\">\n            <div class=\"form-group\">\n                <label for=\"name\">Nama Lengkap</label>\n                <input type=\"text\" id=\"name\" required placeholder=\"Contoh: Budi Santoso\">\n            </div>\n            <div class=\"form-group\">\n                <label for=\"email\">Alamat Email</label>\n                <input type=\"email\" id=\"email\" required placeholder=\"budi@kampus.ac.id\">\n            </div>\n            <button type=\"submit\">Kirim Pendaftaran</button>\n        </form>\n    </div>\n</body>\n</html>",
            "quiz": {
              "q": "Atribut HTML5 apa yang digunakan untuk memastikan sebuah field wajib diisi sebelum form dapat disubmit?",
              "options": [
                "validate='true'",
                "needed",
                "required",
                "mandatory"
              ],
              "answer": 2,
              "explanation": "Atribut 'required' secara otomatis mencegah form dikirimkan jika bidang input tersebut masih kosong."
            }
          }
        ]
      },
      {
        "stage_num": 2,
        "stage_name": "Styling CSS3 Modern & Tata Letak Responsif",
        "modules": [
          {
            "id": "css_boxmodel",
            "title": "CSS Box Model, Warna, & Tipografi Modern",
            "duration": "30 Menit",
            "level": "Dasar & Menengah",
            "desc": "Kuasai cara browser menghitung dimensi elemen (Margin, Border, Padding, Content) dan box-sizing: border-box.",
            "theory": "Semua elemen HTML dihitung oleh browser sebagai sebuah kotak (box). Box Model terdiri atas: Content (isi teks/gambar), Padding (ruang antara konten dan border), Border (garis tepi), dan Margin (ruang kosong di luar border yang memisahkan elemen dengan elemen lain). Aturan 'box-sizing: border-box' adalah standar industri wajib agar padding dan border tidak menambah lebar total elemen.",
            "key_points": [
              "Gunakan '* { box-sizing: border-box; }' di awal stylesheet untuk tata letak yang konsisten.",
              "Gunakan satuan relatif 'rem' untuk font dan margin/padding agar desain otomatis proporsional saat ukuran font dasar berubah.",
              "Terapkan palet warna dengan rasio kontras minimal 4.5:1 sesuai panduan WCAG."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        * { box-sizing: border-box; }\n        body { font-family: system-ui, sans-serif; display: flex; justify-content: center; align-items: center; min-height: 220px; background: #faf5ff; }\n        .box-demo {\n            background: #ffffff;\n            border: 3px solid #9333ea;\n            padding: 24px;\n            margin: 15px;\n            border-radius: 16px;\n            max-width: 320px;\n            box-shadow: 0 10px 25px rgba(147, 51, 234, 0.15);\n            text-align: center;\n        }\n        .box-demo h4 { color: #6b21a8; margin: 0 0 8px; }\n        .box-demo p { color: #4b5563; font-size: 0.9rem; line-height: 1.5; margin: 0; }\n    </style>\n</head>\n<body>\n    <div class=\"box-demo\">\n        <h4>📦 Box Model Sempurna</h4>\n        <p>Kotak ini menggunakan <code>padding: 24px</code> dan <code>border-box</code> sehingga lebarnya tetap presisi tanpa terpotong.</p>\n    </div>\n</body>\n</html>",
            "quiz": {
              "q": "Properti CSS apa yang membuat padding dan border dihitung di dalam lebar total (width) suatu elemen?",
              "options": [
                "box-sizing: content-box;",
                "box-sizing: border-box;",
                "display: inline-block;",
                "margin: auto;"
              ],
              "answer": 1,
              "explanation": "Dengan 'box-sizing: border-box', lebar yang Anda tentukan mencakup content, padding, dan border, sehingga layout tidak pecah saat padding diperbesar."
            }
          },
          {
            "id": "css_flexgrid",
            "title": "Tata Letak Responsif: CSS Flexbox & CSS Grid",
            "duration": "35 Menit",
            "level": "Menengah",
            "desc": "Membangun tata letak kartu produk, navbar, dan grid dashboard yang otomatis menyesuaikan ukuran layar tanpa float.",
            "theory": "CSS Flexbox dirancang untuk tata letak satu dimensi (baris atau kolom), sangat ideal untuk komponen seperti navigasi, tombol grup, dan perataan tengah vertikal. Sedangkan CSS Grid dirancang untuk tata letak dua dimensi (baris dan kolom sekaligus), cocok untuk tata kelola halaman utama, dashboard, dan galeri kartu responsif.",
            "key_points": [
              "Flexbox: 'display: flex', 'justify-content' untuk sumbu utama, 'align-items' untuk sumbu silang.",
              "Grid: 'display: grid', 'grid-template-columns: repeat(auto-fit, minmax(200px, 1fr))' untuk grid responsif tanpa media query.",
              "'gap' dapat digunakan di Flexbox maupun Grid untuk memberi jarak rapi antar elemen anak."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: sans-serif; padding: 15px; background: #f8fafc; }\n        .grid-container {\n            display: grid;\n            grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));\n            gap: 12px;\n        }\n        .card-item {\n            background: white;\n            padding: 16px;\n            border-radius: 10px;\n            border: 1px solid #e2e8f0;\n            text-align: center;\n            box-shadow: 0 2px 4px rgba(0,0,0,0.04);\n            transition: transform 0.2s;\n        }\n        .card-item:hover { transform: translateY(-4px); border-color: #fca311; }\n        .icon { font-size: 24px; margin-bottom: 8px; }\n    </style>\n</head>\n<body>\n    <div class=\"grid-container\">\n        <div class=\"card-item\"><div class=\"icon\">💻</div><strong>Web Dev</strong></div>\n        <div class=\"card-item\"><div class=\"icon\">🚀</div><strong>Cloud VPS</strong></div>\n        <div class=\"card-item\"><div class=\"icon\">📱</div><strong>Flutter</strong></div>\n        <div class=\"card-item\"><div class=\"icon\">🎨</div><strong>UI/UX</strong></div>\n    </div>\n</body>\n</html>",
            "quiz": {
              "q": "Properti Flexbox manakah yang digunakan untuk memusatkan elemen anak tepat di tengah-tengah secara vertikal?",
              "options": [
                "justify-content: center;",
                "align-items: center;",
                "text-align: center;",
                "flex-direction: center;"
              ],
              "answer": 1,
              "explanation": "Pada tata letak flex baris default, 'align-items: center' memusatkan item pada sumbu silang (cross-axis / vertikal)."
            }
          }
        ]
      },
      {
        "stage_num": 3,
        "stage_name": "Interaktivitas JavaScript Modern & DOM Manipulation",
        "modules": [
          {
            "id": "js_dom",
            "title": "Manipulasi DOM & Penanganan Event Pengguna",
            "duration": "35 Menit",
            "level": "Menengah",
            "desc": "Menangkap event klik, input, submit, serta menambah/menghapus kelas CSS secara dinamis pada elemen web.",
            "theory": "Document Object Model (DOM) adalah representasi pohon dari dokumen HTML yang dapat diakses dan diubah menggunakan JavaScript. Melalui method seperti 'document.querySelector()' dan 'addEventListener()', pengembang dapat merespons aksi pengguna seketika tanpa perlu memuat ulang seluruh halaman web.",
            "key_points": [
              "Gunakan 'document.querySelector()' dan 'document.querySelectorAll()' untuk menyeleksi elemen secara fleksibel via CSS selector.",
              "Selalu gunakan 'addEventListener('click', fn)' daripada atribut inline 'onclick' pada tag HTML.",
              "Manfaatkan 'element.classList.toggle()' dan 'element.classList.add()' untuk mengubah tampilan visual dengan aman."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: sans-serif; text-align: center; padding: 25px; background: #fffbeb; }\n        .card { background: white; padding: 20px; border-radius: 12px; max-width: 320px; margin: auto; border: 1px solid #fde68a; }\n        .todo-item { display: flex; justify-content: space-between; padding: 8px 12px; background: #f8fafc; border-radius: 6px; margin-top: 8px; font-size: 0.9rem; }\n        .btn-add { background: #0d2e5c; color: white; border: none; padding: 8px 16px; border-radius: 6px; cursor: pointer; }\n    </style>\n</head>\n<body>\n    <div class=\"card\">\n        <h3 style=\"margin-top:0; color:#0d2e5c;\">Daftar Tugas Koding</h3>\n        <input type=\"text\" id=\"taskInput\" placeholder=\"Ketik tugas baru...\" style=\"padding:8px; border:1px solid #cbd5e1; border-radius:6px; width:70%;\">\n        <button class=\"btn-add\" id=\"btnAddTask\">+ Tambah</button>\n        <div id=\"taskList\" style=\"margin-top: 15px;\">\n            <div class=\"todo-item\"><span>Pelajari DOM JavaScript</span> <span>✅</span></div>\n        </div>\n    </div>\n\n    <script>\n        document.getElementById('btnAddTask').addEventListener('click', function() {\n            const input = document.getElementById('taskInput');\n            const val = input.value.trim();\n            if (val) {\n                const item = document.createElement('div');\n                item.className = 'todo-item';\n                item.innerHTML = `<span>${val}</span> <span style=\"cursor:pointer;\" onclick=\"this.parentElement.remove()\">❌</span>`;\n                document.getElementById('taskList').appendChild(item);\n                input.value = '';\n            }\n        });\n    <\\/script>\n</body>\n</html>",
            "quiz": {
              "q": "Method JavaScript apa yang paling direkomendasikan untuk menambahkan event listener interaksi pengguna pada suatu tombol?",
              "options": [
                "button.attachEvent('click')",
                "button.addEventListener('click', fn)",
                "button.onclick()",
                "document.listen('click')"
              ],
              "answer": 1,
              "explanation": "'addEventListener' adalah standar web W3C modern yang memungkinkan banyak listener didaftarkan tanpa saling menimpa."
            }
          },
          {
            "id": "js_fetch",
            "title": "Fetch API, Asynchronous JS & Konsumsi REST API",
            "duration": "40 Menit",
            "level": "Mahir",
            "desc": "Mengambil data JSON dari server backend secara asynchronous menggunakan Promise, async/await, dan render data dinamis.",
            "theory": "Aplikasi web modern tidak memuat ulang seluruh halaman saat butuh data baru; mereka memanfaatkan Fetch API untuk mengirim dan menerima data JSON secara asynchronous di latar belakang. Dengan sintaks modern 'async/await' dan blok 'try/catch', penulisan kode asynchronous menjadi mudah dibaca seperti kode synchronous biasa.",
            "key_points": [
              "Fetch mengembalikan sebuah Promise yang resolve menjadi objek Response.",
              "Periksa 'response.ok' atau status HTTP sebelum melakukan parsing 'response.json()'.",
              "Gunakan blok 'try { ... } catch (error) { ... }' untuk menangani kegagalan koneksi jaringan dengan ramah pengguna."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: sans-serif; padding: 20px; background: #f8fafc; text-align: center; }\n        .box { background: white; padding: 20px; border-radius: 12px; max-width: 380px; margin: auto; box-shadow: 0 4px 12px rgba(0,0,0,0.06); }\n        .quote { font-style: italic; color: #334155; margin: 15px 0; min-height: 48px; }\n        button { background: #fca311; color: #0d2e5c; border: none; padding: 10px 18px; font-weight: bold; border-radius: 8px; cursor: pointer; }\n    </style>\n</head>\n<body>\n    <div class=\"box\">\n        <h4 style=\"margin:0; color:#0d2e5c;\">Simulasi Konsumsi API</h4>\n        <div class=\"quote\" id=\"quoteText\">\"Klik tombol untuk mengambil data dari server...\"</div>\n        <button onclick=\"fetchQuote()\">Ambil Data Baru ⚡</button>\n    </div>\n\n    <script>\n        const quotes = [\n            \"Kode yang baik adalah dokumentasi terbaiknya sendiri.\",\n            \"Kuasai fundamental, maka framework apa pun akan mudah dipelajari.\",\n            \"Latihan konsisten 30 menit sehari lebih baik daripada belajar 10 jam sekali seminggu.\"\n        ];\n        async function fetchQuote() {\n            const el = document.getElementById('quoteText');\n            el.innerText = 'Memuat data dari API...';\n            // Simulasi jeda network\n            await new Promise(r => setTimeout(r, 400));\n            const random = quotes[Math.floor(Math.random() * quotes.length)];\n            el.innerText = `\"${random}\"`;\n        }\n    <\\/script>\n</body>\n</html>",
            "quiz": {
              "q": "Kata kunci apa yang digunakan bersamaan dengan 'async' function untuk menunggu penyelesaian sebuah Promise?",
              "options": [
                "wait",
                "await",
                "defer",
                "yield"
              ],
              "answer": 1,
              "explanation": "Kata kunci 'await' menunda eksekusi di dalam async function hingga Promise selesai (resolved) atau ditolak (rejected)."
            }
          }
        ]
      },
      {
        "stage_num": 4,
        "stage_name": "Proyek Akhir & Masuk Bursa Freelance",
        "modules": [
          {
            "id": "fe_project",
            "title": "Proyek Akhir: Pembuatan Landing Page Bisnis Responsif",
            "duration": "60 Menit",
            "level": "Proyek Portofolio",
            "desc": "Menggabungkan HTML semantik, CSS Flexbox/Grid, dan interaksi JavaScript menjadi portofolio siap kerja.",
            "theory": "Di tahap akhir ini, Anda akan memadukan seluruh keahlian yang telah dipelajari untuk membangun sebuah Landing Page bisnis profesional yang responsif di smartphone, tablet, maupun layar desktop. Kualitas kode, kerapian struktur, dan kecepatan muat halaman akan menjadi penilaian utama sebelum Anda dapat mengajukan diri menerima proyek di Bursa Freelance Skillance.",
            "key_points": [
              "Menerapkan desain Mobile-First Approach.",
              "Memastikan waktu muat (load time) cepat dengan aset gambar terkompresi.",
              "Mengunggah hasil karya ke GitHub Pages atau hosting live sebagai portofolio portabel."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: system-ui, sans-serif; margin: 0; background: #0d2e5c; color: white; display: flex; justify-content: center; align-items: center; min-height: 240px; text-align: center; }\n        .hero { padding: 30px; }\n        h1 { color: #fca311; margin-bottom: 10px; }\n        p { color: #cbd5e1; max-width: 400px; margin: auto auto 20px; font-size: 0.95rem; }\n        .btn-cta { background: #fca311; color: #0d2e5c; padding: 12px 24px; border-radius: 50px; font-weight: bold; text-decoration: none; border: none; cursor: pointer; }\n    </style>\n</head>\n<body>\n    <div class=\"hero\">\n        <h1>Skillance Talenta Digital</h1>\n        <p>Siap kerja lepas berpenghasilan atau magang di perusahaan teknologi terkemuka.</p>\n        <button class=\"btn-cta\" onclick=\"alert('Selamat! Anda telah menyelesaikan seluruh materi Frontend Web!')\">Lulus & Dapatkan Sertifikat</button>\n    </div>\n</body>\n</html>",
            "quiz": {
              "q": "Apakah prinsip utama dari pendekatan 'Mobile-First Design'?",
              "options": [
                "Membuat website hanya bisa dibuka di smartphone.",
                "Mendesain dan menyusun kode untuk layar kecil terlebih dahulu, baru menambahkan peningkatan untuk layar besar.",
                "Menghilangkan semua gambar agar website ringan di HP.",
                "Menggunakan teknologi aplikasi native seperti Flutter."
              ],
              "answer": 1,
              "explanation": "Mobile-First Design memprioritaskan konten inti pada layar sempit terlebih dahulu, kemudian memanfaatkan media query min-width untuk memperluas tata letak pada layar desktop."
            }
          }
        ]
      }
    ]
  },
  "backend_api": {
    "title": "Backend & RESTful API",
    "badge": "Fondasi ke Lanjut",
    "icon": "fa-solid fa-server",
    "color": "primary",
    "desc": "Kuasai logika server, manajemen database MySQL, arsitektur REST API berstandar OpenAPI, dan keamanan server.",
    "skills": "PHP 8+, MySQL Relational DB, PDO Prepared Statements, RESTful API, JSON, Laravel 11",
    "stages": [
      {
        "stage_num": 1,
        "stage_name": "Fundamental PHP 8+ Modern & Logika Server",
        "modules": [
          {
            "id": "php_basics",
            "title": "Sintaks PHP 8+, Tipe Data, & Array Asosiatif",
            "duration": "30 Menit",
            "level": "Dasar Backend",
            "desc": "Memahami variabel bertipe ketat (strict typing), perulangan, fungsi, dan manipulasi data array.",
            "theory": "PHP 8 menghadirkan peningkatan performa dramatis (JIT engine), 'match expression', 'named arguments', dan type-hinting yang kuat. Sebagai bahasa server-side terpopuler di dunia web, PHP bertugas memproses logika bisnis sebelum mengirimkan keluaran ke browser pengguna.",
            "key_points": [
              "Gunakan 'declare(strict_types=1);' di awal berkas untuk mencegah bug tipe data terselubung.",
              "Manfaatkan array asosiatif untuk menstrukturkan data record dari database.",
              "Gunakan fungsi 'htmlspecialchars()' saat menampilkan data kiriman pengguna ke antarmuka HTML untuk mencegah celah XSS."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: monospace; padding: 20px; background: #0f172a; color: #38bdf8; }\n        .card { background: #1e293b; padding: 20px; border-radius: 10px; border-left: 4px solid #38bdf8; }\n        .var { color: #f472b6; }\n        .str { color: #a3e635; }\n        .num { color: #facc15; }\n    </style>\n</head>\n<body>\n    <div class=\"card\">\n        <h3>// Simulasi Logika Server PHP 8</h3>\n        <p><span class=\"var\">$kursus</span> = [<br>\n        &nbsp;&nbsp;<span class=\"str\">'nama'</span> =&gt; <span class=\"str\">'Backend API Specialist'</span>,<br>\n        &nbsp;&nbsp;<span class=\"str\">'level'</span> =&gt; <span class=\"str\">'Mahir'</span>,<br>\n        &nbsp;&nbsp;<span class=\"str\">'modul'</span> =&gt; <span class=\"num\">8</span><br>\n        ];</p>\n        <button style=\"background:#38bdf8; color:#0f172a; border:none; padding:8px 16px; border-radius:6px; font-weight:bold; cursor:pointer;\" onclick=\"alert('JSON Output:\n{\n  \"status\": 200,\n  \"track\": \"Backend API\"\n}')\">Simulasikan JSON Response</button>\n    </div>\n</body>\n</html>",
            "quiz": {
              "q": "Fungsi PHP standar apa yang digunakan untuk mengubah array atau objek PHP menjadi teks string berformat JSON?",
              "options": [
                "json_stringify()",
                "json_encode()",
                "to_json()",
                "serialize_json()"
              ],
              "answer": 1,
              "explanation": "'json_encode()' adalah fungsi bawaan PHP yang mengubah tipe data array/objek menjadi representasi string JSON standar."
            }
          },
          {
            "id": "mysql_crud",
            "title": "Database Relasional MySQL & Prepared Statements (Anti SQL Injection)",
            "duration": "35 Menit",
            "level": "Menengah",
            "desc": "Mendesain tabel relasional dengan primary/foreign keys dan melakukan query aman dengan PDO / MySQLi Prepared Statements.",
            "theory": "Database adalah jantung tempat penyimpanan data persisten sebuah aplikasi. Kelemahan terbesar pada pemula adalah menggabungkan variabel string langsung ke dalam perintah SQL (SQL Injection). Prepared statements memisahkan instruksi kueri SQL dari parameter data pengguna, sehingga peretas tidak dapat mengubah struktur kueri database.",
            "key_points": [
              "JANGAN PERNAH menyambung query string seperti `SELECT * FROM users WHERE user = '$input'`.",
              "Selalu gunakan tanda tanya (?) atau named parameter (:param) dengan bind_param() atau execute([$param]).",
              "Terapkan relasi Foreign Key dengan ON DELETE CASCADE / RESTRICT untuk menjaga integritas data relasional."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: sans-serif; padding: 20px; background: #f1f5f9; }\n        .code-box { background: #0f172a; color: #e2e8f0; padding: 16px; border-radius: 8px; font-family: monospace; font-size: 0.85rem; }\n        .comment { color: #94a3b8; }\n        .keyword { color: #38bdf8; font-weight: bold; }\n    </style>\n</head>\n<body>\n    <div class=\"code-box\">\n        <span class=\"comment\">// Kueri Aman Menggunakan Prepared Statement</span><br><br>\n        <span class=\"keyword\">$stmt</span> = $conn-&gt;prepare(<span class=\"str\">\"SELECT id, name FROM users WHERE email = ?\"</span>);<br>\n        <span class=\"keyword\">$stmt</span>-&gt;bind_param(<span class=\"str\">\"s\"</span>, $userEmail);<br>\n        <span class=\"keyword\">$stmt</span>-&gt;execute();<br>\n        <span class=\"keyword\">$result</span> = $stmt-&gt;get_result();\n    </div>\n    <p style=\"font-size:0.85rem; color:#475569; margin-top:10px;\">🛡️ Data email diikat secara terpisah sehingga kebal terhadap serangan SQL Injection.</p>\n</body>\n</html>",
            "quiz": {
              "q": "Mengapa penggunaan Prepared Statements wajib diterapkan dalam setiap interaksi kueri database yang melibatkan input pengguna?",
              "options": [
                "Karena membuat query database berjalan 100x lebih cepat.",
                "Untuk mencegah serangan SQL Injection dengan memisahkan kode SQL dari input data pengguna.",
                "Karena database modern menolak query biasa.",
                "Untuk menghemat memori RAM server."
              ],
              "answer": 1,
              "explanation": "Prepared Statements mengompilasi struktur query terlebih dahulu di server DB sebelum data dimasukkan, sehingga karakter kutip atau instruksi SQL berbahaya dari input tidak dieksekusi sebagai perintah."
            }
          }
        ]
      },
      {
        "stage_num": 2,
        "stage_name": "Arsitektur RESTful API & Keamanan Token",
        "modules": [
          {
            "id": "rest_api",
            "title": "Perancangan RESTful JSON API & Standar HTTP Status Codes",
            "duration": "45 Menit",
            "level": "Mahir",
            "desc": "Membangun endpoint API CRUD menggunakan metode GET, POST, PUT, DELETE dengan status code 200, 201, 400, 401, 404, 500.",
            "theory": "REST (Representational State Transfer) adalah gaya arsitektur antarmuka komunikasi antara frontend (Web, Mobile App) dan backend. REST API menggunakan metode HTTP yang terstandarisasi: GET (baca data), POST (buat data), PUT/PATCH (perbarui data), dan DELETE (hapus data). Penggunaan HTTP Status Code yang benar sangat penting bagi developer klien untuk menangani respons dengan akurat.",
            "key_points": [
              "200 OK untuk request berhasil, 201 Created untuk resource yang baru dibuat.",
              "400 Bad Request untuk input tidak valid, 401 Unauthorized untuk pengguna tanpa login/token.",
              "404 Not Found untuk entitas yang tidak ditemukan, 500 Internal Server Error untuk galat server.",
              "Selalu kirimkan header 'Content-Type: application/json; charset=utf-8'."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: monospace; padding: 20px; background: #1e1e2e; color: #a6adc8; }\n        .status-badge { display: inline-block; padding: 4px 8px; border-radius: 4px; font-weight: bold; font-size: 0.8rem; }\n        .s200 { background: #a6e3a1; color: #11111b; }\n        .s401 { background: #f38ba8; color: #11111b; }\n        pre { background: #181825; padding: 12px; border-radius: 8px; color: #cdd6f4; overflow-x: auto; }\n    </style>\n</head>\n<body>\n    <div>\n        <span class=\"status-badge s200\">HTTP 200 OK</span>\n        <pre>{\n  \"status\": \"success\",\n  \"data\": {\n    \"user_id\": 42,\n    \"role\": \"student\",\n    \"track\": \"backend_api\"\n  }\n}</pre>\n    </div>\n</body>\n</html>",
            "quiz": {
              "q": "HTTP Status Code manakah yang paling tepat dikembalikan oleh server ketika sebuah resource data baru berhasil dibuat melalui request POST?",
              "options": [
                "200 OK",
                "201 Created",
                "204 No Content",
                "302 Found"
              ],
              "answer": 1,
              "explanation": "Status 201 Created adalah kode standar REST untuk mengindikasikan bahwa permintaan berhasil dan resource baru telah berhasil dibuat di server."
            }
          },
          {
            "id": "api_security",
            "title": "Keamanan API: Bearer Token, CORS, & Rate Limiting",
            "duration": "40 Menit",
            "level": "Mahir",
            "desc": "Melindungi endpoint API dari serangan brute force, pencurian data lintas domain (CORS), dan otentikasi berbasis token JWT.",
            "theory": "API yang dapat diakses publik rentan terhadap eksploitasi jika tidak diamankan dengan benar. Konfigurasi Cross-Origin Resource Sharing (CORS) membatasi domain web mana saja yang diizinkan mengakses API Anda. Rate Limiting mencegah spam dan DoS dengan membatasi jumlah request per menit per alamat IP.",
            "key_points": [
              "Konfigurasi CORS header 'Access-Control-Allow-Origin' dengan domain spesifik, hindari wildcard (*) untuk data privat.",
              "Simpan token autentikasi pada HTTP-Only secure cookies atau Authorization: Bearer header.",
              "Terapkan rate limiting (misal: maksimal 60 request per menit per IP) untuk mencegah brute-force."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: system-ui, sans-serif; padding: 15px; background: #0f172a; color: white; }\n        .card { background: #1e293b; padding: 16px; border-radius: 10px; border: 1px solid #334155; }\n        .token { word-break: break-all; background: #0b1120; padding: 8px; border-radius: 6px; color: #fca311; font-family: monospace; font-size: 0.78rem; }\n    </style>\n</head>\n<body>\n    <div class=\"card\">\n        <h4 style=\"margin-top:0; color:#38bdf8;\">🔑 Bearer Token Header</h4>\n        <div class=\"token\">Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...</div>\n        <p style=\"font-size:0.8rem; color:#94a3b8; margin-top:8px;\">Klien mengirimkan header ini di setiap request untuk memvalidasi identitas pengguna.</p>\n    </div>\n</body>\n</html>",
            "quiz": {
              "q": "Header HTTP apa yang dikirimkan oleh klien ke server untuk menyertakan token autentikasi JWT?",
              "options": [
                "Authentication: Token ...",
                "Authorization: Bearer <token>",
                "Security-Pass: <token>",
                "X-User-Sign: <token>"
              ],
              "answer": 1,
              "explanation": "Standar RFC 6750 menetapkan header 'Authorization: Bearer <token>' untuk mengirimkan bearer token autentikasi."
            }
          }
        ]
      }
    ]
  },
  "mobile_flutter": {
    "title": "Mobile App Development (Flutter)",
    "badge": "Multiplatform Android & iOS",
    "icon": "fa-solid fa-mobile-screen-button",
    "color": "warning",
    "desc": "Bangun aplikasi mobile Android & iOS berperforma tinggi dengan bahasa Dart dan toolkit UI Flutter dari Google.",
    "skills": "Dart 3, Flutter Widgets, State Management (Provider), REST API Networking, Local DB, Build APK",
    "stages": [
      {
        "stage_num": 1,
        "stage_name": "Dasar Bahasa Dart & Widget Flutter",
        "modules": [
          {
            "id": "dart_basics",
            "title": "Pengenalan Bahasa Dart & Fitur Null Safety",
            "duration": "30 Menit",
            "level": "Dasar Mobile",
            "desc": "Memahami variabel, sound null safety, fungsi async, dan konsep object-oriented programming (OOP) di Dart.",
            "theory": "Dart adalah bahasa yang dioptimalkan oleh Google untuk pengembangan antarmuka klien yang cepat di berbagai platform. Fitur Sound Null Safety menjamin bahwa variabel tidak dapat bernilai null kecuali jika secara eksplisit dideklarasikan dengan tanda tanya (?). Hal ini mengeliminasi kesalahan fatal runtime null dereference yang sering menyebabkan aplikasi mobile tiba-tiba crash.",
            "key_points": [
              "Tipe non-nullable secara default: 'String name = \"Budi\";' tidak boleh bernilai null.",
              "Tipe nullable menggunakan suffix '?': 'String? bio;' boleh berisi null.",
              "Gunakan operator null-coalescing '??' untuk memberikan nilai bawaan jika variabel bernilai null."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: monospace; padding: 20px; background: #042940; color: #9fc131; }\n        .dart-card { background: #005c53; padding: 20px; border-radius: 12px; color: white; }\n        .hl { color: #dbf227; }\n    </style>\n</head>\n<body>\n    <div class=\"dart-card\">\n        <h3>// Dart Sound Null Safety</h3>\n        <p><span class=\"hl\">String</span> name = 'Andi'; // Non-nullable<br>\n        <span class=\"hl\">int?</span> age = null; // Nullable diperbolehkan<br>\n        print(age ?? 18); // Output: 18</p>\n        <button style=\"background:#dbf227; color:#042940; border:none; padding:8px 16px; border-radius:6px; font-weight:bold; cursor:pointer;\" onclick=\"alert('Dart Null Safety mencegah 95% bug crash aplikasi!')\">Cek Manfaat Null Safety</button>\n    </div>\n</body>\n</html>",
            "quiz": {
              "q": "Operator Dart manakah yang digunakan untuk memberikan nilai pengganti bawaan (fallback default) jika sebuah variabel bernilai null?",
              "options": [
                "||",
                "??",
                "?:",
                "&&"
              ],
              "answer": 1,
              "explanation": "Operator null-aware '??' mengembalikan nilai di sebelah kirinya jika tidak null, atau nilai di sebelah kanannya jika null."
            }
          },
          {
            "id": "flutter_widgets",
            "title": "Anatomi Widget Flutter: StatelessWidget vs StatefulWidget",
            "duration": "35 Menit",
            "level": "Menengah",
            "desc": "Menyusun tampilan antarmuka mobile menggunakan Column, Row, Container, Scaffold, dan memanipulasi state layar.",
            "theory": "Di Flutter, 'Everything is a Widget'. StatelessWidget digunakan untuk tampilan yang statis dan tidak berubah setelah dirender (seperti ikon, teks judul, atau kartu statis). StatefulWidget digunakan untuk layar yang memiliki data dinamis yang dapat berubah sepanjang waktu (seperti input formulir, checkbox, atau counter angka) melalui pemanggilan 'setState()'.",
            "key_points": [
              "StatelessWidget: Ringan, tidak menyimpan state internal yang dapat bermutasi.",
              "StatefulWidget: Memiliki kelas State terpisah tempat 'setState()' dipanggil untuk me-render ulang UI.",
              "Scaffold adalah widget struktur standar yang menyediakan AppBar, Body, FloatingActionButton, dan Drawer."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; min-height: 220px; background: #e0f2fe; }\n        .mock-phone { width: 180px; height: 200px; background: white; border-radius: 20px; border: 4px solid #0284c7; box-shadow: 0 10px 20px rgba(0,0,0,0.1); display: flex; flex-direction: column; overflow: hidden; }\n        .app-bar { background: #0284c7; color: white; padding: 10px; font-size: 0.75rem; font-weight: bold; text-align: center; }\n        .app-body { flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center; }\n        .counter { font-size: 24px; font-weight: bold; color: #0284c7; }\n    </style>\n</head>\n<body>\n    <div class=\"mock-phone\">\n        <div class=\"app-bar\">Flutter App Bar</div>\n        <div class=\"app-body\">\n            <span style=\"font-size: 0.7rem; color: #64748b;\">Tekan Tombol:</span>\n            <div class=\"counter\" id=\"flutterCount\">0</div>\n            <button style=\"background:#0284c7; color:white; border:none; width:30px; height:30px; border-radius:50%; cursor:pointer; font-size:16px; margin-top:5px;\" onclick=\"let c=document.getElementById('flutterCount'); c.innerText = parseInt(c.innerText)+1;\">+</button>\n        </div>\n    </div>\n</body>\n</html>",
            "quiz": {
              "q": "Method apa yang harus dipanggil di dalam StatefulWidget untuk memberi tahu framework Flutter agar merender ulang antarmuka layar?",
              "options": [
                "render()",
                "setState(() { ... })",
                "updateUI()",
                "refreshWidget()"
              ],
              "answer": 1,
              "explanation": "'setState()' memberi sinyal kepada Flutter bahwa variabel state telah berubah dan UI perlu dirender ulang."
            }
          }
        ]
      },
      {
        "stage_num": 2,
        "stage_name": "Manajemen State & Konsumsi REST API",
        "modules": [
          {
            "id": "flutter_networking",
            "title": "Integrasi REST API Menggunakan Paket http & Model Dart",
            "duration": "40 Menit",
            "level": "Mahir",
            "desc": "Mengambil data JSON dari server, parsing ke model Dart terstruktur, dan menampilkannya dengan FutureBuilder.",
            "theory": "Aplikasi mobile modern terhubung ke cloud server melalui HTTP REST API. Menggunakan paket 'http' dan fungsi 'jsonDecode()', data JSON diubah menjadi instance Model Dart berorientasi objek yang aman dan mudah diakses di seluruh tampilan widget.",
            "key_points": [
              "Gunakan paket resmi 'http' di file pubspec.yaml.",
              "Manfaatkan factory constructor 'factory Model.fromJson(Map<String, dynamic> json)' untuk deserialisasi data.",
              "Gunakan widget 'FutureBuilder' untuk menangani kondisi: loading (CircularProgressIndicator), success (ListView), dan error."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: sans-serif; padding: 15px; background: #f8fafc; }\n        .card { background: white; padding: 15px; border-radius: 8px; border-left: 4px solid #0284c7; box-shadow: 0 2px 4px rgba(0,0,0,0.05); }\n    </style>\n</head>\n<body>\n    <div class=\"card\">\n        <h4 style=\"margin: 0 0 5px; color:#0284c7;\">FutureBuilder di Flutter</h4>\n        <p style=\"font-size:0.85rem; color:#475569; margin:0;\">Menampilkan widget spinner saat request HTTP berlangsung, lalu merender ListView otomatis setelah data diterima.</p>\n    </div>\n</body>\n</html>",
            "quiz": {
              "q": "Widget Flutter manakah yang paling ideal digunakan untuk merender tampilan berdasarkan status sebuah Promise/Future asynchronous?",
              "options": [
                "AsyncView",
                "FutureBuilder",
                "HttpContainer",
                "WaitWidget"
              ],
              "answer": 1,
              "explanation": "FutureBuilder secara otomatis mendengarkan siklus hidup Future (ConnectionState.waiting, hasData, hasError) dan membangun widget yang sesuai."
            }
          },
          {
            "id": "flutter_release",
            "title": "Build APK Produksi & Rilis ke Google Play Store",
            "duration": "45 Menit",
            "level": "Proyek Portofolio",
            "desc": "Konfigurasi signing key keystore, optimasi proguard/obfuscation, dan membuat bundle AAB untuk Google Play.",
            "theory": "Langkah pamungkas dalam pengembangan aplikasi mobile adalah memproduksi file rilis yang teroptimasi. Perintah 'flutter build appbundle' menghasilkan file Android App Bundle (AAB) yang ukurannya jauh lebih kecil dan aman untuk dipublikasikan ke Google Play Store.",
            "key_points": [
              "Buat keystore digital aman menggunakan tool 'keytool' untuk menandatangani rilis.",
              "Konfigurasi file 'key.properties' dan 'android/app/build.gradle'.",
              "Uji file rilis di perangkat nyata sebelum mengunggah ke Google Play Console."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: monospace; padding: 20px; background: #0f172a; color: #22c55e; }\n        .terminal { background: #1e293b; padding: 16px; border-radius: 8px; }\n    </style>\n</head>\n<body>\n    <div class=\"terminal\">\n        $ flutter build appbundle --release<br>\n        ✓ Built build/app/outputs/bundle/release/app-release.aab (18.4MB).<br>\n        <span style=\"color:#e2e8f0; font-size:0.8rem;\">Aplikasi siap diunggah ke Google Play Store!</span>\n    </div>\n</body>\n</html>",
            "quiz": {
              "q": "Format berkas rilis Android apa yang kini diwajibkan oleh Google Play Store untuk aplikasi baru menggantikan APK konvensional?",
              "options": [
                "JAR (Java Archive)",
                "AAB (Android App Bundle)",
                "EXE (Executable)",
                "IPA (iOS Package)"
              ],
              "answer": 1,
              "explanation": "Google Play Store mewajibkan format AAB (Android App Bundle) karena memungkinkan Google Play menghasilkan APK yang dioptimalkan khusus sesuai spesifikasi perangkat masing-masing pengguna."
            }
          }
        ]
      }
    ]
  },
  "uiux_design": {
    "title": "UI/UX & Multimedia Design",
    "badge": "Riset ke Prototipe",
    "icon": "fa-solid fa-bezier-curve",
    "color": "info",
    "desc": "Kuasai riset pengguna, wireframing, auto-layout Figma standar industri, design system berulang, dan prototipe interaktif.",
    "skills": "Figma, Wireframing, Design Thinking, Auto-Layout, Design Systems, Handoff Developer",
    "stages": [
      {
        "stage_num": 1,
        "stage_name": "Riset Pengguna & Design Thinking",
        "modules": [
          {
            "id": "uiux_intro",
            "title": "Prinsip Design Thinking & Pemetaan Empathy Map Pengguna",
            "duration": "25 Menit",
            "level": "Dasar Desain",
            "desc": "Memahami 5 tahapan Design Thinking: Empathize, Define, Ideate, Prototype, Test untuk memecahkan masalah nyata pengguna.",
            "theory": "Desain UI/UX bukan sekadar membuat tampilan yang indah dipandang secara visual, melainkan menciptakan solusi fungsional yang mudah dan menyenangkan digunakan oleh pengguna nyata. Dengan pendekatan Design Thinking, perancang menggali motivasi, keluhan (pain points), dan kebutuhan mendasar calon pengguna sebelum mulai menggambar antarmuka.",
            "key_points": [
              "Empathize: Wawancara dan observasi langsung ke calon pengguna.",
              "Define: Merumuskan masalah spesifik dalam bentuk Problem Statement.",
              "Ideate: Menghasilkan beragam ide solusi kreatif tanpa batasan awal.",
              "Prototype & Test: Membuat model awal dan menguji coba secara langsung kepada pengguna."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: sans-serif; padding: 15px; background: #fdf4ff; }\n        .empathy-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; max-width: 380px; margin: auto; }\n        .box { background: white; padding: 12px; border-radius: 8px; border: 1px solid #f0abfc; text-align: center; }\n        .box strong { color: #86198f; font-size: 0.85rem; }\n    </style>\n</head>\n<body>\n    <div class=\"empathy-grid\">\n        <div class=\"box\"><strong>Says (Perkataan)</strong><p style=\"font-size:0.75rem; margin:5px 0 0; color:#701a75;\">\"Saya bingung cari materi dasar\"</p></div>\n        <div class=\"box\"><strong>Thinks (Pikiran)</strong><p style=\"font-size:0.75rem; margin:5px 0 0; color:#701a75;\">\"Apakah koding itu sulit?\"</p></div>\n        <div class=\"box\"><strong>Does (Tindakan)</strong><p style=\"font-size:0.75rem; margin:5px 0 0; color:#701a75;\">Membuka tutorial YouTube tapi tersesat</p></div>\n        <div class=\"box\"><strong>Feels (Perasaan)</strong><p style=\"font-size:0.75rem; margin:5px 0 0; color:#701a75;\">Cemas tertinggal kemajuan zaman</p></div>\n    </div>\n</body>\n</html>",
            "quiz": {
              "q": "Manakah urutan 5 tahapan Design Thinking yang paling benar?",
              "options": [
                "Ideate -> Define -> Empathize -> Test -> Prototype",
                "Empathize -> Define -> Ideate -> Prototype -> Test",
                "Prototype -> Test -> Empathize -> Define -> Ideate",
                "Define -> Ideate -> Prototype -> Test -> Empathize"
              ],
              "answer": 1,
              "explanation": "Tahapan standar Design Thinking adalah: Empathize (empati), Define (definisi masalah), Ideate (ide solusi), Prototype (pembuatan model), dan Test (pengujian ke pengguna)."
            }
          },
          {
            "id": "figma_autolayout",
            "title": "Penguasaan Figma Auto Layout & Komponen Responsif",
            "duration": "35 Menit",
            "level": "Menengah",
            "desc": "Membangun tombol, kartu, dan formulir di Figma yang otomatis menyesuaikan ukuran teks menggunakan Auto Layout (Shift+A).",
            "theory": "Auto Layout di Figma adalah padanan langsung dari CSS Flexbox di dunia desain. Dengan menguasai Auto Layout, tombol akan otomatis melebar saat teks diubah, kartu akan tersusun rapi dengan padding yang konsisten, dan pengembang web dapat mengimplementasikan desain Anda ke dalam kode CSS dengan sangat mudah dan presisi.",
            "key_points": [
              "Gunakan shortcut 'Shift + A' untuk membuat frame Auto Layout seketika.",
              "Pahami mode 'Hug Contents' (mengikuti ukuran isi), 'Fixed' (ukuran tetap), dan 'Fill Container' (mengisi penuh ruang sisa).",
              "Terapkan 8-Point Grid System untuk nilai padding dan spacing agar hierarki visual seragam."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: sans-serif; display: flex; justify-content: center; align-items: center; min-height: 200px; background: #f8fafc; }\n        .figma-pill {\n            display: inline-flex;\n            align-items: center;\n            gap: 8px;\n            background: #0d2e5c;\n            color: #ffffff;\n            padding: 8px 16px;\n            border-radius: 30px;\n            font-size: 0.85rem;\n            font-weight: 600;\n            border: 2px solid #fca311;\n            box-shadow: 0 4px 10px rgba(0,0,0,0.1);\n        }\n    </style>\n</head>\n<body>\n    <div class=\"figma-pill\">\n        <span>🎨</span>\n        <span>Auto-Layout Button (Hug)</span>\n    </div>\n</body>\n</html>",
            "quiz": {
              "q": "Opsi resizing Auto Layout Figma apa yang membuat lebar sebuah elemen otomatis memenuhi seluruh lebar frame induknya?",
              "options": [
                "Hug Contents",
                "Fill Container",
                "Fixed Width",
                "Expand Max"
              ],
              "answer": 1,
              "explanation": "'Fill Container' memerintahkan layer untuk meregang dan mengisi seluruh ruang yang tersedia di dalam frame Auto Layout induknya."
            }
          }
        ]
      },
      {
        "stage_num": 2,
        "stage_name": "Design System & Handoff ke Developer",
        "modules": [
          {
            "id": "design_system",
            "title": "Perancangan Design System, Color Tokens, & Typography Scale",
            "duration": "40 Menit",
            "level": "Menengah ke Mahir",
            "desc": "Membangun komponen reusable (komponen master & varian) serta token warna dan tipografi berskala besar.",
            "theory": "Sebuah aplikasi modern membutuhkan konsistensi visual di seluruh layarnya. Design System adalah repositori kebenaran tunggal (single source of truth) yang berisi kumpulan komponen, token warna, tipografi, dan panduan penggunaan yang dipakai oleh desainer dan software engineer dalam bekerja bersama.",
            "key_points": [
              "Komponen Master dan Varian (Primary, Secondary, Danger, Disabled).",
              "Color Tokens: Menyimpan nama warna berdasarkan fungsi (misal: 'bg-primary', 'text-error') bukan kode hex kaku.",
              "Typography scale berbasis rasio proporsional (Major Second, Minor Third)."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: sans-serif; padding: 15px; background: #f8fafc; }\n        .swatch-group { display: flex; gap: 8px; justify-content: center; }\n        .swatch { width: 60px; height: 60px; border-radius: 8px; display: flex; align-items: flex-end; padding: 4px; font-size: 0.65rem; font-weight: bold; }\n        .s-navy { background: #0d2e5c; color: white; }\n        .s-gold { background: #fca311; color: #0d2e5c; }\n        .s-slate { background: #e2e8f0; color: #334155; }\n    </style>\n</head>\n<body>\n    <div class=\"swatch-group\">\n        <div class=\"swatch s-navy\">Navy</div>\n        <div class=\"swatch s-gold\">Gold</div>\n        <div class=\"swatch s-slate\">Slate</div>\n    </div>\n</body>\n</html>",
            "quiz": {
              "q": "Apakah fungsi utama dari Design Token dalam alur kolaborasi UI/UX Designer dan Frontend Engineer?",
              "options": [
                "Sebagai pengganti password login.",
                "Sebagai variabel nilai bersama (seperti warna dan spacing) yang menghubungkan desain di Figma dengan variabel CSS di kode.",
                "Untuk membeli aset ilustrasi berbayar.",
                "Untuk menghitung gaji desainer otomatis."
              ],
              "answer": 1,
              "explanation": "Design Token menyimpan keputusan desain dasar (seperti nilai warna, font, margin) dalam format yang dapat dikonsumsi langsung oleh kode CSS/Sass frontend."
            }
          },
          {
            "id": "design_handoff",
            "title": "Design Handoff, Dev Mode Figma, & Pembuatan Portofolio Case Study",
            "duration": "45 Menit",
            "level": "Proyek Portofolio",
            "desc": "Mempersiapkan file Figma agar siap didevelop oleh programmer, menyusun dokumen serah terima, dan case study Behance/Dribbble.",
            "theory": "Desain yang hebat adalah desain yang dapat diimplementasikan menjadi produk nyata oleh tim developer. Melalui Figma Dev Mode, anotasi pengukuran, dan spesifikasi interaksi yang jelas, desainer memastikan hasil koding sesuai 100% dengan rancangan visual pixel-perfect.",
            "key_points": [
              "Beri nama frame dan layer secara terstruktur dan teratur.",
              "Sertakan spesifikasi state interaktif: hover, active, focused, dan disabled.",
              "Tuliskan Case Study portofolio yang menceritakan latar belakang masalah, proses riset, iterasi, hingga hasil akhir."
            ],
            "sample_code": "<!DOCTYPE html>\n<html>\n<head>\n    <style>\n        body { font-family: sans-serif; padding: 15px; background: #ecfdf5; text-align: center; }\n        .handoff-box { background: white; padding: 20px; border-radius: 12px; max-width: 350px; margin: auto; border: 1px solid #a7f3d0; }\n    </style>\n</head>\n<body>\n    <div class=\"handoff-box\">\n        <h4 style=\"margin:0 0 8px; color:#065f46;\">🚀 Siap Diluncurkan ke Developer</h4>\n        <p style=\"font-size:0.85rem; color:#047857; margin:0;\">Layer rapi, token warna tersambung, dan prototipe interaktif siap dites!</p>\n    </div>\n</body>\n</html>",
            "quiz": {
              "q": "Fitur Figma apa yang secara khusus mempermudah programmer frontend menginspeksi nilai margin, font, CSS, dan mengunduh aset gambar dengan sekali klik?",
              "options": [
                "Vector Networks",
                "Dev Mode",
                "Pen Tool",
                "FigJam"
              ],
              "answer": 1,
              "explanation": "Figma Dev Mode menyediakan ruang kerja khusus bagi developer untuk melihat kode CSS, ukuran jarak presisi, aset SVG/PNG siap unduh, dan riwayat perubahan desain."
            }
          }
        ]
      }
    ]
  }
};

        // State Progres Belajar Pengguna
        let activeTrackKey = 'web_frontend';
        let currentModalModule = null;
        let userCompletedModules = new Set();
        let isLoggedInUser = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;

        // Inisialisasi Progres Pengguna dari API / LocalStorage
        function initUserProgress() {
            if (isLoggedInUser) {
                fetch('api/progress.php')
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success' && data.completed_modules) {
                            userCompletedModules.clear();
                            data.completed_modules.forEach(m => {
                                userCompletedModules.add(`${m.track_id}:${m.module_id}`);
                            });
                            renderCurrentTrack();
                        }
                    })
                    .catch(() => {
                        loadLocalProgress();
                        renderCurrentTrack();
                    });
            } else {
                loadLocalProgress();
                renderCurrentTrack();
            }
        }

        function loadLocalProgress() {
            try {
                const saved = localStorage.getItem('skillance_completed_modules');
                if (saved) {
                    const list = JSON.parse(saved);
                    userCompletedModules = new Set(list);
                }
            } catch(e) {}
        }

        function saveLocalProgress() {
            try {
                localStorage.setItem('skillance_completed_modules', JSON.stringify(Array.from(userCompletedModules)));
            } catch(e) {}
        }

        // Switch Active Track
        function switchTrack(trackKey) {
            activeTrackKey = trackKey;
            
            // Update Tab Buttons UI
            document.querySelectorAll('.track-nav-btn').forEach(btn => {
                btn.classList.remove('btn-navy', 'active', 'shadow-sm');
                btn.classList.add('btn-outline-navy');
            });
            const activeBtn = document.getElementById(`btn-tab-${trackKey}`);
            if (activeBtn) {
                activeBtn.classList.remove('btn-outline-navy');
                activeBtn.classList.add('btn-navy', 'active', 'shadow-sm');
            }

            renderCurrentTrack();
        }

        // Render Current Track Stages & Modules
        function renderCurrentTrack() {
            const track = COURSES_DATA[activeTrackKey];
            if (!track) return;

            // Update Header Card
            document.getElementById('activeTrackBadge').innerText = track.badge;
            document.getElementById('activeTrackTitle').innerText = track.title;
            document.getElementById('activeTrackDesc').innerText = track.desc;
            document.getElementById('activeTrackSkills').innerHTML = `<i class="fa-solid fa-layer-group me-1 text-gold"></i> ${escapeHtml(track.skills)}`;

            // Calculate Progress
            let totalTrackModules = 0;
            let completedTrackModules = 0;

            track.stages.forEach(stage => {
                stage.modules.forEach(m => {
                    totalTrackModules++;
                    if (userCompletedModules.has(`${activeTrackKey}:${m.id}`)) {
                        completedTrackModules++;
                    }
                });
            });

            const percent = totalTrackModules > 0 ? Math.round((completedTrackModules / totalTrackModules) * 100) : 0;
            document.getElementById('trackProgressText').innerText = `${percent}% Selesai (${completedTrackModules}/${totalTrackModules} Modul)`;
            document.getElementById('trackProgressBar').style.width = `${percent}%`;

            // Render Stages
            const container = document.getElementById('stagesContainer');
            let html = '';

            track.stages.forEach((stage, sIdx) => {
                let stageCompletedCount = 0;
                stage.modules.forEach(m => {
                    if (userCompletedModules.has(`${activeTrackKey}:${m.id}`)) {
                        stageCompletedCount++;
                    }
                });

                html += `
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                        <div class="card-header py-3 px-4 bg-navy text-white d-flex flex-wrap justify-content-between align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge bg-gold text-navy fw-bold px-2 py-1">Tahap ${stage.stage_num}</span>
                                <h5 class="mb-0 fw-bold font-heading text-white" style="font-size: 1.05rem;">${escapeHtml(stage.stage_name)}</h5>
                            </div>
                            <span class="badge bg-white bg-opacity-25 text-white fw-semibold small mt-2 mt-md-0">
                                ${stageCompletedCount} / ${stage.modules.length} Selesai
                            </span>
                        </div>
                        <div class="card-body p-4">
                            <div class="row g-3">
                `;

                stage.modules.forEach((mod, mIdx) => {
                    const isDone = userCompletedModules.has(`${activeTrackKey}:${mod.id}`);
                    const cardBorder = isDone ? 'border-success' : 'border-light-subtle';
                    const statusBadge = isDone 
                        ? '<span class="badge bg-success-subtle text-success fw-bold"><i class="fa-solid fa-circle-check me-1"></i> Selesai</span>'
                        : '<span class="badge bg-light text-secondary fw-semibold">Belum Selesai</span>';

                    html += `
                        <div class="col-lg-6">
                            <div class="card h-100 border ${cardBorder} rounded-3 shadow-none p-3 transition-hover" style="background: ${isDone ? '#f0fdf4' : '#ffffff'};">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <span class="badge bg-navy-subtle text-navy fw-bold small">${escapeHtml(mod.level)}</span>
                                    <div>${statusBadge}</div>
                                </div>
                                <h6 class="fw-bold text-navy mb-2" style="font-size: 0.95rem; line-height: 1.4;">${escapeHtml(mod.title)}</h6>
                                <p class="text-muted small mb-3 flex-grow-1" style="font-size: 0.82rem; line-height: 1.5;">${escapeHtml(mod.desc)}</p>
                                
                                <div class="d-flex flex-wrap justify-content-between align-items-center pt-2 border-top border-light-subtle mt-auto gap-2">
                                    <small class="text-muted" style="font-size: 0.75rem;">
                                        <i class="fa-regular fa-clock me-1 text-gold"></i> ${escapeHtml(mod.duration)}
                                    </small>
                                    <div class="d-flex align-items-center gap-2">
                                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-2 py-1" style="font-size: 0.75rem;" onclick="loadSampleDirectly('${activeTrackKey}', ${sIdx}, ${mIdx})" title="Coba Kode Langsung">
                                            <i class="fa-solid fa-code text-gold"></i> Code Lab
                                        </button>
                                        <button class="btn btn-sm btn-navy rounded-pill px-3 py-1 fw-bold" style="font-size: 0.78rem;" onclick="openLessonModal('${activeTrackKey}', ${sIdx}, ${mIdx})">
                                            <i class="fa-solid fa-book-open me-1"></i> Buka Materi
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                });

                html += `
                            </div>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
        }

        // Open Lesson Modal
        function openLessonModal(trackKey, stageIdx, moduleIdx) {
            const mod = COURSES_DATA[trackKey].stages[stageIdx].modules[moduleIdx];
            currentModalModule = { trackKey, stageIdx, moduleIdx, ...mod };

            document.getElementById('modalLessonTitle').innerText = mod.title;
            document.getElementById('modalLessonDuration').innerHTML = `<i class="fa-regular fa-clock me-1"></i> ${escapeHtml(mod.duration)} Estimasi`;
            document.getElementById('modalLevelBadge').innerText = mod.level;

            // Theory
            document.getElementById('modalLessonTheory').innerText = mod.theory;

            // Key Points
            const ul = document.getElementById('modalKeyPoints');
            ul.innerHTML = '';
            mod.key_points.forEach(kp => {
                const li = document.createElement('li');
                li.innerText = kp;
                li.className = 'mb-1';
                ul.appendChild(li);
            });

            // Sample Code
            document.getElementById('modalSampleCode').innerText = mod.sample_code;

            // Quiz
            const quizContainer = document.getElementById('quizOptions');
            const feedbackEl = document.getElementById('quizFeedback');
            feedbackEl.style.display = 'none';
            document.getElementById('quizQuestion').innerText = mod.quiz.q;
            quizContainer.innerHTML = '';

            mod.quiz.options.forEach((opt, idx) => {
                const btn = document.createElement('button');
                btn.className = 'btn btn-sm btn-outline-secondary text-start p-2 rounded-2 quiz-option-btn';
                btn.style.fontSize = '0.82rem';
                btn.innerText = `${String.fromCharCode(65 + idx)}. ${opt}`;
                btn.onclick = function() {
                    checkQuizAnswer(idx, mod.quiz, btn);
                };
                quizContainer.appendChild(btn);
            });

            // Update Complete Button UI
            updateModalCompleteButton();

            // Show Modal
            const modalEl = document.getElementById('lessonModal');
            const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
            modal.show();
        }

        // Check Quiz Answer
        function checkQuizAnswer(selectedIdx, quiz, btnEl) {
            const allBtns = document.querySelectorAll('.quiz-option-btn');
            allBtns.forEach(b => b.disabled = true);

            const feedback = document.getElementById('quizFeedback');
            feedback.style.display = 'block';

            if (selectedIdx === quiz.answer) {
                btnEl.classList.remove('btn-outline-secondary');
                btnEl.classList.add('btn-success', 'text-white');
                feedback.className = 'small mt-2 p-2 rounded-2 bg-success-subtle text-success fw-semibold';
                feedback.innerHTML = `<i class="fa-solid fa-circle-check me-1"></i> <strong>Benar!</strong> ${escapeHtml(quiz.explanation)}`;
            } else {
                btnEl.classList.remove('btn-outline-secondary');
                btnEl.classList.add('btn-danger', 'text-white');
                if (allBtns[quiz.answer]) {
                    allBtns[quiz.answer].classList.remove('btn-outline-secondary');
                    allBtns[quiz.answer].classList.add('btn-success', 'text-white');
                }
                feedback.className = 'small mt-2 p-2 rounded-2 bg-danger-subtle text-danger fw-semibold';
                feedback.innerHTML = `<i class="fa-solid fa-circle-xmark me-1"></i> <strong>Kurang Tepat.</strong> ${escapeHtml(quiz.explanation)}`;
            }
        }

        // Toggle Module Complete
        function updateModalCompleteButton() {
            const btn = document.getElementById('btnToggleComplete');
            if (!currentModalModule) return;
            const key = `${currentModalModule.trackKey}:${currentModalModule.id}`;
            const isDone = userCompletedModules.has(key);

            if (isDone) {
                btn.className = 'btn btn-sm btn-outline-success rounded-pill px-4 fw-bold';
                btn.innerHTML = '<i class="fa-solid fa-check-double me-1"></i> Selesai (Klik Batal)';
                btn.onclick = () => setModuleCompletion(false);
            } else {
                btn.className = 'btn btn-sm btn-success rounded-pill px-4 fw-bold shadow-sm';
                btn.innerHTML = '<i class="fa-solid fa-check me-1"></i> Tandai Selesai';
                btn.onclick = () => setModuleCompletion(true);
            }
        }

        function setModuleCompletion(markDone) {
            if (!currentModalModule) return;
            const trackKey = currentModalModule.trackKey;
            const modId = currentModalModule.id;
            const key = `${trackKey}:${modId}`;

            if (markDone) {
                userCompletedModules.add(key);
            } else {
                userCompletedModules.delete(key);
            }

            saveLocalProgress();
            updateModalCompleteButton();
            renderCurrentTrack();

            // Sync with backend if logged in
            if (isLoggedInUser) {
                fetch('api/progress.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        track_id: trackKey,
                        module_id: modId,
                        completed: markDone
                    })
                })
                .then(r => r.json())
                .then(data => {
                    if (data.status === 'success' && data.badge_awarded) {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Selamat! Lencana Baru Diraih! 🎓',
                                html: `Anda telah menyelesaikan seluruh modul di jalur <strong>${escapeHtml(COURSES_DATA[trackKey].title)}</strong>.<br><br><span class="badge bg-gold text-navy p-2 fs-6"><i class="fa-solid fa-certificate me-1"></i> ${escapeHtml(data.badge_awarded)}</span>`,
                                confirmButtonColor: '#0d2e5c'
                            });
                        }
                    }
                })
                .catch(() => {});
            } else {
                if (markDone && typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'info',
                        title: 'Modul Selesai!',
                        text: 'Progres Anda disimpan di browser. Masuk atau Daftar Akun untuk menyimpan permanen dan mendapatkan sertifikat resmi!',
                        timer: 2500,
                        showConfirmButton: false
                    });
                }
            }
        }

        // Run In Playground from Modal
        function runInPlayground() {
            if (!currentModalModule) return;
            const code = currentModalModule.sample_code;
            const filename = `materi_${currentModalModule.id}.html`;

            // Dismiss modal
            const modalEl = document.getElementById('lessonModal');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) modal.hide();

            // Load to Editor
            document.getElementById('codeEditor').value = code;
            document.getElementById('editorFilename').innerText = filename;
            runCode();

            // Scroll to editor
            const labEl = document.getElementById('playground');
            if (labEl) {
                labEl.scrollIntoView({ behavior: 'smooth' });
            }
        }

        function loadSampleDirectly(trackKey, stageIdx, moduleIdx) {
            const mod = COURSES_DATA[trackKey].stages[stageIdx].modules[moduleIdx];
            document.getElementById('codeEditor').value = mod.sample_code;
            document.getElementById('editorFilename').innerText = `materi_${mod.id}.html`;
            runCode();

            const labEl = document.getElementById('playground');
            if (labEl) {
                labEl.scrollIntoView({ behavior: 'smooth' });
            }
        }


        document.addEventListener('DOMContentLoaded', function() {
            initUserProgress();
            runCode();

            // Check Unified User Session (Option A - Single Sign-On)
            fetch('api/user.php')
                .then(res => res.json())
                .then(data => {
                    if (data.logged_in && data.user) {
                        const u = data.user;
                        const avatar = u.photo || ('https://ui-avatars.com/api/?name=' + encodeURIComponent(u.name) + '&background=0d2e5c&color=fff');
                        
                        // Update Top Hub Bar
                        const topHubUser = document.getElementById('topHubUser');
                        if (topHubUser) {
                            topHubUser.innerHTML = `<span class="badge bg-success-subtle text-success me-2 px-2 py-1"><i class="fa-solid fa-circle-check me-1"></i> Terhubung Akun Terpadu</span> Halo, <strong>${escapeHtml(u.name)}</strong>`;
                        }

                        // Update Main Navbar Auth Area
                        const authArea = document.getElementById('navAuthArea');
                        if (authArea) {
                            authArea.innerHTML = `
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-navy rounded-pill px-3 py-1 fw-bold dropdown-toggle d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                                        <img src="${escapeHtml(avatar)}" class="rounded-circle shadow-sm" style="width: 26px; height: 26px; object-fit: cover;">
                                        <span class="d-none d-md-inline text-truncate" style="max-width: 120px;">${escapeHtml(u.name)}</span>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-3 mt-2" style="font-size: 0.85rem; min-width: 220px;">
                                        <li class="px-3 py-2 border-bottom">
                                            <div class="fw-bold text-navy text-truncate">${escapeHtml(u.name)}</div>
                                            <small class="text-muted text-uppercase" style="font-size: 0.68rem;"><i class="fa-solid fa-graduation-cap text-gold me-1"></i> Siswa Aktif (${escapeHtml(u.type)})</small>
                                        </li>
                                        <li><a class="dropdown-item py-2 fw-semibold" href="https://skillance.my.id/dashboard/freelancer/"><i class="fa-solid fa-briefcase text-gold me-2"></i> Mode Freelance & Tugas</a></li>
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li><a class="dropdown-item py-2 text-danger fw-semibold" href="auth/logout.php"><i class="fa-solid fa-right-from-bracket me-2"></i> Keluar</a></li>
                                    </ul>
                                </div>
                            `;
                        }
                    }
                })
                .catch(() => {});

            function escapeHtml(text) {
                if (!text) return '';
                return text.replace(/[&<>"']/g, function(m) {
                    return {'&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#039;'}[m];
                });
            }
        });
    </script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php if (isset($_GET['logged_in']) && $isLoggedIn): ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Masuk!',
                text: 'Selamat datang, <?= htmlspecialchars($userName) ?>! Akun belajar Anda telah terhubung dengan Bursa Freelance Skillance.',
                timer: 2500,
                showConfirmButton: false
            });
        }
    });
    </script>
    <?php endif; ?>
</body>
</html>
