@extends('admin.layouts.app')
@section('content')
<!-- Movie Card -->
<div class="max-w-3xl mx-auto bg-gray-800 rounded-xl shadow-2xl overflow-hidden hover:shadow-3xl">
    <!-- Movie Poster -->
    <div class="relative">
        <img src="{{asset('storage/'.$movie->picture)}}" alt="{{ $movie->title }} Movie Poster" class="w-full h-64 object-cover">

        <!-- Rating Badge -->
        <div class="absolute top-3 left-3 bg-yellow-500 text-black px-2 py-1 rounded-lg font-bold text-sm flex items-center">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
            {{ number_format($movie->ratings ?? 0, 1) }}
        </div>

        <!-- Year Badge -->
        <div class="absolute top-3 right-3 bg-black/70 text-white px-2 py-1 rounded-lg text-sm font-semibold">
            {{ $movie->year }}
        </div>

        <!-- Views Counter -->
        <div class="absolute bottom-3 right-3 bg-black/70 text-white px-2 py-1 rounded-lg text-xs flex items-center">
            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
            </svg>
            {{ number_format($movie->views) }}
        </div>
    </div>

    <!-- Card Content -->
    <div class="p-4">
        <!-- Title -->
        <h2 class="text-xl font-bold text-white mb-2 line-clamp-1">{{ $movie->title }}</h2>

        <!-- Cast Information -->
        <div class="space-y-2 mb-3">
            <p class="text-gray-300 text-sm flex items-center">
                <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium text-gray-200">Actor:</span>&nbsp;{{ $movie->actor }}
            </p>

            <p class="text-gray-300 text-sm flex items-center">
                <svg class="w-4 h-4 mr-1 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-medium text-gray-200">Actress:</span>&nbsp;{{ $movie->actress }}
            </p>
        </div>

        <!-- Runtime -->
        <p class="text-gray-400 text-sm mb-3 flex items-center">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
            </svg>
            <span class="font-medium text-gray-300">Duration:</span>&nbsp;{{ $movie->long_time }}
        </p>

        <!-- Genres -->
        <div class="flex flex-wrap gap-2 mb-3">
            @if($movie->genre)
                <span class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-3 py-1 rounded-full text-xs font-medium">
                    {{ $movie->genre->name }}
                </span>
            @else
                <span class="bg-gray-600 text-white px-3 py-1 rounded-full text-xs">
                    No Genre
                </span>
            @endif
        </div>

        <!-- Description -->
        <div class="mb-4">
            <h3 class="text-gray-200 font-medium mb-2">Description:</h3>
            <p class="text-gray-300 text-sm leading-relaxed">
                {{ $movie->description ?: 'No description available for this movie.' }}
            </p>
        </div>

        <!-- Rating Details -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center">
                <div class="flex text-yellow-400 mr-2">
                    @php
                        $rating = $movie->ratings ?? 0;
                        $fullStars = floor($rating / 2); // Convert 10-point scale to 5-star
                        $halfStar = ($rating % 2) >= 1;
                        $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                    @endphp

                    {{-- Full Stars --}}
                    @for($i = 0; $i < $fullStars; $i++)
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    @endfor

                    {{-- Half Star --}}
                    @if($halfStar)
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <defs>
                                <linearGradient id="half-star">
                                    <stop offset="50%" stop-color="currentColor"/>
                                    <stop offset="50%" stop-color="#4B5563"/>
                                </linearGradient>
                            </defs>
                            <path fill="url(#half-star)" d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    @endif

                    {{-- Empty Stars --}}
                    @for($i = 0; $i < $emptyStars; $i++)
                        <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    @endfor
                </div>
                <span class="text-gray-300 text-sm">
                    {{ number_format($rating, 1) }}/10
                    @if($movie->ratings_count > 0)
                        ({{ number_format($movie->ratings_count) }} {{ Str::plural('rating', $movie->ratings_count) }})
                    @else
                        (No ratings yet)
                    @endif
                </span>
            </div>
        </div>

        <!-- Movie Statistics -->
        <div class="grid grid-cols-2 gap-4 mb-4 p-3 bg-gray-700 rounded-lg">
            <div class="text-center">
                <div class="text-lg font-bold text-white">{{ number_format($movie->views) }}</div>
                <div class="text-xs text-gray-400">Total Views</div>
            </div>
            <div class="text-center">
                <div class="text-lg font-bold text-white">{{ $movie->created_at->format('M Y') }}</div>
                <div class="text-xs text-gray-400">Added</div>
            </div>
        </div>


        <!-- Action Buttons -->
        <div class="flex gap-2">
            <a href="{{ route('admin_movies.edit', $movie->id) }}"
               class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg text-center transition-colors duration-200">
                Edit Movie
            </a>
            <a href="{{ route('admin_movies.index') }}"
               class="flex-1 bg-gray-600 hover:bg-gray-700 text-white py-2 px-4 rounded-lg text-center transition-colors duration-200">
                Back to List
            </a>
        </div>
    </div>
</div>

@endsection
