<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    // Tampilkan form pendaftaran
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Proses pendaftaran
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Simpan user ke database tanpa hash
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password, // Simpan langsung (TIDAK DI-HASH)
        ]);

        // Redirect ke halaman login setelah registrasi
        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
