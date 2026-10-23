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
        Schema::create('inspections', function (Blueprint $table) {
            $table->id();

            $table->boolean('peinture_etat_ext_avant')->nullable();
            $table->boolean('peinture_etat_ext_apres')->nullable();
            $table->boolean('panneaux_inter_avant')->nullable();
            $table->boolean('panneaux_inter_apres')->nullable();
            $table->boolean('demarrage_vehicule_avant')->nullable();
            $table->boolean('demarrage_vehicule_apres')->nullable();
            $table->boolean('instruments_avant')->nullable();
            $table->boolean('instruments_apres')->nullable();
            $table->boolean('radio_avant')->nullable();
            $table->boolean('radio_apres')->nullable();
            $table->boolean('affichage_code_defaut_tab_avant')->nullable();
            $table->boolean('affichage_code_defaut_tab_apres')->nullable();
            $table->boolean('eclairage_ext_avant')->nullable();
            $table->boolean('eclairage_ext_apres')->nullable();
            $table->boolean('feux_avant')->nullable();
            $table->boolean('feux_apres')->nullable();
            $table->boolean('detresse_avant')->nullable();
            $table->boolean('detresse_apres')->nullable();
            $table->string('autre_commentaire')->nullable();
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
        Schema::dropIfExists('inspections');
    }
};
