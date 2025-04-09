@php
    $currentRoute = Route::currentRouteName();
@endphp

<!-- Sidebar -->
<div class="d-flex flex-column p-3 text-white bg-dark" style="height: 100vh; width: 250px;">
    <a href="/" class="d-flex align-items-center mb-3 text-white text-decoration-none">
        <span class="fs-4">Asset Piksi</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">

        <!-- Dashboard -->
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{ $currentRoute == 'dashboard' ? 'active' : 'text-white' }}">
                Dashboard
            </a>
        </li>

        <!-- Aset -->
        <li>
            <a data-bs-toggle="collapse" href="#submenuAset" role="button"
               class="nav-link {{ str()->startsWith($currentRoute, 'aset') ? '' : 'text-white' }}"
               aria-expanded="{{ str()->startsWith($currentRoute, 'aset') ? 'true' : 'false' }}">
                Aset
            </a>
            <div class="collapse {{ str()->startsWith($currentRoute, 'aset') ? 'show' : '' }}" id="submenuAset">
                <ul class="list-unstyled ps-3">
                    <li>
                        <a href="{{ route('aset.index') }}"
                           class="nav-link {{ $currentRoute == 'aset.index' ? 'active' : 'text-white' }}">Lihat Aset</a>
                    </li>
                    <li>
                        <a href="{{ route('aset.create') }}"
                           class="nav-link {{ $currentRoute == 'aset.create' ? 'active' : 'text-white' }}">Tambah Aset</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Kategori Aset -->
        <li>
            <a data-bs-toggle="collapse" href="#submenuKategori" role="button"
               class="nav-link {{ str()->startsWith($currentRoute, 'aset') ? '' : 'text-white' }}"
               aria-expanded="{{ str()->startsWith($currentRoute, 'aset') ? 'true' : 'false' }}">
                Kategori
            </a>
            <div class="collapse {{ str()->startsWith($currentRoute, 'aset') ? 'show' : '' }}" id="submenuKategori">
                <ul class="list-unstyled ps-3">
                    <li>
                        <a href="{{ route('kategori.index') }}"
                           class="nav-link {{ $currentRoute == 'kategori.index' ? 'active' : 'text-white' }}">Data Kategori</a>
                    </li>
                    <li>
                        <a href="{{ route('kategori.create') }}"
                           class="nav-link {{ $currentRoute == 'kategori.create' ? 'active' : 'text-white' }}">Tambah Kategori</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Peminjaman -->
        <li>
            <a data-bs-toggle="collapse" href="#submenuPeminjaman" role="button"
               class="nav-link {{ str()->startsWith($currentRoute, 'peminjaman') ? '' : 'text-white' }}"
               aria-expanded="{{ str()->startsWith($currentRoute, 'peminjaman') ? 'true' : 'false' }}">
                Peminjaman
            </a>
            <div class="collapse {{ str()->startsWith($currentRoute, 'peminjaman') ? 'show' : '' }}" id="submenuPeminjaman">
                <ul class="list-unstyled ps-3">
                    <li>
                        <a href="{{ route('peminjaman.index') }}"
                           class="nav-link {{ $currentRoute == 'peminjaman.index' ? 'active' : 'text-white' }}">Data Peminjaman</a>
                    </li>
                    <li>
                        <a href="{{ route('peminjaman.create') }}"
                           class="nav-link {{ $currentRoute == 'peminjaman.create' ? 'active' : 'text-white' }}">Ajukan Peminjaman</a>
                    </li>
                    <li>
                        <a href="{{ route('peminjaman.riwayat') }}"
                           class="nav-link {{ $currentRoute == 'peminjaman.riwayat' ? 'active' : 'text-white' }}">Riwayat Peminjaman</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Laporan -->
        <li>
            <a data-bs-toggle="collapse" href="#submenuLaporan" role="button"
               class="nav-link {{ str()->startsWith($currentRoute, 'laporan') ? '' : 'text-white' }}"
               aria-expanded="{{ str()->startsWith($currentRoute, 'laporan') ? 'true' : 'false' }}">
                Laporan
            </a>
            <div class="collapse {{ str()->startsWith($currentRoute, 'laporan') ? 'show' : '' }}" id="submenuLaporan">
                <ul class="list-unstyled ps-3">
                    <li>
                        <a href="{{ route('laporan.index') }}"
                           class="nav-link {{ $currentRoute == 'laporan.index' ? 'active' : 'text-white' }}">Laporan Aset</a>
                    </li>
                    <li>
                        <a href="{{ route('laporan.peminjaman') }}"
                           class="nav-link {{ $currentRoute == 'laporan.peminjaman' ? 'active' : 'text-white' }}">Laporan Peminjaman</a>
                    </li>
                    <li>
                        <a href="{{ route('laporan.cetakPDF') }}"
                           class="nav-link {{ $currentRoute == 'laporan.cetakPDF' ? 'active' : 'text-white' }}">Cetak Laporan PDF</a>
                    </li>
                </ul>
            </div>
        </li>

        <!-- Logout -->
        <li class="mt-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-light w-100">Logout</button>
            </form>
        </li>
    </ul>
</div>
