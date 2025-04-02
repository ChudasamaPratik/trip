@extends('backend.layout.main')
@section('title', 'Slider')
@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Permission</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Role & Permission</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Permission
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#permissionModal">
                            <i class="fa fa-plus"></i> Add Permission
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Permission Modal -->
        <div class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="permissionModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="permissionModalLabel">Add Permission</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="permissionForm">
                            @csrf
                            <input type="hidden" name="permission_id" id="permission_id"> <!-- Hidden Field for ID -->
                            <div class="form-group">
                                <label for="name">Permission Name *</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                                <span class="text-danger" id="nameError"></span>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-box mb-30">
            <div class="pb-20 pt-3 p-auto">
                <table class="slider-table table stripe hover nowrap" id="permissionTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
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
            let table = $('#permissionTable').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('permissions.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                language: {
                    searchPlaceholder: "Search",
                    paginate: {
                        next: '<i class="ion-chevron-right"></i>',
                        previous: '<i class="ion-chevron-left"></i>'
                    }
                }
            });
            // Handle Add & Edit Button Click
            $(document).on('click', '.edit', function() {
                let id = $(this).data('id');
                let name = $(this).data('name');
                $('#permission_id').val(id); // Assign ID to hidden field
                $('#name').val(name);
                $('#permissionModalLabel').text('Edit Permission');
                $('#saveChanges').text('Update changes');
                $('#permissionModal').modal('show');
            });
            // jQuery Validation
            $("#permissionForm").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    }
                },
                messages: {
                    name: {
                        required: "Please enter permission name",
                        minlength: "Permission name should be at least 3 characters long"
                    }
                },
                errorClass: 'text-danger',
                errorElement: "span",
                submitHandler: function(form) {
                    let url = "{{ route('permissions.store') }}";
                    let type = 'POST';
                    let permissionId = $('#permission_id').val(); // Get hidden input value
                    if (permissionId) {
                        url = "{{ route('permissions.update', ':id') }}".replace(':id', permissionId);
                        type = 'PUT';
                    }
                    $.ajax({
                        url: url,
                        type: type,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status === 'success') {
                                toastr.success(response.message);
                                $('#permissionModal').modal('hide');
                                table.ajax.reload();
                            }
                        },
                        error: function(xhr) {
                            if (xhr.status === 422) {
                                let errors = xhr.responseJSON.errors;
                                $('.invalid-feedback').remove();
                                $.each(errors, function(field, messages) {
                                    let inputField = $('[name="' + field + '"]');
                                    inputField.addClass('is-invalid');
                                    inputField.after(
                                        '<div class="invalid-feedback">' +
                                        messages[0] + '</div>');
                                });
                            } else {
                                alert("An error occurred. Please try again.");
                            }
                        }
                    });
                }
            });
            // Reset Modal on Close
            $('#permissionModal').on('hidden.bs.modal', function() {
                $('#permissionForm').find('.is-invalid, .invalid-feedback, .text-danger').removeClass(
                    'is-invalid invalid-feedback text-danger').text('');
                $('#permissionForm')[0].reset();
                $('#permissionForm').validate().resetForm();
                $('#permissionModalLabel').text('Add Permission');
                $('#saveChanges').text('Save changes');
                $('#permission_id').val(''); // Reset hidden field
            });
            // Handle Save Button Click
            $('#saveChanges').on('click', function() {
                if ($('#permissionForm').valid()) {
                    $('#permissionForm').submit();
                }
            });
        });
    </script>
@endpush
