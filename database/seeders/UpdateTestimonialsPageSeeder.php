<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\SectionType;
use App\Models\PageSection;

class UpdateTestimonialsPageSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create/Update Section Type
        $sectionType = SectionType::updateOrCreate(
            ['key' => 'testimonials_list'],
            [
                'name' => 'Testimonials List',
                'category' => 'Dynamic',
                'icon' => '<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" /></svg>',
                'description' => 'Displays client testimonials in a grid.',
                'default_settings' => [
                    'title' => 'What Our Clients Say',
                    'subtitle' => 'Real stories from satisfied customers.'
                ],
            ]
        );

        $this->command->info('Section Type "testimonials_list" created/updated.');

        // 2. Create/Update Page
        $page = Page::updateOrCreate(
            ['slug' => 'testimonials'],
            [
                'title' => 'Testimonials',
                'status' => 'active'
            ]
        );

        $this->command->info('Page "testimonials" created/updated.');

        // 3. Assign Section to Page
        // Clear existing sections to avoid duplicates in this specific case
        $page->sections()->delete();

        PageSection::create([
            'page_id' => $page->id,
            'section_type_id' => $sectionType->id,
            'position' => 0,
            'is_visible' => true,
            'settings' => $sectionType->default_settings
        ]);
        
        // Also add Contact CTA section at the bottom
        $contactCta = SectionType::where('key', 'contact_cta')->first();
        if ($contactCta) {
            PageSection::create([
                'page_id' => $page->id,
                'section_type_id' => $contactCta->id,
                'position' => 1,
                'is_visible' => true,
                'settings' => $contactCta->default_settings
            ]);
        }

        $this->command->info('Section assigned to Testimonials page.');
    }
}
