<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/index.php");
    exit();
}
require_once '../config/config.php';

$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT id, name, email, role, photo FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$myProfile = $stmt->get_result()->fetch_assoc();
$stmt->close();

$photoUrl = !empty($myProfile['photo']) ? "../assets/img/profile/" . $myProfile['photo'] : "https://ui-avatars.com/api/?name=" . urlencode($myProfile['name']) . "&background=0D2E5C&color=fff";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil | S-OS Skillance</title>

    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link rel="apple-touch-icon" href="../assets/img/favicon.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">

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

        .profile-img-preview {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
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
                <a href="index.php" class="nav-link">
                    <i class="fa-solid fa-chart-line"></i> Dashboard
                </a>
            </li>
            <li class="nav-item"><a href="project/index.php" class="nav-link"><i class="fa-solid fa-briefcase"></i> Project</a></li>
            <li class="nav-item"><a href="finance/index.php" class="nav-link"><i class="fa-solid fa-wallet"></i> Keuangan</a></li>
            <li class="nav-item"><a href="investment/index.php" class="nav-link"><i class="fa-solid fa-hand-holding-dollar"></i> Investasi Admin</a></li>
            <li class="nav-item"><a href="hrd/index.php" class="nav-link text-primary"><i class="fa-solid fa-users"></i> HRD</a></li>
            <li class="nav-item"><a href="team/index.php" class="nav-link"><i class="fa-solid fa-people-group"></i> Manajemen Tim</a></li>
            <li class="nav-item"><a href="../payroll/index.php" class="nav-link"><i class="fa-solid fa-money-check-dollar"></i> Penggajian</a></li>
            <li class="nav-item"><a href="blog/index.php" class="nav-link"><i class="fa-solid fa-newspaper"></i> Kelola Artikel</a></li>
            <li class="nav-item">
                <a href="profile.php" class="nav-link active text-warning">
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-navy btn-sm d-md-none" id="sidebarToggle"><i class="fa-solid fa-bars"></i></button>
                <div>
                    <h4 class="fw-bold text-navy mb-0">Pengaturan Profil</h4>
                    <small class="text-muted">Perbarui data diri dan preferensi keamanan Anda.</small>
                </div>
            </div>

            <div class="d-none d-md-flex align-items-center gap-3">
                <div class="text-end">
                    <small class="d-block fw-bold text-navy"><?= htmlspecialchars($myProfile['name']); ?></small>
                    <small class="text-muted" style="font-size: 0.7rem; text-transform: capitalize;"><?= htmlspecialchars($myProfile['role']); ?></small>
                </div>
                <img src="<?= $photoUrl ?>" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;" alt="Profile">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-sm mb-4">
                    <div class="card-body p-4 p-md-5">

                        <form id="formProfile" enctype="multipart/form-data">

                            <!-- Foto Section -->
                            <div class="text-center mb-5">
                                <div class="position-relative d-inline-block">
                                    <img src="<?= $photoUrl ?>" id="profilePreview" class="profile-img-preview mb-3" alt="Foto Profil">
                                    <label for="photo" class="position-absolute bottom-0 end-0 bg-gold text-navy rounded-circle p-2 shadow cursor-pointer shadow-sm hover-up" style="cursor:pointer;" title="Ubah Foto">
                                        <i class="fa-solid fa-camera"></i>
                                    </label>
                                    <input type="file" id="photo" name="photo" accept="image/png, image/jpeg" class="d-none">
                                </div>
                                <div>
                                    <small class="text-muted d-block">Format JPG/PNG. Maks 2MB.</small>
                                </div>
                            </div>

                            <h6 class="fw-bold text-navy border-bottom pb-2 mb-4">Informasi Dasar</h6>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">NAMA LENGKAP</label>
                                    <input type="text" name="name" class="form-control bg-light" value="<?= htmlspecialchars($myProfile['name']); ?>" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">ALAMAT EMAIL</label>
                                    <input type="email" name="email" class="form-control bg-light" value="<?= htmlspecialchars($myProfile['email']); ?>" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label small fw-bold text-muted">ROLE / POSISI</label>
                                    <input type="text" class="form-control bg-light text-capitalize" value="<?= htmlspecialchars($myProfile['role']); ?>" disabled readonly>
                                    <small class="text-muted" style="font-size: 0.7rem;">(Role hanya bisa diubah oleh Administrator / HRD)</small>
                                </div>
                            </div>

                            <h6 class="fw-bold text-navy border-bottom pb-2 mb-4 mt-5">Ubah Password <span class="fw-normal text-muted small">(Opsional)</span></h6>
                            <p class="small text-muted mb-3">Kosongkan kolom di bawah jika Anda tidak ingin mengubah password saat ini.</p>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">PASSWORD BARU</label>
                                    <input type="password" name="password" id="newPassword" class="form-control bg-light" placeholder="Masukkan password baru">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label small fw-bold text-muted">ULANGI PASSWORD</label>
                                    <input type="password" id="confirmPassword" class="form-control bg-light" placeholder="Konfirmasi password baru">
                                </div>
                            </div>

                            <div class="mt-5 text-end">
                                <button type="submit" class="btn btn-navy px-5 fw-bold hover-up" id="btnSaveProfile">Simpan Perubahan <i class="fa-solid fa-floppy-disk ms-2"></i></button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Toggle sidebar mobile
            const toggleBtn = document.getElementById('sidebarToggle');
            if (toggleBtn) {
                toggleBtn.addEventListener('click', function() {
                    document.getElementById('sidebar').classList.toggle('active');
                });
            }

            // Image Preview
            const photoInput = document.getElementById('photo');
            const profilePreview = document.getElementById('profilePreview');

            photoInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profilePreview.src = e.target.result;
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Logout
            const btnLogout = document.getElementById('btnLogout');
            if (btnLogout) {
                btnLogout.addEventListener('click', function(e) {
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
                            fetch('../api/logout.php')
                                .then(() => {
                                    localStorage.clear();
                                    window.location.href = '../auth/index.php';
                                });
                        }
                    });
                });
            }

            // Form Submit
            const formProfile = document.getElementById('formProfile');
            formProfile.addEventListener('submit', function(e) {
                e.preventDefault();

                const pwd1 = document.getElementById('newPassword').value;
                const pwd2 = document.getElementById('confirmPassword').value;

                if (pwd1 !== '' && pwd1 !== pwd2) {
                    Swal.fire('Oops!', 'Sandi baru dan konfirmasi tidak cocok.', 'error');
                    return;
                }

                const formData = new FormData(this);
                const btn = document.getElementById('btnSaveProfile');
                const btnOriginal = btn.innerHTML;
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';
                btn.disabled = true;

                fetch('../api/profile_update.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Update localstorage name just in case other scripts use it
                            localStorage.setItem('userName', data.user.name);

                            Swal.fire('Berhasil!', data.message, 'success').then(() => {
                                window.location.reload();
                            });
                        } else {
                            Swal.fire('Gagal', data.message, 'error');
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        Swal.fire('Error', 'Terjadi kesalahan sistem', 'error');
                    })
                    .finally(() => {
                        btn.innerHTML = btnOriginal;
                        btn.disabled = false;
                    });
            });
        });
    </script>
</body>

</html>
