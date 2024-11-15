<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lahan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengurus_lahan'); // Foreign key
            $table->string('nama_lahan');
            $table->integer('luas_lahan');
            $table->string('alamat_lahan');
            $table->enum('status', ['Milik Sendiri', 'Pinjam', 'Sewa']);
            $table->string('pbb');
            $table->string('sertifikat_lahan');
            $table->string('foto_lahan')->nullable();
            $table->unsignedBigInteger('id_user');


            $table->foreign('id_user')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            // Relasi ke tabel anggota_tanis
            $table->foreign('pengurus_lahan')->references('id')->on('anggota_tanis')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lahan');
    }
};