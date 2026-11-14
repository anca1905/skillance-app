<?php
session_start();

$userName = $_SESSION['user_name'] ?? 'Pengguna Skillance';
$userEmail = $_SESSION['user_email'] ?? 'user@skillance.cloud';
$userPhoto = $_SESSION['user_photo'] ?? ('https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=0d2e5c&color=fff');
$currentRole = $_SESSION['user_role'] ?? 'freelancer';

// Handle Role Selection Action
if (isset($_GET['select'])) {
    $selected = $_GET['select'];
    $_SESSION['active_portal'] = $selected;

    switch ($selected) {
        case 'mahasiswa':
            header("Location: ../academy/partner-portal.php?partner=msc-usn");
            exit();
        case 'dekanat':
            $_SESSION['partner_auth_msc-usn'] = true;
            header("Location: ../academy/dashboard-partner.php?partner=msc-usn&auth=demo");
            exit();
        case 'ormawa':
            $_SESSION['partner_auth_msc-usn'] = true;
            header("Location: ../academy/dashboard-partner.php?partner=msc-usn&auth=demo");
            exit();
        case 'freelancer':
            header("Location: ../dashboard/freelancer/index.php");
            exit();
        case 'admin':
            header("Location: ../dashboard/index.php");
            exit();
        case 'umum':
        default:
            header("Location: ../academy/my-learning.php");
            exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Peran & Portal Akses | S-OS Skillance Ecosystem</title>
    
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Cinzel:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --navy: #0d2e5c;
            --navy-dark: #071a35;
            --gold: #fca311;
            --gold-dark: #d97706;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #071a35 0%, #0d2e5c 60%, #1e3a8a 100%);
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
            margin: 0;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at 80% 20%, rgba(252, 163, 17, 0.12) 0%, transparent 60%);
            pointer-events: none;
        }

        .portal-container {
            max-width: 1050px;
            width: 100%;
            z-index: 2;
            position: relative;
        }

        /* Glassmorphism Card Wrapper */
        .glass-box {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 24px;
            padding: 40px 35px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Role Selection Card */
        .role-card {
            background: #ffffff;
            border: 2px solid #e2e8f0;
            border-radius: 18px;
            padding: 24px 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-decoration: none;
            color: inherit;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .role-card:hover {
            transform: translateY(-5px);
            border-color: #0d2e5c;
            box-shadow: 0 12px 28px rgba(13, 46, 92, 0.12);
            color: inherit;
        }

        .role-card.active-recommended {
            border-color: #fca311;
            box-shadow: 0 8px 25px rgba(252, 163, 17, 0.18);
        }

        .role-icon-box {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 16px;
        }

        .user-profile-badge {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 50rem;
            padding: 6px 16px 6px 8px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }
    </style>
</head>
<body>

    <div class="portal-container">
        <div class="glass-box">

            <!-- HEADER / IDENTITY -->
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-4 mb-4 border-bottom gap-3">
                <div class="d-flex align-items-center gap-3">
                    <img src="../assets/img/logo_skillance_official.png" alt="Logo Skillance" style="max-height: 44px; width: auto;">
                    <div>
                        <span class="badge bg-warning text-navy fw-bold px-2 py-1 small">SIAKAD Unified Gateway</span>
                        <h4 class="fw-bold mb-0 text-navy font-heading" style="color: #0d2e5c;">Pilih Portal & Peran Akses</h4>
                    </div>
                </div>

                <!-- USER ACTIVE SESSION -->
                <div class="user-profile-badge">
                    <img src="<?= htmlspecialchars($userPhoto) ?>" alt="Avatar" width="34" height="34" class="rounded-circle border">
                    <div class="text-start" style="line-height: 1.2;">
                        <span class="d-block fw-bold text-dark small"><?= htmlspecialchars($userName) ?></span>
                        <small class="text-muted" style="font-size: 0.72rem;"><?= htmlspecialchars($userEmail) ?></small>
                    </div>
                    <a href="logout.php" class="btn btn-sm btn-outline-danger rounded-circle p-1 ms-2" style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center;" title="Keluar Akun">
                        <i class="fa-solid fa-power-off" style="font-size: 11px;"></i>
                    </a>
                </div>
            </div>

            <!-- SUBTITLE PROMPT -->
            <div class="text-center mb-4">
                <h5 class="fw-bold text-navy mb-1">Masuk Sebagai Apa Hari Ini?</h5>
                <p class="text-muted small mx-auto mb-0" style="max-width: 620px;">
                    Satu akun terintegrasi untuk seluruh ekosistem PT Skillance Digital Indonesia. Anda dapat berpindah peran kapan saja melalui menu profil.
                </p>
            </div>

            <!-- 4 ROLE SELECTION CARDS (SIAKAD PATTERN) -->
            <div class="row g-3">
                <!-- PERAN 1: MAHASISWA / PESERTA KEMITRAAN -->
                <div class="col-md-6 col-lg-3">
                    <a href="select_role.php?select=mahasiswa" class="role-card active-recommended">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-gold text-navy fw-bold" style="font-size: 0.68rem;">Program Mahasiswa</span>
                                <i class="fa-solid fa-arrow-right text-muted small"></i>
                            </div>
                            <div class="role-icon-box bg-warning bg-opacity-10 text-warning">
                                <i class="fa-solid fa-user-graduate"></i>
                            </div>
                            <h5 class="fw-bold text-navy mb-1" style="font-size: 1.05rem;">Mahasiswa Mitra</h5>
                            <small class="text-muted fw-semibold d-block mb-2">FTI USN Kolaka & UKM MSC</small>
                            <p class="text-muted small mb-0" style="font-size: 0.80rem; line-height: 1.5;">
                                Akses silabus terstruktur 32 JP, modul praktikum koding, ujian kompetensi, dan klaim sertifikat SKPI.
                            </p>
                        </div>
                        <div class="pt-3 mt-3 border-top">
                            <span class="btn btn-sm btn-navy fw-bold w-100 rounded-pill py-2">
                                Masuk ke Kelas &raquo;
                            </span>
                        </div>
                    </a>
                </div>

                <!-- PERAN 2: DEKANAT & DOSEN PEMBINA -->
                <div class="col-md-6 col-lg-3">
                    <a href="select_role.php?select=dekanat" class="role-card">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-primary-subtle text-primary fw-bold" style="font-size: 0.68rem;">Otoritas Kampus</span>
                                <i class="fa-solid fa-arrow-right text-muted small"></i>
                            </div>
                            <div class="role-icon-box bg-primary bg-opacity-10 text-primary">
                                <i class="fa-solid fa-building-columns"></i>
                            </div>
                            <h5 class="fw-bold text-navy mb-1" style="font-size: 1.05rem;">Dekanat & Dosen</h5>
                            <small class="text-muted fw-semibold d-block mb-2">Pimpinan Fakultas & Prodi</small>
                            <p class="text-muted small mb-0" style="font-size: 0.80rem; line-height: 1.5;">
                                Panel monitoring keaktifan mahasiswa, progres modul, skor kelulusan, serta unduh Berita Acara SKPI.
                            </p>
                        </div>
                        <div class="pt-3 mt-3 border-top">
                            <span class="btn btn-sm btn-outline-navy fw-bold w-100 rounded-pill py-2">
                                Buka Dashboard &raquo;
                            </span>
                        </div>
                    </a>
                </div>

                <!-- PERAN 3: PENGURUS ORMAWA / KETUA UKM -->
                <div class="col-md-6 col-lg-3">
                    <a href="select_role.php?select=ormawa" class="role-card">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-success-subtle text-success fw-bold" style="font-size: 0.68rem;">Penyelenggara</span>
                                <i class="fa-solid fa-arrow-right text-muted small"></i>
                            </div>
                            <div class="role-icon-box bg-success bg-opacity-10 text-success">
                                <i class="fa-solid fa-handshake-angle"></i>
                            </div>
                            <h5 class="fw-bold text-navy mb-1" style="font-size: 1.05rem;">Pengurus UKM MSC</h5>
                            <small class="text-muted fw-semibold d-block mb-2">Ketua & Panitia Ormawa</small>
                            <p class="text-muted small mb-0" style="font-size: 0.80rem; line-height: 1.5;">
                                Kelola pendaftaran anggota, absensi bootcamp, verifikasi berkas, dan bagi hasil kas organisasi.
                            </p>
                        </div>
                        <div class="pt-3 mt-3 border-top">
                            <span class="btn btn-sm btn-outline-navy fw-bold w-100 rounded-pill py-2">
                                Kelola Anggota &raquo;
                            </span>
                        </div>
                    </a>
                </div>

                <!-- PERAN 4: FREELANCER / TALENTA DIGITAL -->
                <div class="col-md-6 col-lg-3">
                    <a href="select_role.php?select=freelancer" class="role-card">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="badge bg-info-subtle text-info fw-bold" style="font-size: 0.68rem;">Studio & Proyek</span>
                                <i class="fa-solid fa-arrow-right text-muted small"></i>
                            </div>
                            <div class="role-icon-box bg-info bg-opacity-10 text-info">
                                <i class="fa-solid fa-laptop-code"></i>
                            </div>
                            <h5 class="fw-bold text-navy mb-1" style="font-size: 1.05rem;">Freelance & IT Work</h5>
                            <small class="text-muted fw-semibold d-block mb-2">Skillance Tech Network</small>
                            <p class="text-muted small mb-0" style="font-size: 0.80rem; line-height: 1.5;">
                                Ambil proyek pembuatan software, submit tugas freelance, pantau saldo dompet dan penarikan fee.
                            </p>
                        </div>
                        <div class="pt-3 mt-3 border-top">
                            <span class="btn btn-sm btn-outline-navy fw-bold w-100 rounded-pill py-2">
                                Ke Dashboard &raquo;
                            </span>
                        </div>
                    </a>
                </div>
            </div>

            <!-- FOOTER HELPER -->
            <div class="mt-4 pt-3 border-top d-flex flex-wrap justify-content-between align-items-center text-muted small">
                <span><i class="fa-solid fa-shield-halved text-success me-1"></i> Keamanan S-OS Terenkripsi Google OAuth 2.0</span>
                <span>Ingin menjalin kerjasama baru? <a href="../academy/partner.php#formKemitraan" class="text-primary fw-semibold">Ajukan Kemitraan Kampus</a></span>
            </div>

        </div>
    </div>

</body>
</html>
