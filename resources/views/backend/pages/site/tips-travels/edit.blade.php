@extends('backend.layout.main')
@section('title', 'Edit Tips & Travels')

@push('styles')
    <link href="{{ asset('backend/lib/summernote/summernote-lite.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Edit Tips & Travels</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Site Manage</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('tips-and-travels.index') }}">Tips & Travels</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit Tips & Travels
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('tips-and-travels.index') }}">
                            <i class="fa fa-list"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <div class="pull-left">
                    <h4 class="text-blue h4">Tips & Travels Information</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('tips-and-travels.update', $tipsTravel->id) }}" enctype="multipart/form-data"
                id="tipsForm">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Place Name <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('place_name') is-invalid @enderror" name="place_name" type="text"
                            placeholder="Enter place name" value="{{ old('place_name', $tipsTravel->place_name) }}" />
                        @error('place_name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Thumbnail</label>
                    <div class="col-sm-12 col-md-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('thumbnail') is-invalid @enderror"
                                id="thumbnailImage" name="thumbnail" accept="image/*">
                            <label class="custom-file-label" for="thumbnailImage">Choose thumbnail</label>
                            <small class="form-text text-muted">Image Size Should Be 1900x600 PX</small>
                        </div>
                        @error('thumbnail')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-3" id="thumbnailPreviewContainer" style="{{ $tipsTravel->image ? '' : 'display: none;' }}">
                            <img id="thumbnailPreview" src="{{ $tipsTravel->image ? $tipsTravel->thumbnail_url : '#' }}" 
                                alt="Thumbnail Preview" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Description 1 <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <textarea id="description1" class="form-control summernote @error('description1') is-invalid @enderror" name="description1"
                            placeholder="Enter first description" rows="5">{{ old('description1', $tipsTravel->description1) }}</textarea>
                        @error('description1')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Image 1</label>
                    <div class="col-sm-12 col-md-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image1') is-invalid @enderror"
                                id="image1" name="image1" accept="image/*">
                            <label class="custom-file-label" for="image1">Choose image 1</label>
                            <small class="form-text text-muted">Image Size Should Be 1900x600 PX</small>
                        </div>
                        @error('image1')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-3" id="image1PreviewContainer" style="{{ $tipsTravel->image1 ? '' : 'display: none;' }}">
                            <img id="image1Preview" src="{{ $tipsTravel->image1 ? $tipsTravel->image1_url : '#' }}" 
                                alt="Image 1 Preview" class="img-thumbnail" style="max-height: 300px;">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Description 2 <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <textarea id="description2" class="form-control summernote @error('description2') is-invalid @enderror" name="description2"
                            placeholder="Enter second description" rows="5">{{ old('description2', $tipsTravel->description2) }}</textarea>
                        @error('description2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Image 2</label>
                    <div class="col-sm-12 col-md-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image2') is-invalid @enderror"
                                id="image2" name="image2" accept="image/*">
                            <label class="custom-file-label" for="image2">Choose image 2</label>
                            <small class="form-text text-muted">Image Size Should Be 1900x600 PX</small>
                        </div>
                        @error('image2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-3" id="image2PreviewContainer" style="{{ $tipsTravel->image2 ? '' : 'display: none;' }}">
                            <img id="image2Preview" src="{{ $tipsTravel->image2 ? $tipsTravel->image2_url : '#' }}" 
                                alt="Image 2 Preview" class="img-thumbnail" style="max-height: 300px;">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Update Tips & Travels
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

            // Image preview functionality for thumbnail
            $("#thumbnailImage").change(function() {
                previewImage(this, '#thumbnailPreview', '#thumbnailPreviewContainer');
            });

            // Image preview functionality for image1
            $("#image1").change(function() {
                previewImage(this, '#image1Preview', '#image1PreviewContainer');
            });

            // Image preview functionality for image2
            $("#image2").change(function() {
                previewImage(this, '#image2Preview', '#image2PreviewContainer');
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
                    // Don't clear the preview on edit page if no new file selected
                    if (!preview.attr('src') || preview.attr('src') === '#') {
                        container.hide();
                        fileLabel.text('Choose file');
                    }
                }
            }

            // Form validation
            $("#tipsForm").validate({
                ignore: [], 
                rules: {
                    place_name: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    description1: {
                        summernoteNotEmpty: true
                    },
                    description2: {
                        summernoteNotEmpty: true
                    },
                    thumbnail: {
                        extension: "jpg|jpeg|png|gif"
                    },
                    image1: {
                        extension: "jpg|jpeg|png|gif"
                    },
                    image2: {
                        extension: "jpg|jpeg|png|gif"
                    }
                },
                messages: {
                    place_name: {
                        required: "Please enter a place name",
                        minlength: "Place name must be at least 3 characters long",
                        maxlength: "Place name cannot be more than 100 characters long"
                    },
                    description1: {
                        summernoteNotEmpty: "Please enter the first description"
                    },
                    description2: {
                        summernoteNotEmpty: "Please enter the second description"
                    },
                    thumbnail: {
                        extension: "Please select a valid image file (jpg, jpeg, png, or gif)"
                    },
                    image1: {
                        extension: "Please select a valid image file (jpg, jpeg, png, or gif)"
                    },
                    image2: {
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
                $("#tipsForm").validate().element($(this));
            });
        });
    </script>
@endpush