@extends('layouts.app')

@section('title', 'Lacak Status Pengajuan Surat - SIDESA')

@section('content')
<div class="container" style="max-width: 760px;">
    <div class="card card-custom p-4 p-md-5 mb-4">
        <div class="text-center mb-4">
            <span class="badge bg-success bg-opacity-10 text-success px-3 py-2 rounded-pill fw-bold">Lacak Realtime</span>
            <h3 class="fw-bold text-navy mt-2 mb-1">Cek Status Pengajuan Surat</h3>
            <p class="text-muted small">Masukkan Nomor Resi / Kode Unik atau NIK Anda untuk melacak progress verifikasi.</p>
        </div>

        <form action="{{ route('surat.track') }}" method="GET" class="mb-4">
            <div class="input-group input-group-lg">
                <input type="text" name="resi" class="form-control" placeholder="Contoh: SRT-2026-8812 atau 16 digit NIK" value="{{ request('resi') }}">
                <button class="btn btn-navy fw-bold px-4" type="submit"><i class="fa-solid fa-magnifying-glass me-1"></i> Lacak</button>
            </div>
        </form>

        <!-- Contoh Hasil Tracking -->
        <div class="p-4 border rounded-4 bg-light">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <span class="badge bg-success px-3 py-2 rounded-pill"><i class="fa-solid fa-circle-check me-1"></i> Surat Selesai & Terbit</span>
                    <h5 class="fw-bold text-navy mt-2 mb-0">Surat Keterangan Domisili</h5>
                    <small class="text-muted">No. Resi: <strong>SRT-2026-8812</strong></small>
                </div>
                <a href="{{ route('surat.download', ['id' => 1]) }}" class="btn btn-danger fw-bold rounded-pill px-3 shadow-sm">
                    <i class="fa-solid fa-file-pdf me-1"></i> Unduh PDF Resmi
                </a>
            </div>

            <div class="timeline-step p-3 bg-white rounded-3 border mb-3">
                <div class="d-flex align-items-center gap-3 mb-2">
                    <i class="fa-solid fa-circle-check text-success fs-5"></i>
                    <div>
                        <strong class="d-block text-navy small">1. Permohonan Warga Terkirim</strong>
                        <small class="text-muted">10 Nov 2026, 09:15 WITA - Berkas diterima sistem</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3 mb-2">
                    <i class="fa-solid fa-circle-check text-success fs-5"></i>
                    <div>
                        <strong class="d-block text-navy small">2. Diverifikasi oleh Operator Kasi Pelayanan</strong>
                        <small class="text-muted">10 Nov 2026, 09:28 WITA - NIK & KK dinyatakan valid</small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <i class="fa-solid fa-circle-check text-success fs-5"></i>
                    <div>
                        <strong class="d-block text-navy small">3. Ditandatangani Digital oleh Kepala Desa (QR Code Valid)</strong>
                        <small class="text-muted">10 Nov 2026, 09:35 WITA - Surat resmi diterbitkan dan notifikasi WA terkirim</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
