<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\MenuApiController;
use App\Http\Controllers\Api\SearchController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/menus/{key}', [MenuApiController::class, 'show']);
Route::post('/search', [SearchController::class, 'search']);

// Trip Management Dropdowns
Route::get('/customers', function() {
    return \App\Models\Customer::select('id', 'name', 'phone')->get();
});
Route::get('/drivers', function() {
    return \App\Models\Driver::where('status', 'active')->select('id', 'name')->get();
});
Route::get('/cab-types', function() {
    return \App\Models\VehicleType::select('id', 'name')->get();
});
Route::post('/trips', [\App\Http\Controllers\BookingController::class, 'store']);

// Location Dropdowns
Route::get('/states', function() {
    return \App\Models\State::select('id', 'name')->get();
});
Route::get('/cities', function(\Illuminate\Http\Request $request) {
    return \App\Models\City::where('state_id', $request->state_id)
        ->select('id', 'name')->get();
});

// Driver Management API
Route::get('/admin/drivers', [\App\Http\Controllers\Admin\DriverController::class, 'apiList']);
