<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'name' => 'City Transfer',
                'icon' => 'car',
                'description' => 'Fast and reliable city transfers for your daily commute.',
                'status' => 'active'
            ],
            [
                'name' => 'Airport Pickup',
                'icon' => 'plane',
                'description' => 'Never miss a flight with our punctual airport pickup and drop services.',
                'status' => 'active'
            ],
            [
                'name' => 'Outstation Trip',
                'icon' => 'map-marked-alt',
                'description' => 'Comfortable long-distance rides for your weekend getaways.',
                'status' => 'active'
            ],
            [
                'name' => 'Luxury Rental',
                'icon' => 'crown',
                'description' => 'Experience premium luxury with our high-end fleet for special occasions.',
                'status' => 'active'
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
