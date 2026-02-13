<?php

namespace App\PageBuilder\Resolvers;

use App\Models\Package;

class PackagesListResolver implements SectionResolver
{
    public function resolve(array $settings)
    {
        $limit = $settings['limit'] ?? 4;
        return Package::where('status', 'active')->limit($limit)->get();
    }
}
