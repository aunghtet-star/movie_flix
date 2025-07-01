<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialTestController extends Controller
{
    public function testFacebookConfig()
    {
        try {
            // Test if Facebook configuration is working
            $config = config('services.facebook');

            $status = [
                'facebook_client_id' => $config['client_id'] ? 'Set' : 'Missing',
                'facebook_client_secret' => $config['client_secret'] ? 'Set' : 'Missing',
                'facebook_redirect' => $config['redirect'],
                'socialite_installed' => class_exists('Laravel\Socialite\Facades\Socialite') ? 'Yes' : 'No'
            ];

            return view('test-social', compact('status'));

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'message' => 'Facebook configuration test failed'
            ]);
        }
    }
}
