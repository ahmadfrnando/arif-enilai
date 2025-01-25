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
        DB::statement("
            CREATE TRIGGER update_jumlah_siswa_after_insert
            AFTER INSERT ON siswa
            FOR EACH ROW
            BEGIN
                DECLARE total_siswa INT;

                -- Hitung jumlah siswa untuk kelas yang baru dimasukkan
                SELECT COUNT(*) INTO total_siswa
                FROM siswa
                WHERE id_kelas_sekarang = NEW.id_kelas_sekarang;

                -- Update jumlah siswa di tabel ref_kelas
                UPDATE ref_kelas
                SET jumlah_siswa = total_siswa
                WHERE id = NEW.id_kelas_sekarang;
            END    
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('update_jumlah_siswa_after_insert');
    }
};
