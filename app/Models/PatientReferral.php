<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PatientReferral extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'patient_id',
        'sending_provider_id',
        'receiving_provider_id',
        'sending_practitioner_id',
        'receiving_practitioner_id',
        'status',
        'date_sent',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_sent' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the patient that this referral belongs to.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }

    /**
     * Get the provider that sent this referral.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sendingProvider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'sending_provider_id');
    }

    /**
     * Get the provider that received this referral.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receivingProvider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'receiving_provider_id');
    }

    /**
     * Get the practitioner that sent this referral.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sendingPractitioner(): BelongsTo
    {
        return $this->belongsTo(Practitioner::class, 'sending_practitioner_id');
    }

    /**
     * Get the practitioner that received this referral.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function receivingPractitioner(): BelongsTo
    {
        return $this->belongsTo(Practitioner::class, 'receiving_practitioner_id');
    }
}
