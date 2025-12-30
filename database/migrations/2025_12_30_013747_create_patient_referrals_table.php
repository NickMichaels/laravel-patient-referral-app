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
        Schema::create('patient_referrals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Foreign key to patients table with cascade delete
            $table->foreignId('patient_id')
                ->constrained('patients')
                ->onDelete('cascade');

            // Foreign key to providers table (sending) with cascade delete
            $table->foreignId('sending_provider_id')
                ->constrained('providers')
                ->onDelete('cascade');

            // Foreign key to providers table (receiving) with cascade delete
            $table->foreignId('receiving_provider_id')
                ->constrained('providers')
                ->onDelete('cascade');

            // Foreign key to practitioners table (sending) with cascade delete, nullable
            $table->foreignId('sending_practitioner_id')
                ->nullable()
                ->constrained('practitioners')
                ->onDelete('cascade');

            // Foreign key to practitioners table (receiving) with cascade delete, nullable
            $table->foreignId('receiving_practitioner_id')
                ->nullable()
                ->constrained('practitioners')
                ->onDelete('cascade');

            // Status enum: ACCEPTED, PENDING, SCHEDULED
            $table->string('status');

            // Date when the referral was sent
            $table->dateTime('date_sent');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_referrals');
    }
};
