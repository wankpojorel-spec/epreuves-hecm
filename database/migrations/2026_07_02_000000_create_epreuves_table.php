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
        Schema::create('epreuves', function (Blueprint $table) {
            $table->id();
            $table->string('titre');
            $table->string('filiere');
            $table->string('niveau'); // L1, L2, L3...
            $table->string('matiere');
            $table->string('annee_academique'); // ex: 2023-2024
            $table->enum('type', ['epreuve', 'corrige']);
            $table->string('chemin_fichier'); // chemin vers le PDF stocké
            $table->string('nom_original'); // nom original du fichier uploadé
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('epreuves');
    }
};
