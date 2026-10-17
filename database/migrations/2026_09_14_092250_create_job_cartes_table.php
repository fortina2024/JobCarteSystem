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
        Schema::create('job_cartes', function (Blueprint $table) {
            $table->id();
            $table->string('num_job_carte')->unique();
            $table->date('date');
            $table->foreignId('client_id')
                ->constrained('clients')
                ->restrictOnDelete();
            $table->foreignId('site_id')
                ->constrained('sites')
                ->restrictOnDelete();
            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();
            $table->foreignId('dealer_id')
                ->constrained('dealers')
                ->restrictOnDelete();
            $table->string('num_commande')->nullable();
            $table->longText('signature_technicien')->nullable();
            $table->index('client_id');
            $table->index('user_id');     
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_cartes');
    }
};
