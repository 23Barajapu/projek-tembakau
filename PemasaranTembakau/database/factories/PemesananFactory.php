<?php

namespace Database\Factories;

use App\Models\Pemesanan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PemesananFactory extends Factory
{
    protected $model = Pemesanan::class;

    public function definition()
    {
        return [
            'id_pmsan' => Str::random(10),  // Generate random id_pmsan
            'total_harga' => $this->faker->numberBetween(10000, 1000000),  // Random harga
            'user_id' => User::factory(), // Generate user ID dari factory user
            'tgl_pmsan' => $this->faker->date(),  // Random tanggal
        ];
    }
}
