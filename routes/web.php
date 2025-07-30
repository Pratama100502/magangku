<?php

use App\Http\Controllers\Admin\MentorController;
use App\Http\Controllers\Admin\PesertaMagangController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;


// Halaman utama
Route::get('/', function () {
    if (Auth::guard('peserta')->check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('home');

// LOGIN
Route::get('/login', [AuthController::class, 'index'])
    ->middleware('guest:peserta')
    ->name('login');

Route::post('/login', [AuthController::class, 'postLogin'])
    ->middleware('guest:peserta')
    ->name('login.post');

// REGISTER
Route::get('/register', [AuthController::class, 'registration'])
    ->middleware('guest:peserta') // konsisten pakai guard peserta
    ->name('register');

Route::post('/register', [AuthController::class, 'postRegistration'])
    ->middleware('guest:peserta')
    ->name('register.post');

// DASHBOARD (hanya untuk peserta yang sudah login)
Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->middleware('auth:peserta')
    ->name('dashboard');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:peserta')
    ->name('logout');

// Halaman Admin (Contoh)
Route::get('/test', function () {
    return view('halaman_admin.test');
});

// Manajemen Mentor
Route::prefix('manajemen_mentor')->group(function () {
    Route::get('/', [MentorController::class, 'index'])->name('mentor.index');
    Route::get('/create', [MentorController::class, 'create'])->name('mentor.create');
    Route::post('/', [MentorController::class, 'store'])->name('mentor.store');
    Route::get('/{id}/edit', [MentorController::class, 'edit'])->name('mentor.edit');
    Route::put('/{id}', [MentorController::class, 'update'])->name('mentor.update');
    Route::delete('/{id}', [MentorController::class, 'destroy'])->name('mentor.destroy');
});

// Manajemen Peserta Magang
Route::prefix('manajemen_peserta_magang')->group(function () {
    Route::get('/', [PesertaMagangController::class, 'index'])->name('peserta.index');
    Route::get('/create', [PesertaMagangController::class, 'create'])->name('peserta.create');
    Route::post('/', [PesertaMagangController::class, 'store'])->name('peserta.store');
    Route::get('/{id}/edit', [PesertaMagangController::class, 'edit'])->name('peserta.edit');
    Route::put('/{id}', [PesertaMagangController::class, 'update'])->name('peserta.update');
    Route::get('/{id}', [PesertaMagangController::class, 'show'])->name('peserta.show');
    Route::delete('/{id}', [PesertaMagangController::class, 'destroy'])->name('peserta.destroy');
}); 