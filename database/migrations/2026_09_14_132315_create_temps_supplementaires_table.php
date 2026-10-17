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
        Schema::create('temps_supplementaires', function (Blueprint $table) {
            $table->id();
            $table->datetime('debut_heure_suppl')->nullable();
            $table->datetime('fin_heure_suppl')->nullable();
            $table->datetime('temps_attente_pour')->nullable();
            $table->datetime('debut_attente')->nullable();
            $table->datetime('fin_attente')->nullable();
            $table->text('observation')->nullable();
            $table->string('ancien_num_serie_sim')->nullable();
            $table->string('nouveau_num_serie_sim')->nullable();
            $table->string('ancien_num_serie_boitier_fm')->nullable();
            $table->string('nouveau_num_serie_boitier_fm')->nullable();
            $table->string('ancien_num_serie_fm_terminal')->nullable();
            $table->string('nouveau_num_serie_fm_terminal')->nullable();
            $table->string('ancien_num_serie_boitier_voice_kit')->nullable();
            $table->string('nouveau_num_serie_boitier_voice_kit')->nullable();
            $table->string('ancien_num_serie_boitier_rf_tag_id')->nullable();
            $table->string('nouveau_num_serie_boitier_rf_tag_id')->nullable();
            $table->foreignId('job_carte_id')
                ->unique()
                ->constrained('job_cartes')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temps_supplementaires');
    }
};
