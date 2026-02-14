<?php

namespace App\PageBuilder\Resolvers;

class AboutSectionResolver implements SectionResolver
{
    public function resolve(array $settings)
    {
        return [
            'title' => $settings['title'] ?? 'About Us',
            'description' => $settings['content'] ?? 'We are a premier car booking service dedicated to providing the best travel experience.',
            'image' => $settings['image'] ?? null,
            'happy_customers' => $settings['happy_customers'] ?? '5000+',
            'luxury_cars' => $settings['luxury_cars'] ?? '100+',
        ];
    }
}
