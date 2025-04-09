<?php

namespace App\Http\Controllers;

use App\Models\PeminjamanAset;
use App\Models\Aset;
use Illuminate\Http\Request;

class PeminjamanAsetController extends Controller
{
    public function index()
    {
        $peminjaman = PeminjamanAset::with('aset', 'user')->get();
        return view('peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $aset = Aset::all();
        return view('peminjaman.create', compact('aset'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aset_id' => 'required|exists:assets,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        PeminjamanAset::create([
            'aset_id' => $request->aset_id,
            'user_id' => auth()->id(),
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'Pending',
        ]);

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil diajukan');
    }

    public function riwayat()
    {
        $peminjaman = PeminjamanAset::where('user_id', auth()->id())
                                    ->with('aset')
                                    ->get();
        return view('peminjaman.riwayat', compact('peminjaman'));
    }
}
