<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Provider extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'specialty',
        'addressLine1',
        'addressLine2',
        'city',
        'state',
        'zip',
        'email',
        'phone',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'zip' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Many-to-many relationship with practitioners.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function practitioners(): BelongsToMany
    {
        // Pivot table and related model name may need adjustment
        return $this->belongsToMany(
            Practitioner::class,
            'practitioner_provider',
            'provider_id',
            'practitioner_id'
        );
    }

    /**
     * One-to-many relationship for patient referrals sent.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function patientReferralsSent(): HasMany
    {
        return $this->hasMany(
            PatientReferral::class,
            'sending_provider_id'
        );
    }

    /**
     * One-to-many relationship for patient referrals received.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function patientReferralsReceived(): HasMany
    {
        return $this->hasMany(
            PatientReferral::class,
            'receiving_provider_id'
        );
    }

    /**
     * One-to-many relationship with appointments.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(
            Appointment::class,
            'provider_id'
        );
    }
}


