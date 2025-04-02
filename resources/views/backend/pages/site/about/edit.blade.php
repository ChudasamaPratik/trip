@extends('backend.layout.main')
@section('title', 'Edit About')
@push('styles')
    <link href="{{ asset('backend/lib/summernote/summernote-lite.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Edit About</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Manage About us</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('slider.index') }}">About us</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit About us
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('about.index') }}">
                            <i class="fa fa-list"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <div class="pull-left">
                    <h4 class="text-blue h4">About us Information</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('about.update', $slider->id) }}" enctype="multipart/form-data"
                id="aboutForm">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Main Title <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('main_title') is-invalid @enderror" name="main_title"
                            type="text" placeholder="Enter About title"
                            value="{{ old('main_title', $slider->main_title) }}" />
                        @error('main_title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Title <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('title') is-invalid @enderror" name="title" type="text"
                            placeholder="Enter About title" value="{{ old('title', $slider->title) }}" />
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Description <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <textarea id="summernote" class="form-control summernote @error('description') is-invalid @enderror" name="description"
                            placeholder="Enter destination description" rows="5">{{ old('description', $slider->description) }}</textarea>
                        <div id="description-error" class="text-danger" style="display: none;"></div>
                        @error('description')
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
                                id="aboutImage" name="image" accept="image/*">
                            <label class="custom-file-label" for="aboutImage">Choose file</label>
                            <small class="form-text text-muted">Image Size Should Be 1900x600 PX</small>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-3" id="imagePreviewContainer"
                            style="{{ $slider->image ? 'display: block;' : 'display: none;' }}">
                            <img id="imagePreview" src="{{ $slider->image_url }}" alt="about Preview" class="img-thumbnail"
                                style="max-height: 300px;">
                        </div>
                        @if ($slider->image)
                            <div class="mt-2">
                                <small class="text-muted">Current image: {{ $slider->image }}</small>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Update About
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
            $('#summernote').summernote({
                tabsize: 2,
                height: 120,
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
            $("#aboutImage").change(function() {
                var preview = $("#imagePreview");
                var previewContainer = $("#imagePreviewContainer");
                var fileLabel = $(this).next('.custom-file-label');

                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        preview.attr('src', e.target.result);
                        previewContainer.show();
                        fileLabel.text($("#aboutImage")[0].files[0].name);
                    }

                    reader.readAsDataURL(this.files[0]);
                } else {
                    preview.attr('src', '{{ $slider->image_url }}');
                    previewContainer.show();
                    fileLabel.text('Choose file');
                }
            });

            // Form validation
            $("#aboutForm").validate({
                ignore: [],
                rules: {
                    main_title: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    title: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    description: {
                        summernoteNotEmpty: true,
                        maxlength: 1000
                    },
                    image: {
                        extension: "jpg|jpeg|png|gif"
                    }
                },
                messages: {
                    main_title: {
                        required: "Please enter a about title",
                        minlength: "Title must be at least 3 characters long",
                        maxlength: "Title cannot be more than 100 characters long"
                    },
                    title: {
                        required: "Please enter a about title",
                        minlength: "Title must be at least 3 characters long",
                        maxlength: "Title cannot be more than 100 characters long"
                    },
                    description: {
                        summernoteNotEmpty: "Please enter a description",
                        maxlength: "Description cannot be more than 500 characters long"
                    },
                    image: {
                        extension: "Please select a valid image file (jpg, jpeg, png, or gif)"
                    }
                },
                errorElement: "div",
                errorClass: "text-danger",
                errorPlacement: function(error, element) {
                    if (element.attr("id") === "summernote") {
                        error.insertAfter(element.siblings(".note-editor"));
                    } else if (element.hasClass("custom-file-input")) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                    if ($(element).attr('id') === 'summernote') {
                        $(element).next('.note-editor').addClass("border-danger").removeClass(
                            "border-success");
                    }
                },
                unhighlight: function(element) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                    if ($(element).attr('id') === 'summernote') {
                        $(element).next('.note-editor').addClass("border-success").removeClass(
                            "border-danger");
                    }
                }
            });

            // Add additional validation method for file extensions
            $.validator.addMethod("extension", function(value, element, param) {
                param = typeof param === "string" ? param.replace(/,/g, "|") : "png|jpe?g|gif";
                return this.optional(element) || value.match(new RegExp("\\.(" + param + ")$", "i"));
            }, "Please select a file with a valid extension.");

            // Add additional validation method for summernote not empty
            $.validator.addMethod("summernoteNotEmpty", function(value, element) {
                var $element = $('#' + element.id);
                if ($element.hasClass('summernote') || $element.data('summernote')) {
                    return !$element.summernote('isEmpty');
                }
                return true;
            }, "This field is required.");

            // Custom error message for summernote
            $('#summernote').on('summernote.change', function() {
                $("#aboutForm").validate().element($(this));
            });
        });
    </script>
@endpush
