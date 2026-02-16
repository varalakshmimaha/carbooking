<x-driver-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Profile Information') }}
                            </h2>
                            <p class="mt-1 text-sm text-gray-600">
                                {{ __("Update your account's profile information and email address.") }}
                            </p>
                        </header>

                        @if (session('status') === 'profile-updated')
                            <p class="mt-2 text-sm text-green-600">{{ __('Saved.') }}</p>
                        @endif

                        <form method="post" action="{{ route('driver.profile.update') }}" class="mt-6 space-y-6">
                            @csrf
                            @method('patch')

                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $driver->name)" required autofocus autocomplete="name" />
                                <x-input-error class="mt-2" :messages="$errors->get('name')" />
                            </div>

                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $driver->email)" required autocomplete="username" />
                                <x-input-error class="mt-2" :messages="$errors->get('email')" />
                            </div>

                            <div>
                                <x-input-label for="phone" :value="__('Phone')" />
                                <x-text-input id="phone" name="phone" type="text" class="mt-1 block w-full" :value="old('phone', $driver->phone)" required autocomplete="tel" />
                                <x-input-error class="mt-2" :messages="$errors->get('phone')" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <h4 class="font-medium text-gray-900 mb-2">Change Password</h4>
                                    
                                    <div class="mb-4">
                                        <x-input-label for="current_password" :value="__('Current Password')" />
                                        <x-text-input id="current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
                                        <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                                    </div>

                                    <div class="mb-4">
                                        <x-input-label for="new_password" :value="__('New Password')" />
                                        <x-text-input id="new_password" name="new_password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('new_password')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="new_password_confirmation" :value="__('Confirm Password')" />
                                        <x-text-input id="new_password_confirmation" name="new_password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
                                        <x-input-error :messages="$errors->get('new_password_confirmation')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button>{{ __('Save') }}</x-primary-button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-driver-layout>
