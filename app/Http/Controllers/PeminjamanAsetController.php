<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanAset;
use App\Models\Asset;
use Illuminate\Http\Request;

class PeminjamanAsetController extends Controller
{
    // Method untuk menampilkan jumlah aset dan peminjaman terbaru
    public function index()
    {
        // Mengambil jumlah aset
        $jumlahAset = Asset::count();

        // Mengambil peminjaman terbaru beserta data aset yang dipinjam
        $peminjamanTerbaru = PeminjamanAset::with('aset', 'user')->latest()->get();

        // Mengirimkan data ke view
        return view('peminjaman.index', compact('jumlahAset', 'peminjamanTerbaru'));
    }

    // Method untuk menampilkan form tambah peminjaman
    public function create()
    {
        $aset = Asset::all(); // Ambil semua aset untuk dropdown
        return view('peminjaman.create', compact('aset'));
    }

    // Method untuk menyimpan peminjaman aset
    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'aset_id' => 'required|exists:asets,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);
    
        // Cek jika aset masih dipinjam
        $cekStatus = PeminjamanAset::where('aset_id', $request->aset_id)
            ->where('status', 'Dipinjam')
            ->first();
    
        if ($cekStatus) {
            return redirect()->back()->withErrors(['aset_id' => 'Aset ini masih dalam status Dipinjam.']);
        }
    
        // Simpan peminjaman aset
        PeminjamanAset::create([
            'user_id' => auth()->id(),
            'nama_peminjam' => $request->nama_peminjam,
            'aset_id' => $request->aset_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'Dipinjam',
        ]);
    
        // Update status aset menjadi dipinjam
        $aset = Asset::findOrFail($request->aset_id);
        $aset->status = 'Dipinjam';
        $aset->save();
    
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dicatat');
    }

    // Method untuk mengubah status peminjaman menjadi dikembalikan
    public function kembalikan($id)
    {
        $peminjaman = PeminjamanAset::findOrFail($id);
        
        // Mengubah status peminjaman menjadi dikembalikan
        $peminjaman->status = 'Dikembalikan';
        $peminjaman->save();

        // Update status aset menjadi tersedia kembali
        $aset = $peminjaman->aset;
        $aset->status = 'Tersedia';
        $aset->save();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dikembalikan');
    }
}
