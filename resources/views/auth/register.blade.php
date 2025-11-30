<x-guest-layout>
    <div class="text-center mb-space-6">
        <h2 class="text-2xl font-bold text-primary mb-space-2"><i class="fas fa-user-plus" style="margin-right: var(--space-2);"></i>Create Account</h2>
        <p class="text-sm text-secondary">Register for a new account</p>
    </div>

    <form method="POST" action="{{ route('register') }}" style="display: flex; flex-direction: column; gap: var(--space-4);">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" class="form-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
            @error('name')
                <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2);">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
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

        <div class="flex items-center justify-end" style="margin-top: var(--space-4); gap: var(--space-4);">
            <a class="text-sm text-accent hover:text-primary underline" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <button type="submit" class="btn btn-primary">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</x-guest-layout>
