<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jadwalLahan extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    protected $casts = [
        'tanggal_tanam' => 'date',
    ];
    protected $fillable = ['lahan_id', 'tanggal_tanam', 'pupuk', 'bibit', 'id_user', 'status'];

    // Definisikan relasi ke model Lahan
    public function lahan()
    {
        return $this->belongsTo(Lahan::class, 'lahan_id', 'id'); // relasi belongsTo dengan model Lahan

    }
    // Relasi ke model GambarTahap
    public function gambarTahaps()
    {
        return $this->hasMany(GambarTahapan::class, 'jadwal_id');
    }

    // Relasi ke model Validation
    public function validations()
    {
        return $this->hasMany(Validation::class, 'jadwal_id');
    }
}