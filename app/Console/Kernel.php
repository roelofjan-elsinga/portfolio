<?php

namespace Main\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('aloiacms:publish:posts')->dailyAt('12:00');
        $schedule->command('share:linkedin')->dailyAt('16:00');
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
    }
}
