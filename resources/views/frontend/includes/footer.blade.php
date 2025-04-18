<footer>
    <div class="footer-upper">
        <div class="container">
            <div class="footer-links">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="footer-about footer-margin">
                            <div class="about-logo">
                                <h3>BidmyTrip</h3>
                            </div>
                            <div class="about-location">
                                <p>{!! isset($footer) && isset($footer->description) ? $footer->description : 'Plan and bid on your next trip with us!' !!}</p>
                            </div>
                            <div class="footer-social-links">
                                <ul>
                                    @if (isset($footer) && $footer->facebook_link)
                                        <li class="social-icon"><a href="{{ $footer->facebook_link }}" target="_blank"><i
                                                    class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    @endif

                                    @if (isset($footer) && $footer->instagram_link)
                                        <li class="social-icon"><a href="{{ $footer->instagram_link }}"
                                                target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                        </li>
                                    @endif

                                    @if (isset($footer) && $footer->twitter_link)
                                        <li class="social-icon"><a href="{{ $footer->twitter_link }}" target="_blank"><i
                                                    class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    @endif

                                    @if (isset($footer) && $footer->youtube_link)
                                        <li class="social-icon"><a href="{{ $footer->youtube_link }}" target="_blank"><i
                                                    class="fa fa-youtube" aria-hidden="true"></i></a></li>
                                    @endif

                                    @if (isset($footer) && $footer->linkedin_link)
                                        <li class="social-icon"><a href="{{ $footer->linkedin_link }}"
                                                target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                                        </li>
                                    @endif

                                    @if (isset($footer) && $footer->whatsapp_link)
                                        <li class="social-icon"><a href="{{ $footer->whatsapp_link }}"
                                                target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <div class="footer-links-list footer-margin">
                            <h3>Quick Links</h3>
                            <ul>
                                <li><a href="{{ url('/') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>
                                        Home</a></li>
                                <li><a href="{{ url('/about-us') }}"><i class="fa fa-angle-right"
                                            aria-hidden="true"></i> About Us</a></li>
                                <li><a href="{{ url('/faq') }}"><i class="fa fa-angle-right" aria-hidden="true"></i>
                                        FAQ's</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <div class="footer-links-list footer-margin">
                            <h3>Information</h3>
                            <ul>
                                <li><a href="{{ url('/auctions') }}"><i class="fa fa-angle-right"
                                            aria-hidden="true"></i> Auctions</a></li>
                                <li><a href="{{ url('/tips-and-travels') }}"><i class="fa fa-angle-right"
                                            aria-hidden="true"></i> Tips & Travels</a></li>
                                <li><a href="{{ url('/bid-on-travel') }}"><i class="fa fa-angle-right"
                                            aria-hidden="true"></i> Bid on Travel</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4">
                        <div class="footer-links-list footer-margin">
                            <h3>Support</h3>
                            <ul>
                                <li><a href="{{ url('/contact-us') }}"><i class="fa fa-angle-right"
                                            aria-hidden="true"></i> Contact Us</a></li>
                                <li><a href="{{ url('/privacy-policy') }}"><i class="fa fa-angle-right"
                                            aria-hidden="true"></i> Privacy Policy</a></li>
                                <li><a href="{{ url('/terms-of-use') }}"><i class="fa fa-angle-right"
                                            aria-hidden="true"></i> Terms of Use</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4">
                        <div class="footer-links-list footer-margin">
                            <h3>Get In Touch</h3>
                            <ul>
                                @if (isset($contactUs) && $contactUs)
                                    <li><i class="fa fa-home" aria-hidden="true"></i> <a
                                            href="javascript:void(0)">{{ $contactUs->address ?? 'Address information unavailable' }}</a></li>
                                    <li><i class="flaticon-phone-call"></i> <a
                                            href="tel:{{ $contactUs->phone ?? '' }}">{{ $contactUs->phone ?? 'Phone information unavailable' }}</a></li>
                                    <li><i class="flaticon-mail"></i> <a href="mailto:{{ $contactUs->email ?? '' }}"
                                            class="__cf_email__">{{ $contactUs->email ?? 'Email information unavailable' }}</a></li>
                                @else
                                    <li><i class="fa fa-home" aria-hidden="true"></i> <a href="javascript:void(0)">ABC,
                                            your city, state, country</a></li>
                                    <li><i class="flaticon-phone-call"></i> <a
                                            href="tel:0123-45678">(+91)-0123-45678</a></li>
                                    <li><i class="flaticon-mail"></i> <a href="mailto:info@bidmytrip.com"
                                            class="__cf_email__">info@bidmytrip.com</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-left pt-3">
                    <div class="copyright-content">
                        <p><i class="fa fa-copyright" aria-hidden="true"></i> Copyright {{ date('Y') }} <a
                                href="{{ url('/') }}" target="_blank">BidmyTrip</a> | All rights reserved.</p>
                        <h5 class="text-white mt-2 mb-0">We Accept </h5>
                        <img src="{{ asset('frontend/images/payment.png') }}" alt="Payment methods" class="paymentimg">
                    </div>
                </div>
                <div class="col-lg-6 pt-3">
                    <div class="copyright-content">
                        <p><a href="javascript:void(0)">Disclaimer:</a> {!! isset($footer) && isset($footer->declaimer_description) ? $footer->declaimer_description : 'Terms and conditions apply to all services offered.' !!}</p>
                    </div>
                    <div class="copyright-content pt-1">
                        <p><a href="javascript:void(0)">T&C:</a> {!! isset($footer) && isset($footer->tc_description) ? $footer->tc_description : 'Please refer to our Terms of Use page for complete details.' !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>