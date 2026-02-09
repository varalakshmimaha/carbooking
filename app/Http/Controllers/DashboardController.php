<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_trips' => Booking::count(),
            'total_drivers' => Driver::count(),
            'total_vehicles' => Vehicle::count(),
            'total_customers' => Customer::count(),
        ];

        $upcomingBookings = Booking::with(['customer', 'driver', 'vehicle'])
            ->whereIn('status', ['Pending', 'Confirmed'])
            ->where('book_date', '>', now())
            ->orderBy('book_date', 'asc')
            ->paginate(5);

        $runningBookings = Booking::with(['customer', 'driver', 'vehicle'])
            ->where('status', 'Confirmed')
            ->whereDate('book_date', now()->toDateString())
            ->orderBy('book_date', 'desc')
            ->get();

        return view('dashboard', compact('stats', 'upcomingBookings', 'runningBookings'));
    }
}
