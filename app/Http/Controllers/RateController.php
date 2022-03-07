<?php

namespace App\Http\Controllers;

use App\Http\Requests\CdrRequest;
use App\Http\Resources\InvoiceResource;
use App\Services\RateCalculator;
use Illuminate\Http\Resources\Json\JsonResource;

class RateController extends Controller
{
    public function __construct(
        private RateCalculator $rateCalculator,
    ) {}

    /**
     * @param CdrRequest $request
     * @return JsonResource
     */
    public function applyRateToCdr(CdrRequest $request): JsonResource
    {
        return new InvoiceResource($this->rateCalculator->getInvoice($request));
    }
}
