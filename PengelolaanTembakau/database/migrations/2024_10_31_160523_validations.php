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
        Schema::create('validations', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_terakhir_unggah');
            $table->string('hari');
            $table->unsignedBigInteger('tahapan_id');
            $table->unsignedBigInteger('jadwal_id');
            $table->timestamps();

            // Relasi ke tabel tahapan
            $table->foreign('tahapan_id')->references('id')->on('tahapan')->onDelete('cascade')->onUpdate('cascade');
            // Relasi ke tabel jadwal
            $table->foreign('jadwal_id')->references('id')->on('jadwal')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('validations');
    }
};