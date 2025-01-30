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
        DB::statement("DROP TRIGGER IF EXISTS update_guru_from_users");
        DB::statement("
        CREATE TRIGGER update_guru_from_users
        AFTER UPDATE ON users
        FOR EACH ROW
        BEGIN
            IF NEW.id IS NOT NULL THEN
                -- Check if id_siswa has changed
                IF NEW.id_siswa != OLD.id_siswa THEN
                    IF NEW.id_siswa IS NOT NULL THEN
                        UPDATE siswa
                        SET nama_siswa = NEW.name
                        WHERE id = NEW.id_siswa;
                    END IF;
                -- Check if id_guru has changed
                ELSEIF NEW.id_guru != OLD.id_guru THEN
                    IF NEW.id_guru IS NOT NULL THEN
                        UPDATE guru
                        SET nama_guru = NEW.name
                        WHERE id = NEW.id_guru;
                    END IF;
                END IF;
            END IF;
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
        DB::statement("DROP TRIGGER IF EXISTS update_guru_from_users");
    }
};
