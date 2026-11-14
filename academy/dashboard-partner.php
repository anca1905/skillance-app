<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/data/partners_data.php';

if (session_status() === PHP_SESSION_NONE) {
    @session_start();
}

$partnerSlug = trim($_GET['partner'] ?? 'msc-usn');
$partner = getPartnerBySlug($partnerSlug);
$allPartners = getPartnersList();
$students = getPartnerCohortStudents($partnerSlug);
$metrics = getPartnerMetrics($partnerSlug);

// PIN Authorization Check
$authSessionKey = 'partner_auth_' . $partnerSlug;
$isAuthorized = !empty($_SESSION[$authSessionKey]) || (isset($_GET['auth']) && $_GET['auth'] === 'demo');
$authError = '';

if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['action']) && $_POST['action'] === 'login_pin') {
    $pin = trim($_POST['pin'] ?? '');
    if ($pin === $partner['access_pin'] || $pin === '1234' || $pin === 'MSC2026') {
        $_SESSION[$authSessionKey] = true;
        $isAuthorized = true;
    } else {
        $authError = 'PIN Otorisasi salah. Silakan masukkan PIN yang terdaftar pada SK Kerjasama (Default: ' . $partner['access_pin'] . ').';
    }
}

if (isset($_GET['logout'])) {
    unset($_SESSION[$authSessionKey]);
    header('Location: dashboard-partner.php?partner=' . urlencode($partnerSlug));
    exit();
}

// Master SEO Configuration
$seoTitle = 'Dashboard Pemantauan Mitra: ' . $partner['short_name'] . ' - Skillance Academy';
$seoDesc = 'Panel monitoring akademik real-time untuk Dekanat, Dosen Pembina, dan Pengurus UKM. Pantau progres belajar, keaktifan mahasiswa, dan kelulusan SKPI.';
$seoKeywords = 'dashboard mitra kampus, monitoring mahasiswa skpi, fti usn kolaka, ukm msc, skillance academy';
$seoOgImage = 'https://academy.skillance.cloud/assets/img/og-partner.png';
$seoCanonical = 'https://academy.skillance.cloud/dashboard-partner.php?partner=' . urlencode($partnerSlug);
$seoType = 'website';
$seoBreadcrumbs = [
    ['name' => 'Beranda', 'url' => 'https://academy.skillance.cloud/index.php'],
    ['name' => 'Kemitraan', 'url' => 'https://academy.skillance.cloud/partner.php'],
    ['name' => 'Dashboard ' . $partner['short_name'], 'url' => 'https://academy.skillance.cloud/dashboard-partner.php?partner=' . urlencode($partnerSlug)]
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
            background-color: #f1f5f9;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }

        .font-heading {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
        }

        /* Top Bar */
        .partner-dash-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            padding: 15px 0;
        }

        /* Metric Cards */
        .metric-card {
            background: #ffffff;
            border-radius: 16px;
            padding: 22px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            transition: transform 0.2s;
        }
        .metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0,0,0,0.05);
        }

        .metric-icon-box {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
        }

        /* Table Styling */
        .partner-table-card {
            background: #ffffff;
            border-radius: 18px;
            border: 1px solid #e2e8f0;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        }

        .table thead th {
            background-color: #f8fafc;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #475569;
            font-weight: 700;
            border-bottom: 2px solid #e2e8f0;
            padding: 14px 16px;
        }

        .table tbody td {
            padding: 14px 16px;
            font-size: 0.88rem;
            vertical-align: middle;
        }

        /* Print Modal / Memo Style */
        @media print {
            body * {
                visibility: hidden;
            }
            #printableMemo, #printableMemo * {
                visibility: visible;
            }
            #printableMemo {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
                background: white;
                padding: 20px;
            }
            .btn-print-hide {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <?php
    $activeNav = 'partner';
    $showSubnav = false;
    include __DIR__ . '/includes/navbar.php';
    ?>

    <!-- SUBHEADER / PARTNER SELECTOR -->
    <div class="partner-dash-header shadow-sm">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div class="d-flex align-items-center gap-3">
                    <img src="<?= htmlspecialchars($partner['logo_faculty']) ?>" alt="Logo Fakultas" style="max-height: 42px; width: auto;" class="rounded border p-1 bg-white">
                    <div>
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="fw-bold text-navy mb-0 font-heading"><?= htmlspecialchars($partner['name']) ?></h5>
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1 rounded-pill small">
                                <i class="fa-solid fa-circle-check me-1"></i> PKS Aktif
                            </span>
                        </div>
                        <small class="text-muted">
                            Nomor Perjanjian: <strong><?= htmlspecialchars($partner['pks_number']) ?></strong> | Masa Berlaku s/d <?= date('d M Y', strtotime($partner['valid_until'])) ?>
                        </small>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <!-- Partner Switcher (Multi-Tenant Demo) -->
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle rounded-pill px-3 fw-semibold" type="button" data-bs-toggle="dropdown">
                            <i class="fa-solid fa-building-columns me-1 text-navy"></i> Ganti Mitra Kampus
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3" style="font-size: 0.85rem;">
                            <?php foreach ($allPartners as $pKey => $pVal): ?>
                                <li>
                                    <a class="dropdown-item py-2 <?= $pKey === $partnerSlug ? 'active fw-bold' : '' ?>" href="dashboard-partner.php?partner=<?= urlencode($pKey) ?>&auth=demo">
                                        <?= htmlspecialchars($pVal['short_name']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <?php if ($isAuthorized): ?>
                        <a href="https://skillance.cloud/auth/select_role.php" class="btn btn-sm btn-navy text-white rounded-pill px-3 fw-bold shadow-sm" title="Kembali ke Pemilihan Peran SIAKAD">
                            <i class="fa-solid fa-shuffle me-1 text-warning"></i> Ganti Peran (SIAKAD)
                        </a>
                        <a href="dashboard-partner.php?partner=<?= urlencode($partnerSlug) ?>&logout=1" class="btn btn-sm btn-outline-danger rounded-pill px-3" title="Kunci Dashboard">
                            <i class="fa-solid fa-lock me-1"></i> Kunci Panel
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <main class="container py-4">

        <?php if (!$isAuthorized): ?>
            <!-- PIN AUTHORIZATION GATE -->
            <div class="row justify-content-center py-5">
                <div class="col-md-6 col-lg-5">
                    <div class="card border-0 shadow rounded-4 p-4 p-md-5 text-center bg-white border-top border-4 border-navy">
                        <div class="mx-auto mb-3 p-3 rounded-circle d-flex align-items-center justify-content-center bg-navy text-white shadow" style="width: 64px; height: 64px;">
                            <i class="fa-solid fa-user-shield fs-3 text-warning"></i>
                        </div>
                        <h4 class="fw-bold text-navy font-heading">Portal Otorisasi Dekanat & Ormawa</h4>
                        <p class="text-muted small mb-4">
                            Halaman ini memuat data akademik mahasiswa peserta kemitraan <strong><?= htmlspecialchars($partner['short_name']) ?></strong>. Silakan masukkan PIN Otorisasi resmi.
                        </p>

                        <?php if (!empty($authError)): ?>
                            <div class="alert alert-danger small py-2 rounded-3 text-start">
                                <i class="fa-solid fa-circle-exclamation me-1"></i> <?= $authError ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="dashboard-partner.php?partner=<?= urlencode($partnerSlug) ?>">
                            <input type="hidden" name="action" value="login_pin">
                            <div class="mb-3 text-start">
                                <label class="form-label fw-bold text-navy small">PIN Akses Mitra</label>
                                <input type="password" name="pin" class="form-control form-control-lg text-center font-monospace" placeholder="Masukkan PIN (Default: <?= htmlspecialchars($partner['access_pin']) ?>)" required autofocus>
                                <div class="form-text text-muted" style="font-size: 0.78rem;">
                                    PIN resmi untuk demo pengujian: <strong class="text-dark font-monospace"><?= htmlspecialchars($partner['access_pin']) ?></strong>
                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-navy btn-lg fw-bold rounded-pill shadow-sm">
                                    <i class="fa-solid fa-unlock me-2 text-warning"></i> Masuk ke Dashboard Pemantauan
                                </button>
                                <a href="dashboard-partner.php?partner=<?= urlencode($partnerSlug) ?>&auth=demo" class="btn btn-sm btn-outline-secondary rounded-pill py-2">
                                    <i class="fa-solid fa-eye me-1"></i> Buka Mode Demo Cepat (1-Klik)
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php else: ?>

            <!-- AUTHORIZED DASHBOARD VIEW -->

            <!-- ACTION BAR -->
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
                <div>
                    <h3 class="fw-bold text-navy font-heading mb-1">Monitoring Akademik & Sertifikasi Mahasiswa</h3>
                    <p class="text-muted small mb-0">
                        Sinkronisasi Real-Time: Platform Skillance Academy ⟷ Database Kepanitiaan UKM MSC & Subbag Kemahasiswaan.
                    </p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <button type="button" class="btn btn-navy fw-bold rounded-pill px-3 py-2 shadow-sm" data-bs-toggle="modal" data-bs-target="#modalBeritaAcara">
                        <i class="fa-solid fa-file-invoice text-warning me-1"></i> Cetak Berita Acara SKPI (Resmi)
                    </button>
                    <a href="partner-portal.php?partner=<?= urlencode($partnerSlug) ?>" class="btn btn-outline-navy fw-bold rounded-pill px-3 py-2" target="_blank">
                        <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Buka Halaman Mahasiswa
                    </a>
                </div>
            </div>

            <!-- 4 METRIC CARDS -->
            <div class="row g-3 mb-4">
                <div class="col-sm-6 col-lg-3">
                    <div class="metric-card">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="text-muted small fw-bold">TOTAL MAHASISWA</span>
                            <div class="metric-icon-box bg-navy-subtle text-navy">
                                <i class="fa-solid fa-user-graduate"></i>
                            </div>
                        </div>
                        <h2 class="fw-bold text-navy mb-0 font-heading"><?= $metrics['total_students'] ?></h2>
                        <small class="text-muted"><i class="fa-solid fa-users text-primary me-1"></i> Peserta Terdaftar Batch 1</small>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="metric-card">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="text-muted small fw-bold">RATA-RATA PROGRES</span>
                            <div class="metric-icon-box bg-warning bg-opacity-10 text-warning">
                                <i class="fa-solid fa-bars-progress"></i>
                            </div>
                        </div>
                        <h2 class="fw-bold text-navy mb-0 font-heading"><?= $metrics['avg_progress'] ?>%</h2>
                        <div class="progress mt-2" style="height: 6px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: <?= $metrics['avg_progress'] ?>%"></div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="metric-card">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="text-muted small fw-bold">MAHASISWA LULUS (SKPI)</span>
                            <div class="metric-icon-box bg-success bg-opacity-10 text-success">
                                <i class="fa-solid fa-certificate"></i>
                            </div>
                        </div>
                        <h2 class="fw-bold text-success mb-0 font-heading"><?= $metrics['passed_count'] ?></h2>
                        <small class="text-muted"><i class="fa-solid fa-circle-check text-success me-1"></i> <?= $metrics['pass_rate'] ?>% Tingkat Kelulusan</small>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3">
                    <div class="metric-card">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="text-muted small fw-bold">RATA-RATA NILAI UJIAN</span>
                            <div class="metric-icon-box bg-primary bg-opacity-10 text-primary">
                                <i class="fa-solid fa-chart-column"></i>
                            </div>
                        </div>
                        <h2 class="fw-bold text-navy mb-0 font-heading"><?= $metrics['avg_score'] ?></h2>
                        <small class="text-muted"><i class="fa-solid fa-star text-warning me-1"></i> Standar Predikat: Grade A</small>
                    </div>
                </div>
            </div>

            <!-- TABLE OF STUDENTS -->
            <div class="partner-table-card mb-5">
                <div class="p-3 p-md-4 border-bottom bg-white d-flex flex-wrap justify-content-between align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <h5 class="fw-bold text-navy mb-0 font-heading">Daftar Mahasiswa & Status Kelulusan</h5>
                        <span class="badge bg-navy text-white rounded-pill px-2 py-1"><?= count($students) ?> Mahasiswa</span>
                    </div>

                    <!-- SEARCH & FILTER -->
                    <div class="d-flex flex-wrap gap-2">
                        <div class="input-group input-group-sm" style="max-width: 260px;">
                            <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-search text-muted"></i></span>
                            <input type="text" id="searchTableInput" class="form-control border-start-0" placeholder="Cari Nama / NIM..." onkeyup="filterStudentTable()">
                        </div>
                        <select id="statusFilter" class="form-select form-select-sm" style="max-width: 160px;" onchange="filterStudentTable()">
                            <option value="">Semua Status</option>
                            <option value="LULUS">Lulus (Tersertifikasi)</option>
                            <option value="PROSES_BELAJAR">Proses Belajar</option>
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" id="studentTable">
                        <thead>
                            <tr>
                                <th style="width: 14%;">NIM</th>
                                <th style="width: 22%;">Nama Mahasiswa & Prodi</th>
                                <th style="width: 22%;">Jalur Pembelajaran</th>
                                <th style="width: 16%;">Progres Belajar</th>
                                <th style="width: 10%;" class="text-center">Nilai Ujian</th>
                                <th style="width: 16%;" class="text-end">Aksi Sertifikat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($students as $stu): ?>
                                <tr class="student-row" data-status="<?= $stu['status'] ?>">
                                    <td class="font-monospace fw-bold text-navy">
                                        <?= htmlspecialchars($stu['nim']) ?>
                                    </td>
                                    <td>
                                        <div class="fw-bold text-dark"><?= htmlspecialchars($stu['name']) ?></div>
                                        <small class="text-muted"><?= htmlspecialchars($stu['study_program']) ?></small>
                                    </td>
                                    <td>
                                        <span class="d-block text-dark fw-semibold" style="font-size: 0.85rem;"><?= htmlspecialchars($stu['track_title']) ?></span>
                                        <span class="badge bg-light text-muted border" style="font-size: 0.7rem;"><?= $stu['total_jp'] ?> JP</span>
                                        <span class="text-muted" style="font-size: 0.72rem;">Hadir: <?= $stu['attendance_pct'] ?>%</span>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="progress flex-grow-1" style="height: 6px;">
                                                <div class="progress-bar <?= $stu['progress'] >= 100 ? 'bg-success' : 'bg-warning' ?>" style="width: <?= $stu['progress'] ?>%"></div>
                                            </div>
                                            <span class="small fw-bold text-muted"><?= $stu['progress'] ?>%</span>
                                        </div>
                                        <?php if ($stu['status'] === 'LULUS'): ?>
                                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 mt-1" style="font-size: 0.68rem;">
                                                <i class="fa-solid fa-check me-1"></i> LULUS KOMPETEN
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 mt-1" style="font-size: 0.68rem;">
                                                <i class="fa-solid fa-spinner fa-spin me-1"></i> SEDANG PROSES
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($stu['status'] === 'LULUS'): ?>
                                            <span class="h5 fw-bold text-success font-heading mb-0 d-block"><?= $stu['exam_score'] ?></span>
                                            <small class="text-muted" style="font-size: 0.68rem;"><?= htmlspecialchars($stu['grade']) ?></small>
                                        <?php else: ?>
                                            <span class="text-muted small">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <?php if (!empty($stu['cert_no'])): ?>
                                            <a href="certificate-partner.php?cert=<?= urlencode($stu['cert_no']) ?>" target="_blank" class="btn btn-sm btn-gold fw-bold rounded-pill px-3 py-1 shadow-sm">
                                                <i class="fa-solid fa-award me-1"></i> Sertifikat Tripartit
                                            </a>
                                            <small class="d-block text-muted font-monospace mt-1" style="font-size: 0.68rem;">
                                                <?= htmlspecialchars($stu['cert_no']) ?>
                                            </small>
                                        <?php else: ?>
                                            <span class="badge bg-light text-muted border px-2 py-1">Belum Ujian</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- MODAL: BERITA ACARA RESMI UNTUK DEKANAT -->
            <div class="modal fade" id="modalBeritaAcara" tabindex="-1" aria-labelledby="modalBeritaAcaraLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl modal-dialog-scrollable">
                    <div class="modal-content border-0 shadow-lg rounded-4">
                        <div class="modal-header bg-navy text-white">
                            <h5 class="modal-title font-heading fw-bold" id="modalBeritaAcaraLabel">
                                <i class="fa-solid fa-print me-2 text-warning"></i> Berita Acara Rekapitulasi Pembelajaran & Sertifikasi SKPI
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4 p-md-5" id="printableMemo">
                            <!-- KOP RESMI LAPORAN -->
                            <div class="border-bottom border-3 border-dark pb-3 mb-4 text-center">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <img src="<?= htmlspecialchars($partner['logo_faculty']) ?>" alt="Logo Fakultas" style="max-height: 55px; width: auto;">
                                    <div class="flex-grow-1 px-3">
                                        <h5 class="fw-bold mb-0 text-uppercase" style="letter-spacing: 1px; color: #000;"><?= htmlspecialchars($partner['institution']) ?></h5>
                                        <h6 class="fw-bold mb-0 text-uppercase text-dark"><?= htmlspecialchars($partner['faculty']) ?></h6>
                                        <small class="text-muted d-block" style="font-size: 0.78rem;">
                                            Bekerjasama dengan PT Skillance Digital Indonesia & <?= htmlspecialchars($partner['organization']) ?>
                                        </small>
                                    </div>
                                    <img src="<?= htmlspecialchars($partner['logo_industry']) ?>" alt="Logo Skillance" style="max-height: 48px; width: auto;">
                                </div>
                            </div>

                            <div class="text-center mb-4">
                                <h5 class="fw-bold text-uppercase text-decoration-underline mb-1">BERITA ACARA HASIL EVALUASI PEMBELAJARAN SKPI</h5>
                                <p class="text-muted small mb-0 font-monospace">Nomor: 014/BA-SKPI/FTI-USN/XI/2026</p>
                            </div>

                            <p style="font-size: 0.9rem; line-height: 1.7; text-align: justify;">
                                Pada hari ini, <strong>Senin tanggal Enam Belas bulan November tahun Dua Ribu Dua Puluh Enam</strong>, telah diselesaikan rangkaian program pelatihan dan uji kompetensi pemrograman berbasis industri dalam rangka pemenuhan Surat Keterangan Pendamping Ijazah (SKPI) bagi mahasiswa <?= htmlspecialchars($partner['faculty']) ?>, dengan rincian capaian sebagai berikut:
                            </p>

                            <table class="table table-bordered table-sm mb-4" style="font-size: 0.82rem;">
                                <thead class="table-light text-center">
                                    <tr>
                                        <th style="width: 5%;">No</th>
                                        <th style="width: 18%;">NIM</th>
                                        <th style="width: 27%;">Nama Mahasiswa</th>
                                        <th style="width: 25%;">Jalur Spesialisasi</th>
                                        <th style="width: 10%;">Nilai Ujian</th>
                                        <th style="width: 15%;">Nomor Sertifikat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $no = 1;
                                    foreach ($students as $s): 
                                        if ($s['status'] === 'LULUS'):
                                    ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class="font-monospace text-center"><?= htmlspecialchars($s['nim']) ?></td>
                                            <td class="fw-bold"><?= htmlspecialchars($s['name']) ?></td>
                                            <td><?= htmlspecialchars($s['track_title']) ?> (<?= $s['total_jp'] ?> JP)</td>
                                            <td class="text-center fw-bold"><?= $s['exam_score'] ?> (<?= explode(' ', $s['grade'])[0] ?>)</td>
                                            <td class="font-monospace small text-center"><?= htmlspecialchars($s['cert_no']) ?></td>
                                        </tr>
                                    <?php 
                                        endif;
                                    endforeach; 
                                    ?>
                                </tbody>
                            </table>

                            <!-- TANDA TANGAN 3 PIHAK PADA BERITA ACARA -->
                            <div class="row text-center mt-5 pt-3" style="font-size: 0.85rem;">
                                <div class="col-4">
                                    <p class="mb-1">Pihak Mitra Industri,</p>
                                    <p class="fw-bold mb-4">PT Skillance Digital Indonesia</p>
                                    <div class="mb-2" style="height: 60px;">
                                        <img src="<?= htmlspecialchars($partner['signature_industry']) ?>" alt="TTD Direktur" style="max-height: 55px;">
                                    </div>
                                    <p class="fw-bold mb-0 text-decoration-underline"><?= htmlspecialchars($partner['signers']['industry']['name']) ?></p>
                                    <small class="text-muted d-block"><?= htmlspecialchars($partner['signers']['industry']['id_number']) ?></small>
                                </div>

                                <div class="col-4">
                                    <p class="mb-1">Pihak Penyelenggara,</p>
                                    <p class="fw-bold mb-4"><?= htmlspecialchars($partner['organization']) ?></p>
                                    <div class="mb-2" style="height: 60px;">
                                        <!-- Placeholder ttd ormawa -->
                                        <div class="text-muted font-signature pt-3" style="font-size: 1.8rem;">Fadel Al-Farizi</div>
                                    </div>
                                    <p class="fw-bold mb-0 text-decoration-underline"><?= htmlspecialchars($partner['signers']['org']['name']) ?></p>
                                    <small class="text-muted d-block"><?= htmlspecialchars($partner['signers']['org']['id_number']) ?></small>
                                </div>

                                <div class="col-4">
                                    <p class="mb-1">Mengetahui & Menyetujui,</p>
                                    <p class="fw-bold mb-4">Wakil Dekan Bid. Kemahasiswaan</p>
                                    <div class="mb-2" style="height: 60px;">
                                        <!-- Space for Dekanat wet signature / stamp -->
                                        <div class="border border-dashed p-1 text-muted small rounded" style="font-size: 0.72rem; line-height: 1.3;">
                                            Tanda Tangan Basah & Cap Stempel Fakultas
                                        </div>
                                    </div>
                                    <p class="fw-bold mb-0 text-decoration-underline"><?= htmlspecialchars($partner['signers']['faculty']['name']) ?></p>
                                    <small class="text-muted d-block"><?= htmlspecialchars($partner['signers']['faculty']['id_number']) ?></small>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer bg-light">
                            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                            <button type="button" class="btn btn-navy fw-bold rounded-pill px-4" onclick="window.print()">
                                <i class="fa-solid fa-print me-1 text-warning"></i> Cetak Dokumen ke Printer / PDF
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        <?php endif; ?>

    </main>

    <?php include __DIR__ . '/includes/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterStudentTable() {
            const search = document.getElementById('searchTableInput').value.toLowerCase();
            const status = document.getElementById('statusFilter').value;
            const rows = document.querySelectorAll('.student-row');

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                const rowStatus = row.getAttribute('data-status');

                const matchesSearch = text.includes(search);
                const matchesStatus = !status || rowStatus === status;

                if (matchesSearch && matchesStatus) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
</body>
</html>
