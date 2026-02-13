<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Page;
use App\PageBuilder\Resolvers\BannerSliderResolver;
use App\PageBuilder\Resolvers\ServicesGridResolver;
use App\PageBuilder\Resolvers\AboutSectionResolver;
use App\PageBuilder\Resolvers\PackagesListResolver;
use App\PageBuilder\Resolvers\ContactCtaResolver;
use App\PageBuilder\Resolvers\ContactPageResolver;
use App\PageBuilder\Resolvers\HowWeWorkResolver;
use App\PageBuilder\Resolvers\TestimonialsListResolver;
use App\PageBuilder\Resolvers\BlogsListResolver;

class PageController extends Controller
{
    protected $resolvers = [
        'banner_slider' => BannerSliderResolver::class,
        'services_grid' => ServicesGridResolver::class,
        'about_section' => AboutSectionResolver::class,
        'packages_list' => PackagesListResolver::class,
        'contact_cta' => ContactCtaResolver::class,
        'contact_page' => ContactPageResolver::class,
        'how_we_work' => HowWeWorkResolver::class,
        'testimonials_list' => TestimonialsListResolver::class,
        'blogs_list' => BlogsListResolver::class,
    ];

    public function show($slug)
    {
        $page = Page::where('slug', $slug)->where('status', 'active')->firstOrFail();

        // Load sections
        $page->load(['sections' => function($q) {
            $q->where('is_visible', true)->orderBy('position', 'asc');
        }, 'sections.type']);

        // IF sections exist, use the builder
        if ($page->sections->count() > 0) {
            $sectionsData = [];

            foreach ($page->sections as $section) {
                $resolverClass = $this->resolvers[$section->type->key] ?? null;
                $data = $resolverClass ? (new $resolverClass)->resolve($section->settings ?? []) : null;

                $sectionsData[] = [
                    'key' => $section->type->key,
                    'settings' => $section->settings,
                    'data' => $data
                ];
            }

            return view('frontend.page', compact('page', 'sectionsData'));
        }

        // Fallback to static content if no builder sections
        return view('frontend.static-page', compact('page'));
    }
}
