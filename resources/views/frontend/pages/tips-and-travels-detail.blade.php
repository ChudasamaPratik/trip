@extends('frontend.layout.main')
@section('title', 'Tips and travels Details')

@section('content')
    <section class="breadcrumb-outer text-center">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Details</h2>
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>
    <section class="item-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="item-wrapper">
                        <div class="cover-content">
                            <h2>{{ $tipsTravel->place_name }}</h2>
                            <div class="author-detail">
                                <span><i class="fa fa-clock-o"></i> Posted On :
                                    {{ $tipsTravel->created_at->format('d M, Y') }}</span>
                            </div>
                        </div>
                        <div class="cover-image">
                            <img src="{{ $tipsTravel->image1_url }}" alt="{{ $tipsTravel->place_name }}">
                        </div>
                        <div class="item-detail">
                            <div class="articlepara">
                                {!! $tipsTravel->description1 !!}
                            </div>

                            @if ($tipsTravel->image2)
                                <div class="detail-image">
                                    <img src="{{ $tipsTravel->image2_url }}" alt="{{ $tipsTravel->place_name }}">
                                </div>
                            @endif

                            @if ($tipsTravel->description2)
                                <div class="articlepara">
                                    {!! $tipsTravel->description2 !!}
                                </div>
                            @endif
                        </div><br>

                        <div class="comment-form">
                            <form id="commentForm" method="POST" autocomplete="off">
                                <input type="hidden" name="cid" value="{{ $tipsTravel->id }}">
                                <h3>Leave a message</h3>
                                <div class="row">
                                    <div class="form-group col-lg-4">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" id="name" name="name">
                                    </div>
                                    <div class="form-group col-lg-4">
                                        <label for="email">Email address:</label>
                                        <input type="email" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="form-group col-lg-8">
                                        <label for="message">Your Message:</label>
                                        <textarea name="message" id="message"></textarea>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="comment-btn">
                                            <input type="submit" class="btn-blue btn-red" name="comment"
                                                value="Send Message">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // Configure toastr options
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right",
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };

            // Initialize jQuery Validation for the comment form
            $("#commentForm").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 2
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    message: {
                        required: true,
                        minlength: 10
                    }
                },
                messages: {
                    name: {
                        required: "Please enter your name",
                        minlength: "Your name must be at least 2 characters long"
                    },
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    message: {
                        required: "Please enter your message",
                        minlength: "Your message must be at least 10 characters long"
                    }
                },
                errorElement: 'div',
                errorClass: 'text-danger',
                highlight: function(element, errorClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass) {
                    $(element).removeClass('is-invalid');
                },
                // Submit handler for the form
                submitHandler: function(form) {
                    // Disable submit button to prevent multiple submissions
                    $("#commentForm input[type=submit]").prop('disabled', true).val('Sending...');

                    // Get the CSRF token from meta tag
                    var token = $('meta[name="csrf-token"]').attr('content');

                    // Prepare form data
                    var formData = {
                        tips_travel_id: $("input[name='cid']").val(),
                        name: $("#name").val(),
                        email: $("#email").val(),
                        message: $("#message").val(),
                        _token: token
                    };

                    // Send AJAX POST request
                    $.ajax({
                        url: '{{ route('tips.travels.comment') }}',
                        type: 'POST',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            // Show success message with toastr
                            toastr.success(response.message ||
                                'Your comment has been submitted successfully.');

                            // Reset the form
                            form.reset();

                            // Re-enable submit button
                            $("#commentForm input[type=submit]").prop('disabled', false)
                                .val('Send Message');
                        },
                        error: function(xhr) {
                            // Parse error response
                            var errorMessage = 'An error occurred. Please try again.';

                            if (xhr.responseJSON && xhr.responseJSON.message) {
                                errorMessage = xhr.responseJSON.message;
                            }

                            // Show validation errors if provided
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                var errors = xhr.responseJSON.errors;
                                $.each(errors, function(key, value) {
                                    // Display the first error for each field
                                    toastr.error(value[0]);
                                });
                            } else {
                                // Show general error message
                                toastr.error(errorMessage);
                            }

                            // Re-enable submit button
                            $("#commentForm input[type=submit]").prop('disabled', false)
                                .val('Send Message');
                        }
                    });

                    return false; // Prevent default form submission
                }
            });
        });
    </script>
@endpush
