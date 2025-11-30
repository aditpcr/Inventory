<x-guest-layout>
    <div class="text-center mb-space-6">
        <h2 class="text-2xl font-bold text-primary mb-space-2"><i class="fas fa-shield-alt" style="margin-right: var(--space-2);"></i>Confirm Password</h2>
        <p class="text-sm text-secondary mb-space-4">{{ __('This is a secure area of the application. Please confirm your password before continuing.') }}</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" style="display: flex; flex-direction: column; gap: var(--space-4);">
        @csrf

        <!-- Password -->
        <div>
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" />
            @error('password')
                <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2);">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex justify-end" style="margin-top: var(--space-4);">
            <button type="submit" class="btn btn-primary">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
</x-guest-layout>
