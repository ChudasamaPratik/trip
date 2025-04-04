@extends('backend.layout.main')
@section('title', 'Admin Profiles')
@section('content')

    <div class="pd-ltr-20 xs-pd-20-10">
        <div class="min-height-200px">
            <div class="page-header">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="title">
                            <h4>Profile</h4>
                        </div>
                        <nav aria-label="breadcrumb" role="navigation">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="index.html">Home</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Profile
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
                    <div class="pd-20 card-box height-100-p">
                        <div class="profile-photo">

                            <img class="profileImagePreview rounded-circle" src="{{ $adminDetails->image_url }}"
                                alt="Profile" style="max-width: 100px; max-height: 100px;" />

                        </div>
                        <h5 class="text-center h5 mb-0">{{ $adminDetails->first_name . ' ' . $adminDetails->last_name }}
                        </h5>
                        <div class="profile-info">
                            <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                            <ul>
                                <li>
                                    <span>First Name:</span>
                                    {{ $adminDetails->first_name }}
                                </li>
                                <li>
                                    <span>Last Name:</span>
                                    {{ $adminDetails->last_name }}
                                </li>
                                <li>
                                    <span>Email Address:</span>
                                    {{ $adminDetails->email }}
                                </li>

                            </ul>
                        </div>
                        <div class="profile-social">

                        </div>
                    </div>
                </div>
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
                    <div class="card-box height-100-p overflow-hidden">
                        <div class="profile-tab height-100-p">
                            <div class="tab height-100-p">
                                <ul class="nav nav-tabs customtab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#overview"
                                            role="tab">Overview</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#editProfile" role="tab">Edit
                                            Profile</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#changePassword" role="tab">Change
                                            Password</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <!-- overview profile start -->
                                    <div class="tab-pane fade show active" id="overview" role="tabpanel">
                                        <div class="profile-info">
                                            <h5 class="mb-20 h5 text-blue">Contact Information</h5>
                                            <ul>
                                                <li>
                                                    <h6>Full Name :
                                                        {{ $adminDetails->first_name . ' ' . $adminDetails->last_name }}
                                                    </h6>

                                                </li>
                                                <li>
                                                    <h6>Email Address: {{ $adminDetails->email }} </h6>

                                                </li>

                                            </ul>
                                        </div>
                                    </div>

                                    <!-- overview Profile -->

                                    <!-- change Password -->
                                    <div class="tab-pane fade" id="changePassword" role="tabpanel">
                                        <div class="pd-20 profile-task-wrap">
                                            <div class="container pd-0">
                                                <div class="task-title row align-items-center">
                                                    <form method="POST" action="{{ route('profiles.update-password') }}"
                                                        id="updatePasswordForm">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="form-group row">
                                                            <label for="currentPassword"
                                                                class="col-md-4 col-form-label text-md-right">Current
                                                                Password</label>
                                                            <div class="col-md-8">
                                                                <input name="old_password" type="password"
                                                                    class="form-control" id="currentPassword" required>
                                                                @error('old_password')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="newPassword"
                                                                class="col-md-4 col-form-label text-md-right">New
                                                                Password</label>
                                                            <div class="col-md-8">
                                                                <input name="password" type="password" class="form-control"
                                                                    id="newPassword" required>
                                                                @error('password')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="renewPassword"
                                                                class="col-md-4 col-form-label text-md-right">Re-enter New
                                                                Password</label>
                                                            <div class="col-md-8">
                                                                <input name="password_confirmation" type="password"
                                                                    class="form-control" id="renewPassword" required>
                                                                @error('password_confirmation')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-8 offset-md-4">
                                                                <button type="submit" class="btn btn-primary">Save &
                                                                    Update</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Change Password Tab End -->

                                    <!-- Edit Profile Tab start -->
                                    <div class="tab-pane fade height-100-p" id="editProfile" role="tabpanel">
                                        <div class="profile-setting">
                                            <form id="edit-admin-form" action="{{ route('profile.update') }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <ul class="profile-edit-list row">
                                                    <li class="weight-500 col-md-6">
                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label">Profile Image</label>
                                                            <div class="col-md-8">
                                                                <img class="profileImagePreview rounded-circle"
                                                                    src="{{ $adminDetails->image_url }}" alt="Profile"
                                                                    style="max-width: 100px; max-height: 100px;"
                                                                    name="profile_image" />
                                                                <div class="pt-2">
                                                                    <a href="javascript:void(0);"
                                                                        class="btn btn-primary btn-sm" id="uploadBtn"
                                                                        title="Upload new profile image">
                                                                        <i class="bi bi-upload"></i> Upload
                                                                    </a>
                                                                    <input type="file" name="profile_image"
                                                                        id="profileImageInput"
                                                                        class="d-none profileImageInput" accept="image/*">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label">First Name</label>
                                                            <div class="col-md-8">
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="first_name" id="first_name"
                                                                    value="{{ old('first_name', $adminDetails->first_name) }}" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label">Last Name</label>
                                                            <div class="col-md-8">
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="last_name" id="last_name"
                                                                    value="{{ old('last_name', $adminDetails->last_name) }}" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label class="col-md-4 col-form-label">e-Mail</label>
                                                            <div class="col-md-8">
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="email" id="email"
                                                                    value="{{ old('email', $adminDetails->email) }}" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-8 offset-md-4">
                                                                <input type="submit" class="btn btn-primary"
                                                                    value="Save & Update" />
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Edit Profile Tab End -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#uploadBtn').click(function() {
                $('#profileImageInput').click();
            });

            $('#profileImageInput').change(function() {
                var file = this.files[0];
                var preview = $('.profileImagePreview');

                $('#imageError').hide();

                if (file) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        preview.attr('src', e.target.result);
                        $('.profileImagePreview1').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            });
            $.validator.addMethod("maxFileSize", function(val, element, maxSizeInMB) {
                var maxSizeInBytes = maxSizeInMB * 1048576; // Convert MB to bytes
                if (element.files && element.files[0]) {
                    return element.files[0].size <= maxSizeInBytes;
                }
                return true;
            }, $.validator.format("File size must be less than {0} MB."));

            $.validator.addMethod("noHTML", function(value, element) {
                return this.optional(element) || /^[^<>]*$/.test(value);
            }, "HTML tags are not allowed");

            $('#edit-admin-form').validate({
                ignore: "#hidden",
                rules: {
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
                        email: true,
                        noHTML: true
                    },
                    profile_image: {
                        required: false,
                        extension: "jpeg|jpg|png",
                        maxFileSize: 2
                    }
                },
                messages: {
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
                        email: "Please enter a valid email address",
                        noHTML: "HTML tags are not allowed"
                    },
                    profile_image: {
                        required: "Please upload a profile image",
                        extension: "Invalid file type. Only JPEG, PNG, and GIF files are allowed",
                        filesize: "The file size must not exceed 2MB"
                    }
                },
                errorClass: "is-invalid text-danger",
                validClass: "is-valid",
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                }
            });



            $("#updatePasswordForm").validate({
                rules: {
                    old_password: {
                        required: true,
                        // minlength: 8,
                        maxlength: 12,
                        pattern: /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,12}$/,
                        noHTML: true
                    },
                    password: {
                        required: true,
                        // minlength: 8,
                        maxlength: 12,
                        pattern: /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,12}$/,
                        noHTML: true
                    },
                    password_confirmation: {
                        required: true,
                        // minlength: 8,
                        maxlength: 12,
                        pattern: /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,12}$/,
                        noHTML: true,
                        equalTo: "#password" // Ensure this references the correct password field ID
                    }
                },
                messages: {
                    old_password: {
                        required: "Please enter your current password",
                        // minlength: "Password must be at least 8 characters long",
                        maxlength: "Password must not exceed 12 characters",
                        pattern: "Password must include at least one letter, one number, and one symbol",
                        noHTML: "HTML tags are not allowed"
                    },
                    password: {
                        required: "Please enter a new password",
                        // minlength: "Password must be at least 8 characters long",
                        maxlength: "Password must not exceed 12 characters",
                        pattern: "Password must include at least one letter, one number, and one symbol",
                        noHTML: "HTML tags are not allowed"
                    },
                    password_confirmation: {
                        required: "Please confirm your new password",
                        // minlength: "Password must be at least 8 characters long",
                        maxlength: "Password must not exceed 12 characters",
                        pattern: "Password must include at least one letter, one number, and one symbol",
                        noHTML: "HTML tags are not allowed",
                        equalTo: "New passwords do not match"
                    }
                },
                errorClass: "is-invalid text-danger",
                validClass: "is-valid",
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.insertAfter(element);
                },
                highlight: function(element) {
                    $(element).addClass('is-invalid').removeClass('is-valid');
                },
                unhighlight: function(element) {
                    $(element).addClass('is-valid').removeClass('is-invalid');
                }
            });
        });
    </script>
@endpush
