<?php

namespace App\Console;

use App\Domain\Design\Pages\Jobs\DeletePageIamgesJob;
use App\Domain\Design\Templates\Jobs\DeleteTemplateIamgesJob;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        // $schedule->job(new DeletePageIamgesJob())->everyTwoMinutes();
        // $schedule->job(new DeletePageIamgesJob)->lastDayOfMonth('11:00');
        // $schedule->job(new DeleteTemplateIamgesJob)->lastDayOfMonth('11:15');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
