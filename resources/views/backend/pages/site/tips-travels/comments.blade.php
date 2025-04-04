@extends('backend.layout.main')
@section('title', 'Tips & Travels Comments')
@push('styles')
    <style>
        /* Apply word-break to the message column */
        .tips-travels-comments-table th:nth-child(5),
        .tips-travels-comments-table td:nth-child(5) {
            word-break: break-word;
            overflow-wrap: break-word;
            max-width: 15%;
            white-space: normal !important;
        }

        /* Make sure the DataTable doesn't override our styles */
        .dataTables_wrapper .tips-travels-comments-table td:nth-child(5) {
            white-space: normal !important;
            word-break: break-word !important;
        }

        /* Style for the read more/less functionality */
        .truncated-message {
            word-break: break-word;
            overflow-wrap: break-word;
        }
    </style>
@endpush
@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Tips & Travels Comments</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Site Manage</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Tips & Travels Comments
                            </li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>

        <div class="card-box mb-30">
            <div class="pb-20 pt-3 p-auto">
                <table class="tips-travels-comments-table table stripe hover nowrap">
                    <thead>
                        <tr>
                            <th width="5%">Id</th>
                            <th width="10%">Date</th>
                            <th width="10%">Name</th>
                            <th width="12%">Email</th>
                            <th width="20%" 
                                style="width:20% !important; word-break: break-word;">Message</th>
                            <th width="18%">Tip Name</th>
                            <th width="10%">Action</th>
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
            $('.tips-travels-comments-table').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('tips-and-travels.comments') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '5%'
                    },
                    {
                        data: 'date',
                        name: 'created_at',
                        width: '10%'
                    },
                    {
                        data: 'name',
                        name: 'name',
                        width: '10%'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        width: '12%'
                    },
                    {
                        data: 'message',
                        name: 'message',
                        width: '20%',
                        orderable: false
                    },
                    {
                        data: 'place_name',
                        name: 'place_name',
                        width: '18%'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '10%'
                    },
                ],
                "language": {
                    searchPlaceholder: "Search",
                    paginate: {
                        next: '<i class="ion-chevron-right"></i>',
                        previous: '<i class="ion-chevron-left"></i>'
                    }
                }
            });

            $(document).on("click", ".read-more-link", function(event) {
                event.preventDefault();
                var $tr = $(this).closest("tr");
                var $truncatedMessage = $tr.find(".truncated-message");
                var fullMessage = $truncatedMessage.data("full");

                if ($truncatedMessage.hasClass("showing-full")) {
                    $truncatedMessage.html(
                        truncateString(fullMessage, 30) +
                        ' <a href="#" class="read-more-link">Read More</a>'
                    );
                    $truncatedMessage.removeClass("showing-full");
                } else {
                    $truncatedMessage.html(
                        fullMessage + ' <a href="#" class="read-more-link">Read Less</a>'
                    );
                    $truncatedMessage.addClass("showing-full");
                }
            });

            function truncateString(str, length) {
                return str.length > length ? str.substring(0, length - 3) + "..." : str;
            }

        });
    </script>
@endpush
