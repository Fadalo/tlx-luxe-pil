<?php

namespace App\Console;

use App\Console\Commands\MyScheduledTask; // Import your custom command
use App\Console\Commands\ScheaduleCheckAutoActivated;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    // Register your custom console commands
    protected $commands = [
        MyScheduledTask::class, // Register your custom command here

    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Schedule your command to run every hour
        $schedule->command('my:schedule-task')->hourly();

        // Example of scheduling a command to run daily
        // $schedule->command('my:other-task')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        // Load the commands defined in the app/Console/Commands directory
        $this->load(__DIR__.'/Commands');

        // Alternatively, you can load commands from a specific file
        // $this->load(__DIR__.'/Commands/MySpecificCommand.php');
    }
}
