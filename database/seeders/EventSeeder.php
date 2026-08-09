<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        Event::updateOrCreate(
            ['name' => 'V3 Roller Sport Championship 2026'],
            [
                'description' => 'Development/dummy event used to test the registration flow.',
                'location' => 'Jakarta',
                'start_date' => '2026-12-05',
                'end_date' => '2026-12-07',
                'registration_opens_at' => now(),
                'registration_closes_at' => now()->addMonths(3),
            ],
        );
    }
}
