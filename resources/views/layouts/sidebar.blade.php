
@php
    $route = request()->route()->getName();
@endphp

<aside class="sidebar text-white p-3">
    <div class="text-center mb-4">
        <img src="{{ asset('images/logo_piksi.png') }}" alt="Logo" width="80">
        <h5 class="mt-2">SI ASET</h5>
    </div>

    <ul class="nav flex-column">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link text-white {{ $route == 'dashboard' ? 'fw-bold' : '' }}">
                <i class="bi bi-house-door me-2"></i> Dashboard
            </a>
        </li>

        {{-- Data Aset --}}
        @php $isAset = request()->is('aset*'); @endphp
        <li class="nav-item">
            <a class="nav-link text-white {{ $isAset ? '' : 'collapsed' }}" data-bs-toggle="collapse" href="#asetMenu" role="button" aria-expanded="{{ $isAset ? 'true' : 'false' }}">
                <i class="bi bi-box me-2"></i> Data Aset
            </a>
            <div class="collapse {{ $isAset ? 'show' : '' }}" id="asetMenu">
                <ul class="nav flex-column ms-3">
                    <li>
                        <a href="{{ route('aset.index') }}" class="nav-link text-white {{ $route == 'aset.index' ? 'fw-bold' : '' }}">Lihat Aset</a>
                    </li>
                    <li>
                        <a href="{{ route('aset.create') }}" class="nav-link text-white {{ $route == 'aset.create' ? 'fw-bold' : '' }}">Tambah Aset</a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- Kategori --}}
        @php $isKategori = request()->is('kategori*'); @endphp
        <li class="nav-item">
            <a class="nav-link text-white {{ $isKategori ? '' : 'collapsed' }}" data-bs-toggle="collapse" href="#kategoriMenu" role="button" aria-expanded="{{ $isKategori ? 'true' : 'false' }}">
                <i class="bi bi-tags me-2"></i> Kategori
            </a>
            <div class="collapse {{ $isKategori ? 'show' : '' }}" id="kategoriMenu">
                <ul class="nav flex-column ms-3">
                    <li>
                        <a href="{{ route('kategori.index') }}" class="nav-link text-white {{ $route == 'kategori.index' ? 'fw-bold' : '' }}">Data Kategori</a>
                    </li>
                    <li>
                        <a href="{{ route('kategori.create') }}" class="nav-link text-white {{ $route == 'kategori.create' ? 'fw-bold' : '' }}">Tambah Kategori</a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- Peminjaman --}}
        @php $isPeminjaman = request()->is('peminjaman*'); @endphp
        <li class="nav-item">
            <a class="nav-link text-white {{ $isPeminjaman ? '' : 'collapsed' }}" data-bs-toggle="collapse" href="#peminjamanMenu" role="button" aria-expanded="{{ $isPeminjaman ? 'true' : 'false' }}">
                <i class="bi bi-arrow-left-right me-2"></i> Peminjaman
            </a>
            <div class="collapse {{ $isPeminjaman ? 'show' : '' }}" id="peminjamanMenu">
                <ul class="nav flex-column ms-3">
                    <li>
                        <a href="{{ route('peminjaman.index') }}" class="nav-link text-white {{ $route == 'peminjaman.index' ? 'fw-bold' : '' }}">Data Peminjaman</a>
                    </li>
                    <li>
                        <a href="{{ route('peminjaman.create') }}" class="nav-link text-white {{ $route == 'peminjaman.create' ? 'fw-bold' : '' }}">Catat Peminjaman</a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- Laporan --}}
        @php $isLaporan = request()->is('laporan*'); @endphp
        <li class="nav-item">
            <a class="nav-link text-white {{ $isLaporan ? '' : 'collapsed' }}" data-bs-toggle="collapse" href="#laporanMenu" role="button" aria-expanded="{{ $isLaporan ? 'true' : 'false' }}">
                <i class="bi bi-file-earmark-text me-2"></i> Laporan
            </a>
            <div class="collapse {{ $isLaporan ? 'show' : '' }}" id="laporanMenu">
                <ul class="nav flex-column ms-3">
                    <li>
                        <a href="{{ route('laporan.aset') }}" class="nav-link text-white {{ $route == 'laporan.aset' ? 'fw-bold' : '' }}">Laporan Aset</a>
                    </li>
                    <li>
                        <a href="{{ route('laporan.peminjaman') }}" class="nav-link text-white {{ $route == 'laporan.peminjaman' ? 'fw-bold' : '' }}">Laporan Peminjaman</a>
                    </li>
                    <li>
                        <a href="{{ route('laporan.gabungan') }}" class="nav-link text-white {{ $route == 'laporan.gabungan' ? 'fw-bold' : '' }}">Laporan Gabungan</a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- Logout --}}
        <li class="nav-item mt-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-light w-100">Logout</button>
            </form>
        </li>
    </ul>
</aside>
