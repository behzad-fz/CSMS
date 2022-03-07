<?php

namespace App\Repositories;

class PriceRepository implements RepositoryContract
{
    const OVERALL_DECIMAL_PLACES = 2;

    private array $components = [];

    public function addComponentPrice(string $name, float $price): void
    {
        $this->components[$name] = $price;
    }

    public function getPriceByType(string $name): float
    {
        return $this->components[$name];
    }

    public function overall(): float
    {
        $overall = 0;

        foreach ($this->components as $component) {
            $overall += $component;
        }

        return round($overall, self::OVERALL_DECIMAL_PLACES);
    }


    public function detailedReceipt(): array
    {
        return [
            'overall' => $this->overall(),
            'components' => $this->components
        ];
    }
}
