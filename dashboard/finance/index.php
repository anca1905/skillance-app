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
    <title>Keuangan | S-OS Skillance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        /* Sama seperti Dashboard */
        body {
            background-color: #f3f4f6;
            overflow-x: hidden;
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
            padding: 20px;
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
                margin-left: -250px;
            }

            .sidebar.active {
                margin-left: 0;
            }

            .main-content {
                margin-left: 0;
            }
        }

        .card {
            border: none;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.03);
            border-radius: 8px;
        }
    </style>
</head>

<body>

    <nav class="sidebar shadow-sm" id="sidebar">
        <div class="px-4 mb-4 d-flex align-items-center gap-2">
            <i class="fa-solid fa-code text-gold fs-4"></i>
            <div>
                <h5 class="fw-bold text-navy mb-0 ls-2">SKILLANCE</h5><small class="text-muted"
                    style="font-size: 0.65rem;">OFFICE SYSTEM</small>
            </div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="../" class="nav-link"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            </li>
            <li class="nav-item"><a href="../project" class="nav-link "><i class="fa-solid fa-briefcase"></i>
                    Project</a></li>
            <li class="nav-item"><a href="#" class="nav-link active"><i class="fa-solid fa-wallet"></i> Keuangan</a>
            </li>
            <li class="nav-item"><a href="../investment/index.php" class="nav-link"><i
                        class="fa-solid fa-hand-holding-dollar"></i> Investasi Admin</a></li>
            <li class="nav-item"><a href="../hrd/index.php" class="nav-link text-primary"><i
                        class="fa-solid fa-users"></i> HRD</a></li>
                                    <li class="nav-item"><a href="../	eam/index.php" class="nav-link"><i class="fa-solid fa-people-group"></i> Manajemen Tim</a></li>
            <li class="nav-item">
                <a href="../profile.php" class="nav-link text-warning">
                    <i class="fa-solid fa-user-gear"></i> Profil Saya
                </a>
            </li>
            <li class="nav-item mt-4"><a href="#" class="nav-link text-danger" onclick="logout()"><i
                        class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <button class="btn btn-navy btn-sm d-md-none me-2" onclick="toggleSidebar()"><i
                        class="fa-solid fa-bars"></i></button>
                <h4 class="fw-bold text-navy mb-0 d-inline-block">Keuangan & Cashflow</h4>
            </div>
            <div>
                <a href="print.php" target="_blank" class="btn btn-outline-navy btn-sm shadow-sm me-2">
                    <i class="fa-solid fa-print me-1"></i> Cetak Laporan
                </a>
                <button class="btn btn-navy text-white btn-sm shadow-sm" data-bs-toggle="modal"
                    data-bs-target="#addTrxModal">
                    <i class="fa-solid fa-plus me-1"></i> Transaksi Baru
                </button>
            </div>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="card bg-navy text-white h-100">
                    <div class="card-body p-3">
                        <small class="text-white-50 text-uppercase fw-bold">Saldo Saat Ini</small>
                        <h3 class="fw-bold mt-1 mb-0 text-white" id="statBalance">Rp 0</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-success border-start border-4">
                    <div class="card-body p-3">
                        <small class="text-muted text-uppercase fw-bold">Total Masuk</small>
                        <h4 class="fw-bold text-success mt-1 mb-0" id="statIncome">+ Rp 0</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-danger border-start border-4">
                    <div class="card-body p-3">
                        <small class="text-muted text-uppercase fw-bold">Total Keluar</small>
                        <h4 class="fw-bold text-danger mt-1 mb-0" id="statExpense">- Rp 0</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-navy">Riwayat Transaksi Terakhir</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Tanggal</th>
                                <th>Keterangan</th>
                                <th>Tipe</th>
                                <th class="text-end pe-4">Nominal</th>
                            </tr>
                        </thead>
                        <tbody id="trxList">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addTrxModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-navy text-white">
                    <h6 class="modal-title fw-bold text-white">Catat Transaksi</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="trxForm">
                    <div class="modal-body">
                        <div class="row mb-3 g-2">
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="type" id="typeIn" value="income" checked>
                                <label class="btn btn-outline-success w-100 fw-bold" for="typeIn"><i
                                        class="fa-solid fa-arrow-down"></i> Pemasukan</label>
                            </div>
                            <div class="col-6">
                                <input type="radio" class="btn-check" name="type" id="typeOut" value="expense">
                                <label class="btn btn-outline-danger w-100 fw-bold" for="typeOut"><i
                                        class="fa-solid fa-arrow-up"></i> Pengeluaran</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold">NOMINAL (Rp)</label>
                            <input type="number" class="form-control" id="trxAmount" placeholder="0" required>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold">KETERANGAN</label>
                            <textarea class="form-control" id="trxDesc" rows="2" placeholder="Contoh: DP Project X"
                                required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold">TANGGAL</label>
                            <input type="date" class="form-control" id="trxDate" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-navy text-white">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../assets/js/finance.js"></script>
    <script>
        // Helper Sidebar & Logout (Sama utk semua halaman)
        function toggleSidebar() { document.getElementById('sidebar').classList.toggle('active'); }
        function logout() {
            Swal.fire({ title: 'Logout?', icon: 'warning', showCancelButton: true, confirmButtonColor: '#0d2e5c' }).then(r => {
                if (r.isConfirmed) { localStorage.clear(); window.location.href = '../../auth/index.html'; }
            });
        }
    </script>
</body>

</html>


