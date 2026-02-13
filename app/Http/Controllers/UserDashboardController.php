<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Find bookings linked to the user via email or phone match in customers table
        $customerIds = Customer::where('email', $user->email)
            ->orWhere('phone', $user->phone)
            ->pluck('id');

        $bookings = Booking::with(['driver', 'vehicle', 'vehicleType'])
            ->whereIn('customer_id', $customerIds)
            ->whereNull('package_id')
            ->orderBy('book_date', 'desc')
            ->get();

        $tourBookings = Booking::with(['package'])
            ->whereIn('customer_id', $customerIds)
            ->whereNotNull('package_id')
            ->orderBy('book_date', 'desc')
            ->get();

        return view('user.dashboard', compact('user', 'bookings', 'tourBookings'));
    }
}
