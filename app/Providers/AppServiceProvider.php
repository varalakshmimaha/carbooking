<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer(['layouts.frontend', 'welcome', 'partials.footer', 'frontend.*'], function ($view) {
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
            
            $view->with('headerMenu', $headerMenu)
                 ->with('footerCol1', $footerCol1)
                 ->with('footerCol2', $footerCol2)
                 ->with('footerCol3', $footerCol3);
        });
    }
}
