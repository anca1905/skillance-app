<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

$pageTitle = "Spesifikasi & File Stempel PT";
$activeMenu = "finance";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?> | PT Skillance Digital Indonesia</title>
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Inter', sans-serif;
        }
        .text-navy { color: #0d2e5c !important; }
        .bg-navy { background-color: #0d2e5c !important; }
        .stamp-box {
            background: #ffffff;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            transition: all 0.2s ease;
        }
        .stamp-box:hover {
            border-color: #0d2e5c;
            box-shadow: 0 8px 24px rgba(13, 46, 92, 0.08);
        }
        .stamp-circle {
            background-color: #ffffff;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.06);
            padding: 8px;
        }
        /* Ukuran Fisik Skala 1:1 ketika dicetak (96 DPI preview) */
        .size-40mm {
            width: 151px; /* ~40mm at 96dpi */
            height: 151px;
        }
        .size-38mm {
            width: 144px; /* ~38mm */
            height: 144px;
        }
        .size-42mm {
            width: 159px; /* ~42mm */
            height: 159px;
        }

        @media print {
            body {
                background: #fff !important;
            }
            .no-print {
                display: none !important;
            }
            .sidebar, .sidebar-overlay {
                display: none !important;
            }
            .main-content {
                margin-left: 0 !important;
                padding: 0 !important;
            }
            .print-sheet {
                border: none !important;
                box-shadow: none !important;
                padding: 0 !important;
            }
        }
    </style>
</head>
<body class="bg-light">

    <!-- Sidebar Dynamic -->
    <div class="no-print">
        <?php include __DIR__ . '/../includes/sidebar.php'; ?>
    </div>

    <div class="main-content">
        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4 no-print">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <span class="badge bg-primary text-white fw-bold px-2.5 py-1 small">
                        <i class="fa-solid fa-stamp me-1"></i>LEGAL ASSETS
                    </span>
                    <span class="badge bg-light text-muted border small">PT Skillance Digital Indonesia</span>
                </div>
                <h3 class="fw-bold text-navy mb-0">Stempel Resmi Perusahaan</h3>
                <p class="text-muted small mb-0 mt-1">
                    File siap cetak untuk toko stempel kilat (skala 1:1) dan aset digital untuk dokumen legalitas / rekening bank.
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="index.php" class="btn btn-outline-secondary btn-sm shadow-sm py-2 px-3 fw-semibold">
                    <i class="fa-solid fa-arrow-left me-1"></i>Kembali ke Keuangan
                </a>
                <button onclick="window.print()" class="btn btn-navy text-white btn-sm shadow-sm py-2 px-3 fw-semibold">
                    <i class="fa-solid fa-print me-1.5"></i>Cetak Lembar Ukuran 1:1
                </button>
            </div>
        </div>

        <!-- Panduan Pembuatan Stempel untuk Toko / Percetakan -->
        <div class="alert alert-info border-0 shadow-sm p-3 mb-4 rounded-3 d-flex align-items-start gap-3 no-print" style="background-color: #f0f9ff; border-left: 5px solid #0284c7 !important;">
            <i class="fa-solid fa-circle-info fs-3 text-info mt-1"></i>
            <div>
                <h6 class="fw-bold text-navy mb-1">
                    Panduan Memberikan File ke Tukang Stempel Kilat (Flash Stamp)
                </h6>
                <p class="small text-muted mb-1" style="line-height: 1.55;">
                    Kirimkan file gambar beresolusi tinggi di bawah ini (atau tunjukkan halaman ini) ke tukang stempel dengan instruksi:
                </p>
                <ul class="small text-muted mb-0 ps-3" style="line-height: 1.6;">
                    <li><strong>Jenis Stempel:</strong> Stempel Flash Otomatis (Tanpa Bantalan Tinta Terpisah).</li>
                    <li><strong>Bentuk & Ukuran:</strong> Bulat Lingkaran Sempurna, <strong>Diameter 40 mm (4,0 cm)</strong> — <em>Ukuran paling standar perbankan</em>.</li>
                    <li><strong>Pilihan Warna Tinta:</strong>
                        <strong>Opsi 1 (Paling Aman untuk Bank):</strong> 1 Warna Tinta Ungu (*Violet*) atau Biru Tua (*Navy*).<br>
                        <strong>Opsi 2:</strong> 2 Warna (Lingkaran & Teks: Biru Navy, Logo <code>&lt;/&gt;</code>: Oranye) jika toko stempel mendukung spon 2 warna.
                    </li>
                </ul>
            </div>
        </div>

        <!-- 3 Pilihan Varian Stempel -->
        <div class="row g-4 mb-4">
            <!-- Varian 1: 2 Warna Asli (Navy + Oranye) -->
            <div class="col-md-4">
                <div class="stamp-box h-100 d-flex flex-column justify-content-between">
                    <div>
                        <span class="badge bg-gold text-navy fw-bold mb-2">Varian 1: Dua Warna Asli</span>
                        <h6 class="fw-bold text-navy mb-1">Biru Navy + Oranye</h6>
                        <small class="text-muted d-block mb-3">Sesuai brand identity asli Skillance</small>
                        <div class="stamp-circle size-40mm mb-3 mx-auto">
                            <img src="../../assets/img/stempel_skillance_asli_circle.png" class="img-fluid" alt="Stempel Skillance 2 Warna">
                        </div>
                        <div class="small text-muted mb-3">
                            <span class="badge bg-light text-dark border">Diameter 40 mm</span>
                        </div>
                    </div>
                    <div class="no-print">
                        <a href="../../assets/img/stempel_skillance_asli_circle.png" download="Stempel_PT_Skillance_2Warna_1000px.png" class="btn btn-outline-primary btn-sm w-100 fw-semibold">
                            <i class="fa-solid fa-download me-1"></i>Download PNG HD
                        </a>
                    </div>
                </div>
            </div>

            <!-- Varian 2: Monokrom Biru Navy -->
            <div class="col-md-4">
                <div class="stamp-box h-100 d-flex flex-column justify-content-between" style="border-color: #0d2e5c;">
                    <div>
                        <span class="badge bg-primary text-white fw-bold mb-2">Varian 2: Monokrom Navy (Rekomendasi)</span>
                        <h6 class="fw-bold text-navy mb-1">Satu Warna Biru Tua</h6>
                        <small class="text-muted d-block mb-3">Paling elegan & resmi diterima semua bank</small>
                        <div class="stamp-circle size-40mm mb-3 mx-auto">
                            <img src="../../assets/img/stempel_skillance_navy.png" class="img-fluid" alt="Stempel Skillance Navy">
                        </div>
                        <div class="small text-muted mb-3">
                            <span class="badge bg-light text-dark border">Diameter 40 mm</span>
                        </div>
                    </div>
                    <div class="no-print">
                        <a href="../../assets/img/stempel_skillance_navy.png" download="Stempel_PT_Skillance_Navy_1000px.png" class="btn btn-primary btn-sm w-100 fw-semibold bg-navy border-navy">
                            <i class="fa-solid fa-download me-1"></i>Download PNG HD
                        </a>
                    </div>
                </div>
            </div>

            <!-- Varian 3: Monokrom Ungu Violet -->
            <div class="col-md-4">
                <div class="stamp-box h-100 d-flex flex-column justify-content-between">
                    <div>
                        <span class="badge text-white fw-bold mb-2" style="background:#6b21a8;">Varian 3: Monokrom Ungu Standar</span>
                        <h6 class="fw-bold text-navy mb-1">Satu Warna Ungu Violet</h6>
                        <small class="text-muted d-block mb-3">Warna stempel paling umum perbankan RI</small>
                        <div class="stamp-circle size-40mm mb-3 mx-auto">
                            <img src="../../assets/img/stempel_skillance_ungu.png" class="img-fluid" alt="Stempel Skillance Ungu">
                        </div>
                        <div class="small text-muted mb-3">
                            <span class="badge bg-light text-dark border">Diameter 40 mm</span>
                        </div>
                    </div>
                    <div class="no-print">
                        <a href="../../assets/img/stempel_skillance_ungu.png" download="Stempel_PT_Skillance_Ungu_1000px.png" class="btn btn-outline-dark btn-sm w-100 fw-semibold">
                            <i class="fa-solid fa-download me-1"></i>Download PNG HD
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panduan Ukuran Nyata Skala 1:1 Saat Di-Print ke Kertas -->
        <div class="card shadow-sm border-0 p-4 mb-4 print-sheet">
            <h6 class="fw-bold text-navy mb-3">
                <i class="fa-solid fa-ruler-combined text-primary me-2"></i>Panduan Skala Cetak Fisik 1:1 (Diameter 38 mm, 40 mm, 42 mm)
            </h6>
            <p class="small text-muted mb-4">
                Letakkan koin atau penggaris pada lingkaran di bawah ini setelah dicetak pada kertas A4 untuk memastikan ukuran fisik cetak akurat.
            </p>

            <div class="row text-center g-4 align-items-end">
                <div class="col-4">
                    <div class="d-inline-block border border-dark rounded-circle p-1 mb-2" style="width: 38mm; height: 38mm; display: inline-flex; align-items: center; justify-content: center;">
                        <img src="../../assets/img/stempel_skillance_asli_circle.png" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <div class="fw-bold text-dark small">Diameter 38 mm (3,8 cm)</div>
                    <small class="text-muted" style="font-size: 0.7rem;">Ukuran Kompak</small>
                </div>
                <div class="col-4">
                    <div class="d-inline-block border border-2 border-primary rounded-circle p-1 mb-2 shadow-sm" style="width: 40mm; height: 40mm; display: inline-flex; align-items: center; justify-content: center;">
                        <img src="../../assets/img/stempel_skillance_navy.png" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <div class="fw-bold text-primary small">Diameter 40 mm (4,0 cm)</div>
                    <span class="badge bg-success-subtle text-success border border-success" style="font-size: 0.65rem;">STANDAR BANK (REKOMENDASI)</span>
                </div>
                <div class="col-4">
                    <div class="d-inline-block border border-dark rounded-circle p-1 mb-2" style="width: 42mm; height: 42mm; display: inline-flex; align-items: center; justify-content: center;">
                        <img src="../../assets/img/stempel_skillance_ungu.png" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    <div class="fw-bold text-dark small">Diameter 42 mm (4,2 cm)</div>
                    <small class="text-muted" style="font-size: 0.7rem;">Ukuran Eksekutif Besar</small>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
