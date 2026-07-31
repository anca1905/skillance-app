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
    <title>Manajemen Tim | S-OS Skillance</title>

    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">

    <style>
        body { background-color: #f3f4f6; overflow-x: hidden; }
        .sidebar { width: 250px; height: 100vh; position: fixed; top: 0; left: 0; background-color: var(--white); border-right: 1px solid rgba(0, 0, 0, 0.05); padding-top: 20px; z-index: 1000; transition: 0.3s; }
        .main-content { margin-left: 250px; padding: 20px; transition: 0.3s; }
        .nav-link { color: var(--text-body); padding: 12px 20px; font-weight: 500; display: flex; align-items: center; gap: 10px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background-color: var(--navy-subtle); color: var(--navy) !important; border-right: 3px solid var(--navy); }
        .nav-link i { width: 20px; text-align: center; }
        @media (max-width: 768px) { .sidebar { margin-left: -250px; } .sidebar.active { margin-left: 0; } .main-content { margin-left: 0; } }
        .card { border: none; box-shadow: 0 2px 15px rgba(0, 0, 0, 0.03); border-radius: 8px; }
        .avatar-preview { width: 60px; height: 60px; object-fit: cover; border-radius: 50%; }
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
            <li class="nav-item"><a href="index.php" class="nav-link active"><i class="fa-solid fa-people-group"></i> Manajemen Tim</a></li>
            <li class="nav-item"><a href="../profile.php" class="nav-link text-warning"><i class="fa-solid fa-user-gear"></i> Profil Saya</a></li>
            <li class="nav-item mt-4"><a href="#" class="nav-link text-danger" id="btnLogout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-navy btn-sm d-md-none" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
                <div>
                    <h4 class="fw-bold text-navy mb-0">Manajemen Tim (Organigram)</h4>
                    <small class="text-muted">Kelola struktur anggota tim untuk Landing Page Skillance.</small>
                </div>
            </div>
            
            <div class="d-none d-md-flex align-items-center gap-3">
                <div class="text-end">
                    <small class="d-block fw-bold text-navy" id="userNameDisplay">Memuat...</small>
                    <small class="text-muted" style="font-size: 0.7rem;" id="userRoleDisplay">Administrator</small>
                </div>
                <!-- Profile photo container -->
                <div class="bg-navy text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;" id="headerUserPhoto">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                <h6 class="m-0 fw-bold text-navy">Direktori Anggota Tim</h6>
                <button class="btn btn-navy fw-bold px-3 btn-sm" onclick="openAddModal()">
                    <i class="fa-solid fa-plus me-1"></i> Tambah Anggota
                </button>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light text-muted small">
                            <tr>
                                <th class="px-4 py-3">FOTO & NAMA</th>
                                <th>JABATAN</th>
                                <th>SOSIAL MEDIA</th>
                                <th>URUTAN</th>
                                <th class="text-end px-4">AKSI</th>
                            </tr>
                        </thead>
                        <tbody id="teamTableBody">
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted"><i class="fa-solid fa-spinner fa-spin me-2"></i> Memuat data tim...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    <!-- Modal Form Team Member -->
    <div class="modal fade" id="teamModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-navy text-white">
                    <h5 class="modal-title fw-bold" id="modalTitle">Tambah Anggota Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="teamForm" enctype="multipart/form-data">
                    <input type="hidden" name="action" id="formAction" value="add">
                    <input type="hidden" name="id" id="memberId" value="0">
                    <div class="modal-body">
                        <div class="mb-3 text-center">
                            <img src="../../assets/img/placeholder-user.png" id="previewPhoto" class="avatar-preview shadow-sm mb-2" onerror="this.src='https://ui-avatars.com/api/?name=Tim&background=0D2E5C&color=fff'">
                            <input type="file" name="photo" id="photoInput" class="form-control form-control-sm" accept="image/png, image/jpeg">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto</small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">NAMA LENGKAP</label>
                            <input type="text" name="name" id="inputName" class="form-control" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">JABATAN / POSISI</label>
                            <input type="text" name="position" id="inputPosition" class="form-control" placeholder="Contoh: CEO & Founder" required>
                        </div>

                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted">LINK INSTAGRAM</label>
                                <input type="url" name="instagram" id="inputIg" class="form-control" placeholder="https://instagram.com/...">
                            </div>
                            <div class="col-6">
                                <label class="form-label small fw-bold text-muted">LINK LINKEDIN</label>
                                <input type="url" name="linkedin" id="inputIn" class="form-control" placeholder="https://linkedin.com/in/...">
                            </div>
                            <div class="col-12 mt-2">
                                <label class="form-label small fw-bold text-muted">LINK GITHUB</label>
                                <input type="url" name="github" id="inputGit" class="form-control" placeholder="https://github.com/...">
                            </div>
                        </div>

                        <div class="mb-2">
                            <label class="form-label small fw-bold text-muted">NOMOR URUTAN TAMPIL</label>
                            <input type="number" name="order_num" id="inputOrder" class="form-control" value="0">
                            <small class="text-muted text-xs">Semakin kecil angkanya, semakin tinggi posisinya di halaman</small>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0 pt-0">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-navy" id="btnSave">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const API_URL = '../../api/team_api.php';
        let modalInstance;

        document.addEventListener("DOMContentLoaded", function () {
            // Sidebar mobile
            document.getElementById('sidebarToggle')?.addEventListener('click', () => {
                document.getElementById('sidebar').classList.toggle('active');
            });

            // Set Header user name & photo
            document.getElementById('userNameDisplay').innerText = localStorage.getItem('userName') || 'Admin';
            const role = localStorage.getItem('userRole');
            if(role) document.getElementById('userRoleDisplay').innerText = role;
            
            const pUrl = localStorage.getItem('userPhoto');
            if (pUrl && document.getElementById('headerUserPhoto')) {
                document.getElementById('headerUserPhoto').innerHTML = `<img src="${pUrl}" class="rounded-circle" style="width: 100%; height: 100%; object-fit: cover;" alt="Profile">`;
                document.getElementById('headerUserPhoto').classList.remove('bg-navy', 'text-white');
            }

            // Logout Event
            document.getElementById('btnLogout')?.addEventListener('click', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Keluar Sistem?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#0d2e5c'
                }).then((res) => {
                    if(res.isConfirmed) {
                        fetch('../../api/logout.php').then(() => {
                            localStorage.clear();
                            window.location.href = '../../auth/index.php';
                        });
                    }
                });
            });

            // Modal Init
            modalInstance = new bootstrap.Modal(document.getElementById('teamModal'));

            // Photo Preview
            document.getElementById('photoInput').addEventListener('change', function(e) {
                if(this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = e => document.getElementById('previewPhoto').src = e.target.result;
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Form Submit
            document.getElementById('teamForm').addEventListener('submit', function(e) {
                e.preventDefault();
                const btn = document.getElementById('btnSave');
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';
                btn.disabled = true;

                const formData = new FormData(this);
                
                fetch(API_URL, {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        modalInstance.hide();
                        Swal.fire('Berhasil!', data.message, 'success');
                        loadTeam();
                    } else {
                        Swal.fire('Gagal', data.message, 'error');
                    }
                })
                .finally(() => {
                    btn.innerHTML = 'Simpan';
                    btn.disabled = false;
                });
            });

            // Load Initial Data
            loadTeam();
        });

        function loadTeam() {
            const tbody = document.getElementById('teamTableBody');
            fetch(API_URL)
                .then(res => res.json())
                .then(data => {
                    tbody.innerHTML = '';
                    if (!data.data || data.data.length === 0) {
                        tbody.innerHTML = '<tr><td colspan="5" class="text-center py-4 text-muted">Belum ada anggota tim yang terdaftar.</td></tr>';
                        return;
                    }

                    data.data.forEach(member => {
                        const avatar = member.photo ? `../../assets/img/team/${member.photo}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(member.name)}&background=0D2E5C&color=fff`;
                        
                        let socialLinks = '';
                        if(member.instagram) socialLinks += `<a href="${member.instagram}" target="_blank" class="text-danger me-2"><i class="fa-brands fa-instagram fs-5"></i></a>`;
                        if(member.linkedin) socialLinks += `<a href="${member.linkedin}" target="_blank" class="text-primary me-2"><i class="fa-brands fa-linkedin fs-5"></i></a>`;
                        if(member.github) socialLinks += `<a href="${member.github}" target="_blank" class="text-dark me-2"><i class="fa-brands fa-github fs-5"></i></a>`;

                        const tr = document.createElement('tr');
                        tr.innerHTML = `
                            <td class="px-4 py-3">
                                <div class="d-flex align-items-center">
                                    <img src="${avatar}" class="rounded-circle shadow-sm me-3" style="width: 40px; height: 40px; object-fit: cover;">
                                    <div class="fw-bold text-navy">${member.name}</div>
                                </div>
                            </td>
                            <td>${member.position}</td>
                            <td>${socialLinks || '-'}</td>
                            <td><span class="badge bg-light text-dark border">${member.order_num}</span></td>
                            <td class="text-end px-4">
                                <button class="btn btn-sm btn-outline-primary py-1 px-2 me-1" onclick='editMember(${JSON.stringify(member).replace(/'/g, "\\'")})'>
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button class="btn btn-sm btn-outline-danger py-1 px-2" onclick="deleteMember(${member.id})">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        `;
                        tbody.appendChild(tr);
                    });
                });
        }

        window.openAddModal = function() {
            document.getElementById('formAction').value = 'add';
            document.getElementById('memberId').value = '0';
            document.getElementById('teamForm').reset();
            document.getElementById('modalTitle').innerText = 'Tambah Anggota Baru';
            document.getElementById('previewPhoto').src = 'https://ui-avatars.com/api/?name=Tim&background=0D2E5C&color=fff';
            modalInstance.show();
        };

        window.editMember = function(member) {
            document.getElementById('formAction').value = 'edit';
            document.getElementById('memberId').value = member.id;
            document.getElementById('inputName').value = member.name;
            document.getElementById('inputPosition').value = member.position;
            document.getElementById('inputIg').value = member.instagram || '';
            document.getElementById('inputIn').value = member.linkedin || '';
            document.getElementById('inputGit').value = member.github || '';
            document.getElementById('inputOrder').value = member.order_num;
            
            document.getElementById('modalTitle').innerText = 'Edit Data Anggota';
            const avatar = member.photo ? `../../assets/img/team/${member.photo}` : `https://ui-avatars.com/api/?name=${encodeURIComponent(member.name)}&background=0D2E5C&color=fff`;
            document.getElementById('previewPhoto').src = avatar;
            
            modalInstance.show();
        };

        window.deleteMember = function(id) {
            Swal.fire({
                title: 'Hapus anggota ini?',
                text: "Data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Ya, Hapus'
            }).then((result) => {
                if (result.isConfirmed) {
                    const fd = new FormData();
                    fd.append('action', 'delete');
                    fd.append('id', id);
                    fetch(API_URL, { method: 'POST', body: fd })
                    .then(res => res.json())
                    .then(data => {
                        if(data.status === 'success') {
                            Swal.fire('Terhapus!', data.message, 'success');
                            loadTeam();
                        } else {
                            Swal.fire('Gagal', data.message, 'error');
                        }
                    });
                }
            });
        };
    </script>
</body>
</html>
