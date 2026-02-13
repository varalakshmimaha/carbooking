<?php

namespace App\PageBuilder\Resolvers;

use App\Models\Testimonial;

class TestimonialsListResolver implements SectionResolver
{
    public function resolve(array $settings)
    {
        return [
            'testimonials' => Testimonial::latest()->get(),
            'title' => $settings['title'] ?? 'What Our Customers Say',
            'subtitle' => $settings['subtitle'] ?? 'Read trusted reviews from our happy customers.'
        ];
    }
}
