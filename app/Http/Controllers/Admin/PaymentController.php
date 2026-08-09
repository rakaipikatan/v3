<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentRejectRequest;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function approve(Request $request, Payment $payment): RedirectResponse
    {
        $payment->update([
            'status' => 'paid',
            'reviewed_by' => $request->user()->id,
            'reviewed_at' => now(),
            'rejection_reason' => null,
        ]);

        return back()->with('status', 'payment-approved');
    }

    public function reject(PaymentRejectRequest $request, Payment $payment): RedirectResponse
    {
        $payment->update([
            'status' => 'rejected',
            'reviewed_by' => $request->user()->id,
            'reviewed_at' => now(),
            'rejection_reason' => $request->validated('rejection_reason'),
        ]);

        return back()->with('status', 'payment-rejected');
    }
}
