@extends('backend.layout.main')
@section('title', 'Update Auction')

@push('styles')
    <link href="{{ asset('backend/lib/summernote/summernote-lite.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Update Auction</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Manage Auction</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('slider.index') }}">Auction</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Update Auction
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('auction.index') }}">
                            <i class="fa fa-list"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <div class="pull-left">
                    <h4 class="text-blue h4">Auction Information</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('auction.update', $auction->id) }}" enctype="multipart/form-data"
                id="auctionForm">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Title <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('title') is-invalid @enderror" name="title" type="text"
                            placeholder="Enter About title" value="{{ old('title', $auction->title) }}" />
                        @error('title')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Price <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('price') is-invalid @enderror" name="price" type="number"
                            placeholder="Enter Auction title" value="{{ old('price', $auction->price) }}" />
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Days <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('days') is-invalid @enderror" name="days" type="number"
                            placeholder="Enter Auction Day" value="{{ old('days', $auction->days) }}" />
                        @error('days')
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
                                id="aboutImage" name="image" accept="image/*">
                            <label class="custom-file-label" for="aboutImage">Choose file</label>
                            <small class="form-text text-muted">Image Size Should Be 1900x600 PX</small>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-3" id="imagePreviewContainer">
                            <img id="imagePreview" src="{{ $auction->image_url }}" alt="About Preview"
                                class="img-thumbnail" style="max-height: 300px;">
                        </div>
                        @if ($auction->image)
                            <div class="mt-2">
                                <small class="text-muted">Current image: {{ $auction->image }}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Description-1 <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <textarea id="summernote-description1" class="form-control summernote @error('description1') is-invalid @enderror"
                            name="description1" placeholder="Enter destination description" rows="5">{{ old('description1', $auction->description1) }}</textarea>
                        <div id="description-error" class="text-danger" style="display: none;"></div>
                        @error('description1')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Image-1 <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image1') is-invalid @enderror"
                                id="auctionImage1" name="image1" accept="image/*">
                            <label class="custom-file-label" for="auctionImage1">Choose file</label>
                            <small class="form-text text-muted">Image Size Should Be 1900x600 PX</small>
                        </div>
                        @error('image1')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-3" id="imagePreviewContainer1">
                            <img id="imagePreview1" src="{{ $auction->image_url1 }}" alt="Image-1 Preview"
                                class="img-thumbnail" style="max-height: 300px;">
                        </div>
                        @if ($auction->image1)
                            <div class="mt-2">
                                <small class="text-muted">Current image: {{ $auction->image1 }}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Description-2 <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <textarea id="summernote-description2" class="form-control summernote @error('description2') is-invalid @enderror"
                            name="description2" placeholder="Enter destination description" rows="5">{{ old('description2', $auction->description2) }}</textarea>
                        <div id="description-error" class="text-danger" style="display: none;"></div>
                        @error('description2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Image-2 <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image2') is-invalid @enderror"
                                id="auctionImage2" name="image2" accept="image/*">
                            <label class="custom-file-label" for="auctionImage2">Choose file</label>
                            <small class="form-text text-muted">Image Size Should Be 1900x600 PX</small>
                        </div>
                        @error('image2')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-3" id="imagePreviewContainer2">
                            <img id="imagePreview2" src="{{ $auction->image_url2 }}" alt="Image-1 Preview"
                                class="img-thumbnail" style="max-height: 300px;">
                        </div>
                        @if ($auction->image2)
                            <div class="mt-2">
                                <small class="text-muted">Current image: {{ $auction->image2 }}</small>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Update Auction
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

            // Description-1 Summernote
            $('#summernote-description1,#summernote-description2').summernote({
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
                    preview.attr('src', '');
                    previewContainer.hide();
                    fileLabel.text('Choose file');
                }
            });

            // Image-1 preview functionality
            $("#auctionImage1").change(function() {
                var preview = $("#imagePreview1");
                var previewContainer = $("#imagePreviewContainer1");
                var fileLabel = $(this).next('.custom-file-label');

                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        preview.attr('src', e.target.result);
                        previewContainer.show();
                        fileLabel.text($("#auctionImage1")[0].files[0].name);
                    }

                    reader.readAsDataURL(this.files[0]);
                } else {
                    preview.attr('src', '');
                    previewContainer.hide();
                    fileLabel.text('Choose file');
                }
            });
            // Image-2 preview functionality
            $("#auctionImage2").change(function() {
                var preview = $("#imagePreview2");
                var previewContainer = $("#imagePreviewContainer2");
                var fileLabel = $(this).next('.custom-file-label');

                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        preview.attr('src', e.target.result);
                        previewContainer.show();
                        fileLabel.text($("#auctionImage2")[0].files[0].name);
                    }

                    reader.readAsDataURL(this.files[0]);
                } else {
                    preview.attr('src', '');
                    previewContainer.hide();
                    fileLabel.text('Choose file');
                }
            });

            // Form validation
            $("#auctionForm").validate({
                ignore: [],
                rules: {
                    title: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    price: {
                        required: true,
                        number: true
                    },
                    days: {
                        required: true,
                        number: true
                    },
                    image: {

                        extension: "jpg|jpeg|png|gif"
                    },
                    description1: {
                        summernoteNotEmpty: true,
                        maxlength: 500
                    },
                    image1: {

                        extension: "jpg|jpeg|png|gif"
                    },
                    description2: {
                        summernoteNotEmpty: true,
                        maxlength: 500
                    },
                    image2: {

                        extension: "jpg|jpeg|png|gif"
                    },

                },
                messages: {
                    title: {
                        required: "Please enter a About title",
                        minlength: "Title must be at least 3 characters long",
                        maxlength: "Title cannot be more than 100 characters long"
                    },
                    price: {
                        required: "Please enter a price",
                        number: "Please enter a valid number"
                    },
                    days: {
                        required: "Please enter a days",
                        number: "Please enter a valid number"
                    },
                    image: {

                        extension: "Please select a valid image file (jpg, jpeg, png, or gif)"
                    },
                    description1: {
                        summernoteNotEmpty: "Please enter a description",
                        maxlength: "Description cannot be more than 500 characters long"
                    },
                    image1: {

                        extension: "Please select a valid image file (jpg, jpeg, png, or gif)"
                    },
                    description2: {
                        summernoteNotEmpty: "Please enter a description",
                        maxlength: "Description cannot be more than 500 characters long"
                    },
                    image2: {

                        extension: "Please select a valid image file (jpg, jpeg, png, or gif)"
                    },

                },
                errorElement: "div",
                errorClass: "text-danger",
                errorPlacement: function(error, element) {
                    if (element.attr("id") == "summernote-description1") {
                        error.insertAfter(element.siblings(".note-editor"));
                    } else if (element.attr("id") == "summernote-description2") {
                        error.insertAfter(element.siblings(".note-editor"));
                    } else if (element.hasClass("custom-file-input")) {
                        error.insertAfter(element.parent());
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function(element) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                    if ($(element).attr('id') == 'summernote-description1' || $(element).attr('id') ==
                        'summernote-description2') {
                        $(element).next('.note-editor').addClass("border-danger").removeClass(
                            "border-success");
                    }
                },
                unhighlight: function(element) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                    if ($(element).attr('id') === 'summernote-description1' || $(element).attr('id') ===
                        'summernote-description2') {
                        $(element).next('.note-editor').addClass("border-success").removeClass(
                            "border-danger");
                    }
                }
            });

            // Add additional validation method for file extensions
            $.validator.addMethod("extension", function(value, element, param) {
                    param = typeof param === "string" ? param.replace(/,/g, "|") : "png|jpe?g|gif";
                    return this.optional(element) || value.match(new RegExp("\\.(" + param + ")$", "i"));
                },
                "Please select a file with a valid extension.");

            // Add additional validation method for summernote not empty
            $.validator.addMethod("summernoteNotEmpty", function(value, element) {
                var $element = $('#' + element.id);
                if ($element.hasClass('summernote') || $element.data('summernote')) {
                    return !$element.summernote('isEmpty');
                }
                return true;
            }, "This field is required.");
            // Custom error message for summernote
            $('#summernote-description1', '#summernote-description1').on('summernote.change', function() {
                $("#auctionForm").validate().element($(this));
            });

        });
    </script>
@endpush
