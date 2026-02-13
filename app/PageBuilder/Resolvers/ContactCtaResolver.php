<?php

namespace App\PageBuilder\Resolvers;

class ContactCtaResolver implements SectionResolver
{
    public function resolve(array $settings)
    {
        return [
            'phone' => $settings['phone'] ?? '+91 98765 43210',
            'button_text' => $settings['button_text'] ?? 'Call Now',
            'title' => $settings['title'] ?? 'Ready to Book Your Ride?',
            'subtitle' => $settings['subtitle'] ?? 'We are available 24/7 for your convenience.'
        ];
    }
}
