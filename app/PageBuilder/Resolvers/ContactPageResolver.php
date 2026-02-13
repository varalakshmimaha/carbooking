<?php

namespace App\PageBuilder\Resolvers;

use App\Models\Setting;

class ContactPageResolver implements SectionResolver
{
    public function resolve(array $settings)
    {
        return [
            'address' => Setting::get('company_address', 'Near Taluk Office, Main Road, Narasimharajpur - 577134'),
            'phone' => Setting::get('company_phone', '9342361210'),
            'email' => Setting::get('company_email', 'raitha.okkuta@gmail.com'),
            'title' => $settings['title'] ?? 'Stay connected',
            'subtitle' => $settings['subtitle'] ?? 'We are here to help.',
        ];
    }
}
