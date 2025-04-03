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
                        <h4>Edit How It Work</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Manage How It Work</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('how-does-it-work.index') }}">About us</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit About us
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('how-does-it-work.index') }}">
                            <i class="fa fa-list"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <div class="pull-left">
                    <h4 class="text-blue h4">How It Work Information</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('how-does-it-work.update', $How->id) }}" enctype="multipart/form-data"
                id="aboutForm">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Title <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('title') is-invalid @enderror" name="title" type="text"
                            placeholder="Enter About title" value="{{ old('title', $How->title) }}" />
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
                            placeholder="Enter destination description" rows="5">{{ old('description', $How->description) }}</textarea>
                        <div id="description-error" class="text-danger" style="display: none;"></div>
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
                            <i class="fa fa-save"></i> Update how it work
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
            // Form validation
            $("#howForm").validate({
                ignore: [],
                rules: {
                    title: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    description: {
                        required: true,
                        summernoteNotEmpty: true,
                    },
                },
                messages: {
                    title: {
                        required: "Please enter a about title",
                        minlength: "Title must be at least 3 characters long",
                        maxlength: "Title cannot be more than 100 characters long"
                    },
                    description: {
                        required: "Please enter a about title",
                        summernoteNotEmpty: "Please enter a description",
                    },
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
                $("#howForm").validate().element($(this));
            });
        });
    </script>
@endpush
