<x-guest-layout>
    <div class="text-center mb-space-6">
        <h2 class="text-2xl font-bold text-primary mb-space-2"><i class="fas fa-key" style="margin-right: var(--space-2);"></i>Reset Password</h2>
        <p class="text-sm text-secondary">Enter your new password</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" style="display: flex; flex-direction: column; gap: var(--space-4);">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username" />
            @error('email')
                <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2);">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" />
            @error('password')
                <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2);">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" />
            @error('password_confirmation')
                <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2);">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-end" style="margin-top: var(--space-4);">
            <button type="submit" class="btn btn-primary">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</x-guest-layout>
