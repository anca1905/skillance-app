<?php
/**
 * Shared Master Sidebar for Skillance Office Dashboard
 * 
 * Usage:
 *   $activeMenu = 'dashboard'; // 'dashboard', 'freelance', 'project', 'finance', 'investment', 'hrd', 'team', 'payroll', 'blog', 'profile'
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
        <button class="btn btn-sm btn-light d-md-none rounded-circle" id="btnCloseSidebar" onclick="toggleSidebar()" title="Tutup Menu">
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
            <a href="<?= $dashRoot ?>investment/index.php" class="nav-link <?= $activeMenu === 'investment' ? 'active' : '' ?>">
                <i class="fa-solid fa-hand-holding-dollar"></i> Investasi Admin
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= $dashRoot ?>hrd/index.php" class="nav-link text-primary <?= $activeMenu === 'hrd' ? 'active' : '' ?>">
                <i class="fa-solid fa-users"></i> HRD
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= $dashRoot ?>team/index.php" class="nav-link <?= $activeMenu === 'team' ? 'active' : '' ?>">
                <i class="fa-solid fa-people-group"></i> Manajemen Tim
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= $dashRoot ?>payroll/index.php" class="nav-link <?= $activeMenu === 'payroll' ? 'active' : '' ?>">
                <i class="fa-solid fa-money-check-dollar"></i> Penggajian
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= $dashRoot ?>blog/index.php" class="nav-link <?= $activeMenu === 'blog' ? 'active' : '' ?>">
                <i class="fa-solid fa-newspaper"></i> Kelola Artikel
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
// Universal Sidebar Mobile Toggle Helper
function toggleSidebar() {
    const sb = document.getElementById('sidebar');
    const ov = document.getElementById('sidebarOverlay');
    if (sb) sb.classList.toggle('active');
    if (ov) ov.classList.toggle('active');
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

document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('sidebarOverlay');
    const toggleBtn = document.getElementById('sidebarToggle');
    const closeBtn = document.getElementById('btnCloseSidebar');

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            toggleSidebar();
        });
    }
    if (closeBtn && sidebar) {
        closeBtn.addEventListener('click', function(e) {
            e.preventDefault();
            sidebar.classList.remove('active');
            if (overlay) overlay.classList.remove('active');
        });
    }
    if (overlay && sidebar) {
        overlay.addEventListener('click', function() {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    }
});
</script>
