@extends('layouts.app')

@section('title', 'Ajukan Peminjaman')

@section('content')
<div class="card shadow">
    <div class="card-header bg-dark text-white">Ajukan Peminjaman</div>
    <div class="card-body">
        <form action="{{ route('peminjaman.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Pilih Aset</label>
                <select name="aset_id" class="form-control" required>
                    <option value="">-- Pilih Aset --</option>
                    @foreach ($aset as $a)
                        <option value="{{ $a->id }}">{{ $a->nama_aset }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Pinjam</label>
                <input type="date" name="tanggal_pinjam" class="form-control" required>
            </div>
            <button class="btn btn-dark">Ajukan</button>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
