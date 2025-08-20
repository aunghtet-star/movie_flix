@extends('frontend.layouts.app')
@section('content')
<div class="absolute  inset-0 bg-black/50 backdrop-blur-lg">
    <div class="mx-auto px-4 pt-32 md:pt-28 pb-16">

        <!-- Search and Filter Section -->
        <div class="w-full max-w-7xl mx-auto mb-8 px-2">
            <!-- Main Search Row -->
            <div class="flex flex-col lg:flex-row gap-3 lg:gap-4 items-stretch lg:items-center justify-center mb-4">
                <!-- Search Input - Full width on mobile -->
                <div class="relative w-full lg:w-96 xl:w-[400px]">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m21 21-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <input type="text" id="movieSearch" placeholder="Search movies by title..." value="{{ request('query') }}"
                        class="w-full pl-9 sm:pl-10 pr-4 py-2.5 sm:py-3 text-sm sm:text-base bg-gray-800 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200">
                </div>

                <!-- Filters Row - Responsive flex -->
                <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                    <!-- Genre Filter Dropdown -->
                    <div class="relative flex-1 sm:flex-none sm:min-w-[180px]">
                        <select id="genreFilter"
                            class="appearance-none w-full bg-gray-800 border border-gray-600 rounded-lg px-3 sm:px-4 py-2.5 sm:py-3 pr-8 sm:pr-10 text-sm sm:text-base text-white focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-200 cursor-pointer">
                            <option value="">All Genres</option>
                            @foreach($allGenres as $genre)
                            <option value="{{ strtolower(str_replace([' ', '&'], ['-', ''], $genre->name)) }}"
                                {{ request('genre') == strtolower(str_replace([' ', '&'], ['-', ''], $genre->name)) ? 'selected' : '' }}>
                                {{ $genre->name }}
                            </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Clear Filters Button -->
                    <button id="clearFilters"
                        class="flex-1 sm:flex-none px-4 sm:px-6 py-2.5 sm:py-3 bg-orange-500 hover:bg-orange-600 text-white font-medium rounded-lg transition-colors duration-200 text-sm sm:text-base whitespace-nowrap">
                        Clear Filters
                    </button>
                </div>
            </div>

            <!-- Quick Genre Tags - Responsive and scrollable -->
            <div class="relative">
                <div class="flex flex-wrap sm:justify-center gap-2 overflow-x-auto pb-2 sm:pb-0">
                    <button class="genre-tag flex-shrink-0 px-3 sm:px-4 py-1.5 sm:py-2 {{ request('genre') == '' ? 'bg-orange-500' : 'bg-gray-700' }} hover:bg-orange-500 text-white text-xs sm:text-sm rounded-full transition-colors duration-200"
                        data-genre="">
                        All
                    </button>
                    @foreach($allGenres as $genre)
                    @php
                    $genreSlug = strtolower(str_replace([' ', '&'], ['-', ''], $genre->name));
                    @endphp
                    <button class="genre-tag flex-shrink-0 px-3 sm:px-4 py-1.5 sm:py-2 {{ request('genre') == $genreSlug ? 'bg-orange-500' : 'bg-gray-700' }} hover:bg-orange-500 text-white text-xs sm:text-sm rounded-full transition-colors duration-200"
                        data-genre="{{ $genreSlug }}">
                        {{ $genre->name }}
                    </button>
                    @endforeach
                </div>
                <!-- Fade effect for mobile scroll -->
                <div class="absolute right-0 top-0 bottom-0 w-6 bg-gradient-to-l from-black/50 to-transparent pointer-events-none sm:hidden"></div>
            </div>
        </div>

        <!-- Movies Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mb-8">
            @forelse($movies as $movie)
            <a href="{{ route('moviePage.show', $movie->id) }}" class="group">
                <div class="relative overflow-hidden rounded-lg shadow-lg transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                    <!-- Movie Poster -->
                    <div class="relative h-64 md:h-72">
                        <img src="{{ asset('storage/'.$movie->picture) }}"
                            alt="{{ $movie->title }}"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110">

                        <!-- Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                        <!-- Rating Badge -->
                        <div class="absolute top-2 right-2 bg-black/70 backdrop-blur-sm rounded-full px-2 py-1">
                            <div class="flex items-center">
                                <i class="fas fa-star text-yellow-400 text-xs mr-1"></i>
                                <span class="text-white text-xs font-medium">{{ number_format($movie->average_rating ?? 0, 1) }}</span>
                            </div>
                        </div>

                        <!-- Year Badge -->
                        <div class="absolute top-2 left-2 bg-green-500/80 backdrop-blur-sm rounded px-2 py-1">
                            <span class="text-white text-xs font-bold">{{ $movie->year }}</span>
                        </div>

                        <!-- Hover Info -->
                        <div class="absolute bottom-0 left-0 right-0 p-4 translate-y-full group-hover:translate-y-0 transition-transform duration-300">
                            <div class="space-y-2">
                                <div class="flex items-center text-gray-300 text-xs">
                                    <i class="fas fa-clock mr-1"></i>
                                    <span>{{ $movie->long_time ?? 'N/A' }}</span>
                                </div>
                                <div class="flex items-center text-gray-300 text-xs">
                                    <i class="fas fa-eye mr-1"></i>
                                    <span>{{ number_format($movie->views) }} views</span>
                                </div>
                                @if($movie->genre)
                                <div class="flex items-center text-gray-300 text-xs">
                                    <i class="fas fa-tag mr-1"></i>
                                    <span>{{ $movie->genre->name }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Movie Info -->
                    <div class="p-3 bg-gray-900/90 backdrop-blur-sm">
                        <h3 class="text-white font-semibold text-sm leading-tight truncate group-hover:text-cyan-400 transition-colors duration-200">
                            {{ $movie->title }}
                        </h3>
                        <div class="flex items-center justify-between mt-2">
                            <div class="flex items-center space-x-4 text-xs text-gray-400">
                                <span>{{ $movie->actor }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full flex flex-col items-center justify-center py-12">
                <i class="fas fa-film text-6xl text-gray-600 mb-4"></i>
                <p class="text-gray-400 text-lg">No movies found.</p>
                <p class="text-gray-500 text-sm">Check back later for new releases!</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($movies->hasPages())
        <div class="flex justify-center mt-8 mb-8">
            <div class="flex items-center space-x-2">
                {{-- Previous Page Link --}}
                @if ($movies->onFirstPage())
                <span class="px-3 py-2 text-gray-500 bg-gray-800 rounded-lg cursor-not-allowed">Previous</span>
                @else
                <a href="{{ $movies->previousPageUrl() }}" class="px-3 py-2 text-white bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors duration-200">Previous</a>
                @endif

                {{-- Page Numbers --}}
                @foreach ($movies->getUrlRange(1, $movies->lastPage()) as $page => $url)
                @if ($page == $movies->currentPage())
                <span class="px-3 py-2 text-white bg-orange-500 rounded-lg">{{ $page }}</span>
                @else
                <a href="{{ $url }}" class="px-3 py-2 text-white bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors duration-200">{{ $page }}</a>
                @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($movies->hasMorePages())
                <a href="{{ $movies->nextPageUrl() }}" class="px-3 py-2 text-white bg-gray-700 hover:bg-gray-600 rounded-lg transition-colors duration-200">Next</a>
                @else
                <span class="px-3 py-2 text-gray-500 bg-gray-800 rounded-lg cursor-not-allowed">Next</span>
                @endif
            </div>
        </div>
        @endif

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const movieSearch = document.getElementById('movieSearch');
        const genreFilter = document.getElementById('genreFilter');
        const clearFilters = document.getElementById('clearFilters');
        const genreTags = document.querySelectorAll('.genre-tag');

        let searchTimeout;

        // Function to perform search/filter
        function performSearch() {
            const query = movieSearch.value.trim();
            const genre = genreFilter.value;

            // Build URL with parameters
            const params = new URLSearchParams();
            if (query) params.append('query', query);
            if (genre) params.append('genre', genre);

            // Redirect to search results
            const baseUrl = '{{ route("movies.search") }}';
            const searchUrl = params.toString() ? `${baseUrl}?${params.toString()}` : '{{ route("moviePage") }}';

            window.location.href = searchUrl;
        }

        // Search input with debounce
        movieSearch.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(performSearch, 500);
        });

        // Genre filter change
        genreFilter.addEventListener('change', performSearch);

        // Clear filters button
        clearFilters.addEventListener('click', function() {
            movieSearch.value = '';
            genreFilter.value = '';
            window.location.href = '{{ route("moviePage") }}';
        });

        // Genre tag buttons
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
                performSearch();
            });
        });

        // Enter key on search input
        movieSearch.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                clearTimeout(searchTimeout);
                performSearch();
            }
        });
    });
</script>
@endsection