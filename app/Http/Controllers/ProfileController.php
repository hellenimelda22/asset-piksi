<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->update($request->only(['name', 'email']));

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui');
    }
}
