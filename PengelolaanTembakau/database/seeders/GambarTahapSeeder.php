<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GambarTahapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('gambar_tahaps')->insert([
            [
                'nama' => 'Gambar Tahap 1',
                'tahapan_id' => 1, // Pastikan sesuai dengan data di tabel tahapan
                'jadwal_id' => 1, // Pastikan sesuai dengan data di tabel jadwal
                'status' => 'Segera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Gambar Tahap 2',
                'tahapan_id' => 2,
                'jadwal_id' => 1,
                'status' => 'Sedang berlangsung',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Gambar Tahap 3',
                'tahapan_id' => 3,
                'jadwal_id' => 2,
                'status' => 'Selesai',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan lebih banyak data jika diperlukan
        ]);
    }
}