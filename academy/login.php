<?php
session_start();
require_once __DIR__ . '/config/config.php';

// Jika sudah login di Academy, langsung arahkan ke my-learning atau dashboard sesuai role
if (!empty($_SESSION['user_id'])) {
    $currentRole = strtolower(trim($_SESSION['user_role'] ?? 'pengguna'));
    if ($currentRole === 'admin') {
        header("Location: https://skillance.cloud/dashboard/index.php");
        exit();
    } elseif ($currentRole === 'keuangan' || $currentRole === 'bendahara') {
        header("Location: https://skillance.cloud/dashboard/finance/index.php");
        exit();
    } else {
        $target = $_GET['redirect'] ?? 'my-learning.php';
        header("Location: " . $target);
        exit();
    }
}

$errorMsg = '';
$redirectTarget = $_GET['redirect'] ?? 'my-learning.php';

// Proses Login dengan Email & Password
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = strtolower(trim($_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg = 'Mohon masukkan format alamat email yang valid.';
    } elseif (empty($password)) {
        $errorMsg = 'Mohon masukkan kata sandi / password akun Anda.';
    } else {
        $user = null;

        // Cek pengguna di Database
        if (isset($conn) && $conn instanceof mysqli && !$conn->connect_error) {
            $stmt = $conn->prepare("SELECT id, name, email, password, role, user_type, assigned_roles, partner_slug, photo FROM `users` WHERE `email` = ? LIMIT 1");
            if ($stmt) {
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res && $res->num_rows > 0) {
                    $user = $res->fetch_assoc();
                }
                $stmt->close();
            }
        }

        if ($user && !empty($user['password']) && password_verify($password, $user['password'])) {
            // Normalisasi 3 Peran: admin, keuangan, pengguna
            $rawRole = strtolower(trim($user['role'] ?? 'pengguna'));
            if ($rawRole === 'admin') {
                $role = 'admin';
            } elseif ($rawRole === 'keuangan' || $rawRole === 'bendahara') {
                $role = 'keuangan';
            } else {
                $role = 'pengguna';
            }

            $userId = (int)$user['id'];
            $name = $user['name'];
            $userType = $user['user_type'] ?? 'mahasiswa';
            $assignedRoles = $user['assigned_roles'] ?? ($role === 'admin' ? 'admin,keuangan,pengguna' : 'pengguna,mahasiswa,freelancer');
            $partnerSlug = $user['partner_slug'] ?? 'msc-usn';
            $photo = !empty($user['photo']) ? $user['photo'] : 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&background=0d2e5c&color=fca311';

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

            // Pastikan track dasar terdaftar
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

            // Redirect sesuai peran
            if ($role === 'admin') {
                header("Location: https://skillance.cloud/dashboard/index.php");
                exit();
            } elseif ($role === 'keuangan') {
                header("Location: https://skillance.cloud/dashboard/finance/index.php");
                exit();
            } else {
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

        } else {
            $errorMsg = 'Email atau password yang Anda masukkan tidak sesuai.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Akun | Skillance Academy Indonesia</title>

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

        .form-control-custom {
            height: 46px;
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            padding: 10px 14px 10px 40px;
            font-size: 0.92rem;
            font-weight: 500;
        }
        .form-control-custom:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px rgba(13, 46, 92, 0.12);
        }

        .input-group-custom {
            position: relative;
            margin-bottom: 1rem;
        }
        .input-group-custom .icon-left {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 0.95rem;
            z-index: 5;
        }
        .input-group-custom .btn-toggle-eye {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #94a3b8;
            cursor: pointer;
            z-index: 5;
            padding: 4px;
        }

        .btn-navy {
            background-color: var(--navy);
            color: #ffffff;
            border: none;
            padding: 11px;
            font-weight: 700;
            border-radius: 10px;
            transition: all 0.25s ease;
            width: 100%;
            letter-spacing: 0.3px;
        }
        .btn-navy:hover {
            background-color: var(--navy-dark);
            color: var(--gold);
            transform: translateY(-1px);
        }
        .btn-register-link {
            border: 1.5px solid #e2e8f0;
            background: #f8fafc;
            color: var(--navy);
            font-weight: 700;
            padding: 10px;
            border-radius: 10px;
            display: block;
            text-align: center;
            text-decoration: none;
            transition: all 0.2s ease;
            font-size: 0.88rem;
        }
        .btn-register-link:hover {
            background: #ffffff;
            border-color: var(--navy);
            color: var(--navy);
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
                <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3">
                    <i class="fa-solid fa-circle-exclamation me-1"></i> <?= htmlspecialchars($errorMsg) ?>
                </div>
            <?php endif; ?>

            <!-- FORM LOGIN EMAIL & PASSWORD -->
            <form action="login.php<?= !empty($redirectTarget) ? '?redirect=' . urlencode($redirectTarget) : '' ?>" method="POST">
                <div class="input-group-custom">
                    <i class="fa-solid fa-envelope icon-left"></i>
                    <input type="email" name="email" class="form-control form-control-custom" placeholder="Alamat Email Akun" required autofocus value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                </div>

                <div class="input-group-custom">
                    <i class="fa-solid fa-lock icon-left"></i>
                    <input type="password" name="password" id="passInput" class="form-control form-control-custom" placeholder="Password Akun" required>
                    <button type="button" class="btn-toggle-eye" onclick="togglePass()">
                        <i class="fa-solid fa-eye" id="eyeIcon"></i>
                    </button>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                        <label class="form-check-label text-muted small" for="rememberMe">Ingat Saya</label>
                    </div>
                    <small class="text-muted"><i class="fa-solid fa-shield-halved text-success me-1"></i> Terenkripsi S-OS</small>
                </div>

                <button type="submit" class="btn-navy mb-3 shadow-sm">
                    <i class="fa-solid fa-arrow-right-to-bracket me-2 text-warning"></i> MASUK SEKARANG
                </button>
            </form>

            <div class="text-center my-3">
                <span class="text-muted small">Belum memiliki akun Skillance?</span>
            </div>

            <!-- TOMBOL DAFTAR AKUN BARU -->
            <a href="https://skillance.cloud/auth/index.php?ref=academy" class="btn-register-link">
                <i class="fa-solid fa-user-plus me-1 text-primary"></i> Daftar Akun Baru Sekarang
            </a>

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

    <script>
    function togglePass() {
        const input = document.getElementById('passInput');
        const icon = document.getElementById('eyeIcon');
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    </script>
</body>
</html>
