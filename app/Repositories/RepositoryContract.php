<?php

namespace App\Repositories;

interface RepositoryContract
{
    public function addComponentPrice(string $name, float $price): void;

    public function getPriceByType(string $name): float;

    public function overall(): float;

    public function detailedReceipt(): array;
}
