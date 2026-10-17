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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();           
            $table->bigInteger('AssetId')->unique();
            $table->string('CreatedDate');
            $table->bigInteger('AssetTypeId');
            $table->bigInteger('SiteId');
            $table->bigInteger('FmVehicleId');
            $table->string('Country')->nullable();
            $table->string('CreatedBy')->nullable();
            $table->string('Year')->nullable();
            $table->string('Model')->nullable();
            $table->string('Make')->nullable();
            $table->string('FleetNumber')->nullable();
            $table->string('RegistrationNumber')->nullable();
            $table->string('Description')->nullable();
            $table->string('AdditionalMobileDevice')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
