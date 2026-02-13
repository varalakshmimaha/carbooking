<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="text-2xl font-bold mb-6">Edit Testimonial</h2>

                    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Basic Info -->
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Customer Name</label>
                                <input type="text" name="customer_name" value="{{ $testimonial->customer_name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>
                            
                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Designation</label>
                                <input type="text" name="designation" value="{{ $testimonial->designation }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Company Name</label>
                                <input type="text" name="company_name" value="{{ $testimonial->company_name }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Location (Optional)</label>
                                <input type="text" name="location" value="{{ $testimonial->location }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Rating (1-5)</label>
                                <input type="number" name="rating" min="1" max="5" value="{{ $testimonial->rating }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Display Order</label>
                                <input type="number" name="display_order" value="{{ $testimonial->display_order }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                            </div>

                            <div class="col-span-2">
                                <label class="block mb-2 text-sm font-medium text-gray-900">Message</label>
                                <textarea name="message" rows="4" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">{{ $testimonial->message }}</textarea>
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Photo</label>
                                @if($testimonial->photo)
                                    <img src="{{ asset('storage/' . $testimonial->photo) }}" class="h-16 w-16 mb-2 rounded-full object-cover">
                                @endif
                                <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none">
                            </div>

                            <div>
                                <label class="block mb-2 text-sm font-medium text-gray-900">Status</label>
                                <select name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                    <option value="active" {{ $testimonial->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $testimonial->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="mt-6">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 focus:outline-none">Update Testimonial</button>
                            <a href="{{ route('admin.testimonials.index') }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
