<?php

use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\KetuaAuthController;
use App\Http\Controllers\KetuaDashboardController;

Route::get('/', [LandingController::class, 'index'])->name('home');
Route::get('/pengaduan', [PengaduanController::class, 'index'])->name('pengaduan.index');
Route::get('/pengaduan/buat', [PengaduanController::class, 'create'])->name('pengaduan.create');
Route::get('/pengaduan/ketua-anggota', [PengaduanController::class, 'daftarKetuaAnggota'])->name('pengaduan.ketua-anggota');
Route::post('/pengaduan', [PengaduanController::class, 'store'])->name('pengaduan.store');
Route::get('/pengaduan/{pengaduan}', [PengaduanController::class, 'show'])->name('pengaduan.show');
Route::patch('/pengaduan/{pengaduan}/status', [PengaduanController::class, 'updateStatus'])
    ->middleware('admin.basic')
    ->name('pengaduan.update-status');
Route::patch('/pengaduan/{pengaduan}/ketua', [PengaduanController::class, 'assignKetua'])
    ->middleware('admin.basic')
    ->name('pengaduan.assign-ketua');
Route::patch('/pengaduan/{pengaduan}/anggota', [PengaduanController::class, 'assignAnggota'])
    ->middleware('admin.basic')
    ->name('pengaduan.assign-anggota');
Route::delete('/pengaduan/{pengaduan}', [PengaduanController::class, 'destroy'])
    ->middleware('admin.basic')
    ->name('pengaduan.destroy');

// Routes untuk Ketua
Route::get('/ketua/login', [KetuaAuthController::class, 'showLogin'])->name('ketua.login');
Route::post('/ketua/login', [KetuaAuthController::class, 'login'])->name('ketua.login.post');
Route::post('/ketua/logout', [KetuaAuthController::class, 'logout'])->name('ketua.logout');
Route::get('/ketua/dashboard', [KetuaDashboardController::class, 'dashboard'])->name('ketua.dashboard');
Route::get('/ketua/pengaduan/{pengaduan}', [KetuaDashboardController::class, 'show'])->name('ketua.show');
Route::patch('/ketua/pengaduan/{pengaduan}/anggota', [KetuaDashboardController::class, 'assignAnggota'])->name('ketua.assign-anggota');

// Routes untuk Anggota
Route::get('/anggota/login', [\App\Http\Controllers\AnggotaAuthController::class, 'showLogin'])->name('anggota.login');
Route::post('/anggota/login', [\App\Http\Controllers\AnggotaAuthController::class, 'login'])->name('anggota.login.post');
Route::post('/anggota/logout', [\App\Http\Controllers\AnggotaAuthController::class, 'logout'])->name('anggota.logout');
Route::get('/anggota/dashboard', [\App\Http\Controllers\AnggotaDashboardController::class, 'dashboard'])->name('anggota.dashboard');
Route::get('/anggota/pengaduan/{pengaduan}', [\App\Http\Controllers\AnggotaDashboardController::class, 'show'])->name('anggota.show');
Route::patch('/anggota/pengaduan/{pengaduan}/status', [\App\Http\Controllers\AnggotaDashboardController::class, 'updateStatus'])->name('anggota.update-status');
