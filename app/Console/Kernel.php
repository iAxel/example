<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;

use Illuminate\Foundation\Console\Kernel as BaseKernel;

final class Kernel extends BaseKernel
{
    /**
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * @param Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        //
    }

    /**
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');
    }
}
