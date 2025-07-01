<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect to social provider
     */
    public function redirectToProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'twitter'])) {
            return redirect()->route('login')->with('error', 'Invalid social provider');
        }

        try {
            if ($provider === 'facebook') {
                // Only request basic permissions that don't require app review
                return Socialite::driver($provider)
                    ->scopes(['public_profile']) // Only request public profile, not email
                    ->redirect();
            }

            return Socialite::driver($provider)->redirect();
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Social login redirect error: ' . $e->getMessage());

            return redirect()->route('login')->with('error', 'Unable to connect to ' . ucfirst($provider) . '. Please check the app configuration.');
        }
    }

    /**
     * Handle social provider callback
     */
    public function handleProviderCallback($provider)
    {
        try {
            if (!in_array($provider, ['facebook', 'twitter'])) {
                return redirect()->route('login')->with('error', 'Invalid social provider');
            }

            $socialUser = Socialite::driver($provider)->user();

            // Check if user already exists with this provider
            $existingUser = User::where('provider', $provider)
                              ->where('provider_id', $socialUser->getId())
                              ->first();

            if ($existingUser) {
                Auth::login($existingUser);
                return redirect()->intended('/dashboard');
            }

            // For Facebook without email permission, we need to handle missing email
            $email = $socialUser->getEmail();
            if (!$email) {
                // Generate a placeholder email if Facebook doesn't provide one
                $email = $socialUser->getId() . '@' . $provider . '.placeholder';
            }

            // Check if user exists with same email (only if we have a real email)
            if ($socialUser->getEmail()) {
                $existingEmailUser = User::where('email', $email)->first();

                if ($existingEmailUser) {
                    // Link social account to existing user
                    $existingEmailUser->update([
                        'provider' => $provider,
                        'provider_id' => $socialUser->getId(),
                        'avatar' => $socialUser->getAvatar(),
                    ]);

                    Auth::login($existingEmailUser);
                    return redirect()->intended('/dashboard');
                }
            }

            // Create new user
            $user = User::create([
                'name' => $socialUser->getName() ?: 'User', // Fallback name
                'email' => $email,
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'email_verified_at' => $socialUser->getEmail() ? now() : null, // Only verify if real email
                'password' => null, // Social users don't need passwords
            ]);

            Auth::login($user);
            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            \Log::error('Social callback error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Authentication failed. Please try again.');
        }
    }
}
