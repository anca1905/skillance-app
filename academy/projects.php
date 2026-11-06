<?php
require_once __DIR__ . '/config/config.php';

$projects = [
    [
        'id' => 'sidesa',
        'title' => 'Sistem Informasi Desa Mandiri & Layanan Surat Warga (SIDESA)',
        'category' => 'laravel-vue',
        'badge' => 'Paling Populer',
        'badge_color' => 'bg-danger',
        'desc' => 'Panduan lengkap membangun portal kependudukan desa modern dengan layanan permohonan surat online warga, statistik APBDes interaktif, dan notifikasi WhatsApp.',
        'tech' => ['Laravel 11', 'Inertia.js', 'Vue.js 3', 'Tailwind CSS', 'MySQL'],
        'pages' => '185 Halaman PDF',
        'price_old' => 'Rp 199.000',
        'price_now' => 'Rp 79.000',
        'suitable_for' => 'Skripsi / Tugas Akhir & Proyek Freelance ke Pemerintah Desa (Pemdes)',
        'features' => [
            'Permohonan surat warga online mandiri via NIK & kode unik',
            'Tracking status pengajuan surat realtime (Diajukan, Diproses, Selesai)',
            'Export otomatis surat format resmi PDF dengan Tanda Tangan Digital & QR Code',
            'Visualisasi infografis APBDes dan data demografi kependudukan',
            'Dashboard aparatur desa untuk manajemen data penduduk & arsip',
            'Desain antarmuka modern, estetik, dan responsif mobile smartphone'
        ],
        'chapters' => [
            'Bab 1: Analisis Kebutuhan Sistem Informasi Desa & Skema Relasi Database (ERD)',
            'Bab 2: Setup Laravel 11, Inertia.js, Vue.js 3, dan Tailwind CSS',
            'Bab 3: Pembuatan Sistem Otentikasi Bertingkat (Admin Desa, Petugas, Warga)',
            'Bab 4: Modul Manajemen Kependudukan, Kartu Keluarga, dan Mutasi Warga',
            'Bab 5: Pembangunan Layanan Permohonan Surat Mandiri & Generator PDF',
            'Bab 6: Pembangunan Infografis APBDes Interaktif dengan Chart.js',
            'Bab 7: Integrasi WhatsApp Gateway untuk Notifikasi Surat Selesai',
            'Bab 8: Deployment ke VPS Ubuntu & Live Domain Production'
        ]
    ],
    [
        'id' => 'pos-kasir',
        'title' => 'Sistem Kasir Pintar (Point of Sale) & Cetak Struk Bluetooth Thermal',
        'category' => 'fullstack',
        'badge' => 'Praktis UMKM',
        'badge_color' => 'bg-success',
        'desc' => 'Membangun aplikasi kasir modern untuk toko retail dan cafe dengan scanner barcode USB/webcam, cetak struk thermal otomatis, dan laporan laba rugi.',
        'tech' => ['PHP 8.3', 'Laravel 11', 'MySQL', 'Alpine.js', 'Web Bluetooth'],
        'pages' => '150 Halaman PDF',
        'price_old' => 'Rp 179.000',
        'price_now' => 'Rp 69.000',
        'suitable_for' => 'Jual Software ke Pemilik Toko/Cafe & Portofolio Freelance',
        'features' => [
            'Kasir kilat dengan shortcut keyboard & dukungan scanner barcode',
            'Cetak struk thermal 58mm/80mm via Web Bluetooth tanpa preview dialog',
            'Manajemen inventaris, multi-kategori, dan peringatan stok menipis',
            'Laporan penjualan harian, mingguan, bulanan, dan margin laba bersih',
            'Mendukung multi-kasir dan rekap kas tutup buku harian (Shift Kasir)',
            'Dukungan transaksi tunai, QRIS, dan transfer bank'
        ],
        'chapters' => [
            'Bab 1: Konsep Arsitektur Aplikasi Kasir (POS) & Manajemen Transaksi Cepat',
            'Bab 2: Skema Database Relasional: Produk, Varian, Transaksi, dan Detail Penjualan',
            'Bab 3: Implementasi Frontend Kasir Cepat dengan Alpine.js & Tailwind CSS',
            'Bab 4: Integrasi Barcode Scanner Hardware & Kamera Web Browser',
            'Bab 5: Pemrograman Direct Printing Thermal Printer (ESC/POS & Web Bluetooth)',
            'Bab 6: Modul Manajemen Stok, Laporan Margin Laba, dan Export Excel/PDF',
            'Bab 7: Pengujian Transaksi Stres-Test dan Deployment Kasir Lokal/Cloud'
        ]
    ],
    [
        'id' => 'sarpras-kampus',
        'title' => 'Sistem Peminjaman Sarana Prasarana & Booking Ruangan Kampus',
        'category' => 'fullstack',
        'badge' => 'Favorit Skripsi',
        'badge_color' => 'bg-warning text-dark',
        'desc' => 'Aplikasi peminjaman ruangan dan perlengkapan kampus dengan kalender interaktif, validasi jadwal bentrok otomatis, dan alur persetujuan bertingkat.',
        'tech' => ['Laravel 11', 'Bootstrap 5', 'MySQL', 'FullCalendar.js', 'DomPDF'],
        'pages' => '140 Halaman PDF',
        'price_old' => 'Rp 149.000',
        'price_now' => 'Rp 59.000',
        'suitable_for' => 'Tugas Akhir / Skripsi Teknik Informatika & Sistem Informasi',
        'features' => [
            'Kalender jadwal peminjaman ruangan realtime (FullCalendar)',
            'Deteksi dan pencegahan bentrok jadwal pemakaian sarana secara otomatis',
            'Alur persetujuan bertingkat (Mahasiswa -> Pembina Ormawa -> BAAK/Sarpras)',
            'Cetak otomatis surat izin peminjaman resmi ber-QR Code',
            'Pelaporan utilisasi sarana kampus bulanan',
            'Disertai Diagram UML lengkap (Use Case, Activity, Sequence, ERD)'
        ],
        'chapters' => [
            'Bab 1: Analisis Kebutuhan Sistem Akademik & Standar Skripsi Informatika',
            'Bab 2: Desain Diagram UML (Use Case, Activity, Sequence, Class Diagram) & ERD',
            'Bab 3: Setup Project Laravel & Autentikasi Multi-Role (Mahasiswa, Dosen, Sarpras)',
            'Bab 4: Integrasi FullCalendar.js untuk Visualisasi Jadwal Ruangan Realtime',
            'Bab 5: Logika Algoritma Pengecekan Bentrok Waktu Peminjaman',
            'Bab 6: Sistem Workflow Approval Bertingkat & Notifikasi Email/WA',
            'Bab 7: Generator Surat Izin Peminjaman Format PDF Resmi'
        ]
    ],
    [
        'id' => 'ecommerce-payment',
        'title' => 'Toko Online UMKM Terintegrasi Payment Gateway (Midtrans Snap) & RajaOngkir',
        'category' => 'api-payment',
        'badge' => 'Standar Industri',
        'badge_color' => 'bg-primary',
        'desc' => 'Membangun platform e-commerce dengan checkout otomatis, integrasi QRIS, Virtual Account bank, kurir otomatis se-Indonesia, dan verifikasi webhook.',
        'tech' => ['Laravel 11', 'Vue.js 3', 'Midtrans Snap API', 'RajaOngkir API', 'Webhook'],
        'pages' => '165 Halaman PDF',
        'price_old' => 'Rp 229.000',
        'price_now' => 'Rp 89.000',
        'suitable_for' => 'Portofolio Profesional Siap Kerja & Klien Toko Online UMKM',
        'features' => [
            'Integrasi Midtrans Snap: QRIS (GoPay/ShopeePay), Virtual Account BCA, BRI, Mandiri',
            'Perhitungan ongkos kirim otomatis via RajaOngkir API (JNE, SiCepat, J&T, POS)',
            'Verifikasi status pembayaran instan via Webhook asynchronous',
            'Keranjang belanja reaktif dengan Vue.js 3 & Pinia Store',
            'Manajemen pesanan, input nomor resi, dan notifikasi status pesanan',
            'Panduan lengkap migrasi dari Sandbox ke Production'
        ],
        'chapters' => [
            'Bab 1: Fondasi Arsitektur E-Commerce Modern & Siklus Pembayaran Digital',
            'Bab 2: Setup Database Produk, Kategori, Order, dan Payment Log',
            'Bab 3: Pembuatan Keranjang Belanja Interaktif dengan Vue.js 3',
            'Bab 4: Integrasi RajaOngkir API untuk Cek Ongkir Otomatis Antar Kota',
            'Bab 5: Implementasi Midtrans Snap API (QRIS & Virtual Account)',
            'Bab 6: Pengolahan Webhook Notification & Pembaruan Status Pesanan',
            'Bab 7: Manajemen Pesanan Admin, Input Resi, dan Notifikasi Email'
        ]
    ]
];

$adminWa = "62895325697419"; // Nomor WhatsApp Skillance untuk pemesanan langsung
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog E-Book & Project Kit Siap Pakai - Skillance Academy</title>
    
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

        /* Projects Hero */
        .projects-hero {
            background: linear-gradient(135deg, #071a35 0%, #0d2e5c 60%, #00758f 100%);
            color: white;
            padding: 60px 0 50px;
            text-align: center;
            position: relative;
        }

        /* Project Cards UI/UX Redesign */
        .project-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 18px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            height: 100%;
            transition: transform 0.25s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.25s ease, border-color 0.25s ease;
            box-shadow: 0 4px 16px rgba(0,0,0,0.04);
        }
        .project-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 36px rgba(13, 46, 92, 0.12);
            border-color: #cbd5e1;
        }

        .project-header-cover {
            background: linear-gradient(135deg, #071a35 0%, #0d2e5c 100%);
            padding: 24px 26px;
            color: white;
            position: relative;
            border-bottom: 3px solid #fca311;
        }

        .suitable-box {
            background: #fffdf5;
            border: 1px solid #fde68a;
            border-radius: 10px;
            padding: 10px 14px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .tech-pill {
            background: #f1f5f9;
            color: #1e293b;
            font-size: 0.76rem;
            font-weight: 700;
            padding: 4px 10px;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
            display: inline-block;
        }

        .feature-list {
            margin: 0;
            padding: 0;
        }
        .feature-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
            font-size: 0.85rem;
            color: #475569;
            margin-bottom: 8px;
            line-height: 1.5;
        }
        .feature-item i {
            margin-top: 3px;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .price-old {
            text-decoration: line-through;
            font-size: 0.84rem;
            color: #94a3b8;
            font-weight: 600;
        }
        .price-current {
            font-size: 1.55rem;
            font-weight: 800;
            color: var(--navy);
            line-height: 1.1;
        }

        .btn-order-wa {
            background-color: #25D366;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.88rem;
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.2s;
            border: none;
            box-shadow: 0 2px 8px rgba(37, 211, 102, 0.25);
        }
        .btn-order-wa:hover {
            background-color: #1ebe5d;
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.35);
        }

        .btn-detail-action {
            background-color: #ffffff;
            color: var(--navy);
            border: 1px solid #cbd5e1;
            font-weight: 700;
            font-size: 0.88rem;
            padding: 10px 14px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.2s;
        }
        .btn-detail-action:hover {
            background-color: #f1f5f9;
            border-color: var(--navy);
            color: var(--navy);
        }

        .btn-sample-pdf {
            background-color: #fff1f2;
            border: 1px dashed #f43f5e;
            color: #e11d48;
            font-weight: 700;
            font-size: 0.84rem;
            padding: 9px 14px;
            border-radius: 10px;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            transition: all 0.2s;
            width: 100%;
        }
        .btn-sample-pdf:hover {
            background-color: #ffe4e6;
            border-color: #e11d48;
            color: #be123c;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(225, 29, 72, 0.15);
        }

        /* Filter Tabs */
        .filter-btn {
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #475569;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 8px 18px;
            border-radius: 30px;
            transition: all 0.2s;
        }
        .filter-btn:hover, .filter-btn.active {
            background: var(--navy);
            color: #ffffff;
            border-color: var(--navy);
        }

        /* Mobile Adjustments */
        @media (max-width: 768px) {
            .projects-hero {
                padding: 40px 15px 35px;
            }
            .projects-hero h1 {
                font-size: 1.7rem;
            }
            .project-card {
                margin-bottom: 20px;
            }
        }
        @media (max-width: 576px) {
            .project-header-cover {
                padding: 18px 16px;
            }
            .project-card .p-4 {
                padding: 18px 16px !important;
            }
            .price-current {
                font-size: 1.35rem;
            }
            .btn-order-wa, .btn-detail-action {
                font-size: 0.82rem;
                padding: 8px 12px;
            }
        }
    </style>
</head>
<body>

    <!-- TOP HUB BAR -->
    <div class="top-hub-bar">
        <div class="container d-flex justify-content-between align-items-center">
            <div>
                <a href="https://skillance.my.id" class="text-decoration-none text-white-50 hover-white me-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke <strong>skillance.my.id</strong>
                </a>
                <a href="https://skillance.my.id/bursa-freelance.php" class="text-decoration-none text-gold me-2 d-none d-md-inline">
                    <i class="fa-solid fa-briefcase me-1"></i> Bursa Freelance
                </a>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span class="small" style="color: #cbd5e1;"><i class="fa-solid fa-book-open text-warning me-1"></i> E-Book & Full Source Code Proyek Industri</span>
            </div>
        </div>
    </div>

    <!-- MAIN NAVBAR -->
    <nav class="navbar navbar-expand-lg academy-navbar py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
                <div class="bg-navy text-gold p-2 rounded-3 d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: #0d2e5c;">
                    <i class="fa-solid fa-graduation-cap fs-5 text-warning"></i>
                </div>
                <div>
                    <span class="fw-bold text-navy font-heading" style="font-size: 1.25rem; letter-spacing: -0.5px; color: #0d2e5c;">SKILLANCE ACADEMY</span>
                    <small class="d-block text-muted" style="font-size: 0.7rem; margin-top: -3px;">Pusat Belajar & Proyek Koding Skillance Academy Indonesia</small>
                </div>
            </a>

            <div class="d-flex align-items-center gap-2 ms-auto">
                <a href="partner.php" class="btn btn-sm btn-outline-navy rounded-pill px-3 py-2 fw-bold text-navy d-none d-sm-inline">
                    <i class="fa-solid fa-handshake me-1"></i> Kemitraan Kampus
                </a>
                <a href="verify.php" class="btn btn-sm btn-outline-secondary rounded-pill px-3 py-2 fw-bold d-none d-md-inline">
                    <i class="fa-solid fa-shield-halved text-success me-1"></i> Cek Sertifikat
                </a>
                <a href="roadmap.php" class="btn btn-sm btn-navy rounded-pill px-3 py-2 fw-bold text-white" style="background: #0d2e5c;">
                    <i class="fa-solid fa-map me-1"></i> Roadmap
                </a>
            </div>
        </div>
    </nav>

    <!-- QUICK SUBNAV -->
    <div class="course-subnav">
        <div class="container d-flex align-items-center">
            <a href="index.php" class="course-nav-item"><i class="fa-solid fa-house me-1"></i> Beranda</a>
            <a href="roadmap.php" class="course-nav-item"><i class="fa-solid fa-route me-1"></i> Roadmap Karier</a>
            <a href="projects.php" class="course-nav-item active"><i class="fa-solid fa-laptop-code me-1 text-gold"></i> Kit Studi Kasus Riil</a>
            <a href="exam.php" class="course-nav-item"><i class="fa-solid fa-award me-1"></i> Ujian Sertifikasi SKPI</a>
            <a href="my-learning.php" class="course-nav-item"><i class="fa-solid fa-user-graduate me-1"></i> Dasbor Siswa</a>
            <a href="partner.php" class="course-nav-item"><i class="fa-solid fa-building-columns me-1"></i> Kolaborasi UKM / Kampus</a>
            <a href="verify.php" class="course-nav-item"><i class="fa-solid fa-certificate me-1"></i> Cek Keaslian Sertifikat</a>
        </div>
    </div>

    <!-- PROJECTS HERO -->
    <header class="projects-hero">
        <div class="container">
            <span class="badge bg-white bg-opacity-10 text-gold px-3 py-2 rounded-pill fw-bold mb-3 border border-warning border-opacity-25">
                <i class="fa-solid fa-code me-1"></i> Project-Based Learning & Case Study
            </span>
            <h1 class="display-6 fw-bold font-heading mb-3 text-white">Katalog E-Book & Project Kit Industri</h1>
            <p class="lead mx-auto mb-4" style="max-width: 720px; color: #cbd5e1; font-size: 1rem; line-height: 1.8;">
                Bosan hanya belajar sintaks teori? Dapatkan buku panduan langkah demi langkah membangun aplikasi nyata dari nol hingga online. Disertai <strong>Full Source Code siap pakai</strong> untuk bekal skripsi, portofolio kerja, atau dijual langsung ke klien!
            </p>

            <div class="d-flex flex-wrap justify-content-center gap-3">
                <div class="badge bg-white bg-opacity-10 px-3 py-2 rounded-pill border border-white border-opacity-25">
                    <i class="fa-solid fa-check text-warning me-1"></i> 100% Full Source Code Bebas Lisensi
                </div>
                <div class="badge bg-white bg-opacity-10 px-3 py-2 rounded-pill border border-white border-opacity-25">
                    <i class="fa-solid fa-check text-warning me-1"></i> Modul PDF Rinci & Bergambar
                </div>
                <div class="badge bg-white bg-opacity-10 px-3 py-2 rounded-pill border border-white border-opacity-25">
                    <i class="fa-solid fa-check text-warning me-1"></i> Bantuan Konsultasi Instalasi
                </div>
            </div>
        </div>
    </header>

    <main class="container py-5">
        
        <!-- FILTER CHIPS -->
        <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
            <button class="filter-btn active" onclick="filterProjects('all', this)">Semua Kit Proyek</button>
            <button class="filter-btn" onclick="filterProjects('laravel-vue', this)">Laravel & Vue.js</button>
            <button class="filter-btn" onclick="filterProjects('fullstack', this)">Fullstack PHP & MySQL</button>
            <button class="filter-btn" onclick="filterProjects('api-payment', this)">API & Payment Gateway</button>
        </div>

        <!-- PROJECT GRID -->
        <div class="row g-4" id="projectGrid">
            <?php foreach ($projects as $idx => $p): 
                $waMsg = urlencode("Halo Tim Skillance Academy! Saya tertarik ingin memesan Project Kit: *" . $p['title'] . "* seharga " . $p['price_now'] . ". Mohon info cara akses dan pembayaran. Terima kasih!");
                $waUrl = "https://wa.me/{$adminWa}?text={$waMsg}";
            ?>
                <div class="col-lg-6 project-item" data-category="<?= htmlspecialchars($p['category']) ?>">
                    <div class="project-card">
                        
                        <!-- COVER HEADER -->
                        <div class="project-header-cover">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge <?= $p['badge_color'] ?> px-3 py-1 rounded-pill fw-bold" style="font-size: 0.75rem;">
                                    <i class="fa-solid fa-star me-1"></i> <?= $p['badge'] ?>
                                </span>
                                <span class="badge bg-white bg-opacity-10 text-white border border-white border-opacity-25 px-3 py-1 rounded-pill" style="font-size: 0.74rem;">
                                    <i class="fa-solid fa-file-pdf text-danger me-1"></i> <?= $p['pages'] ?>
                                </span>
                            </div>
                            <h4 class="fw-bold text-white font-heading mb-2" style="font-size: 1.25rem; line-height: 1.4;">
                                <?= htmlspecialchars($p['title']) ?>
                            </h4>
                            <p class="small mb-0" style="color: #cbd5e1; line-height: 1.6;">
                                <?= htmlspecialchars($p['desc']) ?>
                            </p>
                        </div>

                        <!-- CARD BODY (STRICT VERTICAL STACK WITH FLEX-COLUMN) -->
                        <div class="p-4 d-flex flex-column flex-grow-1 justify-content-between">
                            <div>
                                <!-- SUITABLE FOR ALERT BOX -->
                                <div class="suitable-box mb-3">
                                    <i class="fa-solid fa-bullseye text-warning fs-5 mt-1"></i>
                                    <div>
                                        <strong class="d-block text-dark" style="font-size: 0.78rem; text-transform: uppercase; letter-spacing: 0.5px;">Rekomendasi Terbaik Untuk:</strong>
                                        <span class="text-secondary" style="font-size: 0.85rem; line-height: 1.5;"><?= htmlspecialchars($p['suitable_for']) ?></span>
                                    </div>
                                </div>

                                <!-- TECH STACK PILLS -->
                                <div class="mb-3">
                                    <span class="text-uppercase text-muted fw-bold d-block mb-2" style="font-size: 0.72rem; letter-spacing: 0.6px;">Tech Stack Utama:</span>
                                    <div class="d-flex flex-wrap gap-1">
                                        <?php foreach ($p['tech'] as $t): ?>
                                            <span class="tech-pill"><?= htmlspecialchars($t) ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- TOP FEATURES CHECKLIST -->
                                <div class="mb-2">
                                    <span class="text-uppercase text-muted fw-bold d-block mb-2" style="font-size: 0.72rem; letter-spacing: 0.6px;">Fitur Unggulan Sistem:</span>
                                    <ul class="feature-list list-unstyled mb-0">
                                        <?php foreach (array_slice($p['features'], 0, 4) as $ft): ?>
                                            <li class="feature-item">
                                                <i class="fa-solid fa-circle-check text-success"></i>
                                                <span><?= htmlspecialchars($ft) ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>

                            <!-- CARD FOOTER & PRICING -->
                            <div class="pt-3 mt-3 border-top">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div>
                                        <div class="d-flex align-items-center gap-2 mb-1">
                                            <span class="price-old"><?= $p['price_old'] ?></span>
                                            <span class="badge bg-danger-subtle text-danger border border-danger-subtle fw-bold rounded-pill px-2 py-0" style="font-size: 0.7rem;">HEMAT 60%</span>
                                        </div>
                                        <div class="price-current font-heading text-navy">
                                            <?= $p['price_now'] ?>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3 py-1 fw-bold small">
                                            <i class="fa-solid fa-infinity me-1"></i> Akses Selamanya
                                        </span>
                                        <small class="d-block text-muted mt-1" style="font-size: 0.72rem;">Full Source Code + PDF</small>
                                    </div>
                                </div>

                                <!-- BUTTON SAMPLE BAB 1 GRATIS (PDF) -->
                                <button type="button" class="btn btn-sample-pdf mb-2" data-bs-toggle="modal" data-bs-target="#sampleModal-<?= $p['id'] ?>">
                                    <i class="fa-solid fa-file-pdf fs-6 text-danger me-1"></i> Download Sample Bab 1 & Daftar Isi Gratis
                                </button>

                                <div class="row g-2">
                                    <div class="col-sm-5 col-12">
                                        <button class="btn btn-detail-action w-100" data-bs-toggle="modal" data-bs-target="#modal-<?= $p['id'] ?>">
                                            <i class="fa-solid fa-list-ul"></i> Detail & Bab
                                        </button>
                                    </div>
                                    <div class="col-sm-7 col-12">
                                        <a href="<?= $waUrl ?>" target="_blank" class="btn btn-order-wa w-100">
                                            <i class="fa-brands fa-whatsapp fs-5"></i> Dapatkan Kit & Code
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- DETAIL MODAL FOR THIS PROJECT -->
                <div class="modal fade" id="modal-<?= $p['id'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                            <div class="modal-header text-white" style="background: linear-gradient(135deg, #071a35 0%, #0d2e5c 100%);">
                                <div>
                                    <span class="badge <?= $p['badge_color'] ?> px-2 py-1 rounded-pill small mb-1"><?= $p['badge'] ?></span>
                                    <h5 class="modal-title fw-bold font-heading text-white"><?= htmlspecialchars($p['title']) ?></h5>
                                </div>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <h6 class="fw-bold text-navy mb-2"><i class="fa-solid fa-circle-info text-warning me-1"></i> Ringkasan Studi Kasus:</h6>
                                <p class="text-muted small" style="line-height: 1.7;"><?= htmlspecialchars($p['desc']) ?></p>

                                <h6 class="fw-bold text-navy mb-2 mt-4"><i class="fa-solid fa-list-check text-success me-1"></i> Seluruh Fitur yang Dibangun:</h6>
                                <ul class="list-group list-group-flush mb-4 small">
                                    <?php foreach ($p['features'] as $ft): ?>
                                        <li class="list-group-item px-0 d-flex align-items-center gap-2">
                                            <i class="fa-solid fa-check text-success"></i> <?= htmlspecialchars($ft) ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>

                                <h6 class="fw-bold text-navy mb-2"><i class="fa-solid fa-book text-primary me-1"></i> Daftar Bab & Kurikulum E-Book:</h6>
                                <div class="bg-light p-3 rounded-3 border mb-4">
                                    <ol class="mb-0 small text-dark ps-3" style="line-height: 1.8;">
                                        <?php foreach ($p['chapters'] as $ch): ?>
                                            <li class="fw-semibold mb-1"><?= htmlspecialchars($ch) ?></li>
                                        <?php endforeach; ?>
                                    </ol>
                                </div>

                                <div class="p-3 rounded-3 bg-warning bg-opacity-10 border border-warning border-opacity-50 small mb-3">
                                    <strong><i class="fa-solid fa-box-open me-1 text-warning"></i> Apa Saja yang Anda Dapatkan?</strong>
                                    <ul class="mb-0 mt-1 ps-3">
                                        <li>File E-Book PDF Lengkap (<?= $p['pages'] ?>) beresolusi tinggi dan siap cetak.</li>
                                        <li>Full Source Code Project lengkap siap jalankan (GitHub Repository).</li>
                                        <li>Database Seeder & SQL siap import.</li>
                                        <li>Lisensi penggunaan komersial tanpa batas untuk skripsi atau dijual ke klien.</li>
                                        <li>Konsultasi jika mengalami kendala instalasi di komputer lokal.</li>
                                    </ul>
                                </div>

                                <!-- SAMPLE CALLOUT IN DETAIL MODAL -->
                                <div class="p-3 rounded-3 bg-danger bg-opacity-10 border border-danger border-opacity-25 d-flex flex-wrap justify-content-between align-items-center gap-2">
                                    <div>
                                        <h6 class="fw-bold text-danger mb-1" style="font-size: 0.88rem;"><i class="fa-solid fa-file-pdf me-1"></i> Ingin Baca Contohnya Dulu?</h6>
                                        <p class="text-muted small mb-0" style="font-size: 0.78rem;">Dapatkan Sampel Gratis Bab 1 & Daftar Isi Lengkap berformat PDF siap cetak.</p>
                                    </div>
                                    <button type="button" class="btn btn-danger btn-sm rounded-pill px-3 fw-bold" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#sampleModal-<?= $p['id'] ?>">
                                        Buka Sampel Gratis &raquo;
                                    </button>
                                </div>
                            </div>
                            <div class="modal-footer bg-light justify-content-between p-3">
                                <div>
                                    <span class="price-old d-block" style="font-size: 0.8rem;"><?= $p['price_old'] ?></span>
                                    <strong class="text-navy fs-5 font-heading"><?= $p['price_now'] ?></strong>
                                </div>
                                <div class="d-flex gap-2">
                                    <button type="button" class="btn btn-secondary btn-sm rounded-pill px-3" data-bs-dismiss="modal">Tutup</button>
                                    <a href="<?= $waUrl ?>" target="_blank" class="btn btn-order-wa btn-sm px-4">
                                        <i class="fa-brands fa-whatsapp fs-5"></i> Beli Sekarang via WA
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SAMPLE DOWNLOAD & LEAD CAPTURE MODAL -->
                <div class="modal fade" id="sampleModal-<?= $p['id'] ?>" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; overflow: hidden;">
                            <div class="modal-header text-white" style="background: linear-gradient(135deg, #071a35 0%, #0d2e5c 100%);">
                                <div>
                                    <span class="badge bg-danger text-white px-2 py-1 rounded-pill small mb-1">
                                        <i class="fa-solid fa-file-pdf me-1"></i> FREE PREVIEW PDF
                                    </span>
                                    <h5 class="modal-title fw-bold font-heading text-white fs-6">Unduh Sampel Bab 1 & Daftar Isi Gratis</h5>
                                </div>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4">
                                <div class="d-flex align-items-center gap-3 p-3 rounded-3 bg-light border mb-3">
                                    <div class="bg-danger bg-opacity-10 text-danger rounded-3 p-2 fs-3 text-center d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                        <i class="fa-solid fa-book-open"></i>
                                    </div>
                                    <div>
                                        <strong class="d-block text-navy small fw-bold"><?= htmlspecialchars($p['title']) ?></strong>
                                        <span class="text-muted small" style="font-size: 0.75rem;">Bab 1 Lengkap, Analisis Kebutuhan, & Skema Database ERD</span>
                                    </div>
                                </div>

                                <p class="text-muted small mb-3" style="line-height: 1.6;">
                                    Silakan isi data berikut untuk menerima sampel bab gratis (PDF). Dokumen dapat Anda baca langsung di browser dan di-download/dicetak:
                                </p>

                                <form onsubmit="handleLeadSubmit(event, '<?= $p['id'] ?>', '<?= addslashes($p['title']) ?>')">
                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-navy">Nama Lengkap Anda <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="fa-regular fa-user text-muted"></i></span>
                                            <input type="text" name="full_name" class="form-control" placeholder="Contoh: Muhammad Farhan" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-navy">Nomor WhatsApp Aktif <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="fa-brands fa-whatsapp text-success"></i></span>
                                            <input type="tel" name="whatsapp" class="form-control" placeholder="Contoh: 081234567890" required>
                                        </div>
                                        <small class="text-muted" style="font-size: 0.72rem;">Untuk pengiriman link update dan voucher diskon khusus mahasiswa.</small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-navy">Alamat Email <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white"><i class="fa-regular fa-envelope text-muted"></i></span>
                                            <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label small fw-bold text-navy">Status / Profesi</label>
                                        <select name="profession" class="form-select small">
                                            <option value="Mahasiswa Tingkat Akhir (Skripsi)">Mahasiswa Tingkat Akhir (Sedang Skripsi/TA)</option>
                                            <option value="Mahasiswa Baru / Menengah">Mahasiswa Semester 1 - 6</option>
                                            <option value="Freelancer Web Developer">Freelancer Web Developer</option>
                                            <option value="Programmer / Junior Engineer">Programmer / Junior Engineer</option>
                                            <option value="Dosen / Pengajar">Dosen / Tenaga Pendidik</option>
                                        </select>
                                    </div>

                                    <div class="form-check mb-4">
                                        <input class="form-check-input" type="checkbox" id="agree-<?= $p['id'] ?>" checked required>
                                        <label class="form-check-label small text-muted" for="agree-<?= $p['id'] ?>" style="font-size: 0.76rem;">
                                            Saya setuju menerima sampel bab gratis dan informasi diskon modul Skillance Academy.
                                        </label>
                                    </div>

                                    <button type="submit" class="btn btn-danger w-100 fw-bold py-2 rounded-pill shadow-sm" id="btn-submit-<?= $p['id'] ?>">
                                        <i class="fa-solid fa-file-pdf me-1"></i> Buka & Download Sampel Bab 1 (PDF) &raquo;
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>
        <!-- SPECIAL BUNDLE PROMO BANNER -->
        <div class="p-4 p-md-5 rounded-4 text-white mt-5 shadow-lg position-relative overflow-hidden" style="background: linear-gradient(135deg, #0d2e5c 0%, #071a35 70%, #04AA6D 100%);">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <span class="badge bg-gold text-navy fw-bold px-3 py-2 rounded-pill mb-2 text-uppercase">
                        <i class="fa-solid fa-gem me-1"></i> Paket All-In-One Developer Pack
                    </span>
                    <h2 class="display-6 fw-bold font-heading mb-2">Ingin Menguasai Seluruh 4 Kit Proyek Sekaligus?</h2>
                    <p class="text-white-50 mb-3" style="font-size: 0.95rem; line-height: 1.7;">
                        Dapatkan seluruh 4 E-Book Panduan, 4 Full Source Code, database seeder, serta <strong>Akses Komunitas Skillance VIP</strong> dengan harga bundling super hemat!
                    </p>
                    <div class="d-flex flex-wrap gap-3 align-items-center">
                        <span class="text-decoration-line-through text-white-50 fs-5">Rp 756.000</span>
                        <span class="display-6 fw-bold text-gold font-heading">Rp 199.000</span>
                        <span class="badge bg-danger text-white px-3 py-2 rounded-pill">HEMAT RP 557.000</span>
                    </div>
                </div>
                <div class="col-lg-4 text-lg-end mt-4 mt-lg-0">
                    <?php 
                    $waBundleMsg = urlencode("Halo Tim Skillance Academy! Saya tertarik ingin mengambil *Paket Bundling All-In-One (4 Kit Proyek)* seharga Rp 199.000. Mohon panduan pembayarannya. Terima kasih!");
                    $waBundleUrl = "https://wa.me/{$adminWa}?text={$waBundleMsg}";
                    ?>
                    <a href="<?= $waBundleUrl ?>" target="_blank" class="btn btn-warning btn-lg fw-bold px-4 py-3 rounded-pill text-navy shadow">
                        <i class="fa-brands fa-whatsapp me-2 fs-5"></i> Klaim Paket Bundling &raquo;
                    </a>
                </div>
            </div>
        </div>

    </main>

    <!-- FOOTER -->
    <footer class="py-4 bg-white border-top text-center text-muted small mt-5">
        <div class="container">
            <p class="mb-1 fw-semibold">&copy; <?= date('Y') ?> <strong>Skillance Academy Indonesia</strong> — Project-Based Digital Talent Incubator.</p>
            <p class="mb-0 text-muted" style="font-size: 0.75rem;">Source code dan e-book diterbitkan secara resmi untuk membantu mahasiswa, lulusan baru, dan talenta lepas di Indonesia.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterProjects(cat, btnEl) {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            btnEl.classList.add('active');

            const items = document.querySelectorAll('.project-item');
            items.forEach(it => {
                if (cat === 'all' || it.getAttribute('data-category') === cat) {
                    it.style.display = 'block';
                } else {
                    it.style.display = 'none';
                }
            });
        }

        function handleLeadSubmit(event, productId, productTitle) {
            event.preventDefault();
            const form = event.target;
            const submitBtn = document.getElementById('btn-submit-' + productId);
            const originalText = submitBtn.innerHTML;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Menyiapkan Dokumen Sampel...';

            const formData = new FormData(form);
            formData.append('product_id', productId);
            formData.append('product_title', productTitle);

            fetch('api/save_lead.php', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(data => {
                if (data.success && data.preview_url) {
                    const modalEl = document.getElementById('sampleModal-' + productId);
                    const modalInstance = bootstrap.Modal.getInstance(modalEl);
                    if (modalInstance) {
                        modalInstance.hide();
                    }
                    window.location.href = data.preview_url;
                } else {
                    alert(data.message || 'Terjadi kendala saat menyiapkan sampel.');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = originalText;
                }
            })
            .catch(err => {
                console.error(err);
                window.location.href = 'sample_preview.php?pid=' + encodeURIComponent(productId);
            });
        }
    </script>
</body>
</html>
