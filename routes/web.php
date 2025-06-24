<?php

use App\Http\Controllers\ImpersonationController;
use App\Livewire\Admin\Banners;
use App\Livewire\Admin\Banners\CreateBanner;
use App\Livewire\Admin\Banners\EditBanner;
use App\Livewire\Admin\Banners\ViewBanner;
use App\Livewire\Admin\Index;
use App\Livewire\Admin\Users;
use App\Livewire\Admin\Users\CreateUser;
use App\Livewire\Admin\Users\EditUser;
use App\Livewire\Admin\Users\ViewUser;
use App\Livewire\Dashboard;
use App\Livewire\Home;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Locale;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');

Route::get('/dashboard', Dashboard::class)->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function (): void {

    // Impersonations
    Route::post('/impersonate/{user}', [ImpersonationController::class, 'store'])->name('impersonate.store')->middleware('can:impersonate');
    Route::delete('/impersonate/stop', [ImpersonationController::class, 'destroy'])->name('impersonate.destroy');

    // Settings
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password',Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    Route::get('settings/locale', Locale::class)->name('settings.locale');

    // Admin
    Route::prefix('admin')->as('admin.')->group(function (): void {
        Route::get('/', Index::class)->middleware(['auth', 'verified'])->name('index')->middleware('can:access dashboard');
        Route::get('/users', Users::class)->name('users.index')->middleware('can:view users');
        Route::get('/users/create', CreateUser::class)->name('users.create')->middleware('can:create users');
        Route::get('/users/{user}', ViewUser::class)->name('users.show')->middleware('can:view users');
        Route::get('/users/{user}/edit', EditUser::class)->name('users.edit')->middleware('can:update users');
       
        Route::get('/roles', \App\Livewire\Admin\Roles::class)->name('roles.index')->middleware('can:view roles');
        Route::get('/roles/create', \App\Livewire\Admin\Roles\CreateRole::class)->name('roles.create')->middleware('can:create roles');
        Route::get('/roles/{role}/edit', \App\Livewire\Admin\Roles\EditRole::class)->name('roles.edit')->middleware('can:update roles');
        
        Route::get('/permissions', \App\Livewire\Admin\Permissions::class)->name('permissions.index')->middleware('can:view permissions');
        Route::get('/permissions/create', \App\Livewire\Admin\Permissions\CreatePermission::class)->name('permissions.create')->middleware('can:create permissions');
        Route::get('/permissions/{permission}/edit', \App\Livewire\Admin\Permissions\EditPermission::class)->name('permissions.edit')->middleware('can:update permissions');


        // // Banner Management
        Route::get('/banners', Banners::class)
            ->name('banners.index')
            ->middleware('can:view banners');

        Route::get('/banners/create', CreateBanner::class)
            ->name('banners.create')
            ->middleware('can:create banners');

        Route::get('/banners/{banner}', ViewBanner::class)
            ->name('banners.show')
            ->middleware('can:view banners');

        Route::get('/banners/{banner}/edit', EditBanner::class)
            ->name('banners.edit')
            ->middleware('can:update banners');

    });

});

require __DIR__ . '/auth.php';
