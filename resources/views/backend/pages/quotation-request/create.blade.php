@extends('backend.layout.main')
@section('title', 'Create Quotation')

@push('styles')
    <link href="{{ asset('backend/lib/summernote/summernote-lite.css') }}" rel="stylesheet">
    <style>
        .detail-card {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .detail-label {
            font-weight: bold;
            color: #666;
        }

        .detail-value {
            color: #333;
        }

        .requirement-image {
            max-height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .badge-custom {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 13px;
        }
    </style>
@endpush

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Create Quotation</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Requirements</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('quotation.request.index') }}">User Requirements</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Create Quotation
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('quotation.request.index') }}">
                            <i class="fa fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Requirement Details Card -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4 mb-3">Requirement Details</h4>
                <div class="row">
                    <div class="col-md-3 text-center mb-3">
                        <img src="{{ $quotation->requirement->image_url }}" alt="Requirement Image"
                            class="img-fluid requirement-image">
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="detail-card">
                                    <div class="detail-label">Origin</div>
                                    <div class="detail-value">{{ $quotation->requirement->origin }}</div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="detail-card">
                                    <div class="detail-label">Destination</div>
                                    <div class="detail-value">{{ $quotation->requirement->destination }}</div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="detail-card">
                                    <div class="detail-label">Days & Persons</div>
                                    <div class="detail-value">{{ $quotation->requirement->days }} Days /
                                        {{ $quotation->requirement->person }} Persons</div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="detail-card">
                                    <div class="detail-label">Accommodation Type</div>
                                    <div class="detail-value">{{ $quotation->requirement->accommodation }}</div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="detail-card">
                                    <div class="detail-label">Breakfast</div>
                                    <div class="detail-value">
                                        <span
                                            class="badge badge-custom {{ $quotation->requirement->breakfast == 'Yes' ? 'badge-success' : 'badge-danger' }}">
                                            {{ $quotation->requirement->breakfast }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="detail-card">
                                    <div class="detail-label">Tour</div>
                                    <div class="detail-value">
                                        <span
                                            class="badge badge-custom {{ $quotation->requirement->tour == 'Yes' ? 'badge-success' : 'badge-danger' }}">
                                            {{ $quotation->requirement->tour }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="detail-card">
                                    <div class="detail-label">Budget</div>
                                    <div class="detail-value">{{ $quotation->requirement->price }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quotation Form Card -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <div class="pull-left">
                    <h4 class="text-blue h4">Quotation Information</h4>
                    <p class="mb-30">Please provide details for your quotation</p>
                </div>
            </div>
            <form method="POST" action="{{ route('quotation.request.store', $quotation->id) }}"
                enctype="multipart/form-data" id="quotationForm">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Price <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('price') is-invalid @enderror" name="price" type="number"
                            placeholder="Enter your quotation price" value="{{ old('price') }}" />
                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Description <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <textarea class="form-control summernote @error('description') is-invalid @enderror" name="description"
                            placeholder="Enter detailed description of your quotation" rows="5">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Attachment <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input @error('attachment') is-invalid @enderror"
                                id="quotationAttachment" name="attachment" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png"
                                required>
                            <label class="custom-file-label" for="quotationAttachment">Choose file</label>
                            <small class="form-text text-muted">Accepted formats: PDF, DOC, DOCX, JPG, JPEG, PNG (Max:
                                2MB)</small>
                        </div>
                        @error('attachment')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <div class="mt-3" id="attachmentPreviewContainer" style="display: none;">
                            <img id="attachmentPreview" src="#" alt="Attachment Preview" class="img-thumbnail"
                                style="max-height: 200px;">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-paper-plane"></i> Submit Quotation
                        </button>
                        <a href="{{ route('quotation.request.index') }}" class="btn btn-secondary">
                            <i class="fa fa-times"></i> Cancel
                        </a>
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

            // File input
            $("#quotationAttachment").change(function() {
                previewImage(this, '#attachmentPreview', '#attachmentPreviewContainer');
            });

            // Form validation
            $("#quotationForm").validate({
                ignore: [],
                rules: {
                    price: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    description: {
                        summernoteNotEmpty: true
                    },
                    attachment: {
                        required: true,
                        extension: "pdf|doc|docx|jpg|jpeg|png"
                    }
                },
                messages: {
                    price: {
                        required: "Please enter a price",
                        number: "Please enter a valid price",
                        min: "Price must be greater than zero"
                    },
                    description: {
                        summernoteNotEmpty: "Please enter a description"
                    },
                    attachment: {
                        required: "Please upload an attachment",
                        extension: "Please upload a valid file (PDF, DOC, DOCX, JPG, JPEG, PNG)"
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
                $("#quotationForm").validate().element($(this));
            });

            // Image preview functionality
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
        });
    </script>
@endpush
