<?php

namespace Database\Seeders;

use App\Models\RaceEvent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RaceEventSeeder extends Seeder
{
    public function run(): void
    {
        $raceEvents = [
            ['name' => '200 m Time Trial', 'distance_meters' => 200],
            ['name' => '500 m Sprint', 'distance_meters' => 500],
            ['name' => '1000 m Sprint', 'distance_meters' => 1000],
            ['name' => '3000 m Point', 'distance_meters' => 3000],
            ['name' => '5000 m Elimination', 'distance_meters' => 5000],
            ['name' => 'Relay', 'distance_meters' => null],
            ['name' => 'Team Sprint', 'distance_meters' => null],
        ];

        foreach ($raceEvents as $raceEvent) {
            RaceEvent::updateOrCreate(['name' => $raceEvent['name']], $raceEvent);
        }
    }
}
