<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/config/config.php';

$jobId = intval($_GET['id'] ?? 0);
$isLoggedIn = isset($_SESSION['user_id']);
$userRole   = $_SESSION['user_role'] ?? '';
$userId     = $isLoggedIn ? intval($_SESSION['user_id']) : 0;

if ($jobId <= 0) {
    header("Location: freelance.html");
    exit();
}

// Ambil data pekerjaan dari database
$stmt = $conn->prepare("
    SELECT j.*, DATEDIFF(j.deadline, CURDATE()) as days_left,
           (SELECT COUNT(*) FROM freelance_assignments a WHERE a.job_id = j.id AND a.freelancer_id = ?) as has_applied,
           (SELECT a.status FROM freelance_assignments a WHERE a.job_id = j.id AND a.freelancer_id = ? LIMIT 1) as my_task_status
    FROM freelance_jobs j
    WHERE j.id = ? LIMIT 1
");
$stmt->bind_param("iii", $userId, $userId, $jobId);
$stmt->execute();
$res = $stmt->get_result();
$job = $res->fetch_assoc();
$stmt->close();

$jobFound = ($job !== null);

// Data untuk SEO & Social Media Card
if ($jobFound) {
    $jobTitle    = $job['title'];
    $rewardNum   = floatval($job['reward_amount']);
    $rewardText  = 'Rp ' . number_format($rewardNum, 0, ',', '.');
    $category    = $job['category'];
    $target      = ucfirst($job['target_audience']);
    $deadline    = date('d F Y', strtotime($job['deadline']));
    $daysLeft    = intval($job['days_left']);
    $desc        = trim($job['description']);
    $reqs        = trim($job['requirements'] ?? '');
    $pageUrl     = "https://skillance.my.id/job.php?id=" . $job['id'];
    $ogImgUrl    = "https://skillance.my.id/api/og_job.php?id=" . $job['id'];

    $pageTitle   = "[Lowongan Freelance] " . $jobTitle . " (Fee " . $rewardText . ") | Skillance";
    $ogTitle     = "[Freelance] " . $jobTitle . " (Fee " . $rewardText . ")";
    $ogDesc      = "Imbalan / Fee: " . $rewardText . " | Kategori: " . $category . " | Target: " . $target . ". Batas pengerjaan: " . $deadline . ". Klik untuk baca rincian tugas dan ambil pekerjaan di Skillance!";
    
    // WA share text
    $waShareText = urlencode("Halo! Ada info lowongan freelance di Skillance:\n\n📌 *" . $jobTitle . "*\n💰 Fee: *" . $rewardText . "*\n🎯 Kategori: " . $category . " (" . $target . ")\n⏰ Batas: " . $deadline . "\n\nCek detail tugas & ambil pekerjaan ini langsung di:\n" . $pageUrl);
} else {
    $pageTitle   = "Lowongan Tidak Ditemukan | Skillance Freelance";
    $ogTitle     = "Bursa Lowongan Freelance | Skillance Indonesia";
    $ogDesc      = "Cari dan ambil lowongan freelance digital untuk mahasiswa dan umum di Skillance.";
    $ogImgUrl    = "https://skillance.my.id/assets/img/og-preview.png";
    $pageUrl     = "https://skillance.my.id/freelance.html";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <meta name="description" content="<?= htmlspecialchars($ogDesc) ?>">
    <meta name="keywords" content="lowongan freelance, <?= htmlspecialchars($job['category'] ?? 'pekerjaan') ?>, freelance mahasiswa, freelance sultra, cv skillance digital indonesia">
    <meta name="author" content="CV Skillance Digital Indonesia">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1">
    <link rel="canonical" href="<?= htmlspecialchars($pageUrl) ?>">

    <!-- Open Graph (WhatsApp, Facebook, LinkedIn, Telegram) -->
    <meta property="og:locale" content="id_ID">
    <meta property="og:type" content="article">
    <meta property="og:site_name" content="Skillance Digital Indonesia">
    <meta property="og:title" content="<?= htmlspecialchars($ogTitle) ?>">
    <meta property="og:description" content="<?= htmlspecialchars($ogDesc) ?>">
    <meta property="og:image" content="<?= htmlspecialchars($ogImgUrl) ?>">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="<?= htmlspecialchars($ogTitle) ?>">
    <meta property="og:url" content="<?= htmlspecialchars($pageUrl) ?>">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= htmlspecialchars($ogTitle) ?>">
    <meta name="twitter:description" content="<?= htmlspecialchars($ogDesc) ?>">
    <meta name="twitter:image" content="<?= htmlspecialchars($ogImgUrl) ?>">

    <?php if ($jobFound): ?>
    <!-- Structured Data (JSON-LD JobPosting) -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "JobPosting",
      "title": <?= json_encode($jobTitle) ?>,
      "description": <?= json_encode($desc) ?>,
      "datePosted": <?= json_encode($job['created_at']) ?>,
      "validThrough": <?= json_encode($job['deadline'] . "T23:59:59+08:00") ?>,
      "employmentType": "CONTRACTOR",
      "hiringOrganization": {
        "@type": "Organization",
        "name": "CV Skillance Digital Indonesia",
        "sameAs": "https://skillance.my.id",
        "logo": "https://skillance.my.id/assets/img/favicon.png"
      },
      "jobLocationType": "TELECOMMUTE",
      "applicantLocationRequirements": {
        "@type": "Country",
        "name": "Indonesia"
      },
      "baseSalary": {
        "@type": "MonetaryAmount",
        "currency": "IDR",
        "value": {
          "@type": "QuantitativeValue",
          "value": <?= $rewardNum ?>,
          "unitText": "PROJECT"
        }
      }
    }
    </script>
    <?php endif; ?>

    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background-color: #f8fafc;">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-xl fixed-top transition-all" id="mainNavbar">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.html">
                <i class="fa-solid fa-code text-gold fs-4"></i>
                <div class="d-flex flex-column">
                    <span class="fw-bold lh-1">SKILLANCE</span>
                    <span class="small text-muted" style="font-size: 0.65rem; letter-spacing: 1px;">DIGITAL INDONESIA</span>
                </div>
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-xl-center gap-xl-1 gap-xxl-2 text-center text-xl-start mt-3 mt-xl-0">
                    <li class="nav-item"><a class="nav-link" href="index.html">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.html">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link" href="services.html">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="portfolio.html">Karya Kami</a></li>
                    <li class="nav-item"><a class="nav-link active text-gold fw-bold" href="freelance.html"><i class="fa-solid fa-briefcase text-gold me-1"></i> Bursa Freelance</a></li>
                    <li class="nav-item"><a class="nav-link" href="academy.html">Academy</a></li>
                    <li class="nav-item"><a class="nav-link" href="blog.html">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.html">Kontak</a></li>

                    <li class="nav-item mt-3 mt-xl-0 ms-xl-2">
                        <a href="contact.html" class="btn btn-navbar-cta w-100 w-xl-auto">Mulai Konsultasi</a>
                    </li>
                    <li class="nav-item mt-2 mt-xl-0 ms-xl-1">
                        <?php if ($isLoggedIn): ?>
                            <a href="dashboard/freelancer/index.php" class="btn btn-navbar-auth w-100 w-xl-auto">
                                <i class="fa-solid fa-gauge me-1"></i> Dashboard
                            </a>
                        <?php else: ?>
                            <a href="auth/index.php" class="btn btn-navbar-auth w-100 w-xl-auto">
                                <i class="fa-brands fa-google me-1"></i> Masuk / Freelance
                            </a>
                        <?php endif; ?>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Header Banner -->
    <header class="page-header-banner">
        <div class="container">
            <span class="badge bg-gold text-navy fw-bold px-3 py-2 rounded-pill mb-3 text-uppercase">
                <i class="fa-solid fa-briefcase me-1"></i> Detail Lowongan Freelance
            </span>
            <h1 class="display-6 fw-bold font-heading mb-2 text-white">Detail & Spesifikasi Tugas</h1>
            <p class="lead mx-auto mb-0" style="max-width: 680px; color: #e2e8f0;">
                Pelajari kriteria, batas waktu pengerjaan, dan besaran imbalan proyek.
            </p>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-5">
        <div class="container">

            <div class="mb-4">
                <a href="freelance.html" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Bursa Lowongan
                </a>
            </div>

            <?php if (!$jobFound): ?>
                <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white my-4">
                    <i class="fa-solid fa-circle-exclamation text-warning fs-1 mb-3"></i>
                    <h3 class="fw-bold text-navy mb-2">Pekerjaan Tidak Ditemukan</h3>
                    <p class="text-muted mb-4">Lowongan ini mungkin sudah selesai, dibatalkan, atau batas waktunya telah berakhir.</p>
                    <div>
                        <a href="freelance.html" class="btn btn-gold fw-bold px-4 py-2 rounded-pill">
                            Lihat Lowongan Lainnya
                        </a>
                    </div>
                </div>
            <?php else: ?>

                <div class="row g-4">
                    <!-- Left: Job Details -->
                    <div class="col-lg-8">
                        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white">
                            
                            <!-- Badges -->
                            <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                                <span class="badge bg-navy-subtle text-navy border px-3 py-2 fs-6">
                                    <i class="fa-solid fa-tag text-gold me-1"></i> <?= htmlspecialchars($category) ?>
                                </span>
                                <span class="badge bg-primary px-3 py-2 fs-6 text-capitalize">
                                    <i class="fa-solid fa-users me-1"></i> Target: <?= htmlspecialchars($target) ?>
                                </span>
                                <?php if ($daysLeft >= 0): ?>
                                    <span class="badge bg-light text-muted border px-3 py-2 fs-6">
                                        <i class="fa-regular fa-clock text-warning me-1"></i> Batas: <?= $deadline ?> (<?= $daysLeft ?> hari lagi)
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-danger text-white px-3 py-2 fs-6">
                                        <i class="fa-solid fa-triangle-exclamation me-1"></i> Lewat Deadline
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Title -->
                            <h2 class="fw-bold text-navy font-heading mb-4" style="line-height: 1.35;">
                                <?= htmlspecialchars($jobTitle) ?>
                            </h2>

                            <!-- Fee Highlight Card -->
                            <div class="card border-0 rounded-4 p-4 mb-4" style="background: linear-gradient(135deg, #0d2e5c 0%, #1a447e 100%); color: white;">
                                <div class="row align-items-center g-3">
                                    <div class="col-md-7">
                                        <small class="text-gold fw-bold text-uppercase d-block" style="letter-spacing: 1px;">Imbalan / Fee Pekerjaan</small>
                                        <div class="display-6 fw-bold text-white mb-1"><?= $rewardText ?></div>
                                        <small class="text-light" style="color: #cbd5e1 !important;">
                                            <i class="fa-solid fa-shield-halved text-gold me-1"></i> Ditransfer manual langsung oleh Admin ke rekening Anda setelah tugas disetujui.
                                        </small>
                                    </div>
                                    <div class="col-md-5 text-md-end">
                                        <span class="badge bg-gold text-navy fw-bold px-3 py-2 rounded-pill fs-6">
                                            <i class="fa-solid fa-money-bill-transfer me-1"></i> Transfer Manual
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="mb-4">
                                <h5 class="fw-bold text-navy mb-3">
                                    <i class="fa-solid fa-align-left text-gold me-2"></i> Rincian Tugas & Deskripsi:
                                </h5>
                                <div class="text-body" style="line-height: 1.85; font-size: 1.05rem; white-space: pre-line;">
                                    <?= htmlspecialchars($desc) ?>
                                </div>
                            </div>

                            <!-- Requirements -->
                            <?php if (!empty($reqs)): ?>
                            <div class="mb-4 pt-3 border-top">
                                <h5 class="fw-bold text-navy mb-3">
                                    <i class="fa-solid fa-list-check text-gold me-2"></i> Kriteria & Syarat Pengerjaan:
                                </h5>
                                <div class="text-body bg-light p-3 rounded-3" style="line-height: 1.8; font-size: 0.95rem; white-space: pre-line;">
                                    <?= htmlspecialchars($reqs) ?>
                                </div>
                            </div>
                            <?php endif; ?>

                            <!-- Action Box -->
                            <div class="pt-4 border-top">
                                <?php if ($job['has_applied'] > 0): ?>
                                    <div class="alert alert-info d-flex align-items-center gap-3 p-3 rounded-3 mb-0">
                                        <i class="fa-solid fa-circle-check fs-2 text-primary"></i>
                                        <div>
                                            <h6 class="fw-bold mb-1">Anda Sudah Mengambil Pekerjaan Ini</h6>
                                            <p class="small mb-2 text-muted">Status pengerjaan saat ini: <strong><?= strtoupper($job['my_task_status'] ?? 'Sedang Berjalan') ?></strong>.</p>
                                            <a href="dashboard/freelancer/my_tasks.php" class="btn btn-sm btn-primary rounded-pill px-3 fw-bold">
                                                Buka di Dashboard Saya
                                            </a>
                                        </div>
                                    </div>
                                <?php elseif ($isLoggedIn): ?>
                                    <div class="p-3 bg-light rounded-4 text-center text-md-start d-md-flex align-items-center justify-content-between gap-3">
                                        <div>
                                            <h6 class="fw-bold text-navy mb-1">Siap Mengerjakan Tugas Ini?</h6>
                                            <small class="text-muted">Tugas akan langsung masuk ke Dashboard Freelancer Anda.</small>
                                        </div>
                                        <button class="btn btn-gold btn-lg fw-bold rounded-pill px-4 mt-3 mt-md-0 shadow-sm" id="btnTakeJobDirect" onclick="takeJobAction(<?= $job['id'] ?>)">
                                            <i class="fa-solid fa-handshake me-1"></i> Ambil Pekerjaan Sekarang
                                        </button>
                                    </div>
                                <?php else: ?>
                                    <div class="p-4 rounded-4 text-center" style="background-color: #f1f5f9; border: 1.5px dashed #cbd5e1;">
                                        <h5 class="fw-bold text-navy mb-2">Tertarik Mengambil Tugas Ini?</h5>
                                        <p class="text-muted small mb-3">
                                            Masuk dengan Akun Google untuk mengakses dashboard pengerjaan dan menerima transfer fee Anda.
                                        </p>
                                        <a href="auth/google_login.php?redirect=job.php?id=<?= $job['id'] ?>" class="btn btn-gold btn-lg fw-bold rounded-pill px-4 shadow-sm">
                                            <i class="fa-brands fa-google me-2"></i> Masuk dengan Google & Ambil Tugas
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>

                    <!-- Right Sidebar: Share & Info -->
                    <div class="col-lg-4">
                        
                        <!-- Share Card -->
                        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                            <h6 class="fw-bold text-navy mb-3">
                                <i class="fa-solid fa-share-nodes text-gold me-2"></i> Bagikan Lowongan Ini
                            </h6>
                            <p class="small text-muted mb-3">
                                Bagikan ke teman, grup mahasiswa, atau kenalan Anda di media sosial:
                            </p>

                            <!-- Social Share Buttons -->
                            <div class="d-flex flex-column gap-2">
                                <a href="https://api.whatsapp.com/send?text=<?= $waShareText ?>" target="_blank" class="btn btn-success fw-bold py-2 rounded-pill d-flex align-items-center justify-content-center gap-2">
                                    <i class="fa-brands fa-whatsapp fs-5"></i> Bagikan ke WhatsApp
                                </a>

                                <a href="https://t.me/share/url?url=<?= urlencode($pageUrl) ?>&text=<?= urlencode('Info Lowongan Freelance: ' . $jobTitle . ' (Fee ' . $rewardText . ')') ?>" target="_blank" class="btn btn-info text-white fw-bold py-2 rounded-pill d-flex align-items-center justify-content-center gap-2">
                                    <i class="fa-brands fa-telegram fs-5"></i> Bagikan ke Telegram
                                </a>

                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode($pageUrl) ?>" target="_blank" class="btn btn-primary fw-bold py-2 rounded-pill d-flex align-items-center justify-content-center gap-2">
                                    <i class="fa-brands fa-facebook-f"></i> Bagikan ke Facebook
                                </a>

                                <button class="btn btn-outline-dark fw-semibold py-2 rounded-pill d-flex align-items-center justify-content-center gap-2" onclick="copyJobLink()">
                                    <i class="fa-regular fa-copy"></i> Salin Tautan Lowongan
                                </button>
                            </div>
                        </div>

                        <!-- Safety & Payment Guarantee Card -->
                        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
                            <h6 class="fw-bold text-navy mb-3">
                                <i class="fa-solid fa-circle-check text-success me-2"></i> Jaminan Skillance
                            </h6>
                            <ul class="list-unstyled small text-muted d-flex flex-column gap-2 mb-0">
                                <li><i class="fa-solid fa-check text-gold me-2"></i> <strong>Pemberi Kerja Terverifikasi:</strong> Tugas dikelola langsung oleh tim CV Skillance Digital Indonesia.</li>
                                <li><i class="fa-solid fa-check text-gold me-2"></i> <strong>Pencairan Pasti:</strong> Fee ditransfer langsung ke rekening bank atau dompet digital Anda setelah hasil kerja diverifikasi.</li>
                                <li><i class="fa-solid fa-check text-gold me-2"></i> <strong>Sertifikat & Portofolio:</strong> Hasil kerja dapat dicantumkan sebagai portofolio resmi Anda.</li>
                            </ul>
                        </div>

                        <!-- Need Help Card -->
                        <div class="card border-0 rounded-4 p-4 text-white" style="background: linear-gradient(135deg, #0d2e5c 0%, #1e4a86 100%);">
                            <h6 class="fw-bold text-white mb-2"><i class="fa-solid fa-comments text-gold me-2"></i> Ada Pertanyaan?</h6>
                            <p class="small mb-3" style="color: #cbd5e1 !important;">Jika butuh klarifikasi tentang kriteria tugas ini, hubungi admin melalui WhatsApp.</p>
                            <a href="https://wa.me/6282291700778?text=<?= urlencode('Halo Skillance, saya ingin bertanya tentang lowongan: ' . $jobTitle . ' (ID: ' . $job['id'] . ')') ?>" target="_blank" class="btn btn-gold text-navy fw-bold rounded-pill btn-sm py-2">
                                <i class="fa-brands fa-whatsapp me-1"></i> Tanya Admin via WhatsApp
                            </a>
                        </div>

                    </div>
                </div>

            <?php endif; ?>

        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-navy text-white pt-5 pb-4 border-top border-dark mt-5">
        <div class="container">
            <div class="row g-4 justify-content-between mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <i class="fa-solid fa-code text-gold fs-3"></i>
                        <span class="fw-bold fs-4 font-heading text-white">SKILLANCE</span>
                    </div>
                    <p class="text-white-50 small mb-4">
                        CV Skillance Digital Indonesia adalah perusahaan penyedia solusi IT, Software House, dan Konsultan Sistem Informasi terpercaya di Sulawesi Tenggara.
                    </p>
                </div>
                <div class="col-lg-2 col-md-6 col-6">
                    <h6 class="fw-bold text-gold text-uppercase mb-3">Navigasi</h6>
                    <ul class="list-unstyled small text-white-50 d-flex flex-column gap-2 mb-0">
                        <li><a href="index.html" class="text-white-50 text-decoration-none hover-gold">Beranda</a></li>
                        <li><a href="about.html" class="text-white-50 text-decoration-none hover-gold">Tentang Kami</a></li>
                        <li><a href="services.html" class="text-white-50 text-decoration-none hover-gold">Layanan</a></li>
                        <li><a href="portfolio.html" class="text-white-50 text-decoration-none hover-gold">Karya Kami</a></li>
                        <li><a href="freelance.html" class="text-white text-decoration-none hover-gold fw-bold">Bursa Freelance</a></li>
                        <li><a href="contact.html" class="text-white-50 text-decoration-none hover-gold">Kontak</a></li>
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
                &copy; 2026 CV Skillance Digital Indonesia. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function copyJobLink() {
            const url = <?= json_encode($pageUrl ?? '') ?>;
            navigator.clipboard.writeText(url).then(function() {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Tautan lowongan berhasil disalin!',
                    showConfirmButton: false,
                    timer: 2500
                });
            }).catch(function() {
                prompt("Salin tautan lowongan:", url);
            });
        }

        function takeJobAction(jobId) {
            Swal.fire({
                title: 'Ambil Pekerjaan Ini?',
                text: 'Pekerjaan ini akan langsung ditambahkan ke Dashboard Anda untuk dikerjakan.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#fca311',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Ambil Tugas!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Memproses...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });

                    const formData = new FormData();
                    formData.append('action', 'apply_job');
                    formData.append('job_id', jobId);

                    fetch('api/freelance_api.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil Diambil!',
                                text: 'Tugas sudah masuk ke dashboard pengerjaan Anda.',
                                confirmButtonColor: '#0d2e5c',
                                confirmButtonText: 'Lihat di Dashboard'
                            }).then(() => {
                                window.location.href = 'dashboard/freelancer/my_tasks.php';
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                text: data.message || 'Terjadi kesalahan saat mengambil pekerjaan.',
                                confirmButtonColor: '#0d2e5c'
                            });
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal menghubungi server.',
                            confirmButtonColor: '#0d2e5c'
                        });
                    });
                }
            });
        }
    </script>
</body>
</html>
