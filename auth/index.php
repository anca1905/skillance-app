<?php
session_start();

$ref = $_GET['ref'] ?? '';
if ($ref === 'academy' || strpos($_GET['redirect'] ?? '', 'academy') !== false) {
    $_SESSION['auth_redirect'] = 'academy';
}

// Jika sudah ada sesi login, langsung arahkan ke dashboard sesuai role
if (isset($_SESSION['user_id'])) {
    $currentRole = strtolower(trim($_SESSION['user_role'] ?? 'pengguna'));
    if ($currentRole === 'admin') {
        header("Location: ../dashboard/index.php");
        exit();
    } elseif ($currentRole === 'keuangan' || $currentRole === 'bendahara') {
        header("Location: ../dashboard/finance/index.php");
        exit();
    } else {
        if ($ref === 'academy' || ($_SESSION['auth_redirect'] ?? '') === 'academy') {
            unset($_SESSION['auth_redirect']);
            header("Location: https://academy.skillance.cloud/my-learning.php");
            exit();
        }
        header("Location: ../dashboard/freelancer/index.php");
        exit();
    }
}

require_once __DIR__ . '/../config/config.php';

$loginError = $_SESSION['login_error'] ?? null;
unset($_SESSION['login_error']);
$isAcademyRef = ($ref === 'academy' || ($_SESSION['auth_redirect'] ?? '') === 'academy');
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk & Daftar Akun | PT Skillance Digital Indonesia</title>

    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        :root {
            --navy: #0d2e5c;
            --navy-dark: #061a35;
            --gold: #fca311;
            --gold-hover: #e59207;
        }
        body {
            background: linear-gradient(135deg, #0d2e5c 0%, #061a35 100%);
            min-height: 100vh;
            margin: 0;
            padding: 30px 15px;
            font-family: 'Inter', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .auth-container {
            width: 100%;
            max-width: 480px;
        }
        .auth-card {
            background: #ffffff;
            border: none;
            border-radius: 16px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.4);
            overflow: hidden;
            border-top: 5px solid var(--gold);
        }
        .auth-header {
            background: #ffffff;
            padding: 2rem 2rem 1rem;
            text-align: center;
        }
        .brand-logo-badge {
            width: 58px;
            height: 58px;
            background: rgba(13, 46, 92, 0.06);
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 12px;
            border: 1px solid rgba(13, 46, 92, 0.12);
        }
        .brand-text {
            color: var(--navy);
            font-weight: 800;
            font-size: 1.45rem;
            letter-spacing: 1px;
            font-family: 'Poppins', sans-serif;
            margin-bottom: 2px;
        }
        .role-chips {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 10px;
            flex-wrap: wrap;
        }
        .role-chip {
            font-size: 0.7rem;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            background: #f1f5f9;
            color: #475569;
            border: 1px solid #e2e8f0;
        }
        .role-chip.active-chip {
            background: rgba(13, 46, 92, 0.1);
            color: var(--navy);
            border-color: rgba(13, 46, 92, 0.25);
        }
        
        /* Modern Auth Navigation Tabs */
        .auth-tabs {
            display: flex;
            background: #f1f5f9;
            padding: 5px;
            border-radius: 12px;
            margin: 0.5rem 1.75rem 1.25rem;
        }
        .auth-tab-btn {
            flex: 1;
            padding: 9px 12px;
            border: none;
            background: transparent;
            font-weight: 700;
            font-size: 0.88rem;
            color: #64748b;
            border-radius: 9px;
            transition: all 0.2s ease;
            cursor: pointer;
            text-align: center;
        }
        .auth-tab-btn.active {
            background: #ffffff;
            color: var(--navy);
            box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        }
        
        /* Form Inputs */
        .form-floating-custom {
            position: relative;
            margin-bottom: 1rem;
        }
        .form-control-custom {
            height: 48px;
            border-radius: 10px;
            border: 1.5px solid #e2e8f0;
            padding: 10px 14px 10px 42px;
            font-size: 0.92rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .form-control-custom:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px rgba(13, 46, 92, 0.12);
        }
        .input-icon-left {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1rem;
            z-index: 5;
        }
        .btn-toggle-pass {
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
        .btn-toggle-pass:hover {
            color: var(--navy);
        }

        .btn-submit-auth {
            background-color: var(--navy);
            color: #ffffff;
            font-weight: 700;
            padding: 12px;
            border-radius: 10px;
            border: none;
            width: 100%;
            font-size: 0.95rem;
            letter-spacing: 0.4px;
            transition: all 0.25s ease;
            box-shadow: 0 4px 12px rgba(13, 46, 92, 0.25);
        }
        .btn-submit-auth:hover {
            background-color: var(--navy-dark);
            color: var(--gold);
            transform: translateY(-1px);
        }
        .auth-footer-bar {
            background: #f8fafc;
            padding: 14px 20px;
            border-top: 1px solid #f1f5f9;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="auth-container">
    <div class="auth-card">
        <!-- HEADER -->
        <div class="auth-header">
            <div class="brand-logo-badge">
                <i class="fa-solid fa-code text-primary fs-3"></i>
            </div>
            <h4 class="brand-text">SKILLANCE DIGITAL</h4>
            <p class="text-muted small mb-0" style="font-size: 0.82rem;">Portal Masuk Akun Tunggal & Layanan Terintegrasi</p>
            
            <div class="role-chips">
                <span class="role-chip"><i class="fa-solid fa-user-shield me-1 text-primary"></i> Admin</span>
                <span class="role-chip"><i class="fa-solid fa-wallet me-1 text-success"></i> Keuangan</span>
                <span class="role-chip active-chip"><i class="fa-solid fa-users me-1 text-warning"></i> Pengguna & Mahasiswa</span>
            </div>
        </div>

        <!-- TABS NAV -->
        <div class="auth-tabs">
            <button type="button" class="auth-tab-btn active" id="tabBtnLogin" onclick="switchTab('login')">
                <i class="fa-solid fa-right-to-bracket me-1"></i> Masuk
            </button>
            <button type="button" class="auth-tab-btn" id="tabBtnRegister" onclick="switchTab('register')">
                <i class="fa-solid fa-user-plus me-1"></i> Daftar Baru
            </button>
        </div>

        <div class="card-body px-4 pt-1 pb-4">
            <?php if ($isAcademyRef): ?>
                <div class="alert alert-warning py-2 px-3 small border-0 mb-3 rounded-3" style="background-color: #fff9ed; color: #b45309; border-left: 4px solid #fca311 !important;">
                    <i class="fa-solid fa-graduation-cap me-1"></i>
                    <strong>Akses Skillance Academy:</strong> Masuk atau daftar akun untuk mengakses kelas modul, tugas praktikum, dan klaim sertifikat SKPI Anda.
                </div>
            <?php endif; ?>

            <div id="alertContainer"></div>

            <!-- ========================================== -->
            <!-- FORM 1: MASUK (LOGIN)                      -->
            <!-- ========================================== -->
            <form id="formLogin">
                <div class="form-floating-custom">
                    <i class="fa-solid fa-envelope input-icon-left"></i>
                    <input type="email" id="loginEmail" class="form-control form-control-custom" placeholder="Alamat Email Anda" required autofocus>
                </div>

                <div class="form-floating-custom">
                    <i class="fa-solid fa-lock input-icon-left"></i>
                    <input type="password" id="loginPassword" class="form-control form-control-custom" placeholder="Kata Sandi / Password" required>
                    <button type="button" class="btn-toggle-pass" onclick="togglePasswordVisibility('loginPassword', this)">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="rememberMe" checked>
                        <label class="form-check-label text-muted small" for="rememberMe">Ingat Saya</label>
                    </div>
                    <a href="javascript:void(0)" onclick="switchTab('register')" class="text-decoration-none small text-navy fw-semibold">
                        Belum punya akun? <strong class="text-primary">Daftar</strong>
                    </a>
                </div>

                <button type="submit" class="btn-submit-auth" id="btnLoginSubmit">
                    <i class="fa-solid fa-arrow-right-to-bracket me-2"></i> MASUK SEKARANG
                </button>
            </form>

            <!-- ========================================== -->
            <!-- FORM 2: DAFTAR AKUN BARU (REGISTER)        -->
            <!-- ========================================== -->
            <form id="formRegister" style="display: none;">
                <div class="form-floating-custom">
                    <i class="fa-solid fa-user input-icon-left"></i>
                    <input type="text" id="regName" class="form-control form-control-custom" placeholder="Nama Lengkap Sesuai KTP / Ijazah" required>
                </div>

                <div class="form-floating-custom">
                    <i class="fa-solid fa-envelope input-icon-left"></i>
                    <input type="email" id="regEmail" class="form-control form-control-custom" placeholder="Alamat Email Aktif" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold mb-1">KATEGORI PENGGUNA</label>
                    <div class="d-flex gap-2">
                        <div class="form-check flex-fill p-2 border rounded-3 bg-light">
                            <input class="form-check-input ms-1" type="radio" name="regUserType" id="typeMhs" value="mahasiswa" checked>
                            <label class="form-check-label small fw-bold text-navy ms-1" for="typeMhs">
                                <i class="fa-solid fa-graduation-cap me-1 text-primary"></i> Mahasiswa Mitra
                            </label>
                        </div>
                        <div class="form-check flex-fill p-2 border rounded-3 bg-light">
                            <input class="form-check-input ms-1" type="radio" name="regUserType" id="typeUmum" value="umum">
                            <label class="form-check-label small fw-bold text-navy ms-1" for="typeUmum">
                                <i class="fa-solid fa-laptop-code me-1 text-success"></i> Umum & Freelance
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-floating-custom">
                    <i class="fa-solid fa-lock input-icon-left"></i>
                    <input type="password" id="regPassword" class="form-control form-control-custom" placeholder="Password (Minimal 6 Karakter)" minlength="6" required>
                    <button type="button" class="btn-toggle-pass" onclick="togglePasswordVisibility('regPassword', this)">
                        <i class="fa-solid fa-eye"></i>
                    </button>
                </div>

                <div class="form-floating-custom">
                    <i class="fa-solid fa-check-double input-icon-left"></i>
                    <input type="password" id="regConfirmPassword" class="form-control form-control-custom" placeholder="Ulangi Password" minlength="6" required>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="regTerms" required checked>
                    <label class="form-check-label text-muted small" for="regTerms">
                        Saya menyetujui Ketentuan Layanan & Kebijakan Privasi PT Skillance Digital Indonesia.
                    </label>
                </div>

                <button type="submit" class="btn-submit-auth" id="btnRegisterSubmit">
                    <i class="fa-solid fa-user-check me-2"></i> DAFTAR AKUN BARU
                </button>
            </form>

            <div class="text-center mt-3 pt-2 border-top">
                <a href="../index.html" class="text-decoration-none text-muted small">
                    <i class="fa-solid fa-house me-1"></i> Kembali ke Halaman Utama
                </a>
            </div>
        </div>

        <div class="auth-footer-bar">
            <small class="text-muted" style="font-size: 0.74rem;">
                &copy; <?= date('Y') ?> PT Skillance Digital Indonesia &bull; Terdaftar di Kemenkumham RI
            </small>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function switchTab(tab) {
    const formLogin = document.getElementById('formLogin');
    const formRegister = document.getElementById('formRegister');
    const tabLogin = document.getElementById('tabBtnLogin');
    const tabRegister = document.getElementById('tabBtnRegister');
    const alertBox = document.getElementById('alertContainer');
    alertBox.innerHTML = '';

    if (tab === 'register') {
        formLogin.style.display = 'none';
        formRegister.style.display = 'block';
        tabLogin.classList.remove('active');
        tabRegister.classList.add('active');
        document.getElementById('regName').focus();
    } else {
        formRegister.style.display = 'none';
        formLogin.style.display = 'block';
        tabRegister.classList.remove('active');
        tabLogin.classList.add('active');
        document.getElementById('loginEmail').focus();
    }
}

function togglePasswordVisibility(inputId, btn) {
    const input = document.getElementById(inputId);
    const icon = btn.querySelector('i');
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

// 1. Handle Submit Form Login
document.getElementById('formLogin').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('btnLoginSubmit');
    const originalText = btn.innerHTML;
    const email = document.getElementById('loginEmail').value.trim();
    const password = document.getElementById('loginPassword').value;

    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin me-2"></i> Memeriksa Kredensial...';

    fetch('../api/login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email: email, password: password })
    })
    .then(r => r.json())
    .then(res => {
        if (res.status === 'success') {
            localStorage.setItem('isLoggedIn', 'true');
            localStorage.setItem('userEmail', res.user.email);
            localStorage.setItem('userName', res.user.name);
            localStorage.setItem('userRole', res.user.role);

            Swal.fire({
                icon: 'success',
                title: 'Masuk Berhasil!',
                text: 'Selamat datang kembali, ' + res.user.name,
                timer: 1200,
                showConfirmButton: false
            }).then(() => {
                window.location.href = res.redirect || '../dashboard/freelancer/index.php';
            });
        } else {
            document.getElementById('alertContainer').innerHTML = `
                <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3 fade show">
                    <i class="fa-solid fa-circle-exclamation me-1"></i> ${res.message || 'Login gagal.'}
                </div>
            `;
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    })
    .catch(err => {
        console.error(err);
        document.getElementById('alertContainer').innerHTML = `
            <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3 fade show">
                <i class="fa-solid fa-triangle-exclamation me-1"></i> Terjadi gangguan koneksi ke server.
            </div>
        `;
        btn.disabled = false;
        btn.innerHTML = originalText;
    });
});

// 2. Handle Submit Form Register
document.getElementById('formRegister').addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('btnRegisterSubmit');
    const originalText = btn.innerHTML;
    const name = document.getElementById('regName').value.trim();
    const email = document.getElementById('regEmail').value.trim();
    const password = document.getElementById('regPassword').value;
    const confirmPassword = document.getElementById('regConfirmPassword').value;
    const userType = document.querySelector('input[name="regUserType"]:checked').value;

    if (password !== confirmPassword) {
        document.getElementById('alertContainer').innerHTML = `
            <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3 fade show">
                <i class="fa-solid fa-circle-exclamation me-1"></i> Konfirmasi password tidak cocok!
            </div>
        `;
        return;
    }

    btn.disabled = true;
    btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin me-2"></i> Mendaftarkan Akun...';

    fetch('../api/register.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            name: name,
            email: email,
            password: password,
            confirm_password: confirmPassword,
            user_type: userType
        })
    })
    .then(r => r.json())
    .then(res => {
        if (res.status === 'success') {
            localStorage.setItem('isLoggedIn', 'true');
            localStorage.setItem('userEmail', res.user.email);
            localStorage.setItem('userName', res.user.name);
            localStorage.setItem('userRole', res.user.role);

            Swal.fire({
                icon: 'success',
                title: 'Pendaftaran Berhasil!',
                text: 'Akun Anda berhasil dibuat. Mengalihkan ke dashboard...',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.href = res.redirect || '../dashboard/freelancer/index.php';
            });
        } else {
            document.getElementById('alertContainer').innerHTML = `
                <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3 fade show">
                    <i class="fa-solid fa-circle-exclamation me-1"></i> ${res.message || 'Pendaftaran gagal.'}
                </div>
            `;
            btn.disabled = false;
            btn.innerHTML = originalText;
        }
    })
    .catch(err => {
        console.error(err);
        document.getElementById('alertContainer').innerHTML = `
            <div class="alert alert-danger py-2 px-3 small rounded-3 mb-3 fade show">
                <i class="fa-solid fa-triangle-exclamation me-1"></i> Gagal menghubungi server pendaftaran.
            </div>
        `;
        btn.disabled = false;
        btn.innerHTML = originalText;
    });
});
</script>
</body>
</html>
