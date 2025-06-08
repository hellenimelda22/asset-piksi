<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\KategoriAset;
use App\Models\PeminjamanAset;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
{
    $jumlahAset = Asset::count();
    $jumlahKategori = KategoriAset::count();
    $jumlahPeminjaman = PeminjamanAset::count();

    $jumlahDipinjam = PeminjamanAset::where('status', 'Dipinjam')
                        ->distinct('aset_id')
                        ->count('aset_id');

    $jumlahBaik = Asset::where('kondisi', 'Baik')->count();
    $jumlahRusakRingan = Asset::where('kondisi', 'Rusak Ringan')->count();
    $jumlahRusakBerat = Asset::where('kondisi', 'Rusak Berat')->count();
    $jumlahDalamPerbaikan = Asset::where('kondisi', 'Dalam Perbaikan')->count();
    $jumlahAktif = Asset::where('kondisi', 'Aktif')->count();

    $peminjamanTerbaru = PeminjamanAset::with('aset')
                            ->latest()
                            ->take(5)
                            ->get();

    // ✅ Jumlah aset per kategori via kategori (relasi resmi)
    $jumlahAsetPerKategori = KategoriAset::withCount('aset')->pluck('aset_count', 'nama_kategori');

    return view('dashboard', compact(
        'jumlahAset',
        'jumlahKategori',
        'jumlahPeminjaman',
        'jumlahDipinjam',
        'jumlahBaik',
        'jumlahRusakRingan',
        'jumlahRusakBerat',
        'jumlahDalamPerbaikan',
        'jumlahAktif',
        'peminjamanTerbaru',
        'jumlahAsetPerKategori'
    ));
}
}