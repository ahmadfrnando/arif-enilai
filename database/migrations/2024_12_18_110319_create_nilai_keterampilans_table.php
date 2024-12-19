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
        Schema::create('nilai_keterampilan', function (Blueprint $table) {
            $table->id();
            $table->integer('id_siswa');
            $table->integer('id_guru');
            $table->integer('id_mapel');
            $table->integer('id_kelas');
            $table->integer('nilai_keterampilan');
            $table->string('predikat');
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
        Schema::dropIfExists('nilai_keterampilans');
    }
};
