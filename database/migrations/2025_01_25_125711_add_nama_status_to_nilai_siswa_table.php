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
        Schema::table('nilai_siswa', function (Blueprint $table) {
            $table->string('nama_status_lulus_mapel')->nullable()->after('status_lulus_mapel');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nilai_siswa', function (Blueprint $table) {
            $table->dropColumn('nama_status_lulus_mapel');
        });
    }
};
