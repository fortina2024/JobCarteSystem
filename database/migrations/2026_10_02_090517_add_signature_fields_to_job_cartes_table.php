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
        Schema::table('job_cartes', function (Blueprint $table) {
            $table->string('signature_token', 64)->nullable()->unique();
            $table->timestamp('signature_token_expires_at')->nullable();

            $table->string('signature_path')->nullable();

            $table->string('signed_by_name')->nullable();
            $table->string('signed_by_email')->nullable();
            $table->timestamp('signed_at')->nullable();

            $table->enum('signature_status', [
                'pending',
                'signed',
            ])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_cartes', function (Blueprint $table) {
            //
        });
    }
};
