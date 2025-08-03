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
        View::composer(['admin.middle.edit', 'admin.middle.create'], function ($view) {
            try {
                $middle = Middle::first();
                $middlePoints = MiddlePoints::all();

                Log::info('MiddleServiceProvider called, middle ID: ' . ($middle ? $middle->id : 'null'));

                $view->with([
                    'middle' => $middle,
                    'middlePoints' => $middlePoints,
                ]);
            } catch (\Exception $e) {
                Log::error('MiddleServiceProvider error: ' . $e->getMessage());
                $view->with([
                    'middle' => null,
                    'middlePoints' => [],
                ]);
            }
        });
    }
}