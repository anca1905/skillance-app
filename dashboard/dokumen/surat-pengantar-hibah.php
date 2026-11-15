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
  <title>Surat Pengantar Pengajuan Hibah Wirausaha Pemuda - PT Skillance Digital Indonesia</title>
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@700;800&family=Lora:ital,wght@0,400;0,600;1,400&display=swap" rel="stylesheet">
  
  <style>
    @page {
      size: A4 portrait;
      margin: 12mm 16mm 12mm 16mm;
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
        max-width: 100% !important;
        min-height: auto !important;
      }
    }

    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Times New Roman', Times, serif;
      font-size: 11pt;
      line-height: 1.45;
      color: #111827;
      background: #f1f4f8;
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

    /* A4 Paper Sheets */
    .paper {
      background: #fff;
      max-width: 210mm;
      min-height: 297mm;
      margin: 0 auto 26px auto;
      padding: 18mm 20mm 16mm 20mm;
      box-shadow: 0 4px 20px rgba(0,0,0,0.08);
      position: relative;
    }

    /* Standard Kop Surat */
    .kop-surat {
      border-bottom: 3px double #0d2e5c;
      padding-bottom: 8px;
      margin-bottom: 16px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 14px;
    }
    .kop-logo {
      width: 72px;
      height: 72px;
      object-fit: contain;
      flex-shrink: 0;
    }
    .kop-spacer {
      width: 72px;
      flex-shrink: 0;
    }
    .kop-text {
      text-align: center;
      flex: 1;
    }
    .kop-title-main {
      margin: 0 0 1px 0;
      font-size: 15pt;
      font-weight: 800;
      color: #0d2e5c;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-family: 'Poppins', Arial, sans-serif;
    }
    .kop-sub {
      margin: 0 0 2px 0;
      font-size: 8.2pt;
      font-weight: 700;
      color: #d97706;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      font-family: Arial, sans-serif;
    }
    .kop-text p.meta {
      margin: 1px 0;
      font-size: 7.5pt;
      font-family: 'Inter', Arial, sans-serif;
      color: #374151;
      line-height: 1.35;
    }

    .meta-table {
      width: 100%;
      margin-bottom: 14px;
      font-size: 10.5pt;
    }
    .meta-table td {
      vertical-align: top;
      padding: 2px 0;
    }
    .meta-table td.col-label {
      width: 95px;
      font-weight: 600;
    }
    .meta-table td.col-colon {
      width: 15px;
      text-align: center;
    }

    p {
      text-align: justify;
      margin-top: 0;
      margin-bottom: 9px;
      text-indent: 30px;
      font-size: 10.5pt;
      line-height: 1.45;
    }
    p.no-indent {
      text-indent: 0;
    }

    .highlight-box {
      background: #f8fafc;
      border: 1px solid #e2e8f0;
      border-left: 4px solid #0d2e5c;
      padding: 10px 14px;
      margin: 10px 0 14px 0;
      font-family: 'Inter', Arial, sans-serif;
      font-size: 9.5pt;
      border-radius: 4px;
    }

    /* Signature Area */
    .sig-row {
      display: flex;
      justify-content: flex-end;
      margin-top: 25px;
      page-break-inside: avoid;
    }
    .sig-box {
      width: 250px;
      text-align: center;
    }
    .ttd-space {
      height: 75px;
    }
    .ttd-name {
      font-weight: bold;
      text-decoration: underline;
      font-size: 11pt;
      margin-bottom: 2px;
    }
    .ttd-role {
      font-size: 9.5pt;
      color: #374151;
      margin: 0;
    }

    /* Ekspedisi / Tanda Terima */
    .receipt-slip {
      margin-top: 35px;
      border-top: 2px dashed #94a3b8;
      padding-top: 14px;
      font-family: 'Inter', Arial, sans-serif;
      font-size: 8.8pt;
      page-break-inside: avoid;
    }
    .receipt-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 8px;
    }
    .receipt-title {
      font-weight: 800;
      color: #0d2e5c;
      text-transform: uppercase;
      font-size: 9pt;
      letter-spacing: 0.5px;
    }
    .receipt-table {
      width: 100%;
      border-collapse: collapse;
    }
    .receipt-table td {
      border: 1px solid #cbd5e1;
      padding: 5px 8px;
      font-size: 8.5pt;
    }
    .receipt-table td.header-col {
      background: #f8fafc;
      font-weight: 600;
      width: 140px;
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
      <span class="badge-doc">Surat Pengantar Permohonan Hibah</span>
    </div>
    <div class="toolbar-right">
      <a href="proposal-hibah-wirausaha.php" target="_blank" class="btn-nav-tool">
        <i class="fa-solid fa-file-invoice"></i> Buka Proposal Hibah (6 Hal) &raquo;
      </a>
      <button class="btn-print-main" onclick="window.print()">
        <i class="fa-solid fa-print"></i> Cetak Dokumen (A4)
      </button>
    </div>
  </div>

  <div class="paper">
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
        <td style="text-align: right;" contenteditable="true">Bombana, 16 November 2026</td>
      </tr>
      <tr>
        <td class="col-label">Lampiran</td>
        <td class="col-colon">:</td>
        <td contenteditable="true">1 (Satu) Berkas Proposal Usaha & Rencana Anggaran Biaya (RAB)</td>
        <td></td>
      </tr>
      <tr>
        <td class="col-label">Sifat</td>
        <td class="col-colon">:</td>
        <td><strong contenteditable="true">Penting / Resmi</strong></td>
        <td></td>
      </tr>
      <tr>
        <td class="col-label">Perihal</td>
        <td class="col-colon">:</td>
        <td><strong contenteditable="true">Permohonan Bantuan Dana Hibah Modal Wirausaha Pemuda (WMP)</strong></td>
        <td></td>
      </tr>
    </table>

    <!-- TUJUAN SURAT -->
    <div style="margin-bottom: 14px; font-size: 10.5pt; line-height: 1.45;">
      Kepada Yth.<br>
      <strong contenteditable="true">Kepala Dinas Pemuda dan Olahraga / Dinas Koperasi dan UKM</strong><br>
      <span contenteditable="true">Up. Bidang Pemberdayaan Pemuda & Kewirausahaan</span><br>
      di -<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span contenteditable="true">Tempat</span>
    </div>

    <p class="no-indent">Dengan hormat,</p>
    
    <p>
      Dalam rangka penguatan kapasitas daya saing ekonomi generasi muda dan implementasi program kewirausahaan pemuda di daerah, bersama surat ini kami dari <strong>PT SKILLANCE DIGITAL INDONESIA</strong> bermaksud mengajukan proposal permohonan bantuan dana hibah pengembangan usaha pemula (Wirausaha Pemuda Pemula / WMP) Tahun Anggaran 2026.
    </p>

    <p>
      PT SKILLANCE DIGITAL INDONESIA merupakan badan usaha resmi berbadan hukum Kemenkumham RI yang didirikan dan dikelola sepenuhnya oleh talenta muda lokal di Kabupaten Bombana. Fokus kegiatan usaha kami mengintegrasikan <strong>Sentra Produksi Cinderamata & Plakat Akrilik (Aquiris)</strong> dengan <strong>Pengembangan Sistem Informasi & Digitalisasi Layanan Sekolah/Dinas (Software House)</strong>, serta aktif membuka ruang praktik kerja/magang bagi siswa vokasi SMK setempat.
    </p>

    <div class="highlight-box">
      <strong>Rincian Permohonan Bantuan Modal Kerja:</strong>
      <table style="width: 100%; border: none; margin-top: 4px; font-size: 9pt;">
        <tr>
          <td style="width: 170px; font-weight: 600;">Total Usulan Anggaran</td>
          <td style="width: 10px;">:</td>
          <td><strong style="color: #0d2e5c; font-size: 10pt;">Rp 18.000.000,- (Delapan Belas Juta Rupiah)</strong></td>
        </tr>
        <tr>
          <td style="font-weight: 600;">Peruntukan Pengadaan</td>
          <td>:</td>
          <td>Mesin UV Flatbed & Pemotong Akrilik Presisi, Upgrade Server Cloud, dan Bahan Baku Cetak</td>
        </tr>
        <tr>
          <td style="font-weight: 600;">Penyerapan Tenaga Kerja</td>
          <td>:</td>
          <td>Pemberdayaan 8–10 Pemuda Daerah (Teknisi, Jurnalis Muda, & Siswa Magang SMK)</td>
        </tr>
      </table>
    </div>

    <p>
      Bersama surat ini, kami lampirkan 1 (satu) berkas proposal lengkap yang memuat profil perusahaan, analisis pasar, proyeksi keuangan, Rencana Anggaran Biaya (RAB), Pakta Integritas SPTJM, serta salinan legalitas izin usaha resmi.
    </p>

    <p>
      Besar harapan kami kiranya permohonan ini dapat dipertimbangkan dan diverifikasi untuk memperoleh alokasi program bantuan wirausaha pemuda tahun ini. Atas perhatian, bimbingan, dan perkenan Bapak/Ibu, kami ucapkan terima kasih.
    </p>

    <!-- TANDA TANGAN -->
    <div class="sig-row">
      <div class="sig-box">
        <div style="font-size: 10pt;" contenteditable="true">Bombana, 16 November 2026</div>
        <div style="font-size: 9.5pt; font-weight: 700; color: #0d2e5c; margin-top: 2px;">PT SKILLANCE DIGITAL INDONESIA</div>
        <div class="ttd-space"></div>
        <div class="ttd-name" contenteditable="true">MUH ARSYAD RAMSI</div>
        <div class="ttd-role">Founder & Direktur Utama</div>
      </div>
    </div>

    <!-- EKSPEDISI / TANDA TERIMA PETUGAS TU -->
    <div class="receipt-slip">
      <div class="receipt-header">
        <div class="receipt-title"><i class="fa-solid fa-receipt me-1"></i>BUKTI TANDA TERIMA BERKAS PROPOSAL (LEMBAR EKSPEDISI RESMI)</div>
        <div style="font-size: 7.5pt; color: #64748b;">Arsip No: 038/EXT-GR/SDI/XI/2026</div>
      </div>
      <table class="receipt-table">
        <tr>
          <td class="header-col">Instansi Penerima</td>
          <td contenteditable="true">Dinas Pemuda dan Olahraga / Dinas Koperasi dan UKM</td>
          <td class="header-col">Tanggal Penerimaan</td>
          <td contenteditable="true">..... / .................... / 2026</td>
        </tr>
        <tr>
          <td class="header-col">Nama Penerima (TU)</td>
          <td contenteditable="true">............................................................</td>
          <td class="header-col">Nomor Kontak / WA</td>
          <td contenteditable="true">............................................................</td>
        </tr>
        <tr>
          <td class="header-col">Paraf & Cap Stempel TU</td>
          <td colspan="3" style="height: 48px; vertical-align: middle; color: #94a3b8; font-style: italic; text-align: center;">
            ( Tempat Paraf Petugas Front Office / TU & Cap Basah Instansi Penerima )
          </td>
        </tr>
      </table>
    </div>

  </div>

</body>
</html>