<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VarianceController;


Route::apiResource('variances', VarianceController::class);