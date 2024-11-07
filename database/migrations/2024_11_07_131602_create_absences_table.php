<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAbsencesTable extends Migration
{
    public function up()
    {
        Schema::create('absences', function (Blueprint $table) {
            $table->id(); // Identifiant unique
            $table->unsignedBigInteger('user_id'); // Lien avec l'utilisateur
            $table->enum('type', ['congé', 'mission', 'retraite']); // Type d'absence
            $table->date('date_debut'); // Date de début de l'absence
            $table->date('date_fin')->nullable(); // Date de fin de l'absence (facultatif)
            $table->timestamps(); // Pour les dates de création et de mise à jour

            // Clé étrangère
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('absences');
    }
}
