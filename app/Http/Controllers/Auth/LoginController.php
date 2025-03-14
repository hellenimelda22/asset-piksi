<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');

        // Cek apakah email ada di database
        $user = User::where('email', $credentials['email'])->first();

        // Cek apakah user ditemukan dan password cocok
        if ($user && $user->password === $credentials['password']) {
            Auth::login($user); // Login manual tanpa hash
            return redirect()->intended('/dashboard'); // Redirect ke dashboard
        }

        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
