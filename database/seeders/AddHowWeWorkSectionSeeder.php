<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SectionType;

class AddHowWeWorkSectionSeeder extends Seeder
{
    public function run(): void
    {
        SectionType::updateOrCreate(
            ['key' => 'how_we_work'],
            [
                'name' => 'How we Work',
                'category' => 'Dynamic',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>',
                'description' => 'Display a step-by-step process of how your service works.',
                'default_settings' => [
                    'title' => 'How it Works',
                    'subtitle' => 'Booking your ride is as easy as 1-2-3',
                    'step1_title' => 'Search Car',
                    'step1_desc' => 'Choose your destination and pick-up date.',
                    'step2_title' => 'Book Your Ride',
                    'step2_desc' => 'Select your preferred car and confirm booking.',
                    'step3_title' => 'Enjoy Journey',
                    'step3_desc' => 'Sit back and relax while our driver takes you there.'
                ],
                'is_active' => true
            ]
        );
    }
}
