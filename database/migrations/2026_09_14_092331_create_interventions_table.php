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
        Schema::create('interventions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_carte_id')
                ->unique()
                ->constrained('job_cartes')
                ->cascadeOnDelete();
            $table->boolean('nouv_installation')->default(false);
            $table->boolean('reinstallation')->default(false);
            $table->boolean('maintenance')->default(false);
            $table->boolean('panne')->default(false);
            $table->boolean('desinstallation')->default(false);
            $table->string('version_dors_chargee')->nullable();
            $table->boolean('gprs_gsm_verifie')->default(false);
            $table->boolean('arret_vehicule_verifie')->default(false);
            $table->boolean('fm_terminal_verifie')->default(false);
            $table->boolean('voice_kif_verifie')->default(false);
            $table->boolean('rf_reader_verifie')->default(false);
            $table->boolean('proximite_verifie')->default(false);
            $table->string('temps_debut_gprs_gsm_verifie')->nullable();
            $table->string('temps_fin_gprs_gsm_verifie')->nullable();
            $table->string('duree_test_arret_vehicule_verifie')->nullable();
            $table->string('distance_arret_vehicule_verifie')->nullable();
            $table->string('vitesse_max_fm_terminal_verifie')->nullable();
            $table->string('rpm_max_fm_terminal_verifie')->nullable();
            $table->string('odo_hrs_moteur_fixe')->nullable();
            $table->string('plage_bande_verte_de')->nullable();
            $table->string('plage_bande_verte_a')->nullable();
            $table->string('sur_regime')->nullable();
            $table->boolean('calibration_vitesse')->default(false);
            $table->boolean('par_distance_fixe')->default(false);
            $table->boolean('par_tableau')->default(false);
            $table->boolean('vitesse_gps')->default(false);
            $table->boolean('can')->default(false);
            $table->text('observation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interventions');
    }
};
