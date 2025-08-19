@extends('admin.layouts.app')
@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Edit Movie</h1>
            <p class="text-orange-300">Update movie details</p>
        </div>
        <a href="{{ route('admin_movies.index') }}" class="bg-gradient-to-r from-gray-500/20 to-gray-600/20 text-gray-300 hover:from-gray-500/30 hover:to-gray-600/30 px-6 py-3 rounded-lg border border-gray-500/30 hover:border-gray-400/50 transition duration-200 backdrop-blur-sm">
            <i class="fas fa-arrow-left mr-2"></i>Back to Movies
        </a>
    </div>
    <div class="max-w-2xl mx-auto">
        <div class="bg-black/20 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/10 p-8">
            @if ($errors->any())
            <div class="mb-6 p-4 bg-red-900/30 text-red-300 rounded-xl">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                    <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <form action="{{ route('admin_movies.update', $movie->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PATCH')
                <!-- Picture -->
                <div>
                    <label class="block text-orange-300 font-semibold mb-2"><i class="fas fa-image mr-2"></i>Picture</label>
                    <input type="file" name="picture" class="w-full bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200">
                    @if($movie->picture)
                    <img src="{{ asset('storage/'.$movie->picture) }}" alt="Current Picture" class="w-24 mt-2 rounded-xl border border-orange-400/30 shadow-lg">
                    @endif
                </div>
                <!-- Title -->
                <div>
                    <label class="block text-orange-300 font-semibold mb-2"><i class="fas fa-film mr-2"></i>Title</label>
                    <input type="text" name="title" class="w-full bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" value="{{ old('title', $movie->title) }}" required>
                </div>
                <!-- Genre -->
                <div>
                    <label class="block text-orange-300 font-semibold mb-2"><i class="fas fa-tags mr-2"></i>Genre</label>
                    <select name="genre_id" class="w-full bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" required>
                        @foreach($genres as $genre)
                        <option value="{{ $genre->id }}" {{ $movie->genre_id == $genre->id ? 'selected' : '' }}>{{ $genre->name }}</option>
                        @endforeach
                    </select>
                </div>
                <!-- Year -->
                <div>
                    <label class="block text-orange-300 font-semibold mb-2"><i class="fas fa-calendar-alt mr-2"></i>Year</label>
                    <input type="number" name="year" class="w-full bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" value="{{ old('year', $movie->year) }}" required>
                </div>
                <!-- Actor -->
                <div>
                    <label class="block text-orange-300 font-semibold mb-2"><i class="fas fa-user mr-2"></i>Actor</label>
                    <input type="text" name="actor" class="w-full bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" value="{{ old('actor', $movie->actor) }}" required>
                </div>
                <!-- Actress -->
                <div>
                    <label class="block text-orange-300 font-semibold mb-2"><i class="fas fa-user mr-2"></i>Actress</label>
                    <input type="text" name="actress" class="w-full bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" value="{{ old('actress', $movie->actress) }}" required>
                </div>
                <!-- Description -->
                <div>
                    <label class="block text-orange-300 font-semibold mb-2"><i class="fas fa-align-left mr-2"></i>Description</label>
                    <textarea name="description" class="w-full bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" rows="4" required>{{ old('description', $movie->description) }}</textarea>
                </div>
                <!-- Duration -->
                <div>
                    <label class="block text-orange-300 font-semibold mb-2"><i class="fas fa-clock mr-2"></i>Duration</label>
                    <input type="text" name="long_time" class="w-full bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" value="{{ old('long_time', $movie->long_time) }}" required>
                </div>
                <!-- Download Link -->
                <div>
                    <label class="block text-orange-300 font-semibold mb-2"><i class="fas fa-download mr-2"></i>Download Link</label>
                    <input type="text" name="download_link" class="w-full bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" value="{{ old('download_link', $movie->download_link) }}" required>
                </div>

                <!-- Trailer URL -->
                <div>
                    <label class="block text-orange-300 font-semibold mb-2">
                        <i class="fas fa-play-circle mr-2"></i>Trailer URL <span class="text-gray-400 text-sm">(Optional)</span>
                    </label>
                    <input type="url" name="trailer_url" class="w-full bg-black/30 backdrop-blur-sm border border-white/20 rounded-xl text-white px-4 py-3 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-500/50 transition duration-200" value="{{ old('trailer_url', $movie->trailer_url) }}" placeholder="https://youtube.com/watch?v=... or https://example.com/trailer.mp4">
                    <p class="text-gray-400 text-xs mt-1">
                        <i class="fas fa-info-circle mr-1"></i>
                        Supports YouTube URLs and direct video files (MP4, WebM, OGG). Recommended duration: 2-3 minutes
                    </p>
                </div>
                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-semibold px-8 py-3 rounded-xl shadow-lg transition-all duration-200 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:ring-offset-2 focus:ring-offset-transparent">
                        <i class="fas fa-save mr-2"></i>Update Movie
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection