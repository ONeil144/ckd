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
        Schema::create('traitements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patients_id')->constrained('patients')->onDelete('cascade');; // <-- Spécifiez 'patient' explicitement
            $table->foreignId('personnel_medical_id')->constrained('personnel_medical')->onDelete('cascade');
            $table->foreignId('dossier_medicals_id')->constrained('dossier_medicals')->onDelete('cascade'); ;
            $table->date('datedebut');
            $table->date('datefin');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traitements');
    }
};
