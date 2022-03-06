<?php

namespace App\Services;

interface HandlerContract
{
    public function calculate(mixed $start, mixed $stop, float $rate): float;
}
