<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-6">Add New Feature</h2>

                    <form action="{{ route('admin.features.store') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                                <input type="text" name="title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required placeholder="e.g. Easy & Fast Booking">
                            </div>
                            
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Icon Class (Font Awesome)</label>
                                <input type="text" name="icon_class" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g. fa-solid fa-car">
                                <p class="mt-1 text-xs text-gray-500">Use FontAwesome classes.</p>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Redirect URL (Optional)</label>
                                <input type="url" name="redirect_url" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="e.g. https://example.com/page">
                                <p class="mt-1 text-xs text-gray-500">If set, clicking this feature card will redirect the user to this URL.</p>
                            </div>

                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Description</label>
                                <textarea name="description" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Brief description..."></textarea>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Display Order</label>
                                <input type="number" name="display_order" value="0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>

                            <div class="flex items-center mt-6">
                                <input id="is_highlighted" type="checkbox" name="is_highlighted" value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500">
                                <label for="is_highlighted" class="ml-2 text-sm font-medium text-gray-900">Highlight this box (Black background)</label>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                <select name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Save Feature</button>
                            <a href="{{ route('admin.features.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
