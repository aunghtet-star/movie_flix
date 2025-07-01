<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MovieFlix - Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        movieRed: '#E50914',
                        movieDark: '#141414',
                        movieGray: '#222222'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-movieDark min-h-screen flex items-center justify-center p-4">
<div class="w-full max-w-md">
    <!-- Logo -->
    <div class="text-center mb-8">
        <h1 class="text-movieRed text-4xl font-bold tracking-wider">MOVIEFLIX</h1>
    </div>

    <!-- Login Form -->
    <div class="bg-movieGray p-8 rounded-lg shadow-lg">
        <h2 class="text-white text-2xl font-semibold mb-6">Sign In</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Field -->
            <div class="mb-6">
                <label for="email" class="block text-gray-300 text-sm font-medium mb-2">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-movieRed"
                    placeholder="Enter your email"
                    required
                >
            </div>

            <!-- Password Field -->
            <div class="mb-6">
                <label for="password" class="block text-gray-300 text-sm font-medium mb-2">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-md text-white focus:outline-none focus:ring-2 focus:ring-movieRed"
                    placeholder="Enter your password"
                    required
                >
            </div>

            <!-- Submit Button -->
            <button
                type="submit"
                class="w-full bg-movieRed hover:bg-red-700 text-white font-medium py-3 px-4 rounded-md transition duration-300"
            >
                Sign In
            </button>
        </form>

        <!-- Additional Links -->
        <div class="mt-6 text-center text-sm">
            <a href="#" class="text-gray-400 hover:text-white">Forgot password?</a>
            <p class="mt-4 text-gray-400">
                New to MovieFlix? <a href="#" class="text-white hover:underline">Sign up now</a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
