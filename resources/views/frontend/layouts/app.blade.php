<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Flix - Free Movies to Watch</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .movie-poster {
            transform: perspective(1000px) rotateY(var(--rotate-y)) rotateX(var(--rotate-x));
        }

        /* Dynamic gradient background */
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

        /* Movie strip effect */
        .film-strip::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                radial-gradient(circle at 20% 50%, rgba(255, 165, 0, 0.1) 2px, transparent 2px),
                radial-gradient(circle at 80% 50%, rgba(255, 165, 0, 0.1) 2px, transparent 2px);
            background-size: 100px 50px;
            background-repeat: repeat-y;
            opacity: 0.3;
        }
    </style>
</head>

<body class="min-h-screen text-white relative overflow-x-hidden">

    <!-- New Dynamic Background -->
    <div class="fixed inset-0 cinematic-bg"></div>

    <!-- Floating Particles -->
    <div class="particles fixed inset-0 pointer-events-none">
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

    <!-- Film Strip Overlay -->
    <div class="film-strip fixed inset-0 pointer-events-none"></div>

    <!-- Navigation Header -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-black/80 backdrop-blur-md border-b border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('welcome') }}" class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 6a2 2 0 012-2h6l2 2h6a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold text-white">MovieFlix</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="{{ route('welcome') }}" class="text-gray-300 hover:text-orange-400 px-3 py-2 rounded-md text-sm font-medium transition duration-200">
                            Home
                        </a>
                        <a href="{{ url('movie_page') }}" class="text-gray-300 hover:text-orange-400 px-3 py-2 rounded-md text-sm font-medium transition duration-200">
                            Movies
                        </a>
                        <a href="#genre" class="text-gray-300 hover:text-orange-400 px-3 py-2 rounded-md text-sm font-medium transition duration-200">
                            Genres
                        </a>
                    </div>
                </div>

                <!-- User Menu -->
                <div class="flex items-center space-x-4">
                    @auth


                    <!-- User Dropdown -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-300 hover:text-orange-400 transition duration-200">
                            <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-600 rounded-full flex items-center justify-center">
                                <span class="text-sm font-medium text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <span class="hidden md:block text-sm font-medium">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 mt-2 w-48 bg-gray-900/95 backdrop-blur-md border border-gray-700 rounded-lg shadow-lg">
                            <div class="py-1">
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-300 hover:text-orange-400 hover:bg-gray-800/50 transition duration-200">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    Profile
                                </a>
                                <a href="{{ route('watchlist.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-300 hover:text-orange-400 hover:bg-gray-800/50 transition duration-200">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                                    </svg>
                                    My Watchlist
                                </a>

                                <div class="border-t border-gray-700 my-1"></div>
                                <button type="button" onclick="confirmLogout()" class="flex items-center w-full px-4 py-2 text-sm text-red-400 hover:text-red-300 hover:bg-gray-800/50 transition duration-200">
                                    <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Logout
                                </button>
                                <!-- Hidden logout form -->
                                <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                    <!-- Guest Links -->
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="text-gray-300 hover:text-orange-400 px-3 py-2 rounded-md text-sm font-medium transition duration-200">
                            Login
                        </a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition duration-200 transform hover:scale-105">
                            Sign Up
                        </a>
                    </div>
                    @endauth

                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button x-data="{ mobileOpen: false }" @click="mobileOpen = !mobileOpen" class="text-gray-300 hover:text-orange-400 transition duration-200">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content with padding for fixed nav -->
    <div class="relative pt-16">
        @yield('content')
    </div>

    <!-- Include Confirmation Modal -->
    @include('components.confirmation-modal')

    <!-- Include Toast Notifications -->
    @include('admin.components.toast')

    <!-- Add CSRF token for AJAX requests -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchToggle = document.getElementById('searchToggle');
            const searchContainer = document.getElementById('searchContainer');
            const searchForm = searchContainer.querySelector('.search-form');
            const searchInput = document.getElementById('searchInput');
            const searchClose = document.getElementById('searchClose');

            searchToggle.addEventListener('click', function() {
                searchForm.classList.remove('hidden');
                searchToggle.style.display = 'none';

                // Animate the input width
                setTimeout(() => {
                    searchInput.style.width = '300px';
                    searchInput.style.paddingLeft = '1rem';
                    searchInput.style.paddingRight = '0.5rem';
                    searchInput.focus();
                }, 50);
            });

            searchClose.addEventListener('click', function() {
                searchInput.style.width = '0';
                searchInput.style.paddingLeft = '0';
                searchInput.style.paddingRight = '0';

                setTimeout(() => {
                    searchForm.classList.add('hidden');
                    searchToggle.style.display = 'flex';
                }, 300);
            });

            // Close on click outside
            document.addEventListener('click', function(e) {
                if (!searchContainer.contains(e.target)) {
                    searchClose.click();
                }
            });
        });

        function confirmLogout() {
            if (confirm('Are you sure you want to logout?')) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>
</body>

</html>