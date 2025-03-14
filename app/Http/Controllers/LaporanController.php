<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aset;
use App\Models\PeminjamanAset;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $kategori = $request->kategori;
        $nama = $request->nama;

        $query = Aset::query();

        if ($kategori) {
            $query->where('kategori_id', $kategori);
        }

        if ($nama) {
            $query->where('nama_aset', 'LIKE', "%$nama%");
        }

        $aset = $query->with('kategori')->get();
        $peminjaman = PeminjamanAset::with('aset', 'user')->get();

        return view('laporan.index', compact('aset', 'peminjaman'));
    }

    public function generatePDF()
    {
        $aset = Aset::with('kategori')->get();
        $peminjaman = PeminjamanAset::with('aset', 'user')->get();

        $pdf = Pdf::loadView('laporan.pdf', compact('aset', 'peminjaman'));

        return $pdf->download('laporan_aset.pdf');
    }
}
