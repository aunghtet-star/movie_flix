@extends('frontend.layouts.app')
@section('content')
<!-- Hero Section - Plex Style -->
<section class="relative min-h-screen bg-black text-white overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0">
        <!-- Hero Background Image -->
        <div class="absolute inset-0">
            <img src="{{ asset('image/Watch-Free-Hero.png') }}" alt="Watch Free Hero"
                class="w-full h-full object-cover">
        </div>

        <!-- Dark gradient overlay for text readability -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/70 to-black/50 z-10"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/40 z-10"></div>
    </div>

    <!-- Main Content -->
    <div class="relative z-20 flex items-center min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="max-w-2xl">
                <!-- Plex-style badge -->
                <div
                    class="inline-flex items-center space-x-2 bg-orange-500 px-4 py-2 rounded-full text-sm font-medium mb-6">
                    <span>🎬</span>
                    <span>Free Movies & TV</span>
                </div>

                <!-- Main heading -->
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6">
                    Free Movies to Watch,
                    <span class="text-orange-400">Anytime Anywhere</span>
                </h1>

                <!-- Description -->
                <p class="text-lg md:text-xl text-gray-300 mb-8 leading-relaxed max-w-xl">
                    The search is over! Let CineStream help you find the perfect movie to watch tonight for free.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ url('movie_page') }}"
                        class="inline-flex items-center justify-center px-8 py-4 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg text-lg transition-colors duration-200">
                        Watch Free Now
                    </a>
                    <button
                        class="inline-flex items-center justify-center px-8 py-4 border-2 border-gray-600 hover:border-gray-400 text-white font-semibold rounded-lg text-lg transition-colors duration-200">
                        Learn More
                    </button>
                </div>

                <!-- Features list -->
                <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span class="text-gray-300">No subscription</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span class="text-gray-300">No credit card</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <span class="text-gray-300">Watch instantly</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Movies Section -->
<section class="bg-gray-900 py-20 relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4 relative z-20">
                Featured Movies
            </h2>
            <p class="text-gray-400 text-lg max-w-2xl mx-auto relative z-20">
                Hand-picked selections of the most popular and trending movies available for free streaming
            </p>
        </div>

        <!-- Featured Movie Hero -->
        <div class="mb-16 relative z-20">
            @if($featuredMovies->count() > 0)
            @php $latestMovie = $featuredMovies->first(); @endphp
            <div
                class="relative bg-gradient-to-r from-black via-black/50 to-transparent rounded-2xl overflow-hidden shadow-2xl min-h-[400px]">
                <div class="absolute inset-0 z-0">
                    @if($latestMovie->picture)
                    <img src="{{ asset('storage/' . $latestMovie->picture) }}" alt="{{ $latestMovie->title }}"
                        class="w-full h-full object-cover opacity-30">
                    @else
                    <img src="{{ asset('image/movie.png') }}" alt="{{ $latestMovie->title }}"
                        class="w-full h-full object-cover opacity-30">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-r from-black via-black/70 to-transparent"></div>
                </div>
                <div
                    class="relative z-30 p-8 md:p-12 lg:p-16 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center min-h-[400px]">
                    <!-- Movie Info -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <span
                                class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-medium shadow-lg">Featured</span>
                            <span class="text-gray-300 text-sm">
                                {{ $latestMovie->year ?? 'N/A' }} • {{ $latestMovie->genre->name ?? 'Unknown' }} • {{ $latestMovie->duration ?? 'N/A' }}m
                            </span>
                        </div>
                        <h3 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight">
                            {{ $latestMovie->title }}
                        </h3>
                        <p class="text-gray-200 text-lg leading-relaxed">
                            {{ Str::limit($latestMovie->description ?? 'An amazing movie that will keep you entertained from start to finish. Experience great storytelling and memorable characters.', 200) }}
                        </p>
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-1">
                                <span class="text-orange-400 text-2xl">★</span>
                                <span class="text-white font-semibold">{{ number_format($latestMovie->average_rating ?? 0, 1) }}</span>
                                <span class="text-gray-300">/5.0</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="text-green-400 font-semibold">{{ $latestMovie->quality ?? 'HD' }}</span>
                                <span class="text-gray-300">•</span>
                                <span class="text-blue-400 font-semibold">Subtitles</span>
                            </div>
                        </div>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ route('moviePage.show', $latestMovie->id) }}"
                                class="inline-flex items-center justify-center px-8 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Watch Now
                            </a>
                            @auth
                            @if(auth()->user()->hasInWatchlist($latestMovie->id))
                            <button onclick="removeFromWatchlist({{ $latestMovie->id }})"
                                class="watchlist-btn-{{ $latestMovie->id }} inline-flex items-center justify-center px-8 py-3 border-2 border-orange-500 bg-orange-500 text-white rounded-lg transition-all duration-200 hover:bg-orange-600">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                                </svg>
                                In Watchlist
                            </button>
                            @else
                            <button onclick="addToWatchlist({{ $latestMovie->id }})"
                                class="watchlist-btn-{{ $latestMovie->id }} inline-flex items-center justify-center px-8 py-3 border-2 border-gray-500 hover:border-gray-300 text-white rounded-lg transition-all duration-200 hover:bg-white/10">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                Add to Watchlist
                            </button>
                            @endif
                            @else
                            <a href="{{ route('login') }}"
                                class="inline-flex items-center justify-center px-8 py-3 border-2 border-gray-500 hover:border-gray-300 text-white rounded-lg transition-all duration-200 hover:bg-white/10">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                                Add to Watchlist
                            </a>
                            @endauth
                        </div>
                    </div>

                    <!-- Movie Poster -->
                    <div class="flex justify-center lg:justify-end">
                        <div class="relative">
                            <div
                                class="w-64 h-96 bg-gray-800 rounded-lg overflow-hidden shadow-2xl transform hover:scale-105 transition-transform duration-300 cursor-pointer"
                                onclick="window.location.href='{{ route('moviePage.show', $latestMovie->id) }}'">
                                @if($latestMovie->picture)
                                <img src="{{ asset('storage/' . $latestMovie->picture) }}" alt="{{ $latestMovie->title }}"
                                    class="w-full h-full object-cover">
                                @else
                                <img src="{{ asset('image/movie.png') }}" alt="{{ $latestMovie->title }}"
                                    class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div
                                class="absolute -top-4 -right-4 w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center shadow-lg cursor-pointer"
                                onclick="window.location.href='{{ route('moviePage.show', $latestMovie->id) }}'">
                                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <!-- Fallback if no movies -->
            <div
                class="relative bg-gradient-to-r from-black via-black/50 to-transparent rounded-2xl overflow-hidden shadow-2xl min-h-[400px]">
                <div class="absolute inset-0 z-0">
                    <img src="{{ asset('image/movie.png') }}" alt="Featured Movie"
                        class="w-full h-full object-cover opacity-30">
                    <div class="absolute inset-0 bg-gradient-to-r from-black via-black/70 to-transparent"></div>
                </div>
                <div
                    class="relative z-30 p-8 md:p-12 lg:p-16 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center min-h-[400px]">
                    <!-- Movie Info -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-4">
                            <span
                                class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-medium shadow-lg">Featured</span>
                            <span class="text-gray-300 text-sm">Coming Soon</span>
                        </div>
                        <h3 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight">
                            No Movies Available
                        </h3>
                        <p class="text-gray-200 text-lg leading-relaxed">
                            Movies will be available soon. Check back later for the latest releases and featured content.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4">
                            <a href="{{ url('movie_page') }}"
                                class="inline-flex items-center justify-center px-8 py-3 bg-orange-500 hover:bg-orange-600 text-white font-semibold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                                Browse Movies
                            </a>
                        </div>
                    </div>
                    <!-- Movie Poster -->
                    <div class="flex justify-center lg:justify-end">
                        <div class="relative">
                            <div
                                class="w-64 h-96 bg-gray-800 rounded-lg overflow-hidden shadow-2xl">
                                <img src="{{ asset('image/movie.png') }}" alt="No Movie Available"
                                    class="w-full h-full object-cover">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Featured Movies Grid -->
        <div class="mb-16">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-2xl md:text-3xl font-bold text-white">Trending This Week</h3>
                <a href="{{ url('movie_page') }}"
                    class="text-orange-400 hover:text-orange-300 font-medium transition-colors duration-200">
                    View All
                    <svg class="w-4 h-4 inline ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                @forelse($featuredMovies as $movie)
                <div class="group cursor-pointer" onclick="window.location.href='{{ route('moviePage.show', $movie->id) }}'">
                    <div class="relative">
                        <div
                            class="aspect-[2/3] bg-gray-800 rounded-lg overflow-hidden group-hover:scale-105 transition-all duration-300 shadow-lg group-hover:shadow-2xl">
                            @if($movie->picture)
                            <img src="{{ asset('storage/' . $movie->picture) }}" alt="{{ $movie->title }}"
                                class="w-full h-full object-cover">
                            @else
                            <img src="{{ asset('image/movie.png') }}" alt="{{ $movie->title }}"
                                class="w-full h-full object-cover">
                            @endif
                        </div>

                        <!-- Rating Badge -->
                        <div
                            class="absolute top-3 left-3 bg-black/80 backdrop-blur-sm px-2.5 py-1 rounded-full flex items-center space-x-1 shadow-lg">
                            <svg class="w-3 h-3 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                            <span class="text-white text-xs font-semibold">{{ number_format($movie->ratings ?? 0, 1) }}</span>
                        </div>

                        <!-- Quality Badge -->
                        <div
                            class="absolute top-3 right-3 bg-orange-500 px-2 py-1 rounded text-xs font-bold text-white">
                            {{ $movie->quality ?? 'HD' }}
                        </div>

                        <!-- Play Button Overlay -->
                        <div class="absolute inset-0 flex items-center justify-center group-hover:opacity-100 transition-opacity duration-300">
                            <div class="w-12 h-12 bg-orange-500/90 rounded-full flex items-center justify-center backdrop-blur-sm shadow-xl transform scale-90 group-hover:scale-100 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white ml-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>

                        <!-- Movie Info Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-3">
                            <h4 class="text-white font-semibold text-sm mb-1 truncate">
                                {{ $movie->title }}
                            </h4>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-300">
                                    {{ $movie->genre->name ?? 'Unknown' }} • {{ $movie->year ?? 'N/A' }}
                                </span>
                                <span class="text-orange-400 font-medium">{{ $movie->duration ?? 'N/A' }}m</span>
                            </div>
                        </div>

                        <!-- Watchlist Button -->
                        <div class="absolute bottom-3 right-3 group-hover:opacity-100 transition-opacity duration-300">
                            @auth
                            @if(auth()->user()->hasInWatchlist($movie->id))
                            <button class="watchlist-btn-grid-{{ $movie->id }} w-7 h-7 bg-orange-500 rounded-full flex items-center justify-center hover:bg-orange-600 transition-colors duration-200"
                                onclick="event.stopPropagation(); removeFromWatchlistGrid({{ $movie->id }});">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z" />
                                </svg>
                            </button>
                            @else
                            <button class="watchlist-btn-grid-{{ $movie->id }} w-7 h-7 bg-black/80 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-orange-500 transition-colors duration-200"
                                onclick="event.stopPropagation(); addToWatchlistGrid({{ $movie->id }});">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                            @endif
                            @else
                            <a href="{{ route('login') }}" class="w-7 h-7 bg-black/80 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-orange-500 transition-colors duration-200"
                                onclick="event.stopPropagation();">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </a>
                            @endauth
                        </div>
                    </div>
                </div>
                @empty
                <!-- Fallback if no movies found -->
                @for($i = 0; $i < 6; $i++)
                    <div class="group cursor-pointer">
                    <div class="relative">
                        <div
                            class="aspect-[2/3] bg-gray-800 rounded-lg overflow-hidden group-hover:scale-105 transition-all duration-300 shadow-lg group-hover:shadow-2xl">
                            <img src="{{ asset('image/movie.png') }}" alt="Movie {{ $i + 1 }}"
                                class="w-full h-full object-cover">
                        </div>

                        <!-- Rating Badge -->
                        <div
                            class="absolute top-3 left-3 bg-black/80 backdrop-blur-sm px-2.5 py-1 rounded-full flex items-center space-x-1 shadow-lg">
                            <svg class="w-3 h-3 text-orange-400" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                            </svg>
                            <span class="text-white text-xs font-semibold">{{ number_format(rand(75, 95) / 10, 1) }}</span>
                        </div>

                        <!-- Quality Badge -->
                        <div
                            class="absolute top-3 right-3 bg-orange-500 px-2 py-1 rounded text-xs font-bold text-white">
                            {{ ['HD', '4K', 'FHD'][array_rand(['HD', '4K', 'FHD'])] }}
                        </div>

                        <!-- Play Button Overlay -->
                        <div class="absolute inset-0 flex items-center justify-center group-hover:opacity-100 transition-opacity duration-300">
                            <div class="w-12 h-12 bg-orange-500/90 rounded-full flex items-center justify-center backdrop-blur-sm shadow-xl transform scale-90 group-hover:scale-100 transition-transform duration-300">
                                <svg class="w-6 h-6 text-white ml-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                            </div>
                        </div>

                        <!-- Movie Info Overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-3">
                            <h4 class="text-white font-semibold text-sm mb-1 truncate">
                                {{ ['The Dark Knight', 'Inception', 'Interstellar', 'Avengers: Endgame', 'Spider-Man', 'Wonder Woman'][$i] }}
                            </h4>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-300">
                                    {{ ['Action', 'Thriller', 'Sci-Fi', 'Drama', 'Adventure', 'Fantasy'][$i % 6] }} • {{ rand(2020, 2024) }}
                                </span>
                                <span class="text-orange-400 font-medium">{{ rand(105, 180) }}m</span>
                            </div>
                        </div>

                        <!-- Watchlist Button -->
                        <div class="absolute bottom-3 right-3 group-hover:opacity-100 transition-opacity duration-300">
                            <button class="w-7 h-7 bg-black/80 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-orange-500 transition-colors duration-200">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
            </div>
            @endfor
            @endforelse
        </div>
    </div>

    <!-- Movie Categories -->
    <div class="mb-16" id="genre">
        <div class="text-center mb-12">
            <h3 class="text-2xl md:text-3xl font-bold text-white mb-4">Browse by Genre</h3>
            <p class="text-gray-400 max-w-2xl mx-auto mb-8">Discover movies across all your favorite genres
            </p>

            <!-- Search and Filter Section -->
            <div class="max-w-4xl mx-auto mb-8">
                <div class="flex flex-col md:flex-row gap-4 items-center justify-center">
                    <!-- Search Input -->
                    <div class="relative w-full md:w-96">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m21 21-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input type="text" id="movieSearch" placeholder="Search movies by title..."
                            class="w-full pl-10 pr-4 py-3 bg-gray-800 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                    </div>

                    <!-- Genre Filter Dropdown -->
                    <div class="relative">
                        <select id="genreFilter"
                            class="appearance-none bg-gray-800 border border-gray-600 rounded-lg px-4 py-3 pr-8 text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 cursor-pointer">
                            <option value="">All Genres</option>
                            @foreach($allGenres as $genre)
                            <option value="{{ strtolower(str_replace([' ', '&'], ['-', ''], $genre->name)) }}">
                                {{ $genre->name }}
                            </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Clear Filters Button -->
                    <button id="clearFilters"
                        class="px-6 py-3 bg-orange-500 hover:bg-orange-600 text-white font-medium rounded-lg transition-colors duration-200 whitespace-nowrap">
                        Clear Filters
                    </button>
                </div>

                <!-- Quick Genre Tags -->
                <div class="flex flex-wrap justify-center gap-2 mt-6">
                    <button class="genre-tag px-4 py-2 bg-orange-500 hover:bg-orange-500 text-white text-sm rounded-full transition-colors duration-200"
                        data-genre="">
                        All
                    </button>
                    @foreach($allGenres as $genre)
                    <button class="genre-tag px-4 py-2 bg-gray-700 hover:bg-orange-500 text-white text-sm rounded-full transition-colors duration-200"
                        data-genre="{{ strtolower(str_replace([' ', '&'], ['-', ''], $genre->name)) }}">
                        {{ $genre->name }}
                    </button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="genreGrid">
            <!-- Action Movies -->
            <div
                class="genre-card group bg-gradient-to-br from-red-900/30 to-red-800/30 border border-red-800/40 rounded-2xl p-6 hover:border-red-600/60 transition-all duration-300 hover:transform hover:scale-105 cursor-pointer"
                data-genre="action" data-title="Action & Adventure" onclick="window.location.href='{{ url('movie_page') }}?genre=action'">
                <div class="flex items-center space-x-4 mb-6">
                    <div
                        class="w-14 h-14 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                        <span class="text-2xl">💥</span>
                    </div>
                    <div>
                        <h3 class="text-white font-bold text-xl group-hover:text-red-400 transition-colors duration-300">
                            Action & Adventure</h3>
                        <p class="text-gray-400 text-sm">{{ $genreCounts['Action'] ?? 0 }} movies</p>
                    </div>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    @forelse($genreMovies['Action'] ?? [] as $movie)
                    <div
                        class="aspect-[2/3] bg-gray-800 rounded-lg overflow-hidden group-hover:scale-105 transition-transform duration-300 shadow-md">
                        @if($movie->picture)
                        <img src="{{ asset('storage/' . $movie->picture) }}" alt="{{ $movie->title }}"
                            class="w-full h-full object-cover">
                        @else
                        <img src="{{ asset('image/movie.png') }}" alt="{{ $movie->title }}"
                            class="w-full h-full object-cover">
                        @endif
                    </div>
                    @empty
                    @for($i = 0; $i < 3; $i++)
                        <div
                        class="aspect-[2/3] bg-gray-800 rounded-lg overflow-hidden group-hover:scale-105 transition-transform duration-300 shadow-md">
                        <img src="{{ asset('image/movie.png') }}" alt="Action Movie"
                            class="w-full h-full object-cover">
                </div>
                @endfor
                @endforelse
            </div>
            <div class="mt-4 text-center">
                <span
                    class="text-red-400 text-sm font-medium group-hover:text-red-300 transition-colors duration-300">View Action Movies →</span>
            </div>
        </div>

        <!-- Comedy Movies -->
        <div
            class="genre-card group bg-gradient-to-br from-yellow-900/30 to-yellow-800/30 border border-yellow-800/40 rounded-2xl p-6 hover:border-yellow-600/60 transition-all duration-300 hover:transform hover:scale-105 cursor-pointer"
            data-genre="comedy" data-title="Comedy" onclick="window.location.href='{{ url('movie_page') }}?genre=comedy'">
            <div class="flex items-center space-x-4 mb-6">
                <div
                    class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                    <span class="text-2xl">😂</span>
                </div>
                <div>
                    <h3 class="text-white font-bold text-xl group-hover:text-yellow-400 transition-colors duration-300">
                        Comedy</h3>
                    <p class="text-gray-400 text-sm">{{ $genreCounts['Comedy'] ?? 0 }} movies</p>
                </div>
            </div>
            <div class="grid grid-cols-3 gap-3">
                @forelse($genreMovies['Comedy'] ?? [] as $movie)
                <div
                    class="aspect-[2/3] bg-gray-800 rounded-lg overflow-hidden group-hover:scale-105 transition-transform duration-300 shadow-md">
                    @if($movie->picture)
                    <img src="{{ asset('storage/' . $movie->picture) }}" alt="{{ $movie->title }}"
                        class="w-full h-full object-cover">
                    @else
                    <img src="{{ asset('image/movie.png') }}" alt="{{ $movie->title }}"
                        class="w-full h-full object-cover">
                    @endif
                </div>
                @empty
                @for($i = 0; $i < 3; $i++)
                    <div
                    class="aspect-[2/3] bg-gray-800 rounded-lg overflow-hidden group-hover:scale-105 transition-transform duration-300 shadow-md">
                    <img src="{{ asset('image/movie.png') }}" alt="Comedy Movie"
                        class="w-full h-full object-cover">
            </div>
            @endfor
            @endforelse
        </div>
        <div class="mt-4 text-center">
            <span
                class="text-yellow-400 text-sm font-medium group-hover:text-yellow-300 transition-colors duration-300">View Comedy Movies →</span>
        </div>
    </div>

    <!-- Drama Movies -->
    <div
        class="genre-card group bg-gradient-to-br from-purple-900/30 to-purple-800/30 border border-purple-800/40 rounded-2xl p-6 hover:border-purple-600/60 transition-all duration-300 hover:transform hover:scale-105 cursor-pointer"
        data-genre="drama" data-title="Drama" onclick="window.location.href='{{ url('movie_page') }}?genre=drama'">
        <div class="flex items-center space-x-4 mb-6">
            <div
                class="w-14 h-14 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                <span class="text-2xl">🎭</span>
            </div>
            <div>
                <h3 class="text-white font-bold text-xl group-hover:text-purple-400 transition-colors duration-300">
                    Drama</h3>
                <p class="text-gray-400 text-sm">{{ $genreCounts['Drama'] ?? 0 }} movies</p>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-3">
            @forelse($genreMovies['Drama'] ?? [] as $movie)
            <div
                class="aspect-[2/3] bg-gray-800 rounded-lg overflow-hidden group-hover:scale-105 transition-transform duration-300 shadow-md">
                @if($movie->picture)
                <img src="{{ asset('storage/' . $movie->picture) }}" alt="{{ $movie->title }}"
                    class="w-full h-full object-cover">
                @else
                <img src="{{ asset('image/movie.png') }}" alt="{{ $movie->title }}"
                    class="w-full h-full object-cover">
                @endif
            </div>
            @empty
            @for($i = 0; $i < 3; $i++)
                <div
                class="aspect-[2/3] bg-gray-800 rounded-lg overflow-hidden group-hover:scale-105 transition-transform duration-300 shadow-md">
                <img src="{{ asset('image/movie.png') }}" alt="Drama Movie"
                    class="w-full h-full object-cover">
        </div>
        @endfor
        @endforelse
    </div>
    <div class="mt-4 text-center">
        <span
            class="text-purple-400 text-sm font-medium group-hover:text-purple-300 transition-colors duration-300">View Drama Movies →</span>
    </div>
    </div>

    <!-- Horror Movies -->
    <div
        class="genre-card group bg-gradient-to-br from-gray-900/50 to-gray-800/50 border border-gray-700/60 rounded-2xl p-6 hover:border-gray-600/80 transition-all duration-300 hover:transform hover:scale-105 cursor-pointer"
        data-genre="horror" data-title="Horror & Thriller" onclick="window.location.href='{{ url('movie_page') }}?genre=horror'">
        <div class="flex items-center space-x-4 mb-6">
            <div
                class="w-14 h-14 bg-gradient-to-br from-gray-600 to-gray-700 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                <span class="text-2xl">👻</span>
            </div>
            <div>
                <h3 class="text-white font-bold text-xl group-hover:text-gray-300 transition-colors duration-300">
                    Horror & Thriller</h3>
                <p class="text-gray-400 text-sm">{{ $genreCounts['Horror'] ?? 0 }} movies</p>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-3">
            @forelse($genreMovies['Horror'] ?? [] as $movie)
            <div
                class="aspect-[2/3] bg-gray-800 rounded-lg overflow-hidden group-hover:scale-105 transition-transform duration-300 shadow-md">
                @if($movie->picture)
                <img src="{{ asset('storage/' . $movie->picture) }}" alt="{{ $movie->title }}"
                    class="w-full h-full object-cover">
                @else
                <img src="{{ asset('image/movie.png') }}" alt="{{ $movie->title }}"
                    class="w-full h-full object-cover">
                @endif
            </div>
            @empty
            @for($i = 0; $i < 3; $i++)
                <div
                class="aspect-[2/3] bg-gray-800 rounded-lg overflow-hidden group-hover:scale-105 transition-transform duration-300 shadow-md">
                <img src="{{ asset('image/movie.png') }}" alt="Horror Movie"
                    class="w-full h-full object-cover">
        </div>
        @endfor
        @endforelse
    </div>
    <div class="mt-4 text-center">
        <span
            class="text-gray-300 text-sm font-medium group-hover:text-gray-200 transition-colors duration-300">View Horror Movies →</span>
    </div>
    </div>

    <!-- Sci-Fi Movies -->
    <div
        class="genre-card group bg-gradient-to-br from-blue-900/30 to-blue-800/30 border border-blue-800/40 rounded-2xl p-6 hover:border-blue-600/60 transition-all duration-300 hover:transform hover:scale-105 cursor-pointer"
        data-genre="sci-fi" data-title="Sci-Fi & Fantasy" onclick="window.location.href='{{ url('movie_page') }}?genre=sci-fi'">
        <div class="flex items-center space-x-4 mb-6">
            <div
                class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                <span class="text-2xl">🚀</span>
            </div>
            <div>
                <h3 class="text-white font-bold text-xl group-hover:text-blue-400 transition-colors duration-300">
                    Sci-Fi & Fantasy</h3>
                <p class="text-gray-400 text-sm">{{ $genreCounts['Sci-Fi'] ?? 0 }} movies</p>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-3">
            @forelse($genreMovies['Sci-Fi'] ?? [] as $movie)
            <div
                class="aspect-[2/3] bg-gray-800 rounded-lg overflow-hidden group-hover:scale-105 transition-transform duration-300 shadow-md">
                @if($movie->picture)
                <img src="{{ asset('storage/' . $movie->picture) }}" alt="{{ $movie->title }}"
                    class="w-full h-full object-cover">
                @else
                <img src="{{ asset('image/movie.png') }}" alt="{{ $movie->title }}"
                    class="w-full h-full object-cover">
                @endif
            </div>
            @empty
            @for($i = 0; $i < 3; $i++)
                <div
                class="aspect-[2/3] bg-gray-800 rounded-lg overflow-hidden group-hover:scale-105 transition-transform duration-300 shadow-md">
                <img src="{{ asset('image/movie.png') }}" alt="Sci-Fi Movie"
                    class="w-full h-full object-cover">
        </div>
        @endfor
        @endforelse
    </div>
    <div class="mt-4 text-center">
        <span
            class="text-blue-400 text-sm font-medium group-hover:text-blue-300 transition-colors duration-300">View Sci-Fi Movies →</span>
    </div>
    </div>

    <!-- Romance Movies -->
    <div
        class="genre-card group bg-gradient-to-br from-pink-900/30 to-pink-800/30 border border-pink-800/40 rounded-2xl p-6 hover:border-pink-600/60 transition-all duration-300 hover:transform hover:scale-105 cursor-pointer"
        data-genre="romance" data-title="Romance" onclick="window.location.href='{{ url('movie_page') }}?genre=romance'">
        <div class="flex items-center space-x-4 mb-6">
            <div
                class="w-14 h-14 bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                <span class="text-2xl">💕</span>
            </div>
            <div>
                <h3 class="text-white font-bold text-xl group-hover:text-pink-400 transition-colors duration-300">
                    Romance</h3>
                <p class="text-gray-400 text-sm">{{ $genreCounts['Romance'] ?? 0 }} movies</p>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-3">
            @forelse($genreMovies['Romance'] ?? [] as $movie)
            <div
                class="aspect-[2/3] bg-gray-800 rounded-lg overflow-hidden group-hover:scale-105 transition-transform duration-300 shadow-md">
                @if($movie->picture)
                <img src="{{ asset('storage/' . $movie->picture) }}" alt="{{ $movie->title }}"
                    class="w-full h-full object-cover">
                @else
                <img src="{{ asset('image/movie.png') }}" alt="{{ $movie->title }}"
                    class="w-full h-full object-cover">
                @endif
            </div>
            @empty
            @for($i = 0; $i < 3; $i++)
                <div
                class="aspect-[2/3] bg-gray-800 rounded-lg overflow-hidden group-hover:scale-105 transition-transform duration-300 shadow-md">
                <img src="{{ asset('image/movie.png') }}" alt="Romance Movie"
                    class="w-full h-full object-cover">
        </div>
        @endfor
        @endforelse
    </div>
    <div class="mt-4 text-center">
        <span
            class="text-pink-400 text-sm font-medium group-hover:text-pink-300 transition-colors duration-300">View Romance Movies →</span>
    </div>
    </div>
    </div>

    <!-- No Results Message -->
    <div id="noResults" class="text-center py-12 hidden">
        <div class="text-gray-400 text-xl mb-4">No genres found</div>
        <p class="text-gray-500">Try adjusting your search or filter criteria</p>
    </div>
    </div>

    <!-- View All Button -->
    <div class="text-center">
        <a href="{{ url('movie_page') }}"
            class="inline-flex items-center px-10 py-4 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold rounded-xl text-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-105">
            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
            </svg>
            Explore Complete Movie Collection
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
    </div>
</section>


<!-- CTA Section -->
<section class="bg-orange-500 py-20 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0"
            style="background-image: radial-gradient(circle at 25px 25px, white 2px, transparent 0), radial-gradient(circle at 75px 75px, white 2px, transparent 0); background-size: 100px 100px;"></div>
    </div>

    <div class="max-w-6xl mx-auto text-center px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Badge -->
        <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium mb-8">
            <span>🎬</span>
            <span class="text-white">Join Millions of Movie Lovers</span>
        </div>

        <!-- Main Heading -->
        <h2 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">
            Ready to watch?
        </h2>

        <!-- Subheading -->
        <p class="text-orange-100 text-xl md:text-2xl mb-4 max-w-3xl mx-auto font-medium">
            Get started with free movies and TV shows on CineStream.
        </p>
        <p class="text-orange-200 text-lg mb-12 max-w-2xl mx-auto">
            No subscription required. No credit card needed. Start watching instantly.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
            <a href="{{ url('movie_page') }}"
                class="inline-flex items-center px-10 py-4 bg-white text-orange-500 font-bold rounded-xl text-xl hover:bg-gray-100 transition-all duration-300 shadow-2xl hover:shadow-3xl transform hover:scale-105 min-w-[280px] justify-center">
                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"></path>
                </svg>
                Start Watching Free
                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </a>

            <button class="inline-flex items-center px-8 py-4 border-2 border-white text-white font-semibold rounded-xl text-lg hover:bg-white hover:text-orange-500 transition-all duration-300 min-w-[240px] justify-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Learn More
            </button>
        </div>

        <!-- Features List -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                    </svg>
                </div>
                <h3 class="text-white font-bold text-lg mb-2">100% Free</h3>
                <p class="text-orange-100">No hidden fees or subscriptions</p>
            </div>

            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-white font-bold text-lg mb-2">Instant Access</h3>
                <p class="text-orange-100">Start watching immediately</p>
            </div>

            <div class="flex flex-col items-center text-center">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-white font-bold text-lg mb-2">All Devices</h3>
                <p class="text-orange-100">Watch on any device, anywhere</p>
            </div>
        </div>
    </div>
</section>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('movieSearch');
        const genreFilter = document.getElementById('genreFilter');
        const clearFiltersBtn = document.getElementById('clearFilters');
        const genreTags = document.querySelectorAll('.genre-tag');
        const genreCards = document.querySelectorAll('.genre-card');
        const noResults = document.getElementById('noResults');
        const genreGrid = document.getElementById('genreGrid');

        let searchTimeout;

        // Function to perform search/filter and redirect to movie page
        function performMovieSearch() {
            const query = searchInput.value.trim();
            const genre = genreFilter.value;

            // Build URL with parameters
            const params = new URLSearchParams();
            if (query) params.append('query', query);
            if (genre) params.append('genre', genre);

            // Redirect to movie page with search/filter parameters
            const baseUrl = '{{ route("moviePage") }}';
            const searchUrl = params.toString() ? `${baseUrl}?${params.toString()}` : baseUrl;

            window.location.href = searchUrl;
        }

        // Search input with debounce for movie search
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(performMovieSearch, 1000); // Longer delay for home page
        });

        // Genre filter change for movie search
        genreFilter.addEventListener('change', function() {
            performMovieSearch();
        });

        // Clear filters button for movie search
        clearFiltersBtn.addEventListener('click', function() {
            searchInput.value = '';
            genreFilter.value = '';
            window.location.href = '{{ route("moviePage") }}';
        });

        // Genre tag buttons for movie search
        genreTags.forEach(tag => {
            tag.addEventListener('click', function() {
                const genre = this.getAttribute('data-genre');

                // Update UI
                genreTags.forEach(t => t.classList.remove('bg-orange-500'));
                genreTags.forEach(t => t.classList.add('bg-gray-700'));
                this.classList.remove('bg-gray-700');
                this.classList.add('bg-orange-500');

                // Update select dropdown
                genreFilter.value = genre;

                // Perform search
                performMovieSearch();
            });
        });

        // Enter key on search input
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                clearTimeout(searchTimeout);
                performMovieSearch();
            }
        });

        // Filter function for genre cards (existing functionality)
        function filterGenres() {
            const searchTerm = searchInput.value.toLowerCase().trim();
            const selectedGenre = genreFilter.value.toLowerCase();
            let visibleCount = 0;

            genreCards.forEach(card => {
                const cardGenre = card.getAttribute('data-genre').toLowerCase();
                const cardTitle = card.getAttribute('data-title').toLowerCase();

                const matchesSearch = cardTitle.includes(searchTerm);
                const matchesGenre = selectedGenre === '' || cardGenre === selectedGenre;

                if (matchesSearch && matchesGenre) {
                    card.style.display = 'block';
                    card.classList.remove('hidden');
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                    card.classList.add('hidden');
                }
            });

            // Show/hide no results message
            if (visibleCount === 0) {
                noResults.classList.remove('hidden');
                genreGrid.classList.add('mb-0');
            } else {
                noResults.classList.add('hidden');
                genreGrid.classList.remove('mb-0');
            }
        }

        // Update active tag styling
        function updateActiveTag(activeGenre) {
            genreTags.forEach(tag => {
                const tagGenre = tag.getAttribute('data-genre');
                if (tagGenre === activeGenre) {
                    tag.classList.remove('bg-gray-700');
                    tag.classList.add('bg-orange-500');
                } else {
                    tag.classList.remove('bg-orange-500');
                    tag.classList.add('bg-gray-700');
                }
            });
        }

        // Initialize with "All" tag active
        updateActiveTag('');

        // Filter by genre function for genre cards
        window.filterByGenre = function(genre) {
            genreFilter.value = genre;
            filterGenres();
            updateActiveTag(genre);
        }

        // Watchlist functionality
        window.addToWatchlist = function(movieId) {
            fetch('/watchlist', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        movie_id: movieId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update button to show "In Watchlist"
                        const button = document.querySelector(`.watchlist-btn-${movieId}`);
                        if (button) {
                            button.innerHTML = `
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                        In Watchlist
                    `;
                            button.className = 'watchlist-btn-' + movieId + ' inline-flex items-center justify-center px-8 py-3 border-2 border-orange-500 bg-orange-500 text-white rounded-lg transition-all duration-200 hover:bg-orange-600';
                            button.setAttribute('onclick', `removeFromWatchlist(${movieId})`);
                        }

                        // Show success toast
                        showToast('Added to watchlist!', 'success');
                    } else {
                        showToast(data.message || 'Failed to add to watchlist', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('An error occurred. Please try again.', 'error');
                });
        }

        window.removeFromWatchlist = function(movieId) {
            fetch('/watchlist', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        movie_id: movieId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update button to show "Add to Watchlist"
                        const button = document.querySelector(`.watchlist-btn-${movieId}`);
                        if (button) {
                            button.innerHTML = `
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        Add to Watchlist
                    `;
                            button.className = 'watchlist-btn-' + movieId + ' inline-flex items-center justify-center px-8 py-3 border-2 border-gray-500 hover:border-gray-300 text-white rounded-lg transition-all duration-200 hover:bg-white/10';
                            button.setAttribute('onclick', `addToWatchlist(${movieId})`);
                        }

                        // Show success toast
                        showToast('Removed from watchlist!', 'success');
                    } else {
                        showToast(data.message || 'Failed to remove from watchlist', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('An error occurred. Please try again.', 'error');
                });
        }

        // Watchlist functionality for grid
        window.addToWatchlistGrid = function(movieId) {
            fetch('/watchlist', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        movie_id: movieId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update button to show "In Watchlist"
                        const button = document.querySelector(`.watchlist-btn-grid-${movieId}`);
                        if (button) {
                            button.innerHTML = `
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                        </svg>
                    `;
                            button.className = 'watchlist-btn-grid-' + movieId + ' w-7 h-7 bg-orange-500 rounded-full flex items-center justify-center hover:bg-orange-600 transition-colors duration-200';
                            button.setAttribute('onclick', `event.stopPropagation(); removeFromWatchlistGrid(${movieId});`);
                        }

                        // Show success toast
                        showToast('Added to watchlist!', 'success');
                    } else {
                        showToast(data.message || 'Failed to add to watchlist', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('An error occurred. Please try again.', 'error');
                });
        }

        window.removeFromWatchlistGrid = function(movieId) {
            fetch('/watchlist', {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        movie_id: movieId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update button to show "Add to Watchlist"
                        const button = document.querySelector(`.watchlist-btn-grid-${movieId}`);
                        if (button) {
                            button.innerHTML = `
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    `;
                            button.className = 'watchlist-btn-grid-' + movieId + ' w-7 h-7 bg-black/80 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-orange-500 transition-colors duration-200';
                            button.setAttribute('onclick', `event.stopPropagation(); addToWatchlistGrid(${movieId});`);
                        }

                        // Show success toast
                        showToast('Removed from watchlist!', 'success');
                    } else {
                        showToast(data.message || 'Failed to remove from watchlist', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    showToast('An error occurred. Please try again.', 'error');
                });
        }

        // Toast notification function
        function showToast(message, type = 'info') {
            // Remove existing toast if any
            const existingToast = document.getElementById('toast');
            if (existingToast) {
                existingToast.remove();
            }

            // Create toast element
            const toast = document.createElement('div');
            toast.id = 'toast';
            toast.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-lg shadow-lg text-white transform transition-all duration-300 translate-x-full`;

            // Set background color based on type
            if (type === 'success') {
                toast.classList.add('bg-green-500');
            } else if (type === 'error') {
                toast.classList.add('bg-red-500');
            } else {
                toast.classList.add('bg-blue-500');
            }

            toast.innerHTML = `
            <div class="flex items-center space-x-2">
                <span>${message}</span>
                <button onclick="this.parentElement.parentElement.remove()" class="ml-2 text-white hover:text-gray-200">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        `;

            document.body.appendChild(toast);

            // Slide in
            setTimeout(() => {
                toast.classList.remove('translate-x-full');
            }, 100);

            // Auto hide after 3 seconds
            setTimeout(() => {
                toast.classList.add('translate-x-full');
                setTimeout(() => {
                    if (toast.parentNode) {
                        toast.remove();
                    }
                }, 300);
            }, 3000);
        }
    });
</script>