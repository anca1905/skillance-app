@extends('layouts.app')

@section('title', 'Transparansi APBDes - SIDESA Mandiri')

@section('content')
<div class="container">
    <div class="text-center mb-5">
        <span class="badge bg-warning text-navy px-3 py-2 rounded-pill fw-bold">Transparansi Publik</span>
        <h2 class="fw-bold text-navy mt-2">Laporan Anggaran Pendapatan & Belanja Desa (APBDes)</h2>
        <p class="text-muted">Wujud keterbukaan informasi publik dan akuntabilitas keuangan Pemerintah Desa Tahun Anggaran 2026.</p>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="card card-custom p-4 bg-primary text-white h-100">
                <h6 class="text-white-50 text-uppercase fw-bold">Total Pendapatan Desa</h6>
                <h3 class="fw-bold my-2">Rp 1.455.000.000</h3>
                <small class="text-white-50"><i class="fa-solid fa-check-circle me-1"></i> Dana Desa (DDS) + ADD + PADes</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom p-4 bg-success text-white h-100">
                <h6 class="text-white-50 text-uppercase fw-bold">Total Belanja Desa</h6>
                <h3 class="fw-bold my-2">Rp 1.380.000.000</h3>
                <small class="text-white-50"><i class="fa-solid fa-hammer me-1"></i> Pembangunan Fisik & Pemberdayaan</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-custom p-4 bg-navy text-white h-100">
                <h6 class="text-white-50 text-uppercase fw-bold">Sisa Lebih Pembiayaan (SILPA)</h6>
                <h3 class="fw-bold text-gold my-2">Rp 75.000.000</h3>
                <small class="text-white-50"><i class="fa-solid fa-wallet me-1"></i> Cadangan Kas Kas Desa</small>
            </div>
        </div>
    </div>

    <!-- Rincian Pos Belanja -->
    <div class="card card-custom p-4 mb-4">
        <h5 class="fw-bold text-navy mb-4"><i class="fa-solid fa-chart-bar text-warning me-2"></i>Rincian Serapan Belanja Desa per Bidang</h5>
        
        <div class="mb-3">
            <div class="d-flex justify-content-between small fw-bold mb-1">
                <span>1. Bidang Pelaksanaan Pembangunan Desa (Drainase, Jalan Tani, Air Bersih)</span>
                <span class="text-primary">Rp 650.000.000 (88%)</span>
            </div>
            <div class="progress" style="height: 12px;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 88%"></div>
            </div>
        </div>

        <div class="mb-3">
            <div class="d-flex justify-content-between small fw-bold mb-1">
                <span>2. Bidang Penyelenggaraan Pemerintahan Desa (Operasional & Aparatur)</span>
                <span class="text-success">Rp 380.000.000 (95%)</span>
            </div>
            <div class="progress" style="height: 12px;">
                <div class="progress-bar bg-success" role="progressbar" style="width: 95%"></div>
            </div>
        </div>

        <div class="mb-3">
            <div class="d-flex justify-content-between small fw-bold mb-1">
                <span>3. Bidang Pembinaan & Pemberdayaan Masyarakat (UMKM, Posyandu, Karang Taruna)</span>
                <span class="text-warning">Rp 250.000.000 (78%)</span>
            </div>
            <div class="progress" style="height: 12px;">
                <div class="progress-bar bg-warning" role="progressbar" style="width: 78%"></div>
            </div>
        </div>

        <div class="mb-2">
            <div class="d-flex justify-content-between small fw-bold mb-1">
                <span>4. Bidang Penanggulangan Bencana & Mendesak (BLT Dana Desa)</span>
                <span class="text-danger">Rp 100.000.000 (100%)</span>
            </div>
            <div class="progress" style="height: 12px;">
                <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"></div>
            </div>
        </div>
    </div>
</div>
@endsection
