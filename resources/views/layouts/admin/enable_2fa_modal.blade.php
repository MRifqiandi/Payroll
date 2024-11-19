<div class="modal fade" id="modal_2fa" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-800px" style="max-width: 800px !important">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Two-Factor Authentication</h5>
            </div>
            <div class="modal-body">
                <div id="modal-alert-container" class="mb-3"></div>
                <div id="2fa-status">
                    <p>Two-Factor Authentication is not enabled yet. Please enable it to secure your account.</p>
                    <button class="btn btn-primary" id="enable-2fa-btn">Enable 2FA</button>
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                </div>
                <div id="2fa-setup" class="d-none">
                    <form id="enable-2fa-form">
                        <div class="mb-3">
                            <label for="password" class="form-label">Enter your password:</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div id="2fa-details" class="d-none">
                    <div class="text-center d-flex flex-column align-items-center justify-content-center">
                        <p>Scan this QR Code with your authenticator app:</p>
                        <div id="qrcode"></div>
                        <p>Or use this secret key: <span id="secret-key" class="fw-bold"></span></p>
                    </div>
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
                <i class="fa fa-times close-icon ms-3" data-bs-dismiss="alert" aria-label="Close" style="cursor: pointer;"></i>
            </div>
        `);

        $('#modal-alert-container').html(alert);

        setTimeout(() => {
            alert.alert('close');
        }, 5000);
    }

    $(document).ready(function() {
        $('#enable-2fa-btn').click(function() {
            $('#2fa-status').addClass('d-none');
            $('#2fa-setup').removeClass('d-none');
        });

        $('#enable-2fa-form').submit(function(e) {
            e.preventDefault();
            const password = $('#password').val();

            $.ajax({
                url: '{{ route('authenticator.enable') }}',
                method: 'POST',
                data: {
                    password
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('#2fa-setup').addClass('d-none');
                        $('#2fa-details').removeClass('d-none');
                        $('#qrcode').html(
                            `<img src="data:image/svg+xml;base64,${btoa(response.data.qr)}" alt="QR Code">`
                        );
                        $('#secret-key').text(response.data.key);

                        // Show success message
                        showModalAlert(
                            'Two-Factor Authentication has been enabled successfully!',
                            'success');
                    }
                },
                error: function(xhr) {
                    let message = 'An error occurred. Please try again.';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }

                    showModalAlert(message, 'danger');
                }
            });
        });
    });
</script>
