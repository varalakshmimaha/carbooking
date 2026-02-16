<x-app-layout>
    <div x-data="{ modelOpen: false, selectedBookingId: null }">
        <div class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            
            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">All Trips</h1>
                <nav class="text-sm text-gray-600 mt-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-900">All Trips</span>
                </nav>
            </div>

            <!-- Filters & Actions -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <form method="GET" action="{{ route('admin.trips.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    
                    <!-- Booking ID Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Booking ID</label>
                        <input type="text" name="booking_id" value="{{ request('booking_id') }}" placeholder="Enter Booking ID" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">All Status</label>
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Status</option>
                            <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Confirmed" {{ request('status') == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="Running" {{ request('status') == 'Running' ? 'selected' : '' }}>Running</option>
                            <option value="Completed" {{ request('status') == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" {{ request('status') == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <!-- Approval Status Filter -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">All Approval Status</label>
                        <select name="verification_status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">All Approval Status</option>
                            <option value="Verified" {{ request('verification_status') == 'Verified' ? 'selected' : '' }}>Verified</option>
                            <option value="Not Verified" {{ request('verification_status') == 'Not Verified' ? 'selected' : '' }}>Not Verified</option>
                        </select>
                    </div>

                    <!-- Filter Buttons -->
                    <div class="flex items-end space-x-2">
                        <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                            Filter
                        </button>
                        <a href="{{ route('admin.trips.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300 transition-colors">
                            Clear
                        </a>
                    </div>

                </form>

                <!-- Action Buttons Row -->
                <div class="flex justify-between items-center mt-6 pt-6 border-t border-gray-200">
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.trips.export') }}" class="px-6 py-2.5 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-colors flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export to Excel
                        </a>
                    </div>
                    <a href="{{ route('admin.trips.create') }}" class="px-6 py-2.5 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600 transition-colors flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Create Trip
                    </a>
                </div>
            </div>

            <!-- Trips Table -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Booking ID</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Car Name</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Rental Type</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Pickup / Delivery Location</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Dropoff Location</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Booked On</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Trip Start Otp</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Trip End Otp</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Approval</th>
                                <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($bookings as $booking)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-blue-600">#{{ $booking->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ optional($booking->vehicleType)->name ?? $booking->cab_type ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->rental_type }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($booking->pickup_location, 25) }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">{{ Str::limit($booking->drop_location ?? '-', 25) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $booking->book_date->format('d M Y') }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-mono font-bold text-indigo-600 bg-indigo-50 rounded-lg text-center">{{ $booking->trip_start_otp ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-mono font-bold text-purple-600 bg-purple-50 rounded-lg text-center">{{ $booking->trip_end_otp ?? '-' }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">₹{{ number_format($booking->amount, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $booking->status === 'Confirmed' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $booking->status === 'Pending' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $booking->status === 'Cancelled' ? 'bg-red-100 text-red-800' : '' }}
                                            {{ $booking->status === 'Completed' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $booking->status === 'Running' ? 'bg-purple-100 text-purple-800' : '' }}">
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $booking->verification_status === 'Verified' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                            {{ $booking->verification_status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('admin.trips.show', $booking) }}" class="text-blue-600 hover:text-blue-900" title="View Trip">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.trips.edit', $booking) }}" class="text-gray-600 hover:text-gray-900" title="Edit Trip">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.trips.destroy', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this trip?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" title="Delete Trip">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                            
                                            <!-- Assign Driver Button -->
                                            <button @click="modelOpen = true; selectedBookingId = {{ $booking->id }};" class="text-green-600 hover:text-green-900" title="Assign Driver">
                                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                                </svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="12" class="px-6 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <svg class="h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                            <p class="text-lg font-semibold mb-2">No trips found</p>
                                            <p class="text-sm">Try adjusting your filters or create a new trip</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($bookings->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $bookings->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
    
    <!-- Driver Assignment Modal -->
    <div x-show="modelOpen" class="relative z-50">
        <!-- Modal -->
        <div x-show="modelOpen" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen px-4 text-center md:items-center sm:block sm:p-0">
                <div x-show="modelOpen" @click="modelOpen = false" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="absolute inset-0 transition-opacity bg-gray-500 bg-opacity-40" aria-hidden="true"></div>

                <div x-show="modelOpen" x-transition:enter="transition ease-out duration-300 transform" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" class="inline-block w-full max-w-lg p-8 my-20 overflow-hidden text-left transition-all transform bg-white rounded-lg shadow-xl 2xl:max-w-2xl" style="display: none;">
                    <div class="flex items-center justify-between space-x-4">
                        <h1 class="text-xl font-medium text-gray-800">Assign Driver</h1>
                        <button @click="modelOpen = false" class="text-gray-600 focus:outline-none hover:text-gray-700">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </button>
                    </div>
                    <!-- Form -->
                    <form :action="`{{ route('admin.trips.assign-driver', '999999') }}`.replace('999999', selectedBookingId)" method="POST" class="mt-5">
                        @csrf
                        @method('PATCH')
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select Driver</label>
                            <select name="driver_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                                <option value="">Select a Driver</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }} ({{ $driver->phone }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 transition duration-300 shadow-md">
                                Assign Driver
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
</x-app-layout>


