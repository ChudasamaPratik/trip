@extends('backend.layout.main')
@section('title', 'Footer Section')
@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Footer</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Manage Footer</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Create Footer
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-primary" href="{{ route('footer.create') }}">
                            <i class="fa fa-plus"></i> Add Footer
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-box mb-30">
            <div class="pb-20 pt-3 p-auto">
                <table class="Bid-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Description</th>
                            <th>Declaimer Description</th>
                            <th>T&C Description</th>
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
            $('.Bid-table').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('footer.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'declaimer_description',
                        name: 'declaimer_description',
                    },
                    {
                        data: 'tc_description',
                        name: 'tc_description',
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
