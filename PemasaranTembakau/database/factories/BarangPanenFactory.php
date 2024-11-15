<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BarangPanen>
 */
class BarangPanenFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Models\BarangPanen::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_brg' => $this->faker->unique()->bothify('BRG###'),
            'nama' => $this->faker->word(),
            'harga' => $this->faker->numberBetween(50000, 200000),
            'stok' => $this->faker->numberBetween(10, 100),
            'satuan' => $this->faker->randomElement(['Kg', 'Ton']),
            'deskripsi' => $this->faker->sentence(),
            'gambar_brg' => $this->faker->imageUrl(),
            'kategori_id' => \App\Models\Kategori::factory(), // Menggunakan factory Kategori
        ];
    }
}
