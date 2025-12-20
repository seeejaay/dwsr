<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

Route::apiResource('sites', SiteController::class);