@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Movies Management</h1>
            <p class="text-gray-200">Manage your movie collection</p>
        </div>
        <a href="{{ route('admin_movies.create') }}" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white px-6 py-3 rounded-lg transition duration-200 shadow-lg">
            <i class="fas fa-plus mr-2"></i>Add New Movie
        </a>
    </div>

    <!-- Search Bar -->
    <div class="mb-6">
        <form method="GET" action="{{ route('admin_movies.index') }}" class="flex gap-4">
            <div class="flex-1">
                <div class="relative">
                    <input type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search movies by title, actor, actress, or genre..."
                        class="w-full bg-white/10 backdrop-blur-md border border-orange-400/30 text-white placeholder-gray-300 rounded-lg px-4 py-3 pl-10 focus:outline-none focus:border-orange-400 focus:ring-2 focus:ring-orange-400/30 focus:bg-white/15">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-300"></i>
                    </div>
                </div>
            </div>
            <button type="submit" class="bg-orange-600 hover:bg-orange-700 text-white px-6 py-3 rounded-lg transition duration-200 shadow-lg">
                <i class="fas fa-search mr-2"></i>Search
            </button>
            @if(request('search'))
            <a href="{{ route('admin_movies.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition duration-200 shadow-lg">
                <i class="fas fa-times mr-2"></i>Clear
            </a>
            @endif
        </form>
    </div> <!-- Movies Table -->
    <div class="backdrop-blur-md bg-white/5 rounded-xl shadow-2xl overflow-hidden border border-orange-400/20">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-orange-400/20">
                <thead class="bg-black/30">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-orange-200 uppercase tracking-wider">Movie</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-orange-200 uppercase tracking-wider">Genre</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-orange-200 uppercase tracking-wider">Year</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-orange-200 uppercase tracking-wider">Duration</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-orange-200 uppercase tracking-wider">Rating</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-orange-200 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-orange-400/10">
                    @forelse($movies ?? [] as $movie)
                    <tr class="hover:bg-orange-500/10 transition duration-200">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-16 w-12">
                                    <img class="h-16 w-12 rounded object-cover border border-orange-400/20 shadow-md"
                                        src="{{ $movie->picture ? asset('storage/' . $movie->picture) : asset('image/movie.png') }}"
                                        alt="{{ $movie->title }}"
                                        onerror="this.src='/image/movie.png'">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-semibold text-white drop-shadow">{{ $movie->title }}</div>
                                    <div class="text-sm text-gray-200">{{ Str::limit($movie->description ?? '', 50) }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full bg-orange-500/20 text-orange-200 border border-orange-400/30">
                                {{ $movie->genre->name ?? 'Unknown' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-100">
                            {{ $movie->year }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-100">
                            {{ $movie->long_time }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="text-sm text-yellow-400 font-medium">
                                    <i class="fas fa-star mr-1"></i>
                                    {{ number_format($movie->ratings_avg_rating ?? 0, 1) }}
                                </div>
                                <div class="text-xs text-gray-300 ml-2">
                                    ({{ $movie->ratings_count ?? 0 }} reviews)
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <div class="flex justify-center space-x-3">
                                <a href="{{ route('admin_movies.show', $movie->id) }}"
                                    class="bg-blue-600/80 hover:bg-blue-600 text-white p-2 rounded-lg transition duration-200"
                                    title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin_movies.edit', $movie->id) }}"
                                    class="bg-green-600/80 hover:bg-green-600 text-white p-2 rounded-lg transition duration-200"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button"
                                    data-movie-title="{{ $movie->title }}"
                                    data-delete-url="{{ route('admin_movies.destroy', $movie->id) }}"
                                    onclick="confirmDeleteMovie(this)"
                                    class="bg-red-600/80 hover:bg-red-600 text-white p-2 rounded-lg transition duration-200"
                                    title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center">
                                <i class="fas fa-film text-6xl text-orange-400/50 mb-4"></i>
                                <p class="text-gray-200 text-lg font-medium">No movies found.</p>
                                <a href="{{ route('admin_movies.create') }}" class="text-orange-400 hover:text-orange-300 mt-2 inline-block transition duration-200 font-medium">
                                    Add your first movie
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    @if(isset($movies) && $movies->hasPages())
    <div class="mt-6">
        <div class="backdrop-blur-md bg-white/5 rounded-lg border border-orange-400/20 p-4">
            <style>
                .pagination {
                    display: flex;
                    justify-content: center;
                    gap: 0.5rem;
                }

                .pagination .page-link {
                    color: #fed7aa;
                    background-color: rgba(255, 255, 255, 0.1);
                    border: 1px solid #fb923c;
                    padding: 0.5rem 0.75rem;
                    border-radius: 0.5rem;
                    text-decoration: none;
                    transition: all 0.2s;
                    font-weight: 500;
                }

                .pagination .page-link:hover {
                    background-color: #ea580c;
                    color: white;
                    transform: translateY(-1px);
                }

                .pagination .page-item.active .page-link {
                    background-color: #ea580c;
                    color: white;
                    border-color: #ea580c;
                }

                .pagination .page-item.disabled .page-link {
                    color: #9ca3af;
                    border-color: #6b7280;
                    background-color: rgba(255, 255, 255, 0.05);
                }
            </style>
            {{ $movies->links() }}
        </div>
    </div>
    @endif
</div>

<script>
    function confirmDeleteMovie(button) {
        const movieTitle = button.dataset.movieTitle;
        const deleteUrl = button.dataset.deleteUrl;

        if (typeof showConfirmation === 'function') {
            showConfirmation(
                'Delete Movie',
                `Are you sure you want to delete "${movieTitle}"? This action cannot be undone.`,
                function() {
                    // Create and submit form
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = deleteUrl;

                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';

                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                },
                'Delete',
                'bg-red-600 hover:bg-red-700'
            );
        } else {
            // Fallback to native confirm
            if (confirm(`Are you sure you want to delete "${movieTitle}"?`)) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;

                const csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                const methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';

                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        }
    }
</script>
@endsection