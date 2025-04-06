@extends('backend.layout.main')
@section('title', 'View Quotation')

@push('styles')
    <style>
        .detail-card {
            background-color: #f8f9fa;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .detail-label {
            font-weight: bold;
            color: #666;
        }

        .detail-value {
            color: #333;
        }

        .requirement-image {
            max-height: 200px;
            object-fit: cover;
            border-radius: 5px;
        }

        .badge-custom {
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 13px;
        }

        .quotation-card {
            background-color: #fff;
            border-left: 4px solid #0099ff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .quotation-attachment {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 5px;
            border: 1px dashed #ccc;
        }
    </style>
@endpush

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>View Quotation</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Requirements</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="{{ route('quotation.request.index') }}">User Requirements</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                View Quotation
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('quotation.request.index') }}">
                            <i class="fa fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Requirement Details Card -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4 mb-3">Requirement Details</h4>
                <div class="row">
                    <div class="col-md-3 text-center mb-3">
                        <img src="{{ $quotation->requirement->image_url }}" alt="Requirement Image"
                            class="img-fluid requirement-image">
                    </div>
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <div class="detail-card">
                                    <div class="detail-label">Origin</div>
                                    <div class="detail-value">{{ $quotation->requirement->origin }}</div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="detail-card">
                                    <div class="detail-label">Destination</div>
                                    <div class="detail-value">{{ $quotation->requirement->destination }}</div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="detail-card">
                                    <div class="detail-label">Days & Persons</div>
                                    <div class="detail-value">{{ $quotation->requirement->days }} Days /
                                        {{ $quotation->requirement->person }} Persons</div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="detail-card">
                                    <div class="detail-label">Accommodation Type</div>
                                    <div class="detail-value">{{ $quotation->requirement->accommodation }}</div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="detail-card">
                                    <div class="detail-label">Breakfast</div>
                                    <div class="detail-value">
                                        <span
                                            class="badge badge-custom {{ $quotation->requirement->breakfast == 'Yes' ? 'badge-success' : 'badge-danger' }}">
                                            {{ $quotation->requirement->breakfast }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="detail-card">
                                    <div class="detail-label">Tour</div>
                                    <div class="detail-value">
                                        <span
                                            class="badge badge-custom {{ $quotation->requirement->tour == 'Yes' ? 'badge-success' : 'badge-danger' }}">
                                            {{ $quotation->requirement->tour }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <div class="detail-card">
                                    <div class="detail-label">Budget</div>
                                    <div class="detail-value">{{ $quotation->requirement->price }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quotation Details Card -->
        <div class="pd-20 card-box mb-30">
            <div class="clearfix mb-3">
                <div class="pull-left">
                    <h4 class="text-blue h4">Quotation Information</h4>
                    <p class="mb-30">Your submitted quotation details</p>
                </div>
                <div class="pull-right">
                    <span
                        class="badge badge-pill badge-{{ $quotation->status == 'pending' ? 'warning' : ($quotation->status == 'accepted' ? 'success' : 'danger') }}">
                        {{ ucfirst($quotation->status) }}
                    </span>
                </div>
            </div>

            <div class="quotation-card">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="detail-label">Quoted Price</div>
                        <div class="detail-value h4 text-primary mt-1">{{ number_format($quotation->price, 2) }}</div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="detail-label">Submission Date</div>
                        <div class="detail-value">{{ $quotation->updated_at->format('d M, Y h:i A') }}</div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="detail-label mb-2">Description</div>
                        <div class="detail-value">{!! $quotation->description !!}</div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="quotation-attachment">
                            <div class="detail-label mb-2">Attachment</div>
                            @php
                                $fileExt = pathinfo($quotation->attachment, PATHINFO_EXTENSION);
                                $isImage = in_array(strtolower($fileExt), ['jpg', 'jpeg', 'png']);
                            @endphp

                            @if ($isImage)
                                <div class="text-center">
                                    <img src="{{ asset('storage/quotations/' . $quotation->attachment) }}"
                                        alt="Quotation Attachment" class="img-fluid" style="max-height: 300px;">
                                </div>
                            @endif

                            <div class="text-center mt-3">
                                <a href="{{ asset('storage/quotations/' . $quotation->attachment) }}" class="btn btn-primary"
                                    target="_blank">
                                    <i class="fa fa-download"></i> Download Attachment
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
