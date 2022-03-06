<?php

namespace Tests\Unit;

use App\Services\EnergyHandler;
use App\Services\HandlerContract;
use PHPUnit\Framework\TestCase;

class EnergyHandlerTest extends TestCase
{
    /**
     * create new instance of service
     *
     * @return void
     */
    public function test_create_new_instance()
    {
        $handler = new EnergyHandler();

        $this->assertInstanceOf(HandlerContract::class, $handler);
    }

    public function test_calculate_energy_cost()
    {
        $handler = new EnergyHandler();

        $this->assertEquals(3.277, $handler->calculate(1204307, 1215230, 0.3));
    }
}
