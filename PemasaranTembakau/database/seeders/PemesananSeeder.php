<?php

namespace Database\Seeders;

use App\Models\Pemesanan;
use Illuminate\Database\Seeder;

class PemesananSeeder extends Seeder
{
    public function run()
    {
        // Generate 10 data dummy pemesanan
        Pemesanan::factory(10)->create();
    }
}
