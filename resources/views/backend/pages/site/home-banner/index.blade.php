@extends('backend.layout.main')
@section('title', 'Home Banner')
@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Home Banner</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Site Manage</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Home Banner
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-primary" href="{{ route('home-banner.create') }}">
                            <i class="fa fa-plus"></i> Add Home Banner
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
                            <th>Id</th>
                            <th>Type</th>
                            <th>Image</th>
                            <th>Status</th>
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
                ajax: "{{ route('home-banner.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'image',
                        name: 'image',
                    },
                    {
                        data: 'status_switch',
                        name: 'status_switch',
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