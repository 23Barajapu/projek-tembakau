<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pemesanan', function (Blueprint $table) {
            $table->string('id_pmsan', 20)->primary(); // varchar as primary key
            $table->string('nama');
            $table->string('telepon');
            $table->string('alamat');
            $table->string('catatan');
            $table->string('nama_pengiriman')->default(null);
            $table->string('nama_layanan')->default(null);
            $table->integer('total_berat')->default(null);
            $table->integer('harga_layanan')->default(null);
            $table->integer('total_harga');
            $table->string('nomor_resi')->default(null);
            $table->unsignedBigInteger('user_id');
            $table->date('tgl_pmsan');
            $table->enum('status', ['Belum', 'Sudah', 'Gagal'])->default('Belum');
            $table->enum('status_brg', ['Menunggu konfirmasi', 'Sedang pengemasan', 'Pengiriman', 'Sudah sampai'])->default('Menunggu konfirmasi');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanan');
    }
};