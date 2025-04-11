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
          // Supprimer la table users existante
          Schema::dropIfExists('users');

          // Créer la nouvelle table
          Schema::create('users', function (Blueprint $table) {
              $table->id();
              $table->string('code_personnel')->unique();
              $table->string('name');
              $table->string('prenom');
              $table->string('email')->unique();
              $table->timestamp('email_verified_at')->nullable();
              $table->string('password');
              $table->string('avatar')->nullable(); // Photo de profil
              $table->enum('role', ['administrateur', 'personnel_medical']);
              $table->rememberToken();
              $table->timestamps();
          });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
