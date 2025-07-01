<!-- Simplified Movie Rating Component -->
<div class="rating-system bg-gradient-to-br from-gray-900 to-gray-800 rounded-xl p-6 border border-gray-700"
     x-data="simpleRating({{ $movie->id }}, {{ auth()->check() && $userRating ? $userRating->rating : 0 }}, {{ $movie->average_rating ?? 0 }})">

    <!-- Rating Overview -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-4">
            <div class="text-center">
                <div class="text-3xl font-bold text-orange-400" x-text="averageRating > 0 ? averageRating.toFixed(1) : '0.0'"></div>
                <div class="flex justify-center mb-1">
                    <template x-for="i in 5" :key="i">
                        <svg class="w-5 h-5" :class="i <= Math.floor(averageRating) ? 'text-yellow-400' : 'text-gray-600'"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </template>
                </div>
                <p class="text-sm text-gray-400">{{ $movie->total_ratings ?? 0 }} ratings</p>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="text-right">
            <div class="text-sm text-gray-400 mb-1">{{ number_format($movie->views ?? 0) }} views</div>
            <div class="text-sm text-orange-400 font-medium">{{ $movie->genre->name ?? 'Unknown Genre' }}</div>
        </div>
    </div>

    @auth
        <!-- User Rating Section -->
        <div class="border-t border-gray-700 pt-6">
            <h3 class="text-lg font-semibold text-white mb-4">
                <span x-show="userRating === 0" class="text-orange-400">Rate this movie</span>
                <span x-show="userRating > 0" class="text-green-400">Your rating</span>
            </h3>

            <!-- Star Rating Input -->
            <div class="flex items-center space-x-2 mb-4">
                <template x-for="i in 5" :key="i">
                    <button type="button"
                            @click="setRating(i)"
                            @mouseenter="hoverRating = i"
                            @mouseleave="hoverRating = 0"
                            class="focus:outline-none transition-all duration-200 hover:scale-110">
                        <svg class="w-8 h-8"
                             :class="i <= (hoverRating || userRating) ? 'text-yellow-400' : 'text-gray-600'"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </button>
                </template>
                <span class="ml-3 text-sm text-gray-400" x-show="hoverRating > 0" x-text="getRatingText(hoverRating)"></span>
                <span class="ml-3 text-sm text-gray-400" x-show="hoverRating === 0 && userRating > 0" x-text="getRatingText(userRating)"></span>
            </div>

            <!-- Submit Button -->
            <div class="flex items-center space-x-3" x-show="userRating > 0">
                <button @click="submitRating()"
                        :disabled="isSubmitting"
                        class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 disabled:from-gray-500 disabled:to-gray-600 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200">
                    <span x-show="!isSubmitting">Submit Rating</span>
                    <span x-show="isSubmitting">Submitting...</span>
                </button>

                <button @click="userRating = 0"
                        x-show="userRating > 0"
                        class="text-gray-400 hover:text-white px-4 py-2 transition duration-200">
                    Clear
                </button>
            </div>
        </div>
    @else
        <!-- Guest Prompt -->
        <div class="border-t border-gray-700 pt-6 text-center">
            <p class="text-gray-400 mb-4">Sign in to rate this movie</p>
            <a href="{{ route('login') }}"
               class="inline-block bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200">
                Sign In
            </a>
        </div>
    @endauth
</div>

<script>
function simpleRating(movieId, currentUserRating, currentAverage) {
    return {
        movieId: movieId,
        userRating: currentUserRating,
        hoverRating: 0,
        averageRating: currentAverage,
        isSubmitting: false,

        setRating(rating) {
            this.userRating = rating;
        },

        getRatingText(rating) {
            const texts = ['', 'Poor', 'Fair', 'Good', 'Very Good', 'Excellent'];
            return texts[rating] || '';
        },

        async submitRating() {
            this.isSubmitting = true;

            try {
                const response = await fetch(`/movies/${this.movieId}/rate`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        rating: this.userRating
                    })
                });

                const data = await response.json();

                if (data.success) {
                    this.averageRating = data.average_rating;
                    if (typeof showToast === 'function') {
                        showToast('success', data.message);
                    } else {
                        alert(data.message);
                    }
                    // Refresh page to show updated ratings
                    setTimeout(() => window.location.reload(), 1000);
                } else {
                    if (typeof showToast === 'function') {
                        showToast('error', data.message || 'Failed to submit rating');
                    } else {
                        alert(data.message || 'Failed to submit rating');
                    }
                }
            } catch (error) {
                console.error('Rating error:', error);
                if (typeof showToast === 'function') {
                    showToast('error', 'An error occurred while submitting your rating');
                } else {
                    alert('An error occurred while submitting your rating');
                }
            } finally {
                this.isSubmitting = false;
            }
        }
    }
}
</script>
