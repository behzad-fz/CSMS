<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RateController extends Controller
{
    public function rate()
    {
        return response()->json(['message' => "test if it is successful"], 200);
    }
}
