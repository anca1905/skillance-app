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

// Determine active view from GET parameter: 'msc', 'fakultas', 'pks'
$view = $_GET['view'] ?? ($_GET['type'] ?? 'msc');
if (!in_array($view, ['msc', 'fakultas', 'pks'])) {
    $view = 'msc';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $view === 'msc' ? 'Surat Pemberitahuan UKM MSC' : ($view === 'fakultas' ? 'Surat Pemberitahuan Dekanat FTI USN' : 'Naskah PKS Tripartit FTI-MSC-Skillance') ?> | PT Skillance Digital Indonesia</title>
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
  
  <style>
    /* Print Rules - Jaminan 1 Lembar A4 Pas untuk Surat */
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
      .page-break-after {
        page-break-after: always !important;
        break-after: page !important;
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

    /* Top Navigation Toolbar */
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

    /* Document Switcher Tab Bar */
    .doc-nav-card {
      background: #ffffff;
      border-radius: 12px;
      padding: 12px 18px;
      max-width: 210mm;
      margin: 0 auto 16px auto;
      box-shadow: 0 3px 12px rgba(0,0,0,0.06);
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
      padding: 7px 14px;
      border-radius: 8px;
      font-size: 12px;
      font-weight: 600;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 7px;
      transition: all 0.2s;
    }
    .doc-pill:hover {
      background: #eef2f6;
      border-color: #94a3b8;
      color: #0d2e5c;
    }
    .doc-pill.active {
      background: #0d2e5c;
      color: #ffffff;
      border-color: #0d2e5c;
      box-shadow: 0 2px 6px rgba(13,46,92,0.25);
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

    /* Letter Meta (Nomor, Lampiran, Hal) */
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
      font-weight: normal;
    }
    .meta-separator {
      width: 14px;
      text-align: center;
    }

    /* Target Addressee */
    .addressee-box {
      margin-bottom: 14px;
      font-size: 10.5pt;
      line-height: 1.35;
    }

    /* Body Paragraphs */
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

    /* Ordered List Inside Letter */
    .letter-list {
      margin: 4px 0 8px 0;
      padding-left: 24px;
    }
    .letter-list li {
      margin-bottom: 4px;
      line-height: 1.34;
    }

    /* Highlight Info Callout Box */
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

    /* Tembusan */
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
      <span class="badge-org">KEMITRAAN KAMPUS</span>
      <span style="font-size: 12.5px; font-weight: 600;">FTI USN Kolaka x UKM MSC x PT Skillance</span>
    </div>
    <div class="toolbar-right">
      <button onclick="window.print()" class="btn-print-main">
        <i class="fa-solid fa-print"></i> Cetak Dokumen (A4)
      </button>
    </div>
  </header>

  <!-- DOCUMENT SELECTOR TABS (NO PRINT) -->
  <nav class="doc-nav-card no-print">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
      <div class="doc-pills">
        <a href="surat-kemitraan-fti-msc.php?view=msc" class="doc-pill <?= $view === 'msc' ? 'active' : '' ?>">
          <i class="fa-solid fa-users text-warning"></i> 1. Surat untuk UKM MSC (Penyelenggara)
        </a>
        <a href="surat-kemitraan-fti-msc.php?view=fakultas" class="doc-pill <?= $view === 'fakultas' ? 'active' : '' ?>">
          <i class="fa-solid fa-building-columns text-info"></i> 2. Surat untuk Dekanat FTI USN
        </a>
        <a href="surat-kemitraan-fti-msc.php?view=pks" class="doc-pill <?= $view === 'pks' ? 'active' : '' ?>">
          <i class="fa-solid fa-file-contract text-success"></i> 3. Naskah Lengkap PKS Tripartit
        </a>
      </div>
      <div style="font-size: 11px; color: #64748b;">
        <i class="fa-solid fa-circle-check text-success me-1"></i> Standar Surat Resmi Korporat PT
      </div>
    </div>
  </nav>

  <?php if ($view === 'msc'): ?>
  <!-- ========================================================================= -->
  <!-- DOKUMEN 1: SURAT PEMBERITAHUAN UNTUK UKM MSC                            -->
  <!-- ========================================================================= -->
  <main class="paper" id="paperMsc">
    
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
        <td><strong>031/SKL-DIR/PKS-MSC/XI/2026</strong></td>
        <td style="text-align: right; width: 150px;">Kolaka, 15 November 2026</td>
      </tr>
      <tr>
        <td class="meta-label">Lampiran</td>
        <td class="meta-separator">:</td>
        <td>1 (Satu) Berkas Lembar Panduan Akses Mandiri</td>
        <td></td>
      </tr>
      <tr>
        <td class="meta-label">Perihal</td>
        <td class="meta-separator">:</td>
        <td><strong><u>Pemberitahuan Pembukaan Akses Pembelajaran Mandiri & Masa Sinkronisasi Sistem Bootcamp-Sertifikasi (7 Hari)</u></strong></td>
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
        Puji syukur kita panjatkan ke hadirat Tuhan Yang Maha Esa atas kelancaran sinergi kemitraan strategis Tripartit antara PT Skillance Digital Indonesia, UKM Multimedia Study Club (MSC), dan Fakultas Teknologi Informasi USN Kolaka. Berdasarkan Perjanjian Kerja Sama (PKS) Nomor: <strong>014/PKS-SKL/FTI-USN/XI/2026</strong> tentang Penyelenggaraan Pelatihan Fullstack Web Architecture dan Sertifikasi Surat Keterangan Pendamping Ijazah (SKPI), melalui surat ini Direksi PT Skillance Digital Indonesia menyampaikan beberapa hal penting sebagai berikut:
      </p>

      <ol class="letter-list">
        <li>
          <strong>Akses Pembelajaran Mandiri (Learning Track) Resmi Dibuka:</strong><br>
          Terhitung mulai hari ini, <strong>Minggu, 15 November 2026</strong>, sistem pembelajaran teknis mandiri pada kurikulum kemitraan 32 Jam Pelajaran (JP) telah dapat diakses oleh seluruh mahasiswa anggota UKM MSC melalui portal: <strong>https://academy.skillance.cloud/partner-portal.php?partner=msc-usn</strong> dengan memvalidasi NIM mahasiswa.
        </li>
        <li>
          <strong>Fitur yang Dapat Digunakan Saat Ini:</strong><br>
          Fasilitas yang telah aktif dan dapat langsung dimanfaatkan mahasiswa adalah <strong>modul praktikum koding interaktif</strong> (HTML5, Modern CSS, JavaScript ES6+, PHP Backend Architecture, MySQL Relational Database, dan RESTful API). Mahasiswa dapat belajar mandiri, membaca materi silabus, dan menguji kode program secara langsung.
        </li>
        <li>
          <strong>Masa Pengembangan & Sinkronisasi Sistem (7 Hari Kalender):</strong><br>
          Menindaklanjuti ketetapan manajemen, sistem untuk <strong>Jadwal Mentoring Bootcamp Intensif</strong> dan <strong>Penerbitan Sertifikat Tripartit SKPI Digital</strong> saat ini sedang dalam fase finalisasi pengujian beban server dan kalibrasi bank soal ujian selama <strong>7 (tujuh) hari kalender (15 s/d 22 November 2026)</strong>. Selama masa 7 hari ini, fitur bootcamp dan ujian sertifikasi dinonaktifkan sementara untuk menjamin validitas nilai dan keaslian stempel digital.
        </li>
        <li>
          <strong>Arahan untuk Pengurus UKM MSC:</strong><br>
          Kami memohon bantuan Pengurus UKM MSC untuk mengarahkan seluruh anggota cohort agar segera mulai mempelajari materi modul yang tersedia, sembari panitia menyelesaikan validasi data peserta sebelum peluncuran penuh fitur bootcamp dan ujian kompetensi pada <strong>22 November 2026</strong>. Pengurus juga dapat memantau data keaktifan anggota melalui gateway portal khusus pengurus.
        </li>
      </ol>

      <div class="info-callout">
        <strong>Ringkasan Timeline Pelaksanaan Kemitraan:</strong><br>
        &bull; <strong>15 &ndash; 22 November 2026 (7 Hari):</strong> Pembelajaran Modul Mandiri (Learning Track 32 JP) & Sinkronisasi Sistem.<br>
        &bull; <strong>22 November 2026:</strong> Pembukaan Penuh Fitur Bootcamp Terjadwal & Ujian Kompetensi Komprehensif SKPI.
      </div>

      <p class="no-indent">
        Demikian surat pemberitahuan ini kami sampaikan. Atas dedikasi, kerja sama, dan semangat kolaborasi Pengurus UKM Multimedia Study Club demi peningkatan mutu talenta digital mahasiswa, kami ucapkan terima kasih yang sebesar-besarnya.
      </p>
    </div>

    <!-- TANDA TANGAN & STEMPEL -->
    <table class="signature-table">
      <tr>
        <td class="sig-col"></td>
        <td class="sig-col sig-right">
          <div>Kolaka, 15 November 2026</div>
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
        <li>Arsip & Legal Kemitraan PT Skillance Digital Indonesia.</li>
      </ol>
    </div>

  </main>

  <?php elseif ($view === 'fakultas'): ?>
  <!-- ========================================================================= -->
  <!-- DOKUMEN 2: SURAT LAPORAN & PEMBERITAHUAN UNTUK DEKANAT FTI USN          -->
  <!-- ========================================================================= -->
  <main class="paper" id="paperFakultas">
    
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
        <td><strong>032/SKL-DIR/PKS-FTI/XI/2026</strong></td>
        <td style="text-align: right; width: 150px;">Kolaka, 15 November 2026</td>
      </tr>
      <tr>
        <td class="meta-label">Lampiran</td>
        <td class="meta-separator">:</td>
        <td>1 (Satu) Berkas Dokumen Kurikulum 32 JP & Akses Dashboard</td>
        <td></td>
      </tr>
      <tr>
        <td class="meta-label">Perihal</td>
        <td class="meta-separator">:</td>
        <td><strong><u>Laporan Kesiapan Infrastruktur Kemitraan & Pemberitahuan Masa Sinkronisasi Teknis SKPI (7 Hari)</u></strong></td>
        <td></td>
      </tr>
    </table>

    <!-- TUJUAN SURAT -->
    <div class="addressee-box">
      Kepada Yth.<br>
      <strong>Dekan / Wakil Dekan Bidang Kemahasiswaan & Kerjasama</strong><br>
      Fakultas Teknologi Informasi (FTI)<br>
      Universitas Sembilanbelas November Kolaka<br>
      Di -<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u>Tempat</u>
    </div>

    <!-- ISI SURAT -->
    <div class="letter-body">
      <p class="no-indent">Dengan hormat,</p>
      
      <p>
        Teriring salam dan doa semoga Bapak/Ibu Pimpinan Fakultas Teknologi Informasi Universitas Sembilanbelas November Kolaka senantiasa berada dalam lindungan Tuhan Yang Maha Kuasa serta sukses dalam menjalankan tugas tridharma perguruan tinggi.
      </p>

      <p>
        Merujuk pada Perjanjian Kerja Sama (PKS) Tripartit Nomor: <strong>014/PKS-SKL/FTI-USN/XI/2026</strong> tentang Program Pembelajaran Teknis Industri dan Penerbitan Sertifikat Surat Keterangan Pendamping Ijazah (SKPI) Mahasiswa, bersama surat ini kami sampaikan laporan kesiapan teknis serta agenda implementasi program sebagai berikut:
      </p>

      <ol class="letter-list">
        <li>
          <strong>Kesiapan Dashboard Pemantauan Akademik Dekanat:</strong><br>
          PT Skillance Digital Indonesia telah mengaktifkan sistem pemantauan terpadu untuk Pimpinan Fakultas dan Dosen Pembina yang dapat diakses melalui portal resmi: <strong>https://academy.skillance.cloud/dashboard-partner.php?partner=msc-usn</strong>. Melalui panel ini, pimpinan dapat memantau tingkat keaktifan, progres praktikum, serta rekapitulasi data mahasiswa secara berkala.
        </li>
        <li>
          <strong>Pembukaan Akses Pembelajaran Mandiri (Learning Track):</strong><br>
          Terhitung mulai <strong>15 November 2026</strong>, mahasiswa FTI USN Kolaka peserta cohort telah dapat mengakses seluruh materi silabus terstruktur berbobot 32 Jam Pelajaran (JP) yang mencakup teknologi Web Architecture, Frontend Engineering, Backend RESTful API, dan Database Management.
        </li>
        <li>
          <strong>Masa Sinkronisasi & Finalisasi Sistem Evaluasi Ujian SKPI (7 Hari Kalender):</strong><br>
          Guna memastikan terpenuhinya standar akreditasi program studi (LAM-INFOKOM) dan kepatuhan sistem penomoran ijazah nasional (PIN/SIVIL), kami memberlakukan <strong>masa sinkronisasi teknis selama 7 (tujuh) hari kalender (15 &ndash; 22 November 2026)</strong>. Pada masa ini, modul pembelajaran aktif digunakan mahasiswa, sementara sistem ujian kompetensi komprehensif, pencetakan Berita Acara, dan penerbitan Sertifikat Tripartit sedang dalam tahap validasi akhir agar terbebas dari kendala teknis.
        </li>
        <li>
          <strong>Jadwal Peluncuran Sertifikasi & Ujian Komprehensif:</strong><br>
          Fitur ujian kompetensi komprehensif berstandar SKPI dan pencetakan Sertifikat Tripartit ber-QR Code validasi resmi akan diaktifkan secara menyeluruh pada hari <strong>Minggu, 22 November 2026</strong>.
        </li>
      </ol>

      <div class="info-callout">
        <strong>Komitmen Standar Mutu Akademik PT Skillance Digital Indonesia:</strong><br>
        Kami menjamin seluruh sertifikat yang diterbitkan memuat tanda tangan sah 3 (tiga) pihak, nomor registrasi SKPI terenkripsi, transkrip nilai akademik 32 JP di halaman belakang, serta dapat diverifikasi 24/7 melalui sistem verifikasi daring kampus.
      </div>

      <p class="no-indent">
        Demikian surat laporan dan pemberitahuan ini kami sampaikan. Kami mengucapkan terima kasih dan apresiasi yang setinggi-tingginya kepada Dekanat FTI USN Kolaka atas dukungan dan kepercayaan yang diberikan dalam membangun ekosistem talenta digital unggul di Sulawesi Tenggara.
      </p>
    </div>

    <!-- TANDA TANGAN & STEMPEL -->
    <table class="signature-table">
      <tr>
        <td class="sig-col"></td>
        <td class="sig-col sig-right">
          <div>Kolaka, 15 November 2026</div>
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
        <li>Rektor Universitas Sembilanbelas November Kolaka (sebagai laporan);</li>
        <li>Ketua Jurusan / Koordinator Program Studi Sistem Informasi & Ilmu Komputer FTI USN Kolaka;</li>
        <li>Ketua Umum UKM Multimedia Study Club (MSC) USN Kolaka;</li>
        <li>Arsip & Tata Usaha Kemitraan PT Skillance Digital Indonesia.</li>
      </ol>
    </div>

  </main>

  <?php elseif ($view === 'pks'): ?>
  <!-- ========================================================================= -->
  <!-- DOKUMEN 3: NASKAH LENGKAP PERJANJIAN KERJA SAMA (PKS) TRIPARTIT          -->
  <!-- ========================================================================= -->
  <main class="paper" id="paperPks" style="font-size: 10pt; line-height: 1.45;">
    
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
            Kantor: Jl. Pramuka No. 45, Kolaka, Sulawesi Tenggara | Web: skillance.cloud | Email: partnership@skillance.cloud
          </div>
        </td>
      </tr>
    </table>
    <div class="kop-line"></div>

    <div style="text-align: center; margin-bottom: 14px;">
      <h4 style="font-family: 'Arial', sans-serif; font-size: 12pt; font-weight: 900; margin: 0; color: #0d2e5c; text-transform: uppercase;">
        PERJANJIAN KERJA SAMA (PKS) TRIPARTIT
      </h4>
      <div style="font-size: 9pt; font-weight: bold; color: #374151; margin-top: 2px;">
        TENTANG PENYELENGGARAAN PELATIHAN FULLSTACK WEB & SERTIFIKASI SKPI MAHASISWA
      </div>
      <div style="font-size: 8.5pt; color: #6b7280; margin-top: 3px;">
        Nomor Pihak I : 014/PKS-SKL/FTI-USN/XI/2026<br>
        Nomor Pihak II : 005/PKS-MSC/USN/XI/2026<br>
        Nomor Pihak III : 018/UN56.FTI/KS/2026
      </div>
    </div>

    <div class="letter-body">
      <p class="no-indent">
        Pada hari ini, <strong>Senin</strong> tanggal <strong>Enam Belas</strong> bulan <strong>November</strong> tahun <strong>Dua Ribu Dua Puluh Enam (16-11-2026)</strong>, bertempat di Kolaka, Sulawesi Tenggara, pihak-pihak yang bertandatangan di bawah ini:
      </p>

      <table style="width: 100%; font-size: 9.5pt; margin: 6px 0 10px 0;">
        <tr>
          <td style="width: 25px; vertical-align: top; font-weight: bold;">I.</td>
          <td style="width: 130px; vertical-align: top; font-weight: bold;">Muh. Arsyad Ramsi</td>
          <td style="width: 10px; vertical-align: top;">:</td>
          <td style="vertical-align: top;">Direktur Utama PT Skillance Digital Indonesia, bertindak untuk dan atas nama <strong>PT Skillance Digital Indonesia</strong>, selanjutnya disebut sebagai <strong>PIHAK KESATU (INDUSTRI)</strong>.</td>
        </tr>
        <tr>
          <td style="vertical-align: top; font-weight: bold;">II.</td>
          <td style="vertical-align: top; font-weight: bold;">Muh. Fadel Al-Farizi</td>
          <td style="vertical-align: top;">:</td>
          <td style="vertical-align: top;">Ketua Umum UKM Multimedia Study Club (MSC), bertindak untuk dan atas nama <strong>UKM MSC Universitas Sembilanbelas November Kolaka</strong>, selanjutnya disebut sebagai <strong>PIHAK KEDUA (ORMAWA PENYELENGGARA)</strong>.</td>
        </tr>
        <tr>
          <td style="vertical-align: top; font-weight: bold;">III.</td>
          <td style="vertical-align: top; font-weight: bold;">Dr. Ir. Suharman, S.T., M.Kom.</td>
          <td style="vertical-align: top;">:</td>
          <td style="vertical-align: top;">Wakil Dekan Bidang Kemahasiswaan & Kerjasama, bertindak untuk dan atas nama <strong>Fakultas Teknologi Informasi Universitas Sembilanbelas November Kolaka</strong>, selanjutnya disebut sebagai <strong>PIHAK KETIGA (FAKULTAS)</strong>.</td>
        </tr>
      </table>

      <p class="no-indent">
        PIHAK KESATU, PIHAK KEDUA, dan PIHAK KETIGA secara bersama-sama disebut <strong>PARA PIHAK</strong>, sepakat mengikatkan diri dalam Perjanjian Kerja Sama dengan ketentuan dan pasal-pasal sebagai berikut:
      </p>

      <!-- PASAL-PASAL -->
      <div style="text-align: center; font-weight: bold; font-size: 10pt; margin: 8px 0 2px 0;">Pasal 1<br>MAKSUD DAN TUJUAN</div>
      <p>
        Perjanjian ini bertujuan menjalin kolaborasi strategis antara Dunia Usaha dan Dunia Industri (DUDI) dengan Perguruan Tinggi dalam menyelenggarakan pelatihan vokasi intensif, uji kompetensi berstandar industri, serta penyediaan Sertifikat Surat Keterangan Pendamping Ijazah (SKPI) berbobot 32 Jam Pelajaran (JP) untuk mahasiswa Fakultas Teknologi Informasi USN Kolaka.
      </p>

      <div style="text-align: center; font-weight: bold; font-size: 10pt; margin: 8px 0 2px 0;">Pasal 2<br>RUANG LINGKUP PROGRAM</div>
      <p>
        Ruang lingkup kerja sama mencakup:
      </p>
      <ol class="letter-list" style="margin-top: 2px;">
        <li>Penyediaan sistem pembelajaran digital (Skillance Academy Learning Platform) dan silabus teknis 32 JP bidang Fullstack Web Architecture & RESTful API;</li>
        <li>Penyelenggaraan pendampingan praktikum intensif (Bootcamp) yang dikoordinasikan oleh PIHAK KEDUA;</li>
        <li>Penyelenggaraan Ujian Kompetensi Komprehensif terstandar;</li>
        <li>Penerbitan Sertifikat Tripartit Digital ber-QR Code validasi resmi yang diakui sebagai poin SKPI oleh PIHAK KETIGA;</li>
        <li>Penyediaan Dashboard Pemantauan Akademik real-time bagi Pimpinan Fakultas dan Dosen Pembina.</li>
      </ol>

      <div style="text-align: center; font-weight: bold; font-size: 10pt; margin: 8px 0 2px 0;">Pasal 3<br>MASA IMPLEMENTASI & SINKRONISASI TEKNIS</div>
      <p>
        PARA PIHAK menyepakati bahwa per tanggal <strong>15 November 2026</strong>, akses materi pembelajaran mandiri (Learning Track) dibuka untuk seluruh peserta. PIHAK KESATU menetapkan masa sinkronisasi teknis sistem ujian evaluasi dan pencetakan sertifikat selama <strong>7 (tujuh) hari kalender (15 &ndash; 22 November 2026)</strong> sebelum pelaksanaan bootcamp dan ujian dibuka secara penuh.
      </p>

      <div style="text-align: center; font-weight: bold; font-size: 10pt; margin: 8px 0 2px 0;">Pasal 4<br>MASA BERLAKU PERJANJIAN</div>
      <p>
        Perjanjian Kerja Sama ini berlaku selama <strong>1 (satu) tahun kalender</strong>, terhitung sejak tanggal <strong>16 November 2026</strong> sampai dengan <strong>16 November 2027</strong>, dan dapat diperpanjang atas kesepakatan tertulis PARA PIHAK.
      </p>

      <p class="no-indent" style="margin-top: 10px;">
        Demikian Perjanjian Kerja Sama ini dibuat dalam rangkap 3 (tiga) bermaterai cukup dan memiliki kekuatan hukum yang sama bagi PARA PIHAK.
      </p>

      <!-- 3 TANDA TANGAN & STEMPEL TRIPARTIT -->
      <table style="width: 100%; margin-top: 18px; text-align: center; font-size: 8.8pt; border-collapse: collapse;">
        <tr>
          <td style="width: 33.3%; vertical-align: top;">
            <strong>PIHAK KESATU (INDUSTRI)</strong><br>
            PT Skillance Digital Indonesia
            <div style="position: relative; height: 65px; margin: 5px auto;">
              <img src="../../assets/img/stempel_skillance_navy.png" style="position: absolute; left: 20%; top: -2px; height: 68px; opacity: 0.85;">
              <img src="../../assets/img/ttd-muh-arsyad-ramsi.png" style="position: absolute; left: 10%; top: 4px; height: 56px;">
            </div>
            <strong><u>MUH. ARSYAD RAMSI</u></strong><br>
            Direktur Utama
          </td>
          <td style="width: 33.3%; vertical-align: top;">
            <strong>PIHAK KEDUA (ORMAWA)</strong><br>
            UKM Multimedia Study Club (MSC)
            <div style="position: relative; height: 65px; margin: 5px auto; display: flex; align-items: center; justify-content: center;">
              <span style="font-family: 'Brush Script MT', cursive; font-size: 20pt; color: #1e3a8a;">Fadel Al-Farizi</span>
            </div>
            <strong><u>MUH. FADEL AL-FARIZI</u></strong><br>
            Ketua Umum UKM MSC
          </td>
          <td style="width: 33.3%; vertical-align: top;">
            <strong>PIHAK KETIGA (FAKULTAS)</strong><br>
            FTI USN Kolaka
            <div style="position: relative; height: 65px; margin: 5px auto; display: flex; align-items: center; justify-content: center;">
              <div style="border: 1px dashed #cbd5e1; border-radius: 6px; padding: 4px 8px; font-size: 7.5pt; color: #64748b;">
                Tanda Tangan & Cap Fakultas
              </div>
            </div>
            <strong><u>Dr. Ir. Suharman, S.T., M.Kom.</u></strong><br>
            Wakil Dekan Bid. Kemahasiswaan
          </td>
        </tr>
      </table>

    </div>
  </main>
  <?php endif; ?>

</body>
</html>
