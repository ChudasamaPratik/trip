<header>
    <div class="upper-head clearfix">
        <div class="container">
            <div class="contact-info">
                <p><i class="flaticon-phone-call"></i> Phone: (+91)-0123-45678</p>
                <p><i class="flaticon-mail"></i> Mail: <a href="abc@yourdomain.com" class="__cf_email__ text-white"
                        data-cfemail="">abc@yourdomain.com</a></p>
            </div>
            <div class="login-btn pull-right">
                <a href="{{ route('login') }}"><i class="fa fa-user-plus"></i> Login</a>
            </div>
        </div>
    </div>
    <div class="navigation">
        <div class="container">
            <div class="navigation-content">
                <div class="header_menu">
                    <nav class="navbar navbar-default navbar-sticky-function navbar-arrow">
                        <div class="logo pull-left">
                            <a href="{{ url('/') }}">
                                <h1 class="text-dark">BidmyTrip</h1>
                            </a>
                        </div>
                        <div id="navbar" class="navbar-nav-wrapper">
                            <ul class="nav navbar-nav" id="responsive-menu">
                                <li>
                                    <a href="{{ url('/') }}">Home</a>
                                </li>
                                <li>
                                    <a href="{{ route('about') }}">About Us</a>
                                </li>
                                <li>
                                    <a href="{{ route('auctions') }}">Auctions</a>
                                </li>
                                <li>
                                    <a href="{{ route('tips-and-travels') }}">Tips & Travel</a>
                                </li>
                                <li>
                                    <a href="{{ route('bid-on-travel') }}">Bid On Travel</a>
                                </li>
                                <li>
                                    <a href="{{ route('faq') }}">FAQ's</a>
                                </li>
                                <li>
                                    <a href="{{ route('contact-us') }}">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                        <div id="slicknav-mobile"></div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
