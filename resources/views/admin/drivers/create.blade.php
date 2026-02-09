<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center space-x-4">
            <a href="{{ route('admin.drivers.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Drivers
            </a>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Add Driver') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <form action="{{ route('admin.drivers.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                        <!-- Left Column: Form Fields -->
                        <div class="space-y-8">
                            <div>
                                <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                                    <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-3 text-sm">1</span>
                                    Basic Info
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-600 mb-2">Name <span class="text-red-500">*</span></label>
                                        <input type="text" name="name" required value="{{ old('name') }}" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror">
                                        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-600 mb-2">Mobile Number <span class="text-red-500">*</span></label>
                                            <input type="text" name="mobile" required value="{{ old('mobile') }}" placeholder="10 digit mobile" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 @error('mobile') border-red-500 @enderror">
                                            @error('mobile') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                        <div>
                                            <label class="block text-sm font-semibold text-gray-600 mb-2">Email ID</label>
                                            <input type="email" name="email" value="{{ old('email') }}" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror">
                                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-600 mb-2">Address</label>
                                        <textarea name="address" rows="3" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">{{ old('address') }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                                    <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-3 text-sm">2</span>
                                    Location
                                </h3>
                                <div class="grid grid-cols-2 gap-4" x-data="{ state_id: '', cities: [] }">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-600 mb-2">State <span class="text-red-500">*</span></label>
                                        <select name="state_id" required x-model="state_id" @change="fetch('/api/cities?state_id=' + state_id).then(r => r.json()).then(d => cities = d)" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Select State</option>
                                            @foreach($states as $state)
                                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-600 mb-2">City <span class="text-red-500">*</span></label>
                                        <select name="city_id" required class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                                            <option value="">Select City</option>
                                            <template x-for="city in cities" :key="city.id">
                                                <option :value="city.id" x-text="city.name"></option>
                                            </template>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                                    <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-3 text-sm">3</span>
                                    Wallet + Login
                                </h3>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-600 mb-2">Wallet Amount</label>
                                        <input type="number" name="wallet_amount" value="0" class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-600 mb-2">Password <span class="text-red-500">*</span></label>
                                        <input type="password" name="password" required class="w-full border-gray-200 rounded-xl focus:ring-blue-500 focus:border-blue-500 @error('password') border-red-500 @enderror">
                                        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                                    </div>
                                </div>
                            </div>

                            <div>
                                <h3 class="text-lg font-bold text-gray-800 mb-4">Verification Status</h3>
                                <div class="flex space-x-6">
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="radio" name="verification_status" value="verified" class="text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm font-medium text-gray-700">Verified</span>
                                    </label>
                                    <label class="flex items-center space-x-2 cursor-pointer">
                                        <input type="radio" name="verification_status" value="not_verified" checked class="text-blue-600 focus:ring-blue-500">
                                        <span class="text-sm font-medium text-gray-700">Not Verified</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column: Document Uploads -->
                        <div>
                            <h3 class="text-lg font-bold text-gray-800 mb-6 flex items-center">
                                <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center mr-3 text-sm">4</span>
                                Document Upload Section
                            </h3>
                            <div class="grid grid-cols-2 gap-6">
                                <!-- Driver Photo -->
                                <x-doc-upload label="Driver Photo" name="driver_photo" required="true" />
                                <x-doc-upload label="Aadhar Front" name="aadhar_front" required="true" />
                                <x-doc-upload label="Aadhar Back" name="aadhar_back" required="true" />
                                <x-doc-upload label="DL Front" name="dl_front" required="true" />
                                <x-doc-upload label="DL Back" name="dl_back" required="true" />
                                <x-doc-upload label="Health Certificate" name="health_certificate" />
                                <x-doc-upload label="UPI QR Code" name="upi_qr_code" />
                            </div>
                        </div>
                    </div>

                    <div class="mt-12 flex justify-end space-x-4 border-t pt-8">
                        <a href="{{ route('admin.drivers.index') }}" class="px-8 py-3 bg-gray-100 text-gray-600 rounded-xl font-bold hover:bg-gray-200 transition-all">CANCEL</a>
                        <button type="submit" class="px-12 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 shadow-lg shadow-blue-200 transition-all">CREATE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
