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
            CREATE TRIGGER trig_update_jumlah_siswa_after_update
            AFTER UPDATE ON siswa
            FOR EACH ROW
            BEGIN
                DECLARE total_siswa_old INT;
                DECLARE total_siswa_new INT;

                -- Hitung jumlah siswa di kelas lama
                SELECT COUNT(*) INTO total_siswa_old
                FROM siswa
                WHERE id_kelas_sekarang = OLD.id_kelas_sekarang;

                -- Update tabel ref_kelas untuk kelas lama
                UPDATE ref_kelas
                SET jumlah_kelas = total_siswa_old
                WHERE id = OLD.id_kelas_sekarang;

                -- Hitung jumlah siswa di kelas baru
                SELECT COUNT(*) INTO total_siswa_new
                FROM siswa
                WHERE id_kelas_sekarang = NEW.id_kelas_sekarang;

                -- Update tabel ref_kelas untuk kelas baru
                UPDATE ref_kelas
                SET jumlah_siswa = total_siswa_new
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
        DB::statement("DROP TRIGGER trig_update_jumlah_siswa_after_update");
    }
};
