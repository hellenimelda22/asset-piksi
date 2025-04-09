<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aset;
use App\Models\KategoriAset;
use App\Models\PeminjamanAset;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data statistik yang dibutuhkan
        return view('dashboard', [
            'total_aset' => Aset::count(),
            'total_kategori' => KategoriAset::count(),
            'total_peminjaman' => PeminjamanAset::where('status', 'Dipinjam')->count(),
            'total_aset_baik' => Aset::where('kondisi', 'Baik')->count(),
            'total_aset_rusak' => Aset::where('kondisi', 'Rusak')->count(),
        ]);
    }
}
