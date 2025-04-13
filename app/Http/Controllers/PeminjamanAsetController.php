<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PeminjamanAset;
use App\Models\Asset;
use Illuminate\Http\Request;

class PeminjamanAsetController extends Controller
{
    public function index()
    {
        $peminjaman = PeminjamanAset::with('aset')->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $aset = Asset::all();
        return view('peminjaman.create', compact('aset'));
    }

    public function store(Request $request)
{
    $request->validate([
        'nama_peminjam' => 'required|string|max:255',
        'aset_id' => 'required|exists:asets,id',
        'tanggal_pinjam' => 'required|date',
        'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
    ]);

    // Cek apakah aset masih dipinjam
    $cekStatus = PeminjamanAset::where('aset_id', $request->aset_id)
        ->where('status', 'Dipinjam')
        ->first();

    if ($cekStatus) {
        return redirect()->back()->withErrors(['aset_id' => 'Aset ini masih dalam status Dipinjam.']);
    }

    PeminjamanAset::create([
        'user_id' => 1, 
        'nama_peminjam' => $request->nama_peminjam,
        'aset_id' => $request->aset_id,
        'tanggal_pinjam' => $request->tanggal_pinjam,
        'tanggal_kembali' => $request->tanggal_kembali,
        'status' => 'Dipinjam',
    ]);

    return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dicatat');
}


    public function kembalikan($id)
    {
        $peminjaman = PeminjamanAset::findOrFail($id);
        $peminjaman->status = 'Dikembalikan';
        $peminjaman->save();
    
        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dikembalikan');
    }
    
}
