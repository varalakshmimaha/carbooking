<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Vehicle::with(['vehicleType', 'driver']);

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('plate_number', 'like', '%' . $request->search . '%')
                  ->orWhere('cab_number', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('type')) {
            $query->where('vehicle_type_id', $request->type);
        }

        $vehicles = $query->latest()->paginate(10);
        $vehicleTypes = VehicleType::all();

        return view('admin.vehicles.index', compact('vehicles', 'vehicleTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehicleTypes = VehicleType::all();
        $drivers = Driver::orderBy('name')->get();
        return view('admin.vehicles.create', compact('vehicleTypes', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'cab_name' => 'required|string|max:255',
            'model_year' => 'required|string|max:4',
            'cab_number' => 'required|string|unique:vehicles,cab_number|max:20',
            'chassis_number' => 'nullable|string|max:50',
            'cab_color' => 'required|string|max:30',
            'with_carrier' => 'required|in:Yes,No',
            'fuel_type' => 'required|string',
            'seating_capacity' => 'required|integer',
            'status' => 'required|in:active,inactive',
            
            // Image Uploads
            'vehicle_image' => 'nullable|image|max:2048',
            'rc_book_image' => 'nullable|image|max:2048',
            'rc_book_back_image' => 'nullable|image|max:2048',
            'insurance_image' => 'nullable|image|max:2048',
            'puc_image' => 'nullable|image|max:2048',
            'fitness_certificate' => 'nullable|image|max:2048',
            'car_permit' => 'nullable|image|max:2048',

            // Checkboxes or Selects for verification (mapping to the UI)
            'vehicle_image_verified' => 'required|in:Verified,Unverified,Pending',
            'rc_book_image_verified' => 'required|in:Verified,Unverified,Pending',
            'rc_book_back_image_verified' => 'required|in:Verified,Unverified,Pending',
            'insurance_image_verified' => 'required|in:Verified,Unverified,Pending',
            'puc_image_verified' => 'required|in:Verified,Unverified,Pending',
            'fitness_certificate_verified' => 'required|in:Verified,Unverified,Pending',
            'car_permit_verified' => 'required|in:Verified,Unverified,Pending',
        ]);

        // Legacy compatibility
        $validated['name'] = $validated['cab_name'];
        $validated['model'] = $validated['model_year'];
        $validated['plate_number'] = $validated['cab_number'];

        $imageFields = ['vehicle_image', 'rc_book_image', 'rc_book_back_image', 'insurance_image', 'puc_image', 'fitness_certificate', 'car_permit'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('vehicles/' . $field, 'public');
            }
        }

        Vehicle::create($validated);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle added successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        $vehicleTypes = VehicleType::all();
        $drivers = Driver::orderBy('name')->get();
        return view('admin.vehicles.edit', compact('vehicle', 'vehicleTypes', 'drivers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'cab_name' => 'required|string|max:255',
            'model_year' => 'required|string|max:4',
            'cab_number' => 'required|string|max:20|unique:vehicles,cab_number,' . $vehicle->id,
            'chassis_number' => 'nullable|string|max:50',
            'cab_color' => 'required|string|max:30',
            'with_carrier' => 'required|in:Yes,No',
            'fuel_type' => 'required|string',
            'seating_capacity' => 'required|integer',
            'status' => 'required|in:active,inactive',
            
            // Image Uploads
            'vehicle_image' => 'nullable|image|max:2048',
            'rc_book_image' => 'nullable|image|max:2048',
            'rc_book_back_image' => 'nullable|image|max:2048',
            'insurance_image' => 'nullable|image|max:2048',
            'puc_image' => 'nullable|image|max:2048',
            'fitness_certificate' => 'nullable|image|max:2048',
            'car_permit' => 'nullable|image|max:2048',

            // Verification Statuses
            'vehicle_image_verified' => 'required|in:Verified,Unverified,Pending',
            'rc_book_image_verified' => 'required|in:Verified,Unverified,Pending',
            'rc_book_back_image_verified' => 'required|in:Verified,Unverified,Pending',
            'insurance_image_verified' => 'required|in:Verified,Unverified,Pending',
            'puc_image_verified' => 'required|in:Verified,Unverified,Pending',
            'fitness_certificate_verified' => 'required|in:Verified,Unverified,Pending',
            'car_permit_verified' => 'required|in:Verified,Unverified,Pending',
        ]);

        $validated['name'] = $validated['cab_name'];
        $validated['model'] = $validated['model_year'];
        $validated['plate_number'] = $validated['cab_number'];

        $imageFields = ['vehicle_image', 'rc_book_image', 'rc_book_back_image', 'insurance_image', 'puc_image', 'fitness_certificate', 'car_permit'];
        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                if ($vehicle->$field) {
                    Storage::disk('public')->delete($vehicle->$field);
                }
                $validated[$field] = $request->file($field)->store('vehicles/' . $field, 'public');
            }
        }

        $vehicle->update($validated);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        $imageFields = ['vehicle_image', 'rc_book_image', 'rc_book_back_image', 'insurance_image', 'puc_image', 'fitness_certificate', 'car_permit'];
        foreach ($imageFields as $field) {
            if ($vehicle->$field) {
                Storage::disk('public')->delete($vehicle->$field);
            }
        }
        $vehicle->delete();
        return redirect()->route('admin.vehicles.index')->with('success', 'Vehicle deleted successfully');
    }
}
