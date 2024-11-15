<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DummyUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Lokalitas Indonesia untuk data yang lebih nyata

        $DataUsers = [];
        for ($i = 0; $i < 50; $i++) {
            $DataUsers[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => 12345678,
                'alamat' => $faker->address,
                'kota' => $faker->city,
                'role' => 'pengunjung', // Role secara acak
                'telepon' => $faker->phoneNumber,
            ];
        }


        foreach ($DataUsers as $user) {
            User::create($user);
        }
    }
}