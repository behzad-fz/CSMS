<?php

namespace App\Services;

class EnergyHandler implements HandlerContract
{
    const K = 1000;
    const COMPONENT_DECIMAL_PLACES = 3;

    public function calculate(mixed $meterStart, mixed $meterStop, float $rate): float
    {
        $energy = $this->consumed($meterStart, $meterStop);

        $cost = ($energy / self::K) * $rate ;

        return round($cost, self::COMPONENT_DECIMAL_PLACES);
    }

    private function consumed(int $meterStart, int $meterStop): int
    {
        return $meterStop - $meterStart;
    }
}
