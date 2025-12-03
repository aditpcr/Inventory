<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    /**
     * Redirect to Google OAuth
     */
    public function redirectToGoogle()
    {
        try {
            return Socialite::driver('google')
                ->scopes(['openid', 'profile', 'email'])
                ->redirect();
        } catch (\Exception $e) {
            Log::error('Google OAuth Redirect Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('login')
                ->withErrors(['error' => 'Unable to initiate Google login. Please try again.']);
        }
    }

    /**
     * Handle Google OAuth callback
     */
    public function handleGoogleCallback(Request $request)
    {
        try {
            // Check for OAuth errors in the request
            if ($request->has('error')) {
                $error = $request->get('error');
                $errorDescription = $request->get('error_description', 'Unknown error');
                
                Log::error('Google OAuth Error', [
                    'error' => $error,
                    'error_description' => $errorDescription,
                    'request' => $request->all()
                ]);

                $errorMessage = 'Google authentication failed. ';
                
                if ($error === 'access_denied') {
                    $errorMessage .= 'You cancelled the login request.';
                } elseif ($error === 'redirect_uri_mismatch') {
                    $errorMessage .= 'Redirect URI mismatch. Please contact the administrator.';
                } else {
                    $errorMessage .= $errorDescription;
                }

                return redirect()->route('login')
                    ->withErrors(['error' => $errorMessage]);
            }

            // Get user from Google with proper SSL handling
            // The Guzzle client is configured in AppServiceProvider to handle SSL issues
            $googleUser = Socialite::driver('google')
                ->setHttpClient(new \GuzzleHttp\Client([
                    'verify' => app()->environment(['local', 'development', 'testing']) ? false : true,
                    'timeout' => 30,
                    'connect_timeout' => 10,
                ]))
                ->user();

            if (!$googleUser || !$googleUser->email) {
                throw new \Exception('Failed to retrieve user information from Google.');
            }

            // Check if user exists by email
            $user = User::where('email', $googleUser->email)->first();

            if ($user) {
                // Update google_id if not set
                if (!$user->google_id) {
                    $user->update(['google_id' => $googleUser->id]);
                }

                // Log in existing user
                Auth::login($user);

                // Redirect based on role and status
                return $this->redirectBasedOnRole($user);
            } else {
                // Create new user with proper validation
                try {
                    $user = User::create([
                        'name' => $googleUser->name ?? 'User',
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'password' => Hash::make(uniqid('google_', true)), // Random password since Google auth doesn't provide one
                        'role' => null, // Nullable role for new Google users
                        'role_status' => 'pending', // Pending until role is approved
                    ]);

                    // Log in new user
                    Auth::login($user);

                    // Redirect to role request page
                    return redirect()->route('role-request.create')
                        ->with('success', 'Welcome! Please select a role to continue.');
                } catch (\Illuminate\Database\QueryException $e) {
                    // Handle database errors (e.g., role column not nullable)
                    Log::error('Google OAuth User Creation Error', [
                        'error' => $e->getMessage(),
                        'code' => $e->getCode(),
                        'email' => $googleUser->email ?? 'unknown'
                    ]);

                    // Check if it's a role column issue
                    if (str_contains($e->getMessage(), 'role') || str_contains($e->getMessage(), 'NULL')) {
                        return redirect()->route('login')
                            ->withErrors(['error' => 'Database configuration error. Please contact the administrator.']);
                    }

                    throw $e; // Re-throw if it's a different error
                }
            }
        } catch (\Illuminate\Contracts\Container\BindingResolutionException $e) {
            Log::error('Google OAuth Configuration Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('login')
                ->withErrors(['error' => 'Google OAuth is not properly configured. Please check your Google OAuth credentials in the configuration file.']);
        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            Log::error('Google OAuth Invalid State', [
                'error' => $e->getMessage()
            ]);

            return redirect()->route('login')
                ->withErrors(['error' => 'Session expired. Please try logging in again.']);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            Log::error('Google OAuth HTTP Error', [
                'error' => $e->getMessage(),
                'response' => $e->getResponse() ? $e->getResponse()->getBody()->getContents() : null
            ]);

            return redirect()->route('login')
                ->withErrors(['error' => 'Unable to connect to Google. Please check your internet connection and try again.']);
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            // Handle SSL/certificate errors specifically
            $errorMessage = $e->getMessage();
            
            Log::error('Google OAuth Request Error', [
                'error' => $errorMessage,
                'code' => $e->getCode(),
                'trace' => $e->getTraceAsString()
            ]);

            if (str_contains($errorMessage, 'certificate') || str_contains($errorMessage, 'SSL') || str_contains($errorMessage, 'cURL error 77')) {
                // SSL certificate issue - common on Windows/Laragon
                return redirect()->route('login')
                    ->withErrors(['error' => 'SSL certificate error. Please contact the administrator to configure SSL certificates properly.']);
            }

            return redirect()->route('login')
                ->withErrors(['error' => 'Unable to connect to Google. Please check your internet connection and try again.']);
        } catch (\Exception $e) {
            // Log the full error for debugging
            Log::error('Google OAuth General Error', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Show user-friendly error message
            $errorMessage = 'Unable to login with Google. ';
            
            // Check if it's a configuration issue
            if (str_contains($e->getMessage(), 'redirect_uri_mismatch')) {
                $errorMessage .= 'Redirect URI mismatch. Please contact the administrator.';
            } elseif (str_contains($e->getMessage(), 'invalid_client')) {
                $errorMessage .= 'Invalid OAuth credentials. Please contact the administrator.';
            } else {
                $errorMessage .= 'Please try again or contact support if the problem persists.';
            }

            return redirect()->route('login')
                ->withErrors(['error' => $errorMessage]);
        }
    }

    /**
     * Redirect user based on their role and status
     */
    private function redirectBasedOnRole(User $user)
    {
        // If user is pending, redirect to role request page
        if ($user->isPending() || !$user->hasRole()) {
            return redirect()->route('role-request.create')
                ->with('info', 'Please select a role to continue.');
        }

        // Redirect based on role
        switch ($user->role) {
            case 'admin':
                return redirect()->intended('/admin/users');
            case 'supervisor':
                return redirect()->intended('/supervisor/dashboard');
            case 'employee':
                return redirect()->intended('/employee/pos');
            default:
                return redirect()->intended('/dashboard');
        }
    }
}
