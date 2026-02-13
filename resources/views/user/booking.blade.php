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
                    tripType: '{{ request('trip_type', 'oneway') }}',
                    vehicleType: '{{ request('vehicle_type_id', '') }}',
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
                            <select name="package_id" class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
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
