<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    // Menentukan nama tabel
    protected $table = 'pemesanan';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id_pmsan',
        'nama',
        'telepon',
        'alamat',
        'catatan',
        'total_harga',
        'nama_pengiriman',
        'nama_layanan',
        'harga_layanan',
        'total_berat',
        'nomor_resi',
        'user_id',
        'tgl_pmsan',
        'created_at',
        'updated_at',

    ];

    // Primary key
    protected $primaryKey = 'id_pmsan';
    public $incrementing = false; // Karena primary key adalah string

    // Relasi ke model User (Many-to-One)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke model Pembayaran (One-to-Many)
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'pemesanan_id', 'id_pmsan');
    }
    public function items()
    {
        return $this->hasMany(ItemPemesanan::class, 'pemesanan_id', 'id_pmsan');
    }
}