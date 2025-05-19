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

    public function index(Request $request)
{
    $query = Asset::with('kategori');

    if ($request->filled('kategori_id')) {
        $query->where('kategori_id', $request->kategori_id);
    }
    if ($request->filled('nama_aset')) {
        $query->where('nama_aset', $request->nama_aset);
    }
    if ($request->filled('lokasi')) {
        $query->where('lokasi', $request->lokasi);
    }
    if ($request->filled('kondisi')) {
        $query->where('kondisi', $request->kondisi);
    }

    $aset = $query->paginate(10);

    $kategoriData = KategoriAset::all();
    $namaAsetData = Asset::select('nama_aset')->distinct()->orderBy('nama_aset')->pluck('nama_aset');
    $lokasiData = Asset::select('lokasi')->distinct()->orderBy('lokasi')->pluck('lokasi');

    return view('aset.index', compact('aset', 'kategoriData', 'namaAsetData', 'lokasiData'));
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
            'tahun_perolehan' => 'nullable|digits:4',
            'lokasi' => 'nullable',
            'kondisi' => 'required',
            'gambar_aset' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar_aset')) {
            $file = $request->file('gambar_aset');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/aset'), $filename);
            $data['gambar_aset'] = 'uploads/aset/' . $filename; // simpan path ke DB
        }

        $data['status'] = 'Tersedia'; // default status

        Asset::create($data);

        return redirect()->route('aset.index')->with('success', 'Aset berhasil ditambahkan.');
    }

    public function storeMultiple(Request $request)
    {
        $request->validate([
            'nama_aset' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'kategori_id' => 'required|exists:kategori_asets,id',
            'tahun_perolehan' => 'required|integer',
            'kondisi' => 'required|string',
            'lokasi' => 'required|string',
        ]);

        for ($i = 0; $i < $request->jumlah; $i++) {
            $kode = strtoupper(substr($request->nama_aset, 0, 3)) . '-' . strtoupper(uniqid());

            Asset::create([
                'kode_aset' => $kode,
                'nama_aset' => $request->nama_aset,
                'kategori_id' => $request->kategori_id,
                'tahun_perolehan' => $request->tahun_perolehan,
                'kondisi' => $request->kondisi,
                'lokasi' => $request->lokasi,
                'status' => 'Tersedia',
            ]);
        }

        return redirect()->route('aset.index')->with('success', 'Berhasil menambahkan aset sebanyak ' . $request->jumlah . ' unit.');
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
            'tahun_perolehan' => 'required|integer',
            'lokasi' => 'nullable',
            'kondisi' => 'required',
            'gambar_aset' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar_aset')) {
            if ($aset->gambar_aset) {
                Storage::disk('public')->delete($aset->gambar_aset);
            }
            $data['gambar_aset'] = $request->file('gambar_aset')->store('asets', 'public');
        }

        $aset->update($data);

        return redirect()->route('aset.index')->with('success', 'Aset berhasil diupdate.');
    }

    public function destroy($id)
    {
        $aset = Asset::findOrFail($id);
        $aset->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus');
    }

    public function show($id)
    {
        $aset = Asset::with('kategori')->findOrFail($id);
        return view('aset.show', compact('aset'));
    }

    public function laporan(Request $request)
    {
        $query = Asset::with('kategori');

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('nama_aset')) {
            $query->where('nama_aset', 'like', '%' . $request->nama_aset . '%');
        }

        $aset = $query->paginate(10);
        $kategoriData = KategoriAset::all();

        return view('laporan.index', compact('aset', 'kategoriData'));
    }
}
