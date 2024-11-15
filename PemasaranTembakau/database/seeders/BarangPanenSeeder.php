<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BarangPanenSeeder extends Seeder
{
    public function run()
    {
        // Mendapatkan ID kategori untuk referensi
        $kategoriIds = DB::table('kategori')->pluck('id');

        $data = [
            [
                'id_brg' => 'BRG001',
                'nama' => 'Tembakau',
                'harga' => 200000,
                'stok' => 50,
                'satuan' => 'Kg',
                'deskripsi' => 'Tembakau Grade A yang berkualitas baik',
                'gambar_brg' => 'tembakau4.jpg',
                'kategori_id' => 1, // Mengambil ID kategori secara acak
            ],
            [
                'id_brg' => 'BRG002',
                'nama' => 'Tembakau Rare',
                'harga' => 120000,
                'stok' => 100,
                'satuan' => 'Kg',
                'deskripsi' => 'Tembakau Grade B yang berkualitas baik',
                'gambar_brg' => 'tembakau5.jpeg',
                'kategori_id' => 2, // Mengambil ID kategori secara acak
            ],
            [
                'id_brg' => 'BRG003',
                'nama' => 'Tembakau',
                'harga' => 100000,
                'stok' => 30,
                'satuan' => 'Kg',
                'deskripsi' => 'Tembakau Grade C yang berkualitas baik',
                'gambar_brg' => 'tembakau3.jpeg',
                'kategori_id' => 3, // Mengambil ID kategori secara acak
            ],
        ];

        DB::table('barang_panen')->insert($data);
    }
}
