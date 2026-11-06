<?php
require_once __DIR__ . '/config/config.php';

$campus = trim($_GET['campus'] ?? '');
$org = trim($_GET['org'] ?? '');
$pic = trim($_GET['pic'] ?? '');

$recipientCampus = $campus ?: 'Perguruan Tinggi / Universitas Mitra';
$recipientOrg = $org ?: 'Pengurus BEM / Himpunan Mahasiswa / UKM IT';
$recipientPic = $pic ?: 'Ketua / PIC Kemahasiswaan';

$refNumber = 'SKL/EXT-KAMPUS/' . date('Y') . '/' . date('m') . '/' . rand(100, 999);
$letterDate = date('d F Y');

$adminWa = "62895325697419";
$waMsg = urlencode("Halo Admin Kemitraan Skillance Academy, kami dari {$recipientOrg} ({$recipientCampus}) ingin mendiskusikan proposal workshop koding & sertifikasi SKPI.");
$waUrl = "https://wa.me/{$adminWa}?text={$waMsg}";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Proposal Resmi Kerjasama Workshop & Sertifikasi SKPI - Skillance Academy</title>
    
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
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }

        /* Top Sticky Toolbar */
        .proposal-toolbar {
            position: sticky;
            top: 0;
            z-index: 1030;
            background: #ffffff;
            border-bottom: 2px solid #e2e8f0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
        }

        /* Paper Document Layout (A4 format) */
        .a4-page {
            max-width: 860px;
            margin: 25px auto;
            background: #ffffff;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
            border-radius: 6px;
            padding: 55px 65px;
            border: 1px solid #e2e8f0;
            position: relative;
        }

        @media (max-width: 768px) {
            .a4-page {
                padding: 30px 20px;
                margin: 15px auto;
            }
        }

        /* Kop Surat Resmi */
        .kop-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-bottom: 16px;
            border-bottom: 4px double #0d2e5c;
            margin-bottom: 25px;
        }

        .kop-logo-box {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .kop-icon {
            width: 58px;
            height: 58px;
            background: var(--navy);
            color: var(--gold);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .kop-company-title {
            font-family: 'Cinzel', serif;
            font-weight: 800;
            color: var(--navy);
            font-size: 1.35rem;
            letter-spacing: 1px;
            line-height: 1.15;
            margin-bottom: 3px;
        }

        .kop-sub {
            font-size: 0.72rem;
            color: #475569;
            line-height: 1.4;
        }

        /* Section Headings */
        .doc-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
            color: var(--navy);
            text-transform: uppercase;
            font-size: 1.15rem;
            letter-spacing: 0.5px;
            margin-bottom: 15px;
            padding-bottom: 6px;
            border-bottom: 2px solid #e2e8f0;
        }

        .font-signature {
            font-family: 'Great Vibes', cursive;
            font-size: 2.3rem;
            color: var(--navy);
            line-height: 1;
        }

        /* Digital Stamp */
        .digital-stamp {
            border: 2px solid #dc2626;
            color: #dc2626;
            border-radius: 50%;
            width: 100px;
            height: 100px;
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            transform: rotate(-12deg);
            opacity: 0.85;
            font-weight: 800;
            line-height: 1.1;
            padding: 8px;
            position: absolute;
            bottom: 45px;
            left: 55px;
            pointer-events: none;
        }

        /* Print styles */
        @media print {
            .proposal-toolbar, .no-print {
                display: none !important;
            }
            body {
                background: #ffffff !important;
            }
            .a4-page {
                box-shadow: none !important;
                border: none !important;
                margin: 0 auto !important;
                max-width: 100% !important;
                padding: 15mm 15mm !important;
            }
            .page-break {
                page-break-after: always;
                break-after: page;
            }
        }
    </style>
</head>
<body>

    <!-- TOP FLOATING TOOLBAR -->
    <header class="proposal-toolbar py-2 px-3 no-print">
        <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center gap-2">
            <div class="d-flex align-items-center gap-2">
                <a href="partner.php" class="btn btn-outline-secondary btn-sm rounded-pill">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Halaman Kemitraan
                </a>
                <span class="badge bg-navy text-white rounded-pill px-3 py-1 fw-bold small" style="background: #0d2e5c;">
                    <i class="fa-solid fa-file-contract me-1 text-gold"></i> DOKUMEN PROPOSAL & SURAT PENGANTAR RESMI
                </span>
            </div>

            <div class="d-flex align-items-center gap-2 ms-auto">
                <button class="btn btn-outline-navy btn-sm rounded-pill fw-bold px-3" data-bs-toggle="modal" data-bs-target="#editRecipientModal" style="border-color: #0d2e5c; color: #0d2e5c;">
                    <i class="fa-solid fa-pen-to-square me-1"></i> Sesuaikan Nama Kampus / Ormawa
                </button>
                <button onclick="window.print()" class="btn btn-navy text-white btn-sm rounded-pill fw-bold px-3" style="background: #0d2e5c;">
                    <i class="fa-solid fa-print me-1 text-gold"></i> Cetak / Simpan PDF (A4)
                </button>
                <a href="<?= $waUrl ?>" target="_blank" class="btn btn-success btn-sm rounded-pill fw-bold px-3 shadow-sm">
                    <i class="fa-brands fa-whatsapp fs-6 me-1"></i> Hubungi Tim Kemitraan
                </a>
            </div>
        </div>
    </header>

    <!-- LEMBAR 1: SURAT PENGANTAR RESMI (COVER LETTER) -->
    <article class="a4-page page-break">
        
        <!-- KOP SURAT -->
        <div class="kop-header">
            <div class="kop-logo-box">
                <div class="kop-icon">
                    <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div>
                    <div class="kop-company-title">SKILLANCE DIGITAL INDONESIA</div>
                    <div class="fw-bold text-navy" style="font-size: 0.85rem; letter-spacing: 0.5px;">SKILLANCE ACADEMY — PUSAT PENGEMBANGAN TALENTA DIGITAL</div>
                    <div class="kop-sub mt-1">
                        Jl. H. Supu Yusuf No. 18, Kendari, Sulawesi Tenggara &bull; WhatsApp: +62 895-3256-97419<br>
                        Portal Resmi: <strong>academy.skillance.cloud</strong> &bull; Website: <strong>skillance.my.id</strong>
                    </div>
                </div>
            </div>
            <div class="text-end d-none d-sm-block">
                <span class="badge bg-light text-navy border px-2 py-1 small fw-bold">DOKUMEN RESMI</span>
                <div class="small text-muted mt-1" style="font-size: 0.72rem;">Lampiran SKPI & Kolaborasi</div>
            </div>
        </div>

        <!-- INFO SURAT -->
        <div class="row mb-4" style="font-size: 0.9rem;">
            <div class="col-sm-7">
                <table class="table-borderless" style="line-height: 1.6;">
                    <tr>
                        <td style="width: 100px;">Nomor</td>
                        <td style="width: 15px;">:</td>
                        <td><strong><?= htmlspecialchars($refNumber) ?></strong></td>
                    </tr>
                    <tr>
                        <td>Lampiran</td>
                        <td>:</td>
                        <td>1 (Satu) Berkas Proposal Kerjasama & Silabus</td>
                    </tr>
                    <tr>
                        <td>Perihal</td>
                        <td>:</td>
                        <td><strong>Penawaran Kerjasama Workshop Koding & Sertifikasi SKPI Mahasiswa</strong></td>
                    </tr>
                </table>
            </div>
            <div class="col-sm-5 text-sm-end mt-2 mt-sm-0">
                <span>Kendari, <?= $letterDate ?></span>
            </div>
        </div>

        <!-- RECIPIENT -->
        <div class="mb-4" style="font-size: 0.9rem; line-height: 1.7;">
            Kepada Yth.<br>
            <strong><?= htmlspecialchars($recipientPic) ?></strong><br>
            <strong><?= htmlspecialchars($recipientOrg) ?></strong><br>
            <?= htmlspecialchars($recipientCampus) ?><br>
            Di Tempat
        </div>

        <!-- BODY SURAT -->
        <div style="font-size: 0.92rem; line-height: 1.85; text-align: justify; color: #334155;">
            <p>Dengan hormat,</p>
            <p>
                Sehubungan dengan program peningkatan kompetensi praktis mahasiswa dalam bidang teknologi informasi serta pemenuhan <strong>Indikator Kinerja Utama (IKU) Perguruan Tinggi</strong> dan kelengkapan <strong>Surat Keterangan Pendamping Ijazah (SKPI)</strong>, bersama surat ini kami dari <strong>Skillance Digital Indonesia</strong> (melalui divisi edukasi <strong>Skillance Academy</strong>) bermaksud mengajukan penawaran kerjasama penyelenggaraan kegiatan:
            </p>
            
            <div class="p-3 my-3 rounded-3 bg-light border text-center">
                <strong class="d-block text-navy font-heading" style="font-size: 1.05rem;">
                    "WORKSHOP KODING INTENSIF & UJIAN SERTIFIKASI KOMPETENSI DIGITAL MAHASISWA"
                </strong>
                <span class="text-muted small">Program Kolaborasi Peningkatan Keahlian Siap Kerja Berbasis Studi Kasus Nyata Industri</span>
            </div>

            <p>
                Melalui kerjasama ini, Skillance Academy berkomitmen penuh menjadi mitra strategis organisasi kemahasiswaan dengan memberikan dukungan berupa:
            </p>
            <ol style="margin-left: -10px; margin-bottom: 15px;">
                <li><strong>Pemateri Praktisi Industri:</strong> Senior Software Engineer & Trainer bersertifikasi tanpa membebankan biaya awal bagi ormawa.</li>
                <li><strong>Modul & Source Code Eksklusif:</strong> Akses penuh E-Book panduan komprehensif (140-185 halaman PDF) serta repositori source code siap pakai.</li>
                <li><strong>Sertifikat Resmi Ber-QR Code:</strong> Diterbitkan langsung dan tercatat resmi dalam basis data online Skillance Academy untuk lampiran SKPI yang valid diverifikasi pihak kampus dan rekruter kerja.</li>
                <li><strong>Sistem Bagi Hasil Kas Ormawa 50%:</strong> Skema pendapatan transparan 50% tiket masuk kas himpunan/BEM untuk mendanai program kerja ormawa.</li>
            </ol>

            <p>
                Sebagai bahan pertimbangan Bapak/Ibu Dosen Pembina dan Rekan Pengurus Ormawa, terlampir kami sertakan <em>Executive Summary</em>, rincian silabus materi, dan simulasi pembagian hasil kas kegiatan.
            </p>
            <p>
                Demikian surat penawaran ini kami sampaikan. Besar harapan kami agar sinergi positif ini dapat terlaksana demi mencetak lulusan perguruan tinggi yang cakap, berdaya saing global, dan siap berkarier di industri digital. Atas perhatian dan kerjasamanya, kami haturkan terima kasih.
            </p>
        </div>

        <!-- TANDA TANGAN & STEMPEL -->
        <div class="row align-items-end mt-4 pt-2 position-relative">
            <div class="col-6">
                <!-- Stempel Digital -->
                <div class="digital-stamp">
                    <span style="font-size: 0.65rem;">SKILLANCE</span>
                    <i class="fa-solid fa-stamp my-1" style="font-size: 1rem;"></i>
                    <span style="font-size: 0.55rem; letter-spacing: 0.5px;">RESMI &bull; VERIFIED</span>
                </div>
            </div>
            <div class="col-6 text-end">
                <div class="small text-muted mb-1">Hormat kami,</div>
                <div class="fw-bold text-navy" style="font-size: 0.85rem;">Skillance Digital Indonesia</div>
                
                <div class="d-flex align-items-center justify-content-end my-2" style="height: 65px;">
                    <img src="assets/img/ttd-muh-arsyad-ramsi.png" alt="Tanda Tangan Muh Arsyad Ramsi" style="max-height: 65px; max-width: 150px; object-fit: contain;">
                </div>

                <div class="fw-bold text-dark" style="font-size: 0.92rem; border-top: 1px solid #94a3b8; display: inline-block; padding-top: 3px; min-width: 220px;">
                    Muh Arsyad Ramsi
                </div>
                <small class="d-block text-muted" style="font-size: 0.78rem;">Head of Technology & Academy Partnership</small>
                <small class="d-block text-muted" style="font-size: 0.72rem;">Narahubung: +62 895-3256-97419</small>
            </div>
        </div>

    </article>

    <!-- LEMBAR 2: EXECUTIVE SUMMARY & PILIHAN SILABUS WORKSHOP -->
    <article class="a4-page page-break">
        
        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-book-bookmark text-warning fs-5"></i>
                <span class="fw-bold text-navy" style="font-size: 0.9rem;">LAMPIRAN I: EXECUTIVE SUMMARY & SILABUS</span>
            </div>
            <span class="text-muted small" style="font-size: 0.75rem;">Proposal Kerjasama &bull; Skillance Academy</span>
        </div>

        <h3 class="doc-title">Pilihan Paket Workshop Koding Populer Kampus</h3>
        <p class="text-muted small mb-4" style="line-height: 1.7;">
            Ormawa dapat memilih 1 (satu) atau beberapa topik spesialisasi di bawah ini sesuai dengan minat mahasiswa jurusan dan kebutuhan kurikulum kampus:
        </p>

        <!-- PILIHAN 1: SIDESA FULLSTACK -->
        <div class="p-3 rounded-3 border mb-3 bg-white shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="badge bg-primary text-white fw-bold px-2 py-1 small">Paket A: Favorit Skripsi & Portofolio</span>
                <span class="badge bg-light text-dark border small">Format: 2 Hari Intensif (Total 8 Jam)</span>
            </div>
            <h5 class="fw-bold text-navy mb-1" style="font-size: 1.05rem;">Membangun Sistem Informasi Desa Mandiri (SIDESA) & E-Gov</h5>
            <p class="text-muted small mb-2">
                <strong>Tech Stack:</strong> Laravel 11, Inertia.js, Vue.js 3, Tailwind CSS & DomPDF.
            </p>
            <div class="small text-secondary ps-3 border-start border-3 border-primary" style="line-height: 1.6;">
                <div>&bull; <strong>Sesi 1:</strong> Analisis Kebutuhan Sistem E-Gov Desa, Normalisasi ERD Database, dan Setup Laravel 11 + Vue 3 SPA.</div>
                <div>&bull; <strong>Sesi 2:</strong> Autentikasi Multi-Role, Manajemen Kependudukan, & Pembuatan Surat Online Mandiri.</div>
                <div>&bull; <strong>Sesi 3:</strong> Generator Dokumen PDF Resmi ber-QR Code dan Infografis APBDes dengan Chart.js.</div>
                <div>&bull; <strong>Sesi 4:</strong> Simulasi Pengujian Kelulusan & Penerbitan Sertifikat SKPI.</div>
            </div>
        </div>

        <!-- PILIHAN 2: POS KASIR THERMAL -->
        <div class="p-3 rounded-3 border mb-3 bg-white shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="badge bg-success text-white fw-bold px-2 py-1 small">Paket B: Praktis UMKM & Siap Jual</span>
                <span class="badge bg-light text-dark border small">Format: 1 Hari Praktik (Total 5 Jam)</span>
            </div>
            <h5 class="fw-bold text-navy mb-1" style="font-size: 1.05rem;">Aplikasi Kasir Pintar (POS) & Direct Bluetooth Thermal Printing</h5>
            <p class="text-muted small mb-2">
                <strong>Tech Stack:</strong> PHP 8.3, Laravel 11 REST API, Alpine.js, Web Bluetooth API & ESC/POS.
            </p>
            <div class="small text-secondary ps-3 border-start border-3 border-success" style="line-height: 1.6;">
                <div>&bull; <strong>Sesi 1:</strong> Arsitektur Layar Kasir Single-Screen & Shortcut Keyboard Checkout Cepat.</div>
                <div>&bull; <strong>Sesi 2:</strong> Integrasi Barcode Scanner (USB Hardware & Kamera Web Browser).</div>
                <div>&bull; <strong>Sesi 3:</strong> Pemrograman Cetak Struk Tanpa Dialog Browser via Bluetooth ESC/POS Commands.</div>
            </div>
        </div>

        <!-- PILIHAN 3: E-COMMERCE MIDTRANS -->
        <div class="p-3 rounded-3 border mb-4 bg-white shadow-sm">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="badge bg-warning text-dark fw-bold px-2 py-1 small">Paket C: Standar Startup & Payment Gateway</span>
                <span class="badge bg-light text-dark border small">Format: 1 - 2 Hari Praktik</span>
            </div>
            <h5 class="fw-bold text-navy mb-1" style="font-size: 1.05rem;">Integrasi Midtrans Snap (QRIS, VA Bank) & RajaOngkir Kurir</h5>
            <p class="text-muted small mb-2">
                <strong>Tech Stack:</strong> Laravel 11, Vue 3, Midtrans API Sandbox, RajaOngkir API & Webhook.
            </p>
            <div class="small text-secondary ps-3 border-start border-3 border-warning" style="line-height: 1.6;">
                <div>&bull; <strong>Sesi 1:</strong> Alur Pembayaran Digital Modern Indonesia & Setup Sandbox Credentials.</div>
                <div>&bull; <strong>Sesi 2:</strong> Implementasi Snap Popup QRIS & Virtual Account di Frontend Vue 3.</div>
                <div>&bull; <strong>Sesi 3:</strong> Validasi Asynchronous Webhook & Proteksi Keamanan Signature Key SHA-512.</div>
            </div>
        </div>

        <h4 class="doc-title">Fasilitas Lengkap untuk Seluruh Peserta</h4>
        <div class="row g-2 text-center" style="font-size: 0.85rem;">
            <div class="col-sm-3 col-6">
                <div class="p-2 border rounded-3 bg-light h-100">
                    <i class="fa-solid fa-file-pdf text-danger fs-4 mb-1"></i>
                    <div class="fw-bold text-navy">E-Book Lengkap</div>
                    <small class="text-muted">140 - 185 Halaman</small>
                </div>
            </div>
            <div class="col-sm-3 col-6">
                <div class="p-2 border rounded-3 bg-light h-100">
                    <i class="fa-brands fa-github text-dark fs-4 mb-1"></i>
                    <div class="fw-bold text-navy">Full Source Code</div>
                    <small class="text-muted">Lisensi Komersial</small>
                </div>
            </div>
            <div class="col-sm-3 col-6">
                <div class="p-2 border rounded-3 bg-light h-100">
                    <i class="fa-solid fa-certificate text-warning fs-4 mb-1"></i>
                    <div class="fw-bold text-navy">Sertifikat SKPI</div>
                    <small class="text-muted">QR Code Terdaftar</small>
                </div>
            </div>
            <div class="col-sm-3 col-6">
                <div class="p-2 border rounded-3 bg-light h-100">
                    <i class="fa-solid fa-server text-success fs-4 mb-1"></i>
                    <div class="fw-bold text-navy">Cloud Server</div>
                    <small class="text-muted">Akses Live Demo</small>
                </div>
            </div>
        </div>

    </article>

    <!-- LEMBAR 3: SKEMA BAGI HASIL 50:50 & NOTA KESEPAHAMAN (MOU) -->
    <article class="a4-page">
        
        <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
            <div class="d-flex align-items-center gap-2">
                <i class="fa-solid fa-handshake text-success fs-5"></i>
                <span class="fw-bold text-navy" style="font-size: 0.9rem;">LAMPIRAN II: SKEMA FINANSIAL & LEMBAR PERSETUJUAN</span>
            </div>
            <span class="text-muted small" style="font-size: 0.75rem;">Proposal Kerjasama &bull; Skillance Academy</span>
        </div>

        <h3 class="doc-title">Simulasi Finansial Transparan Bagi Hasil Kas Ormawa (50:50)</h3>
        <p class="text-muted small mb-3" style="line-height: 1.7;">
            Skillance Academy mengedepankan prinsip kemitraan saling menguntungkan (<em>win-win partnership</em>). <strong>Ormawa tidak dibebani modal awal sepeser pun</strong>. Pendapatan tiket peserta dibagi sama rata 50% untuk kas organisasi dan 50% untuk operasional tim pengajar.
        </p>

        <!-- TABEL SIMULASI -->
        <div class="table-responsive mb-4">
            <table class="table table-bordered table-sm align-middle text-center" style="font-size: 0.88rem;">
                <thead class="table-navy text-white" style="background: #0d2e5c;">
                    <tr>
                        <th>Jumlah Peserta</th>
                        <th>Estimasi HTM / Orang</th>
                        <th>Total Dana Masuk</th>
                        <th class="table-success text-success fw-bold">Kas BEM / Himpunan (50%)</th>
                        <th>Skillance Academy (50%)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>40 Mahasiswa</strong></td>
                        <td>Rp 50.000</td>
                        <td>Rp 2.000.000</td>
                        <td class="text-success fw-bold">Rp 1.000.000 (Kas Ormawa)</td>
                        <td>Rp 1.000.000</td>
                    </tr>
                    <tr class="table-light">
                        <td><strong>80 Mahasiswa</strong></td>
                        <td>Rp 50.000</td>
                        <td>Rp 4.000.000</td>
                        <td class="text-success fw-bold">Rp 2.000.000 (Kas Ormawa)</td>
                        <td>Rp 2.000.000</td>
                    </tr>
                    <tr>
                        <td><strong>120 Mahasiswa</strong></td>
                        <td>Rp 50.000</td>
                        <td>Rp 6.000.000</td>
                        <td class="text-success fw-bold">Rp 3.000.000 (Kas Ormawa)</td>
                        <td>Rp 3.000.000</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="row g-3 mb-4" style="font-size: 0.84rem; line-height: 1.6;">
            <div class="col-sm-6">
                <div class="p-3 border rounded-3 bg-light h-100">
                    <strong class="text-navy d-block mb-1"><i class="fa-solid fa-users text-primary me-1"></i> Tanggung Jawab Pihak Ormawa:</strong>
                    <ul class="ps-3 mb-0">
                        <li>Menyediakan laboratorium komputer / aula kampus (atau Zoom/GMeet jika webinar).</li>
                        <li>Mempublikasikan pamflet acara ke grup mahasiswa internal kampus.</li>
                        <li>Mengelola pendaftaran peserta dan absensi presensi.</li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="p-3 border rounded-3 bg-light h-100">
                    <strong class="text-navy d-block mb-1"><i class="fa-solid fa-laptop-code text-success me-1"></i> Tanggung Jawab Skillance Academy:</strong>
                    <ul class="ps-3 mb-0">
                        <li>Menyiapkan pemateri praktisi software engineer berpengalaman.</li>
                        <li>Menyediakan kurikulum, modul PDF, dan source code repositori.</li>
                        <li>Menerbitkan Sertifikat Resmi SKPI ber-QR Code unik yang aktif di basis data.</li>
                    </ul>
                </div>
            </div>
        </div>

        <h4 class="doc-title mt-4">Lembar Persetujuan Awal (Nota Kesepahaman / MoU)</h4>
        <p class="text-muted small mb-3" style="font-size: 0.82rem;">
            Tanda tangan di bawah ini menandakan kesepakatan awal untuk menjadwalkan agenda workshop koding bersama:
        </p>

        <!-- KOLOM TANDA TANGAN DUA PIHAK -->
        <div class="row text-center mt-3 pt-2" style="font-size: 0.88rem;">
            <div class="col-6">
                <div class="text-muted small mb-1">Pihak Pertama (Penyedia Program):</div>
                <strong class="text-navy">Skillance Digital Indonesia</strong>
                <div class="d-flex align-items-center justify-content-center my-2" style="height: 55px;">
                    <img src="assets/img/ttd-muh-arsyad-ramsi.png" alt="Tanda Tangan Muh Arsyad Ramsi" style="max-height: 55px; max-width: 130px; object-fit: contain;">
                </div>
                <div class="fw-bold text-dark pt-1" style="border-top: 1px solid #94a3b8; display: inline-block; min-width: 180px;">
                    Muh Arsyad Ramsi
                </div>
                <small class="d-block text-muted" style="font-size: 0.72rem;">Head of Partnership</small>
            </div>

            <div class="col-6">
                <div class="text-muted small mb-1">Pihak Kedua (Mitra Ormawa Kampus):</div>
                <strong class="text-navy"><?= htmlspecialchars($recipientOrg) ?></strong>
                <div class="my-4" style="height: 38px;"></div>
                <div class="fw-bold text-dark pt-1" style="border-top: 1px solid #94a3b8; display: inline-block; min-width: 180px;">
                    ( .................................................... )
                </div>
                <small class="d-block text-muted" style="font-size: 0.72rem;">Ketua Umum / PIC Kegiatan</small>
            </div>
        </div>

        <!-- FOOTER CONTACT -->
        <div class="mt-4 pt-3 border-top text-center text-muted small" style="font-size: 0.75rem;">
            Kontak Konfirmasi & Pengiriman Berkas: <strong>Admin Kemitraan Skillance Academy (+62 895-3256-97419)</strong> &bull; Email: <strong>partnership@skillance.my.id</strong>
        </div>

    </article>

    <!-- MODAL EDIT PENERIMA / KAMPUS -->
    <div class="modal fade no-print" id="editRecipientModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                <div class="modal-header text-white" style="background: linear-gradient(135deg, #071a35 0%, #0d2e5c 100%);">
                    <h5 class="modal-title fw-bold font-heading fs-6">Sesuaikan Identitas Kampus & Ormawa</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="proposal.php" method="GET" class="modal-body p-4">
                    <p class="text-muted small mb-3">
                        Ketik nama kampus dan organisasi Anda untuk langsung menghasilkan surat resmi yang tertuju secara spesifik:
                    </p>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-navy">Nama Perguruan Tinggi / Universitas</label>
                        <input type="text" name="campus" class="form-control" value="<?= htmlspecialchars($campus) ?>" placeholder="Contoh: Universitas Hasanuddin" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-navy">Nama Organisasi / BEM / Himpunan Mahasiswa</label>
                        <input type="text" name="org" class="form-control" value="<?= htmlspecialchars($org) ?>" placeholder="Contoh: BEM Fakultas Ilmu Komputer" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-navy">Nama PIC / Ketua / Dosen Pembina (Opsional)</label>
                        <input type="text" name="pic" class="form-control" value="<?= htmlspecialchars($pic) ?>" placeholder="Contoh: Ketua HIMA-TI & Dosen Pembina">
                    </div>
                    <button type="submit" class="btn btn-navy text-white w-100 fw-bold py-2 rounded-pill shadow-sm" style="background: #0d2e5c;">
                        <i class="fa-solid fa-arrows-rotate me-1 text-gold"></i> Perbarui Dokumen Proposal &raquo;
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
