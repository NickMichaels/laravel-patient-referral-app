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
        Schema::create('practitioners', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('specialty')->nullable();
            $table->string('job_title');
            $table->string('license_number');
            $table->string('email');
            $table->string('phone', length: 50);
        });

        Schema::create('practitioner_provider', function (Blueprint $table) {
            // Define the foreign key columns
            $table->foreignId('provider_id')->constrained()->onDelete('cascade');
            $table->foreignId('practitioner_id')->constrained()->onDelete('cascade');

            // Add a unique constraint to ensure no duplicate relationships
            $table->primary(['provider_id', 'practitioner_id']);
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practitioners');
    }
};
