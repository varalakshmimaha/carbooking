<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mainMenu = \App\Models\Menu::create([
            'name' => 'Main Navigation',
            'key' => 'header',
            'status' => 'active',
        ]);

        $mainMenu->allItems()->createMany([
            ['label' => 'Home', 'type' => 'internal', 'url' => '/', 'sort_order' => 1],
            ['label' => 'Fleet', 'type' => 'internal', 'url' => '/fleet', 'sort_order' => 2],
            ['label' => 'About Us', 'type' => 'internal', 'url' => '/about', 'sort_order' => 3],
            ['label' => 'Contact', 'type' => 'internal', 'url' => '/contact', 'sort_order' => 4],
        ]);

        $footerMenu = \App\Models\Menu::create([
            'name' => 'Quick Links',
            'key' => 'footer_col1',
            'status' => 'active',
        ]);

        $footerMenu->allItems()->createMany([
            ['label' => 'Privacy Policy', 'type' => 'internal', 'url' => '/privacy', 'sort_order' => 1],
            ['label' => 'Terms of Service', 'type' => 'internal', 'url' => '/terms', 'sort_order' => 2],
        ]);
    }
}
