@extends('backend.layout.main')
@section('title', 'User Requirements')
@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>User Requirements</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Requirements</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                User Requirements
                            </li>
                        </ol>
                    </nav>
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
                            <th>Days & Persons</th>
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
            // Initialize DataTable
            $('.slider-table').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('quotation.request.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'image',
                        name: 'image',
                    },
                    {
                        data: 'requirement.origin',
                        name: 'requirement.origin'
                    },
                    {
                        data: 'requirement.destination',
                        name: 'requirement.destination'
                    },
                    {
                        data: 'days_persons',
                        name: 'days_persons',
                    },
                    {
                        data: 'requirement.accommodation',
                        name: 'requirement.accommodation',
                    },
                    {
                        data: 'requirement.breakfast',
                        name: 'requirement.breakfast',
                    },
                    {
                        data: 'requirement.tour',
                        name: 'requirement.tour',
                    },
                    {
                        data: 'requirement.price',
                        name: 'requirement.price',
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
