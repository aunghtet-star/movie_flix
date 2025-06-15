@extends('admin.layouts.app')
@section('content')

<div class="min-h-screen flex items-center justify-center p-4">
<div class="w-full max-w-md">
    <!-- Header -->
    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-black mb-2">Movie Flix Admin</h1>
        <p class="text-gray-600">Create administrator account</p>
    </div>

    <!-- Form -->
    <div class="bg-gray-800/10 backdrop-blur-lg rounded-2xl shadow-2xl p-8 border border-black/20">
        <form class="space-y-6" action="{{ route('admins.store') }}" method="POST">
            @csrf
            <!-- Admin Name Field -->
            <div>
                <label for="name" class="block text-sm font-medium text-black mb-2">
                    Admin Name
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    class="w-full px-4 py-3 bg-gray-800/10 border border-white/30 rounded-lg text-black placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                    placeholder="Enter your full name"
                >
            </div>

            <!-- Email Field -->
            <div>
                <label for="email" class="block text-sm font-medium text-black mb-2">
                    Email Address
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    class="w-full px-4 py-3 bg-gray-800/10 border border-white/30 rounded-lg text-black placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                    placeholder="admin@moviehub.com"
                >
            </div>

            <!-- Password Field -->
            <div>
                <label for="password" class="block text-sm font-medium text-black mb-2">
                    Password
                </label>
                <div class="relative">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        minlength="8"
                        class="w-full px-4 py-3 bg-gray-800/10 border border-white/30 rounded-lg text-black placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                        placeholder="Create a strong password"
                    >
                    <button
                        type="button"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 hover:text-black transition-colors"
                        onclick="togglePassword('password')"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                <p class="text-xs text-gray-600 mt-1">Must be at least 8 characters long</p>
            </div>

            <!-- Retype Password Field -->
            <div>
                <label for="retypePassword" class="block text-sm font-medium text-black mb-2">
                    Retype Password
                </label>
                <div class="relative">
                    <input
                        type="password"
                        id="retypePassword"
                        name="retypePassword"
                        required
                        minlength="8"
                        class="w-full px-4 py-3 bg-gray-800/10 border border-white/30 rounded-lg text-black placeholder-gray-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition-all duration-200"
                        placeholder="Confirm your password"
                    >
                    <button
                        type="button"
                        class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 hover:text-black transition-colors"
                        onclick="togglePassword('retypePassword')"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-black font-semibold py-3 px-4 rounded-lg transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-transparent"
            >
                Create Admin Account
            </button>

        </form>
    </div>
</div>

<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
        field.setAttribute('type', type);
    }

    // Basic password matching validation
    document.getElementById('retypePassword').addEventListener('input', function() {
        const password = document.getElementById('password').value;
        const retypePassword = this.value;

        if (password !== retypePassword) {
            this.setCustomValidity('Passwords do not match');
        } else {
            this.setCustomValidity('');
        }
    });
</script>
</div>


@endsection
