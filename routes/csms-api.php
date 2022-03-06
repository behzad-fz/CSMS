<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RateController;

/*
|--------------------------------------------------------------------------
| CSMS Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for CSMS.
|
*/

Route::post('/rate', [RateController::class, 'applyRateToCdr']);
