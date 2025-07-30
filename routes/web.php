<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\AuthController;

// Halaman utama
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
})->name('home');

// Login
Route::get('/login', [AuthController::class, 'index'])
    ->middleware('guest')
    ->name('login');

Route::post('/login', [AuthController::class, 'postLogin'])
    ->middleware('guest')
    ->name('login.post');

// Register
Route::get('/register', [AuthController::class, 'registration'])
    ->middleware('guest')
    ->name('register');

Route::post('/register', [AuthController::class, 'postRegistration'])
    ->middleware('guest')
    ->name('register.post');

// Dashboard
Route::get('/dashboard', [AuthController::class, 'dashboard'])
    ->middleware('auth')
    ->name('dashboard');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


//halaman admin
Route::get('/test', function () {
    return view('halaman_admin.test');
});    
