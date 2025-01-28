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
            CREATE TRIGGER insert_user_from_guru
            AFTER INSERT ON guru
            FOR EACH ROW
            BEGIN
            IF NEW.id IS NOT NULL AND NEW.id_mapel IS NOT NULL THEN

            INSERT INTO users (
                name,
                role,
                username,
                password,
                id_guru,
                created_at,
                updated_at
            )
            VALUES (
                NEW.nama_guru,
                'guru',
                NEW.id,
                '$2y$10$/ul9c8SpcxMCI7ieBxKqTOuXqU1y6pYwSBP123rmkRyRUsfE.Aj1W',
                NEW.id,
                NOW(),
                NOW()
            );
            END IF;
            END;    
        ");

        DB::statement("
            CREATE TRIGGER delete_user_from_guru
            AFTER DELETE ON guru
            FOR EACH ROW
            BEGIN

                DELETE FROM users
                WHERE id_guru = OLD.id;
            END;    
        ");

        DB::statement("
            CREATE TRIGGER update_guru_from_users
            AFTER UPDATE ON users
            FOR EACH ROW
            BEGIN
                IF NEW.id IS NOT NULL THEN

                    UPDATE guru
                    SET 
                        nam_guru = NEW.name
                    WHERE id = OLD.id_guru;
                END IF;
            END; 
        ");

        DB::statement("
            CREATE TRIGGER update_user_from_guru
            AFTER UPDATE ON guru
            FOR EACH ROW
            BEGIN
                IF NEW.id IS NOT NULL AND NEW.id_mapel IS NOT NULL THEN

                    UPDATE users
                    SET 
                        name = NEW.nama_guru
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
        Schema::dropIfExists('insert_user_from_guru');
        Schema::dropIfExists('delete_user_from_guru');
        Schema::dropIfExists('update_guru_from_users');
        Schema::dropIfExists('update_user_from_guru');
    }
};
