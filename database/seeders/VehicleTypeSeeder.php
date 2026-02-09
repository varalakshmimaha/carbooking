<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['Mini', 'Sedan', 'SUV', 'Premium', 'Tempo Traveller'];
        foreach ($types as $type) {
            \App\Models\VehicleType::updateOrCreate(['name' => $type]);
        }
    }
}
