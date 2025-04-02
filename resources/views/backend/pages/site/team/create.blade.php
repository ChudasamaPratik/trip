@extends('backend.layout.main')
@section('title', 'Add Team Member')

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Add Team Member</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Site Manage</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('team.index') }}">Team Members</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add Team Member
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('team.index') }}">
                            <i class="fa fa-list"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <div class="pull-left">
                    <h4 class="text-blue h4">Team Member Information</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('team.store') }}" enctype="multipart/form-data"
                id="teamForm">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">First Name <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                            type="text" placeholder="Enter first name" value="{{ old('first_name') }}" />
                        @error('first_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Last Name <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('last_name') is-invalid @enderror" name="last_name" type="text"
                            placeholder="Enter last name" value="{{ old('last_name') }}" />
                        @error('last_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Designation <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('designation') is-invalid @enderror" name="designation" type="text"
                            placeholder="Enter designation" value="{{ old('designation') }}" />
                        @error('designation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Image <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                id="teamImage" name="image" accept="image/*">
                            <label class="custom-file-label" for="teamImage">Choose image</label>
                            <small class="form-text text-muted">Recommended image size: 400x400 pixels (square)</small>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-3" id="imagePreviewContainer" style="display: none;">
                            <img id="imagePreview" src="#" alt="Image Preview" class="img-thumbnail"
                                style="max-height: 200px;">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save Team Member
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Image preview functionality
            $("#teamImage").change(function() {
                previewImage(this, '#imagePreview', '#imagePreviewContainer');
            });

            function previewImage(input, previewId, containerId) {
                var preview = $(previewId);
                var container = $(containerId);
                var fileLabel = $(input).next('.custom-file-label');

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        preview.attr('src', e.target.result);
                        container.show();
                        fileLabel.text(input.files[0].name);
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.attr('src', '');
                    container.hide();
                    fileLabel.text('Choose file');
                }
            }

            // Form validation
            $("#teamForm").validate({
                rules: {
                    first_name: {
                        required: true,
                        minlength: 2,
                        maxlength: 100
                    },
                    last_name: {
                        required: true,
                        minlength: 2,
                        maxlength: 100
                    },
                    designation: {
                        required: true,
                        maxlength: 100
                    },
                    image: {
                        required: true,
                        extension: "jpg|jpeg|png|gif"
                    }
                },
                messages: {
                    first_name: {
                        required: "Please enter first name",
                        minlength: "First name must be at least 2 characters long",
                        maxlength: "First name cannot be more than 100 characters long"
                    },
                    last_name: {
                        required: "Please enter last name",
                        minlength: "Last name must be at least 2 characters long",
                        maxlength: "Last name cannot be more than 100 characters long"
                    },
                    designation: {
                        required: "Please enter designation",
                        maxlength: "Designation cannot be more than 100 characters long"
                    },
                    image: {
                        required: "Please select an image",
                        extension: "Please select a valid image file (jpg, jpeg, png, or gif)"
                    }
                },
                errorElement: "div",
                errorClass: "text-danger",
                errorPlacement: function(error, element) {
                    if (element.hasClass("custom-file-input")) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function(element) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                },
            });

            // Add additional validation method for file extensions
            $.validator.addMethod("extension", function(value, element, param) {
                param = typeof param === "string" ? param.replace(/,/g, "|") : "png|jpe?g|gif";
                return this.optional(element) || value.match(new RegExp("\\.(" + param + ")$", "i"));
            }, "Please select a file with a valid extension.");
        });
    </script>
@endpush