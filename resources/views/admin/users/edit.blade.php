<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                
                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Name -->
                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="name">
                            Name
                        </label>
                        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm block w-full mt-1" 
                               id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus />
                        @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="email">
                            Email
                        </label>
                        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm block w-full mt-1" 
                               id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required />
                        @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Phone -->
                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="phone">
                            Phone (Optional)
                        </label>
                        <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm block w-full mt-1" 
                               id="phone" type="text" name="phone" value="{{ old('phone', $user->phone) }}" />
                        @error('phone') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Role -->
                    <div>
                        <label class="block font-medium text-sm text-gray-700" for="role">
                            Role
                        </label>
                        <select id="role" name="role" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm block w-full mt-1">
                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User (Customer)</option>
                            <option value="editor" {{ old('role', $user->role) == 'editor' ? 'selected' : '' }}>Editor</option>
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="super_admin" {{ old('role', $user->role) == 'super_admin' ? 'selected' : '' }}>Super Admin</option>
                        </select>
                        @error('role') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Password -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-4 rounded-xl border border-gray-200">
                        <div class="col-span-2">
                             <h3 class="text-sm font-bold text-gray-900 mb-2">Change Password (Optional)</h3>
                             <p class="text-xs text-gray-500 mb-4">Leave blank to keep current password.</p>
                        </div>
                        <div>
                            <label class="block font-medium text-sm text-gray-700" for="password">
                                New Password
                            </label>
                            <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm block w-full mt-1" 
                                   id="password" type="password" name="password" autocomplete="new-password" />
                            @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block font-medium text-sm text-gray-700" for="password_confirmation">
                                Confirm New Password
                            </label>
                            <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-xl shadow-sm block w-full mt-1" 
                                   id="password_confirmation" type="password" name="password_confirmation" />
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4 pt-4 border-t border-gray-100">
                        <a href="{{ route('admin.users.index') }}" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 mr-4">
                            Cancel
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Update User
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
