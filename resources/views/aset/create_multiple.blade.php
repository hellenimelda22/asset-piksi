@extends('layouts.app') <!-- sesuaikan dengan layout kamu -->

@section('content')
<div class="container">
    <h2>Tambah Banyak Unit Aset</h2>
    
    <form action="{{ route('aset.store_multiple') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nama_aset">Nama Aset</label>
            <input type="text" name="nama_aset" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jumlah">Jumlah Unit</label>
            <input type="number" name="jumlah" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="kategori_id">Kategori</label>
            <select name="kategori_id" class="form-control">
                @foreach ($kategori as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Tambah</button>
    </form>
</div>
@endsection
