@extends('layouts.app')

@section('title', 'Permohonan Surat Warga Online - SIDESA')

@section('content')
<div class="container" style="max-width: 760px;">
    <div class="card card-custom p-4 p-md-5">
        <div class="text-center mb-4">
            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill fw-bold">Form Permohonan Online</span>
            <h3 class="fw-bold text-navy mt-2 mb-1">Pengajuan Surat Warga Desa</h3>
            <p class="text-muted small">Isi data di bawah dengan benar. Dokumen resmi akan diverifikasi oleh operator desa.</p>
        </div>

        <form action="{{ route('surat.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label fw-bold text-navy">Nomor Induk Kependudukan (NIK) <span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" name="nik" class="form-control" placeholder="Contoh: 7401051203990001" maxlength="16" required>
                    <button class="btn btn-outline-secondary" type="button" onclick="alert('Data NIK Terdaftar di Basis Data Desa Mandiri')"><i class="fa-solid fa-check text-success"></i> Cek NIK</button>
                </div>
                <small class="text-muted">Pastikan 16 digit sesuai Kartu Tanda Penduduk (KTP).</small>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold text-navy">Nama Lengkap Pemohon <span class="text-danger">*</span></label>
                <input type="text" name="nama" class="form-control" placeholder="Nama lengkap sesuai KTP" required>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-bold text-navy">No. WhatsApp Aktif <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fa-brands fa-whatsapp text-success"></i></span>
                        <input type="tel" name="whatsapp" class="form-control" placeholder="0822xxxxxxxx" required>
                    </div>
                    <small class="text-muted">Notifikasi & PDF surat dikirim ke WA ini.</small>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-bold text-navy">Pilih Jenis Surat <span class="text-danger">*</span></label>
                    <select name="jenis_surat" class="form-select" required>
                        <option value="">-- Pilih Jenis Surat --</option>
                        <option value="Surat Keterangan Domisili">Surat Keterangan Domisili</option>
                        <option value="Surat Keterangan Usaha (SKU)">Surat Keterangan Usaha (SKU)</option>
                        <option value="Surat Pengantar SKCK">Surat Pengantar SKCK</option>
                        <option value="Surat Keterangan Tidak Mampu (SKTM)">Surat Keterangan Tidak Mampu (SKTM)</option>
                        <option value="Surat Keterangan Kematian">Surat Keterangan Kematian</option>
                    </select>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold text-navy">Keperluan Pengajuan <span class="text-danger">*</span></label>
                <textarea name="keperluan" class="form-control" rows="3" placeholder="Contoh: Untuk persyaratan pengajuan KUR Bank BRI Unit Poleang Barat." required></textarea>
            </div>

            <button type="submit" class="btn btn-warning w-100 fw-bold py-2.5 rounded-3 text-navy shadow-sm">
                <i class="fa-solid fa-paper-plane me-2"></i> Kirim Permohonan Surat
            </button>
        </form>
    </div>
</div>
@endsection
