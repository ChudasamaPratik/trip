@extends('frontend.layout.main')
@section('title', 'Auctions')
@section('content')
    <section class="breadcrumb-outer text-center">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Auctions</h2>
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>

    <section class="blog-list grid-list bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="blog-wrapper">
                        @if (isset($data['auctions']) && $data['auctions']->count() > 0)
                            @foreach ($data['auctions'] as $auction)
                                <div class="blog-item grid-item">
                                    <div class="row align-items-center">
                                        <div class="col-lg-4">
                                            <div class="blog-image">
                                                <img src="{{ asset($auction->image_url) }}" alt="{{ $auction->title }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="blog-content">
                                                <div class="blog-date">
                                                    <p><i class="fa fa-clock-o"></i> Posted On :
                                                        {{ $auction->created_at->format('d M, Y') }}</p>
                                                </div>
                                                <h3><a
                                                        href="{{ route('auction.details', $auction->id) }}">{{ $auction->title }}</a>
                                                </h3>
                                                <p>{!! Str::limit($auction->description1, 300) !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="no-data-container text-center py-5">
                                <div class="mb-4">
                                    <i class="fa fa-info-circle fa-4x text-muted"></i>
                                </div>
                                <h3 class="mb-3">No Data Found</h3>
                                <p class="text-muted">The requested information is not available at the moment.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
