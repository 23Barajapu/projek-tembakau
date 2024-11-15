<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class validation extends Model
{
    protected $table = 'validations';

    protected $fillable = [
        'hari',
        'tahapan_id',
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