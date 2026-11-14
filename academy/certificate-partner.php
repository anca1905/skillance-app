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
$qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=" . urlencode($verifyUrl);

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
            background-color: #0f172a;
            color: #1e293b;
            margin: 0;
            padding: 30px 10px;
        }

        .cert-canvas-wrapper {
            max-width: 1040px;
            margin: 0 auto;
        }

        /* Front Certificate Styling (Landscape A4-ratio) */
        .cert-card {
            background: #ffffff;
            border-radius: 4px;
            box-shadow: 0 15px 45px rgba(0,0,0,0.4);
            padding: 32px;
            position: relative;
            background-image: 
                radial-gradient(circle at 50% 50%, rgba(253, 251, 247, 1) 0%, rgba(248, 250, 252, 1) 100%);
            border: 8px solid #0d2e5c;
            margin-bottom: 40px;
            page-break-after: always;
        }

        .cert-border-inner {
            border: 2px solid #fca311;
            padding: 30px;
            position: relative;
            background: #ffffff;
        }

        .cert-border-inner::before {
            content: '❖';
            position: absolute;
            top: -12px;
            left: 50%;
            transform: translateX(-50%);
            background: #ffffff;
            padding: 0 16px;
            color: #fca311;
            font-size: 1.2rem;
        }

        .cert-watermark {
            position: absolute;
            top: 52%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-20deg);
            font-size: 7.5rem;
            color: rgba(13, 46, 92, 0.035);
            font-weight: 900;
            pointer-events: none;
            user-select: none;
            font-family: 'Cinzel', serif;
            letter-spacing: 12px;
            white-space: nowrap;
        }

        .font-serif-cert {
            font-family: 'Cinzel', serif;
        }

        .cert-recipient-name {
            font-family: 'Cinzel', serif;
            font-size: 2.3rem;
            font-weight: 800;
            color: #0d2e5c;
            letter-spacing: 1.5px;
            border-bottom: 2px solid #fca311;
            display: inline-block;
            padding: 0 40px 6px;
            margin: 10px 0;
        }

        /* Gold Seal Badge */
        .gold-seal-tripartit {
            width: 82px;
            height: 82px;
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
            padding: 4px;
        }

        /* Signature block positioning with Stamp Overlay */
        .sig-block {
            position: relative;
            text-align: center;
        }

        .sig-img-container {
            height: 65px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .sig-stamp-overlay {
            position: absolute;
            top: -15px;
            right: 10px;
            max-height: 85px;
            opacity: 0.88;
            pointer-events: none;
            transform: rotate(-10deg);
        }

        /* Print Settings */
        @media print {
            body {
                background: white !important;
                padding: 0 !important;
            }
            .btn-print-hide {
                display: none !important;
            }
            .cert-card {
                box-shadow: none !important;
                border-width: 6px !important;
                margin: 0 !important;
            }
        }
    </style>
</head>
<body>

    <div class="cert-canvas-wrapper">

        <!-- ACTION TOP BAR -->
        <div class="d-flex flex-wrap justify-content-between align-items-center bg-white p-3 rounded-3 shadow-sm mb-4 btn-print-hide">
            <div class="d-flex align-items-center gap-2">
                <a href="dashboard-partner.php?partner=<?= urlencode($partnerSlug) ?>" class="btn btn-sm btn-outline-secondary rounded-pill px-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Dashboard
                </a>
                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-2 py-1">
                    <i class="fa-solid fa-shield-check me-1"></i> Kredensial Resmi Tripartit
                </span>
            </div>

            <div class="d-flex gap-2">
                <button onclick="downloadPdf()" class="btn btn-sm btn-success fw-bold rounded-pill px-3 py-2 text-white shadow-sm">
                    <i class="fa-solid fa-file-pdf me-1"></i> Download PDF HD (Depan & Belakang)
                </button>
                <button onclick="window.print()" class="btn btn-sm btn-primary fw-bold rounded-pill px-3 py-2">
                    <i class="fa-solid fa-print me-1"></i> Cetak Printer
                </button>
            </div>
        </div>

        <div id="printArea">

            <!-- ========================================== -->
            <!-- HALAMAN 1: MUKA DEPAN SERTIFIKAT TRIPARTIT -->
            <!-- ========================================== -->
            <div class="cert-card">
                <div class="cert-watermark">SKPI RESMI</div>
                
                <div class="cert-border-inner">
                    <!-- KOP 3 LOGO -->
                    <div class="d-flex justify-content-between align-items-center mb-3 pb-3 border-bottom border-2">
                        <!-- LOGO FAKULTAS -->
                        <div class="text-start" style="width: 28%;">
                            <img src="<?= htmlspecialchars($partner['logo_faculty']) ?>" alt="Logo Fakultas" style="max-height: 52px; max-width: 140px; object-fit: contain;">
                            <div class="fw-bold text-dark text-uppercase mt-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">
                                <?= htmlspecialchars($partner['faculty']) ?>
                            </div>
                            <small class="text-muted d-block" style="font-size: 0.65rem;"><?= htmlspecialchars($partner['institution']) ?></small>
                        </div>

                        <!-- LOGO SKILLANCE (INDUSTRY) -->
                        <div class="text-center" style="width: 44%;">
                            <img src="<?= htmlspecialchars($partner['logo_industry']) ?>" alt="Logo PT Skillance" style="max-height: 48px; max-width: 210px; object-fit: contain;">
                            <div class="text-muted fw-bold text-uppercase mt-1" style="font-size: 0.68rem; letter-spacing: 1.5px;">
                                MITRA TEKNOLOGI & KURIKULUM INDUSTRI
                            </div>
                        </div>

                        <!-- LOGO UKM MSC (ORMAWA) -->
                        <div class="text-end" style="width: 28%;">
                            <img src="<?= htmlspecialchars($partner['logo_org']) ?>" alt="Logo UKM MSC" style="max-height: 46px; max-width: 130px; object-fit: contain;">
                            <div class="fw-bold text-dark text-uppercase mt-1" style="font-size: 0.72rem; letter-spacing: 0.5px;">
                                <?= htmlspecialchars($partner['organization']) ?>
                            </div>
                            <small class="text-muted d-block" style="font-size: 0.65rem;">Pelaksana Teknis Kemahasiswaan</small>
                        </div>
                    </div>

                    <!-- CERTIFICATE TITLE -->
                    <div class="text-center my-3">
                        <div class="font-serif-cert text-uppercase fw-bold text-muted" style="letter-spacing: 3px; font-size: 0.85rem;">
                            SERTIFIKAT KELULUSAN & KOMPETENSI RESMI
                        </div>
                        <h2 class="font-serif-cert fw-bold my-1" style="color: #0d2e5c; font-size: 2.1rem; letter-spacing: 2px;">
                            CERTIFICATE OF EXCELLENCE
                        </h2>
                        <div class="text-muted" style="font-size: 0.82rem;">
                            Nomor Sertifikat: <strong class="text-dark font-monospace"><?= htmlspecialchars($student['cert_no']) ?></strong> | 
                            Nomor PKS: <strong class="text-dark font-monospace"><?= htmlspecialchars($partner['pks_number']) ?></strong>
                        </div>

                        <p class="text-muted small mt-3 mb-0">Diberikan kepada:</p>
                        <div class="cert-recipient-name">
                            <?= htmlspecialchars($student['name']) ?>
                        </div>
                        <div class="text-muted fw-semibold mb-2" style="font-size: 0.95rem;">
                            NIM: <strong class="text-dark font-monospace"><?= htmlspecialchars($student['nim']) ?></strong> | Program Studi: <?= htmlspecialchars($student['study_program']) ?>
                        </div>

                        <p class="text-muted mx-auto mb-2" style="max-width: 780px; font-size: 0.88rem; line-height: 1.6;">
                            Telah berhasil menyelesaikan seluruh kurikulum pembelajaran teknis, praktikum kode sumber, dan lulus dalam Ujian Kompetensi Komprehensif berbobot <strong><?= $student['total_jp'] ?> Jam Pelajaran (JP)</strong> pada program kemitraan perguruan tinggi dan industri:
                        </p>

                        <h4 class="fw-bold my-2" style="color: #0d2e5c; font-size: 1.25rem;">
                            "<?= htmlspecialchars($student['track_title']) ?>"
                        </h4>
                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-1 font-monospace" style="font-size: 0.85rem;">
                            Predikat Kelulusan: <?= htmlspecialchars($student['grade']) ?> (Skor: <?= $student['exam_score'] ?>/100)
                        </span>
                    </div>

                    <!-- 3 TANDA TANGAN & STEMPEL TRIPARTIT -->
                    <div class="row align-items-end mt-4 pt-3 border-top border-2 g-2">
                        <!-- TTD 1: MITRA INDUSTRI (SKILLANCE) -->
                        <div class="col-3 sig-block">
                            <div class="sig-img-container">
                                <img src="<?= htmlspecialchars($partner['signature_industry']) ?>" alt="TTD Direktur" style="max-height: 52px; z-index: 2; position: relative;">
                                <img src="<?= htmlspecialchars($partner['stamp_industry']) ?>" alt="Stempel PT Skillance" class="sig-stamp-overlay">
                            </div>
                            <div class="fw-bold text-dark small" style="border-top: 1px solid #64748b; padding-top: 3px;">
                                <?= htmlspecialchars($partner['signers']['industry']['name']) ?>
                            </div>
                            <small class="text-muted d-block" style="font-size: 0.68rem;"><?= htmlspecialchars($partner['signers']['industry']['title']) ?></small>
                            <small class="text-muted d-block" style="font-size: 0.65rem;"><?= htmlspecialchars($partner['signers']['industry']['company']) ?></small>
                        </div>

                        <!-- TTD 2: QR CODE VALIDASI -->
                        <div class="col-3 text-center">
                            <img src="<?= $qrUrl ?>" alt="QR Code" width="75" height="75" class="border p-1 bg-white rounded shadow-sm">
                            <small class="d-block text-muted font-monospace mt-1" style="font-size: 0.62rem;">Scan Validasi Online</small>
                            <small class="text-muted d-block" style="font-size: 0.65rem;">Terbit: <?= date('d F Y', strtotime($student['issue_date'])) ?></small>
                        </div>

                        <!-- TTD 3: UKM MSC -->
                        <div class="col-3 sig-block">
                            <div class="sig-img-container">
                                <div class="font-signature text-navy" style="font-size: 1.8rem; line-height: 1;">Fadel Al-Farizi</div>
                            </div>
                            <div class="fw-bold text-dark small" style="border-top: 1px solid #64748b; padding-top: 3px;">
                                <?= htmlspecialchars($partner['signers']['org']['name']) ?>
                            </div>
                            <small class="text-muted d-block" style="font-size: 0.68rem;"><?= htmlspecialchars($partner['signers']['org']['title']) ?></small>
                            <small class="text-muted d-block" style="font-size: 0.65rem;"><?= htmlspecialchars($partner['signers']['org']['company']) ?></small>
                        </div>

                        <!-- TTD 4: WADEK FAKULTAS -->
                        <div class="col-3 sig-block">
                            <div class="sig-img-container">
                                <div class="text-muted small border border-dashed rounded p-1" style="font-size: 0.62rem; line-height: 1.2;">
                                    Tanda Tangan & Cap Stempel Fakultas
                                </div>
                            </div>
                            <div class="fw-bold text-dark small" style="border-top: 1px solid #64748b; padding-top: 3px;">
                                <?= htmlspecialchars($partner['signers']['faculty']['name']) ?>
                            </div>
                            <small class="text-muted d-block" style="font-size: 0.68rem;"><?= htmlspecialchars($partner['signers']['faculty']['title']) ?></small>
                            <small class="text-muted d-block" style="font-size: 0.65rem;"><?= htmlspecialchars($partner['signers']['faculty']['id_number']) ?></small>
                        </div>
                    </div>

                </div>
            </div>

            <!-- ============================================== -->
            <!-- HALAMAN 2: MUKA BELAKANG (TRANSKRIP SKPI & JP) -->
            <!-- ============================================== -->
            <div class="cert-card">
                <div class="cert-border-inner">
                    <div class="text-center pb-2 mb-3 border-bottom border-2">
                        <h4 class="font-serif-cert fw-bold text-navy mb-1" style="color: #0d2e5c; letter-spacing: 1px;">
                            TRANSKRIP CAPAIAN PEMBELAJARAN & BEBAN JAM PELAJARAN (JP)
                        </h4>
                        <div class="text-muted small font-monospace">
                            Lampiran Sertifikat Nomor: <?= htmlspecialchars($student['cert_no']) ?>
                        </div>
                    </div>

                    <!-- DATA SISWA SINGKAT -->
                    <div class="row g-2 mb-3 bg-light p-2 rounded border" style="font-size: 0.85rem;">
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
                    <table class="table table-bordered table-sm mb-3" style="font-size: 0.82rem;">
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
                    <div class="p-3 rounded bg-white border mb-3" style="font-size: 0.78rem; line-height: 1.6; text-align: justify;">
                        <strong class="text-navy d-block mb-1"><i class="fa-solid fa-scale-balanced me-1 text-warning"></i> Catatan Legalitas & Standar Kualifikasi:</strong>
                        Sertifikat dan transkrip ini diterbitkan berdasarkan kesepakatan bersama antara Perguruan Tinggi dan Mitra Industri sebagai dokumen resmi pelengkap Surat Keterangan Pendamping Ijazah (SKPI) sesuai dengan Peraturan Menteri Pendidikan, Kebudayaan, Riset, dan Teknologi Republik Indonesia. Kompetensi yang tercantum telah diuji secara komprehensif melalui praktikum proyek nyata dan ujian penilaian berbasis standar industri.
                    </div>

                    <div class="d-flex justify-content-between align-items-center text-muted" style="font-size: 0.72rem;">
                        <span>Verifikasi digital aktif di: <strong class="text-primary"><?= $verifyUrl ?></strong></span>
                        <span>Dicetak secara terpusat oleh Biro Sertifikasi Skillance Academy</span>
                    </div>

                </div>
            </div>

        </div>

    </div>

    <script>
        function downloadPdf() {
            const element = document.getElementById('printArea');
            const opt = {
                margin:       [5, 5, 5, 5],
                filename:     'Sertifikat_Tripartit_<?= preg_replace("/[^A-Za-z0-9]/", "_", $student["name"]) ?>.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'landscape' }
            };
            html2pdf().set(opt).from(element).save();
        }
    </script>
</body>
</html>
