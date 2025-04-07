@extends('backend.layout.main')
@section('title', 'Your Requirement')
@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Your Requirement</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="#">Manage Auction</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Your Requirement
                            </li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <div class="dropdown">
                        <a class="btn btn-primary" href="{{ route('requirement.create') }}">
                            <i class="fa fa-plus"></i> Post Your Requirement
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
                            <th>S.No</th>
                            <th>Image</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>No. Of Days</th>
                            <th>No. Of Person</th>
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

    <!-- Agent Assignment Modal -->
    <div class="modal fade" id="assignAgentModal" tabindex="-1" role="dialog" aria-labelledby="assignAgentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="assignAgentModalLabel">Send Quotation Request</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="assignAgentForm" method="POST">
                    @csrf
                    <input type="hidden" name="requirement_id" id="requirement_id">
                    <div class="modal-body">
                        <!-- Radio buttons for assignment type -->
                        <div class="form-group">
                            <label>Assignment Type <span class="text-danger">*</span></label>
                            <div class="custom-control custom-radio mb-2">
                                <input type="radio" id="typePublic" name="assignment_type" value="public"
                                    class="custom-control-input" checked>
                                <label class="custom-control-label" for="typePublic">Make public for all agents</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="typeAgent" name="assignment_type" value="agent"
                                    class="custom-control-input">
                                <label class="custom-control-label" for="typeAgent">Select specific agents</label>
                            </div>
                        </div>

                        <div class="form-group agent-selection" style="display: none;">
                            <label>Select Agents <span class="text-danger">*</span></label>
                            <select class="form-control custom-select2" name="agent_ids[]" id="agent_select"
                                multiple="multiple" style="width: 100%;">
                                <!-- Agents will be loaded here via AJAX -->
                            </select>
                            <div class="error-message" id="agent_ids-error"></div>
                        </div>

                        <!-- Email notification checkbox - only visible for specific agents -->
                        <div class="form-group email-notification" style="display: none;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="sendEmailNotification"
                                    name="send_email" checked>
                                <label class="custom-control-label" for="sendEmailNotification">Send email notification to
                                    selected agents</label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Set Response Deadline (Optional)</label>
                            <input type="datetime-local" class="form-control" name="response_deadline">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Send Request</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirm Delete</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <p>Are you sure you want to delete this requirement?</p>
                    <p class="text-danger">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Check if toastr is available
            if (typeof toastr !== 'undefined') {
                // Configure toastr options
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 5000
                };
            }

            // Initialize Select2
            $('.custom-select2').select2({
                dropdownParent: $('#assignAgentModal'),
                placeholder: "Select agents",
                allowClear: true
            });

            // Toggle agent selection based on assignment type
            $('input[name="assignment_type"]').on('change', function() {
                if ($(this).val() === 'agent') {
                    $('.agent-selection').show();
                    $('.email-notification').show();
                } else {
                    $('.agent-selection').hide();
                    $('.email-notification').hide();
                    $('#agent_select').val(null).trigger('change');
                    $('#agent_ids-error').hide();
                }
            });

            // Initialize DataTable
            $('.slider-table').DataTable({
                scrollCollapse: true,
                autoWidth: false,
                responsive: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('requirement.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'image',
                        name: 'image',
                    },
                    {
                        data: 'origin',
                        name: 'origin'
                    },
                    {
                        data: 'destination',
                        name: 'destination'
                    },
                    {
                        data: 'days',
                        name: 'days',
                    },
                    {
                        data: 'person',
                        name: 'person',
                    },
                    {
                        data: 'accommodation',
                        name: 'accommodation',
                    },
                    {
                        data: 'breakfast',
                        name: 'breakfast',
                    },
                    {
                        data: 'tour',
                        name: 'tour',
                    },
                    {
                        data: 'price',
                        name: 'price',
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

            // Open agent assignment modal
            $(document).on('click', '.btn-assign-agent', function() {
                const requirementId = $(this).data('id');
                $('#requirement_id').val(requirementId);

                // Reset form and clear errors
                resetAssignmentForm();

                // Load agents via AJAX
                $.ajax({
                    url: "{{ route('agents.list') }}",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        $('#agent_select').empty();
                        $.each(response, function(key, agent) {
                            $('#agent_select').append(new Option(agent.first_name, agent
                                .id,
                                false, false));
                        });
                        $('#agent_select').trigger('change');
                        $('#assignAgentModal').modal('show');
                    },
                    error: function(xhr) {
                        if (typeof toastr !== 'undefined') {
                            toastr.error(xhr.responseJSON?.message ||
                                'Failed to load agents. Please try again later.');
                        } else {
                            alert('Failed to load agents. Please try again later.');
                        }
                    }
                });
            });

            // jQuery validation for the form
            $('#assignAgentForm').on('submit', function(e) {
                e.preventDefault();

                // Clear previous error messages
                $('.error-message').empty().hide();

                // Get form data
                const form = $(this);
                const assignmentType = $('input[name="assignment_type"]:checked').val();
                let isValid = true;

                // Validate for specific agent selection
                if (assignmentType === 'agent') {
                    const selectedAgents = $('#agent_select').val();
                    if (!selectedAgents || selectedAgents.length === 0) {
                        $('#agent_ids-error').text('Please select at least one agent').show().css('color',
                            'red');
                        isValid = false;
                    }
                }

                if (!isValid) {
                    return false;
                }

                // Submit the form if validation passes
                $.ajax({
                    url: "{{ route('requirement.assign.agents') }}",
                    type: "POST",
                    data: form.serialize(),
                    beforeSend: function() {
                        $('button[type="submit"]').prop('disabled', true).html(
                            '<i class="fa fa-spinner fa-spin"></i> Processing...');
                    },
                    success: function(response) {
                        $('#assignAgentModal').modal('hide');
                        $('.slider-table').DataTable().ajax.reload();

                        // Reset the form
                        resetAssignmentForm();

                        // Show success message using toastr if available
                        if (typeof toastr !== 'undefined') {
                            toastr.success(response.message);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON || {};

                        // Handle validation errors
                        if (xhr.status === 422 && response.errors) {
                            // Show validation errors under each field
                            $.each(response.errors, function(key, value) {
                                $('#' + key + '-error').text(value[0]).show().css(
                                    'color', 'red');
                            });
                        }

                        // Show general error message
                        if (typeof toastr !== 'undefined') {
                            toastr.error(response.message ||
                                'Something went wrong. Please try again.');
                        } else {
                            alert(response.message ||
                            'Something went wrong. Please try again.');
                        }
                    },
                    complete: function() {
                        $('button[type="submit"]').prop('disabled', false).html('Send Request');
                    }
                });
            });

            // Function to reset the assignment form
            function resetAssignmentForm() {
                $('#assignAgentForm')[0].reset();
                $('#typePublic').prop('checked', true);
                $('.agent-selection').hide();
                $('.email-notification').hide();
                $('#agent_select').val(null).trigger('change');
                $('.error-message').empty().hide();
            }

            // Store requirement ID for deletion
            let deleteRequirementId = null;

            // Delete requirement - show confirmation modal
            $(document).on('click', '.btn-delete', function() {
                deleteRequirementId = $(this).data('id');
                $('#deleteConfirmModal').modal('show');
            });

            // Confirm delete action
            $('#confirmDelete').on('click', function() {
                if (!deleteRequirementId) return;

                $.ajax({
                    url: "{{ url('requirement') }}/" + deleteRequirementId,
                    type: "DELETE",
                    data: {
                        "_token": "{{ csrf_token() }}",
                    },
                    success: function(response) {
                        $('#deleteConfirmModal').modal('hide');
                        $('.slider-table').DataTable().ajax.reload();

                        // Show success message using toastr if available
                        if (typeof toastr !== 'undefined') {
                            toastr.success(response.message ||
                                'Requirement deleted successfully');
                        } else {
                            alert(response.message || 'Requirement deleted successfully');
                        }
                    },
                    error: function(xhr) {
                        $('#deleteConfirmModal').modal('hide');

                        // Show error message using toastr if available
                        if (typeof toastr !== 'undefined') {
                            toastr.error(xhr.responseJSON?.message ||
                                'Failed to delete requirement');
                        } else {
                            alert(xhr.responseJSON?.message || 'Failed to delete requirement');
                        }
                    }
                });
            });
        });
    </script>
@endpush
