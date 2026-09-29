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
        \Illuminate\Pagination\Paginator::useTailwind();

        try {
            $globalPages = \App\Models\Page::select('title', 'slug')->get();
            \Illuminate\Support\Facades\View::share('globalPages', $globalPages);
            
            $globalDocCategories = \App\Models\DocumentCategory::select('name', 'slug')->get();
            \Illuminate\Support\Facades\View::share('globalDocCategories', $globalDocCategories);
        } catch (\Exception $e) {
            // Ignore during migrations or initial setup
        }
    }
}
