@extends('frontend.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Movie Details Card -->
    <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-2xl overflow-hidden mb-8 border border-gray-700">
        <div class="md:flex">
            <!-- Movie Poster -->
            <div class="md:w-1/3">
                <img src="{{ $movie->picture ? Storage::url($movie->picture) : '/image/movie.png' }}"
                     alt="{{ $movie->title }}"
                     class="w-full h-96 md:h-full object-cover">
            </div>

            <!-- Movie Info -->
            <div class="md:w-2/3 p-8 text-white">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h1 class="text-4xl font-bold text-white mb-3">{{ $movie->title }}</h1>
                        <div class="flex items-center space-x-4 text-sm text-gray-300 mb-4">
                            <span class="bg-orange-500 text-white px-3 py-1 rounded-full font-medium">{{ $movie->genre->name ?? 'Unknown' }}</span>
                            <span class="flex items-center">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ $movie->year }}
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-clock mr-1"></i>
                                {{ $movie->long_time }}
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-eye mr-1"></i>
                                {{ number_format($movie->views) }} views
                            </span>
                        </div>
                    </div>

                    <!-- Quick Rating Display -->
                    <div class="text-center bg-gray-800 rounded-lg p-4">
                        <div class="text-3xl font-bold text-orange-400">
                            {{ number_format($movie->average_rating ?? 0, 1) }}
                        </div>
                        <div class="flex justify-center mb-1">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= ($movie->average_rating ?? 0) ? 'text-yellow-400' : 'text-gray-600' }}"
                                     fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            @endfor
                        </div>
                        <div class="text-xs text-gray-400">{{ $movie->total_ratings ?? 0 }} {{ Str::plural('rating', $movie->total_ratings ?? 0) }}</div>
                    </div>
                </div>

                <!-- Description -->
                @if($movie->description)
                    <p class="text-gray-300 leading-relaxed mb-6 text-lg">{{ $movie->description }}</p>
                @endif

                <!-- Cast Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-800 rounded-lg p-4">
                        <h3 class="font-semibold text-orange-400 mb-2 flex items-center">
                            <i class="fas fa-user mr-2"></i>
                            Leading Actor
                        </h3>
                        <p class="text-gray-300">{{ $movie->actor }}</p>
                    </div>
                    <div class="bg-gray-800 rounded-lg p-4">
                        <h3 class="font-semibold text-orange-400 mb-2 flex items-center">
                            <i class="fas fa-user mr-2"></i>
                            Leading Actress
                        </h3>
                        <p class="text-gray-300">{{ $movie->actress }}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ $movie->download_link }}"
                       target="_blank"
                       class="flex-1 bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white px-8 py-4 rounded-lg font-semibold transition duration-200 transform hover:scale-105 shadow-lg text-center">
                        <i class="fas fa-download mr-2"></i>
                        Download Movie
                    </a>
                    <button class="flex-1 bg-gray-700 hover:bg-gray-600 text-white px-6 py-4 rounded-lg font-semibold transition duration-200 border border-gray-600">
                        <i class="fas fa-plus mr-2"></i>
                        Add to Watchlist
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Rating System -->
    <div class="mb-8">
        @include('components.simple-rating', ['movie' => $movie, 'userRating' => $userRating])
    </div>

    <!-- Recent Reviews Section -->
    @php
        $movieRatings = $movie->ratings()->whereNotNull('review')->with('user')->latest()->take(3)->get();
    @endphp
    @if($movieRatings->count() > 0)
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700 mb-8">
            <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                <i class="fas fa-comments mr-3 text-orange-400"></i>
                Recent Reviews
            </h2>
            <div class="space-y-4">
                @foreach($movieRatings as $rating)
                    <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                        <div class="flex items-start justify-between mb-2">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-red-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-medium text-sm">{{ substr($rating->user->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h4 class="font-medium text-white">{{ $rating->user->name }}</h4>
                                    <div class="flex items-center space-x-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-600' }}"
                                                 fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <span class="text-sm text-gray-400">{{ $rating->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-300 leading-relaxed">{{ $rating->review }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <!-- Related Movies -->
    @if($movie->genre && $movie->genre->movies()->where('id', '!=', $movie->id)->exists())
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700">
            <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                <i class="fas fa-film mr-3 text-orange-400"></i>
                More {{ $movie->genre->name }} Movies
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($movie->genre->movies()->where('id', '!=', $movie->id)->take(8)->get() as $relatedMovie)
                    <a href="{{ route('moviePage.show', $relatedMovie->id) }}"
                       class="group block bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-200 border border-gray-700 hover:border-orange-500">
                        <img src="{{ $relatedMovie->picture ? Storage::url($relatedMovie->picture) : '/image/movie.png' }}"
                             alt="{{ $relatedMovie->title }}"
                             class="w-full h-48 object-cover group-hover:scale-105 transition duration-200">
                        <div class="p-4">
                            <h3 class="font-semibold text-sm text-white truncate mb-2">{{ $relatedMovie->title }}</h3>
                            <div class="flex items-center justify-between">
                                <div class="flex">
                                    @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-3 h-3 {{ $i <= ($relatedMovie->average_rating ?? 0) ? 'text-yellow-400' : 'text-gray-600' }}"
                                             fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-xs text-gray-400">{{ number_format($relatedMovie->average_rating ?? 0, 1) }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
