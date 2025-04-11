<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('patients', function (Blueprint $table) {
        // Ajout de la colonne personnel_id
        $table->unsignedBigInteger('personnel_medical_id')->nullable()->after('id'); // après l'id du patient
        $table->foreign('personnel_medical_id')->references('id')->on('personnel_medical')->onDelete('set null'); // Créer la clé étrangère vers la table personnel_medicals
    });
}

public function down()
{
    Schema::table('patients', function (Blueprint $table) {
        $table->dropForeign(['personnel_medical_id']); // Supprimer la contrainte de clé étrangère
        $table->dropColumn('personnel_medical_id'); // Supprimer la colonne
    });
}

};
