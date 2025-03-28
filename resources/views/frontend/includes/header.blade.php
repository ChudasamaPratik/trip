<header>
    <div class="upper-head clearfix">
        <div class="container">
            <div class="contact-info">
                <p><i class="flaticon-phone-call"></i> Phone: (+91)-0123-45678</p>
                <p><i class="flaticon-mail"></i> Mail: <a href="abc@yourdomain.com" class="__cf_email__ text-white"
                        data-cfemail="">abc@yourdomain.com</a></p>
            </div>
            <div class="auth-buttons float-right">
                @auth
                    @if (auth()->user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" class="dashboard-btn  text-white">
                            <i class="fa fa-cogs"></i> Admin Dashboard
                        </a>
                    @elseif(auth()->user()->hasRole('agent'))
                        <a href="{{ route('agent.dashboard') }}" class="dashboard-btn  text-white">
                            <i class="fa fa-headset"></i> Agent Dashboard
                        </a>
                    @else
                        <a href="{{ route('user.dashboard') }}" class="dashboard-btn  text-white">
                            <i class="fa fa-user-circle"></i> Dashboard
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="login-btn  text-white mr-2">
                        <i class="fa fa-sign-in"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="register-btn  text-white">
                        <i class="fa fa-user-plus"></i> Register
                    </a>
                @endauth
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
