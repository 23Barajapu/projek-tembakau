<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Menampilkan halaman profil
    public function show()
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        return view('Profile.profile', compact('user'));
    }
        // Menampilkan halaman edit profil
        public function edit()
        {
            $user = Auth::user(); // Mendapatkan pengguna yang sedang login
            return view('Profile.edit_profile', compact('user'));
        }

        // Mengupdate profil pengguna
        public function update(Request $request)
        {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'alamat' => 'required|string|max:255',
                'kota' => 'required|string|max:255',
                'telepon' => 'required|string|max:15',
            ]);

            $user = Auth::user(); // Mendapatkan pengguna yang sedang login
            $user->update($validatedData); // Update data pengguna

            return redirect()->route('profile.show')->with('success', 'Profil berhasil diperbarui!');
        }
}