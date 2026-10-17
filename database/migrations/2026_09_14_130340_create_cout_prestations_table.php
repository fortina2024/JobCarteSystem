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
        Schema::create('cout_prestations', function (Blueprint $table) {
            $table->id();
            $table->string('distance_parcourue_km')->nullable();
            $table->integer('materiel')->nullable();
            $table->integer('main_oeuvre')->nullable();
            $table->string('tps_attente')->nullable();
            $table->string('deplacement')->nullable();
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
        Schema::dropIfExists('cout_prestations');
    }
};
