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
    <title>HRD | S-OS Skillance</title>

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
                <a href="../investment/index.php" class="nav-link">
                    <i class="fa-solid fa-hand-holding-dollar"></i> Investasi Admin
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php" class="nav-link active">
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
            <span class="fw-bold text-navy">HRD Admin</span>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 d-none d-md-flex">
            <div>
                <h4 class="fw-bold text-navy mb-0">Human Resource Department (HRD)</h4>
                <small class="text-muted">Kelola akun Karyawan dan Investor</small>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row g-4 mb-4">
            <div class="col-12 col-md-6">
                <div class="card bg-info text-white h-100 shadow-sm">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase fw-bold opacity-75">Terkonfirmasi Karyawan (Staff)</small>
                            <h3 class="fw-bold mb-0 mt-2" id="totalStaff">0</h3>
                        </div>
                        <i class="fa-solid fa-user-tie fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6">
                <div class="card bg-success text-white h-100 shadow-sm">
                    <div class="card-body p-4 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase fw-bold opacity-75">Terkonfirmasi Investor Aktif</small>
                            <h3 class="fw-bold mb-0 mt-2" id="totalInvestor">0</h3>
                        </div>
                        <i class="fa-solid fa-user-group fs-1 opacity-50"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Form Tambah User -->
            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-bottom text-navy fw-bold">
                        <i class="fa-solid fa-user-plus me-2"></i>Buat Akun Baru
                    </div>
                    <div class="card-body p-4">
                        <form id="formUser">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Nama Lengkap</label>
                                <input type="text" class="form-control" id="userName" placeholder="Contoh: Darniati"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Email (Username)</label>
                                <input type="email" class="form-control" id="userEmail"
                                    placeholder="contoh@investor.com" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">Password Sementara</label>
                                <input type="text" class="form-control" id="userPass" required
                                    placeholder="minimal 5 karakter">
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">Peran (Role)</label>
                                <select class="form-select" id="userRole" required>
                                    <option value="staff">Karyawan (Staff)</option>
                                    <option value="investor">Investor</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-navy w-100" id="btnSubmit">
                                <i class="fa-solid fa-save me-1"></i> Buat Akun
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- List Users -->
            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div
                        class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-navy"><i class="fa-solid fa-list me-2"></i>Direktori Pengguna</h6>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-muted small">
                                    <tr>
                                        <th class="ps-4">NAMA / NIK</th>
                                        <th>EMAIL LOGIN</th>
                                        <th>PERAN</th>
                                        <th class="text-end pe-4">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
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

            document.getElementById('sidebarToggle')?.addEventListener('click', () => {
                document.getElementById('sidebar').classList.toggle('active');
            });

            function loadData() {
                fetch('../../api/hrd_api.php')
                    .then(r => r.json())
                    .then(res => {
                        if (res.status === 'success') {
                            document.getElementById('totalStaff').textContent = res.summary.staff;
                            document.getElementById('totalInvestor').textContent = res.summary.investor;

                            const tbody = document.getElementById('tableBody');
                            tbody.innerHTML = '';

                            if (res.users.length === 0) {
                                tbody.innerHTML = `<tr><td colspan="4" class="text-center py-4 text-muted">Belum ada data anggota tim.</td></tr>`;
                            } else {
                                res.users.forEach(item => {
                                    const badgeColor = item.role === 'investor' ? 'bg-success' : 'bg-info';
                                    const roleStr = item.role.toUpperCase();

                                    tbody.innerHTML += `
                                        <tr>
                                            <td class="ps-4 fw-semibold">${item.name}</td>
                                            <td class="text-muted">${item.email}</td>
                                            <td><span class="badge ${badgeColor}">${roleStr}</span></td>
                                            <td class="text-end pe-4">
                                                <button class="btn btn-sm btn-outline-danger" onclick="deleteUser(${item.id}, '${item.name}')"><i class="fa-solid fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    `;
                                });
                            }
                        }
                    })
                    .catch(err => console.error(err));
            }

            loadData();

            document.getElementById('formUser').addEventListener('submit', function (e) {
                e.preventDefault();

                const btn = document.getElementById('btnSubmit');
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Menyimpan...';
                btn.disabled = true;

                const data = {
                    name: document.getElementById('userName').value,
                    email: document.getElementById('userEmail').value,
                    password: document.getElementById('userPass').value,
                    role: document.getElementById('userRole').value
                };

                fetch('../../api/hrd_api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                })
                    .then(r => r.json())
                    .then(res => {
                        btn.innerHTML = '<i class="fa-solid fa-save me-1"></i> Buat Akun';
                        btn.disabled = false;

                        if (res.status === 'success') {
                            Swal.fire({ icon: 'success', title: 'Berhasil', text: res.message, timer: 1500, showConfirmButton: false });
                            document.getElementById('formUser').reset();
                            loadData();
                        } else {
                            Swal.fire({ icon: 'error', title: 'Gagal', text: res.message });
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        btn.innerHTML = '<i class="fa-solid fa-save me-1"></i> Buat Akun';
                        btn.disabled = false;
                        Swal.fire({ icon: 'error', title: 'Oops', text: 'Terjadi kesalahan sistem.' });
                    });
            });

            window.deleteUser = function (id, name) {
                Swal.fire({
                    title: 'Hapus Akses?',
                    text: `Apakah Anda yakin ingin menghapus akun ${name}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#secondary',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch('../../api/hrd_api.php', {
                            method: 'DELETE',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({ id: id })
                        }).then(r => r.json()).then(res => {
                            if (res.status === 'success') {
                                Swal.fire('Dihapus!', res.message, 'success');
                                loadData();
                            } else {
                                Swal.fire('Gagal!', res.message, 'error');
                            }
                        });
                    }
                });
            }

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


