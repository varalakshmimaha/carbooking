@extends('layouts.frontend')

@section('title', 'Booking Confirmed')

@section('content')
<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-3xl mx-auto px-6">
        
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden text-center p-8">
            
            <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Booking Confirmed!</h1>
            <p class="text-gray-500 mb-8">Thank you, {{ $booking->customer->name ?? 'Guest' }}. Your ride has been booked successfully.</p>
            
            <div class="bg-gray-50 rounded-xl p-6 text-left mb-8 border border-gray-100">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                    <div class="sm:col-span-2 border-b border-gray-200 pb-4 mb-2">
                        <dt class="text-xs uppercase tracking-wide text-gray-500 font-bold mb-1">Vehicle Details</dt>
                        <dd class="text-xl font-bold text-gray-900 flex items-center">
                            {{ $booking->vehicleType->name ?? 'Car' }}
                            <span class="ml-2 text-sm font-normal text-gray-500">({{ $booking->rental_type }})</span>
                        </dd>
                    </div>

                    <div>
                        <dt class="text-sm font-medium text-gray-500">Booking ID</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900">#{{ $booking->id }}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-500">Amount</dt>
                        <dd class="mt-1 text-lg font-semibold text-indigo-600">₹{{ number_format($booking->amount) }}</dd>
                    </div>

                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Pickup Date & Time</dt>
                        <dd class="mt-1 text-lg font-semibold text-gray-900">
                            {{ \Carbon\Carbon::parse($booking->book_date)->format('d M Y, h:i A') }}
                        </dd>
                    </div>

                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Pickup Location</dt>
                        <dd class="mt-1 text-base text-gray-900">{{ $booking->pickup_location }}</dd>
                    </div>

                    @if($booking->drop_location && $booking->drop_location !== 'Rental')
                    <div class="sm:col-span-2">
                        <dt class="text-sm font-medium text-gray-500">Drop Location</dt>
                        <dd class="mt-1 text-base text-gray-900">{{ $booking->drop_location }}</dd>
                    </div>
                    @endif
                    
                    <div class="sm:col-span-2 pt-4 border-t border-gray-200 mt-2">
                        <dt class="text-sm font-medium text-gray-500">Start / End OTP (Share with Driver)</dt>
                        <div class="flex space-x-4 mt-2">
                            <div class="bg-blue-50 px-3 py-1 rounded text-blue-700 font-mono font-bold">Start: {{ $booking->trip_start_otp }}</div>
                            <div class="bg-red-50 px-3 py-1 rounded text-red-700 font-mono font-bold">End: {{ $booking->trip_end_otp }}</div>
                        </div>
                    </div>
                </dl>
            </div>
            
            <div class="flex flex-col sm:flex-row justify-center space-y-4 sm:space-y-0 sm:space-x-4">
                <a href="{{ url('/') }}" class="bg-gray-100 text-gray-700 px-8 py-3 rounded-xl font-bold hover:bg-gray-200 transition-colors">
                    Back to Home
                </a>
                <!-- Optional: Print/Download button -->
            </div>

        </div>
    </div>
</div>
@endsection
