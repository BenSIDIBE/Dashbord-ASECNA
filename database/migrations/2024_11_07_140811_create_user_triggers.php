<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUserTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Trigger pour l'insertion
        DB::unprepared('
            CREATE TRIGGER user_after_insert
            AFTER INSERT ON users
            FOR EACH ROW
            BEGIN
                INSERT INTO historique_personnels (user_id, changement, date_changement, type_changement, created_at, updated_at)
                VALUES (NEW.id, CONCAT("Ajout de l\'utilisateur ", NEW.name), CURRENT_TIMESTAMP, "Ajout", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
            END;
        ');

        // Trigger pour la mise à jour
        DB::unprepared('
            CREATE TRIGGER user_before_update
            BEFORE UPDATE ON users
            FOR EACH ROW
            BEGIN
                INSERT INTO historique_personnels (user_id, changement, date_changement, type_changement, created_at, updated_at)
                VALUES (NEW.id, CONCAT("Modification de l\'utilisateur ", OLD.name, " vers ", NEW.name), CURRENT_TIMESTAMP, "Modification", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
            END;
        ');

        // Trigger pour la suppression
        DB::unprepared('
            CREATE TRIGGER user_before_delete
            BEFORE DELETE ON users
            FOR EACH ROW
            BEGIN
                INSERT INTO historique_personnels (user_id, changement, date_changement, type_changement, created_at, updated_at)
                VALUES (OLD.id, CONCAT("Suppression de l\'utilisateur ", OLD.name), CURRENT_TIMESTAMP, "Suppression", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP);
            END;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Supprimer les triggers si la migration est annulée
        DB::unprepared('DROP TRIGGER IF EXISTS user_after_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS user_before_update');
        DB::unprepared('DROP TRIGGER IF EXISTS user_before_delete');
    }
}
