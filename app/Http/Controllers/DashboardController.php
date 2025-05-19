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

        // ✅ Jumlah aset yang masih dipinjam (status Dipinjam dan unik per aset)
        $jumlahDipinjam = PeminjamanAset::where('status', 'Dipinjam')
                            ->distinct('aset_id')
                            ->count('aset_id');

        // ✅ Jumlah berdasarkan kondisi
        $jumlahBaik = Asset::where('kondisi', 'Baik')->count();
        $jumlahRusakRingan = Asset::where('kondisi', 'Rusak Ringan')->count();
        $jumlahRusakBerat = Asset::where('kondisi', 'Rusak Berat')->count();

        // ✅ Ambil peminjaman terbaru (misal 5 terakhir)
        $peminjamanTerbaru = PeminjamanAset::with('aset')
                                ->latest()->take(5)->get();

        return view('dashboard', compact(
            'jumlahAset',
            'jumlahKategori',
            'jumlahPeminjaman',
            'jumlahDipinjam',
            'jumlahBaik',
            'jumlahRusakRingan',
            'jumlahRusakBerat',
            'peminjamanTerbaru'
        ));
    }
}