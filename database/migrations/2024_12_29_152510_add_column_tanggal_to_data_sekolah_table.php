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
        Schema::table('data_sekolah', function (Blueprint $table) {
            $table->date('tanggal_sk_pendirian_sekolah')->nullable()->after('sk_pendirian_sekolah');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('data_sekolah', function (Blueprint $table) {
            $table->dropColumn('tanggal_sk_pendirian_sekolah');
        });
    }
};
