@extends('frontend.layout.main')
@section('content')
    <section class="breadcrumb-outer text-center">
        <div class="container">
            <div class="breadcrumb-content">
                <h2>Frequently Asked Questions</h2>
                {{-- <nav aria-label="breadcrumb">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item offset-lg-2"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">FAQ's</li>
                    </ul>
                </nav> --}}
            </div>
        </div>
        <div class="section-overlay"></div>
    </section>

    <section class="flight-destinations">
        <div class="container">
            <div class="row">
                <div id="content" class="col-lg-9 mx-auto">
                    @forelse($data['faqs'] as $key => $faq)
                        <button class="accordion1"><span class="font-weight-bold">{{ $key + 1 }}.</span>
                            {{ $faq->question }}</button>
                        <div class="panel">
                            <p>{!! $faq->answer !!}</p>
                        </div>
                    @empty
                        <div class="no-data-container text-center py-5">
                            <div class="mb-4">
                                <i class="fa fa-info-circle fa-4x text-muted"></i>
                            </div>
                            <h3 class="mb-3">No Data Found</h3>
                            <p class="text-muted">The requested information is not available at the moment.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </section>
@endsection
