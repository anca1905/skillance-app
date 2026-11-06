<?php
/**
 * Master Unified Navbar & Course Subnav for Skillance Academy
 * 
 * Usage:
 *   $activeNav = 'home'; // 'home', 'roadmap', 'projects', 'exam', 'partner', 'verify', 'my-learning', 'learn'
 *   $currentCourse = 'html'; // optional: 'html', 'css', 'javascript', etc.
 *   $showTopicsToggle = false; // optional for learn.php mobile
 *   include __DIR__ . '/includes/navbar.php';
 */

if (session_status() === PHP_SESSION_NONE) {
    @session_start();
}

$isLoggedIn = !empty($_SESSION['user_id']) || (!empty($isLoggedIn) && $isLoggedIn);
$userName = !empty($userName) ? $userName : ($_SESSION['user_name'] ?? 'Siswa Skillance');
$avatarUrl = !empty($avatarUrl) ? $avatarUrl : ($_SESSION['user_photo'] ?? ('https://ui-avatars.com/api/?name=' . urlencode($userName) . '&background=0d2e5c&color=fff'));

$activeNav = $activeNav ?? 'home';
$currentCourse = $currentCourse ?? '';
$showTopicsToggle = $showTopicsToggle ?? false;
$showSubnav = $showSubnav ?? in_array($activeNav, ['home', 'learn', 'roadmap']);
?>
<!-- INLINE CRITICAL NAVBAR STYLES -->
<style>
    /* Top Hub Bar */
    .top-hub-bar {
        background-color: #06152b;
        color: #94a3b8;
        font-size: 0.76rem;
        padding: 5px 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        position: relative;
        z-index: 1025;
    }
    .top-hub-bar a:hover {
        color: #ffffff !important;
    }

    /* Academy Main Navbar */
    .academy-navbar {
        background-color: #ffffff;
        border-bottom: 1px solid #e2e8f0;
        position: sticky;
        top: 0;
        z-index: 1020;
        padding-top: 8px !important;
        padding-bottom: 8px !important;
        min-height: 56px;
    }

    .nav-menu-link {
        color: #475569;
        font-weight: 600;
        font-size: 0.84rem;
        padding: 6px 11px;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.15s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap !important;
    }
    .nav-menu-link:hover {
        color: #0d2e5c;
        background-color: #f1f5f9;
    }
    .nav-menu-link.active {
        color: #0d2e5c;
        font-weight: 700;
        background-color: #f1f5f9;
    }
    .nav-menu-link.dropdown-toggle::after {
        margin-left: 4px;
        vertical-align: 0.15em;
    }

    /* Desktop Dropdown on Hover */
    @media (min-width: 992px) {
        .navbar .dropdown:hover .dropdown-menu {
            display: block;
            margin-top: 0;
            animation: fadeInNav 0.15s ease;
        }
    }
    @keyframes fadeInNav {
        from { opacity: 0; transform: translateY(4px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Course Subnav */
    .course-subnav {
        background-color: #0d2e5c;
        overflow-x: auto;
        white-space: nowrap;
        scrollbar-width: none;
        position: relative;
        z-index: 1010;
        border-top: 1px solid rgba(255, 255, 255, 0.08);
    }
    .course-subnav::-webkit-scrollbar {
        display: none;
    }
    .course-nav-item {
        display: inline-block;
        padding: 7px 16px;
        color: #cbd5e1;
        text-decoration: none;
        font-size: 0.82rem;
        font-weight: 700;
        letter-spacing: 0.4px;
        transition: all 0.15s;
        white-space: nowrap;
    }
    .course-nav-item:hover {
        color: #ffffff;
        background-color: rgba(255, 255, 255, 0.12);
    }
    .course-nav-item.active {
        color: #0d2e5c;
        background-color: #fca311;
    }
</style>

<!-- TOP HUB BAR -->
<div class="top-hub-bar">
    <div class="container-fluid px-3 px-xl-4 d-flex justify-content-between align-items-center" style="max-width: 1440px;">
        <div class="d-flex align-items-center gap-3">
            <a href="https://skillance.my.id" class="text-decoration-none text-white-50">
                <i class="fa-solid fa-arrow-left me-1"></i> skillance.my.id
            </a>
            <span class="text-white-50 opacity-25 d-none d-md-inline">|</span>
            <a href="https://skillance.my.id/bursa-freelance.php" class="text-decoration-none text-warning d-none d-md-inline fw-semibold">
                <i class="fa-solid fa-briefcase me-1"></i> Bursa Freelance
            </a>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span class="small d-none d-lg-inline" style="color: #94a3b8;">Skillance Academy Indonesia</span>
            <?php if ($isLoggedIn): ?>
                <span class="badge bg-success-subtle text-success py-1 px-2"><i class="fa-solid fa-circle-check me-1"></i> <?= htmlspecialchars($userName ?? 'Siswa Skillance') ?></span>
                <a href="https://skillance.my.id/auth/logout.php" class="text-white-50 text-decoration-none small"><i class="fa-solid fa-right-from-bracket me-1"></i> Keluar</a>
            <?php else: ?>
                <a href="https://skillance.my.id/auth/index.php?ref=academy" class="text-warning text-decoration-none fw-semibold small">
                    <i class="fa-solid fa-user me-1"></i> Masuk Akun
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- MAIN NAVBAR (Modern, Slim & Perfectly Aligned) -->
<nav class="navbar navbar-expand-xl academy-navbar">
    <div class="container-fluid px-3 px-xl-4" style="max-width: 1440px;">
        <!-- Brand Logo -->
        <a class="navbar-brand d-flex align-items-center gap-2 py-0 me-3 me-xl-4" href="index.php">
            <div class="bg-navy text-gold rounded-3 d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background: #0d2e5c;">
                <i class="fa-solid fa-graduation-cap fs-5 text-warning"></i>
            </div>
            <div>
                <span class="fw-bold text-navy font-heading" style="font-size: 1.15rem; letter-spacing: -0.5px; color: #0d2e5c; line-height: 1.1; display: block;">
                    SKILLANCE <span class="text-gold" style="color: #fca311;">ACADEMY</span>
                </span>
                <small class="d-none d-sm-block text-muted" style="font-size: 0.65rem; line-height: 1;">Pusat Belajar Koding & Portofolio</small>
            </div>
        </a>

        <?php if ($showTopicsToggle): ?>
            <!-- Mobile Offcanvas Toggle for Topics on learn.php -->
            <button class="btn btn-sm btn-outline-navy d-lg-none me-auto ms-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarOffcanvas" style="border-color: #cbd5e1; font-size: 0.8rem;">
                <i class="fa-solid fa-book-open me-1 text-gold"></i> Topik
            </button>
        <?php endif; ?>

        <!-- Mobile Buttons -->
        <div class="d-flex align-items-center d-xl-none gap-2">
            <button type="button" class="btn btn-sm btn-light border rounded-circle d-flex align-items-center justify-content-center" onclick="openSpotlightSearch()" style="width: 36px; height: 36px;" title="Cari Materi (Ctrl+K)">
                <i class="fa-solid fa-magnifying-glass text-navy"></i>
            </button>
            <button class="navbar-toggler border-0 shadow-none px-2" type="button" data-bs-toggle="collapse" data-bs-target="#academyNavMenu" aria-controls="academyNavMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa-solid fa-bars fs-4 text-navy"></i>
            </button>
        </div>

        <!-- Navbar Links & Actions -->
        <div class="collapse navbar-collapse" id="academyNavMenu">
            <!-- Nav Links: Placed nicely next to brand with me-auto -->
            <ul class="navbar-nav me-auto my-2 my-xl-0 gap-1 align-items-xl-center">
                <li class="nav-item">
                    <a href="index.php" class="nav-menu-link <?= $activeNav === 'home' ? 'active' : '' ?>">
                        <i class="fa-solid fa-house small text-muted"></i> Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a href="roadmap.php" class="nav-menu-link <?= $activeNav === 'roadmap' ? 'active' : '' ?>">
                        <i class="fa-solid fa-route small text-muted"></i> Roadmap
                    </a>
                </li>
                <li class="nav-item">
                    <a href="projects.php" class="nav-menu-link <?= $activeNav === 'projects' ? 'active' : '' ?>">
                        <i class="fa-solid fa-laptop-code small text-muted"></i> E-Book & Proyek
                    </a>
                </li>
                <li class="nav-item">
                    <a href="exam.php" class="nav-menu-link <?= $activeNav === 'exam' ? 'active' : '' ?>">
                        <i class="fa-solid fa-award small text-muted"></i> Ujian SKPI
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-menu-link dropdown-toggle <?= in_array($activeNav, ['verify', 'partner']) ? 'active' : '' ?>" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-ellipsis-vertical small text-muted"></i> Lainnya
                    </a>
                    <ul class="dropdown-menu dropdown-menu-start shadow border-0 rounded-3 mt-1 py-2" style="font-size: 0.85rem; min-width: 220px;">
                        <li>
                            <a class="dropdown-item py-2 d-flex align-items-center gap-2 <?= $activeNav === 'verify' ? 'active fw-bold text-navy' : '' ?>" href="verify.php">
                                <i class="fa-solid fa-shield-halved text-success" style="width: 20px;"></i>
                                <span>Cek Keaslian Sertifikat</span>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item py-2 d-flex align-items-center gap-2 <?= $activeNav === 'partner' ? 'active fw-bold text-navy' : '' ?>" href="partner.php">
                                <i class="fa-solid fa-handshake text-primary" style="width: 20px;"></i>
                                <span>Kemitraan Kampus (BEM/HIMA)</span>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li>
                            <a class="dropdown-item py-2 d-flex align-items-center gap-2" href="tryit.php">
                                <i class="fa-solid fa-terminal text-warning" style="width: 20px;"></i>
                                <span>Code Lab Playground</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Actions on the right with ms-xl-auto -->
            <div class="d-flex align-items-center gap-2 pt-3 pt-xl-0 border-top border-xl-0 ms-xl-auto">
                <button type="button" class="btn btn-sm btn-light border rounded-pill px-2 px-xxl-3 py-1 text-muted d-none d-xl-inline-flex align-items-center gap-2" onclick="openSpotlightSearch()" style="background: #f8fafc; font-size: 0.82rem; height: 34px; border-color: #e2e8f0 !important;" title="Pencarian Materi Cepat (Ctrl+K)">
                    <i class="fa-solid fa-magnifying-glass text-secondary"></i>
                    <span class="d-none d-xxl-inline">Cari materi...</span>
                    <span class="d-inline d-xxl-none">Cari</span>
                    <kbd class="bg-white border text-secondary px-1 py-0 rounded ms-1" style="font-size: 0.65rem; font-family: inherit;">Ctrl K</kbd>
                </button>
                <?php if ($isLoggedIn): ?>
                    <a href="my-learning.php" class="btn btn-sm btn-outline-navy rounded-pill px-3 py-1 fw-semibold d-inline-flex align-items-center gap-2 <?= $activeNav === 'my-learning' ? 'bg-navy text-white' : '' ?>" style="border-color: #0d2e5c; color: #0d2e5c; font-size: 0.82rem; height: 34px;">
                        <img src="<?= htmlspecialchars($avatarUrl ?? 'https://ui-avatars.com/api/?name=User&background=0d2e5c&color=fff') ?>" class="rounded-circle" width="20" height="20" alt="Avatar">
                        <span>Dasbor Siswa</span>
                    </a>
                <?php else: ?>
                    <a href="https://skillance.my.id/auth/index.php?ref=academy" class="btn btn-sm btn-outline-navy rounded-pill px-3 py-1 fw-semibold d-inline-flex align-items-center gap-1" style="border-color: #cbd5e1; color: #0d2e5c; font-size: 0.82rem; height: 34px;">
                        <i class="fa-solid fa-user small"></i> Masuk
                    </a>
                <?php endif; ?>
                <a href="https://skillance.my.id/dashboard/freelancer/" class="btn btn-sm btn-navy rounded-pill px-3 py-1 fw-bold text-white shadow-sm d-inline-flex align-items-center gap-1" style="background: #0d2e5c; font-size: 0.82rem; height: 34px;">
                    <i class="fa-solid fa-briefcase text-warning me-1"></i> <span>Bursa Freelance</span>
                </a>
            </div>
        </div>
    </div>
</nav>

<?php if ($showSubnav): ?>
<!-- COURSE SUBNAV BAR (Slim, Modern & Fast Horizontal Scroll) -->
<div class="course-subnav">
    <div class="container-fluid px-3 px-xl-4 d-flex" style="max-width: 1440px;">
        <a href="learn.php?c=html" class="course-nav-item <?= ($currentCourse === 'html') ? 'active' : '' ?>"><i class="fa-brands fa-html5 me-1 text-warning"></i> HTML</a>
        <a href="learn.php?c=css" class="course-nav-item <?= ($currentCourse === 'css') ? 'active' : '' ?>"><i class="fa-brands fa-css3-alt me-1 text-info"></i> CSS</a>
        <a href="learn.php?c=javascript" class="course-nav-item <?= ($currentCourse === 'javascript') ? 'active' : '' ?>"><i class="fa-brands fa-js me-1 text-warning"></i> JAVASCRIPT</a>
        <a href="learn.php?c=jquery" class="course-nav-item <?= ($currentCourse === 'jquery') ? 'active' : '' ?>"><i class="fa-solid fa-bolt me-1 text-primary"></i> JQUERY</a>
        <a href="learn.php?c=php" class="course-nav-item <?= ($currentCourse === 'php') ? 'active' : '' ?>"><i class="fa-brands fa-php me-1 text-primary"></i> PHP</a>
        <a href="learn.php?c=sql" class="course-nav-item <?= ($currentCourse === 'sql') ? 'active' : '' ?>"><i class="fa-solid fa-database me-1 text-info"></i> SQL</a>
        <a href="learn.php?c=python" class="course-nav-item <?= ($currentCourse === 'python') ? 'active' : '' ?>"><i class="fa-brands fa-python me-1 text-warning"></i> PYTHON</a>
        <a href="learn.php?c=java" class="course-nav-item <?= ($currentCourse === 'java') ? 'active' : '' ?>"><i class="fa-brands fa-java me-1 text-danger"></i> JAVA</a>
        <a href="learn.php?c=cpp" class="course-nav-item <?= ($currentCourse === 'cpp') ? 'active' : '' ?>"><i class="fa-solid fa-code me-1 text-info"></i> C++</a>
        <a href="learn.php?c=vue" class="course-nav-item <?= ($currentCourse === 'vue') ? 'active' : '' ?>"><i class="fa-brands fa-vuejs me-1 text-success"></i> VUE</a>
        <a href="learn.php?c=flutter" class="course-nav-item <?= ($currentCourse === 'flutter') ? 'active' : '' ?>"><i class="fa-solid fa-mobile-screen-button me-1 text-info"></i> FLUTTER</a>
        <a href="learn.php?c=uiux" class="course-nav-item <?= ($currentCourse === 'uiux') ? 'active' : '' ?>"><i class="fa-solid fa-bezier-curve me-1 text-warning"></i> UI/UX</a>
    </div>
</div>
<?php endif; ?>
