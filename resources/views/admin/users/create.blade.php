<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Create New User') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                
                <form method="POST" action="{{ route('admin.users.store') }}" class="p-8 space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Name
                        </label>
                        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm block w-full mt-1" 
                               id="name" type="text" name="name" value="{{ old('name') }}" required autofocus />
                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="email">
                            Email
                        </label>
                        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm block w-full mt-1" 
                               id="email" type="email" name="email" value="{{ old('email') }}" required />
                        @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="phone">
                            Phone (Optional)
                        </label>
                        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm block w-full mt-1" 
                               id="phone" type="text" name="phone" value="{{ old('phone') }}" />
                        @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="role">
                            Role
                        </label>
                        <select id="role" name="role" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm block w-full mt-1">
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Customer)</option>
                            <option value="editor" {{ old('role') == 'editor' ? 'selected' : '' }}>Editor</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="super_admin" {{ old('role') == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                        </select>
                        @error('role') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        <p class="text-xs text-gray-500 mt-2">
                            <strong>Super Admin:</strong> Full access. <strong>Admin:</strong> Manage users/content. <strong>Editor:</strong> Manage content only.
                        </p>
                    </div>

                    <!-- Password -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block font-medium text-sm text-gray-700" for="password">
                                Password
                            </label>
                            <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm block w-full mt-1" 
                                   id="password" type="password" name="password" required autocomplete="new-password" />
                            @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700" for="password_confirmation">
                                Confirm Password
                            </label>
                            <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm block w-full mt-1" 
                                   id="password_confirmation" type="password" name="password_confirmation" required />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:bg-gray-300 active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 mr-4">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Create User
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
