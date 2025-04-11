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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('nationalite');
            $table->enum('sexe', ['Masculin', 'Féminin', 'Autre']);
            $table->string('adresse')->nullable();
            $table->string('ville')->nullable();
            $table->decimal('poids', 5, 2)->nullable(); // Poids avec 2 décimales
            $table->decimal('taille', 5, 2)->nullable(); // Taille avec 2 décimales
            $table->string('profession')->nullable();
            $table->string('telephone')->unique();
            $table->string('groupe_sanguin')->nullable();
            $table->foreignId('workflow_id')
                ->constrained('workflow')
                ->onDelete('cascade'); // Clé étrangère vers workflow
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
