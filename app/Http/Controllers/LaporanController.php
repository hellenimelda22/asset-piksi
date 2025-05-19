<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Asset;
use App\Models\PeminjamanAset;
use App\Models\KategoriAset;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $aset = Asset::query();
    
        if ($request->filled('kategori_id')) {
            $aset->where('kategori_id', $request->kategori_id);
        }
    
        if ($request->filled('nama_aset')) {
            $aset->where('nama_aset', 'like', '%' . $request->nama_aset . '%');
        }
    
        if ($request->filled('lokasi')) {
            $aset->where('lokasi', 'like', '%' . $request->lokasi . '%');
        }
    
        if ($request->filled('kondisi')) {
            $aset->where('kondisi', $request->kondisi);
        }
    
        $data = [
            'aset' => $aset->get(),
            'kategoriData' => KategoriAset::all()
        ];
    
        return view('laporan.index', $data);
    }
    

    // Method untuk generate PDF gabungan
    public function generatePDF(Request $request)
    {
        $aset = Asset::all();
        $peminjaman = PeminjamanAset::query();

        if ($request->has('status')) {
            $peminjaman->where('status', $request->input('status'));
        }

        $peminjaman = $peminjaman->get();

        $pdf = Pdf::loadView('laporan.pdf', compact('aset', 'peminjaman'));
        return $pdf->download('laporan_aset_peminjaman.pdf');
    }

    // Laporan peminjaman (tampilan halaman)
   public function laporanPeminjaman(Request $request)
{
    $peminjaman = PeminjamanAset::with('aset');

    if ($request->filled('status')) {
        $peminjaman->where('status', $request->status);
    }

    if ($request->filled('nama_peminjam')) {
        $peminjaman->where('nama_peminjam', 'like', '%' . $request->nama_peminjam . '%');
    }

    if ($request->filled('tanggal_pinjam')) {
        $peminjaman->whereDate('tanggal_pinjam', $request->tanggal_pinjam);
    }

    $peminjaman = $peminjaman->get();

    return view('laporan.peminjaman', compact('peminjaman'));
}


    // Laporan aset (tampilan halaman)
    public function laporanAset(Request $request)
    {
        $kategoriData = KategoriAset::all();
    
        $aset = Asset::query();
    
        // Filter berdasarkan kategori
        if ($request->filled('kategori_id')) {
            $aset->where('kategori_id', $request->kategori_id);
        }
    
        // Filter berdasarkan nama aset (LIKE)
        if ($request->filled('nama_aset')) {
            $aset->where('nama_aset', 'like', '%' . $request->nama_aset . '%');
        }
    
        $aset = $aset->get();
    
        return view('laporan.index', compact('aset', 'kategoriData'));
    }
    
    public function laporanGabungan()
    {
        $aset = Asset::all();
        $peminjaman = PeminjamanAset::with('aset')->get();
    
        return view('laporan.laporan_gabungan', compact('aset', 'peminjaman'));
    }
    


    // Cetak PDF laporan aset
    public function cetakLaporanAset()
    {
        $aset = Asset::all();
        $pdf = Pdf::loadView('laporan.laporan_aset', compact('aset'));
        return $pdf->stream('laporan-aset.pdf');
    }

    // Cetak PDF laporan peminjaman
    public function cetakLaporanPeminjaman()
    {
        $peminjaman = PeminjamanAset::with('aset')->get();
        $pdf = Pdf::loadView('laporan.laporan_peminjaman', compact('peminjaman'));
        return $pdf->stream('laporan-peminjaman.pdf');
    }
    public function cetakLaporanGabungan() 
    {
        $aset = AsSet::with('kategori')->get();
        $peminjaman = PeminjamanAset::with('aset')->get();
        $pdf = Pdf::loadView('laporan.laporan_gabungan_pdf', compact('aset', 'peminjaman'));
        return $pdf->stream('laporan_gabungan.pdf');
    }
}
