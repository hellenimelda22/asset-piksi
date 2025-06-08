<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
  <div class="container-fluid px-4">
    <a class="navbar-brand fw-bold text-primary" href="{{ url('/dashboard') }}">
      <i class="bi bi-grid-fill me-2"></i> SI ASET
    </a>

    <!-- Spacer biar user di kanan -->
    <div class="ms-auto d-flex align-items-center">
      @auth
        <a href="{{ route('profile') }}" class="d-flex align-items-center text-decoration-none">
          <img src="{{ asset(Auth::user()->foto ? 'uploads/images/' . Auth::user()->foto : 'uploads/images/default.png') }}"
              alt="Foto Profil"
              class="rounded-circle me-2"
              style="width: 32px; height: 32px; object-fit: cover;">
          <span class="fw-semibold text-dark">{{ Auth::user()->name }}</span>
        </a>
      @endauth
    </div>
  </div>
</nav>
