<div class="modal fade" id="modal_add_key" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-800px" style="max-width: 800px !important">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create API Key</h5>
            </div>
            <div class="modal-body">
                <!-- Alert Container -->
                <div id="modal-alert-container" class="mb-3"></div>

                <!-- Form for API Key Creation -->
                <div id="create-api-key-section">
                    <form id="create-api-key-form">
                        <div class="mb-3">
                            <label for="api-name" class="form-label">API Key Name:</label>
                            <input type="text" class="form-control" id="api-name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Permissions:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="create-permission"
                                    name="permissions[]" value="create">
                                <label class="form-check-label" for="create-permission">Create</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="read-permission"
                                    name="permissions[]" value="read">
                                <label class="form-check-label" for="read-permission">Read</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="update-permission"
                                    name="permissions[]" value="update">
                                <label class="form-check-label" for="update-permission">Update</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="delete-permission"
                                    name="permissions[]" value="delete">
                                <label class="form-check-label" for="delete-permission">Delete</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="list-permission"
                                    name="permissions[]" value="list">
                                <label class="form-check-label" for="list-permission">List</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="manage-permission"
                                    name="permissions[]" value="manage">
                                <label class="form-check-label" for="manage-permission">Manage</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" id="create-api-key-btn">
                            <span id="loading-spinner" class="spinner-border spinner-border-sm d-none" role="status"
                                aria-hidden="true"></span>
                            Create API Key
                        </button>
                    </form>
                </div>

                <!-- API Key Display Section -->
                <div id="api-key-display" class="d-none mt-4">
                    <p class="fw-bold">Details:</p>
                    <p><strong>Name:</strong> <span id="api-name-text"></span></p>
                    <p><strong>User:</strong> <span id="api-user-text"></span></p>
                    <p><strong>Key:</strong> <span id="api-key-text" class="text-danger"></span></p>
                    <p class="text-danger mt-4">
                        Warning: This API Key will not be displayed again. Please store it securely.
                    </p>
                    <button class="btn btn-secondary w-100 mt-3" id="ok-btn" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        function modalApiKeyAlert(message, type = 'success') {
            const alert = $(`
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <i class="fa fa-times close-icon" data-bs-dismiss="alert" aria-label="Close" style="cursor: pointer;"></i>
            </div>
        `);
            $('#modal_add_key #modal-alert-container').html(alert);
            setTimeout(() => {
                alert.alert('close');
            }, 5000);
        }

        $('#create-api-key-form').submit(function(e) {
            e.preventDefault();

            // Show loading spinner
            $('#loading-spinner').removeClass('d-none');
            $('#create-api-key-btn').prop('disabled', true);

            const formData = $(this).serialize();

            // AJAX request to create API key
            $.ajax({
                url: '{{ route('api-key.store') }}',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('#api-name-text').text($('#api-name').val());
                        $('#api-user-text').text(response.data.user);
                        $('#api-key-text').text(response.data.key);

                        $('#create-api-key-section').addClass('d-none');
                        $('#api-key-display').removeClass('d-none');
                    }
                },
                error: function(xhr) {
                    let message = 'An error occurred. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }

                    modalApiKeyAlert(message, 'danger');
                },
                complete: function() {
                    $('#loading-spinner').addClass('d-none');
                    $('#create-api-key-btn').prop('disabled', false);
                }
            });
        });

        $('#modal_add_key').on('hidden.bs.modal', function() {
            $('#create-api-key-form').trigger('reset');
            $('#create-api-key-section').removeClass('d-none');
            $('#api-key-display').addClass('d-none');
            $('#modal-alert-container').html('');
        });
    });
</script>
