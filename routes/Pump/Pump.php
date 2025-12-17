<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PumpController;


Route::apiResource('pumps', PumpController::class);