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
        Schema::table('siswa_lulus_semester', function (Blueprint $table) {
            $table->dropColumn('nama_status');
        });
        Schema::table('siswa_lulus_semester', function (Blueprint $table) {
            $table->enum('nama_status', ['Lulus', 'Remedial'])->default('Lulus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
