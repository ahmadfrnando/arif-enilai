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
            DROP TRIGGER IF EXISTS update_user_from_guru;
        ");

        DB::statement("
            CREATE TRIGGER update_user_from_guru
            AFTER UPDATE ON guru
            FOR EACH ROW
            BEGIN
                IF NEW.id IS NOT NULL AND NEW.id_mapel IS NOT NULL THEN

                    UPDATE users
                    SET 
                        name = NEW.nama_guru,
                        username = NEW.username
                    WHERE id_guru = OLD.id;
                END IF;
            END;   
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('update_user_from_guru');
    }
};
