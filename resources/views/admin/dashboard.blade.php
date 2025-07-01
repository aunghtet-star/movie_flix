@extends('admin.layouts.app')

@section('content')
    <div id="dashboard-section" class="content-section p-12">
        <h2 class="text-2xl font-semibold mb-6">Dashboard</h2>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <!-- Total Movies -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-lg bg-blue-100 flex items-center justify-center text-blue-500">
                        <i class="fas fa-film"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Movies</p>
                        <h3 class="text-xl font-semibold">{{ number_format($stats['total_movies']) }}</h3>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center text-green-500">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Users</p>
                        <h3 class="text-xl font-semibold">{{ number_format($stats['total_users']) }}</h3>
                    </div>
                </div>
            </div>

            <!-- Total Genres -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center text-purple-500">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Genres</p>
                        <h3 class="text-xl font-semibold">{{ number_format($stats['total_genres']) }}</h3>
                    </div>
                </div>
            </div>

            <!-- Total Views -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-lg bg-orange-100 flex items-center justify-center text-orange-500">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Views</p>
                        <h3 class="text-xl font-semibold">{{ number_format($stats['total_views']) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold">Recent Movies</h3>
            </div>
            <div class="p-4">
                <ul class="divide-y divide-gray-200">
                    @forelse($recentMovies as $movie)
                        <li class="py-3">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    @if($movie->picture)
                                        <img src="{{ asset('storage/' . $movie->picture) }}" alt="{{ $movie->title }}"
                                             class="w-10 h-10 rounded-full object-cover">
                                    @else
                                        <div
                                            class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-500">
                                            <i class="fas fa-film"></i>
                                        </div>
                                    @endif

                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $movie->title }}</p>
                                        <p class="text-sm text-gray-500">{{ $movie->genre->name ?? 'No Genre' }}
                                            • {{ $movie->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm font-medium text-gray-900">{{ number_format($movie->views) }}
                                        views</p>
                                    <p class="text-sm text-gray-500">
                                        Rating: {{ number_format($movie->ratings ?? 0, 1) }}</p>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="py-3 text-center text-gray-500">
                            No movies found
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>

        <!-- Additional Stats Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Top Rated Movies -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold">Top Rated Movies</h3>
                </div>
                <div class="p-4">
                    <ul class="space-y-3">
                        @forelse($topRatedMovies as $movie)
                            <li class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 rounded bg-yellow-100 flex items-center justify-center text-yellow-500">
                                        <i class="fas fa-star text-xs"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $movie->title }}</p>
                                        <p class="text-xs text-gray-500">{{ $movie->genre->name ?? 'No Genre' }}</p>
                                    </div>
                                </div>
                                <span
                                    class="text-sm font-semibold text-yellow-600">{{ number_format($movie->ratings, 1) }}</span>
                            </li>
                        @empty
                            <li class="text-center text-gray-500 py-4">
                                No rated movies found
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold">Recent Users</h3>
                </div>
                <div class="p-4">
                    <ul class="space-y-3">
                        @forelse($recentUsers as $user)
                            <li class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div
                                        class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-500">
                                        <i class="fas fa-user text-xs"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-gray-900">{{ $user->name }}</p>
                                        <p class="text-xs text-gray-500">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <span class="text-xs text-gray-500">{{ $user->created_at->diffForHumans() }}</span>
                            </li>
                        @empty
                            <li class="text-center text-gray-500 py-4">
                                No users found
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        <!-- Movies by Genre Chart -->
        <div class="bg-white rounded-lg shadow mb-6">
            <div class="p-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold">Movies by Genre</h3>
            </div>
            <div class="p-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @forelse($moviesByGenre as $genre)
                        <div class="text-center p-4 bg-gray-50 rounded-lg">
                            <p class="text-sm font-medium text-gray-900">{{ $genre->name }}</p>
                            <p class="text-2xl font-bold text-blue-600">{{ $genre->movies_count }}</p>
                            <p class="text-xs text-gray-500">movies</p>
                        </div>
                    @empty
                        <div class="col-span-full text-center text-gray-500 py-8">
                            No genre data available
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
