<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lahan extends Model
{
    use HasFactory;
    protected $table = 'lahan';


    protected $fillable = [
        'pengurus_lahan',
        'nama_lahan',
        'luas_lahan',
        'alamat_lahan',
        'status',
        'pbb',
        'sertifikat_lahan',
        'foto_lahan',
        'id_user',

    ];

    public function anggotaTani()
    {
        return $this->belongsTo(AnggotaTani::class, 'pengurus_lahan', 'id');
    }
    public function jadwal()
    {
        return $this->hasMany(jadwalLahan::class, 'lahan_id'); // relasi hasMany ke Jadwal
    }
}