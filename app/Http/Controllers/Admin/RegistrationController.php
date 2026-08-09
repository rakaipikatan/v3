<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    public function index(Request $request): View
    {
        $registrations = Registration::query()
            ->with(['athlete.club', 'event', 'invoice.payments'])
            ->when($request->filled('status'), function ($query) use ($request) {
                $query->whereHas('invoice.payments', fn ($q) => $q->where('status', $request->string('status')));
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.registrations.index', [
            'registrations' => $registrations,
            'statusFilter' => $request->string('status')->toString(),
        ]);
    }

    public function show(Registration $registration): View
    {
        $registration->load([
            'athlete.club.manager',
            'event', 'category', 'jerseySize',
            'items.raceEvent', 'items.raceNumber',
            'invoice.payments.proofs', 'invoice.payments.reviewer',
        ]);

        return view('admin.registrations.show', ['registration' => $registration]);
    }
}
