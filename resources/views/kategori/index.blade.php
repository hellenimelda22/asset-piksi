<!-- resources/views/kategori/index.blade.php -->
@extends('layouts.app')

@section('title', 'Kategori Aset')

@section('content')
    <h3 class="mb-4">Daftar Kategori Aset</h3>

    <a href="{{ route('kategori.create') }}" class="btn btn-dark mb-3">+ Tambah Kategori</a>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Nama Kategori</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($kategori as $kat)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $kat->nama_kategori }}</td>
                    <td>
                        <a href="{{ route('kategori.edit', $kat->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <form action="{{ route('kategori.destroy', $kat->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="3" class="text-center">Belum ada kategori.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
