<?php
/**
 * Skillance Online Bootcamp Portal
 * Model Pembelajaran ala Dicoding: Sekali Bayar, Akses Selamanya, Submission Tugas & Code Review, Hadiah Proyek Terbaik.
 */

if (session_status() === PHP_SESSION_NONE) {
    @session_start();
}

$activeNav = 'bootcamp';
$seoTitle = 'Online Bootcamp Pemrograman Berstandar Industri ala Dicoding | Skillance Academy';
$seoDesc = 'Bootcamp online praktis model Dicoding di Skillance Academy: Sekali bayar akses selamanya, submission tugas dengan code review 1-on-1 dari engineer, dan hadiah dana pembinaan serta proyek freelance bagi karya terbaik.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($seoTitle) ?></title>
    <meta name="description" content="<?= htmlspecialchars($seoDesc) ?>">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #0d2e5c;
            --navy-dark: #071a35;
            --gold: #fca311;
            --gold-hover: #e5930e;
            --green: #04AA6D;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }

        .font-heading {
            font-family: 'Space Grotesk', sans-serif;
        }

        .text-navy { color: var(--navy-dark) !important; }
        .text-gold { color: var(--gold) !important; }
        .bg-navy { background-color: var(--navy-dark) !important; }

        /* Hero Banner */
        .bootcamp-hero {
            background: linear-gradient(135deg, #071a35 0%, #0d2e5c 65%, #0284c7 100%);
            color: #ffffff;
            border-radius: 24px;
            position: relative;
            overflow: hidden;
        }

        .bootcamp-hero::after {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 320px;
            height: 320px;
            background: radial-gradient(circle, rgba(252, 163, 17, 0.25) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        /* Feature Card */
        .pilar-card {
            background: #ffffff;
            border-radius: 18px;
            border: 1px solid #e2e8f0;
            transition: all 0.25s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        }

        .pilar-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 25px rgba(7, 26, 53, 0.08);
            border-color: #cbd5e1;
        }

        /* Class Card */
        .class-card {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .class-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 30px rgba(7, 26, 53, 0.1);
            border-color: var(--gold);
        }

        .class-card-header {
            padding: 24px;
            background: linear-gradient(135deg, #071a35 0%, #0d2e5c 100%);
            color: #ffffff;
            position: relative;
        }

        /* Submission Box */
        .submission-card {
            background: #ffffff;
            border-radius: 20px;
            border: 2px dashed #cbd5e1;
            transition: all 0.2s ease;
        }

        .submission-card:focus-within {
            border-color: #0284c7;
            background: #f0f9ff;
        }

        /* Reviewer Badge */
        .badge-dicoding {
            background: rgba(13, 148, 136, 0.12);
            color: #0f766e;
            border: 1px solid rgba(13, 148, 136, 0.25);
            font-weight: 700;
        }
    </style>
</head>
<body>

    <!-- NAVBAR MASTER ACADEMY -->
    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <main class="container py-4 py-lg-5">

        <!-- ============================================== -->
        <!-- 1. HERO SECTION BOOTCAMP ALA DICODING -->
        <!-- ============================================== -->
        <section class="bootcamp-hero p-4 p-md-5 mb-5 shadow-sm">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                        <span class="badge bg-gold text-navy fw-bold px-3 py-2 rounded-pill shadow-xs" style="background-color: #fca311 !important; color: #071a35 !important;">
                            <i class="fa-solid fa-fire me-1"></i> MODEL BELAJAR ALA DICODING
                        </span>
                        <span class="badge bg-white bg-opacity-15 text-white border border-white border-opacity-25 px-3 py-2 rounded-pill small">
                            <i class="fa-solid fa-infinity text-warning me-1"></i> SEKALI BAYAR &bull; AKSES SELAMANYA
                        </span>
                    </div>

                    <h1 class="display-6 fw-bold font-heading mb-3 text-white">
                        Online Bootcamp Koding Praktis: Bangun Portofolio Industri Nyata
                    </h1>

                    <p class="lead text-white-50 mb-4" style="font-size: 1.05rem; line-height: 1.8;">
                        Pelajari kurikulum koding terstruktur dari dasar hingga mahir. Kerjakan <strong>tugas submission proyek nyata</strong> yang direview secara personal baris demi baris oleh tim <em>Software Engineer</em>, serta raih <strong>Hadiah Uang Pembinaan & Peluang Proyek Freelance Klien</strong> bagi karya terbaik!
                    </p>

                    <div class="d-flex flex-wrap gap-3">
                        <a href="bootcamp-register.php" class="btn btn-warning fw-bold px-4 py-3 rounded-pill text-navy shadow-sm d-flex align-items-center gap-2" style="background-color: #fca311 !important;">
                            <i class="fa-solid fa-graduation-cap fs-5"></i> Daftar Bootcamp Sekarang &raquo;
                        </a>
                        <a href="#portal-submission" class="btn btn-outline-light fw-bold px-4 py-3 rounded-pill d-flex align-items-center gap-2">
                            <i class="fa-solid fa-code-commit fs-5 text-warning"></i> Portal Submission Tugas
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 text-center d-none d-lg-block">
                    <div class="bg-white bg-opacity-10 p-4 rounded-4 border border-white border-opacity-15 shadow-sm text-start">
                        <h6 class="fw-bold text-gold mb-3"><i class="fa-solid fa-award me-2"></i>Benefit Eksklusif Siswa:</h6>
                        <ul class="list-unstyled text-white small d-flex flex-column gap-2 mb-0">
                            <li><i class="fa-solid fa-circle-check text-success me-2"></i> <strong>Akses Selamanya</strong> ke seluruh modul & update 2026</li>
                            <li><i class="fa-solid fa-circle-check text-success me-2"></i> <strong>Code Review 1-on-1</strong> oleh praktisi software house</li>
                            <li><i class="fa-solid fa-circle-check text-success me-2"></i> <strong>Hadiah Dana Pembinaan</strong> bagi proyek terbaik</li>
                            <li><i class="fa-solid fa-circle-check text-success me-2"></i> <strong>Sertifikat Resmi SKPI</strong> ber-QR Code online</li>
                            <li><i class="fa-solid fa-circle-check text-success me-2"></i> <strong>Penyaluran Proyek Freelance</strong> ke mitra klien</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================== -->
        <!-- 2. 4 PILAR UTAMA BOOTCAMP SKILLANCE -->
        <!-- ============================================== -->
        <section class="mb-5">
            <div class="text-center mb-4 mx-auto" style="max-width: 680px;">
                <span class="badge bg-gold-subtle text-navy fw-bold px-3 py-1.5 rounded-pill mb-2 text-uppercase">Kenapa Berbeda?</span>
                <h3 class="fw-bold font-heading text-navy">4 Keunggulan Belajar di Skillance Bootcamp</h3>
                <p class="text-muted small">Dirancang khusus agar mahasiswa dan talenta muda daerah memiliki portofolio koding berstandar industri tanpa biaya bulanan yang memberatkan.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="pilar-card p-4 h-100 border-top border-4 border-warning">
                        <div class="d-inline-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning rounded-3 p-3 mb-3" style="width: 50px; height: 50px;">
                            <i class="fa-solid fa-infinity fs-4"></i>
                        </div>
                        <h5 class="fw-bold text-navy mb-2" style="font-size: 1.05rem;">Sekali Bayar & Akses Selamanya</h5>
                        <p class="text-muted small mb-0" style="line-height: 1.7;">Tidak ada biaya langganan bulanan. Sekali daftar, materi e-book, video modul, dan update kurikulum dapat diakses seumur hidup kapan saja.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="pilar-card p-4 h-100 border-top border-4 border-primary">
                        <div class="d-inline-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary rounded-3 p-3 mb-3" style="width: 50px; height: 50px;">
                            <i class="fa-solid fa-code-pull-request fs-4"></i>
                        </div>
                        <h5 class="fw-bold text-navy mb-2" style="font-size: 1.05rem;">Code Review Tugas ala Dicoding</h5>
                        <p class="text-muted small mb-0" style="line-height: 1.7;">Bukan sekadar kuis pilihan ganda! Anda wajib mengirimkan repositori GitHub proyek asli yang diperiksa baris demi baris oleh tim Software Engineer.</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="pilar-card p-4 h-100 border-top border-4 border-success">
                        <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-3 p-3 mb-3" style="width: 50px; height: 50px;">
                            <i class="fa-solid fa-trophy fs-4"></i>
                        </div>
                        <h5 class="fw-bold text-navy mb-2" style="font-size: 1.05rem;">Hadiah untuk Proyek Terbaik</h5>
                        <p class="text-muted small mb-0" style="line-height: 1.7;">Setiap periode, 3 submission proyek terbaik yang paling rapi dan kreatif mendapatkan <strong>Hadiah Uang Tunai</strong> serta <strong>Tawaran Proyek Freelance Klien</strong>!</p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="pilar-card p-4 h-100 border-top border-4 border-danger">
                        <div class="d-inline-flex align-items-center justify-content-center bg-danger bg-opacity-10 text-danger rounded-3 p-3 mb-3" style="width: 50px; height: 50px;">
                            <i class="fa-solid fa-certificate fs-4"></i>
                        </div>
                        <h5 class="fw-bold text-navy mb-2" style="font-size: 1.05rem;">Sertifikat SKPI Berstandar Industri</h5>
                        <p class="text-muted small mb-0" style="line-height: 1.7;">Setelah proyek dinyatakan lulus verifikasi reviewer, Anda mendapatkan sertifikat resmi ber-QR Code untuk lampiran ijazah dan syarat kelulusan kampus.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================== -->
        <!-- 3. PILIHAN JALUR KELAS BOOTCAMP -->
        <!-- ============================================== -->
        <section id="pilihan-kelas" class="mb-5 pt-3">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
                <div>
                    <span class="badge bg-gold text-navy fw-bold px-3 py-1.5 rounded-pill mb-2 text-uppercase">Kurikulum 2026</span>
                    <h3 class="fw-bold font-heading text-navy mb-1">Pilihan Kelas Bootcamp Unggulan</h3>
                    <p class="text-muted small mb-0">Semua kelas menggunakan teknologi yang paling banyak dicari industri software dan instansi saat ini.</p>
                </div>
                <div class="mt-3 mt-md-0">
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2 rounded-pill small">
                        <i class="fa-solid fa-bolt me-1"></i> Kuota Reviewer Batch Aktif: <strong>Tersedia</strong>
                    </span>
                </div>
            </div>

            <div class="row g-4">
                <!-- KELAS 1: LARAVEL 10 & BLADE -->
                <div class="col-lg-6">
                    <div class="class-card">
                        <div class="class-card-header">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-warning text-navy fw-bold px-3 py-1.5 rounded-pill">PALING POPULER UNTUK SKRIPSI</span>
                                <span class="badge bg-white bg-opacity-20 text-white rounded-pill">12 Modul + 1 Proyek Akhir</span>
                            </div>
                            <h4 class="fw-bold mb-1 text-white font-heading">Fullstack Web Developer: Laravel 10 & Blade Template HTML5</h4>
                            <p class="text-white-50 small mb-0">Membangun Sistem Informasi Manajemen (SIM) standar instansi dari nol tanpa kerumitan framework SPA.</p>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <div class="mb-3">
                                <small class="text-muted d-block fw-bold text-uppercase mb-2" style="font-size: 0.75rem;">Tech Stack Utama:</small>
                                <div class="d-flex flex-wrap gap-1">
                                    <span class="badge bg-light text-navy border">PHP 8.2</span>
                                    <span class="badge bg-light text-navy border">Laravel 10</span>
                                    <span class="badge bg-light text-navy border">Blade HTML5</span>
                                    <span class="badge bg-light text-navy border">Bootstrap 5</span>
                                    <span class="badge bg-light text-navy border">MySQL</span>
                                    <span class="badge bg-light text-navy border">DomPDF</span>
                                    <span class="badge bg-light text-navy border">VPS Ubuntu</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block fw-bold text-uppercase mb-2" style="font-size: 0.75rem;">Tugas Submission Proyek Akhir:</small>
                                <div class="p-3 bg-light rounded-3 border small">
                                    <strong class="text-navy d-block mb-1"><i class="fa-solid fa-laptop-code text-primary me-1"></i> Sistem Informasi Desa Mandiri (SIDESA)</strong>
                                    Permohonan surat warga online, tracking NIK, export PDF tanda tangan digital & QR Code, serta infografis APBDes.
                                </div>
                            </div>

                            <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted text-decoration-line-through small">Rp 350.000</span>
                                    <div class="fs-4 fw-bold text-navy lh-1">Rp 149.000</div>
                                    <small class="text-success fw-semibold"><i class="fa-solid fa-infinity me-1"></i>Akses Selamanya</small>
                                </div>
                                <a href="bootcamp-register.php?path=laravel10" class="btn btn-warning fw-bold px-4 py-2.5 rounded-pill text-navy shadow-sm">
                                    Daftar Kelas &raquo;
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KELAS 2: FLUTTER & DART MOBILE -->
                <div class="col-lg-6">
                    <div class="class-card">
                        <div class="class-card-header" style="background: linear-gradient(135deg, #0369a1 0%, #0c4a6e 100%);">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-info text-dark fw-bold px-3 py-1.5 rounded-pill">MOBILE MULTIPLATFORM</span>
                                <span class="badge bg-white bg-opacity-20 text-white rounded-pill">10 Modul + 1 Proyek Akhir</span>
                            </div>
                            <h4 class="fw-bold mb-1 text-white font-heading">Mobile App Developer: Flutter 3 & Dart Multiplatform</h4>
                            <p class="text-white-50 small mb-0">Membangun aplikasi Android & iOS profesional terintegrasi REST API dan penyimpanan lokal.</p>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <div class="mb-3">
                                <small class="text-muted d-block fw-bold text-uppercase mb-2" style="font-size: 0.75rem;">Tech Stack Utama:</small>
                                <div class="d-flex flex-wrap gap-1">
                                    <span class="badge bg-light text-navy border">Flutter 3</span>
                                    <span class="badge bg-light text-navy border">Dart</span>
                                    <span class="badge bg-light text-navy border">Provider / Bloc</span>
                                    <span class="badge bg-light text-navy border">REST API</span>
                                    <span class="badge bg-light text-navy border">SQLite / Hive</span>
                                    <span class="badge bg-light text-navy border">Play Store Prep</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block fw-bold text-uppercase mb-2" style="font-size: 0.75rem;">Tugas Submission Proyek Akhir:</small>
                                <div class="p-3 bg-light rounded-3 border small">
                                    <strong class="text-navy d-block mb-1"><i class="fa-solid fa-mobile-screen text-info me-1"></i> Aplikasi Kasir Mobile & E-Commerce UMKM</strong>
                                    Manajemen katalog produk, keranjang belanja reaktif, sinkronisasi offline ke online, dan cetak invoice.
                                </div>
                            </div>

                            <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted text-decoration-line-through small">Rp 399.000</span>
                                    <div class="fs-4 fw-bold text-navy lh-1">Rp 179.000</div>
                                    <small class="text-success fw-semibold"><i class="fa-solid fa-infinity me-1"></i>Akses Selamanya</small>
                                </div>
                                <a href="bootcamp-register.php?path=flutter" class="btn btn-warning fw-bold px-4 py-2.5 rounded-pill text-navy shadow-sm">
                                    Daftar Kelas &raquo;
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KELAS 3: FRONTEND JAVASCRIPT & UI/UX -->
                <div class="col-lg-6">
                    <div class="class-card">
                        <div class="class-card-header" style="background: linear-gradient(135deg, #b45309 0%, #78350f 100%);">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-warning text-dark fw-bold px-3 py-1.5 rounded-pill">COCOK UNTUK PEMULA</span>
                                <span class="badge bg-white bg-opacity-20 text-white rounded-pill">8 Modul + 1 Proyek Akhir</span>
                            </div>
                            <h4 class="fw-bold mb-1 text-white font-heading">Frontend Web Engineer: Modern JavaScript, DOM & UI/UX</h4>
                            <p class="text-white-50 small mb-0">Kuasai logika JavaScript modern, manipulasi DOM, konsumsi API publik, dan desain web responsif.</p>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <div class="mb-3">
                                <small class="text-muted d-block fw-bold text-uppercase mb-2" style="font-size: 0.75rem;">Tech Stack Utama:</small>
                                <div class="d-flex flex-wrap gap-1">
                                    <span class="badge bg-light text-navy border">HTML5 Semantik</span>
                                    <span class="badge bg-light text-navy border">CSS3 Flex/Grid</span>
                                    <span class="badge bg-light text-navy border">JavaScript ES6+</span>
                                    <span class="badge bg-light text-navy border">Fetch API</span>
                                    <span class="badge bg-light text-navy border">Bootstrap 5</span>
                                    <span class="badge bg-light text-navy border">Git & GitHub</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block fw-bold text-uppercase mb-2" style="font-size: 0.75rem;">Tugas Submission Proyek Akhir:</small>
                                <div class="p-3 bg-light rounded-3 border small">
                                    <strong class="text-navy d-block mb-1"><i class="fa-solid fa-newspaper text-warning me-1"></i> Web Portal Publik Terintegrasi API & Filter Interaktif</strong>
                                    Website responsif dengan pencarian instan, filter data realtime, bookmark lokal, dan validasi form client-side.
                                </div>
                            </div>

                            <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted text-decoration-line-through small">Rp 250.000</span>
                                    <div class="fs-4 fw-bold text-navy lh-1">Rp 99.000</div>
                                    <small class="text-success fw-semibold"><i class="fa-solid fa-infinity me-1"></i>Akses Selamanya</small>
                                </div>
                                <a href="bootcamp-register.php?path=frontend" class="btn btn-warning fw-bold px-4 py-2.5 rounded-pill text-navy shadow-sm">
                                    Daftar Kelas &raquo;
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KELAS 4: BACKEND & LINUX CLOUD -->
                <div class="col-lg-6">
                    <div class="class-card">
                        <div class="class-card-header" style="background: linear-gradient(135deg, #15803d 0%, #14532d 100%);">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <span class="badge bg-success text-white fw-bold px-3 py-1.5 rounded-pill">ARSITEKTUR & SERVER</span>
                                <span class="badge bg-white bg-opacity-20 text-white rounded-pill">11 Modul + 1 Proyek Akhir</span>
                            </div>
                            <h4 class="fw-bold mb-1 text-white font-heading">Backend Specialist & Cloud Server Architecture</h4>
                            <p class="text-white-50 small mb-0">Membangun REST API performa tinggi, optimasi database relasional, dan administrasi VPS Linux Ubuntu.</p>
                        </div>
                        <div class="p-4 d-flex flex-column flex-grow-1">
                            <div class="mb-3">
                                <small class="text-muted d-block fw-bold text-uppercase mb-2" style="font-size: 0.75rem;">Tech Stack Utama:</small>
                                <div class="d-flex flex-wrap gap-1">
                                    <span class="badge bg-light text-navy border">PHP 8 OOP</span>
                                    <span class="badge bg-light text-navy border">MySQL Database Normalization</span>
                                    <span class="badge bg-light text-navy border">JWT Auth</span>
                                    <span class="badge bg-light text-navy border">Nginx Web Server</span>
                                    <span class="badge bg-light text-navy border">Linux Ubuntu VPS</span>
                                    <span class="badge bg-light text-navy border">SSL & Security Hardening</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <small class="text-muted d-block fw-bold text-uppercase mb-2" style="font-size: 0.75rem;">Tugas Submission Proyek Akhir:</small>
                                <div class="p-3 bg-light rounded-3 border small">
                                    <strong class="text-navy d-block mb-1"><i class="fa-solid fa-server text-success me-1"></i> Arsitektur RESTful API & Server Deployment Terverifikasi</strong>
                                    Sistem API otentikasi role-based, database indexing performa tinggi, dan server deployment dengan SSL aktif.
                                </div>
                            </div>

                            <div class="mt-auto pt-3 border-top d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="text-muted text-decoration-line-through small">Rp 350.000</span>
                                    <div class="fs-4 fw-bold text-navy lh-1">Rp 149.000</div>
                                    <small class="text-success fw-semibold"><i class="fa-solid fa-infinity me-1"></i>Akses Selamanya</small>
                                </div>
                                <a href="bootcamp-register.php?path=backend" class="btn btn-warning fw-bold px-4 py-2.5 rounded-pill text-navy shadow-sm">
                                    Daftar Kelas &raquo;
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================== -->
        <!-- 4. HADIAH & BEST PROJECT AWARD SHOWCASE -->
        <!-- ============================================== -->
        <section class="mb-5">
            <div class="card border-0 rounded-4 p-4 p-md-5 text-white" style="background: linear-gradient(135deg, #071a35 0%, #1e1b4b 50%, #431407 100%);">
                <div class="row align-items-center g-4">
                    <div class="col-lg-6">
                        <span class="badge bg-warning text-dark fw-bold px-3 py-1.5 rounded-pill mb-2">
                            <i class="fa-solid fa-trophy me-1"></i> APRESIASI & INSENTIF KARYA
                        </span>
                        <h2 class="fw-bold font-heading mb-3 text-white">Kompetisi Proyek Terbaik Setiap Periode</h2>
                        <p class="text-white-50" style="line-height: 1.8;">
                            Kami tidak hanya ingin Anda sekadar lulus. Kami ingin Anda menjadi developer unggul! Submission tugas akhir dinilai berdasarkan <strong>kualitas kode, kebersihan arsitektur, kreativitas fitur, dan ketuntasan sistem</strong>.
                        </p>
                        
                        <div class="d-flex flex-column gap-2 mb-4">
                            <div class="d-flex align-items-center gap-3 p-2 rounded-3 bg-white bg-opacity-10">
                                <span class="fs-4 text-warning">🥇</span>
                                <div>
                                    <strong class="d-block text-white" style="font-size: 0.95rem;">Juara 1: Dana Pembinaan Rp 1.500.000 + Kontrak Proyek Freelance Klien</strong>
                                    <small class="text-white-50">Langsung direkrut mengerjakan proyek nyata software house PT Skillance Digital Indonesia.</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 p-2 rounded-3 bg-white bg-opacity-10">
                                <span class="fs-4 text-secondary">🥈</span>
                                <div>
                                    <strong class="d-block text-white" style="font-size: 0.95rem;">Juara 2: Dana Pembinaan Rp 1.000.000 + Bundle Source Code Lengkap</strong>
                                    <small class="text-white-50">Seluruh paket e-book dan source code premium Skillance Academy.</small>
                                </div>
                            </div>
                            <div class="d-flex align-items-center gap-3 p-2 rounded-3 bg-white bg-opacity-10">
                                <span class="fs-4 text-warning opacity-75">🥉</span>
                                <div>
                                    <strong class="d-block text-white" style="font-size: 0.95rem;">Juara 3: Dana Pembinaan Rp 500.000 + Sertifikat Kehormatan</strong>
                                    <small class="text-white-50">Dipajang di Hall of Fame dan direkomendasikan ke bursa kerja mitra.</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="bg-white p-4 rounded-4 shadow-lg text-dark">
                            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                                <span class="badge bg-success bg-opacity-10 text-success fw-bold px-3 py-1 rounded-pill">
                                    <i class="fa-solid fa-star me-1"></i> Pemenang Batch Sebelumnya
                                </span>
                                <small class="text-muted">Periode Semester Ganjil 2026</small>
                            </div>

                            <div class="d-flex align-items-center gap-3 mb-3">
                                <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px; min-width: 48px;">
                                    <i class="fa-solid fa-user-graduate fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 text-navy">Muh. Arsyad Ramsi</h6>
                                    <small class="text-muted">Mahasiswa Teknik Informatika USN Kolaka</small>
                                </div>
                            </div>

                            <div class="p-3 bg-light rounded-3 mb-3 border">
                                <strong class="d-block text-navy small mb-1">Judul Proyek Submission:</strong>
                                <span class="fw-bold text-primary font-heading">Sistem Informasi Desa Mandiri & Layanan Surat Warga (SIDESA)</span>
                                <p class="text-muted small mb-0 mt-1">"Berhasil mengimplementasikan Laravel 10 dengan Blade HTML5, validasi NIK otomatis, dan generator PDF tanda tangan digital ber-QR Code dengan struktur kode yang sangat rapi."</p>
                            </div>

                            <div class="d-flex align-items-center justify-content-between small text-muted">
                                <span><i class="fa-solid fa-code-fork text-primary me-1"></i> Reviewer Score: <strong>98/100</strong></span>
                                <span class="badge bg-warning text-dark fw-bold px-2 py-1">Tawaran Kontrak Klien: Diterima</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================== -->
        <!-- 5. PORTAL INTERAKTIF SUBMISSION TUGAS SISWA -->
        <!-- ============================================== -->
        <section id="portal-submission" class="mb-5 pt-3">
            <div class="row g-4 align-items-start">
                <div class="col-lg-5">
                    <span class="badge bg-primary bg-opacity-10 text-primary fw-bold px-3 py-1.5 rounded-pill mb-2 text-uppercase">Code Review ala Dicoding</span>
                    <h3 class="fw-bold font-heading text-navy">Portal Pengumpulan Tugas & Submission Proyek</h3>
                    <p class="text-muted small" style="line-height: 1.8;">
                        Sudah menyelesaikan proyek bootcamp Anda? Kirimkan tautan repositori GitHub di sini untuk ditinjau oleh software engineer kami.
                    </p>

                    <div class="d-flex flex-column gap-3 mb-4">
                        <div class="d-flex gap-3">
                            <span class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle fw-bold" style="width: 32px; height: 32px; min-width: 32px;">1</span>
                            <div>
                                <strong class="text-navy d-block small">Push Kode ke GitHub / GitLab</strong>
                                <small class="text-muted">Pastikan repositori diset <em>Public</em> dan memiliki file <code>README.md</code> penjelasan arsitektur serta cara instalasi.</small>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <span class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle fw-bold" style="width: 32px; height: 32px; min-width: 32px;">2</span>
                            <div>
                                <strong class="text-navy d-block small">Kirim Formulir Submission</strong>
                                <small class="text-muted">Isi data lengkap di samping. Sistem akan menghasilkan nomor resi tracking evaluasi kode.</small>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <span class="d-inline-flex align-items-center justify-content-center bg-primary text-white rounded-circle fw-bold" style="width: 32px; height: 32px; min-width: 32px;">3</span>
                            <div>
                                <strong class="text-navy d-block small">Reviewer Mengecek Kode (1x24 Jam)</strong>
                                <small class="text-muted">Jika ada catatan revisi, Anda diberikan kesempatan memperbaiki. Jika memenuhi standar, Anda langsung dinyatakan <strong>Lulus</strong>!</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FORM SUBMISSION -->
                <div class="col-lg-7">
                    <div class="card p-4 p-md-5 rounded-4 border shadow-sm bg-white">
                        <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
                            <div>
                                <h5 class="fw-bold text-navy mb-0">Formulir Pengumpulan Tugas</h5>
                                <small class="text-muted">Kirimkan link tugas akhir Anda untuk di-review</small>
                            </div>
                            <span class="badge badge-dicoding px-3 py-1.5 rounded-pill small">
                                <i class="fa-solid fa-code me-1"></i> Reviewer Online
                            </span>
                        </div>

                        <form id="bootcampSubmissionForm" onsubmit="handleBootcampSubmit(event)">
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-navy">Nama Lengkap Siswa <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" id="subNama" class="form-control rounded-3" placeholder="Nama sesuai sertifikat" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-navy">Email Terdaftar <span class="text-danger">*</span></label>
                                    <input type="email" name="email" id="subEmail" class="form-control rounded-3" placeholder="email@gmail.com" required>
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-navy">Nomor WhatsApp Aktif <span class="text-danger">*</span></label>
                                    <input type="tel" name="whatsapp" id="subWa" class="form-control rounded-3" placeholder="0822xxxxxxxx" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-navy">Pilih Jalur Bootcamp <span class="text-danger">*</span></label>
                                    <select name="kelas" id="subKelas" class="form-select rounded-3" required>
                                        <option value="">-- Pilih Kelas --</option>
                                        <option value="Fullstack Web Developer: Laravel 10 & Blade HTML5">Fullstack Web Developer: Laravel 10 & Blade HTML5</option>
                                        <option value="Mobile App Developer: Flutter 3 & Dart Multiplatform">Mobile App Developer: Flutter 3 & Dart Multiplatform</option>
                                        <option value="Frontend Web Engineer: Modern JavaScript, DOM & UI/UX">Frontend Web Engineer: Modern JavaScript, DOM & UI/UX</option>
                                        <option value="Backend Specialist & Cloud Server Architecture">Backend Specialist & Cloud Server Architecture</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-navy">Judul Proyek yang Dibangun <span class="text-danger">*</span></label>
                                <input type="text" name="judul" id="subJudul" class="form-control rounded-3" placeholder="Contoh: Sistem Informasi Desa Mandiri (SIDESA)" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-navy">Tautan Repositori GitHub Proyek <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-brands fa-github text-dark"></i></span>
                                    <input type="url" name="github" id="subGithub" class="form-control" placeholder="https://github.com/username/project-repository" required>
                                </div>
                                <small class="text-muted" style="font-size: 0.72rem;">Pastikan repositori publik dan dapat di-clone oleh tim reviewer.</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label small fw-bold text-navy">Tautan Demo Live / Hosting (Opsional)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-globe text-primary"></i></span>
                                    <input type="url" name="demo" id="subDemo" class="form-control" placeholder="https://proyek-saya.my.id (jika sudah di-hosting)">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label small fw-bold text-navy">Catatan untuk Reviewer (Fitur Unggulan, Akun Demo, dsb.)</label>
                                <textarea name="catatan" id="subCatatan" class="form-control rounded-3" rows="3" placeholder="Tuliskan kredensial login admin demo jika ada, atau kendala spesifik yang ingin dimintai saran reviewer..."></textarea>
                            </div>

                            <button type="submit" id="btnSubmitTask" class="btn btn-warning w-100 fw-bold py-3 rounded-pill text-navy shadow-sm d-flex align-items-center justify-content-center gap-2" style="background-color: #fca311 !important;">
                                <i class="fa-solid fa-paper-plane"></i> Kirim Submission Tugas untuk Code Review &raquo;
                            </button>
                        </form>

                        <div id="subAlertContainer" class="mt-4" style="display: none;"></div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================== -->
        <!-- 6. FAQ LENGKAP TENTANG BOOTCAMP -->
        <!-- ============================================== -->
        <section class="mb-5">
            <div class="text-center mb-4 mx-auto" style="max-width: 650px;">
                <span class="badge bg-gold-subtle text-navy fw-bold px-3 py-1.5 rounded-pill mb-2 text-uppercase">Tanya Jawab</span>
                <h3 class="fw-bold font-heading text-navy">Pertanyaan yang Sering Diajukan (FAQ)</h3>
            </div>

            <div class="accordion accordion-flush shadow-sm rounded-4 bg-white p-3 border" id="faqBootcamp">
                <div class="accordion-item border-bottom py-2">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold text-navy" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Apakah benar-benar Cukup Sekali Bayar dan Akses Selamanya?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqBootcamp">
                        <div class="accordion-body small text-muted" style="line-height: 1.8;">
                            <strong>Ya, 100% benar.</strong> Di Skillance Academy, kami tidak menerapkan sistem langganan bulanan yang mencekik mahasiswa. Cukup satu kali membayar pendaftaran kelas, Anda mendapatkan akses selamanya ke modul teks, video screencast, source code referensi, forum tanya-jawab, serta kesempatan pengumpulan tugas submission.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-bottom py-2">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold text-navy" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Bagaimana alur Code Review seperti di Dicoding?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqBootcamp">
                        <div class="accordion-body small text-muted" style="line-height: 1.8;">
                            Setelah Anda menyelesaikan tugas proyek, Anda mengirimkan link repositori GitHub melalui formulir di atas. Tim Software Engineer Skillance akan memeriksa kode Anda: struktur database, penggunaan best-practice (Clean Code, penamaan variabel, penanganan error, validasi form, keamanan SQL Injection/XSS). Jika masih ada kekurangan, reviewer akan memberikan panduan revisi. Jika sudah sesuai standar industri, Anda langsung dinyatakan <strong>Lulus</strong> dan sertifikat diterbitkan.
                        </div>
                    </div>
                </div>

                <div class="accordion-item border-bottom py-2">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold text-navy" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            Kapan Hadiah Proyek Terbaik diumumkan?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqBootcamp">
                        <div class="accordion-body small text-muted" style="line-height: 1.8;">
                            Hadiah Proyek Terbaik (Best Project Award) dievaluasi setiap akhir kuartal / semester. Karya siswa yang paling rapi, fungsional, dan memiliki dampak nyata (misalnya sistem desa, kasir UMKM, toko online) akan dipilih oleh tim juri software engineer kami untuk menerima dana pembinaan dan tawaran kontrak proyek freelance berbayar.
                        </div>
                    </div>
                </div>

                <div class="accordion-item py-2">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed fw-bold text-navy" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                            Apakah sertifikat kelulusan bisa dilampirkan untuk SKPI kampus?
                        </button>
                    </h2>
                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqBootcamp">
                        <div class="accordion-body small text-muted" style="line-height: 1.8;">
                            <strong>Sangat bisa!</strong> Setiap sertifikat kelulusan Skillance Academy dilengkapi nomor seri unik, jam pelatihan standar industri, dan QR Code verifikasi online yang bisa dicek langsung di halaman <a href="verify.php" class="text-primary fw-bold">Validasi Sertifikat</a>. Sertifikat ini diakui untuk poin Surat Keterangan Pendamping Ijazah (SKPI) di berbagai perguruan tinggi.
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER MASTER ACADEMY -->
    <?php include __DIR__ . '/includes/footer.php'; ?>

    <!-- SUBMISSION HANDLING SCRIPT -->
    <script>
    function handleBootcampSubmit(e) {
        e.preventDefault();
        const btn = document.getElementById('btnSubmitTask');
        const alertBox = document.getElementById('subAlertContainer');
        const originalText = btn.innerHTML;

        btn.disabled = true;
        btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-2"></i> Mengirimkan ke Sistem Reviewer...';

        const payload = {
            nama: document.getElementById('subNama').value,
            email: document.getElementById('subEmail').value,
            whatsapp: document.getElementById('subWa').value,
            kelas: document.getElementById('subKelas').value,
            judul: document.getElementById('subJudul').value,
            github: document.getElementById('subGithub').value,
            demo: document.getElementById('subDemo').value,
            catatan: document.getElementById('subCatatan').value
        };

        fetch('api/submit_bootcamp_task.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(payload)
        })
        .then(res => res.json())
        .then(res => {
            btn.disabled = false;
            btn.innerHTML = originalText;

            if (res.status === 'success') {
                const d = res.data;
                alertBox.style.display = 'block';
                alertBox.innerHTML = `
                    <div class="alert alert-success border-0 shadow-sm p-4 rounded-4">
                        <div class="d-flex align-items-center gap-3 mb-2">
                            <i class="fa-solid fa-circle-check text-success fs-3"></i>
                            <div>
                                <h6 class="fw-bold mb-0 text-navy">Tugas Proyek Berhasil Dikumpulkan!</h6>
                                <small class="text-muted">Kode Evaluasi: <strong class="badge bg-navy text-white">${d.submission_code}</strong></small>
                            </div>
                        </div>
                        <p class="small text-muted mb-3" style="line-height: 1.7;">
                            Tugas Anda pada kelas <strong>${d.kelas_bootcamp}</strong> telah berhasil masuk antrean review. Tim Software Engineer akan menguji kode Anda dalam 1x24 jam kerja. Hasil evaluasi dan sertifikat akan dikonfirmasi via WhatsApp/Email.
                        </p>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="https://wa.me/6282291700778?text=${encodeURIComponent('Halo Admin Skillance, saya baru saja mengumpulkan submission tugas bootcamp dengan Kode: ' + d.submission_code + '. Mohon konfirmasi.')}" target="_blank" class="btn btn-sm btn-success rounded-pill px-3 fw-bold">
                                <i class="fa-brands fa-whatsapp me-1"></i> Konfirmasi ke WA Tim Reviewer
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="document.getElementById('bootcampSubmissionForm').reset(); document.getElementById('subAlertContainer').style.display='none';">
                                Kirim Tugas Lain
                            </button>
                        </div>
                    </div>
                `;
                document.getElementById('bootcampSubmissionForm').reset();
                alertBox.scrollIntoView({ behavior: 'smooth' });
            } else {
                alertBox.style.display = 'block';
                alertBox.innerHTML = `
                    <div class="alert alert-danger border-0 shadow-sm p-3 rounded-3">
                        <i class="fa-solid fa-triangle-exclamation me-1"></i> ${res.message || 'Gagal mengirimkan tugas. Silakan cek kembali form Anda.'}
                    </div>
                `;
            }
        })
        .catch(err => {
            btn.disabled = false;
            btn.innerHTML = originalText;
            alertBox.style.display = 'block';
            alertBox.innerHTML = `
                <div class="alert alert-danger border-0 shadow-sm p-3 rounded-3">
                    <i class="fa-solid fa-triangle-exclamation me-1"></i> Terjadi kesalahan jaringan. Mohon coba sesaat lagi atau hubungi WhatsApp Admin.
                </div>
            `;
        });
    }
    </script>
</body>
</html>
