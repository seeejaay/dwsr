<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaxTypeController;

Route::apiResource('tax-types', TaxTypeController::class);