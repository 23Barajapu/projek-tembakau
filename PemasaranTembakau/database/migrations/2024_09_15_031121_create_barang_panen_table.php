<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangPanenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barang_panen', function (Blueprint $table) {
            $table->string('id_brg', 20)->primary(); // varchar as primary key
            $table->string('nama', 100);
            $table->integer('harga');
            $table->integer('stok');
            $table->enum('satuan', ['Kg', 'Ton']);
            $table->text('deskripsi');
            $table->string('gambar_brg', 255);
            $table->unsignedBigInteger('kategori_id'); // Foreign key column
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('kategori_id')
                ->references('id')->on('kategori')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barang_panen');
    }
}
