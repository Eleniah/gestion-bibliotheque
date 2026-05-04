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
    Schema::create('emprunts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('adherent_id')->constrained('adherents')->cascadeOnDelete();
        $table->foreignId('livre_id')->constrained('livres')->cascadeOnDelete();
        $table->date('date_emprunt')->default(now());
        $table->date('date_retour_prevue')->nullable();  // optionnel
        $table->date('date_retour_reelle')->nullable();  // null = pas encore rendu
        $table->timestamps();

        $table->unique(['adherent_id','livre_id','date_emprunt']); // évite doublons exacts
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emprunts');
    }
};
