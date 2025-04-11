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
        // Ambil data statistik yang dibutuhkan
        return view('dashboard', [
            'total_aset' => Asset::count(),
            'total_kategori' => KategoriAset::count(),
            'total_peminjaman' => PeminjamanAset::where('status', 'Dipinjam')->count(),
            'total_aset_baik' => Asset::where('kondisi', 'Baik')->count(),
            'total_aset_rusak' => Asset::where('kondisi', 'Rusak')->count(),
        ]);
    }
}
