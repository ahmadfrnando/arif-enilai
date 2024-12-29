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
        Schema::create('report_nilai_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('tahun_ajaran', 20);
            $table->integer('id_siswa');
            $table->string('nama_siswa', 100);
            $table->integer('id_kelas');
            $table->string('nama_kelas', 50);
            $table->integer('id_guru');
            $table->string('nama_guru', 100);
            $table->integer('id_semester');
            $table->string('nama_semester', 20);

            // Nilai Pengetahuan
            $table->integer('nilai_pengetahuan_agama')->nullable();
            $table->integer('nilai_pengetahuan_pkn')->nullable();
            $table->integer('nilai_pengetahuan_bi')->nullable();
            $table->integer('nilai_pengetahuan_mm')->nullable();
            $table->integer('nilai_pengetahuan_sejarah_ind')->nullable();
            $table->integer('nilai_pengetahuan_bing')->nullable();
            $table->integer('nilai_pengetahuan_sbud')->nullable();
            $table->integer('nilai_pengetahuan_penjas')->nullable();
            $table->integer('nilai_pengetahuan_prakarya')->nullable();
            $table->integer('nilai_pengetahuan_mm_minat')->nullable();
            $table->integer('nilai_pengetahuan_fisika')->nullable();
            $table->integer('nilai_pengetahuan_kimia')->nullable();
            $table->integer('nilai_pengetahuan_biologi')->nullable();
            $table->integer('nilai_pengetahuan_sosiologi')->nullable();

            // Nilai Keterampilan
            $table->integer('nilai_keterampilan_agama')->nullable();
            $table->integer('nilai_keterampilan_pkn')->nullable();
            $table->integer('nilai_keterampilan_bi')->nullable();
            $table->integer('nilai_keterampilan_mm')->nullable();
            $table->integer('nilai_keterampilan_sejarah_ind')->nullable();
            $table->integer('nilai_keterampilan_bing')->nullable();
            $table->integer('nilai_keterampilan_sbud')->nullable();
            $table->integer('nilai_keterampilan_penjas')->nullable();
            $table->integer('nilai_keterampilan_prakarya')->nullable();
            $table->integer('nilai_keterampilan_mm_minat')->nullable();
            $table->integer('nilai_keterampilan_fisika')->nullable();
            $table->integer('nilai_keterampilan_kimia')->nullable();
            $table->integer('nilai_keterampilan_biologi')->nullable();
            $table->integer('nilai_keterampilan_sosiologi')->nullable();
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
        Schema::dropIfExists('report_nilai_siswa');
    }
};
