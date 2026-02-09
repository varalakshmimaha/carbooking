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
                {{ __('Driver Details: ') }} {{ $driver->name }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Profile Summary -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center">
                    <div class="w-32 h-32 rounded-full overflow-hidden mb-4 border-4 border-blue-50 shadow-sm">
                        @if($driver->documents && $driver->documents->driver_photo)
                            <img src="{{ asset('storage/' . $driver->documents->driver_photo) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400">
                                <svg class="h-16 w-16" fill="currentColor" viewBox="0 0 20 20"><path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/></svg>
                            </div>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-gray-900">{{ $driver->name }}</h3>
                    <p class="text-sm text-gray-500 font-mono">{{ $driver->driver_code }}</p>
                    
                    <div class="mt-6 w-full space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Status:</span>
                            <span class="font-semibold {{ $driver->verification_status === 'verified' ? 'text-green-600' : 'text-red-600' }}">
                                {{ ucfirst(str_replace('_', ' ', $driver->verification_status)) }}
                            </span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Wallet:</span>
                            <span class="font-bold text-gray-900">₹{{ number_format($driver->wallet_amount, 2) }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Joined:</span>
                            <span class="text-gray-900">{{ $driver->created_at->format('d M Y') }}</span>
                        </div>
                    </div>

                    <div class="mt-8 w-full">
                        <a href="{{ route('admin.drivers.edit', $driver) }}" class="block w-full text-center bg-gray-50 hover:bg-gray-100 text-gray-700 py-2 rounded-xl text-sm font-bold transition-all">EDIT PROFILE</a>
                    </div>
                </div>

                <!-- Contact & Info -->
                <div class="md:col-span-2 space-y-8">
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-6">Contact Information</h3>
                        <div class="grid grid-cols-2 gap-8">
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Mobile</p>
                                <p class="text-gray-900 font-medium">{{ $driver->mobile }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Email</p>
                                <p class="text-gray-900 font-medium">{{ $driver->email ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">State / City</p>
                                <p class="text-gray-900 font-medium">{{ $driver->state->name ?? 'N/A' }} / {{ $driver->city->name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-gray-400 uppercase tracking-widest mb-1">Full Address</p>
                                <p class="text-gray-900 font-medium text-sm">{{ $driver->address ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Documents Grid -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800 mb-6">Uploaded Documents</h3>
                        <div class="grid grid-cols-2 lg:grid-cols-3 gap-6">
                            @php
                                $docs = [
                                    'Aadhar Front' => $driver->documents?->aadhar_front ?? null,
                                    'Aadhar Back' => $driver->documents?->aadhar_back ?? null,
                                    'DL Front' => $driver->documents?->dl_front ?? null,
                                    'DL Back' => $driver->documents?->dl_back ?? null,
                                    'Health Cert' => $driver->documents?->health_certificate ?? null,
                                    'UPI QR' => $driver->documents?->upi_qr_code ?? null,
                                ];
                            @endphp

                            @foreach($docs as $label => $path)
                            <div class="space-y-2">
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-widest">{{ $label }}</p>
                                <div class="aspect-video bg-gray-50 rounded-xl overflow-hidden border border-gray-100 group relative">
                                    @if($path)
                                        @if(Str::endsWith($path, '.pdf'))
                                            <div class="w-full h-full flex flex-col items-center justify-center text-red-500">
                                                <svg class="h-10 w-10" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"/></svg>
                                                <span class="text-[10px] font-bold mt-1 uppercase">PDF Document</span>
                                            </div>
                                        @else
                                            <img src="{{ asset('storage/' . $path) }}" class="w-full h-full object-cover">
                                        @endif
                                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all flex items-center justify-center opacity-0 group-hover:opacity-100">
                                            <a href="{{ asset('storage/' . $path) }}" target="_blank" class="bg-white text-gray-800 px-3 py-1 rounded-lg text-xs font-bold shadow-lg">VIEW FULL</a>
                                        </div>
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300 italic text-[10px]">
                                            Not Uploaded
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
