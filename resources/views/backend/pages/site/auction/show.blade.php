@extends('backend.layout.main')
@section('title', 'Show Auction')
@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Auctions Detail Show</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Manage Auction</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Auction Detail
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-secondary" href="{{ route('auction.index') }}">
                            <i class="fa fa-list"></i> Back to List
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-box mb-30">
            <div class="pb-20 pt-3 p-auto">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Field</th>
                            <th>Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Title</td>
                            <td>{{ $auction->title }}</td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td>${{ number_format($auction->price, 2) }}</td>
                        </tr>
                        <tr>
                            <td>Days</td>
                            <td>{{ $auction->days }}</td>
                        </tr>
                        <tr>
                            <td>Image</td>
                            <td><img src="{{ $auction->image_url }}" width="100" alt="Auction Image"></td>
                        </tr>

                        <tr>
                            <td>Image 1</td>
                            <td><img src="{{ asset('storage/auctionSection/' . $auction->image1) }}" width="100"
                                    alt="Image 1"></td>
                        </tr>
                        <tr>
                            <td>Description 1</td>
                            <td>{!! $auction->description1 !!}</td>
                        </tr>

                        <tr>
                            <td>Image 2</td>
                            <td><img src="{{ asset('storage/auctionSection/' . $auction->image2) }}" width="100"
                                    alt="Image 2"></td>
                        </tr>
                        <tr>
                            <td>Description 2</td>
                            <td>{!! $auction->description2 !!}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
