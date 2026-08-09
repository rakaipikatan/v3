<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['payment_id', 'disk', 'file_path', 'original_filename', 'mime_type', 'size_bytes'])]
class PaymentProof extends Model
{
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Payment::class);
    }
}
