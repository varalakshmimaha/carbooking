<x-driver-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Driver Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Status & Toggle -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg col-span-1 md:col-span-2 lg:col-span-1">
                    <div class="p-6 flex flex-col justify-between h-full">
                        <div>
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2">Availability</h3>
                            <div class="flex items-center space-x-2">
                                <span class="h-3 w-3 rounded-full {{ $driver->is_online ? 'bg-green-500 animate-pulse' : 'bg-red-500' }}"></span>
                                <span class="text-2xl font-bold {{ $driver->is_online ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $driver->is_online ? 'ONLINE' : 'OFFLINE' }}
                                </span>
                            </div>
                        </div>
                        <form action="{{ route('driver.toggle-status') }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="w-full py-2 px-4 rounded-lg font-bold text-white text-sm transition-colors {{ $driver->is_online ? 'bg-red-500 hover:bg-red-600' : 'bg-green-500 hover:bg-green-600' }}">
                                {{ $driver->is_online ? 'Go Offline' : 'Go Online' }}
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Pending -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Pending</h3>
                            <div class="p-2 bg-yellow-100 rounded-full text-yellow-600">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <span class="text-3xl font-bold text-gray-900">{{ $pendingRidesCount ?? 0 }}</span>
                    </div>
                </div>

                <!-- Running -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Running</h3>
                            <div class="p-2 bg-blue-100 rounded-full text-blue-600">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                        </div>
                        <span class="text-3xl font-bold text-gray-900">{{ $runningRidesCount ?? 0 }}</span>
                    </div>
                </div>

                <!-- Completed -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                         <div class="flex items-center justify-between mb-4">
                            <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider">Completed</h3>
                            <div class="p-2 bg-green-100 rounded-full text-green-600">
                                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                        </div>
                        <span class="text-3xl font-bold text-gray-900">{{ $completedRidesCount ?? 0 }}</span>
                    </div>
                </div>
            </div>

            <!-- Active Ride Card -->
            @if($activeRide)
            <div class="bg-blue-50 border border-blue-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <h3 class="text-lg font-bold text-blue-900 flex items-center">
                            <span class="animate-pulse bg-green-500 h-3 w-3 rounded-full mr-2"></span>
                            Active Ride #{{ $activeRide->id }}
                        </h3>
                        <span class="bg-blue-200 text-blue-800 text-xs px-2 py-1 rounded-full font-bold uppercase">{{ $activeRide->status }}</span>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Pickup Location</p>
                            <p class="font-semibold text-gray-900">{{ $activeRide->pickup_location }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Drop Location</p>
                            <p class="font-semibold text-gray-900">{{ $activeRide->drop_location ?? 'Not Specified' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Customer</p>
                            <p class="font-semibold text-gray-900">{{ $activeRide->customer->name ?? $activeRide->guest_name ?? 'Guest' }}</p>
                            <p class="text-sm text-gray-500">{{ $activeRide->customer->phone ?? $activeRide->guest_phone ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Amount</p>
                            <p class="font-semibold text-gray-900">₹{{ $activeRide->amount }}</p>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end space-x-3">
                         <a href="{{ route('driver.trips.show', $activeRide->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-900 focus:outline-none focus:border-blue-900 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
                            View Details & Start
                        </a>
                    </div>
                </div>
            </div>
            @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-center text-gray-500">
                    <p>No active rides at the moment.</p>
                    <p class="text-sm mt-1">Make sure you are ONLINE to receive new bookings.</p>
                </div>
            </div>
            @endif

            <!-- Recent History -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Recent Rides</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Route</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($recentRides as $ride)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $ride->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $ride->created_at->format('M d, H:i') }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="w-48 truncate" title="{{ $ride->pickup_location }} -> {{ $ride->drop_location }}">
                                            {{ \Illuminate\Support\Str::limit($ride->pickup_location, 15) }} → {{ \Illuminate\Support\Str::limit($ride->drop_location, 15) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">₹{{ $ride->amount }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Completed</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No recent rides found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-driver-layout>
