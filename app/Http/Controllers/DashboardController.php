<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // If user is pending or has no role, redirect to role request page
        if ($user->isPending() || !$user->hasRole()) {
            return redirect()->route('role-request.create')
                ->with('info', 'Please select a role to continue.');
        }
        
        switch ($user->role) {
            case 'admin':
                return redirect('/admin/users');
            case 'supervisor':
                return redirect('/supervisor/dashboard');
            case 'employee':
                return redirect('/employee/pos');
            default:
                return view('dashboard');
        }
    }
}