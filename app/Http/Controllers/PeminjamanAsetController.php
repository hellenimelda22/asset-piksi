<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanAset;
use App\Models\Aset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanAsetController extends Controller
{
    public function index()
    {
        $peminjaman = PeminjamanAset::with(['aset', 'user'])->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $aset = Aset::where('status', 'Tersedia')->get();
        return view('peminjaman.create', compact('aset'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_id' => 'required',
            'tanggal_pinjam' => 'required|date',
        ]);

        PeminjamanAset::create([
            'aset_id' => $request->aset_id,
            'user_id' => Auth::id(),
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'status' => 'Dipinjam'
        ]);

        Aset::where('id', $request->aset_id)->update(['status' => 'Dipinjam']);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diajukan.');
    }

    public function return($id)
    {
        $peminjaman = PeminjamanAset::findOrFail($id);
        $peminjaman->update([
            'tanggal_kembali' => now(),
            'status' => 'Dikembalikan'
        ]);

        Aset::where('id', $peminjaman->aset_id)->update(['status' => 'Tersedia']);

        return redirect()->route('peminjaman.index')->with('success', 'Aset berhasil dikembalikan.');
    }
}
