<?php

namespace App\Http\Controllers;

use App\Models\RoleRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleRequestController extends Controller
{
    /**
     * Show role request form
     */
    public function create()
    {
        $user = Auth::user();

        // If user already has a role and is active, redirect to dashboard
        if ($user->hasRole() && $user->isActive()) {
            return redirect()->route('dashboard');
        }

        // Check if user has a pending request
        $pendingRequest = RoleRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        return view('auth.role-request', compact('pendingRequest'));
    }

    /**
     * Store role request
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        // Validate request
        $request->validate([
            'role' => 'required|in:admin,supervisor,employee',
        ]);

        // Check if user already has a pending request
        $existingRequest = RoleRequest::where('user_id', $user->id)
            ->where('status', 'pending')
            ->first();

        if ($existingRequest) {
            return back()->withErrors(['error' => 'You already have a pending role request. Please wait for admin approval.']);
        }

        // Create role request
        RoleRequest::create([
            'user_id' => $user->id,
            'requested_role' => $request->role,
            'status' => 'pending',
        ]);

        return redirect()->route('role-request.create')
            ->with('success', 'Role request submitted successfully! Please wait for admin approval.');
    }
}
