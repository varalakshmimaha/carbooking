<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.menus.index') }}" class="text-gray-400 hover:text-gray-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Manage Items:') }} <span class="text-blue-600">{{ $menu->name }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Add Item Form -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-6">Add New Item</h3>
                    <form action="{{ route('admin.menus.items.store', $menu) }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Label / Title</label>
                            <input type="text" name="label" required class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Link Type</label>
                            <select name="type" class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="custom">Custom URL</option>
                                <option value="internal">Internal Page</option>
                                <option value="module">Module Link</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">URL / Slug</label>
                            <input type="text" name="url" placeholder="e.g. /about or https://google.com" class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Parent Item (Optional)</label>
                            <select name="parent_id" class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="">None (Top Level)</option>
                                @foreach($all_items as $p_item)
                                    <option value="{{ $p_item->id }}">{{ $p_item->label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="target_blank" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <label class="ml-2 text-sm text-gray-600">New Tab</label>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-sm transition-all">
                            Add to Menu
                        </button>
                    </form>
                </div>
            </div>

            <!-- Items List (Nested) -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                        <h3 class="text-lg font-bold text-gray-800">Menu Structure</h3>
                        <p class="text-xs text-green-600 font-semibold">✓ Drag and drop enabled</p>
                    </div>
                    
                    <div class="p-6">
                        @if($items->isEmpty())
                            <div class="text-center py-12 text-gray-400">
                                No items yet. Add your first menu link on the left.
                            </div>
                        @else
                            <div id="menu-structure" class="space-y-4">
                                @foreach($items as $item)
                                    @include('admin.menus._item_row', ['item' => $item, 'depth' => 0])
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Edit Item Modal -->
    <div id="edit-item-modal" x-data="{ open: false }" x-show="open" x-on:open-edit-modal.window="open = true" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form id="edit-item-form" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <h3 class="text-lg font-bold text-gray-900 mb-6">Edit Menu Item</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Label / Title</label>
                                <input type="text" id="edit-item-label" name="label" required class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Link Type</label>
                                <select id="edit-item-type" name="type" class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="custom">Custom URL</option>
                                    <option value="internal">Internal Page</option>
                                    <option value="module">Module Link</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">URL / Slug</label>
                                <input type="text" id="edit-item-url" name="url" class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Parent Item (Optional)</label>
                                <select id="edit-item-parent" name="parent_id" class="mt-1 block w-full border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <option value="">None (Top Level)</option>
                                    @foreach($all_items as $p_item)
                                        <option value="{{ $p_item->id }}">{{ $p_item->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center">
                                    <input type="checkbox" id="edit-item-target" name="target_blank" value="1" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <label class="ml-2 text-sm text-gray-600">New Tab</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button type="submit" class="w-full inline-flex justify-center rounded-xl border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">Update Item</button>
                        <button @click="open = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-xl border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <!-- SortableJS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    
    <script>
        window.openEditItemModal = function(id, label, type, url, parentId, targetBlank) {
            // Debug alert to confirm function call
            alert('Edit Modal Function Called'); 
            
            const modal = document.getElementById('edit-item-modal');
            const form = document.getElementById('edit-item-form');
            
            // Set form action
            form.action = `/admin/menu-items/${id}`;
            
            // Populate fields
            document.getElementById('edit-item-label').value = label;
            document.getElementById('edit-item-type').value = type;
            document.getElementById('edit-item-url').value = url;
            document.getElementById('edit-item-parent').value = parentId || '';
            document.getElementById('edit-item-target').checked = targetBlank;
            
            // Show modal
            window.dispatchEvent(new CustomEvent('open-edit-modal'));

            if (modal._x_dataStack) {
                modal._x_dataStack[0].open = true;
            } else if (modal.__x) {
                modal.__x.$data.open = true;
            }
        }

        // Initialize SortableJS for drag and drop
        document.addEventListener('DOMContentLoaded', function() {
            const menuStructure = document.querySelector('#menu-structure');
            
            if (menuStructure) {
                new Sortable(menuStructure, {
                    animation: 150,
                    handle: '.cursor-move',
                    ghostClass: 'bg-blue-100',
                    chosenClass: 'bg-blue-50',
                    dragClass: 'opacity-50',
                    onEnd: function(evt) {
                        // Get all items in new order
                        const items = [];
                        const itemElements = menuStructure.querySelectorAll('[data-id]');
                        
                        itemElements.forEach((el, index) => {
                            items.push({
                                id: el.getAttribute('data-id'),
                                order: index
                            });
                        });

                        // Send AJAX request to update order
                        fetch('{{ route("admin.menu-items.reorder") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ items: items })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Menu items reordered successfully');
                            }
                        })
                        .catch(error => {
                            console.error('Error reordering menu items:', error);
                            location.reload();
                        });
                    }
                });
            }
        });
    </script>
    @endpush
</x-app-layout>
