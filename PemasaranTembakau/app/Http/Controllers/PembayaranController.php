<?php

namespace App\Http\Controllers;

use App\Models\ItemPemesanan;
use App\Models\Keranjang;
use App\Models\Pemesanan;
use Illuminate\Container\Attributes\Log;
use Midtrans\Snap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log as FacadesLog;

class PembayaranController extends Controller
{
    public function pay(Request $request)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telepon' => 'required|string|max:15',
            'catatan' => 'nullable|string|max:500',
            'nama_pengiriman' => 'required|string|max:255',
            'nama_layanan' => 'required|string|max:255',
            'harga_layanan' => 'required|integer',
            'berat' => 'required|integer',
            'ids' => 'required|array',
            'ids.*' => 'exists:keranjangs,id',
        ]);

        // Ambil data keranjang beserta barang terkait
        $keranjangs = Keranjang::with('barang')
            ->whereIn('id', $validatedData['ids'])
            ->get();

        $validatedData['catatan'] = $validatedData['catatan'] ?? 'Tidak ada catatan';

        // Hitung subtotal dan total keseluruhan
        $subtotal = $keranjangs->sum('sub_total');
        $total = $subtotal + $validatedData['harga_layanan'];

        if ($total <= 0) {
            return redirect()->back()->withErrors('Total must be greater than 0.');
        }

        $nama_shipping = "{$validatedData['nama_pengiriman']} - {$validatedData['nama_layanan']}";
        $itemDetails = $this->getItemDetails($keranjangs->toArray());
        $itemDetails[] = [
            'id' => 'SHIPPING',
            'name' =>  $nama_shipping,
            'price' => $validatedData['harga_layanan'],
            'quantity' => 1,
        ];

        // Buat ID Pemesanan unik dan ambil user info
        $orderId = uniqid('ORD-');
        $user = FacadesAuth::user();

        // Simpan data pemesanan
        $pemesanan = Pemesanan::create([
            'id_pmsan' => $orderId,
            'nama' => $validatedData['nama'],
            'telepon' => $validatedData['telepon'],
            'alamat' => $validatedData['alamat'],
            'catatan' => $validatedData['catatan'],
            'nama_pengiriman' => $validatedData['nama_pengiriman'],
            'nama_layanan' => $validatedData['nama_layanan'],
            'harga_layanan' => $validatedData['harga_layanan'],
            'total_berat' => $validatedData['berat'],
            'nomor_resi' => '',
            'total_harga' => $total,
            'user_id' => $user->id,
            'tgl_pmsan' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Simpan item keranjang ke item_pmsan
        $keranjangs->each(function ($keranjang) use ($orderId) {
            ItemPemesanan::create([
                'keranjang_id' => $keranjang->id,
                'pemesanan_id' => $orderId,
                'sub_total' => $keranjang->sub_total,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        });

        // Buat parameter Midtrans dan dapatkan Snap Token
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $total,
            ],
            'customer_details' => [
                'first_name' => $validatedData['nama'],
                'email' => $user->email,
                'phone' => $validatedData['telepon'],
            ],
            'item_details' => $itemDetails,
        ];
        $snapToken = Snap::getSnapToken($params);

        // Kembalikan view dengan Snap Token dan data lainnya
        return view('FrontEnd.konfirmasi-pembayaran', [
            'validatedData' => $validatedData,
            'keranjangs' => $keranjangs,
            'total' => $total,
            'snapToken' => $snapToken,
            'orderId' => $orderId
        ]);
    }


    private function getItemDetails($keranjangs)
    {
        $items = []; // Inisialisasi array kosong

        foreach ($keranjangs as $item) {
            if (isset($item['barang'])) {
                $items[] = [
                    'id' => $item['barang']['id_brg'],
                    'name' => $item['barang']['nama'],
                    'price' => $item['barang']['harga'],
                    'quantity' => $item['jumlah'],
                ];
            }
        }

        return $items; // Kembalikan semua item setelah loop selesai
    }



    public function paymentSuccess(Request $request)
    {
        $orderId = $request->query('orderId');

        // Jika transaksi sukses (berstatus 'settlement' atau 'capture')

        // Update status di tabel pemesanan menjadi 'Sudah'
        $pemesanan = Pemesanan::where('id_pmsan', $orderId)->first();
        $pemesanan = Pemesanan::with('user')->where('id_pmsan', $orderId)->first();


        if ($pemesanan) {
            $pemesanan->status = 'Sudah';
            $pemesanan->save();

            // Ambil semua item pemesanan berdasarkan pemesanan_id
            $itemPemesanan = ItemPemesanan::where('pemesanan_id', $orderId)->get();

            // Update keranjangs pembayaran jadi 'iya' berdasarkan keranjang_id di item_pemesanan
            foreach ($itemPemesanan as $item) {
                $keranjang = Keranjang::find($item->keranjang_id);
                if ($keranjang) {
                    $keranjang->pembayaran = 'iya';
                    $keranjang->save();

                    // Kurangi stok barang berdasarkan jumlah dari keranjang
                    $barang = $keranjang->barang; // Mengambil barang terkait
                    if ($barang) {
                        $barang->stok -= $keranjang->jumlah; // Kurangi stok
                        $barang->save(); // Simpan perubahan stok
                    }
                }
            }
        }

        // Tampilkan halaman invoice
        return view('FrontEnd.invoice_before', ['pemesanan' => $pemesanan], ['orderId' => $orderId]);
    }



    public function index()
    {
        return view('FrontEnd.Pembayaran');
    }
}