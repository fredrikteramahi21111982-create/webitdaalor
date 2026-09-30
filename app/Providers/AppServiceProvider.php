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

        // Force HTTPS in production (sangat penting untuk hosting cPanel / shared hosting)
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        try {
            $globalPages = \App\Models\Page::select('title', 'slug')->get();
            \Illuminate\Support\Facades\View::share('globalPages', $globalPages);
            
            $globalDocCategories = \App\Models\DocumentCategory::select('name', 'slug')->get();
            \Illuminate\Support\Facades\View::share('globalDocCategories', $globalDocCategories);
            
            $importantLinks = \App\Models\ImportantLink::where('is_active', true)->get();
            \Illuminate\Support\Facades\View::share('importantLinks', $importantLinks);
            
            $heroBanners = \App\Models\HeroBanner::where('is_active', true)->pluck('image_path')->map(fn($path) => asset('storage/' . $path))->toArray();
            \Illuminate\Support\Facades\View::share('heroBanners', $heroBanners);
        } catch (\Exception $e) {
            // Ignore during migrations or initial setup
        }
    }
}
