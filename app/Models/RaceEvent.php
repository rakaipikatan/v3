<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name', 'distance_meters'])]
class RaceEvent extends Model
{
    public function registrationItems(): HasMany
    {
        return $this->hasMany(RegistrationItem::class);
    }
}
