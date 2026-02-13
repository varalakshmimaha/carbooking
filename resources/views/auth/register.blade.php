<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Create Account</h1>
        <p class="text-gray-600">Join us today and start your journey</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5" x-data="{ 
        password: '', 
        confirmPassword: '',
        showPassword: false,
        showConfirmPassword: false,
        getPasswordStrength() {
            if (!this.password) return { label: '', color: '', width: '0%' };
            let strength = 0;
            if (this.password.length >= 8) strength++;
            if (/[a-z]/.test(this.password) && /[A-Z]/.test(this.password)) strength++;
            if (/[0-9]/.test(this.password)) strength++;
            if (/[^a-zA-Z0-9]/.test(this.password)) strength++;
            
            if (strength <= 1) return { label: 'Weak', color: 'bg-red-500', width: '25%' };
            if (strength === 2) return { label: 'Fair', color: 'bg-yellow-500', width: '50%' };
            if (strength === 3) return { label: 'Good', color: 'bg-blue-500', width: '75%' };
            return { label: 'Strong', color: 'bg-green-500', width: '100%' };
        }
    }">
        @csrf

        <!-- Full Name -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="block w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                    placeholder="Enter your full name">
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>



        <!-- Phone Number -->
        <div>
            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">Phone Number</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                </div>
                <input id="phone" type="tel" name="phone" value="{{ old('phone') }}" required
                    class="block w-full pl-12 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                    placeholder="Enter your phone number">
            </div>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <input id="password" :type="showPassword ? 'text' : 'password'" name="password" x-model="password" required autocomplete="new-password"
                    class="block w-full pl-12 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                    placeholder="Create a password">
                <button type="button" @click="showPassword = !showPassword" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                    <svg x-show="!showPassword" class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="showPassword" class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            
            <!-- Password Strength Indicator -->
            <div x-show="password" class="mt-2">
                <div class="flex items-center justify-between mb-1">
                    <span class="text-xs font-semibold text-gray-600">Password Strength:</span>
                    <span class="text-xs font-bold" :class="{
                        'text-red-600': getPasswordStrength().label === 'Weak',
                        'text-yellow-600': getPasswordStrength().label === 'Fair',
                        'text-blue-600': getPasswordStrength().label === 'Good',
                        'text-green-600': getPasswordStrength().label === 'Strong'
                    }" x-text="getPasswordStrength().label"></span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="h-2 rounded-full transition-all duration-300" 
                        :class="getPasswordStrength().color" 
                        :style="'width: ' + getPasswordStrength().width"></div>
                </div>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Confirm Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <input id="password_confirmation" :type="showConfirmPassword ? 'text' : 'password'" name="password_confirmation" x-model="confirmPassword" required autocomplete="new-password"
                    class="block w-full pl-12 pr-12 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all"
                    placeholder="Re-enter your password">
                <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute inset-y-0 right-0 pr-4 flex items-center">
                    <svg x-show="!showConfirmPassword" class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <svg x-show="showConfirmPassword" class="h-5 w-5 text-gray-400 hover:text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                    </svg>
                </button>
            </div>
            <div x-show="confirmPassword && password !== confirmPassword" class="mt-2 text-xs text-red-600">
                Passwords do not match
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Terms & Conditions -->
        <div class="flex items-start">
            <input id="terms" type="checkbox" name="terms" required class="mt-1 rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500">
            <label for="terms" class="ml-2 text-sm text-gray-600">
                I agree to the <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold">Terms & Conditions</a> and <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold">Privacy Policy</a>
            </label>
        </div>

        <!-- Create Account Button -->
        <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold text-base hover:bg-blue-700 transition-all shadow-lg">
            Create Account
        </button>

        <!-- Sign In Link -->
        <div class="text-center pt-4 border-t border-gray-200">
            <p class="text-sm text-gray-600">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:text-blue-700">
                    Sign In
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
