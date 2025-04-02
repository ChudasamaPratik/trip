<div class="left-side-bar">
    <div class="brand-logo">
        <a href="index.html">
            <img src="{{ asset('backend/vendors/images/deskapp-logo.svg') }}" alt="" class="dark-logo" />
            <img src="{{ asset('backend/vendors/images/deskapp-logo-white.svg') }}" alt="" class="light-logo" />
        </a>
        <div class="close-sidebar" data-toggle="left-sidebar-close">
            <i class="ion-close-round"></i>
        </div>
    </div>
    <div class="menu-block customscroll">
        <div class="sidebar-menu">
            <ul id="accordion-menu">
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-house"></span><span class="mtext">Site Mange</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('slider.index') }}">Slider</a></li>
                        <li><a href="{{ route('home-banner.index') }}">Home Banner</a></li>
                        <li><a href="{{ route('featured-destination.index') }}">Featured Destinations</a></li>
                        <li><a href="{{ route('about.index') }}"> About us Page</a></li>
                        <li><a href="{{ route('auction.index') }}"> Auction Page</a></li>
                        <li class="dropdown">
                            <a href="javascript:;" class="dropdown-toggle">
                                <span class="micon fa fa-plane"></span><span class="mtext">Tips & Travels</span>
                            </a>
                            <ul class="submenu child">
                                <li><a href="{{ route('tips-and-travels.index') }}"> Tips & Travels Page</a></li>
                                <li><a href="javascript:;"> Tips & Travels Comment </a></li>
                            </ul>
                        </li>
                        <li><a href="{{ route('blog.index') }}"> Blog</a></li>

                    </ul>
                </li>
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle">
                        <span class="micon bi bi-shield-lock"></span>
                        <span class="mtext">Role & Permission</span>
                    </a>
                    <ul class="submenu">
                        <li>
                            <a href="{{ route('roles.index') }}"> Role</a>
                        </li>
                        <li>
                            <a href="{{ route('permissions.index') }}">Permission
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="calendar.html" class="dropdown-toggle no-arrow">
                        <span class="micon bi bi-calendar4-week"></span><span class="mtext">Calendar</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
