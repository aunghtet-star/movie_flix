@extends('admin.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-white drop-shadow-lg">Genres Management</h1>
            <p class="text-gray-200">Manage movie genres and categories</p>
        </div>
        <a href="{{ route('genres.create') }}" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white px-6 py-3 rounded-lg transition duration-200 shadow-lg">
            <i class="fas fa-plus mr-2"></i>Add New Genre
        </a>
    </div>

    <!-- Genres Table -->
    <div class="backdrop-blur-md bg-white/5 rounded-xl shadow-2xl overflow-hidden border border-orange-400/20">
        <table class="min-w-full divide-y divide-orange-400/20">
            <thead class="bg-black/30">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-orange-200 uppercase tracking-wider">Genre</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-orange-200 uppercase tracking-wider">Movies Count</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-orange-200 uppercase tracking-wider">Created</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-orange-200 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-orange-400/10">
                @forelse($genres ?? [] as $genre)
                <tr class="hover:bg-orange-500/10 transition duration-200">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="h-12 w-12 rounded-full bg-gradient-to-r from-orange-400 to-red-500 flex items-center justify-center shadow-lg">
                                <i class="fas fa-tag text-white"></i>
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-semibold text-white drop-shadow">{{ $genre->name }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-600/20 text-blue-300 border border-blue-400/30">
                            {{ $genre->movies_count ?? $genre->movies()->count() }} movies
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-200">
                        {{ $genre->created_at ? $genre->created_at->format('M d, Y') : 'N/A' }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                        <div class="flex space-x-3">
                            <a href="{{ route('genres.edit', $genre->id) }}"
                                class="bg-blue-600/80 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200 shadow-md">
                                <i class="fas fa-edit mr-1"></i>Edit
                            </a>
                            <button type="button"
                                data-genre-name="{{ $genre->name }}"
                                data-delete-url="{{ route('genres.destroy', $genre->id) }}"
                                data-movie-count="{{ $genre->movies()->count() }}"
                                onclick="confirmGenreDelete(this)"
                                class="bg-red-600/80 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200 shadow-md">
                                <i class="fas fa-trash mr-1"></i>Delete
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center">
                            <i class="fas fa-tags text-6xl text-orange-400/50 mb-4"></i>
                            <p class="text-gray-200 text-lg font-medium">No genres found.</p>
                            <a href="{{ route('genres.create') }}" class="text-orange-400 hover:text-orange-300 mt-2 inline-block transition duration-200 font-medium">
                                Create your first genre
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if(isset($genres) && $genres->hasPages())
    <div class="mt-6">
        <div class="backdrop-blur-md bg-white/5 rounded-lg border border-orange-400/20 p-4">
            {{ $genres->links() }}
        </div>
    </div>
    @endif
</div>

<script>
    function confirmGenreDelete(button) {
        const genreName = button.dataset.genreName;
        const deleteUrl = button.dataset.deleteUrl;
        const movieCount = parseInt(button.dataset.movieCount);

        if (movieCount > 0) {
            if (typeof showConfirmation === 'function') {
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
                alert(`Cannot delete "${genreName}" because it has ${movieCount} movie(s) assigned to it.`);
            }
        } else {
            if (typeof showConfirmation === 'function') {
                showConfirmation(
                    'Delete Genre',
                    `Are you sure you want to delete "${genreName}"? This action cannot be undone.`,
                    function() {
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
                if (confirm(`Are you sure you want to delete "${genreName}"?`)) {
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
    }
</script>
@endsection