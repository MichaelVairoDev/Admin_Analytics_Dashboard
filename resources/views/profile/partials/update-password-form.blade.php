<section>
    <form method="post" action="{{ route('password.update') }}" class="form-horizontal">
        @csrf
        @method('put')

        <div class="form-group row">
            <label for="current_password" class="col-sm-4 col-form-label">Current Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                    id="current_password" name="current_password" required>
                @error('current_password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password" class="col-sm-4 col-form-label">New Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                    id="password" name="password" required>
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <label for="password_confirmation" class="col-sm-4 col-form-label">Confirm Password</label>
            <div class="col-sm-8">
                <input type="password" class="form-control" 
                    id="password_confirmation" name="password_confirmation" required>
            </div>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
