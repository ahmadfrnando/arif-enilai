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
        Schema::table('report_akademik_siswa', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        Schema::table('report_akademik_siswa', function (Blueprint $table) {
            $table->enum('status', ['Lulus', 'Remedial'])->default('Lulus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('report_akademik_siswa', function (Blueprint $table) {
            //
        });
    }
};
