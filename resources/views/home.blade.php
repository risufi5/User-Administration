@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    @role('user')
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('You are logged in!') }}
                    </div>
                    @endrole
                    @role('admin')
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ __('You are logged in as ADMIN!') }}
                    </div>
                    @endrole
                </div>
                <br>
                <div class="row">
                    <h3>{{__('Users profile')}}</h3>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg mb-2">
                        <div class="card mb-6">
                            <div class="card-body">
                                <div class="row">
                                    <form action="POST" id="userProfileForm">
                                        @csrf
                                        <div class="col-sm-3">
                                            <p class="mb-0">{{ __('Name') }}</p>
                                        </div>
                                        <div class="col-sm-12 mb-4">
                                            <input type="text" name="name" class="mb-0 form-control"
                                                   value="{{Auth::user()->name}}">
                                        </div>
                                        <div class="col-sm-3">
                                            <p class="mb-0">{{ __('Email') }}</p>
                                        </div>
                                        <div class="col-sm-12 mb-4">
                                            <input type="text" name="email" class="mb-0 form-control"
                                                   value="{{Auth::user()->email}}">
                                        </div>
                                        <div class="col-sm-3">
                                            <p class="mb-0">{{ __('Role') }}</p>
                                        </div>
                                        <div class="col-sm-12 mb-4">
                                            <p class="text-muted mb-0 form-control">
                                                {{Auth::user()->roles[0]['name']}}
                                            </p>
                                        </div>
                                    </form>
                                    <div class="col-sm-12 d-flex justify-content-between">
                                        <button class="btn btn-danger btn-sm deleteUser" data-toggle="modal"
                                                data-target="#deleteUserModal">{{__('Delete Account')}}</button>
                                        <div class="d-flex gap-2">
                                            <button type="button" class="btn btn-outline-primary ms-1"
                                                    data-toggle="modal"
                                                    data-target="#changeProfilePasswordModal">
                                                {{__('Change Password')}}
                                            </button>
                                            <button type="button" class="btn btn-primary"
                                                    id="editProfileBtn">{{__('Edit')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-change-password-modal></x-change-password-modal>
    <x-delete-modal></x-delete-modal>

    <script>
        /**
         * Change password
         */
        $('#changeProfilePasswordBtn').click(() => {
            $.ajax({
                url: "{{ route('change-password') }}",
                data: $('#changePasswordForm').serialize(),
                method: 'POST',
                success: function (response) {
                    toastr.success(response.message);
                    $('#changeProfilePasswordCloseBtn').click()
                },
                error: function (response) {
                    let message = JSON.parse(response.responseText)
                    toastr.error(message.message);
                }
            })
        })

        $('#editProfileBtn').click(() => {
            $.ajax({
                url: "{{ route('edit-profile') }}",
                data: $('#userProfileForm').serialize(),
                method: 'POST',
                success: function (response) {
                    toastr.success(response.message);
                },
                error: function (response) {
                    let message = JSON.parse(response.responseText)
                    toastr.error(message.message);
                }
            })
        })

        /**
         * Delete user
         * */
        $('#deleteUserBtn').click(() => {
            $.ajax({
                url: "{{ route('delete-profile') }}",
                method: 'POST',
                data: $('#deleteUserForm').serialize(),
                success: function (response) {
                    window.location.href = "/login";
                },
                error: function (response) {
                    let message = JSON.parse(response.responseText)
                    toastr.error(message.message);
                }
            })
        })

        /**
         * Clear change password modal
         */
        $('#changeProfilePasswordModal').on('hidden.bs.modal', function (e) {
            $('#changePasswordForm input').each(function () {
                $(this).val("")
            })
        })
    </script>
@endsection
