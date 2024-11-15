<?php

namespace Database\Seeders;

use App\Models\Pembayaran;
use Illuminate\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        // Generate 10 data dummy pembayaran
        Pembayaran::factory(10)->create();
    }
}
