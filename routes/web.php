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
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // **Dashboard**
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // **Manajemen Aset**
    Route::resource('/aset', AsetController::class); // <- Sudah pakai "aset" ✅

    // **Manajemen Kategori Aset**
    Route::resource('/kategori', KategoriAsetController::class); // Ganti ke Route::resource untuk konsistensi

    // **Manajemen Peminjaman Aset**
    Route::prefix('peminjaman')->group(function() {
        Route::get('/', [PeminjamanAsetController::class, 'index'])->name('peminjaman.index');
        Route::get('/create', [PeminjamanAsetController::class, 'create'])->name('peminjaman.create');
        Route::post('/store', [PeminjamanAsetController::class, 'store'])->name('peminjaman.store');
        Route::get('/riwayat', [PeminjamanAsetController::class, 'riwayat'])->name('peminjaman.riwayat');
    });

    // **Laporan Routes**
    Route::prefix('laporan')->group(function() {
        Route::get('/', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/aset', [LaporanController::class, 'laporanAset'])->name('laporan.aset');
        Route::get('/peminjaman', [LaporanController::class, 'laporanPeminjaman'])->name('laporan.peminjaman');
        Route::get('/cetakPDF', [LaporanController::class, 'generatePDF'])->name('laporan.cetakPDF');
        Route::get('/aset/pdf', [LaporanController::class, 'cetakLaporanAset'])->name('laporan.aset.pdf');
        Route::get('/peminjaman/pdf', [LaporanController::class, 'cetakLaporanPeminjaman'])->name('laporan.peminjaman.pdf');

    });
});
