<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AnggotaTanis extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('anggota_tanis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kelompok_tani_id'); // Foreign key
            $table->string('nama_anggota');
            $table->string('telepon')->unique();
            $table->string('alamat');
            $table->string('kk');
            $table->string('buku_nikah');
            $table->string('ktp_path')->nullable(); // Path foto KTP
            $table->unsignedBigInteger('id_user');


            $table->foreign('id_user')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            // Relasi ke tabel kelompok_tani
            $table->foreign('kelompok_tani_id')->references('id')->on('kelompok_tani')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('anggota_tanis', function (Blueprint $table) {
            $table->dropForeign(['kelompok_tani_id']); // Hapus foreign key sebelum drop tabel
        });
        Schema::dropIfExists('anggota_tanis');
    }
}
;