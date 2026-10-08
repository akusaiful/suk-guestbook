<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'event_date',
        'location',
        'description',
        'theme',
        'header_image',
        'is_active',
    ];

    protected $casts = [
        'event_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Penandatangan yang telah dipilih untuk event ini.
     */
    public function signers(): BelongsToMany
    {
        return $this->belongsToMany(
            Signer::class,
            'event_signers'
        )->withTimestamps();
    }

    /**
     * Sesi tandatangan untuk event ini.
     */
    public function signingSessions(): HasMany
    {
        return $this->hasMany(SigningSession::class);
    }

    /**
     * Pengunjung untuk event ini.
     */
    public function visitors(): HasMany
    {
        return $this->hasMany(Visitor::class);
    }

    /**
     * Komen pengunjung untuk event ini.
     */
    public function visitorComments(): HasMany
    {
        return $this->hasMany(VisitorComment::class);
    }

    /**
     * Semua gambar untuk event ini.
     */
    public function images(): HasMany
    {
        return $this->hasMany(EventImage::class);
    }
}