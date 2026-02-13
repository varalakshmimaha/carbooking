<?php

namespace App\PageBuilder\Resolvers;

class HowWeWorkResolver implements SectionResolver
{
    public function resolve(array $settings)
    {
        return [
            'title' => $settings['title'] ?? 'How it Works',
            'subtitle' => $settings['subtitle'] ?? 'Easy steps to book your ride',
            'steps' => [
                [
                    'title' => $settings['step1_title'] ?? 'Search Car',
                    'desc' => $settings['step1_desc'] ?? 'Select your location and car type',
                    'icon' => 'search'
                ],
                [
                    'title' => $settings['step2_title'] ?? 'Book Your Ride',
                    'desc' => $settings['step2_desc'] ?? 'Confirm your booking with one click',
                    'icon' => 'check-circle'
                ],
                [
                    'title' => $settings['step3_title'] ?? 'Enjoy Journey',
                    'desc' => $settings['step3_desc'] ?? 'Travel safely with our expert drivers',
                    'icon' => 'smile'
                ]
            ]
        ];
    }
}
