@extends('layouts.app')

@section('title', 'SIDESA - Portal Pelayanan Warga Desa Mandiri')

@section('content')
<div class="container">
    <!-- Hero Banner -->
    <div class="p-4 p-md-5 rounded-4 text-white bg-navy position-relative overflow-hidden mb-4 shadow-sm" style="background: linear-gradient(135deg, #071a35 0%, #0d2e5c 100%);">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="badge bg-warning text-navy fw-bold px-3 py-2 rounded-pill mb-3">Layanan Mandiri Warga 24 Jam</span>
                <h1 class="fw-bold font-heading mb-3">Urus Surat Desa Cepat, Mudah, dan Tanpa Antre</h1>
                <p class="text-white-50 mb-4" style="line-height: 1.7;">Ajukan Surat Keterangan Usaha, Domisili, SKCK, hingga Surat Keterangan Tidak Mampu langsung dari HP Anda. Dokumen resmi terbit dengan tanda tangan digital & QR Code.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('surat.create') }}" class="btn btn-warning fw-bold px-4 py-2.5 rounded-pill shadow-sm text-navy">
                        <i class="fa-solid fa-file-pen me-2"></i> Buat Surat Sekarang
                    </a>
                    <a href="{{ route('surat.track') }}" class="btn btn-outline-light fw-bold px-4 py-2.5 rounded-pill">
                        <i class="fa-solid fa-magnifying-glass me-2"></i> Lacak Status Surat
                    </a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block text-center">
                <i class="fa-solid fa-house-chimney-window fa-9x text-warning opacity-25"></i>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="row g-3 mb-4">
        <div class="col-md-3 col-6">
            <div class="card card-custom p-3 text-center">
                <div class="text-primary mb-1"><i class="fa-solid fa-users fs-3"></i></div>
                <h4 class="fw-bold text-navy mb-0">2,450</h4>
                <small class="text-muted">Total Penduduk</small>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card card-custom p-3 text-center">
                <div class="text-success mb-1"><i class="fa-solid fa-file-circle-check fs-3"></i></div>
                <h4 class="fw-bold text-navy mb-0">1,128</h4>
                <small class="text-muted">Surat Diterbitkan</small>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card card-custom p-3 text-center">
                <div class="text-warning mb-1"><i class="fa-solid fa-clock fs-3"></i></div>
                <h4 class="fw-bold text-navy mb-0">< 15 Menit</h4>
                <small class="text-muted">Rata-rata Proses</small>
            </div>
        </div>
        <div class="col-md-3 col-6">
            <div class="card card-custom p-3 text-center">
                <div class="text-info mb-1"><i class="fa-solid fa-shield-halved fs-3"></i></div>
                <h4 class="fw-bold text-navy mb-0">100%</h4>
                <small class="text-muted">Gratis & Resmi</small>
            </div>
        </div>
    </div>

    <!-- Pilihan Surat Populer -->
    <div class="card card-custom p-4 mb-4">
        <h4 class="fw-bold text-navy mb-3"><i class="fa-solid fa-envelope-open-text text-warning me-2"></i>Layanan Surat Paling Sering Diajukan</h4>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="p-3 border rounded-3 bg-light h-100">
                    <span class="badge bg-primary mb-2">Paling Cepat</span>
                    <h6 class="fw-bold text-navy">Surat Keterangan Usaha (SKU)</h6>
                    <p class="small text-muted mb-3">Dibutuhkan untuk pengajuan kredit usaha rakyat (KUR), legalitas UMKM, atau izin usaha mikro.</p>
                    <a href="{{ route('surat.create') }}?jenis=sku" class="btn btn-sm btn-outline-primary fw-semibold rounded-pill">Ajukan SKU &raquo;</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 border rounded-3 bg-light h-100">
                    <span class="badge bg-success mb-2">Instan PDF</span>
                    <h6 class="fw-bold text-navy">Surat Keterangan Domisili (SKD)</h6>
                    <p class="small text-muted mb-3">Bukti domisili tempat tinggal sementara untuk keperluan kantor, bank, atau sekolah.</p>
                    <a href="{{ route('surat.create') }}?jenis=domisili" class="btn btn-sm btn-outline-success fw-semibold rounded-pill">Ajukan SKD &raquo;</a>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 border rounded-3 bg-light h-100">
                    <span class="badge bg-warning text-dark mb-2">Resmi</span>
                    <h6 class="fw-bold text-navy">Pengantar SKCK & Beasiswa (SKTM)</h6>
                    <p class="small text-muted mb-3">Surat pengantar kantor kepolisian atau pengajuan bantuan biaya pendidikan/beasiswa.</p>
                    <a href="{{ route('surat.create') }}?jenis=sktm" class="btn btn-sm btn-outline-warning text-dark fw-semibold rounded-pill">Ajukan SKTM &raquo;</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
