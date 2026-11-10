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
    <title>Manajemen Pengguna | Skillance Office</title>

    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">

    <style>
        body {
            background-color: #f3f4f6;
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
    </style>
</head>

<body>

    <?php
    $activeMenu = 'users';
    include __DIR__ . '/../includes/sidebar.php';
    ?>

    <div class="main-content">
        <!-- Topbar Mobile -->
        <div class="d-flex justify-content-between align-items-center mb-4 d-md-none">
            <button class="btn btn-navy btn-sm" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
            <span class="fw-bold text-navy">Manajemen Pengguna</span>
        </div>

        <!-- Header Desktop -->
        <div class="d-flex justify-content-between align-items-center mb-4 d-none d-md-flex">
            <div>
                <h4 class="fw-bold text-navy mb-0">
                    <i class="fa-solid fa-users-gear text-navy me-2"></i>Manajemen Pengguna
                </h4>
                <small class="text-muted">Kelola akun Administrator, Staff Internal, dan Freelancer Skillance.</small>
            </div>
        </div>

        <!-- Summary KPI Cards -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="card bg-navy text-white h-100 shadow-sm border-0">
                    <div class="card-body p-3 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase fw-bold text-white-50" style="font-size: 0.7rem;">Admin</small>
                            <h3 class="fw-bold mb-0 mt-1 text-white" id="totalAdmin">0</h3>
                        </div>
                        <i class="fa-solid fa-user-shield fs-2 text-white opacity-50 d-none d-sm-block"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card text-dark h-100 shadow-sm border-0" style="background: #fff8e1; border-left: 4px solid #ffb300 !important;">
                    <div class="card-body p-3 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase fw-bold text-warning-emphasis" style="font-size: 0.7rem;">Bendahara</small>
                            <h3 class="fw-bold mb-0 mt-1 text-dark" id="totalBendahara">0</h3>
                        </div>
                        <i class="fa-solid fa-coins fs-2 text-warning opacity-75 d-none d-sm-block"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-primary text-white h-100 shadow-sm border-0">
                    <div class="card-body p-3 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase fw-bold text-white-50" style="font-size: 0.7rem;">Staff Internal</small>
                            <h3 class="fw-bold mb-0 mt-1 text-white" id="totalStaff">0</h3>
                        </div>
                        <i class="fa-solid fa-user-tie fs-2 text-white opacity-50 d-none d-sm-block"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-success text-white h-100 shadow-sm border-0">
                    <div class="card-body p-3 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase fw-bold text-white-50" style="font-size: 0.7rem;">Freelancer</small>
                            <h3 class="fw-bold mb-0 mt-1 text-white" id="totalFreelancer">0</h3>
                        </div>
                        <i class="fa-solid fa-laptop-code fs-2 text-white opacity-50 d-none d-sm-block"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Form Tambah User Internal -->
            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-bottom text-navy fw-bold">
                        <i class="fa-solid fa-user-plus text-gold me-2"></i>Tambah Akun Pengguna
                    </div>
                    <div class="card-body p-4">
                        <form id="formUser">
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">NAMA LENGKAP</label>
                                <input type="text" class="form-control" id="userName" placeholder="Contoh: Rian Pratama" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">EMAIL LOGIN</label>
                                <input type="email" class="form-control" id="userEmail" placeholder="nama@skillance.id" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-muted">PASSWORD</label>
                                <input type="text" class="form-control" id="userPass" required placeholder="Minimal 6 karakter">
                            </div>
                            <div class="mb-4">
                                <label class="form-label small fw-bold text-muted">PERAN (ROLE)</label>
                                <select class="form-select" id="userRole" required>
                                    <option value="staff" selected>Staff Internal</option>
                                    <option value="bendahara">Bendahara / Keuangan (Finance)</option>
                                    <option value="admin">Administrator</option>
                                </select>
                                <small class="text-muted" style="font-size: 0.72rem;">Role Bendahara memiliki akses khusus ke Keuangan & Rekap Pajak SPT.</small>
                            </div>
                            <button type="submit" class="btn btn-navy w-100 py-2 fw-bold" id="btnSubmit">
                                <i class="fa-solid fa-save me-1"></i> Simpan Akun Pengguna
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- List Users -->
            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <h6 class="m-0 fw-bold text-navy">
                            <i class="fa-solid fa-list me-2"></i>Daftar Pengguna Sistem
                        </h6>
                        <div class="d-flex gap-2">
                            <input type="text" id="searchUser" class="form-control form-control-sm" placeholder="Cari nama / email..." style="width: 200px;">
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-muted small">
                                    <tr>
                                        <th class="ps-4">PENGGUNA</th>
                                        <th>PERAN</th>
                                        <th>STATUS / KAMPUS</th>
                                        <th>TERDAFTAR</th>
                                        <th class="text-end pe-4">AKSI</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="fa-solid fa-spinner fa-spin me-2"></i>Memuat data pengguna...
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
        let allUsersData = [];

        document.addEventListener('DOMContentLoaded', () => {
            function loadData() {
                fetch('../../api/hrd_api.php')
                    .then(r => r.json())
                    .then(res => {
                        if (res.status === 'success') {
                            document.getElementById('totalAdmin').textContent = res.summary.admin || 0;
                            document.getElementById('totalBendahara').textContent = res.summary.bendahara || 0;
                            document.getElementById('totalStaff').textContent = res.summary.staff || 0;
                            document.getElementById('totalFreelancer').textContent = res.summary.freelancer || 0;

                            allUsersData = res.users || [];
                            renderUsers(allUsersData);
                        }
                    })
                    .catch(err => console.error(err));
            }

            function renderUsers(users) {
                const tbody = document.getElementById('tableBody');
                tbody.innerHTML = '';

                if (users.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="5" class="text-center py-4 text-muted">Tidak ada pengguna ditemukan.</td></tr>`;
                    return;
                }

                users.forEach(item => {
                    let roleBadge = '';
                    if (item.role === 'admin') {
                        roleBadge = '<span class="badge bg-navy text-white px-2 py-1"><i class="fa-solid fa-shield-halved me-1"></i> Admin</span>';
                    } else if (item.role === 'bendahara') {
                        roleBadge = '<span class="badge bg-warning text-dark px-2 py-1"><i class="fa-solid fa-coins me-1"></i> Bendahara</span>';
                    } else if (item.role === 'staff') {
                        roleBadge = '<span class="badge bg-primary text-white px-2 py-1"><i class="fa-solid fa-user-tie me-1"></i> Staff</span>';
                    } else {
                        roleBadge = '<span class="badge bg-success text-white px-2 py-1"><i class="fa-solid fa-laptop-code me-1"></i> Freelancer</span>';
                    }

                    let typeInfo = item.institution ? `<span class="badge bg-light text-dark border">${item.institution}</span>` : `<span class="text-muted small text-capitalize">${item.user_type || '-'}</span>`;

                    const dateFormatted = item.created_at ? item.created_at.split(' ')[0] : '-';

                    tbody.innerHTML += `
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-navy">${item.name}</div>
                                <small class="text-muted">${item.email}</small>
                            </td>
                            <td>${roleBadge}</td>
                            <td>${typeInfo}</td>
                            <td><small class="text-muted">${dateFormatted}</small></td>
                            <td class="text-end pe-4">
                                ${item.id == 1 ? '<span class="badge bg-light text-muted">Utama</span>' : `
                                <button class="btn btn-sm btn-outline-danger" title="Hapus Akun" onclick="deleteUser(${item.id}, '${item.name.replace(/'/g, "\\'")}')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>`}
                            </td>
                        </tr>
                    `;
                });
            }

            // Search filter
            document.getElementById('searchUser')?.addEventListener('input', function(e) {
                const q = e.target.value.toLowerCase().trim();
                const filtered = allUsersData.filter(u => 
                    u.name.toLowerCase().includes(q) || 
                    u.email.toLowerCase().includes(q) ||
                    u.role.toLowerCase().includes(q) ||
                    (u.institution && u.institution.toLowerCase().includes(q))
                );
                renderUsers(filtered);
            });

            loadData();

            // Submit Tambah User
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
                        btn.innerHTML = '<i class="fa-solid fa-save me-1"></i> Simpan Akun Pengguna';
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
                        btn.innerHTML = '<i class="fa-solid fa-save me-1"></i> Simpan Akun Pengguna';
                        btn.disabled = false;
                        Swal.fire({ icon: 'error', title: 'Oops', text: 'Terjadi kesalahan sistem.' });
                    });
            });

            window.deleteUser = function (id, name) {
                Swal.fire({
                    title: 'Hapus Akun Pengguna?',
                    text: `Apakah Anda yakin ingin menghapus akun ${name}? Tindakan ini tidak dapat dibatalkan.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
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
        });
    </script>
</body>

</html>
