<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DriverPackage;
use App\Models\Driver;
use App\Models\Package;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DriverPackageController extends Controller
{
    public function index(Request $request)
    {
        $query = DriverPackage::with(['driver', 'package']);

        if ($request->filled('driver_id')) {
            $query->where('driver_id', $request->driver_id);
        }

        if ($request->filled('package_id')) {
            $query->where('package_id', $request->package_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $driverPackages = $query->latest()->paginate(10);
        
        $drivers = Driver::orderBy('name')->get();
        $packages = Package::where('status', 'active')->orderBy('name')->get();
        
        return view('admin.driver_packages.index', compact('driverPackages', 'drivers', 'packages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'package_id' => 'required|exists:packages,id',
            'description' => 'nullable|string|max:500'
        ]);

        $package = Package::findOrFail($validated['package_id']);
        
        // Rule: One driver can have only one Active package. Mark old ones as expired.
        DriverPackage::where('driver_id', $validated['driver_id'])
            ->where('status', 'active')
            ->update(['status' => 'expired']);

        $startDate = Carbon::now();
        $endDate = $startDate->copy()->addDays($package->days);

        DriverPackage::create([
            'driver_id' => $validated['driver_id'],
            'package_id' => $validated['package_id'],
            'amount' => $package->amount,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'description' => $validated['description'],
            'status' => 'active'
        ]);

        return redirect()->route('admin.driver-packages.index')->with('success', 'Package added successfully');
    }

    public function update(Request $request, DriverPackage $driverPackage)
    {
        $validated = $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'package_id' => 'required|exists:packages,id',
            'description' => 'nullable|string|max:500',
            'status' => 'required|in:active,inactive,expired'
        ]);

        $package = Package::findOrFail($validated['package_id']);
        
        // If changing to active, deactivate others
        if ($validated['status'] === 'active' && $driverPackage->status !== 'active') {
             DriverPackage::where('driver_id', $validated['driver_id'])
                ->where('status', 'active')
                ->where('id', '!=', $driverPackage->id)
                ->update(['status' => 'expired']);
        }

        // Only update dates if package changed
        if ($driverPackage->package_id != $validated['package_id']) {
            $startDate = Carbon::now();
            $endDate = $startDate->copy()->addDays($package->days);
            $driverPackage->amount = $package->amount;
            $driverPackage->start_date = $startDate;
            $driverPackage->end_date = $endDate;
        }

        $driverPackage->update([
            'driver_id' => $validated['driver_id'],
            'package_id' => $validated['package_id'],
            'description' => $validated['description'],
            'status' => $validated['status']
        ]);

        return redirect()->route('admin.driver-packages.index')->with('success', 'Package updated successfully');
    }

    public function destroy(DriverPackage $driverPackage)
    {
        $driverPackage->delete();
        return back()->with('success', 'Package deleted successfully');
    }

    /**
     * Get Package Info via AJAX
     */
    public function getPackageInfo($id)
    {
        $package = Package::find($id);
        if (!$package) return response()->json(['error' => 'Not found'], 404);
        
        return response()->json([
            'amount' => $package->amount,
            'days' => $package->days
        ]);
    }
}
