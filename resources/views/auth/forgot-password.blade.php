<x-guest-layout>
    <div class="text-center mb-space-6">
        <h2 class="text-2xl font-bold text-primary mb-space-2"><i class="fas fa-key" style="margin-right: var(--space-2);"></i>Reset Password</h2>
        <p class="text-sm text-secondary mb-space-4">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="card" style="background: rgba(40, 167, 69, 0.1); border-color: rgba(40, 167, 69, 0.3); margin-bottom: var(--space-4);">
            <div class="card-body">
                <p class="text-sm font-medium" style="color: #28a745;">{{ session('status') }}</p>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" style="display: flex; flex-direction: column; gap: var(--space-4);">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autofocus />
            @error('email')
                <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2);">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end" style="margin-top: var(--space-4);">
            <button type="submit" class="btn btn-primary">
                {{ __('Email Password Reset Link') }}
            </button>
        </div>
    </form>
</x-guest-layout>
