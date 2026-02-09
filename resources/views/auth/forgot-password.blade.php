<x-guest-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight">Recover</h1>
        <p class="text-gray-500 font-medium mt-1">Forgot your password? No problem. Just let us know your email address.</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6 bg-green-50 text-green-700 p-4 rounded-2xl font-bold text-sm" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Registered Email')" class="font-bold text-gray-700 ml-1" />
            <x-text-input id="email" class="block w-full border-0 bg-gray-50 rounded-2xl px-6 py-4 focus:ring-2 focus:ring-black transition-all font-medium" type="email" name="email" :value="old('email')" required autofocus placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="pt-2">
            <button class="w-full bg-black text-white py-4 rounded-2xl font-bold text-lg hover:bg-gray-800 transition-all shadow-xl shadow-black/20 transform active:scale-[0.98]">
                {{ __('Reset Link') }}
            </button>
        </div>

        <div class="text-center">
            <a href="{{ route('login') }}" class="text-sm font-bold text-gray-400 hover:text-black flex items-center justify-center transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Sign In
            </a>
        </div>
    </form>
</x-guest-layout>
