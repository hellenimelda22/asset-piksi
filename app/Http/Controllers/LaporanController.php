<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Aset;
use App\Models\PeminjamanAset;
use App\Models\KategoriAset;

class LaporanController extends Controller
{
    public function index()
    {
        $kategoriData = KategoriAset::all();
        $aset = Aset::all();
        $peminjaman = PeminjamanAset::all();

        return view('laporan.index', compact('kategoriData', 'aset', 'peminjaman'));
    }

    // Method untuk generate PDF
    public function generatePDF(Request $request)
    {
        // Ambil data aset
        $aset = Aset::all();

        // Ambil data peminjaman jika ada filter status
        $peminjaman = PeminjamanAset::query();

        if ($request->has('status')) {
            $peminjaman->where('status', $request->input('status'));
        }

        $peminjaman = $peminjaman->get();

        // Load view PDF untuk aset dan peminjaman
        $pdf = Pdf::loadView('laporan.pdf', compact('aset', 'peminjaman'));

        // Mengunduh file PDF
        return $pdf->download('laporan_aset_peminjaman.pdf');
    }

    // Metode untuk laporan peminjaman
    public function laporanPeminjaman(Request $request)
    {
        // Filter peminjaman berdasarkan status jika diperlukan
        $peminjaman = PeminjamanAset::query();

        if ($request->has('status')) {
            $peminjaman->where('status', $request->input('status'));
        }

        // Ambil data peminjaman
        $peminjaman = $peminjaman->get();

        // Kirim data ke view laporan peminjaman
        return view('laporan.peminjaman', compact('peminjaman'));
    }

    // Metode untuk laporan aset
    public function laporanAset()
    {
        // Ambil semua data aset
        $aset = Aset::all();

        // Kirim data aset ke view laporan aset
        return view('laporan.aset', compact('aset'));
    }

    // Method untuk cetak laporan aset ke PDF
    public function cetakLaporanAset()
    {
        // Ambil data aset
        $aset = Aset::all();

        // Load view PDF untuk laporan aset
        $pdf = Pdf::loadView('laporan.pdf', compact('aset'));

        // Mengunduh file PDF laporan aset
        return $pdf->download('laporan_aset.pdf');
    }

    // Method untuk cetak laporan peminjaman ke PDF
    public function cetakLaporanPeminjaman()
    {
        // Ambil data peminjaman
        $peminjaman = PeminjamanAset::all();

        // Load view PDF untuk laporan peminjaman
        $pdf = Pdf::loadView('laporan.pdf', compact('peminjaman'));

        // Mengunduh file PDF laporan peminjaman
        return $pdf->download('laporan_peminjaman.pdf');
    }
}
