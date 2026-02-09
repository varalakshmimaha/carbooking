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
                        <p class="text-xs text-gray-400 italic">Drag and drop functionality coming soon</p>
                    </div>
                    
                    <div class="p-6">
                        @if($items->isEmpty())
                            <div class="text-center py-12 text-gray-400">
                                No items yet. Add your first menu link on the left.
                            </div>
                        @else
                            <div class="space-y-4">
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
</x-app-layout>
