<?php

namespace App\Services;

use App\Repositories\PriceRepository;
use Illuminate\Http\Request;

class RateCalculator
{
    public function __construct(
        private PriceRepository $priceRepository,
        private EnergyHandler $energyHandler,
        private TimeHandler $timeHandler,
    ) {}

    public function getInvoice(Request $request): array
    {
        $this->fireHandlers($request);

        return $this->priceRepository->detailedReceipt();
    }

    private function fireHandlers($request)
    {
       $this->priceRepository->addComponentPrice('energy', $this->energyHandler->calculate(
            $request->input('cdr')['meterStart'],
            $request->input('cdr')['meterStop'],
            $request->input('rate')['energy']
        ));

        $this->priceRepository->addComponentPrice('time', $this->timeHandler->calculate(
            $request->input('cdr')['timestampStart'],
            $request->input('cdr')['timestampStop'],
            $request->input('rate')['time']
        ));

        $this->priceRepository->addComponentPrice('transaction', $request->input('rate')['transaction']);
    }
}
