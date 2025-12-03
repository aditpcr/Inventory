@extends('layouts.app')

@section('title', 'Request Role Access')
@section('subtitle', 'Select your role to continue')

@section('content')
<div class="container">
    <div style="max-width: 600px; margin: 0 auto;">
        <div class="card">
            <div class="card-header">
                <div class="flex items-center" style="gap: var(--space-4);">
                    <div style="width: 50px; height: 50px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-xl); color: white; background: var(--accent-color); box-shadow: var(--shadow-md);">
                        <i class="fas fa-user-shield"></i>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold text-primary">Request Role Access</h2>
                        <p class="text-sm text-secondary">Please select a role to continue</p>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if(session('success'))
                    <div class="alert" style="background: rgba(40, 167, 69, 0.1); border-color: rgba(40, 167, 69, 0.3); color: #28a745; margin-bottom: var(--space-4);">
                        <i class="fas fa-check-circle" style="margin-right: var(--space-2);"></i>{{ session('success') }}
                    </div>
                @endif

                @if(session('info'))
                    <div class="alert" style="background: rgba(58, 134, 255, 0.1); border-color: rgba(58, 134, 255, 0.3); color: var(--accent-color); margin-bottom: var(--space-4);">
                        <i class="fas fa-info-circle" style="margin-right: var(--space-2);"></i>{{ session('info') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger" style="margin-bottom: var(--space-4);">
                        @foreach($errors->all() as $error)
                            <p style="margin: 0;"><i class="fas fa-exclamation-circle" style="margin-right: var(--space-2);"></i>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                @if($pendingRequest)
                    <div class="card" style="background: rgba(255, 193, 7, 0.1); border: 1px solid rgba(255, 193, 7, 0.3); margin-bottom: var(--space-6);">
                        <div class="card-body">
                            <div class="flex items-center" style="gap: var(--space-4);">
                                <div style="width: 50px; height: 50px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-xl); color: white; background: #ffc107;">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div style="flex: 1;">
                                    <h3 class="text-lg font-bold text-primary" style="margin-bottom: var(--space-2);">Pending Request</h3>
                                    <p class="text-sm text-secondary" style="margin-bottom: var(--space-2);">
                                        You have a pending request for <strong>{{ ucfirst($pendingRequest->requested_role) }}</strong> role.
                                    </p>
                                    <p class="text-xs text-secondary">Please wait for admin approval. You will be notified once your request is reviewed.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <form method="POST" action="{{ route('role-request.store') }}">
                        @csrf
                        
                        <div style="margin-bottom: var(--space-6);">
                            <label class="form-label" style="font-weight: var(--font-weight-medium); margin-bottom: var(--space-4); display: block;">Select Your Role</label>
                            
                            <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: var(--space-4);">
                                <!-- Admin Role -->
                                <label style="cursor: pointer;">
                                    <input type="radio" name="role" value="admin" class="role-radio" style="display: none;" required>
                                    <div class="role-card" data-role="admin" style="border: 2px solid var(--border-light); border-radius: var(--radius-lg); padding: var(--space-4); text-align: center; transition: all var(--transition-base); background: var(--background-card);">
                                        <div style="width: 60px; height: 60px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-2xl); color: white; background: #dc3545; margin: 0 auto var(--space-3); box-shadow: var(--shadow-md);">
                                            <i class="fas fa-crown"></i>
                                        </div>
                                        <h4 class="text-lg font-bold text-primary" style="margin-bottom: var(--space-1);">Admin</h4>
                                        <p class="text-xs text-secondary">Full system access</p>
                                    </div>
                                </label>

                                <!-- Supervisor Role -->
                                <label style="cursor: pointer;">
                                    <input type="radio" name="role" value="supervisor" class="role-radio" style="display: none;" required>
                                    <div class="role-card" data-role="supervisor" style="border: 2px solid var(--border-light); border-radius: var(--radius-lg); padding: var(--space-4); text-align: center; transition: all var(--transition-base); background: var(--background-card);">
                                        <div style="width: 60px; height: 60px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-2xl); color: white; background: #28a745; margin: 0 auto var(--space-3); box-shadow: var(--shadow-md);">
                                            <i class="fas fa-user-shield"></i>
                                        </div>
                                        <h4 class="text-lg font-bold text-primary" style="margin-bottom: var(--space-1);">Supervisor</h4>
                                        <p class="text-xs text-secondary">Manage inventory</p>
                                    </div>
                                </label>

                                <!-- Employee Role -->
                                <label style="cursor: pointer;">
                                    <input type="radio" name="role" value="employee" class="role-radio" style="display: none;" required>
                                    <div class="role-card" data-role="employee" style="border: 2px solid var(--border-light); border-radius: var(--radius-lg); padding: var(--space-4); text-align: center; transition: all var(--transition-base); background: var(--background-card);">
                                        <div style="width: 60px; height: 60px; border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; font-size: var(--text-2xl); color: white; background: #f59e0b; margin: 0 auto var(--space-3); box-shadow: var(--shadow-md);">
                                            <i class="fas fa-user-tie"></i>
                                        </div>
                                        <h4 class="text-lg font-bold text-primary" style="margin-bottom: var(--space-1);">Employee</h4>
                                        <p class="text-xs text-secondary">POS & orders</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary w-full">
                            <i class="fas fa-paper-plane" style="margin-right: var(--space-2);"></i>Submit Request
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    .role-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }
    
    .role-radio:checked + .role-card {
        border-color: var(--accent-color) !important;
        background: rgba(58, 134, 255, 0.05) !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleCards = document.querySelectorAll('.role-card');
        const roleRadios = document.querySelectorAll('.role-radio');

        roleCards.forEach(card => {
            card.addEventListener('click', function() {
                const role = this.getAttribute('data-role');
                const radio = document.querySelector(`input[value="${role}"]`);
                if (radio) {
                    radio.checked = true;
                    // Update visual state
                    roleCards.forEach(c => {
                        c.style.borderColor = 'var(--border-light)';
                        c.style.background = 'var(--background-card)';
                    });
                    this.style.borderColor = 'var(--accent-color)';
                    this.style.background = 'rgba(58, 134, 255, 0.05)';
                }
            });
        });

        // Initialize checked state
        roleRadios.forEach(radio => {
            if (radio.checked) {
                const card = radio.closest('label').querySelector('.role-card');
                if (card) {
                    card.style.borderColor = 'var(--accent-color)';
                    card.style.background = 'rgba(58, 134, 255, 0.05)';
                }
            }
        });
    });
</script>
@endsection

