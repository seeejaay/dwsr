<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdjustmentCategoryController;

Route::apiResource('adjustment-categories', AdjustmentCategoryController::class);