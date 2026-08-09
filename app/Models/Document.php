<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['registration_id', 'type', 'disk', 'file_path', 'original_filename', 'mime_type', 'size_bytes'])]
class Document extends Model
{
    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
