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
        Schema::create('workflow', function (Blueprint $table) {
            $table->id();
            $table->string('nom'); // Nom du workflow
            $table->text('description')->nullable(); // Description du workflow (peut être null)
            $table->foreignId('personnel_medical_id')
                ->constrained('personnel_medical')
                ->onDelete('cascade'); // Clé étrangère vers personnel_medical
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workflow');
    }
};
