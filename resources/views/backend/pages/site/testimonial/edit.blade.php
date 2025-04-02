@extends('backend.layout.main')
@section('title', 'Edit Testimonial')

@push('styles')
    <link href="{{ asset('backend/lib/summernote/summernote-lite.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Edit Testimonial</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Site Manage</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('testimonial.index') }}">Testimonials</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit Testimonial
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('testimonial.index') }}">
                            <i class="fa fa-list"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <div class="pull-left">
                    <h4 class="text-blue h4">Testimonial Information</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('testimonial.update', $testimonial->id) }}" enctype="multipart/form-data"
                id="testimonialForm">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">First Name <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                            type="text" placeholder="Enter first name" value="{{ old('first_name', $testimonial->first_name) }}" />
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
                            placeholder="Enter last name" value="{{ old('last_name', $testimonial->last_name) }}" />
                        @error('last_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Rating <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('rating') is-invalid @enderror" name="rating" 
                            type="number" min="1" max="5" step="0.1" placeholder="Enter rating (1-5)" 
                            value="{{ old('rating', $testimonial->rating) }}" />
                        <small class="form-text text-muted">Enter a value between 1 and 5</small>
                        @error('rating')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Image</label>
                    <div class="col-sm-12 col-md-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                id="testimonialImage" name="image" accept="image/*">
                            <label class="custom-file-label" for="testimonialImage">Choose image</label>
                            <small class="form-text text-muted">Image Size Should Be 740x390 PX</small>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-3" id="imageContainer">
                            @if($testimonial->image_url)
                                <img id="imageDisplay" src="{{ $testimonial->image_url }}" alt="Testimonial Image" class="img-thumbnail" style="max-height: 200px;">
                            @else
                                <img id="imageDisplay" src="#" alt="Testimonial Image" class="img-thumbnail" style="max-height: 200px; display: none;">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Description <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <textarea id="description" class="form-control summernote @error('description') is-invalid @enderror" name="description"
                            placeholder="Enter testimonial description" rows="5">{{ old('description', $testimonial->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Update Testimonial
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('backend/lib/summernote/summernote.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize Summernote editor
            $('.summernote').summernote({
                tabsize: 2,
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Image preview functionality
            $("#testimonialImage").change(function() {
                previewImage(this);
            });

            function previewImage(input) {
                var fileLabel = $(input).next('.custom-file-label');
                var imageDisplay = $('#imageDisplay');

                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        imageDisplay.attr('src', e.target.result);
                        imageDisplay.show();
                        fileLabel.text(input.files[0].name);
                    }

                    reader.readAsDataURL(input.files[0]);
                } else {
                    // If no new file is selected, show the original image if it exists
                    @if($testimonial->image_url)
                        imageDisplay.attr('src', "{{ $testimonial->image_url }}");
                        imageDisplay.show();
                    @else
                        imageDisplay.attr('src', '');
                        imageDisplay.hide();
                    @endif
                    fileLabel.text('Choose file');
                }
            }

            // Form validation
            $("#testimonialForm").validate({
                ignore: [],
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
                    rating: {
                        required: true,
                        number: true,
                        min: 1,
                        max: 5
                    },
                    description: {
                        summernoteNotEmpty: true
                    },
                    image: {
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
                    rating: {
                        required: "Please enter a rating",
                        number: "Please enter a valid number",
                        min: "Rating must be at least 1",
                        max: "Rating cannot be more than 5"
                    },
                    description: {
                        summernoteNotEmpty: "Please enter a description"
                    },
                    image: {
                        extension: "Please select a valid image file (jpg, jpeg, png, or gif)"
                    }
                },
                errorElement: "div",
                errorClass: "text-danger",
                errorPlacement: function(error, element) {
                    if (element.hasClass("summernote")) {
                        error.insertAfter(element.siblings(".note-editor"));
                    } else if (element.hasClass("custom-file-input")) {
                        error.insertAfter(element.parent());
                    } else if (element.hasClass("custom-control-input")) {
                        error.insertAfter(element.parent().parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                    if ($(element).hasClass('summernote')) {
                        $(element).next('.note-editor').addClass("border-danger").removeClass(
                            "border-success");
                    }
                },
                unhighlight: function(element) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                    if ($(element).hasClass('summernote')) {
                        $(element).next('.note-editor').addClass("border-success").removeClass(
                            "border-danger");
                    }
                },
            });

            // Add additional validation method for file extensions
            $.validator.addMethod("extension", function(value, element, param) {
                param = typeof param === "string" ? param.replace(/,/g, "|") : "png|jpe?g|gif";
                return this.optional(element) || value.match(new RegExp("\\.(" + param + ")$", "i"));
            }, "Please select a file with a valid extension.");

            // Add validation method for Summernote not empty
            $.validator.addMethod("summernoteNotEmpty", function(value, element) {
                var $element = $(element);
                if ($element.hasClass('summernote')) {
                    return !$element.summernote('isEmpty');
                }
                return true;
            }, "This field is required.");

            // Validate Summernote on change
            $('.summernote').on('summernote.change', function() {
                $("#testimonialForm").validate().element($(this));
            });
        });
    </script>
@endpush