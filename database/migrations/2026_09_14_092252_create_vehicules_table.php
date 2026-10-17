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
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')
                ->constrained('clients')
                ->cascadeOnDelete();
            $table->foreignId('job_carte_id')
                ->unique()
                ->constrained('job_cartes')
                ->cascadeOnDelete();
            $table->string('identifiant_vehicule')->nullable();
            $table->string('imsi_sim')->nullable();
            $table->string('type_boitier')->nullable();
            $table->string('num_data')->nullable();
            $table->string('numero_flote')->nullable();
            $table->string('marque')->nullable();
            $table->string('num_immobilisation')->nullable();
            $table->string('nom_ref')->nullable();
            $table->string('num_ref')->nullable();
            $table->string('num_voix')->nullable();
            $table->string('num_serie')->nullable();
            $table->string('num_flotte')->nullable();
            $table->date('date_mise_en_disposition')->nullable();
            $table->time('heure_mise_en_disposition')->nullable();
            $table->string('nouv_num_appel')->nullable();
            $table->string('pin')->nullable();
            $table->string('num_chassis')->nullable();
            $table->string('immatriculation')->nullable();
            
            // Index utiles
            $table->index('imsi_sim');
            $table->index('num_serie');
            $table->index('num_flotte');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
