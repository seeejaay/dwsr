<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TankController;

Route::apiResource('tanks', TankController::class);