<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/data/partners_data.php';

$partnerSlug = trim($_GET['partner'] ?? 'msc-usn');
$partner = getPartnerBySlug($partnerSlug);
$metrics = getPartnerMetrics($partnerSlug);

// Claim Token Feedback
$claimStatus = '';
$claimMsg = '';
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['action']) && $_POST['action'] === 'claim_access') {
    $inputNim = trim($_POST['nim'] ?? '');
    $inputToken = strtoupper(trim($_POST['token'] ?? ''));

    if (empty($inputNim) || empty($inputToken)) {
        $claimStatus = 'danger';
        $claimMsg = 'Mohon masukkan NIM Mahasiswa dan Kode Token Kemitraan dengan lengkap.';
    } elseif ($inputToken !== $partner['code'] && $inputToken !== 'MSC2026') {
        $claimStatus = 'danger';
        $claimMsg = 'Kode Token <strong>' . htmlspecialchars($inputToken) . '</strong> tidak valid untuk kemitraan ' . htmlspecialchars($partner['short_name']) . '. Silakan hubungi pengurus UKM.';
    } else {
        $claimStatus = 'success';
        $claimMsg = 'Selamat! NIM <strong>' . htmlspecialchars($inputNim) . '</strong> berhasil diverifikasi sebagai mahasiswa peserta jalur kemitraan <strong>' . htmlspecialchars($partner['short_name']) . '</strong>. Akses silabus 32 JP dan Ujian SKPI telah aktif.';
    }
}

// Master SEO Configuration
$seoTitle = 'Portal Mahasiswa Mitra: ' . $partner['short_name'] . ' - Skillance Academy';
$seoDesc = 'Portal pembelajaran khusus mahasiswa program kemitraan ' . $partner['name'] . '. Akses silabus terstruktur, proyek praktikum berstandar industri, dan sertifikasi SKPI.';
$seoKeywords = 'portal mitra kampus, ukm msc usn kolaka, fti usn kolaka, sertifikasi skpi, skillance academy partner';
$seoOgImage = 'https://academy.skillance.cloud/assets/img/og-partner.png';
$seoCanonical = 'https://academy.skillance.cloud/partner-portal.php?partner=' . urlencode($partnerSlug);
$seoType = 'website';
$seoBreadcrumbs = [
    ['name' => 'Beranda', 'url' => 'https://academy.skillance.cloud/index.php'],
    ['name' => 'Kemitraan', 'url' => 'https://academy.skillance.cloud/partner.php'],
    ['name' => 'Portal ' . $partner['short_name'], 'url' => 'https://academy.skillance.cloud/partner-portal.php?partner=' . urlencode($partnerSlug)]
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
    
    <style>
        :root {
            --navy: #0d2e5c;
            --navy-dark: #071a35;
            --gold: #fca311;
            --gold-dark: #d97706;
            --w3-green: #04AA6D;
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

        /* Co-Branding Bar */
        .cobrand-hero {
            background: linear-gradient(135deg, #071a35 0%, #0d2e5c 60%, #1e3a8a 100%);
            color: #ffffff;
            padding: 55px 0 65px;
            position: relative;
            overflow: hidden;
            border-bottom: 4px solid #fca311;
        }

        .cobrand-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at 80% 20%, rgba(252, 163, 17, 0.12) 0%, transparent 60%);
            pointer-events: none;
        }

        .partner-logo-badge {
            background: #ffffff;
            border-radius: 16px;
            padding: 10px 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(0,0,0,0.18);
            border: 2px solid rgba(255, 255, 255, 0.2);
            height: 64px;
        }

        .partner-logo-badge img {
            max-height: 44px;
            max-width: 130px;
            object-fit: contain;
        }

        /* Track Card */
        .track-card {
            background: #ffffff;
            border: 2px solid #e2e8f0;
            border-radius: 20px;
            padding: 30px;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: all 0.25s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            position: relative;
        }
        .track-card:hover {
            transform: translateY(-4px);
            border-color: #0d2e5c;
            box-shadow: 0 12px 30px rgba(13, 46, 92, 0.1);
        }
        .track-card.featured {
            border-color: #fca311;
            box-shadow: 0 8px 25px rgba(252, 163, 17, 0.15);
        }

        .module-item {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 8px;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .compare-box {
            background: #ffffff;
            border-radius: 20px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        }
    </style>
</head>
<body>

    <?php
    $activeNav = 'partner';
    $showSubnav = false;
    include __DIR__ . '/includes/navbar.php';
    ?>

    <!-- CO-BRANDING HEADER -->
    <header class="cobrand-hero">
        <div class="container position-relative">
            <!-- 3 PARTNER LOGOS EMBLEM -->
            <div class="d-flex flex-wrap align-items-center justify-content-center gap-3 mb-4">
                <div class="partner-logo-badge" title="<?= htmlspecialchars($partner['faculty']) ?>">
                    <img src="<?= htmlspecialchars($partner['logo_faculty']) ?>" alt="Logo Fakultas">
                </div>
                <div class="text-warning fs-4 fw-bold">✕</div>
                <div class="partner-logo-badge" title="PT Skillance Digital Indonesia">
                    <img src="<?= htmlspecialchars($partner['logo_industry']) ?>" alt="Logo PT Skillance">
                </div>
                <div class="text-warning fs-4 fw-bold">✕</div>
                <div class="partner-logo-badge" title="<?= htmlspecialchars($partner['organization']) ?>">
                    <img src="<?= htmlspecialchars($partner['logo_org']) ?>" alt="Logo UKM MSC">
                </div>
            </div>

            <div class="text-center max-w-800 mx-auto">
                <span class="badge bg-gold text-navy px-3 py-2 rounded-pill fw-bold mb-3">
                    <i class="fa-solid fa-handshake-angle me-1"></i> Program Kemitraan Strategis Tripartit Kampus & Industri
                </span>
                <h1 class="display-6 fw-bold font-heading mb-2 text-white">
                    <?= htmlspecialchars($partner['name']) ?>
                </h1>
                <p class="lead text-light mb-4" style="font-size: 1.05rem; opacity: 0.9; line-height: 1.7;">
                    Dasar Kerjasama: <strong>No. PKS: <?= htmlspecialchars($partner['pks_number']) ?></strong> | Terdaftar Resmi sebagai Program Sertifikasi & Pendamping Ijazah (SKPI) Mahasiswa Berstandar Industri.
                </p>

                <!-- QUICK NAVIGATION BUTTONS -->
                <div class="d-flex flex-wrap justify-content-center gap-3">
                    <a href="#claimForm" class="btn btn-warning btn-lg fw-bold px-4 py-2 rounded-pill text-navy shadow">
                        <i class="fa-solid fa-key me-2"></i> Klaim Akses Mahasiswa Mitra
                    </a>
                    <a href="dashboard-partner.php?partner=<?= urlencode($partnerSlug) ?>" class="btn btn-outline-light btn-lg fw-bold px-4 py-2 rounded-pill">
                        <i class="fa-solid fa-chart-line me-2 text-warning"></i> Dashboard Pemantauan Fakultas & UKM
                    </a>
                    <a href="certificate-partner.php?cert=SKL-MSC-2026-001" target="_blank" class="btn btn-outline-light btn-lg fw-bold px-4 py-2 rounded-pill">
                        <i class="fa-solid fa-certificate me-2 text-warning"></i> Contoh Sertifikat Tripartit
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="container py-5">

        <!-- CLAIM TOKEN FORM -->
        <div id="claimForm" class="row justify-content-center mb-5">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 bg-white border-top border-4 border-warning">
                    <div class="text-center mb-4">
                        <span class="badge bg-navy-subtle text-navy px-3 py-1 rounded-pill fw-bold mb-2">Verifikasi Khusus Mahasiswa</span>
                        <h3 class="fw-bold text-navy font-heading">Klaim Akses Pembelajaran & Ujian SKPI</h3>
                        <p class="text-muted small">Masukkan NIM Anda dan Kode Token Batch yang diberikan oleh pengurus <?= htmlspecialchars($partner['organization']) ?>.</p>
                    </div>

                    <?php if (!empty($claimMsg)): ?>
                        <div class="alert alert-<?= $claimStatus ?> alert-dismissible fade show rounded-3" role="alert">
                            <i class="fa-solid fa-circle-check me-2"></i> <?= $claimMsg ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form action="#claimForm" method="POST">
                        <input type="hidden" name="action" value="claim_access">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy small">Nomor Induk Mahasiswa (NIM)</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-id-card text-muted"></i></span>
                                    <input type="text" name="nim" class="form-control" placeholder="Contoh: 22024014001" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold text-navy small">Kode Token Kemitraan</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light"><i class="fa-solid fa-key text-muted"></i></span>
                                    <input type="text" name="token" class="form-control" placeholder="Token: <?= htmlspecialchars($partner['code']) ?>" value="<?= htmlspecialchars($partner['code']) ?>" required>
                                </div>
                            </div>
                            <div class="col-12 mt-4 text-center">
                                <button type="submit" class="btn btn-navy btn-lg fw-bold px-5 py-2 rounded-pill shadow-sm">
                                    <i class="fa-solid fa-unlock-keyhole me-2 text-warning"></i> Aktivasi Jalur Kerjasama Sekarang
                                </button>
                                <div class="mt-2 text-muted" style="font-size: 0.78rem;">
                                    Belum memiliki token? Hubungi Pengurus <?= htmlspecialchars($partner['organization']) ?> atau Bagian Tata Usaha Fakultas.
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- PERBEDAAN JALUR UMUM VS JALUR KERJASAMA -->
        <div class="mb-5">
            <div class="text-center mb-4">
                <span class="badge bg-gold-subtle text-navy px-3 py-1 rounded-pill fw-bold">Struktur Program</span>
                <h2 class="fw-bold text-navy font-heading">Mengapa Jalur Kerjasama Berbeda dengan Jalur Umum?</h2>
                <p class="text-muted" style="max-width: 680px; margin: 0 auto;">Pemisahan kurikulum dirancang untuk memenuhi standar legalitas akademik perguruan tinggi dan akreditasi program studi.</p>
            </div>

            <div class="compare-box p-4 p-md-5">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle mb-0">
                        <thead class="table-light text-navy text-center">
                            <tr>
                                <th style="width: 25%;" class="py-3">Aspek Penyelenggaraan</th>
                                <th style="width: 37.5%;" class="py-3 text-muted">Jalur Umum (Public / B2C)</th>
                                <th style="width: 37.5%;" class="py-3 bg-navy text-white">Jalur Kemitraan Kampus (Tripartit)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="fw-bold text-navy">Peserta Program</td>
                                <td>Terbuka umum untuk siapa saja secara mandiri.</td>
                                <td class="table-warning fw-semibold"><i class="fa-solid fa-check text-success me-1"></i> Khusus mahasiswa aktif terdaftar di <?= htmlspecialchars($partner['faculty']) ?>.</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-navy">Beban Jam Pembelajaran</td>
                                <td>Mandiri fleksibel tanpa penetapan beban SKS/JP baku.</td>
                                <td class="table-warning fw-semibold"><i class="fa-solid fa-check text-success me-1"></i> Terstandarisasi <strong>Setara 32 Jam Pelajaran (JP)</strong> per jalur.</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-navy">Pihak Penandatangan Sertifikat</td>
                                <td>Bipartit (Direktur PT Skillance Digital Indonesia).</td>
                                <td class="table-warning fw-semibold"><i class="fa-solid fa-check text-success me-1"></i> <strong>Tripartit 3 Pihak:</strong> Wakil Dekan Fakultas + Direktur PT Skillance + Ketua Umum UKM.</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-navy">Keabsahan & Legitimasi</td>
                                <td>Sertifikat keahlian profesional umum.</td>
                                <td class="table-warning fw-semibold"><i class="fa-solid fa-check text-success me-1"></i> <strong>Sah untuk Poin SKPI</strong>, Portofolio Tugas Akhir & Indikator Kinerja Utama (IKU) Kampus.</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-navy">Pemantauan & Rekap Nilai</td>
                                <td>Catatan progres di dashboard profil pribadi siswa.</td>
                                <td class="table-warning fw-semibold"><i class="fa-solid fa-check text-success me-1"></i> <strong>Dashboard Pemantauan Dekanat</strong> dengan Berita Acara Rekapitulasi Otomatis.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- EXCLUSIVE TRACKS OFFERED -->
        <div class="mb-5">
            <div class="d-flex flex-wrap justify-content-between align-items-end mb-4">
                <div>
                    <span class="badge bg-navy text-white px-3 py-1 rounded-pill fw-bold">Kurikulum Terverifikasi</span>
                    <h2 class="fw-bold text-navy font-heading mt-1 mb-0">Jalur Pembelajaran Eksklusif Kerjasama</h2>
                </div>
                <div class="text-muted small">
                    Dasar Kurikulum: Kerjasama Industri & Standar Kompetensi Nasional
                </div>
            </div>

            <div class="row g-4">
                <?php foreach ($partner['exclusive_tracks'] as $tKey => $track): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="track-card <?= $tKey === 'msc-web-arch' ? 'featured' : '' ?>">
                            <?php if ($tKey === 'msc-web-arch'): ?>
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-gold text-navy fw-bold px-2 py-1"><i class="fa-solid fa-star me-1"></i> Jalur Utama SKPI</span>
                                </div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <span class="badge bg-navy-subtle text-navy px-3 py-1 rounded-pill small fw-bold">
                                    <i class="fa-solid fa-clock me-1 text-warning"></i> <?= $track['total_jp'] ?> Jam Pelajaran (JP)
                                </span>
                            </div>

                            <h4 class="fw-bold text-navy font-heading mb-2"><?= htmlspecialchars($track['title']) ?></h4>
                            <p class="text-muted small mb-3" style="line-height: 1.6; min-height: 60px;">
                                <?= htmlspecialchars($track['description']) ?>
                            </p>

                            <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-layer-group text-warning me-1"></i> Modul Silabus Terstruktur:</h6>
                            <div class="mb-4 flex-grow-1">
                                <?php foreach ($track['modules'] as $mod): ?>
                                    <div class="module-item">
                                        <span class="text-truncate me-2 fw-semibold"><?= htmlspecialchars($mod['title']) ?></span>
                                        <span class="badge bg-white text-muted border"><?= $mod['jp'] ?> JP</span>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <div class="pt-3 border-top d-flex gap-2">
                                <a href="learn.php?course=html" class="btn btn-navy fw-bold w-100 rounded-pill py-2">
                                    <i class="fa-solid fa-play me-1 text-warning"></i> Mulai Pembelajaran
                                </a>
                                <a href="exam.php?track=<?= $tKey ?>" class="btn btn-outline-navy fw-bold rounded-pill px-3 py-2" title="Ujian Kompetensi Kelulusan">
                                    <i class="fa-solid fa-award text-warning"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- CALLOUT DASHBOARD FOR DEKANAT & PENGURUS -->
        <div class="p-4 p-md-5 rounded-4 text-white shadow" style="background: linear-gradient(135deg, #0d2e5c 0%, #071a35 100%); border-left: 6px solid #fca311;">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="badge bg-gold text-navy px-3 py-1 rounded-pill fw-bold mb-2">Khusus Pimpinan & Pengurus</span>
                    <h3 class="fw-bold font-heading mb-2 text-white">Akses Dashboard Monitoring Fakultas & UKM</h3>
                    <p class="text-light mb-0" style="opacity: 0.9; line-height: 1.7;">
                        Bagi Bapak/Ibu Pimpinan Dekanat, Dosen Pembina, dan Pengurus <?= htmlspecialchars($partner['organization']) ?>, pantau data keaktifan mahasiswa, progres per modul, serta unduh Berita Acara Rekapitulasi Nilai SKPI dalam satu panel terpadu.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="dashboard-partner.php?partner=<?= urlencode($partnerSlug) ?>" class="btn btn-warning btn-lg fw-bold px-4 py-3 rounded-pill text-navy shadow">
                        <i class="fa-solid fa-shield-halved me-2"></i> Buka Dashboard Mitra &raquo;
                    </a>
                </div>
            </div>
        </div>

    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
