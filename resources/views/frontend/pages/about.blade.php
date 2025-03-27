@extends('frontend.layout.main')
@section('content')
    <section class="breadcrumb-outer text-center">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>About Us</h2>
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>
    <section id="mt_about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">

                    <div class="image-rev">
                        <div class="blur-img"
                            style="background-image: url({{ asset('frontend/images/623ad5a6cdbababout.jpg') }});"></div>
                        <img src="{{ asset('frontend/images/623ad5a6cdbababout.jpg') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 pt-5 mt-2">
                    <div class="about_services text-center">
                        <h4>About BidmyTrip</h4>
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
                </div>
            </div>
        </div>
    </section>
    <section id="mt_about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 pt-5 mt-2">
                    <div class="about_services text-center">
                        <h4>What We Do</h4>
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
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="image-rev">
                        <div class="blur-img"
                            style="background-image: url({{ asset('frontend/images/623ad7302d38cabout2.jpg') }});">
                        </div>
                        <img src="{{ asset('frontend/images/623ad7302d38cabout2.jpg') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog pb-5 ">
        <div class="container">
            <div class="row text-center">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>Our Experts</h2>
                        <div class="section-icon">
                            <i class="flaticon-diamond"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mar-bottom-30">
                    <div class="blog-item">
                        <div class="blog-image">
                            <img src="{{ asset('frontend/images/623adb7168579u2.jpg') }}" alt="Image" width="">
                        </div>
                        <div class="blog-content">
                            <h4 class="text-blue">demo demo <span class="text-dark">&#124;</span> SDO</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mar-bottom-30">
                    <div class="blog-item">
                        <div class="blog-image">
                            <img src="{{ asset('frontend/images/62415030a46e0u2.jpg') }}" alt="Image" width="">
                        </div>
                        <div class="blog-content">
                            <h4 class="text-blue">Sandeep Gupta <span class="text-dark">&#124;</span> CEO</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mar-bottom-30">
                    <div class="blog-item">
                        <div class="blog-image">
                            <img src="{{ asset('frontend/images/623adb7168579u2.jpg') }}" alt="Image" width="">
                        </div>
                        <div class="blog-content">
                            <h4 class="text-blue">demo demo <span class="text-dark">&#124;</span> SDO</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mar-bottom-30">
                    <div class="blog-item">
                        <div class="blog-image">
                            <img src="{{ asset('frontend/images/62415030a46e0u2.jpg') }}" alt="Image" width="">
                        </div>
                        <div class="blog-content">
                            <h4 class="text-blue">Sandeep Gupta <span class="text-dark">&#124;</span> CEO</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
