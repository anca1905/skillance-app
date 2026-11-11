<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/index.php");
    exit();
}
if (($_SESSION['user_role'] ?? '') === 'freelancer') {
    header("Location: ../freelancer/index.php");
    exit();
}

$currentUserRole = $_SESSION['user_role'] ?? 'admin';
$currentUserName = $_SESSION['user_name'] ?? 'Pengguna';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuangan & Rekap SPT Pajak | PT Skillance Digital Indonesia</title>
    
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    
    <style>
        body {
            background-color: #f4f6f9;
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: var(--white);
            border-right: 1px solid rgba(0, 0, 0, 0.05);
            padding-top: 20px;
            z-index: 1000;
            transition: 0.3s;
        }

        .main-content {
            margin-left: 250px;
            padding: 24px 30px;
            transition: 0.3s;
        }

        .nav-link {
            color: var(--text-body);
            padding: 12px 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: var(--navy-subtle);
            color: var(--navy) !important;
            border-right: 3px solid var(--navy);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -260px;
            }

            .sidebar.active {
                margin-left: 0;
            }

            .main-content {
                margin-left: 0;
                padding: 16px 12px;
            }
        }

        .card {
            border: none;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.04);
            border-radius: 12px;
        }

        .nav-tabs .nav-link {
            border: none;
            border-bottom: 3px solid transparent;
            color: #6c757d;
            font-weight: 600;
            padding: 12px 18px;
            border-radius: 0;
        }

        .nav-tabs .nav-link:hover {
            border-color: transparent;
            color: var(--navy);
        }

        .nav-tabs .nav-link.active {
            background: transparent;
            border-color: transparent transparent var(--gold) transparent;
            color: var(--navy) !important;
            border-bottom-width: 3px;
        }

        .legal-banner {
            background: linear-gradient(135deg, #0d2e5c 0%, #174276 100%);
            color: #fff;
            border-radius: 12px;
            padding: 18px 22px;
        }
        
        .unit-card {
            transition: transform 0.2s, box-shadow 0.2s;
            border-left: 4px solid var(--gold) !important;
        }
        .unit-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.08);
        }
    </style>
</head>

<body>

    <?php
    $activeMenu = 'finance';
    include __DIR__ . '/../includes/sidebar.php';
    ?>

    <div class="main-content">
        <!-- Topbar Mobile -->
        <div class="d-flex justify-content-between align-items-center mb-4 d-md-none">
            <button class="btn btn-navy btn-sm sidebar-toggle-btn" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
            <span class="fw-bold text-navy">Keuangan & SPT Pajak</span>
        </div>

        <!-- Banner Legalitas PT -->
        <div class="legal-banner mb-4 shadow-sm">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="badge bg-gold text-navy fw-bold px-2 py-1" style="font-size: 0.72rem;">
                            <i class="fa-solid fa-building-columns me-1"></i> PORTAL KEUANGAN & PERPAJAKAN PT
                        </span>
                        <span class="badge bg-success bg-opacity-25 text-white border border-success border-opacity-50 px-2 py-1" style="font-size: 0.72rem;">
                            PPh Final UMKM 0.5% (PP 55/2022)
                        </span>
                    </div>
                    <h4 class="fw-bold mb-1 text-white">PT SKILLANCE DIGITAL INDONESIA</h4>
                    <p class="mb-0 text-white-50 small">
                        <span class="text-white">NPWP Badan:</span> <strong class="text-warning font-monospace">100000011940526</strong> &bull; 
                        <span class="text-white">SK Menkumham:</span> <span class="font-monospace">AHU-A138609.AH.01.30.Tahun 2026</span> &bull; 
                        <span class="text-white">KPP Pengampu:</span> Pratama Kolaka
                    </p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <button class="btn btn-outline-light btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#archiveModal" onclick="loadArchiveData()">
                        <i class="fa-solid fa-box-archive me-1 text-gold"></i> Arsip Pra-PT (<span id="archiveCountBadge">42</span>)
                    </button>
                    <a href="../payroll/index.php" class="btn btn-outline-warning text-white btn-sm shadow-sm">
                        <i class="fa-solid fa-money-check-dollar me-1 text-gold"></i> Penggajian & Honor Tim
                    </a>
                    <a href="../dokumen/index.php" class="btn btn-outline-warning text-white btn-sm shadow-sm">
                        <i class="fa-solid fa-folder-closed me-1 text-gold"></i> MoU & Dokumen Kemitraan
                    </a>
                    <a href="print_spt.php" target="_blank" class="btn btn-warning text-navy btn-sm fw-bold shadow-sm">
                        <i class="fa-solid fa-file-invoice-dollar me-1"></i> Cetak Rekap SPT 1771
                    </a>
                    <a href="stempel.php" class="btn btn-outline-light btn-sm shadow-sm">
                        <i class="fa-solid fa-stamp me-1 text-gold"></i> Stempel PT
                    </a>
                    <a href="print.php" target="_blank" class="btn btn-outline-light btn-sm shadow-sm">
                        <i class="fa-solid fa-print me-1"></i> Laba / Rugi
                    </a>
                    <button class="btn btn-light text-navy btn-sm fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#addTrxModal">
                        <i class="fa-solid fa-plus me-1 text-success"></i> Transaksi Baru
                    </button>
                </div>
            </div>
        </div>

        <!-- KPI Cards -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-lg-3">
                <div class="card bg-navy text-white h-100 shadow-sm border-0">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-white-50 text-uppercase fw-bold" style="font-size: 0.7rem;">Saldo Kas Saat Ini</small>
                            <i class="fa-solid fa-vault text-gold opacity-75"></i>
                        </div>
                        <h4 class="fw-bold mt-2 mb-0 text-white" id="statBalance">Rp 0</h4>
                        <small class="text-white-50" style="font-size: 0.72rem;">Kas Rekening & Tunai PT</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm" style="border-left: 4px solid #198754 !important;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Total Omzet Masuk</small>
                            <i class="fa-solid fa-arrow-trend-up text-success"></i>
                        </div>
                        <h4 class="fw-bold text-success mt-2 mb-0" id="statIncome">+ Rp 0</h4>
                        <small class="text-muted" style="font-size: 0.72rem;">Pemasukan Semua Unit</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm" style="border-left: 4px solid #dc3545 !important;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.7rem;">Total Pengeluaran</small>
                            <i class="fa-solid fa-arrow-trend-down text-danger"></i>
                        </div>
                        <h4 class="fw-bold text-danger mt-2 mb-0" id="statExpense">- Rp 0</h4>
                        <small class="text-muted" style="font-size: 0.72rem;">Beban Operasional & Fee</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm" style="border-left: 4px solid #f59e0b !important; background: #fffdf5;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <small class="text-warning-emphasis text-uppercase fw-bold" style="font-size: 0.7rem;">PPh Final 0.5% (Tahun Ini)</small>
                            <i class="fa-solid fa-receipt text-warning"></i>
                        </div>
                        <h4 class="fw-bold mt-2 mb-0" id="statPph" style="color: #92400e !important;">Rp 0</h4>
                        <small class="text-muted" style="font-size: 0.72rem;">Pajak SPT Badan Terutang</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-white border-bottom p-0">
                <ul class="nav nav-tabs px-3" id="financeTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="tab-trx-btn" data-bs-toggle="tab" data-bs-target="#tab-trx" type="button" role="tab">
                            <i class="fa-solid fa-book me-2 text-primary"></i> Buku Kas & Transaksi
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-spt-btn" data-bs-toggle="tab" data-bs-target="#tab-spt" type="button" role="tab">
                            <i class="fa-solid fa-scale-balanced me-2 text-warning"></i> Rekapitulasi SPT Pajak Badan (PP 55)
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="tab-units-btn" data-bs-toggle="tab" data-bs-target="#tab-units" type="button" role="tab">
                            <i class="fa-solid fa-sitemap me-2 text-success"></i> Unit Bisnis & Anak Usaha
                        </button>
                    </li>
                </ul>
            </div>

            <div class="card-body p-4">
                <div class="tab-content" id="financeTabsContent">
                    
                    <!-- TAB 1: BUKU KAS & TRANSAKSI -->
                    <div class="tab-pane fade show active" id="tab-trx" role="tabpanel">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                            <h6 class="fw-bold text-navy mb-0">
                                <i class="fa-solid fa-clock-rotate-left me-2"></i>Daftar Riwayat Transaksi Kas
                            </h6>
                            <div class="d-flex gap-2">
                                <select id="filterUnit" class="form-select form-select-sm" style="width: 200px;">
                                    <option value="">Semua Unit Usaha</option>
                                    <option value="Software House">Software House</option>
                                    <option value="Bursa Freelance">Bursa Freelance</option>
                                    <option value="Skillance Academy">Skillance Academy</option>
                                    <option value="Aquirist Print">Aquirist Print</option>
                                    <option value="Penyewaan Akrilik">Penyewaan Akrilik</option>
                                    <option value="Media Pemberitaan">Media Pemberitaan</option>
                                    <option value="Operasional Kantor">Operasional Kantor</option>
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-muted small">
                                    <tr>
                                        <th class="ps-3">TANGGAL</th>
                                        <th>KETERANGAN TRANSAKSI</th>
                                        <th>UNIT USAHA</th>
                                        <th>KATEGORI</th>
                                        <th>TIPE</th>
                                        <th class="text-end">NOMINAL</th>
                                        <th class="text-center pe-3">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody id="trxList">
                                    <tr>
                                        <td colspan="7" class="text-center py-4 text-muted">
                                            <i class="fa-solid fa-spinner fa-spin me-2"></i>Memuat catatan keuangan...
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- TAB 2: REKAPITULASI SPT PAJAK BADAN (PP 55) -->
                    <div class="tab-pane fade" id="tab-spt" role="tabpanel">
                        <div class="alert alert-light border border-warning border-opacity-50 p-3 mb-4 rounded-3">
                            <div class="d-flex align-items-start gap-3">
                                <i class="fa-solid fa-circle-info fs-3 text-warning mt-1"></i>
                                <div>
                                    <h6 class="fw-bold text-navy mb-1">Panduan Pengisian SPT Tahunan PPh Wajib Pajak Badan (Formulir 1771-III)</h6>
                                    <p class="small text-muted mb-2">
                                        Sebagai PT Perorangan skala Mikro, PT Skillance Digital Indonesia menggunakan skema <strong>PPh Final PP 55 Tahun 2022 (0,5% dari Peredaran Bruto Bulanan)</strong>. 
                                        Tabel di bawah ini telah dikelompokkan otomatis per masa pajak (Januari - Desember) untuk memudahkan Bendahara / Konsultan Pajak saat mengisi formulir SPT Badan di DJP Online / Coretax.
                                    </p>
                                    <div class="d-flex flex-wrap gap-2">
                                        <span class="badge bg-light text-dark border">
                                            <i class="fa-solid fa-calendar me-1 text-primary"></i> Batas Lapor SPT: <strong>30 April Tahun Berikutnya</strong>
                                        </span>
                                        <span class="badge bg-light text-dark border">
                                            <i class="fa-solid fa-tag me-1 text-success"></i> Kode Akun Pajak: <strong>411128 - 420 (PPh Final UMKM)</strong>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
                            <div class="d-flex align-items-center gap-2">
                                <label class="small fw-bold text-navy mb-0">Tahun Pajak:</label>
                                <select id="selectTaxYear" class="form-select form-select-sm fw-bold text-navy" style="width: 120px;">
                                    <option value="2026" selected>2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                </select>
                            </div>
                            <a href="print_spt.php" id="linkPrintSpt" target="_blank" class="btn btn-warning text-navy btn-sm fw-bold shadow-sm">
                                <i class="fa-solid fa-print me-1"></i> Cetak Format Lampiran SPT 1771-III
                            </a>
                        </div>

                        <!-- SPT 12 Bulan Table -->
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle mb-0">
                                <thead class="table-light text-navy text-center small">
                                    <tr>
                                        <th style="width: 60px;">NO</th>
                                        <th>MASA PAJAK (BULAN)</th>
                                        <th class="text-end">PEREDARAN BRUTO (OMZET)</th>
                                        <th style="width: 110px;">TARIF PPh</th>
                                        <th class="text-end">PPh FINAL TERUTANG (0,5%)</th>
                                        <th class="text-end">TOTAL BIAYA</th>
                                        <th class="text-end">LABA BERSIH</th>
                                        <th class="text-center" style="width: 130px;">STATUS SETOR</th>
                                    </tr>
                                </thead>
                                <tbody id="sptTableBody">
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-muted">
                                            <i class="fa-solid fa-spinner fa-spin me-2"></i>Menghitung rekapitulasi SPT pajak...
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot class="table-light fw-bold" id="sptTableFoot">
                                    <tr>
                                        <td colspan="2" class="text-center">TOTAL TAHUNAN</td>
                                        <td class="text-end text-success" id="sptTotalOmzet">Rp 0</td>
                                        <td class="text-center">0,5%</td>
                                        <td class="text-end text-warning-emphasis" id="sptTotalPph">Rp 0</td>
                                        <td class="text-end text-danger" id="sptTotalBiaya">Rp 0</td>
                                        <td class="text-end text-navy" id="sptTotalLaba">Rp 0</td>
                                        <td class="text-center"><span class="badge bg-secondary">Rekap SPT</span></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>

                    <!-- TAB 3: UNIT BISNIS & ANAK USAHA -->
                    <div class="tab-pane fade" id="tab-units" role="tabpanel">
                        <div class="mb-3">
                            <h6 class="fw-bold text-navy mb-1">
                                <i class="fa-solid fa-building-flag me-2"></i>Kinerja Keuangan Ekosistem Bisnis PT Skillance
                            </h6>
                            <small class="text-muted">Pencatatan omzet dan pengeluaran per unit usaha anak perusahaan secara terpisah dan terintegrasi.</small>
                        </div>

                        <div class="row g-3" id="unitsGrid">
                            <div class="col-12 text-center py-4 text-muted">
                                <i class="fa-solid fa-spinner fa-spin me-2"></i>Memuat kinerja unit usaha...
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Catat Transaksi Baru -->
    <div class="modal fade" id="addTrxModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-navy text-white">
                    <h6 class="modal-title fw-bold text-white">
                        <i class="fa-solid fa-file-circle-plus text-gold me-2"></i>Catat Transaksi Keuangan PT
                    </h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="trxForm">
                    <div class="modal-body p-4">
                        <div class="row mb-3 g-2">
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="type" id="typeIn" value="income" checked>
                                <label class="btn btn-outline-success w-100 fw-bold py-2" for="typeIn">
                                    <i class="fa-solid fa-arrow-down me-1"></i> Pemasukan (Omzet)
                                </label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="type" id="typeOut" value="expense">
                                <label class="btn btn-outline-danger w-100 fw-bold py-2" for="typeOut">
                                    <i class="fa-solid fa-arrow-up me-1"></i> Pengeluaran (Biaya)
                                </label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small text-muted fw-bold">UNIT BISNIS / ANAK PERUSAHAAN</label>
                            <select class="form-select" id="trxUnit" required>
                                <option value="Software House" selected>1. Software House & IT Solusi</option>
                                <option value="Bursa Freelance">2. Bursa Freelance Skillance</option>
                                <option value="Skillance Academy">3. Skillance Academy (Edukasi)</option>
                                <option value="Aquirist Print">4. Aquirist Print (Percetakan)</option>
                                <option value="Penyewaan Akrilik">5. Penyewaan Akrilik Event</option>
                                <option value="Media Pemberitaan">6. Media Pemberitaan & Berita</option>
                                <option value="Operasional Kantor">7. Operasional Kantor & Cloud</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="small text-muted fw-bold">NOMINAL TRANSAKSI (Rp)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light fw-bold text-navy">Rp</span>
                                <input type="number" class="form-control" id="trxAmount" placeholder="0" min="1" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small text-muted fw-bold">KETERANGAN TRANSAKSI</label>
                            <textarea class="form-control" id="trxDesc" rows="2" placeholder="Contoh: DP Pembuatan Web Dinas / Pembayaran Sewa Akrilik" required></textarea>
                            <small class="text-muted" style="font-size: 0.72rem;">Sertakan nomor invoice / nama klien / vendor untuk mempermudah pembukuan.</small>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="small text-muted fw-bold">KATEGORI AKUN</label>
                                <select class="form-select" id="trxCategory">
                                    <option value="Project">Project / Layanan</option>
                                    <option value="Operasional">Operasional / Server</option>
                                    <option value="Honorarium">Honor / Fee Tim</option>
                                    <option value="Bahan Baku">Bahan Baku / Cetak</option>
                                    <option value="Pajak & Bank">Pajak & Administrasi Bank</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="small text-muted fw-bold">TANGGAL TRANSAKSI</label>
                                <input type="date" class="form-control" id="trxDate" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-navy text-white btn-sm fw-bold px-3" id="btnSaveTrx">
                            <i class="fa-solid fa-save me-1"></i> Simpan Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Arsip Transaksi Lama Pra-PT (Jokian & Historis) -->
    <div class="modal fade" id="archiveModal" tabindex="-1">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-dark text-white">
                    <div class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-box-archive text-gold fs-5"></i>
                        <div>
                            <h6 class="modal-title fw-bold text-white mb-0">Arsip Pembukuan Historis Pra-PT (Projek Jokian)</h6>
                            <small class="text-white-50" style="font-size: 0.72rem;">Catatan keuangan masa lalu sebelum berbadan hukum resmi PT Skillance Digital Indonesia</small>
                        </div>
                    </div>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-warning py-2.5 px-3 small d-flex align-items-center justify-content-between mb-3 rounded-3">
                        <div>
                            <i class="fa-solid fa-shield-halved text-warning me-2"></i>
                            <strong>Pemberitahuan Arsip:</strong> Data di bawah ini adalah rekaman transaksi masa lalu (sebelum pendirian PT resmi) yang diarsipkan agar tetap bisa ditinjau untuk referensi proyek. Data ini <strong>tidak</strong> memengaruhi penghitungan SPT Badan PT Skillance yang dimulai dari bulan lalu.
                        </div>
                        <span class="badge bg-dark px-2.5 py-1.5 ms-3">42 Catatan Tersimpan</span>
                    </div>

                    <div class="row g-2 mb-3">
                        <div class="col-md-8">
                            <input type="text" id="searchArchiveInput" class="form-control form-control-sm" placeholder="Cari nama project, sekolah, instansi, atau keterangan...">
                        </div>
                        <div class="col-md-4 text-end">
                            <span class="small text-muted">Total Omzet Historis: <strong class="text-navy" id="archiveTotalIncome">Rp 0</strong></span>
                        </div>
                    </div>

                    <div class="table-responsive" style="max-height: 450px;">
                        <table class="table table-sm table-hover align-middle mb-0">
                            <thead class="table-light small sticky-top">
                                <tr>
                                    <th class="ps-3" style="width: 100px;">TANGGAL</th>
                                    <th>KETERANGAN / NAMA PROJEK</th>
                                    <th style="width: 130px;">KATEGORI</th>
                                    <th style="width: 90px;">TIPE</th>
                                    <th class="text-end pe-3" style="width: 130px;">NOMINAL</th>
                                </tr>
                            </thead>
                            <tbody id="archiveTableBody" class="small">
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        <i class="fa-solid fa-spinner fa-spin me-2"></i>Memuat data arsip...
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <span class="small text-muted me-auto"><i class="fa-solid fa-database me-1"></i> Dump Backup SQL lengkap tersimpan di server & komputer lokal</span>
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../assets/js/finance.js"></script>

</body>

</html>
