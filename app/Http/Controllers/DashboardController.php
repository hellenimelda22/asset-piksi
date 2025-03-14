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
        $total_aset = Aset::count();
        $total_kategori = KategoriAset::count();
        $total_peminjaman = PeminjamanAset::where('status', 'Dipinjam')->count();

        // Statistik kondisi aset
        $aset_baik = Aset::where('kondisi', 'Baik')->count();
        $aset_rusak = Aset::where('kondisi', 'Rusak')->count();

        return view('dashboard', compact('total_aset', 'total_kategori', 'total_peminjaman', 'aset_baik', 'aset_rusak'));
    }
}
