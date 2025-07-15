@extends('admin.layouts.app')
@section('content')

<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Edit Admin</h1>
            <p class="text-orange-300">Update administrator information</p>
        </div>
        <a href="{{ route('admins.index') }}" class="bg-gradient-to-r from-gray-500/20 to-gray-600/20 text-gray-300 hover:from-gray-500/30 hover:to-gray-600/30 px-6 py-3 rounded-lg border border-gray-500/30 hover:border-gray-400/50 transition duration-200 backdrop-blur-sm">
            <i class="fas fa-arrow-left mr-2"></i>Back to Admins
        </a>
    </div>

    <!-- Admin Edit Form -->
    <div class="max-w-2xl mx-auto">
        <div class="bg-black/20 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 p-8">
            <form method="POST" action="{{ route('admins.update', $admin->id) }}">
                @csrf
                @method('PUT')

                <!-- Admin Avatar Section -->
                <div class="flex justify-center mb-8">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-r from-orange-500 to-red-600 flex items-center justify-center shadow-lg">
                        <span class="text-3xl font-bold text-white">{{ substr($admin->name, 0, 1) }}</span>
                    </div>
                </div>

                <!-- Name Field -->
                <div class="mb-6">
                    <label for="name" class="block text-orange-300 font-semibold mb-3">
                        <i class="fas fa-user mr-2"></i>Full Name
                    </label>
                    <input type="text" id="name" name="name" required value="{{ old('name', $admin->name) }}" class="w-full px-4 py-3 bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200">
                    @error('name')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Field -->
                <div class="mb-6">
                    <label for="email" class="block text-orange-300 font-semibold mb-3">
                        <i class="fas fa-envelope mr-2"></i>Email Address
                    </label>
                    <input type="email" id="email" name="email" required value="{{ old('email', $admin->email) }}" class="w-full px-4 py-3 bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200">
                    @error('email')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="mb-8">
                    <label for="password" class="block text-orange-300 font-semibold mb-3">
                        <i class="fas fa-lock mr-2"></i>Password
                        <span class="text-gray-400 text-sm font-normal">(leave blank to keep current password)</span>
                    </label>
                    <input type="password" id="password" name="password" placeholder="Enter new password..." class="w-full px-4 py-3 bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200">
                    @error('password')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('admins.index') }}" class="bg-gradient-to-r from-gray-500/20 to-gray-600/20 text-gray-300 hover:from-gray-500/30 hover:to-gray-600/30 px-6 py-3 rounded-lg border border-gray-500/30 hover:border-gray-400/50 transition duration-200 backdrop-blur-sm">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                    <button type="submit" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-200 shadow-lg">
                        <i class="fas fa-save mr-2"></i>Update Admin
                    </button>
                </div>
            </form>
        </div>

        <!-- Admin Information Card -->
        <div class="mt-6 bg-black/20 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 p-6">
            <h3 class="text-xl font-bold text-white drop-shadow mb-4">
                <i class="fas fa-info-circle text-orange-400 mr-2"></i>Admin Information
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-orange-300 font-semibold">Created:</span>
                    <span class="text-white ml-2">{{ $admin->created_at ? $admin->created_at->format('M d, Y') : 'N/A' }}</span>
                </div>
                <div>
                    <span class="text-orange-300 font-semibold">Last Updated:</span>
                    <span class="text-white ml-2">{{ $admin->updated_at ? $admin->updated_at->format('M d, Y') : 'N/A' }}</span>
                </div>
                <div>
                    <span class="text-orange-300 font-semibold">Admin ID:</span>
                    <span class="text-white ml-2">#{{ $admin->id }}</span>
                </div>
                <div>
                    <span class="text-orange-300 font-semibold">Status:</span>
                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-green-500/20 to-emerald-500/20 text-green-300 border border-green-500/30 ml-2">
                        <i class="fas fa-circle text-green-400 mr-1" style="font-size: 6px;"></i>
                        Active
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection