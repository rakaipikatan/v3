<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['registration_item_id', 'bib_number', 'assigned_at'])]
class RaceNumber extends Model
{
    protected function casts(): array
    {
        return [
            'assigned_at' => 'datetime',
        ];
    }

    public function registrationItem(): BelongsTo
    {
        return $this->belongsTo(RegistrationItem::class);
    }
}
