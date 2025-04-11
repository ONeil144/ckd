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
        Schema::table('dossier_medicals', function (Blueprint $table) {
            $table->string('antecedents_medicaux')->after('raisonsConsultations');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dossier_medicals', function (Blueprint $table) {
            //
        });
    }
};
