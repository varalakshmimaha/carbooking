<?php

namespace App\PageBuilder\Resolvers;

use App\Models\BlogPost;

class BlogsListResolver implements SectionResolver
{
    public function resolve(array $settings)
    {
        return [
            'posts' => BlogPost::where('status', 'published')->latest()->take(9)->get(),
            'title' => $settings['title'] ?? 'Our Latest Blogs',
            'subtitle' => $settings['subtitle'] ?? 'Stay updated with our latest news and travel tips.'
        ];
    }
}
