@extends('admin.layouts.app')
@section('content')

<div class="min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-xl">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white drop-shadow mb-2">Create Genre</h1>
            <p class="text-orange-300">Add a new genre to MovieFlix</p>
        </div>
        <!-- Form -->
        <div class="bg-black/20 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 p-8">
            <form class="space-y-8" action="{{ route('genres.store') }}" method="POST">
                @csrf
                <!-- Genre Icon -->
                <div class="flex justify-center mb-6">
                    <div class="w-20 h-20 rounded-full bg-gradient-to-r from-orange-500 to-red-600 flex items-center justify-center shadow-lg">
                        <i class="fas fa-tags text-3xl text-white"></i>
                    </div>
                </div>
                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-orange-300 font-semibold mb-2">
                        <i class="fas fa-tag mr-2"></i>Genre Name
                    </label>
                    <input type="text" id="name" name="name" required class="w-full px-4 py-3 bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" placeholder="Enter genre name">
                    @error('name')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-semibold py-3 px-4 rounded-xl shadow-lg transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:ring-offset-2 focus:ring-offset-transparent">
                    <i class="fas fa-tags mr-2"></i>Create Genre
                </button>
            </form>
        </div>
    </div>
</div>
@endsection