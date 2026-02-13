<?php

namespace App\PageBuilder\Resolvers;

use App\Models\Service;

class ServicesGridResolver implements SectionResolver
{
    public function resolve(array $settings)
    {
        $limit = $settings['limit'] ?? 6;
        return Service::where('status', 'active')->limit($limit)->get();
    }
}
