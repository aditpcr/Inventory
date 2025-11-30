<x-guest-layout>
    <div class="text-center mb-space-6">
        <h2 class="text-2xl font-bold text-primary mb-space-2"><i class="fas fa-envelope" style="margin-right: var(--space-2);"></i>Verify Email</h2>
        <p class="text-sm text-secondary mb-space-4">{{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="card" style="background: rgba(40, 167, 69, 0.1); border-color: rgba(40, 167, 69, 0.3); margin-bottom: var(--space-4);">
            <div class="card-body">
                <p class="text-sm font-medium" style="color: #28a745;">{{ __('A new verification link has been sent to the email address you provided during registration.') }}</p>
            </div>
        </div>
    @endif

    <div class="flex items-center justify-between" style="margin-top: var(--space-4); gap: var(--space-4);">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-primary">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-accent hover:text-primary underline">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>
