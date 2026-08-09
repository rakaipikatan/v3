<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentProofRequest;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function store(PaymentProofRequest $request, Registration $registration): RedirectResponse
    {
        abort_unless($registration->athlete->club->manager_id === $request->user()->manager->id, 403);

        $invoice = $registration->invoice;
        $file = $request->file('proof');

        DB::transaction(function () use ($invoice, $file) {
            $payment = $invoice->payments()->firstOrCreate([], [
                'amount' => $invoice->total_amount,
                'status' => 'pending_payment',
            ]);

            $path = $file->store('payment-proofs', 'local');

            $payment->proofs()->create([
                'disk' => 'local',
                'file_path' => $path,
                'original_filename' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'size_bytes' => $file->getSize(),
            ]);

            $payment->update([
                'status' => 'payment_submitted',
                'submitted_at' => now(),
            ]);
        });

        return redirect()->route('registrations.show', $registration)->with('status', 'proof-uploaded');
    }
}
