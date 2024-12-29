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
        Schema::dropIfExists('report_nilai_siswa');
        Schema::create('report_akademik_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran', 20);
            $table->integer('id_siswa');
            $table->string('nama_siswa', 100);
            $table->integer('id_kelas');
            $table->string('nama_kelas', 50);
            $table->integer('id_guru');
            $table->string('nama_guru', 100);
            $table->string('nama_semester', 20);
            $table->enum('status', ['Lulus', 'Tidak Lulus']);
            $table->json('nilai');
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
        Schema::dropIfExists('report_akademik_siswa');
    }
};
