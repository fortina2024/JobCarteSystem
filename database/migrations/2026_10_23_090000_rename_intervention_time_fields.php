<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('interventions', function (Blueprint $table): void {
            $table->renameColumn('temps_debut_gprs_gsm_verifie', 'temps_debut_intervention');
            $table->renameColumn('temps_fin_gprs_gsm_verifie', 'temps_fin_intervention');
        });
    }

    public function down(): void
    {
        Schema::table('interventions', function (Blueprint $table): void {
            $table->renameColumn('temps_debut_intervention', 'temps_debut_gprs_gsm_verifie');
            $table->renameColumn('temps_fin_intervention', 'temps_fin_gprs_gsm_verifie');
        });
    }
};
