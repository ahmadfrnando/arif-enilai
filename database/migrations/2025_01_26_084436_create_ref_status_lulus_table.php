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
        Schema::create('ref_status_lulus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_status_lulus');
        });

        DB::table('ref_status_lulus')->insert([
            ['id' => 1, 'nama_status_lulus' => 'Belum Diverifikasi'],
            ['id' => 2, 'nama_status_lulus' => 'Lulus'],
            ['id' => 3, 'nama_status_lulus' => 'Tidak Lulus'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ref_status_lulus');
    }
};
