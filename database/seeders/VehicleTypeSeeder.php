<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\VehicleType;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            [
                'name' => 'Mini',
                'seating_capacity' => 4,
                'base_fare' => 300,
                'per_km_rate' => 10,
                'description' => 'Compact and economical for city rides.',
                'transmission' => 'Manual',
                'fuel_type' => 'Petrol',
                'model_year' => '2023',
                'category' => 'Economy',
                'status' => 'active'
            ],
            [
                'name' => 'Sedan',
                'seating_capacity' => 4,
                'base_fare' => 500,
                'per_km_rate' => 15,
                'description' => 'Comfortable sedan for business and leisure.',
                'transmission' => 'Automatic',
                'fuel_type' => 'Petrol',
                'model_year' => '2024',
                'category' => 'US Standard',
                'status' => 'active'
            ],
            [
                'name' => 'SUV',
                'seating_capacity' => 7,
                'base_fare' => 800,
                'per_km_rate' => 20,
                'description' => 'Spacious SUV for family trips and luggage.',
                'transmission' => 'Automatic',
                'fuel_type' => 'Diesel',
                'model_year' => '2024',
                'category' => 'Premium',
                'status' => 'active'
            ],
            [
                'name' => 'Premium',
                'seating_capacity' => 4,
                'base_fare' => 1200,
                'per_km_rate' => 30,
                'description' => 'Luxury travel with premium amenities.',
                'transmission' => 'Automatic',
                'fuel_type' => 'Electric',
                'model_year' => '2025',
                'category' => 'Luxury',
                'status' => 'active'
            ],
            [
                'name' => 'Tempo Traveller',
                'seating_capacity' => 12,
                'base_fare' => 2000,
                'per_km_rate' => 40,
                'description' => 'Ideal for large groups and outstation trips.',
                'transmission' => 'Manual',
                'fuel_type' => 'Diesel',
                'model_year' => '2023',
                'category' => 'Group',
                'status' => 'active'
            ]
        ];

        foreach ($types as $type) {
            VehicleType::updateOrCreate(
                ['name' => $type['name']], 
                $type
            );
        }
    }
}
