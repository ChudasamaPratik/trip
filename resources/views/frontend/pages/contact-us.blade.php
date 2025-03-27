@extends('frontend.layout.main')
@section('content')
    <section class="breadcrumb-outer text-center">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Feel Free To Contact Us</h2>
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>

    <section class="contact">
        <div class="container">
            <br>
            <div class="row">
                <div class="col-lg-8">
                    <div id="contact-form" class="contact-form">
                        <div id="contactform-error-msg"></div>
                        <form method="POST" id="conform" autocomplete="off">
                            <div class="row">
                                <div class="form-group col-lg-12">
                                    <label>Name:</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Enter full name">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label>Email:</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="abc@xyz.com">
                                </div>
                                <div class="form-group col-lg-6 col-left-padding">
                                    <label>Phone Number:</label>
                                    <input type="text" name="phone" class="form-control" id="phone"
                                        placeholder="XXXX-XXXXXX">
                                </div>
                                <div class="textarea col-lg-12">
                                    <label>Message:</label>
                                    <textarea name="message" placeholder="Enter a message" id="message"></textarea>
                                </div>

                                <div class="form-group col-lg-12">
                                    <div class="g-recaptcha" data-sitekey="6LcFfhAUAAAAAM-OQbebKGpCxrT_-xkr_rEVXCfu">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="comment-btn">
                                        <input type="submit" class="btn-blue btn-red" name="submit" value="Send Message">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="contact-about footer-margin">
                        <h4>Let's Start a Conversation</h4>
                        <p>
                        <p>This is a sample of dummy copy text often used to show page layout and design as sample
                            layout text by Graphic designers..</p>
                        </p>
                        <div class="contact-location">
                            <ul>
                                <li><i class="flaticon-maps-and-flags" aria-hidden="true"></i> ABC, your city, state,
                                    country</li>
                                <li><i class="flaticon-phone-call"></i> (+91)-0123-45678</li>
                                <li><i class="flaticon-mail"></i> <a href="abc@yourdomain.com" class="__cf_email__"
                                        data-cfemail="">abc@yourdomain.com</a></li>
                            </ul>
                        </div>
                        <div class="footer-social-links">
                            <ul>
                                <li class="social-icon"><a href="#" target="_blank"><i class="fa fa-facebook"
                                            aria-hidden="true"></i></a></li>
                                <li class="social-icon"><a href="#" target="_blank"><i class="fa fa-instagram"
                                            aria-hidden="true"></i></a></li>
                                <li class="social-icon"><a href="#" target="_blank"><i class="fa fa-twitter"
                                            aria-hidden="true"></i></a></li>
                                <li class="social-icon"><a href="#" target="_blank"><i class="fa fa-youtube"
                                            aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script type="text/javascript" src="https://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.js"></script>

    <script>
        $.validator.addMethod("email_regex", function(value, element) {
            return this.optional(element) || /^([a-z_0-9"]+)([a-z0-9_\+-\."]+)@([a-z0-9_\-\.]+)\.([a-z]{2,5})$/i
                .test(value);
        }, "The Email Address Is Not Valid Or In The Wrong Format");


        $.validator.addMethod("name_regex", function(value, element) {
            return this.optional(element) || /^[a-zA-Z ]{2,100}$/i.test(value);
        }, "Please choose a name with only a-z 0-9.");

        $.validator.addMethod("phone_regex", function(value, element) {
            return this.optional(element) || /^[0-9]{1}[0-9]{9}$/i.test(value);
        }, "Please choose a valid number.");


        $("#conform").validate({
            errorElement: 'div',
            errorClass: 'help-inline',

            rules: {

                email: {
                    required: true,
                    email_regex: true
                },

                name: {
                    required: true,
                    name_regex: true
                },

                phone: {
                    required: true,
                    phone_regex: true
                },

                message: {
                    required: true,
                },

            },

            messages: {

                email: {
                    required: "Email Is Required",
                    email_regex: "Email Address Is Not Valid "
                },

                name: {
                    required: "Name Is Required",
                    name_regex: "Name Is Not Valid "
                },

                phone: {
                    required: "Phone Number Is Required",
                    phone_regex: "Number Is Not Valid "
                },

                message: {
                    required: " Message Is Required"
                },

            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    </script>
@endpush
