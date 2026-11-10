<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\ApbdesController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes - SIDESA Laravel 10 & Blade HTML5
|--------------------------------------------------------------------------
*/

// Portal Warga
Route::get('/', [HomeController::class, 'index'])->name('home');

// Layanan Surat Online
Route::get('/surat/buat', [SuratController::class, 'create'])->name('surat.create');
Route::post('/surat/buat', [SuratController::class, 'store'])->name('surat.store');
Route::get('/surat/lacak', [SuratController::class, 'track'])->name('surat.track');
Route::get('/surat/download/{id}', [SuratController::class, 'downloadPdf'])->name('surat.download');

// Transparansi APBDes
Route::get('/apbdes', [ApbdesController::class, 'index'])->name('apbdes');

// Panel Admin Desa
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
