<x-app-layout>
    <div class="py-12 bg-gray-50" x-data="{ activeTab: 'payment' }">
        <div class="max-w-7xl mx-auto px-6">
            
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Settings</h1>
                <nav class="text-sm text-gray-500 mt-1">
                    <a href="{{ route('dashboard') }}" class="hover:text-gray-900">Dashboard</a>
                    <span class="mx-2">/</span>
                    <span class="text-gray-900">Settings</span>
                </nav>
            </div>

            <!-- Tabs Navigation -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-8">
                <div class="flex overflow-x-auto scrollbar-hide border-b border-gray-100">
                    <template x-for="tab in [
                        { id: 'payment', label: 'Payment Settings', icon: 'M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z' },
                        { id: 'logo', label: 'Logo Settings', icon: 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z' },
                        { id: 'system', label: 'System Settings', icon: 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z' },
                        { id: 'company', label: 'Company Settings', icon: 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4' },
                        { id: 'social', label: 'Social Media', icon: 'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1' },
                        { id: 'email', label: 'Email Settings', icon: 'M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z' },
                        { id: 'google_map', label: 'Google Map', icon: 'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7' },
                        { id: 'password', label: 'Change Password', icon: 'M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z' }
                    ]">
                        <button 
                            @click="activeTab = tab.id"
                            :class="activeTab === tab.id ? 'border-blue-600 text-blue-600 bg-blue-50' : 'border-transparent text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
                            class="flex-shrink-0 px-6 py-4 border-b-2 font-medium text-sm flex items-center transition-all focus:outline-none"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor font-medium">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" :d="tab.icon" />
                            </svg>
                            <span x-text="tab.label"></span>
                        </button>
                    </template>
                </div>
            </div>

            <!-- Content Container -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                
                <!-- Payment Settings -->
                <div x-show="activeTab === 'payment'">
                    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="group" value="payment">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                            <div class="space-y-6">
                                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                                    <span class="w-10 h-10 bg-green-100 text-green-600 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                    </span>
                                    Enable Methods
                                </h3>
                                <div class="space-y-4">
                                    <label class="flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition-all cursor-pointer">
                                        <span class="font-semibold text-gray-700">Razorpay</span>
                                        <input type="checkbox" name="razorpay_enabled" value="1" class="w-6 h-6 rounded text-blue-600 focus:ring-blue-500" {{ ($settings['payment']['razorpay_enabled'] ?? '') == '1' ? 'checked' : '' }}>
                                    </label>
                                    <label class="flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition-all cursor-pointer">
                                        <span class="font-semibold text-gray-700">Cash on Delivery</span>
                                        <input type="checkbox" name="cod_enabled" value="1" class="w-6 h-6 rounded text-blue-600 focus:ring-blue-500" {{ ($settings['payment']['cod_enabled'] ?? '') == '1' ? 'checked' : '' }}>
                                    </label>
                                    <label class="flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition-all cursor-pointer">
                                        <span class="font-semibold text-gray-700">Manual Payment</span>
                                        <input type="checkbox" name="manual_payment_enabled" value="1" class="w-6 h-6 rounded text-blue-600 focus:ring-blue-500" {{ ($settings['payment']['manual_payment_enabled'] ?? '') == '1' ? 'checked' : '' }}>
                                    </label>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                                    <span class="w-10 h-10 bg-indigo-100 text-indigo-600 rounded-lg flex items-center justify-center mr-3">
                                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" /></svg>
                                    </span>
                                    Razorpay Credentials
                                </h3>
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Key ID</label>
                                        <input type="text" name="razorpay_key_id" value="{{ $settings['payment']['razorpay_key_id'] ?? '' }}" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Key Secret</label>
                                        <input type="password" name="razorpay_key_secret" value="{{ $settings['payment']['razorpay_key_secret'] ?? '' }}" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold text-gray-700 mb-2">Webhook Secret</label>
                                        <input type="text" name="razorpay_webhook_secret" value="{{ $settings['payment']['razorpay_webhook_secret'] ?? '' }}" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pt-8 border-t border-gray-50 flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg shadow-blue-200">Save Payment Settings</button>
                        </div>
                    </form>
                </div>

                <!-- Logo Settings -->
                <div x-show="activeTab === 'logo'">
                    <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        <input type="hidden" name="group" value="logo">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="space-y-4">
                                <label class="block text-sm font-bold text-gray-700">Site Logo</label>
                                <div class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center hover:border-blue-400 transition-all bg-gray-50">
                                    @if(isset($settings['logo']['logo']))
                                        <img src="{{ asset('storage/' . $settings['logo']['logo']) }}" class="h-20 mx-auto mb-4 object-contain">
                                    @endif
                                    <input type="file" name="logo" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                </div>
                            </div>
                            <div class="space-y-4">
                                <label class="block text-sm font-bold text-gray-700">Favicon</label>
                                <div class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center hover:border-blue-400 transition-all bg-gray-50">
                                    @if(isset($settings['logo']['favicon']))
                                        <img src="{{ asset('storage/' . $settings['logo']['favicon']) }}" class="h-12 w-12 mx-auto mb-4 object-contain">
                                    @endif
                                    <input type="file" name="favicon" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                </div>
                            </div>
                            <div class="space-y-4">
                                <label class="block text-sm font-bold text-gray-700">Admin Logo</label>
                                <div class="border-2 border-dashed border-gray-200 rounded-2xl p-6 text-center hover:border-blue-400 transition-all bg-gray-50">
                                    @if(isset($settings['logo']['admin_logo']))
                                        <img src="{{ asset('storage/' . $settings['logo']['admin_logo']) }}" class="h-20 mx-auto mb-4 object-contain">
                                    @endif
                                    <input type="file" name="admin_logo" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                                </div>
                            </div>
                        </div>
                        <div class="pt-8 border-t border-gray-50 flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg shadow-blue-200">Save Logo Settings</button>
                        </div>
                    </form>
                </div>

                <!-- System Settings -->
                <div x-show="activeTab === 'system'">
                    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="group" value="system">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Site Name</label>
                                <input type="text" name="site_name" value="{{ $settings['system']['site_name'] ?? '' }}" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Site URL</label>
                                <input type="text" name="site_url" value="{{ $settings['system']['site_url'] ?? '' }}" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Time Zone</label>
                                <select name="timezone" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    <option value="Asia/Kolkata" {{ ($settings['system']['timezone'] ?? '') == 'Asia/Kolkata' ? 'selected' : '' }}>Asia/Kolkata (IST)</option>
                                    <option value="UTC" {{ ($settings['system']['timezone'] ?? '') == 'UTC' ? 'selected' : '' }}>UTC</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Maintenance Mode</label>
                                <select name="maintenance_mode" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                    <option value="0" {{ ($settings['system']['maintenance_mode'] ?? '') == '0' ? 'selected' : '' }}>Disabled</option>
                                    <option value="1" {{ ($settings['system']['maintenance_mode'] ?? '') == '1' ? 'selected' : '' }}>Enabled</option>
                                </select>
                            </div>
                        </div>
                        <div class="pt-8 border-t border-gray-50 flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg shadow-blue-200">Save System Settings</button>
                        </div>
                    </form>
                </div>

                <!-- Company Settings -->
                <div x-show="activeTab === 'company'">
                    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="group" value="company">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Company Name</label>
                                <input type="text" name="company_name" value="{{ $settings['company']['company_name'] ?? '' }}" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Address</label>
                                <textarea name="company_address" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">{{ $settings['company']['company_address'] ?? '' }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Contact Email</label>
                                <input type="email" name="company_email" value="{{ $settings['company']['company_email'] ?? '' }}" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Contact Phone</label>
                                <input type="text" name="company_phone" value="{{ $settings['company']['company_phone'] ?? '' }}" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <div class="pt-8 border-t border-gray-50 flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg shadow-blue-200">Save Company Settings</button>
                        </div>
                    </form>
                </div>

                <!-- Social Settings -->
                <div x-show="activeTab === 'social'">
                    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="group" value="social">
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Facebook URL</label>
                                <input type="text" name="facebook_url" value="{{ $settings['social']['facebook_url'] ?? '' }}" placeholder="https://facebook.com/..." class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Instagram URL</label>
                                <input type="text" name="instagram_url" value="{{ $settings['social']['instagram_url'] ?? '' }}" placeholder="https://instagram.com/..." class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">X / Twitter URL</label>
                                <input type="text" name="twitter_url" value="{{ $settings['social']['twitter_url'] ?? '' }}" placeholder="https://x.com/..." class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">LinkedIn URL</label>
                                <input type="text" name="linkedin_url" value="{{ $settings['social']['linkedin_url'] ?? '' }}" placeholder="https://linkedin.com/..." class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <div class="pt-8 border-t border-gray-50 flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg shadow-blue-200">Save Social Media Settings</button>
                        </div>
                    </form>
                </div>

                <!-- Email Settings -->
                <div x-show="activeTab === 'email'">
                    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="group" value="email">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">SMTP Host</label>
                                <input type="text" name="mail_host" value="{{ $settings['email']['mail_host'] ?? '' }}" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">SMTP Port</label>
                                <input type="text" name="mail_port" value="{{ $settings['email']['mail_port'] ?? '' }}" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">SMTP Username</label>
                                <input type="text" name="mail_username" value="{{ $settings['email']['mail_username'] ?? '' }}" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">SMTP Password</label>
                                <input type="password" name="mail_password" value="{{ $settings['email']['mail_password'] ?? '' }}" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">From Email</label>
                                <input type="email" name="mail_from_address" value="{{ $settings['email']['mail_from_address'] ?? '' }}" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">From Name</label>
                                <input type="text" name="mail_from_name" value="{{ $settings['email']['mail_from_name'] ?? '' }}" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>
                        <div class="pt-8 border-t border-gray-50 flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg shadow-blue-200">Save Email Settings</button>
                        </div>
                    </form>
                </div>

                <!-- Google Map Settings -->
                <div x-show="activeTab === 'google_map'">
                    <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-8">
                        @csrf
                        <input type="hidden" name="group" value="google_map">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Google Maps API Key</label>
                                <input type="text" name="google_maps_api_key" value="{{ $settings['google_map']['google_maps_api_key'] ?? '' }}" class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500" placeholder="AIza...">
                                <p class="text-xs text-gray-500 mt-1">Required for map display, autocomplete, and distance calculations on the booking page.</p>
                            </div>
                        </div>
                        <div class="pt-8 border-t border-gray-50 flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg shadow-blue-200">Save Google Map Settings</button>
                        </div>
                    </form>
                </div>

                <!-- Password Tab -->
                <div x-show="activeTab === 'password'">
                    <form action="{{ route('admin.settings.update') }}" method="POST" class="max-w-md mx-auto space-y-6">
                        @csrf
                        <input type="hidden" name="group" value="password">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Current Password</label>
                            <input type="password" name="current_password" required class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            @error('current_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">New Password</label>
                            <input type="password" name="new_password" required class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                            @error('new_password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Confirm New Password</label>
                            <input type="password" name="new_password_confirmation" required class="w-full border-gray-200 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div class="pt-6">
                            <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-8 py-3 rounded-xl font-bold transition-all shadow-lg shadow-red-200">Update Password</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <!-- Notification -->
    @if(session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="fixed bottom-8 right-8 bg-gray-900 text-white px-6 py-4 rounded-2xl shadow-2xl flex items-center space-x-3 z-50">
            <svg class="w-6 h-6 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor font-medium">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
            <span class="font-bold">{{ session('success') }}</span>
        </div>
    @endif

</x-app-layout>
