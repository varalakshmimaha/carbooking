<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\MenuItem;

class UpdateFooterMenusSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Update Footer Column 1 (Quick Links) - Add Home if missing
        $col1 = Menu::where('key', 'footer_col1')->first();
        if ($col1) {
            // Check if Home exists
            $homeExists = $col1->items()->where('label', 'Home')->exists();
            
            if (!$homeExists) {
                // Add Home at the top (sort_order 0)
                MenuItem::create([
                    'menu_id' => $col1->id,
                    'label' => 'Home',
                    'type' => 'internal',
                    'url' => '/',
                    'sort_order' => 0,
                    'status' => 'active'
                ]);
                $this->command->info('Added Home link to Footer Quick Links.');
            }
        }

        // 2. Update Footer Column 3 (Contact Us) - Update/Replace items
        $col3 = Menu::where('key', 'footer_col3')->first();
        if ($col3) {
            // Remove existing items to ensure clean slate with new info
            $col3->items()->delete();
            
            // Add Address
            MenuItem::create([
                'menu_id' => $col3->id,
                'label' => 'Near Taluk Office, Main Road, Narasimharajpur - 577134',
                'type' => 'custom',
                'url' => '#',
                'icon' => 'map-pin',
                'sort_order' => 1,
                'status' => 'active'
            ]);

            // Add Phone
            MenuItem::create([
                'menu_id' => $col3->id,
                'label' => '+91 9342361210',
                'type' => 'custom',
                'url' => 'tel:+919342361210',
                'icon' => 'phone',
                'sort_order' => 2,
                'status' => 'active'
            ]);

            // Add Email
            MenuItem::create([
                'menu_id' => $col3->id,
                'label' => 'raitha.okkuta@gmail.com',
                'type' => 'custom',
                'url' => 'mailto:raitha.okkuta@gmail.com',
                'icon' => 'mail',
                'sort_order' => 3,
                'status' => 'active'
            ]);
            
            $this->command->info('Updated Footer Contact Info.');
        }
    }
}
