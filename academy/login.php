<?php
session_start();
require_once __DIR__ . '/config/config.php';

// Jika sudah login di Academy, langsung arahkan ke my-learning
if (!empty($_SESSION['user_id'])) {
    $target = $_GET['redirect'] ?? 'my-learning.php';
    header("Location: " . $target);
    exit();
}

$errorMsg = '';
$redirectTarget = $_GET['redirect'] ?? 'my-learning.php';
$action = $_REQUEST['action'] ?? '';
$account = $_REQUEST['account'] ?? '';

// Proses Login: Baik melalui tombol Google 1-klik (GET/POST) maupun formulir email kampus (POST)
if ($action === 'google' || $action === 'quick_google' || $action === 'login_google' || $_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = 'freelancer';
    $userType = 'mahasiswa';

    if ($action === 'google' || $action === 'quick_google' || $action === 'login_google') {
        if ($account === 'skillance') {
            $email = 'skillance.id@gmail.com';
            $name  = 'Skillance Official';
            $role  = 'freelancer';
        } else {
            // Default Google Account: arsyadhijrah49720@gmail.com (Muh. Arsyad Ramsi)
            $email = 'arsyadhijrah49720@gmail.com';
            $name  = 'MUH. ARSYAD RAMSI';
            $role  = 'admin';
        }
    } else {
        // Formulir email kampus
        $email = strtolower(trim($_POST['email'] ?? ''));
        $name  = trim($_POST['name'] ?? '');
    }

    $assignedRoles = ($role === 'admin') ? 'admin,dekanat,ormawa,mahasiswa,freelancer' : 'mahasiswa,freelancer';
    $partnerSlug = 'msc-usn';

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = 'Mohon masukkan format alamat email yang valid.';
    } else {
        $userId = null;
        $photo = null;

        // Cek dan daftarkan di Database jika koneksi DB aktif
        if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
            $stmt = $conn->prepare("SELECT id, name, email, role, user_type, assigned_roles, partner_slug, photo FROM `users` WHERE `email` = ? LIMIT 1");
            if ($stmt) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res && $res->num_rows > 0) {
                    $u = $res->fetch_assoc();
                    $userId = (int)$u['id'];
                    $name   = !empty($u['name']) ? $u['name'] : (!empty($name) ? $name : explode('@', $email)[0]);
                    $role   = $u['role'] ?? $role;
                    $userType = $u['user_type'] ?? $userType;
                    $assignedRoles = $u['assigned_roles'] ?? $assignedRoles;
                    $partnerSlug = $u['partner_slug'] ?? $partnerSlug;
                    $photo  = $u['photo'] ?? null;
                } else {
                    // Daftarkan sebagai Pengguna Baru di Database
                    $name = !empty($name) ? $name : ucwords(str_replace(['.', '_', '-'], ' ', explode('@', $email)[0]));
                    $photo = 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=0d2e5c&color=fca311';
                    $ins = $conn->prepare("INSERT INTO `users` (`name`, `email`, `role`, `user_type`, `assigned_roles`, `partner_slug`, `photo`) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    if ($ins) {
                        $ins->bind_param("sssssss", $name, $email, $role, $userType, $assignedRoles, $partnerSlug, $photo);
                        if ($ins->execute()) {
                            $userId = $ins->insert_id;
                        }
                        $ins->close();
                    }
                }
                $stmt->close();
            }
        }

        // Fallback User ID jika offline
        if (!$userId) {
            $userId = ($email === 'arsyadhijrah49720@gmail.com') ? 4 : rand(100, 999);
            $name = !empty($name) ? $name : explode('@', $email)[0];
        }

        if (empty($photo)) {
            $photo = 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=0d2e5c&color=fca311';
        }

        // Set Session Lengkap di Subdomain Academy
        $_SESSION['user_id']        = $userId;
        $_SESSION['user_name']      = $name;
        $_SESSION['user_email']     = $email;
        $_SESSION['user_role']      = $role;
        $_SESSION['user_photo']     = $photo;
        $_SESSION['user_type']      = $userType;
        $_SESSION['assigned_roles'] = $assignedRoles;
        $_SESSION['partner_slug']   = $partnerSlug;

        $_SESSION['academy_user_id']    = $userId;
        $_SESSION['academy_user_name']  = $name;
        $_SESSION['academy_user_email'] = $email;
        $_SESSION['academy_user_role']  = $role;
        $_SESSION['academy_user_photo'] = $photo;
        $_SESSION['academy_user_type']  = $userType;

        // Otomatis daftar enrollment track dasar jika DB aktif
        if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
            $trackCheck = $conn->prepare("SELECT id FROM `academy_enrollments` WHERE `user_id` = ? LIMIT 1");
            if ($trackCheck) {
                $trackCheck->bind_param("i", $userId);
                $trackCheck->execute();
                if ($trackCheck->get_result()->num_rows === 0) {
                    $insTrack = $conn->prepare("INSERT INTO `academy_enrollments` (`user_id`, `track_id`, `progress_percent`, `status`) VALUES (?, 'web_frontend', 10, 'learning')");
                    if ($insTrack) {
                        $insTrack->bind_param("i", $userId);
                        $insTrack->execute();
                        $insTrack->close();
                    }
                }
                $trackCheck->close();
            }
        }

        // Arahkan ke halaman tujuan
        $validTargets = ['my-learning.php', 'index.php', 'partner-portal.php', 'exam.php', 'bootcamp.php'];
        $cleanTarget = 'my-learning.php';
        if (!empty($redirectTarget)) {
            $base = basename(parse_url($redirectTarget, PHP_URL_PATH));
            if (in_array($base, $validTargets)) {
                $cleanTarget = ltrim($redirectTarget, '/');
            }
        }

        $sep = (strpos($cleanTarget, '?') !== false) ? '&' : '?';
        header("Location: " . $cleanTarget . $sep . "logged_in=1");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Kelas & Dasbor Siswa | Skillance Academy Indonesia</title>

    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --navy: #0d2e5c;
            --navy-dark: #071a35;
            --gold: #fca311;
            --gold-hover: #e5930e;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #071a35 0%, #0d2e5c 60%, #1e3a8a 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px 15px;
            margin: 0;
            color: #1e293b;
        }

        .login-card {
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            border-top: 5px solid var(--gold);
        }

        .login-header {
            padding: 32px 25px 15px;
            text-align: center;
            background: #ffffff;
        }

        .font-heading {
            font-family: 'Space Grotesk', sans-serif;
        }

        /* Tombol Google Masuk Akun */
        .btn-google-account {
            background-color: #ffffff;
            color: #1f2937;
            border: 1.5px solid #dadce0;
            padding: 12px 16px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.25s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.06);
            text-decoration: none;
            width: 100%;
        }
        .btn-google-account:hover {
            background-color: #f8fafc;
            border-color: #ea4335;
            box-shadow: 0 6px 18px rgba(234, 67, 53, 0.16);
            transform: translateY(-2px);
            color: #0d2e5c;
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0 1rem;
            color: #94a3b8;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }
        .divider:not(:empty)::before { margin-right: .75em; }
        .divider:not(:empty)::after { margin-left: .75em; }

        .btn-navy {
            background-color: var(--navy);
            color: #ffffff;
            border: none;
            padding: 10px;
            font-weight: 700;
            border-radius: 10px;
            transition: all 0.25s ease;
        }
        .btn-navy:hover {
            background-color: var(--navy-dark);
            color: var(--gold);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <div class="d-inline-flex align-items-center justify-content-center text-warning rounded-3 mb-2" style="width: 52px; height: 52px; background-color: #0d2e5c;">
                <i class="fa-solid fa-graduation-cap fs-3 text-warning"></i>
            </div>
            <h4 class="font-heading fw-bold text-navy mb-0" style="color: #0d2e5c;">SKILLANCE <span class="text-warning">ACADEMY</span></h4>
            <p class="text-muted small mb-0 mt-1">Portal Pembelajaran & Sertifikasi Digital</p>
        </div>

        <div class="p-4 pt-2">

            <?php if (!empty($errorMsg)): ?>
                <div class="alert alert-danger py-2 small rounded-3 mb-3">
                    <i class="fa-solid fa-circle-exclamation me-1"></i> <?= htmlspecialchars($errorMsg) ?>
                </div>
            <?php endif; ?>

            <!-- PILIH AKUN GOOGLE UNTUK LOGIN INSTAN (SINGLE SIGN-ON) -->
            <div class="mb-3">
                <label class="form-label small fw-bold text-navy mb-2 d-flex align-items-center gap-1">
                    <i class="fa-brands fa-google text-danger"></i> Masuk dengan Akun Google
                </label>

                <!-- Pilihan 1: Muh. Arsyad Ramsi -->
                <a href="login.php?action=google&account=arsyad<?= !empty($redirectTarget) ? '&redirect=' . urlencode($redirectTarget) : '' ?>" class="btn-google-account mb-2">
                    <img src="https://ui-avatars.com/api/?name=Muh+Arsyad+Ramsi&background=0d2e5c&color=fca311" class="rounded-circle" width="36" height="36" alt="Muh. Arsyad Ramsi">
                    <div class="text-start flex-grow-1">
                        <div class="fw-bold text-dark" style="font-size: 0.88rem;">Muh. Arsyad Ramsi</div>
                        <small class="text-muted" style="font-size: 0.72rem;">arsyadhijrah49720@gmail.com</small>
                    </div>
                    <span class="badge bg-warning text-dark" style="font-size: 0.65rem;">1-Klik Masuk &raquo;</span>
                </a>

                <!-- Pilihan 2: Skillance Official -->
                <a href="login.php?action=google&account=skillance<?= !empty($redirectTarget) ? '&redirect=' . urlencode($redirectTarget) : '' ?>" class="btn-google-account mb-2">
                    <img src="https://ui-avatars.com/api/?name=Skillance+Official&background=ea4335&color=fff" class="rounded-circle" width="36" height="36" alt="Skillance Official">
                    <div class="text-start flex-grow-1">
                        <div class="fw-bold text-dark" style="font-size: 0.88rem;">Skillance Official</div>
                        <small class="text-muted" style="font-size: 0.72rem;">skillance.id@gmail.com</small>
                    </div>
                    <span class="badge bg-danger text-white" style="font-size: 0.65rem;">1-Klik Masuk &raquo;</span>
                </a>

                <div class="text-center mt-2">
                    <small class="text-muted" style="font-size: 0.72rem;">
                        <i class="fa-solid fa-bolt text-warning me-1"></i> Langsung masuk otomatis tanpa perlu ketik email dan password.
                    </small>
                </div>
            </div>

            <div class="divider">ATAU GUNAKAN EMAIL KAMPUS / MAHASISWA</div>

            <!-- TOGGLE COLLAPSIBLE EMAIL FORM -->
            <div class="text-center mb-2">
                <a class="text-decoration-none small fw-semibold text-navy" data-bs-toggle="collapse" href="#emailCollapse" role="button" aria-expanded="false" style="font-size: 0.80rem;">
                    <i class="fa-solid fa-envelope me-1"></i> Masuk dengan Email Kampus / Institusi <i class="fa-solid fa-chevron-down ms-1 small"></i>
                </a>
            </div>

            <div class="collapse" id="emailCollapse">
                <form action="login.php<?= !empty($redirectTarget) ? '?redirect=' . urlencode($redirectTarget) : '' ?>" method="POST" class="bg-light p-3 rounded-3 border mt-2">
                    <input type="hidden" name="action" value="login_email">

                    <div class="mb-2">
                        <label class="form-label small fw-bold text-navy mb-1">Email Mahasiswa</label>
                        <input type="email" name="email" class="form-control form-control-sm rounded-2" placeholder="nim@student.usn.ac.id" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-bold text-navy mb-1">Nama Lengkap Mahasiswa</label>
                        <input type="text" name="name" class="form-control form-control-sm rounded-2" placeholder="Nama untuk Sertifikat SKPI">
                    </div>

                    <button type="submit" class="btn btn-navy btn-sm w-100 shadow-sm">
                        <i class="fa-solid fa-right-to-bracket me-1 text-warning"></i> Masuk dengan Email Kampus
                    </button>
                </form>
            </div>

            <div class="text-center mt-4 pt-2 border-top">
                <a href="index.php" class="text-muted text-decoration-none small">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Katalog Modul
                </a>
            </div>

        </div>
        <div class="bg-light py-2 px-3 text-center border-top">
            <small class="text-muted" style="font-size: 0.72rem;">&copy; <?= date('Y') ?> PT Skillance Digital Indonesia &bull; Skillance Academy</small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
