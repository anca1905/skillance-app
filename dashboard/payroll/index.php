<?php
session_start();
require_once __DIR__ . '/../../config/config.php';

// Cek hak akses: hanya admin dan bendahara yang boleh mengakses halaman ini
$currentUserRole = $_SESSION['user_role'] ?? $_SESSION['role'] ?? '';
if (!isset($_SESSION['user_id']) || !in_array($currentUserRole, ['admin', 'bendahara'])) {
    header("Location: ../finance/index.php");
    exit();
}

$pageTitle = "Penggajian & Honorarium Tim";
$activeMenu = "payroll";
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
        :root {
            --navy: #0d2e5c;
            --gold: #f59e0b;
        }

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
            background-color: #ffffff;
            border-right: 1px solid rgba(0, 0, 0, 0.05);
            padding-top: 20px;
            z-index: 1000;
            transition: 0.3s;
            overflow-y: auto;
        }

        .main-content {
            margin-left: 250px;
            padding: 24px 30px;
            transition: 0.3s;
            min-height: 100vh;
        }

        .nav-link {
            color: #4b5563;
            padding: 12px 20px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.3s;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: #e0e7ff;
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

        .text-navy { color: var(--navy) !important; }
        .bg-navy { background-color: var(--navy) !important; }
        .border-navy { border-color: var(--navy) !important; }
        .role-badge {
            font-size: 0.75rem;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 600;
        }
        .role-badge.programmer { background: #e0e7ff; color: #4338ca; }
        .role-badge.designer { background: #fce7f3; color: #be185d; }
        .hover-card {
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        .hover-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 .5rem 1rem rgba(0,0,0,.08)!important;
        }
    </style>
</head>
<body class="bg-light">

    <!-- Sidebar Dynamic (Admin & Bendahara) -->
    <?php include __DIR__ . '/../includes/sidebar.php'; ?>

    <div class="main-content">
        <!-- Topbar Mobile -->
        <div class="d-flex justify-content-between align-items-center mb-3 d-md-none">
            <button class="btn btn-navy btn-sm sidebar-toggle-btn" id="sidebarToggle" onclick="window.toggleSidebar()"><i class="fa-solid fa-bars"></i></button>
            <span class="fw-bold text-navy">Penggajian & Bagi Hasil</span>
        </div>
        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <div class="d-flex align-items-center gap-2 mb-1">
                    <span class="badge bg-gold text-navy fw-bold px-2.5 py-1 small">
                        <i class="fa-solid fa-coins me-1"></i>S-PAYROLL & PROFIT SHARING
                    </span>
                    <span class="badge bg-light text-muted border small">PT Skillance Digital Indonesia</span>
                </div>
                <h3 class="fw-bold text-navy mb-0">Penggajian & Bagi Hasil Proyek Tim</h3>
                <p class="text-muted small mb-0 mt-1">
                    Kelola pencatatan kompensasi per-proyek (revenue sharing) dan honorarium tim ekosistem PT Skillance Digital Indonesia.
                </p>
            </div>
            <div class="d-flex gap-2">
                <a href="../finance/index.php" class="btn btn-outline-secondary btn-sm shadow-sm py-2 px-3 fw-semibold">
                    <i class="fa-solid fa-book me-1.5"></i>Buku Kas PT
                </a>
                <button class="btn btn-navy text-white btn-sm shadow-sm py-2 px-3 fw-semibold" data-bs-toggle="modal" data-bs-target="#addPayrollModal">
                    <i class="fa-solid fa-plus me-1.5"></i>Tambah Catatan Honor / Bagi Hasil
                </button>
            </div>
        </div>

        <!-- Ecosystem Notice Banner: Penjelasan Skema Gaji Per-Proyek & Kas Realistis -->
        <div class="alert alert-warning border-0 shadow-sm p-3 mb-4 rounded-3 d-flex align-items-start gap-3" style="background-color: #fffbeb; border-left: 5px solid #f59e0b !important;">
            <i class="fa-solid fa-shield-halved fs-3 text-warning mt-1"></i>
            <div>
                <h6 class="fw-bold text-warning-emphasis mb-1">
                    Prinsip Keuangan: Skema Bagi Hasil Per-Proyek (Cashflow Protection)
                </h6>
                <p class="small text-muted mb-0" style="line-height: 1.55;">
                    Karena kondisi kas rintisan saat ini berbasis perputaran proyek (belum gaji bulanan tetap), pembayaran honor programmer, desainer, dan tim teknis menganut sistem <strong>Bagi Hasil Nilai Proyek (Profit Sharing)</strong>. Honor hanya dicairkan setelah pembayaran/termin dari klien masuk ke rekening PT Skillance untuk menjaga kas perusahaan tetap sehat dan tidak defisit.
                </p>
            </div>
        </div>

        <!-- Dua Pilar Model Pembayaran di Ekosistem Skillance -->
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm" style="border-left: 4px solid #f59e0b !important;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h6 class="fw-bold mb-0 text-navy">
                                <i class="fa-solid fa-store text-warning me-1.5"></i> 1. Aquirist Print & Acrylic Studio
                            </h6>
                            <span class="badge bg-warning-subtle text-warning-emphasis small border border-warning">Anak Usaha Toko</span>
                        </div>
                        <p class="small text-muted mb-2" style="font-size: 0.78rem;">
                            Penggajian kasir/operator toko dihitung otomatis di sistem toko: <strong>40% Pekerja</strong>, <strong>20% Maintenance/Kertas</strong>, dan <strong>40% Setoran Pemilik/PT</strong>.
                        </p>
                        <a href="https://aquiris.skillance.cloud/bagi_hasil.php" target="_blank" class="btn btn-outline-warning btn-sm text-dark py-1 px-2.5 fw-semibold" style="font-size: 0.74rem;">
                            <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Buka Bagi Hasil Aquirist
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm" style="border-left: 4px solid #0d2e5c !important;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h6 class="fw-bold mb-0 text-navy">
                                <i class="fa-solid fa-laptop-code text-primary me-1.5"></i> 2. Tim Software House & Edukasi Skillance
                            </h6>
                            <span class="badge bg-navy text-white small">Holding PT</span>
                        </div>
                        <p class="small text-muted mb-2" style="font-size: 0.78rem;">
                            Pencatatan bagi hasil programmer/desainer per project. Saat status ditandai <strong>"Dibayar"</strong>, sistem otomatis memotong saldo kas PT dan mencatat pengeluaran di Buku Kas PT Skillance.
                        </p>
                        <button class="btn btn-outline-navy btn-sm py-1 px-2.5 fw-semibold" style="font-size: 0.74rem;" data-bs-toggle="modal" data-bs-target="#addPayrollModal">
                            <i class="fa-solid fa-plus me-1"></i> Tambah Catatan Honor Tim
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- KPI Cards -->
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-0" style="border-left: 4px solid #f59e0b !important; background: #fffcf0;">
                    <div class="card-body p-3 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase fw-bold text-warning-emphasis" style="font-size: 0.7rem;">Tagihan Honor Pending (Menunggu Pembayaran Klien/Pencairan)</small>
                            <h3 class="fw-bold mb-0 mt-1" id="totalPending" style="color: #92400e !important;">Rp 0</h3>
                        </div>
                        <i class="fa-solid fa-clock-rotate-left fs-2 text-warning opacity-75"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 shadow-sm border-0" style="border-left: 4px solid #198754 !important;">
                    <div class="card-body p-3 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase fw-bold text-muted" style="font-size: 0.7rem;">Total Honor Telah Ditransfer (Buku Kas PT)</small>
                            <h3 class="fw-bold mb-0 mt-1 text-success" id="totalPaid">Rp 0</h3>
                        </div>
                        <i class="fa-solid fa-check-double fs-2 text-success opacity-75"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Payroll -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="fw-bold text-navy mb-0">
                    <i class="fa-solid fa-list-check me-2"></i>Daftar Penggajian & Bagi Hasil Tim
                </h6>
                <small class="text-muted">Data otomatis tersinkronisasi dengan Buku Kas PT Skillance</small>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light small text-muted">
                            <tr>
                                <th class="ps-4">KARYAWAN / PENERIMA</th>
                                <th>UNIT BISNIS</th>
                                <th>PERAN / TUGAS</th>
                                <th>RINCIAN TUGAS / PROYEK</th>
                                <th>QTY x TARIF</th>
                                <th>TOTAL HONOR</th>
                                <th>STATUS</th>
                                <th class="text-end pe-4">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="payrollList">
                            <tr>
                                <td colspan="8" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-spinner fa-spin me-2"></i>Memuat data penggajian...
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Payroll Modal -->
    <div class="modal fade" id="addPayrollModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-navy text-white">
                    <h6 class="modal-title fw-bold text-white">
                        <i class="fa-solid fa-file-circle-plus text-gold me-2"></i>Catat Honorarium / Bagi Hasil Proyek
                    </h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="payrollForm">
                    <div class="modal-body p-4">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold">PENERIMA / KARYAWAN</label>
                            <select id="pUser" class="form-select" required>
                                <option value="">-- Pilih Karyawan --</option>
                            </select>
                        </div>

                        <!-- Hubungkan ke Project untuk Bagi Hasil -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <label class="small text-muted fw-bold">HUBUNGKAN DENGAN PROYEK (OPSIONAL)</label>
                                <span class="badge bg-primary-subtle text-primary border" style="font-size: 0.65rem;">Kalkulator Bagi Hasil</span>
                            </div>
                            <select id="pProject" class="form-select">
                                <option value="0">-- Bukan Terkait Proyek Spesifik (Honor Lepas) --</option>
                            </select>
                            
                            <div id="projectInfoBox" class="p-3 mt-2 rounded-3 border bg-light d-none" style="font-size: 0.8rem;">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <span class="text-muted">Nilai Kontrak Klien:</span>
                                    <span class="fw-bold fs-6 text-navy" id="projPriceDisplay">Rp 0</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">Status Bayar Klien:</span>
                                    <span class="badge bg-secondary" id="projPayStatusDisplay">-</span>
                                </div>

                                <!-- Rincian Skema Bagi Hasil PT Skillance (50% Kas PT, 40% Programmer, 10% Bendahara) -->
                                <div class="card p-2.5 border-0 bg-white shadow-sm mb-2 rounded-3">
                                    <div class="d-flex justify-content-between align-items-center mb-1.5 pb-1 border-bottom">
                                        <span class="fw-bold text-navy" style="font-size: 0.76rem;">
                                            <i class="fa-solid fa-chart-pie text-warning me-1"></i>Simulasi Bagi Hasil Proyek:
                                        </span>
                                        <span class="badge bg-primary-subtle text-primary fw-bold" style="font-size: 0.65rem;">50% - 40% - 10%</span>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-0.5">
                                        <span class="text-muted small"><i class="fa-solid fa-building-columns text-navy me-1"></i>Kas PT Skillance (50%):</span>
                                        <strong class="text-navy" id="calcKasPt">Rp 0</strong>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-0.5">
                                        <span class="text-muted small"><i class="fa-solid fa-code text-primary me-1"></i>Programmer / Tim Teknis (40%):</span>
                                        <strong class="text-primary" id="calcProg">Rp 0</strong>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center py-0.5">
                                        <span class="text-muted small"><i class="fa-solid fa-vault text-warning me-1"></i>Bendahara Keuangan (10%):</span>
                                        <strong class="text-warning-emphasis" id="calcBendahara">Rp 0</strong>
                                    </div>
                                </div>

                                <div class="text-muted small mb-1 fw-bold" style="font-size: 0.72rem;">TERAPKAN FEE KE FORM:</div>
                                <div class="row g-1 mb-1">
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-primary btn-sm w-100 py-1.5 fw-bold" onclick="applyRoleShare('Programmer', 0.40)">
                                            <i class="fa-solid fa-code me-1"></i>40% Programmer
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-outline-warning text-dark btn-sm w-100 py-1.5 fw-bold" onclick="applyRoleShare('Bendahara', 0.10)">
                                            <i class="fa-solid fa-vault me-1"></i>10% Bendahara
                                        </button>
                                    </div>
                                </div>
                                <div class="btn-group w-100 mt-1" role="group">
                                    <button type="button" class="btn btn-outline-secondary btn-sm py-1" onclick="applyProjectShare(0.50, '50% Eksekutor / 50% Kas PT')">50%</button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm py-1" onclick="applyProjectShare(0.35, '35% Programmer / 15% Bendahara')">35%</button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm py-1" onclick="applyProjectShare(0.15, '15% Bendahara')">15%</button>
                                    <button type="button" class="btn btn-outline-secondary btn-sm py-1" onclick="applyProjectShare(0.30, '30% Fee')">30%</button>
                                </div>
                                <div class="text-muted mt-1.5" style="font-size: 0.68rem;" id="shareNote">
                                    * Klik tombol di atas untuk mengisi tarif honor secara otomatis.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="small text-muted fw-bold">UNIT BISNIS ANAK PERUSAHAAN</label>
                            <select id="pUnit" class="form-select" required>
                                <option value="Software House" selected>1. Software House & IT Solusi</option>
                                <option value="Skillance Academy">2. Skillance Academy</option>
                                <option value="Aquirist Print">3. Aquirist Print & Percetakan</option>
                                <option value="Media Pemberitaan">4. Media Pemberitaan & Berita</option>
                                <option value="Operasional Kantor">5. Operasional Kantor & Manajemen</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="small text-muted fw-bold">JENIS PERAN / PEKERJAAN</label>
                            <select id="pRole" class="form-select" required>
                                <option value="Programmer">Programmer (Tim Teknis / Coding)</option>
                                <option value="Bendahara">Bendahara (Admin Keuangan & Invoicing)</option>
                                <option value="Designer">Desainer Grafis (Per Konten / Banner)</option>
                                <option value="Operator Toko">Operator Toko Cetak / Akrilik (Rp 50k / shift)</option>
                                <option value="Instruktur">Instruktur / Mentor Bootcamp (Rp 200k / sesi)</option>
                                <option value="Jurnalis">Jurnalis / Penulis Berita (Rp 35k / artikel)</option>
                                <option value="Staf Operasional">Staf Operasional / Kustom</option>
                            </select>
                        </div>

                        <div class="mb-3 d-none" id="complexityContainer">
                            <label class="small text-muted fw-bold">TINGKAT KESULITAN (DESAINER)</label>
                            <select id="pComplexity" class="form-select">
                                <option value="Standard">1 Layer / Simple (Rp 15.000)</option>
                                <option value="Complex">Multi Slide / Banyak Layer (Rp 25.000)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="small text-muted fw-bold">NAMA PROJECT / RINCIAN TUGAS</label>
                            <input type="text" id="pDesc" class="form-control" placeholder="Contoh: Modul Absensi SIMS / Desain Feed Instagram" required>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="small text-muted fw-bold">TARIF SATUAN (Rp)</label>
                                <input type="number" id="pRate" class="form-control" value="500000" min="1000" step="1000" required>
                            </div>
                            <div class="col-6">
                                <label class="small text-muted fw-bold">JUMLAH (QTY)</label>
                                <input type="number" id="pQty" class="form-control" value="1" min="1" required>
                            </div>
                        </div>
                        
                        <div class="alert alert-info py-2.5 mb-0 d-flex justify-content-between align-items-center rounded-3">
                            <span class="small fw-bold text-navy">Total Estimasi Honor:</span>
                            <span class="fw-bold fs-5 text-navy" id="pTotalEstimasi">Rp 500.000</span>
                        </div>
                    </div>
                    <div class="modal-footer bg-light py-2">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-navy text-white btn-sm fw-bold px-3">
                            <i class="fa-solid fa-save me-1"></i> Simpan Catatan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../assets/js/payroll.js"></script>

</body>
</html>
