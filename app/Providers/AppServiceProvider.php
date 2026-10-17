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

    public function boot(): void
    {
        try {
            if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                $systemLogo = \App\Models\Setting::get('system_logo');
                $systemName = \App\Models\Setting::get('system_name', 'Book Admin');
                $systemTagline = \App\Models\Setting::get('system_tagline', 'Library Management');
                
                \Illuminate\Support\Facades\View::share('globalSystemLogo', $systemLogo);
                \Illuminate\Support\Facades\View::share('globalSystemName', $systemName);
                \Illuminate\Support\Facades\View::share('globalSystemTagline', $systemTagline);
            }
        } catch (\Throwable $e) {
            // Ignore database connection issues during early CLI steps
        }
    }
}
