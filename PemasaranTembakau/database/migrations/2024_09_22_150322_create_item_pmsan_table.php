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
        Schema::create('item_pmsan', function (Blueprint $table) {
            $table->bigIncrements('id'); // primary key
            $table->unsignedBigInteger('keranjang_id'); // Foreign key untuk 'keranjangs'
            $table->string('pemesanan_id', 20); // Foreign key untuk 'pemesanan' harus string
            $table->integer('sub_total');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('pemesanan_id')
                ->references('id_pmsan')->on('pemesanan')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('keranjang_id')
                ->references('id')->on('keranjangs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_pmsan');
    }
};