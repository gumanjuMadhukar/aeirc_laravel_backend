<?php

use App\Http\Controllers\API\BannerController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\ContentController;
use App\Http\Controllers\API\FaqController;
use App\Http\Controllers\API\GalleryController;
use App\Http\Controllers\API\NavigationController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ServiceController;
use App\Http\Controllers\API\SitesettingController;
use App\Http\Controllers\API\TeamController;
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
// Gallery Routes
Route::prefix('galleryList')->group(function () {
    Route::get('/', [GalleryController::class, 'index']);     // Get all products
    Route::get('/{id}', [GalleryController::class, 'show']);  // Get single product by ID});
});
// Client Routes
Route::prefix('clients')->group(function () {
    Route::get('/', [ClientController::class, 'index']);     // Get all clinets
    Route::get('/{id}', [ClientController::class, 'show']);  // Get single clinet by ID});
});
// Team Routes
Route::prefix('teams')->group(function () {
    Route::get('/', [TeamController::class, 'index']);     // Get all teams
    Route::get('/{id}', [TeamController::class, 'show']);  // Get single team by ID});
});
// Contact Routes
Route::prefix('contacts')->group(function () {
    Route::get('/', [ContactController::class, 'index']);     // Get all contacts
    Route::get('/{id}', [ContactController::class, 'show']);  // Get single contact by ID});
});
// Content Routes
Route::prefix('contacts')->group(function () {
    Route::get('/', [ContentController::class, 'index']);     // Get all contents
    Route::get('/{id}', [ContentController::class, 'show']);  // Get single content by ID});
});
// Navigation Routes
Route::prefix('contacts')->group(function () {
    Route::get('/', [NavigationController::class, 'index']);     // Get all navigations
    Route::get('/{id}', [NavigationController::class, 'show']);  // Get single navigation by ID});
});
// Sitesetting Routes
Route::prefix('contacts')->group(function () {
    Route::get('/', [SitesettingController::class, 'index']);     // Get all sitesettings
    Route::get('/{id}', [SitesettingController::class, 'show']);  // Get single sitesetting by ID});
});
