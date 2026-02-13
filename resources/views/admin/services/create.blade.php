<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-6">Add New Service</h2>

                    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Basic Info -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Service Name</label>
                                <input type="text" name="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>
                            
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Slug (Optional)</label>
                                <input type="text" name="slug" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>

                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Short Description (150 chars)</label>
                                <textarea name="short_description" rows="3" maxlength="150" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></textarea>
                            </div>

                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Full Description</label>
                                <textarea name="full_description" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Icon Class (Font Awesome)</label>
                                <input type="text" name="icon_class" placeholder="fa fa-car" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Display Order</label>
                                <input type="number" name="display_order" value="0" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Featured Image</label>
                                <input type="file" name="featured_image" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Banner Image</label>
                                <input type="file" name="banner_image" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                            </div>

                            <!-- SEO -->
                            <div class="col-span-2 border-t pt-4 mt-4">
                                <h3 class="text-lg font-semibold mb-4">SEO Settings</h3>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Meta Title</label>
                                <input type="text" name="meta_title" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>

                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Meta Description</label>
                                <textarea name="meta_description" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"></textarea>
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
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Save Service</button>
                            <a href="{{ route('admin.services.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('scripts')
<script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create(document.querySelector('textarea[name="full_description"]'))
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
