<?php

namespace App\PageBuilder\Resolvers;

use App\Models\Feature;

class WhyChooseUsResolver implements SectionResolver
{
    public function resolve(array $settings)
    {
        // Settings could include limit, but we'll default to all active features
        $limit = $settings['limit'] ?? 10;
        
        $features = Feature::where('status', 'active')
            ->orderBy('display_order', 'asc')
            ->orderBy('id', 'asc')
            ->limit($limit)
            ->get();
            
        return [
            'features' => $features,
            'title' => $settings['title'] ?? 'Why Choose Us',
            'subtitle' => $settings['subtitle'] ?? 'We are innovative and passionate about the work we do.',
        ];
    }
}
