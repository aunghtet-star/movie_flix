<!-- Movie Rating Component -->
<div class="movie-rating-system" x-data="movieRating({{ $movie->id }}, {{ $userRating ? $userRating->rating : 0 }}, {{ $movie->average_rating }})">
    <!-- Average Rating Display -->
    <div class="rating-overview mb-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-4">
                <div class="text-center">
                    <div class="text-4xl font-bold text-orange-400" x-text="averageRating.toFixed(1)"></div>
                    <div class="flex justify-center mb-1">
                        <template x-for="(star, index) in 5" :key="index">
                            <svg class="w-5 h-5" :class="index < Math.floor(averageRating) ? 'text-yellow-400' : 'text-gray-300'"
                                 fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        </template>
                    </div>
                    <p class="text-sm text-gray-500">{{ $movie->total_ratings }} {{ Str::plural('rating', $movie->total_ratings) }}</p>
                </div>
            </div>

            <!-- Rating Breakdown -->
            <div class="flex-1 max-w-sm ml-8">
                @for($i = 5; $i >= 1; $i--)
                    @php
                        $count = $movie->ratings()->where('rating', $i)->count();
                        $percentage = $movie->total_ratings > 0 ? ($count / $movie->total_ratings) * 100 : 0;
                    @endphp
                    <div class="flex items-center text-sm mb-1">
                        <span class="w-3 text-gray-600">{{ $i }}</span>
                        <svg class="w-4 h-4 text-yellow-400 mx-1" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <div class="flex-1 mx-2">
                            <div class="bg-gray-200 rounded-full h-2">
                                <div class="bg-orange-400 h-2 rounded-full transition-all duration-300" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                        <span class="w-8 text-xs text-gray-500">{{ $count }}</span>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <!-- User Rating Section -->
    @auth
        <div class="user-rating-section bg-gradient-to-r from-gray-50 to-orange-50 rounded-xl p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <span x-show="userRating === 0">Rate this movie</span>
                <span x-show="userRating > 0">Your rating</span>
            </h3>

            <!-- Interactive Star Rating -->
            <div class="flex items-center space-x-1 mb-4">
                <template x-for="(star, index) in 5" :key="index">
                    <button type="button"
                            @click="setRating(index + 1)"
                            @mouseenter="hoverRating = index + 1"
                            @mouseleave="hoverRating = 0"
                            class="focus:outline-none transform transition-all duration-200 hover:scale-110">
                        <svg class="w-8 h-8 transition-all duration-200"
                             :class="{
                                 'text-yellow-400 drop-shadow-sm': index < (hoverRating || userRating),
                                 'text-gray-300': index >= (hoverRating || userRating),
                                 'animate-bounce': index === (hoverRating - 1) && hoverRating > 0
                             }"
                             fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    </button>
                </template>
                <span class="ml-3 text-sm text-gray-600" x-show="hoverRating > 0" x-text="getRatingText(hoverRating)"></span>
                <span class="ml-3 text-sm text-gray-600" x-show="hoverRating === 0 && userRating > 0" x-text="getRatingText(userRating)"></span>
            </div>

            <!-- Review Text Area -->
            <div class="mb-4" x-show="userRating > 0">
                <label class="block text-sm font-medium text-gray-700 mb-2">Write a review (optional)</label>
                <textarea x-model="reviewText"
                          placeholder="Share your thoughts about this movie..."
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent resize-none"
                          rows="3"></textarea>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center space-x-3" x-show="userRating > 0">
                <button @click="submitRating()"
                        :disabled="isSubmitting"
                        class="bg-orange-500 hover:bg-orange-600 disabled:bg-gray-400 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 transform hover:scale-105 disabled:transform-none">
                    <span x-show="!isSubmitting">
                        <span x-show="originalRating === 0">Submit Rating</span>
                        <span x-show="originalRating > 0">Update Rating</span>
                    </span>
                    <span x-show="isSubmitting">Submitting...</span>
                </button>

                <button @click="cancelRating()"
                        x-show="originalRating !== userRating || reviewText !== originalReview"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg font-medium transition-all duration-200">
                    Cancel
                </button>

                <button @click="deleteRating()"
                        x-show="originalRating > 0"
                        class="text-red-500 hover:text-red-700 px-4 py-2 font-medium transition-all duration-200">
                    Remove Rating
                </button>
            </div>
        </div>
    @else
        <div class="guest-rating-prompt bg-gray-50 rounded-xl p-6 text-center mb-6">
            <i class="fas fa-star text-4xl text-gray-300 mb-3"></i>
            <p class="text-gray-600 mb-4">Sign in to rate and review this movie</p>
            <a href="{{ route('login') }}" class="bg-orange-500 hover:bg-orange-600 text-white px-6 py-2 rounded-lg font-medium transition-all duration-200 transform hover:scale-105">
                Sign In
            </a>
        </div>
    @endauth

    <!-- Recent Reviews -->
    @if($movie->ratings()->whereNotNull('review')->count() > 0)
        <div class="reviews-section">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Recent Reviews</h3>
            <div class="space-y-4">
                @foreach($movie->ratings()->whereNotNull('review')->with('user')->latest()->take(5)->get() as $rating)
                    <div class="review-card bg-white border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                        <div class="flex items-start justify-between mb-2">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-gradient-to-r from-orange-400 to-red-500 rounded-full flex items-center justify-center">
                                    <span class="text-white font-medium text-sm">{{ substr($rating->user->name, 0, 1) }}</span>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-900">{{ $rating->user->name }}</h4>
                                    <div class="flex items-center space-x-1">
                                        @for($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4 {{ $i <= $rating->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                                                 fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <span class="text-sm text-gray-500">{{ $rating->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-gray-700 leading-relaxed">{{ $rating->review }}</p>
                    </div>
                @endforeach
            </div>

            @if($movie->ratings()->whereNotNull('review')->count() > 5)
                <div class="text-center mt-4">
                    <button class="text-orange-500 hover:text-orange-600 font-medium">
                        View all {{ $movie->ratings()->whereNotNull('review')->count() }} reviews
                    </button>
                </div>
            @endif
        </div>
    @endif
</div>

<script>
function movieRating(movieId, currentUserRating, currentAverage) {
    return {
        movieId: movieId,
        userRating: currentUserRating,
        originalRating: currentUserRating,
        hoverRating: 0,
        averageRating: currentAverage,
        reviewText: '',
        originalReview: '',
        isSubmitting: false,

        init() {
            // Load existing review if user has rated
            if (this.userRating > 0) {
                this.loadUserReview();
            }
        },

        setRating(rating) {
            this.userRating = rating;
        },

        getRatingText(rating) {
            const texts = {
                1: 'Poor',
                2: 'Fair',
                3: 'Good',
                4: 'Very Good',
                5: 'Excellent'
            };
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
                        rating: this.userRating,
                        review: this.reviewText
                    })
                });

                const data = await response.json();

                if (data.success) {
                    this.originalRating = this.userRating;
                    this.originalReview = this.reviewText;
                    this.averageRating = data.average_rating;

                    // Show success toast
                    showToast('success', data.message || 'Rating submitted successfully!');

                    // Refresh the page after a short delay to show updated reviews
                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    showToast('error', data.message || 'Failed to submit rating');
                }
            } catch (error) {
                showToast('error', 'An error occurred while submitting your rating');
            } finally {
                this.isSubmitting = false;
            }
        },

        async deleteRating() {
            if (!confirm('Are you sure you want to remove your rating?')) {
                return;
            }

            try {
                const response = await fetch(`/movies/${this.movieId}/rate`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                const data = await response.json();

                if (data.success) {
                    this.userRating = 0;
                    this.originalRating = 0;
                    this.reviewText = '';
                    this.originalReview = '';
                    this.averageRating = data.average_rating;

                    showToast('success', 'Rating removed successfully!');

                    setTimeout(() => {
                        window.location.reload();
                    }, 1500);
                } else {
                    showToast('error', data.message || 'Failed to remove rating');
                }
            } catch (error) {
                showToast('error', 'An error occurred while removing your rating');
            }
        },

        cancelRating() {
            this.userRating = this.originalRating;
            this.reviewText = this.originalReview;
        },

        async loadUserReview() {
            try {
                const response = await fetch(`/movies/${this.movieId}/user-rating`);
                const data = await response.json();

                if (data.review) {
                    this.reviewText = data.review;
                    this.originalReview = data.review;
                }
            } catch (error) {
                console.error('Failed to load user review:', error);
            }
        }
    }
}
</script>

