@extends('backend.layout.main')
@section('title', 'Create Footer')
@push('styles')
    <link href="{{ asset('backend/lib/summernote/summernote-lite.css') }}" rel="stylesheet">
@endpush
@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Edit Footer</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Footers</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Edit Footer
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('footer.index') }}">
                            <i class="fa fa-list"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <div class="pull-left">
                    <h4 class="text-blue h4">Footer Information</h4>
                </div>
            </div>
            <form method="POST" action="{{ route('footer.update', $footer->id) }}" id="footerForm">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Facebook Link <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('facebook_link') is-invalid @enderror" name="facebook_link"
                            type="text" placeholder="Enter facebook link"
                            value="{{ old('facebook_link', $footer->facebook_link) }}" />
                        @error('facebook_link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Twitter Link <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('twitter_link') is-invalid @enderror" name="twitter_link"
                            type="text" placeholder="Enter twitter link"
                            value="{{ old('twitter_link', $footer->twitter_link) }}" />
                        @error('twitter_link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Instagram Link <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('instagram_link') is-invalid @enderror" name="instagram_link"
                            type="text" placeholder="Enter instagram link"
                            value="{{ old('instagram_link', $footer->instagram_link) }}" />
                        @error('instagram_link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Linkedin Link <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('linkedin_link') is-invalid @enderror" name="linkedin_link"
                            type="text" placeholder="Enter linkedin link"
                            value="{{ old('linkedin_link', $footer->linkedin_link) }}" />
                        @error('linkedin_link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Youtube Link <span class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('youtube_link') is-invalid @enderror" name="youtube_link"
                            type="text" placeholder="Enter youtube link"
                            value="{{ old('youtube_link', $footer->youtube_link) }}" />
                        @error('youtube_link')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Whatsapp Link <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <input class="form-control @error('whatsapp_link') is-invalid @enderror" name="whatsapp_link"
                            type="text" placeholder="Enter whatsapp link"
                            value="{{ old('whatsapp_link', $footer->whatsapp_link) }}" />
                        @error('whatsapp_link')
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
                            placeholder="Enter destination description" rows="5">{{ old('description', $footer->description) }}</textarea>
                        <div id="description-error" class="text-danger" style="display: none;"></div>
                        @error('description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">Declaimer Description <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <textarea id="declaimer_description_summernote"
                            class="form-control summernote @error('declaimer_description') is-invalid @enderror" name="declaimer_description"
                            placeholder="Enter destination description" rows="5">{{ old('declaimer_description', $footer->declaimer_description) }}</textarea>
                        <div id="description-error" class="text-danger" style="display: none;"></div>
                        @error('declaimer_description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-12 col-md-2 col-form-label">T&C Description <span
                            class="text-danger">*</span></label>
                    <div class="col-sm-12 col-md-10">
                        <textarea id="tc_description_summernote" class="form-control summernote @error('tc_description') is-invalid @enderror"
                            name="tc_description" placeholder="Enter TC description" rows="5">{{ old('tc_description', $footer->tc_description) }}</textarea>
                        <div id="description-error" class="text-danger" style="display: none;"></div>
                        @error('tc_description')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 col-md-10 offset-md-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Update Footer
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
            $('#summernote, #declaimer_description_summernote, #tc_description_summernote').summernote({
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
            }, "This field is required.");

            // Form validation
            $("#footerForm").validate({
                ignore: [],
                rules: {
                    facebook_link: {
                        minlength: 3,
                        maxlength: 100
                    },
                    twitter_link: {
                        minlength: 3,
                        maxlength: 100
                    },
                    instagram_link: {
                        minlength: 3,
                        maxlength: 100
                    },
                    linkedin_link: {
                        minlength: 3,
                        maxlength: 100
                    },
                    youtube_link: {
                        minlength: 3,
                        maxlength: 100
                    },
                    whatsapp_link: {
                        minlength: 3,
                        maxlength: 100
                    },
                    description: {
                        required: true,
                        summernoteNotEmpty: true
                    },
                    declaimer_description: {
                        required: true,
                        summernoteNotEmpty: true
                    },
                    tc_description: {
                        required: true,
                        summernoteNotEmpty: true
                    }
                },
                messages: {
                    facebook_link: {
                        minlength: "Must be at least 3 characters",
                        maxlength: "Cannot exceed 100 characters"
                    },
                    twitter_link: {
                        minlength: "Must be at least 3 characters",
                        maxlength: "Cannot exceed 100 characters"
                    },
                    instagram_link: {
                        minlength: "Must be at least 3 characters",
                        maxlength: "Cannot exceed 100 characters"
                    },
                    linkedin_link: {
                        minlength: "Must be at least 3 characters",
                        maxlength: "Cannot exceed 100 characters"
                    },
                    youtube_link: {
                        minlength: "Must be at least 3 characters",
                        maxlength: "Cannot exceed 100 characters"
                    },
                    whatsapp_link: {
                        minlength: "Must be at least 3 characters",
                        maxlength: "Cannot exceed 100 characters"
                    },
                    description: {
                        summernoteNotEmpty: "Please enter a description"
                    },
                    declaimer_description: {
                        summernoteNotEmpty: "Please enter a disclaimer description"
                    },
                    tc_description: {
                        summernoteNotEmpty: "Please enter terms and conditions"
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
            $('#summernote, #declaimer_description_summernote, #tc_description_summernote').on('summernote.change',
                function() {
                    $("#footerForm").validate().element($(this));
                });

        });
    </script>
@endpush
