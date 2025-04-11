<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\KategoriAset;
use App\Models\PeminjamanAset;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik ringkasan
        $totalAset       = Asset::count();
        $totalKategori   = KategoriAset::count();
        $totalPeminjaman = PeminjamanAset::count();
        $totalDipinjam   = PeminjamanAset::where('status', 'Dipinjam')->count();

        // Statistik kondisi aset
        $asetBaik  = Asset::where('kondisi', 'Baik')->count();
        $asetRusak = Asset::where('kondisi', 'Rusak')->count();

        // 5 peminjaman terbaru
        $peminjamanTerbaru = PeminjamanAset::with('aset')
                                ->latest()
                                ->take(5)
                                ->get();

        // Kirim data ke view dashboard
        return view('dashboard', compact(
            'totalAset',
            'totalKategori',
            'totalPeminjaman',
            'totalDipinjam',
            'asetBaik',
            'asetRusak',
            'peminjamanTerbaru'
        ));
    }
}
