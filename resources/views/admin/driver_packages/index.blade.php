<x-app-layout>
    <div x-data="driverPackageModule()">
        <div class="py-8 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                
                <!-- Header -->
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">📦 All Driver Packages</h1>
                        <nav class="text-sm text-gray-600 mt-1">
                            <a href="{{ route('dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                            <span class="mx-2">/</span>
                            <span class="text-gray-900">All Driver Packages</span>
                        </nav>
                    </div>
                </div>

                <!-- Filters Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                    <form method="GET" action="{{ route('admin.driver-packages.index') }}" class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-4 items-end text-sm">
                        
                        <div>
                            <label class="block font-bold text-gray-700 mb-2 uppercase text-[10px]">Select Name</label>
                            <select name="driver_id" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900">
                                <option value="">All Drivers</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ request('driver_id') == $driver->id ? 'selected' : '' }}>{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2 uppercase text-[10px]">Select Package</label>
                            <select name="package_id" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900">
                                <option value="">All Packages</option>
                                @foreach($packages as $package)
                                    <option value="{{ $package->id }}" {{ request('package_id') == $package->id ? 'selected' : '' }}>{{ $package->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block font-bold text-gray-700 mb-2 uppercase text-[10px]">Select Status</label>
                            <select name="status" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="expired" {{ request('status') == 'expired' ? 'selected' : '' }}>Expired</option>
                            </select>
                        </div>

                        <div class="flex space-x-2">
                            <button type="submit" class="bg-blue-600 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-blue-700 transition-all uppercase tracking-wider text-xs shadow-md">
                                Search
                            </button>
                            <a href="{{ route('admin.driver-packages.index') }}" class="bg-gray-800 text-white px-5 py-2.5 rounded-lg font-bold hover:bg-black transition-all uppercase tracking-wider text-xs shadow-md flex items-center justify-center">
                                All
                            </a>
                        </div>
                        
                        <div class="text-right flex justify-end">
                             <button type="button" @click="openAddModal()" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg font-bold hover:bg-blue-700 transition-all shadow-lg flex items-center uppercase text-xs tracking-widest">
                                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add
                            </button>
                        </div>

                    </form>
                </div>

                <!-- Summary Bar -->
                <div class="mb-4">
                     <span class="text-gray-900 font-bold bg-white px-4 py-2 rounded-lg shadow-sm border border-gray-100">Total Packages: {{ $driverPackages->total() }}</span>
                </div>

                <!-- Table -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-left">
                            <thead class="bg-gray-50">
                                <tr class="text-[10px] uppercase tracking-widest font-bold text-gray-500">
                                    <th class="px-6 py-4">Sr No</th>
                                    <th class="px-6 py-4">Name</th>
                                    <th class="px-6 py-4">Package</th>
                                    <th class="px-6 py-4">Amount</th>
                                    <th class="px-6 py-4">Remaining Day</th>
                                    <th class="px-6 py-4 text-center">Status</th>
                                    <th class="px-6 py-4 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100 italic font-medium">
                                @forelse($driverPackages as $index => $dp)
                                    <tr class="hover:bg-blue-50/30 transition-colors text-sm text-gray-700">
                                        <td class="px-6 py-4 text-gray-500">{{ $driverPackages->firstItem() + $index }}</td>
                                        <td class="px-6 py-4 font-bold text-gray-900">{{ $dp->driver->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4">{{ $dp->package->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 font-bold text-blue-600">₹{{ number_format($dp->amount, 2) }}</td>
                                        <td class="px-6 py-4">
                                            <span class="{{ $dp->remaining_days === 'Expired' ? 'text-red-500 underline' : 'text-gray-600' }}">
                                                {{ $dp->remaining_days }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-bold rounded-lg {{ $dp->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                                {{ ucfirst($dp->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex items-center justify-center space-x-4">
                                                <button @click="openEditModal({{ json_encode($dp) }})" class="text-blue-600 hover:text-blue-900 bg-blue-50 p-2 rounded-lg transition-all" title="Edit">
                                                    ✏️
                                                </button>
                                                <form action="{{ route('admin.driver-packages.destroy', $dp) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this driver package?')" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 p-2 rounded-lg transition-all" title="Delete">
                                                        🗑️
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center text-gray-500 italic">No driver packages found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($driverPackages->hasPages())
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                            {{ $driverPackages->links() }}
                        </div>
                    @endif
                </div>
            </div>

            <!-- Modal -->
            <div x-show="modalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm"></div>
                    </div>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div x-show="modalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                        
                        <div class="flex justify-between items-center bg-blue-600 px-6 py-4">
                             <h3 class="text-lg font-bold text-white flex items-center">
                                <span class="mr-2" x-text="isEdit ? '✏️ Edit Package' : '➕ Add Package'"></span>
                             </h3>
                             <button @click="closeModal()" class="text-white hover:text-gray-200">
                                 <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                             </button>
                        </div>

                        <form :action="isEdit ? '{{ url('admin/driver-packages') }}/' + dpId : '{{ route('admin.driver-packages.store') }}'" method="POST">
                            @csrf
                            <template x-if="isEdit"><input type="hidden" name="_method" value="PUT"></template>

                            <div class="bg-white px-6 py-8 space-y-6">
                                
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Driver Name <span class="text-red-500">*</span></label>
                                    <select name="driver_id" x-model="driver_id" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-medium text-gray-900">
                                        <option value="">Select Driver</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Package Name <span class="text-red-500">*</span></label>
                                    <select name="package_id" x-model="package_id" required class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-medium text-gray-900">
                                        <option value="">Select Package</option>
                                        @foreach($packages as $package)
                                            <option value="{{ $package->id }}">{{ $package->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Description</label>
                                    <textarea name="description" x-model="description" placeholder="Enter description..." rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-medium text-gray-900"></textarea>
                                    <p class="text-right text-[10px] text-gray-400 mt-1 uppercase font-bold tracking-widest">Max 500 characters</p>
                                </div>

                                <template x-if="isEdit">
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Status</label>
                                        <select name="status" x-model="status" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-medium text-gray-900">
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                            <option value="expired">Expired</option>
                                        </select>
                                    </div>
                                </template>

                            </div>

                            <div class="bg-gray-50 px-6 py-4 flex items-center justify-end space-x-3 border-t border-gray-100">
                                <button type="button" @click="closeModal()" class="px-6 py-2.5 bg-red-500 text-white rounded-xl font-bold hover:bg-red-600 transition-all uppercase text-xs tracking-widest shadow-md">
                                    Close
                                </button>
                                <button type="submit" class="px-10 py-2.5 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition-all uppercase text-xs tracking-widest shadow-lg shadow-blue-100">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script>
        function driverPackageModule() {
            return {
                modalOpen: false,
                isEdit: false,
                dpId: null,
                driver_id: '',
                package_id: '',
                description: '',
                status: 'active',

                openAddModal() {
                    this.isEdit = false;
                    this.dpId = null;
                    this.driver_id = '';
                    this.package_id = '';
                    this.description = '';
                    this.status = 'active';
                    this.modalOpen = true;
                },

                openEditModal(dp) {
                    this.isEdit = true;
                    this.dpId = dp.id;
                    this.driver_id = dp.driver_id;
                    this.package_id = dp.package_id;
                    this.description = dp.description;
                    this.status = dp.status;
                    this.modalOpen = true;
                },

                closeModal() {
                    this.modalOpen = false;
                }
            }
        }
    </script>
</x-app-layout>
