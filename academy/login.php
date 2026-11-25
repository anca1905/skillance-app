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

// Proses Login Form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? 'login_email';
    $email = strtolower(trim($_POST['email'] ?? ''));
    $name  = trim($_POST['name'] ?? '');

    if ($action === 'quick_google' || $email === 'skillance.id@gmail.com') {
        $email = 'skillance.id@gmail.com';
        $name = !empty($name) ? $name : 'Skillance Official';
        $role = 'student';
        $userType = 'mahasiswa';
    } elseif ($action === 'quick_admin') {
        $email = 'arsyadhijrah49720@gmail.com';
        $name = 'MUH. ARSYAD RAMSI';
        $role = 'admin';
        $userType = 'admin';
    } elseif ($action === 'quick_student') {
        $email = 'rian@usn.ac.id';
        $name = 'Muhammad Rian Pratama';
        $role = 'student';
        $userType = 'mahasiswa';
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = 'Mohon masukkan format alamat email yang valid.';
    } else {
        $userId = null;
        $role = $role ?? 'student';
        $userType = $userType ?? 'mahasiswa';
        $assignedRoles = 'mahasiswa,freelancer';
        $partnerSlug = 'msc-usn';
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
                    // Daftarkan sebagai Siswa / Pengguna Baru
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
            $userId = rand(100, 999);
            $name = !empty($name) ? $name : explode('@', $email)[0];
        }

        if (empty($photo)) {
            $photo = 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=0d2e5c&color=fca311';
        }

        // Set Session di Subdomain Academy
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
            padding: 30px 25px 20px;
            text-align: center;
            background: #ffffff;
        }

        .font-heading {
            font-family: 'Space Grotesk', sans-serif;
        }

        .btn-navy {
            background-color: var(--navy);
            color: #ffffff;
            border: none;
            padding: 12px;
            font-weight: 700;
            border-radius: 12px;
            transition: all 0.25s ease;
        }
        .btn-navy:hover {
            background-color: var(--navy-dark);
            color: var(--gold);
            transform: translateY(-1px);
        }

        .btn-quick {
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            padding: 10px 14px;
            border-radius: 10px;
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--navy);
            display: flex;
            align-items: center;
            justify-content: space-between;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
            width: 100%;
            text-align: left;
        }
        .btn-quick:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
            color: var(--navy-dark);
        }

        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.25rem 0;
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
    </style>
</head>
<body>

    <div class="login-card">
        <div class="login-header">
            <div class="d-inline-flex align-items-center justify-content-center bg-navy text-gold rounded-3 mb-2" style="width: 48px; height: 48px; background-color: #0d2e5c;">
                <i class="fa-solid fa-graduation-cap fs-4 text-warning"></i>
            </div>
            <h4 class="font-heading fw-bold text-navy mb-0" style="color: #0d2e5c;">SKILLANCE <span class="text-warning">ACADEMY</span></h4>
            <p class="text-muted small mb-0 mt-1">Masuk Kelas, Dasbor Siswa & Sertifikasi SKPI</p>
        </div>

        <div class="p-4 pt-1">

            <?php if (!empty($errorMsg)): ?>
                <div class="alert alert-danger py-2 small rounded-3 mb-3">
                    <i class="fa-solid fa-circle-exclamation me-1"></i> <?= htmlspecialchars($errorMsg) ?>
                </div>
            <?php endif; ?>

            <!-- FORM LOGIN AKUN SISWA / GOOGLE -->
            <form action="login.php<?= !empty($redirectTarget) ? '?redirect=' . urlencode($redirectTarget) : '' ?>" method="POST">
                <input type="hidden" name="action" value="login_email">

                <div class="mb-3">
                    <label class="form-label small fw-bold text-navy mb-1">
                        <i class="fa-brands fa-google text-danger me-1"></i> Alamat Email Anda
                    </label>
                    <input type="email" name="email" id="inputEmail" class="form-control rounded-3" placeholder="Contoh: skillance.id@gmail.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" required autofocus>
                    <small class="text-muted" style="font-size: 0.72rem;">*Gunakan email Google Anda untuk menyimpan riwayat materi secara permanen.</small>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-navy mb-1">Nama Lengkap (Opsional)</label>
                    <input type="text" name="name" class="form-control rounded-3" placeholder="Nama untuk sertifikat SKPI" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                </div>

                <button type="submit" class="btn btn-navy w-100 shadow-sm d-flex align-items-center justify-content-center gap-2">
                    <i class="fa-solid fa-arrow-right-to-bracket text-warning"></i>
                    <span>Masuk ke Skillance Academy</span>
                </button>
            </form>

            <div class="divider">ATAU MASUK CEPAT 1-KLIK</div>

            <!-- QUICK ONE-CLICK SHORTCUTS -->
            <div class="d-flex flex-column gap-2">
                <form action="login.php<?= !empty($redirectTarget) ? '?redirect=' . urlencode($redirectTarget) : '' ?>" method="POST" class="m-0">
                    <input type="hidden" name="action" value="quick_google">
                    <input type="hidden" name="email" value="skillance.id@gmail.com">
                    <input type="hidden" name="name" value="Skillance Official">
                    <button type="submit" class="btn-quick" style="border: 1.5px solid #ea4335; background: #fff5f5;">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-danger text-white"><i class="fa-brands fa-google"></i></span>
                            <div>
                                <div class="fw-bold text-navy" style="font-size: 0.82rem;">Masuk Akun Google (Rekomendasi)</div>
                                <small class="text-danger fw-semibold" style="font-size: 0.70rem;">skillance.id@gmail.com</small>
                            </div>
                        </div>
                        <span class="badge bg-danger text-white" style="font-size: 0.68rem;">1-Klik Masuk &raquo;</span>
                    </button>
                </form>

                <form action="login.php<?= !empty($redirectTarget) ? '?redirect=' . urlencode($redirectTarget) : '' ?>" method="POST" class="m-0">
                    <input type="hidden" name="action" value="quick_student">
                    <input type="hidden" name="email" value="rian@usn.ac.id">
                    <input type="hidden" name="name" value="Muhammad Rian Pratama">
                    <button type="submit" class="btn-quick">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-warning text-dark"><i class="fa-solid fa-graduation-cap"></i></span>
                            <div>
                                <div class="fw-bold text-navy" style="font-size: 0.82rem;">Siswa Mitra Kampus (Demo)</div>
                                <small class="text-muted" style="font-size: 0.70rem;">Muhammad Rian Pratama &bull; rian@usn.ac.id</small>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-muted small"></i>
                    </button>
                </form>

                <form action="login.php<?= !empty($redirectTarget) ? '?redirect=' . urlencode($redirectTarget) : '' ?>" method="POST" class="m-0">
                    <input type="hidden" name="action" value="quick_admin">
                    <input type="hidden" name="email" value="arsyadhijrah49720@gmail.com">
                    <input type="hidden" name="name" value="MUH. ARSYAD RAMSI">
                    <button type="submit" class="btn-quick">
                        <div class="d-flex align-items-center gap-2">
                            <span class="badge bg-primary text-white"><i class="fa-solid fa-user-shield"></i></span>
                            <div>
                                <div class="fw-bold text-navy" style="font-size: 0.82rem;">Admin / Pengelola Skillance</div>
                                <small class="text-muted" style="font-size: 0.70rem;">MUH. ARSYAD RAMSI &bull; arsyadhijrah49720@gmail.com</small>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-muted small"></i>
                    </button>
                </form>
            </div>

            <div class="text-center mt-3 pt-2 border-top">
                <a href="index.php" class="text-muted text-decoration-none small">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Katalog Modul
                </a>
            </div>

        </div>
        <div class="bg-light py-2 px-3 text-center border-top">
            <small class="text-muted" style="font-size: 0.72rem;">&copy; <?= date('Y') ?> PT Skillance Digital Indonesia &bull; Skillance Academy</small>
        </div>
    </div>

</body>
</html>
