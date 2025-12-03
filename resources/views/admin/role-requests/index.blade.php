@extends('layouts.app')

@section('title', 'Role Requests')
@section('subtitle', 'Manage user role access requests')

@section('breadcrumbs')
<div class="flex items-center" style="gap: var(--space-2); font-size: var(--text-sm);">
    <span class="text-secondary font-medium">Admin</span>
    <span class="text-secondary">/</span>
    <span class="text-secondary font-medium">Role Requests</span>
</div>
@endsection

@section('content')
<div class="container">
    <!-- Stats Cards -->
    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: var(--space-6); margin-bottom: var(--space-8);">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Pending Requests</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $pendingRequests->count() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #ffc107; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-clock" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Approved</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $approvedRequests->count() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #28a745; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-check-circle" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-secondary font-medium">Rejected</p>
                        <p class="text-3xl font-bold text-primary" style="margin-top: var(--space-2);">{{ $rejectedRequests->count() }}</p>
                    </div>
                    <div style="width: 48px; height: 48px; background: #dc3545; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-times-circle" style="color: white; font-size: var(--text-xl);"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Role Requests Table -->
    <div class="card">
        <div class="card-header">
            <div class="flex items-center justify-between">
                <div class="flex items-center" style="gap: var(--space-3);">
                    <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; box-shadow: var(--shadow-base);">
                        <i class="fas fa-user-shield" style="color: white; font-size: var(--text-lg);"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-primary">All Role Requests</h2>
                        <p class="text-sm text-secondary">Review and manage user role access requests</p>
                    </div>
                </div>
            </div>
        </div>

        <div style="overflow-x: auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Requested Role</th>
                        <th>Status</th>
                        <th>Requested At</th>
                        <th>Reviewed By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($roleRequests as $request)
                    <tr>
                        <td>
                            <div class="flex items-center">
                                <div style="width: 40px; height: 40px; background: var(--accent-color); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; margin-right: var(--space-3); box-shadow: var(--shadow-base);">
                                    <span style="color: white; font-weight: var(--font-weight-medium); font-size: var(--text-sm);">
                                        {{ strtoupper(substr($request->user->name, 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <span class="font-bold text-primary block">{{ $request->user->name }}</span>
                                    <span class="text-xs text-secondary">{{ $request->user->email }}</span>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($request->requested_role === 'admin')
                            <span class="badge badge-danger">
                                <i class="fas fa-crown" style="margin-right: var(--space-1);"></i> Admin
                            </span>
                            @elseif($request->requested_role === 'supervisor')
                            <span class="badge badge-success">
                                <i class="fas fa-user-shield" style="margin-right: var(--space-1);"></i> Supervisor
                            </span>
                            @else
                            <span class="badge badge-info">
                                <i class="fas fa-user-tie" style="margin-right: var(--space-1);"></i> Employee
                            </span>
                            @endif
                        </td>
                        <td>
                            @if($request->status === 'pending')
                            <span class="badge" style="background: #ffc107; color: white;">
                                <i class="fas fa-clock" style="margin-right: var(--space-1);"></i> Pending
                            </span>
                            @elseif($request->status === 'approved')
                            <span class="badge badge-success">
                                <i class="fas fa-check-circle" style="margin-right: var(--space-1);"></i> Approved
                            </span>
                            @else
                            <span class="badge badge-danger">
                                <i class="fas fa-times-circle" style="margin-right: var(--space-1);"></i> Rejected
                            </span>
                            @endif
                        </td>
                        <td>
                            <span class="text-sm font-medium text-primary">{{ $request->created_at->format('M d, Y') }}</span>
                            <br>
                            <span class="text-xs text-secondary">{{ $request->created_at->format('h:i A') }}</span>
                        </td>
                        <td>
                            @if($request->reviewer)
                            <span class="text-sm font-medium text-primary">{{ $request->reviewer->name }}</span>
                            @if($request->reviewed_at)
                            <br>
                            <span class="text-xs text-secondary">{{ $request->reviewed_at->format('M d, Y') }}</span>
                            @endif
                            @else
                            <span class="text-sm text-secondary">—</span>
                            @endif
                        </td>
                        <td>
                            @if($request->status === 'pending')
                            <div class="flex items-center" style="gap: var(--space-2);">
                                <form action="{{ route('admin.role-requests.approve', $request) }}" method="POST" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="btn" style="padding: var(--space-2) var(--space-3); background: #28a745; color: white; border: none;" onclick="return confirm('Approve this role request?')">
                                        <i class="fas fa-check" style="font-size: var(--text-sm);"></i>
                                    </button>
                                </form>
                                <button type="button" class="btn" style="padding: var(--space-2) var(--space-3); background: #dc3545; color: white; border: none;" onclick="showRejectModal({{ $request->id }})">
                                    <i class="fas fa-times" style="font-size: var(--text-sm);"></i>
                                </button>
                            </div>
                            @elseif($request->status === 'rejected' && $request->rejection_reason)
                            <button type="button" class="btn" style="padding: var(--space-2) var(--space-3); background: #6c757d; color: white; border: none;" onclick="showRejectionReason('{{ $request->rejection_reason }}')">
                                <i class="fas fa-info-circle" style="font-size: var(--text-sm);"></i>
                            </button>
                            @else
                            <span class="text-sm text-secondary">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center" style="padding: var(--space-8);">
                            <div style="width: 96px; height: 96px; background: var(--background-light); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-4); box-shadow: var(--shadow-base);">
                                <i class="fas fa-inbox" style="color: var(--text-light); font-size: var(--text-3xl);"></i>
                            </div>
                            <h3 class="text-xl font-bold text-primary" style="margin-bottom: var(--space-2);">No role requests found</h3>
                            <p class="text-secondary">All role requests have been processed.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div id="rejectModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div class="card" style="max-width: 500px; width: 90%; margin: var(--space-4);">
        <div class="card-header">
            <h3 class="text-xl font-bold text-primary">Reject Role Request</h3>
        </div>
        <div class="card-body">
            <form id="rejectForm" method="POST">
                @csrf
                <div class="form-group">
                    <label class="form-label">Rejection Reason (Optional)</label>
                    <textarea name="rejection_reason" class="form-control" rows="4" placeholder="Enter reason for rejection..."></textarea>
                </div>
                <div class="flex items-center" style="gap: var(--space-3);">
                    <button type="submit" class="btn" style="background: #dc3545; color: white; flex: 1;">
                        <i class="fas fa-times" style="margin-right: var(--space-2);"></i>Reject Request
                    </button>
                    <button type="button" class="btn" style="background: var(--background-light); color: var(--text-primary); flex: 1;" onclick="closeRejectModal()">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Rejection Reason Modal -->
<div id="reasonModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 1000; align-items: center; justify-content: center;">
    <div class="card" style="max-width: 500px; width: 90%; margin: var(--space-4);">
        <div class="card-header">
            <h3 class="text-xl font-bold text-primary">Rejection Reason</h3>
        </div>
        <div class="card-body">
            <p id="reasonText" class="text-primary"></p>
            <button type="button" class="btn btn-primary w-full" style="margin-top: var(--space-4);" onclick="closeReasonModal()">
                Close
            </button>
        </div>
    </div>
</div>

<script>
    function showRejectModal(requestId) {
        const form = document.getElementById('rejectForm');
        form.action = `/admin/role-requests/${requestId}/reject`;
        document.getElementById('rejectModal').style.display = 'flex';
    }

    function closeRejectModal() {
        document.getElementById('rejectModal').style.display = 'none';
        document.getElementById('rejectForm').reset();
    }

    function showRejectionReason(reason) {
        document.getElementById('reasonText').textContent = reason || 'No reason provided.';
        document.getElementById('reasonModal').style.display = 'flex';
    }

    function closeReasonModal() {
        document.getElementById('reasonModal').style.display = 'none';
    }

    // Close modals when clicking outside
    document.getElementById('rejectModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeRejectModal();
        }
    });

    document.getElementById('reasonModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeReasonModal();
        }
    });
</script>
@endsection

