@extends('layouts.app')

@section('title', 'Daftar Aset')

@section('content')
    <h2>Manajemen Aset</h2>

   <form method="GET" action="{{ route('aset.index') }}" class="row g-3 mb-4 align-items-end">
    <div class="col-md-3">
        <label for="kategori_id" class="form-label">Kategori</label>
        <select name="kategori_id" id="kategori_id" class="form-control select2" style="width: 100%;">
            <option value="">-- Semua Kategori --</option>
            @foreach($kategoriData as $kategori)
                <option value="{{ $kategori->id }}" {{ request('kategori_id') == $kategori->id ? 'selected' : '' }}>
                    {{ $kategori->nama_kategori }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label for="nama_aset" class="form-label">Nama Aset</label>
        <select name="nama_aset" id="nama_aset" class="form-control select2-tags" style="width: 100%;">
            <option value="">-- Semua Nama Aset --</option>
            @foreach($namaAsetData as $nama)
                <option value="{{ $nama }}" {{ request('nama_aset') == $nama ? 'selected' : '' }}>{{ $nama }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label for="lokasi" class="form-label">Lokasi</label>
        <select name="lokasi" id="lokasi" class="form-control select2-tags" style="width: 100%;">
            <option value="">-- Semua Lokasi --</option>
            @foreach($lokasiData as $lokasi)
                <option value="{{ $lokasi }}" {{ request('lokasi') == $lokasi ? 'selected' : '' }}>{{ $lokasi }}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-3">
        <label for="kondisi" class="form-label">Kondisi</label>
        <select name="kondisi" id="kondisi" class="form-control select2-tags" style="width: 100%;">
            <option value="">-- Semua Kondisi --</option>
            <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
            <option value="Rusak" {{ request('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
        </select>
    </div>

    <div class="col-12 d-flex gap-3 flex-wrap">
        <button type="submit" class="btn btn-primary px-4 py-2 fw-semibold d-flex align-items-center gap-2">
            <i class="bi bi-funnel-fill"></i> Filter
        </button>

        <a href="{{ route('aset.create') }}" class="btn btn-primary px-4 py-2 fw-semibold d-flex align-items-center gap-2">
            <i class="bi bi-plus-circle-fill"></i> Tambah Aset
        </a>

        <a href="{{ route('aset.create_multiple') }}" class="btn btn-success px-4 py-2 fw-semibold d-flex align-items-center gap-2">
            <i class="bi bi-plus-square-fill"></i> Tambah Banyak Aset
        </a>
    </div>
</form>

@push('scripts')
<script>
    $(document).ready(function() {
        // Select2 biasa untuk Kategori
        $('#kategori_id').select2({
            placeholder: "Pilih Kategori",
            allowClear: true,
            width: '100%'
        });

        // Select2 dengan tags: true untuk Nama Aset dan Lokasi
        $('.select2-tags').select2({
            tags: true,
            placeholder: "Ketik atau pilih opsi",
            allowClear: true,
            width: '100%',
            createTag: function(params) {
                return {
                    id: params.term,
                    text: params.term,
                    newOption: true
                }
            },
            templateResult: function(data) {
                var $result = $("<span></span>");
                $result.text(data.text);
                if (data.newOption) {
                    $result.append(" <em>(baru)</em>");
                }
                return $result;
            }
        });
    });
</script>
@endpush


        
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Aset</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                 <th>Tahun Perolehan</th>
                <th>Lokasi</th>
                <th>Kondisi</th>
                <th>Status</th>
                <th>Gambar</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($aset as $item)
                <tr>
                    <td>{{ $loop->iteration + ($aset->currentPage() - 1) * $aset->perPage() }}</td>
                    <td>{{ $item->kode_aset }}</td>
                    <td>{{ $item->nama_aset }}</td>
                    <td>{{ $item->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $item->tahun_perolehan ?? 'N/A' }}</td>
                    <td>{{ $item->lokasi }}</td>
                    <td>{{ $item->kondisi }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        @if ($item->gambar_aset && file_exists(public_path($item->gambar_aset)))
                            <a href="{{ asset($item->gambar_aset) }}" target="_blank">
                                <img src="{{ asset($item->gambar_aset) }}" width="60" style="border-radius: 4px;">
                            </a>
                        @else
                            <span>Belum ada gambar</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('aset.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('aset.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">Tidak ada data aset.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Update pagination section -->
    <div class="pagination-container">
        {{ $aset->links('pagination::bootstrap-4') }}
    </div>
@endsection