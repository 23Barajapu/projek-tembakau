<?php

namespace App\Http\Controllers;

use App\Models\BarangPanen;
use App\Models\Kategori;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ShopController extends Controller
{
    public function index(Request $request)
    {
        // Ambil parameter sorting dan filtering
        $sortBy = $request->input('sort_by', 'id_brg');
        $sortDirection = $request->input('sort_direction', 'asc');
        $categoryId = $request->input('category_id');
        $searchKeyword = $request->input('search'); // Ambil kata kunci pencarian
        $minPrice = $request->input('min_price', 0); // Ambil harga minimum
        $maxPrice = $request->input('max_price', 1000000); // Ambil harga maksimum

        // Menghitung total produk
        $totalProducts = BarangPanen::count();

        // Ambil kategori beserta jumlah barang di setiap kategori
        $categories = Kategori::withCount('barangPanen')->get();

        // Query barang dengan paginasi, sorting, dan filtering
        $query = BarangPanen::with('kategori')->orderBy($sortBy, $sortDirection);

        if ($categoryId) {
            $query->where('kategori_id', $categoryId);
        }

        if ($searchKeyword) {
            $query->where('nama', 'like', '%' . $searchKeyword . '%');
        }

        $query->whereBetween('harga', [$minPrice, $maxPrice]);

        // Gunakan paginate untuk ambil 10 barang per halaman
        $barang = $query->paginate(10);

        // Kirim data ke view
        return view('FrontEnd.shop', [
            'barang' => $barang,
            'categories' => $categories,
            'totalProducts' => $totalProducts,
            'searchKeyword' => $searchKeyword, // Kirim kata kunci ke view
            'minPrice' => $minPrice, // Kirim harga minimum ke view
            'maxPrice' => $maxPrice, // Kirim harga maksimum ke view
        ]);
    }
    public function detail($id_brg)
    {
        // Ambil data barang berdasarkan id
        $barang = BarangPanen::with('kategori')->findOrFail($id_brg);

        return view('FrontEnd.shop-detail', [
            'barang' => $barang,
        ]);
    }
}
