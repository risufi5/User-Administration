<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"/>
    <link href="{{asset('css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/select2.min.css')}}"/>

    <script src="{{asset('js/jquery.js')}}"></script>
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/select2.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
<!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>

    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}"/>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            @auth
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ __('Home') }}
                </a>
            @endauth
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ms-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif

                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        @role('admin')
                        <a class="nav-link" href="{{ route('admin.list') }}">
                            {{ __('User List') }}
                        </a>
                        @endrole
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

<script type="text/javascript">
    $(function () {
        $('input[name="birthday"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,startDate:moment().subtract(18,'years'),
            minYear: 1901,
            maxYear: parseInt(moment().subtract(18,'years').format('YYYY'), 10),
            locale: {
                format: 'YYYY-MM-DD',
                cancelLabel: 'Clear'
            }
        });
        $('input[name="birthday"]').val('')
        $('input[name="birthday"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });
    });

    $.validator.addMethod("minAge", function(value, element, min) {
        var today = new Date();
        var birthDate = new Date(value);
        var age = today.getFullYear() - birthDate.getFullYear();

        if (age > min + 1) {
            return true;
        }

        var m = today.getMonth() - birthDate.getMonth();

        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }

        return age >= min;
    }, "You are not old enough!");

    jQuery.validator.addMethod("lettersonly", function(value, element) {
        return this.optional(element) || /^[a-z\s]+$/i.test(value);
    }, "Only alphabetical characters");

    $("#registerUserForm").validate({

            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('authError');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
        rules: {
            name: {
                required: true,
                lettersonly: true,
                maxlength: 255
            },

            email: {
                required: true,
                email: true,
                maxlength: 255
            },

            phone_number: {
                required: true,
                digits: true,
                minLength: 8,
            },

            birthday: {
                required: true,
                date : true,
                minAge: 18
            },

            password: {
                required: true,
                minlength: 8
            },

            password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: "#password"
            },
        },
        messages: {

            name: {
                required: 'Please enter name',
                lettersonly: "Name field must contain only letters",
                maxlength: 255
            },

            email: {
                required: "Please enter email",
                email: "Invalid email format.",
                maxlength: 255
            },

            phone_number: {
                required: "Please enter phone number",
                digits: "Must have only numbers",
                maxlength: 'Must be max to 255 numbers',
                minlength: 'Must be at least 8 numbers'
            },

            birthday: {
                required: "Please enter birthday",
                date : "Invalid date",
                minAge: "You must be at least 18 years old!"
            },

            password: {
                required: "Please enter password",
                minlength: "Password must be at least 8 characters"
            },

            password_confirmation: {
                required: "Please enter password confirmation",
                minlength: "Password confirmation must be at least 8 characters",
                equalTo: "Passwords don't match"
            },
        },
    })
</script>
</body>
</html>
