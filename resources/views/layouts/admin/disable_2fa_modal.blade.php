<div class="modal fade" id="modal_2fa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-800px" style="max-width: 800px !important">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Disable Two-Factor Authentication</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fa fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal-alert-container" class="mb-3"></div>

                <div id="disable-2fa" class="text-center d-flex flex-column align-items-center justify-content-center" style="min-height: 300px;">
                    <p>Enter the authenticator code to disable Two-Factor Authentication:</p>
                    <form id="disable-2fa-form" class="w-100" style="max-width: 400px;">
                        <div class="mb-3">
                            <label for="auth-code" class="form-label">Authenticator Code:</label>
                            <input type="text" class="form-control" id="auth-code" name="auth_code" required>
                        </div>
                        <button type="submit" class="btn btn-danger w-100">Disable 2FA</button>
                    </form>
                    <p class="text-danger mt-4">
                        If you have lost access to your authenticator and want to disable 2FA, please contact the administrator.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showModalAlert(message, type = 'success') {
        const alert = $(`
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <i class="fa fa-times close-icon" data-bs-dismiss="alert" aria-label="Close" style="cursor: pointer;"></i>
            </div>
        `);
        $('#modal_2fa #modal-alert-container').html(alert);
        setTimeout(() => {
            alert.alert('close');
        }, 5000);
    }

    $(document).ready(function () {
        $('#disable-2fa-form').submit(function (e) {
            e.preventDefault();
            const authCode = $('#auth-code').val();

            $.ajax({
                url: '{{ route('authenticator.disable') }}',
                method: 'POST',
                data: { code: authCode },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    if (response.status === 'success') {
                        showModalAlert('Two-Factor Authentication has been disabled successfully.', 'success');

                        setTimeout(() => {
                            $('#modal_2fa').modal('hide');
                        }, 2000);
                    }
                },
                error: function (xhr) {
                    let message = 'An error occurred. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }

                    // Show error alert
                    showModalAlert(message, 'danger');
                }
            });
        });
    });
</script>
