@extends('admin.layouts.app')
@section('content')
    <div id="genres-section" class="content-section">
        <h2 class="text-2xl font-semibold mb-6">Genre Management</h2>

        <!-- Genre Stats -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-500 text-white p-3 rounded-lg">
                        <i class="fas fa-tags"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Genres</p>
                        <h3 class="text-xl font-semibold">{{ number_format($stats['total_genres']) }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-500 text-white p-3 rounded-lg">
                        <i class="fas fa-film"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Genres with Movies</p>
                        <h3 class="text-xl font-semibold">{{ number_format($stats['genres_with_movies']) }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-500 text-white p-3 rounded-lg">
                        <i class="fas fa-video"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Total Movies</p>
                        <h3 class="text-xl font-semibold">{{ number_format($stats['total_movies']) }}</h3>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-orange-500 text-white p-3 rounded-lg">
                        <i class="fas fa-chart-bar"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-500 text-sm">Avg Movies/Genre</p>
                        <h3 class="text-xl font-semibold">{{ number_format($stats['average_movies_per_genre'], 1) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Genres Table -->
        <div class="bg-white rounded-lg shadow">
            <div class="p-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-semibold">Genres</h3>
                <div class="flex space-x-2">
                    <form method="GET" action="{{ route('genres.index') }}" class="relative">
                        <input type="text" name="search" value="{{ $search }}" placeholder="Search genres..."
                               class="w-64 pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <i class="fas fa-search"></i>
                        </div>
                    </form>
                    <a href="{{ route('genres.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md text-sm">
                        <i class="fas fa-plus mr-2"></i> Add Genre
                    </a>
                </div>
            </div>
            <div class="p-4">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Genre Name
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Movies Count
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Created Date
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($genres as $genre)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-500">
                                            <i class="fas fa-tag"></i>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $genre->name }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        {{ $genre->movies_count > 0 ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $genre->movies_count }} movies
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $genre->created_at->format('d M Y') }}</div>
                                    <div class="text-sm text-gray-500">{{ $genre->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <a href="{{ route('genres.edit', $genre->id) }}" class="text-blue-500 hover:text-blue-700 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('genres.destroy', $genre->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700"
                                                onclick="return confirm('Are you sure you want to delete this genre?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                    @if($search)
                                        No genres found matching "{{ $search }}".
                                    @else
                                        No genres found. <a href="{{ route('genres.create') }}" class="text-blue-500 hover:text-blue-700">Create your first genre</a>.
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
                        Showing {{ $genres->firstItem() ?? 0 }} to {{ $genres->lastItem() ?? 0 }} of {{ $genres->total() }} entries
                        @if($search)
                            <span class="ml-2 text-blue-600">(filtered from {{ $stats['total_genres'] }} total genres)</span>
                        @endif
                    </div>

                    <!-- Laravel Pagination Links -->
                    <div class="flex space-x-2">
                        {{-- Previous Page Link --}}
                        @if ($genres->onFirstPage())
                            <span class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-400 cursor-not-allowed">Previous</span>
                        @else
                            <a href="{{ $genres->previousPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-50">Previous</a>
                        @endif

                        {{-- Page Numbers --}}
                        @foreach ($genres->getUrlRange(1, $genres->lastPage()) as $page => $url)
                            @if ($page == $genres->currentPage())
                                <span class="px-3 py-1 bg-blue-500 text-white rounded-md text-sm">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-50">{{ $page }}</a>
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($genres->hasMorePages())
                            <a href="{{ $genres->nextPageUrl() }}" class="px-3 py-1 border border-gray-300 rounded-md text-sm hover:bg-gray-50">Next</a>
                        @else
                            <span class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-400 cursor-not-allowed">Next</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
