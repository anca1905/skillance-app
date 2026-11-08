<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WargaPortalController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\APBDesController;
use App\Http\Controllers\AdminDashboardController;

// --- PORTAL PUBLIK WARGA ---
Route::get('/', [WargaPortalController::class, 'index'])->name('home');
Route::post('/portal/cek-nik', [WargaPortalController::class, 'cekNik'])->name('warga.cek-nik');
Route::post('/portal/ajukan-surat', [WargaPortalController::class, 'ajukanSurat'])->name('warga.ajukan-surat');
Route::get('/tracking', [WargaPortalController::class, 'trackingPage'])->name('warga.tracking');
Route::get('/tracking/{kode}', [WargaPortalController::class, 'trackingDetail'])->name('warga.tracking.detail');
Route::get('/apbdes-publik', [APBDesController::class, 'publik'])->name('apbdes.publik');

// --- VERIFIKASI QR CODE RESMI (PUBLIK) ---
Route::get('/verifikasi-surat/{token}', [SuratController::class, 'verifikasiQr'])->name('surat.verifikasi-qr');
Route::get('/surat/download-pdf/{kode}', [SuratController::class, 'downloadPdf'])->name('surat.download-pdf');

// --- DASBOR APARATUR DESA (ADMIN & PETUGAS) ---
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    
    // Manajemen Penduduk & KK
    Route::resource('penduduk', PendudukController::class);
    
    // Verifikasi & Penandatanganan Surat
    Route::get('/surat', [SuratController::class, 'adminIndex'])->name('admin.surat.index');
    Route::get('/surat/{id}', [SuratController::class, 'show'])->name('admin.surat.show');
    Route::post('/surat/{id}/verifikasi', [SuratController::class, 'verifikasi'])->name('admin.surat.verifikasi');
    Route::post('/surat/{id}/tandatangani', [SuratController::class, 'tandatangani'])->name('admin.surat.tandatangani');
    Route::post('/surat/{id}/tolak', [SuratController::class, 'tolak'])->name('admin.surat.tolak');

    // Manajemen Transparansi APBDes
    Route::resource('apbdes', APBDesController::class);
});
