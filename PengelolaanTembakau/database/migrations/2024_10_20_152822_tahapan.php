<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tahapan extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tahapan', function (Blueprint $table) {
            $table->id();
            $table->integer('tahap')->unique();
            $table->string('nama_tahap');
            $table->string('deskripsi');
            $table->integer('mulai');
            $table->integer('selesai');
            $table->timestamps();
            $table->unsignedBigInteger('id_user');


            $table->foreign('id_user')
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
        Schema::dropIfExists('tahapan');
    }
}
;