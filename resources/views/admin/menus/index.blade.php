<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Menu Management') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Create Menu Button & Modal -->
            <div x-data="{ open: false }" class="flex justify-end">
                <button @click="open = true" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-xl font-bold shadow-sm transition-all flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Menu Group
                </button>

                <!-- Create/Edit Modal -->
                <div x-show="open" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <form action="{{ route('admin.menus.store') }}" method="POST">
                                @csrf
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <h3 class="text-xl font-bold text-gray-900 mb-4">New Menu Group</h3>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Menu Name</label>
                                            <input type="text" name="name" required class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Menu Key (Unique)</label>
                                            <input type="text" name="key" required placeholder="e.g. header, footer_col1" class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Status</label>
                                            <select name="status" class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Description</label>
                                            <textarea name="description" class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">Save Menu</button>
                                    <button @click="open = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Edit Modal -->
                <div x-data="{ open: false, form: { action: '', name: '', key: '', status: 'active', description: '' } }" 
                     @edit-menu.window="open = true; form.action = '/admin/menus/' + $event.detail.id; form.name = $event.detail.name; form.key = $event.detail.key; form.status = $event.detail.status; form.description = $event.detail.description"
                     x-show="open" 
                     class="fixed inset-0 z-50 overflow-y-auto" 
                     style="display: none;">
                    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 transition-opacity" aria-hidden="true">
                            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                        </div>
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <form :action="form.action" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                    <h3 class="text-xl font-bold text-gray-900 mb-4">Edit Menu Group</h3>
                                    <div class="space-y-4">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Menu Name</label>
                                            <input type="text" x-model="form.name" name="name" required class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Menu Key (Unique)</label>
                                            <input type="text" x-model="form.key" name="key" required class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Status</label>
                                            <select x-model="form.status" name="status" class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700">Description</label>
                                            <textarea x-model="form.description" name="description" class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">Update Menu</button>
                                    <button @click="open = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Menus Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($menus as $menu)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">{{ $menu->name }}</h3>
                                <p class="text-xs font-mono text-gray-400 mt-1 uppercase tracking-widest">Key: {{ $menu->key }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $menu->status === 'active' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($menu->status) }}
                            </span>
                        </div>
                        
                        <div class="flex items-center text-sm text-gray-500 mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                            {{ $menu->all_items_count }} Items
                        </div>

                        <div class="flex space-x-2">
                            <a href="{{ route('admin.menus.items', $menu) }}" class="flex-1 bg-gray-50 hover:bg-gray-100 text-gray-700 text-center py-2 rounded-xl text-sm font-semibold transition-colors">
                                Manage Items
                            </a>
                            <button @click="$dispatch('edit-menu', { id: {{ $menu->id }}, name: {{ json_encode($menu->name) }}, key: {{ json_encode($menu->key) }}, status: '{{ $menu->status }}', description: {{ json_encode($menu->description) }} })" class="bg-blue-50 hover:bg-blue-100 text-blue-600 px-4 py-2 rounded-xl transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </button>
                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" onsubmit="return confirm('Delete this menu group?')" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-xl transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full bg-white p-12 rounded-2xl shadow-sm border border-gray-100 text-center text-gray-500">
                    No Menu Groups found. Create one to get started.
                </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>
