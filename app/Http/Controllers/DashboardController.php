<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
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