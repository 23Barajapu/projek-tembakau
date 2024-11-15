<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('panen', function (Blueprint $table) {
            $table->id();
            $table->date('tanggalPenanaman');
            $table->date('tanggalPanen');
            $table->integer('jumlahPanen');
            $table->integer('hargaGradeA');
            $table->integer('hargaGradeB');
            $table->integer('hargaGradeC');
            $table->timestamps();
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_jadwal')->nullable();

            $table->foreign('id_jadwal')
                ->references('id')->on('jadwal')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('id_user')
                ->references('id')->on('users')
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
        Schema::dropIfExists('panen');
    }
};
