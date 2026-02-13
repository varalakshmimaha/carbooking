<?php

namespace App\PageBuilder\Resolvers;

// use App\Models\Banner; // Assuming Banner model exists

class BannerSliderResolver implements SectionResolver
{
    public function resolve(array $settings)
    {
        // For now, return dummy data as those tables might not exist yet
        return [
            ['image' => 'https://via.placeholder.com/1920x600', 'title' => 'Travel the World'],
            ['image' => 'https://via.placeholder.com/1920x600', 'title' => 'Luxury Car Rentals'],
        ];
        
        /* 
        $limit = $settings['limit'] ?? 5;
        return Banner::where('is_active', true)->limit($limit)->get();
        */
    }
}
