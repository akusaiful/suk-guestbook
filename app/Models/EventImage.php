<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventImage extends Model
{
    protected $fillable = [
        'event_id',
        'image_path',
        'caption',
    ];

    /**
     * Event yang mempunyai gambar ini.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}