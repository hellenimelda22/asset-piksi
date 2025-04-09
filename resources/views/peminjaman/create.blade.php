<!-- resources/views/peminjaman/create.blade.php -->
@extends('layouts.app')

@section('content')
    <h3>Ajukan Peminjaman Aset</h3>
    <form method="POST" action="{{ route('peminjaman.store') }}">
        @csrf
        <div class="form-group">
            <label for="aset_id">Pilih Aset</label>
            <select name="aset_id" class="form-control" required>
                @foreach ($aset as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_aset }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="tanggal_pinjam">Tanggal Pinjam</label>
            <input type="date" name="tanggal_pinjam" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="tanggal_kembali">Tanggal Kembali</label>
            <input type="date" name="tanggal_kembali" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Ajukan Peminjaman</button>
    </form>
@endsection
