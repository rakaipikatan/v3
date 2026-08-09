<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Concerns\AuthorizesClubOwnership;
use App\Http\Requests\ClubRequest;
use App\Models\Club;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ClubController extends Controller
{
    use AuthorizesClubOwnership;

    public function index(Request $request): View
    {
        return view('clubs.index', [
            'clubs' => $request->user()->manager->clubs()->withCount('athletes')->latest()->get(),
        ]);
    }

    public function create(): View
    {
        return view('clubs.create');
    }

    public function store(ClubRequest $request): RedirectResponse
    {
        $request->user()->manager->clubs()->create($request->validated());

        return redirect()->route('clubs.index')->with('status', 'club-created');
    }

    public function edit(Request $request, Club $club): View
    {
        $this->authorizeClub($request, $club);

        return view('clubs.edit', ['club' => $club]);
    }

    public function update(ClubRequest $request, Club $club): RedirectResponse
    {
        $this->authorizeClub($request, $club);

        $club->update($request->validated());

        return redirect()->route('clubs.index')->with('status', 'club-updated');
    }

    public function destroy(Request $request, Club $club): RedirectResponse
    {
        $this->authorizeClub($request, $club);

        abort_if($club->athletes()->exists(), 422, 'Cannot delete a club that already has athletes.');

        $club->delete();

        return redirect()->route('clubs.index')->with('status', 'club-deleted');
    }
}
