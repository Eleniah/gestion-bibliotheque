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
    Schema::table('livres', function (Blueprint $table) {
        // on garde l'ancienne colonne "auteur" (string) pour ne rien casser,
        // mais on ajoute la vraie FK. Quand tu seras prête, on pourra supprimer la colonne string.
        $table->foreignId('auteur_id')->nullable()->constrained('auteurs')->nullOnDelete();
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
