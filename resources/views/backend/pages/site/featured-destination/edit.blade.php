@extends('backend.layout.main')
@section('title', 'Edit Featured Destination')

@push('styles')
    <link href="{{ asset('backend/lib/summernote/summernote-lite.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Edit Featured Destination</h4>
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
                                Edit Featured Destination
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
            <form method="POST" action="{{ route('featured-destination.update', $featuredDestination->id) }}" enctype="multipart/form-data"
                id="destinationForm">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Name <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('name') is-invalid @enderror" name="name" type="text"
                            placeholder="Enter destination name" value="{{ old('name', $featuredDestination->name) }}" />
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
                            placeholder="Enter hotel information" value="{{ old('hotel', $featuredDestination->hotel) }}" />
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
                            placeholder="Enter rental information" value="{{ old('rental', $featuredDestination->rental) }}" />
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
                            placeholder="Enter tour information" value="{{ old('tour', $featuredDestination->tour) }}" />
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
                        <input class="form-control @error('activities') is-invalid @enderror" name="activities"
                            type="text" placeholder="Enter activities information" value="{{ old('activities', $featuredDestination->activities) }}" />
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
                        <textarea id="summernote" class="form-control summernote @error('description') is-invalid @enderror" name="description"
                            placeholder="Enter destination description" rows="5">{{ old('description', $featuredDestination->description) }}</textarea>
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
                                id="destinationImage" name="image" accept="image/*">
                            <label class="custom-file-label" for="destinationImage">Choose file</label>
                            <small class="form-text text-muted">Image Size Should Be 1900x600 PX</small>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-3" id="imagePreviewContainer" style="display: {{ $featuredDestination->image_url ? 'block' : 'none' }};">
                            <img id="imagePreview" src="{{ $featuredDestination->image_url ? $featuredDestination->image_url : '#' }}" 
                                alt="Destination Preview" class="img-thumbnail" style="max-height: 300px;">
                        </div>
                        @if($featuredDestination->image_url)
                        <div class="mt-2">
                            <small class="text-muted">Current image will be used if no new image is selected</small>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Update Featured Destination
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
                    @if($featuredDestination->image_url)
                    preview.attr('src', '{{ $featuredDestination->image_url }}');
                    previewContainer.show();
                    @else
                    preview.attr('src', '');
                    previewContainer.hide();
                    @endif
                    fileLabel.text('Choose file');
                }
            });
            
            // Form validation
            $("#destinationForm").validate({
                ignore: [], 
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
                        summernoteNotEmpty: true,
                        maxlength: 500
                    },
                    image: {
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
                },
            });

            // Add additional validation method for file extensions
            $.validator.addMethod("extension", function(value, element, param) {
                param = typeof param === "string" ? param.replace(/,/g, "|") : "png|jpe?g|gif";
                return this.optional(element) || value.match(new RegExp("\\.(" + param + ")$", "i"));
            }, "Please select a file with a valid extension.");

            $.validator.addMethod("summernoteNotEmpty", function(value, element) {
                var $element = $('#' + element.id);
                if ($element.hasClass('summernote') || $element.data('summernote')) {
                    return !$element.summernote('isEmpty');
                }
                return true;
            }, "This field is required.");


            $('#summernote')
                .on('summernote.change', function() {
                    $("#destinationForm").validate().element($(this));
                });
        });
    </script>
@endpush