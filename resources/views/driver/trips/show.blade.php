<x-driver-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Trip Details') }} #{{ $trip->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Status Header -->
                    <div class="flex justify-between items-center mb-6">
                        <span class="bg-blue-100 text-blue-800 text-sm font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                            {{ $trip->status }}
                        </span>
                        <div class="text-right">
                            <p class="text-xs text-gray-500 uppercase font-bold">Total Amount</p>
                            <p class="text-2xl font-bold text-gray-900">₹{{ number_format($trip->amount, 2) }}</p>
                            <p class="text-xs text-gray-500">{{ $trip->payment_status }} - {{ $trip->payment_method }}</p>
                        </div>
                    </div>

                    <!-- Customer Info -->
                    <div class="mb-8 border-b border-gray-100 pb-6">
                         <h3 class="text-lg font-bold text-gray-900 mb-4">Customer Details</h3>
                         <div class="flex items-center space-x-4">
                            <div class="bg-gray-100 h-12 w-12 rounded-full flex items-center justify-center text-gray-500 font-bold text-xl">
                                {{ substr($trip->customer->name ?? 'G', 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold text-gray-900">{{ $trip->customer->name ?? $trip->guest_name ?? 'Guest User' }}</p>
                                <a href="tel:{{ $trip->customer->phone ?? $trip->guest_phone }}" class="text-blue-600 font-semibold hover:underline">
                                    {{ $trip->customer->phone ?? $trip->guest_phone ?? '-' }}
                                </a>
                            </div>
                         </div>
                    </div>

                    <!-- Route Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                        <div>
                            <div class="flex items-start mb-4">
                                <div class="flex-shrink-0 mt-1 mr-3">
                                    <div class="h-3 w-3 rounded-full bg-green-500"></div>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-bold mb-1">Pickup Location</p>
                                    <p class="text-gray-900 font-medium">{{ $trip->pickup_location }}</p>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="flex items-start mb-4">
                                <div class="flex-shrink-0 mt-1 mr-3">
                                    <div class="h-3 w-3 rounded-full bg-red-500"></div>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-500 uppercase font-bold mb-1">Drop Location</p>
                                    <p class="text-gray-900 font-medium">{{ $trip->drop_location ?? 'Not Specified' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Area -->
                    <div class="bg-gray-50 rounded-xl p-6 border border-gray-100">
                        @if($trip->status === 'Confirmed')
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Start Trip</h3>
                            <p class="text-sm text-gray-500 mb-4">Ask customer for the Start OTP to begin the journey.</p>
                            
                            <form action="{{ route('driver.trips.start', $trip->id) }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="start_otp" class="sr-only">Start OTP</label>
                                    <input type="number" name="start_otp" id="start_otp" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-lg tracking-widest text-center" placeholder="Enter 6-digit OTP" required>
                                    @error('start_otp')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    VERIFY & START TRIP
                                </button>
                            </form>

                        @elseif($trip->status === 'Running')
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Trip in Progress</h3>
                            <div class="flex items-center text-sm text-gray-500 mb-6">
                                <svg class="w-5 h-5 mr-2 text-green-500 animate-pulse" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Started at {{ $trip->start_time ? Carbon\Carbon::parse($trip->start_time)->format('h:i A') : '-' }}
                            </div>

                            <p class="text-sm text-gray-500 mb-4">Enter End OTP provided by customer to complete the trip.</p>
                            
                            <form action="{{ route('driver.trips.complete', $trip->id) }}" method="POST" class="space-y-4">
                                @csrf
                                <div>
                                    <label for="end_otp" class="sr-only">End OTP</label>
                                    <input type="number" name="end_otp" id="end_otp" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-lg tracking-widest text-center" placeholder="Enter End OTP" required>
                                    @error('end_otp')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-bold text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                    COMPLETE TRIP
                                </button>
                            </form>
                        @elseif($trip->status === 'Completed')
                            <div class="text-center py-4">
                                <svg class="w-16 h-16 text-green-500 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <h3 class="text-xl font-bold text-gray-900">Trip Completed</h3>
                                <p class="text-gray-500 mt-2">Finished at {{ $trip->end_time ? Carbon\Carbon::parse($trip->end_time)->format('h:i A') : '-' }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-driver-layout>
