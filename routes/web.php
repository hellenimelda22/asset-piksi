<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\KategoriAsetController;
use App\Http\Controllers\PeminjamanAsetController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

// 🔒 Redirect ke login
Route::get('/', fn () => redirect()->route('login'));

// 🔐 Autentikasi untuk tamu (guest)
Route::middleware('guest')->group(function () {
    // Login & Register
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    // 🔑 Reset Password
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
});

// 🔐 Setelah login (auth)
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 📦 Manajemen Aset
    Route::prefix('aset')->name('aset.')->group(function () {
        Route::get('/', [AsetController::class, 'index'])->name('index');
        Route::get('/create', [AsetController::class, 'create'])->name('create');
        Route::post('/', [AsetController::class, 'store'])->name('store');

        // ➕ Tambah Banyak Aset
        Route::get('/tambah-banyak', [AsetController::class, 'createMultiple'])->name('create_multiple');
        Route::post('/tambah-banyak', [AsetController::class, 'storeMultiple'])->name('store-multiple');

        // 🔍 Detail, Edit, Hapus
        Route::get('/{id}', [AsetController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AsetController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AsetController::class, 'update'])->name('update');
        Route::delete('/{id}', [AsetController::class, 'destroy'])->name('destroy');
    });

    // 🗂️ Kategori Aset
    Route::resource('kategori', KategoriAsetController::class);

    // 📋 Peminjaman Aset
    Route::prefix('peminjaman')->name('peminjaman.')->group(function () {
        Route::get('/', [PeminjamanAsetController::class, 'index'])->name('index');
        Route::get('/create', [PeminjamanAsetController::class, 'create'])->name('create');
        Route::post('/', [PeminjamanAsetController::class, 'store'])->name('store');
        Route::patch('/{id}/kembalikan', [PeminjamanAsetController::class, 'kembalikan'])->name('kembalikan');
    });

    // 📄 Laporan
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/aset', [LaporanController::class, 'laporanAset'])->name('aset');
        Route::get('/peminjaman', [LaporanController::class, 'laporanPeminjaman'])->name('peminjaman');
        Route::get('/gabungan', [LaporanController::class, 'laporanGabungan'])->name('gabungan');

        // 🖨️ Cetak PDF
        Route::get('/aset/pdf', [LaporanController::class, 'cetakLaporanAset'])->name('aset.pdf');
        Route::get('/peminjaman/pdf', [LaporanController::class, 'cetakLaporanPeminjaman'])->name('peminjaman.pdf');
        Route::get('/gabungan/pdf', [LaporanController::class, 'cetakLaporanGabungan'])->name('gabungan.pdf');
    });

    // 👤 Profile
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'show'])->name('show');
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/', [ProfileController::class, 'update'])->name('update');
        Route::get('/password', [ProfileController::class, 'password'])->name('password');
        Route::put('/password/update', [ProfileController::class, 'updatePassword'])->name('password.update');
    });
});
