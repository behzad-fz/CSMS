<?php

namespace App\Services;

use Carbon\Carbon;

class TimeHandler implements HandlerContract
{
    const MINUTES_PER_HOUR = 60;
    const COMPONENT_DECIMAL_PLACES = 3;

    public function calculate(mixed $timestampStart, mixed $timestampStop, float $rate): float
    {
        $cost = $this->consumed($timestampStart, $timestampStop) * ($rate / self::MINUTES_PER_HOUR);

        return round($cost, self::COMPONENT_DECIMAL_PLACES);
    }

    public function consumed(string $timestampStart, string $timestampStop): int
    {
        $start = Carbon::create($timestampStart);
        $stop = Carbon::create($timestampStop);

        return $start->diffInMinutes($stop);
    }
}
