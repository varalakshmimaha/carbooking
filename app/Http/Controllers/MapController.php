<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Driver;
use App\Models\Vehicle;

class MapController extends Controller
{
    /**
     * Get nearby drivers.
     * Mocks real-time location by fetching active drivers with coordinates.
     */
    public function nearbyDrivers(Request $request)
    {
        // Lat/Lng from user request
        $lat = $request->query('lat');
        $lng = $request->query('lng');
        
        // Radius in km (optional, default 10)
        $radius = 50; 

        // In a real app, use Haversine formula to filter by distance.
        // For MVP, just return all 'online/active' drivers with location data.
        
        $drivers = Driver::where('status', 'active')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->select('id', 'name', 'latitude', 'longitude')
            ->get();

        // Attach vehicle type info if possible
        $data = $drivers->map(function($driver) {
             // Assuming One-to-One relationship or finding vehicle where driver_id matches
             // For now, simpler:
             $vehicle = Vehicle::where('driver_id', $driver->id)->with('vehicleType')->first();
             
             return [
                 'id' => $driver->id,
                 'lat' => (float)$driver->latitude,
                 'lng' => (float)$driver->longitude,
                 'name' => $driver->name . ($vehicle ? ' (' . $vehicle->vehicleType->name . ')' : ''),
                 'type' => $vehicle ? $vehicle->vehicleType->name : 'Car',
                 'icon' => $vehicle ? asset('storage/' . $vehicle->vehicleType->icon) : null // Or use a default car icon
             ];
        });

        return response()->json($data);
    }
}
