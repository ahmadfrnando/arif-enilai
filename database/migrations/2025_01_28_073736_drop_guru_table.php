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
        Schema::dropIfExists('guru');

        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nama_guru');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('agama', ['Islam', 'Protestan', 'Katolik', 'Hindu', 'Budha', 'Konghucu']);
            $table->string('id_mapel')->nullable();
            $table->date('tanggal_mulai_tugas')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('jenis_sekolah')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('tahun_sttb')->nullable();
            $table->string('penataran_yang_pernah_diikutin')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('pas_foto')->nullable();
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
        Schema::dropIfExists('guru');
    }
};
