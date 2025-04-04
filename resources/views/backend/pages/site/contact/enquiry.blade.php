@extends('backend.layout.main')
@section('title', 'Contact Enquiries')
@push('styles')
    <style>
        /* Apply word-break to the message column */
        .enquiries-table th:nth-child(4),
        .enquiries-table td:nth-child(4) {
            word-break: break-word;
            overflow-wrap: break-word;
            max-width: 25%;
            white-space: normal !important;
        }

        /* Make sure the DataTable doesn't override our styles */
        .dataTables_wrapper .enquiries-table td:nth-child(4) {
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
    <div class="content-container">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Contact Enquiries</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="#">Contact Management</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Contact Enquiries
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Enquiries Table start -->
        <div class="card-box mb-30">
            <div class="card-header pd-20">
                <h4 class="text-primary h4">Enquiry List</h4>
            </div>
            <div class="card-body pb-20">
                <table class="data-table table stripe hover nowrap enquiries-table" id="enquiries-table">
                    <thead>
                        <tr>
                            <th style="width:5% !important;">ID</th>
                            <th style="width:20% !important;">Email</th>
                            <th style="width:15% !important;">Phone</th>
                            <th style="width:40% !important; word-break: break-word;">Message</th>
                            <th style="width:20% !important;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Enquiries Table End -->
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#enquiries-table').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('contact.enquires') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        width: '5%'
                    },
                    {
                        data: 'email',
                        name: 'email',
                        width: '20%'
                    },
                    {
                        data: 'phone',
                        name: 'phone',
                        width: '15%'
                    },
                    {
                        data: 'message',
                        name: 'message',
                        width: '40%',
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        width: '20%',
                        orderable: false,
                        searchable: false
                    },
                ]
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
