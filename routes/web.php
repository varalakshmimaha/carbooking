<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\UserBookingController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/packages', [\App\Http\Controllers\PackageController::class, 'index'])->name('packages.index');
Route::get('/blog/{slug}', [\App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');

// Admin redirects
Route::get('/admin', function () {
    return redirect('/dashboard');
})->middleware('auth');

Route::get('/carbooking/admin', function () {
    return redirect('/dashboard');
})->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/user/dashboard', [UserDashboardController::class, 'index'])
    ->middleware('auth')
    ->name('user.dashboard');

// User Booking Flow
Route::get('/user/book-now', [UserBookingController::class, 'index'])
    ->name('user.booking.index');

Route::post('/user/book-now', [UserBookingController::class, 'store'])
    ->name('user.booking.store');

Route::post('/user/payment/verify', [UserBookingController::class, 'paymentVerify'])
    ->name('user.booking.payment.verify');

Route::get('/booking/success/{booking}', [UserBookingController::class, 'success'])
    ->name('booking.success');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Menu Management
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('menus', MenuController::class);
        Route::get('menus/{menu}/items', [MenuItemController::class, 'index'])->name('menus.items');
        Route::post('menus/{menu}/items', [MenuItemController::class, 'store'])->name('menus.items.store');
        Route::post('menu-items/reorder', [MenuItemController::class, 'reorder'])->name('menu-items.reorder');
        Route::put('menu-items/{item}', [MenuItemController::class, 'update'])->name('menu-items.update');
        Route::delete('menu-items/{item}', [MenuItemController::class, 'destroy'])->name('menu-items.destroy');

        // Trip Management
        Route::get('trips/export', [BookingController::class, 'export'])->name('trips.export');
        Route::resource('trips', BookingController::class);

        // Driver Management
        Route::resource('drivers', \App\Http\Controllers\Admin\DriverController::class);
        
        Route::patch('drivers/{driver}/verify', [\App\Http\Controllers\Admin\DriverController::class, 'verify'])->name('drivers.verify');
        Route::patch('drivers/{driver}/unverify', [\App\Http\Controllers\Admin\DriverController::class, 'unverify'])->name('drivers.unverify');

        // Customer Management
        Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class);
        Route::get('/states/{state}/cities', [\App\Http\Controllers\Admin\CustomerController::class, 'getCities']);

        // Package Management
        Route::resource('packages', \App\Http\Controllers\Admin\PackageController::class);
        Route::patch('packages/{package}/toggle', [\App\Http\Controllers\Admin\PackageController::class, 'toggleStatus'])->name('packages.toggle');

        // Driver Package Subscription
        Route::resource('driver-packages', \App\Http\Controllers\Admin\DriverPackageController::class);

        // Vehicle Management
        Route::resource('vehicles', \App\Http\Controllers\Admin\VehicleController::class);

        // Route Management
        Route::resource('routes', \App\Http\Controllers\Admin\RouteController::class);
        Route::post('routes/generate-content', [\App\Http\Controllers\Admin\RouteController::class, 'generateContent'])->name('routes.generate');

        // Rate Management
        Route::resource('rates', \App\Http\Controllers\Admin\RateController::class);

        // Setting Management
        Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
        Route::post('settings', [\App\Http\Controllers\Admin\SettingController::class, 'update'])->name('settings.update');

        // Page & Page Builder
        Route::resource('pages', \App\Http\Controllers\Admin\PageController::class);
        Route::get('pages/{page}/builder', [\App\Http\Controllers\Admin\PageBuilderController::class, 'show'])->name('pages.builder');
        Route::post('pages/{page}/builder/sections', [\App\Http\Controllers\Admin\PageBuilderController::class, 'addSection'])->name('pages.builder.add');
        Route::put('pages/sections/{section}', [\App\Http\Controllers\Admin\PageBuilderController::class, 'updateSection'])->name('pages.builder.update-section');
        Route::post('pages/{page}/builder/reorder', [\App\Http\Controllers\Admin\PageBuilderController::class, 'reorderSections'])->name('pages.builder.reorder');
        Route::get('pages/sections/{section}', [\App\Http\Controllers\Admin\PageBuilderController::class, 'getSection'])->name('pages.builder.get-section');
        Route::delete('pages/sections/{section}', [\App\Http\Controllers\Admin\PageBuilderController::class, 'removeSection'])->name('pages.builder.remove-section');
        // Website Content
        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
        
        // Blog
        Route::resource('blog-posts', \App\Http\Controllers\Admin\BlogPostController::class, ['names' => 'blog.posts']);
        Route::resource('blog-categories', \App\Http\Controllers\Admin\BlogCategoryController::class);
        Route::resource('blog-tags', \App\Http\Controllers\Admin\BlogTagController::class);

        // Testimonials
        Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class);

        // User Management
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    });
});



require __DIR__.'/auth.php';

Route::get('/test-menus', function () {
    return view('test-menus');
});

Route::get('/{slug}', [\App\Http\Controllers\PageController::class, 'show'])->name('pages.frontend.show');
