<?php

namespace App\Http\Controllers;

use App\Models\ItemPemesanan;
use App\Models\Keranjang;
use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class PembelianController extends Controller
{
    public function formPembelian(Request $request)
    {
        // Ambil query parameter 'ids' dari URL
        $ids = $request->input('ids');

        if ($ids) {
            $user = Auth::user();
            // Pisahkan ID menjadi array
            $selectedItems = explode(',', $ids);

            // Ambil barang yang dipilih dari database berdasarkan ID
            $keranjangs = Keranjang::whereIn('id', $selectedItems)->get();

            $admin = User::where('role', 'admin')->first();
            // Menghitung total berat keranjang dalam gram
            $totalWeightInGrams = $keranjangs->sum(function ($keranjang) {
                // Asumsikan setiap jumlah barang memiliki berat 1 kg, lalu konversi ke gram
                return $keranjang->jumlah * 1000;
            });

            $response = Http::withHeaders([
                'key' => 'c052ea5113775df52f21a5b8d2f1eb8a'
            ])->get('https://api.rajaongkir.com/starter/city');

            $cities = $response['rajaongkir']['results'];

            // Cari city_id yang sesuai dengan kota user
            $userCity = collect($cities)->firstWhere('city_name', $user->kota);
            $userCityId = $userCity ? $userCity['city_id'] : null; // Dapatkan city_id atau null jika tidak ditemukan
            // Cari city_id yang sesuai dengan kota admin

            $adminCity = collect($cities)->firstWhere('city_name', $admin->kota);
            $adminCityId = $adminCity ? $adminCity['city_id'] : null; // Dapatkan city_id atau null jika tidak ditemukan
            // Redirect ke halaman konfirmasi pembayaran dengan data biaya pengiriman
            return view('Frontend.form-pembelian', [
                'cities' => $cities,
                'ongkir' => null,
                'user' => $user,
                'admin' => $admin,
                'userCityId' => $userCityId,
                'adminCityId' => $adminCityId,
                'beratGram' => $totalWeightInGrams,
                'keranjangs' => $keranjangs,
            ]);
        } else {
            return redirect()->back()->with('error', 'Tidak ada barang yang dipilih!');
        }
    }


    //ga guna
    public function konfirmasi(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'catatan' => 'nullable|string|max:500',
            'nama_pengiriman' => 'required|string|max:255',
            'nama_layanan' => 'required|string|max:255',
            'harga_layanan' => 'required|integer|max:15',
            'total_berat' => 'required|integer|max:15',
            'ids' => 'required|array',
            'ids.*' => 'exists:keranjangs,id',
        ]);



        // Ambil data keranjang
        $keranjangs = Keranjang::whereIn('id', $validatedData['ids'])->get();

        // Hitung total
        $total = $keranjangs->sum('sub_total') + $validatedData['harga_layanan'];

        // Kembalikan view konfirmasi dengan data
        return view('FrontEnd.konfirmasi-pembayaran', compact('validatedData', 'keranjangs', 'total'));
    }

    public function status()
    {
        $userId = Auth::id(); // Ambil ID pengguna yang sedang login

        $pemesanans = Pemesanan::with('items', 'user')
            ->where('status_brg', '!=', 'Sudah sampai')
            ->where('user_id', $userId)
            ->where('status', '=', 'Sudah')
            ->get();


        return view('FrontEnd.status', compact('pemesanans')); // Kirim data ke view
    }
    public function updateStatusSS(Request $request, $id)
    {
        // Temukan pemesanan berdasarkan ID
        $pemesanan = Pemesanan::findOrFail($id);

        // Ubah status menjadi 'Sudah sampai'
        $pemesanan->status_brg = 'Sudah sampai';
        $pemesanan->save();

        // Redirect atau return response
        return redirect()->back()->with('success', 'Status pemesanan telah diperbarui.');
    }

    public function AdminStatus()
    {
        // Eager load 'items' and filter out 'Sudah sampai' status
        $pemesanans = Pemesanan::with('items', 'user')
            ->where('status_brg', '!=', 'Sudah sampai')
            ->where('status', '=', 'Sudah')
            ->get();

        return view('BackEnd.status', compact('pemesanans')); // Kirim data ke view
    }

    public function updateStatus(Request $request, $id_pmsan)
    {
        // Cari pemesanan berdasarkan id_pmsan
        $request->validate([
            'status' => 'required|string',
            'nomor_resi' => 'nullable|string',
            'gambar_resi' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Mengunggah gambar
        if ($request->hasFile('gambar_resi')) {
            $imageName = time() . '.' . $request->gambar_resi->extension();
            $request->gambar_resi->move(public_path('gambar_resi'), $imageName);
        }

        $pemesanan = Pemesanan::findOrFail($id_pmsan);
        $pemesanan->status_brg = $request->status;
        $pemesanan->nomor_resi = $request->no_resi ?? null;
        $pemesanan->gambar_resi = $imageName ?? null; // Jika gambar ada, update nama file gambar, jika tidak, tetapkan null
        $pemesanan->save();
        // Redirect kembali ke halaman history atau status
        return redirect()->route('pemesanan.adminStatus')->with('success', 'Status barang telah diperbarui menjadi "Sudah sampai"');
    }

    public function history()
    {
        $userId = Auth::id(); // Ambil ID pengguna yang sedang login

        // Ambil pemesanan dengan status barang 'Sudah sampai' dan user_id sesuai dengan pengguna yang login
        $pemesanans = Pemesanan::with('items', 'user') // Ambil dengan relasi items
            ->where('user_id', $userId)
            ->where('status', '=', 'Sudah')
            ->where('status_brg', 'Sudah sampai')
            ->get();

        return view('FrontEnd.history', compact('pemesanans'));
    }
    public function historyAdmin()
    {
        // Ambil pemesanan dengan status barang 'Sudah sampai' dan user_id sesuai dengan pengguna yang login
        $pemesanans = Pemesanan::with('items', 'user') // Ambil dengan relasi items
            ->where('status_brg', 'Sudah sampai')
            ->where('status', '=', 'Sudah')
            ->get();

        return view('BackEnd.history', compact('pemesanans'));
    }

    //CEK ONGKIR
    public function ongkir()
    {
        $response = Http::withHeaders([
            'key' => 'c052ea5113775df52f21a5b8d2f1eb8a'
        ])->get('https://api.rajaongkir.com/starter/city');

        $cities = $response['rajaongkir']['results'];

        dd($response->json());

        return view('Frontend/form-pembelian', ['cities' => $cities, 'ongkir' => '']);
    }


    public function cekOngkir(Request $request)
    {
        $user = Auth::user();
        $keranjangs = Keranjang::whereIn('id', $request['ids'])->get();


        $admin = User::where('role', 'admin')->first();

        // Ambil data kota dari API Raja Ongkir
        $response = Http::withHeaders([
            'key' => 'c052ea5113775df52f21a5b8d2f1eb8a'
        ])->get('https://api.rajaongkir.com/starter/city');

        // Request ongkos kirim berdasarkan data input dari form
        $responseCost = Http::withHeaders([
            'key' => 'c052ea5113775df52f21a5b8d2f1eb8a'
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $request->origin,
            'destination' => $request->destination,
            'weight' => $request->weight,
            'courier' => $request->courier,
        ]);
        $cities = $response['rajaongkir']['results'];
        $ongkir = $responseCost['rajaongkir']['results'];

        // Menghitung total berat keranjang dalam gram
        $totalWeightInGrams = $keranjangs->sum(function ($keranjang) {
            // Asumsikan setiap jumlah barang memiliki berat 1 kg, lalu konversi ke gram
            return $keranjang->jumlah * 1000;
        });
        // Cari city_id yang sesuai dengan kota user
        $userCity = collect($cities)->firstWhere('city_name', $user->kota);
        $userCityId = $userCity ? $userCity['city_id'] : null; // Dapatkan city_id atau null jika tidak ditemukan
        // Cari city_id yang sesuai dengan kota admin
        $adminCity = collect($cities)->firstWhere('city_name', $admin->kota);
        $adminCityId = $adminCity ? $adminCity['city_id'] : null; // Dapatkan city_id atau null jika tidak ditemukan

        return view('Frontend.form-pembelian', [
            'cities' => $cities,
            'ongkir' => $ongkir,
            'user' => $user,
            'keranjangs' => $keranjangs,
            'admin' => $admin,
            'userCityId' => $userCityId,
            'adminCityId' => $adminCityId,
            'beratGram' => $totalWeightInGrams,
        ]);
    }
}