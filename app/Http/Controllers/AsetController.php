<?php

namespace App\Http\Controllers;

use App\Models\Asset;
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
        $aset = Asset::with('kategori')->get();
        return view('aset.index', compact('aset'));
    }

    public function create()
    {
        $kategori = KategoriAset::all();
        return view('aset.create', compact('kategori'));
    }

    public function createMultiple()
{
    $kategori = KategoriAset::all(); // Ambil semua kategori aset
    return view('aset.create_multiple', compact('kategori')); // Tampilkan form tambah banyak aset
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

        Asset::create($data);

        return redirect()->route('aset.index')->with('success', 'Aset berhasil ditambahkan.');
    }

    public function storeMultiple(Request $request)
    {
        $request->validate([
            'nama_aset' => 'required|string',
            'kategori_id' => 'required|exists:kategori_aset,id',
            'jumlah' => 'required|integer|min:1',
        ]);

        $namaAset = $request->nama_aset;
        $kategoriId = $request->kategori_id;
        $jumlah = $request->jumlah;

        // Ambil kode terakhir dari aset dengan nama yang sama
        $lastAset = Asset::where('nama_aset', $namaAset)->orderBy('id', 'desc')->first();
        $start = 1;

        if ($lastAset && preg_match('/-(\d+)$/', $lastAset->kode_aset, $matches)) {
            $start = (int) $matches[1] + 1;
        }

        for ($i = $start; $i < $start + $jumlah; $i++) {
            Asset::create([
                'kode_aset' => strtoupper(substr($namaAset, 0, 3)) . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'nama_aset' => $namaAset,
                'kategori_id' => $kategoriId,
                'status' => 'Tersedia',
                'kondisi' => 'Baik',
            ]);
        }

        return redirect()->route('aset.index')->with('success', $jumlah . ' unit aset berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $aset = Asset::findOrFail($id);
        $kategori = KategoriAset::all();
        return view('aset.edit', compact('aset', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $aset = Asset::findOrFail($id);

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
        $aset = Asset::findOrFail($id);
        if ($aset->gambar_aset) {
            Storage::disk('public')->delete($aset->gambar_aset);
        }
        $aset->delete();

        return redirect()->route('aset.index')->with('success', 'Aset berhasil dihapus.');
    }

    // Menambahkan method show untuk menampilkan detail aset berdasarkan ID
    public function show($id)
    {
        // Cari aset berdasarkan ID
        $aset = Asset::with('kategori')->findOrFail($id);
        return view('aset.show', compact('aset'));  // Mengirim data aset ke view
    }
}
