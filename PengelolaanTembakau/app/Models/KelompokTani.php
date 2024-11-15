<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokTani extends Model
{
    use HasFactory;

    protected $table = 'kelompok_tani';

    protected $fillable = [
        'nama_kelompok',
        'jenis_kelompok',
        'jumlah_anggota',
        'ketua_kelompok',
        'desa',
        'kecamatan',
        'penyuluh',
        'nip_penyuluh',
        'id_user',
    ];

    public function anggota()
    {
        return $this->hasMany(AnggotaTani::class);
    }
}