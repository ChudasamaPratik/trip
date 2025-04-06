@extends('frontend.layout.main')
@section('content')
    <section class="swiper-banner">
        <div class="slider">
            <div class="swiper-container">
                <div class="swiper-wrapper">
                    @foreach ($data['sliders'] as $slider)
                        <div class="swiper-slide" style="background-image:url({{ asset($slider->image_url) }})">
                            <div class="swiper-content" data-animation="animated fadeInDown">
                                <h2>{{ $slider->title }}</h2>
                                <h1>{{ $slider->description }}</h1>
                            </div>
                        </div>
                    @endforeach
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
                @foreach ($data['auctions'] as $auction)
                    <div class="col-lg-4">
                        <div class="package-item">
                            <div class="package-image">
                                <img src="{{ $auction->image_url }}" alt="Image">
                                <div class="package-price">
                                    <p><i>&#8377; {{ $auction->price }}</i> <small>/ Ends in {{ $auction->days }}
                                            days</small> </p>
                                </div>
                            </div>
                            <div class="package-content">
                                <h3>{{ $auction->title }}</h3>
                                <p class="package-days"><i class="flaticon-time"></i> {{ $auction->days }} days</p>
                                <p>{!! Str::limit($auction->description1, 80) !!}</p>
                                <div class="package-info">
                                    <a href="{{ route('auction.details', $auction->id) }}" class="btn-blue btn-red">Bid
                                        Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="bucket-list" class="bucket-list">
        <div class="bucket-icons">
            <div class="container">
                <div class="section-title text-center">
                    <h2>Latest Bids</h2>
                    <div class="section-icon">
                        <i class="flaticon-diamond"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="bucket-content">
            <div class="container">
                <div class="row isotopeContainer d-flex justify-content-center">

                    @forelse($data['bids']  as $bid)
                        <div class="col-lg-6 no-padding isotopeSelector family">
                            <div class="hovereffect-bucket bucket-item">
                                <div class="bucket-image">
                                    <img src="{{ $bid->image_url }}" alt="{{ $bid->title }}" class="img-responsive">
                                </div>
                                <div class="bucket-item-content">
                                    <h3><a href="javascript:void(0)">{{ $bid->title }}</a></h3>
                                    <span class="text-success"> &#8377; {{ $bid->price }}</span>
                                    <span>{{ $bid->category }}</span>

                                    <a href="#" class="btn-blue btn-red">
                                        Bid Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12 text-center">
                            <p>No bids available at the moment. Check back soon!</p>
                        </div>
                    @endforelse

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
                @php
                    $destinations = $data['featured_destinations']->take(5);
                    $firstTwo = $destinations->take(2);
                    $middle = $destinations->skip(2)->take(1);
                    $lastTwo = $destinations->skip(3)->take(2);
                @endphp

                <div class="col-lg-4 col-md-4">
                    @foreach ($firstTwo as $destination)
                        <div class="top-destination-item">
                            <img class="img-responsive" src="{{ asset($destination->image_url) }}"
                                alt="{{ $destination->name }}">
                            <div class="overlay">
                                <h2><a href="javascript:void(0)">{{ $destination->name }}</a></h2>
                                <p>{{ $destination->hotel }} Hotels, {{ $destination->rental }} Rental,
                                    {{ $destination->tour }} Tours, {{ $destination->activities }} Activities</p>
                                <p>{{ $destination->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-lg-4 col-md-4">
                    @foreach ($middle as $destination)
                        <div class="top-destination-item destination-margin">
                            <img class="img-responsive" src="{{ asset($destination->image_url) }}"
                                alt="{{ $destination->name }}">
                            <div class="overlay overlay-full">
                                <h2><a href="javascript:void(0)">{{ $destination->name }}</a></h2>
                                <p>{{ $destination->hotel }} Hotels, {{ $destination->rental }} Rental,
                                    {{ $destination->tour }} Tours, {{ $destination->activities }} Activities</p>
                                <p>{{ $destination->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="col-lg-4 col-md-4">
                    @foreach ($lastTwo as $destination)
                        <div class="top-destination-item">
                            <img class="img-responsive" src="{{ asset($destination->image_url) }}"
                                alt="{{ $destination->name }}">
                            <div class="overlay">
                                <h2><a href="javascript:void(0)">{{ $destination->name }}</a></h2>
                                <p>{{ $destination->hotel }} Hotels, {{ $destination->rental }} Rental,
                                    {{ $destination->tour }} Tours, {{ $destination->activities }} Activities</p>
                                <p>{{ $destination->description }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    @if (isset($data['banner']) && count($data['banner']) > 0)
        <section class="pt-0 pb-0 bg-white">
            <img src="{{ asset($data['banner'][0]->image_url) }}" alt="banner" class="salebanner">
        </section>
    @endif

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
                @foreach ($data['testimonials'] as $key => $testimonial)
                    <li data-target="#testimonial_094" data-slide-to="{{ $key }}"
                        class="{{ $key === 0 ? 'active' : '' }}">
                        <img src="{{ asset($testimonial->image_url) }}" alt="{{ $testimonial->first_name }}">
                    </li>
                @endforeach
            </ol>
            <div class="carousel-inner" role="listbox">
                @foreach ($data['testimonials'] as $key => $testimonial)
                    <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                        <div class="testimonial_094_slide">
                            <p>{!! $testimonial->description !!}</p>
                            <div class="deal-rating">
                                @for ($i = 1; $i <= $testimonial->rating; $i++)
                                    <span class="fa fa-star {{ $i <= $testimonial->rating ? 'checked' : '' }}"></span>
                                @endfor
                            </div>
                            <h5><a
                                    href="javascript:void(0)">{{ $testimonial->first_name . ' ' . $testimonial->last_name }}</a>
                            </h5>
                        </div>
                    </div>
                @endforeach
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

                @foreach ($data['blog'] as $blog)
                    <div class="col-lg-4 col-md-12 mar-bottom-30">
                        <div class="blog-item">
                            <div class="blog-image">
                                <img src="{{ asset($blog->image_url) }}" alt="{{ $blog->title }}">
                            </div>
                            <div class="blog-content">
                                <div class="blog-date">
                                    <p><i class="fa fa-clock-o"></i> Posted On : {{ $blog->created_at->format('d M, Y') }}
                                    </p>
                                </div>
                                <h3><a href="{{ route('blog.details', $blog->id) }}">{{ $blog->title }}</a></h3>
                                <p>{!! Str::limit($blog->description, 120) !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    @if (isset($data['banner']) && count($data['banner']) > 1)
        <section class="pt-0 pb-0 bg-white">
            <img src="{{ asset($data['banner'][1]->image_url) }}" alt="banner" class="salebanner">
        </section>
    @endif
@endsection
