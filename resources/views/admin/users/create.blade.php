@extends('admin.layouts.app')
@section('content')

<div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white drop-shadow mb-2">Create User Account</h1>
            <p class="text-orange-300">Add a new user to MovieFlix</p>
        </div>
        <!-- Form -->
        <div class="bg-black/20 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 p-8">
            <form class="space-y-8" action="{{ route('users.store') }}" method="POST">
                @csrf
                <!-- User Avatar -->
                <div class="flex justify-center mb-6">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-r from-orange-500 to-red-600 flex items-center justify-center shadow-lg">
                        <i class="fas fa-user text-3xl text-white"></i>
                    </div>
                </div>
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-orange-300 font-semibold mb-2">
                        <i class="fas fa-user mr-2"></i>Full Name
                    </label>
                    <input type="text" id="name" name="name" required class="w-full px-4 py-3 bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" placeholder="Enter full name">
                    @error('name')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-orange-300 font-semibold mb-2">
                        <i class="fas fa-envelope mr-2"></i>Email Address
                    </label>
                    <input type="email" id="email" name="email" required class="w-full px-4 py-3 bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" placeholder="user@movieflix.com">
                    @error('email')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-orange-300 font-semibold mb-2">
                        <i class="fas fa-lock mr-2"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required minlength="8" class="w-full px-4 py-3 bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" placeholder="Create a strong password">
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-orange-300 hover:text-white transition-colors" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <p class="text-xs text-orange-300 mt-1">Must be at least 8 characters long</p>
                </div>
                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:ring-offset-2 focus:ring-offset-transparent">
                    <i class="fas fa-user mr-2"></i>Create User Account
                </button>
            </form>
        </div>
    </div>
</div>
<script>
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const type = field.getAttribute('type') === 'password' ? 'text' : 'password';
        field.setAttribute('type', type);
    }
</script>
@endsection