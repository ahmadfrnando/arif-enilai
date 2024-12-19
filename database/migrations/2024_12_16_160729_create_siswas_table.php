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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id();
            $table->string('nama_siswa');
            $table->string('nisn');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']);
            $table->string('anak_ke');
            $table->enum('status_dalam_keluarga', ['Anak Kandung', 'Anak Tiri', 'Anak Angkat']);
            $table->string('alamat_siswa');
            $table->string('telepon_siswa');
            $table->integer('id_kelas_pertama');
            $table->date('tanggal_pertama_diterima');
            $table->string('semester_pertama_diterima');
            $table->string('asal_sekolah');
            $table->string('tahun_ijazah');
            $table->string('nomor_ijazah');
            $table->string('tahun_shun')->nullable();
            $table->string('nomor_shun')->nullable();
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->string('pekerjaan_ayah');
            $table->string('pekerjaan_ibu');
            $table->string('alamat_ortu');
            $table->string('telepon_ortu');
            $table->string('nama_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('alamat_wali')->nullable();
            $table->string('telepon_wali')->nullable();
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
        Schema::dropIfExists('siswas');
    }
};
