<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\KategoriAsetController;
use App\Http\Controllers\PeminjamanAsetController;
use App\Http\Controllers\LaporanController;


// Redirect ke halaman login jika tidak login
Route::get('/', function () {
    return redirect()->route('login');
});

// **Rute Autentikasi (Login, Register, Logout)**
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // **Dashboard**
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // **Manajemen Aset**
    Route::resource('/asset', AsetController::class);

    // **Manajemen Kategori Aset**
    Route::resource('/kategori', KategoriAsetController::class);

    // **Manajemen Peminjaman Aset**
    Route::resource('/peminjaman', PeminjamanAsetController::class);
    Route::post('/peminjaman/return/{id}', [PeminjamanAsetController::class, 'return'])->name('peminjaman.return');
    Route::post('/peminjaman/approve/{id}', [PeminjamanAsetController::class, 'approve'])->name('peminjaman.approve');

    // **Laporan & Statistik**
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/pdf', [LaporanController::class, 'generatePDF'])->name('laporan.pdf');
    Route::get('/laporan/excel', [LaporanController::class, 'generateExcel'])->name('laporan.excel');
});
