@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@push('styles')
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    thead th {
        background-color: #a7ccf4;
        color: #212529;
        font-weight: 600;
        text-align: center;
        font-size: 14px;
        height: 45px;
        border: none;
    }
    tbody tr:nth-child(odd) {
        background-color: #ffffff;
    }
    tbody tr:nth-child(even) {
        background-color: #f3f4f6;
    }
    tbody td {
        font-size: 13.5px;
        text-align: center;
        color: #212529;
        vertical-align: middle;
        border: none;
    }
    .btn-sm {
        padding: 4px 8px;
    }
</style>
@endpush

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center py-3">
        <h4 class="text-primary fw-bold">Manajemen Kategori</h4>
        <a href="{{ route('kategori.create') }}" class="btn btn-sm btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Kategori
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-sm table-striped table-borderless align-middle mb-0">        
                <thead>
                    <tr>
                        <th class="text-left"style="background-color:rgb(204, 227, 255); color: #212529;">No</th>
                        <th class="text-left"style="background-color:rgb(204, 227, 255); color: #212529;">Nama Kategori</th>
                        <th class="text-left"style="background-color:rgb(204, 227, 255); color: #212529;">Jumlah Aset</th>
                        <th class="text-left"style="background-color:rgb(204, 227, 255); color: #212529;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategori as $index => $kat)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td class="text-start">{{ $kat->nama_kategori }}</td>
                            <td>{{ $kat->aset->count() }}</td>
                            <td class="text-left">
                                <a href="{{ route('kategori.edit', $kat->id) }}" class="btn btn-sm" style="background-color: #ffc107; color: black; padding: 6px 10px; border-radius: 6px;">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('kategori.destroy', $kat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm" style="background-color: #dc3545; color: white; padding: 6px 10px; border-radius: 6px;">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center text-muted">Belum ada data kategori.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
