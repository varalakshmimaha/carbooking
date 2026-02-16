<x-driver-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Rides') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Route</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($trips as $trip)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">#{{ $trip->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $trip->created_at->format('M d, Y') }}<br>
                                        <span class="text-xs">{{ $trip->created_at->format('h:i A') }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $trip->customer->name ?? $trip->guest_name ?? 'Guest' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900">
                                        <div class="flex flex-col">
                                            <span class="font-medium text-green-600 mb-1">From: {{ \Illuminate\Support\Str::limit($trip->pickup_location, 20) }}</span>
                                            <span class="font-medium text-red-600">To: {{ \Illuminate\Support\Str::limit($trip->drop_location ?? 'Not Specified', 20) }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">₹{{ number_format($trip->amount, 2) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $trip->status === 'Confirmed' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $trip->status === 'Running' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $trip->status === 'Completed' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $trip->status === 'Cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ $trip->status }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('driver.trips.show', $trip->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold">Details</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                        <p class="text-lg font-semibold">No rides found</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if($trips->hasPages())
                        <div class="mt-4">
                            {{ $trips->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-driver-layout>
