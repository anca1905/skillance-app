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
    <title>Project | S-OS Skillance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <style>
        /* Sama seperti Dashboard */
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
    </style>
</head>

<body>

    <nav class="sidebar shadow-sm" id="sidebar">
        <div class="px-4 mb-4 d-flex align-items-center gap-2">
            <i class="fa-solid fa-code text-gold fs-4"></i>
            <div>
                <h5 class="fw-bold text-navy mb-0 ls-2">SKILLANCE</h5><small class="text-muted"
                    style="font-size: 0.65rem;">OFFICE SYSTEM</small>
            </div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="../" class="nav-link"><i class="fa-solid fa-chart-line"></i> Dashboard</a>
            </li>
            <li class="nav-item"><a href="#" class="nav-link active"><i class="fa-solid fa-briefcase"></i> Project</a>
            </li>
            <li class="nav-item"><a href="../finance" class="nav-link"><i class="fa-solid fa-wallet"></i> Keuangan</a>
            </li>
            <li class="nav-item"><a href="../investment/index.php" class="nav-link"><i
                        class="fa-solid fa-hand-holding-dollar"></i> Investasi Admin</a></li>
            <li class="nav-item"><a href="../hrd/index.php" class="nav-link text-primary"><i
                        class="fa-solid fa-users"></i> HRD</a></li>
                                    <li class="nav-item"><a href="../	eam/index.php" class="nav-link"><i class="fa-solid fa-people-group"></i> Manajemen Tim</a></li>
            <li class="nav-item">
                <a href="../profile.php" class="nav-link text-warning">
                    <i class="fa-solid fa-user-gear"></i> Profil Saya
                </a>
            </li>
            <li class="nav-item mt-4"><a href="#" class="nav-link text-danger" onclick="logout()"><i
                        class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <button class="btn btn-navy btn-sm d-md-none me-2" onclick="toggleSidebar()"><i
                        class="fa-solid fa-bars"></i></button>
                <h4 class="fw-bold text-navy mb-0 d-inline-block">Manajemen Project</h4>
            </div>
            <button class="btn btn-navy text-white btn-sm shadow-sm" data-bs-toggle="modal"
                data-bs-target="#addProjectModal">
                <i class="fa-solid fa-plus me-1"></i> Project Baru
            </button>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Nama Project</th>
                                <th>Klien</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th>Pembayaran</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="projectList">
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted"><i
                                        class="fa-solid fa-spinner fa-spin"></i> Memuat data...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addProjectModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-navy text-white">
                    <h6 class="modal-title fw-bold text-white">Tambah Project Baru</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="projectForm">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold">NAMA PROJECT</label>
                            <input type="text" id="pName" class="form-control"
                                placeholder="Contoh: Website Profil Sekolah" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted fw-bold">PLATFORM</label>
                                <select id="pPlatform" class="form-select">
                                    <option>Web App (PHP Native)</option>
                                    <option>Web App (Laravel/CodeIgniter)</option>
                                    <option>Web App (Node/React/Vue)</option>
                                    <option>Buku/Modul Digital</option>
                                    <option>Wordpress / CMS</option>
                                    <option>Mobile App (Android/iOS)</option>
                                    <option>UI/UX Design</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted fw-bold">DEADLINE</label>
                                <input type="date" id="pDeadline" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted fw-bold">NAMA KLIEN</label>
                                <input type="text" id="pClient" class="form-control" placeholder="Klien" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted fw-bold">KONTAK KLIEN</label>
                                <input type="text" id="pClientContact" class="form-control" placeholder="No HP/WA">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted fw-bold">INSTANSI</label>
                                <input type="text" id="pClientInst" class="form-control"
                                    placeholder="Nama Perusahaan/Instansi">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted fw-bold">NILAI PROJECT (Rp)</label>
                                <input type="number" id="pPrice" class="form-control" placeholder="Contoh: 5000000"
                                    min="0" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="small text-muted fw-bold">STATUS</label>
                                <select id="pStatus" class="form-select">
                                    <option value="Development">Development</option>
                                    <option value="Testing">Testing</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="small text-muted fw-bold">PEMBAYARAN</label>
                                <select id="pPayment" class="form-select">
                                    <option value="Belum Bayar">Belum Bayar</option>
                                    <option value="DP (Sebagian Lunas)">DP (Sebagian Lunas)</option>
                                    <option value="Lunas">Lunas</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="small text-muted fw-bold">NOMINAL DBYAR (Rp)</label>
                                <input type="number" id="pDpAmount" class="form-control" placeholder="0" min="0"
                                    value="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-navy text-white">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Project Modal -->
    <div class="modal fade" id="editProjectModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-navy text-white">
                    <h6 class="modal-title fw-bold text-white">Edit Project</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="editProjectForm">
                    <input type="hidden" id="editId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold">NAMA PROJECT</label>
                            <input type="text" id="editName" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted fw-bold">PLATFORM</label>
                                <select id="editPlatform" class="form-select">
                                    <option>Web App (PHP Native)</option>
                                    <option>Web App (Laravel/CodeIgniter)</option>
                                    <option>Web App (Node/React/Vue)</option>
                                    <option>Buku/Modul Digital</option>
                                    <option>Wordpress / CMS</option>
                                    <option>Mobile App (Android/iOS)</option>
                                    <option>UI/UX Design</option>
                                    <option>Lainnya</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted fw-bold">DEADLINE</label>
                                <input type="date" id="editDeadline" class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted fw-bold">NAMA KLIEN</label>
                                <input type="text" id="editClient" class="form-control" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted fw-bold">KONTAK KLIEN</label>
                                <input type="text" id="editClientContact" class="form-control" placeholder="No HP/WA">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted fw-bold">INSTANSI</label>
                                <input type="text" id="editClientInst" class="form-control"
                                    placeholder="Nama Perusahaan/Instansi">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted fw-bold">NILAI PROJECT BASE (Rp)</label>
                                <input type="number" id="editPrice" class="form-control" min="0" required>
                            </div>
                        </div>

                        <!-- Dynamic Addons Section -->
                        <div class="mb-3 px-2 py-2 bg-light rounded border">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label class="small text-muted fw-bold mb-0">BIAYA TAMBAHAN / REVISI</label>
                                <button type="button" class="btn btn-sm btn-outline-secondary" id="btnAddAddon"><i
                                        class="fa-solid fa-plus"></i> Tambah</button>
                            </div>
                            <div id="addonsContainer">
                                <!-- Addon rows go here dynamically -->
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="small text-muted fw-bold">STATUS</label>
                                <select id="editStatus" class="form-select">
                                    <option value="Development">Development</option>
                                    <option value="Testing">Testing</option>
                                    <option value="On Hold">On Hold</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="small text-muted fw-bold">PEMBAYARAN</label>
                                <select id="editPayment" class="form-select">
                                    <option value="Belum Bayar">Belum Bayar</option>
                                    <option value="DP (Sebagian Lunas)">DP (Sebagian Lunas)</option>
                                    <option value="Lunas">Lunas</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="small text-muted fw-bold">NOMINAL DBYAR (Rp)</label>
                                <input type="number" id="editDpAmount" class="form-control" min="0" value="0" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-navy text-white">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Project Modal (Dokumentasi) -->
    <div class="modal fade" id="viewProjectModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-navy text-white border-0">
                    <h6 class="modal-title fw-bold text-white"><i class="fa-solid fa-folder-open me-2"></i>Dokumentasi
                        Project</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body bg-light">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body">
                            <h5 class="fw-bold text-navy" id="viewName">Loading...</h5>
                            <span class="badge bg-secondary mb-3" id="viewPlatform">...</span>

                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td width="40%" class="text-muted small">Timeline</td>
                                    <td class="fw-bold" id="viewTimeline">...</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small">Klien</td>
                                    <td class="fw-bold" id="viewClientName">...</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small">Instansi</td>
                                    <td class="fw-bold" id="viewClientInst">...</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small">Kontak</td>
                                    <td class="fw-bold" id="viewClientContact">...</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small">Nilai Project Utama</td>
                                    <td class="fw-bold" id="viewPrice">...</td>
                                </tr>
                                <tbody id="viewAddonsContainer">
                                    <!-- Dynamic addon rows will be injected here -->
                                </tbody>
                                <tr class="border-top">
                                    <td class="text-muted small pt-2">Total Project Base</td>
                                    <td class="fw-bold pt-2" id="viewTotalPrice">...</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small">Telah Dibayar</td>
                                    <td class="fw-bold text-success" id="viewDpAmount">...</td>
                                </tr>
                                <tr class="border-top">
                                    <td class="text-muted small pt-2">Sisa Tagihan</td>
                                    <td class="fw-bold text-danger pt-2" id="viewBalance">...</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <div class="bg-white p-3 rounded shadow-sm text-center border h-100">
                                <small class="text-muted d-block mb-1">Status Progres</small>
                                <div id="viewStatusBadge">...</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white p-3 rounded shadow-sm text-center border h-100">
                                <small class="text-muted d-block mb-1">Keuangan</small>
                                <div id="viewPaymentBadge">...</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 bg-light d-flex justify-content-between rounded-bottom">
                    <div>
                        <a href="#" class="btn btn-outline-navy btn-sm" id="btnCetakInvoice" target="_blank"><i
                                class="fa-solid fa-file-invoice me-1"></i> Cetak Invoice</a>
                        <a href="#" class="btn btn-outline-navy btn-sm" id="btnCetakMOU" target="_blank"><i
                                class="fa-solid fa-handshake me-1"></i> Cetak MOU</a>
                    </div>
                    <button type="button" class="btn btn-navy text-white" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../../assets/js/project.js?v=2"></script>
    <script>
        // Helper Sidebar & Logout (Sama utk semua halaman)
        function toggleSidebar() { document.getElementById('sidebar').classList.toggle('active'); }
        function logout() {
            Swal.fire({ title: 'Logout?', icon: 'warning', showCancelButton: true, confirmButtonColor: '#0d2e5c' }).then(r => {
                if (r.isConfirmed) { localStorage.clear(); window.location.href = '../../auth/index.html'; }
            });
        }
    </script>
</body>

</html>


