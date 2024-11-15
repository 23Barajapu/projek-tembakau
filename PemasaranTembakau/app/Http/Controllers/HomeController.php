<?php

namespace App\Http\Controllers;

use App\Models\BarangPanen;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        // Ambil parameter sorting dan filtering
        $sortBy = $request->input('sort_by', 'id_brg');
        $sortDirection = $request->input('sort_direction', 'asc');
        $categoryId = $request->input('category_id');

        // Filter barang berdasarkan kategori yang dipilih
        $query = BarangPanen::with('kategori')->orderBy($sortBy, $sortDirection);
        if ($categoryId) {
            $query->where('kategori_id', $categoryId);
        }

        // Gunakan paginate untuk ambil 10 barang per halaman
        $barang = $query->paginate(10);

        // Ambil semua kategori
        $categories = Kategori::all();

        // Kirim data ke view
        return view('home', [
            'barang' => $barang,
            'categories' => $categories,
            'sort_by' => $sortBy,
            'sort_direction' => $sortDirection,
            'category_id' => $categoryId,
        ]);
    }

    public function filter(Request $request)
    {
        $categoryId = $request->input('category_id');

        // Memeriksa apakah category_id tidak kosong
        $query = BarangPanen::with('kategori');
        if ($categoryId) {
            $query->where('kategori_id', $categoryId);
        }

        // Gunakan paginate untuk ambil 10 barang per halaman
        $barang = $query->paginate(10);

        // Ambil semua kategori
        $categories = Kategori::all();

        return view('home', [
            'barang' => $barang,
            'categories' => $categories,
            'category_id' => $categoryId,
        ]);
    }

    public function tentangKami()
    {
        return view('FrontEnd.tentang-kami');
    }

    public function testimoni()
    {
        return view('FrontEnd.testimoni');
    }

    //profile
    // Menampilkan halaman profil
    public function show()
    {
        $user = Auth::user(); // Mendapatkan pengguna yang sedang login
        return view('Frontend.profile', compact('user'));
    }
        // Menampilkan halaman edit profil
        public function edit()
        {
            $user = Auth::user(); // Mendapatkan pengguna yang sedang login
            return view('Frontend.edit_profile', compact('user'));
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
        public function admin_show()
        {
            $user = Auth::user(); // Mendapatkan pengguna yang sedang login
            return view('Backend.profile', compact('user'));
        }
            // Menampilkan halaman edit profil
            public function admin_edit()
            {
                $user = Auth::user(); // Mendapatkan pengguna yang sedang login
                return view('Backend.edit_profile', compact('user'));
            }
    
            // Mengupdate profil pengguna
            public function admin_update(Request $request)
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
    
                return redirect()->route('admin_profile.show')->with('success', 'Profil berhasil diperbarui!');
            }
        
    }