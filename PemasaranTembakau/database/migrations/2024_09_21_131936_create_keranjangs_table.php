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
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('barang_id', 20); // Foreign key column
            $table->unsignedBigInteger('user_id');
            $table->enum('pembayaran', ['tidak', 'iya'])->default('tidak');
            $table->integer('jumlah');
            $table->integer('sub_total');
            $table->timestamps();

            $table->foreign('barang_id')
                ->references('id_brg')->on('barang_panen') // Pastikan tabel `barangs` ada
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('keranjangs');
    }
};