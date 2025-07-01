@extends('frontend.layouts.app')
@section('content')
    <!-- Adaptive Full Screen Background -->
    <div class="fixed inset-0 w-full h-full bg-black/50 backdrop-blur-lg overflow-y-auto z-0">
        <!-- Responsive Container with Proper Centering -->
        <div class="min-h-screen w-full flex items-center justify-center p-2 sm:p-4 md:p-6 lg:p-8 pt-20 sm:pt-24 lg:pt-28">
            <!-- Adaptive Movie Card -->
            <div class="w-full max-w-xs sm:max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl 2xl:max-w-2xl bg-gray-800/95 backdrop-blur-sm rounded-xl shadow-2xl overflow-hidden my-4">
                <!-- Movie Poster -->
                <div class="relative">
                    <img src="{{ asset('storage/'.$movie->picture) }}" alt="{{ $movie->title }}"
                         class="w-full h-40 xs:h-48 sm:h-56 md:h-64 lg:h-72 xl:h-80 object-cover">

                    <!-- Rating Badge -->
                    <div class="absolute top-1.5 sm:top-2 md:top-3 left-1.5 sm:left-2 md:left-3 bg-yellow-500 text-black px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-md sm:rounded-lg font-bold text-xs sm:text-sm flex items-center">
                        <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-0.5 sm:mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        {{ $movie->ratings }}
                    </div>

                    <!-- Year Badge -->
                    <div class="absolute top-1.5 sm:top-2 md:top-3 right-1.5 sm:right-2 md:right-3 bg-black/70 text-white px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-md sm:rounded-lg text-xs sm:text-sm font-semibold">
                        {{ $movie->year }}
                    </div>

                    <!-- Views Counter -->
                    <div class="absolute bottom-1.5 sm:bottom-2 md:bottom-3 right-1.5 sm:right-2 md:right-3 bg-black/70 text-white px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-md sm:rounded-lg text-xs flex items-center">
                        <svg class="w-3 h-3 mr-0.5 sm:mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path>
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="hidden xs:inline">{{ number_format($movie->views) }}</span>
                        <span class="xs:hidden">{{ number_format($movie->views/1000, 1) }}k</span>
                    </div>
                </div>

                <!-- Card Content -->
                <div class="p-3 sm:p-4 md:p-5 lg:p-6">
                    <!-- Title -->
                    <h2 class="text-base sm:text-lg md:text-xl lg:text-2xl font-bold text-white mb-2 sm:mb-3 leading-tight">{{ $movie->title }}</h2>

                    <!-- Cast Info -->
                    <div class="space-y-1.5 sm:space-y-2 mb-3 sm:mb-4">
                        <p class="text-gray-300 text-xs sm:text-sm flex items-center">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1.5 sm:mr-2 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium text-cyan-400 mr-1">Actor:</span>
                            <span class="truncate">{{ $movie->actor }}</span>
                        </p>

                        <p class="text-gray-300 text-xs sm:text-sm flex items-center">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1.5 sm:mr-2 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium text-cyan-400 mr-1">Actress:</span>
                            <span class="truncate">{{ $movie->actress }}</span>
                        </p>
                    </div>

                    <!-- Runtime & Genre -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 mb-3 sm:mb-4">
                        <p class="text-gray-400 text-xs sm:text-sm flex items-center">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1.5 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                            </svg>
                            {{ $movie->long_time }}
                        </p>

                        <div class="flex flex-wrap gap-1">
                            <span class="bg-red-600 text-white px-2 py-1 rounded-full text-xs">{{ $movie->genre->name }}</span>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="text-gray-300 text-xs sm:text-sm mb-3 sm:mb-4 leading-relaxed line-clamp-3 sm:line-clamp-none">
                        {{ $movie->description }}
                    </p>

                    <!-- Rating Display -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-3 sm:mb-4 gap-2">
                        <div class="flex items-center">
                            <div class="flex text-yellow-400 mr-2">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-3 h-3 sm:w-4 sm:h-4 {{ $i <= floor($movie->ratings) ? 'text-yellow-400' : 'text-gray-600' }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-gray-400 text-xs sm:text-sm">({{ number_format($movie->ratings_count) }})</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col gap-2 mb-3 sm:mb-4">
                        <a href="{{ $movie->download_link }}" target="_blank"
                           class="w-full bg-green-600 hover:bg-green-700 text-white py-2 sm:py-2.5 md:py-3 px-4 rounded-lg font-semibold transition-colors flex items-center justify-center text-sm sm:text-base">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1.5 sm:mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            Download
                        </a>
                    </div>

                    <!-- Rating Form -->
                    <form action="{{ route('movies.rate', $movie->id) }}" method="POST" class="flex flex-col items-center">
                        @csrf
                        <div class="flex flex-row-reverse justify-center mb-3 gap-0.5 sm:gap-1">
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}" class="hidden peer" required>
                                <label for="star{{ $i }}" class="cursor-pointer text-lg sm:text-xl md:text-2xl text-gray-400 hover:text-yellow-400 peer-checked:text-yellow-400 transition-colors">
                                    <svg class="w-5 h-5 sm:w-6 sm:h-6 md:w-7 md:h-7" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364 1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                </label>
                            @endfor
                        </div>
                        <button type="submit" class="w-full bg-orange-600 hover:bg-orange-700 text-white py-2 sm:py-2.5 md:py-3 px-4 rounded-lg font-semibold transition-colors text-sm sm:text-base">
                            Submit Rating
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
