<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>SI ASET - @yield('title')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

    <!-- DataTables Bootstrap5 CSS -->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" />

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        .sidebar {
            width: 250px;
            background-color: rgb(95, 155, 245);
            color: white;
            min-height: 100vh;
        }

        .sidebar .nav-link {
            color: white;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover,
        .sidebar .nav-link.fw-bold {
            background-color: #063970;
        }

        .sidebar h5 {
            font-weight: bold;
        }

        .content-area {
            flex-grow: 1;
        }

        .navbar {
            background-color: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

    <div class="d-flex">
        @include('layouts.sidebar')

        <div class="content-area">
            <nav class="navbar navbar-light px-4 py-2">
                <div class="d-flex justify-content-between w-100">
                    <span class="navbar-brand mb-0 h5">Sistem Informasi Aset</span>
                   <a href="{{ route('profile.show') }}" class="d-flex align-items-center text-decoration-none">
                    <img src="{{ asset('images/default-user.jpg') }}" alt="Foto Profil"
                        class="rounded-circle me-2 object-fit-cover" width="36" height="36"
                        style="object-fit: cover;"
                        onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff';" />

                    <span class="text-dark">{{ Auth::user()->name }}</span>
                </a>
                </div>
            </nav>

            <div class="p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- jQuery (Load sekali) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Custom scripts per page -->
    @stack('scripts')

</body>
</html>
