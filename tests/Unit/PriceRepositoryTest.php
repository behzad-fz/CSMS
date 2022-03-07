<?php

namespace Tests\Unit;

use App\Repositories\PriceRepository;
use App\Repositories\RepositoryContract;
use PHPUnit\Framework\TestCase;

class PriceRepositoryTest extends TestCase
{
    /**
     * create new instance of repository
     *
     * @return void
     */
    public function test_create_new_instance()
    {
        $repository = new PriceRepository();

        $this->assertInstanceOf(RepositoryContract::class, $repository);
    }

    public function test_add_new_component()
    {
        $repository = new PriceRepository();

        $repository->addComponentPrice('tax', 3.77);

        $this->assertEquals(3.77, $repository->getPriceByType('tax'));
    }

    public function test_get_overall()
    {
        $repository = new PriceRepository();

        $repository->addComponentPrice('tax', 3.77);
        $repository->addComponentPrice('transaction', 2);
        $repository->addComponentPrice('energy', 5);

        $this->assertEquals(10.77, $repository->overall());
    }

    public function test_get_detailed_receipt()
    {
        $repository = new PriceRepository();

        $repository->addComponentPrice('tax', 3.77);
        $repository->addComponentPrice('transaction', 2);
        $repository->addComponentPrice('energy', 5);

        $this->assertIsArray($repository->detailedReceipt());
        $this->assertArrayHasKey('overall', $repository->detailedReceipt());
        $this->assertArrayHasKey('components', $repository->detailedReceipt());
        $this->assertEquals(10.77, $repository->detailedReceipt()['overall']);

        $expected['tax'] = 3.77;
        $expected['transaction'] = 2;
        $expected['energy'] = 5;

        $this->assertEquals($expected , $repository->detailedReceipt()['components']);
    }
}
