<?php

namespace App\Providers;

use App\Models\Jumbotron;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class JumbotronServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer(['components.jumbotron'], function ($view) {
            try {
                $currentRoute = request()->route() ? request()->route()->getName() : null;
                
                // Debug logging
                Log::info('JumbotronServiceProvider called for route: ' . ($currentRoute ?? 'null'));
                
                if (!$currentRoute) {
                    return;
                }
                
                $jumbotron = Jumbotron::where('page', $currentRoute)
                    ->where('is_active', true)
                    ->first();

                Log::info('Jumbotron found: ' . ($jumbotron ? 'Yes (ID: ' . $jumbotron->id . ')' : 'No'));

                if ($jumbotron) {
                    $view->with([
                        'title' => $jumbotron->title,
                        'subtitle' => $jumbotron->subtitle,
                        'description' => $jumbotron->description,
                        'backgroundImage' => $jumbotron->background_image 
                            ? asset('storage/' . $jumbotron->background_image) 
                            : asset('assets/images/default-jumbotron.jpg'),
                        'icon' => $jumbotron->icon ? asset('storage/' . $jumbotron->icon) : null,
                        'badge' => $jumbotron->badge,
                    ]);
                } else {
                    // Provide default values if no jumbotron found
                    $view->with([
                        'title' => null,
                        'subtitle' => null,
                        'description' => null,
                        'backgroundImage' => asset('assets/images/default-jumbotron.jpg'),
                        'icon' => null,
                        'badge' => null,
                    ]);
                }
            } catch (\Exception $e) {
                // Log error and provide defaults
                Log::error('JumbotronServiceProvider error: ' . $e->getMessage());
                $view->with([
                    'title' => null,
                    'subtitle' => null,
                    'description' => null,
                    'backgroundImage' => asset('assets/images/default-jumbotron.jpg'),
                    'icon' => null,
                    'badge' => null,
                ]);
            }
        });
    }
}
