@extends('layouts.app')

@section('title', 'Kategori Aset')

@section('content')
<div class="card shadow">
    <div class="card-header bg-dark text-white d-flex justify-content-between">
        <h5>Kategori Aset</h5>
        <a href="{{ route('kategori.create') }}" class="btn btn-light btn-sm">➕ Tambah</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $k)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $k->nama_kategori }}</td>
                        <td>
                            <a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-warning btn-sm">✏ Edit</a>
                            <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">❌ Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
