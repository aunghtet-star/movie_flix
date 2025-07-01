@extends('frontend.layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <!-- Profile Header -->
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-2xl p-8 mb-8 border border-gray-700">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold text-white flex items-center">
                    <i class="fas fa-user-cog mr-3 text-orange-400"></i>
                    Profile Settings
                </h1>
                <a href="{{ route('welcome') }}" class="text-gray-400 hover:text-orange-400 transition duration-200">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Home
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Profile Photo -->
                <div class="text-center">
                    <div class="relative inline-block">
                        <img src="{{ Auth::user()->profile_photo_url }}"
                             alt="Profile Photo"
                             class="w-32 h-32 rounded-full border-4 border-orange-500 object-cover mx-auto">
                        <div class="absolute bottom-0 right-0 bg-orange-500 rounded-full p-2 cursor-pointer hover:bg-orange-600 transition duration-200">
                            <i class="fas fa-camera text-white text-sm"></i>
                        </div>
                    </div>
                    <h2 class="text-xl font-semibold text-white mt-4">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-400">{{ Auth::user()->email }}</p>
                </div>

                <!-- Profile Stats -->
                <div class="md:col-span-2">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="bg-gray-800 rounded-lg p-4 text-center border border-gray-600">
                            <div class="text-2xl font-bold text-orange-400">{{ Auth::user()->movieRatings()->count() }}</div>
                            <div class="text-sm text-gray-400">Movies Rated</div>
                        </div>
                        <div class="bg-gray-800 rounded-lg p-4 text-center border border-gray-600">
                            <div class="text-2xl font-bold text-green-400">{{ Auth::user()->movieRatings()->avg('rating') ? number_format(Auth::user()->movieRatings()->avg('rating'), 1) : '0.0' }}</div>
                            <div class="text-sm text-gray-400">Avg Rating</div>
                        </div>
                        <div class="bg-gray-800 rounded-lg p-4 text-center border border-gray-600">
                            <div class="text-2xl font-bold text-blue-400">{{ Auth::user()->movieRatings()->whereNotNull('review')->count() }}</div>
                            <div class="text-sm text-gray-400">Reviews</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Profile Information Form -->
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-2xl border border-gray-700 mb-8">
            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- Profile Photo Form -->
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-2xl border border-gray-700 mb-8">
            @include('profile.partials.update-photo-form')
        </div>

        <!-- Password Change Form -->
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl shadow-2xl border border-gray-700">
            @include('profile.partials.update-password-form')
        </div>
    </div>
</div>
@endsection
