<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Signer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'organization',
        'phone',
        'email',
        'photo',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Event yang telah memilih / menambah signer ini.
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(
            Event::class,
            'event_signers'
        )->withTimestamps();
    }

    /**
     * Sesi tandatangan signer ini.
     */
    public function signingSessions(): HasMany
    {
        return $this->hasMany(SigningSession::class);
    }
}