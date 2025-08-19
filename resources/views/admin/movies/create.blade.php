@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Add New Movie</h1>
            <p class="text-orange-300">Create a new movie entry</p>
        </div>
        <a href="{{ route('admin_movies.index') }}" class="bg-gradient-to-r from-gray-500/20 to-gray-600/20 text-gray-300 hover:from-gray-500/30 hover:to-gray-600/30 px-6 py-3 rounded-lg border border-gray-500/30 hover:border-gray-400/50 transition duration-200 backdrop-blur-sm">
            <i class="fas fa-arrow-left mr-2"></i>Back to Movies
        </a>
    </div>

    <!-- Movie Create Form -->
    <div class="max-w-4xl mx-auto">
        <div class="bg-black/20 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 p-8">
            @if ($errors->any())
            <div class="mb-6 p-4 bg-red-900/30 text-red-300 rounded-xl border border-red-600/30">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('admin_movies.store') }}" class="space-y-6" enctype="multipart/form-data">
                @csrf

                <!-- Movie Icon Section -->
                <div class="flex justify-center mb-8">
                    <div class="w-24 h-24 rounded-full bg-gradient-to-r from-orange-500 to-red-600 flex items-center justify-center shadow-lg">
                        <i class="fas fa-film text-3xl text-white"></i>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Picture Field -->
                        <div>
                            <label for="picture" class="block text-orange-300 font-semibold mb-3">
                                <i class="fas fa-image mr-2"></i>Movie Picture
                            </label>
                            <input type="file" id="picture" name="picture" required accept="image/*" onchange="previewImage(event)" class="w-full px-4 py-3 bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-orange-500 file:text-white hover:file:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200">
                            <div id="preview-container" class="mt-3">
                                <img id="preview-image" src="#" alt="Preview" class="hidden w-40 h-auto rounded-xl shadow-lg border border-orange-400/30" />
                            </div>
                        </div>

                        <!-- Title Field -->
                        <div>
                            <label for="title" class="block text-orange-300 font-semibold mb-3">
                                <i class="fas fa-film mr-2"></i>Movie Title
                            </label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full px-4 py-3 bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" placeholder="Enter movie title">
                        </div>

                        <!-- Actor Field -->
                        <div>
                            <label for="actor" class="block text-orange-300 font-semibold mb-3">
                                <i class="fas fa-male mr-2"></i>Main Actor
                            </label>
                            <input type="text" id="actor" name="actor" value="{{ old('actor') }}" required class="w-full px-4 py-3 bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" placeholder="Enter main actor name">
                        </div>

                        <!-- Actress Field -->
                        <div>
                            <label for="actress" class="block text-orange-300 font-semibold mb-3">
                                <i class="fas fa-female mr-2"></i>Main Actress
                            </label>
                            <input type="text" id="actress" name="actress" value="{{ old('actress') }}" required class="w-full px-4 py-3 bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" placeholder="Enter main actress name">
                        </div>

                        <!-- Genre Field -->
                        <div>
                            <label for="genre_id" class="block text-orange-300 font-semibold mb-3">
                                <i class="fas fa-tags mr-2"></i>Genre
                            </label>
                            <select id="genre_id" name="genre_id" required class="w-full px-4 py-3 bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200">
                                <option value="">Select a genre...</option>
                                @foreach($genres as $genre)
                                <option value="{{ $genre->id }}" {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                    {{ $genre->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Year Field -->
                        <div>
                            <label for="year" class="block text-orange-300 font-semibold mb-3">
                                <i class="fas fa-calendar mr-2"></i>Release Year
                            </label>
                            <input type="number" id="year" name="year" value="{{ old('year') }}" required class="w-full px-4 py-3 bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" placeholder="e.g., 2024">
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="space-y-6">
                        <!-- Description Field -->
                        <div>
                            <label for="description" class="block text-orange-300 font-semibold mb-3">
                                <i class="fas fa-align-left mr-2"></i>Description
                            </label>
                            <textarea id="description" name="description" required rows="8" class="w-full px-4 py-3 bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200 resize-none" placeholder="Enter movie description">{{ old('description') }}</textarea>
                        </div>

                        <!-- Duration Field -->
                        <div>
                            <label for="long_time" class="block text-orange-300 font-semibold mb-3">
                                <i class="fas fa-clock mr-2"></i>Duration
                            </label>
                            <input type="text" id="long_time" name="long_time" value="{{ old('long_time') }}" required class="w-full px-4 py-3 bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" placeholder="e.g., 2h 30m">
                        </div>

                        <!-- Download Link Field -->
                        <div>
                            <label for="download_link" class="block text-orange-300 font-semibold mb-3">
                                <i class="fas fa-download mr-2"></i>Download Link
                            </label>
                            <input type="url" id="download_link" name="download_link" value="{{ old('download_link') }}" required class="w-full px-4 py-3 bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" placeholder="https://example.com/movie-download">
                        </div>

                        <!-- Trailer URL Field -->
                        <div>
                            <label for="trailer_url" class="block text-orange-300 font-semibold mb-3">
                                <i class="fas fa-play-circle mr-2"></i>Trailer URL <span class="text-gray-400 text-sm">(Optional)</span>
                            </label>
                            <input type="url" id="trailer_url" name="trailer_url" value="{{ old('trailer_url') }}" class="w-full px-4 py-3 bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" placeholder="https://youtube.com/watch?v=... or https://example.com/trailer.mp4">
                            <p class="text-gray-400 text-xs mt-2">
                                <i class="fas fa-info-circle mr-1"></i>
                                Supports YouTube URLs and direct video files (MP4, WebM, OGG). Recommended duration: 2-3 minutes
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 mt-8 pt-6 border-t border-white/10">
                    <a href="{{ route('admin_movies.index') }}" class="bg-gradient-to-r from-gray-500/20 to-gray-600/20 text-gray-300 hover:from-gray-500/30 hover:to-gray-600/30 px-6 py-3 rounded-lg border border-gray-500/30 hover:border-gray-400/50 transition duration-200 backdrop-blur-sm">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                    <button type="submit" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-200 shadow-lg transform hover:scale-[1.02]">
                        <i class="fas fa-plus mr-2"></i>Create Movie
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Image preview functionality
    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('preview-image');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        } else {
            preview.classList.add('hidden');
        }
    }
</script>
@endsection