<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-6">Edit Post</h2>

                    <form action="{{ route('admin.blog.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Basic Info -->
                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Post Title</label>
                                <input type="text" name="title" value="{{ $post->title }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>
                            
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Slug (Optional)</label>
                                <input type="text" name="slug" value="{{ $post->slug }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Category</label>
                                <select name="category_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Tags</label>
                                <select name="tags[]" multiple class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 h-32">
                                    @foreach($tags as $tag)
                                        <option value="{{ $tag->id }}" {{ $post->tags->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Short Description</label>
                                <textarea name="short_description" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>{{ $post->short_description }}</textarea>
                            </div>

                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Full Content (Rich Text)</label>
                                <textarea name="full_content" rows="10" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>{{ $post->full_content }}</textarea>
                                <p class="mt-1 text-sm text-gray-500">Note: Rich Text Editor integration pending (use HTML).</p>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Featured Image</label>
                                @if($post->featured_image)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" class="h-16 w-16 mb-2 rounded object-cover">
                                @endif
                                <input type="file" name="featured_image" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Banner Image</label>
                                @if($post->banner_image)
                                    <img src="{{ asset('storage/' . $post->banner_image) }}" class="h-16 w-16 mb-2 rounded object-cover">
                                @endif
                                <input type="file" name="banner_image" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Author Name</label>
                                <input type="text" name="author_name" value="{{ $post->author_name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Publish Date</label>
                                <input type="date" name="publish_date" value="{{ $post->publish_date ? $post->publish_date->format('Y-m-d') : '' }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Estimated Reading Time</label>
                                <input type="text" name="estimated_reading_time" value="{{ $post->estimated_reading_time }}" placeholder="e.g. 5 mins" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                <select name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="draft" {{ $post->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ $post->status == 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                            </div>

                            <!-- SEO -->
                            <div class="col-span-2 border-t pt-4 mt-4">
                                <h3 class="text-lg font-semibold mb-4">SEO Settings</h3>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Meta Title</label>
                                <input type="text" name="meta_title" value="{{ $post->meta_title }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>

                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Meta Description</label>
                                <textarea name="meta_description" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ $post->meta_description }}</textarea>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Update Post</button>
                            <a href="{{ route('admin.blog.posts.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Cancel</a>
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
        .create(document.querySelector('textarea[name="full_content"]'))
        .catch(error => {
            console.error(error);
        });
</script>
@endpush
