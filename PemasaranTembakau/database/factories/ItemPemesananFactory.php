<?php

namespace Database\Factories;

use App\Models\ItemPemesanan;
use App\Models\Pemesanan;
use App\Models\Barang;
use App\Models\BarangPanen;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemPemesananFactory extends Factory
{
    protected $model = ItemPemesanan::class;

    public function definition(): array
    {
        return [
            'barang_id' => BarangPanen::factory(),
            'pemesanan_id' => Pemesanan::factory(),
            'jumlah' => $this->faker->numberBetween(1, 10),
            'sub_total' => $this->faker->numberBetween(10000, 100000),
        ];
    }
}
