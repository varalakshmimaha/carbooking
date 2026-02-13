<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Setting;

class FooterLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Footer Column 1: Quick Links
        $col1 = Menu::firstOrCreate(
            ['key' => 'footer_col1'],
            ['name' => 'Quick Links', 'status' => 'active']
        );
        
        $col1->items()->delete();
        $col1->items()->createMany([
            ['label' => 'About Us', 'type' => 'internal', 'url' => '/about-us', 'sort_order' => 1],
            ['label' => 'Blogs', 'type' => 'internal', 'url' => '/blogs', 'sort_order' => 2],
            ['label' => 'Services', 'type' => 'internal', 'url' => '/services', 'sort_order' => 3],
            ['label' => 'Contact', 'type' => 'internal', 'url' => '/contact', 'sort_order' => 4],
        ]);

        // 2. Footer Column 2: Legal Policies
        $col2 = Menu::firstOrCreate(
            ['key' => 'footer_col2'],
            ['name' => 'Legal Policies', 'status' => 'active']
        );
        
        $col2->items()->delete();
        $col2->items()->createMany([
             ['label' => 'Privacy Policy', 'type' => 'internal', 'url' => '/privacy-policy', 'sort_order' => 1],
             ['label' => 'Shipping Policy', 'type' => 'internal', 'url' => '/shipping-policy', 'sort_order' => 2],
             ['label' => 'Cancellation Policy', 'type' => 'internal', 'url' => '/cancellation-policy', 'sort_order' => 3],
        ]);

        // 3. Ensure Pages exist
        $pages = [
            'privacy-policy' => 'Privacy Policy',
            'shipping-policy' => 'Shipping Policy',
            'cancellation-policy' => 'Cancellation Policy',
        ];
        
        foreach ($pages as $slug => $title) {
            Page::firstOrCreate(
                ['slug' => $slug],
                [
                    'title' => $title,
                    'content' => "<h2>$title</h2><p>This is the $title content. You can edit this in the admin panel.</p>",
                    'status' => 'active'
                ]
            );
        }

        // 4. Social Links Settings
        $socials = [
            'social_facebook' => 'https://facebook.com',
            'social_instagram' => 'https://instagram.com',
            'social_twitter' => 'https://twitter.com',
            'social_whatsapp' => 'https://wa.me/9876543210',
        ];

        foreach ($socials as $key => $value) {
            Setting::set($key, $value, 'social');
        }
    }
}
