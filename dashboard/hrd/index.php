<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/index.php");
    exit();
}
if (($_SESSION['user_role'] ?? '') !== 'admin') {
    if (($_SESSION['user_role'] ?? '') === 'bendahara') {
        header("Location: ../finance/index.php");
    } else {
        header("Location: ../freelancer/index.php");
    }
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Pengguna & Multi-Role SIAKAD | Skillance Office</title>

    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">

    <style>
        :root {
            --navy: #0d2e5c;
            --navy-dark: #071a35;
            --gold: #fca311;
        }

        body {
            background-color: #f1f5f9;
            overflow-x: hidden;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
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
            border: 1px solid #e2e8f0;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.03);
            border-radius: 14px;
        }

        .badge-role-tag {
            font-size: 0.72rem;
            padding: 4px 8px;
            border-radius: 6px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin: 2px;
        }

        .role-check-card {
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 12px;
            cursor: pointer;
            transition: all 0.2s;
            background: #fff;
        }
        .role-check-card:hover {
            border-color: #0d2e5c;
            background: #f8fafc;
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
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div>
                <div class="d-flex align-items-center gap-2">
                    <h4 class="fw-bold text-navy mb-0">
                        <i class="fa-solid fa-users-gear text-navy me-2"></i>Manajemen Pengguna & Multi-Role Akses
                    </h4>
                    <span class="badge bg-warning text-navy fw-bold small">SIAKAD Gateway Engine</span>
                </div>
                <small class="text-muted">
                    Atur hak akses pengguna ke berbagai peran: <strong>Mahasiswa Mitra</strong>, <strong>Dekanat & Dosen</strong>, <strong>Pengurus UKM MSC</strong>, <strong>Freelancer</strong>, hingga <strong>Superadmin</strong>.
                </small>
            </div>
            <div>
                <a href="../../auth/select_role.php" target="_blank" class="btn btn-sm btn-outline-navy fw-bold rounded-pill px-3">
                    <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Preview Layar SIAKAD
                </a>
            </div>
        </div>

        <!-- Summary KPI Cards -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="card bg-navy text-white h-100 shadow-sm border-0">
                    <div class="card-body p-3 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase fw-bold text-white-50" style="font-size: 0.7rem;">Superadmin</small>
                            <h3 class="fw-bold mb-0 mt-1 text-white" id="totalAdmin">0</h3>
                            <small class="text-gold" style="font-size: 0.7rem;">Akses Seluruh Portal</small>
                        </div>
                        <i class="fa-solid fa-crown fs-2 text-warning opacity-75 d-none d-sm-block"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card text-dark h-100 shadow-sm border-0" style="background: #eff6ff; border-left: 4px solid #3b82f6 !important;">
                    <div class="card-body p-3 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase fw-bold text-primary" style="font-size: 0.7rem;">Dekanat & Dosen</small>
                            <h3 class="fw-bold mb-0 mt-1 text-dark" id="totalDekanat">0</h3>
                            <small class="text-muted" style="font-size: 0.7rem;">Monitoring Kampus</small>
                        </div>
                        <i class="fa-solid fa-building-columns fs-2 text-primary opacity-50 d-none d-sm-block"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card text-dark h-100 shadow-sm border-0" style="background: #f0fdf4; border-left: 4px solid #22c55e !important;">
                    <div class="card-body p-3 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase fw-bold text-success" style="font-size: 0.7rem;">Pengurus UKM MSC</small>
                            <h3 class="fw-bold mb-0 mt-1 text-dark" id="totalOrmawa">0</h3>
                            <small class="text-muted" style="font-size: 0.7rem;">Kelola Anggota & Kas</small>
                        </div>
                        <i class="fa-solid fa-handshake-angle fs-2 text-success opacity-50 d-none d-sm-block"></i>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card text-dark h-100 shadow-sm border-0" style="background: #fffbeb; border-left: 4px solid #f59e0b !important;">
                    <div class="card-body p-3 d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-uppercase fw-bold text-warning-emphasis" style="font-size: 0.7rem;">Mahasiswa / Freelancer</small>
                            <h3 class="fw-bold mb-0 mt-1 text-dark" id="totalMahasiswa">0</h3>
                            <small class="text-muted" style="font-size: 0.7rem;">Siswa Belajar & Proyek</small>
                        </div>
                        <i class="fa-solid fa-graduation-cap fs-2 text-warning opacity-75 d-none d-sm-block"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- List Users Table (8 Cols) -->
            <div class="col-12 col-xl-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <h6 class="m-0 fw-bold text-navy">
                            <i class="fa-solid fa-list-check me-2"></i>Daftar Pengguna & Hak Akses Multi-Role
                        </h6>
                        <div class="d-flex gap-2">
                            <input type="text" id="searchUser" class="form-control form-control-sm" placeholder="Cari nama / email / peran..." style="width: 220px;">
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light text-muted small">
                                    <tr>
                                        <th class="ps-3">PENGGUNA</th>
                                        <th>JABATAN & MITRA</th>
                                        <th>HAK AKSES MULTI-ROLE (SIAKAD)</th>
                                        <th class="text-end pe-3">AKSI KONTROL</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBody">
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">
                                            <i class="fa-solid fa-spinner fa-spin me-2"></i>Memuat data pengguna...
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Tambah User Cepat (4 Cols) -->
            <div class="col-12 col-xl-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white py-3 border-bottom text-navy fw-bold">
                        <i class="fa-solid fa-user-plus text-gold me-2"></i>Tambah Pengguna Baru
                    </div>
                    <div class="card-body p-3">
                        <form id="formUser">
                            <div class="mb-2">
                                <label class="form-label small fw-bold text-muted mb-1">NAMA LENGKAP</label>
                                <input type="text" class="form-control form-control-sm" id="userName" placeholder="Contoh: Muh. Fadel Al-Farizi" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold text-muted mb-1">EMAIL LOGIN</label>
                                <input type="email" class="form-control form-control-sm" id="userEmail" placeholder="email@kampus.ac.id" required>
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold text-muted mb-1">PASSWORD DEFAULT</label>
                                <input type="text" class="form-control form-control-sm" id="userPass" required placeholder="Minimal 6 karakter" value="Skillance2026!">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold text-muted mb-1">JABATAN / POSISI RESMI</label>
                                <input type="text" class="form-control form-control-sm" id="userPosition" placeholder="Contoh: Ketua Umum UKM MSC / Dosen">
                            </div>
                            <div class="mb-2">
                                <label class="form-label small fw-bold text-muted mb-1">MITRA KAMPUS</label>
                                <select class="form-select form-select-sm" id="userPartner">
                                    <option value="msc-usn" selected>FTI USN Kolaka x UKM MSC (msc-usn)</option>
                                    <option value="umum">Umum / Non-Mitra</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label small fw-bold text-navy mb-1">HAK AKSES MULTI-ROLE (CENTANG YANG DIBERIKAN)</label>
                                <div class="bg-light p-2 rounded border small">
                                    <div class="form-check mb-1">
                                        <input class="form-check-input new-role-check" type="checkbox" value="mahasiswa" id="chkNewMhs" checked>
                                        <label class="form-check-label fw-semibold" for="chkNewMhs">
                                            <i class="fa-solid fa-graduation-cap text-warning me-1"></i> Mahasiswa Mitra (Silabus 32 JP)
                                        </label>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input class="form-check-input new-role-check" type="checkbox" value="ormawa" id="chkNewOrmawa">
                                        <label class="form-check-label fw-semibold" for="chkNewOrmawa">
                                            <i class="fa-solid fa-handshake-angle text-success me-1"></i> Pengurus UKM MSC
                                        </label>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input class="form-check-input new-role-check" type="checkbox" value="dekanat" id="chkNewDekan">
                                        <label class="form-check-label fw-semibold" for="chkNewDekan">
                                            <i class="fa-solid fa-building-columns text-primary me-1"></i> Dekanat & Dosen Pembina
                                        </label>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input class="form-check-input new-role-check" type="checkbox" value="freelancer" id="chkNewFreelance" checked>
                                        <label class="form-check-label fw-semibold" for="chkNewFreelance">
                                            <i class="fa-solid fa-laptop-code text-info me-1"></i> Freelance & Tech Work
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input new-role-check" type="checkbox" value="admin" id="chkNewAdmin">
                                        <label class="form-check-label fw-semibold text-danger" for="chkNewAdmin">
                                            <i class="fa-solid fa-crown text-danger me-1"></i> Superadmin Eksekutif
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-navy w-100 py-2 fw-bold" id="btnSubmit">
                                <i class="fa-solid fa-user-plus me-1"></i> Daftarkan Pengguna
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT MULTI-ROLE & HAK AKSES -->
    <div class="modal fade" id="modalEditRoles" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow rounded-4">
                <div class="modal-header bg-navy text-white py-3">
                    <h5 class="modal-title fw-bold" style="font-size: 1.05rem;">
                        <i class="fa-solid fa-user-shield text-gold me-2"></i>Atur Hak Akses Multi-Role
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="editUserId">

                    <div class="p-3 bg-light rounded-3 mb-3 border d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-navy text-white fw-bold d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; font-size: 1.1rem;" id="editAvatarBox">
                            U
                        </div>
                        <div>
                            <h6 class="fw-bold text-navy mb-0" id="editUserName">Nama Pengguna</h6>
                            <small class="text-muted" id="editUserEmail">email@domain.com</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-navy mb-1">JABATAN / POSISI RESMI</label>
                        <input type="text" class="form-control" id="editPositionTitle" placeholder="Contoh: Ketua Umum UKM MSC / Wakil Dekan">
                        <small class="text-muted" style="font-size: 0.72rem;">Ditampilkan pada badge profil dan dokumen berita acara.</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-navy mb-1">MITRA KAMPUS / LEMBAGA</label>
                        <select class="form-select" id="editPartnerSlug">
                            <option value="msc-usn">FTI USN Kolaka x UKM MSC (msc-usn)</option>
                            <option value="umum">Umum / Non-Mitra Kampus</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-navy mb-2">
                            PILIH HAK AKSES PORTAL (MULTI-ROLE DAPAT DIKOMBINASIKAN):
                        </label>

                        <div class="vstack gap-2">
                            <!-- Role Mahasiswa -->
                            <label class="role-check-card d-flex align-items-center gap-3" for="roleMhs">
                                <input class="form-check-input edit-role-chk m-0" type="checkbox" value="mahasiswa" id="roleMhs">
                                <div>
                                    <span class="fw-bold text-navy d-block small">
                                        <i class="fa-solid fa-graduation-cap text-warning me-1"></i> Mahasiswa Mitra Kampus
                                    </span>
                                    <small class="text-muted" style="font-size: 0.75rem;">Akses silabus 32 JP, modul praktikum koding, ujian & sertifikat SKPI.</small>
                                </div>
                            </label>

                            <!-- Role Ormawa -->
                            <label class="role-check-card d-flex align-items-center gap-3" for="roleOrmawa">
                                <input class="form-check-input edit-role-chk m-0" type="checkbox" value="ormawa" id="roleOrmawa">
                                <div>
                                    <span class="fw-bold text-navy d-block small">
                                        <i class="fa-solid fa-handshake-angle text-success me-1"></i> Pengurus UKM MSC / Ormawa
                                    </span>
                                    <small class="text-muted" style="font-size: 0.75rem;">Dashboard kelola anggota bootcamp, verifikasi berkas, dan bagi hasil kas.</small>
                                </div>
                            </label>

                            <!-- Role Dekanat -->
                            <label class="role-check-card d-flex align-items-center gap-3" for="roleDekan">
                                <input class="form-check-input edit-role-chk m-0" type="checkbox" value="dekanat" id="roleDekan">
                                <div>
                                    <span class="fw-bold text-navy d-block small">
                                        <i class="fa-solid fa-building-columns text-primary me-1"></i> Dekanat & Dosen Pembina
                                    </span>
                                    <small class="text-muted" style="font-size: 0.75rem;">Panel pimpinan monitoring keaktifan mahasiswa & unduh Berita Acara SKPI.</small>
                                </div>
                            </label>

                            <!-- Role Freelance -->
                            <label class="role-check-card d-flex align-items-center gap-3" for="roleFreelance">
                                <input class="form-check-input edit-role-chk m-0" type="checkbox" value="freelancer" id="roleFreelance">
                                <div>
                                    <span class="fw-bold text-navy d-block small">
                                        <i class="fa-solid fa-laptop-code text-info me-1"></i> Freelance & IT Work
                                    </span>
                                    <small class="text-muted" style="font-size: 0.75rem;">Akses bursa proyek freelance, submit pekerjaan, dan penarikan fee.</small>
                                </div>
                            </label>

                            <!-- Role Superadmin -->
                            <label class="role-check-card d-flex align-items-center gap-3" for="roleAdmin">
                                <input class="form-check-input edit-role-chk m-0" type="checkbox" value="admin" id="roleAdmin">
                                <div>
                                    <span class="fw-bold text-danger d-block small">
                                        <i class="fa-solid fa-crown text-danger me-1"></i> Administrator Skillance (Superadmin)
                                    </span>
                                    <small class="text-muted" style="font-size: 0.75rem;">Akses penuh ke seluruh kantor pusat, semua portal, dan pengatur hak akses.</small>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div class="alert alert-info py-2 px-3 small mb-0 rounded-3" style="font-size: 0.75rem;">
                        <i class="fa-solid fa-lightbulb text-warning me-1"></i>
                        <strong>Contoh Kasus Multi-Role:</strong> Untuk Ketua MSC, centang <strong>Pengurus UKM MSC</strong> dan <strong>Mahasiswa Mitra</strong> agar dapat mengelola organisasi sekaligus masuk mode belajar.
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-sm btn-secondary rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-sm btn-navy fw-bold rounded-pill px-4" id="btnSaveRoles" onclick="saveUserRoles()">
                        <i class="fa-solid fa-check me-1"></i> Simpan Hak Akses
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let allUsersData = [];
        let editModal = null;

        document.addEventListener('DOMContentLoaded', () => {
            editModal = new bootstrap.Modal(document.getElementById('modalEditRoles'));

            function loadData() {
                fetch('../../api/hrd_api.php')
                    .then(r => r.json())
                    .then(res => {
                        if (res.status === 'success') {
                            document.getElementById('totalAdmin').textContent = res.summary.admin || 0;
                            document.getElementById('totalDekanat').textContent = res.summary.dekanat || 0;
                            document.getElementById('totalOrmawa').textContent = res.summary.ormawa || 0;
                            document.getElementById('totalMahasiswa').textContent = (res.summary.mahasiswa || 0) + ' / ' + (res.summary.freelancer || 0);

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
                    tbody.innerHTML = `<tr><td colspan="4" class="text-center py-4 text-muted">Tidak ada pengguna ditemukan.</td></tr>`;
                    return;
                }

                users.forEach(item => {
                    // Multi-role tags
                    const rawRoles = (item.assigned_roles || item.role || 'freelancer').toLowerCase();
                    const rolesArr = rawRoles.split(',').map(s => s.trim());
                    
                    let roleTagsHtml = '';
                    if (item.role === 'admin' || rolesArr.includes('admin')) {
                        roleTagsHtml += '<span class="badge-role-tag bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25"><i class="fa-solid fa-crown"></i> Superadmin</span>';
                    }
                    if (rolesArr.includes('dekanat')) {
                        roleTagsHtml += '<span class="badge-role-tag bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25"><i class="fa-solid fa-building-columns"></i> Dekanat</span>';
                    }
                    if (rolesArr.includes('ormawa')) {
                        roleTagsHtml += '<span class="badge-role-tag bg-success bg-opacity-10 text-success border border-success border-opacity-25"><i class="fa-solid fa-handshake-angle"></i> Ormawa MSC</span>';
                    }
                    if (rolesArr.includes('mahasiswa')) {
                        roleTagsHtml += '<span class="badge-role-tag bg-warning bg-opacity-15 text-warning-emphasis border border-warning border-opacity-25"><i class="fa-solid fa-graduation-cap"></i> Mahasiswa</span>';
                    }
                    if (rolesArr.includes('freelancer')) {
                        roleTagsHtml += '<span class="badge-role-tag bg-info bg-opacity-10 text-info-emphasis border border-info border-opacity-25"><i class="fa-solid fa-laptop-code"></i> Freelancer</span>';
                    }

                    const partnerBadge = item.partner_slug === 'msc-usn' 
                        ? '<span class="badge bg-light text-navy border fw-bold" style="font-size: 0.72rem;">FTI USN Kolaka x UKM MSC</span>' 
                        : '<span class="badge bg-light text-muted border" style="font-size: 0.72rem;">Umum</span>';

                    const positionText = item.position_title 
                        ? `<div class="fw-semibold text-navy small mb-1"><i class="fa-solid fa-id-badge text-gold me-1"></i>${item.position_title}</div>` 
                        : '';

                    const avatarLetter = (item.name || 'U').charAt(0).toUpperCase();

                    tbody.innerHTML += `
                        <tr>
                            <td class="ps-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="rounded-circle bg-navy text-white fw-bold d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; font-size: 0.95rem; flex-shrink: 0;">
                                        ${avatarLetter}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-navy small">${item.name}</div>
                                        <small class="text-muted" style="font-size: 0.73rem;">${item.email}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                ${positionText}
                                ${partnerBadge}
                            </td>
                            <td>
                                <div class="d-flex flex-wrap align-items-center">
                                    ${roleTagsHtml || '<span class="text-muted small">-</span>'}
                                </div>
                            </td>
                            <td class="text-end pe-3">
                                <button class="btn btn-sm btn-navy rounded-pill px-3 py-1 fw-bold me-1" style="font-size: 0.75rem;" onclick="openEditRoles(${item.id})">
                                    <i class="fa-solid fa-sliders me-1"></i> Atur Role
                                </button>
                                ${item.id == 1 ? '' : `
                                <button class="btn btn-sm btn-outline-danger rounded-circle p-1" style="width: 28px; height: 28px;" title="Hapus Akun" onclick="deleteUser(${item.id}, '${item.name.replace(/'/g, "\\'")}')">
                                    <i class="fa-solid fa-trash" style="font-size: 11px;"></i>
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
                    (u.assigned_roles && u.assigned_roles.toLowerCase().includes(q)) ||
                    (u.position_title && u.position_title.toLowerCase().includes(q))
                );
                renderUsers(filtered);
            });

            loadData();

            // Open Edit Modal
            window.openEditRoles = function(userId) {
                const user = allUsersData.find(u => u.id == userId);
                if (!user) return;

                document.getElementById('editUserId').value = user.id;
                document.getElementById('editUserName').textContent = user.name;
                document.getElementById('editUserEmail').textContent = user.email;
                document.getElementById('editAvatarBox').textContent = (user.name || 'U').charAt(0).toUpperCase();
                document.getElementById('editPositionTitle').value = user.position_title || '';
                document.getElementById('editPartnerSlug').value = user.partner_slug || 'msc-usn';

                // Parse current roles
                const rawRoles = (user.assigned_roles || user.role || 'freelancer').toLowerCase();
                const rolesArr = rawRoles.split(',').map(s => s.trim());

                document.querySelectorAll('.edit-role-chk').forEach(chk => {
                    chk.checked = rolesArr.includes(chk.value) || (chk.value === 'admin' && user.role === 'admin');
                });

                editModal.show();
            };

            // Save User Roles AJAX
            window.saveUserRoles = function() {
                const userId = document.getElementById('editUserId').value;
                const positionTitle = document.getElementById('editPositionTitle').value.trim();
                const partnerSlug = document.getElementById('editPartnerSlug').value;

                const selectedRoles = [];
                document.querySelectorAll('.edit-role-chk:checked').forEach(chk => {
                    selectedRoles.push(chk.value);
                });

                if (selectedRoles.length === 0) {
                    Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Minimal pilih 1 hak akses untuk pengguna.' });
                    return;
                }

                const btn = document.getElementById('btnSaveRoles');
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Menyimpan...';
                btn.disabled = true;

                const payload = {
                    action: 'update_roles',
                    id: userId,
                    assigned_roles: selectedRoles.join(','),
                    partner_slug: partnerSlug,
                    position_title: positionTitle,
                    role: selectedRoles.includes('admin') ? 'admin' : (selectedRoles.includes('freelancer') ? 'freelancer' : 'staff')
                };

                fetch('../../api/hrd_api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                })
                .then(r => r.json())
                .then(res => {
                    btn.innerHTML = '<i class="fa-solid fa-check me-1"></i> Simpan Hak Akses';
                    btn.disabled = false;

                    if (res.status === 'success') {
                        editModal.hide();
                        Swal.fire({ icon: 'success', title: 'Berhasil!', text: res.message, timer: 1500, showConfirmButton: false });
                        loadData();
                    } else {
                        Swal.fire({ icon: 'error', title: 'Gagal', text: res.message });
                    }
                })
                .catch(err => {
                    console.error(err);
                    btn.innerHTML = '<i class="fa-solid fa-check me-1"></i> Simpan Hak Akses';
                    btn.disabled = false;
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Gagal menghubungi server.' });
                });
            };

            // Submit Tambah User Cepat
            document.getElementById('formUser').addEventListener('submit', function (e) {
                e.preventDefault();

                const btn = document.getElementById('btnSubmit');
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Mendaftarkan...';
                btn.disabled = true;

                const selectedRoles = [];
                document.querySelectorAll('.new-role-check:checked').forEach(chk => {
                    selectedRoles.push(chk.value);
                });

                if (selectedRoles.length === 0) {
                    Swal.fire({ icon: 'warning', title: 'Perhatian', text: 'Pilih minimal satu hak akses multi-role.' });
                    btn.innerHTML = '<i class="fa-solid fa-user-plus me-1"></i> Daftarkan Pengguna';
                    btn.disabled = false;
                    return;
                }

                const data = {
                    name: document.getElementById('userName').value.trim(),
                    email: document.getElementById('userEmail').value.trim(),
                    password: document.getElementById('userPass').value,
                    position_title: document.getElementById('userPosition').value.trim(),
                    partner_slug: document.getElementById('userPartner').value,
                    assigned_roles: selectedRoles.join(','),
                    role: selectedRoles.includes('admin') ? 'admin' : (selectedRoles.includes('freelancer') ? 'freelancer' : 'staff')
                };

                fetch('../../api/hrd_api.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data)
                })
                    .then(r => r.json())
                    .then(res => {
                        btn.innerHTML = '<i class="fa-solid fa-user-plus me-1"></i> Daftarkan Pengguna';
                        btn.disabled = false;

                        if (res.status === 'success') {
                            Swal.fire({ icon: 'success', title: 'Berhasil!', text: res.message, timer: 1500, showConfirmButton: false });
                            document.getElementById('formUser').reset();
                            loadData();
                        } else {
                            Swal.fire({ icon: 'error', title: 'Gagal', text: res.message });
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        btn.innerHTML = '<i class="fa-solid fa-user-plus me-1"></i> Daftarkan Pengguna';
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