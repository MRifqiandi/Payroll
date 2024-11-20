<div class="modal fade" id="modal_validate_2fa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-800px" style="max-width: 800px !important">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Two-Factor Authentication</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal-alert-container" class="mb-3"></div>

                <div id="disable-2fa" class="text-center d-flex flex-column align-items-center justify-content-center"
                    style="min-height: 300px;">
                    <p>Enter the authenticator code to continue your action:</p>
                    <form id="validate_2fa_form" class="w-100" style="max-width: 400px;">
                        <div class="mb-3">
                            <label for="auth-code" class="form-label">Authenticator Code:</label>
                            <input type="text" class="form-control" id="validate-auth-code" name="auth_code"
                                required>
                        </div>
                        <button type="submit" class="btn btn-info w-100">Authenticate!</button>
                    </form>
                    <p class="text-danger mt-4">
                        If you have lost access to your authenticator and want to disable 2FA, please contact the
                        administrator.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showValidateAlert(message, type = 'success') {
        const alert = $(`
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <i class="fa fa-times close-icon" data-bs-dismiss="alert" aria-label="Close" style="cursor: pointer;"></i>
            </div>
        `);
        $('#modal_validate_2fa #modal-alert-container').html(alert);
        setTimeout(() => {
            alert.alert('close');
        }, 5000);
    }

    $(document).ready(function() {
        $('#validate_2fa_form').submit(function(e) {
            e.preventDefault();
            const authCode = $('#validate-auth-code').val();

            $('#modal_validate_2fa [type="submit"]').attr('disabled', true);
            $('#modal_validate_2fa [type="submit"]').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
            );

            $.ajax({
                url: '{{ route('authenticator.verify') }}',
                method: 'POST',
                data: {
                    code: authCode
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        showValidateAlert('OTP Has been validated!', 'success');

                        $('#modal_validate_2fa [type="submit"]').html(
                            'Validated! <i class="fa fa-check"></i>'
                        );

                        setTimeout(() => {
                            window.location.reload();
                        }, 2000);
                    }
                },
                error: function(xhr) {
                    $('#modal_validate_2fa [type="submit"]').attr('disabled', false);
                    $('#modal_validate_2fa [type="submit"]').html('Authenticate!');

                    let message = 'An error occurred. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }

                    showValidateAlert(message, 'danger');
                }
            });
        });
    });
</script>
