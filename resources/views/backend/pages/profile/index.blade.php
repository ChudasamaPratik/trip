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
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="d-flex flex-column align-items-center text-center card-box height-100-p">
                        <!-- Profile Image -->
                        <img class="profileImagePreview rounded-circle mt-5" src="{{ $adminDetails->image_url ?? '' }}"
                            alt="Profile" style="width: 100px; height: 100px; object-fit: cover;" />

                        <!-- Admin Name (Single Line) -->
                        <h5 class="mt-2 mb-0 text-nowrap">
                            {{ $adminDetails->first_name . ' ' . $adminDetails->last_name ?? '' }}
                        </h5>
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
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <tbody>
                                                        <tr>
                                                            <th>Full Name</th>
                                                            <td>{{ $adminDetails->first_name . ' ' . $adminDetails->last_name ?? '' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Address</th>
                                                            <td>{{ $adminDetails->userDetails->address ?? 'Not available' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Email Address</th>
                                                            <td>{{ $adminDetails->userDetails->email ?? 'Not available' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Phone</th>
                                                            <td>{{ $adminDetails->userDetails->phone ?? 'Not available' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Agency Name</th>
                                                            <td>{{ $adminDetails->userDetails->agency_name ?? 'Not available' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>City</th>
                                                            <td>{{ $adminDetails->userDetails->city ?? 'Not available' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>State</th>
                                                            <td>{{ $adminDetails->userDetails->state ?? 'Not available' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Country</th>
                                                            <td>{{ $adminDetails->userDetails->country ?? 'Not available' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Zipcode</th>
                                                            <td>{{ $adminDetails->userDetails->zipcode ?? 'Not available' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Description</th>
                                                            <td>{{ $adminDetails->userDetails->description ?? 'Not available' }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- overview Profile -->

                                    <!-- change Password -->
                                    <div class="tab-pane fade" id="changePassword" role="tabpanel">
                                        <div class="p-4 profile-task-wrap">
                                            <h5 class="mb-3 fw-bold text-primary">Change Password</h5>

                                            <form method="POST" action="{{ route('profiles.update-password') }}"
                                                id="updatePasswordForm">
                                                @csrf
                                                @method('PUT')

                                                <div class="row mb-3 align-items-center">
                                                    <label for="currentPassword"
                                                        class="col-sm-2 col-form-label text-end fw-semibold">Current
                                                        Password</label>
                                                    <div class="col-sm-6">
                                                        <input name="old_password" type="password" class="form-control"
                                                            id="currentPassword" placeholder=" Current Password" required>
                                                        @error('old_password')
                                                            <div class="text-danger small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row mb-3 align-items-center">
                                                    <label for="newPassword"
                                                        class="col-sm-2 col-form-label text-end fw-semibold">New
                                                        Password</label>
                                                    <div class="col-sm-6">
                                                        <input name="password" type="password" class="form-control"
                                                            id="newPassword" placeholder="New Password" required>
                                                        @error('password')
                                                            <div class="text-danger small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row mb-3 align-items-center">
                                                    <label for="renewPassword"
                                                        class="col-sm-2 col-form-label text-end fw-semibold">Re-enter
                                                        Password</label>
                                                    <div class="col-sm-6">
                                                        <input name="password_confirmation" type="password"
                                                            class="form-control" id="renewPassword"
                                                            placeholder="Re-enter Password" required>
                                                        @error('password_confirmation')
                                                            <div class="text-danger small">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6 offset-sm-2">
                                                        <button type="submit" class="btn btn-primary w-100">Save &
                                                            Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Change Password Tab End -->

                                    <!-- Edit Profile Tab start -->
                                    <div class="tab-pane fade height-100-p" id="editProfile" role="tabpanel">
                                        <div class="profile-setting">
                                            <div class="card shadow-sm">
                                                <div class="card-body">
                                                    <form id="edit-admin-form" action="{{ route('profile.update') }}"
                                                        method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">
                                                            <!-- Profile Image Upload -->
                                                            <div class="col-md-12 text-center mb-3">
                                                                <div class="d-flex flex-column align-items-center">
                                                                    <img class="profileImagePreview rounded-circle border"
                                                                        src="{{ $adminDetails->image_url }}"
                                                                        alt="Profile"
                                                                        style="width: 100px; height: 100px; object-fit: cover;">
                                                                    <div class="mt-2">
                                                                        <label class="btn btn-sm btn-primary">
                                                                            <i class="bi bi-upload"></i> Upload
                                                                            <input type="file" name="profile_image"
                                                                                id="profileImageInput"
                                                                                class="d-none profileImageInput"
                                                                                accept="image/*">
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- Full Name -->
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">First Name</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="first_name" id="first_name"
                                                                    value="{{ old('first_name', $adminDetails->first_name) }}" />
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Last Name</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="last_name" id="last_name"
                                                                    value="{{ old('last_name', $adminDetails->last_name) }}" />
                                                            </div>

                                                            <!-- Email (Read-Only) -->
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">e-Mail</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="email" id="email"
                                                                    value="{{ old('email', $adminDetails->email) }}"
                                                                    readonly />
                                                            </div>

                                                            <!-- Address -->
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Address</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="address" id="address" placeholder="Address"
                                                                    value="{{ old('address', $adminDetails->userDetails->address ?? '') }}" />
                                                            </div>

                                                            <!-- Phone -->
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Phone</label>
                                                                <input class="form-control form-control-lg" type="number"
                                                                    name="phone" id="phone"
                                                                    placeholder="Phone Number"
                                                                    value="{{ old('phone', $adminDetails->userDetails->phone ?? '') }}" />
                                                            </div>

                                                            <!-- City, State, Country -->
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">City</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="city" id="city" placeholder="City"
                                                                    value="{{ old('city', $adminDetails->userDetails->city ?? '') }}" />
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">State</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="state" id="state" placeholder="State"
                                                                    value="{{ old('state', $adminDetails->userDetails->state ?? '') }}" />
                                                            </div>
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Country</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="country" id="country" placeholder="Country"
                                                                    value="{{ old('country', $adminDetails->userDetails->country ?? '') }}" />
                                                            </div>

                                                            <!-- Zipcode -->
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Zipcode</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="zipcode" id="zipcode" placeholder="Zipcode"
                                                                    value="{{ old('zipcode', $adminDetails->userDetails->zipcode ?? '') }}" />
                                                            </div>
                                                            <!-- Agency Name -->
                                                            <div class="col-md-6 mb-3">
                                                                <label class="form-label">Agency Name</label>
                                                                <input class="form-control form-control-lg" type="text"
                                                                    name="agency_name" id="agency_name"
                                                                    placeholder="Agency Name"
                                                                    value="{{ old('agency_name', $adminDetails->userDetails->agency_name ?? '') }}" />
                                                            </div>
                                                            <!-- Description -->
                                                            <div class="col-md-12 mb-3">
                                                                <label class="form-label">Description</label>
                                                                <textarea class="form-control form-control-lg" name="description" id="description" placeholder="Description">{{ old('description', $adminDetails->userDetails->description ?? '') }}</textarea>
                                                            </div>
                                                            <!-- Submit Button -->
                                                            <div class="col-md-12 text-center mt-3">
                                                                <button type="submit" class="btn btn-lg btn-primary">
                                                                    <i class="bi bi-save"></i> Save & Update
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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
                // ignore: "#hidden",
                rules: {
                    first_name: {
                        required: true,
                        minlength: 2
                    },
                    last_name: {
                        required: true,
                        minlength: 2
                    },
                    address: {
                        // required: true,
                        maxlength: 50
                    },
                    phone: {
                        // required: true,
                        digits: true,
                        minlength: 10
                    },
                    city: {
                        // required: true,
                        maxlength: 20
                    },
                    state: {
                        // required: true,
                        maxlength: 20
                    },
                    country: {
                        // required: true,
                        maxlength: 20
                    },
                    zipcode: {
                        // required: true,
                        digits: true,
                        minlength: 6
                    },
                    agency_name: {
                        // required: true,
                        maxlength: 50
                    },
                    description: {
                        // required: true,
                        maxlength: 100
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
                    address: {
                        // required: "Please enter your address",
                        maxlength: "Your address must be less than 50 characters long"
                    },
                    phone: {
                        // required: "Please enter your phone number",
                        digits: "Please enter a valid phone number",
                        minlength: "Your phone number must be at least 10 digits long"
                    },
                    city: {
                        // required: "Please enter your city",
                        maxlength: "Your city name must be less than 10 characters long"
                    },
                    state: {
                        // required: "Please enter your state",
                        maxlength: "Your state name must be less than 10 characters long"
                    },
                    country: {
                        // required: "Please enter your country",
                        maxlength: "Your country name must be less than 10 characters long"
                    },
                    zipcode: {
                        // required: "Please enter your zipcode",
                        digits: "Please enter a valid zipcode",
                        minlength: "Your zipcode must be at least 6 digits long"
                    },
                    agency_name: {
                        // required: "Please enter your agency name",
                        maxlength: "Your agency name must be less than 50 characters long"
                    },
                    description: {
                        // required: "Please enter your description",
                        maxlength: "Your description must be less than 100 characters long"
                    },
                    profile_image: {
                        required: "Please upload a profile image",
                        extension: "Invalid file type. Only JPEG, PNG files are allowed"
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
