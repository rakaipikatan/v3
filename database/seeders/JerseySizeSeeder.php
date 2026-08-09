<?php

namespace Database\Seeders;

use App\Models\JerseySize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JerseySizeSeeder extends Seeder
{
    public function run(): void
    {
        $labels = ['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL'];

        foreach ($labels as $order => $label) {
            JerseySize::updateOrCreate(['label' => $label], ['sort_order' => $order]);
        }
    }
}
