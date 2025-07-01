<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - MovieFlix</title>
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
            <p class="mt-4 text-gray-400 text-lg">Join the ultimate movie experience</p>
        </div>

        <!-- Register Form -->
        <div class="bg-gray-900/80 backdrop-blur-md border border-gray-700 rounded-2xl shadow-2xl p-8">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-white text-center mb-2">Create Account</h2>
                <p class="text-gray-400 text-center">Start your cinematic journey today</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                        Full Name
                    </label>
                    <input id="name"
                           name="name"
                           type="text"
                           value="{{ old('name') }}"
                           required
                           autofocus
                           autocomplete="name"
                           class="w-full px-4 py-3 bg-gray-800/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200"
                           placeholder="Enter your full name">
                    @if($errors->get('name'))
                        <p class="mt-1 text-sm text-red-400">{{ implode(', ', $errors->get('name')) }}</p>
                    @endif
                </div>

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
                               autocomplete="new-password"
                               class="w-full px-4 py-3 pr-12 bg-gray-800/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200"
                               placeholder="Create a secure password">
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

                <!-- Confirm Password -->
                <div x-data="{ showConfirmPassword: false }">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-2">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <input :type="showConfirmPassword ? 'text' : 'password'"
                               id="password_confirmation"
                               name="password_confirmation"
                               required
                               autocomplete="new-password"
                               class="w-full px-4 py-3 pr-12 bg-gray-800/50 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition duration-200"
                               placeholder="Confirm your password">
                        <button type="button"
                                @click="showConfirmPassword = !showConfirmPassword"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-orange-400 transition duration-200">
                            <svg x-show="!showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                            <svg x-show="showConfirmPassword" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                            </svg>
                        </button>
                    </div>
                    @if($errors->get('password_confirmation'))
                        <p class="mt-1 text-sm text-red-400">{{ implode(', ', $errors->get('password_confirmation')) }}</p>
                    @endif
                </div>

                <!-- Terms and Privacy -->
                <div class="flex items-center">
                    <input id="terms"
                           name="terms"
                           type="checkbox"
                           required
                           class="h-4 w-4 text-orange-500 bg-gray-800 border-gray-600 rounded focus:ring-orange-500 focus:ring-2">
                    <label for="terms" class="ml-2 block text-sm text-gray-300">
                        I agree to the
                        <a href="#" class="text-orange-400 hover:text-orange-300 font-medium">Terms of Service</a>
                        and
                        <a href="#" class="text-orange-400 hover:text-orange-300 font-medium">Privacy Policy</a>
                    </label>
                </div>

                <!-- Register Button -->
                <button type="submit"
                        class="w-full py-3 px-4 bg-gradient-to-r from-orange-500 to-red-600 hover:from-orange-600 hover:to-red-700 text-white font-semibold rounded-lg shadow-lg transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                    <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                    </svg>
                    Create Account
                </button>
            </form>

            <!-- Login Link -->
            <div class="mt-6 text-center">
                <p class="text-gray-400">
                    Already have an account?
                    <a href="{{ route('login') }}"
                       class="text-orange-400 hover:text-orange-300 font-medium transition duration-200">
                        Sign in here
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
