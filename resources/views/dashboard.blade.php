<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Car Booking Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Dashboard Summary Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Total Trips -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="p-3 bg-blue-100 rounded-xl text-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A2 2 0 013 15.488V5.512a2 2 0 011.553-1.944L9 1l6 3 5.447-2.724A2 2 0 0121 3.224v9.976a2 2 0 01-1.553 1.944L15 18l-6 2z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Trips</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_trips'] }}</p>
                    </div>
                </div>

                <!-- Total Drivers -->
                <a href="{{ route('admin.drivers.index') }}" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4 hover:shadow-md transition-all cursor-pointer">
                    <div class="p-3 bg-green-100 rounded-xl text-green-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Drivers</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_drivers'] }}</p>
                    </div>
                </a>

                <!-- Total Vehicles -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="p-3 bg-purple-100 rounded-xl text-purple-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Vehicles</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_vehicles'] }}</p>
                    </div>
                </div>

                <!-- Total Customers -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center space-x-4 hover:shadow-md transition-shadow cursor-pointer">
                    <div class="p-3 bg-yellow-100 rounded-xl text-yellow-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Customers</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $stats['total_customers'] }}</p>
                    </div>
                </div>
            </div>

            <!-- Driver Status Summary -->
            <h3 class="text-lg font-bold text-gray-800 mb-4">Driver Status</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Online Drivers -->
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-green-100 uppercase tracking-wider">Online Drivers</p>
                            <p class="text-3xl font-bold mt-1">{{ $stats['online_drivers'] }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.636 18.364a9 9 0 010-12.728m12.728 0a9 9 0 010 12.728m-9.9-2.829a5 5 0 010-7.07m7.072 0a5 5 0 010 7.07M13 12a1 1 0 11-2 0 1 1 0 012 0z" /></svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-green-400 border-opacity-30">
                        <p class="text-xs text-green-100">Drivers currently available</p>
                    </div>
                </div>
                
                <!-- Active Rides -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-blue-100 uppercase tracking-wider">Active Rides</p>
                            <p class="text-3xl font-bold mt-1">{{ $stats['active_rides'] }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                           <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                    </div>
                     <div class="mt-4 pt-4 border-t border-blue-400 border-opacity-30">
                        <p class="text-xs text-blue-100">Trips currently in progress</p>
                    </div>
                </div>

                <!-- Offline Drivers -->
                <div class="bg-gradient-to-br from-gray-500 to-gray-600 rounded-2xl p-6 text-white shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="text-sm font-medium text-gray-100 uppercase tracking-wider">Offline Drivers</p>
                            <p class="text-3xl font-bold mt-1">{{ $stats['total_drivers'] - $stats['online_drivers'] }}</p>
                        </div>
                        <div class="bg-white bg-opacity-20 p-3 rounded-xl">
                            <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                        </div>
                    </div>
                     <div class="mt-4 pt-4 border-t border-gray-400 border-opacity-30">
                        <p class="text-xs text-gray-100">Drivers currently unavailable</p>
                    </div>
                </div>
            </div>

            <!-- Upcoming Bookings Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800">Upcoming Bookings</h3>
                    <button class="text-sm font-semibold text-blue-600 hover:text-blue-800">View All</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider font-semibold">
                                <th class="px-6 py-4">No</th>
                                <th class="px-6 py-4">Customer Name</th>
                                <th class="px-6 py-4">Customer Number</th>
                                <th class="px-6 py-4">Driver Name</th>
                                <th class="px-6 py-4">Rental Type</th>
                                <th class="px-6 py-4">Pick Up</th>
                                <th class="px-6 py-4">Drop</th>
                                <th class="px-6 py-4">Date</th>
                                <th class="px-6 py-4">Amount</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($upcomingBookings as $booking)
                            <tr class="hover:bg-gray-50 transition-colors text-sm text-gray-700">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $booking->customer->name }}</td>
                                <td class="px-6 py-4">{{ $booking->customer->phone }}</td>
                                <td class="px-6 py-4">{{ $booking->driver->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $booking->rental_type }}</td>
                                <td class="px-6 py-4">{{ $booking->pickup_location }}</td>
                                <td class="px-6 py-4">{{ $booking->drop_location }}</td>
                                <td class="px-6 py-4 italic">{{ $booking->book_date->format('d M Y, h:i A') }}</td>
                                <td class="px-6 py-4 font-bold">₹{{ number_format($booking->amount, 2) }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusClasses = [
                                            'Pending' => 'bg-yellow-100 text-yellow-700',
                                            'Confirmed' => 'bg-blue-100 text-blue-700',
                                            'Completed' => 'bg-green-100 text-green-700',
                                            'Cancelled' => 'bg-red-100 text-red-700',
                                        ][$booking->status] ?? 'bg-gray-100 text-gray-700';
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusClasses }}">
                                        {{ $booking->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div x-data="{ open: false }" class="relative inline-block">
                                        <button @click="open = !open" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                            </svg>
                                        </button>
                                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-xl border border-gray-100 z-50 py-1 origin-top-right">
                                            <a href="#" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100">View Booking</a>
                                            <a href="#" class="block px-4 py-2 text-xs text-gray-700 hover:bg-gray-100 border-t">Assign Driver</a>
                                            <a href="#" class="block px-4 py-2 text-xs text-blue-600 hover:bg-gray-50 border-t font-semibold">Change Status</a>
                                            <a href="#" class="block px-4 py-2 text-xs text-red-600 hover:bg-gray-50 border-t font-semibold">Cancel Booking</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                        </svg>
                                        <p>No Upcoming Bookings Found.</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="p-4 bg-gray-50 border-t border-gray-100">
                    {{ $upcomingBookings->links() }}
                </div>
            </div>

            <!-- Running Bookings Section -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800">Running Bookings</h3>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider font-semibold">
                                <th class="px-6 py-4">No</th>
                                <th class="px-6 py-4">Customer Name</th>
                                <th class="px-6 py-4">Customer Number</th>
                                <th class="px-6 py-4">Driver Name</th>
                                <th class="px-6 py-4">Rental Type</th>
                                <th class="px-6 py-4">Pick Up</th>
                                <th class="px-6 py-4">Drop</th>
                                <th class="px-6 py-4">Date</th>
                                <th class="px-6 py-4">Amount</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($runningBookings as $booking)
                            <tr class="hover:bg-gray-50 transition-colors text-sm text-gray-700">
                                <td class="px-6 py-4">{{ $loop->iteration }}</td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $booking->customer->name }}</td>
                                <td class="px-6 py-4">{{ $booking->customer->phone }}</td>
                                <td class="px-6 py-4">{{ $booking->driver->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $booking->rental_type }}</td>
                                <td class="px-6 py-4">{{ $booking->pickup_location }}</td>
                                <td class="px-6 py-4">{{ $booking->drop_location }}</td>
                                <td class="px-6 py-4 italic">{{ $booking->book_date->format('d M Y, h:i A') }}</td>
                                <td class="px-6 py-4 font-bold">₹{{ number_format($booking->amount, 2) }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700">
                                        {{ $booking->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <!-- Action Dots for Running Bookings -->
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z" />
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="11" class="px-6 py-12 text-center text-gray-500 italic">
                                    “No Running Bookings Found.”
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
