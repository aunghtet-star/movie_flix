@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-3xl font-bold text-white drop-shadow-lg mb-8">Dashboard</h2>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Movies -->
        <div class="backdrop-blur-md bg-white/5 rounded-xl shadow-2xl p-6 border border-orange-400/20 hover:bg-white/10 transition duration-200">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-film"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-300 text-sm font-medium">Total Movies</p>
                    <h3 class="text-2xl font-bold text-white drop-shadow">{{ number_format($stats['total_movies']) }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Users -->
        <div class="backdrop-blur-md bg-white/5 rounded-xl shadow-2xl p-6 border border-orange-400/20 hover:bg-white/10 transition duration-200">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-green-500 to-green-600 flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-users"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-300 text-sm font-medium">Total Users</p>
                    <h3 class="text-2xl font-bold text-white drop-shadow">{{ number_format($stats['total_users']) }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Genres -->
        <div class="backdrop-blur-md bg-white/5 rounded-xl shadow-2xl p-6 border border-orange-400/20 hover:bg-white/10 transition duration-200">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-purple-500 to-purple-600 flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-tags"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-300 text-sm font-medium">Total Genres</p>
                    <h3 class="text-2xl font-bold text-white drop-shadow">{{ number_format($stats['total_genres']) }}</h3>
                </div>
            </div>
        </div>

        <!-- Total Views -->
        <div class="backdrop-blur-md bg-white/5 rounded-xl shadow-2xl p-6 border border-orange-400/20 hover:bg-white/10 transition duration-200">
            <div class="flex items-center">
                <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-orange-500 to-red-600 flex items-center justify-center text-white shadow-lg">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="ml-4">
                    <p class="text-gray-300 text-sm font-medium">Total Views</p>
                    <h3 class="text-2xl font-bold text-white drop-shadow">{{ number_format($stats['total_views']) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="backdrop-blur-md bg-white/5 rounded-xl shadow-2xl mb-8 border border-orange-400/20">
        <div class="p-6 border-b border-orange-400/20">
            <h3 class="text-xl font-bold text-white drop-shadow">Recent Movies</h3>
        </div>
        <div class="p-6">
            <ul class="divide-y divide-orange-400/10">
                @forelse($recentMovies as $movie)
                <li class="py-4 hover:bg-orange-500/10 transition duration-200 rounded-lg px-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            @if($movie->picture)
                            <img src="{{ asset('storage/' . $movie->picture) }}" alt="{{ $movie->title }}"
                                class="w-12 h-12 rounded-full object-cover border border-orange-400/30 shadow-md">
                            @else
                            <div
                                class="w-12 h-12 rounded-full bg-gradient-to-r from-blue-500 to-blue-600 flex items-center justify-center text-white shadow-lg">
                                <i class="fas fa-film"></i>
                            </div>
                            @endif

                            <div class="ml-4">
                                <p class="text-sm font-semibold text-white drop-shadow">{{ $movie->title }}</p>
                                <p class="text-sm text-gray-300">{{ $movie->genre->name ?? 'No Genre' }}
                                    • {{ $movie->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-white drop-shadow">{{ number_format($movie->views) }}
                                views</p>
                            <p class="text-sm text-gray-300">
                                Rating: {{ number_format($movie->average_rating ?? 0, 1) }}</p>
                        </div>
                    </div>
                </li>
                @empty
                <li class="py-6 text-center">
                    <i class="fas fa-film text-4xl text-orange-400/50 mb-2"></i>
                    <p class="text-gray-300">No movies found</p>
                </li>
                @endforelse
            </ul>
        </div>
    </div>

    <!-- Additional Stats Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Top Rated Movies -->
        <div class="backdrop-blur-md bg-white/5 rounded-xl shadow-2xl border border-orange-400/20">
            <div class="p-6 border-b border-orange-400/20">
                <h3 class="text-xl font-bold text-white drop-shadow">Top Rated Movies</h3>
            </div>
            <div class="p-6">
                <ul class="space-y-4">
                    @forelse($topRatedMovies as $movie)
                    <li class="flex items-center justify-between hover:bg-orange-500/10 transition duration-200 rounded-lg p-3">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 rounded-lg bg-gradient-to-r from-yellow-400 to-yellow-500 flex items-center justify-center text-white shadow-lg">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-white drop-shadow">{{ $movie->title }}</p>
                                <p class="text-xs text-gray-300">{{ $movie->genre->name ?? 'No Genre' }}</p>
                            </div>
                        </div>
                        <span
                            class="text-sm font-bold text-yellow-400">{{ number_format($movie->average_rating ?? 0, 1) }}</span>
                    </li>
                    @empty
                    <li class="text-center py-6">
                        <i class="fas fa-star text-4xl text-orange-400/50 mb-2"></i>
                        <p class="text-gray-300">No rated movies found</p>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="backdrop-blur-md bg-white/5 rounded-xl shadow-2xl border border-orange-400/20">
            <div class="p-6 border-b border-orange-400/20">
                <h3 class="text-xl font-bold text-white drop-shadow">Recent Users</h3>
            </div>
            <div class="p-6">
                <ul class="space-y-4">
                    @forelse($recentUsers as $user)
                    <li class="flex items-center justify-between hover:bg-orange-500/10 transition duration-200 rounded-lg p-3">
                        <div class="flex items-center">
                            <div
                                class="w-10 h-10 rounded-full bg-gradient-to-r from-green-400 to-green-500 flex items-center justify-center text-white shadow-lg">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-white drop-shadow">{{ $user->name }}</p>
                                <p class="text-xs text-gray-300">{{ $user->email }}</p>
                            </div>
                        </div>
                        <span class="text-xs text-gray-300 font-medium">{{ $user->created_at->diffForHumans() }}</span>
                    </li>
                    @empty
                    <li class="text-center py-6">
                        <i class="fas fa-users text-4xl text-orange-400/50 mb-2"></i>
                        <p class="text-gray-300">No users found</p>
                    </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

    <!-- Movies by Genre Chart -->
    <div class="backdrop-blur-md bg-white/5 rounded-xl shadow-2xl border border-orange-400/20">
        <div class="p-6 border-b border-orange-400/20">
            <h3 class="text-xl font-bold text-white drop-shadow">Movies by Genre</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($moviesByGenre as $genre)
                <div class="text-center p-6 bg-gradient-to-br from-orange-500/10 to-red-600/10 rounded-xl border border-orange-400/20 hover:from-orange-500/20 hover:to-red-600/20 transition duration-300 backdrop-blur-sm">
                    <div class="w-12 h-12 rounded-lg bg-gradient-to-r from-orange-500 to-red-600 flex items-center justify-center text-white shadow-lg mx-auto mb-3">
                        <i class="fas fa-tags"></i>
                    </div>
                    <p class="text-sm font-semibold text-white drop-shadow mb-2">{{ $genre->name }}</p>
                    <p class="text-3xl font-bold text-orange-400 drop-shadow-lg">{{ $genre->movies_count }}</p>
                    <p class="text-xs text-gray-300 mt-1">movies</p>
                </div>
                @empty
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-film text-6xl text-orange-400/30 mb-4"></i>
                    <p class="text-white/70 text-lg">No genre data available</p>
                    <p class="text-orange-300/60 text-sm mt-2">Add some movies to see genre statistics.</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection