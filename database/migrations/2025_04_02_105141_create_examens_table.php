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
        Schema::create('examens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patients_id')->constrained('patients')->onDelete('cascade'); // Clé étrangère vers la table patients
            $table->foreignId('personnel_medical_id')->constrained('personnel_medical')->onDelete('cascade'); // Clé étrangère vers la table personnel médical
            $table->string('type_examen'); // Type d'examen
            $table->string('nom_laboratoire'); // Nom du laboratoire
            $table->string('plage_reference'); // Plage de référence
            $table->string('valeur_critique'); // Valeur critique
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examens');
    }
};
