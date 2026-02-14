@extends('layouts.frontend')

@section('title', 'Book a Ride')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-4xl mx-auto px-6">
        
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-indigo-600 p-6 text-white text-center">
                <h1 class="text-3xl font-bold">Book Your Ride</h1>
                <p class="text-indigo-100 mt-2">Choose your trip type and get an instant estimate</p>
            </div>

            <!-- Booking Form -->
            <div class="p-8">
                <form action="{{ route('user.booking.store') }}" method="POST" x-data="{ 
                    tripType: '{{ request('package_id') ? 'local' : request('trip_type', 'oneway') }}',
                    vehicleType: '{{ request('vehicle_type_id', '') }}',
                    packageId: '{{ request('package_id', '') }}',
                    pickup: '{{ request('pickup_location', '') }}',
                    drop: '{{ request('drop_location', '') }}',
                    date: '{{ request('pickup_date', '') && request('pickup_time', '') ? request('pickup_date').'T'.request('pickup_time') : '' }}',
                    fareEstimate: {{ request('estimated_amount', 0) }},
                    paymentMethod: 'razorpay',
                    
                    updateFare() {
                        // Basic estimation logic (mock for now without Google Maps)
                        // In reality, this would call an API with distance
                        if (!this.vehicleType) return;
                        
                        let baseRate = 0;
                        // Example rates hardcoded for demo simplicity, ideally fetch from backend props
                        switch(this.tripType) {
                            case 'oneway': baseRate = 15; break; // per km
                            case 'roundtrip': baseRate = 12; break; // lower per km
                            case 'local': baseRate = 1200; break; // fixed 4hr package
                            case 'airport': baseRate = 800; break; // fixed drop
                        }
                        
                        // Fake distance for demo
                        let cleaningFee = 50;
                        if (this.tripType === 'local') this.fareEstimate = baseRate;
                        else if (this.tripType === 'airport') this.fareEstimate = baseRate;
                        else this.fareEstimate = (baseRate * 10) + cleaningFee; // Assume 10km trip
                    }
                }">
                    @csrf

                    @if ($errors->any())
                        <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-xl">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                                    <div class="mt-2 text-sm text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Trip Type Tabs -->
                    <div class="flex border-b border-gray-200 mb-6 space-x-8">
                        <button type="button" @click="tripType = 'oneway'; updateFare()" 
                            :class="{'border-b-2 border-indigo-600 text-indigo-600': tripType === 'oneway', 'text-gray-500 hover:text-gray-700': tripType !== 'oneway'}"
                            class="pb-4 font-semibold text-lg transition-colors focus:outline-none">
                            One Way
                        </button>
                        <button type="button" @click="tripType = 'roundtrip'; updateFare()"
                            :class="{'border-b-2 border-indigo-600 text-indigo-600': tripType === 'roundtrip', 'text-gray-500 hover:text-gray-700': tripType !== 'roundtrip'}"
                            class="pb-4 font-semibold text-lg transition-colors focus:outline-none">
                            Round Trip
                        </button>
                        <button type="button" @click="tripType = 'local'; updateFare()"
                            :class="{'border-b-2 border-indigo-600 text-indigo-600': tripType === 'local', 'text-gray-500 hover:text-gray-700': tripType !== 'local'}"
                            class="pb-4 font-semibold text-lg transition-colors focus:outline-none">
                            Rental
                        </button>
                        <button type="button" @click="tripType = 'airport'; updateFare()"
                            :class="{'border-b-2 border-indigo-600 text-indigo-600': tripType === 'airport', 'text-gray-500 hover:text-gray-700': tripType !== 'airport'}"
                            class="pb-4 font-semibold text-lg transition-colors focus:outline-none">
                            Airport
                        </button>
                    </div>

                    <input type="hidden" name="trip_type" x-model="tripType">

                    @guest
                    <!-- Guest Contact Details -->
                    <div class="mb-8 p-4 bg-yellow-50 rounded-xl border border-yellow-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Your Contact Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Name</label>
                                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Enter your full name"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" name="phone" value="{{ old('phone') }}" required placeholder="Enter phone number" 
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Email Address</label>
                                <input type="email" name="email" value="{{ old('email') }}" required placeholder="Enter email address"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">These details will be used for booking confirmation and driver communication.</p>
                    </div>
                    @endguest

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Pickup Location -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pickup Location</label>
                            <input type="text" name="pickup_location" x-model="pickup" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Enter city, hotel, or address">
                        </div>

                        <!-- Drop Location (Hidden for Rental) -->
                        <div x-show="tripType !== 'local'">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Drop Location</label>
                            <input type="text" name="drop_location" x-model="drop" 
                                :required="tripType !== 'local'"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                placeholder="Enter destination">
                        </div>

                        <!-- Rental (Visible only for Rental) -->
                        <div x-show="tripType === 'local'">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Rental Package</label>
                            <select name="package_id" x-model="packageId" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                @foreach($packages as $pkg)
                                    <option value="{{ $pkg->id }}">{{ $pkg->name }} ({{ $pkg->days }} days)</option>
                                @endforeach
                                <option value="">Custom (4hrs / 40km)</option>
                            </select>
                        </div>

                        <!-- Date & Time -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Pickup Date & Time</label>
                            <input type="datetime-local" name="book_date" x-model="date" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <!-- Vehicle Type -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Select Vehicle Class</label>
                            <select name="vehicle_type_id" x-model="vehicleType" @change="updateFare()" required
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">-- Choose Car Type --</option>
                                @foreach($vehicleTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }} ({{ $type->seating_capacity }} Seats)</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Fare Estimate Box -->
                    <div x-show="vehicleType && pickup" class="bg-gray-50 rounded-xl p-6 mb-8 border border-gray-200">
                        <h3 class="font-bold text-gray-900 mb-2">Fare Estimate</h3>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 text-sm">Estimated Total</span>
                            <span class="text-3xl font-bold text-indigo-600">₹<span x-text="fareEstimate"></span></span>
                        </div>
                        <p class="text-xs text-gray-400 mt-2">* Final fare may vary based on actual distance and waiting time.</p>
                        <input type="hidden" name="estimated_amount" x-model="fareEstimate">
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-8">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Payment Method</label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors" :class="{'border-indigo-600 bg-indigo-50': paymentMethod === 'razorpay'}">
                                <input type="radio" name="payment_method" value="razorpay" x-model="paymentMethod" class="text-indigo-600 focus:ring-indigo-500 h-5 w-5">
                                <span class="ml-3 font-medium text-gray-900">Pay Now (Razorpay)</span>
                            </label>
                            <label class="flex items-center p-4 border rounded-xl cursor-pointer hover:bg-gray-50 transition-colors" :class="{'border-indigo-600 bg-indigo-50': paymentMethod === 'cash'}">
                                <input type="radio" name="payment_method" value="cash" x-model="paymentMethod" class="text-indigo-600 focus:ring-indigo-500 h-5 w-5">
                                <span class="ml-3 font-medium text-gray-900">Pay Later (Cash)</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-indigo-700 transition-shadow shadow-lg hover:shadow-xl">
                        <span x-show="paymentMethod === 'razorpay'">Proceed to Pay ₹<span x-text="fareEstimate"></span></span>
                        <span x-show="paymentMethod !== 'razorpay'">Book Ride Now</span>
                    </button>

                </form>
            </div>
        </div>

    </div>
</div>
@endsection
