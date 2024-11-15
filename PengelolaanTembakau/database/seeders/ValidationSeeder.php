<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ValidationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('validations')->insert([
            [
                'tanggal_terakhir_unggah' => Carbon::now()->subDays(3),
                'hari' => 1,
                'tahapan_id' => 1, // Pastikan id ini sesuai dengan data pada tabel tahapan
                'jadwal_id' => 1, // Pastikan id ini sesuai dengan data pada tabel jadwal
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal_terakhir_unggah' => Carbon::now()->subDays(2),
                'hari' => 2,
                'tahapan_id' => 1,
                'jadwal_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'tanggal_terakhir_unggah' => Carbon::now()->subDays(1),
                'hari' => 3,
                'tahapan_id' => 3,
                'jadwal_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data lain sesuai kebutuhan
        ]);
    }
}