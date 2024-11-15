<?php

namespace Database\Seeders;

use App\Models\ItemPemesanan;
use App\Models\Pemesanan;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run()
    {
        // Generate 10 data dummy pemesanan
        ItemPemesanan::factory(10)->create();
    }
}
