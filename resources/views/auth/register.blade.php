<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
</head>
<body>
    <h2>Form Registrasi</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <label>Nama:</label>
        <input type="text" name="name" required>
        <br>
        <label>Email:</label>
        <input type="email" name="email" required>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required>
        <br>
        <label>Konfirmasi Password:</label>
        <input type="password" name="password_confirmation" required>
        <br>
        <button type="submit">Daftar</button>
    </form>

    <!-- Tombol untuk pengguna yang sudah memiliki akun -->
    <p>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></p>
</body>
</html>
