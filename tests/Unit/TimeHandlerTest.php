<?php

namespace Tests\Unit;

use App\Services\HandlerContract;
use App\Services\TimeHandler;
use PHPUnit\Framework\TestCase;

class TimeHandlerTest extends TestCase
{
    /**
     * create new instance of service
     *
     * @return void
     */
    public function test_create_new_instance()
    {
        $handler = new TimeHandler();

        $this->assertInstanceOf(HandlerContract::class, $handler);
    }

    public function test_calculate_energy_cost()
    {
        $handler = new TimeHandler();

        $this->assertEquals(2.767, $handler->calculate("2021-04-05T10:04:00Z", "2021-04-05T11:27:00Z", 2));
    }
}
