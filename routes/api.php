<?php

use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('banners', BannerController::class); 
Route::prefix('banners')->group(function () {
        Route::get('/page/{page}',[BannerController::class, 'index']);
});

Route::prefix('services')->group(function () {
    Route::get('/', [ServiceController::class, 'index']);   
    Route::get('/{id}', [ServiceController::class, 'show']); 
});