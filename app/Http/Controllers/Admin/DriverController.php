<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\DriverDocument;
use App\Models\State;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DriverController extends Controller
{
    public function index(Request $request)
    {
        $query = Driver::with(['state', 'city']);

        if ($request->driver_id) {
            $query->where('driver_code', 'like', '%' . $request->driver_id . '%');
        }
        if ($request->name) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->mobile) {
            $query->where('mobile', 'like', '%' . $request->mobile . '%');
        }
        if ($request->verified !== null && $request->verified !== 'all') {
            $query->where('verification_status', $request->verified);
        }

        $drivers = $query->latest()->paginate(10);
        
        // Data for filters
        $allDriverIds = Driver::select('driver_code')->distinct()->get();
        $allNames = Driver::select('name')->distinct()->get();
        $allMobiles = Driver::select('mobile')->distinct()->get();

        return view('admin.drivers.index', compact('drivers', 'allDriverIds', 'allNames', 'allMobiles'));
    }

    public function create()
    {
        $states = State::all();
        return view('admin.drivers.create', compact('states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|unique:drivers,mobile',
            'email' => 'nullable|email|unique:drivers,email',
            'password' => 'required|min:6',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'driver_photo' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            'aadhar_front' => 'required|image|mimes:jpeg,png,jpg,pdf|max:5120',
            'aadhar_back' => 'required|image|mimes:jpeg,png,jpg,pdf|max:5120',
            'dl_front' => 'required|image|mimes:jpeg,png,jpg,pdf|max:5120',
            'dl_back' => 'required|image|mimes:jpeg,png,jpg,pdf|max:5120',
        ]);

        $driverCode = '#' . rand(100000, 999999);
        while (Driver::where('driver_code', $driverCode)->exists()) {
            $driverCode = '#' . rand(100000, 999999);
        }

        $driver = Driver::create([
            'driver_code' => $driverCode,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'address' => $request->address,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'wallet_amount' => $request->wallet_amount ?? 0,
            'password' => $request->password,
            'verification_status' => $request->verification_status ?? 'not_verified',
        ]);

        $documents = new DriverDocument(['driver_id' => $driver->id]);

        $files = [
            'driver_photo', 'aadhar_front', 'aadhar_back', 
            'dl_front', 'dl_back', 'health_certificate', 'upi_qr_code'
        ];

        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                $path = $request->file($file)->store('driver_docs', 'public');
                $documents->$file = $path;
            }
        }

        $documents->save();

        return redirect()->route('admin.drivers.index')->with('success', 'Driver created successfully');
    }

    public function show(Driver $driver)
    {
        $driver->load(['state', 'city', 'documents']);
        return view('admin.drivers.show', compact('driver'));
    }

    public function edit(Driver $driver)
    {
        $driver->load(['state', 'city', 'documents']);
        $states = State::all();
        $cities = City::where('state_id', $driver->state_id)->get();
        return view('admin.drivers.edit', compact('driver', 'states', 'cities'));
    }

    public function update(Request $request, Driver $driver)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|string|unique:drivers,mobile,' . $driver->id,
            'email' => 'nullable|email|unique:drivers,email,' . $driver->id,
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
        ]);

        $data = $request->except(['password', 'verification_status']);
        if ($request->password) {
            $data['password'] = $request->password;
        }
        $data['verification_status'] = $request->verification_status ?? $driver->verification_status;

        $driver->update($data);

        $documents = $driver->documents ?: new DriverDocument(['driver_id' => $driver->id]);
        $files = ['driver_photo', 'aadhar_front', 'aadhar_back', 'dl_front', 'dl_back', 'health_certificate', 'upi_qr_code'];

        foreach ($files as $file) {
            if ($request->hasFile($file)) {
                // Delete old file
                if ($documents->$file) {
                    Storage::disk('public')->delete($documents->$file);
                }
                $documents->$file = $request->file($file)->store('driver_docs', 'public');
            }
        }
        $documents->save();

        return redirect()->route('admin.drivers.index')->with('success', 'Driver updated successfully');
    }

    public function verify(Driver $driver)
    {
        $driver->update(['verification_status' => 'verified']);
        return back()->with('success', 'Driver verified successfully');
    }

    public function unverify(Driver $driver)
    {
        $driver->update(['verification_status' => 'not_verified']);
        return back()->with('success', 'Driver unverified successfully');
    }

    public function destroy(Driver $driver)
    {
        if ($driver->documents) {
            $files = ['driver_photo', 'aadhar_front', 'aadhar_back', 'dl_front', 'dl_back', 'health_certificate', 'upi_qr_code'];
            foreach ($files as $file) {
                if ($driver->documents->$file) {
                    Storage::disk('public')->delete($driver->documents->$file);
                }
            }
        }
        $driver->delete();
        return back()->with('success', 'Driver deleted successfully');
    }

    public function apiList(Request $request)
    {
        $query = Driver::query();
        if ($request->verified === 'true') {
            $query->where('verification_status', 'verified');
        }
        return $query->select('id', 'name', 'mobile')->get();
    }
}
