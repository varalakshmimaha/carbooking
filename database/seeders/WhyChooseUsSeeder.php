<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WhyChooseUsSeeder extends Seeder
{
    public function run()
    {
        // 1. Ensure the Section Type exists
        $type = \App\Models\SectionType::firstOrCreate(
            ['key' => 'why_choose_us'],
            [
                'name' => 'Why Choose Us',
                'description' => 'Features grid with icon and highlight option.',
                'icon' => 'heroicons:list-bullet',
                'category' => 'Features',
                'is_active' => true
            ]
        );

        // 2. Add sample Features (if not already added by FeatureSeeder)
        $this->call(FeatureSeeder::class);

        // 3. Add the section to the Home Page
        $homePage = \App\Models\Page::where('slug', 'home')->first();
        if ($homePage) {
            // Check if section already exists on this page
            $exists = $homePage->sections()->where('section_type_id', $type->id)->exists();
            
            if (!$exists) {
                // Calculate next position
                $maxPos = $homePage->sections()->max('position') ?? 0;
                
                $homePage->sections()->create([
                    'section_type_id' => $type->id,
                    'is_visible' => true,
                    'position' => $maxPos + 1,
                    'settings' => [
                        'title' => 'Why Choose Us',
                        'subtitle' => 'We are innovative and passionate about the work we do.',
                        'limit' => 3
                    ],
                ]);
            }
        }
    }
}
