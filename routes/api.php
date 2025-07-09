<?php

use App\Http\Controllers\API\BannerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::apiResource('banners', BannerController::class); 
Route::prefix('banners')->group(function () {
        Route::get('/page/{page}',[BannerController::class, 'index']);
});