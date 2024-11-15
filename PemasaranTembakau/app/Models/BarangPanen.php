<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangPanen extends Model
{
    use HasFactory;

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'barang_panen';
    protected $primaryKey = 'id_brg'; // Tentukan primary key-nya
    public $incrementing = false;     // Jika id_brg bukan integer, nonaktifkan auto-increment
    protected $keyType = 'string';
    // Atribut yang bisa diisi
    protected $fillable = [
        'id_brg',
        'nama',
        'harga',
        'stok',
        'satuan',
        'deskripsi',
        'gambar_brg',
        'kategori_id'
    ];

    // Definisikan relasi dengan model Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
