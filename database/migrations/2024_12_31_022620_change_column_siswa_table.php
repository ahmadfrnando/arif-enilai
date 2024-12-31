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
        Schema::table('siswa', function (Blueprint $table) {
            $table->integer('semester_sekarang')->nullable()->default(1)->change();
            $table->integer('id_kelas_sekarang')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('siswa', function (Blueprint $table) {
            $table->enum('semester_sekarang', [1, 2])->nullable()->change();
            $table->integer('id_kelas_sekarang')->nullable()->change();
        });
    }

};
