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
        Schema::table('nilai_pengetahuan', function (Blueprint $table) {
            $table->integer('semester')->after('id_kelas');
        });
        
        Schema::table('nilai_keterampilan', function (Blueprint $table) {
            $table->integer('semester')->after('id_kelas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nilai_pengetahuan', function (Blueprint $table) {
            $table->dropColumn('semester');
        });
        Schema::table('nilai_keterampilan', function (Blueprint $table) {
            $table->dropColumn('semester');
        });
    }
};
