<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">Asset Piksi</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/asset') }}">Aset</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/kategori') }}">Kategori</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/peminjaman') }}">Peminjaman</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ url('/laporan') }}">Laporan</a>
        </li>
      </ul>

      <!-- Bagian Kanan Navbar -->
      <ul class="navbar-nav">
        @auth
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
            <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="{{ route('profile') }}">Profil</a></li>
            <li><hr class="dropdown-divider"></li>
            <li>
              <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="dropdown-item" type="submit">Logout</button>
              </form>
            </li>
          </ul>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
