@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Movies Management</h1>
            <p class="text-gray-600">Manage your movie collection</p>
        </div>
        <a href="{{ route('admin_movies.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
            <i class="fas fa-plus mr-2"></i>Add New Movie
        </a>
    </div>

    <!-- Movies Grid -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 p-6">
            @forelse($movies ?? [] as $movie)
            <div class="bg-white border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition duration-200">
                <!-- Movie Poster -->
                <div class="aspect-w-3 aspect-h-4">
                    <img src="{{ $movie->picture ? Storage::url($movie->picture) : '/image/movie.png' }}"
                         alt="{{ $movie->title }}"
                         class="w-full h-48 object-cover">
                </div>

                <!-- Movie Info -->
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 text-sm mb-1 truncate">{{ $movie->title }}</h3>
                    <p class="text-xs text-gray-500 mb-2">{{ $movie->genre->name ?? 'Unknown' }}</p>
                    <p class="text-xs text-gray-600 mb-3">{{ $movie->year }} • {{ $movie->long_time }}</p>

                    <!-- Action Buttons -->
                    <div class="flex space-x-2">
                        <a href="{{ route('admin_movies.edit', $movie->id) }}"
                           class="flex-1 text-center bg-blue-500 hover:bg-blue-600 text-white text-xs py-2 px-3 rounded transition duration-200">
                            <i class="fas fa-edit mr-1"></i>Edit
                        </a>
                        <button type="button"
                                onclick="confirmDelete('{{ $movie->title }}', '{{ route('admin_movies.destroy', $movie->id) }}', 'movie')"
                                class="flex-1 bg-red-500 hover:bg-red-600 text-white text-xs py-2 px-3 rounded transition duration-200">
                            <i class="fas fa-trash mr-1"></i>Delete
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-film text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">No movies found.</p>
                <a href="{{ route('admin_movies.create') }}" class="text-blue-500 hover:text-blue-600 mt-2 inline-block">
                    Add your first movie
                </a>
            </div>
            @endforelse
        </div>
    </div>

    <!-- Pagination -->
    @if(isset($movies) && $movies->hasPages())
        <div class="mt-6">
            {{ $movies->links() }}
        </div>
    @endif
</div>
@endsection
