@extends('backend.layout.main')
@section('title', 'Your Requirement')
@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Your Requirement</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Manage Auction</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Your Requirement
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-primary" href="{{ route('requirement.create') }}">
                            <i class="fa fa-plus"></i> Post Your Requirement
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-box mb-30">
            <div class="pb-20 pt-3 p-auto">
                <table class="slider-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Image</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>No. Of Days</th>
                            <th>No. Of Person</th>
                            <th>Type Of Accomodation</th>
                            <th>Breakfast</th>
                            <th>Tour</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.slider-table').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('requirement.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'image',
                        name: 'image',
                    },
                    {
                        data: 'origin',
                        name: 'origin'
                    },
                    {
                        data: 'destination',
                        name: 'destination'
                    },
                    {
                        data: 'days',
                        name: 'days',
                    },
                    {
                        data: 'person',
                        name: 'person',
                    },
                    {
                        data: 'accommodation',
                        name: 'accommodation',
                    },
                    {
                        data: 'breakfast',
                        name: 'breakfast',
                    },
                    {
                        data: 'tour',
                        name: 'tour',
                    },
                    {
                        data: 'price',
                        name: 'price',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "language": {
                    searchPlaceholder: "Search",
                    paginate: {
                        next: '<i class="ion-chevron-right"></i>',
                        previous: '<i class="ion-chevron-left"></i>'
                    }
                },
            });
        });
    </script>
@endpush
