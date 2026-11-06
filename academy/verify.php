<?php
require_once __DIR__ . '/config/config.php';

$certNo = trim($_GET['cert'] ?? '');
$certificate = null;
$searched = false;
$errorMsg = '';

if (!empty($certNo)) {
    $searched = true;
    if ($conn) {
        $stmt = $conn->prepare("SELECT * FROM `academy_certificates` WHERE `certificate_no` = ? LIMIT 1");
        if ($stmt) {
            $stmt->bind_param('s', $certNo);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res && $res->num_rows > 0) {
                $certificate = $res->fetch_assoc();
            } else {
                $errorMsg = "Nomor sertifikat <strong>" . htmlspecialchars($certNo) . "</strong> tidak ditemukan dalam basis data resmi Skillance Academy.";
            }
            $stmt->close();
        }
    } else {
        $errorMsg = "Sistem basis data verifikasi sedang dalam pemeliharaan. Silakan coba kembali beberapa saat lagi.";
    }
}

// Sample certificates for quick demonstration
$sampleCerts = [
    ['no' => 'SKL-2026-FE-8821', 'name' => 'Ahmad Faisal Pratama', 'track' => 'Frontend Web Developer'],
    ['no' => 'SKL-2026-FS-9102', 'name' => 'Siti Nurhaliza', 'track' => 'Fullstack Web Developer']
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $certificate ? 'Sertifikat Resmi: ' . htmlspecialchars($certificate['recipient_name']) . ' - ' : 'Verifikasi Sertifikat Digital - ' ?>Skillance Academy</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cinzel:wght@600;700;800&family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --navy: #0d2e5c;
            --navy-dark: #071a35;
            --gold: #fca311;
            --gold-dark: #d97706;
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

        .font-serif-cert {
            font-family: 'Cinzel', serif;
        }

        .font-signature {
            font-family: 'Great Vibes', cursive;
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
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }
        .course-subnav::-webkit-scrollbar {
            display: none;
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
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Verification Hero */
        .verify-hero {
            background: linear-gradient(135deg, #071a35 0%, #0d2e5c 60%, #00758f 100%);
            color: white;
            padding: 55px 0 45px;
            text-align: center;
        }

        /* Search Card */
        .search-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 24px 28px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
            margin-top: -30px;
            position: relative;
            z-index: 10;
        }

        /* DIGITAL CERTIFICATE CANVAS */
        .cert-wrapper {
            background: #ffffff;
            border: 12px solid #0d2e5c;
            border-radius: 12px;
            padding: 40px 48px;
            position: relative;
            box-shadow: 0 10px 35px rgba(0,0,0,0.12);
            background-image: 
                radial-gradient(circle at 50% 50%, rgba(252, 163, 17, 0.03) 0%, transparent 70%),
                linear-gradient(to right, rgba(13, 46, 92, 0.02) 1px, transparent 1px),
                linear-gradient(to bottom, rgba(13, 46, 92, 0.02) 1px, transparent 1px);
            background-size: 100% 100%, 20px 20px, 20px 20px;
            overflow: hidden;
        }

        /* Inner Ornamental Gold Border */
        .cert-inner-border {
            border: 2px solid #fca311;
            border-radius: 6px;
            padding: 30px 36px;
            position: relative;
        }
        .cert-inner-border::before {
            content: '❖';
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: #ffffff;
            padding: 0 14px;
            color: #fca311;
            font-size: 1.1rem;
        }

        .cert-watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-25deg);
            font-size: 8rem;
            color: rgba(13, 46, 92, 0.03);
            font-weight: 900;
            pointer-events: none;
            user-select: none;
            white-space: nowrap;
            font-family: 'Cinzel', serif;
        }

        .cert-gold-seal {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: radial-gradient(circle, #fca311 0%, #d97706 80%);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 15px rgba(217, 119, 6, 0.35);
            border: 3px dashed #ffffff;
            text-align: center;
            padding: 6px;
        }

        .cert-recipient-name {
            font-family: 'Cinzel', serif;
            font-size: 2.2rem;
            font-weight: 800;
            color: var(--navy);
            letter-spacing: 1px;
            border-bottom: 2px solid #fca311;
            display: inline-block;
            padding: 0 30px 8px;
            margin: 15px 0;
        }

        /* Competency Box */
        .competency-tag {
            background: #f1f5f9;
            color: #334155;
            font-size: 0.78rem;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            display: inline-block;
            margin: 2px;
        }

        /* Action Buttons */
        .btn-gold {
            background-color: var(--gold);
            color: var(--navy-dark);
            font-weight: 700;
            border: none;
            transition: all 0.2s;
        }
        .btn-gold:hover {
            background-color: #e5930e;
            color: var(--navy-dark);
            transform: translateY(-1px);
        }

        /* Mobile Adjustments */
        @media (max-width: 768px) {
            .cert-wrapper {
                padding: 16px;
                border-width: 6px;
            }
            .cert-inner-border {
                padding: 18px 12px;
            }
            .cert-recipient-name {
                font-size: 1.45rem;
                padding: 0 10px 5px;
            }
            .cert-gold-seal {
                width: 70px;
                height: 70px;
                font-size: 0.7rem;
            }
        }

        /* Print Mode: Exact Landscape A4 Format */
        @media print {
            .academy-navbar, .top-hub-bar, .course-subnav, .verify-hero, .search-card, .btn-print-hide, .cert-footer-info {
                display: none !important;
            }
            body {
                background: white !important;
                margin: 0 !important;
                padding: 0 !important;
            }
            .cert-wrapper {
                box-shadow: none !important;
                border: 10px solid #0d2e5c !important;
                page-break-inside: avoid;
                margin: 0 !important;
                padding: 24px 30px !important;
            }
            @page {
                size: A4 landscape;
                margin: 1cm;
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
                <span class="small" style="color: #cbd5e1;"><i class="fa-solid fa-shield-halved text-warning me-1"></i> Sistem Validasi SKPI & Sertifikat Resmi</span>
            </div>
        </div>
    </div>

    <!-- MAIN NAVBAR -->
    <nav class="navbar navbar-expand-lg academy-navbar py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
                <div class="bg-navy text-gold p-2 rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: #0d2e5c;">
                    <i class="fa-solid fa-graduation-cap fs-5 text-warning"></i>
                </div>
                <div>
                    <span class="fw-bold text-navy font-heading" style="font-size: 1.25rem; letter-spacing: -0.5px; color: #0d2e5c;">SKILLANCE ACADEMY</span>
                    <small class="d-block text-muted" style="font-size: 0.7rem; margin-top: -3px;">Pusat Belajar & Sertifikasi Koding Skillance Academy Indonesia</small>
                </div>
            </a>

            <div class="d-flex align-items-center gap-2 ms-auto">
                <a href="projects.php" class="btn btn-sm btn-outline-warning text-dark fw-bold rounded-pill px-3 py-2 d-none d-sm-inline">
                    <i class="fa-solid fa-book-bookmark text-warning me-1"></i> E-Book & Proyek
                </a>
                <a href="partner.php" class="btn btn-sm btn-outline-navy rounded-pill px-3 py-2 fw-bold text-navy d-none d-md-inline">
                    <i class="fa-solid fa-handshake me-1"></i> Kemitraan Kampus
                </a>
                <a href="roadmap.php" class="btn btn-sm btn-navy rounded-pill px-3 py-2 fw-bold text-white" style="background: #0d2e5c;">
                    <i class="fa-solid fa-map me-1"></i> Roadmap
                </a>
            </div>
        </div>
    </nav>

    <!-- QUICK SUBNAV -->
    <div class="course-subnav">
        <div class="container d-flex align-items-center">
            <a href="index.php" class="course-nav-item"><i class="fa-solid fa-house me-1"></i> Beranda</a>
            <a href="roadmap.php" class="course-nav-item"><i class="fa-solid fa-route me-1"></i> Roadmap Karier</a>
            <a href="projects.php" class="course-nav-item"><i class="fa-solid fa-laptop-code me-1"></i> Kit Studi Kasus Riil</a>
            <a href="exam.php" class="course-nav-item"><i class="fa-solid fa-award me-1"></i> Ujian Sertifikasi SKPI</a>
            <a href="my-learning.php" class="course-nav-item"><i class="fa-solid fa-user-graduate me-1"></i> Dasbor Siswa</a>
            <a href="partner.php" class="course-nav-item"><i class="fa-solid fa-building-columns me-1"></i> Kolaborasi UKM / Kampus</a>
            <a href="verify.php" class="course-nav-item active"><i class="fa-solid fa-certificate me-1 text-gold"></i> Cek Keaslian Sertifikat</a>
        </div>
    </div>

    <!-- VERIFICATION HERO -->
    <header class="verify-hero">
        <div class="container">
            <span class="badge bg-white bg-opacity-10 text-gold px-3 py-2 rounded-pill fw-bold mb-3 border border-warning border-opacity-25">
                <i class="fa-solid fa-award me-1"></i> Official Digital Credential Verification
            </span>
            <h1 class="display-6 fw-bold font-heading mb-2 text-white">Verifikasi Keaslian Sertifikat Digital</h1>
            <p class="lead mx-auto mb-3" style="max-width: 680px; color: #cbd5e1; font-size: 0.98rem; line-height: 1.7;">
                Setiap sertifikat kelulusan jalur belajar <strong>Skillance Academy Indonesia</strong> memiliki tanda tangan kriptografi dan kode unik yang dapat diverifikasi secara realtime untuk lampiran SKPI kampus maupun rekrutmen kerja.
            </p>
        </div>
    </header>

    <main class="container py-4">

        <!-- SEARCH FORM CARD -->
        <div class="search-card mb-5">
            <form action="verify.php" method="GET" class="row g-2 align-items-center">
                <div class="col-md-9 col-sm-8">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-barcode"></i></span>
                        <input type="text" name="cert" class="form-control form-control-lg border-start-0 fs-6 fw-semibold" placeholder="Masukkan Nomor Sertifikat (Contoh: SKL-2026-FE-8821)" value="<?= htmlspecialchars($certNo) ?>" required autocomplete="off">
                    </div>
                </div>
                <div class="col-md-3 col-sm-4">
                    <button type="submit" class="btn btn-navy btn-lg w-100 fw-bold fs-6 text-white" style="background: #0d2e5c;">
                        <i class="fa-solid fa-magnifying-glass me-1"></i> Verifikasi Sekarang
                    </button>
                </div>
            </form>

            <!-- Quick Sample Links -->
            <div class="d-flex flex-wrap align-items-center gap-2 mt-3 pt-2 border-top">
                <span class="small text-muted fw-semibold">Contoh Demo Verifikasi:</span>
                <?php foreach ($sampleCerts as $sc): ?>
                    <a href="verify.php?cert=<?= urlencode($sc['no']) ?>" class="badge bg-light text-navy border text-decoration-none py-2 px-3 fw-bold">
                        <i class="fa-solid fa-check-circle text-success me-1"></i> <?= $sc['no'] ?> (<?= $sc['name'] ?>)
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if (!empty($errorMsg)): ?>
            <!-- ERROR STATE -->
            <div class="alert alert-warning border-warning shadow-sm rounded-3 p-4 text-center my-4">
                <div class="fs-1 text-warning mb-2"><i class="fa-solid fa-triangle-exclamation"></i></div>
                <h4 class="fw-bold text-navy">Sertifikat Tidak Terdaftar</h4>
                <p class="mb-3 text-muted"><?= $errorMsg ?></p>
                <p class="small text-muted mb-0">Pastikan nomor sertifikat yang Anda masukkan sudah benar termasuk tanda hubung (-). Jika Anda merasa ini adalah kekeliruan, silakan hubungi tim akademik di <strong>support@skillance.my.id</strong>.</p>
            </div>
        <?php endif; ?>

        <?php if ($certificate): ?>
            <!-- CERTIFICATE VERIFIED CARD -->
            <div class="mb-4 d-flex flex-wrap justify-content-between align-items-center gap-2 btn-print-hide">
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-success px-3 py-2 fs-6 rounded-pill">
                        <i class="fa-solid fa-circle-check me-1"></i> Status: SERTIFIKAT VALID & TERDAFTAR RESMI
                    </span>
                    <span class="text-muted small d-none d-md-inline">ID: #<?= $certificate['id'] ?></span>
                </div>
                <div class="d-flex gap-2">
                    <button onclick="window.print()" class="btn btn-sm btn-outline-navy fw-bold rounded-pill px-3 py-2 text-navy" style="border-color: #0d2e5c;">
                        <i class="fa-solid fa-print me-1"></i> Cetak / Simpan PDF (A4)
                    </button>
                    <button onclick="copyShareUrl()" class="btn btn-sm btn-gold fw-bold rounded-pill px-3 py-2">
                        <i class="fa-solid fa-share-nodes me-1"></i> Salin Tautan
                    </button>
                </div>
            </div>

            <!-- PRINTABLE DIGITAL CERTIFICATE CONTAINER -->
            <div id="certificateCanvas" class="cert-wrapper mb-5">
                <div class="cert-watermark">SKILLANCE</div>
                
                <div class="cert-inner-border">
                    <!-- HEADER -->
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="p-2 rounded-3 text-white d-flex align-items-center justify-content-center shadow-sm" style="background: #0d2e5c; width: 50px; height: 50px;">
                                <i class="fa-solid fa-graduation-cap fs-4 text-warning"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0 text-navy font-heading" style="color: #0d2e5c; letter-spacing: -0.5px;">SKILLANCE ACADEMY</h4>
                                <small class="text-muted fw-semibold" style="font-size: 0.75rem; letter-spacing: 1px;">INSTITUT PENGEMBANGAN TALENTA DIGITAL INDONESIA</small>
                            </div>
                        </div>

                        <!-- GOLD SEAL BADGE -->
                        <div class="cert-gold-seal">
                            <i class="fa-solid fa-certificate fs-5 mb-1"></i>
                            <span style="font-size: 0.62rem; font-weight: 800; line-height: 1.1; text-transform: uppercase;">VALID CREDENTIAL</span>
                        </div>
                    </div>

                    <!-- CERT TITLE -->
                    <div class="text-center my-4">
                        <div class="font-serif-cert text-uppercase fw-bold text-muted small" style="letter-spacing: 3px;">SERTIFIKAT KELULUSAN & KOMPETENSI RESMI</div>
                        <h2 class="font-serif-cert fw-bold text-navy my-2" style="color: #0d2e5c; font-size: 1.9rem; letter-spacing: 2px;">
                            CERTIFICATE OF EXCELLENCE
                        </h2>
                        <p class="text-muted mb-3" style="font-size: 0.88rem;">Nomor Registrasi Kredensial: <strong class="text-dark font-monospace"><?= htmlspecialchars($certificate['certificate_no']) ?></strong></p>
                        
                        <p class="text-muted small mb-1">Dengan ini menyatakan bahwa:</p>
                        <div class="cert-recipient-name">
                            <?= htmlspecialchars($certificate['recipient_name']) ?>
                        </div>
                        <p class="text-muted" style="font-size: 0.95rem; max-width: 680px; margin: 0 auto; line-height: 1.7;">
                            Telah berhasil menyelesaikan seluruh kurikulum pembelajaran mandiri, praktikum kode sumber, serta lulus dalam Ujian Kompetensi Komprehensif berstandar industri pada jalur spesialisasi:
                        </p>
                        
                        <h3 class="fw-bold text-navy font-heading my-3" style="color: #0d2e5c;">
                            <?= htmlspecialchars($certificate['track_title']) ?>
                        </h3>
                    </div>

                    <!-- COMPETENCIES & EVALUATION -->
                    <div class="row align-items-center my-4 pt-3 border-top">
                        <div class="col-md-8 col-sm-7">
                            <h6 class="fw-bold text-navy mb-2" style="font-size: 0.85rem;"><i class="fa-solid fa-list-check text-warning me-1"></i> Cakupan Kompetensi Keahlian Teknis:</h6>
                            <div class="d-flex flex-wrap">
                                <?php 
                                $compList = explode(',', $certificate['competencies'] ?? '');
                                foreach ($compList as $cp): 
                                    $cp = trim($cp);
                                    if (!empty($cp)):
                                ?>
                                    <span class="competency-tag"><i class="fa-solid fa-check text-success me-1"></i> <?= htmlspecialchars($cp) ?></span>
                                <?php 
                                    endif;
                                endforeach; 
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-5 text-sm-end mt-3 mt-sm-0">
                            <div class="p-3 rounded-3 bg-light border text-center d-inline-block">
                                <span class="d-block small text-muted fw-bold">NILAI EVALUASI</span>
                                <span class="display-6 fw-bold text-success font-heading"><?= (int)$certificate['score'] ?></span>
                                <span class="d-block text-muted" style="font-size: 0.75rem;">Grade A (Sangat Memuaskan)</span>
                            </div>
                        </div>
                    </div>

                    <!-- SIGNATURES & QR CODE -->
                    <div class="row align-items-end mt-4 pt-3 border-top g-3">
                        <div class="col-4 text-center">
                            <div class="font-signature text-navy" style="font-size: 2.1rem; line-height: 1; color: #0d2e5c;">Anca R.</div>
                            <div class="fw-bold text-dark small" style="border-top: 1px solid #94a3b8; padding-top: 4px;">Anca Rusmana, S.Kom.</div>
                            <small class="text-muted d-block" style="font-size: 0.7rem;">Head of Curriculum & Technology</small>
                            <small class="text-muted d-block" style="font-size: 0.68rem;">Skillance Academy Indonesia</small>
                        </div>

                        <div class="col-4 text-center">
                            <?php 
                            $verifyUrl = "https://academy.skillance.cloud/verify.php?cert=" . urlencode($certificate['certificate_no']);
                            $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($verifyUrl);
                            ?>
                            <img src="<?= $qrUrl ?>" alt="QR Code Verifikasi" width="90" height="90" class="img-fluid border p-1 bg-white rounded shadow-sm">
                            <small class="d-block text-muted font-monospace mt-1" style="font-size: 0.65rem;">Scan untuk Validasi Online</small>
                        </div>

                        <div class="col-4 text-center">
                            <div class="font-signature text-navy" style="font-size: 2.1rem; line-height: 1; color: #0d2e5c;">Skillance ID</div>
                            <div class="fw-bold text-dark small" style="border-top: 1px solid #94a3b8; padding-top: 4px;">Tanggal Terbit Resmi</div>
                            <small class="text-muted d-block fw-semibold" style="font-size: 0.75rem;"><?= date('d F Y', strtotime($certificate['issue_date'])) ?></small>
                            <small class="text-muted d-block" style="font-size: 0.68rem;">Biro Sertifikasi & Kredensial</small>
                        </div>
                    </div>

                </div>
            </div>

            <!-- POST-CERTIFICATE HELPER INFO -->
            <div class="cert-footer-info bg-white border rounded-3 p-4 shadow-sm mb-5 btn-print-hide">
                <div class="row g-4 align-items-center">
                    <div class="col-md-8">
                        <h5 class="fw-bold text-navy font-heading mb-2">Informasi Tambahan untuk Pihak Kampus / HRD</h5>
                        <p class="text-muted small mb-2" style="line-height: 1.7;">
                            Sertifikat ini diterbitkan secara sah oleh <strong>Skillance Academy Indonesia</strong> sebagai bentuk pengakuan atas penguasaan kompetensi digital praktis. Dokumen ini dapat digunakan sebagai kelengkapan <strong>Surat Keterangan Pendamping Ijazah (SKPI)</strong>, portofolio magang, maupun berkas seleksi kerja profesional.
                        </p>
                        <div class="d-flex flex-wrap gap-2 pt-1">
                            <span class="badge bg-light text-navy border"><i class="fa-solid fa-lock text-success me-1"></i> Database Terenkripsi</span>
                            <span class="badge bg-light text-navy border"><i class="fa-solid fa-fingerprint text-primary me-1"></i> ID Unik Anti-Pemalsuan</span>
                            <span class="badge bg-light text-navy border"><i class="fa-solid fa-globe text-warning me-1"></i> Dapat Diakses Publik</span>
                        </div>
                    </div>
                    <div class="col-md-4 text-md-end">
                        <a href="https://skillance.my.id/bursa-freelance.php" class="btn btn-navy text-white fw-bold px-4 py-3 rounded-pill shadow-sm" style="background: #0d2e5c;">
                            <i class="fa-solid fa-briefcase text-warning me-1"></i> Cek Bursa Freelance &raquo;
                        </a>
                    </div>
                </div>
            </div>

        <?php elseif (!$searched): ?>
            <!-- EXPLANATION SECTION WHEN NO CERT NO QUERIED -->
            <div class="row g-4 my-2">
                <div class="col-md-4">
                    <div class="card h-100 border p-4 rounded-3 shadow-sm bg-white">
                        <div class="rounded-3 p-3 bg-primary bg-opacity-10 text-primary d-inline-block mb-3" style="width: 50px; height: 50px;">
                            <i class="fa-solid fa-shield-halved fs-4"></i>
                        </div>
                        <h5 class="fw-bold text-navy font-heading">Terverifikasi Realtime</h5>
                        <p class="text-muted small mb-0" style="line-height: 1.6;">
                            Setiap sertifikat tersimpan permanen di cloud database Skillance Academy. HRD dan dosen penguji dapat memverifikasi keabsahannya kapan saja hanya dengan scan QR Code.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border p-4 rounded-3 shadow-sm bg-white">
                        <div class="rounded-3 p-3 bg-warning bg-opacity-10 text-warning d-inline-block mb-3" style="width: 50px; height: 50px;">
                            <i class="fa-solid fa-file-shield fs-4"></i>
                        </div>
                        <h5 class="fw-bold text-navy font-heading">Standar Lampiran SKPI</h5>
                        <p class="text-muted small mb-0" style="line-height: 1.6;">
                            Disusun memenuhi standar capaian pembelajaran nasional (CPL) dan dapat langsung dilampirkan sebagai Surat Keterangan Pendamping Ijazah (SKPI) bagi mahasiswa diploma dan sarjana.
                        </p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card h-100 border p-4 rounded-3 shadow-sm bg-white">
                        <div class="rounded-3 p-3 bg-success bg-opacity-10 text-success d-inline-block mb-3" style="width: 50px; height: 50px;">
                            <i class="fa-solid fa-briefcase fs-4"></i>
                        </div>
                        <h5 class="fw-bold text-navy font-heading">Prioritas di Bursa Kerja</h5>
                        <p class="text-muted small mb-0" style="line-height: 1.6;">
                            Pemilik sertifikat kompetensi resmi mendapatkan badge khusus di <strong>Skillance Freelance</strong> untuk menarik lebih banyak klien proyek pembuatan website dan aplikasi.
                        </p>
                    </div>
                </div>
            </div>
        <?php endif; ?>

    </main>

    <!-- FOOTER -->
    <footer class="py-4 bg-white border-top text-center text-muted small mt-5 btn-print-hide">
        <div class="container">
            <p class="mb-1 fw-semibold">&copy; <?= date('Y') ?> <strong>Skillance Academy Indonesia</strong> — Sistem Sertifikasi & Pengembangan Talenta Digital.</p>
            <p class="mb-0 text-muted" style="font-size: 0.75rem;">Materi dan sertifikat resmi diterbitkan untuk tujuan akademik dan profesional di bawah naungan Skillance Indonesia.</p>
        </div>
    </footer>

    <script>
        function copyShareUrl() {
            const url = window.location.href;
            navigator.clipboard.writeText(url).then(() => {
                alert('Tautan verifikasi sertifikat berhasil disalin ke clipboard:\n' + url);
            }).catch(() => {
                prompt('Salin tautan ini:', url);
            });
        }
    </script>
</body>
</html>
