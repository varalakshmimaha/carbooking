<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\SectionType;
use App\Models\PageSection;

class DefaultPagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'title' => 'Home',
                'slug' => 'home',
                'status' => 'active',
                'sections' => ['banner_slider', 'services_grid', 'contact_cta']
            ],
            [
                'title' => 'About Us',
                'slug' => 'about',
                'status' => 'active',
                'sections' => ['about_section']
            ],
            [
                'title' => 'Contact Us',
                'slug' => 'contact',
                'status' => 'active',
                'sections' => ['contact_page']
            ],
        ];

        foreach ($pages as $pData) {
            $page = Page::updateOrCreate(
                ['slug' => $pData['slug']],
                [
                    'title' => $pData['title'],
                    'status' => $pData['status']
                ]
            );

            // Ensure sections match the seeder data
            $page->sections()->delete();
            foreach ($pData['sections'] as $index => $typeKey) {
                $type = SectionType::where('key', $typeKey)->first();
                if ($type) {
                    PageSection::create([
                        'page_id' => $page->id,
                        'section_type_id' => $type->id,
                        'position' => $index,
                        'is_visible' => true,
                        'settings' => $type->default_settings
                    ]);
                }
            }
        }
    }
}
