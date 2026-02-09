<?php

namespace Database\Seeders;

use App\Models\State;
use App\Models\City;
use Illuminate\Database\Seeder;

class StateCitySeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Tamil Nadu' => ['Chennai', 'Coimbatore', 'Madurai', 'Trichy'],
            'Karnataka' => ['Bangalore', 'Mysore', 'Hubli', 'Mangalore'],
            'Maharashtra' => ['Mumbai', 'Pune', 'Nagpur', 'Thane'],
            'Delhi' => ['New Delhi', 'North Delhi', 'South Delhi'],
        ];

        foreach ($data as $stateName => $cities) {
            $state = State::create(['name' => $stateName]);
            foreach ($cities as $cityName) {
                City::create([
                    'state_id' => $state->id,
                    'name' => $cityName
                ]);
            }
        }
    }
}
