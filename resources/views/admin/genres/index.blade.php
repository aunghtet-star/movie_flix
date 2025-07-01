@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Genres Management</h1>
            <p class="text-gray-600">Manage movie genres and categories</p>
        </div>
        <a href="{{ route('genres.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200">
            <i class="fas fa-plus mr-2"></i>Add New Genre
        </a>
    </div>

    <!-- Genres Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Genre</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Movies Count</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($genres ?? [] as $genre)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-r from-orange-400 to-red-500 flex items-center justify-center">
                                <i class="fas fa-tag text-white text-sm"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">{{ $genre->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ $genre->movies_count ?? $genre->movies()->count() }} movies
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $genre->created_at ? $genre->created_at->format('M d, Y') : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-2">
                            <a href="{{ route('genres.edit', $genre->id) }}"
                               class="text-indigo-600 hover:text-indigo-900 px-3 py-1 rounded border border-indigo-200 hover:bg-indigo-50 transition duration-200">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <button type="button"
                                    onclick="confirmGenreDelete('{{ $genre->name }}', '{{ route('genres.destroy', $genre->id) }}', {{ $genre->movies()->count() }})"
                                    class="text-red-600 hover:text-red-900 px-3 py-1 rounded border border-red-200 hover:bg-red-50 transition duration-200">
                                <i class="fas fa-trash mr-1"></i>Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-tags text-4xl text-gray-300 mb-4"></i>
                        <p>No genres found.</p>
                        <a href="{{ route('genres.create') }}" class="text-blue-500 hover:text-blue-600 mt-2 inline-block">
                            Create your first genre
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if(isset($genres) && $genres->hasPages())
        <div class="mt-6">
            {{ $genres->links() }}
        </div>
    @endif
</div>

<script>
function confirmGenreDelete(genreName, deleteUrl, movieCount) {
    if (movieCount > 0) {
        showConfirmation(
            'Cannot Delete Genre',
            `Cannot delete "${genreName}" because it has ${movieCount} movie(s) assigned to it. Please reassign or delete those movies first.`,
            function() {
                // Do nothing - just close modal
            },
            'Understood',
            'bg-yellow-600 hover:bg-yellow-700'
        );
    } else {
        confirmDelete(genreName, deleteUrl, 'genre');
    }
}
</script>
@endsection
