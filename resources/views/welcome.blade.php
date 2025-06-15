@extends('frontend.layouts.app')
@section('content')
    <!-- Hero Section -->
    <main class="relative z-10 flex flex-col items-start justify-center min-h-[calc(100vh-80px)] px-8 md:px-16 lg:px-24">
        <div class="max-w-2xl">
            <h1 class="text-xl md:text-6xl lg:text-7xl font-bold leading-tight mb-6">
                Free Movies to Watch, <br />
                Anytime Anywhere.
            </h1>

            <p class="text-lg md:text-xl text-gray-300 mb-8 leading-relaxed">
                The search is over! Let Plex help you find the perfect movie to watch tonight for free.
            </p>

            <a href="{{ url('movie_page') }}" class="bg-orange-500 hover:bg-orange-600 text-white font-semibold px-8 py-3 text-lg rounded-full transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 focus:ring-offset-black">
                Watch Free
            </a>
        </div>
    </main>
@endsection
