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
  <title>Proposal Kemitraan Strategis Tripartit - FTI USN Kolaka x UKM MSC x PT Skillance</title>
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Poppins:wght@600;700;800;900&display=swap" rel="stylesheet">
  
  <style>
    @page {
      size: A4 portrait;
      margin: 10mm 14mm 10mm 14mm;
    }
    @page :first {
      margin: 0;
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
        padding: 12mm 16mm !important;
        width: 100% !important;
        max-width: 100% !important;
        page-break-after: always !important;
        page-break-inside: avoid !important;
      }
      .paper.cover-page {
        width: 210mm !important;
        height: 297mm !important;
        max-height: 297mm !important;
        padding: 0 !important;
        margin: 0 !important;
        overflow: hidden !important;
        page-break-after: always !important;
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
      line-height: 1.40;
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

    /* A4 Paper Sheets */
    .paper {
      background: #ffffff;
      width: 210mm;
      min-height: 297mm;
      margin: 0 auto 24px auto;
      padding: 16mm 20mm;
      box-shadow: 0 8px 30px rgba(0,0,0,0.12);
      border-radius: 2px;
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    /* Cover Page Styling */
    .paper.cover-page {
      padding: 0 !important;
      overflow: hidden;
      background: #ffffff;
      border: 1px solid #cbd5e1;
      display: block;
    }
    .cover-inner {
      height: 297mm;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 30px 40px;
      border: 10px solid #0d2e5c;
      outline: 2.5px solid #fe9800;
      outline-offset: -16px;
      background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
      position: relative;
    }

    .cover-header-logos {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 24px;
      margin-top: 15px;
      padding-bottom: 20px;
      border-bottom: 1.5px solid #e2e8f0;
    }
    .cover-header-logos img {
      max-height: 60px;
      width: auto;
      object-fit: contain;
    }

    .cover-center-content {
      text-align: center;
      margin: auto 0;
    }
    .cover-badge {
      display: inline-block;
      background: #0d2e5c;
      color: #fe9800;
      font-family: 'Inter', sans-serif;
      font-size: 9pt;
      font-weight: 800;
      letter-spacing: 1px;
      padding: 6px 16px;
      border-radius: 50rem;
      text-transform: uppercase;
      margin-bottom: 16px;
    }
    .cover-title {
      font-family: 'Poppins', sans-serif;
      font-size: 21pt;
      font-weight: 900;
      color: #0d2e5c;
      line-height: 1.25;
      margin: 0 0 12px 0;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }
    .cover-subtitle {
      font-family: 'Inter', sans-serif;
      font-size: 11pt;
      font-weight: 700;
      color: #b45309;
      line-height: 1.45;
      margin: 0 auto 16px auto;
      max-width: 580px;
    }
    .cover-desc {
      font-family: 'Times New Roman', serif;
      font-size: 11pt;
      color: #374151;
      font-style: italic;
      line-height: 1.4;
      max-width: 540px;
      margin: 0 auto;
    }

    .cover-meta-box {
      background: #f1f5f9;
      border: 1.5px solid #cbd5e1;
      border-radius: 12px;
      padding: 16px 20px;
      margin: 20px auto 0 auto;
      max-width: 540px;
      text-align: left;
      font-family: 'Inter', sans-serif;
      font-size: 8.5pt;
      line-height: 1.5;
    }
    .cover-meta-box table {
      width: 100%;
      border-collapse: collapse;
    }
    .cover-meta-box td {
      padding: 2px 4px;
      vertical-align: top;
    }

    .cover-footer-text {
      text-align: center;
      font-family: 'Inter', sans-serif;
      font-size: 8.5pt;
      color: #4b5563;
      border-top: 1.5px solid #e2e8f0;
      padding-top: 15px;
    }

    /* KOP SURAT STANDAR (HALAMAN 2 dst) */
    .kop-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 2px;
    }
    .kop-logo {
      width: 68px;
      text-align: center;
      vertical-align: middle;
      padding-right: 10px;
    }
    .kop-logo img {
      max-height: 54px;
      width: auto;
    }
    .kop-text {
      vertical-align: middle;
      text-align: center;
    }
    .kop-title {
      font-family: 'Arial', sans-serif;
      font-size: 12pt;
      font-weight: 900;
      color: #0d2e5c;
      letter-spacing: 0.8px;
      margin: 0 0 1px 0;
      text-transform: uppercase;
    }
    .kop-sub {
      font-family: 'Arial', sans-serif;
      font-size: 7.8pt;
      font-weight: bold;
      color: #fe9800;
      margin: 0 0 1px 0;
    }
    .kop-legal {
      font-family: 'Arial', sans-serif;
      font-size: 6.8pt;
      color: #4b5563;
      margin: 0;
      line-height: 1.2;
    }
    .kop-line {
      border: 0;
      border-top: 2px solid #0d2e5c;
      border-bottom: 0.8px solid #fe9800;
      height: 3.5px;
      margin: 3px 0 10px 0;
    }

    /* Content Typography */
    .page-body {
      flex: 1;
    }
    .section-title {
      font-family: 'Arial', sans-serif;
      font-size: 11pt;
      font-weight: bold;
      color: #0d2e5c;
      border-bottom: 1.5px solid #cbd5e1;
      padding-bottom: 3px;
      margin: 12px 0 8px 0;
      text-transform: uppercase;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    .section-title i {
      color: #fe9800;
      font-size: 10pt;
    }
    .p-body {
      text-align: justify;
      text-justify: inter-word;
      font-size: 10pt;
      line-height: 1.38;
      margin: 0 0 7px 0;
      text-indent: 26px;
    }
    .p-body.no-indent {
      text-indent: 0;
    }

    /* Tables */
    .content-table {
      width: 100%;
      border-collapse: collapse;
      font-size: 8.8pt;
      margin: 8px 0 10px 0;
      line-height: 1.3;
    }
    .content-table th, .content-table td {
      border: 1px solid #cbd5e1;
      padding: 6px 8px;
      vertical-align: top;
    }
    .content-table th {
      background: #0d2e5c;
      color: #ffffff;
      font-family: 'Arial', sans-serif;
      font-weight: bold;
      text-align: center;
    }
    .content-table tr:nth-child(even) td {
      background: #f8fafc;
    }

    /* Feature / Highlight Box */
    .callout-card {
      background: #f8fafc;
      border: 1px solid #cbd5e1;
      border-left: 3.5px solid #0d2e5c;
      border-radius: 4px;
      padding: 8px 12px;
      margin: 8px 0;
      font-size: 9pt;
      line-height: 1.35;
    }

    /* Ordered & Unordered Lists */
    .list-styled {
      margin: 4px 0 8px 0;
      padding-left: 20px;
      font-size: 9.8pt;
      line-height: 1.36;
    }
    .list-styled li {
      margin-bottom: 3px;
    }

    /* Page Footer (Pagination) */
    .page-footer {
      border-top: 0.8px solid #cbd5e1;
      padding-top: 4px;
      margin-top: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-family: 'Inter', sans-serif;
      font-size: 7.5pt;
      color: #64748b;
    }
  </style>
</head>
<body>

  <!-- TOP STICKY TOOLBAR (NO PRINT) -->
  <header class="top-nav-bar no-print">
    <div class="toolbar-left">
      <a href="index.php" class="btn-nav-tool">
        <i class="fa-solid fa-arrow-left"></i> Pusat Dokumen
      </a>
      <span class="badge-org">PROPOSAL KEMITRAAN DUDI</span>
      <span style="font-size: 12px; font-weight: 600;">FTI USN Kolaka &times; UKM MSC &times; PT Skillance</span>
    </div>
    <div class="toolbar-right">
      <a href="surat-pengantar-fakultas-proposal.php" class="btn-nav-tool" target="_blank">
        <i class="fa-solid fa-envelope-open-text text-warning"></i> Surat Pengantar Dekanat
      </a>
      <a href="surat-pengantar-msc-proposal.php" class="btn-nav-tool" target="_blank">
        <i class="fa-solid fa-envelope-open-text text-warning"></i> Surat Pengantar MSC
      </a>
      <button onclick="window.print()" class="btn-print-main">
        <i class="fa-solid fa-print"></i> Cetak Dokumen Proposal (A4)
      </button>
    </div>
  </header>

  <!-- ========================================================================= -->
  <!-- HALAMAN 1: COVER PAGE                                                    -->
  <!-- ========================================================================= -->
  <div class="paper cover-page">
    <div class="cover-inner">
      
      <!-- 3 LOGO LEMBAGA -->
      <div class="cover-header-logos">
        <img src="../../assets/img/logo-usn.png" alt="Logo USN Kolaka" title="Universitas Sembilanbelas November Kolaka">
        <img src="../../assets/img/logo-msc.svg" alt="Logo UKM MSC" title="UKM Multimedia Study Club">
        <img src="../../assets/img/logo_skillance_official.png" alt="Logo PT Skillance" title="PT Skillance Digital Indonesia">
      </div>

      <!-- TITLE CONTENT -->
      <div class="cover-center-content">
        <div class="cover-badge">
          <i class="fa-solid fa-handshake me-1"></i> DOKUMEN PROPOSAL KEMITRAAN DUDI & KAMPUS
        </div>
        
        <h1 class="cover-title">
          PROPOSAL KEMITRAAN STRATEGIS TRIPARTIT
        </h1>
        
        <div class="cover-subtitle">
          PROGRAM PENGEMBANGAN TALENTA DIGITAL, BOOTCAMP INTENSIF 32 JP, DAN SERTIFIKASI SURAT KETERANGAN PENDAMPING IJAZAH (SKPI) BERSTANDAR INDUSTRI
        </div>
        
        <div class="cover-desc">
          "Penyelarasan Kurikulum Vokasi, Praktikum Koding Mandiri 24/7, dan Pembinaan Karir Freelance Software Developer bagi Mahasiswa Fakultas Teknologi Informasi USN Kolaka"
        </div>

        <!-- METADATA BOX -->
        <div class="cover-meta-box">
          <table>
            <tr>
              <td style="width: 140px; font-weight: bold; color: #0d2e5c;">Nomor Dokumen</td>
              <td style="width: 12px; text-align: center;">:</td>
              <td style="font-weight: 700;">012/PROP-SKL/FTI-MSC/XI/2026</td>
            </tr>
            <tr>
              <td style="font-weight: bold; color: #0d2e5c;">Kerjasama Antara</td>
              <td style="text-align: center;">:</td>
              <td>
                1. Fakultas Teknologi Informasi (FTI) &ndash; USN Kolaka<br>
                2. UKM Multimedia Study Club (MSC USN)<br>
                3. PT Skillance Digital Indonesia
              </td>
            </tr>
            <tr>
              <td style="font-weight: bold; color: #0d2e5c;">Fokus Kurikulum</td>
              <td style="text-align: center;">:</td>
              <td>Fullstack Web Architecture, RESTful API & MySQL (32 JP)</td>
            </tr>
            <tr>
              <td style="font-weight: bold; color: #0d2e5c;">Tahun Pelaksanaan</td>
              <td style="text-align: center;">:</td>
              <td>2026 / 2027 (Periode Kemitraan 1 Tahun Kalender)</td>
            </tr>
          </table>
        </div>
      </div>

      <!-- FOOTER TEXT -->
      <div class="cover-footer-text">
        <strong>PT SKILLANCE DIGITAL INDONESIA</strong> &bull; SK Kemenkumham RI No. AHU-0019405.AH.01.01.TAHUN 2026<br>
        Head Office: Jl. Pramuka No. 45, Kolaka, Sulawesi Tenggara, 93517 | Web: https://skillance.cloud | Email: partnership@skillance.cloud
      </div>

    </div>
  </div>

  <!-- ========================================================================= -->
  <!-- HALAMAN 2: BAB I & BAB II                                                -->
  <!-- ========================================================================= -->
  <div class="paper">
    <div class="page-body">
      <!-- KOP RESMI -->
      <table class="kop-table">
        <tr>
          <td class="kop-logo"><img src="../../assets/img/logo_skillance_official.png" alt="Logo"></td>
          <td class="kop-text">
            <div class="kop-title">PT SKILLANCE DIGITAL INDONESIA</div>
            <div class="kop-sub">SKILLANCE ACADEMY & TECH ECOSYSTEM &bull; PROPOSAL KEMITRAAN KAMPUS</div>
            <div class="kop-legal">SK Menkumham RI: AHU-0019405.AH.01.01.TAHUN 2026 | NIB: 100000011940526 | KBLI 62019 & 85499</div>
          </td>
        </tr>
      </table>
      <div class="kop-line"></div>

      <!-- BAB I -->
      <div class="section-title"><i class="fa-solid fa-circle-info"></i> BAB I: LATAR BELAKANG & URGENSI PROGRAM</div>
      <p class="p-body">
        Perkembangan industri teknologi informasi dan transformasi digital nasional menuntut ketersediaan sumber daya manusia (SDM) yang tidak hanya menguasai teori akademis, melainkan memiliki keterampilan rekayasa perangkat lunak praktis (hands-on coding) yang adaptif terhadap standar industri. Namun demikian, masih dijumpai kesenjangan (skill gap) antara materi perkuliahan konvensional dengan tuntutan dunia kerja, khususnya pada penguasaan arsitektur web modern, integrasi RESTful API, dan kolaborasi proyek berbasis repositori kode sumber.
      </p>
      <p class="p-body">
        Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi mendorong implementasi Surat Keterangan Pendamping Ijazah (SKPI) sebagai rekam jejak resmi kompetensi keahlian tambahan yang dimiliki lulusan perguruan tinggi, sejalan dengan pemenuhan Indikator Kinerja Utama (IKU 1 & IKU 2) serta akreditasi LAM-INFOKOM. Dalam konteks Fakultas Teknologi Informasi (FTI) Universitas Sembilanbelas November Kolaka, kehadiran Unit Kegiatan Mahasiswa Multimedia Study Club (UKM MSC) telah menjadi wadah potensial pengembangan minat dan bakat mahasiswa di bidang teknologi.
      </p>
      <p class="p-body">
        Menyikapi hal tersebut, <strong>PT Skillance Digital Indonesia</strong> hadir sebagai mitra Dunia Usaha dan Dunia Industri (DUDI) lokal yang berbadan hukum resmi untuk membangun sinergi Tripartit bersama <strong>FTI USN Kolaka</strong> dan <strong>UKM MSC</strong>. Sinergi ini memadukan infrastruktur belajar digital modern (Skillance Academy), pembinaan praktikum intensif (Bootcamp), penerbitan sertifikat SKPI sah 32 Jam Pelajaran (JP), serta penyaluran langsung talenta terbaik ke bursa proyek freelance teknologi.
      </p>

      <!-- BAB II -->
      <div class="section-title"><i class="fa-solid fa-bullseye"></i> BAB II: MAKSUD, TUJUAN, & SASARAN</div>
      <p class="p-body no-indent"><strong>2.1 Maksud Kemitraan:</strong></p>
      <p class="p-body">
        Membangun payung kolaborasi berkelanjutan antara entitas industri software (PT Skillance), pimpinan perguruan tinggi (FTI USN Kolaka), dan organisasi kemahasiswaan (UKM MSC) dalam ekosistem vokasi terpadu untuk percepatan kompetensi koding mahasiswa.
      </p>
      <p class="p-body no-indent"><strong>2.2 Tujuan Strategis:</strong></p>
      <ol class="list-styled">
        <li>Membekali mahasiswa dengan keahlian Fullstack Web Architecture & RESTful API berbobot 32 JP yang memenuhi kualifikasi industri software modern;</li>
        <li>Menyediakan dokumen resmi Surat Keterangan Pendamping Ijazah (SKPI) Tripartit ber-QR Code validasi online yang diakui dalam penomoran ijazah fakultas;</li>
        <li>Menyediakan Dashboard Pemantauan Akademik real-time bagi Dekanat dan Dosen Pembina untuk memantau keaktifan dan progres belajar mahasiswa;</li>
        <li>Memberikan dukungan kemandirian finansial bagi kas organisasi UKM MSC melalui skema bagi hasil kemitraan (revenue sharing);</li>
        <li>Membuka gerbang karir profesional mahasiswa melalui Skillance Freelance Tech Network.</li>
      </ol>
      <p class="p-body no-indent"><strong>2.3 Sasaran Peserta:</strong></p>
      <p class="p-body">
        Program ini ditargetkan bagi mahasiswa aktif Program Studi S1 Sistem Informasi, S1 Ilmu Komputer, serta anggota UKM Multimedia Study Club (MSC) FTI USN Kolaka (Target Cohort Batch 1: 50 &ndash; 100 Mahasiswa).
      </p>
    </div>

    <div class="page-footer">
      <span>Proposal Kemitraan Tripartit &bull; FTI USN &times; UKM MSC &times; PT Skillance</span>
      <span>Halaman 2 dari 5</span>
    </div>
  </div>

  <!-- ========================================================================= -->
  <!-- HALAMAN 3: BAB III & BAB IV                                              -->
  <!-- ========================================================================= -->
  <div class="paper">
    <div class="page-body">
      <!-- KOP RESMI -->
      <table class="kop-table">
        <tr>
          <td class="kop-logo"><img src="../../assets/img/logo_skillance_official.png" alt="Logo"></td>
          <td class="kop-text">
            <div class="kop-title">PT SKILLANCE DIGITAL INDONESIA</div>
            <div class="kop-sub">SKILLANCE ACADEMY & TECH ECOSYSTEM &bull; PROPOSAL KEMITRAAN KAMPUS</div>
            <div class="kop-legal">SK Menkumham RI: AHU-0019405.AH.01.01.TAHUN 2026 | NIB: 100000011940526 | KBLI 62019 & 85499</div>
          </td>
        </tr>
      </table>
      <div class="kop-line"></div>

      <!-- BAB III -->
      <div class="section-title"><i class="fa-solid fa-graduation-cap"></i> BAB III: STRUKTUR KURIKULUM & MATERI (32 JP)</div>
      <p class="p-body">
        Kurikulum dirancang berbasis Outcome-Based Education (OBE) dengan bobot <strong>70% Praktikum Kode Sumber Nyata</strong> dan <strong>30% Konseptual Arsitektur</strong>. Rincian 6 modul pembelajaran berbobot total 32 Jam Pelajaran (JP) adalah sebagai berikut:
      </p>

      <table class="content-table">
        <thead>
          <tr>
            <th style="width: 8%;">Modul</th>
            <th style="width: 32%;">Mata Pelatihan & Teknologi</th>
            <th style="width: 12%;">Bobot (JP)</th>
            <th style="width: 48%;">Capaian Pembelajaran (Learning Outcome)</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style="text-align: center; font-weight: bold;">MOD-01</td>
            <td><strong>Modern Web Foundations & Semantic HTML5</strong></td>
            <td style="text-align: center;">4 JP</td>
            <td>Struktur dokumen web modern, aksesibilitas, SEO-friendly layout, dan form handling.</td>
          </tr>
          <tr>
            <td style="text-align: center; font-weight: bold;">MOD-02</td>
            <td><strong>Responsive UI Architecture & CSS Grid/Flexbox</strong></td>
            <td style="text-align: center;">4 JP</td>
            <td>Desain antarmuka adaptif mobile-first, CSS variables, flexbox layout, dan Bootstrap 5 framework.</td>
          </tr>
          <tr>
            <td style="text-align: center; font-weight: bold;">MOD-03</td>
            <td><strong>JavaScript ES6+ & Asynchronous DOM Manipulation</strong></td>
            <td style="text-align: center;">6 JP</td>
            <td>Logika pemrograman modern, manipulasi elemen DOM dinamis, event handling, dan Fetch API.</td>
          </tr>
          <tr>
            <td style="text-align: center; font-weight: bold;">MOD-04</td>
            <td><strong>Server-Side Backend Architecture with PHP</strong></td>
            <td style="text-align: center;">8 JP</td>
            <td>Arsitektur MVC, state management session & cookie, sanitasi input, dan otentikasi login terenkripsi.</td>
          </tr>
          <tr>
            <td style="text-align: center; font-weight: bold;">MOD-05</td>
            <td><strong>Relational Database Design & MySQL Optimization</strong></td>
            <td style="text-align: center;">4 JP</td>
            <td>Normalisasi database, relasi multi-tabel (PK-FK), query CRUD kompleks, dan indexing performa.</td>
          </tr>
          <tr>
            <td style="text-align: center; font-weight: bold;">MOD-06</td>
            <td><strong>RESTful API Engineering & Project Capstone</strong></td>
            <td style="text-align: center;">6 JP</td>
            <td>Pembangunan endpoint REST API (JSON payload, HTTP verbs, token auth) dan deployment aplikasi web utuh.</td>
          </tr>
          <tr style="font-weight: bold; background: #f1f5f9;">
            <td colspan="2" style="text-align: right; padding-right: 12px;">TOTAL BEBAN PEMBELAJARAN & PRAKTIKUM:</td>
            <td style="text-align: center; color: #0d2e5c;">32 JP</td>
            <td>Lulus Ujian Komprehensif Skor &ge; 75 &amp; Klaim Sertifikat SKPI</td>
          </tr>
        </tbody>
      </table>

      <!-- BAB IV -->
      <div class="section-title"><i class="fa-solid fa-laptop-code"></i> BAB IV: EKOSISTEM TEKNOLOGI & METODOLOGI</div>
      <p class="p-body">
        Pelaksanaan program memanfaatkan kombinasi platform digital (hybrid learning) yang terintegrasi:
      </p>
      <ol class="list-styled">
        <li><strong>Platform Daring 24/7 (Skillance Academy):</strong> Seluruh silabus, modul praktikum, dan video instruksional dapat diakses mandiri kapan saja melalui portal kemitraan: <code>https://academy.skillance.cloud/partner-portal.php?partner=msc-usn</code>.</li>
        <li><strong>Mentoring Bootcamp Intensif (Tatap Muka &amp; Hybrid):</strong> Pendampingan praktikum terfokus bersama instruktur industri dan pengurus UKM MSC untuk bedah kode (code review) dan penyelesaian proyek nyata.</li>
        <li><strong>Ujian Kompetensi Komprehensif Berstandar Industri:</strong> Evaluasi akhir terdiri dari asesmen teori teknis dan tes koding praktikum untuk mengukur penguasaan standar SKPI mahasiswa.</li>
        <li><strong>Gateway Multi-Role SIAKAD:</strong> Sistem otorisasi satu pintu yang membedakan hak akses secara presisi antara Mahasiswa, Pimpinan Dekanat, Pengurus Ormawa, dan Freelancer.</li>
      </ol>
    </div>

    <div class="page-footer">
      <span>Proposal Kemitraan Tripartit &bull; FTI USN &times; UKM MSC &times; PT Skillance</span>
      <span>Halaman 3 dari 5</span>
    </div>
  </div>

  <!-- ========================================================================= -->
  <!-- HALAMAN 4: BAB V & BAB VI                                                -->
  <!-- ========================================================================= -->
  <div class="paper">
    <div class="page-body">
      <!-- KOP RESMI -->
      <table class="kop-table">
        <tr>
          <td class="kop-logo"><img src="../../assets/img/logo_skillance_official.png" alt="Logo"></td>
          <td class="kop-text">
            <div class="kop-title">PT SKILLANCE DIGITAL INDONESIA</div>
            <div class="kop-sub">SKILLANCE ACADEMY & TECH ECOSYSTEM &bull; PROPOSAL KEMITRAAN KAMPUS</div>
            <div class="kop-legal">SK Menkumham RI: AHU-0019405.AH.01.01.TAHUN 2026 | NIB: 100000011940526 | KBLI 62019 & 85499</div>
          </td>
        </tr>
      </table>
      <div class="kop-line"></div>

      <!-- BAB V -->
      <div class="section-title"><i class="fa-solid fa-award"></i> BAB V: SPESIFIKASI SERTIFIKAT TRIPARTIT & VALIDITAS SKPI</div>
      <p class="p-body">
        Sertifikat yang diterbitkan dirancang khusus memenuhi standar tata kelola dokumen perguruan tinggi dan akreditasi LAM-INFOKOM, dengan spesifikasi teknis:
      </p>
      <ol class="list-styled">
        <li><strong>Format Dua Halaman (Landscape A4 Terstandar):</strong>
          <ul style="margin-top: 2px; padding-left: 18px;">
            <li><strong>Halaman Depan:</strong> Sertifikat Kelulusan resmi memuat identitas mahasiswa (Nama, NIM, Program Studi), judul kompetensi industri, predikat kelulusan (A / B+), QR-Code validasi online, serta 3 (tiga) Tanda Tangan &amp; Stempel Sah (Direktur PT Skillance, Ketua Umum UKM MSC, dan Wadek Bidang Kemahasiswaan FTI USN Kolaka).</li>
            <li><strong>Halaman Belakang:</strong> Transkrip Nilai Akademik 32 JP yang memerinci nilai angka (0&ndash;100) dan nilai huruf per modul, tanggal penerbitan, serta tandatangan verifikasi Ketua Program Studi / Panitia Uji.</li>
          </ul>
        </li>
        <li><strong>Sistem Validasi QR-Code 24/7:</strong> Setiap sertifikat memiliki kode registrasi unik (misal: <code>SKL-MSC-2026-001</code>) yang terhubung ke mesin validasi publik di <code>https://academy.skillance.cloud/verify.php</code> untuk mencegah segala bentuk pemalsuan berkas.</li>
        <li><strong>Berita Acara Rekapitulasi Otomatis:</strong> Dekanat dapat mencetak Berita Acara Kelulusan resmi langsung dari panel dashboard pemantauan sebagai bukti fisik pertanggungjawaban akademik.</li>
      </ol>

      <!-- BAB VI -->
      <div class="section-title"><i class="fa-solid fa-hand-holding-dollar"></i> BAB VI: ANALISIS MANFAAT BAGI SELURUH PIHAK</div>
      <p class="p-body">
        Kemitraan ini dibangun atas asas saling menguntungkan (Win-Win-Win Solution) yang memberikan dampak nyata:
      </p>

      <div class="callout-card">
        <strong>1. Manfaat bagi Fakultas Teknologi Informasi (FTI USN Kolaka):</strong><br>
        &bull; Peningkatan capaian IKU-1 (Lulusan mendapat pekerjaan layak) & IKU-2 (Mahasiswa berkegiatan di luar kampus).<br>
        &bull; Penguatan poin akreditasi institusi dan program studi pada kriteria Kerjasama DUDI.<br>
        &bull; Dashboard monitoring mandiri tanpa membebani server lokal kampus.
      </div>

      <div class="callout-card">
        <strong>2. Manfaat bagi UKM Multimedia Study Club (MSC USN):</strong><br>
        &bull; Penguatan reputasi ormawa sebagai inisiator pelatihan vokasi bersertifikasi industri di lingkungan kampus.<br>
        &bull; Alokasi dana kas organisasi (Revenue Sharing) dari setiap peserta guna membiayai program kerja internal.<br>
        &bull; Pembinaan teknis langsung dari instruktur industri bagi pengurus inti ormawa.
      </div>

      <div class="callout-card">
        <strong>3. Manfaat bagi Mahasiswa Peserta:</strong><br>
        &bull; Portofolio kode sumber aplikasi nyata yang siap ditunjukkan kepada calon pemberi kerja.<br>
        &bull; Dokumen sertifikasi resmi SKPI berbobot 32 JP yang diakui kampus dan industri.<br>
        &bull; Akses langsung ke Skillance Freelance Tech Network untuk mendapatkan penghasilan dari proyek software.
      </div>
    </div>

    <div class="page-footer">
      <span>Proposal Kemitraan Tripartit &bull; FTI USN &times; UKM MSC &times; PT Skillance</span>
      <span>Halaman 4 dari 5</span>
    </div>
  </div>

  <!-- ========================================================================= -->
  <!-- HALAMAN 5: BAB VII, BAB VIII, & LEMBAR PENGESAHAN                        -->
  <!-- ========================================================================= -->
  <div class="paper">
    <div class="page-body">
      <!-- KOP RESMI -->
      <table class="kop-table">
        <tr>
          <td class="kop-logo"><img src="../../assets/img/logo_skillance_official.png" alt="Logo"></td>
          <td class="kop-text">
            <div class="kop-title">PT SKILLANCE DIGITAL INDONESIA</div>
            <div class="kop-sub">SKILLANCE ACADEMY & TECH ECOSYSTEM &bull; PROPOSAL KEMITRAAN KAMPUS</div>
            <div class="kop-legal">SK Menkumham RI: AHU-0019405.AH.01.01.TAHUN 2026 | NIB: 100000011940526 | KBLI 62019 & 85499</div>
          </td>
        </tr>
      </table>
      <div class="kop-line"></div>

      <!-- BAB VII -->
      <div class="section-title"><i class="fa-solid fa-timeline"></i> BAB VII: TIMELINE IMPLEMENTASI PROGRAM</div>
      <table class="content-table" style="margin-bottom: 8px;">
        <thead>
          <tr>
            <th style="width: 20%;">Tahapan</th>
            <th style="width: 45%;">Agenda Kegiatan</th>
            <th style="width: 35%;">Penanggung Jawab</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><strong>Fase 1: Sosialisasi</strong></td>
            <td>Pembukaan portal belajar mandiri daring &amp; registrasi cohort mahasiswa.</td>
            <td>Pengurus UKM MSC &amp; PT Skillance</td>
          </tr>
          <tr>
            <td><strong>Fase 2: Mentoring</strong></td>
            <td>Pelaksanaan kelas bootcamp intensif, live coding, dan asistensi tugas.</td>
            <td>Instruktur Skillance &amp; Divisi Diklat MSC</td>
          </tr>
          <tr>
            <td><strong>Fase 3: Evaluasi</strong></td>
            <td>Ujian kompetensi komprehensif 32 JP dan penilaian proyek capstone.</td>
            <td>Tim Penguji Skillance &amp; Dosen Reviewer</td>
          </tr>
          <tr>
            <td><strong>Fase 4: Sertifikasi</strong></td>
            <td>Penerbitan Sertifikat SKPI Tripartit dan penyerahan Berita Acara ke Dekanat.</td>
            <td>Dekanat FTI, MSC, &amp; PT Skillance</td>
          </tr>
        </tbody>
      </table>

      <!-- BAB VIII -->
      <div class="section-title"><i class="fa-solid fa-shield-halved"></i> BAB VIII: LEGALITAS & KANTOR PUSAT PENGUSUNG</div>
      <table style="width: 100%; font-size: 8.5pt; line-height: 1.4; margin-bottom: 10px;">
        <tr>
          <td style="width: 150px; font-weight: bold; color: #0d2e5c;">Nama Badan Hukum</td>
          <td style="width: 10px;">:</td>
          <td>PT SKILLANCE DIGITAL INDONESIA</td>
        </tr>
        <tr>
          <td style="font-weight: bold; color: #0d2e5c;">SK Pengesahan Menkumham</td>
          <td>:</td>
          <td>AHU-0019405.AH.01.01.TAHUN 2026</td>
        </tr>
        <tr>
          <td style="font-weight: bold; color: #0d2e5c;">Nomor Induk Berusaha (NIB)</td>
          <td>:</td>
          <td>100000011940526 (KBLI 62019 &amp; 85499)</td>
        </tr>
        <tr>
          <td style="font-weight: bold; color: #0d2e5c;">Alamat Kantor Pusat</td>
          <td>:</td>
          <td>Jl. Pramuka No. 45, Kolaka, Sulawesi Tenggara, 93517</td>
        </tr>
        <tr>
          <td style="font-weight: bold; color: #0d2e5c;">Kontak &amp; Layanan Kemitraan</td>
          <td>:</td>
          <td>Telp/WA: +62 822-9076-2003 | Email: partnership@skillance.cloud</td>
        </tr>
      </table>

      <!-- LEMBAR PENGESAHAN TRIPARTIT -->
      <div style="background: #f8fafc; border: 1.5px solid #0d2e5c; border-radius: 8px; padding: 12px; margin-top: 6px;">
        <div style="text-align: center; font-family: 'Arial', sans-serif; font-size: 10pt; font-weight: bold; color: #0d2e5c; margin-bottom: 6px;">
          LEMBAR PENGESAHAN &amp; KESEPAKATAN KEMITRAAN TRIPARTIT
        </div>
        <div style="text-align: center; font-size: 8.5pt; color: #475569; margin-bottom: 12px;">
          Kolaka, 24 November 2026 &bull; Ditetapkan dan disetujui bersama oleh Perwakilan Para Pihak:
        </div>

        <table style="width: 100%; text-align: center; font-size: 8.2pt; border-collapse: collapse;">
          <tr>
            <td style="width: 33.3%; vertical-align: top;">
              <strong>PIHAK I (INDUSTRI)</strong><br>
              PT Skillance Digital Indonesia
              <div style="position: relative; height: 60px; margin: 4px auto;">
                <img src="../../assets/img/stempel_skillance_navy.png" style="position: absolute; left: 18%; top: -2px; height: 62px; opacity: 0.90;">
                <img src="../../assets/img/ttd-muh-arsyad-ramsi.png" style="position: absolute; left: 10%; top: 4px; height: 50px;">
              </div>
              <strong><u>MUH. ARSYAD RAMSI</u></strong><br>
              Direktur Utama
            </td>
            <td style="width: 33.3%; vertical-align: top;">
              <strong>PIHAK II (ORMAWA)</strong><br>
              UKM Multimedia Study Club (MSC)
              <div style="position: relative; height: 60px; margin: 4px auto; display: flex; align-items: center; justify-content: center;">
                <span style="font-family: 'Brush Script MT', cursive; font-size: 18pt; color: #1e3a8a;">Fadel Al-Farizi</span>
              </div>
              <strong><u>MUH. FADEL AL-FARIZI</u></strong><br>
              Ketua Umum UKM MSC
            </td>
            <td style="width: 33.3%; vertical-align: top;">
              <strong>PIHAK III (FAKULTAS)</strong><br>
              FTI USN Kolaka
              <div style="position: relative; height: 60px; margin: 4px auto; display: flex; align-items: center; justify-content: center;">
                <div style="border: 1px dashed #cbd5e1; border-radius: 4px; padding: 4px 6px; font-size: 7pt; color: #64748b;">
                  Tanda Tangan &amp; Cap Fakultas
                </div>
              </div>
              <strong><u>Dr. Ir. Suharman, S.T., M.Kom.</u></strong><br>
              Wakil Dekan Bid. Kemahasiswaan
            </td>
          </tr>
        </table>
      </div>

    </div>

    <div class="page-footer">
      <span>Proposal Kemitraan Tripartit &bull; FTI USN &times; UKM MSC &times; PT Skillance</span>
      <span>Halaman 5 dari 5</span>
    </div>
  </div>

</body>
</html>
