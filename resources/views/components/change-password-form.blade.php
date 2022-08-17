<form action="POST" id="changePasswordForm">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-sm-4">
                <p>{{ __('Current Password') }}</p>
            </div>
            <div class="col-sm-8 mb-4">
                <input type="password" class="text-muted form-control" name="currentPassword">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 mb-4">
                <p>{{ __('New Password') }}</p>
            </div>
            <div class="col-sm-8">
                <input type="password" class="text-muted form-control" name="newPassword">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <p>{{ __('Confirm New Password') }}</p>
            </div>
            <div class="col-sm-8">
                <input type="password" class="text-muted form-control" name="newPassword_confirmation">
            </div>
        </div>
    </div>
</form>
