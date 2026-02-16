<x-app-layout>
    <div x-data="{ 
        addModalOpen: false,
        packageId: null,
        name: '',
        description: '',
        amount: '',
        days: '',
        type: 'rental',
        status: 'active',
        isEdit: false,

        openAddModal() {
            this.isEdit = false;
            this.name = '';
            this.description = '';
            this.amount = '';
            this.days = '';
            this.type = 'rental';
            this.status = 'active';
            this.addModalOpen = true;
        },

        openEditModal(pkg) {
            this.isEdit = true;
            this.packageId = pkg.id;
            this.name = pkg.name;
            this.description = pkg.description;
            this.amount = pkg.amount;
            this.days = pkg.days;
            this.type = pkg.type || 'rental';
            this.status = pkg.status;
            this.addModalOpen = true;
        },

        closeModal() {
            this.addModalOpen = false;
        }
    }">
        <div class="py-8 bg-gray-50">
            <div class="max-w-7xl mx-auto px-6">
                
                <!-- Header -->
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">All Packages</h1>
                        <nav class="text-sm text-gray-600 mt-1">
                            <a href="{{ route('dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                            <span class="mx-2">/</span>
                            <span class="text-gray-900">Packages</span>
                        </nav>
                    </div>
                </div>

                <!-- Filters & Actions -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                    <form method="GET" action="{{ route('admin.packages.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                        
                        <!-- Filter by Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select Name</label>
                            <select name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">All Names</option>
                                @foreach($allNames as $n)
                                    <option value="{{ $n->name }}" {{ request('name') == $n->name ? 'selected' : '' }}>{{ $n->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Filter by Status -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Select Status</label>
                            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Buttons -->
                        <div class="flex space-x-2">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                Search
                            </button>
                            <a href="{{ route('admin.packages.index') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-green-700 transition-colors flex items-center justify-center">
                                All
                            </a>
                        </div>
                        
                        <div class="text-right">
                             <button type="button" @click="openAddModal()" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold hover:bg-blue-700 transition-all shadow-lg shadow-blue-100 inline-flex items-center uppercase text-sm tracking-wide">
                                <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add New Package
                            </button>
                        </div>

                    </form>
                </div>

                <!-- Summary -->
                <div class="mb-4">
                     <span class="text-gray-700 font-semibold">Total Packages: {{ $totalPackages }}</span>
                </div>

                <!-- Packages Table -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">No.</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Name</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Amount</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Days</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($packages as $index => $package)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $packages->firstItem() + $index }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $package->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate" title="{{ $package->description }}">{{ Str::limit($package->description, 50) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">₹{{ number_format($package->amount, 2) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $package->days }} Days</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $package->status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($package->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <div class="flex items-center space-x-3">
                                                <button @click="openEditModal({{ json_encode($package) }})" class="text-blue-600 hover:text-blue-900" title="Edit">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </button>
                                                <form action="{{ route('admin.packages.toggle', $package) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="{{ $package->status === 'active' ? 'text-red-500 hover:text-red-700' : 'text-green-500 hover:text-green-700' }}" title="{{ $package->status === 'active' ? 'Deactivate' : 'Activate' }}">
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                                                        </svg>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.packages.destroy', $package) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center text-gray-500">
                                            No packages found. Click "Add Package" to create one.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                 <!-- Pagination -->
                @if($packages->hasPages())
                    <div class="px-6 py-4 mt-4">
                        {{ $packages->links() }}
                    </div>
                @endif
            </div>

            <!-- Modal -->
            <div x-show="addModalOpen" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    
                    <div x-show="addModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="absolute inset-0 bg-gray-900/40 backdrop-blur-sm"></div>
                    </div>

                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                    <div x-show="addModalOpen" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg w-full">
                        
                        <form :action="isEdit ? '/admin/packages/' + packageId : '{{ route('admin.packages.store') }}'" method="POST">
                            @csrf
                            <input type="hidden" name="_method" value="PUT" x-bind:disabled="!isEdit">

                            <div class="bg-blue-600 px-6 py-4">
                                <h3 class="text-lg font-bold text-white uppercase tracking-wider" x-text="isEdit ? 'Edit Package' : 'Add New Package'"></h3>
                            </div>

                            <div class="bg-white px-6 py-8 space-y-6">
                                
                                <!-- Name -->
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Package Name <span class="text-red-500">*</span></label>
                                    <input type="text" name="name" x-model="name" required placeholder="e.g. Kerala Luxury Tour" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-medium text-gray-900 transition-all">
                                </div>

                                <!-- Description -->
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Description <span class="text-red-500">*</span></label>
                                    <textarea name="description" x-model="description" required placeholder="Describe the package details..." rows="3" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-medium text-gray-900 transition-all"></textarea>
                                </div>

                                <!-- Type -->
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Package Type <span class="text-red-500">*</span></label>
                                    <select name="type" x-model="type" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-medium text-gray-900 transition-all">
                                        <option value="rental">Rental (Local)</option>
                                        <option value="airport">Airport</option>
                                    </select>
                                </div>

                                <div class="grid grid-cols-2 gap-6">
                                    <!-- Amount -->
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Amount (₹) <span class="text-red-500">*</span></label>
                                        <input type="number" name="amount" x-model="amount" required min="0" step="1" placeholder="0" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-bold text-gray-900 transition-all">
                                    </div>

                                    <!-- Days -->
                                    <div>
                                        <label class="block text-sm font-bold text-gray-700 mb-2">Days <span class="text-red-500">*</span></label>
                                        <input type="number" name="days" x-model="days" required min="1" placeholder="1" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-bold text-gray-900 transition-all">
                                    </div>
                                </div>

                                <!-- Status (only for edit) -->
                                <div x-show="isEdit">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Status</label>
                                    <select name="status" x-model="status" class="w-full px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm font-medium text-gray-900 transition-all">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
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
</x-app-layout>
