<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/index.php");
    exit();
}

$userRole = $_SESSION['user_role'] ?? '';
if ($userRole !== 'admin' && $userRole !== 'client' && $userRole !== 'staff') {
    header("Location: ../freelancer/index.php");
    exit();
}

require_once __DIR__ . '/../../config/config.php';
$userName = $_SESSION['user_name'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Bursa Freelance | S-OS Skillance</title>

    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">

    <style>
        body {
            background-color: #f3f4f6;
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0; left: 0;
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
            min-height: 100vh;
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
        .nav-link:hover, .nav-link.active {
            background-color: var(--navy-subtle);
            color: var(--navy) !important;
            border-right: 3px solid var(--navy);
        }
        .card-custom {
            border: none;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.03);
            border-radius: 12px;
            background: #ffffff;
        }
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(13, 46, 92, 0.5);
            backdrop-filter: blur(2px);
            z-index: 1040;
            transition: opacity 0.3s ease;
        }
        .sidebar-overlay.active {
            display: block;
        }
        @media (max-width: 768px) {
            .sidebar { 
                margin-left: -260px;
                box-shadow: 4px 0 25px rgba(0,0,0,0.25);
            }
            .sidebar.active { 
                margin-left: 0; 
            }
            .main-content { 
                margin-left: 0; 
                padding: 16px 12px; 
            }
        }
    </style>
</head>
<body>

    <?php
    $activeMenu = 'freelance';
    include __DIR__ . '/../includes/sidebar.php';
    ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar Mobile & Desktop -->
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4 pb-2 border-bottom">
            <div class="d-flex align-items-center gap-2 gap-sm-3">
                <button class="btn btn-navy btn-sm d-md-none shadow-sm rounded-circle d-flex align-items-center justify-content-center" style="width: 38px; height: 38px;" id="sidebarToggle" title="Buka Menu">
                    <i class="fa-solid fa-bars fs-6"></i>
                </button>
                <div>
                    <h4 class="fw-bold text-navy mb-0 fs-5 fs-md-4">
                        <i class="fa-solid fa-handshake text-gold me-1"></i> Manajemen Freelance
                    </h4>
                    <small class="text-muted d-none d-sm-block">Kelola lowongan, review tugas, dan transfer fee.</small>
                </div>
            </div>
            <div class="d-flex gap-2 ms-auto">
                <button class="btn btn-gold btn-sm fw-bold px-3 py-2 shadow-sm rounded-pill" data-bs-toggle="modal" data-bs-target="#modalCreateJob">
                    <i class="fa-solid fa-plus me-1"></i> Buka Lowongan Baru
                </button>
            </div>
        </div>

        <!-- KPI Cards -->
        <div class="row g-3 mb-4 align-items-stretch">
            <div class="col-6 col-md-3">
                <div class="card card-custom h-100 p-3 border-start border-4 border-warning d-flex flex-column justify-content-between shadow-sm">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <small class="text-muted fw-bold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.5px;">Butuh Review</small>
                            <i class="fa-solid fa-inbox text-warning" style="font-size: 0.85rem;"></i>
                        </div>
                        <h4 class="fw-bold text-warning mb-0" id="statPendingReview">0 Tugas</h4>
                    </div>
                    <div class="pt-2 mt-2 border-top border-light-subtle">
                        <small class="text-muted" style="font-size: 0.72rem;">Hasil kerja masuk</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card card-custom h-100 p-3 border-start border-4 border-danger d-flex flex-column justify-content-between shadow-sm">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <small class="text-muted fw-bold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.5px;">Antrean Transfer</small>
                            <i class="fa-solid fa-money-bill-transfer text-danger" style="font-size: 0.85rem;"></i>
                        </div>
                        <h4 class="fw-bold text-danger mb-0" id="statPendingPayouts">Rp 0</h4>
                    </div>
                    <div class="pt-2 mt-2 border-top border-light-subtle">
                        <small class="text-muted" id="statPendingPayoutsCount" style="font-size: 0.72rem;">0 antrean transfer</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card card-custom h-100 p-3 border-start border-4 border-success d-flex flex-column justify-content-between shadow-sm">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <small class="text-muted fw-bold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.5px;">Fee Telah Ditransfer</small>
                            <i class="fa-solid fa-circle-check text-success" style="font-size: 0.85rem;"></i>
                        </div>
                        <h4 class="fw-bold text-success mb-0" id="statTransferred">Rp 0</h4>
                    </div>
                    <div class="pt-2 mt-2 border-top border-light-subtle">
                        <small class="text-muted" style="font-size: 0.72rem;">Total fee dibayarkan</small>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card card-custom h-100 p-3 border-start border-4 border-primary d-flex flex-column justify-content-between shadow-sm">
                    <div>
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <small class="text-muted fw-bold text-uppercase" style="font-size: 0.68rem; letter-spacing: 0.5px;">Total Lowongan</small>
                            <i class="fa-solid fa-briefcase text-primary" style="font-size: 0.85rem;"></i>
                        </div>
                        <h4 class="fw-bold text-navy mb-0" id="statTotalJobs">0 Lowongan</h4>
                    </div>
                    <div class="pt-2 mt-2 border-top border-light-subtle">
                        <small class="text-muted" style="font-size: 0.72rem;">Bursa freelance aktif</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nav Tabs Admin Freelance -->
        <div class="card card-custom mb-4">
            <div class="card-header bg-white border-bottom-0 pt-3 px-3 px-md-4 overflow-x-auto" style="-webkit-overflow-scrolling: touch;">
                <ul class="nav nav-tabs card-header-tabs flex-nowrap" id="freelanceAdminTabs" style="white-space: nowrap; min-width: max-content;">
                    <li class="nav-item">
                        <button class="nav-link active fw-bold text-navy" data-bs-toggle="tab" data-bs-target="#tabSubmissions" onclick="loadSubmissions()">
                            <i class="fa-solid fa-inbox me-1"></i> Review Hasil Kerja
                            <span class="badge bg-danger ms-1" id="badgeSubmissions">0</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link fw-bold text-navy" data-bs-toggle="tab" data-bs-target="#tabPayouts" onclick="loadPayouts()">
                            <i class="fa-solid fa-money-bill-transfer me-1"></i> Pembayaran Manual & Transfer
                            <span class="badge bg-warning text-dark ms-1" id="badgePayouts">0</span>
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link fw-bold text-navy" data-bs-toggle="tab" data-bs-target="#tabJobs" onclick="loadAllJobs()">
                            <i class="fa-solid fa-briefcase me-1"></i> Kelola Daftar Lowongan
                        </button>
                    </li>
                </ul>
            </div>

            <div class="card-body p-4">
                <div class="tab-content">
                    
                    <!-- 1. TAB REVIEW SUBMISSION -->
                    <div class="tab-pane fade show active" id="tabSubmissions">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold text-navy mb-0">Tugas yang Masuk & Butuh Review Anda</h6>
                            <button class="btn btn-sm btn-outline-secondary" onclick="loadSubmissions()"><i class="fa-solid fa-rotate me-1"></i> Refresh</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr class="small text-muted text-uppercase">
                                        <th>Freelancer</th>
                                        <th>Pekerjaan / Tugas</th>
                                        <th>Fee</th>
                                        <th>Hasil Kerja Diajukan</th>
                                        <th>Status</th>
                                        <th>Tindakan Review</th>
                                    </tr>
                                </thead>
                                <tbody id="submissionsTableBody">
                                    <tr><td colspan="6" class="text-center py-4 text-muted">Memuat data submission...</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- 2. TAB PEMBAYARAN MANUAL -->
                    <div class="tab-pane fade" id="tabPayouts">
                        <div class="alert alert-info py-2 px-3 small mb-3">
                            <i class="fa-solid fa-info-circle me-1"></i> <strong>Sistem Pembayaran Manual:</strong> Anda dapat mentransfer fee langsung melalui m-banking atau e-wallet ke rekening tujuan freelancer di bawah ini. Setelah transfer selesai, klik <strong>"Konfirmasi Sudah Ditransfer"</strong> dan unggah bukti struk transfer.
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr class="small text-muted text-uppercase">
                                        <th>Freelancer</th>
                                        <th>Pekerjaan</th>
                                        <th>Nominal Fee</th>
                                        <th>Rekening Tujuan Transfer</th>
                                        <th>Status Pembayaran</th>
                                        <th>Aksi Transfer Manual</th>
                                    </tr>
                                </thead>
                                <tbody id="payoutsTableBody">
                                    <tr><td colspan="6" class="text-center py-4 text-muted">Memuat data antrean transfer...</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- 3. TAB KELOLA LOWONGAN -->
                    <div class="tab-pane fade" id="tabJobs">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold text-navy mb-0">Daftar Semua Lowongan Freelance</h6>
                            <button class="btn btn-gold btn-sm fw-bold" data-bs-toggle="modal" data-bs-target="#modalCreateJob">
                                <i class="fa-solid fa-plus me-1"></i> Buka Lowongan Baru
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr class="small text-muted text-uppercase">
                                        <th>Judul Lowongan</th>
                                        <th>Kategori & Target</th>
                                        <th>Budget / Fee</th>
                                        <th>Deadline</th>
                                        <th>Pelamar / Pengerja</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="jobsTableBody">
                                    <tr><td colspan="7" class="text-center py-4 text-muted">Memuat data lowongan...</td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Buat Lowongan Baru -->
    <div class="modal fade" id="modalCreateJob" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content card-custom">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold text-navy"><i class="fa-solid fa-briefcase text-gold me-2"></i> Buka Lowongan Freelance Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formCreateJob" enctype="multipart/form-data">
                    <div class="modal-body p-4">
                        <input type="hidden" name="action" value="create_job">

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-navy">Judul Tugas / Pekerjaan <span class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control" placeholder="Contoh: Desain Banner Promosi Media Sosial (Figma / Canva)" required>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">Kategori</label>
                                <select name="category" class="form-select" required>
                                    <option value="Web & Pemrograman">Web & Pemrograman</option>
                                    <option value="Desain & UI/UX" selected>Desain & UI/UX</option>
                                    <option value="Penulisan & Konten">Penulisan & Konten</option>
                                    <option value="Digital Marketing">Digital Marketing</option>
                                    <option value="Data & Administrasi">Data & Administrasi</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">Target Freelancer</label>
                                <select name="target_audience" class="form-select" required>
                                    <option value="semua">Semua (Mahasiswa & Umum)</option>
                                    <option value="mahasiswa">Khusus Mahasiswa</option>
                                    <option value="umum">Khusus Umum / Profesional</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">Imbalan / Fee (Rp) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="reward_amount" class="form-control" placeholder="350000" min="10000" step="5000" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small fw-bold text-navy">Batas Waktu (Deadline) <span class="text-danger">*</span></label>
                                <input type="date" name="deadline" class="form-control" min="<?= date('Y-m-d') ?>" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-navy">Deskripsi Lengkap Tugas <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" rows="4" placeholder="Jelaskan secara detail apa yang harus dikerjakan, output yang diharapkan, serta acuan yang digunakan..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-navy">Kriteria & Syarat Pengerjaan</label>
                            <textarea name="requirements" class="form-control" rows="2" placeholder="Contoh: 1. Melampirkan link file Figma rapi. 2. Revisi minor maks. 2 kali."></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-navy">
                                <i class="fa-solid fa-image text-gold me-1"></i> Foto / Banner Lowongan (Opsional)
                            </label>
                            <input type="file" name="image" id="jobImageInput" class="form-control" accept="image/png, image/jpeg, image/jpg, image/webp">
                            <small class="text-muted d-block mt-1" style="font-size: 0.72rem;">Format: JPG, PNG, WebP (Maksimal 5MB). Banner akan tampil di kartu lowongan publik dan saat dibagikan ke medsos.</small>
                            <div id="jobImagePreviewWrapper" class="mt-2 d-none">
                                <div class="position-relative d-inline-block w-100">
                                    <img id="jobImagePreview" src="" alt="Preview Banner" class="img-fluid rounded border shadow-sm w-100" style="max-height: 200px; object-fit: cover;">
                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2 rounded-circle" id="btnRemoveImagePreview" title="Hapus Foto" style="width: 30px; height: 30px; padding: 0;">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-gold fw-bold" id="btnSubmitJob">
                            <i class="fa-solid fa-paper-plane me-1"></i> Terbitkan Lowongan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Review & Feedback Submission -->
    <div class="modal fade" id="modalReviewSubmission" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card-custom">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold text-navy" id="reviewModalTitle">Review Hasil Kerja</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <input type="hidden" id="reviewAssignmentId">
                    <input type="hidden" id="reviewDecision">

                    <p class="small text-muted mb-3" id="reviewModalDescription"></p>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-navy" id="reviewFeedbackLabel">Catatan Review</label>
                        <textarea id="reviewFeedbackText" class="form-control" rows="3" placeholder="Tuliskan catatan apresiasi atau detail yang perlu direvisi..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-top">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary fw-bold" id="btnConfirmReviewAction">Kirim Keputusan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Transfer Manual -->
    <div class="modal fade" id="modalConfirmPayout" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content card-custom">
                <div class="modal-header border-bottom">
                    <h5 class="modal-title fw-bold text-navy"><i class="fa-solid fa-money-bill-transfer text-success me-2"></i> Konfirmasi Pembayaran Fee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="formConfirmPayout" enctype="multipart/form-data">
                    <div class="modal-body p-4">
                        <input type="hidden" name="action" value="confirm_payout">
                        <input type="hidden" name="payout_id" id="payoutIdInput">

                        <div class="p-3 bg-light rounded-3 mb-3 border">
                            <div class="d-flex justify-content-between mb-1">
                                <small class="text-muted">Penerima:</small>
                                <strong class="text-navy" id="payoutFreelancerName">-</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-1">
                                <small class="text-muted">Rekening / E-Wallet:</small>
                                <strong class="text-navy" id="payoutBankDetails">-</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-0">
                                <small class="text-muted">Nominal Transfer:</small>
                                <h5 class="fw-bold text-success mb-0" id="payoutAmountDisplay">Rp 0</h5>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-navy">Unggah Foto Bukti Transfer / Struk m-Banking (Opsional)</label>
                            <input type="file" name="transfer_receipt" class="form-control" accept="image/*,.pdf">
                            <small class="text-muted" style="font-size: 0.72rem;">Screenshot bukti transfer dari aplikasi BCA Mobile, BRImo, Livin, Dana, dll.</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small fw-bold text-navy">Catatan Transfer (No. Referensi / Bank Pengirim)</label>
                            <input type="text" name="transfer_notes" class="form-control" placeholder="Contoh: Transfer via BCA ref: #928173">
                        </div>
                    </div>
                    <div class="modal-footer border-top">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success fw-bold" id="btnSubmitPayoutConfirm">
                            <i class="fa-solid fa-check me-1"></i> Ya, Tandai Sudah Ditransfer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(number);
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar Mobile Toggle & Overlay
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            const toggleBtn = document.getElementById('sidebarToggle');
            const closeBtn = document.getElementById('btnCloseSidebar');

            if (toggleBtn && sidebar) {
                toggleBtn.addEventListener('click', () => {
                    sidebar.classList.toggle('active');
                    if (overlay) overlay.classList.toggle('active');
                });
            }
            if (closeBtn && sidebar) {
                closeBtn.addEventListener('click', () => {
                    sidebar.classList.remove('active');
                    if (overlay) overlay.classList.remove('active');
                });
            }
            if (overlay && sidebar) {
                overlay.addEventListener('click', () => {
                    sidebar.classList.remove('active');
                    overlay.classList.remove('active');
                });
            }

            loadAdminStats();
            loadSubmissions();
            loadPayouts();
            loadAllJobs();

            // Image preview listener for Create Job
            const jobImageInput = document.getElementById('jobImageInput');
            const jobImagePreviewWrapper = document.getElementById('jobImagePreviewWrapper');
            const jobImagePreview = document.getElementById('jobImagePreview');
            const btnRemoveImagePreview = document.getElementById('btnRemoveImagePreview');

            if (jobImageInput) {
                jobImageInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            jobImagePreview.src = e.target.result;
                            jobImagePreviewWrapper.classList.remove('d-none');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        jobImagePreview.src = '';
                        jobImagePreviewWrapper.classList.add('d-none');
                    }
                });
            }

            if (btnRemoveImagePreview) {
                btnRemoveImagePreview.addEventListener('click', function() {
                    jobImageInput.value = '';
                    jobImagePreview.src = '';
                    jobImagePreviewWrapper.classList.add('d-none');
                });
            }

            // Create job submit
            const formJob = document.getElementById('formCreateJob');
            formJob.addEventListener('submit', function(e) {
                e.preventDefault();
                const btn = document.getElementById('btnSubmitJob');
                const orig = btn.innerHTML;
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Menyimpan...';
                btn.disabled = true;

                const formData = new FormData(formJob);
                fetch('../../api/freelance_admin_api.php', { method: 'POST', body: formData })
                .then(r => r.json())
                .then(d => {
                    if (d.status === 'success') {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('modalCreateJob'));
                        if (modal) modal.hide();
                        formJob.reset();
                        if (jobImagePreview) jobImagePreview.src = '';
                        if (jobImagePreviewWrapper) jobImagePreviewWrapper.classList.add('d-none');
                        Swal.fire({ icon: 'success', title: 'Berhasil!', text: d.message });
                        loadAdminStats();
                        loadAllJobs();
                    } else {
                        Swal.fire({ icon: 'error', title: 'Gagal', text: d.message });
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Terjadi kesalahan sistem.' });
                })
                .finally(() => { btn.innerHTML = orig; btn.disabled = false; });
            });

            // Confirm Payout submit
            const formPayout = document.getElementById('formConfirmPayout');
            formPayout.addEventListener('submit', function(e) {
                e.preventDefault();
                const btn = document.getElementById('btnSubmitPayoutConfirm');
                const orig = btn.innerHTML;
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Memproses...';
                btn.disabled = true;

                const formData = new FormData(formPayout);
                fetch('../../api/freelance_admin_api.php', { method: 'POST', body: formData })
                .then(r => r.json())
                .then(d => {
                    if (d.status === 'success') {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('modalConfirmPayout'));
                        if (modal) modal.hide();
                        formPayout.reset();
                        Swal.fire({ icon: 'success', title: 'Transfer Dikonfirmasi!', text: d.message });
                        loadAdminStats();
                        loadPayouts();
                    } else {
                        Swal.fire({ icon: 'error', title: 'Gagal', text: d.message });
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Terjadi kesalahan sistem.' });
                })
                .finally(() => { btn.innerHTML = orig; btn.disabled = false; });
            });

            // Review action submit
            document.getElementById('btnConfirmReviewAction').addEventListener('click', function() {
                const assignmentId = document.getElementById('reviewAssignmentId').value;
                const decision = document.getElementById('reviewDecision').value;
                const feedback = document.getElementById('reviewFeedbackText').value;

                const btn = this;
                const orig = btn.innerHTML;
                btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin me-1"></i> Menyimpan...';
                btn.disabled = true;

                const formData = new FormData();
                formData.append('action', 'review_submission');
                formData.append('assignment_id', assignmentId);
                formData.append('decision', decision);
                formData.append('feedback', feedback);

                fetch('../../api/freelance_admin_api.php', { method: 'POST', body: formData })
                .then(r => r.json())
                .then(d => {
                    if (d.status === 'success') {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('modalReviewSubmission'));
                        if (modal) modal.hide();
                        Swal.fire({ icon: 'success', title: 'Berhasil!', text: d.message });
                        loadAdminStats();
                        loadSubmissions();
                        loadPayouts();
                    } else {
                        Swal.fire({ icon: 'error', title: 'Gagal', text: d.message });
                    }
                })
                .catch(err => {
                    console.error(err);
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Terjadi kesalahan sistem.' });
                })
                .finally(() => { btn.innerHTML = orig; btn.disabled = false; });
            });
        });

        function loadAdminStats() {
            fetch('../../api/freelance_admin_api.php?action=get_admin_stats')
            .then(r => r.json())
            .then(d => {
                if (d.status === 'success') {
                    document.getElementById('statPendingReview').innerText = d.stats.pending_review + ' Tugas';
                    document.getElementById('statPendingPayouts').innerText = formatRupiah(d.stats.pending_payouts_amount);
                    document.getElementById('statPendingPayoutsCount').innerText = d.stats.pending_payouts_count + ' antrean transfer';
                    document.getElementById('statTransferred').innerText = formatRupiah(d.stats.total_transferred_amount);
                    document.getElementById('statTotalJobs').innerText = d.stats.total_jobs + ' Lowongan';

                    document.getElementById('badgeSubmissions').innerText = d.stats.pending_review;
                    document.getElementById('badgePayouts').innerText = d.stats.pending_payouts_count;
                }
            })
            .catch(err => console.error(err));
        }

        function loadSubmissions() {
            const tbody = document.getElementById('submissionsTableBody');
            tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-muted"><i class="fa-solid fa-spinner fa-spin me-2"></i> Memuat...</td></tr>';

            fetch('../../api/freelance_admin_api.php?action=get_submissions')
            .then(r => r.json())
            .then(d => {
                if (d.status === 'success') {
                    renderSubmissionsTable(d.submissions);
                }
            })
            .catch(err => console.error(err));
        }

        function renderSubmissionsTable(submissions) {
            const tbody = document.getElementById('submissionsTableBody');
            if (!submissions || submissions.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-muted">Belum ada pengajuan hasil kerja saat ini.</td></tr>';
                return;
            }

            let html = '';
            submissions.forEach(s => {
                let statusBadge = '';
                let actionBtns = '';

                if (s.status === 'submitted') {
                    statusBadge = '<span class="badge bg-warning text-dark"><i class="fa-solid fa-clock me-1"></i> Menunggu Review</span>';
                    actionBtns = `
                        <button class="btn btn-sm btn-success fw-bold mb-1" onclick="openReviewModal(${s.id}, 'approve', '${escapeHtml(s.job_title)}', '${escapeHtml(s.freelancer_name)}')">
                            <i class="fa-solid fa-check me-1"></i> Setujui & Bayar
                        </button>
                        <button class="btn btn-sm btn-outline-danger fw-bold" onclick="openReviewModal(${s.id}, 'revision', '${escapeHtml(s.job_title)}', '${escapeHtml(s.freelancer_name)}')">
                            <i class="fa-solid fa-rotate-left me-1"></i> Minta Revisi
                        </button>
                    `;
                } else if (s.status === 'revision') {
                    statusBadge = '<span class="badge bg-danger"><i class="fa-solid fa-triangle-exclamation me-1"></i> Dalam Revisi</span>';
                    actionBtns = '<small class="text-muted">Menunggu revisi freelancer</small>';
                } else if (s.status === 'completed') {
                    statusBadge = '<span class="badge bg-success"><i class="fa-solid fa-circle-check me-1"></i> Selesai Disetujui</span>';
                    actionBtns = '<small class="text-success fw-bold"><i class="fa-solid fa-check me-1"></i> Approved</small>';
                } else {
                    statusBadge = '<span class="badge bg-primary">Sedang Dikerjakan</span>';
                    actionBtns = '<small class="text-muted">-</small>';
                }

                let deliverables = '';
                if (s.submission_link) {
                    deliverables += `<a href="${s.submission_link}" target="_blank" class="btn btn-xs btn-outline-primary d-inline-block mb-1" style="font-size:0.75rem;"><i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Buka Link Kerja</a><br>`;
                }
                if (s.submission_file) {
                    deliverables += `<a href="../../uploads/freelance_submissions/${s.submission_file}" target="_blank" class="btn btn-xs btn-outline-secondary d-inline-block" style="font-size:0.75rem;"><i class="fa-solid fa-download me-1"></i> Unduh File</a>`;
                }
                if (s.submission_notes) {
                    deliverables += `<div class="small text-muted fst-italic mt-1">"${escapeHtml(s.submission_notes)}"</div>`;
                }

                html += `
                    <tr>
                        <td>
                            <div class="fw-bold text-navy">${escapeHtml(s.freelancer_name)}</div>
                            <small class="badge bg-light text-muted border text-capitalize">${s.user_type} ${s.institution ? ' - ' + escapeHtml(s.institution) : ''}</small>
                            <small class="d-block text-muted" style="font-size: 0.72rem;">${s.freelancer_email}</small>
                        </td>
                        <td>
                            <div class="fw-bold text-navy">${escapeHtml(s.job_title)}</div>
                            <small class="text-muted">${s.job_category}</small>
                        </td>
                        <td class="fw-bold text-success">${formatRupiah(s.reward_amount)}</td>
                        <td>${deliverables || '<span class="text-muted small">Belum diajukan</span>'}</td>
                        <td>${statusBadge}</td>
                        <td>${actionBtns}</td>
                    </tr>
                `;
            });
            tbody.innerHTML = html;
        }

        function openReviewModal(assignmentId, decision, jobTitle, freelancerName) {
            document.getElementById('reviewAssignmentId').value = assignmentId;
            document.getElementById('reviewDecision').value = decision;

            const btnConfirm = document.getElementById('btnConfirmReviewAction');

            if (decision === 'approve') {
                document.getElementById('reviewModalTitle').innerHTML = '<i class="fa-solid fa-circle-check text-success me-2"></i> Setujui Hasil Kerja';
                document.getElementById('reviewModalDescription').innerHTML = `Apakah Anda puas dan ingin menyetujui tugas <strong>${jobTitle}</strong> yang dikerjakan oleh <strong>${freelancerName}</strong>? Tugas ini akan diselesaikan dan langsung masuk ke Antrean Pembayaran Manual.`;
                document.getElementById('reviewFeedbackLabel').innerText = 'Catatan Apresiasi / Review (Opsional)';
                document.getElementById('reviewFeedbackText').placeholder = 'Contoh: Pengerjaan rapi dan sesuai instruksi. Terima kasih banyak!';
                btnConfirm.className = 'btn btn-success fw-bold';
                btnConfirm.innerHTML = '<i class="fa-solid fa-check me-1"></i> Setujui & Masukkan ke Antrean Bayar';
            } else {
                document.getElementById('reviewModalTitle').innerHTML = '<i class="fa-solid fa-rotate-left text-danger me-2"></i> Minta Revisi Pekerjaan';
                document.getElementById('reviewModalDescription').innerHTML = `Tuliskan poin-poin yang harus diperbaiki oleh <strong>${freelancerName}</strong> untuk tugas <strong>${jobTitle}</strong>. Pesan ini akan langsung tampil di dashboard freelancer.`;
                document.getElementById('reviewFeedbackLabel').innerText = 'Poin Revisi / Feedback yang Harus Diperbaiki (Wajib)';
                document.getElementById('reviewFeedbackText').placeholder = 'Contoh: Mohon perbaiki bagian font di header agar lebih kontras, dan perbaiki link figma halaman mobile.';
                btnConfirm.className = 'btn btn-danger fw-bold';
                btnConfirm.innerHTML = '<i class="fa-solid fa-paper-plane me-1"></i> Kirim Permintaan Revisi';
            }

            document.getElementById('reviewFeedbackText').value = '';
            new bootstrap.Modal(document.getElementById('modalReviewSubmission')).show();
        }

        function loadPayouts() {
            const tbody = document.getElementById('payoutsTableBody');
            tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-muted"><i class="fa-solid fa-spinner fa-spin me-2"></i> Memuat antrean...</td></tr>';

            fetch('../../api/freelance_admin_api.php?action=get_payouts')
            .then(r => r.json())
            .then(d => {
                if (d.status === 'success') {
                    renderPayoutsTable(d.payouts);
                }
            })
            .catch(err => console.error(err));
        }

        function renderPayoutsTable(payouts) {
            const tbody = document.getElementById('payoutsTableBody');
            if (!payouts || payouts.length === 0) {
                tbody.innerHTML = '<tr><td colspan="6" class="text-center py-4 text-muted">Belum ada antrean pembayaran fee.</td></tr>';
                return;
            }

            let html = '';
            payouts.forEach(p => {
                let statusBadge = '';
                let actionBtn = '';

                if (p.status === 'pending') {
                    statusBadge = '<span class="badge bg-warning text-dark"><i class="fa-solid fa-clock me-1"></i> Siap Ditransfer Manual</span>';
                    actionBtn = `
                        <button class="btn btn-sm btn-success fw-bold" onclick="openPayoutModal(${p.id}, '${escapeHtml(p.freelancer_name)}', '${p.bank_name}', '${p.account_number}', '${escapeHtml(p.account_name)}', ${p.amount})">
                            <i class="fa-solid fa-money-bill-transfer me-1"></i> Konfirmasi Transfer
                        </button>
                    `;
                } else {
                    statusBadge = '<span class="badge bg-success"><i class="fa-solid fa-circle-check me-1"></i> Selesai Ditransfer</span>';
                    if (p.transfer_receipt) {
                        actionBtn = `<a href="../../uploads/transfer_receipts/${p.transfer_receipt}" target="_blank" class="btn btn-sm btn-outline-success" style="font-size:0.75rem;"><i class="fa-solid fa-receipt me-1"></i> Lihat Struk</a>`;
                    } else {
                        actionBtn = `<small class="text-muted">Ditransfer: ${p.transferred_at}</small>`;
                    }
                }

                html += `
                    <tr>
                        <td>
                            <div class="fw-bold text-navy">${escapeHtml(p.freelancer_name)}</div>
                            <small class="text-muted">${p.freelancer_phone || p.freelancer_email}</small>
                        </td>
                        <td>
                            <div class="fw-bold text-navy">${escapeHtml(p.job_title)}</div>
                            <small class="text-muted">Disetujui: ${p.approved_at || '-'}</small>
                        </td>
                        <td class="fw-bold text-success fs-6">${formatRupiah(p.amount)}</td>
                        <td>
                            <span class="badge bg-primary px-2">${p.bank_name}</span>
                            <div class="fw-bold text-navy">${p.account_number}</div>
                            <small class="text-muted">a.n. ${escapeHtml(p.account_name)}</small>
                        </td>
                        <td>${statusBadge}</td>
                        <td>${actionBtn}</td>
                    </tr>
                `;
            });
            tbody.innerHTML = html;
        }

        function openPayoutModal(payoutId, freelancerName, bankName, accountNum, accountName, amount) {
            document.getElementById('payoutIdInput').value = payoutId;
            document.getElementById('payoutFreelancerName').innerText = freelancerName;
            document.getElementById('payoutBankDetails').innerText = `${bankName} - ${accountNum} (a.n. ${accountName})`;
            document.getElementById('payoutAmountDisplay').innerText = formatRupiah(amount);

            new bootstrap.Modal(document.getElementById('modalConfirmPayout')).show();
        }

        function loadAllJobs() {
            const tbody = document.getElementById('jobsTableBody');
            tbody.innerHTML = '<tr><td colspan="7" class="text-center py-4 text-muted"><i class="fa-solid fa-spinner fa-spin me-2"></i> Memuat lowongan...</td></tr>';

            fetch('../../api/freelance_admin_api.php?action=get_all_jobs')
            .then(r => r.json())
            .then(d => {
                if (d.status === 'success') {
                    renderJobsTable(d.jobs);
                }
            })
            .catch(err => console.error(err));
        }

        function getJobBannerUrl(img, category) {
            if (img && img.trim() !== '') {
                return `../../uploads/freelance_jobs/${img}`;
            }
            const fallbacks = {
                'Web & Pemrograman': 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=700&q=80',
                'Desain & UI/UX': 'https://images.unsplash.com/photo-1581291518655-9523c932694b?auto=format&fit=crop&w=700&q=80',
                'Penulisan & Konten': 'https://images.unsplash.com/photo-1455390582262-044cdead277a?auto=format&fit=crop&w=700&q=80',
                'Digital Marketing': 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=700&q=80',
                'Data & Administrasi': 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=700&q=80',
                'Lainnya': 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=700&q=80'
            };
            return fallbacks[category] || 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=700&q=80';
        }

        function renderJobsTable(jobs) {
            const tbody = document.getElementById('jobsTableBody');
            if (!jobs || jobs.length === 0) {
                tbody.innerHTML = '<tr><td colspan="7" class="text-center py-4 text-muted">Belum ada lowongan dibuka.</td></tr>';
                return;
            }

            let html = '';
            jobs.forEach(j => {
                let statusBadge = j.status === 'open' ? '<span class="badge bg-success">Terbuka (Open)</span>' :
                                 (j.status === 'completed' ? '<span class="badge bg-secondary">Selesai</span>' :
                                 `<span class="badge bg-light text-dark border text-capitalize">${j.status}</span>`);

                const bannerImg = getJobBannerUrl(j.image, j.category);

                html += `
                    <tr>
                        <td>
                            <div class="d-flex align-items-center gap-2">
                                <img src="${bannerImg}" alt="${escapeHtml(j.title)}" class="rounded border object-fit-cover shadow-sm flex-shrink-0" style="width: 50px; height: 38px;">
                                <div style="min-width: 0;">
                                    <div class="fw-bold text-navy text-truncate" style="max-width: 230px;">${escapeHtml(j.title)}</div>
                                    <small class="text-muted text-truncate d-block" style="max-width: 230px;">${escapeHtml(j.description)}</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-light text-navy border mb-1">${j.category}</span><br>
                            <span class="badge bg-primary-subtle text-primary text-capitalize">${j.target_audience}</span>
                        </td>
                        <td class="fw-bold text-success">${formatRupiah(j.reward_amount)}</td>
                        <td><small class="text-muted">${j.deadline}</small></td>
                        <td>
                            <span class="badge bg-light text-dark border">${j.total_applicants} Pelamar</span>
                        </td>
                        <td>${statusBadge}</td>
                        <td>
                            <div class="d-flex align-items-center gap-1">
                                <select class="form-select form-select-sm" style="width: auto; font-size: 0.75rem;" onchange="updateJobStatus(${j.id}, this.value)">
                                    <option value="open" ${j.status === 'open' ? 'selected' : ''}>Open</option>
                                    <option value="in_progress" ${j.status === 'in_progress' ? 'selected' : ''}>In Progress</option>
                                    <option value="completed" ${j.status === 'completed' ? 'selected' : ''}>Completed</option>
                                    <option value="closed" ${j.status === 'closed' ? 'selected' : ''}>Closed</option>
                                </select>
                                <a href="../../job.php?id=${j.id}" target="_blank" class="btn btn-sm btn-outline-primary" title="Lihat Halaman Publik Lowongan">
                                    <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                </a>
                                <button class="btn btn-sm btn-outline-danger" title="Hapus Lowongan" onclick="confirmDeleteJob(${j.id}, '${escapeHtml(j.title)}')">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                `;
            });
            tbody.innerHTML = html;
        }

        function updateJobStatus(jobId, newStatus) {
            const formData = new FormData();
            formData.append('action', 'update_job_status');
            formData.append('job_id', jobId);
            formData.append('status', newStatus);

            fetch('../../api/freelance_admin_api.php', { method: 'POST', body: formData })
            .then(r => r.json())
            .then(d => {
                if (d.status === 'success') {
                    Swal.fire({ icon: 'success', title: 'Status Diperbarui', timer: 1000, showConfirmButton: false });
                    loadAllJobs();
                }
            })
            .catch(err => console.error(err));
        }

        function confirmDeleteJob(jobId, jobTitle) {
            Swal.fire({
                title: 'Hapus Lowongan Ini?',
                html: `Apakah Anda yakin ingin menghapus lowongan:<br><strong>${jobTitle}</strong>?<br><small class="text-danger">Tindakan ini akan menghapus data lowongan secara permanen.</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fa-solid fa-trash-can me-1"></i> Ya, Hapus Lowongan',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Menghapus...',
                        allowOutsideClick: false,
                        didOpen: () => Swal.showLoading()
                    });

                    const formData = new FormData();
                    formData.append('action', 'delete_job');
                    formData.append('job_id', jobId);

                    fetch('../../api/freelance_admin_api.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(r => r.json())
                    .then(d => {
                        if (d.status === 'success') {
                            Swal.fire({
                                icon: 'success',
                                title: 'Terhapus!',
                                text: d.message,
                                timer: 1500,
                                showConfirmButton: false
                            });
                            loadAllJobs();
                            if (typeof loadAdminStats === 'function') loadAdminStats();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal Menghapus',
                                text: d.message || 'Terjadi kesalahan saat menghapus.'
                            });
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Gagal menghubungi server.'
                        });
                    });
                }
            });
        }

        function escapeHtml(str) {
            if (!str) return '';
            return str.replace(/&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/"/g, "&quot;").replace(/'/g, "&#039;");
        }

        function confirmLogout(e) {
            if (e) e.preventDefault();
            Swal.fire({
                title: 'Logout dari Sistem?',
                text: 'Apakah Anda yakin ingin keluar dari Office Skillance?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Logout',
                cancelButtonText: 'Batal',
                confirmButtonColor: '#0d2e5c'
            }).then((result) => {
                if (result.isConfirmed) {
                    localStorage.clear();
                    window.location.href = '../../api/logout.php';
                }
            });
        }
    </script>
</body>
</html>
