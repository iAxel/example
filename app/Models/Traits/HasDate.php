<?php

namespace App\Models\Traits;

use Illuminate\Support\Carbon;

trait HasDate
{
    /**
     * @param string $date
     *
     * @return Carbon
     */
    private function getDate(string $date): Carbon
    {
        return Carbon::parse($date);
    }
}
