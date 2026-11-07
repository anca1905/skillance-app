<?php
require_once __DIR__ . '/config/config.php';

$adminWa = "6282291700778"; // Nomor WhatsApp Skillance untuk kemitraan kampus

// Master SEO Configuration
$seoTitle = 'Kemitraan Kampus, Fakultas & UKM Mahasiswa - Skillance Academy';
$seoDesc = 'Inisiatif kolaborasi edukasi pemrograman antara Skillance Academy dengan institusi pendidikan tinggi, fakultas teknologi, dan komunitas mahasiswa di seluruh Indonesia.';
$seoKeywords = 'kemitraan kampus it, kerjasama fakultas ilmu komputer, ukm pemrograman, skpi kampus, skillance academy partner';
$seoOgImage = 'https://academy.skillance.cloud/assets/img/og-partner.png';
$seoCanonical = 'https://academy.skillance.cloud/partner.php';
$seoType = 'website';
$seoBreadcrumbs = [
    ['name' => 'Beranda', 'url' => 'https://academy.skillance.cloud/index.php'],
    ['name' => 'Kemitraan Kampus', 'url' => 'https://academy.skillance.cloud/partner.php']
];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- MASTER ENTERPRISE SEO & OPEN GRAPH -->
    <?php include __DIR__ . '/includes/seo_meta.php'; ?>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --navy: #0d2e5c;
            --navy-dark: #071a35;
            --gold: #fca311;
            --gold-dark: #d97706;
            --w3-green: #04AA6D;
            --w3-green-hover: #038d5a;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
            margin: 0;
            padding: 0;
        }

        .font-heading {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 800;
        }

        /* Top Hub Bar */
        .top-hub-bar {
            background-color: var(--navy-dark);
            color: #cbd5e1;
            font-size: 0.78rem;
            padding: 7px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        /* Navbar */
        
        /* Modern Clean Academy Navbar */
        .academy-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        .nav-menu-link {
            color: #475569;
            font-weight: 600;
            font-size: 0.88rem;
            padding: 8px 14px;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .nav-menu-link:hover {
            color: #0d2e5c;
            background-color: #f1f5f9;
        }

        .nav-menu-link.active {
            color: #0d2e5c;
            font-weight: 700;
            background-color: #f1f5f9;
        }

        @media (max-width: 1199.98px) {
            .nav-menu-link {
                display: flex;
                padding: 10px 14px;
                border-radius: 8px;
            }
        }

        .academy-navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 1020;
        }

        /* Subnav */
        .course-subnav {
            background-color: var(--navy);
            overflow-x: auto;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            scrollbar-width: none;
        }
        .course-subnav::-webkit-scrollbar {
            display: none;
        }
        .course-nav-item {
            display: inline-block;
            padding: 10px 18px;
            color: #cbd5e1;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: all 0.2s;
        }
        .course-nav-item:hover, .course-nav-item.active {
            color: #ffffff;
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Partner Hero */
        .partner-hero {
            background: linear-gradient(135deg, #071a35 0%, #0d2e5c 60%, #00758f 100%);
            color: white;
            padding: 65px 0 55px;
            text-align: center;
        }

        /* Benefit Cards */
        .benefit-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 28px;
            height: 100%;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }
        .benefit-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(13, 46, 92, 0.08);
            border-color: #cbd5e1;
        }

        .icon-circle {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Scheme Card */
        .scheme-card {
            background: #ffffff;
            border: 2px solid #e2e8f0;
            border-radius: 18px;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: all 0.25s ease;
        }
        .scheme-card.highlight {
            border-color: #fca311;
            box-shadow: 0 8px 30px rgba(252, 163, 17, 0.15);
        }

        /* Form Card */
        .form-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            padding: 35px;
            box-shadow: 0 4px 25px rgba(0,0,0,0.05);
        }

        @media (max-width: 768px) {
            .partner-hero {
                padding: 45px 15px 40px;
            }
            .partner-hero h1 {
                font-size: 1.75rem;
            }
            .form-card {
                padding: 22px 18px;
            }
        }
    </style>
</head>
<body>

    <?php
    $activeNav = 'partner';
    $showSubnav = false;
    include __DIR__ . '/includes/navbar.php';
    ?>

    <!-- PARTNER HERO -->
    <header class="partner-hero">
        <div class="container">
            <span class="badge bg-white bg-opacity-10 text-gold px-3 py-2 rounded-pill fw-bold mb-3 border border-warning border-opacity-25">
                <i class="fa-solid fa-handshake me-1"></i> Campus & Student Organization Partnership
            </span>
            <h1 class="display-6 fw-bold font-heading mb-3 text-white">Kolaborasi Kampus, BEM & Himpunan Mahasiswa</h1>
            <p class="lead mx-auto mb-4" style="max-width: 760px; color: #cbd5e1; font-size: 1.02rem; line-height: 1.8;">
                Tingkatkan kompetensi digital mahasiswa di kampus Anda tanpa repot menyusun kurikulum dari nol. <strong>Skillance Academy</strong> siap menjadi mitra strategis penyelenggaraan <strong>Workshop Koding, Sertifikasi SKPI Resmi, dan Program Kerja Ormawa</strong> dengan sistem bagi hasil kas organisasi yang transparan!
            </p>

            <div class="d-flex flex-wrap justify-content-center gap-3">
                <a href="#formKemitraan" class="btn btn-warning btn-lg fw-bold px-4 py-3 rounded-pill text-navy shadow">
                    <i class="fa-solid fa-paper-plane me-2"></i> Ajukan Kolaborasi Sekarang &raquo;
                </a>
                <a href="proposal.php" class="btn btn-outline-light btn-lg fw-bold px-4 py-3 rounded-pill">
                    <i class="fa-solid fa-file-pdf me-2 text-warning"></i> Download Proposal Resmi (PDF)
                </a>
                <a href="https://wa.me/<?= $adminWa ?>?text=Halo%20Admin%20Skillance,%20saya%20pengurus%20UKM/Himpunan%20ingin%20konsultasi%20kerja%20sama%20event%20koding." target="_blank" class="btn btn-outline-light btn-lg fw-bold px-4 py-3 rounded-pill">
                    <i class="fa-brands fa-whatsapp me-2 fs-5 text-success"></i> Konsultasi via WhatsApp
                </a>
            </div>
        </div>
    </header>

    <main class="container py-5">

        <!-- WHY PARTNER WITH US -->
        <div class="text-center mb-5 mx-auto" style="max-width: 680px;">
            <h2 class="fw-bold text-navy font-heading">Keuntungan Kemitraan Bersama Skillance Academy</h2>
            <p class="text-muted">Solusi terintegrasi untuk membantu pengurus BEM, Himpunan Mahasiswa (HIMA-TI, HIMASISFO, dsb), dan UKM IT mencapai target proker tahunan.</p>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-3">
                <div class="benefit-card text-center">
                    <div class="icon-circle bg-primary bg-opacity-10 text-primary mx-auto">
                        <i class="fa-solid fa-file-shield"></i>
                    </div>
                    <h5 class="fw-bold text-navy font-heading mb-2">Sertifikat SKPI Berbarcode</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">
                        Setiap peserta workshop mendapatkan sertifikat resmi ber-QR Code yang terdaftar di database online untuk lampiran SKPI wisuda.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="benefit-card text-center">
                    <div class="icon-circle bg-success bg-opacity-10 text-success mx-auto">
                        <i class="fa-solid fa-hand-holding-dollar"></i>
                    </div>
                    <h5 class="fw-bold text-navy font-heading mb-2">Bagi Hasil Kas UKM</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">
                        Sistem revenue sharing hingga <strong>40% – 50%</strong> dari tiket workshop langsung masuk kas organisasi untuk mendanai kegiatan mahasiswa.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="benefit-card text-center">
                    <div class="icon-circle bg-warning bg-opacity-10 text-warning mx-auto">
                        <i class="fa-solid fa-laptop-code"></i>
                    </div>
                    <h5 class="fw-bold text-navy font-heading mb-2">Kurikulum & Lab Siap Pakai</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">
                        Panitia tidak perlu pusing mencari modul. Skillance menyediakan 931 materi, editor interaktif di browser, dan instruktur berpengalaman.
                    </p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="benefit-card text-center">
                    <div class="icon-circle bg-danger bg-opacity-10 text-danger mx-auto">
                        <i class="fa-solid fa-briefcase"></i>
                    </div>
                    <h5 class="fw-bold text-navy font-heading mb-2">Akses Bursa Freelance</h5>
                    <p class="text-muted small mb-0" style="line-height: 1.6;">
                        Peserta terbaik langsung direkomendasikan menangani proyek pembuatan web/aplikasi di platform <strong>Skillance Freelance</strong>.
                    </p>
                </div>
            </div>
        </div>

        <!-- 3 COLLABORATION SCHEMES -->
        <div class="text-center mb-5 mt-5 mx-auto" style="max-width: 650px;">
            <span class="badge bg-navy text-white px-3 py-2 rounded-pill fw-bold text-uppercase mb-2" style="background: #0d2e5c;">Skema Kerjasama</span>
            <h2 class="fw-bold text-navy font-heading">3 Pilihan Bentuk Kolaborasi</h2>
            <p class="text-muted">Pilih skema yang paling sesuai dengan kebutuhan proker atau kurikulum di kampus Anda.</p>
        </div>

        <div class="row g-4 mb-5">
            
            <!-- SCHEME 1 -->
            <div class="col-lg-4">
                <div class="scheme-card highlight">
                    <div class="p-4 bg-navy text-white" style="background: #0d2e5c;">
                        <span class="badge bg-warning text-navy fw-bold px-3 py-1 rounded-pill small mb-2">Paling Populer</span>
                        <h4 class="fw-bold text-white font-heading mb-1">Co-Branded Workshop</h4>
                        <p class="small text-white-50 mb-0">Penyelenggaraan workshop / bootcamp hands-on 1-2 hari.</p>
                    </div>
                    <div class="p-4 flex-grow-1 d-flex flex-column justify-content-between">
                        <div>
                            <p class="small text-muted mb-3" style="line-height: 1.7;">
                                Skillance menyediakan materi studi kasus nyata (Web Desa / Aplikasi Kasir POS / Toko Online), instruktur, dan sistem sertifikat. UKM bertindak sebagai *Host Organizer* di kampus.
                            </p>
                            <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-check-circle text-success me-1"></i> Apa yang Diperoleh UKM?</h6>
                            <ul class="list-unstyled small text-secondary mb-4 ps-1" style="line-height: 1.8;">
                                <li>✓ Bagi hasil pendaftaran tiket <strong>40% - 50%</strong></li>
                                <li>✓ Logo UKM tercetak di e-sertifikat resmi SKPI</li>
                                <li>✓ Seluruh peserta dapat modul & source code proyek</li>
                                <li>✓ Gratis biaya kerjasama awal (Zero Capital)</li>
                            </ul>
                        </div>
                        <a href="#formKemitraan" class="btn btn-navy fw-bold w-100 py-2 rounded-pill text-white" style="background: #0d2e5c;">
                            Pilih Skema Ini &raquo;
                        </a>
                    </div>
                </div>
            </div>

            <!-- SCHEME 2 -->
            <div class="col-lg-4">
                <div class="scheme-card">
                    <div class="p-4 bg-light border-bottom">
                        <span class="badge bg-secondary text-white fw-bold px-3 py-1 rounded-pill small mb-2">Individu Mahasiswa</span>
                        <h4 class="fw-bold text-navy font-heading mb-1">Campus Ambassador</h4>
                        <p class="small text-muted mb-0">Program Duta Kampus untuk aktivis & pengurus mahasiswa.</p>
                    </div>
                    <div class="p-4 flex-grow-1 d-flex flex-column justify-content-between">
                        <div>
                            <p class="small text-muted mb-3" style="line-height: 1.7;">
                                Menjadi perwakilan resmi Skillance di kampus untuk mempromosikan materi koding dan project kit kepada teman-teman satu angkatan dan jurusan.
                            </p>
                            <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-check-circle text-success me-1"></i> Apa yang Diperoleh Ambassador?</h6>
                            <ul class="list-unstyled small text-secondary mb-4 ps-1" style="line-height: 1.8;">
                                <li>✓ Komisi finansial <strong>25% – 30%</strong> per transaksi referral</li>
                                <li>✓ Sertifikat Magang / Perwakilan Resmi Kampus</li>
                                <li>✓ Akses gratis seluruh E-Book & Project Kit Skillance</li>
                                <li>✓ Bimbingan karier & koneksi proyek freelance</li>
                            </ul>
                        </div>
                        <a href="#formKemitraan" class="btn btn-outline-navy fw-bold w-100 py-2 rounded-pill text-navy" style="border-color: #0d2e5c;">
                            Daftar Jadi Ambassador &raquo;
                        </a>
                    </div>
                </div>
            </div>

            <!-- SCHEME 3 -->
            <div class="col-lg-4">
                <div class="scheme-card">
                    <div class="p-4 bg-light border-bottom">
                        <span class="badge bg-secondary text-white fw-bold px-3 py-1 rounded-pill small mb-2">Prodi & Laboratorium</span>
                        <h4 class="fw-bold text-navy font-heading mb-1">MoU Mitra Praktikum</h4>
                        <p class="small text-muted mb-0">Integrasi modul kurikulum praktikum lab pemrograman.</p>
                    </div>
                    <div class="p-4 flex-grow-1 d-flex flex-column justify-content-between">
                        <div>
                            <p class="small text-muted mb-3" style="line-height: 1.7;">
                                Kerjasama bersama Ketua Program Studi atau Kepala Lab Komputer untuk memanfaatkan modul materi Skillance sebagai panduan ajar praktikum pemrograman web.
                            </p>
                            <h6 class="fw-bold text-navy small mb-2"><i class="fa-solid fa-check-circle text-success me-1"></i> Manfaat bagi Laboratorium:</h6>
                            <ul class="list-unstyled small text-secondary mb-4 ps-1" style="line-height: 1.8;">
                                <li>✓ Dosen & asisten lab tidak perlu mengetik modul dari nol</li>
                                <li>✓ Mahasiswa bisa praktikum tanpa instalasi rumit</li>
                                <li>✓ Ujian evaluasi otomatis dengan rekap nilai</li>
                                <li>✓ Surat Perjanjian Kerjasama (MoU) resmi</li>
                            </ul>
                        </div>
                        <a href="#formKemitraan" class="btn btn-outline-navy fw-bold w-100 py-2 rounded-pill text-navy" style="border-color: #0d2e5c;">
                            Ajukan Kerjasama Lab &raquo;
                        </a>
                    </div>
                </div>
            </div>

        </div>

        <!-- SECTION: PROPOSAL & SURAT PENGANTAR RESMI (DOWNLOAD / CETAK) -->
        <div class="p-4 p-md-5 rounded-4 text-white mt-5 shadow-lg position-relative overflow-hidden" style="background: linear-gradient(135deg, #071a35 0%, #0d2e5c 65%, #04AA6D 100%);">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-gold text-navy fw-bold px-3 py-2 rounded-pill mb-2 text-uppercase" style="background-color: #fca311 !important; color: #071a35 !important;">
                        <i class="fa-solid fa-file-contract me-1"></i> Berkas Resmi Siap Bawa
                    </span>
                    <h2 class="display-6 fw-bold font-heading mb-2 text-white">Butuh Proposal untuk Rapat BEM / Dosen Pembina?</h2>
                    <p class="text-white-50 mb-3" style="font-size: 0.98rem; line-height: 1.8;">
                        Pengurus ormawa tidak perlu repot menyusun dokumen proposal dari nol. Kami telah menyiapkan <strong>Surat Pengantar Resmi ber-Kop Surat Skillance Digital Indonesia</strong>, rincian silabus workshop siap pakai, dan simulasi pembagian hasil kas ormawa 50:50 yang dapat langsung Anda cetak atau simpan sebagai PDF!
                    </p>
                    <div class="d-flex flex-wrap gap-2 text-white-50 small mb-4 mb-lg-0">
                        <span class="badge bg-white bg-opacity-10 border border-white border-opacity-25 rounded-pill px-3 py-1"><i class="fa-solid fa-stamp text-warning me-1"></i> Kop & Stempel Resmi</span>
                        <span class="badge bg-white bg-opacity-10 border border-white border-opacity-25 rounded-pill px-3 py-1"><i class="fa-solid fa-list-check text-info me-1"></i> Silabus 4 Topik Unggulan</span>
                        <span class="badge bg-white bg-opacity-10 border border-white border-opacity-25 rounded-pill px-3 py-1"><i class="fa-solid fa-calculator text-success me-1"></i> Simulasi Bagi Hasil 50%</span>
                        <span class="badge bg-white bg-opacity-10 border border-white border-opacity-25 rounded-pill px-3 py-1"><i class="fa-solid fa-print text-white me-1"></i> Format Standar Cetak A4</span>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="proposal.php" class="btn btn-warning btn-lg fw-bold px-4 py-3 rounded-pill text-navy shadow w-100 mb-2">
                        <i class="fa-solid fa-file-pdf fs-5 me-1 text-danger"></i> Buka Proposal Resmi (PDF) &raquo;
                    </a>
                    <small class="d-block text-white-50 text-center" style="font-size: 0.75rem;">*Bisa disesuaikan dengan nama kampus & ormawa Anda</small>
                </div>
            </div>
        </div>

        <!-- FORM INTERAKTIF PENGAJUAN KEMITRAAN -->
        <div id="formKemitraan" class="form-card mt-5">
            <div class="row g-4 align-items-center">
                <div class="col-lg-5">
                    <span class="badge bg-gold text-navy fw-bold px-3 py-1 rounded-pill mb-2 text-uppercase" style="background-color: #fca311 !important; color: #071a35 !important;">Formulir Kolaborasi</span>
                    <h3 class="fw-bold text-navy font-heading mb-3">Siap Mengadakan Event Koding di Kampus Anda?</h3>
                    <p class="text-muted small mb-4" style="line-height: 1.8;">
                        Isi formulir di samping untuk mendiskusikan jadwal, topik materi studi kasus, dan pembagian hasil kas organisasi. Tim kemitraan Skillance Academy akan menghubungi Anda via WhatsApp dalam waktu maksimal 1x24 jam.
                    </p>
                    
                    <div class="p-3 rounded-3 bg-light border mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <i class="fa-brands fa-whatsapp fs-2 text-success"></i>
                            <div>
                                <small class="text-muted d-block fw-semibold">Narahubung Cepat Kemitraan:</small>
                                <strong class="text-navy">+62 822-9170-0778 (Admin Kemitraan)</strong>
                            </div>
                        </div>
                    </div>

                    <div class="small text-muted">
                        <i class="fa-solid fa-circle-check text-success me-1"></i> Surat Pengantar & Proposal Resmi Siap Diberikan.
                    </div>
                </div>

                <div class="col-lg-7">
                    <form id="partnerForm" onsubmit="submitPartnerForm(event)" class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-navy">Nama Kampus / Universitas <span class="text-danger">*</span></label>
                            <input type="text" id="pCampus" class="form-control" placeholder="Contoh: Universitas Hasanuddin" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-navy">Nama Organisasi / UKM <span class="text-danger">*</span></label>
                            <input type="text" id="pOrg" class="form-control" placeholder="Contoh: HIMA-TI / BEM Fasilkom" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-navy">Nama Lengkap PIC / Ketua <span class="text-danger">*</span></label>
                            <input type="text" id="pName" class="form-control" placeholder="Nama Narahubung" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-navy">No. WhatsApp Aktif <span class="text-danger">*</span></label>
                            <input type="tel" id="pWa" class="form-control" placeholder="08xxxxxxxxxx" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-navy">Bentuk Kerjasama yang Diinginkan</label>
                            <select id="pScheme" class="form-select">
                                <option value="Co-Branded Workshop Koding">Co-Branded Workshop Koding</option>
                                <option value="Campus Ambassador">Pendaftaran Campus Ambassador</option>
                                <option value="MoU Praktikum Lab / Jurusan">MoU Praktikum Lab / Jurusan</option>
                                <option value="Sponsorship Lomba / Event IT">Sponsorship Lomba / Event IT</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold text-navy">Estimasi Peserta / Anggota</label>
                            <select id="pParticipants" class="form-select">
                                <option value="30 - 50 Peserta">30 - 50 Peserta</option>
                                <option value="50 - 100 Peserta">50 - 100 Peserta</option>
                                <option value="100 - 200+ Peserta">100 - 200+ Peserta</option>
                                <option value="Belum Ditentukan">Belum Ditentukan</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label small fw-bold text-navy">Catatan Tambahan / Tanggal Rencana Kegiatan</label>
                            <textarea id="pNotes" class="form-control" rows="3" placeholder="Tuliskan topik studi kasus yang diinginkan atau rencana jadwal event..."></textarea>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-warning btn-lg fw-bold w-100 rounded-pill text-navy shadow-sm">
                                <i class="fa-brands fa-whatsapp me-2 fs-5"></i> Kirim Pengajuan via WhatsApp &raquo;
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <!-- FOOTER -->
    <footer class="py-4 bg-white border-top text-center text-muted small mt-5">
        <div class="container">
            <p class="mb-1 fw-semibold">&copy; <?= date('Y') ?> <strong>Skillance Academy Indonesia</strong> — Kolaborasi Ekosistem Talenta Digital Kampus.</p>
            <p class="mb-0 text-muted" style="font-size: 0.75rem;">Mendukung percepatan literasi teknologi mahasiswa Indonesia menuju talenta siap industri.</p>
        </div>
    </footer>

    <script>
        function submitPartnerForm(e) {
            e.preventDefault();
            const campus = document.getElementById('pCampus').value.trim();
            const org = document.getElementById('pOrg').value.trim();
            const name = document.getElementById('pName').value.trim();
            const wa = document.getElementById('pWa').value.trim();
            const scheme = document.getElementById('pScheme').value;
            const participants = document.getElementById('pParticipants').value;
            const notes = document.getElementById('pNotes').value.trim();

            const text = `Halo Tim Kemitraan Skillance Academy!\n\nSaya ingin mengajukan kerja sama kemitraan kampus:\n- *Kampus:* ${campus}\n- *Organisasi/UKM:* ${org}\n- *Narahubung:* ${name}\n- *WhatsApp:* ${wa}\n- *Bentuk Kolaborasi:* ${scheme}\n- *Estimasi Peserta:* ${participants}\n- *Catatan/Rencana:* ${notes || '-'}\n\nMohon info dan jadwal diskusi tindak lanjutnya. Terima kasih!`;
            
            const targetUrl = `https://wa.me/<?= $adminWa ?>?text=` + encodeURIComponent(text);
            window.open(targetUrl, '_blank');

            const propUrl = `proposal.php?campus=` + encodeURIComponent(campus) + `&org=` + encodeURIComponent(org) + `&pic=` + encodeURIComponent(name);
            setTimeout(() => {
                if (confirm("Pesan WhatsApp telah disiapkan! Apakah Anda ingin langsung membuka Surat Pengantar & Proposal Resmi bertuliskan nama kampus/organisasi Anda?")) {
                    window.location.href = propUrl;
                }
            }, 600);
        }
    </script>
<?php include_once __DIR__ . '/includes/spotlight_modal.php'; ?>
<script src="assets/js/spotlight.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
