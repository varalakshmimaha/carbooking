<x-app-layout>
    <div class="py-8 bg-gray-50">
        <div class="max-w-5xl mx-auto px-6 pb-12">
            
            <!-- Back Button -->
            <a href="{{ route('admin.trips.index') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-gray-900 mb-6">
                <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Trips
            </a>

            <!-- Booking Header Info -->
            <div class="mb-8 flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Edit Trip #{{ $booking->id }}</h1>
                    <p class="text-sm text-gray-500 mt-1">Manage trip details and verification</p>
                </div>
                <div class="flex items-center space-x-2">
                    <span class="px-3 py-1 rounded-full text-xs font-semibold
                        {{ $booking->verification_status == 'Verified' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        {{ $booking->verification_status }}
                    </span>
                    <span class="px-3 py-1 rounded-full text-xs font-semibold 
                        {{ $booking->status == 'Completed' ? 'bg-blue-100 text-blue-800' : ($booking->status == 'Cancelled' ? 'bg-gray-100 text-gray-800' : 'bg-yellow-100 text-yellow-800') }}">
                        {{ $booking->status }}
                    </span>
                </div>
            </div>

            <form action="{{ route('admin.trips.update', $booking) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-2xl shadow-sm border border-gray-200 p-8">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                    
                    <!-- Trip Type -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Trip Type</label>
                        <select name="rental_type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Trip Type</option>
                            <option value="One Way" {{ old('rental_type', $booking->rental_type) == 'One Way' ? 'selected' : '' }}>One Way</option>
                            <option value="Round Trip" {{ old('rental_type', $booking->rental_type) == 'Round Trip' ? 'selected' : '' }}>Round Trip</option>
                            <option value="Local / Hourly" {{ old('rental_type', $booking->rental_type) == 'Local / Hourly' ? 'selected' : '' }}>Local / Hourly</option>
                            <option value="Airport Pickup" {{ old('rental_type', $booking->rental_type) == 'Airport Pickup' ? 'selected' : '' }}>Airport Pickup</option>
                            <option value="Airport Drop" {{ old('rental_type', $booking->rental_type) == 'Airport Drop' ? 'selected' : '' }}>Airport Drop</option>
                        </select>
                    </div>

                    <!-- Customer Name -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Customer Name</label>
                        <select name="customer_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ old('customer_id', $booking->customer_id) == $customer->id ? 'selected' : '' }}>{{ $customer->name }} ({{ $customer->phone }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Trip Status -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Trip Status</label>
                        <select name="status" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="Pending" {{ old('status', $booking->status) == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Confirmed" {{ old('status', $booking->status) == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="Running" {{ old('status', $booking->status) == 'Running' ? 'selected' : '' }}>Running</option>
                            <option value="Completed" {{ old('status', $booking->status) == 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Cancelled" {{ old('status', $booking->status) == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <!-- Cab Type (Legacy) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Cab Name (Legacy)</label>
                        <select name="cab_type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Cab Type</option>
                            @foreach($vehicleTypes as $type)
                                <option value="{{ $type->name }}" {{ old('cab_type', $booking->cab_type) == $type->name ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Vehicle Class ID -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Requested Vehicle Class</label>
                        <select name="vehicle_type_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Class</option>
                            @foreach($vehicleTypes as $type)
                                <option value="{{ $type->id }}" {{ old('vehicle_type_id', $booking->vehicle_type_id) == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Package -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Package</label>
                        <select name="package_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Package</option>
                            @foreach($packages as $pkg)
                                <option value="{{ $pkg->id }}" {{ old('package_id', $booking->package_id) == $pkg->id ? 'selected' : '' }}>{{ $pkg->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Driver -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Driver</label>
                        <select name="driver_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Select Driver</option>
                            @foreach($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ old('driver_id', $booking->driver_id) == $driver->id ? 'selected' : '' }}>{{ $driver->name }} ({{ $driver->phone }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Amount -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500">₹</span>
                            <input type="number" name="amount" required step="0.01" min="0" value="{{ old('amount', $booking->amount) }}" placeholder="0.00" class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>

                    <!-- Pickup Location -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pickup Location</label>
                        <input type="text" name="pickup_location" required value="{{ old('pickup_location', $booking->pickup_location) }}" placeholder="Enter a City or Airport" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Dropoff Location -->
                    <div class="col-span-1 md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Dropoff Location</label>
                        <input type="text" name="drop_location" required value="{{ old('drop_location', $booking->drop_location) }}" placeholder="Enter a City or Airport" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Start Date</label>
                        <input type="date" name="book_date" required value="{{ old('book_date', $booking->book_date->format('Y-m-d')) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- End Date -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">End Date</label>
                        <input type="date" name="end_date" value="{{ old('end_date', optional($booking->end_date)->format('Y-m-d')) }}" placeholder="--:--" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Trip Codes Section -->
                    <div class="col-span-1 md:col-span-2 border-t border-gray-100 pt-6 mt-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Trip Codes</h3>
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Trip Start OTP</label>
                                <input type="text" name="trip_start_otp" value="{{ old('trip_start_otp', $booking->trip_start_otp) }}" placeholder="e.g. 1234" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-mono tracking-wider">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Trip End OTP</label>
                                <input type="text" name="trip_end_otp" value="{{ old('trip_end_otp', $booking->trip_end_otp) }}" placeholder="e.g. 5678" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-mono tracking-wider">
                            </div>
                        </div>
                    </div>

                    <!-- Documents Section -->
                    <div class="col-span-1 md:col-span-2 border-t border-gray-100 pt-6 mt-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Trip Documents</h3>
                        
                        <!-- Uploaded Documents List -->
                        @if($booking->documents && count(is_array($booking->documents) ? $booking->documents : json_decode($booking->documents, true) ?? []) > 0)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Uploaded Documents</label>
                                <ul class="border border-gray-200 rounded-lg divide-y divide-gray-200">
                                    @foreach(is_array($booking->documents) ? $booking->documents : json_decode($booking->documents, true) as $doc)
                                        <li class="px-4 py-3 flex items-center justify-between text-sm">
                                            <div class="flex items-center">
                                                <svg class="flex-shrink-0 h-5 w-5 text-gray-400 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                <span class="truncate">{{ basename($doc) }}</span>
                                            </div>
                                            <a href="{{ asset('storage/' . $doc) }}" target="_blank" class="font-medium text-blue-600 hover:text-blue-500">View</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @else
                            <p class="text-sm text-gray-500 italic mb-4">No documents uploaded yet.</p>
                        @endif

                        <!-- Upload New Documents -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload Documents</label>
                            <input type="file" name="documents[]" multiple class="block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100">
                            <p class="mt-1 text-xs text-gray-500">PDF, Images, or Doc files up to 10MB.</p>
                        </div>
                    </div>

                    <!-- Verification Status -->
                    <div class="col-span-1 md:col-span-2 border-t border-gray-100 pt-6 mt-2">
                        <label class="block text-sm font-medium text-gray-700 mb-3">Verification Status</label>
                        <div class="flex items-center space-x-8">
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="verification_status" value="Verified" {{ old('verification_status', $booking->verification_status) == 'Verified' ? 'checked' : '' }} class="w-4 h-4 text-green-600 focus:ring-green-500">
                                <span class="ml-2 text-sm font-medium text-gray-900">Verified</span>
                            </label>
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="verification_status" value="Not Verified" {{ old('verification_status', $booking->verification_status) == 'Not Verified' ? 'checked' : '' }} class="w-4 h-4 text-red-600 focus:ring-red-500">
                                <span class="ml-2 text-sm font-medium text-gray-900">Not Verified</span>
                            </label>
                        </div>
                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-gray-200">
                    <a href="{{ route('admin.trips.index') }}" class="px-8 py-3 bg-teal-600 text-white rounded-lg font-semibold hover:bg-teal-700 transition-colors">
                        CANCEL
                    </a>
                    <button type="submit" class="px-8 py-3 bg-orange-500 text-white rounded-lg font-semibold hover:bg-orange-600 transition-colors">
                        UPDATE
                    </button>
                </div>

            </form>

        </div>
    </div>
</x-app-layout>
