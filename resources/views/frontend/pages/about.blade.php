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

    @forelse($data['about'] as $index => $aboutSection)
        <section id="mt_about">
            <div class="container">
                <div class="row d-flex align-items-center">
                    @if ($index % 2 == 0)
                        <!-- Even index: Image on left, text on right -->
                        <div class="col-lg-6 col-md-12">
                            <div class="image-rev">
                                <div class="blur-img" style="background-image: url({{ asset($aboutSection->image_url) }});">
                                </div>
                                <img src="{{ asset($aboutSection->image_url) }}" alt="{{ $aboutSection->title }}">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 pt-5 mt-2">
                            <div class="about_services text-center">
                                <h4>{{ $aboutSection->main_title }}</h4>
                                <h2 class="text-uppercase">{{ $aboutSection->title }}</h2>
                                <p>{!! $aboutSection->description !!}</p>
                            </div>
                        </div>
                    @else
                        <!-- Odd index: Text on left, image on right -->
                        <div class="col-lg-6 col-md-12 pt-5 mt-2">
                            <div class="about_services text-center">
                                <h4>{{ $aboutSection->main_title }}</h4>
                                <h2 class="text-uppercase">{{ $aboutSection->title }}</h2>
                                <p>{!! $aboutSection->description !!}</p>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12">
                            <div class="image-rev">
                                <div class="blur-img" style="background-image: url({{ asset($aboutSection->image) }});">
                                </div>
                                <img src="{{ asset($aboutSection->image) }}" alt="{{ $aboutSection->title }}">
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
    @empty
        <!-- No About Sections Found -->
        <div class="no-data-container text-center py-5">
            <div class="mb-4">
                <i class="fa fa-info-circle fa-4x text-muted"></i>
            </div>
            <h3 class="mb-3">No About Content Found</h3>
            <p class="text-muted">About information is not available at the moment.</p>
        </div>
    @endforelse

    <section class="blog pb-5">
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

                @forelse($data['teams'] as $team)
                    <div class="col-lg-3 col-md-6 mar-bottom-30">
                        <div class="blog-item">
                            <div class="blog-image">
                                <img src="{{ asset($team->image_url) }}" alt="{{ $team->first_name . $team->last_name }}"
                                    width="">
                            </div>
                            <div class="blog-content">
                                <h4 class="text-blue">{{ ucfirst($team->first_name) . ' ' . ucfirst($team->last_name) }}
                                    <span class="text-dark">&#124;</span>
                                    {{ $team->designation }}
                                </h4>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- No Team Members Found -->
                    <div class="col-12">
                        <div class="no-data-container text-center py-5">
                            <div class="mb-4">
                                <i class="fa fa-users fa-4x text-muted"></i>
                            </div>
                            <h3 class="mb-3">No Team Members Found</h3>
                            <p class="text-muted">Team information is not available at the moment.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
