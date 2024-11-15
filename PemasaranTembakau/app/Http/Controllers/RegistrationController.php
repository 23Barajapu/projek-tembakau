<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;  // Mengimpor model User
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    // Menampilkan formulir registrasi
    public function showRegistrationForm()
    {
        return view('register');
    }

    // Menangani penyimpanan data registrasi
    public function register(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'alamat' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Simpan data ke database
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Mengenskripsi password
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'telepon' => $request->telepon,
        ]);

        // Redirect ke halaman lain setelah berhasil
        return redirect('/login')->with('success', 'Registration successful.');
    }
}