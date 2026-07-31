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
    <title>Manajemen Investasi | S-OS Skillance</title>

    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">

    <style>
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
                <h5 class="fw-bold text-navy mb-0 ls-2">SKILLANCE</h5>
                <small class="text-muted" style="font-size: 0.65rem;">OFFICE SYSTEM</small>
            </div>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="../index.php" class="nav-link">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="../project/index.php" class="nav-link">
                    <i class="fa-solid fa-briefcase"></i> Project
                </a>
            </li>
            <li class="nav-item">
                <a href="../finance/index.php" class="nav-link">
                    <i class="fa-solid fa-wallet"></i> Keuangan
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php" class="nav-link active">
                    <i class="fa-solid fa-hand-holding-dollar"></i> Investasi Admin
                </a>
            </li>
            <li class="nav-item">
                <a href="../hrd/index.php" class="nav-link text-primary">
                    <i class="fa-solid fa-users"></i> HRD
                </a>
            </li>
                                    <li class="nav-item"><a href="../	eam/index.php" class="nav-link"><i class="fa-solid fa-people-group"></i> Manajemen Tim</a></li>
            <li class="nav-item">
                <a href="../profile.php" class="nav-link text-warning">
                    <i class="fa-solid fa-user-gear"></i> Profil Saya
                </a>
            </li>
            <li class="nav-item mt-4">
                <a href="#" class="nav-link text-danger" id="btnLogout">
                    <i class="fa-solid fa-right-from-bracket"></i> Logout
                </a>
            </li>
        </ul>
    </nav>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4 d-md-none">
            <button class="btn btn-navy btn-sm" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
            <span class="fw-bold text-navy">Manajemen Investasi</span>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 d-none d-md-flex">
            <div>
                <h4 class="fw-bold text-navy mb-0">Manajemen Investasi</h4>
                <small class="text-muted">Kelola modal investasi yang disalurkan</small>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-md-6">
                <div class="card bg-primary text-white h-100 shadow-sm">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase fw-bold opacity-75">Total Modal Disalurkan</small>
                            <h3 class="fw-bold mb-0 mt-2" id="totalModal">Rp 0</h3>
                        </div>
                        <i class="fa-solid fa-hand-holding-dollar fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card bg-success text-white h-100 shadow-sm">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase fw-bold opacity-75">Total Profit Diterima</small>
                            <h3 class="fw-bold mb-0 mt-2" id="totalProfit">Rp 0</h3>
                        </div>
                        <i class="fa-solid fa-money-bill-trend-up fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Form Tambah Investasi -->
            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-bottom text-navy fw-bold">
                        <i class="fa-solid fa-plus-circle me-2"></i>Tambah Modal
                    </div>
                    <div class="card-body p-4">
                        <form id="formInvestasi">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Tanggal</label>
                                <input type="date" class="form-control" id="invDate" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Deskripsi / Nama Investor</label>
                                <input type="text" class="form-control" id="invDesc"
                                    placeholder="Contoh: Modal Pulsa Darni" required>
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">Jumlah Modal (Rp)</label>
                                <input type="number" class="form-control" id="invAmount" required min="0"
                                    placeholder="500000">
                            </div>
                            <button type="submit" class="btn btn-navy w-100" id="btnSubmit">
                                <i class="fa-solid fa-save me-1"></i> Simpan Modal
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- List Investasi -->
            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div
                        class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-navy"><i class="fa-solid fa-list me-2"></i>Riwayat Modal Investasi
                        </h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-muted small">
                                    <tr>
                                        <th class="ps-4">TANGGAL</th>
                                        <th>DESKRIPSI</th>
                                        <th class="text-end pe-4">JUMLAH (RP)</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <tr>
                                        <td colspan="3" class="text-center py-4 text-muted">
                                            <i class="fa-solid fa-spinner fa-spin me-2"></i>Memuat data...
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Set today's date
            document.getElementById('invDate').valueAsDate = new Date();

            const formatRp = (num) => 'Rp ' + parseFloat(num).toLocaleString('id-ID');

            function loadData() {
                fetch('../../api/admin_investment.php')
                    .then(r => r.json())
                    .then(res => {
                        if (res.status === 'success') {
                            document.getElementById('totalModal').textContent = formatRp(res.totalModal);
                            document.getElementById('totalProfit').textContent = formatRp(res.totalProfit);

                            const tbody = document.getElementById('tableBody');
                            tbody.innerHTML = '';

                            if (res.investments.length === 0) {
                                tbody.innerHTML = `<tr><td colspan="3" class="text-center py-4 text-muted">Belum ada data pengeluaran modal investasi.</td></tr>`;
                            } else {
                                res.investments.forEach(item => {
                                    tbody.innerHTML += `
                                        <tr>
                                            <td class="ps-4">${item.date}</td>
                                            <td class="fw-semibold">${item.description}</td>
                                            <td class="text-end pe-4 text-danger fw-bold">${formatRp(item.amount)}</td>
                                        </tr>
                                    `;
                                });
                            }
                        }
                    })
                    .catch(err => console.error(err));
            }

            loadData();

            document.getElementById('formInvestasi').addEventListener('submit', function (e) {
                e.preventDefault();

                const btn = document.getElementById('btnSubmit');
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Menyimpan...';
                btn.disabled = true;

                const data = {
                    date: document.getElementById('invDate').value,
                    description: document.getElementById('invDesc').value,
                    amount: document.getElementById('invAmount').value
                };

                fetch('../../api/admin_investment.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                })
                    .then(r => r.json())
                    .then(res => {
                        btn.innerHTML = '<i class="fa-solid fa-save me-1"></i> Simpan Modal';
                        btn.disabled = false;

                        if (res.status === 'success') {
                            Swal.fire({ icon: 'success', title: 'Berhasil', text: res.message, timer: 1500, showConfirmButton: false });
                            document.getElementById('formInvestasi').reset();
                            document.getElementById('invDate').valueAsDate = new Date();
                            loadData();
                        } else {
                            Swal.fire({ icon: 'error', title: 'Gagal', text: res.message });
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        btn.innerHTML = '<i class="fa-solid fa-save me-1"></i> Simpan Modal';
                        btn.disabled = false;
                        Swal.fire({ icon: 'error', title: 'Oops', text: 'Terjadi kesalahan sistem.' });
                    });
            });

            // Logout
            document.getElementById('btnLogout').addEventListener('click', (e) => {
                e.preventDefault();
                Swal.fire({
                    title: 'Keluar Sistem?',
                    text: "Sesi Anda akan diakhiri.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0d2e5c',
                    confirmButtonText: 'Ya, Logout'
                }).then((result) => {
                    if (result.isConfirmed) {
                        localStorage.clear();
                        window.location.href = '../../auth/index.html';
                    }
                });
            });
        });
    </script>
</body>

</html>


