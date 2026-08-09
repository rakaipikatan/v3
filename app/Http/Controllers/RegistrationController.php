<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\AuthorizesClubOwnership;
use App\Http\Requests\RegistrationRequest;
use App\Models\Athlete;
use App\Models\Category;
use App\Models\Club;
use App\Models\Event;
use App\Models\Invoice;
use App\Models\JerseySize;
use App\Models\RaceEvent;
use App\Models\Registration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class RegistrationController extends Controller
{
    use AuthorizesClubOwnership;

    public function create(Request $request, Club $club, Athlete $athlete): View
    {
        $this->authorizeAthlete($request, $club, $athlete);

        return view('registrations.create', [
            'club' => $club,
            'athlete' => $athlete,
            'events' => Event::orderBy('start_date')->get(),
            'categories' => Category::orderBy('group')->orderBy('name')->get(),
            'jerseySizes' => JerseySize::orderBy('sort_order')->get(),
            'raceEvents' => RaceEvent::orderBy('name')->get(),
        ]);
    }

    public function store(RegistrationRequest $request, Club $club, Athlete $athlete): RedirectResponse
    {
        $this->authorizeAthlete($request, $club, $athlete);

        abort_if(
            $athlete->registrations()->where('event_id', $request->integer('event_id'))->exists(),
            422,
            'This athlete is already registered for this event.',
        );

        $category = Category::findOrFail($request->integer('category_id'));

        $registration = DB::transaction(function () use ($request, $athlete, $category) {
            $registration = $athlete->registrations()->create([
                ...$request->safe()->only(['event_id', 'category_id', 'jersey_size_id', 'emergency_contact_name', 'emergency_contact_phone']),
                'data_declaration_agreed_at' => now(),
                'rules_agreement_agreed_at' => now(),
            ]);

            foreach ($request->input('race_event_ids') as $raceEventId) {
                $registration->items()->create(['race_event_id' => $raceEventId]);
            }

            $uniqueCode = random_int(100, 999);

            Invoice::create([
                'registration_id' => $registration->id,
                'invoice_number' => 'INV-'.now()->format('Ymd').'-'.Str::upper(Str::random(6)),
                'base_fee' => $category->fee,
                'unique_code' => $uniqueCode,
                'total_amount' => $category->fee + $uniqueCode,
            ]);

            return $registration;
        });

        return redirect()->route('registrations.show', $registration)->with('status', 'registration-created');
    }

    public function show(Request $request, Registration $registration): View
    {
        abort_unless($registration->athlete->club->manager_id === $request->user()->manager->id, 403);

        $registration->load(['athlete', 'event', 'category', 'jerseySize', 'items.raceEvent', 'invoice.payments']);

        return view('registrations.show', ['registration' => $registration]);
    }
}
