<?php

use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\FaqController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\WhyusController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Get authenticated user (requires Sanctum token)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Banner Routes
// Route::apiResource('banners', BannerController::class); 
Route::prefix('banners')->group(function () {
    Route::get('/page/{page}', [BannerController::class, 'index']);
});

// Service Routes
Route::prefix('services')->group(function () {
    Route::get('/', [ServiceController::class, 'index']);     // get all services
    Route::get('/{id}', [ServiceController::class, 'show']);  // get services by id
});

// Whyus Routes
Route::prefix('whyus')->group(function () {
    Route::get('/', [WhyusController::class, 'index']);       // Get all Whyus
    Route::get('/{id}', [WhyusController::class, 'show']);    // Get Whyus by ID
});

// FAQ Routes
Route::prefix('faqs')->group(function () {
    Route::get('/', [FaqController::class, 'index']);         // Get all FAQs
    Route::get('/{id}', [FaqController::class, 'show']);      // Get FAQ by ID
});

// Product Routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index']);     // Get all products
    Route::get('/{id}', [ProductController::class, 'show']);  // Get single product by ID});
});
