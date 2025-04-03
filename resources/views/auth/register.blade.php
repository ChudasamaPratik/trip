<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/vendors/images/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('backend/vendors/images/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/vendors/images/favicon-16x16.png') }}" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/styles/style.css') }}" />
</head>

<body class="login-page">
    {{-- <div class="login-header box-shadow">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div class="brand-logo">
                <a href="login.html">
                    <img src="{{ asset('backend/vendors/images/deskapp-logo.svg') }}" alt="" />
                </a>
            </div>
            <div class="login-menu">
                <ul>
                    <li><a href="login.html">Login</a></li>
                </ul>
            </div>
        </div>
    </div> --}}
    <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 col-lg-7">
                    <img src="{{ asset('backend/vendors/images/login-page-img.png') }}" alt="" />
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="login-box bg-white box-shadow border-radius-10">
                        <div class="login-title">
                            <h2 class="text-center text-primary">Register To DeskApp</h2>
                        </div>
                        <form id="registrationForm" method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="select-role mb-3">
                                <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                    <label class="btn active">
                                        <input type="radio" name="role" id="user" value="user" checked />
                                        <div class="icon">
                                            <img src="{{ asset('backend/vendors/images/briefcase.svg') }}"
                                                class="svg" alt="" />
                                        </div>
                                        <span>I'm</span>
                                        User
                                    </label>
                                    <label class="btn">
                                        <input type="radio" name="role" id="agent" value="agent" />
                                        <div class="icon">
                                            <img src="{{ asset('backend/vendors/images/person.svg') }}" class="svg"
                                                alt="" />
                                        </div>
                                        <span>I'm</span>
                                        Agent
                                    </label>
                                </div>
                            </div>
                            <div class="text-danger small mt-1 mb-3" id="role-error"></div>
                            @error('role')
                                <div class="text-danger small mt-1 mb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror

                            <div class="input-group custom mb-0">
                                <input type="text" class="form-control form-control-lg" id="first_name"
                                    name="first_name" placeholder="First Name" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="text-danger small mt-1 mb-3" id="first_name-error"></div>
                            @error('first_name')
                                <div class="text-danger small mt-1 mb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror

                            <div class="input-group custom mb-0">
                                <input type="text" class="form-control form-control-lg" id="last_name"
                                    name="last_name" placeholder="Last Name" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>
                                </div>
                            </div>
                            <div class="text-danger small mt-1 mb-3" id="last_name-error"></div>
                            @error('last_name')
                                <div class="text-danger small mt-1 mb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror

                            <div class="input-group custom mb-0">
                                <input type="text" class="form-control form-control-lg" id="email" name="email"
                                    placeholder="Email" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="icon-copy dw dw-email"></i></span>
                                </div>
                            </div>
                            <div class="text-danger small mt-1 mb-3" id="email-error"></div>
                            @error('email')
                                <div class="text-danger small mt-1 mb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror

                            <div class="input-group custom mb-0">
                                <input type="password" class="form-control form-control-lg" id="password"
                                    name="password" placeholder="Password" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="text-danger small mt-1 mb-3" id="password-error"></div>
                            @error('password')
                                <div class="text-danger small mt-1 mb-3" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror

                            <div class="input-group custom mb-0">
                                <input type="password" class="form-control form-control-lg"
                                    id="password_confirmation" name="password_confirmation"
                                    placeholder="Confirm Password" />
                                <div class="input-group-append custom">
                                    <span class="input-group-text"><i class="dw dw-padlock1"></i></span>
                                </div>
                            </div>
                            <div class="text-danger small mt-1 mb-3" id="password_confirmation-error"></div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="input-group mb-0">
                                        <button type="submit"
                                            class="btn btn-primary btn-lg btn-block">Register</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="font-16 weight-600 pt-10 pb-10 text-center" data-color="#707373">
                                    OR
                                </div>
                                <div class="input-group mb-0">
                                    <a class="btn btn-outline-primary btn-lg btn-block" href="{{ route('login') }}">
                                        Already have an account? Login
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- js -->
    <script src="{{ asset('lib/jquery-3.6.2.js') }}"></script>
    <script src="{{ asset('backend/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('backend/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/scripts/process.js') }}"></script>

    <!-- jQuery validation -->
    <script src="{{ asset('lib/jquery_validate/jquery.validate.js') }}"></script>

    <script>
        $(document).ready(function() {
            // jQuery validation
            $("#registrationForm").validate({
                rules: {
                    role: {
                        required: true
                    },
                    first_name: {
                        required: true,
                        minlength: 2
                    },
                    last_name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 8
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: "#password"
                    }
                },
                messages: {
                    role: {
                        required: "Please select a role"
                    },
                    first_name: {
                        required: "Please enter your first name",
                        minlength: "Your first name must be at least 2 characters long"
                    },
                    last_name: {
                        required: "Please enter your last name",
                        minlength: "Your last name must be at least 2 characters long"
                    },
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 8 characters long"
                    },
                    password_confirmation: {
                        required: "Please confirm your password",
                        equalTo: "Passwords do not match"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    var elementId = element.attr("id");
                    $("#" + elementId + "-error").html(error);
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>
