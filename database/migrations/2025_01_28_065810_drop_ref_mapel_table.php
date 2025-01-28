<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::dropIfExists('ref_mapel');
        Schema::create('ref_mapel', function (Blueprint $table) {
            $table->id();
            $table->integer('kkm');
            $table->string('nama_mapel');
            $table->string('nama_mapel_lengkap');
        });
        DB::table('ref_mapel')->insert([
            ['id' => 1, 'kkm' => 82,'nama_mapel' => 'AGAMA', 'nama_mapel_lengkap' => 'Pendidikan Agama dan Budi Pekerti'],
            ['id' => 2, 'kkm' => 82,'nama_mapel' => 'PKN', 'nama_mapel_lengkap' => 'Pendidikan Pancasila dan Kewarganegaraan'],
            ['id' => 3, 'kkm' => 82,'nama_mapel' => 'B.INDO', 'nama_mapel_lengkap' => 'Bahasa Indonesia'],
            ['id' => 4, 'kkm' => 78,'nama_mapel' => 'MM WAJIB', 'nama_mapel_lengkap' => 'Matematika'],
            ['id' => 5, 'kkm' => 82,'nama_mapel' => 'SEJ. INDO', 'nama_mapel_lengkap' => 'Sejarah Indonesia'],
            ['id' => 6, 'kkm' => 82,'nama_mapel' => 'B.ING', 'nama_mapel_lengkap' => 'Bahasa Inggris'],
            ['id' => 7, 'kkm' => 82,'nama_mapel' => 'S.BUD', 'nama_mapel_lengkap' => 'Seni Budaya'],
            ['id' => 8, 'kkm' => 82,'nama_mapel' => 'PENJAS', 'nama_mapel_lengkap' => 'Pendidikan Jasmani, olahraga, dan kesehatan'],
            ['id' => 9, 'kkm' => 82,'nama_mapel' => 'PRAKRYA', 'nama_mapel_lengkap' => 'Prakarya dan Kewirausahaan'],
            ['id' => 10, 'kkm' => 78,'nama_mapel' => 'MM MINAT', 'nama_mapel_lengkap' => 'Matematika'],
            ['id' => 11, 'kkm' => 78,'nama_mapel' => 'FISIKA', 'nama_mapel_lengkap' => 'Fisika'],
            ['id' => 12, 'kkm' => 78,'nama_mapel' => 'KIMIA', 'nama_mapel_lengkap' => 'Kimia'],
            ['id' => 13, 'kkm' => 78,'nama_mapel' => 'BIOLOGI', 'nama_mapel_lengkap' => 'Biologi'],
            ['id' => 14, 'kkm' => 82,'nama_mapel' => 'SOSIOLOGI', 'nama_mapel_lengkap' => 'Sosiologi'],
            ['id' => 15, 'kkm' => 82,'nama_mapel' => 'B.JERMAN', 'nama_mapel_lengkap' => 'BAHASA JERMAN'],
            ['id' => 16, 'kkm' => 82,'nama_mapel' => 'PSPB', 'nama_mapel_lengkap' => 'Pendidikan Sejarah Perjuangan Bangsa'],
            ['id' => 17, 'kkm' => 82,'nama_mapel' => 'PKK', 'nama_mapel_lengkap' => 'Pemberdayaan Kesejahteraan Keluarga'],
            ['id' => 18, 'kkm' => 78,'nama_mapel' => 'PMP', 'nama_mapel_lengkap' => 'Project Management Professional'],
            ['id' => 19, 'kkm' => 78,'nama_mapel' => 'TIK', 'nama_mapel_lengkap' => 'Teknik Informatika Komputer'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_mapel');
    }
};
