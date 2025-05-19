<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Aset - Auth</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('/images/bg-login-piksi.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: 'Segoe UI', sans-serif;
            position: relative;
            margin: 0;
            padding: 0;
        }

        /* Overlay gelap seluruh layar */
        .dark-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.45); /* <<< efek gelap */
            z-index: 0;
        }

        .auth-wrapper {
            position: relative;
            z-index: 1; /* supaya tampil di atas overlay */
        }

        .overlay {
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 1rem;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
            animation: fadeInUp 0.6s ease-in-out;
            width: 100%;
            max-width: 420px;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .btn-primary {
            background-color: #0066cc;
            border: none;
        }

        .btn-primary:hover {
            background-color: #004a99;
        }

        input.form-control {
            border-radius: 0.5rem;
            border: 1px solid #ccc;
        }

        h4 {
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="dark-overlay"></div> <!-- Tambahan layer gelap -->
    <div class="auth-wrapper d-flex justify-content-center align-items-center min-vh-100">
        <div class="overlay">
            @yield('content')
        </div>
    </div>
</body>
</html>
