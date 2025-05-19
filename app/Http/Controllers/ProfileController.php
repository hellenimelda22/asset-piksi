<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{

    public function show()
    {
        return view('profile.show', ['user' => auth()->user()]);
    }
    
    public function edit()
    {
        return view('profile.edit', ['user' => auth()->user()]);
    }
    
    public function update(Request $request)
    {
        $user = auth()->user();
    
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $user->name = $request->name;
        $user->email = $request->email;
    
        if ($request->hasFile('photo')) {
            // Hapus foto lama kalau ada
            if ($user->photo && file_exists(public_path('images/' . $user->photo))) {
                unlink(public_path('images/' . $user->photo));
            }
    
            // Simpan foto baru
            $filename = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('images'), $filename);
            $user->photo = $filename;
        }
    
        $user->save();
    
        return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
    }
}    