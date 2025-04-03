@extends('backend.layout.main')
@section('title', 'Footer Section')
@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Contact us</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Manage Contact</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Create Contact
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-primary" href="{{ route('contact.create') }}">
                            <i class="fa fa-plus"></i> Add Contact
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Simple Datatable start -->
        <div class="card-box mb-30">
            <div class="pd-20">
                <h4 class="text-blue h4">Contact Content</h4>
            </div>
            <div class="pb-20">
                <table class="data-table table stripe hover nowrap" id="contact-table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>e-Mail</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Action</th>
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
    <script>
        $(document).ready(function() {
            $('#contact-table').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('contact.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                    },
                    {
                        data: 'address',
                        name: 'address',
                    },
                    {
                        data: 'description',
                        name: 'description',
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
                ]
            });
        });
    </script>
@endpush
