<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuktiPeminjaman;

class BuktiPeminjamanController extends Controller
{
        public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman_asets,id',
            'file_bukti' => 'required|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        $file = $request->file('file_bukti');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('bukti_peminjaman'), $filename);

        BuktiPeminjaman::create([
            'peminjaman_id' => $request->peminjaman_id,
            'file_bukti' => $filename
        ]);

        return back()->with('success', 'Bukti peminjaman berhasil diupload.');
    }

}
