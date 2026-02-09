<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            
            <!-- Header -->
            <div class="mb-8 flex justify-between items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Rate Plan</h1>
                    <nav class="text-sm text-gray-500 mt-1">
                        <a href="{{ route('dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                        <span class="mx-2">/</span>
                        <span class="text-gray-900">Rates</span>
                    </nav>
                </div>
                <a href="{{ route('admin.rates.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-lg font-semibold shadow-sm transition-all flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Rate
                </a>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider font-semibold">
                                <th class="px-6 py-4">No.</th>
                                <th class="px-6 py-4">Cab Type</th>
                                <th class="px-6 py-4">Default Rate</th>
                                <th class="px-6 py-4">Round Trip</th>
                                <th class="px-6 py-4">12h Rate</th>
                                <th class="px-6 py-4">Capacity</th>
                                <th class="px-6 py-4">Status</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($rates as $index => $rate)
                                <tr class="hover:bg-gray-50 transition-colors text-sm text-gray-700">
                                    <td class="px-6 py-4 text-gray-500">{{ $rates->firstItem() + $index }}</td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if($rate->image)
                                                <img src="{{ asset('storage/' . $rate->image) }}" class="w-12 h-12 rounded-lg object-cover mr-3 border border-gray-100">
                                            @else
                                                <div class="w-12 h-12 rounded-lg bg-gray-100 flex items-center justify-center mr-3 border border-gray-100 text-gray-400">
                                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                    </svg>
                                                </div>
                                            @endif
                                            <span class="font-bold text-gray-900">{{ $rate->vehicleType->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-gray-900">₹{{ number_format($rate->default_rate, 2) }}</td>
                                    <td class="px-6 py-4 text-gray-600">₹{{ number_format($rate->round_trip_rate ?? 0, 2) }}</td>
                                    <td class="px-6 py-4 text-gray-600">₹{{ number_format($rate->local_12_hours_rate ?? 0, 2) }}</td>
                                    <td class="px-6 py-4 text-gray-600">{{ $rate->capacity ?? 'N/A' }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $rate->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($rate->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center space-x-3">
                                            <a href="{{ route('admin.rates.edit', $rate) }}" class="text-blue-600 hover:text-blue-800 font-medium text-xs uppercase tracking-wider">Edit</a>
                                            <form action="{{ route('admin.rates.destroy', $rate) }}" method="POST" onsubmit="return confirm('Delete this rate?');" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-xs uppercase tracking-wider">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center text-gray-500">No rate plans found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($rates->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                        {{ $rates->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
