@extends('frontend.layouts.app')

@section('content')
<style>
    /* Custom Video Player Styles */
    #trailerPlayer {
        border-radius: 8px;
    }

    #trailerPlayer::-webkit-media-controls-panel {
        background-color: rgba(0, 0, 0, 0.8);
    }

    #trailerPlayer::-webkit-media-controls-play-button,
    #trailerPlayer::-webkit-media-controls-volume-slider,
    #trailerPlayer::-webkit-media-controls-timeline {
        filter: brightness(1.2);
    }

    #playButton {
        transition: all 0.3s ease;
    }

    #playButton:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }

    /* Video loading animation */
    .video-loading {
        position: relative;
    }

    .video-loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 40px;
        height: 40px;
        margin: -20px 0 0 -20px;
        border: 3px solid #f97316;
        border-radius: 50%;
        border-top-color: transparent;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* Responsive video controls */
    @media (max-width: 768px) {
        #playButton .fa-play {
            font-size: 1.5rem;
        }

        #playButton {
            width: 60px;
            height: 60px;
        }
    }
</style>

<div class="container mx-auto px-4 py-8">
    <!-- Movie Details Card -->
    <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-2xl overflow-hidden mb-8 border border-gray-700">
        <div class="md:flex">
            <!-- Movie Poster -->
            <div class="md:w-1/3">
                <img src="{{ $movie->picture ? Storage::url($movie->picture) : '/image/movie.png' }}"
                    alt="{{ $movie->title }}"
                    class="w-full h-96 md:h-full object-cover">
            </div>

            <!-- Movie Info -->
            <div class="md:w-2/3 p-8 text-white">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h1 class="text-4xl font-bold text-white mb-3">{{ $movie->title }}</h1>
                        <div class="flex items-center space-x-4 text-sm text-gray-300 mb-4">
                            <span class="bg-orange-500 text-white px-3 py-1 rounded-full font-medium">{{ $movie->genre->name ?? 'Unknown' }}</span>
                            <span class="flex items-center">
                                <i class="fas fa-calendar mr-1"></i>
                                {{ $movie->year }}
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-clock mr-1"></i>
                                {{ $movie->long_time }}
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-eye mr-1"></i>
                                {{ number_format($movie->views) }} views
                            </span>
                        </div>
                    </div>

                    <!-- Quick Rating Display -->
                    <div class="text-center bg-gray-800 rounded-lg p-4">
                        <div class="text-3xl font-bold text-orange-400">
                            {{ number_format($movie->average_rating ?? 0, 1) }}
                        </div>
                        <div class="flex justify-center mb-1">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 {{ $i <= ($movie->average_rating ?? 0) ? 'text-yellow-400' : 'text-gray-600' }}"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                @endfor
                        </div>
                        <div class="text-xs text-gray-400">{{ $movie->total_ratings ?? 0 }} {{ Str::plural('rating', $movie->total_ratings ?? 0) }}</div>
                    </div>
                </div>

                <!-- Description -->
                @if($movie->description)
                <p class="text-gray-300 leading-relaxed mb-6 text-lg">{{ $movie->description }}</p>
                @endif

                <!-- Cast Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-800 rounded-lg p-4">
                        <h3 class="font-semibold text-orange-400 mb-2 flex items-center">
                            <i class="fas fa-user mr-2"></i>
                            Leading Actor
                        </h3>
                        <p class="text-gray-300">{{ $movie->actor }}</p>
                    </div>
                    <div class="bg-gray-800 rounded-lg p-4">
                        <h3 class="font-semibold text-orange-400 mb-2 flex items-center">
                            <i class="fas fa-user mr-2"></i>
                            Leading Actress
                        </h3>
                        <p class="text-gray-300">{{ $movie->actress }}</p>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ $movie->download_link }}"
                        target="_blank"
                        class="flex-1 bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white px-8 py-4 rounded-lg font-semibold transition duration-200 transform hover:scale-105 shadow-lg text-center">
                        <i class="fas fa-download mr-2"></i>
                        Download Movie
                    </a>

                    @auth
                    @if(auth()->user()->hasInWatchlist($movie->id))
                    <button onclick="removeFromWatchlist({{ $movie->id }})"
                        id="watchlist-btn"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white px-6 py-4 rounded-lg font-semibold transition duration-200 border border-red-500">
                        <i class="fas fa-check mr-2"></i>
                        In Watchlist
                    </button>
                    @else
                    <button onclick="addToWatchlist({{ $movie->id }})"
                        id="watchlist-btn"
                        class="flex-1 bg-gray-700 hover:bg-gray-600 text-white px-6 py-4 rounded-lg font-semibold transition duration-200 border border-gray-600">
                        <i class="fas fa-plus mr-2"></i>
                        Add to Watchlist
                    </button>
                    @endif
                    @else
                    <a href="{{ route('login') }}"
                        class="flex-1 bg-gray-700 hover:bg-gray-600 text-white px-6 py-4 rounded-lg font-semibold transition duration-200 border border-gray-600 text-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        Login to Add to Watchlist
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Trailer Section -->
    @if($movie->trailer_url)
    <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-2xl overflow-hidden mb-8 border border-gray-700">
        <div class="p-8">
            <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                <i class="fas fa-play-circle mr-3 text-orange-400"></i>
                Movie Trailer
            </h2>

            <!-- Video Player Container -->
            <div class="relative bg-black rounded-lg overflow-hidden shadow-2xl">
                <div class="relative" style="padding-bottom: 56.25%; /* 16:9 aspect ratio */">
                    @php
                    $isYouTube = false;
                    $youtubeId = '';
                    $trailerUrl = $movie->trailer_url ?: 'https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/BigBuckBunny.mp4';

                    // Check if it's a YouTube URL and extract video ID
                    if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $trailerUrl, $matches)) {
                    $isYouTube = true;
                    $youtubeId = $matches[1];
                    }
                    @endphp

                    @if($isYouTube)
                    <!-- YouTube Embed -->
                    <iframe
                        class="absolute top-0 left-0 w-full h-full"
                        src="https://www.youtube.com/embed/{{ $youtubeId }}?rel=0&modestbranding=1&controls=1&showinfo=0"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                    @else
                    <!-- Regular Video Player -->
                    <video
                        id="trailerPlayer"
                        class="absolute top-0 left-0 w-full h-full object-cover"
                        controls
                        preload="metadata"
                        poster="{{ $movie->picture ? Storage::url($movie->picture) : '/image/movie.png' }}"
                        playsinline>
                        <source src="{{ $trailerUrl }}" type="video/mp4">
                        <source src="{{ $trailerUrl }}" type="video/webm">
                        <source src="{{ $trailerUrl }}" type="video/ogg">
                        <p class="text-white p-4">
                            Your browser doesn't support HTML5 video.
                            <a href="{{ $trailerUrl }}" class="text-orange-400 hover:text-orange-300">
                                Download the video
                            </a> instead.
                        </p>
                    </video>

                    <!-- Custom Play Button Overlay (only for regular videos) -->
                    <div id="playButton" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 cursor-pointer transition-opacity duration-300 hover:bg-opacity-30">
                        <div class="w-20 h-20 bg-orange-500 rounded-full flex items-center justify-center shadow-2xl transform transition-transform duration-300 hover:scale-110">
                            <i class="fas fa-play text-white text-2xl ml-1"></i>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Video Controls Info (only for regular videos) -->
                @if(!$isYouTube)
                <div class="p-4 bg-gray-800 border-t border-gray-700">
                    <div class="flex items-center justify-between text-sm text-gray-400">
                        <div class="flex items-center space-x-4">
                            <span class="flex items-center">
                                <i class="fas fa-clock mr-1"></i>
                                <span id="videoDuration">--:--</span>
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-volume-up mr-1"></i>
                                Volume: <span id="volumeLevel">100%</span>
                            </span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button id="volumeBtn" class="hover:text-orange-400 transition-colors duration-200">
                                <i class="fas fa-volume-up"></i>
                            </button>
                            <button id="fullscreenBtn" class="hover:text-orange-400 transition-colors duration-200">
                                <i class="fas fa-expand"></i>
                            </button>
                        </div>
                    </div>
                </div>
                @else
                <!-- YouTube Video Info -->
                <div class="p-4 bg-gray-800 border-t border-gray-700">
                    <div class="flex items-center justify-center text-sm text-gray-400">
                        <span class="flex items-center">
                            <i class="fab fa-youtube mr-2 text-red-500"></i>
                            YouTube Trailer - Full controls available in player
                        </span>
                    </div>
                </div>
                @endif
            </div>

            <!-- Trailer Info -->
            <div class="mt-4 text-center">
                <p class="text-gray-400 text-sm">
                    <i class="fas fa-info-circle mr-1"></i>
                    Official trailer for "{{ $movie->title }}" - Watch a sneak peek before downloading
                </p>
            </div>
        </div>
    </div>
    @endif

    <!-- Rating System -->
    <div class="mb-8">
        @include('components.simple-rating', ['movie' => $movie, 'userRating' => $userRating])
    </div>

    <!-- Recent Reviews Section -->
    @php
    $movieRatings = $movie->ratings()->whereNotNull('review')->with('user')->latest()->take(3)->get();
    @endphp
    @if($movieRatings->count() > 0)
    <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700 mb-8">
        <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
            <i class="fas fa-comments mr-3 text-orange-400"></i>
            Recent Reviews
        </h2>
        <div class="space-y-4">
            @foreach($movieRatings as $rating)
            <div class="bg-gray-800 rounded-lg p-4 border border-gray-700">
                <div class="flex items-start justify-between mb-2">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-red-500 rounded-full flex items-center justify-center">
                            <span class="text-white font-medium text-sm">{{ substr($rating->user->name, 0, 1) }}</span>
                        </div>
                        <div>
                            <h4 class="font-medium text-white">{{ $rating->user->name }}</h4>
                            <div class="flex items-center space-x-1">
                                @for($i = 1; $i <= 5; $i++)
                                    <svg class="w-4 h-4 {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-600' }}"
                                    fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                    @endfor
                            </div>
                        </div>
                    </div>
                    <span class="text-sm text-gray-400">{{ $rating->created_at->diffForHumans() }}</span>
                </div>
                <p class="text-gray-300 leading-relaxed">{{ $rating->review }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- Related Movies -->
    @if($movie->genre && $movie->genre->movies()->where('id', '!=', $movie->id)->exists())
    <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-700">
        <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
            <i class="fas fa-film mr-3 text-orange-400"></i>
            More {{ $movie->genre->name }} Movies
        </h2>
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($movie->genre->movies()->where('id', '!=', $movie->id)->take(8)->get() as $relatedMovie)
            <a href="{{ route('moviePage.show', $relatedMovie->id) }}"
                class="group block bg-gray-800 rounded-lg shadow-md overflow-hidden hover:shadow-xl transition duration-200 border border-gray-700 hover:border-orange-500">
                <img src="{{ $relatedMovie->picture ? Storage::url($relatedMovie->picture) : '/image/movie.png' }}"
                    alt="{{ $relatedMovie->title }}"
                    class="w-full h-48 object-cover group-hover:scale-105 transition duration-200">
                <div class="p-4">
                    <h3 class="font-semibold text-sm text-white truncate mb-2">{{ $relatedMovie->title }}</h3>
                    <div class="flex items-center justify-between">
                        <div class="flex">
                            @for($i = 1; $i <= 5; $i++)
                                <svg class="w-3 h-3 {{ $i <= ($relatedMovie->average_rating ?? 0) ? 'text-yellow-400' : 'text-gray-600' }}"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                                @endfor
                        </div>
                        <span class="text-xs text-gray-400">{{ number_format($relatedMovie->average_rating ?? 0, 1) }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
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

<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    // Video Player Functionality
    document.addEventListener('DOMContentLoaded', function() {
        const video = document.getElementById('trailerPlayer');
        const playButton = document.getElementById('playButton');
        const volumeBtn = document.getElementById('volumeBtn');
        const fullscreenBtn = document.getElementById('fullscreenBtn');
        const volumeLevel = document.getElementById('volumeLevel');
        const videoDuration = document.getElementById('videoDuration');

        // Only initialize custom controls for regular video players (not YouTube)
        if (video) {
            // Initialize video player
            video.volume = 1.0;

            // Play button functionality
            if (playButton) {
                playButton.addEventListener('click', function() {
                    if (video.paused) {
                        video.play();
                        playButton.style.display = 'none';
                    }
                });
            }

            // Hide play button when video starts
            video.addEventListener('play', function() {
                if (playButton) {
                    playButton.style.display = 'none';
                }
            });

            // Show play button when video is paused
            video.addEventListener('pause', function() {
                if (playButton) {
                    playButton.style.display = 'flex';
                }
            });

            // Update duration when video metadata is loaded
            video.addEventListener('loadedmetadata', function() {
                if (videoDuration) {
                    const minutes = Math.floor(video.duration / 60);
                    const seconds = Math.floor(video.duration % 60);
                    videoDuration.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                }
            });

            // Volume control
            if (volumeBtn) {
                volumeBtn.addEventListener('click', function() {
                    if (video.muted) {
                        video.muted = false;
                        volumeBtn.innerHTML = '<i class="fas fa-volume-up"></i>';
                        volumeLevel.textContent = Math.round(video.volume * 100) + '%';
                    } else {
                        video.muted = true;
                        volumeBtn.innerHTML = '<i class="fas fa-volume-mute"></i>';
                        volumeLevel.textContent = '0%';
                    }
                });
            }

            // Fullscreen functionality
            if (fullscreenBtn) {
                fullscreenBtn.addEventListener('click', function() {
                    if (video.requestFullscreen) {
                        video.requestFullscreen();
                    } else if (video.webkitRequestFullscreen) {
                        video.webkitRequestFullscreen();
                    } else if (video.msRequestFullscreen) {
                        video.msRequestFullscreen();
                    }
                });
            }

            // Volume change event
            video.addEventListener('volumechange', function() {
                if (volumeLevel && !video.muted) {
                    volumeLevel.textContent = Math.round(video.volume * 100) + '%';
                }
            });

            // Add keyboard controls
            video.addEventListener('keydown', function(e) {
                switch (e.code) {
                    case 'Space':
                        e.preventDefault();
                        if (video.paused) {
                            video.play();
                        } else {
                            video.pause();
                        }
                        break;
                    case 'ArrowLeft':
                        e.preventDefault();
                        video.currentTime -= 10;
                        break;
                    case 'ArrowRight':
                        e.preventDefault();
                        video.currentTime += 10;
                        break;
                    case 'ArrowUp':
                        e.preventDefault();
                        video.volume = Math.min(1, video.volume + 0.1);
                        break;
                    case 'ArrowDown':
                        e.preventDefault();
                        video.volume = Math.max(0, video.volume - 0.1);
                        break;
                }
            });

            // Add video ended event
            video.addEventListener('ended', function() {
                if (playButton) {
                    playButton.style.display = 'flex';
                }
            });
        }
    });

    // Watchlist Functions
    function addToWatchlist(movieId) {
        const button = document.getElementById('watchlist-btn');
        const originalContent = button.innerHTML;

        // Show loading state
        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Adding...';
        button.disabled = true;

        fetch('{{ route("watchlist.store") }}', {
                method: 'POST',
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
                    // Update button to "In Watchlist" state
                    button.innerHTML = '<i class="fas fa-check mr-2"></i>In Watchlist';
                    button.className = button.className.replace('bg-gray-700 hover:bg-gray-600', 'bg-red-600 hover:bg-red-700').replace('border-gray-600', 'border-red-500');
                    button.onclick = () => removeFromWatchlist(movieId);
                    showToast(data.message, 'success');
                } else {
                    button.innerHTML = originalContent;
                    showToast(data.message, 'error');
                }
            })
            .catch(error => {
                button.innerHTML = originalContent;
                showToast('An error occurred', 'error');
            })
            .finally(() => {
                button.disabled = false;
            });
    }

    function removeFromWatchlist(movieId) {
        const button = document.getElementById('watchlist-btn');
        const originalContent = button.innerHTML;

        // Show loading state
        button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Removing...';
        button.disabled = true;

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
                    // Update button to "Add to Watchlist" state
                    button.innerHTML = '<i class="fas fa-plus mr-2"></i>Add to Watchlist';
                    button.className = button.className.replace('bg-red-600 hover:bg-red-700', 'bg-gray-700 hover:bg-gray-600').replace('border-red-500', 'border-gray-600');
                    button.onclick = () => addToWatchlist(movieId);
                    showToast(data.message, 'success');
                } else {
                    button.innerHTML = originalContent;
                    showToast(data.message, 'error');
                }
            })
            .catch(error => {
                button.innerHTML = originalContent;
                showToast('An error occurred', 'error');
            })
            .finally(() => {
                button.disabled = false;
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

@endsection