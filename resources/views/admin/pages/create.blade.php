<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-3xl mx-auto px-6">
            <div class="mb-6">
                <nav class="flex mb-4" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('admin.pages.index') }}" class="text-gray-700 hover:text-indigo-600">Pages</a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                </svg>
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Create New Page</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-2xl font-bold text-gray-900">Create New Page</h1>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <form action="{{ route('admin.pages.store') }}" method="POST" class="p-8">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-700 mb-1">Page Title</label>
                            <input type="text" name="title" id="title" value="{{ old('title') }}" required class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" placeholder="e.g. Home Page">
                            @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="slug" class="block text-sm font-semibold text-gray-700 mb-1">Slug (optional)</label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" placeholder="e.g. home-page (auto-generated if empty)">
                            @error('slug') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="content" class="block text-sm font-semibold text-gray-700 mb-1">Page Content</label>
                            <textarea name="content" id="content" rows="12" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" placeholder="Enter page content (HTML supported)...">{{ old('content') }}</textarea>
                            <p class="mt-1 text-xs text-gray-500">You can use HTML tags for formatting (headings, paragraphs, lists, etc.)</p>
                            @error('content') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-1">Status</label>
                            <select name="status" id="status" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="border-t border-gray-100 pt-6 mt-6">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">SEO Settings</h3>
                            
                            <div class="space-y-4">
                                <div>
                                    <label for="meta_title" class="block text-sm font-semibold text-gray-700 mb-1">Meta Title</label>
                                    <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                </div>
                                <div>
                                    <label for="meta_description" class="block text-sm font-semibold text-gray-700 mb-1">Meta Description</label>
                                    <textarea name="meta_description" id="meta_description" rows="3" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">{{ old('meta_description') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end space-x-3">
                        <a href="{{ route('admin.pages.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-colors">Cancel</a>
                        <button type="submit" class="px-6 py-2 bg-indigo-600 border border-transparent rounded-lg text-sm font-semibold text-white hover:bg-indigo-700 transition-colors">Create Page</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
