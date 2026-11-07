<?php
/**
 * Custom 404 Error Page for Skillance Academy Indonesia
 */
// http_response_code(404);
session_start();

$activeNav = '';
$showSubnav = false;

// Master SEO Configuration
$seoTitle = '404 - Halaman Tidak Ditemukan | Skillance Academy Indonesia';
$seoDesc = 'Halaman atau modul pembelajaran yang Anda cari tidak ditemukan di Skillance Academy Indonesia. Temukan kurikulum koding, roadmap belajar, dan sertifikasi SKPI kami.';
$seoKeywords = '404 skillance academy, halaman tidak ditemukan, belajar coding indonesia';
$seoOgImage = 'https://academy.skillance.cloud/assets/img/og-academy.png';
$seoCanonical = 'https://academy.skillance.cloud/404.php';
$seoType = 'website';
$seoBreadcrumbs = [
    ['name' => 'Beranda', 'url' => 'https://academy.skillance.cloud/index.php'],
    ['name' => '404 Tidak Ditemukan', 'url' => 'https://academy.skillance.cloud/404.php']
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include __DIR__ . '/includes/seo_meta.php'; ?>

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
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
        .error-hero-card {
            background: linear-gradient(135deg, #0d2e5c 0%, #071a35 100%);
            border-radius: 24px;
            color: white;
            padding: 50px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .error-code {
            font-family: 'Fira Code', monospace;
            font-size: 5.5rem;
            font-weight: 800;
            line-height: 1;
            letter-spacing: -2px;
            background: linear-gradient(135deg, #fca311 0%, #ffd166 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .quick-nav-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px;
            height: 100%;
            transition: all 0.25s ease;
            text-decoration: none;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .quick-nav-card:hover {
            transform: translateY(-4px);
            border-color: #fca311;
            box-shadow: 0 10px 25px rgba(13, 46, 92, 0.08);
        }
    </style>
</head>
<body>

    <?php include __DIR__ . '/includes/navbar.php'; ?>

    <main class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <!-- ERROR HERO BANNER -->
                <div class="error-hero-card mb-5 shadow-lg">
                    <span class="badge bg-gold text-navy fw-bold px-3 py-2 rounded-pill mb-3 text-uppercase shadow-sm" style="background-color: #fca311 !important; color: #071a35 !important; font-size: 0.78rem;">
                        <i class="fa-solid fa-triangle-exclamation me-1"></i> Error 404 &bull; Page Not Found
                    </span>
                    <div class="error-code mb-2">404</div>
                    <h1 class="display-6 fw-bold font-heading mb-3 text-white">Modul atau Halaman Tidak Ditemukan</h1>
                    <p class="mx-auto mb-4 text-white-50" style="max-width: 620px; font-size: 1.02rem; line-height: 1.7;">
                        Tautan yang Anda tuju mungkin salah ketik, telah digantikan dengan silabus baru, atau sedang dalam pembaharuan sistem akademik.
                    </p>

                    <!-- SEARCH BAR TRIGGER -->
                    <div class="mx-auto mb-4" style="max-width: 520px;">
                        <div class="input-group input-group-lg shadow-sm" style="cursor: pointer;" onclick="document.dispatchEvent(new KeyboardEvent('keydown', {'key': 'k', 'ctrlKey': true}));">
                            <span class="input-group-text bg-white border-end-0 text-muted ps-3"><i class="fa-solid fa-magnifying-glass text-warning"></i></span>
                            <input type="text" class="form-control border-start-0 border-end-0 bg-white" placeholder="Cari materi koding (HTML, CSS, PHP, Flutter...)" readonly style="cursor: pointer;">
                            <span class="input-group-text bg-white border-start-0 pe-3"><kbd class="bg-light text-muted border px-2 py-1 small">Ctrl + K</kbd></span>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center gap-3">
                        <a href="index.php" class="btn btn-warning btn-lg fw-bold px-4 py-3 rounded-pill text-navy shadow">
                            <i class="fa-solid fa-house me-2"></i> Kembali ke Beranda &raquo;
                        </a>
                        <a href="roadmap.php" class="btn btn-outline-light btn-lg fw-bold px-4 py-3 rounded-pill">
                            <i class="fa-solid fa-map-location-dot me-2 text-warning"></i> Buka Roadmap Belajar
                        </a>
                    </div>
                </div>

                <!-- RECOMMENDED DESTINATIONS -->
                <div class="mb-4 text-center">
                    <h4 class="fw-bold text-navy font-heading mb-1">Destinasi Populer yang Mungkin Anda Butuhkan</h4>
                    <p class="text-muted small">Pilih salah satu menu di bawah ini untuk melanjutkan aktivitas belajar Anda:</p>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6 col-lg-3">
                        <a href="learn.php?c=html" class="quick-nav-card">
                            <div>
                                <div class="bg-primary bg-opacity-10 text-primary p-3 rounded-3 d-inline-flex mb-3">
                                    <i class="fa-solid fa-book-open fs-4"></i>
                                </div>
                                <h5 class="fw-bold text-navy mb-1">Materi Interaktif</h5>
                                <p class="text-muted small mb-0">90+ modul koding mandiri langsung coba di browser.</p>
                            </div>
                            <span class="text-primary fw-bold small mt-3">Mulai Belajar &raquo;</span>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <a href="exam.php" class="quick-nav-card">
                            <div>
                                <div class="bg-success bg-opacity-10 text-success p-3 rounded-3 d-inline-flex mb-3">
                                    <i class="fa-solid fa-award fs-4"></i>
                                </div>
                                <h5 class="fw-bold text-navy mb-1">Ujian SKPI</h5>
                                <p class="text-muted small mb-0">Uji kompetensi teknis dan raih sertifikat digital resmi.</p>
                            </div>
                            <span class="text-success fw-bold small mt-3">Ambil Ujian &raquo;</span>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <a href="projects.php" class="quick-nav-card">
                            <div>
                                <div class="bg-warning bg-opacity-10 text-warning p-3 rounded-3 d-inline-flex mb-3">
                                    <i class="fa-solid fa-laptop-code fs-4"></i>
                                </div>
                                <h5 class="fw-bold text-navy mb-1">Kit Proyek E-Book</h5>
                                <p class="text-muted small mb-0">Source code studi kasus nyata siap pakai untuk portofolio.</p>
                            </div>
                            <span class="text-warning fw-bold small mt-3">Buka Katalog &raquo;</span>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-3">
                        <a href="verify.php" class="quick-nav-card">
                            <div>
                                <div class="bg-info bg-opacity-10 text-info p-3 rounded-3 d-inline-flex mb-3">
                                    <i class="fa-solid fa-shield-halved fs-4"></i>
                                </div>
                                <h5 class="fw-bold text-navy mb-1">Cek Sertifikat</h5>
                                <p class="text-muted small mb-0">Validasi keaslian sertifikat kelulusan secara realtime.</p>
                            </div>
                            <span class="text-info fw-bold small mt-3">Verifikasi &raquo;</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php include_once __DIR__ . '/includes/spotlight_modal.php'; ?>
    <script src="assets/js/spotlight.js"></script>
</body>
</html>
