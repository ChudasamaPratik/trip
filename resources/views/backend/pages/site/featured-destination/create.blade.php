@extends('backend.layout.main')
@section('title', 'Create Featured Destination')
@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Create Featured Destination</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Site Manage</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('featured-destination.index') }}">Featured Destination</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Create Featured Destination
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('featured-destination.index') }}">
                            <i class="fa fa-list"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <div class="pull-left">
                    <h4 class="text-blue h4">Featured Destination Information</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('featured-destination.store') }}" enctype="multipart/form-data" id="destinationForm">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('name') is-invalid @enderror" name="name" type="text"
                            placeholder="Enter destination name" value="{{ old('name') }}" />
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Hotel <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('hotel') is-invalid @enderror" name="hotel" type="text"
                            placeholder="Enter hotel information" value="{{ old('hotel') }}" />
                        @error('hotel')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Rental <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('rental') is-invalid @enderror" name="rental" type="text"
                            placeholder="Enter rental information" value="{{ old('rental') }}" />
                        @error('rental')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Tour <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('tour') is-invalid @enderror" name="tour" type="text"
                            placeholder="Enter tour information" value="{{ old('tour') }}" />
                        @error('tour')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Activities <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('activities') is-invalid @enderror" name="activities" type="text"
                            placeholder="Enter activities information" value="{{ old('activities') }}" />
                        @error('activities')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Description <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                            placeholder="Enter destination description" rows="5">{{ old('description') }}</textarea>
                        @error('description')
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
                                id="destinationImage" name="image" accept="image/*">
                            <label class="custom-file-label" for="destinationImage">Choose file</label>
                            <small class="form-text text-muted">Image Size Should Be 1900x600 PX</small>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-3" id="imagePreviewContainer" style="display: none;">
                            <img id="imagePreview" src="#" alt="Destination Preview" class="img-thumbnail"
                                style="max-height: 300px;">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save Featured Destination
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
            $("#destinationImage").change(function() {
                var preview = $("#imagePreview");
                var previewContainer = $("#imagePreviewContainer");
                var fileLabel = $(this).next('.custom-file-label');
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        preview.attr('src', e.target.result);
                        previewContainer.show();
                        fileLabel.text($("#destinationImage")[0].files[0].name);
                    }
                    reader.readAsDataURL(this.files[0]);
                } else {
                    preview.attr('src', '');
                    previewContainer.hide();
                    fileLabel.text('Choose file');
                }
            });
            // Form validation
            $("#destinationForm").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    hotel: {
                        required: true,
                        maxlength: 100
                    },
                    rental: {
                        required: true,
                        maxlength: 100
                    },
                    tour: {
                        required: true,
                        maxlength: 100
                    },
                    activities: {
                        required: true,
                        maxlength: 100
                    },
                    description: {
                        required: true,
                        maxlength: 500
                    },
                    image: {
                        required: true,
                        extension: "jpg|jpeg|png|gif"
                    }
                },
                messages: {
                    name: {
                        required: "Please enter a destination name",
                        minlength: "Name must be at least 3 characters long",
                        maxlength: "Name cannot be more than 100 characters long"
                    },
                    hotel: {
                        required: "Please enter hotel information",
                        maxlength: "Hotel information cannot be more than 100 characters long"
                    },
                    rental: {
                        required: "Please enter rental information",
                        maxlength: "Rental information cannot be more than 100 characters long"
                    },
                    tour: {
                        required: "Please enter tour information",
                        maxlength: "Tour information cannot be more than 100 characters long"
                    },
                    activities: {
                        required: "Please enter activities information",
                        maxlength: "Activities information cannot be more than 100 characters long"
                    },
                    description: {
                        required: "Please enter a description",
                        maxlength: "Description cannot be more than 500 characters long"
                    },
                    image: {
                        required: "Please select an image for the destination",
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
                submitHandler: function(form) {
                    form.submit();
                }
            });
            // Add additional validation method for file extensions
            $.validator.addMethod("extension", function(value, element, param) {
                param = typeof param === "string" ? param.replace(/,/g, "|") : "png|jpe?g|gif";
                return this.optional(element) || value.match(new RegExp("\\.(" + param + ")$", "i"));
            }, "Please select a file with a valid extension.");
        });
    </script>
@endpush