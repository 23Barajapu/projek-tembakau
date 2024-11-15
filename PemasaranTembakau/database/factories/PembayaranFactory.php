<?php

namespace Database\Factories;

use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PembayaranFactory extends Factory
{
    protected $model = Pembayaran::class;

    public function definition()
    {
        return [
            'id_pembayaran' => Str::random(10),  // Generate random id_pembayaran
            'pemesanan_id' => Pemesanan::factory(),  // Generate pemesanan_id dari factory pemesanan
            'metode_pembayaran' => $this->faker->randomElement(['Tunai', 'Transfer']),
            'tempat_pembayaran' => $this->faker->city(),  // Tempat pembayaran random
            'total_pembayaran' => $this->faker->numberBetween(10000, 1000000),  // Random total pembayaran
            'tgl_pembayaran' => $this->faker->date(),  // Random tanggal pembayaran
        ];
    }
}
