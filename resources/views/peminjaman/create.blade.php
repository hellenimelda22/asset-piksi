@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Catat Peminjaman Aset</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('peminjaman.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" class="form-control" required>
                </div>
                <div class="mb-3">
    <label for="aset_id" class="form-label">Pilih Aset</label>
    <select name="aset_id" id="aset_id" class="form-select" required>
        <option value="">-- Pilih Aset --</option>
        @foreach ($aset as $item)
            <option value="{{ $item->id }}">
                {{ $item->kode_aset }} - {{ $item->nama_aset }}
            </option>
        @endforeach
    </select>
</div>

                <div class="mb-3">
                    <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                    <input type="date" name="tanggal_kembali" class="form-control" required>
                </div>

                <button type="submit" class="btn btn-success">Simpan Peminjaman</button>
            </form>
        </div>
    </div>
</div>
@endsection
