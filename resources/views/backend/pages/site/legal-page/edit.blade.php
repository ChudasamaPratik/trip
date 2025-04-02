@extends('backend.layout.main')
@section('title', 'Edit Legal Page')

@push('styles')
    <link href="{{ asset('backend/lib/summernote/summernote-lite.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Edit Legal Page</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Site Manage</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('legal-page.index') }}">Legal Pages</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit Legal Page
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('legal-page.index') }}">
                            <i class="fa fa-list"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <div class="pull-left">
                    <h4 class="text-blue h4">Legal Page Information</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('legal-page.update', $legalPage->id) }}" id="legalPageForm">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Type <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <select class="form-control @error('type') is-invalid @enderror" name="type">
                            <option value="">Select Type</option>
                            <option value="privacy_policy"
                                {{ old('type', $legalPage->type) == 'privacy_policy' ? 'selected' : '' }}>Privacy Policy
                            </option>
                            <option value="terms_of_use"
                                {{ old('type', $legalPage->type) == 'terms_of_use' ? 'selected' : '' }}>Terms of Use
                            </option>
                        </select>
                        @error('type')
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
                            placeholder="Enter legal page title" value="{{ old('title', $legalPage->title) }}" />
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
                        <textarea id="description" class="form-control summernote @error('description') is-invalid @enderror" name="description"
                            placeholder="Enter legal page description" rows="5">{{ old('description', $legalPage->description) }}</textarea>
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
                            <i class="fa fa-save"></i> Update Legal Page
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
                height: 400,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Form validation
            $("#legalPageForm").validate({
                ignore: [],
                rules: {
                    type: {
                        required: true
                    },
                    title: {
                        required: true,
                        minlength: 5,
                        maxlength: 255
                    },
                    description: {
                        summernoteNotEmpty: true
                    }
                },
                messages: {
                    type: {
                        required: "Please select a legal page type"
                    },
                    title: {
                        required: "Please enter a title",
                        minlength: "Title must be at least 5 characters long",
                        maxlength: "Title cannot be more than 255 characters long"
                    },
                    description: {
                        summernoteNotEmpty: "Please provide a description"
                    }
                },
                errorElement: "div",
                errorClass: "text-danger",
                errorPlacement: function(error, element) {
                    if (element.hasClass("summernote")) {
                        error.insertAfter(element.siblings(".note-editor"));
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
                $("#legalPageForm").validate().element($(this));
            });
        });
    </script>
@endpush
