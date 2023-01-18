<?php

namespace App\Console;

use App\Console\Commands\DailyQuote;
use App\Models\Post;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        DailyQuote::class
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')->everyMinute();

        $schedule->command('quote:daily')->everyMinute();

        $schedule->call(function () {
            Post::first()->delete();
        })->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
