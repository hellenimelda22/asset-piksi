<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asset;
use App\Models\PeminjamanAset;
use App\Models\BuktiPeminjaman;

class PeminjamanAsetController extends Controller
{
    // Menampilkan daftar peminjaman dengan filter + relasi aset, user, bukti
    public function index(Request $request)
    {
        $query = PeminjamanAset::with(['aset', 'user', 'bukti'])->latest();

        // Filter status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter nama peminjam
        if ($request->filled('nama_peminjam')) {
            $query->where('nama_peminjam', 'like', '%' . $request->nama_peminjam . '%');
        }

        // Filter tanggal pinjam
        if ($request->filled('tanggal_pinjam')) {
            $query->whereDate('tanggal_pinjam', $request->tanggal_pinjam);
        }

        $peminjaman = $query->paginate(10);
        return view('peminjaman.index', compact('peminjaman'));
    }

    // Menampilkan form tambah peminjaman
    public function create()
    {
        $aset = Asset::all();
        return view('peminjaman.create', compact('aset'));
    }

    // Menyimpan data peminjaman + upload bukti (jika ada)
    public function store(Request $request)
    {
        $request->validate([
            'nama_peminjam' => 'required|string|max:255',
            'aset_id' => 'required|exists:asets,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_kembali' => 'required|date|after_or_equal:tanggal_pinjam',
            'file_bukti' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        // Cek apakah aset masih dipinjam
        $cekStatus = PeminjamanAset::where('aset_id', $request->aset_id)
            ->where('status', 'Dipinjam')
            ->first();

        if ($cekStatus) {
            return redirect()->back()->withErrors(['aset_id' => 'Aset ini masih dalam status Dipinjam.']);
        }

        // Simpan peminjaman
        $peminjaman = PeminjamanAset::create([
            'user_id' => auth()->id(),
            'nama_peminjam' => $request->nama_peminjam,
            'aset_id' => $request->aset_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_kembali' => $request->tanggal_kembali,
            'status' => 'Dipinjam',
        ]);

        // Update status aset
        $aset = Asset::findOrFail($request->aset_id);
        $aset->status = 'Dipinjam';
        $aset->save();

        // Upload bukti (jika ada)
        if ($request->hasFile('file_bukti')) {
            $file = $request->file('file_bukti');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('bukti_peminjaman'), $filename);

            BuktiPeminjaman::create([
                'peminjaman_id' => $peminjaman->id,
                'file_bukti' => $filename,
            ]);
        }

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dicatat.');
    }

    // Mengubah status jadi dikembalikan dan aset tersedia kembali
    public function kembalikan($id)
    {
        $peminjaman = PeminjamanAset::findOrFail($id);
        $peminjaman->status = 'Dikembalikan';
        $peminjaman->save();

        $aset = $peminjaman->aset;
        $aset->status = 'Tersedia';
        $aset->save();

        return redirect()->route('peminjaman.index')->with('success', 'Peminjaman berhasil dikembalikan.');
    }
}
