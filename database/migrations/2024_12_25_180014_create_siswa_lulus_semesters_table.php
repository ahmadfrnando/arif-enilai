<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa_lulus_semester', function (Blueprint $table) {
            $table->id();
            $table->integer('id_siswa');
            $table->integer('semester');
            $table->integer('id_kelas');
            $table->integer('id_guru');
            $table->enum('id_status', [1,2]);
            $table->enum('nama_status', ['Lulus', 'Tidak Lulus']);
            $table->text('alasan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswa_lulus_semester');
    }
};
