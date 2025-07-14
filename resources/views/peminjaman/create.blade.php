@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="fw-bold mb-4">Tambah Peminjaman Aset</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Periksa kembali:</strong>
                    <ul class="mb-0 mt-1">
                        @foreach ($errors->all() as $error)
                            <li class="small">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- ✅ Tambahkan enctype karena ada file upload --}}
            <form method="POST" action="{{ route('peminjaman.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="nama_peminjam" class="form-label">Nama Peminjam</label>
                    <input type="text" name="nama_peminjam" class="form-control" required placeholder="Masukkan nama peminjam">
                </div>

                <div class="mb-3">
                    <label for="aset_id" class="form-label">Pilih Aset</label>
                    <select name="aset_id" id="aset_id" class="form-select" required>
                        <option value="">-- Pilih aset --</option>
                        @foreach ($aset as $item)
                            <option value="{{ $item->id }}">{{ $item->kode_aset }} - {{ $item->nama_aset }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                        <input type="date" name="tanggal_pinjam" class="form-control" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                        <input type="date" name="tanggal_kembali" class="form-control" required>
                    </div>
                </div>

                {{-- ✅ Input Upload Bukti --}}
                <div class="mb-3">
                    <label for="file_bukti" class="form-label">Upload Bukti Peminjaman (opsional)</label>
                    <input type="file" name="file_bukti" class="form-control" accept=".pdf,.jpg,.jpeg,.png">
                    <small class="text-muted">File maksimal 2MB (PDF/JPG/PNG)</small>
                </div>

                <div class="d-flex justify-content-start mt-4">
                    <button type="submit" class="btn btn-primary me-2">
                       <i class="bi bi-save2 me-1"></i> Simpan Peminjaman
                    </button>
                    <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('#aset_id').select2({
            placeholder: "Pilih Aset",
            allowClear: true
        });
    });
</script>
@endpush
