<?php

namespace Database\Seeders;

use App\Models\ItemPemesanan;
use Database\Seeders\ProvinceSeeder as SeedersProvinceSeeder;
use Illuminate\Database\Seeder;
use ProvinceSeeder;

class DatabaseSeeder extends Seeder
{
    /**P
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            DummyUsers::class,
            KategoriSeeder::class,
            BarangPanenSeeder::class,
            PemesananSeeder::class,
            PembayaranSeeder::class,
            ItemPemesanan::class,
            // Tambahkan seeder lain jika diperlukan
        ]);
    }
}