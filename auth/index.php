<?php
session_start();

$ref = $_GET['ref'] ?? '';
if ($ref === 'academy' || strpos($_GET['redirect'] ?? '', 'academy') !== false) {
    $_SESSION['auth_redirect'] = 'academy';
}

if (isset($_SESSION['user_id'])) {
    if ($ref === 'academy' || ($_SESSION['auth_redirect'] ?? '') === 'academy') {
        unset($_SESSION['auth_redirect']);
        header("Location: sso_jump.php?target=academy");
        exit();
    }
    if ($_SESSION['user_role'] === 'investor') {
        header("Location: ../dashboard/investor.php");
    } elseif ($_SESSION['user_role'] === 'freelancer') {
        header("Location: ../dashboard/freelancer/index.php");
    } else {
        header("Location: ../dashboard/index.php");
    }
    exit();
}

require_once __DIR__ . '/../config/config.php';
$clientId = $_ENV['GOOGLE_CLIENT_ID'] ?? (function_exists('getenv') ? getenv('GOOGLE_CLIENT_ID') : '');

$loginError = $_SESSION['login_error'] ?? null;
unset($_SESSION['login_error']);
$isAcademyRef = ($ref === 'academy' || ($_SESSION['auth_redirect'] ?? '') === 'academy');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk | Skillance Freelance & Office</title>

    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <!-- Google Identity Services (GSI) Client -->
    <script src="https://accounts.google.com/gsi/client" async defer></script>

    <style>
        body {
            background: linear-gradient(135deg, #0d2e5c 0%, #061a35 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px 15px;
            font-family: 'Inter', sans-serif;
        }
        .login-card {
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            border: none;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.35);
            border-top: 5px solid var(--gold);
            border-radius: 14px;
            overflow: hidden;
        }
        .login-header {
            background-color: #fff;
            padding: 2.2rem 2rem 1.2rem;
            text-align: center;
        }
        .brand-text {
            color: var(--navy);
            letter-spacing: 1.5px;
            font-weight: 800;
            font-size: 1.6rem;
            font-family: 'Poppins', sans-serif;
        }
        .btn-google {
            background-color: #ffffff;
            color: #3c4043;
            border: 1px solid #dadce0;
            padding: 0.75rem 1rem;
            font-weight: 600;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            transition: all 0.25s ease;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08);
            text-decoration: none;
        }
        .btn-google:hover {
            background-color: #f8f9fa;
            border-color: #c2c6cb;
            color: #202124;
            box-shadow: 0 4px 12px rgba(0,0,0,0.12);
            transform: translateY(-1px);
        }
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            margin: 1.5rem 0;
            color: #8c98a4;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #e2e8f0;
        }
        .divider:not(:empty)::before { margin-right: .75em; }
        .divider:not(:empty)::after { margin-left: .75em; }

        .btn-login {
            background-color: var(--navy);
            color: #fff;
            padding: 0.75rem;
            font-weight: 600;
            border-radius: 8px;
            letter-spacing: 0.5px;
            transition: all 0.3s;
            border: none;
        }
        .btn-login:hover {
            background-color: var(--navy-dark);
            color: var(--gold);
        }
        .role-pill {
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 600;
            background: rgba(13, 46, 92, 0.08);
            color: var(--navy);
        }
        .demo-box {
            background: #fff9ed;
            border: 1px dashed #fca311;
            border-radius: 8px;
            padding: 10px 14px;
        }
    </style>
</head>

<body>

    <div class="login-card card">
        <div class="login-header">
            <div class="mb-2">
                <i class="fa-solid fa-code text-gold fa-3x"></i>
            </div>
            <h4 class="brand-text mb-0">SKILLANCE</h4>
            <div class="d-flex justify-content-center gap-2 mt-2">
                <span class="role-pill"><i class="fa-solid fa-graduation-cap me-1"></i> Mahasiswa</span>
                <span class="role-pill"><i class="fa-solid fa-users me-1"></i> Umum</span>
                <span class="role-pill"><i class="fa-solid fa-briefcase me-1"></i> Freelance</span>
            </div>
        </div>

        <div class="card-body px-4 pb-4 pt-1">
            
            <?php if ($isAcademyRef): ?>
                <div class="alert alert-warning py-2 px-3 small border-0 mb-3 rounded-3" style="background-color: #fff9ed; color: #b45309; border-left: 4px solid #fca311 !important;">
                    <i class="fa-solid fa-graduation-cap me-1"></i>
                    <strong>Akun Terpadu Skillance:</strong> Masuk untuk mengakses kelas di <strong>Skillance Academy</strong> dan terhubung langsung ke <strong>Bursa Freelance</strong>.
                </div>
            <?php endif; ?>

            <div id="alertContainer">
                <?php if ($loginError): ?>
                    <div class="alert alert-danger py-2 small fade show" role="alert">
                        <i class="fa-solid fa-circle-exclamation me-1"></i> <?= htmlspecialchars($loginError) ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Tombol Login Google Utama -->
            <div class="mb-2">
                <a href="google_login.php<?= $isAcademyRef ? '?redirect=academy' : '' ?>" class="btn-google w-100" id="btnGoogleDirect">
                    <svg width="20" height="20" viewBox="0 0 48 48">
                        <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                        <path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/>
                        <path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.79l7.97-6.2z"/>
                        <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                    </svg>
                    <span>Masuk dengan Akun Google</span>
                </a>
            </div>

            <div class="text-center mt-2 mb-1">
                <small class="text-muted" style="font-size: 0.76rem;">
                    Buka proyek freelance untuk <strong>Mahasiswa & Umum</strong>.
                </small>
            </div>

            <!-- GSI Native Container (jika didukung) -->
            <div id="g_id_onload"
                data-client_id="<?= htmlspecialchars($clientId) ?>"
                data-callback="handleGoogleCredentialResponse"
                data-auto_prompt="false">
            </div>

            <div class="divider">ATAU LOGIN PEGAWAI / ADMIN</div>

            <!-- Form Login Email Biasa (Untuk Admin & Pegawai Internal) -->
            <form id="loginForm">
                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold">EMAIL</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-envelope text-muted"></i></span>
                        <input type="email" id="email" class="form-control border-start-0" placeholder="admin@skillance.id" required autofocus>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold">PASSWORD</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-lock text-muted"></i></span>
                        <input type="password" id="password" class="form-control border-start-0" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember">
                        <label class="form-check-label small text-muted" for="remember">Ingat Saya</label>
                    </div>
                    <a href="../index.html" class="small text-decoration-none text-navy fw-bold"><i class="fa-solid fa-arrow-left me-1"></i> Ke Website</a>
                </div>

                <button type="submit" class="btn btn-login w-100" id="btnLogin">
                    <i class="fa-solid fa-right-to-bracket me-2"></i> MASUK SISTEM
                </button>
            </form>

            <!-- Box Demo Cepat di Localhost -->
            <div class="demo-box mt-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <small class="fw-bold text-dark"><i class="fa-solid fa-flask text-gold me-1"></i> Demo Login Cepat Freelancer:</small>
                    <span class="badge bg-warning text-dark" style="font-size: 0.65rem;">Local Mode</span>
                </div>
                <div class="d-flex gap-2">
                    <a href="../api/demo_google_login.php?type=mahasiswa" class="btn btn-sm btn-outline-primary flex-fill" style="font-size: 0.72rem;">
                        <i class="fa-solid fa-graduation-cap me-1"></i> Demo Mahasiswa
                    </a>
                    <a href="../api/demo_google_login.php?type=umum" class="btn btn-sm btn-outline-secondary flex-fill" style="font-size: 0.72rem;">
                        <i class="fa-solid fa-user me-1"></i> Demo Umum
                    </a>
                </div>
            </div>

        </div>
        <div class="card-footer bg-light text-center py-3 border-top-0">
            <small class="text-muted" style="font-size: 0.75rem;">
                &copy; <?= date('Y') ?> CV Skillance Digital Indonesia.<br>Platform Agency & Kolaborasi Freelance.
            </small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/js/login.js"></script>

    <script>
    // Handler untuk respon kredensial Google Identity Services (One-Tap / GSI)
    function handleGoogleCredentialResponse(response) {
        if (!response.credential) return;

        Swal.fire({
            title: 'Memverifikasi Akun Google...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading(); }
        });

        fetch('../api/google_auth_token.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ credential: response.credential })
        })
        .then(res => res.json())
        .then(data => {
            if (data.status === 'success') {
                localStorage.setItem('isLoggedIn', 'true');
                localStorage.setItem('userEmail', data.user.email);
                localStorage.setItem('userName', data.user.name);
                localStorage.setItem('userRole', data.user.role);

                Swal.fire({
                    icon: 'success',
                    title: 'Selamat Datang!',
                    text: data.message,
                    timer: 1200,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = data.redirect || '../dashboard/freelancer/index.php';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Google Gagal',
                    text: data.message || 'Silakan coba lagi.'
                });
            }
        })
        .catch(err => {
            console.error('Error Google Auth:', err);
            Swal.fire({
                icon: 'error',
                title: 'Koneksi Bermasalah',
                text: 'Tidak dapat menghubungi server verifikasi Google.'
            });
        });
    }
    </script>
</body>
</html>
