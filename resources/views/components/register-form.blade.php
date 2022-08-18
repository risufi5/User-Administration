<form method="POST" action="{{ route('register') }}" id="registerUserForm">
    @csrf

    <div class="row">
        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

        <div class="col-md-6 form-group">
            <input id="name" type="text"
                   class="form-control @error('name') is-invalid @enderror" name="name"
                   value="{{ old('name') }}" required autocomplete="off">

            @error('name')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>
    </div>

    <div class="row">
        <label for="email"
               class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

        <div class="col-md-6 form-group">
            <input id="email" type="email"
                   class="form-control @error('email') is-invalid @enderror" name="email"
                   value="{{ old('email') }}" required autocomplete="off">

            @error('email')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>
    </div>

    <div class="row">
        <label for="phone_number"
               class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

        <div class="col-md-6 form-group">
            <input id="phone_number" type="text"
                   class="form-control @error('email') is-invalid @enderror" name="phone_number"
                   value="{{ old('phone_number') }}" required autocomplete="off">

            @error('phone_number')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>
    </div>

    <div class="row">
        <label for="birthday"
               class="col-md-4 col-form-label text-md-end">{{ __('Birthday') }}</label>

        <div class="col-md-6 form-group">

            <input type="text" name="birthday" class="form-control @error('birthday') is-invalid @enderror"
                   autocomplete="off" required/>
            @error('birthday')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>
    </div>

    @role('admin')
    <div class="row">
        <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
        <div class="col-md-6 form-group">
            <select class="select2 form-control roleSelect2" name="role">
                <option value="" disabled selected></option>
            </select>
        </div>
    </div>
    @endrole
    <div class="row">
        <label for="password"
               class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

        <div class="col-md-6 form-group">
            <input type="password" id="password"
                   class="form-control @error('password') is-invalid @enderror password" name="password"
                   required autocomplete="password">

            @error('password')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>
    </div>

    <div class="row">
        <label for="password-confirm"
               class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

        <div class="col-md-6 form-group">
            <input type="password" class="form-control password-confirm"
                   name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>
    @guest
        <div class="row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>
        </div>
    @endguest
</form>

