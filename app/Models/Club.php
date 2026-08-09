<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['manager_id', 'club_name', 'club_pic', 'city', 'province'])]
class Club extends Model
{
    public function manager(): BelongsTo
    {
        return $this->belongsTo(Manager::class);
    }

    public function athletes(): HasMany
    {
        return $this->hasMany(Athlete::class);
    }
}
