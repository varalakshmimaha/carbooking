<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    public function index()
    {
        $driver = Auth::guard('driver')->user();
        $trips = Booking::where('driver_id', $driver->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('driver.trips.index', compact('trips'));
    }

    public function show($id)
    {
        $driver = Auth::guard('driver')->user();
        $trip = Booking::where('id', $id)
            ->where('driver_id', $driver->id)
            ->firstOrFail();
            
        return view('driver.trips.show', compact('trip'));
    }

    public function startTrip(Request $request, $id)
    {
        $request->validate([
            'start_otp' => 'required|numeric|digits:6',
        ]);

        $driver = Auth::guard('driver')->user();
        $trip = Booking::where('id', $id)
            ->where('driver_id', $driver->id)
            ->firstOrFail();

        if ($trip->trip_start_otp != $request->start_otp) {
            return back()->withErrors(['start_otp' => 'Invalid OTP. Please ask the customer for the correct start OTP.']);
        }

        $trip->update([
            'status' => 'Running',
            'start_time' => now(),
        ]);

        return redirect()->route('driver.trips.show', $trip->id)->with('success', 'Trip started successfully!');
    }

    public function completeTrip(Request $request, $id)
    {
        $request->validate([
            'end_otp' => 'required|numeric|digits:6',
        ]);

        $driver = Auth::guard('driver')->user();
        $trip = Booking::where('id', $id)
            ->where('driver_id', $driver->id)
            ->firstOrFail();
            
        if ($trip->trip_end_otp != $request->end_otp) {
             return back()->withErrors(['end_otp' => 'Invalid OTP. Please ask the customer for the correct end OTP.']);
        }

        $trip->update([
            'status' => 'Completed',
            'end_time' => now(),
            'payment_status' => 'Paid' // Assuming cash payment on completion if not already paid
        ]);

        return redirect()->route('driver.dashboard')->with('success', 'Trip completed successfully!');
    }
}
