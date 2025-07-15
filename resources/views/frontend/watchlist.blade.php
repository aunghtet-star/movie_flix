@extends('frontend.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white mb-2">My Watchlist</h1>
        <p class="text-gray-300">Movies you want to watch later</p>
    </div>

    @if($watchlistMovies->count() > 0)
    <!-- Movies Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6 mb-8">
        @foreach($watchlistMovies as $movie)
        <div class="group relative">
            <!-- Movie Card -->
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-lg shadow-lg overflow-hidden border border-gray-700 hover:border-orange-500 transition duration-300">
                <a href="{{ route('moviePage.show', $movie->id) }}" class="block">
                    <div class="relative aspect-[3/4] overflow-hidden">
                        <img src="{{ $movie->picture ? Storage::url($movie->picture) : '/image/movie.png' }}"
                            alt="{{ $movie->title }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">

                        <!-- Overlay with rating -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300">
                            <div class="absolute bottom-4 left-4 right-4">
                                <div class="flex items-center justify-between text-white text-sm">
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                                        <span>{{ number_format($movie->average_rating ?? 0, 1) }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-eye mr-1"></i>
                                        <span>{{ number_format($movie->views) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>

                <!-- Movie Info -->
                <div class="p-4">
                    <h3 class="font-semibold text-white text-sm mb-2 line-clamp-2">{{ $movie->title }}</h3>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <span class="text-xs text-gray-400">{{ $movie->year }}</span>
                            @if($movie->genre)
                            <span class="bg-orange-500/20 text-orange-300 px-2 py-1 rounded text-xs">
                                {{ $movie->genre->name }}
                            </span>
                            @endif
                        </div>
                        <!-- Remove from watchlist button -->
                        <button onclick="removeFromWatchlist({{ $movie->id }})"
                            class="text-red-400 hover:text-red-300 transition duration-200"
                            title="Remove from watchlist">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="flex justify-center">
        {{ $watchlistMovies->links() }}
    </div>
    @else
    <!-- Empty State -->
    <div class="text-center py-16">
        <div class="w-24 h-24 bg-gray-800 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="fas fa-bookmark text-4xl text-gray-600"></i>
        </div>
        <h2 class="text-2xl font-bold text-white mb-4">Your watchlist is empty</h2>
        <p class="text-gray-400 mb-8">Start adding movies you want to watch later!</p>
        <a href="{{ url('/') }}"
            class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white px-8 py-3 rounded-lg font-semibold transition duration-200 inline-flex items-center">
            <i class="fas fa-search mr-2"></i>
            Browse Movies
        </a>
    </div>
    @endif
</div>

<!-- Toast Notification -->
<div id="toast" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-x-full opacity-0 transition-all duration-300 z-50">
    <div class="flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        <span id="toast-message"></span>
    </div>
</div>

<script>
    function removeFromWatchlist(movieId) {
        if (!confirm('Are you sure you want to remove this movie from your watchlist?')) {
            return;
        }

        fetch('{{ route("watchlist.destroy") }}', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    movie_id: movieId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast(data.message, 'success');
                    // Reload the page after a short delay
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    showToast(data.message, 'error');
                }
            })
            .catch(error => {
                showToast('An error occurred', 'error');
            });
    }

    function showToast(message, type) {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toast-message');

        toastMessage.textContent = message;

        if (type === 'error') {
            toast.className = toast.className.replace('bg-green-500', 'bg-red-500');
        } else {
            toast.className = toast.className.replace('bg-red-500', 'bg-green-500');
        }

        toast.classList.remove('translate-x-full', 'opacity-0');

        setTimeout(() => {
            toast.classList.add('translate-x-full', 'opacity-0');
        }, 3000);
    }
</script>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection