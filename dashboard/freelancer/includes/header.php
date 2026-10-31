<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/index.php");
    exit();
}

require_once __DIR__ . '/../../../config/config.php';

$currentUserId = intval($_SESSION['user_id']);
$userQuery = $conn->query("SELECT name, email, photo, role, user_type, institution, major, skills, bank_name, bank_account_number, bank_account_name FROM users WHERE id = $currentUserId");
$currentUser = $userQuery->fetch_assoc();

$userName = $currentUser['name'] ?? $_SESSION['user_name'] ?? 'Freelancer';
$userRole = $currentUser['role'] ?? 'freelancer';
$userType = $currentUser['user_type'] ?? 'umum';
$userEmail = $currentUser['email'] ?? '';
$userPhoto = $currentUser['photo'] ?? '';

if (empty($userPhoto)) {
    $avatarUrl = "https://ui-avatars.com/api/?name=" . urlencode($userName) . "&background=0d2e5c&color=fca311&bold=true";
} elseif (strpos($userPhoto, 'http') === 0) {
    $avatarUrl = $userPhoto;
} else {
    $avatarUrl = "../../assets/img/profile/" . $userPhoto;
}

$pageTitle = $pageTitle ?? "Dashboard Freelancer";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> | Skillance Freelance</title>

    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">

    <style>
        body {
            background-color: #f4f6fa;
            font-family: 'Inter', sans-serif;
            color: #334155;
            overflow-x: hidden;
        }
        /* Sidebar Styling */
        .freelance-sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #ffffff;
            border-right: 1px solid rgba(0, 0, 0, 0.07);
            padding: 24px 0;
            z-index: 1020;
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .freelance-sidebar .brand-area {
            padding: 0 24px 20px 24px;
            border-bottom: 1px solid #f1f5f9;
        }
        .main-wrapper {
            margin-left: 260px;
            padding: 24px 30px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }
        .nav-item-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #64748b;
            font-weight: 500;
            font-size: 0.92rem;
            text-decoration: none;
            transition: all 0.2s;
            border-left: 4px solid transparent;
        }
        .nav-item-link:hover {
            color: var(--navy);
            background-color: #f8fafc;
        }
        .nav-item-link.active {
            color: var(--navy);
            background-color: var(--navy-subtle);
            font-weight: 700;
            border-left-color: var(--gold);
        }
        .nav-item-link i {
            width: 20px;
            font-size: 1.1rem;
            text-align: center;
        }
        .badge-type {
            font-size: 0.7rem;
            padding: 3px 8px;
            border-radius: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .badge-mhs {
            background: #e0f2fe;
            color: #0369a1;
        }
        .badge-umum {
            background: #fef3c7;
            color: #b45309;
        }
        .card-custom {
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 12px rgba(13, 46, 92, 0.05);
            background: #ffffff;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .card-custom:hover {
            box-shadow: 0 6px 20px rgba(13, 46, 92, 0.08);
        }
        .stat-card-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }
        .bg-navy-light {
            background-color: rgba(13, 46, 92, 0.1);
            color: var(--navy);
        }
        .bg-gold-light {
            background-color: rgba(252, 163, 17, 0.15);
            color: #d97706;
        }
        .bg-green-light {
            background-color: rgba(16, 185, 129, 0.12);
            color: #059669;
        }
        .bg-purple-light {
            background-color: rgba(139, 92, 246, 0.12);
            color: #7c3aed;
        }
        @media (max-width: 991px) {
            .freelance-sidebar {
                margin-left: -260px;
            }
            .freelance-sidebar.show {
                margin-left: 0;
            }
            .main-wrapper {
                margin-left: 0;
                padding: 18px 15px;
            }
            .sidebar-overlay {
                display: none;
                position: fixed;
                top: 0; left: 0; right: 0; bottom: 0;
                background: rgba(0,0,0,0.4);
                z-index: 1015;
            }
            .sidebar-overlay.show {
                display: block;
            }
        }
    </style>
</head>
<body>

    <!-- Mobile Overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar Navigation -->
    <aside class="freelance-sidebar shadow-sm" id="freelanceSidebar">
        <div class="brand-area d-flex align-items-center justify-content-between">
            <a href="index.php" class="text-decoration-none d-flex align-items-center gap-2">
                <i class="fa-solid fa-code text-gold fs-4"></i>
                <div>
                    <h5 class="fw-bold text-navy mb-0 ls-1 font-heading">SKILLANCE</h5>
                    <small class="text-muted fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">FREELANCE HUB</small>
                </div>
            </a>
            <button class="btn btn-sm btn-light d-lg-none" id="btnCloseSidebar"><i class="fa-solid fa-xmark"></i></button>
        </div>

        <!-- Profil Singkat di Sidebar -->
        <div class="px-4 py-3 border-bottom d-flex align-items-center gap-3">
            <img src="<?= htmlspecialchars($avatarUrl) ?>" alt="Avatar" class="rounded-circle shadow-sm" style="width: 44px; height: 44px; object-fit: cover;">
            <div class="overflow-hidden">
                <h6 class="mb-0 fw-bold text-truncate text-navy" style="font-size: 0.9rem;"><?= htmlspecialchars($userName) ?></h6>
                <div class="mt-1">
                    <?php if ($userType === 'mahasiswa'): ?>
                        <span class="badge-type badge-mhs"><i class="fa-solid fa-graduation-cap me-1"></i> Mahasiswa</span>
                    <?php else: ?>
                        <span class="badge-type badge-umum"><i class="fa-solid fa-user me-1"></i> Umum</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <nav class="flex-grow-1 py-3">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="index.php" class="nav-item-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">
                        <i class="fa-solid fa-chart-pie"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="my_tasks.php" class="nav-item-link <?= basename($_SERVER['PHP_SELF']) == 'my_tasks.php' ? 'active' : '' ?>">
                        <i class="fa-solid fa-list-check"></i>
                        <span>Pekerjaan Saya</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="jobs.php" class="nav-item-link <?= basename($_SERVER['PHP_SELF']) == 'jobs.php' ? 'active' : '' ?>">
                        <i class="fa-solid fa-briefcase"></i>
                        <span>Bursa Lowongan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="payments.php" class="nav-item-link <?= basename($_SERVER['PHP_SELF']) == 'payments.php' ? 'active' : '' ?>">
                        <i class="fa-solid fa-wallet"></i>
                        <span>Riwayat Pembayaran</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="profile.php" class="nav-item-link <?= basename($_SERVER['PHP_SELF']) == 'profile.php' ? 'active' : '' ?>">
                        <i class="fa-solid fa-id-card"></i>
                        <span>Profil & Rekening</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div class="px-3 border-top pt-3">
            <?php if ($userRole === 'admin'): ?>
                <a href="../index.php" class="btn btn-sm btn-outline-primary w-100 mb-2" style="font-size: 0.8rem;">
                    <i class="fa-solid fa-crown me-1"></i> Mode Admin Office
                </a>
            <?php endif; ?>
            <a href="../../api/logout.php" class="btn btn-sm btn-light text-danger w-100 fw-bold" style="font-size: 0.85rem;" onclick="confirmLogout(event)">
                <i class="fa-solid fa-right-from-bracket me-2"></i> Keluar
            </a>
        </div>
    </aside>

    <!-- Main Content Wrapper -->
    <div class="main-wrapper">
        <!-- Top Navbar -->
        <header class="d-flex align-items-center justify-content-between mb-4 pb-3 border-bottom">
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-light d-lg-none" id="btnToggleSidebar">
                    <i class="fa-solid fa-bars"></i>
                </button>
                <div>
                    <h4 class="fw-bold text-navy mb-0"><?= htmlspecialchars($pageTitle) ?></h4>
                    <small class="text-muted">Halo, <strong><?= htmlspecialchars($userName) ?></strong> 👋 Selamat datang di Skillance Freelance.</small>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <a href="jobs.php" class="btn btn-gold btn-sm d-none d-sm-inline-flex align-items-center gap-2">
                    <i class="fa-solid fa-magnifying-glass"></i> Cari Pekerjaan
                </a>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                        <img src="<?= htmlspecialchars($avatarUrl) ?>" alt="User" class="rounded-circle border" style="width: 38px; height: 38px; object-fit: cover;">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 py-2">
                        <li><h6 class="dropdown-header text-navy fw-bold"><?= htmlspecialchars($userName) ?></h6></li>
                        <li><small class="dropdown-item-text text-muted"><?= htmlspecialchars($userEmail) ?></small></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="profile.php"><i class="fa-solid fa-user-gear me-2"></i> Pengaturan Profil</a></li>
                        <li><a class="dropdown-item" href="payments.php"><i class="fa-solid fa-credit-card me-2"></i> Rekening Pencairan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="../../api/logout.php" onclick="confirmLogout(event)"><i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Keluar</a></li>
                    </ul>
                </div>
            </div>
        </header>
