<head>
    <title>Users List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex flex-row-reverse"><!-- Button trigger modal -->
            <button type="button" class="btn btn-success mb-2 float-right" data-toggle="modal"
                    data-target="#addUserModal">
                Add User
            </button>
        </div>
        <div class="row">
            <!-- Datatable show user list-->
            <div class="col-12 table-responsive">
                <table class="table table-bordered" id="userDatatable">
                    <thead>
                    <tr>
                        <th>Nr</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Birthday</th>
                        <th>Role</th>
                        <th width="100px">Action</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
    <x-register-modal></x-register-modal>
    <x-edit-modal></x-edit-modal>
    <x-delete-modal></x-delete-modal>
    <script type="text/javascript">

        /**
         * Show user datatable
         * */
        let table;

        $(function () {
            table = $('#userDatatable').DataTable({
                processing: true,
                ajax: "{{ route('admin.list') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'phone_number', name: 'phone_number'},
                    {data: 'birthday', name: 'birthday'},
                    {
                        data: 'roles', name: 'roles',
                        render: function (data, type, row, meta) {
                            return capitalizeFirstLetter(data[0].name)
                        },
                    },
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            /**
             * Get user roles - Add user
             * */
            $.ajax({
                url: "{{ route('admin.roles') }}",
                success: function (data) {
                    $('.roleSelect2').each(function () {
                        $(this).empty()
                        data.forEach(role => {
                            let option = document.createElement('option')
                            option.innerText = capitalizeFirstLetter(role.name);
                            option.value = role.name;
                            $(this).append(option)
                        })
                    })
                }
            })

        });

        /**
         * Select 2
         * */
        $(document).ready(function () {
            $('.select2').each(function () {
                $(this).select2({
                    dropdownParent: $(this).parents('.modal'),
                    width: '100%'
                });
            })
        });

        /**
         * Add user
         * */
        $('#addUserBtn').click(() => {
            $.ajax({
                url: "{{ route('admin.register') }}",
                data: $('#registerUserForm').serialize(),
                method: 'POST',
                success: function (response) {
                    toastr.success(response.message);
                    $('#addUserCloseBtn').click()
                },
                error: function (response) {
                    let message = JSON.parse(response.responseText)
                    toastr.error(message.message);
                }
            })
            table.ajax.reload();
        })

        /**
         * Edit user
         * */
        $('#editUserBtn').click(() => {
            $.ajax({
                url: "{{ route('admin.edit') }}",
                data: $('#editUserForm').serialize(),
                method: 'POST',
                success: function (response) {
                    toastr.success(response.message);
                    $('#editUserCloseBtn').click()
                },
                error: function (response) {
                    let message = JSON.parse(response.responseText)
                    toastr.error(message.message);
                }
            })
            table.ajax.reload();
        })

        /**
         * Delete user
         * */
        $('#deleteUserBtn').click(() => {
            $.ajax({
                url: "{{ route('admin.delete') }}",
                data: $('#deleteUserForm').serialize(),
                method: 'POST',
                success: function (response) {
                    toastr.success(response.message);
                    $('#deleteUserCloseBtn').click()
                },
                error: function (response) {
                    let message = JSON.parse(response.responseText)
                    toastr.error(message.message);
                }
            })
            table.ajax.reload();
        })

        /**
         * Open delete modal
         * */
        $(document).on('click', '.deleteUser', function () {
            let rowData = table.row($(this).closest('tr')).data();
            $('#deleteUserModal input[name=id]').val(rowData.id);
        })

        /**
         * Open edit user modal
         * */
        $(document).on('click', '.editUser', function () {
            let rowData = table.row($(this).closest('tr')).data();
            $('#editUserModal input[name=name]').val(rowData.name);
            $('#editUserModal input[name=email]').val(rowData.email);
            $('#editUserModal select[name=role]').val(rowData.roles[0].name).change();
            $('#editUserModal input[name=id]').val(rowData.id);

        })

        /**
         * Clear register-modal
         */
        $('#addUserModal').on('hidden.bs.modal', function (e) {
            $('#registerUserForm input').each(function () {
                $(this).val("")
            })
        })


        /**
         * Capitalize first letter of roles
         * */
        function capitalizeFirstLetter(string) {
            return string.charAt(0).toUpperCase() + string.slice(1).toLowerCase();
        }

    </script>
@endsection
