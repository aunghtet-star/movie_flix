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
    <style>
        /* Dynamic gradient background similar to user side */
        .cinematic-bg {
            background: linear-gradient(135deg,
                    #0c0c0c 0%,
                    #1a1a1a 25%,
                    #0d1117 50%,
                    #161b22 75%,
                    #0c0c0c 100%);
            background-size: 400% 400%;
            animation: gradientShift 15s ease infinite;
        }

        @keyframes gradientShift {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        /* Floating particles effect */
        .particles {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 2px;
            height: 2px;
            background: rgba(255, 165, 0, 0.3);
            border-radius: 50%;
            animation: float 20s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }

        /* Admin specific glass effect */
        .glass-effect {
            backdrop-filter: blur(15px);
            background: rgba(0, 0, 0, 0.7);
            border: 1px solid rgba(255, 165, 0, 0.2);
        }

        /* Improved text shadows for better readability */
        .text-shadow {
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.8);
        }

        /* Navigation hover effects */
        .nav-link {
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 165, 0, 0.2), transparent);
            transition: left 0.5s;
        }

        .nav-link:hover::before {
            left: 100%;
        }
    </style>
</head>

<body class="min-h-screen text-white relative overflow-x-hidden">

    <!-- Dynamic Background similar to user side -->
    <div class="fixed inset-0 cinematic-bg"></div>

    <!-- Floating Particles -->
    <div class="particles fixed inset-0">
        <div class="particle" style="left: 10%; animation-delay: -2s;"></div>
        <div class="particle" style="left: 20%; animation-delay: -4s;"></div>
        <div class="particle" style="left: 30%; animation-delay: -6s;"></div>
        <div class="particle" style="left: 40%; animation-delay: -8s;"></div>
        <div class="particle" style="left: 50%; animation-delay: -10s;"></div>
        <div class="particle" style="left: 60%; animation-delay: -12s;"></div>
        <div class="particle" style="left: 70%; animation-delay: -14s;"></div>
        <div class="particle" style="left: 80%; animation-delay: -16s;"></div>
        <div class="particle" style="left: 90%; animation-delay: -18s;"></div>
    </div>

    <!-- Admin Header -->
    <nav class="relative z-30 glass-effect shadow-xl border-b border-orange-500/20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
                <div class="flex items-center space-x-4">
                    <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-film text-white"></i>
                    </div>
                    <span class="text-xl font-bold text-white text-shadow">MovieFlix Admin</span>
                </div>

                <!-- Admin Menu -->
                <div class="flex items-center space-x-4">
                    <!-- Navigation Links -->
                    <div class="hidden md:flex space-x-4">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link text-gray-200 hover:text-orange-300 px-3 py-2 rounded-md text-sm font-medium transition duration-200 text-shadow">
                            <i class="fas fa-tachometer-alt mr-1"></i>Dashboard
                        </a>
                        <a href="{{ route('users.index') }}" class="nav-link text-gray-200 hover:text-orange-300 px-3 py-2 rounded-md text-sm font-medium transition duration-200 text-shadow">
                            <i class="fas fa-users mr-1"></i>Users
                        </a>
                        <a href="{{ route('admin_movies.index') }}" class="nav-link text-gray-200 hover:text-orange-300 px-3 py-2 rounded-md text-sm font-medium transition duration-200 text-shadow">
                            <i class="fas fa-video mr-1"></i>Movies
                        </a>
                        <a href="{{ route('genres.index') }}" class="nav-link text-gray-200 hover:text-orange-300 px-3 py-2 rounded-md text-sm font-medium transition duration-200 text-shadow">
                            <i class="fas fa-tags mr-1"></i>Genres
                        </a>
                        <a href="{{ route('admins.index') }}" class="nav-link text-gray-200 hover:text-orange-300 px-3 py-2 rounded-md text-sm font-medium transition duration-200 text-shadow">
                            <i class="fas fa-user-shield mr-1"></i>Admins
                        </a>
                    </div>

                    <!-- Admin Profile Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-200 hover:text-orange-300 transition duration-200 text-shadow">
                            <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-600 rounded-full flex items-center justify-center shadow-lg">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <span class="hidden md:block text-sm font-medium">{{ Auth::guard('admin')->user()->name ?? 'Admin' }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" x-transition class="absolute right-0 mt-2 w-48 glass-effect rounded-md shadow-xl border border-orange-500/20 z-50">
                            <div class="py-1">
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-200 hover:bg-orange-600/30 transition duration-200">
                                    <i class="fas fa-user mr-3"></i>Profile
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-200 hover:bg-orange-600/30 transition duration-200">
                                    <i class="fas fa-cog mr-3"></i>Settings
                                </a>
                                <div class="border-t border-orange-500/20"></div>
                                <button type="button" onclick="confirmAdminLogout()" class="flex items-center w-full px-4 py-2 text-sm text-red-300 hover:bg-red-600/30 transition duration-200">
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
    <main class="relative z-20 min-h-screen">
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