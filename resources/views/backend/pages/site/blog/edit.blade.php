@extends('backend.layout.main')
@section('title', 'Edit Blog')

@push('styles')
    <link href="{{ asset('backend/lib/summernote/summernote-lite.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Edit Blog</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Site Manage</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('blog.index') }}">Blog</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit Blog
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('blog.index') }}">
                            <i class="fa fa-list"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <div class="pull-left">
                    <h4 class="text-blue h4">Blog Information</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('blog.update', $blog->id) }}" enctype="multipart/form-data"
                id="blogForm">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Title <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('title') is-invalid @enderror" name="title" type="text"
                            placeholder="Enter blog title" value="{{ old('title', $blog->title) }}" />
                        @error('title')
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
                                id="blogImage" name="image" accept="image/*">
                            <label class="custom-file-label" for="blogImage">Choose new image (optional)</label>
                            <small class="form-text text-muted">Image Size Should Be 1900x600 PX</small>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-3" id="imagePreviewContainer"
                            style="{{ $blog->image ? 'display: block;' : 'display: none;' }}">
                            <img id="imagePreview" src="{{ $blog->image ? asset('storage/blog/' . $blog->image) : '#' }}"
                                alt="Image Preview" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Content <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <textarea id="content" class="form-control summernote @error('content') is-invalid @enderror" name="content"
                            placeholder="Enter blog content" rows="5">{{ old('content', $blog->description) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Update Blog
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
            // Initialize Summernote editors
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
            $("#blogImage").change(function() {
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
                    // Don't hide the container on edit page if there's an existing image
                    if (!preview.attr('src') || preview.attr('src') === '#') {
                        preview.attr('src', '');
                        container.hide();
                    }
                    fileLabel.text('Choose new image (optional)');
                }
            }

            // Form validation
            $("#blogForm").validate({
                ignore: [],
                rules: {
                    title: {
                        required: true,
                        minlength: 3,
                        maxlength: 200
                    },
                    content: {
                        summernoteNotEmpty: true
                    }
                },
                messages: {
                    title: {
                        required: "Please enter a blog title",
                        minlength: "Title must be at least 3 characters long",
                        maxlength: "Title cannot be more than 200 characters long"
                    },
                    content: {
                        summernoteNotEmpty: "Please enter blog content"
                    }
                },
                errorElement: "div",
                errorClass: "text-danger",
                errorPlacement: function(error, element) {
                    if (element.hasClass("summernote")) {
                        error.insertAfter(element.siblings(".note-editor"));
                    } else if (element.hasClass("custom-file-input")) {
                        error.insertAfter(element.parent());
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
                $("#blogForm").validate().element($(this));
            });
        });
    </script>
@endpush
