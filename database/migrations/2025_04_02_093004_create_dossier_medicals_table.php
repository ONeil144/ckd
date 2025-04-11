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
        Schema::create('dossier_medicals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patients_id')->constrained('patients'); // <-- Spécifiez 'patient' explicitement
            $table->foreignId('personnel_medical_id')->constrained('personnel_medical')->onDelete('cascade');  // <-- Spécifiez 'personnel médical' explicitement
            $table->date('consultationdate');
            $table->text('raisonsConsultations');
            $table->text('diagnostic');
            $table->text('observation');
            $table->text('allergies')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dossier_medicals');
    }
};
