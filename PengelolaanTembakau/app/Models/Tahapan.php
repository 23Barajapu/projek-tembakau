<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tahapan extends Model
{

    protected $table = 'tahapan';
    protected $fillable = [
        'tahap',
        'nama_tahap',
        'deskripsi',
        'mulai',
        'selesai',
        'id_user',
    ];
}