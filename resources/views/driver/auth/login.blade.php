<x-guest-layout>
    <div class="mb-6 text-center">
        <a href="/">
             <div class="h-14 w-14 bg-black rounded-xl flex items-center justify-center mx-auto mb-2 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                </svg>
            </div>
            <h2 class="text-2xl font-black tracking-tight text-gray-900">Driver Portal</h2>
            <p class="text-sm text-gray-500 font-medium">Log in to manage your rides</p>
        </a>
    </div>

    <form method="POST" action="{{ route('driver.login.submit') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Driver Email')" class="text-xs uppercase tracking-wider font-bold text-gray-500 mb-1" />
            <x-text-input id="email" class="block mt-1 w-full bg-gray-50 border-gray-200 focus:bg-white transition-colors py-3 rounded-xl" type="email" name="email" :value="old('email')" required autofocus placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" class="text-xs uppercase tracking-wider font-bold text-gray-500 mb-1" />
            <x-text-input id="password" class="block mt-1 w-full bg-gray-50 border-gray-200 focus:bg-white transition-colors py-3 rounded-xl" type="password" name="password" required autocomplete="current-password" placeholder="Enter your password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-black shadow-sm focus:border-black focus:ring focus:ring-black focus:ring-opacity-20" name="remember">
                <span class="ml-2 text-sm text-gray-600 font-medium">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center py-4 text-base font-bold tracking-tight rounded-xl shadow-lg shadow-blue-500/30">
                {{ __('Secure Login') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
