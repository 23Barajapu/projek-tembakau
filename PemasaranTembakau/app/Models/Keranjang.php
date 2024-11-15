<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;
    protected $table = 'keranjangs';
    protected $fillable = ['barang_id', 'user_id', 'jumlah', 'sub_total'];

    // Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke barang
    public function barang()
    {
        return $this->belongsTo(BarangPanen::class, 'barang_id', 'id_brg');
    }
}
