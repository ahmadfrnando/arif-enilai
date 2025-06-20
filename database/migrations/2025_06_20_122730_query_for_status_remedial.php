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
        // Update nilai status 'Tidak Lulus' menjadi 'Remedial'
        DB::statement("
        UPDATE report_akademik_siswa
        SET status = 'Remedial'
        WHERE status = 'Tidak Lulus';
    ");


        // Update tabel siswa_lulus_semester
        DB::statement("
        UPDATE siswa_lulus_semester
        SET nama_status = 'Remedial'
        WHERE nama_status = 'Tidak Lulus';
    ");
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
