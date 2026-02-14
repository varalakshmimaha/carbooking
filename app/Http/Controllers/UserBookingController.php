<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Package;
use App\Models\Rate;
use App\Models\VehicleType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBookingController extends Controller
{
    public function index(Request $request)
    {
        // 1. If searching via home page (has params but no vehicle selected)
        if ($request->has('trip_type') && !$request->has('vehicle_type_id')) {
            $searchResults = $this->getMockSearchResults($request);
            return view('user.booking_results', compact('searchResults'));
        }

        // 2. Default Loading (Manual selection) or Final Step (Vehicle selected)
        $vehicleTypes = VehicleType::where('status', 'active')->get();
        $packages = Package::where('status', 'active')->get();

        // Fetch rates for estimation logic
        $rates = Rate::where('status', 'active')->get()->groupBy('vehicle_type_id');
        
        return view('user.booking', compact('vehicleTypes', 'packages', 'rates'));
    }

    private function getMockSearchResults(Request $request)
    {
        // Fetch specific 3 types requested (or first 3)
        $vehicleTypes = VehicleType::where('status', 'active')
            ->take(3)
            ->get();

        $results = [];
        foreach ($vehicleTypes as $type) {
            // Mock Calculation Logic (Dummy Data)
            $baseFare = $type->base_fare > 0 ? $type->base_fare : 500;
            $perKm = $type->per_km_rate > 0 ? $type->per_km_rate : 15;
            $distance = 25; // Mock distance in km
            
            $estimate = $baseFare + ($distance * $perKm);
            
            if ($request->trip_type == 'airport') $estimate = $baseFare + 800; // Flat additional
            if ($request->trip_type == 'roundtrip') $estimate = ($estimate * 2) * 0.9; // Return + discount
            if ($request->trip_type == 'local') $estimate = 2000; // Fixed package

            $results[] = [
                'type' => $type,
                'estimate' => round($estimate),
                'eta' => rand(5, 15) . ' mins',
                'features' => ['AC', '4 Seats', 'Luggage Space'] // Dummy features
            ];
        }
        return $results;
    }

    public function store(Request $request)
    {
        // define rules
        $rules = [
            'trip_type' => 'required|in:oneway,roundtrip,local,airport',
            'pickup_location' => 'required|string',
            'drop_location' => 'nullable|string', 
            'book_date' => 'required|date|after:now',
            'vehicle_type_id' => 'required|exists:vehicle_types,id',
            'package_id' => 'nullable|exists:packages,id',
            'estimated_distance' => 'nullable|numeric',
            'estimated_duration' => 'nullable|numeric',
            'estimated_amount' => 'nullable|numeric|min:0',
            'payment_method' => 'required|in:razorpay,cash',
        ];

        // Add guest validation
        if (!Auth::check()) {
            $rules['name'] = 'required|string|max:255';
            $rules['email'] = 'required|email|max:255';
            $rules['phone'] = 'required|string|max:20';
        }

        $validated = $request->validate($rules);

        // Handle Customer Creation
        if (Auth::check()) {
            $user = Auth::user();
            $customer = Customer::firstOrCreate(
                ['phone' => $user->phone],
                [
                    'name' => $user->name,
                    'email' => $user->email,
                    'address' => 'Not provided'
                ]
            );
        } else {
            $customer = Customer::firstOrCreate(
                ['phone' => $validated['phone']],
                [
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'address' => 'Guest'
                ]
            );
        }

        $vehicleType = VehicleType::find($validated['vehicle_type_id']);

        $tripTypeMap = [
            'oneway' => 'One Way',
            'roundtrip' => 'Round Trip',
            'local' => 'Rental',
            'airport' => 'Airport Pickup',
        ];

        // Create booking
        $booking = Booking::create([
            'customer_id' => $customer->id,
            'rental_type' => $tripTypeMap[$validated['trip_type']] ?? ucfirst($validated['trip_type']),
            'pickup_location' => $validated['pickup_location'],
            'drop_location' => $validated['drop_location'] ?? 'Rental',
            'book_date' => $validated['book_date'],
            'vehicle_type_id' => $validated['vehicle_type_id'],
            'package_id' => $validated['package_id'] ?? null,
            'cab_type' => $vehicleType ? $vehicleType->name : null, // Legacy field
            'amount' => $validated['estimated_amount'] ?? 0, 
            'status' => 'Pending',
            'payment_status' => 'Unpaid',
            'payment_method' => ucfirst($validated['payment_method']),
            'trip_start_otp' => rand(100000, 999999), 
            'trip_end_otp' => rand(100000, 999999),
        ]);

        if ($validated['payment_method'] === 'razorpay' && $booking->amount > 0) {
            $key = config('services.razorpay.key');
            $secret = config('services.razorpay.secret');

            // DEV BYPASS: Check if using placeholder/test keys
            $isTestMode = empty($key) || str_contains($key, 'YOUR_KEY_HERE');

            if ($isTestMode) {
                // Mock Order for Development
                $razorpayOrder = (object) [
                    'id' => 'order_' . \Illuminate\Support\Str::random(10),
                    'amount' => $booking->amount * 100,
                    'status' => 'created',
                ];
                $booking->update(['transaction_id' => $razorpayOrder->id]);

                return view('user.payment', [
                    'order' => $razorpayOrder,
                    'booking' => $booking,
                    'amount' => $booking->amount,
                    'isTestMode' => true
                ]);
            }

            // Real Production Flow
            $api = new \Razorpay\Api\Api($key, $secret);
            
            $orderData = [
                'receipt'         => 'booking_' . $booking->id,
                'amount'          => $booking->amount * 100, // INR in paise
                'currency'        => 'INR',
                'payment_capture' => 1 // Auto capture
            ];
            
            try {
                $razorpayOrder = $api->order->create($orderData);
                
                $booking->update(['transaction_id' => $razorpayOrder->id]);

                return view('user.payment', [
                    'order' => $razorpayOrder,
                    'booking' => $booking,
                    'amount' => $booking->amount,
                    'isTestMode' => false
                ]);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['error' => 'Payment creation failed: ' . $e->getMessage()])->withInput();
            }
        }

        if (Auth::check()) {
            return redirect()->route('user.dashboard', ['tab' => 'bookings'])->with('success', 'Booking request submitted successfully! Our team will contact you shortly.');
        } 
        
        return redirect()->route('booking.success', $booking->id);
    }

    public function paymentVerify(Request $request)
    {
        $success = true;
        $error = "Payment Failed";
        
        // Check for Mock Payment ID first
        if ($request->has('razorpay_payment_id') && str_contains($request->razorpay_payment_id, 'pay_mock_')) {
             if (empty(config('services.razorpay.key')) || str_contains(config('services.razorpay.key'), 'YOUR_KEY_HERE')) {
                  // Allow mock payment if config allows/matches placeholder
                  $success = true;
             } else {
                  $error = "Mock payments not allowed in production configuration.";
                  $success = false;
             }
        }
        else if (empty($request->razorpay_payment_id) === false) {
            $api = new \Razorpay\Api\Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            
            try {
                $attributes = [
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature
                ];
                
                $api->utility->verifyPaymentSignature($attributes);
            } catch(\Exception $e) {
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
            }
        }
        
        if ($success === true) {
            $booking = Booking::findOrFail($request->booking_id);
            $booking->update([
                'payment_status' => 'Paid',
                'transaction_id' => $request->razorpay_payment_id,
            ]);
            
            if (Auth::check()) {
                return redirect()->route('user.dashboard', ['tab' => 'bookings'])->with('success', 'Payment successful! Your booking is confirmed.');
            }
            return redirect()->route('booking.success', $booking->id);
        } else {
            return redirect()->route('user.booking.index')->withErrors(['error' => $error]);
        }
    }

    public function success($id)
    {
        $booking = Booking::with('vehicleType')->findOrFail($id);
        return view('booking.success', compact('booking'));
    }
}
