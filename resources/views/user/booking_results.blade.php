@extends('layouts.frontend')

@section('title', 'Select Your Ride')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Search Summary -->
        <div class="bg-white rounded-xl shadow-sm p-6 mb-8 border border-gray-100 flex flex-col md:flex-row justify-between items-center">
            <div class="flex items-center space-x-4 mb-4 md:mb-0">
                <div class="bg-indigo-100 text-indigo-600 rounded-lg p-3">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-900 capitalize">{{ request('trip_type') }} Trip</h2>
                    <p class="text-gray-600 text-sm">
                        {{ request('pickup_location') }} 
                        @if(request('drop_location')) 
                            <span class="mx-2">→</span> {{ request('drop_location') }}
                        @endif
                    </p>
                    @if(request('pickup_date'))
                        <p class="text-gray-500 text-xs mt-1">{{ \Carbon\Carbon::parse(request('pickup_date'))->format('D, M d Y') }} @ {{ request('pickup_time') }}</p>
                    @endif
                </div>
            </div>
            <a href="/" class="text-indigo-600 font-semibold hover:text-indigo-800 text-sm">Modify Search</a>
        </div>

        <!-- Car Results Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach($searchResults as $result)
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-shadow duration-300 transform hover:-translate-y-1">
                <!-- Image -->
                <div class="h-48 bg-gray-100 flex items-center justify-center relative overflow-hidden">
                    @if($result['type']->image)
                        <img src="{{ asset('storage/' . $result['type']->image) }}" alt="{{ $result['type']->name }}" class="w-full h-full object-cover">
                    @else
                        <!-- Fallback / Dummy Image based on Type Name -->
                        @php
                            $defaultImage = match(strtolower($result['type']->name)) {
                                'hatchback' => 'https://example.com/hatchback.png', // Replace with local asset later if needed
                                'sedan' => 'https://example.com/sedan.png',
                                default => ''
                            };
                        @endphp
                        <div class="text-gray-400 flex flex-col items-center">
                            <svg class="w-20 h-20 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17a2 2 0 11-4 0 2 2 0 014 0zM19 17a2 2 0 11-4 0 2 2 0 014 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 012-2v0m12 0a2 2 0 012 2v0m-2-2h2a1 1 0 011 1v1a1 1 0 01-1 1h-2.28a1 1 0 01-.948-.684l-.3-.924" /></svg>
                            <span class="text-sm font-semibold">{{ $result['type']->name }} Image</span>
                        </div>
                    @endif
                    <div class="absolute top-4 right-4 bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded-full">
                        {{ $result['eta'] }} away
                    </div>
                </div>

                <!-- Content -->
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900">{{ $result['type']->name }} <span class="text-sm font-normal text-gray-500">({{ $result['type']->category ?? 'Standard' }})</span></h3>
                            <p class="text-gray-500 text-sm">{{ $result['type']->seating_capacity }} Seater • {{ $result['type']->model_year }}</p>
                        </div>
                        <div class="text-right">
                            <span class="block text-2xl font-bold text-gray-900 text-red-600">₹{{ $result['estimate'] }}</span>
                            <span class="text-xs text-gray-500"> / Up to {{ $result['kms_included'] }} Km</span>
                        </div>
                    </div>

                    <!-- Detailed Info List -->
                    <div class="space-y-2 mb-6 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Category :</span>
                            <span class="font-medium text-gray-900 capitalize">{{ request('trip_type') == 'local' ? 'Rental' : request('trip_type') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Advance Amount :</span>
                            <span class="font-bold text-gray-900">₹{{ round($result['estimate'] * 0.25) }}</span>
                        </div>
                    </div>

                    <!-- Features & Specs -->
                    <div class="flex flex-wrap items-center gap-4 mb-6 text-xs text-gray-600 bg-gray-50 p-3 rounded-lg">
                        <div class="flex items-center">
                             <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
                             {{ $result['type']->transmission }}
                        </div>
                         <div class="flex items-center">
                             <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                             {{ $result['type']->fuel_type }}
                        </div>
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                            {{ $result['type']->seating_capacity }} Persons
                        </div>
                         <div class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                            {{ $result['type']->model_year }}
                        </div>
                    </div>

                    <!-- Book Button -->
                    <form action="{{ route('user.booking.index') }}" method="GET">
                        <!-- Pass forward all search params -->
                        <input type="hidden" name="trip_type" value="{{ request('trip_type') }}">
                        <input type="hidden" name="pickup_location" value="{{ request('pickup_location') }}">
                        <input type="hidden" name="drop_location" value="{{ request('drop_location') }}">
                        <input type="hidden" name="pickup_date" value="{{ request('pickup_date') }}">
                        <input type="hidden" name="pickup_time" value="{{ request('pickup_time') }}">
                        <input type="hidden" name="package_id" value="{{ request('package_id') }}">
                        
                        <!-- Select Vehicle -->
                        <input type="hidden" name="vehicle_type_id" value="{{ $result['type']->id }}">
                        <input type="hidden" name="estimated_amount" value="{{ $result['estimate'] }}">

                        <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-xl font-bold hover:bg-indigo-700 transition-colors shadow-lg hover:shadow-xl flex justify-center items-center">
                            Select {{ $result['type']->name }}
                            <svg class="w-5 h-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" /></svg>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</div>
@endsection
