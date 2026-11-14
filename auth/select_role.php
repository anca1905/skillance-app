<?php
session_start();

require_once __DIR__ . '/../config/config.php';

// Check if user is logged in
if (empty($_SESSION['user_id']) && empty($_SESSION['user_email'])) {
    header("Location: index.php");
    exit();
}

$userId    = $_SESSION['user_id'] ?? 0;
$userEmail = $_SESSION['user_email'] ?? '';
$userName  = $_SESSION['user_name'] ?? 'Pengguna Skillance';
$userPhoto = $_SESSION['user_photo'] ?? null;
$userRole  = $_SESSION['user_role'] ?? 'freelancer';

// Query fresh user permissions from database
$assignedRolesStr = $_SESSION['assigned_roles'] ?? 'freelancer,mahasiswa';
$partnerSlug      = $_SESSION['partner_slug'] ?? 'msc-usn';
$positionTitle    = $_SESSION['position_title'] ?? '';

if (!empty($userEmail) && isset($conn) && $conn instanceof mysqli) {
    $stmt = $conn->prepare("SELECT id, name, email, role, photo, assigned_roles, partner_slug, position_title FROM users WHERE email = ? OR id = ? LIMIT 1");
    if ($stmt) {
        $stmt->bind_param("si", $userEmail, $userId);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res && $res->num_rows > 0) {
            $u = $res->fetch_assoc();
            $userName         = $u['name'] ?? $userName;
            $userRole         = $u['role'] ?? $userRole;
            $userPhoto        = $u['photo'] ?? $userPhoto;
            $assignedRolesStr = $u['assigned_roles'] ?? $assignedRolesStr;
            $partnerSlug      = $u['partner_slug'] ?? $partnerSlug;
            $positionTitle    = $u['position_title'] ?? $positionTitle;

            $_SESSION['user_name']      = $userName;
            $_SESSION['user_role']      = $userRole;
            $_SESSION['user_photo']     = $userPhoto;
            $_SESSION['assigned_roles'] = $assignedRolesStr;
            $_SESSION['partner_slug']   = $partnerSlug;
            $_SESSION['position_title'] = $positionTitle;
        }
        $stmt->close();
    }
}

if (empty($userPhoto)) {
    $userPhoto = 'https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=0d2e5c&color=fff';
}

// Parse assigned roles into array
$rolesList = array_filter(array_map('trim', explode(',', strtolower($assignedRolesStr))));
if (empty($rolesList)) {
    $rolesList = ['freelancer', 'mahasiswa'];
}

$isAdmin = ($userRole === 'admin' || in_array('admin', $rolesList));

$canMahasiswa  = $isAdmin || in_array('mahasiswa', $rolesList);
$canDekanat    = $isAdmin || in_array('dekanat', $rolesList);
$canOrmawa     = $isAdmin || in_array('ormawa', $rolesList);
$canFreelancer = $isAdmin || in_array('freelancer', $rolesList);

// Handle Role Selection Action
if (isset($_GET['select'])) {
    $selected = strtolower(trim($_GET['select']));

    if ($selected === 'admin') {
        if (!$isAdmin) {
            header("Location: select_role.php?denied=admin");
            exit();
        }
        $_SESSION['active_portal'] = 'admin';
        header("Location: ../dashboard/index.php");
        exit();
    }

    if ($selected === 'mahasiswa') {
        if (!$canMahasiswa) {
            header("Location: select_role.php?denied=mahasiswa");
            exit();
        }
        $_SESSION['active_portal'] = 'mahasiswa';
        header("Location: https://academy.skillance.cloud/partner-portal.php?partner=" . urlencode($partnerSlug));
        exit();
    }

    if ($selected === 'dekanat') {
        if (!$canDekanat) {
            header("Location: select_role.php?denied=dekanat");
            exit();
        }
        $_SESSION['active_portal'] = 'dekanat';
        $_SESSION['partner_auth_' . $partnerSlug] = true;
        $_SESSION['partner_role_' . $partnerSlug] = 'dekanat';
        header("Location: https://academy.skillance.cloud/dashboard-partner.php?partner=" . urlencode($partnerSlug) . "&role=dekanat&auth=demo");
        exit();
    }

    if ($selected === 'ormawa') {
        if (!$canOrmawa) {
            header("Location: select_role.php?denied=ormawa");
            exit();
        }
        $_SESSION['active_portal'] = 'ormawa';
        $_SESSION['partner_auth_' . $partnerSlug] = true;
        $_SESSION['partner_role_' . $partnerSlug] = 'ormawa';
        header("Location: https://academy.skillance.cloud/dashboard-partner.php?partner=" . urlencode($partnerSlug) . "&role=ormawa&auth=demo");
        exit();
    }

    if ($selected === 'freelancer') {
        if (!$canFreelancer) {
            header("Location: select_role.php?denied=freelancer");
            exit();
        }
        $_SESSION['active_portal'] = 'freelancer';
        header("Location: ../dashboard/freelancer/index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilih Portal & Peran Akses | SIAKAD Skillance Ecosystem</title>
    
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
            max-width: 1080px;
            width: 100%;
            z-index: 2;
            position: relative;
        }

        /* Glassmorphism Card Wrapper */
        .glass-box {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 24px;
            padding: 35px 30px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        /* Role Selection Card (Active / Unlocked) */
        .role-card {
            background: #ffffff;
            border: 2px solid #e2e8f0;
            border-radius: 18px;
            padding: 22px 18px;
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
            box-shadow: 0 12px 28px rgba(13, 46, 92, 0.14);
            color: inherit;
        }

        .role-card.unlocked-highlight {
            border-color: #fca311;
            box-shadow: 0 8px 22px rgba(252, 163, 17, 0.16);
        }

        /* Locked / Restricted Role Card */
        .role-card.is-locked {
            background: #f8fafc;
            border: 2px dashed #cbd5e1;
            opacity: 0.72;
            cursor: pointer;
        }
        .role-card.is-locked:hover {
            transform: none;
            border-color: #94a3b8;
            box-shadow: none;
        }

        .role-icon-box {
            width: 50px;
            height: 50px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 14px;
        }

        .user-profile-badge {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 50rem;
            padding: 6px 14px 6px 8px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .admin-banner {
            background: linear-gradient(135deg, #071a35 0%, #0d2e5c 100%);
            border-radius: 16px;
            border: 1.5px solid rgba(252, 163, 17, 0.4);
            box-shadow: 0 8px 25px rgba(13, 46, 92, 0.25);
        }
    </style>
</head>
<body>

    <div class="portal-container">
        <div class="glass-box">

            <!-- HEADER / IDENTITY -->
            <div class="d-flex flex-wrap justify-content-between align-items-center pb-3 mb-3 border-bottom gap-3">
                <div class="d-flex align-items-center gap-3">
                    <img src="../assets/img/logo_skillance_official.png" alt="Logo Skillance" style="max-height: 42px; width: auto;">
                    <div>
                        <span class="badge bg-warning text-navy fw-bold px-2 py-0.5 small">SIAKAD Unified Gateway</span>
                        <h4 class="fw-bold mb-0 text-navy font-heading" style="color: #0d2e5c; font-size: 1.25rem;">Pilih Portal & Peran Akses</h4>
                    </div>
                </div>

                <!-- USER ACTIVE SESSION -->
                <div class="user-profile-badge">
                    <img src="<?= htmlspecialchars($userPhoto) ?>" alt="Avatar" width="34" height="34" class="rounded-circle border">
                    <div class="text-start" style="line-height: 1.2;">
                        <span class="d-block fw-bold text-dark small">
                            <?= htmlspecialchars($userName) ?>
                            <?php if ($isAdmin): ?>
                                <span class="badge bg-danger text-white ms-1" style="font-size: 0.65rem;">Admin</span>
                            <?php endif; ?>
                        </span>
                        <small class="text-muted" style="font-size: 0.70rem;">
                            <?= !empty($positionTitle) ? htmlspecialchars($positionTitle) : htmlspecialchars($userEmail) ?>
                        </small>
                    </div>
                    <a href="logout.php" class="btn btn-sm btn-outline-danger rounded-circle p-1 ms-2" style="width: 26px; height: 26px; display: flex; align-items: center; justify-content: center;" title="Keluar Akun">
                        <i class="fa-solid fa-power-off" style="font-size: 11px;"></i>
                    </a>
                </div>
            </div>

            <!-- SUPERADMIN VIP BANNER (KHUSUS ARSYAD / ADMIN) -->
            <?php if ($isAdmin): ?>
                <div class="admin-banner p-3 p-md-3.5 text-white mb-4">
                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle bg-warning text-navy d-flex align-items-center justify-content-center fw-bold fs-4 shadow-sm" style="width: 44px; height: 44px; flex-shrink: 0;">
                                <i class="fa-solid fa-crown"></i>
                            </div>
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <h6 class="fw-bold text-white mb-0" style="font-size: 1rem;">Otoritas Superadmin Skillance Aktif</h6>
                                    <span class="badge bg-gold text-navy fw-bold" style="font-size: 0.65rem;">Pusat Kontrol</span>
                                </div>
                                <small class="text-white-50" style="font-size: 0.78rem;">
                                    Anda memiliki hak akses penuh ke seluruh 4 mode portal, serta berwenang menentukan peran setiap pengguna.
                                </small>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <a href="../dashboard/hrd/index.php" class="btn btn-sm btn-warning text-navy fw-bold rounded-pill px-3 py-1.5 shadow-sm" style="font-size: 0.8rem;">
                                <i class="fa-solid fa-users-gear me-1"></i> Kelola Hak Akses Pengguna
                            </a>
                            <a href="../dashboard/index.php" class="btn btn-sm btn-outline-light rounded-pill px-3 py-1.5" style="font-size: 0.8rem;">
                                <i class="fa-solid fa-gauge-high me-1"></i> Dashboard Eksekutif PT
                            </a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- SUBTITLE PROMPT -->
            <div class="text-center mb-3">
                <h5 class="fw-bold text-navy mb-1" style="font-size: 1.15rem;">Masuk Sebagai Apa Hari Ini?</h5>
                <p class="text-muted small mx-auto mb-0" style="max-width: 650px; font-size: 0.82rem;">
                    Satu akun terintegrasi untuk seluruh ekosistem Skillance. Peran dan hak akses Anda ditentukan langsung oleh Administrator PT Skillance Digital Indonesia.
                </p>
            </div>

            <!-- 4 ROLE SELECTION CARDS (SIAKAD PATTERN) -->
            <div class="row g-3">

                <!-- PERAN 1: MAHASISWA / PESERTA KEMITRAAN -->
                <div class="col-md-6 col-lg-3">
                    <?php if ($canMahasiswa): ?>
                        <a href="select_role.php?select=mahasiswa" class="role-card unlocked-highlight">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 fw-bold" style="font-size: 0.68rem;">
                                        <i class="fa-solid fa-circle-check me-1"></i> Akses Terbuka
                                    </span>
                                    <i class="fa-solid fa-arrow-right text-muted small"></i>
                                </div>
                                <div class="role-icon-box bg-warning bg-opacity-15 text-warning">
                                    <i class="fa-solid fa-user-graduate"></i>
                                </div>
                                <h5 class="fw-bold text-navy mb-1" style="font-size: 1rem;">Mahasiswa Mitra</h5>
                                <small class="text-muted fw-semibold d-block mb-2">FTI USN Kolaka & UKM MSC</small>
                                <p class="text-muted small mb-0" style="font-size: 0.78rem; line-height: 1.5;">
                                    Akses silabus 32 JP, modul praktikum koding, ujian kompetensi, dan klaim sertifikat SKPI.
                                </p>
                            </div>
                            <div class="pt-3 mt-3 border-top">
                                <span class="btn btn-sm btn-navy fw-bold w-100 rounded-pill py-2">
                                    Masuk ke Kelas &raquo;
                                </span>
                            </div>
                        </a>
                    <?php else: ?>
                        <div class="role-card is-locked" onclick="alertLockedRole('Mahasiswa Mitra Kampus')">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border fw-bold" style="font-size: 0.68rem;">
                                        <i class="fa-solid fa-lock me-1"></i> Perlu Izin Admin
                                    </span>
                                    <i class="fa-solid fa-lock text-muted small"></i>
                                </div>
                                <div class="role-icon-box bg-secondary bg-opacity-10 text-secondary">
                                    <i class="fa-solid fa-user-graduate"></i>
                                </div>
                                <h5 class="fw-bold text-muted mb-1" style="font-size: 1rem;">Mahasiswa Mitra</h5>
                                <small class="text-muted d-block mb-2">Khusus Peserta Kemitraan</small>
                                <p class="text-muted small mb-0" style="font-size: 0.78rem; line-height: 1.5;">
                                    Silabus 32 JP dan sertifikasi SKPI hanya dapat diakses oleh mahasiswa yang telah diizinkan.
                                </p>
                            </div>
                            <div class="pt-3 mt-3 border-top">
                                <button class="btn btn-sm btn-light border text-muted w-100 rounded-pill py-2">
                                    <i class="fa-solid fa-lock me-1"></i> Akses Dibatasi
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- PERAN 2: DEKANAT & DOSEN PEMBINA -->
                <div class="col-md-6 col-lg-3">
                    <?php if ($canDekanat): ?>
                        <a href="select_role.php?select=dekanat" class="role-card unlocked-highlight">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-primary bg-opacity-10 text-primary border border-primary border-opacity-25 fw-bold" style="font-size: 0.68rem;">
                                        <i class="fa-solid fa-circle-check me-1"></i> Akses Terbuka
                                    </span>
                                    <i class="fa-solid fa-arrow-right text-muted small"></i>
                                </div>
                                <div class="role-icon-box bg-primary bg-opacity-15 text-primary">
                                    <i class="fa-solid fa-building-columns"></i>
                                </div>
                                <h5 class="fw-bold text-navy mb-1" style="font-size: 1rem;">Dekanat & Dosen</h5>
                                <small class="text-muted fw-semibold d-block mb-2">Pimpinan Fakultas & Dosen</small>
                                <p class="text-muted small mb-0" style="font-size: 0.78rem; line-height: 1.5;">
                                    Panel monitoring keaktifan mahasiswa, progres modul, skor, serta unduh Berita Acara SKPI.
                                </p>
                            </div>
                            <div class="pt-3 mt-3 border-top">
                                <span class="btn btn-sm btn-outline-navy fw-bold w-100 rounded-pill py-2">
                                    Buka Dashboard &raquo;
                                </span>
                            </div>
                        </a>
                    <?php else: ?>
                        <div class="role-card is-locked" onclick="alertLockedRole('Dekanat & Pimpinan Fakultas')">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border fw-bold" style="font-size: 0.68rem;">
                                        <i class="fa-solid fa-lock me-1"></i> Perlu Izin Admin
                                    </span>
                                    <i class="fa-solid fa-lock text-muted small"></i>
                                </div>
                                <div class="role-icon-box bg-secondary bg-opacity-10 text-secondary">
                                    <i class="fa-solid fa-building-columns"></i>
                                </div>
                                <h5 class="fw-bold text-muted mb-1" style="font-size: 1rem;">Dekanat & Dosen</h5>
                                <small class="text-muted d-block mb-2">Khusus Pimpinan Kampus</small>
                                <p class="text-muted small mb-0" style="font-size: 0.78rem; line-height: 1.5;">
                                    Monitoring nilai dan penandatanganan SKPI hanya dibuka untuk Dekan, Wakil Dekan, dan Dosen.
                                </p>
                            </div>
                            <div class="pt-3 mt-3 border-top">
                                <button class="btn btn-sm btn-light border text-muted w-100 rounded-pill py-2">
                                    <i class="fa-solid fa-lock me-1"></i> Akses Dibatasi
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- PERAN 3: PENGURUS ORMAWA / KETUA UKM MSC -->
                <div class="col-md-6 col-lg-3">
                    <?php if ($canOrmawa): ?>
                        <a href="select_role.php?select=ormawa" class="role-card unlocked-highlight">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 fw-bold" style="font-size: 0.68rem;">
                                        <i class="fa-solid fa-circle-check me-1"></i> Akses Terbuka
                                    </span>
                                    <i class="fa-solid fa-arrow-right text-muted small"></i>
                                </div>
                                <div class="role-icon-box bg-success bg-opacity-15 text-success">
                                    <i class="fa-solid fa-handshake-angle"></i>
                                </div>
                                <h5 class="fw-bold text-navy mb-1" style="font-size: 1rem;">Pengurus UKM MSC</h5>
                                <small class="text-muted fw-semibold d-block mb-2">Ketua & Panitia Ormawa</small>
                                <p class="text-muted small mb-0" style="font-size: 0.78rem; line-height: 1.5;">
                                    Kelola pendaftaran anggota, absensi bootcamp, verifikasi berkas, dan bagi hasil kas ormawa.
                                </p>
                            </div>
                            <div class="pt-3 mt-3 border-top">
                                <span class="btn btn-sm btn-outline-navy fw-bold w-100 rounded-pill py-2">
                                    Kelola Anggota &raquo;
                                </span>
                            </div>
                        </a>
                    <?php else: ?>
                        <div class="role-card is-locked" onclick="alertLockedRole('Pengurus UKM / Ormawa')">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border fw-bold" style="font-size: 0.68rem;">
                                        <i class="fa-solid fa-lock me-1"></i> Perlu Izin Admin
                                    </span>
                                    <i class="fa-solid fa-lock text-muted small"></i>
                                </div>
                                <div class="role-icon-box bg-secondary bg-opacity-10 text-secondary">
                                    <i class="fa-solid fa-handshake-angle"></i>
                                </div>
                                <h5 class="fw-bold text-muted mb-1" style="font-size: 1rem;">Pengurus UKM MSC</h5>
                                <small class="text-muted d-block mb-2">Khusus Panitia & Ketua</small>
                                <p class="text-muted small mb-0" style="font-size: 0.78rem; line-height: 1.5;">
                                    Fitur kepengurusan ormawa hanya dibuka untuk Ketua dan panitia pelaksana bootcamp terdaftar.
                                </p>
                            </div>
                            <div class="pt-3 mt-3 border-top">
                                <button class="btn btn-sm btn-light border text-muted w-100 rounded-pill py-2">
                                    <i class="fa-solid fa-lock me-1"></i> Akses Dibatasi
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- PERAN 4: FREELANCE & IT WORK -->
                <div class="col-md-6 col-lg-3">
                    <?php if ($canFreelancer): ?>
                        <a href="select_role.php?select=freelancer" class="role-card unlocked-highlight">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 fw-bold" style="font-size: 0.68rem;">
                                        <i class="fa-solid fa-circle-check me-1"></i> Akses Terbuka
                                    </span>
                                    <i class="fa-solid fa-arrow-right text-muted small"></i>
                                </div>
                                <div class="role-icon-box bg-info bg-opacity-15 text-info">
                                    <i class="fa-solid fa-laptop-code"></i>
                                </div>
                                <h5 class="fw-bold text-navy mb-1" style="font-size: 1rem;">Freelance & IT Work</h5>
                                <small class="text-muted fw-semibold d-block mb-2">Skillance Tech Network</small>
                                <p class="text-muted small mb-0" style="font-size: 0.78rem; line-height: 1.5;">
                                    Ambil proyek pembuatan software, submit tugas freelance, pantau saldo dompet dan penarikan fee.
                                </p>
                            </div>
                            <div class="pt-3 mt-3 border-top">
                                <span class="btn btn-sm btn-outline-navy fw-bold w-100 rounded-pill py-2">
                                    Ke Dashboard &raquo;
                                </span>
                            </div>
                        </a>
                    <?php else: ?>
                        <div class="role-card is-locked" onclick="alertLockedRole('Freelance Network')">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-secondary bg-opacity-10 text-secondary border fw-bold" style="font-size: 0.68rem;">
                                        <i class="fa-solid fa-lock me-1"></i> Perlu Izin Admin
                                    </span>
                                    <i class="fa-solid fa-lock text-muted small"></i>
                                </div>
                                <div class="role-icon-box bg-secondary bg-opacity-10 text-secondary">
                                    <i class="fa-solid fa-laptop-code"></i>
                                </div>
                                <h5 class="fw-bold text-muted mb-1" style="font-size: 1rem;">Freelance & IT Work</h5>
                                <small class="text-muted d-block mb-2">Talenta Profesional</small>
                                <p class="text-muted small mb-0" style="font-size: 0.78rem; line-height: 1.5;">
                                    Akses bursa proyek dan pembayaran honor freelance Skillance.
                                </p>
                            </div>
                            <div class="pt-3 mt-3 border-top">
                                <button class="btn btn-sm btn-light border text-muted w-100 rounded-pill py-2">
                                    <i class="fa-solid fa-lock me-1"></i> Akses Dibatasi
                                </button>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

            </div>

            <!-- FOOTER HELPER -->
            <div class="mt-4 pt-3 border-top d-flex flex-wrap justify-content-between align-items-center text-muted small">
                <span><i class="fa-solid fa-shield-halved text-success me-1"></i> Keamanan S-OS Terenkripsi Google OAuth 2.0</span>
                <span>Ingin menjalin kerjasama baru? <a href="https://academy.skillance.cloud/partner.php#formKemitraan" class="text-primary fw-semibold">Ajukan Kemitraan Kampus</a></span>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function alertLockedRole(roleName) {
            Swal.fire({
                icon: 'info',
                title: 'Hak Akses Belum Diaktifkan',
                html: `Peran <strong>${roleName}</strong> belum dibuka untuk akun Anda.<br><br>` +
                      `Hak akses dan multi-role diatur langsung oleh <strong>Administrator PT Skillance Digital Indonesia</strong>.<br>` +
                      `Silakan hubungi admin untuk aktivasi peran ini.`,
                confirmButtonColor: '#0d2e5c',
                confirmButtonText: 'Mengerti'
            });
        }

        <?php if (isset($_GET['denied'])): ?>
            Swal.fire({
                icon: 'warning',
                title: 'Akses Ditolak',
                text: 'Akun Anda tidak memiliki izin untuk mengakses peran <?= htmlspecialchars($_GET['denied']) ?>.',
                confirmButtonColor: '#0d2e5c',
                confirmButtonText: 'Tutup'
            });
        <?php endif; ?>
    </script>
</body>
</html>