<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penggajian | S-OS Skillance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        body { background-color: #f3f4f6; overflow-x: hidden; font-family: 'Inter', sans-serif; }
        .sidebar { width: 250px; height: 100vh; position: fixed; top: 0; left: 0; background-color: var(--white); border-right: 1px solid rgba(0,0,0,0.05); padding-top: 20px; z-index: 1000; transition: 0.3s; }
        .main-content { margin-left: 250px; padding: 20px; transition: 0.3s; }
        .nav-link { color: var(--text-body); padding: 12px 20px; font-weight: 500; display: flex; align-items: center; gap: 10px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background-color: var(--navy-subtle); color: var(--navy) !important; border-right: 3px solid var(--navy); }
        .nav-link i { width: 20px; text-align: center; }
        @media (max-width: 768px) { .sidebar { margin-left: -250px; } .sidebar.active { margin-left: 0; } .main-content { margin-left: 0; } }
        .card { border: none; box-shadow: 0 2px 15px rgba(0,0,0,0.03); border-radius: 8px; }
        
        .role-badge.programmer { background-color: #e0e7ff; color: #4338ca; }
        .role-badge.designer { background-color: #fce7f3; color: #be185d; }
    </style>
</head>
<body>

    <nav class="sidebar shadow-sm" id="sidebar">
        <div class="px-4 mb-4 d-flex align-items-center gap-2">
            <i class="fa-solid fa-code text-gold fs-4"></i>
            <div>
                <h5 class="fw-bold text-navy mb-0 ls-2">SKILLANCE</h5>
                <small class="text-muted" style="font-size: 0.65rem;">OFFICE SYSTEM</small>
            </div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="../index.php" class="nav-link"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
            <li class="nav-item"><a href="../project/index.php" class="nav-link"><i class="fa-solid fa-briefcase"></i> Project</a></li>
            <li class="nav-item"><a href="../finance/index.php" class="nav-link"><i class="fa-solid fa-wallet"></i> Keuangan</a></li>
            <li class="nav-item"><a href="../investment/index.php" class="nav-link"><i class="fa-solid fa-hand-holding-dollar"></i> Investasi Admin</a></li>
            <li class="nav-item"><a href="../hrd/index.php" class="nav-link"><i class="fa-solid fa-users"></i> HRD</a></li>
            <li class="nav-item"><a href="../team/index.php" class="nav-link"><i class="fa-solid fa-people-group"></i> Manajemen Tim</a></li>
            <li class="nav-item"><a href="../payroll/index.php" class="nav-link"><i class="fa-solid fa-money-check-dollar"></i> Penggajian</a></li>
            <li class="nav-item"><a href="index.php" class="nav-link active"><i class="fa-solid fa-money-check-dollar"></i> Penggajian</a></li>
            <li class="nav-item"><a href="../profile.php" class="nav-link text-warning"><i class="fa-solid fa-user-gear"></i> Profil Saya</a></li>
            <li class="nav-item mt-4"><a href="#" class="nav-link text-danger" onclick="logout()"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <button class="btn btn-navy btn-sm d-md-none me-2" onclick="toggleSidebar()"><i class="fa-solid fa-bars"></i></button>
                <h4 class="fw-bold text-navy mb-0 d-inline-block">Penggajian Karyawan</h4>
            </div>
            <button class="btn btn-navy text-white btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#addPayrollModal">
                <i class="fa-solid fa-plus me-1"></i> Tambah Gaji
            </button>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <div class="card bg-warning text-dark h-100 shadow-sm">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase fw-bold opacity-75">Tagihan Pending</small>
                            <h3 class="fw-bold mb-0 mt-2" id="totalPending">Rp 0</h3>
                        </div>
                        <i class="fa-solid fa-clock-rotate-left fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card bg-success text-white h-100 shadow-sm">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase fw-bold opacity-75">Total Telah Dibayar</small>
                            <h3 class="fw-bold mb-0 mt-2" id="totalPaid">Rp 0</h3>
                        </div>
                        <i class="fa-solid fa-check-double fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Karyawan</th>
                                <th>Role</th>
                                <th>Deskripsi Tugas</th>
                                <th>Qty</th>
                                <th>Total Gaji</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="payrollList">
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted"><i class="fa-solid fa-spinner fa-spin"></i> Memuat data...</td>
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
            <div class="modal-content">
                <div class="modal-header bg-navy text-white">
                    <h6 class="modal-title fw-bold text-white">Tambah Catatan Gaji</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="payrollForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold">KARYAWAN</label>
                            <select id="pUser" class="form-select" required>
                                <option value="">-- Pilih Karyawan --</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold">ROLE</label>
                            <select id="pRole" class="form-select" required>
                                <option value="">-- Pilih Role --</option>
                                <option value="Programmer">Programmer (Rp 500k / project)</option>
                                <option value="Designer">Desainer (Per konten)</option>
                            </select>
                        </div>
                        <div class="mb-3 d-none" id="complexityContainer">
                            <label class="small text-muted fw-bold">TINGKAT KESULITAN (DESAINER)</label>
                            <select id="pComplexity" class="form-select">
                                <option value="Standard">1 Layer / Simple (Rp 15k)</option>
                                <option value="Complex">Multi Slide / Banyak Layer (Rp 25k)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold">NAMA PROJECT / DESKRIPSI</label>
                            <input type="text" id="pDesc" class="form-control" placeholder="Contoh: Pembuatan Website E-Commerce" required>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold">JUMLAH (QTY)</label>
                            <input type="number" id="pQty" class="form-control" value="1" min="1" required>
                        </div>
                        
                        <div class="alert alert-info py-2 mb-0 d-flex justify-content-between align-items-center">
                            <span class="small fw-bold">Estimasi Gaji:</span>
                            <span class="fw-bold fs-5" id="pTotalEstimasi">Rp 0</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-navy text-white">Simpan Catatan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../assets/js/payroll.js"></script>
    <script>
        function toggleSidebar() { document.getElementById('sidebar').classList.toggle('active'); }
        function logout() {
            Swal.fire({ title: 'Logout?', icon: 'warning', showCancelButton: true, confirmButtonColor: '#0d2e5c' }).then(r => {
                if (r.isConfirmed) { localStorage.clear(); window.location.href = '../../auth/index.html'; }
            });
        }
    </script>
</body>
</html>
