<!-- resources/views/aset/show.blade.php -->
<div class="container">
    <h2>Detail Aset</h2>
    <table class="table">
        <tr>
            <th>ID Aset</th>
            <td>{{ $aset->id }}</td>
        </tr>
        <tr>
            <th>Nama Aset</th>
            <td>{{ $aset->nama_aset }}</td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td>{{ $aset->kategori->nama_kategori }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $aset->status }}</td>
        </tr>
        <tr>
            <th>Kondisi</th>
            <td>{{ $aset->kondisi }}</td>
        </tr>
        <tr>
            <th>Lokasi</th>
            <td>{{ $aset->lokasi }}</td>
        </tr>
        <tr>
            <th>Gambar Aset</th>
            <td>
                @if ($aset->gambar_aset)
                    <img src="{{ Storage::url($aset->gambar_aset) }}" width="200">
                @else
                    <span>Belum ada gambar</span>
                @endif
            </td>
        </tr>
    </table>
    <a href="{{ route('aset.index') }}" class="btn btn-secondary">Kembali</a>
</div>
