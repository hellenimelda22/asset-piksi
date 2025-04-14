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

// Rute Autentikasi (Login, Register, Logout)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

// Rute yang hanya bisa diakses setelah login
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Aset (termasuk tambah banyak)
    Route::get('/aset/tambah-banyak', [AsetController::class, 'createMultiple'])->name('aset.create_multiple');
    Route::post('/aset/store-multiple', [AsetController::class, 'storeMultiple'])->name('aset.store_multiple');
    Route::resource('/aset', AsetController::class);
    
    // (Opsional) Jika kamu ingin rute show aset tersedia (lihat detail aset)
    Route::get('/aset/{id}', [AsetController::class, 'show'])->name('aset.show');

    // Manajemen Kategori Aset
    Route::resource('/kategori', KategoriAsetController::class);

    // Manajemen Peminjaman Aset
    Route::prefix('peminjaman')->name('peminjaman.')->group(function () {
        Route::get('/', [PeminjamanAsetController::class, 'index'])->name('index');
        Route::get('/create', [PeminjamanAsetController::class, 'create'])->name('create');
        Route::post('/store', [PeminjamanAsetController::class, 'store'])->name('store');
        Route::patch('/{id}/kembalikan', [PeminjamanAsetController::class, 'kembalikan'])->name('kembalikan');
    });

    // Laporan
    Route::prefix('laporan')->name('laporan.')->group(function () {
        Route::get('/', [LaporanController::class, 'index'])->name('index');
        Route::get('/aset', [LaporanController::class, 'laporanAset'])->name('aset');
        Route::get('/peminjaman', [LaporanController::class, 'laporanPeminjaman'])->name('peminjaman');
        Route::get('/cetakPDF', [LaporanController::class, 'generatePDF'])->name('cetakPDF');
        Route::get('/aset/pdf', [LaporanController::class, 'cetakLaporanAset'])->name('aset.pdf');
        Route::get('/peminjaman/pdf', [LaporanController::class, 'cetakLaporanPeminjaman'])->name('peminjaman.pdf');
    });
    Route::get('/coba-tambah', function () {
        return 'Route berhasil!';
    });
    
});
