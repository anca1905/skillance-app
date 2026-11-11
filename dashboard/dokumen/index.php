<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

$currentUserRole = strtolower(trim($_SESSION['user_role'] ?? $_SESSION['role'] ?? ''));
$currentUserId = (int)($_SESSION['user_id'] ?? 0);
$currentUserEmail = strtolower(trim($_SESSION['user_email'] ?? ''));
$currentUserName = strtolower(trim($_SESSION['user_name'] ?? ''));

$isAuthorized = (
    in_array($currentUserRole, ['admin', 'direktur', 'director', 'ceo', 'bendahara', 'leader', 'pimpinan'])
    || in_array($currentUserId, [1, 4])
    || strpos($currentUserEmail, 'arsyad') !== false
    || strpos($currentUserName, 'arsyad') !== false
);

if (!isset($_SESSION['user_id']) || !$isAuthorized) {
    header("Location: ../../auth/index.php");
    exit();
}

$backUrl = ($currentUserRole === 'bendahara') ? '../finance/index.php' : '../index.php';
$backLabel = ($currentUserRole === 'bendahara') ? 'Kembali ke Keuangan' : 'Kembali ke Dashboard Admin';

$pageTitle = "Pusat Dokumen Legal & Kemitraan";
$activeMenu = "dokumen";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> | PT Skillance Digital Indonesia</title>
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Lora:ital,wght@0,400;0,600;0,700;1,400&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css?v=<?= filemtime(__DIR__ . '/../../assets/css/style.css') ?>">
    
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Inter', sans-serif;
        }
        .text-navy { color: #0d2e5c !important; }
        .bg-navy { background-color: #0d2e5c !important; }
        .text-gold { color: #fe9800 !important; }
        .bg-gold { background-color: #fe9800 !important; }

        /* Universal Dashboard Sidebar & Nav-Link Layout (Matches dashboard/index.php) */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #ffffff;
            border-right: 1px solid rgba(0, 0, 0, 0.05);
            padding-top: 20px;
            z-index: 1000;
            transition: margin-left 0.3s ease;
            overflow-y: auto;
        }

        .main-content {
            margin-left: 250px;
            padding: 24px 30px;
            transition: 0.3s;
            min-height: 100vh;
        }

        .sidebar .nav-link,
        .nav-link {
            color: var(--text-body, #555555);
            padding: 12px 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.3s;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active,
        .nav-link:hover,
        .nav-link.active {
            background-color: var(--navy-subtle, #eef2f7);
            color: var(--navy, #0d2e5c) !important;
            border-right: 3px solid var(--navy, #0d2e5c);
            font-weight: 600;
        }

        .sidebar .nav-link i,
        .nav-link i {
            width: 20px;
            text-align: center;
        }

        /* Mobile Sidebar Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(13, 46, 92, 0.45);
            backdrop-filter: blur(3px);
            z-index: 1040;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.active {
            display: block;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -260px !important;
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                width: 260px !important;
                height: 100vh !important;
                z-index: 1050 !important;
                box-shadow: 4px 0 25px rgba(0, 0, 0, 0.25) !important;
            }

            .sidebar.active {
                margin-left: 0 !important;
            }

            .main-content {
                margin-left: 0 !important;
                padding: 16px 12px !important;
            }
        }

        .legal-hub-banner {
            background: linear-gradient(135deg, #0d2e5c 0%, #174276 100%);
            color: #fff;
            border-radius: 14px;
            padding: 22px 24px;
        }

        .doc-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            padding: 20px;
            transition: all 0.2s ease-in-out;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .doc-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            border-color: #fe9800;
        }

        /* Paper Sheet Preview */
        .paper-container {
            background-color: #525659;
            padding: 25px 15px;
            border-radius: 14px;
            overflow-x: auto;
        }
        .paper-sheet {
            background: #ffffff;
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            padding: 22mm 20mm 20mm 25mm;
            box-shadow: 0 12px 35px rgba(0,0,0,0.4);
            font-family: 'Lora', serif;
            color: #111827;
            font-size: 10.5pt;
            line-height: 1.6;
            position: relative;
        }

        /* Kop Surat Resmi PT Skillance */
        .kop-surat {
            border-bottom: 3px double #0d2e5c;
            padding-bottom: 12px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .kop-logo {
            width: 84px;
            height: 84px;
            object-fit: contain;
        }
        .kop-text h2 {
            font-family: 'Poppins', sans-serif;
            font-weight: 800;
            font-size: 15.5pt;
            color: #0d2e5c;
            margin: 0 0 3px 0;
            letter-spacing: 0.5px;
        }
        .kop-text p {
            margin: 0;
            font-family: 'Inter', sans-serif;
            font-size: 7.8pt;
            color: #374151;
            line-height: 1.35;
        }

        .doc-header-title {
            text-align: center;
            margin-bottom: 20px;
        }
        .doc-header-title h4 {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 12.5pt;
            text-decoration: underline;
            margin: 0 0 4px 0;
            color: #0d2e5c;
            letter-spacing: 0.5px;
        }
        .doc-header-title .doc-number {
            font-family: 'Inter', sans-serif;
            font-size: 9.5pt;
            color: #4b5563;
        }

        .clause-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 10.5pt;
            text-align: center;
            margin-top: 16px;
            margin-bottom: 4px;
            color: #0d2e5c;
        }
        .clause-subtitle {
            text-align: center;
            font-weight: 600;
            font-size: 9.5pt;
            margin-bottom: 8px;
            display: block;
        }

        /* Signature block & Stamp Overlay */
        .ttd-table {
            width: 100%;
            margin-top: 35px;
            font-size: 10pt;
            page-break-inside: avoid;
        }
        .materai-box {
            width: 120px;
            height: 60px;
            border: 1px dashed #9ca3af;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            font-size: 7.5pt;
            margin: 8px 0;
            border-radius: 4px;
            background: #fafafa;
        }
        .ttd-box-p1 {
            position: relative;
            min-height: 90px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .stempel-digital-overlay {
            position: absolute;
            width: 120px;
            height: 120px;
            top: -15px;
            left: 20%;
            opacity: 0.88;
            pointer-events: none;
            mix-blend-mode: multiply;
            z-index: 10;
        }

        @media print {
            body {
                background: #fff !important;
                padding: 0 !important;
            }
            .no-print, .sidebar, .sidebar-overlay, .nav, .modal {
                display: none !important;
            }
            .main-content {
                margin: 0 !important;
                padding: 0 !important;
            }
            .paper-container {
                background: transparent !important;
                padding: 0 !important;
            }
            .paper-sheet {
                box-shadow: none !important;
                margin: 0 !important;
                padding: 12mm 15mm 15mm 20mm !important;
                width: 100% !important;
                min-height: auto !important;
            }
        }
    </style>
</head>
<body class="bg-light">

    <!-- Sidebar Navigation -->
    <div class="no-print">
        <?php include __DIR__ . '/../includes/sidebar.php'; ?>
    </div>

    <div class="main-content">
        <!-- Mobile Header Bar (Only visible on mobile) -->
        <div class="d-flex justify-content-between align-items-center mb-3 d-md-none no-print">
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-navy btn-sm rounded-circle d-flex align-items-center justify-content-center shadow-sm sidebar-toggle-btn" style="width: 38px; height: 38px;" id="sidebarToggle" title="Buka Menu">
                    <i class="fa-solid fa-bars fs-6 text-white"></i>
                </button>
                <span class="fw-bold text-navy fs-5">Pusat Dokumen</span>
            </div>
            <div class="bg-navy text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                <i class="fa-solid fa-user small"></i>
            </div>
        </div>

        <!-- Top Banner Header (No Print) -->
        <div class="legal-hub-banner shadow-sm mb-4 no-print">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-2">
                        <span class="badge bg-gold text-navy fw-bold px-2.5 py-1 small">
                            <i class="fa-solid fa-folder-closed me-1"></i>PUSAT DOKUMEN & LEGALITAS
                        </span>
                        <span class="badge bg-white bg-opacity-20 text-white border border-light border-opacity-25 px-2 py-1 small">
                            Unit Usaha & Media Skillance
                        </span>
                    </div>
                    <h3 class="fw-bold text-white mb-1">Dokumen Kemitraan, MoU, & PKS Resmi</h3>
                    <p class="text-white-50 small mb-0">
                        Kelola, buat, dan cetak naskah perjanjian kerja sama resmi PT Skillance Digital Indonesia untuk penjualan produk, reseller software, dan media partner.
                    </p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="<?= $backUrl ?>" class="btn btn-outline-light btn-sm shadow-sm py-2 px-3 fw-semibold">
                        <i class="fa-solid fa-arrow-left me-1"></i><?= $backLabel ?>
                    </a>
                    <a href="../finance/index.php" class="btn btn-outline-light btn-sm shadow-sm py-2 px-3 fw-semibold">
                        <i class="fa-solid fa-wallet me-1"></i>Buku Kas PT
                    </a>
                    <a href="../payroll/index.php" class="btn btn-outline-light btn-sm shadow-sm py-2 px-3 fw-semibold">
                        <i class="fa-solid fa-money-check-dollar me-1"></i>Penggajian Tim
                    </a>
                    <a href="#generatorSection" class="btn btn-warning text-navy btn-sm fw-bold shadow-sm py-2 px-3">
                        <i class="fa-solid fa-pen-nib me-1"></i>Buka Live Generator
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Info Cards (No Print) -->
        <div class="row g-3 mb-4 no-print">
            <div class="col-md-4">
                <div class="doc-card">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="badge bg-primary bg-opacity-10 text-primary fw-bold">Unit Produk & Toko</span>
                            <i class="fa-solid fa-store fs-4 text-primary"></i>
                        </div>
                        <h5 class="fw-bold text-navy mb-1">Aquirist Print & Acrylic</h5>
                        <p class="text-muted small mb-3">
                            Kerja sama titip jual (konsinyasi) plakat akrilik, gantungan kunci kustom, standing banner di toko ATK, kafe, fotokopi, dan souvenir.
                        </p>
                    </div>
                    <button onclick="pickDocumentType('pks_konsinyasi')" class="btn btn-outline-primary btn-sm w-100 fw-semibold">
                        <i class="fa-solid fa-file-signature me-1"></i>Buat PKS Konsinyasi &raquo;
                    </button>
                </div>
            </div>

            <div class="col-md-4">
                <div class="doc-card">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="badge bg-success bg-opacity-10 text-success fw-bold">Unit IT & Software</span>
                            <i class="fa-solid fa-laptop-code fs-4 text-success"></i>
                        </div>
                        <h5 class="fw-bold text-navy mb-1">Software House Skillance</h5>
                        <p class="text-muted small mb-3">
                            Perjanjian kemitraan reseller / agen pemasaran website sekolah, SIMS instansi, sistem kasir (POS) UMKM dengan komisi 15% – 20%.
                        </p>
                    </div>
                    <button onclick="pickDocumentType('pks_reseller_software')" class="btn btn-outline-success btn-sm w-100 fw-semibold">
                        <i class="fa-solid fa-file-signature me-1"></i>Buat PKS Reseller &raquo;
                    </button>
                </div>
            </div>

            <div class="col-md-4">
                <div class="doc-card">
                    <div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="badge bg-warning bg-opacity-10 text-warning fw-bold">Unit Portal Media</span>
                            <i class="fa-solid fa-newspaper fs-4 text-warning"></i>
                        </div>
                        <h5 class="fw-bold text-navy mb-1">XyronNews / Media Skillance</h5>
                        <p class="text-muted small mb-3">
                            Official Media Partner rilis berita kegiatan event/kampus/lomba (skema barter logo) dan publikasi advertorial komersial berbayar.
                        </p>
                    </div>
                    <button onclick="pickDocumentType('pks_media_barter')" class="btn btn-outline-warning text-dark btn-sm w-100 fw-semibold">
                        <i class="fa-solid fa-file-signature me-1"></i>Buat PKS Media Partner &raquo;
                    </button>
                </div>
            </div>
        </div>

        <!-- LIVE GENERATOR & DOCUMENT PREVIEW AREA -->
        <div id="generatorSection" class="row g-4">
            
            <!-- Left Panel Editor / Form Input Mitra (No Print) -->
            <div class="col-lg-4 no-print">
                <div class="card border-0 shadow-sm rounded-3 p-3 sticky-top" style="top: 20px;">
                    <h6 class="fw-bold text-navy mb-3 d-flex align-items-center justify-content-between">
                        <span><i class="fa-solid fa-sliders text-gold me-2"></i>Parameter Dokumen</span>
                        <span class="badge bg-success bg-opacity-10 text-success small">Siap Cetak A4</span>
                    </h6>

                    <div class="mb-3">
                        <label class="small text-muted fw-bold">PILIH TEMPLATE DOKUMEN</label>
                        <select id="docTypeSelect" class="form-select form-select-sm fw-semibold text-navy" onchange="switchDocType()">
                            <optgroup label="🛍️ Anak Usaha Penjualan & Produk">
                                <option value="pks_konsinyasi" selected>1. PKS Konsinyasi & Titip Jual Produk (Aquirist Print)</option>
                                <option value="pks_reseller_software">2. PKS Reseller & Agen Penjualan Software (Skillance Tech)</option>
                            </optgroup>
                            <optgroup label="📰 Unit Media & Pemberitaan">
                                <option value="pks_media_barter">3. PKS Official Media Partner & Barter Promosi (XyronNews)</option>
                                <option value="pks_media_advertorial">4. PKS Publikasi Berita Komersial / Advertorial (XyronNews)</option>
                            </optgroup>
                            <optgroup label="🏛️ Kemitraan Strategis & Administrasi">
                                <option value="mou_strategis">5. Nota Kesepahaman (MoU) Kemitraan Induk (Sekolah / Kampus)</option>
                                <option value="bast_pekerjaan">6. Berita Acara Serah Terima (BAST) Pekerjaan / Produk</option>
                            </optgroup>
                        </select>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-7">
                            <label class="small text-muted fw-bold">NOMOR SURAT</label>
                            <input type="text" id="inputDocNo" class="form-control form-control-sm font-monospace" value="001/PKS-KNS/SDI/XI/2026" oninput="updateDocumentPreview()">
                        </div>
                        <div class="col-5">
                            <label class="small text-muted fw-bold">TANGGAL</label>
                            <input type="text" id="inputDocDate" class="form-control form-control-sm" value="<?= date('d F Y') ?>" oninput="updateDocumentPreview()">
                        </div>
                    </div>

                    <hr class="my-2 text-muted">
                    <div class="fw-bold small text-navy mb-2"><i class="fa-solid fa-handshake me-1 text-gold"></i>IDENTITAS MITRA (PIHAK KEDUA):</div>

                    <div class="mb-2">
                        <label class="small text-muted fw-bold">NAMA TOKO / INSTANSI / EVENT</label>
                        <input type="text" id="inputPartnerCompany" class="form-control form-control-sm" value="TOKO CITRA SOUVENIR & ATK" oninput="updateDocumentPreview()">
                    </div>

                    <div class="mb-2">
                        <label class="small text-muted fw-bold">NAMA PIMPINAN / PEMILIK</label>
                        <input type="text" id="inputPartnerName" class="form-control form-control-sm" value="Bpk. Ahmad Dahlan" oninput="updateDocumentPreview()">
                    </div>

                    <div class="mb-2">
                        <label class="small text-muted fw-bold">JABATAN PIHAK KEDUA</label>
                        <input type="text" id="inputPartnerRole" class="form-control form-control-sm" value="Pemilik Usaha" oninput="updateDocumentPreview()">
                    </div>

                    <div class="mb-2">
                        <label class="small text-muted fw-bold">ALAMAT LENGKAP MITRA</label>
                        <textarea id="inputPartnerAddress" class="form-control form-control-sm" rows="2" oninput="updateDocumentPreview()">Jl. Merdeka No. 45, Rumbia, Kab. Bombana, Sulawesi Tenggara</textarea>
                    </div>

                    <div class="mb-3" id="customParamBox">
                        <label class="small text-muted fw-bold" id="customParamLabel">MARGIN BAGI HASIL MITRA (%)</label>
                        <input type="text" id="inputCustomParam" class="form-control form-control-sm" value="20%" oninput="updateDocumentPreview()">
                    </div>

                    <hr class="my-2 text-muted">
                    <div class="fw-bold small text-navy mb-2"><i class="fa-solid fa-image me-1 text-gold"></i>FORMAT LOGO KOP SURAT:</div>
                    <div class="mb-3">
                        <select id="kopStyleSelect" class="form-select form-select-sm fw-semibold text-navy" onchange="switchKopStyle(this.value)">
                            <option value="icon" selected>1. Ikon Emblem &lt;/&gt; Resmi + Teks PT (Standar)</option>
                            <option value="banner">2. Logo Horizontal Lengkap (&lt;/&gt; SKILLANCE DIGITAL INDONESIA)</option>
                        </select>
                    </div>

                    <div class="fw-bold small text-navy mb-2"><i class="fa-solid fa-stamp me-1 text-gold"></i>STEMPEL & METERAI:</div>

                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="chkShowStamp" checked onchange="toggleStampPreview()">
                        <label class="form-check-label small fw-semibold" for="chkShowStamp">Tampilkan Cap Stempel Resmi PT</label>
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input" type="checkbox" id="chkShowMaterai" checked onchange="toggleMateraiPreview()">
                        <label class="form-check-label small fw-semibold" for="chkShowMaterai">Tampilkan Kotak Meterai Rp 10.000</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button onclick="window.print()" class="btn btn-navy text-white fw-bold btn-sm py-2 shadow-sm">
                            <i class="fa-solid fa-print me-1.5"></i>Cetak / Simpan PDF (A4)
                        </button>
                        <button onclick="copyDocumentText()" class="btn btn-outline-secondary btn-sm py-1.5">
                            <i class="fa-solid fa-copy me-1.5"></i>Salin Teks ke Microsoft Word
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Panel: Live A4 Clean Paper Preview -->
            <div class="col-lg-8">
                <div class="paper-container">
                    <div class="paper-sheet" id="printArea">
                        
                        <!-- KOP SURAT RESMI PT SKILLANCE DIGITAL INDONESIA -->
                        <div class="kop-surat" id="kopSuratWrapper">
                            <img src="../../assets/img/logo_skillance_icon.png" class="kop-logo" id="kopLogoImg" alt="Logo PT Skillance Digital Indonesia">
                            <div class="kop-text" id="kopTextContent">
                                <h2>PT SKILLANCE DIGITAL INDONESIA</h2>
                                <p><strong>Keputusan Menkumham RI:</strong> AHU-A138609.AH.01.30.Tahun 2026 &bull; <strong>NPWP Badan:</strong> 100000011940526</p>
                                <p><strong>NIB OSS:</strong> Terdaftar Resmi BKPM RI &bull; <strong>Sektor Usaha:</strong> IT Solutions, Creative Print & Digital Media Portal</p>
                                <p>Alamat Kantor: Desa Pabiring Dusun Taruseng, Kec. Poleang Barat, Kab. Bombana, Sulawesi Tenggara 93772</p>
                                <p>Website: https://skillance.my.id &bull; Surel: official@skillance.my.id &bull; Narahubung: 0811-4030-800</p>
                            </div>
                        </div>

                        <!-- DINAMIS DOKUMEN ISI -->
                        <div id="dynamicDocContent">
                            <!-- Injected by JavaScript based on selected document type -->
                        </div>

                        <!-- AREA PENUTUP & TANDA TANGAN BERMETERAI -->
                        <div class="mt-4" style="text-align: justify; font-size: 10pt;">
                            Demikian dokumen kesepakatan ini dibuat dan ditandatangani oleh kedua belah pihak dalam rangkap 2 (dua) asli bermeterai cukup, yang masing-masing mempunyai kekuatan hukum yang sama, dan mulai berlaku efektif sejak tanggal ditandatangani.
                        </div>

                        <table class="ttd-table">
                            <tr>
                                <td width="50%" align="center" valign="top">
                                    <strong>PIHAK PERTAMA</strong><br>
                                    PT SKILLANCE DIGITAL INDONESIA<br>
                                    <div class="ttd-box-p1 my-2">
                                        <div class="materai-box" id="boxMateraiP1">Meterai Rp 10.000</div>
                                        <img src="../../assets/img/stempel_skillance_asli_circle.png" class="stempel-digital-overlay" id="imgStampP1" alt="Stempel PT">
                                    </div>
                                    <strong style="text-decoration: underline;">MUH. ARSYAD RAMSI</strong><br>
                                    <span style="font-size: 9pt;">Direktur Utama</span>
                                </td>
                                <td width="50%" align="center" valign="top">
                                    <strong>PIHAK KEDUA</strong><br>
                                    <span id="previewTtdPartnerCompany">TOKO CITRA SOUVENIR & ATK</span><br>
                                    <div class="ttd-box-p1 my-2">
                                        <div class="materai-box" id="boxMateraiP2">Meterai Rp 10.000<br>& Cap Mitra</div>
                                    </div>
                                    <strong style="text-decoration: underline;" id="previewTtdPartnerName">Bpk. Ahmad Dahlan</strong><br>
                                    <span style="font-size: 9pt;" id="previewTtdPartnerRole">Pemilik Usaha</span>
                                </td>
                            </tr>
                        </table>

                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const docTemplates = {
            // 1. PKS KONSINYASI & TITIP JUAL PRODUK AKRILIK / CETAK (AQUIRIST PRINT)
            pks_konsinyasi: {
                title: "PERJANJIAN KERJA SAMA KONSINYASI & TITIP JUAL PRODUK",
                codePrefix: "PKS-KNS",
                customParamLabel: "MARGIN KEUNTUNGAN MITRA TOKO",
                defaultCustomParam: "20%",
                render: function(d) {
                    return `
                        <div class="doc-header-title">
                            <h4>${this.title}</h4>
                            <div class="doc-number">Nomor: ${d.docNo}</div>
                        </div>

                        <p>Pada hari ini, tanggal <strong>${d.docDate}</strong>, bertempat di Kabupaten Bombana, Sulawesi Tenggara, para pihak yang bertanda tangan di bawah ini:</p>

                        <table style="width: 100%; margin-bottom: 12px; font-size: 10pt;">
                            <tr valign="top">
                                <td width="5%"><strong>1.</strong></td>
                                <td width="22%"><strong>Nama</strong></td>
                                <td width="3%">:</td>
                                <td><strong>MUH. ARSYAD RAMSI</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Jabatan</strong></td>
                                <td>:</td>
                                <td>Direktur Utama PT SKILLANCE DIGITAL INDONESIA</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Alamat</strong></td>
                                <td>:</td>
                                <td>Desa Pabiring Dusun Taruseng, Kec. Poleang Barat, Kab. Bombana, Sultra</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td colspan="3" style="padding-top: 4px;">Bertindak untuk dan atas nama <strong>PT SKILLANCE DIGITAL INDONESIA</strong> (menaungi unit usaha <em>Aquirist Print & Acrylic Studio</em>), selanjutnya disebut sebagai <strong>PIHAK PERTAMA (PEMILIK BARANG)</strong>.</td>
                            </tr>
                            <tr><td colspan="4" style="height: 8px;"></td></tr>
                            <tr valign="top">
                                <td><strong>2.</strong></td>
                                <td><strong>Nama</strong></td>
                                <td>:</td>
                                <td><strong>${d.partnerName}</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Jabatan</strong></td>
                                <td>:</td>
                                <td>${d.partnerRole}</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Badan / Toko</strong></td>
                                <td>:</td>
                                <td><strong>${d.partnerCompany}</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Alamat</strong></td>
                                <td>:</td>
                                <td>${d.partnerAddress}</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td colspan="3" style="padding-top: 4px;">Bertindak untuk dan atas nama <strong>${d.partnerCompany}</strong>, selanjutnya disebut sebagai <strong>PIHAK KEDUA (MITRA DISTRIBUSI / TOKO PENJUAL)</strong>.</td>
                            </tr>
                        </table>

                        <p>PARA PIHAK secara sadar dan beriktikad baik bersepakat mengikatkan diri dalam Perjanjian Konsinyasi Titip Jual Produk dengan syarat dan ketentuan sebagai berikut:</p>

                        <div class="clause-title">PASAL 1<br><span class="clause-subtitle">MAKSUD, TUJUAN, DAN STATUS KEPEMILIKAN</span></div>
                        <ol style="text-align: justify; padding-left: 20px;">
                            <li>PIHAK PERTAMA menitipkan sejumlah produk kreatif cetak dan akrilik dari unit <em>Aquirist Print & Acrylic Studio</em> kepada PIHAK KEDUA untuk dipajang dan dijualkan di gerai/toko milik PIHAK KEDUA.</li>
                            <li>Semua produk yang dititipkan tetap menjadi hak milik sah PIHAK PERTAMA hingga barang tersebut terjual secara tunai/lunas kepada konsumen akhir.</li>
                        </ol>

                        <div class="clause-title">PASAL 2<br><span class="clause-subtitle">RUANG LINGKUP PRODUK TITIP JUAL</span></div>
                        <p style="text-align: justify;">Produk titip jual meliputi: Plakat Akrilik Wisuda/Penghargaan, Gantungan Kunci Kustom, Nomor Meja Akrilik Kafe, Lampu Akrilik Hias (LED Acrylic), Standing Banner Promosi, dan merchandise cetak resmi keluaran Aquirist Print.</p>

                        <div class="clause-title">PASAL 3<br><span class="clause-subtitle">PENETAPAN HARGA & BAGI HASIL KEUNTUNGAN</span></div>
                        <ol style="text-align: justify; padding-left: 20px;">
                            <li>Harga Jual Eceran Konsumen (HET) ditetapkan secara bersama berdasarkan daftar harga resmi yang dilampirkan dalam Formulir Titip Barang.</li>
                            <li>Atas setiap produk yang berhasil terjual, PIHAK KEDUA berhak memperoleh komisi bagi hasil sebesar <strong>${d.customParam}</strong> dari nilai harga eceran.</li>
                            <li>PIHAK KEDUA tidak diperkenankan menaikkan harga jual melampaui HET tanpa persetujuan tertulis dari PIHAK PERTAMA demi menjaga stabilitas pasar.</li>
                        </ol>

                        <div class="clause-title">PASAL 4<br><span class="clause-subtitle">REKAPITULASI STOK, PENYETORAN DANA, DAN RETUR</span></div>
                        <ol style="text-align: justify; padding-left: 20px;">
                            <li>Pencatatan sisa stok (stock opname) dilakukan setiap 1 (satu) bulan sekali antara staf perwakilan kedua belah pihak.</li>
                            <li>Hasil penjualan bersih (setelah dipotong komisi PIHAK KEDUA) wajib disetorkan selambat-lambatnya tanggal 5 setiap bulannya ke rekening resmi PT SKILLANCE DIGITAL INDONESIA.</li>
                            <li>Barang titipan yang mengalami cacat produksi pabrik atau tidak terjual dalam masa pajang 3 (tiga) bulan dapat diretur atau ditukar dengan varian model baru atas beban PIHAK PERTAMA.</li>
                        </ol>

                        <div class="clause-title">PASAL 5<br><span class="clause-subtitle">JANGKA WAKTU PERJANJIAN</span></div>
                        <p style="text-align: justify;">Perjanjian kerja sama ini berlaku selama <strong>1 (satu) tahun</strong> terhitung sejak tanggal ditandatangani dan dapat diperpanjang secara otomatis melalui pemberitahuan tertulis kedua belah pihak.</p>
                    `;
                }
            },

            // 2. PKS RESELLER & AGEN PENJUALAN SOFTWARE (SKILLANCE TECH)
            pks_reseller_software: {
                title: "PERJANJIAN KERJA SAMA RESELLER & AGEN PEMASARAN IT SOLUTIONS",
                codePrefix: "PKS-SW",
                customParamLabel: "KOMISI AGEN PER PROYEK (%)",
                defaultCustomParam: "15%",
                render: function(d) {
                    return `
                        <div class="doc-header-title">
                            <h4>${this.title}</h4>
                            <div class="doc-number">Nomor: ${d.docNo}</div>
                        </div>

                        <p>Pada hari ini, tanggal <strong>${d.docDate}</strong>, dibuat dan disepakati perjanjian kemitraan pemasaran solusi teknologi informasi antara:</p>

                        <table style="width: 100%; margin-bottom: 12px; font-size: 10pt;">
                            <tr valign="top">
                                <td width="5%"><strong>1.</strong></td>
                                <td width="22%"><strong>Nama</strong></td>
                                <td width="3%">:</td>
                                <td><strong>MUH. ARSYAD RAMSI</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Jabatan</strong></td>
                                <td>:</td>
                                <td>Direktur Utama PT SKILLANCE DIGITAL INDONESIA</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td colspan="3" style="padding-top: 4px;">Bertindak untuk dan atas nama <strong>PT SKILLANCE DIGITAL INDONESIA</strong> (selaku Principal & Pengembang Software House Skillance), selanjutnya disebut sebagai <strong>PIHAK PERTAMA (DEVELOPER)</strong>.</td>
                            </tr>
                            <tr><td colspan="4" style="height: 8px;"></td></tr>
                            <tr valign="top">
                                <td><strong>2.</strong></td>
                                <td><strong>Nama</strong></td>
                                <td>:</td>
                                <td><strong>${d.partnerName}</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Jabatan</strong></td>
                                <td>:</td>
                                <td>${d.partnerRole}</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Badan / Mitra</strong></td>
                                <td>:</td>
                                <td><strong>${d.partnerCompany}</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Alamat</strong></td>
                                <td>:</td>
                                <td>${d.partnerAddress}</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td colspan="3" style="padding-top: 4px;">Bertindak untuk dan atas nama diri sendiri / badan usaha <strong>${d.partnerCompany}</strong>, selanjutnya disebut sebagai <strong>PIHAK KEDUA (MITRA AGEN / RESELLER)</strong>.</td>
                            </tr>
                        </table>

                        <p>PARA PIHAK bersepakat menjalin kemitraan keagenan dan penjualan produk teknologi informasi dengan ketentuan:</p>

                        <div class="clause-title">PASAL 1<br><span class="clause-subtitle">RUANG LINGKUP PRODUK IT & JASA</span></div>
                        <p style="text-align: justify;">PIHAK KEDUA diberi hak memasarkan produk digital PIHAK PERTAMA, meliputi: Pembuatan Website Profil Instansi/Sekolah/Desa, Sistem Informasi Manajemen Sekolah (SIMS), Sistem Kasir UMKM (POS), Aplikasi Keuangan, serta layanan Hosting & Domain resmi.</p>

                        <div class="clause-title">PASAL 2<br><span class="clause-subtitle">KOMISI PEMASARAN & MEKANISME PENCAIRAN</span></div>
                        <ol style="text-align: justify; padding-left: 20px;">
                            <li>PIHAK KEDUA berhak menerima komisi fee agen sebesar <strong>${d.customParam}</strong> dari Nilai Kontrak Bersih per proyek yang berhasil ditutup (closing) dan telah lunas dibayarkan oleh klien.</li>
                            <li>Pencairan fee komisi ditransfer langsung ke rekening PIHAK KEDUA maksimal 3 (tiga) hari kerja setelah pembayaran termin dari klien masuk ke kas PT SKILLANCE DIGITAL INDONESIA.</li>
                        </ol>

                        <div class="clause-title">PASAL 3<br><span class="clause-subtitle">DUKUNGAN TEKNIS & KEPEMILIKAN HAK CIPTA</span></div>
                        <ol style="text-align: justify; padding-left: 20px;">
                            <li>Seluruh pekerjaan pemrograman, instalasi server, pemeliharaan sistem, dan garansi purna jual ditangani penuh oleh tim developer PIHAK PERTAMA.</li>
                            <li>Hak Kekayaan Intelektual (HAKI) dan source code sistem sepenuhnya milik PT SKILLANCE DIGITAL INDONESIA. PIHAK KEDUA dilarang menggandakan atau mendistribusikan ulang kode tanpa lisensi sah.</li>
                        </ol>

                        <div class="clause-title">PASAL 4<br><span class="clause-subtitle">JANGKA WAKTU KEMITRAAN</span></div>
                        <p style="text-align: justify;">Perjanjian ini berlaku selama <strong>1 (satu) tahun</strong> terhitung sejak tanggal penandatanganan dan dievaluasi secara berkala.</p>
                    `;
                }
            },

            // 3. PKS OFFICIAL MEDIA PARTNER & BARTER PROMOSI (XYRONNEWS)
            pks_media_barter: {
                title: "PERJANJIAN KERJA SAMA (PKS) OFFICIAL MEDIA PARTNER & BARTER PROMOSI",
                codePrefix: "PKS-MED",
                customParamLabel: "NAMA EVENT / PROGRAM KEGIATAN",
                defaultCustomParam: "FESTIVAL KREATIF & SEMINAR TEKNOLOGI 2026",
                render: function(d) {
                    return `
                        <div class="doc-header-title">
                            <h4>${this.title}</h4>
                            <div class="doc-number">Nomor: ${d.docNo}</div>
                        </div>

                        <p>Pada hari ini, tanggal <strong>${d.docDate}</strong>, bertempat di Kabupaten Bombana, Sulawesi Tenggara, para pihak yang bertanda tangan di bawah ini:</p>

                        <table style="width: 100%; margin-bottom: 12px; font-size: 10pt;">
                            <tr valign="top">
                                <td width="5%"><strong>1.</strong></td>
                                <td width="22%"><strong>Nama</strong></td>
                                <td width="3%">:</td>
                                <td><strong>MUH. ARSYAD RAMSI</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Jabatan</strong></td>
                                <td>:</td>
                                <td>Direktur Utama PT SKILLANCE DIGITAL INDONESIA</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td colspan="3" style="padding-top: 4px;">Bertindak untuk dan atas nama <strong>PT SKILLANCE DIGITAL INDONESIA</strong> (menaungi unit media informasi & pemberitaan <em>XyronNews / Skillance Media Network</em>), selanjutnya disebut sebagai <strong>PIHAK PERTAMA (OFFICIAL MEDIA PARTNER)</strong>.</td>
                            </tr>
                            <tr><td colspan="4" style="height: 8px;"></td></tr>
                            <tr valign="top">
                                <td><strong>2.</strong></td>
                                <td><strong>Nama</strong></td>
                                <td>:</td>
                                <td><strong>${d.partnerName}</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Jabatan</strong></td>
                                <td>:</td>
                                <td>${d.partnerRole}</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Penyelenggara</strong></td>
                                <td>:</td>
                                <td><strong>${d.partnerCompany}</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Alamat</strong></td>
                                <td>:</td>
                                <td>${d.partnerAddress}</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td colspan="3" style="padding-top: 4px;">Bertindak atas nama panitia penyelenggara kegiatan <strong>${d.customParam}</strong>, selanjutnya disebut sebagai <strong>PIHAK KEDUA (PENYELENGGARA EVENT)</strong>.</td>
                            </tr>
                        </table>

                        <p>PARA PIHAK bersepakat menjalin kerja sama kemitraan publikasi media (Media Partner) berbasis Barter Promosi (Non-Tunai) dengan ketentuan sebagai berikut:</p>

                        <div class="clause-title">PASAL 1<br><span class="clause-subtitle">KEWAJIBAN PIHAK PERTAMA (MEDIA PARTNER)</span></div>
                        <ol style="text-align: justify; padding-left: 20px;">
                            <li>Menayangkan artikel rilis berita (Press Release) kegiatan pra-acara dan pasca-acara di portal resmi <em>XyronNews / Skillance Network</em> selambat-lambatnya 2x24 jam setelah naskah diterima.</li>
                            <li>Memuat postingan publikasi pamflet/poster acara pada kanal media sosial resmi jaringan Skillance.</li>
                            <li>Menyediakan link publikasi online resmi yang dapat dicantumkan dalam laporan pertanggungjawaban panitia.</li>
                        </ol>

                        <div class="clause-title">PASAL 2<br><span class="clause-subtitle">KEWAJIBAN PIHAK KEDUA (PENYELENGGARA)</span></div>
                        <ol style="text-align: justify; padding-left: 20px;">
                            <li>Mencantumkan logo resmi <strong>XyronNews / Skillance</strong> dengan proporsi yang jelas pada seluruh media promosi event (Backdrop panggung, pamflet cetak & digital, umbul-umbul, id-card, dan tiket).</li>
                            <li>Menyebutkan (ad-libs) nama <em>XyronNews</em> oleh Master of Ceremony (MC) sebagai Official Media Partner minimal 2 (dua) kali selama acara berlangsung.</li>
                            <li>Memberikan akses ID Pass Liputan dan dokumentasi eksklusif bagi perwakilan jurnalis PIHAK PERTAMA pada hari pelaksanaan kegiatan.</li>
                        </ol>

                        <div class="clause-title">PASAL 3<br><span class="clause-subtitle">ETIKA JURNALISTIK & BEBAS SENGKETA</span></div>
                        <p style="text-align: justify;">Materi naskah rilis yang diajukan PIHAK KEDUA tidak boleh mengandung muatan hoaks, ujaran kebencian, pelanggaran SARA, atau pornografi sesuai Kode Etik Jurnalistik dan UU No. 40 Tahun 1999 tentang Pers.</p>
                    `;
                }
            },

            // 4. PKS PUBLIKASI BERITA KOMERSIAL / ADVERTORIAL BERBAYAR (XYRONNEWS)
            pks_media_advertorial: {
                title: "PERJANJIAN KERJA SAMA PUBLIKASI BERITA KOMERSIAL & ADVERTORIAL",
                codePrefix: "PKS-ADV",
                customParamLabel: "NILAI KONTRAK PUBLIKASI / ADVERTORIAL",
                defaultCustomParam: "Rp 1.500.000",
                render: function(d) {
                    return `
                        <div class="doc-header-title">
                            <h4>${this.title}</h4>
                            <div class="doc-number">Nomor: ${d.docNo}</div>
                        </div>

                        <p>Pada hari ini, tanggal <strong>${d.docDate}</strong>, dibuat dan ditandatangani perjanjian layanan publikasi berita komersial antara:</p>

                        <table style="width: 100%; margin-bottom: 12px; font-size: 10pt;">
                            <tr valign="top">
                                <td width="5%"><strong>1.</strong></td>
                                <td width="22%"><strong>Nama</strong></td>
                                <td width="3%">:</td>
                                <td><strong>MUH. ARSYAD RAMSI</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Jabatan</strong></td>
                                <td>:</td>
                                <td>Direktur Utama PT SKILLANCE DIGITAL INDONESIA</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td colspan="3" style="padding-top: 4px;">Bertindak untuk dan atas nama <strong>PT SKILLANCE DIGITAL INDONESIA</strong> (penerbit media digital <em>XyronNews</em>), selanjutnya disebut sebagai <strong>PIHAK PERTAMA (PENERBIT MEDIA)</strong>.</td>
                            </tr>
                            <tr><td colspan="4" style="height: 8px;"></td></tr>
                            <tr valign="top">
                                <td><strong>2.</strong></td>
                                <td><strong>Nama</strong></td>
                                <td>:</td>
                                <td><strong>${d.partnerName}</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Jabatan</strong></td>
                                <td>:</td>
                                <td>${d.partnerRole}</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Instansi / Brand</strong></td>
                                <td>:</td>
                                <td><strong>${d.partnerCompany}</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Alamat</strong></td>
                                <td>:</td>
                                <td>${d.partnerAddress}</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td colspan="3" style="padding-top: 4px;">Bertindak untuk dan atas nama brand/lembaga <strong>${d.partnerCompany}</strong>, selanjutnya disebut sebagai <strong>PIHAK KEDUA (KLIEN / PEMASANG IKLAN)</strong>.</td>
                            </tr>
                        </table>

                        <p>PARA PIHAK bersepakat mengikatkan diri dalam kontrak advertorial dan rilis berita berbayar dengan syarat:</p>

                        <div class="clause-title">PASAL 1<br><span class="clause-subtitle">RUANG LINGKUP PENAYANGAN & OPTIMASI SEO</span></div>
                        <ol style="text-align: justify; padding-left: 20px;">
                            <li>PIHAK PERTAMA menyediakan jasa penulisan redaksional, penyuntingan narasi, dan penerbitan artikel advertorial pada portal <em>XyronNews</em> serta jaringan sindikasi media Skillance.</li>
                            <li>Artikel advertorial ditayangkan secara permanen (tanpa batasan masa kedaluwarsa) dan dioptimasi dengan teknik Search Engine Optimization (SEO) agar mudah ditemukan di mesin pencarian Google.</li>
                        </ol>

                        <div class="clause-title">PASAL 2<br><span class="clause-subtitle">BIAYA JASA & TATA CARA PEMBAYARAN</span></div>
                        <ol style="text-align: justify; padding-left: 20px;">
                            <li>Total biaya jasa publikasi yang disepakati adalah sebesar <strong>${d.customParam}</strong> (bersih dari potongan pajak).</li>
                            <li>Pembayaran diselesaikan penuh di muka atau maksimal saat naskah draf disetujui (preview approved) sebelum ditayangkan secara live ke publik, ditransfer ke rekening resmi PT SKILLANCE DIGITAL INDONESIA.</li>
                        </ol>

                        <div class="clause-title">PASAL 3<br><span class="clause-subtitle">TANGGUNG JAWAB HUKUM KONTEN</span></div>
                        <p style="text-align: justify;">PIHAK KEDUA menjamin bahwa seluruh data, klaim produk, testimoni, dan gambar yang diberikan adalah benar dan tidak melanggar hak cipta pihak ketiga mana pun. PIHAK PERTAMA berhak menyunting redaksional sesuai pedoman standar jurnalistik.</p>
                    `;
                }
            },

            // 5. NOTA KESEPAHAMAN (MoU) INDUK KEMITRAAN STRATEGIS
            mou_strategis: {
                title: "NOTA KESEPAHAMAN (MEMORANDUM OF UNDERSTANDING)<br>KEMITRAAN STRATEGIS DIGITALISASI & LAYANAN KREATIF",
                codePrefix: "MOU-STR",
                customParamLabel: "DURASI KERJA SAMA (TAHUN)",
                defaultCustomParam: "2 (Dua) Tahun",
                render: function(d) {
                    return `
                        <div class="doc-header-title">
                            <h4>${this.title}</h4>
                            <div class="doc-number">Nomor: ${d.docNo}</div>
                        </div>

                        <p>Pada hari ini, tanggal <strong>${d.docDate}</strong>, bertempat di Kabupaten Bombana, Sulawesi Tenggara, dibuat kesepakatan bersama antara:</p>

                        <table style="width: 100%; margin-bottom: 12px; font-size: 10pt;">
                            <tr valign="top">
                                <td width="5%"><strong>1.</strong></td>
                                <td width="22%"><strong>Nama</strong></td>
                                <td width="3%">:</td>
                                <td><strong>MUH. ARSYAD RAMSI</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Jabatan</strong></td>
                                <td>:</td>
                                <td>Direktur Utama PT SKILLANCE DIGITAL INDONESIA</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td colspan="3" style="padding-top: 4px;">Selaku pimpinan badan hukum PT SKILLANCE DIGITAL INDONESIA, selanjutnya disebut sebagai <strong>PIHAK PERTAMA</strong>.</td>
                            </tr>
                            <tr><td colspan="4" style="height: 8px;"></td></tr>
                            <tr valign="top">
                                <td><strong>2.</strong></td>
                                <td><strong>Nama</strong></td>
                                <td>:</td>
                                <td><strong>${d.partnerName}</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Jabatan</strong></td>
                                <td>:</td>
                                <td>${d.partnerRole}</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Instansi / Lembaga</strong></td>
                                <td>:</td>
                                <td><strong>${d.partnerCompany}</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Alamat</strong></td>
                                <td>:</td>
                                <td>${d.partnerAddress}</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td colspan="3" style="padding-top: 4px;">Selaku pimpinan perwakilan institusi <strong>${d.partnerCompany}</strong>, selanjutnya disebut sebagai <strong>PIHAK KEDUA</strong>.</td>
                            </tr>
                        </table>

                        <p>PARA PIHAK bersepakat menjalin Nota Kesepahaman Kemitraan Strategis Berkelanjutan dengan pokok kesepahaman:</p>

                        <div class="clause-title">PASAL 1<br><span class="clause-subtitle">BIDANG KERJA SAMA MULTI-SEKTOR</span></div>
                        <ol style="text-align: justify; padding-left: 20px;">
                            <li><strong>Solusi Digital & Perangkat Lunak:</strong> Pengembangan website resmi instansi/sekolah, sistem manajemen data siswa/arsip, dan integrasi absensi online oleh <em>Skillance Tech</em>.</li>
                            <li><strong>Pengadaan Percetakan & Merchandise:</strong> Suplai plakat penghargaan, souvenir akrilik wisuda, tanda pengenal, dan standing banner oleh <em>Aquirist Print</em>.</li>
                            <li><strong>Pemberitaan & Publikasi Kegiatan:</strong> Peliputan resmi rilis kegiatan dan branding institusi melalui portal berita <em>XyronNews</em>.</li>
                            <li><strong>Peningkatan SDM & Pelatihan:</strong> Penyelenggaraan kelas pelatihan coding, literasi digital, atau sertifikasi melalui <em>Skillance Academy</em>.</li>
                        </ol>

                        <div class="clause-title">PASAL 2<br><span class="clause-subtitle">PERJANJIAN TEKNIS OPERASIONAL (PKS)</span></div>
                        <p style="text-align: justify;">Nota Kesepahaman ini berlaku sebagai landasan induk. Pelaksanaan kegiatan teknis, rincian biaya proyek, dan jadwal kerja akan diturunkan dalam Perjanjian Kerja Sama (PKS) terpisah yang disetujui PARA PIHAK.</p>

                        <div class="clause-title">PASAL 3<br><span class="clause-subtitle">JANGKA WAKTU KESEPAHAMAN</span></div>
                        <p style="text-align: justify;">Nota Kesepahaman ini berlaku untuk jangka waktu <strong>${d.customParam}</strong> sejak tanggal ditandatangani dan dapat diperpanjang atas kesepakatan bersama.</p>
                    `;
                }
            },

            // 6. BERITA ACARA SERAH TERIMA (BAST) PEKERJAAN & PRODUK
            bast_pekerjaan: {
                title: "BERITA ACARA SERAH TERIMA (BAST) PEKERJAAN / PRODUK",
                codePrefix: "BAST",
                customParamLabel: "DESKRIPSI PEKERJAAN / PESANAN SELESAI",
                defaultCustomParam: "Pengadaan 50 Pcs Plakat Akrilik & Aplikasi SIMS",
                render: function(d) {
                    return `
                        <div class="doc-header-title">
                            <h4>${this.title}</h4>
                            <div class="doc-number">Nomor: ${d.docNo}</div>
                        </div>

                        <p>Pada hari ini, tanggal <strong>${d.docDate}</strong>, bertempat di kantor PIHAK KEDUA, yang bertanda tangan di bawah ini:</p>

                        <table style="width: 100%; margin-bottom: 12px; font-size: 10pt;">
                            <tr valign="top">
                                <td width="5%"><strong>1.</strong></td>
                                <td width="22%"><strong>Nama</strong></td>
                                <td width="3%">:</td>
                                <td><strong>MUH. ARSYAD RAMSI</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Jabatan</strong></td>
                                <td>:</td>
                                <td>Direktur Utama PT SKILLANCE DIGITAL INDONESIA</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td colspan="3" style="padding-top: 4px;">Selaku penyedia barang/jasa, selanjutnya disebut sebagai <strong>PIHAK PERTAMA (YANG MENYERAHKAN)</strong>.</td>
                            </tr>
                            <tr><td colspan="4" style="height: 8px;"></td></tr>
                            <tr valign="top">
                                <td><strong>2.</strong></td>
                                <td><strong>Nama</strong></td>
                                <td>:</td>
                                <td><strong>${d.partnerName}</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Jabatan</strong></td>
                                <td>:</td>
                                <td>${d.partnerRole}</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Instansi / Mitra</strong></td>
                                <td>:</td>
                                <td><strong>${d.partnerCompany}</strong></td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td><strong>Alamat</strong></td>
                                <td>:</td>
                                <td>${d.partnerAddress}</td>
                            </tr>
                            <tr valign="top">
                                <td></td>
                                <td colspan="3" style="padding-top: 4px;">Selaku penerima barang/jasa, selanjutnya disebut sebagai <strong>PIHAK KEDUA (YANG MENERIMA)</strong>.</td>
                            </tr>
                        </table>

                        <p>PARA PIHAK dengan ini menyatakan dengan sebenarnya bahwa:</p>

                        <div class="clause-title">PASAL 1<br><span class="clause-subtitle">PENYERAHAN PEKERJAAN</span></div>
                        <p style="text-align: justify;">PIHAK PERTAMA telah menyelesaikan dan menyerahkan hasil pekerjaan/produk berupa: <strong>${d.customParam}</strong> kepada PIHAK KEDUA dalam kondisi baik, lengkap, dan berfungsi secara optimal sesuai spesifikasi yang disepakati bersama.</p>

                        <div class="clause-title">PASAL 2<br><span class="clause-subtitle">PEMERIKSAAN DAN PENERIMAAN</span></div>
                        <p style="text-align: justify;">PIHAK KEDUA telah memeriksa secara teliti seluruh hasil pekerjaan/barang yang diserahkan dan menyatakan menerima dengan baik tanpa ada komplain atau kekurangan pada saat serah terima ini dilakukan.</p>

                        <div class="clause-title">PASAL 3<br><span class="clause-subtitle">HAK PEMBAYARAN & ADMINISTRASI</span></div>
                        <p style="text-align: justify;">Dengan ditandatanganinya Berita Acara Serah Terima (BAST) ini, maka seluruh kewajiban penyerahan telah tuntas dan PIHAK PERTAMA berhak menerbitkan kuitansi/invoice pelunasan pembayaran sesuai nilai kontrak yang berlaku.</p>
                    `;
                }
            }
        };

        function switchDocType() {
            const select = document.getElementById('docTypeSelect');
            const docKey = select.value;
            const tpl = docTemplates[docKey];
            
            // Generate official document number
            const now = new Date();
            const romanMonths = ["I","II","III","IV","V","VI","VII","VIII","IX","X","XI","XII"];
            document.getElementById('inputDocNo').value = `001/${tpl.codePrefix}/SDI/${romanMonths[now.getMonth()]}/${now.getFullYear()}`;
            
            // Custom Parameter Label and Value
            document.getElementById('customParamLabel').innerText = tpl.customParamLabel;
            document.getElementById('inputCustomParam').value = tpl.defaultCustomParam;

            updateDocumentPreview();
        }

        function pickDocumentType(key) {
            document.getElementById('docTypeSelect').value = key;
            switchDocType();
            const genSec = document.getElementById('generatorSection');
            genSec.scrollIntoView({ behavior: 'smooth' });
        }

        function updateDocumentPreview() {
            const docKey = document.getElementById('docTypeSelect').value;
            const tpl = docTemplates[docKey];

            const data = {
                docNo: document.getElementById('inputDocNo').value,
                docDate: document.getElementById('inputDocDate').value,
                partnerCompany: document.getElementById('inputPartnerCompany').value,
                partnerName: document.getElementById('inputPartnerName').value,
                partnerRole: document.getElementById('inputPartnerRole').value,
                partnerAddress: document.getElementById('inputPartnerAddress').value,
                customParam: document.getElementById('inputCustomParam').value
            };

            document.getElementById('dynamicDocContent').innerHTML = tpl.render(data);

            // Update signature block preview
            document.getElementById('previewTtdPartnerCompany').innerText = data.partnerCompany;
            document.getElementById('previewTtdPartnerName').innerText = data.partnerName;
            document.getElementById('previewTtdPartnerRole').innerText = data.partnerRole;
        }

        function toggleStampPreview() {
            const isChecked = document.getElementById('chkShowStamp').checked;
            document.getElementById('imgStampP1').style.display = isChecked ? 'block' : 'none';
        }

        function toggleMateraiPreview() {
            const isChecked = document.getElementById('chkShowMaterai').checked;
            document.getElementById('boxMateraiP1').style.display = isChecked ? 'inline-flex' : 'none';
            document.getElementById('boxMateraiP2').style.display = isChecked ? 'inline-flex' : 'none';
        }

        function copyDocumentText() {
            const printArea = document.getElementById('printArea');
            const text = printArea.innerText;
            navigator.clipboard.writeText(text).then(() => {
                alert('Teks dokumen berhasil disalin ke clipboard! Anda dapat menempelkannya (Paste) langsung ke Microsoft Word.');
            }).catch(err => {
                alert('Gagal menyalin teks: ' + err);
            });
        }

        // Initialize on load
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            const reqType = urlParams.get('type');
            if (reqType && docTemplates[reqType]) {
                document.getElementById('docTypeSelect').value = reqType;
            }
            switchDocType();
            toggleStampPreview();
            toggleMateraiPreview();
        });
    </script>

</body>
</html>
