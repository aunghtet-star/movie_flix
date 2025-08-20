@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <nav class="flex items-center space-x-2 text-sm text-gray-300 mb-2">
                <a href="{{ route('admin_movies.index') }}" class="hover:text-orange-400 transition-colors">
                    <i class="fas fa-film mr-1"></i>Movies
                </a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-white">{{ $movie->title }}</span>
            </nav>
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Movie Details</h1>
            <p class="text-gray-200">View complete movie information</p>
        </div>
        <a href="{{ route('admin_movies.index') }}"
            class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white px-6 py-3 rounded-lg transition duration-200 shadow-lg">
            <i class="fas fa-arrow-left mr-2"></i>Back to Movies
        </a>
    </div>

    <!-- Main Content -->
    <div class="backdrop-blur-md bg-white/5 rounded-xl shadow-2xl overflow-hidden border border-orange-400/20">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 p-8">

            <!-- Movie Poster Section -->
            <div class="lg:col-span-1">
                <div class="relative group">
                    <div class="aspect-[2/3] overflow-hidden rounded-lg border border-orange-400/30 shadow-lg">
                        @if($movie->picture)
                        <img src="{{ asset('storage/' . $movie->picture) }}"
                            alt="{{ $movie->title }}"
                            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        @else
                        <div class="w-full h-full bg-black/50 flex items-center justify-center">
                            <div class="text-center text-gray-400">
                                <i class="fas fa-film text-6xl mb-4"></i>
                                <p class="text-lg">No Image Available</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Rating Badge -->
                    <div class="absolute top-3 left-3 bg-yellow-500 text-black px-3 py-2 rounded-lg font-bold text-sm flex items-center shadow-lg">
                        <i class="fas fa-star mr-1"></i>
                        {{ number_format($movie->average_rating ?? 0, 1) }}
                    </div>

                    <!-- Year Badge -->
                    <div class="absolute top-3 right-3 bg-orange-500/80 backdrop-blur-sm text-white px-3 py-2 rounded-lg text-sm font-semibold">
                        {{ $movie->year }}
                    </div>

                    <!-- Views Counter -->
                    <div class="absolute bottom-3 right-3 bg-black/70 backdrop-blur-sm text-white px-3 py-2 rounded-lg text-xs flex items-center">
                        <i class="fas fa-eye mr-1"></i>
                        {{ number_format($movie->views) }}
                    </div>
                </div>
            </div>

            <!-- Movie Information Section -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Title and Genre Section -->
                <div>
                    <h2 class="text-4xl font-bold text-white drop-shadow-lg mb-4">{{ $movie->title }}</h2>

                    <!-- Genre Badge -->
                    <div class="flex flex-wrap gap-2 mb-6">
                        @if($movie->genre)
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-orange-500/20 text-orange-200 border border-orange-400/30">
                            <i class="fas fa-tags mr-2"></i>{{ $movie->genre->name }}
                        </span>
                        @else
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-gray-500/20 text-gray-200 border border-gray-400/30">
                            <i class="fas fa-question mr-2"></i>No Genre
                        </span>
                        @endif
                    </div>

                    <!-- Rating Display -->
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="flex text-yellow-400 text-lg">
                            @php
                            $rating = $movie->average_rating ?? 0;
                            $fullStars = floor($rating / 2);
                            $halfStar = ($rating % 2) >= 1;
                            $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                            @endphp

                            {{-- Full Stars --}}
                            @for($i = 0; $i < $fullStars; $i++)
                                <i class="fas fa-star"></i>
                                @endfor

                                {{-- Half Star --}}
                                @if($halfStar)
                                <i class="fas fa-star-half-alt"></i>
                                @endif

                                {{-- Empty Stars --}}
                                @for($i = 0; $i < $emptyStars; $i++)
                                    <i class="far fa-star text-gray-600"></i>
                                    @endfor
                        </div>
                        <div class="text-white">
                            <span class="text-xl font-bold">{{ number_format($rating, 1) }}</span>
                            <span class="text-gray-400">/10</span>
                            @if($movie->ratings_count > 0)
                            <span class="text-sm text-gray-300 ml-2">
                                ({{ number_format($movie->ratings_count) }} {{ Str::plural('rating', $movie->ratings_count) }})
                            </span>
                            @else
                            <span class="text-sm text-gray-300 ml-2">(No ratings yet)</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Cast and Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Actor -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-lg p-4 border border-orange-400/20">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-orange-500/20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-user text-orange-300"></i>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-orange-200 uppercase tracking-wider">Lead Actor</p>
                                <p class="text-white font-semibold">{{ $movie->actor }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actress -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-lg p-4 border border-orange-400/20">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-orange-500/20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-user text-orange-300"></i>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-orange-200 uppercase tracking-wider">Lead Actress</p>
                                <p class="text-white font-semibold">{{ $movie->actress }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Duration -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-lg p-4 border border-orange-400/20">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-orange-500/20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-clock text-orange-300"></i>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-orange-200 uppercase tracking-wider">Duration</p>
                                <p class="text-white font-semibold">{{ $movie->long_time }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Release Year -->
                    <div class="bg-white/5 backdrop-blur-sm rounded-lg p-4 border border-orange-400/20">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-orange-500/20 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-calendar text-orange-300"></i>
                            </div>
                            <div>
                                <p class="text-xs font-semibold text-orange-200 uppercase tracking-wider">Release Year</p>
                                <p class="text-white font-semibold">{{ $movie->year }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-white/5 backdrop-blur-sm rounded-lg p-6 border border-orange-400/20">
                    <div class="flex items-center mb-4">
                        <div class="w-10 h-10 bg-orange-500/20 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-file-alt text-orange-300"></i>
                        </div>
                        <h3 class="text-lg font-bold text-white">Synopsis</h3>
                    </div>
                    <p class="text-gray-300 leading-relaxed">
                        {{ $movie->description ?: 'No description available for this movie.' }}
                    </p>
                </div>

                <!-- Movie Statistics -->
                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-white/5 backdrop-blur-sm rounded-lg p-6 text-center border border-orange-400/20">
                        <div class="w-12 h-12 bg-orange-500/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-eye text-orange-300 text-xl"></i>
                        </div>
                        <div class="text-2xl font-bold text-white mb-1">{{ number_format($movie->views) }}</div>
                        <div class="text-sm text-orange-200">Total Views</div>
                    </div>

                    <div class="bg-white/5 backdrop-blur-sm rounded-lg p-6 text-center border border-orange-400/20">
                        <div class="w-12 h-12 bg-orange-500/20 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-calendar-plus text-orange-300 text-xl"></i>
                        </div>
                        <div class="text-2xl font-bold text-white mb-1">{{ $movie->created_at->format('M Y') }}</div>
                        <div class="text-sm text-orange-200">Date Added</div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="{{ route('admin_movies.edit', $movie->id) }}"
                        class="flex-1 bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white py-3 px-6 rounded-lg text-center font-semibold transition duration-200 shadow-lg">
                        <i class="fas fa-edit mr-2"></i>Edit Movie
                    </a>

                    <a href="{{ route('admin_movies.index') }}"
                        class="flex-1 bg-gray-600/80 hover:bg-gray-600 backdrop-blur-sm text-white py-3 px-6 rounded-lg text-center font-semibold transition duration-200 shadow-lg border border-orange-400/20">
                        <i class="fas fa-list mr-2"></i>Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection