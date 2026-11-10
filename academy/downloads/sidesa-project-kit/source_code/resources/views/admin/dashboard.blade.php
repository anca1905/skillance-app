@extends('layouts.app')

@section('title', 'Panel Admin & Aparatur Desa - SIDESA')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <span class="badge bg-danger px-3 py-1.5 rounded-pill fw-bold">Panel Aparatur Desa</span>
            <h3 class="fw-bold text-navy mt-1 mb-0">Dasbor Verifikasi Surat Masuk</h3>
        </div>
        <a href="{{ route('home') }}" class="btn btn-outline-navy btn-sm rounded-pill px-3"><i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Portal</a>
    </div>

    <!-- Table Pengajuan Masuk -->
    <div class="card card-custom p-4">
        <h5 class="fw-bold text-navy mb-3"><i class="fa-solid fa-inbox text-warning me-2"></i>Daftar Antrean Surat Warga Masuk</h5>
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Kode Resi</th>
                        <th>Tanggal</th>
                        <th>Nama Warga & NIK</th>
                        <th>Jenis Surat</th>
                        <th>Keperluan</th>
                        <th>Status</th>
                        <th>Aksi Aparatur</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge bg-secondary font-monospace">SRT-2026-8812</span></td>
                        <td class="small text-muted">10 Nov 2026</td>
                        <td>
                            <strong class="d-block text-navy">Muh. Arsyad Ramsi</strong>
                            <small class="text-muted">NIK: 7401051203990001</small>
                        </td>
                        <td><span class="badge bg-success-subtle text-success">Keterangan Domisili</span></td>
                        <td class="small">Persyaratan legalitas perusahaan PT</td>
                        <td><span class="badge bg-success">Selesai (Terbit)</span></td>
                        <td>
                            <a href="{{ route('surat.download', ['id' => 1]) }}" class="btn btn-sm btn-danger rounded-pill px-3">
                                <i class="fa-solid fa-file-pdf me-1"></i> Cetak PDF
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-secondary font-monospace">SRT-2026-8815</span></td>
                        <td class="small text-muted">10 Nov 2026</td>
                        <td>
                            <strong class="d-block text-navy">Rahmat Hidayat</strong>
                            <small class="text-muted">NIK: 7401051508980004</small>
                        </td>
                        <td><span class="badge bg-primary-subtle text-primary">Keterangan Usaha (SKU)</span></td>
                        <td class="small">Pengajuan pinjaman modal usaha warung</td>
                        <td><span class="badge bg-warning text-dark">Menunggu TTD Kades</span></td>
                        <td>
                            <button class="btn btn-sm btn-success rounded-pill px-3" onclick="alert('Surat Berhasil Ditandatangani dan Terbit Otomatis!')">
                                <i class="fa-solid fa-signature me-1"></i> Approve & TTD
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
