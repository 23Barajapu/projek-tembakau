<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class KelompokTani extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelompok_tani', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelompok');
            $table->string('jenis_kelompok');
            $table->integer('jumlah_anggota');
            $table->string('ketua_kelompok');
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('penyuluh');
            $table->string('nip_penyuluh');
            $table->unsignedBigInteger('id_user');
            $table->timestamps();


            $table->foreign('id_user')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }
    // Foreign key untuk 'keranjangs'

    // Foreign key constraint


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kelompok_tani');
    }


}