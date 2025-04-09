<?php

namespace App\Http\Controllers;

use App\Models\KategoriAset;  
use Illuminate\Http\Request;

class KategoriAsetController extends Controller
{
    public function index()
    {
        // Ambil semua data kategori
        $kategori = KategoriAset::all();  // Mengambil semua data kategori dari database

        // Kirimkan data kategori ke tampilan
        return view('kategori.index', compact('kategori'));  // Mengirim variabel kategori ke tampilan
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        // Menggunakan model KategoriAset untuk menyimpan data kategori
        KategoriAset::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit($id)
    {
        // Menggunakan model KategoriAset untuk mencari data kategori
        $kategori = KategoriAset::findOrFail($id);
        return view('kategori.edit', compact('kategori'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255'
        ]);

        // Menggunakan model KategoriAset untuk memperbarui data kategori
        $kategori = KategoriAset::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy($id)
    {
        // Menggunakan model KategoriAset untuk menghapus data kategori
        $kategori = KategoriAset::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
