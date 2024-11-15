<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemPemesanan extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'item_pmsan';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'keranjang_id',
        'pemesanan_id',
        'jumlah',
        'sub_total',
    ];

    // Relasi ke model Pemesanan (Many-to-One)
    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class, 'pemesanan_id', 'id_pmsan');
    }

    // Relasi ke model Barang (Many-to-One)
    public function keranjang()
    {
        return $this->belongsTo(keranjang::class, 'keranjang_id', 'id');
    }
}
