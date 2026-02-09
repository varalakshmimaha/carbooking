<x-app-layout>
    <div class="py-12 bg-gray-50" x-data="routeGenerator()">
        <div class="max-w-4xl mx-auto px-6">
            
            <!-- Header -->
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Route</h1>
                    <nav class="text-sm text-gray-500 mt-1">
                        <a href="{{ route('admin.routes.index') }}" class="hover:text-gray-900">Routes</a>
                        <span class="mx-2">/</span>
                        <span class="text-gray-900">Edit</span>
                    </nav>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <form action="{{ route('admin.routes.update', $route) }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    @method('PUT')
                    
                    <!-- Basic Info -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">From City <span class="text-red-500">*</span></label>
                            <select name="from_city_id" x-model="from_city_id" required class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select City</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" {{ $route->from_city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">To City <span class="text-red-500">*</span></label>
                            <select name="to_city_id" x-model="to_city_id" required class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select City</option>
                                @foreach($cities as $city)
                                    <option value="{{ $city->id }}" {{ $route->to_city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- AI Generator Button -->
                    <div class="mb-10 bg-blue-50 border border-blue-100 p-6 rounded-2xl flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center font-bold">
                                AI
                            </div>
                            <div>
                                <h3 class="font-bold text-blue-900">Re-Magic Content</h3>
                                <p class="text-sm text-blue-700">Regenerate SEO content based on selected cities.</p>
                            </div>
                        </div>
                        <button type="button" @click="generateAI()" :disabled="loading" class="bg-blue-600 hover:bg-blue-700 disabled:opacity-50 text-white px-6 py-3 rounded-xl font-bold transition-all shadow-lg shadow-blue-200 flex items-center">
                            <svg x-show="loading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            <span x-text="loading ? 'Generating...' : 'Regenerate Content'"></span>
                        </button>
                    </div>

                    <!-- SEO Fields -->
                    <div class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Route Title <span class="text-red-500">*</span></label>
                                <input type="text" name="title" x-model="title" required class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Slug <span class="text-red-500">*</span></label>
                                <input type="text" name="slug" x-model="slug" required class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Image Alt Title <span class="text-red-500">*</span></label>
                            <input type="text" name="image_title" x-model="image_title" required class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Route Description <span class="text-red-500">*</span></label>
                            <textarea name="description" x-model="description" rows="8" required class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-6 border-t border-gray-50">
                            <div class="space-y-4">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Route Image</label>
                                @if($route->image)
                                    <img src="{{ asset('storage/' . $route->image) }}" class="w-32 h-20 rounded-xl object-cover border border-gray-100 mb-4">
                                @endif
                                <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Status</label>
                                <select name="status" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                                    <option value="active" {{ $route->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $route->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 flex justify-end space-x-4 border-t border-gray-50 pt-8">
                        <a href="{{ route('admin.routes.index') }}" class="px-8 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">CANCEL</a>
                        <button type="submit" class="px-12 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 shadow-xl shadow-blue-200 transition-all">UPDATE ROUTE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function routeGenerator() {
            return {
                from_city_id: '{{ $route->from_city_id }}',
                to_city_id: '{{ $route->to_city_id }}',
                title: '{{ addslashes($route->title) }}',
                slug: '{{ $route->slug }}',
                image_title: '{{ addslashes($route->image_title) }}',
                description: `{!! addslashes($route->description) !!}`,
                loading: false,

                async generateAI() {
                    if (!this.from_city_id || !this.to_city_id) {
                        alert('Please select both From and To cities first.');
                        return;
                    }

                    this.loading = true;
                    try {
                        const response = await fetch('{{ route('admin.routes.generate') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                from_city_id: this.from_city_id,
                                to_city_id: this.to_city_id
                            })
                        });

                        const data = await response.json();
                        
                        if (response.ok) {
                            this.title = data.title;
                            this.slug = data.slug;
                            this.image_title = data.image_title;
                            this.description = data.description;
                        } else {
                            alert(data.error || 'Generation failed');
                        }
                    } catch (error) {
                        console.error(error);
                        alert('Something went wrong.');
                    } finally {
                        this.loading = false;
                    }
                }
            }
        }
    </script>
</x-app-layout>
