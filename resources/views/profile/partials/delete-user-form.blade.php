<section style="display: flex; flex-direction: column; gap: var(--space-6);">
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn" style="background: #dc3545; color: white; border: none;"
    >{{ __('Delete Account') }}</button>

    <div x-data="{ show: @js($errors->userDeletion->isNotEmpty()) }" x-show="show" style="display: none;" class="card" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1000; max-width: 500px; width: 90%;">
        <div class="card-header">
            <h2 class="text-lg font-bold text-primary">
                {{ __('Are you sure you want to delete your account?') }}
            </h2>
        </div>
        <form method="post" action="{{ route('profile.destroy') }}" class="card-body">
            @csrf
            @method('delete')

            <p class="text-sm text-secondary" style="margin-top: var(--space-1);">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>

            <div style="margin-top: var(--space-6);">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-input"
                    placeholder="{{ __('Password') }}"
                />
                @error('password', 'userDeletion')
                    <p class="text-sm" style="color: #dc3545; margin-top: var(--space-2);">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-end" style="margin-top: var(--space-6); gap: var(--space-3);">
                <button type="button" x-on:click="show = false" class="btn btn-outline">
                    {{ __('Cancel') }}
                </button>
                <button type="submit" class="btn" style="background: #dc3545; color: white; border: none;">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </div>
</section>
