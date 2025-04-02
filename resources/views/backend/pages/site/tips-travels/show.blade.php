@extends('backend.layout.main')
@section('title', 'View Tips & Travels')

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>View Tips & Travels</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Site Manage</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('tips-and-travels.index') }}">Tips & Travels</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                View Tips & Travels
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('tips-and-travels.index') }}">
                            <i class="fa fa-list"></i> Back to List
                        </a>
                        <a class="btn btn-primary" href="{{ route('tips-and-travels.edit', $tipsTravel->id) }}">
                            <i class="fa fa-pencil"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-4">
                <div class="pull-left">
                    <h4 class="text-blue h4">{{ $tipsTravel->place_name }}</h4>
                    <p class="mb-30 text-muted">Created: {{ $tipsTravel->created_at->format('M d, Y') }}</p>
                </div>
            </div>

            <!-- Thumbnail Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-dark font-weight-bold mb-3">Thumbnail</h5>
                    @if ($tipsTravel->image)
                        <img src="{{ $tipsTravel->thumbnail_url }}" alt="Thumbnail" class="img-fluid rounded"
                            style="max-height: 400px;">
                    @else
                        <p class="text-muted">No thumbnail available</p>
                    @endif
                </div>
            </div>

            <!-- Description 1 Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-dark font-weight-bold mb-3">Description 1</h5>
                    <div class="border p-3 rounded bg-light">
                        {!! $tipsTravel->description1 !!}
                    </div>
                </div>
            </div>

            <!-- Image 1 Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-dark font-weight-bold mb-3">Image 1</h5>
                    @if ($tipsTravel->image1)
                        <img src="{{ $tipsTravel->image1_url }}" alt="Image 1" class="img-fluid rounded"
                            style="max-height: 400px;">
                    @else
                        <p class="text-muted">No image available</p>
                    @endif
                </div>
            </div>

            <!-- Description 2 Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-dark font-weight-bold mb-3">Description 2</h5>
                    <div class="border p-3 rounded bg-light">
                        {!! $tipsTravel->description2 !!}
                    </div>
                </div>
            </div>

            <!-- Image 2 Section -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="text-dark font-weight-bold mb-3">Image 2</h5>
                    @if ($tipsTravel->image2)
                        <img src="{{ $tipsTravel->image2_url }}" alt="Image 2" class="img-fluid rounded"
                            style="max-height: 400px;">
                    @else
                        <p class="text-muted">No image available</p>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="row">
                <div class="col-12">
                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('tips-and-travels.index') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Back to List
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
