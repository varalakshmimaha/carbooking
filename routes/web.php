<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuItemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Menu Management
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('menus', MenuController::class);
        Route::get('menus/{menu}/items', [MenuItemController::class, 'index'])->name('menus.items');
        Route::post('menus/{menu}/items', [MenuItemController::class, 'store'])->name('menus.items.store');
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
    });
});

require __DIR__.'/auth.php';
