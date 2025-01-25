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
        CREATE TRIGGER trig_update_jumlah_siswa_after_delete
        AFTER DELETE ON siswa
        FOR EACH ROW
        BEGIN
            DECLARE total_siswa INT;

            -- Hitung jumlah siswa di kelas terkait
            SELECT COUNT(*) INTO total_siswa
            FROM siswa
            WHERE id_kelas_sekarang = OLD.id_kelas_sekarang;

            -- Update tabel ref_kelas dengan jumlah siswa terbaru
            UPDATE ref_kelas
            SET jumlah_siswa = total_siswa
            WHERE id = OLD.id_kelas_sekarang;
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
        DB::statement("DROP TRIGGER trig_update_jumlah_siswa_after_delete");
    }
};
