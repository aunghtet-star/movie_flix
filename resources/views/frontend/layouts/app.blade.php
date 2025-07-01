<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plex - Free Movies to Watch</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
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

<!-- Subtle Vignette -->
<div class="fixed inset-0 pointer-events-none bg-gradient-to-r from-black/20 via-transparent to-black/20"></div>
<div class="fixed inset-0 pointer-events-none bg-gradient-to-b from-black/30 via-transparent to-black/40"></div>

<!-- Header -->
<header class="relative z-10 flex flex-col sm:flex-row items-center justify-between p-2 sm:p-3 md:p-4 bg-black/20 backdrop-blur-lg gap-3 sm:gap-4">
    <!-- Logo Section -->
    <a href="{{ url('/') }}" class="flex items-center w-full sm:w-auto justify-center sm:justify-start">
        <h1 class="text-3xl font-extrabold text-white leading-tight">
            Movie<span class="text-orange-500">Flix</span>
        </h1>
    </a>

    <!-- Auth Section -->
    <div class="w-full sm:w-auto flex justify-center sm:justify-end">
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/profile') }}"
                       class="font-semibold flex gap-2 text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M5.121 17.804A9 9 0 1112 21a9 9 0 01-6.879-3.196z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg> Profile</a>
                @else
                    <a href="{{ route('login') }}"
                       class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log
                        in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
</header>


{{--  Content  --}}
<div class="content">
    @yield('content')
</div>

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
    </script>
</body>
</html>
