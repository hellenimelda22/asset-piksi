<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\KategoriAset;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function dashboard()
    {
        return view('dashboard');
    }

    public function index(Request $request)
    {
        $kategoriData = KategoriAset::all();
        $namaAsetData = Asset::select('nama_aset')->distinct()->orderBy('nama_aset')->pluck('nama_aset');
        $lokasiData = Asset::select('lokasi')->distinct()->orderBy('lokasi')->pluck('lokasi');
        $tahunList = array_reverse(range(2000, date('Y')));

        $query = Asset::with('kategori');

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('nama_aset')) {
            $query->where('nama_aset', 'like', '%' . $request->nama_aset . '%');
        }

        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'like', '%' . $request->lokasi . '%');
        }

        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        if ($request->filled('tahun_perolehan')) {
            $query->where('tahun_perolehan', $request->tahun_perolehan);
        }

        $aset = $query->paginate(10);
        $kategoriId = $request->kategori_id;
        $showLuas = $kategoriId == 4 || $kategoriId == 8;

        return view('aset.index', compact(
            'aset',
            'kategoriData',
            'namaAsetData',
            'lokasiData',
            'tahunList',
            'showLuas'
        ));
    }

    public function create()
    {
        $kategori = KategoriAset::all();
        return view('aset.create', compact('kategori'));
    }

    public function createMultiple()
    {
        $kategori = KategoriAset::all();
        return view('aset.create_multiple', compact('kategori'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_aset' => 'required|unique:asets,kode_aset',
            'nama_aset' => 'required',
            'kategori_id' => 'required|integer',
            'tahun_perolehan' => 'nullable|digits:4',
            'harga_beli' => 'nullable|numeric|min:0',
            'lokasi' => 'nullable',
            'kondisi' => 'required',
            'gambar_aset' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'luas' => function ($attribute, $value, $fail) use ($request) {
                if (in_array($request->kategori_id, [4, 8]) && empty($value)) {
                    $fail('Kolom luas wajib diisi untuk kategori Bangunan atau Lahan.');
                }
            },
        ]);

        if ($request->hasFile('gambar_aset')) {
            $file = $request->file('gambar_aset');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $data['gambar_aset'] = 'images/' . $filename;
        }

        $data['status'] = 'Tersedia';
        $data['luas'] = in_array($request->kategori_id, [4, 8]) ? $request->luas : null;

        Asset::create($data);

        $totalAset = Asset::count();
        $perPage = 10;
        $lastPage = ceil($totalAset / $perPage);

        return redirect()->route('aset.index', ['page' => $lastPage])
            ->with('success', 'Aset berhasil ditambahkan!');
    }

    public function storeMultiple(Request $request)
    {
        $request->validate([
            'nama_aset' => 'required|string',
            'jumlah' => 'required|integer|min:1',
            'kategori_id' => 'required|exists:kategori_asets,id',
            'tahun_perolehan' => 'required|integer',
            'harga_beli' => 'nullable|numeric|min:0',
            'kondisi' => 'required|string',
            'lokasi' => 'required|string',
            'gambar_aset' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $filename = null;
        if ($request->hasFile('gambar_aset')) {
            $file = $request->file('gambar_aset');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
        }

        for ($i = 0; $i < $request->jumlah; $i++) {
            $kode = strtoupper(substr($request->nama_aset, 0, 3)) . '-' . strtoupper(uniqid());

            Asset::create([
                'kode_aset' => $kode,
                'nama_aset' => $request->nama_aset,
                'kategori_id' => $request->kategori_id,
                'tahun_perolehan' => $request->tahun_perolehan,
                'harga_beli' => $request->harga_beli,
                'kondisi' => $request->kondisi,
                'lokasi' => $request->lokasi,
                'status' => 'Tersedia',
                'gambar_aset' => $filename ? 'images/' . $filename : null,
            ]);
        }

        $totalAset = Asset::count();
        $perPage = 10;
        $lastPage = ceil($totalAset / $perPage);

        return redirect()->route('aset.index', ['page' => $lastPage])
            ->with('success', 'Berhasil menambahkan aset sebanyak ' . $request->jumlah . ' unit.');
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

        $validated = $request->validate([
            'kode_aset' => 'required|string|max:100',
            'nama_aset' => 'required|string|max:100',
            'kategori_id' => 'required|exists:kategori_asets,id',
            'tahun_perolehan' => 'required|integer',
            'harga_beli' => 'nullable|numeric|min:0',
            'lokasi' => 'required|string|max:100',
            'kondisi' => 'required|string|max:100',
            'gambar_aset' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('gambar_aset')) {
            $file = $request->file('gambar_aset');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $validated['gambar_aset'] = 'images/' . $filename;
        }

        $aset->update($validated);

        $page = $request->input('page', 1);

        return redirect()->route('aset.index', ['page' => $page])
            ->with('success', 'Data aset berhasil diperbarui.');
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
