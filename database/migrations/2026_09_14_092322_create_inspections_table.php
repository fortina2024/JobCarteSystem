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
            $table->string('peinture_etat_ext')->nullable();
            $table->string('panneaux_inter')->nullable();
            $table->string('demarrage_vehicule')->nullable();
            $table->string('instruments')->nullable();
            $table->string('radio')->nullable();
            $table->string('affichage_code_defaut_tab')->nullable();
            $table->string('eclairage_ext')->nullable();
            $table->string('feux')->nullable();
            $table->string('detresse')->nullable();
            $table->boolean('peinture_etat_ext_avant')->default(false);
            $table->boolean('peinture_etat_ext_apres')->default(false);

            $table->boolean('panneaux_inter_avant')->default(false);
            $table->boolean('panneaux_inter_apres')->default(false);

            $table->boolean('demarrage_vehicule_avant')->default(false);
            $table->boolean('demarrage_vehicule_apres')->default(false);

            $table->boolean('instruments_avant')->default(false);
            $table->boolean('instruments_apres')->default(false);

            $table->boolean('radio_avant')->default(false);
            $table->boolean('radio_apres')->default(false);

            $table->boolean('affichage_code_defaut_tab_avant')->default(false);
            $table->boolean('affichage_code_defaut_tab_apres')->default(false);

            $table->boolean('eclairage_ext_avant')->default(false);
            $table->boolean('eclairage_ext_apres')->default(false);

            $table->boolean('feux_avant')->default(false);
            $table->boolean('feux_apres')->default(false);

            $table->boolean('detresse_avant')->default(false);
            $table->boolean('detresse_apres')->default(false);
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
