<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'athlete_id', 'event_id', 'category_id', 'jersey_size_id',
    'emergency_contact_name', 'emergency_contact_phone',
    'data_declaration_agreed_at', 'rules_agreement_agreed_at',
])]
class Registration extends Model
{
    protected function casts(): array
    {
        return [
            'data_declaration_agreed_at' => 'datetime',
            'rules_agreement_agreed_at' => 'datetime',
        ];
    }

    public function athlete(): BelongsTo
    {
        return $this->belongsTo(Athlete::class);
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function jerseySize(): BelongsTo
    {
        return $this->belongsTo(JerseySize::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(RegistrationItem::class);
    }

    public function invoice(): HasOne
    {
        return $this->hasOne(Invoice::class);
    }

    public function documents(): HasMany
    {
        return $this->hasMany(Document::class);
    }
}
