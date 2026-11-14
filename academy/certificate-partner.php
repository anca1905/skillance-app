<?php
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/data/partners_data.php';

$certNo = trim($_GET['cert'] ?? 'SKL-MSC-2026-001');
$partnerSlug = trim($_GET['partner'] ?? 'msc-usn');
$partner = getPartnerBySlug($partnerSlug);

$student = getPartnerStudentByCert($certNo);
if (!$student) {
    // Fallback to first student
    $allStudents = getPartnerCohortStudents($partnerSlug);
    $student = $allStudents[0];
}

$trackKey = $student['track_id'];
$trackInfo = $partner['exclusive_tracks'][$trackKey] ?? reset($partner['exclusive_tracks']);

$verifyUrl = "https://academy.skillance.cloud/verify.php?cert=" . urlencode($student['cert_no']);
$qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=140x140&data=" . urlencode($verifyUrl);

// Master SEO Configuration
$seoTitle = 'Sertifikat Tripartit SKPI: ' . $student['name'] . ' - ' . $partner['short_name'];
$seoDesc = 'Sertifikat resmi kelulusan program kemitraan ' . $partner['name'] . ' atas nama ' . $student['name'] . ' (' . $student['nim'] . ').';
$seoKeywords = 'sertifikat tripartit, skpi usn kolaka, skillance academy, ukm msc';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($seoTitle) ?></title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cinzel:wght@600;700;800&family=Great+Vibes&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

    <style>
        :root {
            --navy: #0d2e5c;
            --navy-dark: #071a35;
            --gold: #fca311;
            --gold-dark: #d97706;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #0b1329;
            color: #1e293b;
            margin: 0;
            padding: 20px 10px 40px;
        }

        .cert-canvas-wrapper {
            max-width: 1040px;
            margin: 0 auto;
        }

        /* Fixed Landscape A4 Proportion (Zero Overflow Cut) */
        .cert-card {
            width: 1000px;
            height: 680px;
            max-height: 680px;
            background: #ffffff;
            margin: 0 auto 30px auto;
            padding: 16px;
            box-sizing: border-box;
            border: 8px solid #0d2e5c;
            box-shadow: 0 12px 40px rgba(0,0,0,0.5);
            position: relative;
            background-image: radial-gradient(circle at 50% 50%, #ffffff 0%, #fbfcfe 100%);
            page-break-after: always;
            page-break-inside: avoid !important;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .cert-border-inner {
            border: 2px solid #fca311;
            padding: 16px 22px 14px;
            position: relative;
            background: #ffffff;
            height: 100%;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .cert-border-inner::before {
            content: '❖';
            position: absolute;
            top: -11px;
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
            transform: translate(-50%, -50%) rotate(-18deg);
            font-size: 6.8rem;
            color: rgba(13, 46, 92, 0.035);
            font-weight: 900;
            pointer-events: none;
            user-select: none;
            font-family: 'Cinzel', serif;
            letter-spacing: 10px;
            white-space: nowrap;
        }

        .font-serif-cert {
            font-family: 'Cinzel', serif;
        }

        .cert-recipient-name {
            font-family: 'Cinzel', serif;
            font-size: 2.05rem;
            font-weight: 800;
            color: #0d2e5c;
            letter-spacing: 1.2px;
            border-bottom: 2px solid #fca311;
            display: inline-block;
            padding: 0 35px 3px;
            margin: 4px 0 6px;
            line-height: 1.2;
        }

        /* Signatures Container */
        .sig-block {
            position: relative;
            text-align: center;
        }

        .sig-img-container {
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .sig-stamp-overlay {
            position: absolute;
            top: -16px;
            right: 0px;
            max-height: 72px;
            opacity: 0.88;
            pointer-events: none;
            transform: rotate(-8deg);
        }

        /* Navigation Tab Pill */
        .nav-pills .nav-link {
            border-radius: 50rem;
            font-size: 0.84rem;
            font-weight: 600;
            color: #cbd5e1;
            padding: 6px 16px;
        }
        .nav-pills .nav-link.active {
            background-color: var(--gold);
            color: #071a35;
        }

        /* Print Settings */
        @media print {
            @page {
                size: A4 landscape;
                margin: 0;
            }
            body {
                background: white !important;
                padding: 0 !important;
                margin: 0 !important;
            }
            .btn-print-hide {
                display: none !important;
            }
            .cert-canvas-wrapper {
                max-width: 100% !important;
                margin: 0 !important;
            }
            .cert-card {
                width: 100% !important;
                height: 100vh !important;
                max-height: 100vh !important;
                box-shadow: none !important;
                border-width: 6px !important;
                margin: 0 !important;
                page-break-after: always !important;
            }
            #page1Card, #page2Card {
                display: flex !important;
            }
        }
    </style>
</head>
<body>

    <div class="cert-canvas-wrapper">

        <!-- ACTION TOP BAR & VIEW SWITCHER -->
        <div class="bg-white p-3 rounded-4 shadow mb-4 btn-print-hide">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div class="d-flex align-items-center gap-2">
                    <a href="dashboard-partner.php?partner=<?= urlencode($partnerSlug) ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                        <i class="fa-solid fa-arrow-left me-1"></i> Dashboard Mitra
                    </a>
                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 rounded-pill small">
                        <i class="fa-solid fa-shield-check me-1"></i> Kredensial Resmi Tripartit
                    </span>
                </div>

                <!-- VIEW TABS -->
                <ul class="nav nav-pills bg-dark p-1 rounded-pill" id="certTab">
                    <li class="nav-item">
                        <button class="nav-link active" onclick="switchCertPage('front')">
                            <i class="fa-solid fa-file-lines me-1"></i> Halaman 1 (Sertifikat)
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" onclick="switchCertPage('back')">
                            <i class="fa-solid fa-list-check me-1"></i> Halaman 2 (Transkrip SKPI)
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" onclick="switchCertPage('both')">
                            <i class="fa-solid fa-layer-group me-1"></i> Tampilkan Keduanya
                        </button>
                    </li>
                </ul>

                <!-- DOWNLOAD & PRINT BUTTONS -->
                <div class="d-flex gap-2">
                    <button onclick="downloadPdfHD()" class="btn btn-sm btn-success fw-bold rounded-pill px-3 py-2 text-white shadow-sm">
                        <i class="fa-solid fa-file-pdf me-1"></i> Download PDF HD
                    </button>
                    <button onclick="window.print()" class="btn btn-sm btn-primary fw-bold rounded-pill px-3 py-2">
                        <i class="fa-solid fa-print me-1"></i> Cetak Printer
                    </button>
                </div>
            </div>
        </div>

        <div id="printArea">

            <!-- ========================================== -->
            <!-- HALAMAN 1: MUKA DEPAN SERTIFIKAT TRIPARTIT -->
            <!-- ========================================== -->
            <div id="page1Card" class="cert-card">
                <div class="cert-watermark">SKPI RESMI</div>
                
                <div class="cert-border-inner">
                    <!-- KOP 3 LOGO -->
                    <div class="d-flex justify-content-between align-items-center pb-2 border-bottom border-2">
                        <!-- LOGO FAKULTAS -->
                        <div class="text-start" style="width: 28%;">
                            <img src="<?= htmlspecialchars($partner['logo_faculty']) ?>" alt="Logo Fakultas" style="max-height: 46px; max-width: 140px; object-fit: contain;">
                            <div class="fw-bold text-dark text-uppercase mt-1" style="font-size: 0.68rem; letter-spacing: 0.5px; line-height: 1.2;">
                                <?= htmlspecialchars($partner['faculty']) ?>
                            </div>
                            <small class="text-muted d-block" style="font-size: 0.62rem;"><?= htmlspecialchars($partner['institution']) ?></small>
                        </div>

                        <!-- LOGO SKILLANCE (INDUSTRY) -->
                        <div class="text-center" style="width: 44%;">
                            <img src="<?= htmlspecialchars($partner['logo_industry']) ?>" alt="Logo PT Skillance" style="max-height: 44px; max-width: 200px; object-fit: contain;">
                            <div class="text-muted fw-bold text-uppercase mt-1" style="font-size: 0.65rem; letter-spacing: 1.2px;">
                                MITRA TEKNOLOGI & KURIKULUM INDUSTRI
                            </div>
                        </div>

                        <!-- LOGO UKM MSC (ORMAWA) -->
                        <div class="text-end" style="width: 28%;">
                            <img src="<?= htmlspecialchars($partner['logo_org']) ?>" alt="Logo UKM MSC" style="max-height: 42px; max-width: 120px; object-fit: contain;">
                            <div class="fw-bold text-dark text-uppercase mt-1" style="font-size: 0.68rem; letter-spacing: 0.5px; line-height: 1.2;">
                                <?= htmlspecialchars($partner['organization']) ?>
                            </div>
                            <small class="text-muted d-block" style="font-size: 0.62rem;">Pelaksana Teknis Kemahasiswaan</small>
                        </div>
                    </div>

                    <!-- CERTIFICATE TITLE -->
                    <div class="text-center my-auto py-1">
                        <div class="font-serif-cert text-uppercase fw-bold text-muted" style="letter-spacing: 2.5px; font-size: 0.78rem;">
                            SERTIFIKAT KELULUSAN & KOMPETENSI RESMI
                        </div>
                        <h2 class="font-serif-cert fw-bold my-1" style="color: #0d2e5c; font-size: 1.85rem; letter-spacing: 1.5px; line-height: 1.1;">
                            CERTIFICATE OF EXCELLENCE
                        </h2>
                        <div class="text-muted" style="font-size: 0.76rem;">
                            Nomor Sertifikat: <strong class="text-dark font-monospace"><?= htmlspecialchars($student['cert_no']) ?></strong> | 
                            Nomor PKS: <strong class="text-dark font-monospace"><?= htmlspecialchars($partner['pks_number']) ?></strong>
                        </div>

                        <p class="text-muted small mt-2 mb-0" style="font-size: 0.78rem;">Diberikan kepada:</p>
                        <div class="cert-recipient-name">
                            <?= htmlspecialchars($student['name']) ?>
                        </div>
                        <div class="text-muted fw-semibold mb-2" style="font-size: 0.88rem;">
                            NIM: <strong class="text-dark font-monospace"><?= htmlspecialchars($student['nim']) ?></strong> | Program Studi: <?= htmlspecialchars($student['study_program']) ?>
                        </div>

                        <p class="text-muted mx-auto mb-1" style="max-width: 760px; font-size: 0.82rem; line-height: 1.5;">
                            Telah berhasil menyelesaikan seluruh kurikulum pembelajaran teknis, praktikum kode sumber, dan lulus dalam Ujian Kompetensi Komprehensif berbobot <strong><?= $student['total_jp'] ?> Jam Pelajaran (JP)</strong> pada program kemitraan perguruan tinggi dan industri:
                        </p>

                        <h4 class="fw-bold my-1" style="color: #0d2e5c; font-size: 1.15rem;">
                            "<?= htmlspecialchars($student['track_title']) ?>"
                        </h4>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 font-monospace" style="font-size: 0.78rem;">
                            Predikat Kelulusan: <?= htmlspecialchars($student['grade']) ?> (Skor: <?= $student['exam_score'] ?>/100)
                        </span>
                    </div>

                    <!-- 3 TANDA TANGAN & STEMPEL TRIPARTIT -->
                    <div class="row align-items-end pt-2 border-top border-2 g-2">
                        <!-- TTD 1: MITRA INDUSTRI (SKILLANCE) -->
                        <div class="col-3 sig-block">
                            <div class="sig-img-container">
                                <img src="<?= htmlspecialchars($partner['signature_industry']) ?>" alt="TTD Direktur" style="max-height: 44px; z-index: 2; position: relative;">
                                <img src="<?= htmlspecialchars($partner['stamp_industry']) ?>" alt="Stempel PT Skillance" class="sig-stamp-overlay">
                            </div>
                            <div class="fw-bold text-dark small" style="border-top: 1px solid #64748b; padding-top: 2px; font-size: 0.78rem;">
                                <?= htmlspecialchars($partner['signers']['industry']['name']) ?>
                            </div>
                            <small class="text-muted d-block" style="font-size: 0.65rem;"><?= htmlspecialchars($partner['signers']['industry']['title']) ?></small>
                            <small class="text-muted d-block" style="font-size: 0.62rem;"><?= htmlspecialchars($partner['signers']['industry']['company']) ?></small>
                        </div>

                        <!-- TTD 2: QR CODE VALIDASI -->
                        <div class="col-3 text-center">
                            <img src="<?= $qrUrl ?>" alt="QR Code" width="62" height="62" class="border p-1 bg-white rounded shadow-sm">
                            <small class="d-block text-muted font-monospace mt-1" style="font-size: 0.60rem;">Scan Validasi Online</small>
                            <small class="text-muted d-block" style="font-size: 0.60rem;">Terbit: <?= date('d M Y', strtotime($student['issue_date'])) ?></small>
                        </div>

                        <!-- TTD 3: UKM MSC -->
                        <div class="col-3 sig-block">
                            <div class="sig-img-container">
                                <div class="font-signature text-navy" style="font-size: 1.5rem; line-height: 1;">Fadel Al-Farizi</div>
                            </div>
                            <div class="fw-bold text-dark small" style="border-top: 1px solid #64748b; padding-top: 2px; font-size: 0.78rem;">
                                <?= htmlspecialchars($partner['signers']['org']['name']) ?>
                            </div>
                            <small class="text-muted d-block" style="font-size: 0.65rem;"><?= htmlspecialchars($partner['signers']['org']['title']) ?></small>
                            <small class="text-muted d-block" style="font-size: 0.62rem;"><?= htmlspecialchars($partner['signers']['org']['company']) ?></small>
                        </div>

                        <!-- TTD 4: WADEK FAKULTAS -->
                        <div class="col-3 sig-block">
                            <div class="sig-img-container">
                                <div class="text-muted small border border-dashed rounded p-1" style="font-size: 0.58rem; line-height: 1.1;">
                                    Tanda Tangan & Cap Stempel Fakultas
                                </div>
                            </div>
                            <div class="fw-bold text-dark small" style="border-top: 1px solid #64748b; padding-top: 2px; font-size: 0.78rem;">
                                <?= htmlspecialchars($partner['signers']['faculty']['name']) ?>
                            </div>
                            <small class="text-muted d-block" style="font-size: 0.65rem;"><?= htmlspecialchars($partner['signers']['faculty']['title']) ?></small>
                            <small class="text-muted d-block" style="font-size: 0.62rem;"><?= htmlspecialchars($partner['signers']['faculty']['id_number']) ?></small>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ============================================== -->
            <!-- HALAMAN 2: MUKA BELAKANG (TRANSKRIP SKPI & JP) -->
            <!-- ============================================== -->
            <div id="page2Card" class="cert-card" style="display: none;">
                <div class="cert-border-inner">
                    <div class="text-center pb-2 border-bottom border-2">
                        <h4 class="font-serif-cert fw-bold text-navy mb-0" style="color: #0d2e5c; letter-spacing: 1px; font-size: 1.15rem;">
                            TRANSKRIP CAPAIAN PEMBELAJARAN & BEBAN JAM PELAJARAN (JP)
                        </h4>
                        <div class="text-muted small font-monospace" style="font-size: 0.74rem;">
                            Lampiran Sertifikat Nomor: <?= htmlspecialchars($student['cert_no']) ?>
                        </div>
                    </div>

                    <!-- DATA SISWA SINGKAT -->
                    <div class="row g-1 my-1 bg-light p-2 rounded border" style="font-size: 0.80rem;">
                        <div class="col-md-6">
                            <div>Nama Mahasiswa: <strong class="text-dark"><?= htmlspecialchars($student['name']) ?></strong></div>
                            <div>NIM: <strong class="text-dark font-monospace"><?= htmlspecialchars($student['nim']) ?></strong></div>
                        </div>
                        <div class="col-md-6">
                            <div>Program Studi: <strong class="text-dark"><?= htmlspecialchars($student['study_program']) ?></strong></div>
                            <div>Institusi: <strong class="text-dark"><?= htmlspecialchars($partner['institution']) ?></strong></div>
                        </div>
                    </div>

                    <!-- TABEL SILABUS DAN JP -->
                    <table class="table table-bordered table-sm my-auto" style="font-size: 0.78rem;">
                        <thead class="table-light text-center">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th style="width: 35%;">Unit Kompetensi & Materi Silabus</th>
                                <th style="width: 45%;">Capaian Pembelajaran Lulusan (CPL)</th>
                                <th style="width: 15%;">Beban (JP)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $mNo = 1;
                            $sumJp = 0;
                            foreach ($trackInfo['modules'] as $mod): 
                                $sumJp += $mod['jp'];
                            ?>
                                <tr>
                                    <td class="text-center fw-bold"><?= $mNo++ ?></td>
                                    <td class="fw-bold text-navy"><?= htmlspecialchars($mod['title']) ?></td>
                                    <td><?= htmlspecialchars($mod['competency']) ?></td>
                                    <td class="text-center font-monospace fw-bold"><?= $mod['jp'] ?> JP</td>
                                </tr>
                            <?php endforeach; ?>
                            <tr class="table-warning fw-bold">
                                <td colspan="3" class="text-end">TOTAL BEBAN PEMBELAJARAN TERSERTIFIKASI:</td>
                                <td class="text-center font-monospace"><?= $sumJp ?> JP</td>
                            </tr>
                        </tbody>
                    </table>

                    <!-- KETERANGAN LEGALITAS SKPI -->
                    <div class="p-2 rounded bg-white border mt-1" style="font-size: 0.74rem; line-height: 1.5; text-align: justify;">
                        <strong class="text-navy d-block mb-1"><i class="fa-solid fa-scale-balanced me-1 text-warning"></i> Catatan Legalitas & Standar Kualifikasi:</strong>
                        Sertifikat dan transkrip ini diterbitkan berdasarkan kesepakatan bersama antara Perguruan Tinggi dan Mitra Industri sebagai dokumen resmi pelengkap Surat Keterangan Pendamping Ijazah (SKPI) sesuai dengan Peraturan Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi Republik Indonesia. Kompetensi yang tercantum telah diuji secara komprehensif melalui praktikum proyek nyata dan ujian penilaian berbasis standar industri.
                    </div>

                    <div class="d-flex justify-content-between align-items-center text-muted pt-2 border-top" style="font-size: 0.70rem;">
                        <span>Verifikasi digital aktif di: <strong class="text-primary"><?= $verifyUrl ?></strong></span>
                        <span>Dicetak secara terpusat oleh Biro Sertifikasi Skillance Academy</span>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <script>
        let currentTabMode = 'front';

        function switchCertPage(mode) {
            currentTabMode = mode;
            const p1 = document.getElementById('page1Card');
            const p2 = document.getElementById('page2Card');
            const navLinks = document.querySelectorAll('#certTab .nav-link');

            navLinks.forEach(nl => nl.classList.remove('active'));

            if (mode === 'front') {
                p1.style.display = 'flex';
                p2.style.display = 'none';
                navLinks[0].classList.add('active');
            } else if (mode === 'back') {
                p1.style.display = 'none';
                p2.style.display = 'flex';
                navLinks[1].classList.add('active');
            } else {
                p1.style.display = 'flex';
                p2.style.display = 'flex';
                navLinks[2].classList.add('active');
            }
        }

        function downloadPdfHD() {
            // Ensure both pages are visible for PDF export
            const p1 = document.getElementById('page1Card');
            const p2 = document.getElementById('page2Card');
            p1.style.display = 'flex';
            p2.style.display = 'flex';

            const element = document.getElementById('printArea');
            const opt = {
                margin:       0,
                filename:     'Sertifikat_Tripartit_<?= preg_replace("/[^A-Za-z0-9]/", "_", $student["name"]) ?>.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true, logging: false },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'landscape' },
                pagebreak:    { mode: ['avoid-all', 'css', 'legacy'] }
            };

            html2pdf().set(opt).from(element).save().then(() => {
                // Restore previous active tab mode
                switchCertPage(currentTabMode);
            });
        }
    </script>
</body>
</html>
