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
    // 1) S'assurer que le type est bien BIGINT UNSIGNED
    Schema::table('livres', function (Blueprint $table) {
        $table->unsignedBigInteger('auteur_id')->change();
    });

    // 2) Ajouter la contrainte étrangère (si pas déjà présente)
    Schema::table('livres', function (Blueprint $table) {
        // Si tu n'as jamais eu de FK, on peut l'ajouter directement
        $table->foreign('auteur_id')
              ->references('id')->on('auteurs')
              ->cascadeOnDelete();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('livres', function (Blueprint $table) {
            //
        });
    }
};
