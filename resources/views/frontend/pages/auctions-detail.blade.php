@extends('frontend.layout.main')
@section('title', 'Auction Details')
@section('content')
    <section class="breadcrumb-outer text-center">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Auctions Details</h2>
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>
    <section class="item-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 mx-auto">
                    <div class="item-wrapper">
                        <div class="cover-content">
                            <h2>{{ $auction->title }}</h2>
                            <div class="author-detail">
                                <span><i class="fa fa-clock-o"></i> Posted On :
                                    {{ $auction->created_at->format('d M, Y') }}</span>
                            </div>
                        </div>
                        <div class="cover-image">
                            <img src="{{ $auction->image_url1 }}" alt="Image">
                        </div>
                        <div class="item-detail">
                            <div class="articlepara">
                                {!! $auction->description1 !!}
                            </div>
                            <div class="detail-image">
                                @if ($auction->image2)
                                    <div class="detail-image">
                                        <img src="{{ $auction->image_url2 }}" alt="Image">
                                    </div>
                                @endif
                            </div>
                            <div class="articlepara">
                                {!! $auction->description2 !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
