<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RaceNumberRequest;
use App\Models\RegistrationItem;
use Illuminate\Http\RedirectResponse;

class RaceNumberController extends Controller
{
    public function store(RaceNumberRequest $request, RegistrationItem $registrationItem): RedirectResponse
    {
        $registrationItem->raceNumber()->updateOrCreate([], [
            'bib_number' => $request->validated('bib_number'),
            'assigned_at' => now(),
        ]);

        return back()->with('status', 'race-number-assigned');
    }
}
