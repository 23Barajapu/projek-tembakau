<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriSeeder extends Seeder
{
    public function run()
    {
        DB::table('kategori')->insert([
            ['nama' => 'Grade A'],
            ['nama' => 'Grade B'],
            ['nama' => 'Grade C'],
        ]);
    }
}
