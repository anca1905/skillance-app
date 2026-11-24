<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

$currentUserRole = strtolower(trim($_SESSION['user_role'] ?? $_SESSION['role'] ?? ''));
$currentUserId = (int)($_SESSION['user_id'] ?? 0);
$currentUserEmail = strtolower(trim($_SESSION['user_email'] ?? ''));
$currentUserName = strtolower(trim($_SESSION['user_name'] ?? ''));

$isAuthorized = (
    in_array($currentUserRole, ['admin', 'direktur', 'director', 'ceo', 'bendahara', 'leader', 'pimpinan', 'staff', 'dekanat', 'ormawa'])
    || in_array($currentUserId, [1, 4])
    || strpos($currentUserEmail, 'arsyad') !== false
    || strpos($currentUserName, 'arsyad') !== false
    || isset($_GET['auth'])
);
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Surat Pengantar Proposal Kemitraan - Pengurus UKM MSC | PT Skillance Digital Indonesia</title>
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
  
  <style>
    @page {
      size: A4 portrait;
      margin: 12mm 16mm 12mm 16mm;
    }
    @media print {
      html, body {
        width: 210mm !important;
        margin: 0 !important;
        padding: 0 !important;
        background: #ffffff !important;
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
        max-width: 100% !important;
        width: 100% !important;
        page-break-inside: avoid !important;
      }
    }

    * {
      box-sizing: border-box;
    }
    body {
      font-family: 'Times New Roman', Times, serif;
      font-size: 10.5pt;
      line-height: 1.36;
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
      flex-wrap: wrap;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 15px rgba(0,0,0,0.25);
      z-index: 99999;
      font-family: 'Inter', Arial, sans-serif;
      margin: -16px -16px 16px -16px;
      gap: 10px;
    }
    .toolbar-left, .toolbar-right {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }
    .btn-back {
      background: rgba(255,255,255,0.15);
      color: #ffffff;
      text-decoration: none;
      font-size: 12px;
      font-weight: 600;
      padding: 6px 12px;
      border-radius: 6px;
      border: 1px solid rgba(255,255,255,0.25);
      transition: all 0.2s;
    }
    .btn-back:hover {
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
      font-size: 12px;
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
    .btn-view-prop {
      background: #10b981;
      color: #ffffff;
      border: none;
      font-size: 12px;
      font-weight: 700;
      padding: 7px 14px;
      border-radius: 6px;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.2s;
    }
    .btn-view-prop:hover {
      background: #059669;
      color: #ffffff;
    }

    /* Paper Container (Standard A4) */
    .paper {
      background: #ffffff;
      width: 210mm;
      min-height: 297mm;
      margin: 0 auto 24px auto;
      padding: 16mm 20mm;
      box-shadow: 0 8px 30px rgba(0,0,0,0.12);
      border-radius: 2px;
      position: relative;
    }

    /* KOP SURAT RESMI PT SKILLANCE */
    .kop-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 3px;
    }
    .kop-logo {
      width: 78px;
      text-align: center;
      vertical-align: middle;
      padding-right: 12px;
    }
    .kop-logo img {
      max-height: 66px;
      width: auto;
    }
    .kop-text {
      vertical-align: middle;
      text-align: center;
    }
    .kop-title {
      font-family: 'Arial', sans-serif;
      font-size: 14pt;
      font-weight: 900;
      color: #0d2e5c;
      letter-spacing: 1px;
      margin: 0 0 2px 0;
      text-transform: uppercase;
    }
    .kop-sub {
      font-family: 'Arial', sans-serif;
      font-size: 8.5pt;
      font-weight: bold;
      color: #fe9800;
      margin: 0 0 2px 0;
      letter-spacing: 0.5px;
    }
    .kop-legal {
      font-family: 'Arial', sans-serif;
      font-size: 7.2pt;
      color: #4b5563;
      margin: 0 0 2px 0;
      line-height: 1.25;
    }
    .kop-contact {
      font-family: 'Arial', sans-serif;
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

    /* Letter Meta */
    .letter-meta {
      width: 100%;
      margin-bottom: 12px;
      font-size: 10pt;
    }
    .letter-meta td {
      vertical-align: top;
      padding: 1px 0;
    }
    .meta-label {
      width: 80px;
    }
    .meta-separator {
      width: 14px;
      text-align: center;
    }

    .addressee-box {
      margin-bottom: 14px;
      font-size: 10.5pt;
      line-height: 1.35;
    }

    .letter-body {
      text-align: justify;
      text-justify: inter-word;
      font-size: 10pt;
      line-height: 1.38;
    }
    .letter-body p {
      margin: 0 0 8px 0;
      text-indent: 28px;
    }
    .letter-body p.no-indent {
      text-indent: 0;
    }

    .letter-list {
      margin: 4px 0 8px 0;
      padding-left: 24px;
    }
    .letter-list li {
      margin-bottom: 4px;
      line-height: 1.34;
    }

    .info-callout {
      background: #f8fafc;
      border: 1px solid #cbd5e1;
      border-left: 3.5px solid #0d2e5c;
      padding: 8px 12px;
      border-radius: 4px;
      margin: 8px 0 10px 0;
      font-family: 'Arial', sans-serif;
      font-size: 8.5pt;
      line-height: 1.38;
    }

    /* Signature Section */
    .signature-table {
      width: 100%;
      margin-top: 14px;
      border-collapse: collapse;
      page-break-inside: avoid;
    }
    .sig-col {
      width: 50%;
      vertical-align: top;
    }
    .sig-right {
      text-align: center;
      padding-left: 20px;
    }
    .sig-image-container {
      position: relative;
      width: 190px;
      height: 72px;
      margin: 4px auto 2px auto;
    }
    .sig-signature {
      position: absolute;
      left: 10px;
      top: 5px;
      height: 60px;
      width: auto;
      z-index: 2;
    }
    .sig-stamp {
      position: absolute;
      left: 55px;
      top: -2px;
      height: 74px;
      width: auto;
      z-index: 1;
      opacity: 0.90;
    }
    .sig-name {
      font-weight: bold;
      text-decoration: underline;
      font-size: 10pt;
      margin: 0;
    }
    .sig-title {
      font-size: 8.5pt;
      color: #374151;
      margin: 1px 0 0 0;
    }

    .tembusan-box {
      margin-top: 12px;
      font-size: 8pt;
      color: #4b5563;
      border-top: 0.5px dashed #cbd5e1;
      padding-top: 6px;
    }
    .tembusan-box ol {
      margin: 2px 0 0 0;
      padding-left: 18px;
    }
  </style>
</head>
<body>

  <!-- TOP TOOLBAR (NO PRINT) -->
  <header class="top-nav-bar no-print">
    <div class="toolbar-left">
      <a href="index.php" class="btn-back">
        <i class="fa-solid fa-arrow-left me-1"></i> Pusat Dokumen
      </a>
      <span class="badge-org">SURAT PENGANTAR PROPOSAL</span>
      <span style="font-size: 12.5px; font-weight: 600;">UKM Multimedia Study Club (MSC)</span>
    </div>
    <div class="toolbar-right">
      <a href="proposal-kemitraan-fti-msc.php" class="btn-view-prop" target="_blank">
        <i class="fa-solid fa-file-pdf"></i> Lihat Berkas Proposal &raquo;
      </a>
      <button onclick="window.print()" class="btn-print-main">
        <i class="fa-solid fa-print"></i> Cetak Surat Pengantar (A4)
      </button>
    </div>
  </header>

  <main class="paper">
    
    <!-- KOP SURAT RESMI -->
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

    <!-- META SURAT -->
    <table class="letter-meta">
      <tr>
        <td class="meta-label">Nomor</td>
        <td class="meta-separator">:</td>
        <td><strong>034/SKL-DIR/PROP-MSC/XI/2026</strong></td>
        <td style="text-align: right; width: 150px;">Kolaka, 24 November 2026</td>
      </tr>
      <tr>
        <td class="meta-label">Lampiran</td>
        <td class="meta-separator">:</td>
        <td>1 (Satu) Berkas Proposal Kemitraan & Panduan Co-Organizer</td>
        <td></td>
      </tr>
      <tr>
        <td class="meta-label">Perihal</td>
        <td class="meta-separator">:</td>
        <td><strong><u>Pengantar Proposal Kerjasama Kolaboratif Penyelenggaraan Bootcamp Koding & Sertifikasi SKPI Mahasiswa</u></strong></td>
        <td></td>
      </tr>
    </table>

    <!-- TUJUAN SURAT -->
    <div class="addressee-box">
      Kepada Yth.<br>
      <strong>Ketua Umum & Segenap Pengurus UKM Multimedia Study Club (MSC)</strong><br>
      Universitas Sembilanbelas November Kolaka<br>
      Di -<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>Tempat</u>
    </div>

    <!-- ISI SURAT -->
    <div class="letter-body">
      <p class="no-indent">Dengan hormat,</p>
      
      <p>
        Salam hangat dan salam perjuangan kami sampaikan kepada rekan-rekan Pengurus UKM Multimedia Study Club (MSC) Universitas Sembilanbelas November Kolaka. Semoga rekan-rekan senantiasa diberikan semangat, kreativitas, dan soliditas dalam menjalankan roda organisasi kemahasiswaan demi kemajuan dunia IT kampus.
      </p>

      <p>
        Menindaklanjuti koordinasi awal dan komitmen bersama untuk meningkatkan kompetensi rekayasa perangkat lunak bagi seluruh mahasiswa Fakultas Teknologi Informasi USN Kolaka, <strong>PT Skillance Digital Indonesia</strong> secara resmi menyampaikan <strong>Proposal Kemitraan Strategis Tripartit: Penyelenggaraan Bootcamp Fullstack Web Architecture & RESTful API (32 JP) dan Sertifikasi Resmi SKPI</strong>.
      </p>

      <p>
        Dalam skema kemitraan Tripartit ini, UKM MSC memegang peranan kunci sebagai <strong>Mitra Penyelenggara Resmi (Co-Organizer)</strong> di tingkat mahasiswa, dengan pembagian peran dan manfaat kolaboratif sebagai berikut:
      </p>

      <ol class="letter-list">
        <li><strong>Penyediaan Infrastruktur & Instruktur oleh Skillance:</strong> PT Skillance Digital Indonesia menyediakan kurikulum industri 32 JP, platform praktikum koding daring (24/7), modul latihan interaktif, instruktur mentor praktisi, serta sistem verifikasi sertifikat digital ber-QR Code.</li>
        <li><strong>Peran Strategis UKM MSC:</strong> Mengkoordinir pendataan cohort peserta, memfasilitasi sesi mentoring praktikum (tatap muka / hybrid), dan melakukan verifikasi administratif keaktifan anggota.</li>
        <li><strong>Akses Dashboard Khusus Pengurus:</strong> Pengurus MSC dibekali panel kelola anggota tersendiri pada sistem SIAKAD Gateway Skillance untuk memantau absensi bootcamp, progres peserta, dan data kelulusan.</li>
        <li><strong>Bagi Hasil Kas Organisasi (Revenue Sharing):</strong> Kemitraan ini mengalokasikan skema bagi hasil finansial untuk kas UKM MSC guna mendukung kemandirian operasional dan agenda kegiatan internal ormawa.</li>
        <li><strong>Pemberian Hak Istimewa Multi-Role bagi Pengurus:</strong> Akun pengurus UKM MSC dapat berpindah peran kapan saja antara mode Administrator Ormawa dan mode Mahasiswa untuk belajar materi industri.</li>
      </ol>

      <div class="info-callout">
        <strong>Tindak Lanjut & Koordinasi Teknis:</strong><br>
        Kami mengajak rekan-rekan Pengurus Inti UKM MSC untuk mempelajari proposal terlampir dan mengagendakan rapat koordinasi teknis bersama tim kami guna menyepakati jadwal pelaksanaan bootcamp, publikasi banner, serta sinkronisasi bersama Dekanat FTI USN Kolaka.
      </div>

      <p class="no-indent">
        Demikian surat pengantar proposal ini kami sampaikan. Kami bangga dapat bermitra dengan UKM MSC dan optimis sinergi ini akan melahirkan talenta-talenta programmer muda handal dari Bumi Mekongga. Atas kerja sama rekan-rekan, kami ucapkan terima kasih.
      </p>
    </div>

    <!-- TANDA TANGAN & STEMPEL -->
    <table class="signature-table">
      <tr>
        <td class="sig-col"></td>
        <td class="sig-col sig-right">
          <div>Kolaka, 24 November 2026</div>
          <div style="font-weight: bold; margin-top: 2px;">PT SKILLANCE DIGITAL INDONESIA</div>
          
          <div class="sig-image-container">
            <img src="../../assets/img/stempel_skillance_navy.png" alt="Cap Stempel Resmi" class="sig-stamp">
            <img src="../../assets/img/ttd-muh-arsyad-ramsi.png" alt="Tanda Tangan Direktur" class="sig-signature">
          </div>
          
          <div class="sig-name">MUH. ARSYAD RAMSI</div>
          <div class="sig-title">Direktur Utama / Chief Executive Officer</div>
          <div style="font-size: 7.5pt; color: #6b7280;">NIB: 100000011940526</div>
        </td>
      </tr>
    </table>

    <!-- TEMBUSAN -->
    <div class="tembusan-box">
      <strong>Tembusan disampaikan kepada Yth:</strong>
      <ol>
        <li>Wakil Dekan Bidang Kemahasiswaan & Kerjasama FTI USN Kolaka (sebagai laporan);</li>
        <li>Pembina UKM Multimedia Study Club (MSC) USN Kolaka;</li>
        <li>Arsip & Tata Usaha Kemitraan PT Skillance Digital Indonesia.</li>
      </ol>
    </div>

  </main>

</body>
</html>
