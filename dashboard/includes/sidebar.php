<?php
/**
 * Shared Master Sidebar for Skillance Office Dashboard
 * 
 * Usage:
 *   $activeMenu = 'dashboard'; // 'dashboard', 'freelance', 'project', 'finance', 'team', 'blog', 'users', 'profile'
 *   include __DIR__ . '/includes/sidebar.php'; // or /../includes/sidebar.php
 */

if (!isset($dashRoot)) {
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['PHP_SELF']));
    if (preg_match('#/dashboard$#', rtrim($scriptDir, '/'))) {
        $dashRoot = '';
        $apiRoot = '../api/';
    } else {
        $dashRoot = '../';
        $apiRoot = '../../api/';
    }
} else {
    $apiRoot = ($dashRoot === '') ? '../api/' : '../../api/';
}

$activeMenu = $activeMenu ?? '';
?>
<!-- Mobile Overlay -->
<div class="sidebar-overlay" id="sidebarOverlay"></div>

<!-- Sidebar Admin Navigation -->
<nav class="sidebar shadow-sm" id="sidebar">
    <div class="px-3 px-md-4 mb-4 d-flex align-items-center justify-content-between">
        <a href="<?= $dashRoot ?>index.php" class="text-decoration-none d-flex align-items-center gap-2">
            <i class="fa-solid fa-code text-gold fs-4"></i>
            <div>
                <h5 class="fw-bold text-navy mb-0 ls-2">SKILLANCE</h5>
                <small class="text-muted fw-bold" style="font-size: 0.65rem; letter-spacing: 1px;">OFFICE SYSTEM</small>
            </div>
        </a>
        <button type="button" class="btn btn-sm btn-light d-md-none rounded-circle sidebar-close-btn" id="btnCloseSidebar" title="Tutup Menu">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="<?= $dashRoot ?>index.php" class="nav-link <?= $activeMenu === 'dashboard' ? 'active' : '' ?>">
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= $dashRoot ?>freelance/index.php" class="nav-link <?= $activeMenu === 'freelance' ? 'active fw-bold text-navy' : 'text-success fw-bold' ?>">
                <i class="fa-solid fa-handshake <?= $activeMenu === 'freelance' ? 'text-gold' : 'text-success' ?>"></i> Bursa Freelance
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= $dashRoot ?>project/index.php" class="nav-link <?= $activeMenu === 'project' ? 'active' : '' ?>">
                <i class="fa-solid fa-briefcase"></i> Project
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= $dashRoot ?>finance/index.php" class="nav-link <?= $activeMenu === 'finance' ? 'active' : '' ?>">
                <i class="fa-solid fa-wallet"></i> Keuangan
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= $dashRoot ?>team/index.php" class="nav-link <?= $activeMenu === 'team' ? 'active' : '' ?>">
                <i class="fa-solid fa-people-group"></i> Manajemen Tim
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= $dashRoot ?>blog/index.php" class="nav-link <?= $activeMenu === 'blog' ? 'active' : '' ?>">
                <i class="fa-solid fa-newspaper"></i> Kelola Artikel
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= $dashRoot ?>hrd/index.php" class="nav-link <?= ($activeMenu === 'users' || $activeMenu === 'hrd') ? 'active' : 'text-primary' ?>">
                <i class="fa-solid fa-users-gear text-primary"></i> Manajemen Pengguna
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= $dashRoot ?>profile.php" class="nav-link text-warning <?= $activeMenu === 'profile' ? 'active' : '' ?>">
                <i class="fa-solid fa-user-gear"></i> Profil Saya
            </a>
        </li>

        <li class="nav-item mt-3 px-3">
            <a href="<?= $dashRoot ?>freelancer/index.php" class="btn btn-sm btn-outline-primary w-100 fw-bold" style="font-size: 0.78rem;">
                <i class="fa-solid fa-eye me-1"></i> Mode Freelancer
            </a>
        </li>
        <li class="nav-item mt-2">
            <a href="<?= $apiRoot ?>logout.php" class="nav-link text-danger" id="btnLogout" onclick="confirmLogout(event)">
                <i class="fa-solid fa-right-from-bracket"></i> Logout
            </a>
        </li>
    </ul>
</nav>

<script>
// Universal Sidebar Functions (Guaranteed Single Source of Truth)
window.toggleSidebar = function(forceState) {
    const sb = document.getElementById('sidebar');
    const ov = document.getElementById('sidebarOverlay');
    if (!sb) return;

    const isActive = sb.classList.contains('active');
    const targetState = (typeof forceState === 'boolean') ? forceState : !isActive;

    if (targetState) {
        sb.classList.add('active');
        if (ov) ov.classList.add('active');
        document.body.classList.add('sidebar-open');
    } else {
        sb.classList.remove('active');
        if (ov) ov.classList.remove('active');
        document.body.classList.remove('sidebar-open');
    }
};

window.openSidebar = function() { window.toggleSidebar(true); };
window.closeSidebar = function() { window.toggleSidebar(false); };

// Prevent multiple event listener registrations across dashboard sub-pages
if (!window._sidebarEventsBound) {
    window._sidebarEventsBound = true;

    // Global Delegated Click Handler for all sidebar mobile controls
    document.addEventListener('click', function(e) {
        // Toggle Trigger
        const toggleBtn = e.target.closest('#sidebarToggle, .sidebar-toggle-btn, [data-action="toggle-sidebar"]');
        if (toggleBtn) {
            e.preventDefault();
            e.stopPropagation();
            window.toggleSidebar();
            return;
        }

        // Close Trigger (inside sidebar)
        const closeBtn = e.target.closest('#btnCloseSidebar, .sidebar-close-btn, [data-action="close-sidebar"]');
        if (closeBtn) {
            e.preventDefault();
            e.stopPropagation();
            window.closeSidebar();
            return;
        }

        // Backdrop Overlay Click
        const overlay = e.target.closest('#sidebarOverlay');
        if (overlay) {
            e.preventDefault();
            e.stopPropagation();
            window.closeSidebar();
            return;
        }
    });

    // Close on Escape Key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' || e.key === 'Esc') {
            window.closeSidebar();
        }
    });
}

// Universal Logout Helper with SweetAlert2
function confirmLogout(e) {
    if (e) e.preventDefault();
    const logoutUrl = '<?= $apiRoot ?>logout.php';
    const authUrl = '<?= $dashRoot ?>../auth/index.php';

    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Keluar Sistem?',
            text: 'Sesi Anda akan diakhiri.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0d2e5c',
            confirmButtonText: 'Ya, Logout',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(logoutUrl).finally(() => {
                    localStorage.clear();
                    window.location.href = authUrl;
                });
            }
        });
    } else {
        if (confirm('Keluar dari sistem?')) {
            window.location.href = logoutUrl;
        }
    }
}
function logout() { confirmLogout(); }
</script>
