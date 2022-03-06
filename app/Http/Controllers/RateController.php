<?php

namespace App\Http\Controllers;

use App\Http\Requests\CdrRequest;
use Illuminate\Http\JsonResponse;

class RateController extends Controller
{
    /**
     * @param CdrRequest $request
     * @return JsonResponse
     */
    public function applyRateToCdr(CdrRequest $request): JsonResponse
    {
        return response()->json(['message' => "test if it is successful"], 200);
    }
}
