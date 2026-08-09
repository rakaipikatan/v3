<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentProof;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class PaymentProofController extends Controller
{
    public function show(PaymentProof $paymentProof): StreamedResponse
    {
        return Storage::disk($paymentProof->disk)->response(
            $paymentProof->file_path,
            $paymentProof->original_filename,
        );
    }
}
