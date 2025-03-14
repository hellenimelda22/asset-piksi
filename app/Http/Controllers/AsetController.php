<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aset;
use App\Models\KategoriAset;

class AsetController extends Controller
{
    public function index()
    {
        $asets = Aset::all();
        return view('aset.index', compact('asets'));
    }

    public function create()
    {
        $kategori = KategoriAset::all();
        return view('aset.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_aset' => 'required|unique:asets',
            'nama_aset' => 'required',
            'kategori_id' => 'required',
            'lokasi' => 'required',
            'kondisi' => 'required',
            'gambar_aset' => 'image|nullable|max:2048'
        ]);

        $gambar = $request->file('gambar_aset') ? $request->file('gambar_aset')->store('gambar_aset', 'public') : null;

        Aset::create([
            'kode_aset' => $request->kode_aset,
            'nama_aset' => $request->nama_aset,
            'kategori_id' => $request->kategori_id,
            'lokasi' => $request->lokasi,
            'kondisi' => $request->kondisi,
            'gambar_aset' => $gambar,
            'status' => 'Tersedia'
        ]);

        return redirect()->route('aset.index')->with('success', 'Aset berhasil ditambahkan');
    }

    public function destroy(Aset $aset)
    {
        $aset->delete();
        return redirect()->route('aset.index')->with('success', 'Aset berhasil dihapus');
    }
}
