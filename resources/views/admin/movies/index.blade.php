@extends('admin.layouts.app')
@section('content')
    <div id="movies-section" class="content-section">
        <h2 class="text-2xl font-semibold mb-6">Movie Management</h2>

        <!-- Movie Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 text-white p-3 rounded-lg">
                        <i class="fas fa-film"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Movies</p>
                        <h3 class="text-xl font-semibold">{{ number_format($stats['total_movies']) }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 text-white p-3 rounded-lg">
                        <i class="fas fa-eye"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Views</p>
                        <h3 class="text-xl font-semibold">{{ number_format($stats['total_views']) }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-500 text-white p-3 rounded-lg">
                        <i class="fas fa-plus"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">This Month</p>
                        <h3 class="text-xl font-semibold">{{ number_format($stats['movies_this_month']) }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-yellow-500 text-white p-3 rounded-lg">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Avg Rating</p>
                        <h3 class="text-xl font-semibold">{{ number_format($stats['average_rating'], 1) }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-indigo-500 text-white p-3 rounded-lg">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Genres</p>
                        <h3 class="text-xl font-semibold">{{ number_format($stats['total_genres']) }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-orange-500 text-white p-3 rounded-lg">
                        <i class="fas fa-trophy"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Top Genre</p>
                        <h3 class="text-lg font-semibold">{{ $stats['top_genre'] }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Movies Table -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold">Movies</h3>
                <div class="flex space-x-2">
                    <form method="GET" action="{{ route('admin_movies.index') }}" class="relative">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Search movies..."
                               class="w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-search"></i>
                        </div>
                    </form>
                    <a href="{{ route('admin_movies.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-plus mr-2"></i> Add Movie
                    </a>
                </div>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Movie
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Genre
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Year
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Rating
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Views
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($movies as $movie)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-12 h-16 rounded-lg overflow-hidden bg-gray-200 flex-shrink-0">
                                            @if($movie->picture)
                                                <img src="{{ asset('storage/' . $movie->picture) }}" alt="{{ $movie->title }}"
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                                    <i class="fas fa-film"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $movie->title }}</div>
                                            <div class="text-sm text-gray-500">{{ $movie->actor }} • {{ $movie->actress }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $movie->genre->name ?? 'No Genre' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $movie->year }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                                        <span class="text-sm text-gray-900">{{ number_format($movie->ratings ?? 0, 1) }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ number_format($movie->views) }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="{{route('admin_movies.show',$movie->id)}}" class="text-blue-500 hover:text-blue-700 mr-3">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </a>
                                    <a href="{{route('admin_movies.edit',$movie->id)}}" class="text-blue-500 hover:text-blue-700 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form action="{{route('admin_movies.destroy',$movie->id)}}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    @if($search)
                                        No movies found matching "{{ $search }}".
                                    @else
                                        No movies found. <a href="{{ route('admin_movies.create') }}" class="text-blue-500 hover:text-blue-700">Add your first movie</a>.
                                    @endif
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="flex items-center justify-between mt-4">
                    <div class="text-sm text-gray-500">
                        Showing {{ $movies->firstItem() ?? 0 }} to {{ $movies->lastItem() ?? 0 }} of {{ $movies->total() }} entries
                        @if($search)
                            <span class="ml-2 text-blue-600">(filtered from {{ $stats['total_movies'] }} total movies)</span>
                        @endif
                    </div>

                    <!-- Laravel Pagination Links -->
                    <div class="flex space-x-2">
                        {{-- Previous Page Link --}}
                        @if ($movies->onFirstPage())
                            <span class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-400 cursor-not-allowed">Previous</span>
                        @else
                            <a href="{{ $movies->previousPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-50">Previous</a>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($movies->getUrlRange(1, $movies->lastPage()) as $page => $url)
                            @if ($page == $movies->currentPage())
                                <span class="px-3 py-1 bg-blue-500 text-white rounded-md text-sm">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-50">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($movies->hasMorePages())
                            <a href="{{ $movies->nextPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-50">Next</a>
                        @else
                            <span class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-400 cursor-not-allowed">Next</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
