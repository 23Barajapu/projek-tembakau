<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panen extends Model
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
        'id_user',
        'id_jadwal',
    ];

    /**
     * Relasi ke tabel User
     * Setiap lahan dimiliki oleh satu pengguna (user).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Relasi ke tabel Jadwal
     * Setiap lahan memiliki satu jadwal yang terkait.
     */
    public function jadwal()
    {
        return $this->belongsTo(jadwalLahan::class, 'id_jadwal');
    }
}
