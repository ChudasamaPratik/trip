@extends('frontend.layout.main')
@section('title', 'Tips & Travels')
@section('content')
    <section class="breadcrumb-outer text-center">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Tips & Travels</h2>
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>

    <section class="blog-list grid-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog-wrapper">
                        <div class="row d-flex justify-content-center">
                            @if (isset($data['tipsAndTravels']) && $data['tipsAndTravels']->count() > 0)
                                @foreach ($data['tipsAndTravels'] as $item)
                                    <div class="col-lg-4">
                                        <div class="blog-item">
                                            <div class="blog-image">
                                                <img src="{{ asset($item->thumbnail_url) }}" alt="{{ $item->place_name }}">
                                            </div>
                                            <div class="blog-content">
                                                <div class="blog-date">
                                                    <p><i class="fa fa-clock-o"></i> Posted On :
                                                        {{ $item->created_at->format('d M, Y') }}</p>
                                                </div>
                                                <h3><a
                                                        href="{{ route('tips-and-travel.details', $item->id) }}">{{ $item->place_name }}</a>
                                                </h3>
                                                <p>{{ Str::limit(strip_tags($item->description1), 150) }}</p>
                                                <a href="{{ route('tips-and-travel.details', $item->id) }}"
                                                    class="read-more">Read More</a>
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
        </div>
    </section>
@endsection
