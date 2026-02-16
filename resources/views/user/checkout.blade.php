@extends('layouts.frontend')

@section('title', 'Checkout')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumbs -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="/" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-indigo-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <a href="{{ url()->previous() }}" class="ml-1 text-sm font-medium text-gray-700 hover:text-indigo-600 md:ml-2">Vehicle Selection</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Checkout</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Booking Summary -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden sticky top-8">
                    <div class="p-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Your Booking Details</h2>
                        
                        <!-- Vehicle Info -->
                        <div class="mb-6">
                            <div class="h-40 bg-gray-100 rounded-lg overflow-hidden mb-3 flex items-center justify-center">
                                @if($vehicleType->image)
                                    <img src="{{ asset('storage/' . $vehicleType->image) }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-16 h-16 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 012-2v0m12 0a2 2 0 012 2v0m-2-2h2a1 1 0 011 1v1a1 1 0 01-1 1h-2.28a1 1 0 01-.948-.684l-.3-.924" /></svg>
                                @endif
                            </div>
                            <h3 class="font-bold text-gray-900 text-lg">{{ $vehicleType->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $vehicleType->seating_capacity }} Seater • {{ ucfirst(request('trip_type')) }}</p>
                        </div>

                        <hr class="border-gray-100 my-4">

                        <!-- Trip Details -->
                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Pickup</span>
                                <span class="font-medium text-gray-900 text-right truncate w-32" title="{{ request('pickup_location') }}">{{ request('pickup_location') }}</span>
                            </div>
                            @if(request('drop_location'))
                            <div class="flex justify-between">
                                <span class="text-gray-500">Drop</span>
                                <span class="font-medium text-gray-900 text-right truncate w-32" title="{{ request('drop_location') }}">{{ request('drop_location') }}</span>
                            </div>
                            @endif
                            <div class="flex justify-between">
                                <span class="text-gray-500">Date & Time</span>
                                <span class="font-medium text-gray-900 text-right">
                                    {{ \Carbon\Carbon::parse(request('pickup_date'))->format('M d, Y') }}<br>
                                    {{ request('pickup_time') }}
                                </span>
                            </div>
                            @if(request('trip_type') == 'local' && $package)
                            <div class="flex justify-between">
                                <span class="text-gray-500">Package</span>
                                <span class="font-medium text-gray-900 text-right">{{ $package->name }}</span>
                            </div>
                            @endif
                            <!-- KMs Included Row -->
                            <div class="flex justify-between">
                                <span class="text-gray-500">KMs Included</span>
                                <span class="font-medium text-gray-900 text-right">
                                    {{ request('trip_type') == 'local' ? '80' : '100' }} Km
                                </span>
                            </div>
                        </div>

                        <hr class="border-gray-100 my-4">

                        <!-- Pricing -->
                            <div class="flex justify-between mb-2">
                                <span class="text-gray-600">Total Estimate</span>
                                <span class="font-bold text-gray-900">₹{{ number_format((float)$estimate, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-500 text-xs mt-2 pt-2 border-t border-gray-200">
                                <span>Payable Amount</span>
                                <span>₹{{ number_format((float)$estimate, 2) }}</span>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <!-- Right Column: Form -->
            <div class="lg:col-span-2">
                <form action="{{ route('user.booking.store') }}" method="POST" class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                    @csrf
                    <!-- Hidden inputs -->
                    <input type="hidden" name="trip_type" value="{{ request('trip_type') }}">
                    <input type="hidden" name="pickup_location" value="{{ request('pickup_location') }}">
                    <input type="hidden" name="drop_location" value="{{ request('drop_location') }}">
                    <input type="hidden" name="vehicle_type_id" value="{{ $vehicleType->id }}">
                    <input type="hidden" name="package_id" value="{{ request('package_id') }}">
                    <input type="hidden" name="estimated_amount" value="{{ $estimate }}">
                    <input type="hidden" name="book_date" value="{{ request('pickup_date') . ' ' . request('pickup_time') }}">

                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mr-3 text-sm">1</span>
                        Contact Information
                    </h2>
                    
                    @guest
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Full Name</label>
                            <input type="text" name="name" required class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors" placeholder="e.g. John Doe">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Mobile Number</label>
                            <input type="tel" name="phone" required class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors" placeholder="e.g. 9876543210">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 mb-2">Email Address</label>
                            <input type="email" name="email" required class="w-full px-4 py-3 border border-gray-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors" placeholder="e.g. john@example.com">
                        </div>
                    </div>
                    @else
                    <div class="bg-blue-50 p-4 rounded-lg mb-8 flex items-center">
                        <div class="mr-4">
                            <div class="h-10 w-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                        </div>
                        <div>
                            <p class="font-bold text-gray-900">Logged in as {{ Auth::user()->name }}</p>
                            <p class="text-sm text-gray-600">{{ Auth::user()->email }} • {{ Auth::user()->phone }}</p>
                        </div>
                    </div>
                    @endguest

                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center mr-3 text-sm">2</span>
                        Payment Method
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                        <label class="relative flex p-4 cursor-pointer rounded-xl border border-gray-200 hover:border-indigo-500 transition-colors group">
                            <input type="radio" name="payment_method" value="razorpay" class="peer h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500 mt-1" checked>
                            <div class="ml-3">
                                <span class="block text-sm font-bold text-gray-900 group-hover:text-indigo-600">Pay Online (Razorpay)</span>
                                <span class="block text-xs text-gray-500">Secure payment via UPI, Cards, Netbanking</span>
                            </div>
                        </label>
                        <label class="relative flex p-4 cursor-pointer rounded-xl border border-gray-200 hover:border-indigo-500 transition-colors group">
                            <input type="radio" name="payment_method" value="cash" class="peer h-4 w-4 text-indigo-600 border-gray-300 focus:ring-indigo-500 mt-1">
                            <div class="ml-3">
                                <span class="block text-sm font-bold text-gray-900 group-hover:text-indigo-600">Pay to Driver (Cash)</span>
                                <span class="block text-xs text-gray-500">Pay cash after the trip ends</span>
                            </div>
                        </label>
                    </div>

                    <div class="pt-6 border-t border-gray-100">
                        <button type="submit" class="w-full bg-indigo-600 text-white py-4 rounded-xl font-bold text-lg hover:bg-indigo-700 transition-all shadow-lg hover:shadow-xl flex justify-center items-center">
                            Confirm Booking
                            <svg class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                        </button>
                        <p class="text-center text-xs text-gray-400 mt-4">By booking, you agree to our Terms & Conditions and Privacy Policy.</p>
                    </div>

                </form>

                <!-- Information Tabs -->
                <div class="mt-8 bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden" x-data="{ tab: 'inclusions' }">
                    <div class="flex border-b border-gray-100">
                        <button @click="tab = 'inclusions'" :class="{'text-indigo-600 border-indigo-600 bg-indigo-50': tab === 'inclusions', 'text-gray-500 border-transparent hover:text-gray-700': tab !== 'inclusions'}" class="flex-1 py-4 px-6 text-sm font-bold border-b-2 transition-colors">Inclusions</button>
                        <button @click="tab = 'exclusions'" :class="{'text-indigo-600 border-indigo-600 bg-indigo-50': tab === 'exclusions', 'text-gray-500 border-transparent hover:text-gray-700': tab !== 'exclusions'}" class="flex-1 py-4 px-6 text-sm font-bold border-b-2 transition-colors">Exclusions</button>
                        <button @click="tab = 'terms'" :class="{'text-indigo-600 border-indigo-600 bg-indigo-50': tab === 'terms', 'text-gray-500 border-transparent hover:text-gray-700': tab !== 'terms'}" class="flex-1 py-4 px-6 text-sm font-bold border-b-2 transition-colors">T&C</button>
                    </div>
                    <div class="p-6 text-sm text-gray-600">
                        <div x-show="tab === 'inclusions'" class="space-y-2">
                            <p>✅ Fuel Charges</p>
                            <p>✅ Driver Allowance</p>
                            <p>✅ Toll & State Tax (If specified)</p>
                            <p>✅ Clean & Sanitized Car</p>
                        </div>
                        <div x-show="tab === 'exclusions'" class="space-y-2" style="display: none;">
                            <p>❌ Parking Fees (to be paid by customer at actuals)</p>
                            <p>❌ Entry Fees for tourist spots</p>
                            <p>❌ GST (Unless explicitly mentioned)</p>
                        </div>
                        <div x-show="tab === 'terms'" class="space-y-2" style="display: none;">
                            <p>• One day means a calendar day from 12 AM to 12 PM.</p>
                            <p>• KM calculation starts from our garage to garage.</p>
                            <p>• Extra KM limit charges apply post package limits.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
