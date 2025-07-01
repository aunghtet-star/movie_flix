<div class="p-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Change Password</h2>
        <div class="h-px bg-gradient-to-r from-orange-500 to-transparent flex-1 ml-4"></div>
    </div>

    <form method="post" action="{{ route('password.update') }}" class="space-y-6" x-data="{ showPasswords: false }">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-300 mb-2">
                {{ __('Current Password') }}
            </label>
            <div class="relative">
                <input id="current_password" name="current_password"
                       :type="showPasswords ? 'text' : 'password'"
                       class="w-full px-4 py-3 pr-12 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200"
                       placeholder="Enter your current password"
                       autocomplete="current-password"
                       required>
                <button type="button" @click="showPasswords = !showPasswords"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-orange-400 transition duration-200">
                    <svg x-show="!showPasswords" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    <svg x-show="showPasswords" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                    </svg>
                </button>
            </div>
            @error('current_password', 'updatePassword')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                {{ __('New Password') }}
            </label>
            <div class="relative">
                <input id="password" name="password"
                       :type="showPasswords ? 'text' : 'password'"
                       class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200"
                       placeholder="Enter your new password"
                       autocomplete="new-password"
                       required>
            </div>
            @error('password', 'updatePassword')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
            <div class="mt-2 text-sm text-gray-400">
                <p>Password must be at least 8 characters long and contain:</p>
                <ul class="list-disc list-inside mt-1 space-y-1">
                    <li>At least one uppercase letter</li>
                    <li>At least one lowercase letter</li>
                    <li>At least one number</li>
                </ul>
            </div>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">
                {{ __('Confirm New Password') }}
            </label>
            <div class="relative">
                <input id="password_confirmation" name="password_confirmation"
                       :type="showPasswords ? 'text' : 'password'"
                       class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200"
                       placeholder="Confirm your new password"
                       autocomplete="new-password"
                       required>
            </div>
            @error('password_confirmation', 'updatePassword')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Security Note -->
        <div class="bg-blue-500/10 border border-blue-500/30 rounded-lg p-4">
            <div class="flex items-start">
                <svg class="w-5 h-5 text-blue-400 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="text-sm text-blue-300">
                    <p class="font-medium mb-1">Security Tip:</p>
                    <p>Choose a strong password that you haven't used elsewhere. After changing your password, you'll remain logged in on this device.</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-700">
            <div class="flex items-center gap-4">
                <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-medium rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    {{ __('Update Password') }}
                </button>

                @if (session('status') === 'password-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                       class="text-sm text-green-400 font-medium">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ __('Password updated successfully!') }}
                    </p>
                @endif
            </div>
        </div>
    </form>
</div>
