<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Drivers') }}
            </h2>
            <a href="{{ route('admin.drivers.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl font-bold shadow-sm transition-all flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Add Driver
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Filter Bar -->
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                <form action="{{ route('admin.drivers.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4 items-end">
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Select Driver Id</label>
                        <select name="driver_id" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <option value="">All Driver IDs</option>
                            @foreach($allDriverIds as $id)
                                <option value="{{ $id->driver_code }}" {{ request('driver_id') == $id->driver_code ? 'selected' : '' }}>{{ $id->driver_code }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Select Name</label>
                        <select name="name" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <option value="">All Names</option>
                            @foreach($allNames as $n)
                                <option value="{{ $n->name }}" {{ request('name') == $n->name ? 'selected' : '' }}>{{ $n->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Select Mobile Number</label>
                        <select name="mobile" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <option value="">All Numbers</option>
                            @foreach($allMobiles as $m)
                                <option value="{{ $m->mobile }}" {{ request('mobile') == $m->mobile ? 'selected' : '' }}>{{ $m->mobile }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Verification Filter</label>
                        <select name="verified" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 text-sm">
                            <option value="all" {{ request('verified') == 'all' ? 'selected' : '' }}>All</option>
                            <option value="verified" {{ request('verified') == 'verified' ? 'selected' : '' }}>Verified</option>
                            <option value="not_verified" {{ request('verified') == 'not_verified' ? 'selected' : '' }}>Not Verified</option>
                        </select>
                    </div>
                    <div class="flex space-x-2">
                        <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 rounded-xl font-bold transition-all">Search</button>
                        <a href="{{ route('admin.drivers.index') }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 py-2 rounded-xl font-bold text-center transition-all">Reset</a>
                    </div>
                </form>
            </div>

            <!-- Table -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider font-semibold">
                                <th class="px-6 py-4"><input type="checkbox" class="rounded text-blue-600"></th>
                                <th class="px-6 py-4">No.</th>
                                <th class="px-6 py-4">Driver ID</th>
                                <th class="px-6 py-4">Driver Name</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4">Mobile</th>
                                <th class="px-6 py-4">Address</th>
                                <th class="px-6 py-4">Joining Date</th>
                                <th class="px-6 py-4">Verified</th>
                                <th class="px-6 py-4 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($drivers as $driver)
                            <tr class="hover:bg-gray-50 transition-colors text-sm text-gray-700">
                                <td class="px-6 py-4"><input type="checkbox" class="rounded text-blue-600"></td>
                                <td class="px-6 py-4">{{ ($drivers->currentPage()-1) * $drivers->perPage() + $loop->iteration }}</td>
                                <td class="px-6 py-4 font-bold text-blue-600 hover:underline">
                                    <a href="{{ route('admin.drivers.show', $driver) }}">{{ $driver->driver_code }}</a>
                                </td>
                                <td class="px-6 py-4 font-medium text-gray-900">{{ $driver->name }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $driver->email ?? 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $driver->mobile }}</td>
                                <td class="px-6 py-4 text-gray-400 truncate max-w-xs">{{ $driver->address ?? 'N/A' }}</td>
                                <td class="px-6 py-4 italic text-gray-400">{{ $driver->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4">
                                    @if($driver->verification_status === 'verified')
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Verified</span>
                                    @else
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Not Verified</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('admin.drivers.show', $driver) }}" class="text-blue-600 hover:text-blue-800" title="View Details">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        
                                        <a href="{{ route('admin.drivers.edit', $driver) }}" class="text-gray-600 hover:text-gray-800" title="Edit Driver">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>

                                        <form action="{{ route($driver->verification_status === 'verified' ? 'admin.drivers.unverify' : 'admin.drivers.verify', $driver) }}" method="POST" class="inline">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="{{ $driver->verification_status === 'verified' ? 'text-orange-500 hover:text-orange-700' : 'text-green-500 hover:text-green-700' }}" title="{{ $driver->verification_status === 'verified' ? 'Unverify' : 'Verify' }}">
                                                @if($driver->verification_status === 'verified')
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                    </svg>
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                @endif
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.drivers.destroy', $driver) }}" method="POST" onsubmit="return confirm('Delete this driver?')" class="inline">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700" title="Delete Driver">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="10" class="px-6 py-12 text-center text-gray-500">
                                    No drivers found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="p-4 bg-gray-50 border-t border-gray-100">
                    {{ $drivers->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
