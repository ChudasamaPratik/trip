@extends('backend.layout.main')
@section('title', 'Add FAQ')

@push('styles')
    <link href="{{ asset('backend/lib/summernote/summernote-lite.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Add FAQ</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Site Manage</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('faq.index') }}">FAQs</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Add FAQ
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('faq.index') }}">
                            <i class="fa fa-list"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <div class="pull-left">
                    <h4 class="text-blue h4">FAQ Information</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('faq.store') }}" id="faqForm">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Question <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('question') is-invalid @enderror" name="question"
                            type="text" placeholder="Enter FAQ question" value="{{ old('question') }}" />
                        @error('question')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Answer <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <textarea id="answer" class="form-control summernote @error('answer') is-invalid @enderror" name="answer"
                            placeholder="Enter FAQ answer" rows="5">{{ old('answer') }}</textarea>
                        @error('answer')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-12 col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Save FAQ
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
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            // Form validation
            $("#faqForm").validate({
                ignore: [],
                rules: {
                    question: {
                        required: true,
                        minlength: 5,
                        maxlength: 255
                    },
                    answer: {
                        summernoteNotEmpty: true
                    }
                },
                messages: {
                    question: {
                        required: "Please enter a question",
                        minlength: "Question must be at least 5 characters long",
                        maxlength: "Question cannot be more than 255 characters long"
                    },
                    answer: {
                        summernoteNotEmpty: "Please provide an answer"
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
                        $(element).next('.note-editor').addClass("border-danger").removeClass("border-success");
                    }
                },
                unhighlight: function(element) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                    if ($(element).hasClass('summernote')) {
                        $(element).next('.note-editor').addClass("border-success").removeClass("border-danger");
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
                $("#faqForm").validate().element($(this));
            });
        });
    </script>
@endpush