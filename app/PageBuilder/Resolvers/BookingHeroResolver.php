<?php

namespace App\PageBuilder\Resolvers;

class BookingHeroResolver implements SectionResolver
{
    public function resolve(array $settings)
    {
        $packages = \App\Models\Package::where('status', 'active')->get();

        return [
            'title' => $settings['title'] ?? 'Book Your Ride',
            'subtitle' => $settings['subtitle'] ?? 'Choose your trip type and get started',
            'bg_gradient' => $settings['bg_gradient'] ?? 'from-blue-50 via-indigo-50 to-purple-50',
            'packages' => $packages,
        ];
    }
}
