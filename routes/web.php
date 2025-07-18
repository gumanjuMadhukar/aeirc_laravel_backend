<?php

use App\Http\Controllers\ImpersonationController;



use App\Livewire\Admin\Clients;
use App\Livewire\Admin\Clients\CreateClient;
use App\Livewire\Admin\Clients\EditClient;
use App\Livewire\Admin\Clients\ViewClient;

use App\Livewire\Admin\Contacts;
use App\Livewire\Admin\Contacts\CreateContact;
use App\Livewire\Admin\Contacts\EditContact;
use App\Livewire\Admin\Contacts\ViewContact;

use App\Livewire\Admin\Contents;
use App\Livewire\Admin\Contents\CreateContent;
use App\Livewire\Admin\Contents\EditContent;
use App\Livewire\Admin\Contents\ViewContent;
use App\Livewire\Admin\GalleryList;
use App\Livewire\Admin\GalleryList\CreateGallery;
use App\Livewire\Admin\GalleryList\EditGallery;
use App\Livewire\Admin\GalleryList\ViewGallery;

use App\Livewire\Admin\Index;
use App\Livewire\Admin\NAvigations;
use App\Livewire\Admin\Navigations\CreateNavigation;
use App\Livewire\Admin\Navigations\EditNavigation;
use App\Livewire\Admin\Navigations\ViewNavigation;
use App\Livewire\Admin\Products;
use App\Livewire\Admin\Products\CreateProduct;
use App\Livewire\Admin\Products\EditProduct;
use App\Livewire\Admin\Products\ViewProduct;

use App\Livewire\Admin\Faqs;
use App\Livewire\Admin\Faqs\CreateFaq;
use App\Livewire\Admin\Faqs\EditFaq;
use App\Livewire\Admin\Faqs\ViewFaq;

use App\Livewire\Admin\Services;
use App\Livewire\Admin\Services\CreateService;
use App\Livewire\Admin\Services\EditService;
use App\Livewire\Admin\Services\ViewService;

use App\Livewire\Admin\Banners;
use App\Livewire\Admin\Banners\CreateBanner;
use App\Livewire\Admin\Banners\EditBanner;
use App\Livewire\Admin\Banners\ViewBanner;

use App\Livewire\Admin\Sitesettings;
use App\Livewire\Admin\Sitesettings\CreateSitesetting;
use App\Livewire\Admin\Sitesettings\EditSitesetting;
use App\Livewire\Admin\Sitesettings\ViewSitesetting;
use App\Livewire\Admin\Teams;
use App\Livewire\Admin\Teams\CreateTeam;
use App\Livewire\Admin\Teams\EditTeam;
use App\Livewire\Admin\Teams\ViewTeam;

use App\Livewire\Admin\Users;
use App\Livewire\Admin\Users\CreateUser;
use App\Livewire\Admin\Users\EditUser;
use App\Livewire\Admin\Users\ViewUser;

use App\Livewire\Admin\WhyusList;
use App\Livewire\Admin\WhyusList\CreateWhyus;
use App\Livewire\Admin\WhyusList\EditWhyus;
use App\Livewire\Admin\WhyusList\ViewWhyus;

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
    Route::get('settings/password', Password::class)->name('settings.password');
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


        //service management
        Route::get('/services', Services::class)
            ->name('services.index')
            ->middleware('can:view services');

        Route::get('/services/create', CreateService::class)
            ->name('services.create')
            ->middleware('can:create services');

        Route::get('/services/{service}', ViewService::class)
            ->name('services.show')
            ->middleware('can:view services');

        Route::get('/services/{service}/edit', EditService::class)
            ->name('services.edit')
            ->middleware('can:update services');


        // Whyus management routes
        Route::get('/whyusList', WhyusList::class)
            ->name('whyusList.index')
            ->middleware('can:view whyus');

        Route::get('/whyusList/create', CreateWhyus::class)
            ->name('whyusList.create')
            ->middleware('can:create whyus');

        Route::get('/whyusList/{whyus}', ViewWhyus::class)
            ->name('whyusList.show')
            ->middleware('can:view whyus');

        Route::get('/whyusList/{whyus}/edit', EditWhyus::class)
            ->name('whyusList.edit')
            ->middleware('can:update whyus');


        // Faq management routes
        Route::get('/faqs', Faqs::class)
            ->name('faqs.index')
            ->middleware('can:view faq');

        Route::get('/faqs/create', CreateFaq::class)
            ->name('faqs.create')
            ->middleware('can:create faq');

        Route::get('/faqs/{faq}', ViewFaq::class)
            ->name('faqs.show')
            ->middleware('can:view faq');

        Route::get('/faqs/{faq}/edit', EditFaq::class)
            ->name('faqs.edit')
            ->middleware('can:update faq');


        // Product management routes
        Route::get('/products', Products::class)
            ->name('products.index')
            ->middleware('can:view products');

        Route::get('/products/create', CreateProduct::class)
            ->name('products.create')
            ->middleware('can:create products');

        Route::get('/products/{product}', ViewProduct::class)
            ->name('products.show')
            ->middleware('can:view products');

        Route::get('/products/{product}/edit', EditProduct::class)
            ->name('products.edit')
            ->middleware('can:update products');


        // Gallery management routes
        Route::get('/galleryList', GalleryList::class)
            ->name('galleryList.index')
            ->middleware('can:view galleryList');

        Route::get('/galleryList/create', CreateGallery::class)
            ->name('galleryList.create')
            ->middleware('can:create galleryList');

        Route::get('/galleryList/{gallery}', ViewGallery::class)
            ->name('galleryList.show')
            ->middleware('can:view galleryList');

        Route::get('/galleryList/{gallery}/edit', EditGallery::class)
            ->name('galleryList.edit')
            ->middleware('can:update galleryList');

        // Client management routes
        Route::get('/clients', Clients::class)
            ->name('clients.index')
            ->middleware('can:view clients');
    
        Route::get('/clients/create', CreateClient::class)
            ->name('clients.create')
            ->middleware('can:create clients');
    
        Route::get('/clients/{client}', ViewClient::class)
            ->name('clients.show')
            ->middleware('can:view clients');
    
        Route::get('/clients/{client}/edit', EditClient::class)
            ->name('clients.edit')
            ->middleware('can:update clients');

        // Team management routes
        Route::get('/teams', Teams::class)
            ->name('teams.index')
            ->middleware('can:view teams');
    
        Route::get('/teams/create', CreateTeam::class)
            ->name('teams.create')
            ->middleware('can:create teams');
    
        Route::get('/teams/{team}', ViewTeam::class)
            ->name('teams.show')
            ->middleware('can:view teams');
    
        Route::get('/teams/{team}/edit', EditTeam::class)
            ->name('teams.edit')
            ->middleware('can:update teams');

        // Contact management routes
        Route::get('/contacts', Contacts::class)
            ->name('contacts.index')
            ->middleware('can:view contacts');
    
        Route::get('/contacts/create', CreateContact::class)
            ->name('contacts.create')
            ->middleware('can:create contacts');
    
        Route::get('/contacts/{contact}', ViewContact::class)
            ->name('contacts.show')
            ->middleware('can:view contacts');
    
        Route::get('/contacts/{contact}/edit', EditContact::class)
            ->name('contacts.edit')
            ->middleware('can:update contacts');

        // Content management routes
        Route::get('/contents', Contents::class)
            ->name('contents.index')
            ->middleware('can:view contents');
    
        Route::get('/contents/create', CreateContent::class)
            ->name('contents.create')
            ->middleware('can:create contents');
    
        Route::get('/contents/{content}', ViewContent::class)
            ->name('contents.show')
            ->middleware('can:view contents');
    
        Route::get('/contents/{content}/edit', EditContent::class)
            ->name('contents.edit')
            ->middleware('can:update contents');

        // Navigation management routes
        Route::get('/navigations', NAvigations::class)
            ->name('navigations.index')
            ->middleware('can:view navigations');
    
        Route::get('/navigations/create', CreateNavigation::class)
            ->name('navigations.create')
            ->middleware('can:create navigations');
    
        Route::get('/navigations/{navigation}', ViewNavigation::class)
            ->name('navigations.show')
            ->middleware('can:view navigations');
    
        Route::get('/navigations/{navigation}/edit', EditNavigation::class)
            ->name('navigations.edit')
            ->middleware('can:update navigations');

        // Sitesetting management routes
        Route::get('/sitesettings', Sitesettings::class)
            ->name('sitesettings.index')
            ->middleware('can:view sitesettings');
    
        Route::get('/sitesettings/create', CreateSitesetting::class)
            ->name('sitesettings.create')
            ->middleware('can:create sitesettings');
    
        Route::get('/sitesettings/{sitesetting}', ViewSitesetting::class)
            ->name('sitesettings.show')
            ->middleware('can:view sitesettings');
    
        Route::get('/sitesettings/{sitesetting}/edit', EditSitesetting::class)
            ->name('sitesettings.edit')
            ->middleware('can:update sitesettings');
    });
    

        

});

require __DIR__ . '/auth.php';
