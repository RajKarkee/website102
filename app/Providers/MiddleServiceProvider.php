<?php 
namespace App\Providers;

use App\Models\Middle;
use App\Models\MiddlePoints;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class MiddleServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        View::composer(['components.values'], function ($view) {
            try {
                $currentRoute = request()->route() ? request()->route()->getName() : null;
                Log::info('MiddleServiceProvider called for route: ' . ($currentRoute ?? 'null'));
                if (!$currentRoute) {
                    return;
                }

                $middle = Middle::where('page',$currentRoute)->first();
            if($middle){
                $middle_points = MiddlePoints::where('middle_id', $middle->id)->get();
                if ($middle_points->isEmpty()) {
                    Log::info('No middle points found for middle ID: ' . $middle->id);
                } else {
                    Log::info('Middle points found for middle ID: ' . $middle->id);
                    $view->with([
                        'middle' => $middle,
                        'middle_points' => $middle_points, 
                    ]);
                }

            }

            } catch (\Exception $e) {
                Log::error('MiddleServiceProvider error: ' . $e->getMessage());
                $view->with([
                    'middle' => null,
                    'icon' => null,
                    'title' => null,
                    'description' => null,
                ]);
            }
        });
    }
}