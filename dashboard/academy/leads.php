<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/index.php");
    exit();
}
if (($_SESSION['user_role'] ?? '') === 'freelancer') {
    header("Location: ../freelancer/index.php");
    exit();
}

require_once __DIR__ . '/../../config/config.php';

// Handle CSV Export
if (isset($_GET['action']) && $_GET['action'] === 'export_csv') {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=skillance_academy_leads_' . date('Y-m-d_His') . '.csv');
    
    $output = fopen('php://output', 'w');
    // UTF-8 BOM for Excel compatibility
    fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));
    
    fputcsv($output, ['ID', 'Waktu Masuk', 'Nama Lengkap', 'WhatsApp', 'Email', 'Profesi', 'Produk E-Book / Kit', 'Status']);
    
    $res = $conn->query("SELECT id, downloaded_at, full_name, whatsapp, email, profession, product_title, status FROM academy_leads ORDER BY id DESC");
    if ($res) {
        while ($row = $res->fetch_assoc()) {
            $waktu = !empty($row['downloaded_at']) ? $row['downloaded_at'] : (!empty($row['created_at']) ? $row['created_at'] : '-');
            fputcsv($output, [
                $row['id'],
                $waktu,
                $row['full_name'],
                $row['whatsapp'],
                $row['email'],
                $row['profession'],
                $row['product_title'],
                $row['status']
            ]);
        }
    }
    fclose($output);
    exit();
}

// Handle Order Approval & ZIP Unlock
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'approve_order') {
    $inv = trim($_POST['invoice_no'] ?? '');
    if (!empty($inv)) {
        $invSafe = $conn->real_escape_string($inv);
        $conn->query("UPDATE academy_orders SET status = 'verified', verified_at = NOW() WHERE invoice_no = '$invSafe'");
    }
    header("Location: leads.php?msg=order_approved");
    exit();
}

// Handle Status Update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_status') {
    $leadId = intval($_POST['lead_id'] ?? 0);
    $newStatus = trim($_POST['status'] ?? 'active');
    if ($leadId > 0 && in_array($newStatus, ['active', 'new', 'contacted', 'converted'])) {
        $up = $conn->prepare("UPDATE academy_leads SET status = ? WHERE id = ?");
        if ($up) {
            $up->bind_param('si', $newStatus, $leadId);
            $up->execute();
        }
    }
    header("Location: leads.php?msg=updated");
    exit();
}

// Search and filter query
$search = trim($_GET['search'] ?? '');
$filterProduct = trim($_GET['product'] ?? '');
$filterStatus = trim($_GET['status'] ?? '');

$sql = "SELECT * FROM academy_leads WHERE 1=1";
$params = [];
$types = "";

if (!empty($search)) {
    $sql .= " AND (full_name LIKE ? OR whatsapp LIKE ? OR email LIKE ?)";
    $like = "%$search%";
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
    $types .= "sss";
}

if (!empty($filterProduct)) {
    $sql .= " AND product_id = ?";
    $params[] = $filterProduct;
    $types .= "s";
}

if (!empty($filterStatus)) {
    $sql .= " AND status = ?";
    $params[] = $filterStatus;
    $types .= "s";
}

$sql .= " ORDER BY id DESC";

$stmt = $conn->prepare($sql);
if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$leads = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Fetch Orders for 1x24h Verification Gate
$recentOrders = [];
$pendingOrderCount = 0;
$orderQ = $conn->query("SELECT * FROM academy_orders ORDER BY id DESC LIMIT 15");
if ($orderQ) {
    while ($orow = $orderQ->fetch_assoc()) {
        $recentOrders[] = $orow;
        if ($orow['status'] === 'pending') {
            $pendingOrderCount++;
        }
    }
}

// Calculate KPI Metrics
$totalLeads = count($leads);
$mhsCount = 0;
$contactedCount = 0;
$convertedCount = 0;

$allRes = $conn->query("SELECT status, profession, COUNT(*) as cnt FROM academy_leads GROUP BY status, profession");
if ($allRes) {
    while ($r = $allRes->fetch_assoc()) {
        if (stripos($r['profession'], 'mahasiswa') !== false) {
            $mhsCount += intval($r['cnt']);
        }
        if ($r['status'] === 'contacted') $contactedCount += intval($r['cnt']);
        if ($r['status'] === 'converted') $convertedCount += intval($r['cnt']);
    }
}
$grandTotal = $conn->query("SELECT COUNT(*) as c FROM academy_leads")->fetch_assoc()['c'] ?? 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Leads E-Book & Portofolio | S-OS Skillance</title>

    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../assets/css/style.css">

    <style>
        body { background-color: #f3f4f6; overflow-x: hidden; font-family: 'Inter', sans-serif; }
        .sidebar { width: 250px; height: 100vh; position: fixed; top: 0; left: 0; background-color: var(--white); border-right: 1px solid rgba(0, 0, 0, 0.05); padding-top: 20px; z-index: 1000; transition: 0.3s; overflow-y: auto;}
        .main-content { margin-left: 250px; padding: 24px; transition: 0.3s; }
        .nav-link { color: var(--text-body); padding: 12px 20px; font-weight: 500; display: flex; align-items: center; gap: 10px; transition: 0.3s; }
        .nav-link:hover, .nav-link.active { background-color: var(--navy-subtle); color: var(--navy) !important; border-right: 3px solid var(--navy); }
        .nav-link i { width: 20px; text-align: center; }
        @media (max-width: 768px) { .sidebar { margin-left: -250px; } .sidebar.active { margin-left: 0; } .main-content { margin-left: 0; } }
        .card-custom { border: none; box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04); border-radius: 12px; background: white; }
        .stat-icon { width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
    </style>
</head>
<body>

    <?php
    $activeMenu = 'academy';
    include __DIR__ . '/../includes/sidebar.php';
    ?>

    <div class="main-content">
        <!-- Header -->
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-3">
            <div>
                <h4 class="fw-bold text-navy mb-1"><i class="fa-solid fa-graduation-cap text-gold me-2"></i> CRM Leads E-Book & Calon Pembeli</h4>
                <p class="text-muted small mb-0">Database calon pembeli yang mengunduh sampel bab gratis di Skillance Academy.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="leads.php?action=export_csv" class="btn btn-success fw-bold rounded-pill px-3 py-2 shadow-sm text-white">
                    <i class="fa-solid fa-file-excel me-1"></i> Ekspor Data CSV
                </a>
                <a href="https://academy.skillance.cloud/projects.php" target="_blank" class="btn btn-outline-navy fw-bold rounded-pill px-3 py-2">
                    <i class="fa-solid fa-arrow-up-right-from-square me-1"></i> Lihat Halaman E-Book
                </a>
            </div>
        </div>

        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'updated'): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-3 small" role="alert">
                <i class="fa-solid fa-check-circle me-1"></i> Status prospek berhasil diperbarui.
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Stat Cards -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="card card-custom p-3 h-100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                            <i class="fa-solid fa-users"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.68rem;">Total Prospek Masuk</small>
                            <h4 class="fw-bold text-navy mb-0"><?= number_format($grandTotal) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card card-custom p-3 h-100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-info bg-opacity-10 text-info">
                            <i class="fa-solid fa-user-graduate"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.68rem;">Kategori Mahasiswa</small>
                            <h4 class="fw-bold text-info mb-0"><?= number_format($mhsCount) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card card-custom p-3 h-100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                            <i class="fa-solid fa-comments"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.68rem;">Sudah Di-Follow Up</small>
                            <h4 class="fw-bold text-warning mb-0"><?= number_format($contactedCount) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card card-custom p-3 h-100">
                    <div class="d-flex align-items-center gap-3">
                        <div class="stat-icon bg-success bg-opacity-10 text-success">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </div>
                        <div>
                            <small class="text-muted text-uppercase fw-bold" style="font-size: 0.68rem;">Closing / Membeli</small>
                            <h4 class="fw-bold text-success mb-0"><?= number_format($convertedCount) ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION VERIFIKASI PEMBAYARAN 1X24 JAM -->
        <div class="card card-custom p-4 mb-4 border-start border-4 border-warning shadow-sm">
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
                <div>
                    <span class="badge bg-warning text-dark fw-bold px-3 py-1.5 rounded-pill mb-1">
                        <i class="fa-solid fa-clock-rotate-left me-1"></i> VERIFIKASI 1X24 JAM
                    </span>
                    <h5 class="fw-bold text-navy mb-0">Antrean Konfirmasi Pembayaran QRIS & Akses Download ZIP</h5>
                    <small class="text-muted">Daftar transaksi masuk yang menunggu validasi admin untuk membuka tautan unduhan File ZIP pembeli.</small>
                </div>
                <div>
                    <span class="badge bg-navy text-gold px-3 py-2 rounded-pill font-monospace fs-6">
                        <?= $pendingOrderCount ?> Menunggu Verifikasi
                    </span>
                </div>
            </div>

            <?php if (isset($_GET['msg']) && $_GET['msg'] === 'order_approved'): ?>
                <div class="alert alert-success py-2 px-3 small rounded-3 mb-3">
                    <i class="fa-solid fa-circle-check text-success me-1"></i> <strong>Pembayaran Berhasil Dikonfirmasi!</strong> Akses unduhan File ZIP pembeli telah dibuka secara otomatis.
                </div>
            <?php endif; ?>

            <?php if (empty($recentOrders)): ?>
                <div class="p-3 bg-light rounded-3 text-center text-muted small">
                    <i class="fa-solid fa-receipt me-1"></i> Belum ada transaksi QRIS yang tercatat di sistem.
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-sm table-hover align-middle mb-0 small">
                        <thead class="table-light">
                            <tr>
                                <th>Invoice</th>
                                <th>Tanggal</th>
                                <th>Pembeli & Kontak</th>
                                <th>Produk / Paket</th>
                                <th>Nominal</th>
                                <th>Status Pembayaran</th>
                                <th class="text-end">Aksi Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recentOrders as $ord): 
                                $isVerified = ($ord['status'] === 'verified');
                                $ordWa = preg_replace('/[^0-9]/', '', $ord['buyer_whatsapp'] ?? '082291700778');
                                $waApprovalMsg = rawurlencode("Halo Kak " . ($ord['buyer_name'] ?? 'Pelanggan') . ", pembayaran Anda untuk No. Invoice " . $ord['invoice_no'] . " (" . $ord['product_title'] . ") telah kami konfirmasi! Akses unduh File ZIP Anda sekarang telah dibuka seumur hidup. Silakan cek dan download di https://academy.skillance.cloud/projects.php. Terima kasih!");
                            ?>
                                <tr>
                                    <td><strong class="font-monospace text-navy"><?= htmlspecialchars($ord['invoice_no']) ?></strong></td>
                                    <td class="text-muted small"><?= date('d/m/Y H:i', strtotime($ord['created_at'])) ?></td>
                                    <td>
                                        <div class="fw-bold text-navy"><?= htmlspecialchars($ord['buyer_name'] ?? 'Pelanggan') ?></div>
                                        <small class="text-muted"><?= htmlspecialchars($ord['buyer_whatsapp'] ?? '-') ?></small>
                                    </td>
                                    <td><span class="badge bg-light text-navy border"><?= htmlspecialchars($ord['product_title']) ?></span></td>
                                    <td class="fw-bold text-primary">Rp <?= number_format($ord['nominal']) ?></td>
                                    <td>
                                        <?php if ($isVerified): ?>
                                            <span class="badge bg-success"><i class="fa-solid fa-circle-check me-1"></i> Terverifikasi</span>
                                        <?php else: ?>
                                            <span class="badge bg-warning text-dark"><i class="fa-solid fa-clock me-1"></i> Menunggu Konfirmasi</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-end">
                                        <?php if (!$isVerified): ?>
                                            <form method="POST" style="display:inline-block;">
                                                <input type="hidden" name="action" value="approve_order">
                                                <input type="hidden" name="invoice_no" value="<?= htmlspecialchars($ord['invoice_no']) ?>">
                                                <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 fw-bold">
                                                    <i class="fa-solid fa-check me-1"></i> Approve
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            <a href="https://wa.me/<?= $ordWa ?>?text=<?= $waApprovalMsg ?>" target="_blank" class="btn btn-sm btn-outline-success rounded-pill px-3 fw-bold">
                                                <i class="fa-brands fa-whatsapp me-1"></i> Notif WA
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <!-- Filter Form -->
        <div class="card card-custom p-3 mb-4">
            <form method="GET" class="row g-2 align-items-center">
                <div class="col-md-5">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Cari nama, WhatsApp, atau email..." value="<?= htmlspecialchars($search) ?>">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select form-select-sm">
                        <option value="">-- Semua Status --</option>
                        <option value="active" <?= $filterStatus === 'active' ? 'selected' : '' ?>>Baru (Active)</option>
                        <option value="contacted" <?= $filterStatus === 'contacted' ? 'selected' : '' ?>>Sudah Dihubungi</option>
                        <option value="converted" <?= $filterStatus === 'converted' ? 'selected' : '' ?>>Closing Membeli</option>
                    </select>
                </div>
                <div class="col-md-4 d-flex gap-2">
                    <button type="submit" class="btn btn-navy btn-sm fw-bold px-3 rounded-pill">
                        <i class="fa-solid fa-filter me-1"></i> Filter
                    </button>
                    <?php if (!empty($search) || !empty($filterStatus)): ?>
                        <a href="leads.php" class="btn btn-light btn-sm rounded-pill text-muted">Reset</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        <!-- Leads Table -->
        <div class="card card-custom overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0 small">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3 py-3">Tanggal</th>
                            <th>Nama Prospek</th>
                            <th>WhatsApp</th>
                            <th>Email</th>
                            <th>Produk Diminati</th>
                            <th>Status Follow-Up</th>
                            <th class="text-end pe-3">Aksi Chat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($leads)): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fa-solid fa-inbox fs-2 mb-2 d-block opacity-50"></i>
                                    Belum ada data prospek yang sesuai filter pencarian.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($leads as $l): 
                                $cleanWa = preg_replace('/[^0-9]/', '', $l['whatsapp']);
                                $waMsg = rawurlencode("Halo Kak " . $l['full_name'] . ", salam kenal dari Skillance Academy! Kami melihat Kakak baru saja mengunduh sampel bab gratis e-book '" . $l['product_title'] . "'. Apakah materinya sudah sempat dibaca? Jika ada pertanyaan seputar source code atau diskon mahasiswa, silakan kabari ya Kak.");
                                $waUrl = "https://wa.me/" . $cleanWa . "?text=" . $waMsg;
                            ?>
                                <tr>
                                    <td class="ps-3 text-muted">
                                        <?php 
                                            $rawDate = !empty($l['downloaded_at']) ? $l['downloaded_at'] : (!empty($l['created_at']) ? $l['created_at'] : null);
                                            $formattedDate = $rawDate ? date('d/m/Y H:i', strtotime($rawDate)) : '-';
                                        ?>
                                        <span class="small fw-semibold text-dark"><i class="fa-regular fa-clock me-1 text-muted"></i><?= $formattedDate ?></span>
                                    </td>
                                    <td>
                                        <strong class="d-block text-navy"><?= htmlspecialchars($l['full_name']) ?></strong>
                                        <span class="badge bg-light text-secondary border" style="font-size: 0.65rem;"><?= htmlspecialchars($l['profession']) ?></span>
                                    </td>
                                    <td>
                                        <a href="<?= $waUrl ?>" target="_blank" class="fw-bold text-success text-decoration-none d-block">
                                            <i class="fa-brands fa-whatsapp me-1"></i> <?= htmlspecialchars($l['whatsapp']) ?>
                                        </a>
                                        <?php if (!empty($l['is_wa_verified'])): ?>
                                            <span class="badge bg-success-subtle text-success border border-success-subtle d-inline-flex align-items-center gap-1 mt-1" style="font-size: 0.65rem;">
                                                <i class="fa-solid fa-circle-check"></i> WA Terverifikasi (<?= htmlspecialchars($l['wa_provider'] ?: 'Aktif') ?>)
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle d-inline-flex align-items-center gap-1 mt-1" style="font-size: 0.65rem;">
                                                <i class="fa-solid fa-triangle-exclamation"></i> Belum Terverifikasi
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-muted">
                                        <?= htmlspecialchars($l['email'] ?: '-') ?>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary fw-semibold" style="max-width: 220px; white-space: normal; text-align: left;">
                                            <?= htmlspecialchars($l['product_title']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <form method="POST" class="d-inline">
                                            <input type="hidden" name="action" value="update_status">
                                            <input type="hidden" name="lead_id" value="<?= $l['id'] ?>">
                                            <select name="status" class="form-select form-select-sm py-0 px-2" style="font-size: 0.75rem; width: auto;" onchange="this.form.submit()">
                                                <option value="active" <?= in_array($l['status'], ['active', 'new']) ? 'selected' : '' ?>>🔵 Baru</option>
                                                <option value="contacted" <?= $l['status'] === 'contacted' ? 'selected' : '' ?>>🟡 Sudah Chat</option>
                                                <option value="converted" <?= $l['status'] === 'converted' ? 'selected' : '' ?>>🟢 Closing</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="text-end pe-3">
                                        <a href="<?= $waUrl ?>" target="_blank" class="btn btn-sm btn-success rounded-pill px-3 py-1 fw-bold text-white shadow-sm" style="font-size: 0.75rem;">
                                            <i class="fa-brands fa-whatsapp me-1"></i> Follow-Up
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
