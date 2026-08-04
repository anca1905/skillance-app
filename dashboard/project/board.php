<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/index.php");
    exit();
}

require '../../config/config.php';

$project_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($project_id === 0) {
    header("Location: index.php");
    exit();
}

// Fetch project info
$stmt = $conn->prepare("SELECT name FROM projects WHERE id = ?");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header("Location: index.php");
    exit();
}
$project = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Board - <?php echo htmlspecialchars($project['name']); ?> | S-OS Skillance</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
            height: 100vh;
            display: flex;
            flex-direction: column;
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

        .nav-link i { width: 20px; text-align: center; }

        @media (max-width: 768px) {
            .sidebar { margin-left: -250px; }
            .sidebar.active { margin-left: 0; }
            .main-content { margin-left: 0; }
        }

        /* Kanban Board Styles */
        .board-container {
            display: flex;
            gap: 1.5rem;
            overflow-x: auto;
            flex-grow: 1;
            padding-bottom: 20px;
            align-items: flex-start;
        }

        .board-column {
            background: #eef2f6;
            border-radius: 12px;
            width: 320px;
            min-width: 320px;
            max-height: 100%;
            display: flex;
            flex-direction: column;
        }

        .board-header {
            padding: 15px;
            font-weight: 600;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid transparent;
        }
        
        .board-header.backlog { border-bottom-color: #6c757d; }
        .board-header.todo { border-bottom-color: #0d6efd; }
        .board-header.development { border-bottom-color: #fd7e14; }
        .board-header.testing { border-bottom-color: #0dcaf0; }
        .board-header.bug { border-bottom-color: #dc3545; }
        .board-header.selesai { border-bottom-color: #198754; }

        .task-list {
            padding: 10px;
            flex-grow: 1;
            overflow-y: auto;
            min-height: 50px;
        }

        .task-card {
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 12px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
            cursor: grab;
            border-left: 4px solid transparent;
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .task-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        
        .task-card:active {
            cursor: grabbing;
        }

        .task-card.priority-high { border-left-color: #dc3545; }
        .task-card.priority-normal { border-left-color: #ffc107; }
        .task-card.priority-low { border-left-color: #198754; }

        .task-title {
            font-weight: 600;
            color: #2b3445;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .task-tags {
            margin-bottom: 10px;
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
        }

        .task-tag {
            font-size: 0.7rem;
            padding: 2px 8px;
            border-radius: 20px;
            background: #e2e8f0;
            color: #475569;
        }

        .task-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
            font-size: 0.8rem;
            color: #6c757d;
        }

        .assignee-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background-color: var(--navy);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.7rem;
        }
        
        .sortable-ghost {
            opacity: 0.4;
            background-color: #f8f9fa;
        }
        
        .sortable-drag {
            cursor: grabbing !important;
        }
        
        /* Custom Scrollbar for horizontal board */
        .board-container::-webkit-scrollbar {
            height: 8px;
        }
        .board-container::-webkit-scrollbar-track {
            background: #f1f1f1; 
            border-radius: 10px;
        }
        .board-container::-webkit-scrollbar-thumb {
            background: #c1c1c1; 
            border-radius: 10px;
        }
        .board-container::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8; 
        }
    </style>
</head>
<body>

    <nav class="sidebar shadow-sm" id="sidebar">
        <div class="px-4 mb-4 d-flex align-items-center gap-2">
            <i class="fa-solid fa-code text-gold fs-4"></i>
            <div>
                <h5 class="fw-bold text-navy mb-0 ls-2">SKILLANCE</h5><small class="text-muted" style="font-size: 0.65rem;">OFFICE SYSTEM</small>
            </div>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="../" class="nav-link"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
            <li class="nav-item"><a href="index.php" class="nav-link active"><i class="fa-solid fa-briefcase"></i> Project</a></li>
            <li class="nav-item"><a href="../finance" class="nav-link"><i class="fa-solid fa-wallet"></i> Keuangan</a></li>
            <li class="nav-item"><a href="../investment/index.php" class="nav-link"><i class="fa-solid fa-hand-holding-dollar"></i> Investasi Admin</a></li>
            <li class="nav-item"><a href="../hrd/index.php" class="nav-link text-primary"><i class="fa-solid fa-users"></i> HRD</a></li>
            <li class="nav-item"><a href="../team/index.php" class="nav-link"><i class="fa-solid fa-people-group"></i> Manajemen Tim</a></li>
            <li class="nav-item"><a href="../payroll/index.php" class="nav-link"><i class="fa-solid fa-money-check-dollar"></i> Penggajian</a></li>
            <li class="nav-item"><a href="../profile.php" class="nav-link text-warning"><i class="fa-solid fa-user-gear"></i> Profil Saya</a></li>
            <li class="nav-item mt-4"><a href="#" class="nav-link text-danger" onclick="logout()"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
        </ul>
    </nav>

    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <button class="btn btn-navy btn-sm d-md-none me-2" onclick="toggleSidebar()"><i class="fa-solid fa-bars"></i></button>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-1">
                        <li class="breadcrumb-item"><a href="index.php" class="text-decoration-none text-muted">Project</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Board</li>
                    </ol>
                </nav>
                <h4 class="fw-bold text-navy mb-0 d-inline-block"><?php echo htmlspecialchars($project['name']); ?></h4>
            </div>
            <button class="btn btn-navy text-white btn-sm shadow-sm" onclick="openTaskModal()">
                <i class="fa-solid fa-plus me-1"></i> Task Baru
            </button>
        </div>

        <input type="hidden" id="currentProjectId" value="<?php echo $project_id; ?>">

        <div class="board-container" id="boardContainer">
            <!-- Backlog -->
            <div class="board-column">
                <div class="board-header backlog">
                    <span><i class="fa-solid fa-list text-secondary me-2"></i>Backlog</span>
                    <span class="badge bg-secondary rounded-pill" id="count-Backlog">0</span>
                </div>
                <div class="task-list" id="col-Backlog" data-status="Backlog"></div>
            </div>

            <!-- To Do -->
            <div class="board-column">
                <div class="board-header todo">
                    <span><i class="fa-regular fa-circle text-primary me-2"></i>To Do</span>
                    <span class="badge bg-primary rounded-pill" id="count-To Do">0</span>
                </div>
                <div class="task-list" id="col-To Do" data-status="To Do"></div>
            </div>

            <!-- Development -->
            <div class="board-column">
                <div class="board-header development">
                    <span><i class="fa-solid fa-code text-warning me-2"></i>Development</span>
                    <span class="badge bg-warning rounded-pill text-dark" id="count-Development">0</span>
                </div>
                <div class="task-list" id="col-Development" data-status="Development"></div>
            </div>

            <!-- Testing -->
            <div class="board-column">
                <div class="board-header testing">
                    <span><i class="fa-solid fa-vial text-info me-2"></i>Testing</span>
                    <span class="badge bg-info rounded-pill" id="count-Testing">0</span>
                </div>
                <div class="task-list" id="col-Testing" data-status="Testing"></div>
            </div>

            <!-- Bug & Improvement -->
            <div class="board-column">
                <div class="board-header bug">
                    <span><i class="fa-solid fa-bug text-danger me-2"></i>Bug & Improvement</span>
                    <span class="badge bg-danger rounded-pill" id="count-Bug & Improvement">0</span>
                </div>
                <div class="task-list" id="col-Bug & Improvement" data-status="Bug & Improvement"></div>
            </div>

            <!-- Selesai -->
            <div class="board-column">
                <div class="board-header selesai">
                    <span><i class="fa-solid fa-circle-check text-success me-2"></i>Selesai</span>
                    <span class="badge bg-success rounded-pill" id="count-Selesai">0</span>
                </div>
                <div class="task-list" id="col-Selesai" data-status="Selesai"></div>
            </div>
        </div>
    </div>

    <!-- Task Modal -->
    <div class="modal fade" id="taskModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-navy text-white">
                    <h6 class="modal-title fw-bold text-white" id="taskModalTitle">Tambah Task</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="taskForm">
                    <input type="hidden" id="taskId">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="small text-muted fw-bold">NAMA TASK</label>
                            <input type="text" id="tTitle" class="form-control" placeholder="Contoh: Fitur Export Riwayat Presensi Guru" required>
                        </div>
                        <div class="mb-3">
                            <label class="small text-muted fw-bold">DESKRIPSI / LOKASI FITUR</label>
                            <textarea id="tDescription" class="form-control" rows="4" placeholder="Deskripsi lengkap mengenai task ini..."></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="small text-muted fw-bold">STATUS</label>
                                <select id="tStatus" class="form-select">
                                    <option value="Backlog">Backlog</option>
                                    <option value="To Do">To Do</option>
                                    <option value="Development">Development</option>
                                    <option value="Testing">Testing</option>
                                    <option value="Bug & Improvement">Bug & Improvement</option>
                                    <option value="Selesai">Selesai</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="small text-muted fw-bold">PRIORITAS</label>
                                <select id="tPriority" class="form-select">
                                    <option value="Low">Low (Rendah)</option>
                                    <option value="Normal" selected>Normal</option>
                                    <option value="High">High (Tinggi)</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="small text-muted fw-bold">TENGGAT WAKTU (DUE DATE)</label>
                                <input type="date" id="tDueDate" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted fw-bold">ASSIGNEE (PENGERJA)</label>
                                <select id="tAssignee" class="form-select">
                                    <option value="">-- Pilih Anggota --</option>
                                    <!-- Dynamic from JS -->
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="small text-muted fw-bold">TAGS (Pisahkan dengan koma)</label>
                                <input type="text" id="tTags" class="form-control" placeholder="export, presensi, ui">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-between">
                        <button type="button" class="btn btn-danger btn-sm d-none" id="btnDeleteTask" onclick="deleteTask()"><i class="fa-solid fa-trash"></i> Hapus</button>
                        <div>
                            <button type="button" class="btn btn-light border" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-navy text-white">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- SortableJS -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    
    <script src="../../assets/js/board.js"></script>
    <script>
        function toggleSidebar() { document.getElementById('sidebar').classList.toggle('active'); }
        function logout() {
            Swal.fire({ title: 'Logout?', icon: 'warning', showCancelButton: true, confirmButtonColor: '#0d2e5c' }).then(r => {
                if (r.isConfirmed) { localStorage.clear(); window.location.href = '../../auth/index.html'; }
            });
        }
    </script>
</body>
</html>
