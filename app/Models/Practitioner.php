<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Practitioner extends Model
{

    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'jobTitle',
        'specialty',
        'licenseNumber',
        'email',
        'phone',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Many-to-many relationship with providers.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function providers(): BelongsToMany
    {
        // Pivot table and related model name may need adjustment
        return $this->belongsToMany(
            Provider::class,
            'practitioner_provider',
            'practitioner_id',
            'provider_id'
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
            'sending_practitioner_id'
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
            'receiving_practitioner_id'
        );
    }

}
