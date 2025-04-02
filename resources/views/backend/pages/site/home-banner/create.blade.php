@extends('backend.layout.main')
@section('title', 'Create Home Banner')
@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Create Home Banner</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Site Manage</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('home-banner.index') }}">Home Banner</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Create Home Banner
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('home-banner.index') }}">
                            <i class="fa fa-list"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <div class="pull-left">
                    <h4 class="text-blue h4">Home Banner Information</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('home-banner.store') }}" enctype="multipart/form-data" id="bannerForm">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Type <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <select class="form-control @error('type') is-invalid @enderror" name="type">
                            <option value="">Select Type</option>
                            <option value="top" {{ old('type') == 'top' ? 'selected' : '' }} {{ $exists['top'] ? 'disabled' : '' }}>
                                Top {{ $exists['top'] ? '(Exists)' : '' }}
                            </option>
                            <option value="bottom" {{ old('type') == 'bottom' ? 'selected' : '' }} {{ $exists['bottom'] ? 'disabled' : '' }}>
                                Bottom {{ $exists['bottom'] ? '(Exists)' : '' }}
                            </option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        @if($exists['top'] && $exists['bottom'])
                            <div class="text-danger mt-2">
                                <i class="fa fa-exclamation-circle"></i> 
                                Both banner types already exist. Please edit existing banners instead.
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Image <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('image') is-invalid @enderror"
                                id="bannerImage" name="image" accept="image/*">
                            <label class="custom-file-label" for="bannerImage">Choose file</label>
                            <small class="form-text text-muted">
                                Image Size Should Be 1900x600 PX
                            </small>
                        </div>
                        @error('image')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-3" id="imagePreviewContainer" style="display: none;">
                            <img id="imagePreview" src="#" alt="Home Banner Preview" class="img-thumbnail"
                                style="max-height: 300px;">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary" {{ $exists['top'] && $exists['bottom'] ? 'disabled' : '' }}>
                            <i class="fa fa-save"></i> Save Home Banner
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
            $("#bannerImage").change(function() {
                var preview = $("#imagePreview");
                var previewContainer = $("#imagePreviewContainer");
                var fileLabel = $(this).next('.custom-file-label');

                if (this.files && this.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        preview.attr('src', e.target.result);
                        previewContainer.show();
                        fileLabel.text($("#bannerImage")[0].files[0].name);
                    }

                    reader.readAsDataURL(this.files[0]);
                } else {
                    preview.attr('src', '');
                    previewContainer.hide();
                    fileLabel.text('Choose file');
                }
            });

            // Form validation
            $("#bannerForm").validate({
                rules: {
                    type: {
                        required: true
                    },
                    image: {
                        required: true,
                        extension: "jpg|jpeg|png|gif"
                    }
                },
                messages: {
                    type: {
                        required: "Please select a banner type"
                    },
                    image: {
                        required: "Please select an image for the banner",
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