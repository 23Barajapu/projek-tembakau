<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'kategori';

    // Atribut yang bisa diisi
    protected $fillable = [
        'nama'
    ];

    // Definisikan relasi dengan model BarangPanen
    public function barangPanen()
    {
        return $this->hasMany(BarangPanen::class, 'kategori_id', 'id');
    }
}
