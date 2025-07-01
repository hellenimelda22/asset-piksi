<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Asset;
use App\Models\PeminjamanAset;
use App\Models\KategoriAset;

class LaporanController extends Controller
{
    // 🌐 Halaman Laporan Aset
    public function laporanAset(Request $request)
    {
        $query = Asset::with('kategori');

        if ($request->kategori_id) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->nama_aset) {
            $query->where('nama_aset', 'like', '%' . $request->nama_aset . '%');
        }

        if ($request->lokasi) {
            $query->where('lokasi', 'like', '%' . $request->lokasi . '%');
        }

        if ($request->tahun_perolehan) {
            $query->where('tahun_perolehan', $request->tahun_perolehan);
        }


        $aset = $query->paginate(10);
        $kategoriList = KategoriAset::all();
        $asetList = Asset::select('nama_aset')->distinct()->pluck('nama_aset');
        $lokasiList = Asset::select('lokasi')->distinct()->pluck('lokasi');

        return view('laporan.aset', compact('aset', 'kategoriList', 'asetList', 'lokasiList'));
    }

    // 🖨️ Cetak PDF Laporan Aset
    public function cetakLaporanAset(Request $request)
    {
        $query = Asset::with('kategori');

        if ($request->kategori_id) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->nama_aset) {
            $query->where('nama_aset', 'like', '%' . $request->nama_aset . '%');
        }

        if ($request->lokasi) {
            $query->where('lokasi', 'like', '%' . $request->lokasi . '%');
        }

        if ($request->tahun_perolehan) {
            $query->where('tahun_perolehan', $request->tahun_perolehan);
        }

        $aset = $query->get();

        $pdf = Pdf::loadView('laporan.laporan_aset_pdf', compact('aset'));
        return $pdf->stream('laporan-aset.pdf');
    }

    // 🌐 Halaman Laporan Peminjaman
    public function laporanPeminjaman(Request $request)
    {
        $query = PeminjamanAset::with('aset');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->nama_peminjam) {
            $query->where('nama_peminjam', 'like', '%' . $request->nama_peminjam . '%');
        }

        if ($request->tanggal_pinjam) {
            $query->whereDate('tanggal_pinjam', $request->tanggal_pinjam);
        }

        $peminjaman = $query->get();

        return view('laporan.laporan_peminjaman', compact('peminjaman'));
    }

    // 🖨️ Cetak PDF Laporan Peminjaman
    public function cetakLaporanPeminjaman(Request $request)
    {
        $query = PeminjamanAset::with('aset');

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->nama_peminjam) {
            $query->where('nama_peminjam', 'like', '%' . $request->nama_peminjam . '%');
        }

        if ($request->tanggal_pinjam) {
            $query->whereDate('tanggal_pinjam', $request->tanggal_pinjam);
        }

        $peminjaman = $query->get();

        $pdf = Pdf::loadView('laporan.laporan_peminjaman_pdf', compact('peminjaman'));
        return $pdf->stream('laporan-peminjaman.pdf');
    }

    // 🌐 Halaman Laporan Gabungan
    public function laporanGabungan()
    {
        $aset = Asset::with('kategori')->get();
        $peminjaman = PeminjamanAset::with('aset')->get();

        return view('laporan.laporan_gabungan', compact('aset', 'peminjaman'));
    }

    // 🖨️ Cetak PDF Laporan Gabungan
    public function cetakLaporanGabungan()
    {
        $aset = Asset::with('kategori')->get();
        $peminjaman = PeminjamanAset::with('aset')->get();

        $pdf = Pdf::loadView('laporan.laporan_gabungan_pdf', compact('aset', 'peminjaman'));
        return $pdf->stream('laporan-gabungan.pdf');
    }
}
