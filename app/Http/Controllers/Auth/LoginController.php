<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // If user is pending or has no role, redirect to role request page
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

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}