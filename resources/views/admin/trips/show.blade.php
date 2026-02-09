<x-app-layout>
    <div class="py-8 bg-gray-50">
        <div class="max-w-4xl mx-auto px-6">
            
            <!-- Header -->
            <div class="mb-6 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Trip Details</h1>
                    <nav class="text-sm text-gray-600 mt-1">
                        <a href="{{ route('admin.trips.index') }}" class="hover:text-gray-900">All Trips</a>
                        <span class="mx-2">/</span>
                        <span class="text-gray-900">Trip #{{ $booking->id }}</span>
                    </nav>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('admin.trips.edit', $booking) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                        Edit Trip
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
                    <h2 class="text-lg font-semibold text-gray-800">Booking Information</h2>
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                        {{ $booking->status === 'Confirmed' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $booking->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $booking->status === 'Cancelled' ? 'bg-red-100 text-red-800' : '' }}
                        {{ $booking->status === 'Completed' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ $booking->status === 'Running' ? 'bg-purple-100 text-purple-800' : '' }}">
                        {{ $booking->status }}
                    </span>
                </div>
                
                <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Customer Details -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Customer</h3>
                        <p class="text-gray-900 font-semibold text-lg">{{ $booking->customer->name ?? 'N/A' }}</p>
                        <p class="text-gray-600 text-sm">{{ $booking->customer->email ?? '' }}</p>
                        <p class="text-gray-600 text-sm">{{ $booking->customer->phone ?? '' }}</p>
                    </div>

                    <!-- Driver Details -->
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 mb-1">Driver</h3>
                        @if($booking->driver)
                            <p class="text-gray-900 font-semibold text-lg">{{ $booking->driver->name }}</p>
                            <p class="text-gray-600 text-sm">{{ $booking->driver->phone }}</p>
                            <p class="text-gray-600 text-sm">Vehicle: {{ $booking->vehicle->name ?? 'N/A' }} - {{ $booking->vehicle->plate_number ?? 'N/A' }}</p>
                        @else
                            <p class="text-gray-500 italic">No driver assigned</p>
                        @endif
                    </div>

                    <!-- Trip Details -->
                    <div class="col-span-2 border-t border-gray-100 pt-4 mt-2">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 mb-1">Trip Type</h3>
                                <p class="text-gray-900">{{ $booking->rental_type }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 mb-1">Cab Type</h3>
                                <p class="text-gray-900">{{ $booking->cab_type ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 mb-1">Pickup Location</h3>
                                <p class="text-gray-900">{{ $booking->pickup_location }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 mb-1">Dropoff Location</h3>
                                <p class="text-gray-900">{{ $booking->drop_location }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 mb-1">Start Date</h3>
                                <p class="text-gray-900">{{ $booking->book_date->format('d M Y, h:i A') }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 mb-1">End Date</h3>
                                <p class="text-gray-900">{{ $booking->end_date ? $booking->end_date->format('d M Y, h:i A') : 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Details -->
                    <div class="col-span-2 border-t border-gray-100 pt-4 mt-2">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 mb-1">Total Amount</h3>
                                <p class="text-gray-900 font-bold text-xl">₹{{ number_format($booking->amount, 2) }}</p>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500 mb-1 text-right">Verification</h3>
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $booking->verification_status === 'Verified' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $booking->verification_status }}
                                </span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
