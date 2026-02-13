<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Driver;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with(['customer', 'driver', 'vehicle', 'vehicleType']);

        // Filter by Booking ID
        if ($request->filled('booking_id')) {
            $query->where('id', $request->booking_id);
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by Verification Status
        if ($request->filled('verification_status')) {
            $query->where('verification_status', $request->verification_status);
        }

        $bookings = $query->latest()->paginate(15);
        
        return view('admin.trips.index', compact('bookings'));
    }

    public function export()
    {
        // Simple CSV export
        $bookings = Booking::with(['customer', 'driver'])->get();
        
        $filename = 'trips_export_' . date('Y-m-d_His') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($bookings) {
            $file = fopen('php://output', 'w');
            
            // Header row
            fputcsv($file, ['Booking ID', 'Customer', 'Pickup', 'Drop', 'Date', 'Amount', 'Status', 'Verification Status']);
            
            // Data rows
            foreach ($bookings as $booking) {
                fputcsv($file, [
                    $booking->id,
                    $booking->customer->name ?? 'N/A',
                    $booking->pickup_location,
                    $booking->drop_location,
                    $booking->book_date->format('Y-m-d H:i'),
                    $booking->amount,
                    $booking->status,
                    $booking->verification_status,
                ]);
            }
            
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function create()
    {
        $customers = Customer::all();
        $drivers = Driver::where('status', 'active')->get();
        $vehicleTypes = VehicleType::all();
        $packages = \App\Models\Package::all();
        return view('admin.trips.create', compact('customers', 'drivers', 'vehicleTypes', 'packages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'rental_type' => 'required',
            'pickup_location' => 'required',
            'drop_location' => 'required',
            'drop_locations' => 'nullable|array',
            'book_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:book_date',
            'amount' => 'required|numeric|min:0',
            'status' => 'required',
            'verification_status' => 'required',
            'cab_type' => 'nullable',
            'driver_id' => 'nullable|exists:drivers,id',
            'vehicle_type_id' => 'nullable|exists:vehicle_types,id',
            'package_id' => 'nullable|exists:packages,id',
        ]);

        if ($request->has('drop_locations')) {
            $validated['drop_locations'] = $request->drop_locations;
        }

        $booking = Booking::create($validated);

        if ($request->wantsJson()) {
            return response()->json(['message' => 'Trip Created Successfully', 'booking' => $booking]);
        }

        return redirect()->route('admin.trips.index')->with('success', 'Trip Created Successfully');
    }

    public function show($id)
    {
        $booking = Booking::with(['customer', 'driver', 'vehicle'])->findOrFail($id);
        return view('admin.trips.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = Booking::findOrFail($id);
        $customers = Customer::all();
        $drivers = Driver::where('status', 'active')->get();
        $vehicleTypes = VehicleType::all();
        $packages = \App\Models\Package::all();
        return view('admin.trips.edit', compact('booking', 'customers', 'drivers', 'vehicleTypes', 'packages'));
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'rental_type' => 'required',
            'pickup_location' => 'required',
            'drop_location' => 'required',
            'drop_locations' => 'nullable|array',
            'book_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:book_date',
            'amount' => 'required|numeric|min:0',
            'status' => 'required',
            'verification_status' => 'required',
            'cab_type' => 'nullable',
            'vehicle_type_id' => 'nullable|exists:vehicle_types,id',
            'package_id' => 'nullable|exists:packages,id',
            'driver_id' => 'nullable|exists:drivers,id',
            'trip_start_otp' => 'nullable|string',
            'trip_end_otp' => 'nullable|string',
            'documents.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf,doc,docx|max:10240', // 10MB max
        ]);

        // OTPs
        $validated['trip_start_otp'] = $request->trip_start_otp;
        $validated['trip_end_otp'] = $request->trip_end_otp;

        // Handle Documents Upload
        if ($request->hasFile('documents')) {
            $uploadedDocs = [];
            foreach ($request->file('documents') as $file) {
                $path = $file->store('trip_documents', 'public');
                $uploadedDocs[] = $path;
            }
            
            // Merge with existing if any (assuming JSON column)
            $existingDocs = is_array($booking->documents) ? $booking->documents : json_decode($booking->documents, true) ?? [];
            $validated['documents'] = array_merge($existingDocs, $uploadedDocs);
        }

        if ($request->has('drop_locations')) {
            $validated['drop_locations'] = $request->drop_locations;
        }

        $booking->update($validated);

        return redirect()->route('admin.trips.index')->with('success', 'Trip Updated Successfully');
    }

    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->route('admin.trips.index')->with('success', 'Trip Deleted Successfully');
    }
}
