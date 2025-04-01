@extends('backend.layout.main')
@section('title', 'Roles')
@section('content')
    <div class="min-height-200px ">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Role</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Role & Permission</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Role
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <button class="btn btn-primary ebg-blue" data-toggle="modal" data-target="#roleModal">
                            <i class="bi bi-plus"></i> Add Role
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-box mb-30">
            <div class="pb-20 pt-3 p-auto">
                <table class="slider-table table stripe hover nowrap" id="role-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Role Name</th>
                            <th scope="col">Permissions</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Role Modal -->
        <div class="modal fade" id="roleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Role</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="roleForm">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label for="name">Role Name *</label>
                                <input type="text" class="form-control" name="name" id="name" required>
                            </div>

                            <div class="container mt-4">
                                <h4 class="mb-3">Permissions</h4>

                                <!-- Select All Checkbox -->
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                    <label class="form-check-label" for="selectAll">Select All</label>
                                </div>

                                <div class="form-group row">
                                    @foreach ($permissions as $index => $permission)
                                        <div class="col-md-3 mb-3">
                                            <div class="form-check d-flex align-items-center">
                                                <input type="checkbox" class="form-check-input"
                                                    value="{{ $permission->name }}" name="permission[]"
                                                    id="permissionCheck{{ $index + 1 }}">
                                                <label class="form-check-label ml-2"
                                                    for="permissionCheck{{ $index + 1 }}">{{ $permission->name }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div id="permissionsError" class="text-danger"></div>
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
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#role-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('roles.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'permissions',
                        name: 'permissions'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('#selectAll').change(function() {
                $('.form-check-input').prop('checked', $(this).prop('checked'));
            });
            $(document).on('click', '.edit', function() {
                var id = $(this).data('id');
                var name = $(this).data('name');
                var permissions = $(this).data('permissions');
                $('#roleId').val(id);
                $('#name').val(name);
                $('input[name="permission[]"]').prop('checked', false);
                if (permissions && permissions.length > 0) {
                    permissions.forEach(function(permission) {
                        $('#permissionCheck' + permission).prop('checked',
                            true);
                    });
                }
                $('#roleModal .modal-title').text('Edit Role');
                $('#saveChanges').text('Update changes');
                $('#roleModal').data('roleId', id);
                $('#roleModal').modal('show');
            });
            $("#roleForm").validate({
                rules: {
                    name: {
                        required: true,
                        minlength: 3
                    },
                    "permission[]": {
                        required: true,
                        minlength: 1
                    }
                },
                messages: {
                    name: {
                        required: "Role name is required",
                        minlength: "Role name must be at least 3 characters"
                    },
                    "permission[]": {
                        required: "Please select at least one permission"
                    }
                },
                errorPlacement: function(error, element) {
                    if (element.attr("name") == "permission[]") {
                        error.appendTo("#permissionsError");
                    } else {
                        error.insertAfter(element);
                    }
                },
                errorClass: 'text-danger',
                errorElement: "span",
                submitHandler: function(form) {
                    var url = "{{ route('roles.store') }}";
                    var type = 'POST';
                    var roleId = $('#roleModal').data('roleId');
                    if (roleId) {
                        url = "{{ route('roles.update', ':id') }}".replace(':id', roleId);
                        type = 'PUT';
                    }
                    $.ajax({
                        url: url,
                        type: type,
                        data: $(form).serialize(),
                        success: function(response) {
                            if (response.status === 'success') {
                                toastr.success(response.message);
                                $('#roleModal').modal('hide');
                                table.ajax.reload();
                            }
                        },
                        error: function(xhr, status, error) {
                            if (xhr.status === 422) {
                                var errors = xhr.responseJSON.errors;
                                $('.invalid-feedback').remove();
                                $.each(errors, function(field, messages) {
                                    var inputField = $('[name="' + field + '"]');
                                    inputField.addClass('is-invalid');
                                    inputField.after(
                                        '<div class="invalid-feedback">' +
                                        messages[0] + '</div>');
                                });
                            } else {
                                alert("An error occurred: " + error);
                            }
                        }
                    });
                }
            });
            $('#roleModal').on('hidden.bs.modal', function() {
                $('#roleForm')[0].reset();
                $('#roleForm').validate().resetForm();
                $('#roleForm').find('.is-invalid, .invalid-feedback, .text-danger').removeClass(
                    'is-invalid invalid-feedback text-danger');
                $('#roleModal .modal-title').text('Add Permission');
                $('#saveChanges').text('Save changes');
                $('#roleModal').removeData('roleId');
            });
            $('#saveChanges').on('click', function() {
                if ($('#roleForm').valid()) {
                    $('#roleForm').submit();
                }
            });
        });
    </script>
@endpush
