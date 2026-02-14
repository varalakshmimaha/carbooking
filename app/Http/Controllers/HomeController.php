<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        // Load menus for the welcome page
        $headerMenu = \App\Models\Menu::where('key', 'header')->with(['items' => function($query) {
            $query->where('status', 'active')->orderBy('sort_order');
        }])->first();
        
        $footerCol1 = \App\Models\Menu::where('key', 'footer_col1')->with(['items' => function($query) {
            $query->where('status', 'active')->orderBy('sort_order');
        }])->first();
        
        $footerCol2 = \App\Models\Menu::where('key', 'footer_col2')->with(['items' => function($query) {
            $query->where('status', 'active')->orderBy('sort_order');
        }])->first();
        
        $footerCol3 = \App\Models\Menu::where('key', 'footer_col3')->with(['items' => function($query) {
            $query->where('status', 'active')->orderBy('sort_order');
        }])->first();
        
        $page = Page::where('slug', 'home')->where('status', 'active')->with(['sections' => function($q) {
            $q->where('is_visible', true)->orderBy('position', 'asc');
        }, 'sections.type'])->first();

        if ($page && $page->sections->count() > 0) {
            $sectionsData = [];
            foreach ($page->sections as $section) {
                // Map section type key to resolver class name
                $className = str_replace(' ', '', ucwords(str_replace('_', ' ', $section->type->key))) . 'Resolver';
                $resolverClass = 'App\\PageBuilder\\Resolvers\\' . $className;
                
                $data = [];
                if (class_exists($resolverClass)) {
                    $data = (new $resolverClass)->resolve($section->settings ?? []);
                }
                
                $sectionsData[] = [
                    'key' => $section->type->key,
                    'settings' => $section->settings,
                    'data' => $data
                ];
            }
            return view('frontend.page', compact('page', 'sectionsData'));
        }

        // Fallback to old welcome view if no home page builder sections exist
        $aboutPage = Page::where('slug', 'about-us')->where('status', 'active')->with(['sections.type'])->first();
        $servicesPage = Page::where('slug', 'services')->where('status', 'active')->with(['sections.type'])->first();
        
        $aboutSections = $this->resolveSections($aboutPage);
        $servicesSections = $this->resolveSections($servicesPage);
        
        $packages = \App\Models\Package::where('status', 'active')->get();
        return view('welcome', compact('aboutPage', 'servicesPage', 'aboutSections', 'servicesSections', 'headerMenu', 'footerCol1', 'footerCol2', 'footerCol3', 'packages'));
    }

    protected function resolveSections($page)
    {
        if (!$page) return [];
        
        $sectionsData = [];
        foreach ($page->sections as $section) {
            if (!$section->is_visible) continue;
            
            // Map section type key to resolver class name
            // e.g. 'services_grid' -> 'ServicesGridResolver'
            $className = str_replace(' ', '', ucwords(str_replace('_', ' ', $section->type->key))) . 'Resolver';
            $resolverClass = 'App\\PageBuilder\\Resolvers\\' . $className;
            
            $data = [];
            if (class_exists($resolverClass)) {
                $data = (new $resolverClass)->resolve($section->settings ?? []);
            }
            
            $sectionsData[] = [
                'key' => $section->type->key,
                'settings' => $section->settings,
                'data' => $data
            ];
        }
        return $sectionsData;
    }
}
