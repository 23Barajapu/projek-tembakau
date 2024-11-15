<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'pembayaran';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id_pembayaran',
        'pemesanan_id',
        'metode_pembayaran',
        'tempat_pembayaran',
        'total_pembayaran',
        'tgl_pembayaran',
    ];

    // Primary key
    protected $primaryKey = 'id_pembayaran';
    public $incrementing = false; // Karena primary key adalah string

    // Relasi ke model Pemesanan (Many-to-One)
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id', 'id_pmsan');
    }
}
