<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $driver = Auth::guard('driver')->user();
        
        // Get current active ride if any (Confirmed or Running)
        $activeRide = Booking::where('driver_id', $driver->id)
            ->whereIn('status', ['Confirmed', 'Running'])
            ->latest()
            ->first();
            
        // Get recent completed rides for history
        $recentRides = Booking::where('driver_id', $driver->id)
            ->where('status', 'Completed')
            ->latest()
            ->take(5)
            ->get();

        // Counts for Status Cards
        $totalRides = Booking::where('driver_id', $driver->id)->count();
        $pendingRidesCount = Booking::where('driver_id', $driver->id)->where('status', 'Confirmed')->count(); // Using Confirmed as "Pending" for driver (assigned but not started)
        $runningRidesCount = Booking::where('driver_id', $driver->id)->where('status', 'Running')->count();
        $completedRidesCount = Booking::where('driver_id', $driver->id)->where('status', 'Completed')->count();

        return view('driver.dashboard', compact('driver', 'activeRide', 'recentRides', 'totalRides', 'pendingRidesCount', 'runningRidesCount', 'completedRidesCount'));
    }

    public function toggleStatus(Request $request)
    {
        $driver = Auth::guard('driver')->user();
        $driver->is_online = !$driver->is_online;
        $driver->save();

        return back()->with('success', 'You are now ' . ($driver->is_online ? 'Online' : 'Offline'));
    }
}
