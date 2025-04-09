@extends('layouts.app')

@section('content')
<h3>Edit Peminjaman Aset</h3>
<form method="POST" action="{{ route('peminjaman.update', $peminjaman->id) }}">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Tanggal Pinjam</label>
        <input type="date" name="tanggal_pinjam" class="form-control" value="{{ $peminjaman->tanggal_pinjam }}">
    </div>
    <div class="mb-3">
        <label>Status</label>
        <select name="status" class="form-control">
            <option value="Dipinjam" {{ $peminjaman->status == 'Dipinjam' ? 'selected' : '' }}>Dipinjam</option>
            <option value="Dikembalikan" {{ $peminjaman->status == 'Dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
        </select>
    </div>
    <button class="btn btn-primary">Update</button>
</form>
@endsection
