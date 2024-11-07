<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('departements', function (Blueprint $table) {
            $table->id();
            $table->string('nom');

            // Ajouter la colonne chef_id (clé étrangère vers la table users)
            $table->unsignedBigInteger('chef_id')->nullable();  // La colonne chef_id qui peut être nulle

            // Définir la clé étrangère qui référence l'id de la table users
            $table->foreign('chef_id')->references('id')->on('users')->onDelete('set null'); // Si le chef est supprimé, la valeur sera mise à null

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departements');
    }
};
