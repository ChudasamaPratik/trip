@extends('backend.layout.main')
@section('title', 'Requirement Quotations')

@push('styles')
    <style>
        .requirement-image {
            max-height: 200px;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Quotations for Requirement</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Requirements</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('requirements.index') }}">User Requirements</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Quotations
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="{{ route('requirements.index') }}" class="btn btn-secondary">
                        <i class="fa fa-arrow-left"></i> Back to Requirements
                    </a>
                </div>
            </div>
        </div>

        <!-- Requirement Details Card -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4 mb-3">Requirement Details</h4>
                <div class="row">
                    <div class="col-md-3 text-center mb-3">
                        <img src="{{ $requirement->image_url }}" alt="Requirement Image"
                            class="img-fluid rounded requirement-image shadow-sm">
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body p-3">
                                        <h6 class="text-muted small text-uppercase mb-2">Origin</h6>
                                        <p class="mb-0 font-weight-medium">{{ $requirement->origin }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body p-3">
                                        <h6 class="text-muted small text-uppercase mb-2">Destination</h6>
                                        <p class="mb-0 font-weight-medium">{{ $requirement->destination }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body p-3">
                                        <h6 class="text-muted small text-uppercase mb-2">Days & Persons</h6>
                                        <p class="mb-0 font-weight-medium">{{ $requirement->days }} Days /
                                            {{ $requirement->person }} Persons</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body p-3">
                                        <h6 class="text-muted small text-uppercase mb-2">Accommodation</h6>
                                        <p class="mb-0 font-weight-medium">{{ $requirement->accommodation }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body p-3">
                                        <h6 class="text-muted small text-uppercase mb-2">Breakfast</h6>
                                        <p class="mb-0">
                                            <span
                                                class="badge badge-{{ $requirement->breakfast == 'Yes' ? 'success' : 'danger' }} badge-pill">
                                                {{ $requirement->breakfast }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="card h-100">
                                    <div class="card-body p-3">
                                        <h6 class="text-muted small text-uppercase mb-2">Status</h6>
                                        <p class="mb-0">
                                            <span
                                                class="badge badge-{{ $requirement->status == 'pending' ? 'warning' : ($requirement->status == 'quoted' ? 'info' : ($requirement->status == 'confirmed' ? 'success' : 'primary')) }} badge-pill">
                                                {{ ucfirst($requirement->status) }}
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quotations List -->
        <div class="card-box mb-30">
            <div class="pd-20 border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h4 class="text-blue h4 mb-1">Quotations</h4>
                        <p class="mb-0 text-muted">{{ $quotations->count() }} quotation(s) received for this requirement
                        </p>
                    </div>
                </div>
            </div>

            <div class="pb-20 pt-3">
                @if ($quotations->count() > 0)
                    <div class="row mx-0">
                        @foreach ($quotations as $index => $quotation)
                            <div class="col-12 px-3 mb-3">
                                <div class="card {{ $quotation->status == 'accepted' ? 'border-success' : '' }}">
                                    <div
                                        class="card-header bg-{{ $quotation->status == 'accepted' ? 'success text-white' : 'light' }}">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <h5 class="card-title mb-0">
                                                    <i class="fa fa-user-circle mr-2"></i> {{ $quotation->agent->name }}
                                                    @if ($quotation->status == 'accepted')
                                                        <i class="fa fa-check-circle ml-2"></i>
                                                    @endif
                                                </h5>
                                            </div>
                                            <div>
                                                <span
                                                    class="badge badge-pill badge-{{ $quotation->status == 'pending' ? 'warning' : ($quotation->status == 'accepted' ? 'light' : 'danger') }}">
                                                    {{ ucfirst($quotation->status) }}
                                                </span>
                                                <span
                                                    class="text-{{ $quotation->status == 'accepted' ? 'light' : 'dark' }} ml-3">
                                                    <i class="fa fa-calendar mr-1"></i>
                                                    {{ $quotation->updated_at->format('d M, Y') }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="text-center bg-light p-3 rounded">
                                                    <h3 class="display-4 text-success mb-0">
                                                        {{ number_format($quotation->price, 0) }}</h3>
                                                    <p class="text-muted">Quoted Price</p>

                                                    <div class="mt-3">
                                                        <p class="mb-1">
                                                            <i class="fa fa-envelope mr-1"></i>
                                                            {{ $quotation->agent->email }}
                                                        </p>
                                                        <p class="mb-0">
                                                            <i class="fa fa-phone mr-1"></i>
                                                            {{ $quotation->agent->phone ?? 'N/A' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-9">
                                                <div class="border-bottom pb-3 mb-3">
                                                    <h6 class="text-muted mb-2">Description</h6>
                                                    <div class="bg-light p-3 rounded">
                                                        {!! $quotation->description !!}
                                                    </div>
                                                </div>

                                                @if ($quotation->attachment)
                                                    <div>
                                                        <h6 class="text-muted mb-2">Attachment</h6>
                                                        <div class="bg-light p-3 rounded">
                                                            @php
                                                                $fileExt = pathinfo(
                                                                    $quotation->attachment,
                                                                    PATHINFO_EXTENSION,
                                                                );
                                                            @endphp

                                                            <a href="{{ asset('storage/quotations/' . $quotation->attachment) }}"
                                                                class="btn btn-primary" target="_blank">
                                                                <i class="fa fa-download mr-1"></i> Download Attachment
                                                                ({{ strtoupper($fileExt) }})
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if ($quotation->status == 'pending')
                                        <div class="card-footer bg-white border-top">
                                            <div class="text-right">
                                                <form action="#" method="POST" class="d-inline">
                                                    @csrf
                                                    <button type="submit" class="btn btn-danger">
                                                        <i class="fa fa-times mr-1"></i> Reject
                                                    </button>
                                                </form>
                                                <form action="#" method="POST" class="d-inline ml-2">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success">
                                                        <i class="fa fa-check mr-1"></i> Accept Quotation
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @elseif($quotation->status == 'accepted')
                                        <div class="card-footer bg-success text-white">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <i class="fa fa-check-circle mr-2"></i> This quotation has been
                                                    accepted
                                                </div>
                                                <div>
                                                    <a href="{{ route('admin.quotation.details', $quotation->id) }}"
                                                        class="btn btn-light btn-sm">
                                                        <i class="fa fa-eye mr-1"></i> View Details
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="card-footer bg-light text-danger">
                                            <i class="fa fa-times-circle mr-2"></i> This quotation has been rejected
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-5">
                        <div class="icon-box">
                            <i class="dw dw-file-31" style="font-size: 3rem; color: #aaa;"></i>
                        </div>
                        <h5 class="text-muted mt-3">No quotations submitted yet</h5>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
