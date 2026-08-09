<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['registration_id', 'race_event_id'])]
class RegistrationItem extends Model
{
    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }

    public function raceEvent(): BelongsTo
    {
        return $this->belongsTo(RaceEvent::class);
    }

    public function raceNumber(): HasOne
    {
        return $this->hasOne(RaceNumber::class);
    }
}
