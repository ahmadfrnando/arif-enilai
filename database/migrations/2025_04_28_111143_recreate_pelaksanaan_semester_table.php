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
        Schema::dropIfExists('pelaksanaan_semester');

        Schema::create('pelaksanaan_semester', function (Blueprint $table) {
            $table->id();
            $table->enum('semester', ['1', '2']);
            $table->string('tahun_ajaran')->nullable();
            $table->boolean('status_aktif')->default(0);
            $table->timestamps();
        });

        DB::table('pelaksanaan_semester')->insert([
            'id' => 1,
            'semester' => '1',
            'tahun_ajaran' => '2025/2026',
            'status_aktif' => '0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pelaksanaan_semester');
    }
};
