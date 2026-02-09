<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            
            <!-- Header -->
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Add Vehicle</h1>
                    <nav class="text-sm text-gray-500 mt-1">
                        <a href="{{ route('admin.vehicles.index') }}" class="hover:text-gray-900 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                            Back to Vehicles
                        </a>
                    </nav>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <form action="{{ route('admin.vehicles.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <!-- Driver -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Driver <span class="text-red-500">*</span></label>
                            <select name="driver_id" required class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Driver</option>
                                @foreach($drivers as $driver)
                                    <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Cab Type -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Cab Type <span class="text-red-500">*</span></label>
                            <select name="vehicle_type_id" required class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Cab Type</option>
                                @foreach($vehicleTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('vehicle_type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Cab Name -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Cab Name <span class="text-red-500">*</span></label>
                            <input type="text" name="cab_name" required value="{{ old('cab_name') }}" placeholder="Enter Cab name" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Model Year -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Model Year <span class="text-red-500">*</span></label>
                            <input type="text" name="model_year" required value="{{ old('model_year') }}" placeholder="e.g. 2024" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Cab Number -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Cab Number <span class="text-red-500">*</span></label>
                            <input type="text" name="cab_number" required value="{{ old('cab_number') }}" placeholder="e.g. KA 01 AB 1234" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Chassis Number -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Chassis Number <span class="text-red-500">*</span></label>
                            <input type="text" name="chassis_number" required value="{{ old('chassis_number') }}" placeholder="Enter Chassis Number" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Cab Color -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Cab Color <span class="text-red-500">*</span></label>
                            <input type="text" name="cab_color" required value="{{ old('cab_color') }}" placeholder="Enter Cab Color" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- With Carrier -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">With Carrier <span class="text-red-500">*</span></label>
                            <select name="with_carrier" required class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                                <option value="Yes" {{ old('with_carrier') == 'Yes' ? 'selected' : '' }}>Yes</option>
                                <option value="No" {{ old('with_carrier') == 'No' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <!-- Fuel Type -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Fuel Type <span class="text-red-500">*</span></label>
                            <select name="fuel_type" required class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                                <option value="Petrol" {{ old('fuel_type') == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                                <option value="Diesel" {{ old('fuel_type') == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                <option value="CNG" {{ old('fuel_type') == 'CNG' ? 'selected' : '' }}>CNG</option>
                                <option value="Electric" {{ old('fuel_type') == 'Electric' ? 'selected' : '' }}>Electric</option>
                            </select>
                        </div>

                        <!-- Seating Capacity -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Seating Capacity <span class="text-red-500">*</span></label>
                            <input type="number" name="seating_capacity" required value="{{ old('seating_capacity') }}" placeholder="Enter Seating Capacity" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Images Section -->
                    <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8">
                        @php
                            $images = [
                                'vehicle_image' => 'Vehicle Image',
                                'rc_book_image' => 'RC Book Image',
                                'rc_book_back_image' => 'RC Book Back Image',
                                'insurance_image' => 'Insurance Image',
                                'puc_image' => 'PUC Image',
                                'fitness_certificate' => 'Fitness Certificate',
                                'car_permit' => 'Car Permit'
                            ];
                        @endphp

                        @foreach($images as $key => $label)
                            <div class="space-y-4">
                                <label class="block text-sm font-bold text-gray-700">{{ $label }}</label>
                                <div class="border-2 border-dashed border-gray-200 rounded-2xl p-6 flex flex-col items-center justify-center bg-gray-50 hover:bg-gray-100 transition-all cursor-pointer relative min-h-[200px]" onclick="document.getElementById('file_{{ $key }}').click()">
                                    <svg class="w-12 h-12 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                    </svg>
                                    <input type="file" name="{{ $key }}" id="file_{{ $key }}" class="hidden" onchange="previewImage(this, 'preview_{{ $key }}')">
                                    <img id="preview_{{ $key }}" class="absolute inset-0 w-full h-full object-cover rounded-2xl hidden">
                                </div>
                                <select name="{{ $key }}_verified" class="w-full border-gray-200 rounded-xl text-sm focus:ring-blue-500">
                                    <option value="Unverified">Unverified</option>
                                    <option value="Verified">Verified</option>
                                    <option value="Pending" selected>Pending</option>
                                </select>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        <label class="block text-sm font-bold text-gray-700 mb-2">Status</label>
                        <select name="status" class="w-full md:w-1/3 border-gray-200 rounded-xl focus:ring-blue-500">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="mt-12 flex items-center justify-end space-x-4 border-t border-gray-100 pt-8">
                        <a href="{{ route('admin.vehicles.index') }}" class="px-8 py-3 bg-cyan-600 text-white rounded-xl font-bold hover:bg-cyan-700 transition-all shadow-lg flex items-center uppercase text-sm tracking-widest">
                            CANCEL
                        </a>
                        <button type="submit" class="px-12 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 shadow-xl shadow-blue-100 transition-all flex items-center uppercase text-sm tracking-widest">
                            CREATE
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(input, previewId) {
            const preview = document.getElementById(previewId);
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
