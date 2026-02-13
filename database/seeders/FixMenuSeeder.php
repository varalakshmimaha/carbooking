<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class FixMenuSeeder extends Seeder
{
    public function run()
    {
        $menu = Menu::where('key', 'header')->first();
        if ($menu) {
            // Check existing URLs to avoid duplicates
            $existingUrls = $menu->items()->pluck('url')->toArray();

            $itemsToAdd = [
                ['label' => 'Home', 'url' => '/', 'type' => 'internal', 'sort_order' => 1, 'status' => 'active'],
                ['label' => 'About Us', 'url' => '/about-us', 'type' => 'internal', 'sort_order' => 2, 'status' => 'active'],
                ['label' => 'Blogs', 'url' => '/blogs', 'type' => 'internal', 'sort_order' => 5, 'status' => 'active']
            ];

            foreach ($itemsToAdd as $item) {
                if (!in_array($item['url'], $existingUrls)) {
                    $menu->items()->create($item);
                }
            }
        }
    }
}
