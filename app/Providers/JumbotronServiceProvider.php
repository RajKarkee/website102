<?php

namespace App\Providers;

use App\Models\Jumbotron;
use Illuminate\Support\Facades\View;
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
            $currentRoute = request()->route()->getName();
            $jumbotron = Jumbotron::where('page', $currentRoute)
                ->where('is_active', true)
                ->first();

            if ($jumbotron) {
                $view->with([
                    'title' => $jumbotron->title,
                    'subtitle' => $jumbotron->subtitle,
                    'description' => $jumbotron->description,
                    'backgroundImage' => $jumbotron->background_image 
                        ? asset('storage/' . $jumbotron->background_image) 
                        : null,
                    'icon' => $jumbotron->icon,
                    'badge' => $jumbotron->badge,
                ]);
            }
        });
    }
}
