<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register LogoHelper as a singleton
        $this->app->singleton('LogoHelper', function ($app) {
            return new \App\Helpers\LogoHelper();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Load custom helper files
        require_once app_path('Helpers/LogoHelper.php');
        
        // Register Blade component aliases for admin components
        Blade::componentNamespace('App\\View\\Components\\Admin', 'admin');
        
        // Auto-discover admin components
        Blade::anonymousComponentNamespace('admin.components', 'admin');

        view()->composer('components.partners', function ($view) {
            $view->with('partners', \App\Models\Partner::all());
            $view->with('partnerHeading',\App\Models\PartnerHeading::first());
        });

     
    }
}
