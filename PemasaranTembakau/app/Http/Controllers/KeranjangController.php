<?php

namespace App\Http\Controllers;

use App\Models\BarangPanen;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KeranjangController extends Controller
{
    // Menambahkan barang ke keranjang
    public function keranjang(Request $request)
    {
        // Validasi request
        $request->validate([
            'id_brg' => 'required|exists:barang_panen,id_brg',
            'jumlah' => 'required|integer|min:1',
        ], [
            'id_brg.required' => 'Barang tidak ditemukan.',
            'jumlah.required' => 'Jumlah barang tidak boleh kosong.',
        ]);

        $user_id = Auth::id();
        $jumlah = $request->jumlah;

        // Ambil harga barang hanya sekali
        $barang = BarangPanen::find($request->id_brg);
        $harga = $barang->harga;

        // Cek apakah ada keranjang untuk barang_id dan user_id dengan pembayaran 'tidak'
        $keranjang = Keranjang::where('barang_id', $request->id_brg)
            ->where('user_id', $user_id)
            ->where('pembayaran', 'tidak')
            ->first();

        if ($keranjang) {
            // Jika keranjang sudah ada, tambahkan jumlah dan perbarui subtotal
            $keranjang->jumlah += $jumlah;
            $keranjang->sub_total = $keranjang->jumlah * $harga;
            $keranjang->save();
        } else {
            // Jika tidak ada keranjang sama sekali, buat keranjang baru
            Keranjang::create([
                'user_id' => $user_id,
                'barang_id' => $request->id_brg,
                'jumlah' => $jumlah,
                'sub_total' => $harga * $jumlah,
                'pembayaran' => 'tidak', // Status pembayaran belum
            ]);
        }

        return redirect()->route('FrontEnd.showCart')->with('success', 'Item berhasil ditambahkan ke keranjang');
    }


    // Menampilkan halaman keranjang
    public function showCart()
    {
        $user_id = Auth::id();

        // Ambil semua keranjang milik user dengan pembayaran 'tidak'
        $keranjangs = Keranjang::where('user_id', $user_id)
            ->where('pembayaran', 'tidak')
            ->with('barang')
            ->get();

        // Hitung subtotal
        $subtotal = $keranjangs->sum('sub_total');

        return view('FrontEnd.keranjang', compact('keranjangs', 'subtotal'));
    }

    // Update jumlah item di keranjang
    public function updateCart(Request $request)
    {
        // Validasi request
        $request->validate([
            'id' => 'required|exists:keranjangs,id',
            'qty' => 'required|integer|min:1',
        ]);

        $keranjang = Keranjang::find($request->id);

        if (!$keranjang) {
            return response()->json(['error' => 'Item not found'], 404);
        }

        // Update jumlah dan subtotal sesuai dengan yang baru
        $keranjang->jumlah = $request->qty;
        $keranjang->sub_total = $keranjang->barang->harga * $request->qty;
        $keranjang->save();

        // Hitung ulang subtotal untuk semua item dalam keranjang
        $subtotal = Keranjang::where('user_id', Auth::id())
            ->where('pembayaran', 'tidak')
            ->sum('sub_total');

        return response()->json([
            'updated' => true,
            'keranjang' => $keranjang,
            'subtotal' => $subtotal
        ]);
    }

    // Hapus barang dari keranjang
    public function deleteCart(Request $request)
    {
        $keranjang = Keranjang::find($request->id);
        if ($keranjang) {
            $keranjang->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Item not found'], 404);
    }
}