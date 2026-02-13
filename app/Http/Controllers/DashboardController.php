<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Redirect non-admin users to user dashboard
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }
        
        if (!$user->is_admin) {
            return redirect()->route('user.dashboard');
        }

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
