<div class="p-8">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-white">Profile Information</h2>
        <div class="h-px bg-gradient-to-r from-orange-500 to-transparent flex-1 ml-4"></div>
    </div>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
        @csrf
        @method('patch')

        <!-- Name Field -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                {{ __('Full Name') }}
            </label>
            <input id="name" name="name" type="text"
                   class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200"
                   value="{{ old('name', $user->name) }}"
                   required autofocus autocomplete="name"
                   placeholder="Enter your full name">
            @error('name')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Field -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                {{ __('Email Address') }}
            </label>
            <input id="email" name="email" type="email"
                   class="w-full px-4 py-3 bg-gray-700/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200"
                   value="{{ old('email', $user->email) }}"
                   required autocomplete="username"
                   placeholder="Enter your email address">
            @error('email')
                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-4 bg-yellow-500/10 border border-yellow-500/30 rounded-lg">
                    <p class="text-sm text-yellow-300">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification"
                                class="underline text-yellow-400 hover:text-yellow-200 font-medium">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-400 font-medium">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Action Buttons -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-700">
            <div class="flex items-center gap-4">
                <button type="submit"
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-medium rounded-lg shadow-lg transition duration-200 transform hover:scale-105">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ __('Save Changes') }}
                </button>

                @if (session('status') === 'profile-updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                       class="text-sm text-green-400 font-medium">
                        <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ __('Profile updated successfully!') }}
                    </p>
                @endif
            </div>
        </div>
    </form>

    <!-- Separate verification form -->
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
</div>
