<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\KategoriAset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AsetController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function index()
    {
        $aset = Aset::with('kategori')->get();
        return view('aset.index', compact('aset'));
    }

    public function create()
    {
        $kategori = KategoriAset::all();
        return view('aset.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_aset' => 'required',
            'nama_aset' => 'required',
            'kategori_id' => 'required',
            'lokasi' => 'nullable',
            'kondisi' => 'required',
            'gambar_aset' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar_aset')) {
            $data['gambar_aset'] = $request->file('gambar_aset')->store('aset', 'public');
        }

        Aset::create($data);

        return redirect()->route('aset.index')->with('success', 'Aset berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $aset = Aset::findOrFail($id);
        $kategori = KategoriAset::all();
        return view('aset.edit', compact('aset', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $aset = Aset::findOrFail($id);

        $data = $request->validate([
            'kode_aset' => 'required',
            'nama_aset' => 'required',
            'kategori_id' => 'required',
            'lokasi' => 'nullable',
            'kondisi' => 'required',
            'gambar_aset' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar_aset')) {
            if ($aset->gambar_aset) {
                Storage::disk('public')->delete($aset->gambar_aset);
            }
            $data['gambar_aset'] = $request->file('gambar_aset')->store('aset', 'public');
        }

        $aset->update($data);

        return redirect()->route('aset.index')->with('success', 'Aset berhasil diupdate.');
    }

    public function destroy($id)
    {
        $aset = Aset::findOrFail($id);
        if ($aset->gambar_aset) {
            Storage::disk('public')->delete($aset->gambar_aset);
        }
        $aset->delete();

        return redirect()->route('aset.index')->with('success', 'Aset berhasil dihapus.');
    }
}
