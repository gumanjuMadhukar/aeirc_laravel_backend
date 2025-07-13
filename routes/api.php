<?php

use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Get authenticated user (requires Sanctum token)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Banner Routes
// Route::apiResource('banners', BannerController::class); 
Route::prefix('banners')->group(function () {
        Route::get('/page/{page}',[BannerController::class, 'index']);
});

// Service Routes
Route::prefix('services')->group(function () {
    Route::get('/', [ServiceController::class, 'index']);     // get all services
    Route::get('/{id}', [ServiceController::class, 'show']);  // get services by id
});

// Whyus Routes
