<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIDESA - Sistem Informasi Desa Mandiri')</title>
    <!-- Bootstrap 5 CSS (HTML Biasa) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome 6 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #1e293b; }
        .bg-navy { background-color: #071a35 !important; }
        .text-navy { color: #071a35 !important; }
        .text-gold { color: #fca311 !important; }
        .btn-navy { background-color: #071a35; color: #fff; border: none; }
        .btn-navy:hover { background-color: #0d2e5c; color: #fff; }
        .navbar-brand span { color: #fca311; }
        .card-custom { border: none; border-radius: 14px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navbar Navigasi -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-navy sticky-top shadow-sm py-2.5">
        <div class="container">
            <a class="navbar-brand fw-bold d-flex align-items-center gap-2" href="{{ route('home') }}">
                <i class="fa-solid fa-landmark text-gold fs-4"></i>
                <div>
                    <span class="d-block lh-1 text-white">SIDESA</span>
                    <small class="text-white-50" style="font-size: 0.7rem; font-weight: 400;">Sistem Informasi Desa</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navMenu">
                <ul class="navbar-nav ms-auto align-items-lg-center gap-1">
                    <li class="nav-item"><a class="nav-link text-white fw-semibold px-3" href="{{ route('home') }}"><i class="fa-solid fa-house me-1"></i> Beranda</a></li>
                    <li class="nav-item"><a class="nav-link text-white fw-semibold px-3" href="{{ route('surat.create') }}"><i class="fa-solid fa-file-pen me-1"></i> Buat Surat</a></li>
                    <li class="nav-item"><a class="nav-link text-white fw-semibold px-3" href="{{ route('surat.track') }}"><i class="fa-solid fa-magnifying-glass me-1"></i> Lacak Status</a></li>
                    <li class="nav-item"><a class="nav-link text-white fw-semibold px-3" href="{{ route('apbdes') }}"><i class="fa-solid fa-chart-pie me-1"></i> APBDes Transparan</a></li>
                    <li class="nav-item ms-lg-2"><a class="btn btn-warning btn-sm rounded-pill px-3 fw-bold text-navy" href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-lock me-1"></i> Panel Admin Desa</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-navy text-white pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row g-4 mb-4">
                <div class="col-lg-5">
                    <h5 class="fw-bold text-gold mb-2"><i class="fa-solid fa-landmark me-2"></i>SIDESA Mandiri</h5>
                    <p class="text-white-50 small mb-0">Platform digitalisasi layanan kependudukan dan surat-menyurat warga desa berbasis Laravel 10 dan HTML5/Bootstrap 5. Efisien, transparan, dan terintegrasi notifikasi WhatsApp.</p>
                </div>
                <div class="col-lg-3 col-6">
                    <h6 class="fw-bold text-white mb-3">Layanan Cepat</h6>
                    <ul class="list-unstyled small text-white-50 d-flex flex-column gap-2 mb-0">
                        <li><a href="{{ route('surat.create') }}" class="text-white-50 text-decoration-none">Permohonan Surat SKU</a></li>
                        <li><a href="{{ route('surat.create') }}" class="text-white-50 text-decoration-none">Surat Keterangan Domisili</a></li>
                        <li><a href="{{ route('surat.track') }}" class="text-white-50 text-decoration-none">Cek Tracking Surat NIK</a></li>
                        <li><a href="{{ route('apbdes') }}" class="text-white-50 text-decoration-none">Transparansi Anggaran APBDes</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-6">
                    <h6 class="fw-bold text-white mb-3">Kontak Pemdes</h6>
                    <p class="text-white-50 small mb-1"><i class="fa-solid fa-location-dot text-gold me-2"></i> Kantor Balai Desa Mandiri, Kec. Poleang</p>
                    <p class="text-white-50 small mb-1"><i class="fa-brands fa-whatsapp text-success me-2"></i> Layanan WA Desa: 0822-9170-0778</p>
                    <p class="text-white-50 small mb-0"><i class="fa-solid fa-envelope text-info me-2"></i> layanan@desa-mandiri.id</p>
                </div>
            </div>
            <div class="border-top border-secondary pt-3 text-center small text-white-50">
                &copy; {{ date('Y') }} SIDESA Mandiri &bull; Ditenagai oleh <strong>Laravel 10 Framework</strong>. Source Code Resmi Skillance Academy.
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
