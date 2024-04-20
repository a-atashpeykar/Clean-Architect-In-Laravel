<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel;

class ConsoleKernel extends Kernel
{
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
    }
	
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
