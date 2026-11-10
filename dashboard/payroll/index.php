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
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penggajian & Honor Tim | PT Skillance Digital Indonesia</title>

    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    
    <style>
        body { background-color: #f4f6fa; overflow-x: hidden; font-family: 'Inter', sans-serif; }
        .sidebar { width: 250px; height: 100vh; position: fixed; top: 0; left: 0; background-color: var(--white); border-right: 1px solid rgba(0,0,0,0.05); padding-top: 20px; z-index: 1000; transition: 0.3s; }
        .main-content { margin-left: 250px; padding: 24px 30px; transition: 0.3s; }
        .nav-link { color: var(--text-body); padding: 12px 20px; font-weight: 500; display: flex; align-items: center; gap: 10px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background-color: var(--navy-subtle); color: var(--navy) !important; border-right: 3px solid var(--navy); }
        .nav-link i { width: 20px; text-align: center; }
        @media (max-width: 768px) { .sidebar { margin-left: -250px; } .sidebar.active { margin-left: 0; } .main-content { margin-left: 0; padding: 16px 12px; } }
        .card { border: none; box-shadow: 0 2px 15px rgba(0,0,0,0.04); border-radius: 12px; }
        
        .ecosystem-banner {
            background: linear-gradient(135deg, #0d2e5c 0%, #174276 100%);
            border-radius: 12px;
            color: #fff;
            padding: 20px 24px;
        }
    </style>
</head>
<body>

    <?php
    $activeMenu = 'payroll';
    include __DIR__ . '/../includes/sidebar.php';
    ?>

    <div class="main-content">
        <!-- Topbar Mobile -->
        <div class="d-flex justify-content-between align-items-center mb-4 d-md-none">
            <button class="btn btn-navy btn-sm sidebar-toggle-btn" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
            <span class="fw-bold text-navy">Penggajian & Honor Tim</span>
        </div>

        <!-- Banner Ekosistem Holding -->
        <div class="ecosystem-banner mb-4 shadow-sm">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <div class="d-flex align-items-center gap-2 mb-1">
                        <span class="badge bg-gold text-navy fw-bold px-2 py-1" style="font-size: 0.7rem;">
                            <i class="fa-solid fa-money-check-dollar me-1"></i> PAYROLL & HONORARIUM PT
                        </span>
                        <span class="badge bg-success bg-opacity-25 text-white border border-success border-opacity-50 px-2 py-1" style="font-size: 0.7rem;">
                            Auto-Sync Buku Kas
                        </span>
                    </div>
                    <h4 class="fw-bold mb-1 text-white">Penggajian & Honor Tim Ekosistem PT</h4>
                    <p class="mb-0 text-white-50 small">
                        Pencatatan fee programmer, desainer, staf operasional, serta integrasi bagi hasil toko anak usaha (Aquirist Print).
                    </p>
                </div>
                <div class="d-flex flex-wrap gap-2">
                    <a href="https://aquiris.skillance.cloud/bagi_hasil.php" target="_blank" class="btn btn-warning text-navy btn-sm fw-bold shadow-sm">
                        <i class="fa-solid fa-store me-1"></i> Bagi Hasil Aquirist Print
                    </a>
                    <button class="btn btn-light text-navy btn-sm fw-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#addPayrollModal">
                        <i class="fa-solid fa-plus me-1 text-success"></i> Catat Gaji / Honor Baru
                    </button>
                </div>
            </div>
        </div>

        <!-- Edukasi Integrasi Anakan Usaha -->
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm" style="border-left: 4px solid #f59e0b !important; background: #fffcf0;">
                    <div class="card-body p-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h6 class="fw-bold mb-0 text-dark">
                                <i class="fa-solid fa-print text-warning me-1.5"></i> 1. Aquirist Print & Akrilik Studio
                            </h6>
                            <span class="badge bg-warning text-dark small">Toko Fisik</span>
                        </div>
                        <p class="small text-muted mb-2" style="font-size: 0.78rem;">
                            Sistem kasir dan bagi hasil toko berjalan mandiri di <strong>aquiris.skillance.cloud</strong> dengan skema otomatis: <strong>40% Upah Pekerja Toko</strong>, <strong>20% Kas Cadangan</strong>, dan <strong>40% Setoran ke Pemilik/PT</strong>.
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
                                <i class="fa-solid fa-laptop-code text-primary me-1.5"></i> 2. Tim Internal Skillance & Software House
                            </h6>
                            <span class="badge bg-navy text-white small">Holding PT</span>
                        </div>
                        <p class="small text-muted mb-2" style="font-size: 0.78rem;">
                            Pencatatan fee programmer berbasis project, desainer grafis per konten, dan staf operasional. Saat status ditandai <strong>"Dibayar"</strong>, sistem otomatis memotong saldo dan mencatat pengeluaran di Buku Kas PT Skillance.
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
                            <small class="text-uppercase fw-bold text-warning-emphasis" style="font-size: 0.7rem;">Tagihan Honor Pending (Belum Ditransfer)</small>
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
                            <small class="text-uppercase fw-bold text-muted" style="font-size: 0.7rem;">Total Honor Telah Ditransfer</small>
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
                    <i class="fa-solid fa-list-check me-2"></i>Daftar Penggajian & Honorarium Tim
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
                                <th>RINCIAN TUGAS</th>
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
                        <i class="fa-solid fa-file-circle-plus text-gold me-2"></i>Catat Gaji / Honorarium Tim
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
                                <option value="Programmer">Programmer (Preset Rp 500k / project)</option>
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
                            <label class="small text-muted fw-bold">NAMA PROJECT / DESKRIPSI PEKERJAAN</label>
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
