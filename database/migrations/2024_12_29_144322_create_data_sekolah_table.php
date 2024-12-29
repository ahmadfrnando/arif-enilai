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
        Schema::create('data_sekolah', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sekolah');
            $table->string('nama_kepsek');
            $table->string('nama_operator');
            $table->string('akreditasi');
            $table->string('kurikulum');
            $table->datetime('waktu')->nullable();

            // identitas sekolah
            $table->string('npsn');
            $table->string('status');
            $table->string('bentuk_pendidikan');
            $table->string('status_kepemilikan');
            $table->string('sk_pendirian_sekolah');
            $table->string('sk_izin_operasional');
            $table->date('tanggal_sk_izin_operasional');

            // data pelengkap
            $table->string('kebutuhan_khusus')->nullable();
            $table->string('nama_bank');
            $table->string('cabang_bank');
            $table->string('nama_rekening');

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
        Schema::dropIfExists('data_sekolah');
    }
};
