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
        Schema::dropIfExists('nilai_pengetahuan');
        Schema::dropIfExists('nilai_keterampilan');
        
        Schema::create('nilai_siswa', function (Blueprint $table) {
            $table->id();
            $table->integer('id_siswa');
            $table->integer('id_guru');
            $table->integer('id_mapel');
            $table->integer('id_kelas');
            $table->integer('semester_id'); // 1 = ganjil, 2 = genap
            $table->string('tahun_ajaran')->nullable();
            $table->integer('nilai_pengetahuan')->nullable();
            $table->string('predikat_pengetahuan')->nullable();
            $table->integer('nilai_keterampilan')->nullable();
            $table->string('predikat_keterampilan')->nullable();
            $table->integer('status_lulus_mapel')->nullable(); // 1 = belum verifikasi, 2 = lulus, 3 = tidak lulus
            $table->string('alasan_tidak_lulus')->nullable();
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
        Schema::dropIfExists('nilai_siswa');
    }
};
