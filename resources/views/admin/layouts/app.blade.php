<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - MovieFlix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100">
    <!-- Admin Header -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center space-x-4">
                    <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-film text-white"></i>
                    </div>
                    <span class="text-xl font-bold text-gray-800">MovieFlix Admin</span>
                </div>

                <!-- Admin Menu -->
                <div class="flex items-center space-x-4">
                    <!-- Navigation Links -->
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-tachometer-alt mr-1"></i>Dashboard
                        </a>
                        <a href="{{ route('users.index') }}" class="text-gray-600 hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-users mr-1"></i>Users
                        </a>
                        <a href="{{ route('admin_movies.index') }}" class="text-gray-600 hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-video mr-1"></i>Movies
                        </a>
                        <a href="{{ route('genres.index') }}" class="text-gray-600 hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-tags mr-1"></i>Genres
                        </a>
                        <a href="{{ route('admins.index') }}" class="text-gray-600 hover:text-orange-500 px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-user-shield mr-1"></i>Admins
                        </a>
                    </div>

                    <!-- Admin Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-600 hover:text-orange-500">
                            <div class="w-8 h-8 bg-gray-300 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-gray-600"></i>
                            </div>
                            <span class="hidden md:block text-sm font-medium">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg border border-gray-200 z-50">
                            <div class="py-1">
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-user mr-3"></i>Profile
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class="fas fa-cog mr-3"></i>Settings
                                </a>
                                <div class="border-t border-gray-100"></div>
                                <button type="button" onclick="confirmAdminLogout()" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                    <i class="fas fa-sign-out-alt mr-3"></i>Logout
                                </button>
                                <!-- Hidden logout form -->
                                <form id="admin-logout-form" method="POST" action="{{ route('admin.logout') }}" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="min-h-screen">
        @yield('content')
    </main>

    <!-- Include Toast Notifications -->
    @include('admin.components.toast')

    <!-- Include Confirmation Modal -->
    @include('components.confirmation-modal')

    <script>
        function confirmAdminLogout() {
            showConfirmation(
                'Confirm Logout',
                'Are you sure you want to logout from the admin panel?',
                function() {
                    document.getElementById('admin-logout-form').submit();
                },
                'Logout',
                'bg-orange-600 hover:bg-orange-700'
            );
        }
    </script>
</body>
</html>
