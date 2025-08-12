<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ReferensiController;
use App\Http\Controllers\LaporanPerbulanController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MentorController;
use App\Http\Controllers\Admin\PesertaMagangController;
use App\Http\Controllers\Admin\DokumenController;
use App\Http\Controllers\Admin\KalenderMagangController;
use App\Http\Controllers\Admin\CalonPesertaController;

// ===================== HALAMAN UTAMA =====================
Route::get('/', function () {
    if (Auth::guard('peserta')->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('home');

// ===================== AUTH PESERTA =====================
// LOGIN
Route::get('/login', [AuthController::class, 'index'])
    ->middleware('guest:peserta')
    ->name('login');

Route::post('/login', [AuthController::class, 'postLogin'])
    ->middleware('guest:peserta')
    ->name('login.post');

// REGISTER
Route::get('/register', [AuthController::class, 'registration'])
    ->middleware('guest:peserta')
    ->name('register');

Route::post('/register', [AuthController::class, 'postRegistration'])
    ->middleware('guest:peserta')
    ->name('register.post');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:peserta')
    ->name('logout');

// ===================== DASHBOARD PESERTA =====================
Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->middleware('auth:peserta')
    ->name('dashboard');

// ===================== REFERENSI PESERTA =====================
Route::post('/referensi/upload', [ReferensiController::class, 'upload'])
    ->middleware('auth:peserta')
    ->name('referensi.upload');

Route::middleware(['auth:peserta'])->prefix('peserta')->group(function () {
    Route::get('/laporan-akhir', [App\Http\Controllers\Peserta\LaporanAkhirController::class, 'index'])->name('peserta.laporan-akhir.index');
    Route::post('/laporan-akhir', [App\Http\Controllers\Peserta\LaporanAkhirController::class, 'store'])->name('peserta.laporan-akhir.store');
    });

// ===================== LAPORAN PERBULAN =====================
Route::middleware('auth:peserta')->group(function () {
    Route::get('/laporan', [LaporanPerbulanController::class, 'index'])->name('laporan.index');
    Route::post('/laporan/upload', [LaporanPerbulanController::class, 'upload'])->name('laporan.upload');
    Route::get('/laporan/download/{file}', [LaporanPerbulanController::class, 'download'])->name('laporan.download');
});


// ===================== ADMIN SECTION =====================
Route::prefix('dashboard_admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard.admin.index');
});

// ========== MANAJEMEN MENTOR ==========
Route::prefix('manajemen_mentor')->group(function () {
    Route::get('/', [MentorController::class, 'index'])->name('mentor.index');
    Route::get('/create', [MentorController::class, 'create'])->name('mentor.create');
    Route::post('/', [MentorController::class, 'store'])->name('mentor.store');
    Route::get('/{id}/edit', [MentorController::class, 'edit'])->name('mentor.edit');
    Route::put('/{id}', [MentorController::class, 'update'])->name('mentor.update');
    Route::delete('/{id}', [MentorController::class, 'destroy'])->name('mentor.destroy');
});

// ========== MANAJEMEN PESERTA MAGANG ==========
Route::prefix('manajemen_peserta_magang')->group(function () {
    Route::get('/', [PesertaMagangController::class, 'index'])->name('peserta.index');
    Route::get('/create', [PesertaMagangController::class, 'create'])->name('peserta.create');
    Route::post('/', [PesertaMagangController::class, 'store'])->name('peserta.store');
    Route::get('/{id}/edit', [PesertaMagangController::class, 'edit'])->name('peserta.edit');
    Route::put('/{id}', [PesertaMagangController::class, 'update'])->name('peserta.update');
    Route::get('/{id}', [PesertaMagangController::class, 'show'])->name('peserta.show');
    Route::delete('/{id}', [PesertaMagangController::class, 'destroy'])->name('peserta.destroy');
    Route::patch('/{id}/status', [PesertaMagangController::class, 'updateStatus'])->name('admin.peserta.updateStatus');
});

// ========== KALENDER MAGANG ==========
Route::prefix('kalender_magang')->group(function () {
    Route::get('/', [KalenderMagangController::class, 'index'])->name('kalender.index');
    Route::get('/data-kalender', [KalenderMagangController::class, 'getData'])->name('kalender.data');
});

// ========== MANAJEMEN DOKUMEN ==========
Route::prefix('manajemen_laporan')->group(function () {
    Route::get('/', [DokumenController::class, 'index'])->name('dokumen.index');
    Route::get('/create', [DokumenController::class, 'create'])->name('dokumen.create');
    Route::post('/', [DokumenController::class, 'store'])->name('dokumen.store');
    Route::delete('/', [DokumenController::class, 'destroyAll'])->name('dokumen.destroy.all');
});

// ========== CALON PESERTA ==========
Route::prefix('calon_peserta')->group(function () {
    Route::get('/', [CalonPesertaController::class, 'index'])->name('calon.index');
});

// ========== DASHBOARD PESERTA (Admin Lihat) ==========
Route::prefix('dashboard_peserta')->group(function () {
    Route::get('/', [DashboardController::class, 'indexPeserta'])->name('peserta.dashboard');
});

// ========== TEST PAGE ==========
Route::get('/test', function () {
    return view('halaman_admin.test');
});
