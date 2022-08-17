@role('admin')
<form id="editUserForm">
    @csrf

    <div class="row mb-3">
        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

        <div class="col-md-6">
            <input type="hidden" name="id">
            <input type="text"
                   class="form-control @error('name') is-invalid @enderror" name="name"
                   value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="email"
               class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

        <div class="col-md-6">
            <input type="email"
                   class="form-control @error('email') is-invalid @enderror" name="email"
                   value="{{ old('email') }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
            @enderror
        </div>
    </div>
    <div class="row mb-3">
        <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
        <div class="col-md-6">
            <select class="select2 form-control roleSelect2" name="role">
                <option value="" disabled selected></option>
            </select>
        </div>
    </div>
</form>
@endrole
