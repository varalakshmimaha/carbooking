<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sections = [
            [
                'key' => 'banner_slider',
                'name' => 'Hero Banner Slider',
                'category' => 'Dynamic',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>',
                'description' => 'Display top sliding banners for featured content.',
                'default_settings' => ['limit' => 5, 'autoplay' => true],
            ],
            [
                'key' => 'services_grid',
                'name' => 'Services Grid',
                'category' => 'Dynamic',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>',
                'description' => 'Automatic grid of your business services.',
                'default_settings' => ['limit' => 6, 'columns' => 3],
            ],
            [
                'key' => 'about_section',
                'name' => 'About Us Section',
                'category' => 'Static',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
                'description' => 'A clean text + image section for introductions.',
                'default_settings' => ['title' => 'About Our Company', 'content' => 'Enter description here...'],
            ],
            [
                'key' => 'packages_list',
                'name' => 'Travel Packages',
                'category' => 'Dynamic',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" /></svg>',
                'description' => 'List of latest car/travel packages from DB.',
                'default_settings' => ['limit' => 4],
            ],
            [
                'key' => 'contact_cta',
                'name' => 'Contact CTA Bar',
                'category' => 'Static',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" /></svg>',
                'description' => 'A call to action bar with phone number.',
                'default_settings' => ['phone' => '+1234567890', 'button_text' => 'Call Now'],
            ],
            [
                'key' => 'contact_page',
                'name' => 'Contact Page Form',
                'category' => 'Static',
                'icon' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>',
                'description' => 'Full contact page with form and info boxes.',
                'default_settings' => ['title' => 'Stay connected', 'subtitle' => 'We are here to help.'],
            ],
        ];

        foreach ($sections as $section) {
            \App\Models\SectionType::updateOrCreate(['key' => $section['key']], $section);
        }
    }
}
