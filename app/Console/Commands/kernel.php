<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        // Register your custom Artisan commands here
        \App\Console\Commands\MakeAdmin::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        // Define scheduled tasks here
    }

    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
