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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patients_id')->constrained('patients')->onDelete('cascade'); // Clé étrangère vers la table patients
            $table->foreignId('personnel_medical_id')->constrained('personnel_medical')->onDelete('cascade'); // Clé étrangère vers la table users
            $table->foreignId('workflow_id')->constrained('workflow')->onDelete('cascade'); // Clé étrangère vers la table workflow
            $table->text('message'); // Message de la notification
            $table->boolean('vu')->default(false); // Indique si la notification a été vue ou non
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
