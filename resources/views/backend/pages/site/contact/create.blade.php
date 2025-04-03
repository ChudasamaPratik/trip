@extends('backend.layout.main')
@section('title', 'Create Contact')
@push('styles')
    <link href="{{ asset('backend/lib/summernote/summernote-lite.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Create Contact</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Contact us</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Create Contact
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('contact.index') }}">
                            <i class="fa fa-list"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <div class="pull-left">
                    <h4 class="text-blue h4">Contact Information</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('contact.store') }}" id="contactForm">
                @csrf
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">e-Mail <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('email') is-invalid @enderror" name="email" type="email"
                            placeholder="Enter e-mail" value="{{ old('email') }}" />
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Phone <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('phone') is-invalid @enderror" name="phone" type="number"
                            placeholder="Enter Phone" value="{{ old('phone') }}" />
                        @error('Phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Address<span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('address') is-invalid @enderror" name="address" type="text"
                            placeholder="Enter Address" value="{{ old('address') }}" />
                        @error('address')
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
                            placeholder="Enter destination description" rows="5">{{ old('description') }}</textarea>
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
                            <i class="fa fa-save"></i> Save Contact
                        </button>
                    </div>
                </div>
            </form>
        </div>
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

            // Custom validation method for Summernote fields
            $.validator.addMethod("summernoteNotEmpty", function(value, element) {
                var content = $(element).summernote('isEmpty') ? '' : $(element).val().trim();
                return content.length > 0;
            }, "Please enter a description");

            // Form validation
            $("#contactForm").validate({
                ignore: [],
                rules: {
                    email: {
                        required: true,
                    },
                    phone: {
                        required: true,
                        maxlength: 10
                    },
                    address: {
                        required: true,
                        maxlength: 50
                    },
                    description: {
                        required: true,
                        summernoteNotEmpty: true
                    }
                },
                messages: {
                    email: {
                        required: "Please enter a e-Mail"
                    },
                    phone: {
                        required: "Please enter a Phone",
                        maxlength: "Cannot exceed 10 Digit"
                    },
                    address: {
                        required: "Please enter a Address",
                        maxlength: "Cannot exceed 50 Character"
                    },
                    description: {
                        summernoteNotEmpty: "Please enter a description"
                    },
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
                    if ($(element).hasClass("summernote")) {
                        $(element).siblings('.note-editor').addClass("border-danger").removeClass(
                            "border-success");
                    }
                },
                unhighlight: function(element) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                    if ($(element).hasClass("summernote")) {
                        $(element).siblings('.note-editor').addClass("border-success").removeClass(
                            "border-danger");
                    }
                }
            });

            // Trigger validation on Summernote content change
            $('#summernote').on('summernote.change',
                function() {
                    $("#contactForm").validate().element($(this));
                });
        });
    </script>
@endpush
