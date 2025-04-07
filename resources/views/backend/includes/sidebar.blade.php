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
                @role('admin')
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
                                    <li><a href="{{ route('tips-and-travels.comments') }}"> Tips & Travels Comment </a></li>
                                </ul>
                            </li>

                            <li><a href="{{ route('bid.index') }}">Latest Bid</a></li>
                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon fa fa-plane"></span><span class="mtext">Bid & Travels</span>
                                </a>
                                <ul class="submenu child">
                                    <li><a href="{{ route('bid-on-travel.index') }}"> Bid & Travels Page</a></li>
                                    <li><a href="{{ route('how-does-it-work.index') }}"> How it Work </a></li>
                                </ul>
                            </li>
                            <li><a href="{{ route('blog.index') }}"> Blog</a></li>
                            <li><a href="{{ route('testimonial.index') }}"> Testimonial</a></li>
                            <li><a href="{{ route('team.index') }}"> Team</a></li>
                            <li><a href="{{ route('faq.index') }}"> FAQ's</a></li>
                            <li><a href="{{ route('legal-page.index') }}"> Legal Pages Content</a></li>

                            <li class="dropdown">
                                <a href="javascript:;" class="dropdown-toggle">
                                    <span class="micon fa fa-plane"></span><span class="mtext">Contact us</span>
                                </a>
                                <ul class="submenu child">
                                    <li><a href="{{ route('contact.index') }}"> Contact Pages Content</a></li>
                                    <li><a href="{{ route('contact.enquires') }}"> Contact Us Enquiry </a>
                                    </li>
                                </ul>
                            </li>


                            <li><a href="{{ route('footer.index') }}"> Footer Pages Content</a></li>
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
                        <a href="{{ route('users.index') }}" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-person-plus"></span><span class="mtext">User Register</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('agents.index') }}" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-person-badge"></span><span class="mtext">Agent Register</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('requirements.index') }}" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-file-earmark-text"></span><span class="mtext">User Requirements</span>
                        </a>
                    </li>
                @endrole
                @role('agent')
                    <li>
                        <a href="{{ route('agent.dashboard') }}" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-house"></span><span class="mtext">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('quotation.request.index') }}" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-file-earmark-text"></span><span class="mtext">Quotation Request</span>
                        </a>
                    </li>
                @endrole
                @role('user')
                    <li>
                        <a href="{{ route('user.dashboard') }}" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-house"></span><span class="mtext">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('requirement.index') }}" class="dropdown-toggle no-arrow">
                            <span class="micon bi bi-file-earmark-text"></span><span class="mtext">Your Requirement</span>
                        </a>
                    </li>
                @endrole

            </ul>
        </div>
    </div>
</div>
<div class="mobile-menu-overlay"></div>
