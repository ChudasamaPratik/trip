@extends('frontend.layout.main')
@section('content')
    <section class="swiper-banner">
        <div class="slider">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    <div class="swiper-slide"
                        style="background-image:url({{ asset('frontend/images/623ab816bda2cslider1.jpg') }})">
                        <div class="swiper-content" data-animation="animated fadeInDown">
                            <h2>Welcome To BidmyTrip</h2>
                            <h1>We offer you better deals</h1>
                        </div>
                    </div>
                    <div class="swiper-slide"
                        style="background-image:url({{ asset('frontend/images/623ab83b00732slider2.jpg') }})">
                        <div class="swiper-content" data-animation="animated fadeInRight">
                            <h2>Welcome To BidmyTrip</h2>
                            <h1>Exciting schemes just a click away</h1>
                        </div>
                    </div>
                    <div class="swiper-slide"
                        style="background-image:url({{ asset('frontend/images/623ab85585010slider3.jpg') }})">
                        <div class="swiper-content" data-animation="animated fadeInUp">
                            <h2>Welcome To BidmyTrip</h2>
                            <h1>We offer you better deals</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="overlay"></div>
        </div>
    </section>

    <div class="search-box clearfix">
        <div class="container">
            <div class="search-outer">
                <div class="search-content">
                    <form>
                        <div class="row">
                            <div class="col-lg-3 col-md-12">
                                <div class="search-title d-flex align-items-center justify-content-between">
                                    <p>Find Your <span>Holiday</span></p>
                                    <i class="flaticon-sun-umbrella "></i>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="table_item">
                                    <div class="form-group">
                                        <select id="custom-select-1" class="selectpicker form-control">
                                            <option value="0">Destination</option>
                                            <option value="1">0</option>
                                            <option value="2">1</option>
                                            <option value="3">2</option>
                                            <option value="4">3</option>
                                            <option value="5">4</option>
                                        </select>
                                        <i class="flaticon-maps-and-flags"></i>
                                    </div>
                                    <div class="form-group  form-icon">
                                        <select name="custom-select-2" class="selectpicker form-control" tabindex="1">
                                            <option value="0">Accommodation Type</option>
                                            <option value="Hotel">Hotel/Motel</option>
                                            <option value="Villa">Villa/Cottage</option>
                                            <option value="StandardCab">Cabin</option>
                                            <option value="Apartment">Apartment</option>
                                            <option value="Unit">Unit</option>
                                            <option value="BnB">B&amp;B</option>
                                            <option value="GlamourTent">Glamour tent</option>
                                            <option value="Houseboat">Houseboats &amp; Ferries</option>
                                            <option value="PoweredSite">Powered site</option>
                                            <option value="HolidayHome">Holiday home</option>
                                        </select>
                                        <i class="flaticon-box"></i>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <div class="table_item">
                                    <div class="form-group">
                                        <div class="input-group date" id="datetimepicker1">
                                            <input type="text" class="form-control" value="Depart">
                                            <i class="flaticon-calendar"></i>
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group form-icon">
                                        <div class="input-group date" id="datetimepicker2">
                                            <input type="text" class="form-control" value="Return">
                                            <i class="flaticon-calendar"></i>
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <div class="table_item">
                                    <div class="form-group">
                                        <select id="custom-select-1" class="selectpicker form-control">
                                            <option value="0">No. of People</option>
                                            <option value="1">0</option>
                                            <option value="2">1</option>
                                            <option value="3">2</option>
                                            <option value="4">3</option>
                                            <option value="5">4</option>
                                        </select>
                                        <i class="mt-1 fa fa-users"></i>
                                    </div>
                                    <div class="form-group  form-icon">
                                        <!-- <select name="custom-select-2" class="selectpicker form-control" tabindex="1">
            <option value="0">Economy</option>
            <option value="1">0</option>
            <option value="2">1</option>
            <option value="3">2</option>
            <option value="4">3</option>
            <option value="5">4</option>
           </select>
           <i class="mt-1 fa fa-money"></i> -->

                                        <div class="range-slider">
                                            <div data-min="0" data-max="40000" data-unit="&#8377;"
                                                data-min-name="min_price" data-max-name="max_price"
                                                class="range-slider-ui ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"
                                                aria-disabled="false">
                                                <span class="min-value">0 &#8377;</span>
                                                <span class="max-value">40,000 &#8377;</span>
                                                <div class="ui-slider-range ui-widget-header ui-corner-all"
                                                    style="left: 0%; width: 100%;"></div>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-2 col-md-12">
                                <div class="table_item table-item-slider">
                                    <!-- <div class="range-slider">
           <div data-min="0" data-max="2000" data-unit="&#8377;" data-min-name="min_price" data-max-name="max_price" class="range-slider-ui ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" aria-disabled="false">
            <span class="min-value">0 &#8377;</span>
            <span class="max-value">2000 &#8377;</span>
            <div class="ui-slider-range ui-widget-header ui-corner-all" style="left: 0%; width: 100%;"></div>
           </div>
           <div class="clearfix"></div>
          </div> -->
                                    <div class="search pt-3">
                                        <a href="javascript:void(0)" class="btn-blue btn-red">SUBMIT</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <section class="popular-packages">
        <div class="container">
            <div class="section-title text-center">
                <h2>Auctions</h2>
                <div class="section-icon">
                    <i class="flaticon-diamond"></i>
                </div>
            </div>
            <div class="row package-slider slider-button">

                <div class="col-lg-4">
                    <div class="package-item">
                        <div class="package-image">
                            <img src="{{ asset('frontend/images/627384dfc73caau1.jpg') }}" alt="Image">
                            <div class="package-price">
                                <p><i>&#8377; 26591</i> <small>/ Ends in 7 days</small> </p>
                            </div>
                        </div>
                        <div class="package-content">
                            <h3>Koonwarra Holiday Park</h3>
                            <p class="package-days"><i class="flaticon-time"></i> 7 days</p>
                            <p>This is a sample of dummy copy text often used to show page</p>
                            <div class="package-info">
                                <a href="auctions-detail.php?id=1" class="btn-blue btn-red">Bid Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="package-item">
                        <div class="package-image">
                            <img src="{{ asset('frontend/images/627384f7c1da0au2.jpg') }}" alt="Image">
                            <div class="package-price">
                                <p><i>&#8377; 2659</i> <small>/ Ends in 7 days</small> </p>
                            </div>
                        </div>
                        <div class="package-content">
                            <h3>River Retreat Villas</h3>
                            <p class="package-days"><i class="flaticon-time"></i> 7 days</p>
                            <p>This is a sample of dummy copy text often used to show page</p>
                            <div class="package-info">
                                <a href="auctions-detail.php?id=2" class="btn-blue btn-red">Bid Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="package-item">
                        <div class="package-image">
                            <img src="{{ asset('frontend/images/6273851828d77au3.jpg') }}" alt="Image">
                            <div class="package-price">
                                <p><i>&#8377; 2659</i> <small>/ Ends in 7 days</small> </p>
                            </div>
                        </div>
                        <div class="package-content">
                            <h3>Surfside Holiday Park</h3>
                            <p class="package-days"><i class="flaticon-time"></i> 7 days</p>
                            <p>This is a sample of dummy copy text often used to show page</p>
                            <div class="package-info">
                                <a href="auctions-detail.php?id=3" class="btn-blue btn-red">Bid Now</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="package-item">
                        <div class="package-image">
                            <img src="{{ asset('frontend/images/6273853ab509aau1.jpg') }}" alt="Image">
                            <div class="package-price">
                                <p><i>&#8377; 2659</i> <small>/ Ends in 7 days</small> </p>
                            </div>
                        </div>
                        <div class="package-content">
                            <h3>Koonwarra Holiday Park</h3>
                            <p class="package-days"><i class="flaticon-time"></i> 7 days</p>
                            <p>This is a sample of dummy copy text often used to show page</p>
                            <div class="package-info">
                                <a href="auctions-detail.php?id=4" class="btn-blue btn-red">Bid Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="bucket-list" class="bucket-list">
        <div class="bucket-icons">
            <div class="container">
                <div class="section-title text-center">
                    <h2>Latest Bids </h2>
                    <div class="section-icon">
                        <i class="flaticon-diamond"></i>
                    </div>
                </div>
                <!-- <div class="row">
      <div class="col-lg-12">
       <div class="mt_filter">
        <ul class="list-inline text-center filter">
         <li><a href="javascript:void(0)" data-filter=".family"><i class="flaticon-family"></i><span>FAMILY</span></a></li>
        </ul>
       </div>
      </div>
     </div> -->
            </div>
        </div>
        <div class="bucket-content">
            <div class="container">
                <div class="row isotopeContainer">


                    <div class="col-lg-6 no-padding isotopeSelector family">
                        <div class="hovereffect-bucket bucket-item">
                            <div class="bucket-image"><img src="{{ asset('frontend/images/627bb75e15fd5bucket4.jpg') }}"
                                    alt="image" class="img-responsive"></div>
                            <div class="bucket-item-content">
                                <h3><a href="javascript:void(0)">Antrim Villa, Cape Town: 3 nights for 2</a></h3>
                                <span class="text-success"> &#8377; 3000</span><span>Daily Tour</span>

                                <a href="" class="btn-blue btn-red" onclick="showAlert()">Bid Now</a>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 no-padding isotopeSelector family">
                        <div class="hovereffect-bucket bucket-item">
                            <div class="bucket-image"><img src="{{ asset('frontend/images/627bb69135bfdbucket2.jpg') }}"
                                    alt="image" class="img-responsive"></div>
                            <div class="bucket-item-content">
                                <h3><a href="javascript:void(0)">Kruger Kumba: 2 nights for 2</a></h3>
                                <span class="text-success"> &#8377; 2400</span><span>Daily Tour</span>

                                <a href="" class="btn-blue btn-red" onclick="showAlert()">Bid Now</a>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 no-padding isotopeSelector family">
                        <div class="hovereffect-bucket bucket-item">
                            <div class="bucket-image"><img src="{{ asset('frontend/images/627b6927d5e7dbucket2.jpg') }}"
                                    alt="image" class="img-responsive"></div>
                            <div class="bucket-item-content">
                                <h3><a href="javascript:void(0)">Makalali River Lodge: 2 nights for 4</a></h3>
                                <span class="text-success"> &#8377; 2600</span><span>Daily Tour</span>

                                <a href="" class="btn-blue btn-red" onclick="showAlert()">Bid Now</a>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 no-padding isotopeSelector family">
                        <div class="hovereffect-bucket bucket-item">
                            <div class="bucket-image"><img src="{{ asset('frontend/images/627bb5926c022bucket1.jpg') }}"
                                    alt="image" class="img-responsive"></div>
                            <div class="bucket-item-content">
                                <h3><a href="javascript:void(0)">Bundox Safari Lodge: 2 nights for 2</a></h3>
                                <span class="text-success"> &#8377; 2400</span><span>Daily Tour</span>

                                <a href="" class="btn-blue btn-red" onclick="showAlert()">Bid Now</a>

                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-lg-6 no-padding isotopeSelector  family">
       <div class="hovereffect-bucket bucket-item">
        <div class="bucket-image"><img src="images/bucket2.jpg" alt="image" class="img-responsive"></div>
        <div class="bucket-item-content">
         <h3><a href="javascript:void(0)">Bundox Safari Lodge: 2 nights for 2</a></h3>
         <span class="text-success"> &#8377; 20,500</span><span>Daily Tour</span>
        </div>
       </div>
      </div>
      
      <div class="col-lg-6 no-padding isotopeSelector family">
       <div class="hovereffect-bucket bucket-item">
        <div class="bucket-image"><img src="images/bucket3.jpg" alt="image" class="img-responsive"></div>
        <div class="bucket-item-content">
         <h3><a href="javascript:void(0)">Kruger Kumba: 4 nights for 6</a></h3>
         <span class="text-success"> &#8377; 20,500</span><span>Daily Tour</span>
        </div>
       </div>
      </div>
      <div class="col-lg-6 no-padding isotopeSelector  family">
       <div class="hovereffect-bucket bucket-item">
        <div class="bucket-image"><img src="images/bucket4.jpg" alt="image" class="img-responsive"></div>
        <div class="bucket-item-content">
         <h3><a href="javascript:void(0)">Antrim Villa, Cape Town: 3 nights for 2</a></h3>
         <span class="text-success"> &#8377; 20,500</span><span>Daily Tour</span>
        </div>
       </div>
      </div>


      <div class="col-lg-6 no-padding isotopeSelector family">
       <div class="hovereffect-bucket bucket-item">
        <div class="bucket-image"><img src="images/bucket5.jpg" alt="image" class="img-responsive"></div>
        <div class="bucket-item-content">
         <h3><a href="javascript:void(0)">Makalali River Lodge: 2 nights for 2</a></h3>
         <span class="text-success"> &#8377; 20,500</span><span>Daily Tour</span>
        </div>
       </div>
      </div>
      <div class="col-lg-6 no-padding isotopeSelector  family">
       <div class="hovereffect-bucket bucket-item">
        <div class="bucket-image"><img src="images/bucket6.jpg" alt="image" class="img-responsive"></div>
        <div class="bucket-item-content">
         <h3><a href="javascript:void(0)">Bundox Safari Lodge: 2 nights for 2</a></h3>
         <span class="text-success"> &#8377; 20,500</span><span>Daily Tour</span>
        </div>
       </div>
      </div> -->
                </div>
                <div class="section-overlay"></div>
            </div>
        </div>
    </section>


    <section class="top-destinations bg-white">
        <div class="container">
            <div class="section-title text-center">
                <h2>Featured Destinations</h2>
                <div class="section-icon">
                    <i class="flaticon-diamond"></i>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="top-destination-item">
                        <img class="img-responsive" src="{{ asset('frontend/images/623af7fe8c084deal1.jpg') }}"
                            alt="Image">
                        <div class="overlay">
                            <h2><a href="javascript:void(0)">Bahamas</a></h2>
                            <p>5 Hotels, 5 Rental, 9 Tours, 6 Activities</p>
                            <p>
                            <p>This is a sample of dummy copy text often used to show page layout and design as sample
                                layout text by Graphic designers.</p>
                            </p>
                        </div>
                    </div>
                    <div class="top-destination-item">
                        <img class="img-responsive" src="{{ asset('frontend/images/623af82a6a54bdeal2.jpg') }}"
                            alt="Image">
                        <div class="overlay">
                            <h2><a href="javascript:void(0)">Italy</a></h2>
                            <p>5 Hotels, 5 Rental, 9 Tours, 6 Activities</p>
                            <p>
                            <p>This is a sample of dummy copy text often used to show page layout and design as sample
                                layout text by Graphic designers</p>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="top-destination-item destination-margin">
                        <img class="img-responsive" src="{{ asset('frontend/images/623af8803dd5edeal5.jpg') }}"
                            alt="Image">
                        <div class="overlay overlay-full">
                            <h2><a href="javascript:void(0)">Egypt</a></h2>
                            <p>5 Hotels, 1 Rental, 9 Tours, 6 Activities</p>
                            <p>
                            <p>This is a sample of dummy copy text often used to show page layout and design as sample
                                layout text by Graphic designers</p>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="top-destination-item">
                        <img class="img-responsive" src="{{ asset('frontend/images/623af8a484846deal3.jpg') }}"
                            alt="Image">
                        <div class="overlay">
                            <h2><a href="javascript:void(0)">Nepal</a></h2>
                            <p>5 Hotels, 1 Rental, 9 Tours, 6 Activities</p>
                            <p>
                            <p>This is a sample of dummy copy text often used to show page layout and design as sample
                                layout text by Graphic designers</p>
                            </p>
                        </div>
                    </div>

                    <div class="top-destination-item">
                        <img class="img-responsive" src="{{ asset('frontend/images/623af8cf94364deal4.jpg') }}"
                            alt="Image">
                        <div class="overlay">
                            <h2><a href="javascript:void(0)">Thailand</a></h2>
                            <p>5 Hotels, 1 Rental, 9 Tours, 6 Activities</p>
                            <p>
                            <p>This is a sample of dummy copy text often used to show page layout and design as sample
                                layout text by Graphic designers</p>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-0 pb-0 bg-white">
        <img src="{{ asset('frontend/images/623afbae36211salebanner1.jpg') }}" alt="" class="salebanner">
    </section>

    <section class="testimonials ">
        <div class="section-title text-center">
            <h2>Agents</h2>
            <div class="section-icon section-icon-white">
                <i class="flaticon-diamond"></i>
            </div>
        </div>
        <div id="testimonial_094" class="carousel slide testimonial_094_indicators thumb_scroll_x swipe_x ps_easeOutSine"
            data-ride="carousel" data-pause="hover" data-interval="3000" data-duration="1000">
            <ol class="carousel-indicators">
                <li data-target="#testimonial_094" data-slide-to="1" class="active">
                    <img src="{{ asset('frontend/images/623abc0587399u2.jpg') }}" alt="testimonial_094_01">
                </li>
                <li data-target="#testimonial_094" data-slide-to="2">
                    <img src="{{ asset('frontend/images/6273c42503ff4623abc0587399u2.jpg') }}" alt="testimonial_094_02">
                </li>
                <li data-target="#testimonial_094" data-slide-to="3">
                    <img src="{{ asset('frontend/images/623abc28cf94fu2.jpg') }}" alt="testimonial_094_02">
                </li>
                <li data-target="#testimonial_094" data-slide-to="4">
                    <img src="{{ asset('frontend/images/623abc3782d2cu2.jpg') }}" alt="testimonial_094_02">
                </li>
            </ol>
            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <div class="testimonial_094_slide">
                        <p>
                        <p>This is a sample of dummy copy text often used to show page layout and design as sample
                            layout text by Graphic designers, Web designers, People creating templates, and many other
                            uses.</p>
                        </p>
                        <div class="deal-rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <!-- <span class="fa fa-star checked"></span>
        <span class="fa fa-star checked"></span> -->
                            <!-- <span class="fa fa-star checked"></span> -->
                        </div>
                        <h5><a href="javascript:void(0)">Sapna Mohan Das</a></h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="testimonial_094_slide">
                        <p>
                        <p>This is a sample of dummy copy text often used to show page layout and design as sample
                            layout text by Graphic designers, Web designers, People creating templates, and many other
                            uses.</p>
                        </p>
                        <div class="deal-rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <!-- <span class="fa fa-star checked"></span> -->
                            <!-- <span class="fa fa-star checked"></span> -->
                        </div>
                        <h5><a href="javascript:void(0)">Amit Sharma</a></h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="testimonial_094_slide">
                        <p>
                        <p>This is a sample of dummy copy text often used to show page layout and design as sample
                            layout text by Graphic designers, Web designers, People creating templates, and many other
                            uses.</p>
                        </p>
                        <div class="deal-rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <!-- <span class="fa fa-star checked"></span> -->
                        </div>
                        <h5><a href="javascript:void(0)">Divya Chabra RATHORE</a></h5>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="testimonial_094_slide">
                        <p>
                        <p>This is a sample of dummy copy text often used to show page layout and design as sample
                            layout text by Graphic designers, Web designers, People creating templates, and many other
                            uses.</p>
                        </p>
                        <div class="deal-rating">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                        </div>
                        <h5><a href="javascript:void(0)">Raj RATHORE</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog pb-5 ">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title text-center">
                        <h2>Our Blog</h2>
                        <div class="section-icon">
                            <i class="flaticon-diamond"></i>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 mar-bottom-30">
                    <div class="blog-item">
                        <div class="blog-image">
                            <img src="{{ asset('frontend/images/623abe792537dblog3.jpg') }}" alt="Image">
                        </div>
                        <div class="blog-content">
                            <div class="blog-date">
                                <p><i class="fa fa-clock-o"></i> Posted On : 05 May, 2022</p>
                            </div>
                            <h3><a href="blog-detail.php?id=3">Spend Time On The South Coast</a></h3>
                            <p>This is a sample of dummy copy text often used to show page layout and design as sample
                                layout text by Graphic</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 mar-bottom-30">
                    <div class="blog-item">
                        <div class="blog-image">
                            <img src="{{ asset('frontend/images/623abe5a8d9d9blog2.jpg') }}" alt="Image">
                        </div>
                        <div class="blog-content">
                            <div class="blog-date">
                                <p><i class="fa fa-clock-o"></i> Posted On : 05 May, 2022</p>
                            </div>
                            <h3><a href="blog-detail.php?id=2">Guide For The Garden State</a></h3>
                            <p>This is a sample of dummy copy text often used to show page layout and design as sample
                                layout text by Graphic</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 mar-bottom-30">
                    <div class="blog-item">
                        <div class="blog-image">
                            <img src="{{ asset('frontend/images/623abe41d0ad0blog1.jpg') }}" alt="Image">
                        </div>
                        <div class="blog-content">
                            <div class="blog-date">
                                <p><i class="fa fa-clock-o"></i> Posted On : 05 May, 2022</p>
                            </div>
                            <h3><a href="blog-detail.php?id=1">Update Your Interests With Ease</a></h3>
                            <p>This is a sample of dummy copy text often used to show page layout and design as sample
                                layout text by Graphic</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-0 pb-0 bg-white">
        <img src="{{ asset('frontend/images/623afc60ded3dsalebanner2.jpg') }}" alt="" class="salebanner">
    </section>
@endsection
