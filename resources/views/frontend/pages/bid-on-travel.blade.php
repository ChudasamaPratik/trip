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

    @if (isset($data['bidOnTravel']) && $data['bidOnTravel']->count() > 0)
        @php
            $bidTravel = $data['bidOnTravel']->first();
        @endphp
        <section id="mt_about">
            <div class="container">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-6 col-md-12 pt-5 mt-2">
                        <div class="about_services text-center">
                            <h4>{{ $bidTravel->main_title }}</h4>
                            <h2 class="text-uppercase">{{ $bidTravel->title }}</h2>
                            <p>{!! $bidTravel->description !!}</p>
                        </div>
                        <div class="comment-btn text-center">
                            <a href="#" class="btn-blue btn-red">Register Now</a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="image-rev">
                            <div class="blur-img" style="background-image: url({{ asset($bidTravel->image_url) }});"></div>
                            <img src="{{ asset($bidTravel->image_url) }}" alt="{{ $bidTravel->title }}">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if (isset($data['howItWorks']) && $data['howItWorks']->count() > 0)
        <section class="aboutus">
            <div class="container">
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="section-title text-center">
                            <h2>How does it work?</h2>
                            <div class="section-icon section-icon-white">
                                <i class="flaticon-diamond"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    @foreach ($data['howItWorks'] as $key => $item)
                        <div class="col-lg-4 col-md-6">
                            <div class="about-item">
                                <div class="about-icon">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </div>
                                <div class="about-content">
                                    <h3>{{ $item->title ?? 'Step ' . ($key + 1) }}</h3>
                                    <p>{!! $item->description ?? 'This is a sample of dummy copy text often used to show page layout and design.' !!}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

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
                @php
                    $faqs = isset($data['faqs']) ? $data['faqs'] : null;
                    $totalFaqs = $faqs ? $faqs->count() : 6;
                    $halfCount = ceil($totalFaqs / 2);
                @endphp

                <div class="col-md-6">
                    @if ($faqs && $faqs->count() > 0)
                        @foreach ($faqs->take($halfCount) as $faq)
                            <button class="accordion1">{{ $faq->question }}</button>
                            <div class="panel">
                                <p>{!! $faq->answer !!}</p>
                            </div>
                        @endforeach
                    @else
                        {{--  --}}
                    @endif
                </div>

                <div class="col-md-6">
                    @if ($faqs && $faqs->count() > 0)
                        @foreach ($faqs->skip($halfCount) as $faq)
                            <button class="accordion1">{{ $faq->question }}</button>
                            <div class="panel">
                                <p>{!! $faq->answer !!}</p>
                            </div>
                        @endforeach
                    @else
                        {{--  --}}
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
