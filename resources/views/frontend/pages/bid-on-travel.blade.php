@extends('frontend.layout.main')
@section('content')
    <section class="breadcrumb-outer text-center">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Bid On Travel</h2>
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>

    <section id="mt_about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 pt-5 mt-2">
                    <div class="about_services text-center">
                        <h4>This is a sample text</h4>
                        <h2 class="text-uppercase">THIS IS A SAMPLE OF DUMMY TEXT!</h2>
                        <p>
                        <p>This is a sample of dummy copy text often used to show page layout and design as sample
                            layout text by Graphic designers, Web designers, People creating templates, and many other
                            uses. This is a sample of dummy copy text often used to show page layout and design as
                            sample layout text by Graphic designers, Web designers, People creating templates, and many
                            other uses. This is a sample of dummy copy text often used to show page layout and design as
                            sample layout text by Graphic designers, Web designers, People creating templates, and many
                            other uses.</p>
                        </p>
                    </div>
                    <div class="comment-btn text-center">
                        <a href="javascript:void(0)" class="btn-blue btn-red">Register Now</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="image-rev">
                        <div class="blur-img"
                            style="background-image: url({{ asset('frontend/images/623c0a3158fd5bid.jpg') }});"></div>
                        <img src="{{ asset('frontend/images/623c0a3158fd5bid.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="aboutus">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>How does it work?</h2>
                        <div class="section-icon section-icon-white">
                            <i class="flaticon-diamond"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="about-item">
                        <div class="about-icon">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                        <div class="about-content">
                            <h3>Sign up</h3>
                            <p>
                            <p>This is a sample of dummy copy text often used to show page layout and design as sample
                                layout text by Graphic designers, Web designers, People creating templates, and many
                                other uses.</p>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-item">
                        <div class="about-icon">
                            <i class="fa fa-gear" aria-hidden="true"></i>
                        </div>
                        <div class="about-content">
                            <h3>Add your services</h3>
                            <p>
                            <p>This is a sample of dummy copy text often used to show page layout and design as sample
                                layout text by Graphic designers, Web designers, People creating templates, and many
                                other uses.</p>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="about-item">
                        <div class="about-icon">
                            <i class="fa fa-plane" aria-hidden="true"></i>
                        </div>
                        <div class="about-content">
                            <h3>
                                Get bookings</h3>
                            <p>
                            <p>This is a sample of dummy copy text often used to show page layout and design as sample
                                layout text by Graphic designers, Web designers, People creating templates, and many
                                other uses.</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="flight-destinations">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>Frequently Asked Questions</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <button class="accordion1">Where do the bookings happen?1</button>
                    <div class="panel">
                        <p>
                        <p>This is a sample of dummy copy text often used to show page layout and design as sample
                            layout text by Graphic designers, Web designers, People creating templates, and many other
                            uses. This is a sample of dummy copy text often used to show page layout and design as
                            sample layout text by Graphic designers, Web designers, People creating templates, and many
                            other uses.1</p>
                        </p>
                    </div>
                    <button class="accordion1">Can I talk directly to the client?2</button>
                    <div class="panel">
                        <p>
                        <p>This is a sample of dummy copy text often used to show page layout and design as sample
                            layout text by Graphic designers, Web designers, People creating templates, and many other
                            uses. This is a sample of dummy copy text often used to show page layout and design as
                            sample layout text by Graphic designers, Web designers, People creating templates, and many
                            other uses.</p>
                        </p>
                    </div>
                    <button class="accordion1">You dont have my destination!3</button>
                    <div class="panel">
                        <p>
                        <p>This is a sample of dummy copy text often used to show page layout and design as sample
                            layout text by Graphic designers, Web designers, People creating templates, and many other
                            uses. This is a sample of dummy copy text often used to show page layout and design as
                            sample layout text by Graphic designers, Web designers, People creating templates, and many
                            other uses.</p>
                        </p>
                    </div>

                    <!-- <button class="accordion1">Can I talk directly to the client?</button>
                                    <div class="panel">
                                        <p>This is a sample of dummy copy text often used to show page layout and design as sample layout text by Graphic designers, Web designers, People creating templates, and many other uses. This is a sample of dummy copy text often used to show page layout and design as sample layout text by Graphic designers, Web designers, People creating templates, and many other uses. </p>
                                    </div>

                                    <button class="accordion1">You don't have my destination!</button>
                                    <div class="panel">
                                        <p>This is a sample of dummy copy text often used to show page layout and design as sample layout text by Graphic designers, Web designers, People creating templates, and many other uses. This is a sample of dummy copy text often used to show page layout and design as sample layout text by Graphic designers, Web designers, People creating templates, and many other uses. </p>
                                    </div> -->

                </div>

                <div class="col-md-6">
                    <button class="accordion1">How do we provide the discount?4</button>
                    <div class="panel">
                        <p>
                        <p>This is a sample of dummy copy text often used to show page layout and design as sample
                            layout text by Graphic designers, Web designers, People creating templates, and many other
                            uses. This is a sample of dummy copy text often used to show page layout and design as
                            sample layout text by Graphic designers, Web designers, People creating templates, and many
                            other uses.4</p>
                        </p>
                    </div>
                    <button class="accordion1">Where do the bookings happen?5</button>
                    <div class="panel">
                        <p>
                        <p>This is a sample of dummy copy text often used to show page layout and design as sample
                            layout text by Graphic designers, Web designers, People creating templates, and many other
                            uses. This is a sample of dummy copy text often used to show page layout and design as
                            sample layout text by Graphic designers, Web designers, People creating templates, and many
                            other uses.1</p>
                        </p>
                    </div>
                    <button class="accordion1">Can I talk directly to the client?6</button>
                    <div class="panel">
                        <p>
                        <p>This is a sample of dummy copy text often used to show page layout and design as sample
                            layout text by Graphic designers, Web designers, People creating templates, and many other
                            uses. This is a sample of dummy copy text often used to show page layout and design as
                            sample layout text by Graphic designers, Web designers, People creating templates, and many
                            other uses.</p>
                        </p>
                    </div>
                    <!-- <button class="accordion1">How do we provide the discount?</button>
                                    <div class="panel">
                                        <p>This is a sample of dummy copy text often used to show page layout and design as sample layout text by Graphic designers, Web designers, People creating templates, and many other uses. This is a sample of dummy copy text often used to show page layout and design as sample layout text by Graphic designers, Web designers, People creating templates, and many other uses. </p>
                                    </div>

                                    <button class="accordion1">Where do the bookings happen?</button>
                                    <div class="panel">
                                        <p>This is a sample of dummy copy text often used to show page layout and design as sample layout text by Graphic designers, Web designers, People creating templates, and many other uses. This is a sample of dummy copy text often used to show page layout and design as sample layout text by Graphic designers, Web designers, People creating templates, and many other uses. </p>
                                    </div> -->

                </div>


            </div>
        </div>
    </section>
@endsection
