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
    Schema::create('livres', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->string('auteur')->nullable();
        $table->string('genre')->nullable();
        $table->string('editeur')->nullable();
        $table->string('isbn')->nullable()->unique();
        $table->unsignedInteger('nb_exemplaires')->default(1);
        $table->string('code_barres')->unique(); // généré
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('livres');
    }
};
