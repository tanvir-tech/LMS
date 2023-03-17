<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

use App\Console\Commands\AutoReminder;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\AutoReminder::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('autoreminder:checkfine')->everyMinute();
        $schedule->command('queue:work')->everyMinute();
        // ->evenInMaintenanceMode();

        // $schedule->command('autoreminder:checkfine')->daily();
        
        
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
