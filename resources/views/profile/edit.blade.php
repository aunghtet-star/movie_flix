@extends('frontend.layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-black py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header Section -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Profile Settings</h1>
            <p class="text-gray-400 text-lg">Manage your account information and preferences</p>
        </div>

        <!-- Profile Information Card -->
        <div class="bg-gray-800/50 backdrop-blur-lg border border-gray-700 rounded-2xl shadow-2xl mb-8 overflow-hidden">
            <div class="bg-gradient-to-r from-orange-500/10 to-orange-600/10 border-b border-gray-700 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-orange-500 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-white">Profile Information</h2>
                        <p class="text-gray-400 text-sm">Update your account's profile information and email address</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Password Update Card -->
        <div class="bg-gray-800/50 backdrop-blur-lg border border-gray-700 rounded-2xl shadow-2xl mb-8 overflow-hidden">
            <div class="bg-gradient-to-r from-blue-500/10 to-blue-600/10 border-b border-gray-700 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-white">Update Password</h2>
                        <p class="text-gray-400 text-sm">Ensure your account is using a long, random password to stay secure</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete Account Card -->
        <div class="bg-gray-800/50 backdrop-blur-lg border border-gray-700 rounded-2xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-red-500/10 to-red-600/10 border-b border-gray-700 p-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-red-500 rounded-lg flex items-center justify-center mr-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5C2.962 18.333 3.924 20 5.464 20z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-white">Delete Account</h2>
                        <p class="text-gray-400 text-sm">Permanently delete your account and all associated data</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

        <!-- Back to Movies Button -->
        <div class="text-center mt-8">
            <a href="{{ route('moviePage') }}"
               class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl transform hover:scale-105">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Movies
            </a>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    /* Custom styling for form elements */
    .profile-form input[type="text"],
    .profile-form input[type="email"],
    .profile-form input[type="password"] {
        @apply bg-gray-700 border-gray-600 text-white placeholder-gray-400 focus:border-orange-500 focus:ring-orange-500;
    }

    .profile-form label {
        @apply text-gray-300 font-medium;
    }

    .profile-form button[type="submit"] {
        @apply bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-semibold px-6 py-2 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl;
    }

    .profile-form .btn-danger {
        @apply bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 text-white font-semibold px-6 py-2 rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl;
    }

    /* Success/Error Messages */
    .alert-success {
        @apply bg-green-500/10 border border-green-500 text-green-400 px-4 py-3 rounded-lg mb-4;
    }

    .alert-error {
        @apply bg-red-500/10 border border-red-500 text-red-400 px-4 py-3 rounded-lg mb-4;
    }
</style>
@endsection
