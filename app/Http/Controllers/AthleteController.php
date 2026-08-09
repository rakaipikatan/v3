<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\AuthorizesClubOwnership;
use App\Http\Requests\AthleteRequest;
use App\Models\Athlete;
use App\Models\Club;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AthleteController extends Controller
{
    use AuthorizesClubOwnership;

    public function index(Request $request, Club $club): View
    {
        $this->authorizeClub($request, $club);

        return view('athletes.index', [
            'club' => $club,
            'athletes' => $club->athletes()->with('registrations')->latest()->get(),
        ]);
    }

    public function create(Request $request, Club $club): View
    {
        $this->authorizeClub($request, $club);

        return view('athletes.create', ['club' => $club]);
    }

    public function store(AthleteRequest $request, Club $club): RedirectResponse
    {
        $this->authorizeClub($request, $club);

        $club->athletes()->create($request->validated());

        return redirect()->route('clubs.athletes.index', $club)->with('status', 'athlete-created');
    }

    public function edit(Request $request, Club $club, Athlete $athlete): View
    {
        $this->authorizeAthlete($request, $club, $athlete);

        return view('athletes.edit', ['club' => $club, 'athlete' => $athlete]);
    }

    public function update(AthleteRequest $request, Club $club, Athlete $athlete): RedirectResponse
    {
        $this->authorizeAthlete($request, $club, $athlete);

        $athlete->update($request->validated());

        return redirect()->route('clubs.athletes.index', $club)->with('status', 'athlete-updated');
    }

    public function destroy(Request $request, Club $club, Athlete $athlete): RedirectResponse
    {
        $this->authorizeAthlete($request, $club, $athlete);

        abort_if($athlete->registrations()->exists(), 422, 'Cannot delete an athlete that already has registrations.');

        $athlete->delete();

        return redirect()->route('clubs.athletes.index', $club)->with('status', 'athlete-deleted');
    }
}
