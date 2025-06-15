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
    </style>
</head>
<body class="min-h-screen bg-black text-white relative">
<!-- Background Image -->
<div class="absolute inset-0 ">
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('/image/movie.png'); opacity: 0.5;"></div>
</div>

<!-- Header -->
<header class="relative z-10 flex items-center justify-between p-1 md:p-4  bg-black/20 backdrop-blur-lg">
    <div class="flex items-center space-x-8">
        <div class="text-2xl font-bold">
            <span class="text-white">plex</span>
        </div>
    </div>

    <div class="flex-1 max-w-md mx-8">
        <div class="relative">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-6-6m2-5a7 7 0 1 1-14 0 7 7 0 0 1 14 0z"></path>
            </svg>
            <input
                type="text"
                placeholder="Find Movies & TV"
                class="w-full pl-10 pr-4 py-2 bg-gray-800/50 border border-gray-600 rounded-md text-white placeholder-gray-400 focus:outline-none focus:border-orange-500 focus:ring-1 focus:ring-orange-500"
            />
        </div>
    </div>

    <div>
        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif
                @endauth
            </div>
        @endif


    </div>

    <div class="w-24"></div>
</header>


{{--  Content  --}}
<div class="content">
    @yield('content')
</div>



</body>
</html>
