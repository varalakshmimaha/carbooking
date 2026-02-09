<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6">
            
            <!-- Header -->
            <div class="mb-8 flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Edit Rate</h1>
                    <nav class="text-sm text-gray-500 mt-1">
                        <a href="{{ route('admin.rates.index') }}" class="hover:text-gray-900 flex items-center">
                            <svg class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                            Back to Rates
                        </a>
                    </nav>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <form action="{{ route('admin.rates.update', $rate) }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        <!-- Cab Type Name -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Cab Type Name <span class="text-red-500">*</span></label>
                            <select name="vehicle_type_id" required class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Cab Type</option>
                                @foreach($vehicleTypes as $type)
                                    <option value="{{ $type->id }}" {{ $rate->vehicle_type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Default Rate -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Default Rate <span class="text-red-500">*</span></label>
                            <input type="number" step="0.01" name="default_rate" value="{{ $rate->default_rate }}" required class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Round Trip Rate -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Round Trip Rate</label>
                            <input type="number" step="0.01" name="round_trip_rate" value="{{ $rate->round_trip_rate }}" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Total 12 Hours Rate -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Local 12 Hours Rate</label>
                            <input type="number" step="0.01" name="local_12_hours_rate" value="{{ $rate->local_12_hours_rate }}" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Local 8 Hours Rate -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Local 8 Hours Rate</label>
                            <input type="number" step="0.01" name="local_8_hours_rate" value="{{ $rate->local_8_hours_rate }}" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Extra KM Charge -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Extra KM Charge</label>
                            <input type="number" step="0.01" name="extra_km_charge" value="{{ $rate->extra_km_charge }}" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Daily Max KM -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Daily Max KM</label>
                            <input type="number" name="daily_max_km" value="{{ $rate->daily_max_km }}" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Night Driving Charge -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Night Driving Charge</label>
                            <input type="number" step="0.01" name="night_driving_charge" value="{{ $rate->night_driving_charge }}" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Driver Allowance -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Driver Allowance</label>
                            <input type="number" step="0.01" name="driver_allowance" value="{{ $rate->driver_allowance }}" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Gear Type -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Gear Type</label>
                            <select name="gear_type" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                                <option value="Manual" {{ $rate->gear_type == 'Manual' ? 'selected' : '' }}>Manual</option>
                                <option value="Automatic" {{ $rate->gear_type == 'Automatic' ? 'selected' : '' }}>Automatic</option>
                            </select>
                        </div>

                        <!-- Fuel Type -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Fuel Type</label>
                            <select name="fuel_type" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                                <option value="Diesel" {{ $rate->fuel_type == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                <option value="Petrol" {{ $rate->fuel_type == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                                <option value="CNG" {{ $rate->fuel_type == 'CNG' ? 'selected' : '' }}>CNG</option>
                                <option value="Electric" {{ $rate->fuel_type == 'Electric' ? 'selected' : '' }}>Electric</option>
                            </select>
                        </div>

                        <!-- Steering -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Steering</label>
                            <select name="steering" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                                <option value="Power" {{ $rate->steering == 'Power' ? 'selected' : '' }}>Power</option>
                                <option value="Manual" {{ $rate->steering == 'Manual' ? 'selected' : '' }}>Manual</option>
                            </select>
                        </div>

                        <!-- Persons -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-2">Persons (e.g. 4+1)</label>
                            <input type="text" name="capacity" value="{{ $rate->capacity }}" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Cab Image -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-4">Cab Image</label>
                            <div class="flex items-center space-x-6">
                                @if($rate->image)
                                    <img src="{{ asset('storage/' . $rate->image) }}" class="w-20 h-20 rounded-xl object-cover border border-gray-100 shadow-sm">
                                @endif
                                <input type="file" name="image" class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-6 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                            </div>
                        </div>
                    </div>

                    <!-- Editor Sections -->
                    <div class="mt-10 space-y-8">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Terms and Conditions</label>
                            <div class="border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                                <textarea name="terms_and_conditions" rows="4" class="w-full border-0 focus:ring-0 p-4 text-gray-700">{{ $rate->terms_and_conditions }}</textarea>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Inclusions</label>
                            <div class="border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                                <textarea name="inclusions" rows="4" class="w-full border-0 focus:ring-0 p-4 text-gray-700">{{ $rate->inclusions }}</textarea>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3">Exclusions</label>
                            <div class="border border-gray-200 rounded-xl overflow-hidden shadow-sm">
                                <textarea name="exclusions" rows="4" class="w-full border-0 focus:ring-0 p-4 text-gray-700">{{ $rate->exclusions }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-between">
                        <div>
                            <label class="inline-flex items-center">
                                <span class="text-sm font-bold text-gray-700 mr-4">Status:</span>
                                <select name="status" class="border-gray-200 rounded-lg text-sm focus:ring-blue-500">
                                    <option value="active" {{ $rate->status == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ $rate->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </label>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('admin.rates.index') }}" class="px-8 py-3 bg-cyan-600 text-white rounded-lg font-bold hover:bg-cyan-700 transition-all shadow-lg flex items-center">
                                CANCEL
                            </a>
                            <button type="submit" class="px-12 py-3 bg-blue-600 text-white rounded-lg font-bold hover:bg-blue-700 shadow-xl shadow-blue-100 transition-all flex items-center">
                                UPDATE
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
