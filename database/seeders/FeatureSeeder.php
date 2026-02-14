<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    public function run()
    {
        $features = [
            [
                'title' => 'Easy & Fast Booking',
                'description' => 'Completely carinate e business testing process whereas fully researched customer service. Globally extensive content with quality.',
                'icon_class' => 'fa-solid fa-vector-square',
                'is_highlighted' => false,
                'display_order' => 1,
                'status' => 'active',
            ],
            [
                'title' => 'Many Pickup Location',
                'description' => 'Enthusiastically magnetic initiatives with cross-platform sources. Dynamically target testing procedures through effective.',
                'icon_class' => 'fa-solid fa-crown',
                'is_highlighted' => true,
                'display_order' => 2,
                'status' => 'active',
            ],
            [
                'title' => 'Customer Satisfaction',
                'description' => 'Globally user centric method interactive. Seamlessly revolutionize unique portals corporate collaboration.',
                'icon_class' => 'fa-solid fa-user-check',
                'is_highlighted' => false,
                'display_order' => 3,
                'status' => 'active',
            ],
        ];

        foreach ($features as $feature) {
            Feature::updateOrCreate(['title' => $feature['title']], $feature);
        }
    }
}
