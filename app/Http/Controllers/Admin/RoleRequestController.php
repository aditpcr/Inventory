<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleRequest;
use Illuminate\Http\Request;

class RoleRequestController extends Controller
{
    /**
     * Display all role requests
     */
    public function index()
    {
        $roleRequests = RoleRequest::with(['user', 'reviewer'])
            ->orderBy('created_at', 'desc')
            ->get();

        $pendingRequests = $roleRequests->where('status', 'pending');
        $approvedRequests = $roleRequests->where('status', 'approved');
        $rejectedRequests = $roleRequests->where('status', 'rejected');

        return view('admin.role-requests.index', compact(
            'roleRequests',
            'pendingRequests',
            'approvedRequests',
            'rejectedRequests'
        ));
    }

    /**
     * Approve a role request
     */
    public function approve(RoleRequest $roleRequest)
    {
        $user = $roleRequest->user;

        // Update user role and status
        $user->update([
            'role' => $roleRequest->requested_role,
            'role_status' => 'active',
        ]);

        // Update role request
        $roleRequest->update([
            'status' => 'approved',
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->route('admin.role-requests.index')
            ->with('success', 'Role request approved successfully.');
    }

    /**
     * Reject a role request
     */
    public function reject(Request $request, RoleRequest $roleRequest)
    {
        $request->validate([
            'rejection_reason' => 'nullable|string|max:500',
        ]);

        // Update role request
        $roleRequest->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'reviewed_by' => auth()->id(),
            'reviewed_at' => now(),
        ]);

        return redirect()->route('admin.role-requests.index')
            ->with('success', 'Role request rejected successfully.');
    }
}
