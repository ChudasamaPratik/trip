<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8" />
    <title>
        @hasSection('title')
            @yield('title') |
        @endif
        BidMyTrip
    </title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('backend/vendors/images/apple-touch-icon.png') }}" />
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('backend/vendors/images/favicon-32x32.png') }}" />
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('backend/vendors/images/favicon-16x16.png') }}" />

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/styles/core.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/styles/icon-font.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/vendors/styles/style.css') }}" />

    {{-- sweet alert --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/src/plugins/sweetalert2/sweetalert2.css') }}" />

    {{-- Toaster --}}
    <link rel="stylesheet" href="{{ asset('lib/toaster/toastr.min.css') }}">
    @stack('styles')
</head>

<body>
    {{-- <div class="pre-loader">
        <div class="pre-loader-box">
            <div class="loader-logo">
                <img src="{{ asset('backend/vendors/images/deskapp-logo.svg') }}" alt="" />
            </div>
            <div class="loader-progress" id="progress_div">
                <div class="bar" id="bar1"></div>
            </div>
            <div class="percent" id="percent1">0%</div>
            <div class="loading-text">Loading...</div>
        </div>
    </div> --}}

    @include('backend.includes.header')

    @include('backend.includes.sidebar')

    <div class="main-container">
        <div class="xs-pd-20-10 pd-ltr-20">
            <div style="min-height: 720px; !important">

                @yield('content')
            </div>
            @include('backend.includes.footer')
        </div>
    </div>

    <!-- js -->
    <script src="{{ asset('lib/jquery-3.6.2.js') }}"></script>
    <script src="{{ asset('backend/vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('backend/vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('backend/vendors/scripts/layout-settings.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>

    <!-- jQuery validation -->
    <script src="{{ asset('lib/jquery_validate/jquery.validate.js') }}"></script>
    {{-- Sweet alert --}}
    <script src="{{ asset('backend/src/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
    {{-- Toaster --}}
    <script src="{{ asset('lib/toaster/toastr.min.js') }}"></script>
    <script>
        @if (Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
        @endif
        @if (Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
        @endif
    </script>


    <script>
        $(document).ready(function() {
            $(document).ready(function() {
                // Handle Bootstrap switch click with SweetAlert2 confirmation
                $(document).on('change', '.change-status', function(e) {
                    e.preventDefault();

                    // Store reference to the checkbox
                    var checkbox = $(this);
                    var statusURL = checkbox.data("href");

                    // Temporarily revert the checkbox state for confirmation
                    checkbox.prop('checked', !checkbox.prop('checked'));

                    swal({
                        title: 'Are you sure?',
                        text: 'You are about to change the status!',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, change it!',
                    }).then((result) => {
                        if (result.value) {
                            // If confirmed, toggle the checkbox back
                            checkbox.prop('checked', !checkbox.prop('checked'));

                            $.ajax({
                                url: statusURL,
                                method: 'POST',
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr(
                                        'content')
                                },
                                success: function(response) {
                                    if (response.success) {
                                        swal({
                                            title: 'Success',
                                            text: response.message,
                                        });
                                    } else {
                                        // Revert checkbox if server returns error
                                        checkbox.prop('checked', !checkbox.prop(
                                            'checked'));
                                        swal({
                                            title: 'Error',
                                            text: response.message,
                                        });
                                    }
                                },
                                error: function(xhr, status, error) {
                                    // Revert checkbox on AJAX error
                                    checkbox.prop('checked', !checkbox.prop(
                                        'checked'));
                                    swal('Error',
                                        'Something went wrong. Please try again.',
                                        'error');
                                },
                                complete: function() {
                                    const tableID = $("table").attr('id');
                                    $(`#${tableID}`).DataTable().ajax.reload();
                                }
                            });
                        }
                    });
                });
            });



            $(document).on('click', '.delete', function(e) {
                e.preventDefault();

                const $deleteButton = $(this);
                const deleteURL = $deleteButton.attr("href") || $deleteButton.data("url");


                if (!deleteURL) {
                    swal('Configuration Error', 'No delete URL specified', 'error');
                    return;
                }


                const originalButtonContent = $deleteButton.html();

                // Disable the button to prevent multiple clicks
                $deleteButton.prop('disabled', true);

                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    confirmButtonClass: 'btn btn-success margin-5',
                    cancelButtonClass: 'btn btn-danger margin-5',
                    buttonsStyling: false
                }).then((result) => {
                    if (result.value) {
                        // Show loading state
                        $deleteButton.html('<i class="fa fa-spinner fa-spin"></i> Deleting...');

                        const csrfToken = $('meta[name="csrf-token"]').attr('content');
                        if (!csrfToken) {
                            console.warn('CSRF token not found');
                        }

                        $.ajax({
                            url: deleteURL,
                            type: 'DELETE',
                            data: {
                                "_token": csrfToken
                            },
                            success: function(response) {
                                swal(
                                    'Deleted!',
                                    response.message ||
                                    'Item has been deleted successfully.',
                                    'success'
                                );

                                // If the element is in a table row, remove the row
                                const $tableRow = $deleteButton.closest('tr');
                                if ($tableRow.length) {
                                    $tableRow.fadeOut(400, function() {
                                        $(this).remove();
                                    });
                                }
                            },
                            error: function(xhr) {
                                // More detailed error handling
                                let errorMessage = 'Something went wrong.';

                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMessage = xhr.responseJSON.message;
                                } else if (xhr.status === 403) {
                                    errorMessage =
                                        'You do not have permission to delete this item.';
                                } else if (xhr.status === 404) {
                                    errorMessage =
                                        'The item was not found or has already been deleted.';
                                } else if (xhr.status === 500) {
                                    errorMessage =
                                        'Server error occurred while processing your request.';
                                }

                                swal(
                                    'Error!',
                                    errorMessage,
                                    'error'
                                );
                            },
                            complete: function() {
                                // Restore button state
                                $deleteButton.prop('disabled', false);
                                $deleteButton.html(originalButtonContent);

                                // Reload DataTable if it exists
                                const $table = $("table.dataTable");
                                if ($table.length) {
                                    try {
                                        const tableID = $table.attr('id');
                                        if (tableID && $.fn.DataTable.isDataTable(
                                                `#${tableID}`)) {
                                            $(`#${tableID}`).DataTable().ajax.reload(
                                                null, false);
                                        }
                                    } catch (e) {
                                        console.error('Error reloading DataTable:', e);
                                    }
                                }
                            }
                        });
                    } else {
                        // Re-enable the button if deletion was canceled
                        $deleteButton.prop('disabled', false);
                    }
                }).catch(err => {
                    console.error('SweetAlert error:', err);
                    $deleteButton.prop('disabled', false);
                });
            });
        });
    </script>
    @stack('scripts')
</body>

</html>
