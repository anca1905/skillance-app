<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/index.php");
    exit();
}
if (($_SESSION['user_role'] ?? '') === 'freelancer') {
    header("Location: freelancer/index.php");
    exit();
}
if (($_SESSION['user_role'] ?? '') === 'bendahara') {
    header("Location: finance/index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | S-OS Skillance</title>

    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link rel="apple-touch-icon" href="../assets/img/favicon.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        /* CSS Khusus Layout Dashboard */
        body {
            background-color: #f3f4f6;
            overflow-x: hidden;
        }

        /* Sidebar Styling */
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
            /* Geser konten ke kanan */
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

        /* Responsive Sidebar & Mobile Overlay */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(13, 46, 92, 0.45);
            backdrop-filter: blur(3px);
            z-index: 1040;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.active {
            display: block;
        }

        @media (max-width: 768px) {
            .sidebar {
                margin-left: -260px;
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                z-index: 1050;
                box-shadow: 4px 0 25px rgba(0, 0, 0, 0.25);
            }

            .sidebar.active {
                margin-left: 0;
            }

            .main-content {
                margin-left: 0;
                padding: 16px 12px;
            }
        }

        /* Utilities Dashboard */
        .card {
            border: none;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.03);
            border-radius: 8px;
        }

        .blink-badge {
            animation: blink 2s infinite;
        }

        @keyframes blink {
            0% {
                opacity: 1;
            }

            50% {
                opacity: 0.6;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <?php
    $activeMenu = 'dashboard';
    include __DIR__ . '/includes/sidebar.php';
    ?>

    <div class="main-content">

        <div class="d-flex justify-content-between align-items-center mb-4 d-md-none">
            <div class="d-flex align-items-center gap-2">
                <button type="button" class="btn btn-navy btn-sm rounded-circle d-flex align-items-center justify-content-center shadow-sm sidebar-toggle-btn" style="width: 38px; height: 38px;" id="sidebarToggle" title="Buka Menu">
                    <i class="fa-solid fa-bars fs-6"></i>
                </button>
                <span class="fw-bold text-navy fs-5">Dashboard</span>
            </div>
            <div class="bg-navy text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px;">
                <i class="fa-solid fa-user small"></i>
            </div>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4 d-none d-md-flex">
            <div>
                <h4 class="fw-bold text-navy mb-0">Executive Dashboard</h4>
                <small class="text-muted">Ringkasan performa bisnis hari ini.</small>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="text-end">
                    <small class="d-block fw-bold text-navy" id="userNameDisplay">User</small>
                    <small class="text-muted" style="font-size: 0.7rem;">Administrator</small>
                </div>
                <div class="bg-navy text-white rounded-circle d-flex align-items-center justify-content-center"
                    style="width: 40px; height: 40px;">
                    <i class="fa-solid fa-user"></i>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-12 col-md-6">
                <div class="card h-100 border-start border-5 border-primary shadow-sm bg-white">
                    <div class="card-body d-flex justify-content-between align-items-center p-4">
                        <div>
                            <small class="text-uppercase text-muted fw-bold ls-1" style="font-size: 0.75rem;">Total
                                Omzet (Realtime)</small>
                            <h3 class="fw-bold text-navy mt-2 mb-0" id="totalOmzet">Rp 0</h3>
                            <small class="text-success mt-2 d-inline-block"><i
                                    class="fa-solid fa-arrow-trend-up me-1"></i> Data Terupdate Realtime</small>
                        </div>
                        <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 60px; height: 60px;">
                            <i class="fa-solid fa-wallet fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card h-100 border-start border-5 border-warning shadow-sm bg-white">
                    <div class="card-body d-flex justify-content-between align-items-center p-4">
                        <div>
                            <small class="text-uppercase text-muted fw-bold ls-1" style="font-size: 0.75rem;">Project
                                Aktif</small>
                            <h3 class="fw-bold text-warning mt-2 mb-0" id="activeProjects">0 Project</h3>
                            <small class="text-muted mt-2 d-inline-block"><i class="fa-regular fa-clock me-1"></i>
                                Sedang Berjalan</small>
                        </div>
                        <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 60px; height: 60px;">
                            <i class="fa-solid fa-briefcase fs-3"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-12 col-xl-8">
                <div class="card h-100 shadow-sm border-0">
                    <div
                        class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-navy">Statistik Performa Mingguan</h6>
                        <button class="btn btn-sm btn-light border" id="btnDownloadReport"><i
                                class="fa-solid fa-download"></i> Report</button>
                    </div>
                    <div class="card-body bg-white p-4" style="min-height: 300px;">
                        <canvas id="omzetChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-4">
                <div class="card h-100 shadow-sm border-0">
                    <div
                        class="card-header bg-white py-3 border-bottom d-flex justify-content-between align-items-center">
                        <h6 class="m-0 fw-bold text-navy">Project Terbaru</h6>
                        <a href="project.php" class="text-decoration-none small text-primary fw-semibold">Lihat
                            Semua</a>
                    </div>
                    <div class="list-group list-group-flush" id="recentProjectsList">
                        <div class="text-center p-4"><i class="fa-solid fa-spinner fa-spin text-muted"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center py-3">
                        <span class="fw-bold ls-1"><i class="fa-regular fa-calendar-check me-2"></i>AGENDA PRIORITAS
                            SAYA</span>
                        <button class="btn btn-sm btn-warning text-navy fw-bold px-3 shadow-sm" data-bs-toggle="modal"
                            data-bs-target="#addAgendaModal">
                            <i class="fa-solid fa-plus me-1"></i> Baru
                        </button>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush" id="agendaList"
                            style="max-height: 400px; overflow-y: auto;">
                            <div class="text-center p-4"><i class="fa-solid fa-spinner fa-spin text-muted"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="modal fade" id="addAgendaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-navy text-white">
                    <h6 class="modal-title fw-bold">Tambah Agenda Baru</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <form id="agendaForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">KEGIATAN</label>
                            <input type="text" id="agendaTitle" class="form-control"
                                placeholder="Contoh: Meeting Klien Laundry" required>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label class="form-label small fw-bold text-muted">TANGGAL</label>
                                <input type="date" id="agendaDate" class="form-control" required>
                            </div>
                            <div class="col-6 mb-3">
                                <label class="form-label small fw-bold text-muted">JAM</label>
                                <input type="time" id="agendaTime" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">LOKASI</label>
                            <input type="text" id="agendaLocation" class="form-control" placeholder="Opsional">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">PRIORITAS</label>
                            <select id="agendaPriority" class="form-select">
                                <option value="normal">Normal</option>
                                <option value="high">High</option>
                                <option value="critical">Critical</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-navy text-white">Simpan Agenda</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>

</html>
