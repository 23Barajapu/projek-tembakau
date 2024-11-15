<?php

namespace App\Models;

use App\Models\jadwalLahan;
use App\Models\Tahapan;
use Illuminate\Database\Eloquent\Model;

class GambarTahapan extends Model
{
    protected $table = 'gambar_tahaps';


    protected $fillable = [
        'nama',
        'tahapan_id',
        'status',
        'validasi',
        'jadwal_id',
        'tanggal_terakhir_unggah',
    ];

     // Definisikan relasi dengan model JadwalLahan
     public function jadwalLahan()
     {
         return $this->belongsTo(JadwalLahan::class, 'jadwal_id');
     }
 
     // Definisikan relasi dengan model Tahapan
     public function tahapan()
     {
         return $this->belongsTo(Tahapan::class, 'tahapan_id');
     }

}