@extends('backend.layout.main')
@section('title', 'Legal Pages')


@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Legal Pages</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Site Manage</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Legal Pages
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a class="btn btn-primary" href="{{ route('legal-page.create') }}">
                        <i class="fa fa-plus"></i> Add New Legal Page
                    </a>
                </div>
            </div>
        </div>
        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">All Legal Pages</h4>
            </div>
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="15%">Type</th>
                            <th width="20%">Title</th>
                            <th width="35%">Description</th>
                            <th width="10%">Status</th>
                            <th width="15%">Created Date</th>
                            <th width="10%" class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Simple Datatable End -->
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('.data-table').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('legal-page.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '5%'
                    },
                    {
                        data: 'type',
                        name: 'type',
                        width: '15%'
                    },
                    {
                        data: 'title',
                        name: 'title',
                        width: '20%'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        width: '35%'
                    },
                    {
                        data: 'status_switch',
                        name: 'status',
                        width: '10%'
                    },
                    {
                        data: 'date',
                        name: 'created_at',
                        width: '15%'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '10%'
                    },
                ]
            });


        });
    </script>
@endpush
