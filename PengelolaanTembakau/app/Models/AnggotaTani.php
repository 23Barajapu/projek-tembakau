<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnggotaTani extends Model
{
    use HasFactory;
    protected $table = 'anggota_tanis';


    protected $fillable = [
        'kelompok_tani_id',
        'nama_anggota',
        'alamat',
        'telepon',
        'ktp_path',
        'kk',
        'buku_nikah',
        'id_user',

    ];

    public function kelompokTani()
    {
        return $this->belongsTo(KelompokTani::class);
    }
    public function lahan()
    {
        return $this->hasMany(Lahan::class, 'pengurus_lahan');
    }
}