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
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Proposal Pengajuan Hibah Wirausaha Pemuda & Industri Kreatif Digital - PT Skillance Digital Indonesia</title>
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700;800;900&display=swap" rel="stylesheet">
  
  <style>
    @page {
      size: A4 portrait;
      margin: 10mm 14mm 10mm 14mm;
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
        padding: 10mm 14mm !important;
        width: 100% !important;
        max-width: 100% !important;
        min-height: auto !important;
        page-break-after: always !important;
        page-break-inside: avoid !important;
      }
      .paper:last-child {
        page-break-after: auto !important;
      }
    }

    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Times New Roman', Times, serif;
      font-size: 10.5pt;
      line-height: 1.45;
      color: #111827;
      background: #eef2f6;
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
      letter-spacing: 0.5px;
    }
    .badge-doc {
      background: rgba(255,255,255,0.2);
      color: #ffffff;
      font-size: 11px;
      font-weight: 600;
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

    /* Parameter Controls */
    .param-card {
      background: #ffffff;
      border-radius: 10px;
      padding: 12px 18px;
      max-width: 210mm;
      margin: 0 auto 16px auto;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      border: 1px solid #e2e8f0;
      font-family: 'Inter', Arial, sans-serif;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 12px;
    }
    .param-left {
      font-size: 12px;
      color: #475569;
    }
    .param-left strong {
      color: #0d2e5c;
    }
    .param-right {
      display: flex;
      align-items: center;
      gap: 8px;
    }
    .param-input-wrap label {
      font-size: 11px;
      font-weight: 700;
      color: #64748b;
      margin-right: 4px;
    }
    .param-input-wrap input {
      padding: 5px 10px;
      border-radius: 6px;
      border: 1px solid #cbd5e1;
      font-size: 12px;
      font-family: 'Inter', sans-serif;
      font-weight: 600;
      color: #0d2e5c;
    }

    /* A4 Paper Sheets */
    .paper {
      background: #fff;
      max-width: 210mm;
      min-height: 297mm;
      margin: 0 auto 26px auto;
      padding: 12mm 18mm 12mm 18mm;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .page-body {
      flex: 1;
    }

    /* Standard Kop Surat */
    .kop-surat {
      border-bottom: 2.5px double #0d2e5c;
      padding-bottom: 6px;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
    }
    .kop-logo {
      width: 66px;
      height: 66px;
      object-fit: contain;
      flex-shrink: 0;
    }
    .kop-spacer {
      width: 66px;
      flex-shrink: 0;
    }
    .kop-text {
      text-align: center;
      flex: 1;
    }
    .kop-title-main {
      margin: 0 0 1px 0;
      font-size: 14pt;
      font-weight: 800;
      color: #0d2e5c;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-family: 'Poppins', Arial, sans-serif;
    }
    .kop-sub {
      margin: 0 0 2px 0;
      font-size: 7.8pt;
      font-weight: 700;
      color: #d97706;
      text-transform: uppercase;
      letter-spacing: 0.4px;
      font-family: Arial, sans-serif;
    }
    .kop-text p.meta {
      margin: 1px 0;
      font-size: 7.2pt;
      font-family: 'Inter', Arial, sans-serif;
      color: #374151;
      line-height: 1.3;
    }

    /* Document Titles */
    .doc-title-box {
      text-align: center;
      margin: 10px 0 14px 0;
    }
    .doc-title-main {
      margin: 0 0 2px 0;
      font-size: 12pt;
      font-weight: 800;
      color: #0d2e5c;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      text-decoration: underline;
    }
    .doc-title-sub {
      margin: 0;
      font-size: 8.8pt;
      font-weight: 600;
      color: #4b5563;
      font-family: 'Inter', Arial, sans-serif;
    }

    /* Headings */
    h3.section-heading {
      font-family: 'Poppins', Arial, sans-serif;
      font-size: 10.5pt;
      font-weight: 700;
      color: #0d2e5c;
      border-bottom: 1.5px solid #0d2e5c;
      padding-bottom: 3px;
      margin-top: 14px;
      margin-bottom: 8px;
      text-transform: uppercase;
      letter-spacing: 0.3px;
    }

    p {
      text-align: justify;
      margin-top: 0;
      margin-bottom: 7px;
      text-indent: 26px;
      font-size: 10pt;
      line-height: 1.42;
    }
    p.no-indent {
      text-indent: 0;
    }

    /* Tables */
    table.data-table {
      width: 100%;
      border-collapse: collapse;
      margin: 8px 0 12px 0;
      font-size: 9.5pt;
    }
    table.data-table th, table.data-table td {
      border: 1px solid #cbd5e1;
      padding: 5px 8px;
      vertical-align: middle;
    }
    table.data-table th {
      background-color: #f1f5f9;
      color: #0d2e5c;
      font-weight: 700;
      text-align: center;
      font-family: 'Inter', Arial, sans-serif;
    }

    .meta-table {
      width: 100%;
      margin-bottom: 10px;
      font-size: 10pt;
    }
    .meta-table td {
      vertical-align: top;
      padding: 2px 0;
    }
    .meta-table td.col-label {
      width: 130px;
      font-weight: 600;
    }
    .meta-table td.col-colon {
      width: 15px;
      text-align: center;
    }

    /* Highlight & Cards */
    .highlight-card {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-left: 4px solid #fe9800;
      padding: 8px 12px;
      margin: 8px 0;
      font-family: 'Inter', Arial, sans-serif;
      font-size: 9pt;
      border-radius: 4px;
      line-height: 1.4;
    }

    /* Footer Page Number */
    .page-footer-note {
      border-top: 1px solid #e2e8f0;
      padding-top: 6px;
      margin-top: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-family: 'Inter', Arial, sans-serif;
      font-size: 7.5pt;
      color: #64748b;
    }

    /* Signature Block */
    .sig-row {
      display: flex;
      justify-content: space-between;
      margin-top: 16px;
      page-break-inside: avoid;
    }
    .sig-box {
      width: 220px;
      text-align: center;
    }
    .ttd-space {
      height: 65px;
      position: relative;
    }
    .ttd-name {
      font-weight: bold;
      text-decoration: underline;
      font-size: 10.5pt;
      margin-bottom: 1px;
    }
    .ttd-role {
      font-size: 9pt;
      color: #4b5563;
      margin: 0;
    }

    [contenteditable="true"] {
      outline: none;
      transition: background 0.2s;
      border-radius: 2px;
    }
    [contenteditable="true"]:hover {
      background: rgba(254, 152, 0, 0.1);
    }
    [contenteditable="true"]:focus {
      background: rgba(254, 152, 0, 0.18);
      box-shadow: 0 0 0 2px #fe9800;
    }
  </style>
</head>
<body>

  <!-- TOP BAR (NO PRINT) -->
  <div class="top-nav-bar no-print">
    <div class="toolbar-left">
      <a href="index.php" class="btn-nav-tool">
        <i class="fa-solid fa-arrow-left"></i> Pusat Dokumen
      </a>
      <span class="badge-org">PT SKILLANCE DIGITAL INDONESIA</span>
      <span class="badge-doc">Proposal Hibah Wirausaha Pemuda 2026</span>
    </div>
    <div class="toolbar-right">
      <a href="surat-pengantar-hibah.php" target="_blank" class="btn-nav-tool">
        <i class="fa-solid fa-envelope-open-text"></i> Surat Pengantar Hibah &raquo;
      </a>
      <button class="btn-print-main" onclick="window.print()">
        <i class="fa-solid fa-print"></i> Cetak Dokumen (A4)
      </button>
    </div>
  </div>

  <!-- PARAMETER CONTROL (NO PRINT) -->
  <div class="param-card no-print">
    <div class="param-left">
      <strong><i class="fa-solid fa-sliders text-warning me-1.5"></i>Parameter Dokumen Hibah Wirausaha Pemuda (WMP):</strong>
      <span class="text-muted ms-1">Sesuaikan target instansi pemberi hibah, tanggal pengajuan, dan total anggaran yang diajukan.</span>
    </div>
    <div class="param-right">
      <div class="param-input-wrap">
        <label>Instansi Tujuan:</label>
        <input type="text" id="targetAgencyInput" value="Kemenpora RI / Dinas Pemuda dan Olahraga" style="width: 260px;" oninput="syncParams()">
      </div>
      <div class="param-input-wrap">
        <label>Tanggal Surat:</label>
        <input type="text" id="targetDateInput" value="16 November 2026" style="width: 140px;" oninput="syncParams()">
      </div>
      <div class="param-input-wrap">
        <label>Total Usulan RAB:</label>
        <input type="text" id="targetTotalRabInput" value="Rp 18.000.000,-" style="width: 140px;" oninput="syncParams()">
      </div>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- HALAMAN 1: COVER / SAMPUL RESMI PROPOSAL HIBAH                 -->
  <!-- ============================================================== -->
  <div class="paper" style="border: 4px double #0d2e5c; padding: 18mm 16mm; justify-content: space-between;">
    <div class="page-body" style="text-align: center; display: flex; flex-direction: column; justify-content: space-between; height: 100%;">
      
      <div>
        <div style="font-family: 'Poppins', Arial, sans-serif; font-size: 13pt; font-weight: 800; color: #0d2e5c; letter-spacing: 1px; margin-bottom: 4px;">
          PROPOSAL PENGAJUAN BANTUAN DANA HIBAH
        </div>
        <div style="font-family: 'Inter', Arial, sans-serif; font-size: 10.5pt; font-weight: 700; color: #d97706; letter-spacing: 0.5px; text-transform: uppercase;">
          PROGRAM PENGEMBANGAN WIRAUSAHA PEMUDA PEMULA (WMP) & INDUSTRI KREATIF
        </div>
        <div style="width: 80px; height: 3px; background: #0d2e5c; margin: 12px auto;"></div>
      </div>

      <div style="margin: 25px 0;">
        <img src="../../assets/img/logo_skillance_icon.png" style="width: 110px; height: 110px; object-fit: contain; margin-bottom: 16px;" alt="Logo PT Skillance">
        <div style="font-family: 'Poppins', Arial, sans-serif; font-size: 18pt; font-weight: 900; color: #0d2e5c; text-transform: uppercase; margin-bottom: 6px;">
          PT SKILLANCE DIGITAL INDONESIA
        </div>
        <div style="font-family: 'Inter', Arial, sans-serif; font-size: 9.5pt; font-weight: 600; color: #475569; max-width: 520px; margin: 0 auto; line-height: 1.5;">
          "Sentra Inovasi Teknologi Informasi (Software House) dan Pusat Produksi Kreatif Berkelanjutan (Aquiris) Berbasis Pemberdayaan Pemuda Daerah"
        </div>
      </div>

      <div style="background: #f8fafc; border: 1.5px solid #cbd5e1; border-radius: 8px; padding: 14px 20px; max-width: 480px; margin: 0 auto; text-align: left; font-family: 'Inter', Arial, sans-serif; font-size: 8.8pt;">
        <div style="font-weight: 800; color: #0d2e5c; margin-bottom: 6px; text-transform: uppercase; border-bottom: 1px solid #e2e8f0; padding-bottom: 4px;">
          <i class="fa-solid fa-id-card me-1 text-warning"></i>Identitas Perusahaan Pengusul:
        </div>
        <table style="width: 100%; border: none; font-size: 8.5pt;">
          <tr>
            <td style="width: 130px; font-weight: 600; padding: 2px 0;">SK Kemenkumham RI</td>
            <td style="width: 10px;">:</td>
            <td><strong>AHU-A138609.AH.01.30.Tahun 2026</strong></td>
          </tr>
          <tr>
            <td style="font-weight: 600; padding: 2px 0;">NIB OSS BKPM RI</td>
            <td>:</td>
            <td>Terdaftar KBLI 62019 & 62029</td>
          </tr>
          <tr>
            <td style="font-weight: 600; padding: 2px 0;">NPWP Badan Usaha</td>
            <td>:</td>
            <td><strong>100000011940526</strong></td>
          </tr>
          <tr>
            <td style="font-weight: 600; padding: 2px 0;">Founder & Direktur</td>
            <td>:</td>
            <td><strong>MUH ARSYAD RAMSI</strong></td>
          </tr>
          <tr>
            <td style="font-weight: 600; padding: 2px 0;">Finance Officer</td>
            <td>:</td>
            <td><strong>RINA</strong></td>
          </tr>
          <tr>
            <td style="font-weight: 600; padding: 2px 0;">Total Nilai Usulan</td>
            <td>:</td>
            <td><strong class="target-total-rab-text" style="color: #0d2e5c; font-size: 9.5pt;">Rp 18.000.000,-</strong></td>
          </tr>
        </table>
      </div>

      <div style="margin-top: 25px;">
        <div style="font-size: 9.5pt; font-weight: 600; color: #4b5563; text-transform: uppercase; margin-bottom: 4px;">
          Diajukan Kepada Yth:
        </div>
        <div class="target-agency-text" style="font-family: 'Poppins', Arial, sans-serif; font-size: 11pt; font-weight: 800; color: #0d2e5c; text-transform: uppercase;">
          Kementerian Pemuda dan Olahraga Republik Indonesia / Dinas Pemuda dan Olahraga
        </div>
        <div style="font-size: 9pt; color: #64748b; margin-top: 14px;">
          Kabupaten Bombana, Provinsi Sulawesi Tenggara &bull; Tahun 2026
        </div>
      </div>

    </div>
  </div>

  <!-- ============================================================== -->
  <!-- HALAMAN 2: SURAT PERMOHONAN RESMI & LEMBAR PENGESAHAN           -->
  <!-- ============================================================== -->
  <div class="paper">
    <div class="page-body">
      
      <!-- KOP SURAT -->
      <div class="kop-surat">
        <img src="../../assets/img/logo_skillance_icon.png" class="kop-logo" alt="Logo Skillance">
        <div class="kop-text">
          <h2 class="kop-title-main">PT SKILLANCE DIGITAL INDONESIA</h2>
          <div class="kop-sub">SOFTWARE HOUSE, IT SOLUTIONS & CREATIVE PRODUCTION PARTNER</div>
          <p class="meta"><strong>SK Kemenkumham RI:</strong> AHU-A138609.AH.01.30.Tahun 2026 &bull; <strong>NPWP:</strong> 100000011940526 &bull; <strong>NIB:</strong> Terdaftar OSS BKPM RI</p>
          <p class="meta"><strong>Alamat Kantor:</strong> Desa Pabiring Dusun Taruseng, Kec. Poleang Barat, Kab. Bombana, Sulawesi Tenggara 93772</p>
          <p class="meta"><strong>Website:</strong> https://skillance.cloud &bull; <strong>Surel:</strong> official@skillance.cloud &bull; <strong>Hotline/WA:</strong> 0811-4030-800</p>
        </div>
        <div class="kop-spacer"></div>
      </div>

      <!-- TANGGAL & META SURAT -->
      <table class="meta-table">
        <tr>
          <td class="col-label">Nomor</td>
          <td class="col-colon">:</td>
          <td><strong contenteditable="true">038/EXT-GR/SDI/XI/2026</strong></td>
          <td style="text-align: right;" contenteditable="true">Bombana, <span class="target-date-text">16 November 2026</span></td>
        </tr>
        <tr>
          <td class="col-label">Lampiran</td>
          <td class="col-colon">:</td>
          <td contenteditable="true">1 (Satu) Berkas Proposal Usaha & Rencana Anggaran Biaya (RAB)</td>
          <td></td>
        </tr>
        <tr>
          <td class="col-label">Perihal</td>
          <td class="col-colon">:</td>
          <td><strong contenteditable="true">Permohonan Bantuan Dana Hibah Pengembangan Usaha Pemula (WMP)</strong></td>
          <td></td>
        </tr>
      </table>

      <!-- TUJUAN -->
      <div style="margin-bottom: 12px; font-size: 10pt; line-height: 1.4;">
        Kepada Yth.<br>
        <strong class="target-agency-text" contenteditable="true">Pimpinan Program Bantuan Wirausaha Pemuda (WMP) / Dinas Terkait</strong><br>
        di - <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tempat
      </div>

      <p class="no-indent">Dengan hormat,</p>
      
      <p>
        Puji syukur kita panjatkan ke hadirat Tuhan Yang Maha Esa. Sehubungan dengan program penguatan kapasitas dan bantuan modal kerja bagi Wirausaha Pemuda Pemula (WMP), perkenankan kami dari <strong>PT SKILLANCE DIGITAL INDONESIA</strong> mengajukan proposal permohonan bantuan dana hibah pengembangan usaha di bidang <strong>Teknologi Informasi (Software House) dan Industri Percetakan Kreatif (Aquiris)</strong>.
      </p>

      <p>
        PT SKILLANCE DIGITAL INDONESIA didirikan oleh pemuda daerah di Kabupaten Bombana, Sulawesi Tenggara, dengan badan hukum resmi Kemenkumham RI Nomor: <strong>AHU-A138609.AH.01.30.Tahun 2026</strong>. Fokus usaha kami adalah menjawab tantangan digitalisasi di daerah melalui pengembangan sistem informasi manajemen sekolah/dinas serta penyediaan sentra produksi cinderamata dan plakat akrilik lokal yang berdaya saing tinggi.
      </p>

      <div class="highlight-card">
        <strong>Ringkasan Usulan Bantuan Modal:</strong>
        <ul style="margin: 3px 0 0 16px; padding: 0;">
          <li><strong>Total Usulan Anggaran:</strong> <span class="target-total-rab-text">Rp 18.000.000,-</span> (Delapan Belas Juta Rupiah).</li>
          <li><strong>Pemanfaatan Utama:</strong> Pengadaan mesin UV/Cutting Akrilik presisi, peningkatan kapasitas server cloud, serta penyediaan bahan baku produksi dan insentif pelatihan kerja siswa magang SMK lokal.</li>
        </ul>
      </div>

      <p>
        Sebagai bahan pertimbangan dan kelengkapan seleksi administrasi, bersama surat ini kami lampirkan dokumen profil usaha, model bisnis, analisis kelayakan pasar, Rencana Anggaran Biaya (RAB), serta legalitas resmi badan usaha.
      </p>

      <p>
        Demikian permohonan ini kami sampaikan dengan harapan besar kiranya Bapak/Ibu pimpinan berkenan memberikan dukungan dan rekomendasi. Atas perhatian dan kesempatannya, kami haturkan terima kasih.
      </p>

      <!-- TANDA TANGAN BERSAMA -->
      <div class="sig-row">
        <div class="sig-box">
          <div style="font-size: 9.5pt; font-weight: 600; margin-bottom: 2px;">Mengetahui,</div>
          <div style="font-size: 9pt; color: #4b5563;">Finance & Administration Officer</div>
          <div class="ttd-space"></div>
          <div class="ttd-name" contenteditable="true">RINA</div>
          <div class="ttd-role">NIP/ID: SDI-FIN-2026-02</div>
        </div>

        <div class="sig-box">
          <div style="font-size: 9.5pt; font-weight: 600; margin-bottom: 2px;">Hormat Kami,</div>
          <div style="font-size: 9pt; color: #0d2e5c; font-weight: 700;">PT SKILLANCE DIGITAL INDONESIA</div>
          <div class="ttd-space"></div>
          <div class="ttd-name" contenteditable="true">MUH ARSYAD RAMSI</div>
          <div class="ttd-role">Founder & Direktur Utama</div>
        </div>
      </div>

    </div>

    <div class="page-footer-note">
      <span>PT SKILLANCE DIGITAL INDONESIA &bull; Proposal Bantuan Wirausaha Pemuda 2026</span>
      <span>Halaman 2 dari 6</span>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- HALAMAN 3: RINGKASAN EKSEKUTIF, LATAR BELAKANG & PROFIL TIM    -->
  <!-- ============================================================== -->
  <div class="paper">
    <div class="page-body">
      
      <div class="doc-title-box">
        <div class="doc-title-main">BAB I: PROFIL PERUSAHAAN & LATAR BELAKANG USAHA</div>
        <div class="doc-title-sub">Inisiatif Kewirausahaan Pemuda Mandiri di Sektor Digital & Kreatif</div>
      </div>

      <h3 class="section-heading">1.1 Latar Belakang & Urgensi Masalah Daerah</h3>
      <p>
        Kesenjangan infrastruktur digital dan akses teknologi antara kota-kota metropolitan dengan wilayah kabupaten/daerah berkembang di kawasan Timur Indonesia, khususnya Kabupaten Bombana, Sulawesi Tenggara, masih sangat terasa. Berbagai instansi pelayanan publik, sekolah, dan pelaku usaha mikro di daerah masih banyak yang menggunakan pencatatan konvensional berbasis kertas manual, yang rentan hilang, boros anggaran, dan lambat dalam pelaporan.
      </p>
      <p>
        Di sisi lain, kebutuhan akan produk promosi fisik seperti plakat akrilik, stempel, dan perlengkapan perkantoran selama ini masih banyak dipesan dari luar pulau dengan ongkos kirim yang mahal dan waktu tunggu yang lama. Hadirnya <strong>PT SKILLANCE DIGITAL INDONESIA</strong> bertujuan memutus ketergantungan tersebut dengan menghadirkan solusi teknologi terpadu dan sentra produksi kreatif langsung di daerah.
      </p>

      <h3 class="section-heading">1.2 Visi & Misi Perusahaan</h3>
      <div style="font-size: 9.8pt; line-height: 1.45; margin-bottom: 8px;">
        <strong>Visi Perusahaan:</strong><br>
        Menjadi perusahaan teknologi informasi dan industri kreatif daerah yang berdaya saing nasional, mendorong terciptanya tata kelola digital mandiri, serta memberdayakan generasi muda lokal menjadi talenta digital produktif.
      </div>
      <div style="font-size: 9.8pt; line-height: 1.45;">
        <strong>Misi Perusahaan:</strong>
        <ol style="margin: 3px 0 0 18px; padding: 0;">
          <li>Mengembangkan aplikasi web dan mobile kustom yang terjangkau untuk sekolah dan dinas pemerintah.</li>
          <li>Menyediakan sentra produksi percetakan dan cinderamata akrilik berkualitas dengan waktu pengerjaan cepat.</li>
          <li>Membina dan menyerap tenaga kerja pemuda lokal melalui program kemitraan dan magang vokasi.</li>
        </ol>
      </div>

      <h3 class="section-heading">1.3 Struktur Organisasi & Pengelola Inti</h3>
      <table class="data-table">
        <thead>
          <tr>
            <th style="width: 25%;">Posisi / Jabatan</th>
            <th style="width: 30%;">Nama Pejabat</th>
            <th style="width: 45%;">Tugas Pokok & Kompetensi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>Founder & Direktur</strong></td>
            <td><strong>Muh Arsyad Ramsi</strong></td>
            <td>Penanggung jawab operasional, arsitektur sistem software, dan strategic business relation.</td>
          </tr>
          <tr>
            <td><strong>Finance Officer</strong></td>
            <td><strong>Rina</strong></td>
            <td>Pengelolaan tata kelola keuangan, administrasi penagihan, perpajakan, dan pelaporan SPJ.</td>
          </tr>
          <tr>
            <td><strong>Teknisi Produksi</strong></td>
            <td>2 Orang Staf Lokal</td>
            <td>Operator mesin cetak, perakitan akrilik, finishing plakat, dan quality control produk.</td>
          </tr>
          <tr>
            <td><strong>Tim Media & Lapangan</strong></td>
            <td>1 Editor & 5 Wartawan</td>
            <td>Pengelolaan publikasi berita siber daerah (Cerita Rakyat ID) dan kemitraan advertorial.</td>
          </tr>
        </tbody>
      </table>

      <h3 class="section-heading">1.4 Legalitas Badan Usaha</h3>
      <p class="no-indent" style="font-size: 9.5pt;">
        PT SKILLANCE DIGITAL INDONESIA telah terdaftar secara sah pada basis data nasional:
      </p>
      <ul style="margin: 2px 0 0 18px; padding: 0; font-size: 9.3pt; line-height: 1.4;">
        <li><strong>Keputusan Menteri Hukum dan HAM RI:</strong> AHU-A138609.AH.01.30.Tahun 2026.</li>
        <li><strong>Nomor Pokok Wajib Pajak (NPWP Badan):</strong> 100000011940526 (KPP Pratama Kolaka).</li>
        <li><strong>Nomor Induk Berusaha (NIB OSS BKPM):</strong> KBLI Aktivitas Pemrograman Komputer & Konsultasi TI.</li>
      </ul>

    </div>

    <div class="page-footer-note">
      <span>PT SKILLANCE DIGITAL INDONESIA &bull; Proposal Bantuan Wirausaha Pemuda 2026</span>
      <span>Halaman 3 dari 6</span>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- HALAMAN 4: PRODUK UNGGULAN, MODEL BISNIS & DAMPAK SOSIAL       -->
  <!-- ============================================================== -->
  <div class="paper">
    <div class="page-body">
      
      <div class="doc-title-box">
        <div class="doc-title-main">BAB II: PRODUK, MODEL BISNIS & DAMPAK SOSIAL</div>
        <div class="doc-title-sub">Strategi Pertumbuhan Berkelanjutan dan Pemberdayaan Komunitas</div>
      </div>

      <h3 class="section-heading">2.1 Tiga Lini Produk & Layanan Unggulan</h3>
      
      <div style="display: flex; gap: 10px; margin-bottom: 10px;">
        <div style="flex: 1; border: 1px solid #cbd5e1; border-top: 3px solid #0d2e5c; padding: 8px 10px; background: #f8fafc; border-radius: 4px;">
          <div style="font-weight: 700; color: #0d2e5c; font-size: 9.5pt; margin-bottom: 3px;"><i class="fa-solid fa-code text-primary me-1"></i>1. GovTech & Software</div>
          <div style="font-size: 8.5pt; color: #475569; line-height: 1.35;">
            Pengembangan platform sistem informasi: <em>Smart School CBT</em>, Web-GIS Kehutanan, Antrean Online Dukcapil, dan E-Pengawasan Inspektorat.
          </div>
        </div>

        <div style="flex: 1; border: 1px solid #cbd5e1; border-top: 3px solid #fe9800; padding: 8px 10px; background: #f8fafc; border-radius: 4px;">
          <div style="font-weight: 700; color: #0d2e5c; font-size: 9.5pt; margin-bottom: 3px;"><i class="fa-solid fa-cube text-warning me-1"></i>2. Aquiris Creative Print</div>
          <div style="font-size: 8.5pt; color: #475569; line-height: 1.35;">
            Sentra produksi merchandise fisik: plakat akrilik wisuda/kegiatan, papan nama instansi, stempel dinas, cetak map rapor, dan kartu tanda pengenal (ID Card).
          </div>
        </div>

        <div style="flex: 1; border: 1px solid #cbd5e1; border-top: 3px solid #10b981; padding: 8px 10px; background: #f8fafc; border-radius: 4px;">
          <div style="font-weight: 700; color: #0d2e5c; font-size: 9.5pt; margin-bottom: 3px;"><i class="fa-solid fa-graduation-cap text-success me-1"></i>3. EdTech & Media Siber</div>
          <div style="font-size: 8.5pt; color: #475569; line-height: 1.35;">
            Portal berita resmi daerah (Cerita Rakyat ID) dan platform pembelajaran coding online (Skillance Academy) dengan uji kompetensi digital SKPI.
          </div>
        </div>
      </div>

      <h3 class="section-heading">2.2 Analisis Pasar & Keunggulan Kompetitif (*Competitive Advantage*)</h3>
      <table class="data-table">
        <thead>
          <tr>
            <th style="width: 25%;">Segmen Pasar</th>
            <th style="width: 35%;">Kebutuhan Rutin Pelanggan</th>
            <th style="width: 40%;">Nilai Tambah PT Skillance</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>Dinas & Instansi Pemda</strong></td>
            <td>Digitalisasi SPBE, sistem antrean, aplikasi pelaporan, dan plakat kenang-kenangan.</td>
            <td>Dukungan teknis lokal 24/7 (cepat merespons jika ada kendala di lapangan), harga kompetitif.</td>
          </tr>
          <tr>
            <td><strong>Sekolah & Kampus</strong></td>
            <td>Ujian sekolah digital tanpa kertas (CBT mandiri), PPDB, serta sertifikat/plakat wisuda.</td>
            <td>Sistem terintegrasi offline-online, hemat anggaran belanja kertas ratusan rim tiap tahun.</td>
          </tr>
          <tr>
            <td><strong>Pemerintah Desa & UMKM</strong></td>
            <td>Papan informasi desa, plakat KKN mahasiswa, nota transaksi, kemasan produk UMKM.</td>
            <td>Bisa pesan satuan tanpa minimum order tinggi, desain profesional gratis.</td>
          </tr>
        </tbody>
      </table>

      <h3 class="section-heading">2.3 Dampak Sosial & Penyerapan Tenaga Kerja Pemuda (*Social Impact*)</h3>
      <p>
        Bantuan hibah modal wirausaha ini tidak hanya berdampak pada pertumbuhan finansial perusahaan, melainkan memberikan multiplier effect yang nyata bagi generasi muda setempat:
      </p>
      <ul style="margin: 2px 0 0 18px; padding: 0; font-size: 9.3pt; line-height: 1.45;">
        <li><strong>Membuka Kesempatan Magang Vokasi (PKL SMK):</strong> Memberikan tempat magang resmi bagi siswa jurusan Rekayasa Perangkat Lunak (RPL), Akuntansi, dan Multimedia di Bombana.</li>
        <li><strong>Pemberdayaan Ekonomi Wartawan Pemuda:</strong> Memberikan wadah bagi 5 wartawan pemuda lokal untuk berkarya di media pers berbadan hukum dengan sistem bagi hasil advertorial yang adil.</li>
        <li><strong>Pengurangan Emisi Karbon & Efisiensi Daerah:</strong> Membantu instansi beralih ke sistem *paperless* melalui aplikasi ujian dan sistem kearsipan berbasis cloud.</li>
      </ul>

    </div>

    <div class="page-footer-note">
      <span>PT SKILLANCE DIGITAL INDONESIA &bull; Proposal Bantuan Wirausaha Pemuda 2026</span>
      <span>Halaman 4 dari 6</span>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- HALAMAN 5: RENCANA ANGGARAN BIAYA (RAB) & ANALISIS KEUANGAN    -->
  <!-- ============================================================== -->
  <div class="paper">
    <div class="page-body">
      
      <div class="doc-title-box">
        <div class="doc-title-main">BAB III: RENCANA ANGGARAN BIAYA (RAB) & KEBERLANJUTAN USAHA</div>
        <div class="doc-title-sub">Alokasi Anggaran Belanja Produktif dan Target Kinerja Finansial</div>
      </div>

      <h3 class="section-heading">3.1 Rincian Rencana Anggaran Biaya (RAB) Pengajuan Dana Hibah</h3>
      <p class="no-indent" style="font-size: 9.3pt; margin-bottom: 6px;">
        Total permohonan bantuan dana hibah sebesar <strong class="target-total-rab-text">Rp 18.000.000,-</strong> dialokasikan 100% pada belanja aset produktif dan modal kerja:
      </p>

      <table class="data-table">
        <thead>
          <tr>
            <th style="width: 5%;">No</th>
            <th style="width: 45%;">Komponen Pengeluaran / Item Belanja</th>
            <th style="width: 15%;">Volume</th>
            <th style="width: 15%;">Harga Satuan</th>
            <th style="width: 20%;">Jumlah (Rp)</th>
          </tr>
        </thead>
        <tbody>
          <tr style="background: #fdf6ec;">
            <td colspan="5"><strong>A. BELANJA MODAL ASET PRODUKTIF (CAPITAL EXPENDITURE)</strong></td>
          </tr>
          <tr>
            <td style="text-align: center;">1</td>
            <td><strong>Mesin UV Flatbed Mini & Rotary Engraver Akrilik:</strong><br><span style="font-size: 8pt; color: #64748b;">Untuk produksi plakat akrilik, gantungan kunci, dan cetak UV presisi instansi.</span></td>
            <td style="text-align: center;">1 Unit</td>
            <td style="text-align: right;">Rp 8.000.000</td>
            <td style="text-align: right; font-weight: 700;">Rp 8.000.000</td>
          </tr>
          <tr>
            <td style="text-align: center;">2</td>
            <td><strong>Mesin Pemotong Akrilik & Toolset Finishing Presisi:</strong><br><span style="font-size: 8pt; color: #64748b;">Alat potong pola sudut, penghalus tepi akrilik, dan heat gun bending.</span></td>
            <td style="text-align: center;">1 Set</td>
            <td style="text-align: right;">Rp 2.500.000</td>
            <td style="text-align: right; font-weight: 700;">Rp 2.500.000</td>
          </tr>
          <tr>
            <td style="text-align: center;">3</td>
            <td><strong>Infrastruktur Cloud VPS High-Performance 1 Tahun:</strong><br><span style="font-size: 8pt; color: #64748b;">Hosting dedicated, SSL wildcard, domain skillance.cloud, dan database storage.</span></td>
            <td style="text-align: center;">1 Paket</td>
            <td style="text-align: right;">Rp 2.500.000</td>
            <td style="text-align: right; font-weight: 700;">Rp 2.500.000</td>
          </tr>

          <tr style="background: #fdf6ec;">
            <td colspan="5"><strong>B. MODAL KERJA & PENGEMBANGAN SDM VOKASI (OPERATIONAL EXPENDITURE)</strong></td>
          </tr>
          <tr>
            <td style="text-align: center;">4</td>
            <td><strong>Stok Bahan Baku Akrilik Sheet, Tinta Sublim & Kertas:</strong><br><span style="font-size: 8pt; color: #64748b;">Akrilik bening/hitam 2mm, 3mm, 5mm, bahan stempel, dan tinta original.</span></td>
            <td style="text-align: center;">1 Paket</td>
            <td style="text-align: right;">Rp 3.000.000</td>
            <td style="text-align: right; font-weight: 700;">Rp 3.000.000</td>
          </tr>
          <tr>
            <td style="text-align: center;">5</td>
            <td><strong>Uang Saku & Pembinaan Vokasi 2 Siswa Magang SMK:</strong><br><span style="font-size: 8pt; color: #64748b;">Bantuan uang transport/makan 2 siswa magang selama 3 bulan masa praktik.</span></td>
            <td style="text-align: center;">2 Orang</td>
            <td style="text-align: right;">Rp 1.000.000</td>
            <td style="text-align: right; font-weight: 700;">Rp 2.000.000</td>
          </tr>

          <tr style="background: #0d2e5c; color: #ffffff; font-weight: bold; font-size: 10pt;">
            <td colspan="4" style="text-align: right; padding-right: 14px;">TOTAL USULAN ANGGARAN HIBAH (A + B)</td>
            <td style="text-align: right; color: #fe9800; font-size: 11pt;">Rp 18.000.000</td>
          </tr>
        </tbody>
      </table>

      <h3 class="section-heading">3.2 Proyeksi Peningkatan Pendapatan & Kemandirian Usaha</h3>
      <p>
        Dengan adanya penambahan mesin cetak akrilik sendiri dan server cloud berkapasitas tinggi, efisiensi produksi kami meningkat hingga <strong>60%</strong> (karena tidak lagi bergantung pada jasa perantara pihak ketiga di luar kota).
      </p>

      <table class="data-table">
        <thead>
          <tr>
            <th>Indikator Keuangan</th>
            <th>Sebelum Bantuan Hibah</th>
            <th>Target Pasca Injeksi Hibah (Bulan ke-3)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>Kapasitas Produksi Akrilik/Bulan</strong></td>
            <td>20 – 30 pcs (terbatas)</td>
            <td><strong>150 – 250 pcs / bulan</strong> (siap layani dinas & sekolah)</td>
          </tr>
          <tr>
            <td><strong>Omzet Rata-Rata per Bulan</strong></td>
            <td>Rp 2.000.000 – Rp 3.000.000</td>
            <td><strong>Rp 10.000.000 – Rp 20.000.000 / bulan</strong></td>
          </tr>
          <tr>
            <td><strong>Tenaga Kerja Pemuda yang Diberdayakan</strong></td>
            <td>3 Orang</td>
            <td><strong>8 – 10 Orang</strong> (termasuk tim wartawan & anak magang)</td>
          </tr>
        </tbody>
      </table>

    </div>

    <div class="page-footer-note">
      <span>PT SKILLANCE DIGITAL INDONESIA &bull; Proposal Bantuan Wirausaha Pemuda 2026</span>
      <span>Halaman 5 dari 6</span>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- HALAMAN 6: PAKTA INTEGRITAS, SPTJM & PENUTUP                   -->
  <!-- ============================================================== -->
  <div class="paper">
    <div class="page-body">
      
      <div class="doc-title-box">
        <div class="doc-title-main">SURAT PERNYATAAN TANGGUNG JAWAB MUTLAK (SPTJM)</div>
        <div class="doc-title-sub">Pakta Integritas Pemanfaatan Bantuan Modal Wirausaha Pemuda Pemula (WMP)</div>
      </div>

      <p class="no-indent">Yang bertanda tangan di bawah ini:</p>
      
      <table class="meta-table" style="margin-left: 10px; margin-bottom: 12px;">
        <tr>
          <td class="col-label">Nama Lengkap</td>
          <td class="col-colon">:</td>
          <td><strong contenteditable="true">MUH ARSYAD RAMSI</strong></td>
        </tr>
        <tr>
          <td class="col-label">Jabatan</td>
          <td class="col-colon">:</td>
          <td>Founder & Direktur Utama PT Skillance Digital Indonesia</td>
        </tr>
        <tr>
          <td class="col-label">Nama Badan Usaha</td>
          <td class="col-colon">:</td>
          <td><strong>PT SKILLANCE DIGITAL INDONESIA</strong></td>
        </tr>
        <tr>
          <td class="col-label">Nomor Induk Berusaha</td>
          <td class="col-colon">:</td>
          <td>Terdaftar Resmi OSS BKPM RI</td>
        </tr>
        <tr>
          <td class="col-label">Alamat Domisili</td>
          <td class="col-colon">:</td>
          <td>Desa Pabiring Dusun Taruseng, Kec. Poleang Barat, Kab. Bombana, Sultra</td>
        </tr>
      </table>

      <p class="no-indent">Dengan ini menyatakan dengan sesungguhnya dan berani bertanggung jawab secara hukum bahwa:</p>
      
      <ol style="margin: 4px 0 0 20px; padding: 0; font-size: 9.8pt; line-height: 1.45;">
        <li>Seluruh data, informasi profil perusahaan, legalitas perizinan, dan dokumen portofolio yang terlampir dalam proposal ini adalah <strong>benar, sah, dan dapat dipertanggungjawabkan</strong> keasliannya.</li>
        <li>Bantuan dana hibah yang dimohonkan sebesar <strong class="target-total-rab-text">Rp 18.000.000,-</strong> akan dipergunakan <strong>100% secara tepat guna</strong> sesuai Rencana Anggaran Biaya (RAB) yang disetujui untuk pengembangan alat produksi akrilik dan infrastruktur IT.</li>
        <li>Kami bersedia menyampaikan Laporan Pertanggungjawaban (LPJ) pemanfaatan dana beserta bukti pembelanjaan fisik yang sah secara berkala sesuai ketentuan petunjuk teknis.</li>
        <li>Apabila di kemudian hari terbukti terjadi penyalahgunaan bantuan atau manipulasi data, kami bersedia dituntut di hadapan hukum dan siap mengembalikan seluruh dana bantuan tersebut ke Kas Negara.</li>
      </ol>

      <h3 class="section-heading" style="margin-top: 14px;">Daftar Lampiran Berkas Legalitas & Pendukung</h3>
      <table class="data-table" style="font-size: 9pt; margin-bottom: 14px;">
        <thead>
          <tr>
            <th style="width: 8%;">No</th>
            <th style="width: 62%;">Dokumen Kelengkapan Pengajuan</th>
            <th style="width: 30%;">Status Verifikasi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="text-align: center;">1</td>
            <td>Salinan SK Badan Hukum Kemenkumham RI (AHU-A138609.AH.01.30.Tahun 2026)</td>
            <td style="color: #0d2e5c; font-weight: 700;"><i class="fa-solid fa-check text-success me-1"></i>Lengkap & Terlampir</td>
          </tr>
          <tr>
            <td style="text-align: center;">2</td>
            <td>Salinan Nomor Pokok Wajib Pajak (NPWP Badan Usaha 100000011940526)</td>
            <td style="color: #0d2e5c; font-weight: 700;"><i class="fa-solid fa-check text-success me-1"></i>Lengkap & Terlampir</td>
          </tr>
          <tr>
            <td style="text-align: center;">3</td>
            <td>Salinan Nomor Induk Berusaha (NIB OSS BKPM Sektor IT & Percetakan)</td>
            <td style="color: #0d2e5c; font-weight: 700;"><i class="fa-solid fa-check text-success me-1"></i>Lengkap & Terlampir</td>
          </tr>
          <tr>
            <td style="text-align: center;">4</td>
            <td>Salinan KTP Pemohon & Kartu Keluarga Mandiri Direktur Utama</td>
            <td style="color: #0d2e5c; font-weight: 700;"><i class="fa-solid fa-check text-success me-1"></i>Lengkap & Terlampir</td>
          </tr>
          <tr>
            <td style="text-align: center;">5</td>
            <td>Buku Tabungan / Rekening Koran Resmi Bank Atas Nama Perusahaan</td>
            <td style="color: #0d2e5c; font-weight: 700;"><i class="fa-solid fa-check text-success me-1"></i>Lengkap & Terlampir</td>
          </tr>
          <tr>
            <td style="text-align: center;">6</td>
            <td>Dokumentasi Foto Toko Aquiris & Tampilan Sistem Website Skillance</td>
            <td style="color: #0d2e5c; font-weight: 700;"><i class="fa-solid fa-check text-success me-1"></i>Lengkap & Terlampir</td>
          </tr>
        </tbody>
      </table>

      <!-- TANDA TANGAN BERMETERAI -->
      <div style="display: flex; justify-content: flex-end; margin-top: 10px;">
        <div style="width: 250px; text-align: center;">
          <div style="font-size: 9.5pt;" contenteditable="true">Bombana, <span class="target-date-text">16 November 2026</span></div>
          <div style="font-size: 9pt; font-weight: 700; color: #0d2e5c; margin-top: 2px;">Yang Menyatakan,</div>
          
          <div style="height: 75px; position: relative; display: flex; align-items: center; justify-content: center;">
            <div style="border: 1px dashed #94a3b8; width: 90px; height: 45px; display: flex; align-items: center; justify-content: center; font-size: 7.5pt; color: #94a3b8; font-family: 'Inter', sans-serif;">
              Meterai Rp 10.000
            </div>
          </div>

          <div class="ttd-name" contenteditable="true">MUH ARSYAD RAMSI</div>
          <div class="ttd-role">Direktur Utama &bull; NIK Terdaftar</div>
        </div>
      </div>

    </div>

    <div class="page-footer-note">
      <span>PT SKILLANCE DIGITAL INDONESIA &bull; Proposal Bantuan Wirausaha Pemuda 2026</span>
      <span>Halaman 6 dari 6</span>
    </div>
  </div>

  <script>
    function syncParams() {
      const agency = document.getElementById('targetAgencyInput').value || 'Kemenpora RI / Dinas Pemuda dan Olahraga';
      const dateVal = document.getElementById('targetDateInput').value || '16 November 2026';
      const rabVal = document.getElementById('targetTotalRabInput').value || 'Rp 18.000.000,-';

      document.querySelectorAll('.target-agency-text').forEach(el => el.textContent = agency);
      document.querySelectorAll('.target-date-text').forEach(el => el.textContent = dateVal);
      document.querySelectorAll('.target-total-rab-text').forEach(el => el.textContent = rabVal);
    }
  </script>
</body>
</html>