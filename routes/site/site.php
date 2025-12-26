<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

Route::controller(SiteController::class)->prefix('sites')
->group(function(){
    Route::post('export', [SiteController::class, 'export']);
});


Route::apiResource('sites', SiteController::class);