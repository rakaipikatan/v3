<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Fees follow the website spec (Section 17). The Excel/mind map fee
     * figures conflict with this and must be reconciled before production.
     */
    public function run(): void
    {
        $fees = [
            'beginner' => 450000,
            'standard' => 470000,
            'speed' => 500000,
        ];

        $names = [
            'beginner' => ['U6', 'K1', 'K2', 'K3'],
            'standard' => ['A', 'B', 'C', 'D', 'Junior-Senior'],
            'speed' => ['A', 'B', 'C', 'D', 'Junior-Senior'],
        ];

        foreach ($names as $group => $groupNames) {
            foreach ($groupNames as $name) {
                Category::updateOrCreate(
                    ['group' => $group, 'name' => $name],
                    ['fee' => $fees[$group]],
                );
            }
        }
    }
}
