<?php
/**
 * Skillance Bootcamp Registration Flow (Dicoding Style Multi-Step)
 * Langkah 1: Registrasi Awal
 * Langkah 2: Pembayaran (QRIS)
 * Langkah 3: Daftar Ulang
 * Langkah 4: Selamat Belajar (Download ZIP Langsung)
 */

if (session_status() === PHP_SESSION_NONE) {
    @session_start();
}

require_once __DIR__ . '/config/config.php';

// Auto create table if not exists
if ($conn && $conn instanceof mysqli && !$conn->connect_error) {
    @$conn->query("
        CREATE TABLE IF NOT EXISTS academy_bootcamp_registrations (
            id BIGINT AUTO_INCREMENT PRIMARY KEY,
            invoice_no VARCHAR(50) UNIQUE NOT NULL,
            nama_lengkap VARCHAR(150) NOT NULL,
            email VARCHAR(150) NOT NULL,
            whatsapp VARCHAR(25) NOT NULL,
            learning_path VARCHAR(150) NOT NULL,
            skema_pembayaran VARCHAR(100) NOT NULL,
            nominal INT NOT NULL DEFAULT 149000,
            status_pembayaran VARCHAR(20) NOT NULL DEFAULT 'pending',
            universitas VARCHAR(150) NULL,
            jurusan VARCHAR(100) NULL,
            pengalaman VARCHAR(50) NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
    ");
}

// Pre-selected path from GET
$pathParam = $_GET['path'] ?? '';
$defaultSelectedPath = 'laravel10';
if (stripos($pathParam, 'flutter') !== false) {
    $defaultSelectedPath = 'flutter';
} elseif (stripos($pathParam, 'front') !== false) {
    $defaultSelectedPath = 'frontend';
} elseif (stripos($pathParam, 'back') !== false) {
    $defaultSelectedPath = 'backend';
}

$seoTitle = 'Registrasi Online Bootcamp | Skillance Academy Indonesia';
$seoDesc = 'Formulir pendaftaran resmi Online Bootcamp Skillance Academy dengan kurikulum berstandar industri model Dicoding: Sekali bayar akses selamanya, code review tugas, dan hadiah proyek terbaik.';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($seoTitle) ?></title>
    <meta name="description" content="<?= htmlspecialchars($seoDesc) ?>">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --navy: #0d2e5c;
            --navy-dark: #071a35;
            --gold: #fca311;
            --blue-accent: #0284c7;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
            color: #1e293b;
        }

        .font-heading {
            font-family: 'Space Grotesk', sans-serif;
        }

        /* Top Minimalist Header */
        .bootcamp-topbar {
            background-color: #ffffff;
            border-bottom: 1px solid #f1f5f9;
            padding: 14px 0;
        }

        .bootcamp-logo-circle {
            width: 38px;
            height: 38px;
            background: #071a35;
            color: #fca311;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 1.1rem;
        }

        /* Left Stepper Sidebar */
        .stepper-card {
            background: #ffffff;
            border-radius: 16px;
            border: 1px solid #f1f5f9;
            padding: 24px 20px;
        }

        .step-item {
            display: flex;
            align-items: flex-start;
            gap: 16px;
            padding: 16px 14px;
            border-radius: 12px;
            transition: all 0.2s ease;
            position: relative;
            margin-bottom: 8px;
        }

        .step-item.active {
            background-color: #f1f5f9;
        }

        .step-indicator {
            width: 24px;
            height: 24px;
            min-width: 24px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 2px;
            font-size: 0.75rem;
        }

        .step-indicator.active {
            border: 2px solid #0f172a;
            position: relative;
        }

        .step-indicator.active::after {
            content: '';
            width: 12px;
            height: 12px;
            background: #0f172a;
            border-radius: 50%;
        }

        .step-indicator.locked {
            color: #94a3b8;
            font-size: 0.85rem;
        }

        .step-indicator.completed {
            background-color: #10b981;
            color: #ffffff;
        }

        .step-text h6 {
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 3px;
            color: #0f172a;
        }

        .step-text p {
            font-size: 0.78rem;
            line-height: 1.45;
            color: #64748b;
            margin-bottom: 0;
        }

        /* Brand bottom card */
        .stepper-brand-box {
            padding-top: 24px;
            margin-top: 16px;
            border-top: 1px solid #f1f5f9;
        }

        .stepper-gradient-bar {
            height: 4px;
            border-radius: 2px;
            background: linear-gradient(90deg, #071a35 0%, #0284c7 50%, #fca311 100%);
            margin-top: 12px;
        }

        /* Right Form Container */
        .step-breadcrumb {
            font-size: 0.82rem;
            font-weight: 700;
            color: #0284c7;
            margin-bottom: 6px;
        }

        .step-heading {
            font-size: 1.85rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .step-subtitle {
            font-size: 0.88rem;
            color: #64748b;
            margin-bottom: 12px;
        }

        .step-required-note {
            color: #ef4444;
            font-size: 0.82rem;
            margin-bottom: 24px;
        }

        /* Form Card */
        .form-registration-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 32px;
        }

        .form-registration-title {
            font-size: 1.2rem;
            font-weight: 800;
            color: #0f172a;
            padding-bottom: 16px;
            margin-bottom: 24px;
            border-bottom: 1px solid #f1f5f9;
        }

        .form-label {
            font-size: 0.88rem;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 6px;
        }

        .form-control, .form-select {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.9rem;
        }

        .form-control:focus, .form-select:focus {
            border-color: #0284c7;
            box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.15);
        }

        .form-helper-text {
            font-size: 0.76rem;
            color: #64748b;
            margin-top: 5px;
        }

        .terms-box {
            font-size: 0.78rem;
            color: #475569;
            line-height: 1.6;
        }

        .btn-submit-navy {
            background-color: #071a35;
            color: #ffffff;
            font-weight: 700;
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            width: 100%;
            transition: all 0.2s ease;
        }

        .btn-submit-navy:hover {
            background-color: #0d2e5c;
            color: #ffffff;
        }

        .learning-path-box {
            background: #f8fafc;
            border: 1.5px solid #cbd5e1;
            border-radius: 10px;
            padding: 14px 16px;
        }
    </style>
</head>
<body>

    <!-- TOPBAR: MINIMALIST LIKE DICODING -->
    <header class="bootcamp-topbar">
        <div class="container d-flex align-items-center justify-content-between" style="max-width: 1140px;">
            <div class="d-flex align-items-center gap-3">
                <a href="bootcamp.php" class="bootcamp-logo-circle text-decoration-none">
                    <i class="fa-solid fa-graduation-cap text-warning fs-5"></i>
                </a>
                <a href="bootcamp.php" class="text-decoration-none text-dark fw-bold small">
                    Homepage Skillance Bootcamp
                </a>
            </div>
            <a href="https://wa.me/6282291700778?text=Halo%20Admin%20Skillance,%20saya%20butuh%20bantuan%20pendaftaran%20bootcamp" target="_blank" class="text-decoration-none text-muted small">
                <i class="fa-brands fa-whatsapp text-success me-1"></i> Bantuan Pendaftaran
            </a>
        </div>
    </header>

    <!-- MAIN REGISTRATION SECTION -->
    <main class="container my-4 my-md-5" style="max-width: 1140px;">
        <div class="row g-4 g-lg-5">

            <!-- ============================================== -->
            <!-- LEFT COLUMN: STEPPER SIDEBAR (DICODING STYLE)  -->
            <!-- ============================================== -->
            <div class="col-lg-4 col-md-5">
                <div class="stepper-card sticky-top" style="top: 24px;">

                    <!-- STEP 1: REGISTRASI AWAL -->
                    <div class="step-item active" id="sidebarStep1">
                        <div class="step-indicator active" id="stepIcon1"></div>
                        <div class="step-text">
                            <h6>Registrasi Awal</h6>
                            <p>Lengkapi data diri Anda untuk memulai proses pendaftaran.</p>
                        </div>
                    </div>

                    <!-- STEP 2: PEMBAYARAN -->
                    <div class="step-item" id="sidebarStep2">
                        <div class="step-indicator locked" id="stepIcon2">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div class="step-text">
                            <h6>Pembayaran</h6>
                            <p>Atur pembayaran sesuai kebutuhan melalui QRIS instan resmi.</p>
                        </div>
                    </div>

                    <!-- STEP 3: DAFTAR ULANG -->
                    <div class="step-item" id="sidebarStep3">
                        <div class="step-indicator locked" id="stepIcon3">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div class="step-text">
                            <h6>Daftar Ulang</h6>
                            <p>Lengkapi formulir daftar ulang untuk validasi data diri dan minat belajar.</p>
                        </div>
                    </div>

                    <!-- STEP 4: SELAMAT BELAJAR -->
                    <div class="step-item" id="sidebarStep4">
                        <div class="step-indicator locked" id="stepIcon4">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div class="step-text">
                            <h6>Selamat Belajar!</h6>
                            <p>Anda dapat segera mengakses materi pembelajaran dan mengunduh source code.</p>
                        </div>
                    </div>

                    <!-- BRANDING BOTTOM -->
                    <div class="stepper-brand-box">
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-code text-gold fs-5"></i>
                            <div>
                                <span class="fw-bold d-block lh-1 text-navy font-heading" style="font-size: 0.95rem; letter-spacing: -0.3px;">SKILLANCE</span>
                                <small class="text-muted fw-bold" style="font-size: 0.7rem; letter-spacing: 0.5px;">BOOTCAMP</small>
                            </div>
                        </div>
                        <div class="stepper-gradient-bar"></div>
                    </div>

                </div>
            </div>

            <!-- ============================================== -->
            <!-- RIGHT COLUMN: DYNAMIC FORM CONTAINER           -->
            <!-- ============================================== -->
            <div class="col-lg-8 col-md-7">

                <!-- STEP 1 CONTENT: REGISTRASI AWAL -->
                <div id="stepContent1">
                    <div class="step-breadcrumb">Langkah 1</div>
                    <h2 class="step-heading font-heading">Registrasi Awal</h2>
                    <p class="step-subtitle">
                        Silakan lengkapi formulir di bawah dan pastikan data diisi dengan benar. <a href="#" onclick="alert('Petunjuk: Pastikan nama lengkap sesuai KTP agar sertifikat kelulusan sah untuk lampiran SKPI kuliah Anda. No. WA digunakan untuk konfirmasi otomatis.'); return false;" class="text-primary text-decoration-none">Lihat petunjuk pengisian</a>.
                    </p>
                    <div class="step-required-note">*Wajib diisi.</div>

                    <div class="form-registration-card shadow-xs">
                        <h5 class="form-registration-title">Formulir Registrasi</h5>

                        <form id="initialRegisterForm" onsubmit="handleInitialSubmit(event)">
                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label class="form-label">Nama lengkap <span class="text-danger">*</span></label>
                                <input type="text" id="regNama" class="form-control" placeholder="Nama lengkap sesuai KTP" required>
                                <div class="form-helper-text">Pastikan nama lengkap sesuai dengan KTP, nama akan digunakan untuk sertifikat kelulusan.</div>
                            </div>

                            <!-- Email Aktif -->
                            <div class="mb-3">
                                <label class="form-label">Email aktif <span class="text-danger">*</span></label>
                                <input type="email" id="regEmail" class="form-control" placeholder="nama@email.com" required>
                            </div>

                            <!-- No WhatsApp Aktif -->
                            <div class="mb-3">
                                <label class="form-label">Nomor WhatsApp aktif <span class="text-danger">*</span></label>
                                <div class="form-helper-text mb-1">Mohon gunakan format 628xxxx atau 08xxxx</div>
                                <input type="tel" id="regWa" class="form-control" placeholder="Contoh: 6282291700778" maxlength="15" required>
                            </div>

                            <!-- Pilih Learning Path -->
                            <div class="mb-3">
                                <label class="form-label">Pilih Learning Path <span class="text-danger">*</span></label>
                                <div class="learning-path-box">
                                    <select id="regPath" class="form-select border-0 bg-transparent fw-bold text-navy" required onchange="updatePriceDisplay()">
                                        <option value="laravel10" <?= $defaultSelectedPath === 'laravel10' ? 'selected' : '' ?>>
                                            Batch 1 - Full-Stack Web Development (Laravel 10 & Blade HTML5)
                                        </option>
                                        <option value="flutter" <?= $defaultSelectedPath === 'flutter' ? 'selected' : '' ?>>
                                            Batch 1 - Mobile App Development (Flutter 3 & Dart Multiplatform)
                                        </option>
                                        <option value="frontend" <?= $defaultSelectedPath === 'frontend' ? 'selected' : '' ?>>
                                            Batch 1 - Frontend Web Engineering (Modern JavaScript & Responsive UI)
                                        </option>
                                        <option value="backend" <?= $defaultSelectedPath === 'backend' ? 'selected' : '' ?>>
                                            Batch 1 - Backend Specialist & Cloud Architecture (PHP 8 & Linux VPS)
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <!-- Pilih Skema Pembayaran -->
                            <div class="mb-4">
                                <label class="form-label">Pilih Skema Pembayaran <span class="text-danger">*</span></label>
                                <select id="regSkema" class="form-select" required>
                                    <option value="lump_sum_lifetime" selected>
                                        Bayar Penuh Sekali Bayar (Akses Selamanya) - <span id="priceLabel">Rp 149.000</span>
                                    </option>
                                </select>
                                <div class="form-helper-text text-success fw-semibold"><i class="fa-solid fa-infinity me-1"></i> Sekali Bayar Saja &bull; Bebas Biaya Bulanan &bull; Akses Materi Selamanya</div>
                            </div>

                            <!-- Checkbox Agreement -->
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="regAgreement" required>
                                <label class="form-check-label terms-box" for="regAgreement">
                                    Dengan mengisi form ini, saya menyatakan bahwa: (1) Saya telah membaca, memahami, dan menyetujui Terms of Service, Kebijakan Privasi, serta Kode Etik Bootcamp yang berlaku; (2) Saya mengizinkan Skillance menghubungi saya terkait pendaftaran dan program melalui WhatsApp dan email; (3) Data yang saya isi adalah akurat dan saya bertanggung jawab atas kebenaran informasi yang diberikan.
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" id="btnSubmitInitial" class="btn btn-submit-navy shadow-sm">
                                Kirim formulir &raquo;
                            </button>
                        </form>
                    </div>
                </div>

                <!-- STEP 2 CONTENT: PEMBAYARAN (QRIS) -->
                <div id="stepContent2" style="display: none;">
                    <div class="step-breadcrumb">Langkah 2</div>
                    <h2 class="step-heading font-heading">Pembayaran</h2>
                    <p class="step-subtitle">
                        Selesaikan pembayaran dengan scan QRIS resmi Skillance Store di bawah.
                    </p>

                    <div class="form-registration-card shadow-xs text-center">
                        <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3 text-start">
                            <div>
                                <small class="text-muted d-block" style="font-size: 0.72rem;">Nomor Tagihan / Invoice:</small>
                                <strong class="fs-6 font-monospace text-navy" id="invoiceDisplay">INV-BC-2026-XXXX</strong>
                            </div>
                            <span class="badge bg-warning text-dark fw-bold px-3 py-1.5 rounded-pill">Menunggu Pembayaran</span>
                        </div>

                        <!-- Ringkasan Program -->
                        <div class="p-3 bg-light rounded-3 text-start mb-4 border">
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted small">Nama Pendaftar:</span>
                                <strong class="text-navy small" id="summaryNama">-</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <span class="text-muted small">Program Kelas:</span>
                                <strong class="text-navy small" id="summaryPath">-</strong>
                            </div>
                            <div class="d-flex justify-content-between border-top pt-2 mt-2">
                                <span class="fw-bold text-navy">Total Pembayaran:</span>
                                <strong class="text-primary fs-5 fw-bold" id="summaryNominal">Rp 149.000</strong>
                            </div>
                            <small class="text-success d-block mt-1"><i class="fa-solid fa-infinity me-1"></i> Skema Sekali Bayar &bull; Akses Selamanya</small>
                        </div>

                        <!-- QRIS Barcode Image -->
                        <div class="p-3 border rounded-3 d-inline-block bg-white shadow-xs mb-3">
                            <img src="assets/img/qris_official.jpg" alt="QRIS Resmi Skillance" class="img-fluid rounded" style="max-width: 250px;">
                            <div class="small fw-bold text-navy mt-2"><i class="fa-solid fa-qrcode me-1"></i> Merchant: SKILLANCE STORE</div>
                            <div class="text-muted" style="font-size: 0.72rem;">NMID: ID1026634363422 &bull; Mendukung Semua Bank & E-Wallet</div>
                        </div>

                        <div class="d-flex flex-column gap-2 max-w-md mx-auto">
                            <!-- WhatsApp Confirmation -->
                            <a id="btnWaConfirmPay" href="#" target="_blank" class="btn btn-success fw-bold py-2.5 rounded-3 d-flex align-items-center justify-content-center gap-2">
                                <i class="fa-brands fa-whatsapp fs-5"></i> Kirim Bukti Transfer ke WhatsApp Admin
                            </a>

                            <!-- Continue to Step 3 -->
                            <button type="button" class="btn btn-navy fw-bold py-2.5 rounded-3" onclick="goToStep3()">
                                Saya Sudah Bayar & Lanjut Daftar Ulang &raquo;
                            </button>
                        </div>
                    </div>
                </div>

                <!-- STEP 3 CONTENT: DAFTAR ULANG -->
                <div id="stepContent3" style="display: none;">
                    <div class="step-breadcrumb">Langkah 3</div>
                    <h2 class="step-heading font-heading">Daftar Ulang</h2>
                    <p class="step-subtitle">
                        Lengkapi formulir daftar ulang untuk validasi data diri dan minat belajar Anda.
                    </p>

                    <div class="form-registration-card shadow-xs">
                        <h5 class="form-registration-title">Formulir Daftar Ulang</h5>

                        <form id="reRegisterForm" onsubmit="handleReRegisterSubmit(event)">
                            <div class="mb-3">
                                <label class="form-label">Asal Universitas / Kampus / Sekolah / Institusi <span class="text-danger">*</span></label>
                                <input type="text" id="reUniv" class="form-control" placeholder="Contoh: Universitas Sembilanbelas November Kolaka (USN)" required>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label">Program Studi / Jurusan</label>
                                    <input type="text" id="reJurusan" class="form-control" placeholder="Contoh: Teknik Informatika / Sistem Informasi">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Tingkat Pengalaman Koding Saat Ini</label>
                                    <select id="rePengalaman" class="form-select">
                                        <option value="Pemula (Baru Mulai Belajar)">Pemula (Baru Mulai Belajar)</option>
                                        <option value="Menengah (Pernah Belajar HTML/PHP)">Menengah (Pernah Belajar HTML/PHP)</option>
                                        <option value="Tingkat Akhir (Sedang Mengerjakan Skripsi)">Tingkat Akhir (Sedang Mengerjakan Skripsi)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Minat Proyek Akhir yang Ingin Dibangun</label>
                                <textarea id="reMinat" class="form-control" rows="3" placeholder="Contoh: Ingin membangun sistem informasi desa (SIDESA) untuk skripsi dan diikutkan seleksi Best Project Award."></textarea>
                            </div>

                            <button type="submit" class="btn btn-submit-navy shadow-sm">
                                Selesaikan Pendaftaran & Mulai Belajar &raquo;
                            </button>
                        </form>
                    </div>
                </div>

                <!-- STEP 4 CONTENT: SELAMAT BELAJAR (DOWNLOAD ZIP LANGSUNG) -->
                <div id="stepContent4" style="display: none;">
                    <div class="step-breadcrumb text-success">Langkah 4</div>
                    <h2 class="step-heading font-heading text-navy">Selamat Belajar! 🎉</h2>
                    <p class="step-subtitle">
                        Pendaftaran Anda telah aktif. Anda dapat segera mengakses materi pembelajaran, mengunduh source code starter kit, dan memulai studi.
                    </p>

                    <div class="form-registration-card shadow-xs text-center">
                        <div class="d-inline-flex align-items-center justify-content-center bg-success bg-opacity-10 text-success rounded-circle p-3 mb-3" style="width: 72px; height: 72px;">
                            <i class="fa-solid fa-circle-check fa-3x"></i>
                        </div>

                        <h4 class="fw-bold text-navy mb-1">Akses Bootcamp Anda Telah Dibuka!</h4>
                        <p class="text-muted small max-w-md mx-auto mb-4" style="line-height: 1.8;">
                            Selamat datang di komunitas developer Skillance Academy! Silakan unduh modul handbook serta source code starter kit di bawah ini.
                        </p>

                        <!-- TOMBOL DOWNLOAD UTAMA: LANGSUNG DOWNLOAD ZIP -->
                        <div class="p-4 bg-light rounded-4 border mb-4 text-start">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div>
                                    <span class="badge bg-primary px-3 py-1 rounded-pill mb-1">Paket Belajar Siap Pakai</span>
                                    <h5 class="fw-bold text-navy mb-0">Project Kit & Full Source Code Bundle (ZIP)</h5>
                                    <small class="text-muted">Master Handbook PDF + Laravel 10 Blade + Database SQL</small>
                                </div>
                                <span class="badge bg-success py-2 px-3 rounded-pill fw-bold"><i class="fa-solid fa-infinity me-1"></i> Akses Selamanya</span>
                            </div>

                            <!-- ACTION DOWNLOAD ZIP -->
                            <a href="downloads/sidesa-bundle-master.zip" download="sidesa-bundle-master.zip" class="btn btn-primary btn-lg w-100 fw-bold py-3 rounded-3 shadow-sm d-flex align-items-center justify-content-center gap-2">
                                <i class="fa-solid fa-file-zipper fs-4"></i>
                                <span>Download File ZIP Langsung (Full Source Code & E-Book)</span>
                            </a>
                            <small class="text-muted d-block text-center mt-2" style="font-size: 0.75rem;">
                                <i class="fa-solid fa-lock text-success me-1"></i> Tautan unduhan terverifikasi resmi &bull; Format .ZIP lengkap
                            </small>
                        </div>

                        <!-- OTHER ACTION LINKS -->
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <a href="bootcamp.php#portal-submission" class="btn btn-outline-navy w-100 py-2.5 rounded-3 fw-bold small">
                                    <i class="fa-solid fa-code-commit text-primary me-1"></i> Portal Pengumpulan Tugas
                                </a>
                            </div>
                            <div class="col-sm-6">
                                <a href="https://wa.me/6282291700778?text=Halo%20Admin%20Skillance,%20saya%20sudah%20menyelesaikan%20pendaftaran%20bootcamp.%20Mohon%20invite%20ke%20grup%20diskusi." target="_blank" class="btn btn-outline-success w-100 py-2.5 rounded-3 fw-bold small">
                                    <i class="fa-brands fa-whatsapp text-success me-1"></i> Gabung Grup WhatsApp Siswa
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>

    <footer class="py-4 border-top mt-5 bg-white text-center text-muted small">
        <div class="container" style="max-width: 1140px;">
            &copy; <?= date('Y') ?> <strong>Skillance Academy Indonesia</strong> &bull; Platform Bootcamp Online Terstruktur & Akses Selamanya. Hak Cipta Dilindungi Undang-Undang.
        </div>
    </footer>

    <!-- SCRIPT STEPPER NAVIGATION & PERSISTENCE -->
    <script>
    let currentInvoice = 'INV-BC-2026-' + Math.floor(1000 + Math.random() * 9000);
    let registrationData = {};

    const PATH_NAMES = {
        'laravel10': 'Full-Stack Web Development (Laravel 10 & Blade HTML5)',
        'flutter': 'Mobile App Development (Flutter 3 & Dart Multiplatform)',
        'frontend': 'Frontend Web Engineering (Modern JavaScript & Responsive UI)',
        'backend': 'Backend Specialist & Cloud Architecture (PHP 8 & Linux VPS)'
    };

    const PATH_PRICES = {
        'laravel10': { val: 149000, label: 'Rp 149.000' },
        'flutter': { val: 179000, label: 'Rp 179.000' },
        'frontend': { val: 99000, label: 'Rp 99.000' },
        'backend': { val: 149000, label: 'Rp 149.000' }
    };

    function updatePriceDisplay() {
        const path = document.getElementById('regPath').value;
        const pObj = PATH_PRICES[path] || PATH_PRICES['laravel10'];
        const pLabel = document.getElementById('priceLabel');
        if (pLabel) pLabel.innerText = pObj.label;
    }

    function setStep(stepNum) {
        // Hide all contents
        document.getElementById('stepContent1').style.display = 'none';
        document.getElementById('stepContent2').style.display = 'none';
        document.getElementById('stepContent3').style.display = 'none';
        document.getElementById('stepContent4').style.display = 'none';

        // Reset sidebar states
        for (let i = 1; i <= 4; i++) {
            const item = document.getElementById('sidebarStep' + i);
            const icon = document.getElementById('stepIcon' + i);
            item.classList.remove('active');
            
            if (i < stepNum) {
                // Completed
                icon.className = 'step-indicator completed';
                icon.innerHTML = '<i class="fa-solid fa-check"></i>';
            } else if (i === stepNum) {
                // Active
                item.classList.add('active');
                icon.className = 'step-indicator active';
                icon.innerHTML = '';
            } else {
                // Locked
                icon.className = 'step-indicator locked';
                icon.innerHTML = '<i class="fa-solid fa-lock"></i>';
            }
        }

        // Show current content
        document.getElementById('stepContent' + stepNum).style.display = 'block';
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function handleInitialSubmit(e) {
        e.preventDefault();
        const nama = document.getElementById('regNama').value.trim();
        const email = document.getElementById('regEmail').value.trim();
        const wa = document.getElementById('regWa').value.trim();
        const pathKey = document.getElementById('regPath').value;
        const pathTitle = PATH_NAMES[pathKey] || pathKey;
        const priceObj = PATH_PRICES[pathKey] || PATH_PRICES['laravel10'];

        registrationData = {
            invoice: currentInvoice,
            nama: nama,
            email: email,
            whatsapp: wa,
            pathKey: pathKey,
            pathTitle: pathTitle,
            nominal: priceObj.val,
            nominalLabel: priceObj.label
        };

        // Populate step 2 summary
        document.getElementById('invoiceDisplay').innerText = currentInvoice;
        document.getElementById('summaryNama').innerText = nama;
        document.getElementById('summaryPath').innerText = pathTitle;
        document.getElementById('summaryNominal').innerText = priceObj.label;

        // WhatsApp Confirmation Link
        const waMsg = encodeURIComponent(
            `Halo Admin Skillance Academy, saya telah melakukan pendaftaran Online Bootcamp:\n\n` +
            `🧾 No. Invoice: *${currentInvoice}*\n` +
            `👤 Nama Siswa: *${nama}*\n` +
            `📚 Program: *${pathTitle}*\n` +
            `💰 Total Tagihan: *${priceObj.label}* (Sekali Bayar & Akses Selamanya)\n\n` +
            `Berikut saya kirimkan bukti pembayarannya. Mohon verifikasi aksesnya ya. Terima kasih!`
        );
        document.getElementById('btnWaConfirmPay').href = `https://wa.me/6282291700778?text=${waMsg}`;

        // Save to backend database
        fetch('api/submit_bootcamp_task.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                nama: nama,
                email: email,
                whatsapp: wa,
                kelas: pathTitle,
                judul: 'Registrasi Baru Bootcamp - ' + currentInvoice,
                github: 'https://github.com/skillance-academy',
                catatan: 'Pendaftaran Awal Invoice: ' + currentInvoice + ', Nominal: ' + priceObj.label
            })
        }).catch(() => {});

        // Advance to Step 2
        setStep(2);
    }

    function goToStep3() {
        setStep(3);
    }

    function handleReRegisterSubmit(e) {
        e.preventDefault();
        registrationData.univ = document.getElementById('reUniv').value;
        registrationData.jurusan = document.getElementById('reJurusan').value;
        registrationData.pengalaman = document.getElementById('rePengalaman').value;
        registrationData.minat = document.getElementById('reMinat').value;

        // Advance to Step 4 (Congratulations & Direct Download)
        setStep(4);
    }

    // Initialize display on load
    document.addEventListener('DOMContentLoaded', function() {
        updatePriceDisplay();
    });
    </script>
</body>
</html>
