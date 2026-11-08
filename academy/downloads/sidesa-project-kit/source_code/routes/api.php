<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WargaPortalController;
use App\Http\Controllers\APBDesController;

Route::get('/apbdes/chart-data', [APBDesController::class, 'chartData']);
Route::get('/surat/status/{kode}', [WargaPortalController::class, 'apiTrackingStatus']);
