<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilPanen extends Model
{
    use HasFactory;

    protected $table = 'panen';

    protected $fillable = [
        'namaLahan',
        'tanggalPenanaman',
        'tanggalPanen',
        'jumlahPanen',
        'hargaGradeA',
        'hargaGradeB',
        'hargaGradeC',
        'id_jadwal',
    ];
}
