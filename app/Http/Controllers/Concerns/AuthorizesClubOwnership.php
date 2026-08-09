<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Athlete;
use App\Models\Club;
use Illuminate\Http\Request;

trait AuthorizesClubOwnership
{
    private function authorizeClub(Request $request, Club $club): void
    {
        abort_unless($club->manager_id === $request->user()->manager->id, 403);
    }

    private function authorizeAthlete(Request $request, Club $club, Athlete $athlete): void
    {
        $this->authorizeClub($request, $club);

        abort_unless($athlete->club_id === $club->id, 404);
    }
}
