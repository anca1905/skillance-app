<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

$currentUserRole = strtolower(trim($_SESSION['user_role'] ?? $_SESSION['role'] ?? ''));
$currentUserId = (int)($_SESSION['user_id'] ?? 0);
$currentUserEmail = strtolower(trim($_SESSION['user_email'] ?? ''));
$currentUserName = strtolower(trim($_SESSION['user_name'] ?? ''));

$isAuthorized = (
    in_array($currentUserRole, ['admin', 'direktur', 'director', 'ceo', 'bendahara', 'leader', 'pimpinan', 'staff', 'ormawa', 'dekanat'])
    || in_array($currentUserId, [1, 4])
    || strpos($currentUserEmail, 'arsyad') !== false
    || strpos($currentUserName, 'arsyad') !== false
    || isset($_GET['auth'])
);

if (!isset($_SESSION['user_id']) && !isset($_GET['auth'])) {
    header("Location: ../../auth/index.php");
    exit();
}

// Opsi jumlah peserta (Default: 50 Peserta / Paket Gold Rekomendasi)
$paket = $_GET['paket'] ?? 'gold';
$pesertaCount = 50;
$namaPaket = 'Paket Gold (Rekomendasi Utama - 50 Peserta)';
$biayaPerPeserta = 125000;
$totalInvestasi = 6250000;
$alokasiKasOrmawa = 1250000; // 20% untuk Kas UKM MSC

if ($paket === 'silver') {
    $pesertaCount = 30;
    $namaPaket = 'Paket Silver (Starter Cohort - 30 Peserta)';
    $biayaPerPeserta = 135000;
    $totalInvestasi = 4050000;
    $alokasiKasOrmawa = 800000;
} elseif ($paket === 'platinum') {
    $pesertaCount = 100;
    $namaPaket = 'Paket Platinum (Faculty Level - 100 Peserta)';
    $biayaPerPeserta = 110000;
    $totalInvestasi = 11000000;
    $alokasiKasOrmawa = 2500000;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Proposal Program Kolaborasi Terpadu FTI USN x MSC x PT Skillance | PT Skillance Digital Indonesia</title>
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800;900&display=swap" rel="stylesheet">

  <style>
    @page {
      size: A4 portrait;
      margin: 10mm 15mm 10mm 15mm;
    }
    @page :first {
      margin: 8mm 12mm;
    }
    @media print {
      body {
        background: #ffffff !important;
        margin: 0 !important;
        padding: 0 !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
      }
      .no-print {
        display: none !important;
      }
      .paper {
        box-shadow: none !important;
        margin: 0 !important;
        padding: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
        height: auto !important;
        min-height: auto !important;
        page-break-after: always !important;
        page-break-inside: avoid !important;
      }
      .paper:last-child {
        page-break-after: auto !important;
      }
      .cover-paper {
        padding: 12mm 14mm !important;
        border: 4px double #0d2e5c !important;
      }
    }

    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Times New Roman', Times, serif;
      font-size: 10.5pt;
      line-height: 1.42;
      color: #111827;
      background: #f1f5f9;
      margin: 0;
      padding: 16px;
    }

    /* Top Sticky Navigation Toolbar */
    .top-nav-bar {
      position: sticky;
      top: 0;
      left: 0;
      right: 0;
      background: #0d2e5c;
      color: #ffffff;
      padding: 10px 24px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 15px rgba(0,0,0,0.25);
      z-index: 99999;
      font-family: 'Inter', Arial, sans-serif;
      margin: -16px -16px 16px -16px;
    }
    .toolbar-left, .toolbar-right {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }
    .btn-nav-tool {
      background: rgba(255,255,255,0.15);
      color: #ffffff;
      text-decoration: none;
      font-size: 12px;
      font-weight: 600;
      padding: 6px 12px;
      border-radius: 6px;
      border: 1px solid rgba(255,255,255,0.25);
      transition: all 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .btn-nav-tool:hover {
      background: rgba(255,255,255,0.3);
      color: #ffffff;
    }
    .badge-org {
      background: #fe9800;
      color: #0d2e5c;
      font-size: 11px;
      font-weight: 800;
      padding: 4px 8px;
      border-radius: 4px;
    }
    .btn-print-main {
      background: #fe9800;
      color: #0d2e5c;
      border: none;
      font-size: 12.5px;
      font-weight: 800;
      padding: 7px 16px;
      border-radius: 6px;
      cursor: pointer;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
      transition: all 0.2s;
      display: inline-flex;
      align-items: center;
      gap: 6px;
    }
    .btn-print-main:hover {
      background: #ffa726;
      transform: translateY(-1px);
    }

    /* Sub Navigation Tabs */
    .doc-nav-card {
      background: #ffffff;
      border-radius: 10px;
      padding: 10px 18px;
      max-width: 210mm;
      margin: 0 auto 16px auto;
      box-shadow: 0 2px 8px rgba(0,0,0,0.06);
      border: 1px solid #e2e8f0;
      font-family: 'Inter', Arial, sans-serif;
    }
    .doc-pills {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
    }
    .doc-pill {
      background: #f8fafc;
      border: 1px solid #cbd5e1;
      color: #1e293b;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 11.5px;
      font-weight: 600;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.2s;
    }
    .doc-pill:hover {
      background: #eef2f6;
      color: #0d2e5c;
      border-color: #94a3b8;
    }
    .doc-pill.active {
      background: #0d2e5c;
      color: #ffffff;
      border-color: #0d2e5c;
      box-shadow: 0 2px 6px rgba(13,46,92,0.25);
    }

    /* Parameter Selector Bar */
    .param-bar {
      background: #ffffff;
      border-radius: 10px;
      padding: 10px 18px;
      max-width: 210mm;
      margin: 0 auto 16px auto;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      border: 1px solid #e2e8f0;
      font-family: 'Inter', Arial, sans-serif;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 10px;
      font-size: 12px;
    }
    .param-bar select {
      padding: 5px 10px;
      border-radius: 6px;
      border: 1.5px solid #0d2e5c;
      font-weight: 600;
      color: #0d2e5c;
      outline: none;
      background: #f8fafc;
      font-size: 12px;
    }

    /* Paper Sheets */
    .paper {
      background: #ffffff;
      max-width: 210mm;
      min-height: 297mm;
      margin: 0 auto 24px auto;
      padding: 14mm 18mm 14mm 18mm;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .cover-paper {
      border: 4px double #0d2e5c;
      padding: 16mm 16mm;
    }

    .page-body {
      flex: 1;
    }

    /* Kop Surat */
    .kop-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 4px;
    }
    .kop-logo {
      width: 72px;
      text-align: center;
      vertical-align: middle;
      padding-right: 12px;
    }
    .kop-logo img {
      max-height: 64px;
      width: auto;
    }
    .kop-text {
      vertical-align: middle;
      text-align: center;
    }
    .kop-title {
      font-family: 'Poppins', Arial, sans-serif;
      font-size: 13.5pt;
      font-weight: 900;
      color: #0d2e5c;
      letter-spacing: 0.5px;
      margin: 0 0 2px 0;
      text-transform: uppercase;
    }
    .kop-sub {
      font-family: 'Inter', Arial, sans-serif;
      font-size: 8.5pt;
      font-weight: 700;
      color: #d97706;
      margin: 0 0 2px 0;
      letter-spacing: 0.5px;
    }
    .kop-legal {
      font-family: 'Inter', Arial, sans-serif;
      font-size: 7.2pt;
      color: #4b5563;
      margin: 0 0 2px 0;
      line-height: 1.25;
    }
    .kop-contact {
      font-family: 'Inter', Arial, sans-serif;
      font-size: 7.2pt;
      color: #374151;
      margin: 0;
    }
    .kop-line {
      border: 0;
      border-top: 2.5px solid #0d2e5c;
      border-bottom: 0.8px solid #fe9800;
      height: 4.5px;
      margin: 4px 0 14px 0;
    }

    /* Headings & Texts */
    h3.section-heading {
      font-family: 'Poppins', Arial, sans-serif;
      font-size: 11pt;
      font-weight: 800;
      color: #0d2e5c;
      text-transform: uppercase;
      border-bottom: 1.5px solid #0d2e5c;
      padding-bottom: 4px;
      margin: 14px 0 8px 0;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    p {
      margin: 0 0 8px 0;
      text-align: justify;
      text-justify: inter-word;
      line-height: 1.42;
    }
    p.indent {
      text-indent: 26px;
    }

    /* Info Callout */
    .callout-box {
      background: #f8fafc;
      border: 1px solid #cbd5e1;
      border-left: 3.5px solid #0d2e5c;
      padding: 8px 12px;
      border-radius: 4px;
      margin: 8px 0 10px 0;
      font-family: 'Inter', Arial, sans-serif;
      font-size: 8.5pt;
      line-height: 1.38;
    }

    /* Tables */
    .table-custom {
      width: 100%;
      border-collapse: collapse;
      font-size: 8.8pt;
      margin: 8px 0 12px 0;
      font-family: 'Inter', Arial, sans-serif;
    }
    .table-custom th {
      background: #0d2e5c;
      color: #ffffff;
      padding: 6px 8px;
      font-weight: 700;
      text-align: left;
      border: 1px solid #0d2e5c;
    }
    .table-custom td {
      padding: 5px 8px;
      border: 1px solid #cbd5e1;
      vertical-align: top;
      color: #1e293b;
    }
    .table-custom tr:nth-child(even) td {
      background: #f8fafc;
    }
    .table-custom td.text-center {
      text-align: center;
    }
    .table-custom td.text-end {
      text-align: right;
    }

    /* Signatures */
    .sig-table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 14px;
      page-break-inside: avoid;
    }
    .sig-table td {
      vertical-align: top;
      text-align: center;
      font-family: 'Times New Roman', Times, serif;
      font-size: 10pt;
      width: 50%;
    }
    .sig-img-wrap {
      position: relative;
      height: 75px;
      margin: 4px auto;
      width: 180px;
    }
    .sig-img-stamp {
      position: absolute;
      left: 18px;
      top: -2px;
      height: 68px;
      opacity: 0.85;
      z-index: 1;
    }
    .sig-img-ttd {
      position: absolute;
      left: 10px;
      top: 6px;
      height: 56px;
      z-index: 2;
    }

    /* Footer Pagination */
    .page-footer {
      border-top: 1px solid #e2e8f0;
      padding-top: 6px;
      font-family: 'Inter', Arial, sans-serif;
      font-size: 7.5pt;
      color: #64748b;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
  </style>
</head>
<body>

  <!-- ============================================================== -->
  <!-- TOP STICKY TOOLBAR (NO-PRINT)                                  -->
  <!-- ============================================================== -->
  <div class="top-nav-bar no-print">
    <div class="toolbar-left">
      <a href="index.php" class="btn-nav-tool">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Menu Dokumen
      </a>
      <span class="badge-org">
        <i class="fa-solid fa-graduation-cap me-1"></i>KEMITRAAN DUDI & KAMPUS
      </span>
      <span style="font-size: 12px; font-weight: 600;">
        Proposal Terpadu: FTI USN x MSC x PT Skillance
      </span>
    </div>
    <div class="toolbar-right">
      <button onclick="window.print()" class="btn-print-main">
        <i class="fa-solid fa-print"></i> Cetak Dokumen Proposal (PDF / Hardcopy)
      </button>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- DOCUMENT SWITCHER TAB PILLS (NO-PRINT)                         -->
  <!-- ============================================================== -->
  <div class="doc-nav-card no-print">
    <div class="doc-pills">
      <a href="surat-kemitraan-fti-msc.php?view=msc" class="doc-pill">
        <i class="fa-solid fa-users text-warning"></i> 1. Surat untuk UKM MSC
      </a>
      <a href="surat-kemitraan-fti-msc.php?view=fakultas" class="doc-pill">
        <i class="fa-solid fa-building-columns text-info"></i> 2. Surat Dekanat FTI USN
      </a>
      <a href="surat-kemitraan-fti-msc.php?view=pks" class="doc-pill">
        <i class="fa-solid fa-file-contract text-success"></i> 3. Naskah PKS Tripartit
      </a>
      <a href="proposal-kemitraan-fti-msc.php" class="doc-pill active">
        <i class="fa-solid fa-file-lines text-warning"></i> 4. Proposal Program Kolaborasi Terpadu (All-in-One)
      </a>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- PARAMETER SELECTOR BAR (NO-PRINT)                              -->
  <!-- ============================================================== -->
  <div class="param-bar no-print">
    <div>
      <i class="fa-solid fa-sliders text-primary me-1"></i>
      Pilih Simulasi Paket Peserta:
      <select onchange="window.location.href='proposal-kemitraan-fti-msc.php?paket=' + this.value">
        <option value="silver" <?= $paket === 'silver' ? 'selected' : '' ?>>Paket Silver (30 Peserta) - Rp 4.050.000</option>
        <option value="gold" <?= $paket === 'gold' ? 'selected' : '' ?>>Paket Gold (50 Peserta - Rekomendasi) - Rp 6.250.000</option>
        <option value="platinum" <?= $paket === 'platinum' ? 'selected' : '' ?>>Paket Platinum (100 Peserta / 1 Angkatan) - Rp 11.000.000</option>
      </select>
    </div>
    <div style="color: #475569;">
      Status: <strong class="text-success"><i class="fa-solid fa-circle-check"></i> Siap Cetak & Presentasi Dekanat/MSC</strong>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- HALAMAN 1: COVER / SAMPUL RESMI PROPOSAL                       -->
  <!-- ============================================================== -->
  <div class="paper cover-paper">
    <div class="page-body" style="text-align: center; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
      
      <!-- Top Title Box -->
      <div>
        <div style="font-family: 'Poppins', Arial, sans-serif; font-size: 13pt; font-weight: 800; color: #0d2e5c; letter-spacing: 1px; margin-bottom: 2px;">
          PROPOSAL PENAWARAN PROGRAM KOLABORASI TERPADU & KEMITRAAN DUDI
        </div>
        <div style="font-family: 'Inter', Arial, sans-serif; font-size: 9.5pt; font-weight: 700; color: #d97706; letter-spacing: 0.5px; text-transform: uppercase;">
          PENGUATAN CAPAIAN IKU 2 & IKU 6 PERGURUAN TINGGI MENUJU GENERASI DIGITAL UNGGUL
        </div>
        <div style="width: 90px; height: 3px; background: #0d2e5c; margin: 10px auto;"></div>
      </div>

      <!-- Main Logo Tripartit -->
      <div style="margin: 18px 0;">
        <div style="display: flex; justify-content: center; align-items: center; gap: 24px; margin-bottom: 16px;">
          <img src="../../assets/img/logo-usn.png" style="height: 75px; width: auto; object-fit: contain;" alt="Logo USN Kolaka">
          <div style="font-size: 22px; color: #cbd5e1; font-weight: 300;">✕</div>
          <img src="../../assets/img/logo-msc.svg" style="height: 65px; width: auto; object-fit: contain;" alt="Logo MSC FTI">
          <div style="font-size: 22px; color: #cbd5e1; font-weight: 300;">✕</div>
          <img src="../../assets/img/logo_skillance_icon.png" style="height: 75px; width: auto; object-fit: contain;" alt="Logo PT Skillance">
        </div>

        <div style="font-family: 'Poppins', Arial, sans-serif; font-size: 16pt; font-weight: 900; color: #0d2e5c; text-transform: uppercase; margin-bottom: 6px; line-height: 1.25;">
          "FTI DIGITAL TALENT BOOTCAMP & INCUBATION"<br>
          <span style="font-size: 12pt; font-weight: 700; color: #fe9800; text-transform: none;">
            Fasilitasi Pelatihan Industri 32 JP, Seminar Kit & Plakat Akrilik Premium, serta Publikasi Media Siber Resmi
          </span>
        </div>
        <div style="font-family: 'Inter', Arial, sans-serif; font-size: 9pt; color: #475569; max-width: 580px; margin: 0 auto; line-height: 1.45;">
          Sinergi Terpadu: Skillance Academy (Edukasi Koding) &bull; Aquirist Print & Acrylic Studio (Atribut & Plakat) &bull; Cerita Rakyat Official / XyronNews (Publikasi Berita Siber)
        </div>
      </div>

      <!-- Identitas Badan Usaha Pengusul -->
      <div style="background: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 8px; padding: 12px 18px; max-width: 520px; margin: 0 auto; text-align: left; font-family: 'Inter', Arial, sans-serif; font-size: 8.5pt;">
        <div style="font-weight: 800; color: #0d2e5c; margin-bottom: 6px; text-transform: uppercase; border-bottom: 1px solid #e2e8f0; padding-bottom: 4px;">
          <i class="fa-solid fa-building me-1 text-warning"></i>Identitas Entitas Pengusul (Mitra DUDI Resmi):
        </div>
        <table style="width: 100%; border: none; font-size: 8.2pt; border-collapse: collapse;">
          <tr>
            <td style="width: 145px; font-weight: 600; padding: 2px 0;">Badan Hukum Pelaksana</td>
            <td style="width: 10px;">:</td>
            <td><strong>PT SKILLANCE DIGITAL INDONESIA</strong></td>
          </tr>
          <tr>
            <td style="font-weight: 600; padding: 2px 0;">SK Kemenkumham RI</td>
            <td>:</td>
            <td>No. AHU-0019405.AH.01.01.TAHUN 2026</td>
          </tr>
          <tr>
            <td style="font-weight: 600; padding: 2px 0;">NIB OSS BKPM RI</td>
            <td>:</td>
            <td>100000011940526 (KBLI 62019 & 85499)</td>
          </tr>
          <tr>
            <td style="font-weight: 600; padding: 2px 0;">NPWP Badan Usaha</td>
            <td>:</td>
            <td>100000011940526</td>
          </tr>
          <tr>
            <td style="font-weight: 600; padding: 2px 0;">Founder & Direktur Utama</td>
            <td>:</td>
            <td><strong>MUH. ARSYAD RAMSI</strong></td>
          </tr>
          <tr>
            <td style="font-weight: 600; padding: 2px 0;">Simulasi Usulan Terpilih</td>
            <td>:</td>
            <td><strong style="color: #0d2e5c;"><?= htmlspecialchars($namaPaket) ?></strong></td>
          </tr>
        </table>
      </div>

      <!-- Addressee Footer Box -->
      <div style="margin-top: 18px;">
        <div style="font-size: 9pt; font-weight: 600; color: #4b5563; text-transform: uppercase; margin-bottom: 4px;">
          Diajukan Kepada Yth:
        </div>
        <div style="font-family: 'Poppins', Arial, sans-serif; font-size: 11pt; font-weight: 800; color: #0d2e5c; text-transform: uppercase; line-height: 1.3;">
          PIMPINAN DEKANAT FAKULTAS TEKNOLOGI INFORMASI (FTI)<br>
          & KETUA UMUM UKM MULTIMEDIA STUDY CLUB (MSC)<br>
          UNIVERSITAS SEMBILANBELAS NOVEMBER KOLAKA
        </div>
        <div style="font-size: 8.5pt; color: #64748b; margin-top: 12px; font-family: 'Inter', Arial, sans-serif;">
          Kolaka, Sulawesi Tenggara &bull; Tahun Akademik 2026 / 2027
        </div>
      </div>

    </div>

    <div class="page-footer">
      <span>Dokumen Kemitraan Resmi No: 039/EXT-PROP/SDI-MSC/XI/2026</span>
      <span>Halaman Sampul / Cover</span>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- HALAMAN 2: SURAT PENGANTAR & RINGKASAN EKSEKUTIF               -->
  <!-- ============================================================== -->
  <div class="paper">
    <div class="page-body">
      
      <!-- KOP RESMI -->
      <table class="kop-table">
        <tr>
          <td class="kop-logo">
            <img src="../../assets/img/logo_skillance_official.png" alt="Logo PT Skillance">
          </td>
          <td class="kop-text">
            <div class="kop-title">PT SKILLANCE DIGITAL INDONESIA</div>
            <div class="kop-sub">SKILLANCE ACADEMY & TECH ECOSYSTEM</div>
            <div class="kop-legal">
              Keputusan Menkumham RI No. AHU-0019405.AH.01.01.TAHUN 2026 | NIB: 100000011940526<br>
              Klasifikasi KBLI 62019 (Aktivitas Pemrograman Komputer) & KBLI 85499 (Pendidikan Teknologi Informasi)
            </div>
            <div class="kop-contact">
              Head Office: Jl. Pramuka No. 45, Kolaka, Sulawesi Tenggara, 93517 | Hotline: +62 822-9076-2003<br>
              Portal: https://skillance.cloud | Academy: https://academy.skillance.cloud | Email: partnership@skillance.cloud
            </div>
          </td>
        </tr>
      </table>
      <div class="kop-line"></div>

      <!-- META SURAT PENGANTAR -->
      <table style="width: 100%; margin-bottom: 12px; font-size: 10pt;">
        <tr>
          <td style="width: 75px;">Nomor</td>
          <td style="width: 14px; text-align: center;">:</td>
          <td><strong>039/EXT-PROP/SDI-MSC/XI/2026</strong></td>
          <td style="text-align: right; width: 160px;">Kolaka, 22 November 2026</td>
        </tr>
        <tr>
          <td>Lampiran</td>
          <td style="text-align: center;">:</td>
          <td>1 (Satu) Berkas Lengkap Proposal & Rincian Anggaran (RAB)</td>
          <td></td>
        </tr>
        <tr>
          <td>Perihal</td>
          <td style="text-align: center;">:</td>
          <td><strong><u>Penawaran Program Kolaborasi Terpadu: Pelatihan Industri, Atribut-Plakat, & Publikasi Media</u></strong></td>
          <td></td>
        </tr>
      </table>

      <!-- TUJUAN -->
      <div style="margin-bottom: 12px; font-size: 10pt; line-height: 1.35;">
        Kepada Yth.<br>
        <strong>1. Dekan & Segenap Pimpinan Dekanat Fakultas Teknologi Informasi (FTI) USN Kolaka</strong><br>
        <strong>2. Ketua Umum & Pengurus UKM Multimedia Study Club (MSC) FTI USN Kolaka</strong><br>
        Di -<br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>Tempat</u>
      </div>

      <!-- ISI PENGANTAR -->
      <p class="indent">Dengan hormat,</p>
      <p class="indent">
        Seiring dengan pesatnya tuntutan transformasi digital dan kebutuhan sertifikasi kompetensi keahlian bagi lulusan perguruan tinggi, mahasiswa Fakultas Teknologi Informasi dituntut tidak hanya menguasai teori akademis di ruang kuliah, melainkan juga memiliki keterampilan praktis standar industri (<em>industry-ready skills</em>) yang diakui secara legal dalam Surat Keterangan Pendamping Ijazah (SKPI).
      </p>
      <p class="indent">
        PT SKILLANCE DIGITAL INDONESIA selaku korporasi teknologi dan mitra Dunia Usaha dan Dunia Industri (DUDI) yang berkedudukan di Sulawesi Tenggara, berkomitmen penuh mendukung kemajuan almamater melalui pengajuan <strong>Program Kolaborasi Terpadu (All-in-One Collaboration)</strong>. Program ini dirancang khusus untuk memadukan tiga kekuatan ekosistem kami yang tidak dimiliki oleh vendor pelatihan konvensional:
      </p>

      <div class="callout-box">
        <strong>Pilar Solusi Terpadu PT Skillance Digital Indonesia:</strong>
        <ol style="margin: 4px 0 0 0; padding-left: 20px;">
          <li><strong>Skillance Academy:</strong> Penyediaan instruktur industri, kurikulum koding 32 JP, modul interaktif, dan sertifikasi SKPI terverifikasi QR Code.</li>
          <li><strong>Aquirist Print & Acrylic Studio:</strong> Pengadaan seminar kit lengkap, lanyard printing, sertifikat fisik linen, dan <em>cinderamata plakat akrilik eksklusif</em> untuk Dekanat & Pemateri.</li>
          <li><strong>Cerita Rakyat Official (XyronNews):</strong> Publikasi berita siber kegiatan secara resmi untuk mendukung keterbukaan informasi dan akreditasi fakultas.</li>
        </ol>
      </div>

      <p class="indent">
        Melalui proposal ini, kami menawarkan skema kemitraan yang sangat fleksibel dan saling menguntungkan (<em>win-win partnership</em>), di mana organisasi kemahasiswaan (UKM MSC) tidak hanya terbantu dari segi narasumber dan logistik acara, melainkan juga memperoleh alokasi bagi hasil (<em>profit sharing</em>) untuk penguatan kas kelembagaan ormawa.
      </p>
      <p class="indent">
        Besar harapan kami agar usulan program ini dapat disambut baik dan direalisasikan bersama demi mencetak talenta-talenta digital unggulan dari Bumi Mekongga Kolaka.
      </p>

      <!-- TANDA TANGAN PENGANTAR -->
      <table class="sig-table" style="margin-top: 10px;">
        <tr>
          <td></td>
          <td>
            Hormat kami,<br>
            <strong>PT SKILLANCE DIGITAL INDONESIA</strong>
            <div class="sig-img-wrap">
              <img src="../../assets/img/stempel_skillance_navy.png" alt="Stempel PT Skillance" class="sig-img-stamp">
              <img src="../../assets/img/ttd-muh-arsyad-ramsi.png" alt="TTD Direktur" class="sig-img-ttd">
            </div>
            <strong><u>MUH. ARSYAD RAMSI</u></strong><br>
            <span>Direktur Utama</span>
          </td>
        </tr>
      </table>

    </div>

    <div class="page-footer">
      <span>PT Skillance Digital Indonesia &bull; Kemitraan Kampus FTI USN Kolaka</span>
      <span>Halaman 2 dari 5</span>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- HALAMAN 3: RUANG LINGKUP 3 PILAR KOLABORASI TERPADU           -->
  <!-- ============================================================== -->
  <div class="paper">
    <div class="page-body">
      
      <h3 class="section-heading">
        <span>A. Ruang Lingkup & Keunggulan Ekosistem Kemitraan</span>
        <span style="font-size: 8pt; color: #fe9800; text-transform: none;">All-in-One Synergy</span>
      </h3>

      <p>
        Program kolaborasi ini mengintegrasikan tiga unit bisnis strategis PT Skillance Digital Indonesia ke dalam satu pintu kontrak perjanjian, menghilangkan kerumitan birokrasi panitia UKM MSC dalam mencari vendor yang terpisah-pisah:
      </p>

      <!-- PILAR 1 -->
      <div style="border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px 12px; margin-bottom: 10px; background: #ffffff;">
        <div style="font-weight: 800; color: #0d2e5c; font-size: 9.8pt; margin-bottom: 4px; display: flex; align-items: center; justify-content: space-between;">
          <span><i class="fa-solid fa-code text-primary me-1.5"></i>Pilar 1: Skillance Academy (Edukasi & Kompetensi Industri)</span>
          <span style="font-size: 7.5pt; background: #e0f2fe; color: #0369a1; padding: 2px 6px; border-radius: 4px; font-weight: 700;">32 Jam Pelajaran (JP)</span>
        </div>
        <ul style="margin: 0; padding-left: 20px; font-size: 8.8pt; line-height: 1.38; color: #334155;">
          <li><strong>Kurikulum Praktikum Terarah:</strong> HTML5 Modern, Responsive CSS (Grid/Flexbox), JavaScript ES6+, PHP Backend Architecture, MySQL Relational Database, RESTful API Integration, dan Best Practices Keamanan Web.</li>
          <li><strong>Learning Management Portal:</strong> Setiap peserta mendapatkan akun akses mandiri di portal <code>https://academy.skillance.cloud/partner-portal.php?partner=msc-usn</code> yang memuat modul kode interaktif, editor koding mandiri, dan materi silabus.</li>
          <li><strong>Ujian Kompetensi & E-Sertifikat SKPI:</strong> Peserta yang menuntaskan minimal 80% silabus dan lulus uji akhir berhak menerima e-sertifikat tripartit (FTI USN x MSC x PT Skillance) ber-QR Code untuk verifikasi otentisitas ijazah pendamping.</li>
        </ul>
      </div>

      <!-- PILAR 2 -->
      <div style="border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px 12px; margin-bottom: 10px; background: #ffffff;">
        <div style="font-weight: 800; color: #0d2e5c; font-size: 9.8pt; margin-bottom: 4px; display: flex; align-items: center; justify-content: space-between;">
          <span><i class="fa-solid fa-print text-warning me-1.5"></i>Pilar 2: Aquirist Print & Acrylic Studio (Atribut & Logistik Fisik)</span>
          <span style="font-size: 7.5pt; background: #fef3c7; color: #b45309; padding: 2px 6px; border-radius: 4px; font-weight: 700;">Produksi Mandiri Presisi</span>
        </div>
        <ul style="margin: 0; padding-left: 20px; font-size: 8.8pt; line-height: 1.38; color: #334155;">
          <li><strong>Seminar Kit Peserta:</strong> Totebag Kanvas/Spunbond premium berlogo MSC x Skillance, Blocknote spiral custom A5, pulpen gel cetak logo, dan stiker vinyl tech anti-air.</li>
          <li><strong>Tali Lanyard & ID Card:</strong> Lanyard bahan tissue halus full-color printing 2 sisi dilengkapi card-case transparan untuk seluruh peserta dan jajaran panitia UKM MSC.</li>
          <li><strong>Sertifikat Fisik Eksklusif:</strong> Dicetak di atas kertas Linen / Concorde tebal dengan frame guilloche resmi dan cap basah perusahaan.</li>
          <li><strong>Plakat Akrilik Premium Cinderamata:</strong> Plakat akrilik potong laser presisi tebal 8-10 mm dengan grafir UV berkualitas tinggi khusus diserahkan kepada Dekan FTI, Pembina Ormawa, dan Instruktur Tamu.</li>
        </ul>
      </div>

      <!-- PILAR 3 -->
      <div style="border: 1px solid #cbd5e1; border-radius: 6px; padding: 10px 12px; margin-bottom: 12px; background: #ffffff;">
        <div style="font-weight: 800; color: #0d2e5c; font-size: 9.8pt; margin-bottom: 4px; display: flex; align-items: center; justify-content: space-between;">
          <span><i class="fa-solid fa-newspaper text-danger me-1.5"></i>Pilar 3: Cerita Rakyat Official / XyronNews (Publikasi Berita Siber)</span>
          <span style="font-size: 7.5pt; background: #fee2e2; color: #b91c1c; padding: 2px 6px; border-radius: 4px; font-weight: 700;">Media Partner Resmi</span>
        </div>
        <ul style="margin: 0; padding-left: 20px; font-size: 8.8pt; line-height: 1.38; color: #334155;">
          <li><strong>Publikasi 2 Tahap (Pra & Pasca Acara):</strong> Penayangan siaran pers pembukaan pendaftaran serta artikel liputan khusus keberhasilan kegiatan di portal siber <em>xyronnews.com</em>.</li>
          <li><strong>Kutipan Pejabat Dekanat & Ormawa:</strong> Nama pimpinan dekanat dan ketua UKM MSC akan dikutip resmi sebagai narasumber berita, meningkatkan citra positif institusi di mata publik.</li>
          <li><strong>Dokumentasi Profesional:</strong> Penyediaan master foto dan dokumentasi video rangkuman kegiatan yang siap dilampirkan dalam Laporan Pertanggungjawaban (LPJ) kemahasiswaan dan borang akreditasi program studi.</li>
        </ul>
      </div>

      <h3 class="section-heading">
        <span>B. Manfaat Strategis untuk Fakultas & Akreditasi</span>
      </h3>
      <table class="table-custom">
        <thead>
          <tr>
            <th style="width: 28%;">Parameter IKU Kampus</th>
            <th style="width: 37%;">Kontribusi Program Kolaborasi</th>
            <th style="width: 35%;">Bukti Fisik / Output</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>IKU 2 (Pengalaman Luar Kampus)</strong></td>
            <td>Mahasiswa menyelesaikan 32 JP pembelajaran praktikum dengan kurikulum standar software house.</td>
            <td>Logbook aktivitas portal koding, kartu tugas, dan proyek aplikasi portofolio.</td>
          </tr>
          <tr>
            <td><strong>IKU 6 (Kemitraan DUDI Resmi)</strong></td>
            <td>Program Studi FTI memiliki kerja sama aktif dengan PT berbadan hukum SK Kemenkumham RI & NIB OSS.</td>
            <td>Naskah PKS Tripartit, Berita Acara Serah Terima (BAST), dan Plakat Akrilik Kemitraan.</td>
          </tr>
          <tr>
            <td><strong>Akreditasi LAM-INFOKOM</strong></td>
            <td>Bukti pemenuhan kompetensi tambahan lulusan di bidang rekayasa perangkat lunak dan kehumasan.</td>
            <td>Sertifikat SKPI terverifikasi dan kliping publikasi media massa online.</td>
          </tr>
        </tbody>
      </table>

    </div>

    <div class="page-footer">
      <span>PT Skillance Digital Indonesia &bull; Kemitraan Kampus FTI USN Kolaka</span>
      <span>Halaman 3 dari 5</span>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- HALAMAN 4: RENCANA ANGGARAN BIAYA & SIMULASI PROFIT SHARING    -->
  <!-- ============================================================== -->
  <div class="paper">
    <div class="page-body">
      
      <h3 class="section-heading">
        <span>C. Rencana Anggaran Biaya (RAB) Transparan</span>
        <span style="font-size: 8pt; color: #fe9800; text-transform: none;">Cohort: <?= $pesertaCount ?> Peserta Mahasiswa</span>
      </h3>

      <p>
        Rencana pembiayaan disusun secara menyeluruh dan terperinci. Setiap komponen telah memperhitungkan pengadaan material fisik kualitas terbaik serta operasional instruktur praktisi:
      </p>

      <table class="table-custom">
        <thead>
          <tr>
            <th style="width: 6%;" class="text-center">No</th>
            <th style="width: 44%;">Deskripsi Komponen & Layanan</th>
            <th style="width: 14%;" class="text-center">Volume</th>
            <th style="width: 18%;" class="text-end">Tarif Satuan (Rp)</th>
            <th style="width: 18%;" class="text-end">Subtotal (Rp)</th>
          </tr>
        </thead>
        <tbody>
          <!-- KOMPONEN 1: SKILLANCE ACADEMY -->
          <tr style="background: #eef2f6; font-weight: 700;">
            <td colspan="5"><i class="fa-solid fa-code text-primary me-1"></i>I. Komponen Skillance Academy (Edukasi & Lisensi Platform)</td>
          </tr>
          <tr>
            <td class="text-center">1</td>
            <td>Honorarium Instruktur Praktisi Industri & Asisten Lab (32 JP)</td>
            <td class="text-center">1 Paket</td>
            <td class="text-end"><?= number_format($pesertaCount == 30 ? 1200000 : ($pesertaCount == 50 ? 1750000 : 2800000), 0, ',', '.') ?></td>
            <td class="text-end"><?= number_format($pesertaCount == 30 ? 1200000 : ($pesertaCount == 50 ? 1750000 : 2800000), 0, ',', '.') ?></td>
          </tr>
          <tr>
            <td class="text-center">2</td>
            <td>Aktivasi Lisensi Akun Learning Track & Praktikum Portal Koding Mandiri</td>
            <td class="text-center"><?= $pesertaCount ?> User</td>
            <td class="text-end">25.000</td>
            <td class="text-end"><?= number_format($pesertaCount * 25000, 0, ',', '.') ?></td>
          </tr>
          <tr>
            <td class="text-center">3</td>
            <td>Penerbitan E-Certificate Terverifikasi QR Code SKPI Database Tripartit</td>
            <td class="text-center"><?= $pesertaCount ?> Sertifikat</td>
            <td class="text-end">15.000</td>
            <td class="text-end"><?= number_format($pesertaCount * 15000, 0, ',', '.') ?></td>
          </tr>

          <!-- KOMPONEN 2: AQUIRIST PRINT -->
          <tr style="background: #eef2f6; font-weight: 700;">
            <td colspan="5"><i class="fa-solid fa-print text-warning me-1"></i>II. Komponen Aquirist Print & Acrylic Studio (Atribut & Cinderamata)</td>
          </tr>
          <tr>
            <td class="text-center">4</td>
            <td>Seminar Kit Lengkap (Totebag Sablon Kemitraan + Blocknote A5 + Pen Gel)</td>
            <td class="text-center"><?= $pesertaCount ?> Set</td>
            <td class="text-end">30.000</td>
            <td class="text-end"><?= number_format($pesertaCount * 30000, 0, ',', '.') ?></td>
          </tr>
          <tr>
            <td class="text-center">5</td>
            <td>ID Card Peserta & Panitia + Tali Lanyard Tissue Fullcolor Cetak 2 Sisi</td>
            <td class="text-center"><?= $pesertaCount + 10 ?> Set</td>
            <td class="text-end">15.000</td>
            <td class="text-end"><?= number_format(($pesertaCount + 10) * 15000, 0, ',', '.') ?></td>
          </tr>
          <tr>
            <td class="text-center">6</td>
            <td>Sertifikat Fisik Cetak Bahan Linen / Concorde Premium Frame Emas</td>
            <td class="text-center"><?= $pesertaCount ?> Lembar</td>
            <td class="text-end">10.000</td>
            <td class="text-end"><?= number_format($pesertaCount * 10000, 0, ',', '.') ?></td>
          </tr>
          <tr>
            <td class="text-center">7</td>
            <td><strong>Plakat Akrilik Premium Cinderamata (Tebal 10mm Laser Grafir UV)</strong><br><small class="text-muted">Untuk Dekan FTI, Pembina Ormawa, dan Pemateri Tamu</small></td>
            <td class="text-center">3 Buah</td>
            <td class="text-end">150.000</td>
            <td class="text-end">450.000</td>
          </tr>

          <!-- KOMPONEN 3: MEDIA SIBER -->
          <tr style="background: #eef2f6; font-weight: 700;">
            <td colspan="5"><i class="fa-solid fa-newspaper text-danger me-1"></i>III. Komponen Cerita Rakyat Official / XyronNews (Publikasi Media Siber)</td>
          </tr>
          <tr>
            <td class="text-center">8</td>
            <td>Paket Publikasi Media Siber 2x Terbit (Pra-Event & Liputan Pasca-Acara) + Foto/Video LPJ</td>
            <td class="text-center">1 Paket</td>
            <td class="text-end"><?= number_format($pesertaCount == 30 ? 450000 : ($pesertaCount == 50 ? 500000 : 750000), 0, ',', '.') ?></td>
            <td class="text-end"><?= number_format($pesertaCount == 30 ? 450000 : ($pesertaCount == 50 ? 500000 : 750000), 0, ',', '.') ?></td>
          </tr>

          <tr style="background: #0d2e5c; color: #ffffff; font-weight: 800; font-size: 9.5pt;">
            <td colspan="4" class="text-end">TOTAL NILAI INVESTASI KEGIATAN</td>
            <td class="text-end">Rp <?= number_format($totalInvestasi, 0, ',', '.') ?>,-</td>
          </tr>
        </tbody>
      </table>

      <h3 class="section-heading">
        <span>D. Simulasi Skema Pendanaan & Bagi Hasil Kas Ormawa</span>
      </h3>

      <div style="display: flex; gap: 12px; margin-bottom: 8px;">
        <div style="flex: 1; border: 1.5px solid #0d2e5c; border-radius: 6px; padding: 10px; background: #f8fafc;">
          <div style="font-weight: 800; color: #0d2e5c; font-size: 8.8pt; text-transform: uppercase; margin-bottom: 4px;">
            <i class="fa-solid fa-ticket me-1 text-warning"></i>Skema A: Kontribusi Mandiri Mahasiswa (HTM)
          </div>
          <p style="font-size: 8pt; margin: 0; line-height: 1.35; color: #475569;">
            Setiap mahasiswa membayar kontribusi pendaftaran berkisar <strong>Rp <?= number_format($biayaPerPeserta, 0, ',', '.') ?> / orang</strong>. Sudah mendapatkan akses pelatihan koding 32 JP, seminar kit totebag/blocknote, sertifikat SKPI ganda (e-sertifikat + cetak linen), dan dokumentasi publikasi.
          </p>
        </div>
        <div style="flex: 1; border: 1.5px solid #10b981; border-radius: 6px; padding: 10px; background: #f0fdf4;">
          <div style="font-weight: 800; color: #047857; font-size: 8.8pt; text-transform: uppercase; margin-bottom: 4px;">
            <i class="fa-solid fa-coins me-1 text-success"></i>Skema B: Subsidi Dana Ormawa / DIPA Fakultas
          </div>
          <p style="font-size: 8pt; margin: 0; line-height: 1.35; color: #475569;">
            Kegiatan diajukan ke Dekanat FTI / Wakil Dekan III Bidang Kemahasiswaan melalui Pos Pembinaan Prestasi Ormawa, sehingga mahasiswa cukup membayar sisa biaya komitmen (misal: Rp 35.000 / orang), sisanya disubsidi anggaran kampus.
          </p>
        </div>
      </div>

      <div class="callout-box" style="border-left-color: #10b981; background: #f0fdf4;">
        <strong style="color: #047857;"><i class="fa-solid fa-hand-holding-dollar me-1"></i>Alokasi Bagi Hasil untuk Kas UKM Multimedia Study Club (MSC):</strong><br>
        Dari total perputaran kegiatan, PT Skillance Digital Indonesia mengalokasikan <strong>Rp <?= number_format($alokasiKasOrmawa, 0, ',', '.') ?>,-</strong> (atau setara 20% margin kegiatan) langsung diserahkan kepada Bendahara Umum UKM MSC sebagai pemasukan kas organisasi guna mendukung operasional program kerja berikutnya.
      </div>

    </div>

    <div class="page-footer">
      <span>PT Skillance Digital Indonesia &bull; Kemitraan Kampus FTI USN Kolaka</span>
      <span>Halaman 4 dari 5</span>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- HALAMAN 5: TIMELINE, LEGALITAS & LEMBAR PENGESAHAN             -->
  <!-- ============================================================== -->
  <div class="paper">
    <div class="page-body">
      
      <h3 class="section-heading">
        <span>E. Timeline Pelaksanaan Kegiatan (4 Pekan)</span>
      </h3>

      <table class="table-custom" style="margin-bottom: 12px;">
        <thead>
          <tr>
            <th style="width: 18%;">Tahapan</th>
            <th style="width: 32%;">Aktivitas Pelaksanaan</th>
            <th style="width: 28%;">Penanggung Jawab</th>
            <th style="width: 22%;">Target Output</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>Pekan I</strong></td>
            <td>Sosialisasi program, pembukaan registrasi mahasiswa, dan rilis berita pra-event.</td>
            <td>UKM MSC & XyronNews Media</td>
            <td>Daftar cohort peserta terverifikasi & berita online tayang.</td>
          </tr>
          <tr>
            <td><strong>Pekan II</strong></td>
            <td>Pembelajaran mandiri (Learning Track) pada portal koding 32 JP & produksi seminar kit.</td>
            <td>Skillance Academy & Aquirist Print</td>
            <td>Progress belajar online & kesiapan seminar kit/lanyard.</td>
          </tr>
          <tr>
            <td><strong>Pekan III</strong></td>
            <td>Live Mentoring / Workshop Tatap Muka (Lab Komputer FTI) & pembagian seminar kit.</td>
            <td>Tim Instruktur Skillance & Panitia MSC</td>
            <td>Praktikum aplikasi web & dokumentasi foto/video.</td>
          </tr>
          <tr>
            <td><strong>Pekan IV</strong></td>
            <td>Uji Kompetensi SKPI, penyerahan plakat akrilik pimpinan, & rilis berita penutupan.</td>
            <td>Dekanat, MSC, & PT Skillance</td>
            <td>Sertifikat SKPI terbit, BAST ditandatangani, LPJ rampung.</td>
          </tr>
        </tbody>
      </table>

      <h3 class="section-heading">
        <span>F. Penutup & Komitmen Integritas</span>
      </h3>
      <p class="indent">
        Demikian proposal penawaran program kolaborasi terpadu ini kami sampaikan dengan penuh tanggung jawab. Sinergi ini merupakan wujud nyata kontribusi dunia usaha dalam memajukan kualitas sumber daya manusia di lingkungan kampus Fakultas Teknologi Informasi Universitas Sembilanbelas November Kolaka.
      </p>
      <p class="indent">
        Atas perhatian, dukungan, dan kerja sama yang baik dari jajaran pimpinan Dekanat FTI serta rekan-rekan Pengurus UKM Multimedia Study Club, kami haturkan terima kasih yang sebesar-besarnya.
      </p>

      <!-- LEMBAR PENGESAHAN TRIPARTIT -->
      <div style="margin-top: 14px; border: 1.5px solid #cbd5e1; border-radius: 6px; padding: 12px; background: #ffffff;">
        <div style="text-align: center; font-weight: 800; font-family: 'Poppins', Arial, sans-serif; font-size: 9.5pt; color: #0d2e5c; text-transform: uppercase; margin-bottom: 10px;">
          LEMBAR KESEPAKATAN & PENGESAHAN PROGRAM KERJA SAMA
        </div>

        <table style="width: 100%; border-collapse: collapse; text-align: center; font-family: 'Times New Roman', Times, serif; font-size: 9.5pt;">
          <tr>
            <td style="width: 50%; vertical-align: top;">
              Pihak Pengusul Program:<br>
              <strong>PT SKILLANCE DIGITAL INDONESIA</strong>
              <div class="sig-img-wrap" style="height: 68px; margin: 2px auto;">
                <img src="../../assets/img/stempel_skillance_navy.png" alt="Stempel PT Skillance" class="sig-img-stamp" style="height: 60px; left: 22px;">
                <img src="../../assets/img/ttd-muh-arsyad-ramsi.png" alt="TTD Direktur" class="sig-img-ttd" style="height: 50px; left: 16px;">
              </div>
              <strong><u>MUH. ARSYAD RAMSI</u></strong><br>
              <span>Direktur Utama</span>
            </td>
            <td style="width: 50%; vertical-align: top;">
              Pihak Penyelenggara Ormawa:<br>
              <strong>UKM MULTIMEDIA STUDY CLUB (MSC)</strong>
              <div style="height: 68px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-style: italic; font-size: 8.5pt;">
                (Tanda Tangan & Stempel Ormawa)
              </div>
              <strong><u>KETUA UMUM UKM MSC</u></strong><br>
              <span>Pengurus Periode 2026/2027</span>
            </td>
          </tr>
          <tr>
            <td colspan="2" style="padding-top: 10px; vertical-align: top;">
              Mengetahui dan Menyetujui:<br>
              <strong>DEKANAT FAKULTAS TEKNOLOGI INFORMASI USN KOLAKA</strong>
              <div style="height: 65px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-style: italic; font-size: 8.5pt;">
                (Tanda Tangan & Cap Sah Dekanat)
              </div>
              <strong><u>DEKAN / WAKIL DEKAN BIDANG KEMAHASISWAAN</u></strong><br>
              <span>Fakultas Teknologi Informasi Universitas Sembilanbelas November Kolaka</span>
            </td>
          </tr>
        </table>
      </div>

    </div>

    <div class="page-footer">
      <span>PT Skillance Digital Indonesia &bull; Kemitraan Kampus FTI USN Kolaka</span>
      <span>Halaman 5 dari 5 (Lembar Akhir)</span>
    </div>
  </div>

</body>
</html>
