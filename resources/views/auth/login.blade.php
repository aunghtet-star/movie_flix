<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - MovieFlix</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
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
            position: fixed;
            width: 100%;
            height: 100vh;
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
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0;
            }
        }
    </style>
</head>
<body class="min-h-screen text-white relative">

<!-- Dynamic Background -->
<div class="fixed inset-0 cinematic-bg"></div>

<!-- Floating Particles -->
<div class="particles">
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

<!-- Main Content -->
<div class="relative min-h-screen flex items-center justify-center p-4 py-8">
    <div class="w-full max-w-md">
        <!-- Logo Section -->
        <div class="text-center mb-8">
            <a href="{{ route('welcome') }}" class="inline-flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 6a2 2 0 012-2h6l2 2h6a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6zM14.553 7.106A1 1 0 0014 8v4a1 1 0 00.553.894l2 1A1 1 0 0018 13V7a1 1 0 00-1.447-.894l-2 1z"></path>
                    </svg>
                </div>
                <span class="text-3xl font-bold text-white">MovieFlix</span>
            </a>
            <p class="mt-4 text-gray-400 text-lg">Welcome back to your cinema</p>
        </div>

        <!-- Login Form -->
        <div class="bg-gray-900/80 backdrop-blur-md border border-gray-700 rounded-2xl shadow-2xl p-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-white text-center mb-2">Sign In</h2>
                <p class="text-gray-400 text-center">Continue your movie journey</p>
            </div>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-4 p-4 bg-green-500/10 border border-green-500/30 rounded-lg">
                    <p class="text-sm text-green-400">{{ session('status') }}</p>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                        Email Address
                    </label>
                    <input id="email"
                           name="email"
                           type="email"
                           value="{{ old('email') }}"
                           required
                           autofocus
                           autocomplete="username"
                           class="w-full px-4 py-3 bg-gray-800/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200"
                           placeholder="Enter your email address">
                    @if($errors->get('email'))
                        <p class="mt-1 text-sm text-red-400">{{ implode(', ', $errors->get('email')) }}</p>
                    @endif
                </div>

                <!-- Password -->
                <div x-data="{ showPassword: false }">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">
                        Password
                    </label>
                    <div class="relative">
                        <input :type="showPassword ? 'text' : 'password'"
                               id="password"
                               name="password"
                               required
                               autocomplete="current-password"
                               class="w-full px-4 py-3 pr-12 bg-gray-800/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200"
                               placeholder="Enter your password">
                        <button type="button"
                                @click="showPassword = !showPassword"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-orange-400 transition duration-200">
                            <svg x-show="!showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <svg x-show="showPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                            </svg>
                        </button>
                    </div>
                    @if($errors->get('password'))
                        <p class="mt-1 text-sm text-red-400">{{ implode(', ', $errors->get('password')) }}</p>
                    @endif
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center">
                        <input id="remember_me"
                               name="remember"
                               type="checkbox"
                               class="h-4 w-4 text-orange-500 bg-gray-800 border-gray-600 rounded focus:ring-orange-500 focus:ring-2">
                        <span class="ml-2 block text-sm text-gray-300">Remember me</span>
                    </label>

                </div>

                <!-- Login Button -->
                <button type="submit"
                        class="w-full py-3 px-4 bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-semibold rounded-lg shadow-lg transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                    </svg>
                    Sign In
                </button>
            </form>

{{--            <!-- Social Login (Optional) -->--}}
{{--            <div class="mt-6">--}}
{{--                <div class="relative">--}}
{{--                    <div class="absolute inset-0 flex items-center">--}}
{{--                        <div class="w-full border-t border-gray-600"></div>--}}
{{--                    </div>--}}
{{--                    <div class="relative flex justify-center text-sm">--}}
{{--                        <span class="px-2 bg-gray-900/80 text-gray-400">Or continue with</span>--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--                <div class="mt-6 grid grid-cols-2 gap-3">--}}
{{--                    <a href="{{ route('social.redirect', 'facebook') }}" class="w-full inline-flex justify-center py-2 px-4 border border-gray-600 rounded-lg shadow-sm bg-gray-800/50 text-sm font-medium text-gray-300 hover:bg-blue-600/20 hover:border-blue-500 hover:text-blue-400 transition duration-200">--}}
{{--                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">--}}
{{--                            <path fill-rule="evenodd" d="M20 10c0-5.523-4.477-10-10-10S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z" clip-rule="evenodd"></path>--}}
{{--                        </svg>--}}
{{--                        <span class="ml-2">Facebook</span>--}}
{{--                    </a>--}}

{{--                    <a href="{{ route('social.redirect', 'twitter') }}" class="w-full inline-flex justify-center py-2 px-4 border border-gray-600 rounded-lg shadow-sm bg-gray-800/50 text-sm font-medium text-gray-300 hover:bg-blue-400/20 hover:border-blue-400 hover:text-blue-300 transition duration-200">--}}
{{--                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">--}}
{{--                            <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"></path>--}}
{{--                        </svg>--}}
{{--                        <span class="ml-2">Twitter</span>--}}
{{--                    </a>--}}
{{--                </div>--}}
{{--            </div>--}}

            <!-- Register Link -->
            <div class="mt-6 text-center">
                <p class="text-gray-400">
                    Don't have an account?
                    <a href="{{ route('register') }}"
                       class="text-orange-400 hover:text-orange-300 font-medium transition duration-200">
                        Create one here
                    </a>
                </p>
            </div>
        </div>

        <!-- Back to Home -->
        <div class="mt-6 text-center">
            <a href="{{ route('welcome') }}"
               class="inline-flex items-center text-gray-400 hover:text-orange-400 transition duration-200">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to MovieFlix
            </a>
        </div>
    </div>
</div>

</body>
</html>
