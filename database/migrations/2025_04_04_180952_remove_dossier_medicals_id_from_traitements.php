<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('traitements', function (Blueprint $table) {
            $table->dropForeign(['dossier_medicals_id']);
            $table->dropColumn('dossier_medicals_id');
        });
    }

    public function down()
    {
        Schema::table('traitements', function (Blueprint $table) {
            $table->foreignId('dossier_medicals_id')->constrained('dossier_medicals')->onDelete('cascade');
        });
    }
};
