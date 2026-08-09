<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'club_id', 'full_name', 'nickname', 'gender', 'place_of_birth',
    'date_of_birth', 'identity_number', 'blood_type',
])]
class Athlete extends Model
{
    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
        ];
    }

    public function club(): BelongsTo
    {
        return $this->belongsTo(Club::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }
}
